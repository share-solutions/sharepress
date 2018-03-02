(function () {
    // https://generatewp.com/take-shortcodes-ultimate-level/

  var shortcircuitSetContentEvent = false

  function getAttr (s, n) {
    n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s)
    return n ? window.decodeURIComponent(n[1]) : ''
  };

  function parseAttributes (data) {
    let pairs = data.split(' ')
    let ret = {}
    console.log(pairs)
    for (var i = 0; i < pairs.length; i++) {
      let keyVal = pairs[i].split('=')
      if (keyVal[1]) { ret[keyVal[0]] = keyVal[1].replace(/\"/g, '') }
    }
    return ret
  }

  function html (tag, atts, content) {
    var attributes = parseAttributes(atts)

    return $.ajax(tinymce_shortcodes_handler.url, {
      dataType: 'json',
      method: 'post',
      data: {
        action: 'tinymce_shortcodes_handler',
        tag: tag,
        atts: attributes,
        content: content,
        nonce: tinymce_shortcodes_handler.nonce
      }
    })
  }

  function replaceShortcodes (content, theEditor) {
    const keys = Object.keys(tinyMCE_object)

    shortcircuitSetContentEvent = true
    replaceShortcode(0, keys, content, theEditor)
  }

  function recursivelyMatch (tag, reg, content, endCb) {
    var matches = reg.exec(content)
    if (matches !== null) {
      html(tag, matches[1], matches[2])
                .done(data => {
                  content = content.replace(matches[0], "<div class='shortcoded' data-shortcode='" + matches[0].substr(1, matches[0].length) + "'>" + data.data + '</div>')
                  recursivelyMatch(tag, reg, content, endCb)
                })
                .fail(err => {
                  recursivelyMatch(tag, reg, content, endCb)
                })
    } else {
      endCb(content)
    }
  }

  function replaceShortcode (index, keys, content, theEditor) {
    if (content.indexOf('[' + keys[index]) !== -1) {
      var reg = new RegExp('\\[' + keys[index] + '([^\\]]*)\\]([^\\]]*)\\[\\/' + keys[index] + '\\]', 'g')
      recursivelyMatch(keys[index], reg, content, function (newContent) {
        if (keys[index + 1]) {
          replaceShortcode(index + 1, keys, newContent, theEditor)
        } else {
          shortcircuitSetContentEvent = true
          theEditor.setContent(newContent)
        }
      })
    } else {
      if (keys[index + 1]) {
        replaceShortcode(index + 1, keys, content, theEditor)
      } else {
        shortcircuitSetContentEvent = true
        theEditor.setContent(content)
      }
    }
  }

  function restoreShortcodes (tag, content) {
        // match any image tag with our class and replace it with the shortcode's content and attributes
    return content.replace(/(?:<p(?: [^>]+)?>)*(<div [^>]+>)(?:<\/p>)*/g, function (match, span) {
      var data = getAttr(span, 'data-shortcode')

      if (data) {
        return '[' + data
      }
      return match
    })
  }

  var DOMReady = function (a, b, c) {
    b = document, c = 'addEventListener'
    b[c] ? b[c]('DOMContentLoaded', a) : window.attachEvent('onload', a)
  }
  DOMReady(function () {
    try {
      const buttonConfiguration = (editor, buttonData) => {
        return {
          text: buttonData.label,
          icon: false,
          onclick: buttonData.fields
                        ? () => {
                          editor.windowManager.open({
                            title: buttonData.windowLabel,
                            body: buttonData.fields,
                            onsubmit: function (e) {
                              let atts = [], content = []
                              if (buttonData.fields) {
                                atts = buttonData.fields.map(item => {
                                  if (!!e.data[item.name] && item.name !== 'content') {
                                    return item.name + '="' + e.data[item.name] + '"'
                                  }
                                  return null
                                })
                                content = buttonData.fields.map(item => {
                                  if (!!e.data[item.name] && item.name === 'content') {
                                    return e.data[item.name] + '[/' + buttonData.shortcode + ']'
                                  }
                                })
                              }
                              editor.insertContent('[' + buttonData.shortcode + atts.join(' ') + ']' + content.join(''))
                            }
                          })
                        }
                        : () => {
                          editor.insertContent('[' + buttonData.shortcode + ']')
                        }
        }
      }
      tinymce.PluginManager.add('custombuttons', function (editor, url) {
        for (let buttonKey in tinyMCE_object) {
          if (tinyMCE_object.hasOwnProperty(buttonKey)) { editor.addButton(buttonKey, buttonConfiguration(editor, tinyMCE_object[buttonKey])) }
        }

                // replace from shortcode to an image placeholder

        editor.on('BeforeSetcontent', function (event) {
                    /*
                    if(!shortcircuitSetContentEvent) {
                        setTimeout(function () {
                            replaceShortcodes (event.content, editor)
                        }, 10);
                    }
                    else {
                        event.content = event.content
                    }
                    shortcircuitSetContentEvent = false
                    */
        })

                // replace from image placeholder to shortcode
        editor.on('GetContent', function (event) {
                    // TODO: Reactivate BeforeSetcontent Code and review the restore Process which was the one failing
                    // event.content = event.content; //restoreShortcodes(event.content);
        })
      })
    } catch (error) {
      console.log(error)
    }
  })
})()
