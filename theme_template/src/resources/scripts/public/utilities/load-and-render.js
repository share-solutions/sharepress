const loadAndRender = (options, complete, onerror) => {
  loadItems(options.url, options.ajaxSettings ? options.ajaxSettings : {})
        .done(data => {
          if (data.success === true) {
            render(data.data, options.wrapper, options.template, options.replace, complete)
          } else {
            console.warn('load error')
          }
        })
        .fail(response => {
          if (onerror) onerror(response)
        })
}
export const loadItems = (url, ajaxSettings) => {
  return $.ajax(url, ajaxSettings || {})
        .done(data => {
            /* console.log("loadItems done", data); */
        })
        .fail(err => { /* console.warn("load error", err) */ })
}
const render = (data, wrapper, template, replaceContents, complete) => {
    // clone template
  let clone, template_match, templateElement
  let templateMatchKeys = Object.keys(data.template_match)
  const newNodes = data.data.map((item) => {
    if (item.template) {
      template_match = data.template_match[item.template]
      templateElement = $(item.template).eq(0)
    } else {
      template_match = data.template_match
      templateElement = template
    }
    templateMatchKeys = Object.keys(template_match)
    clone = templateElement.clone()
    templateMatchKeys.map(key => {
      if (typeof template_match[key] === 'string') {
        if (template_match[key].substr(0, 2) === '!!') {
          clone.find(template_match[key].substr(2)).attr('href', item[key])
        } else if (template_match[key].substr(0, 2) === '##') {
          clone.find(template_match[key].substr(2)).attr('src', item[key])
        } else if (template_match[key].substr(0, 2) === '!#') {
          clone.find(template_match[key].substr(2)).attr('alt', item[key])
        } else {
          clone.find(template_match[key]).html(item[key])
        }
      }
    })
    return clone
  })

    // add up to wrapper
  if (replaceContents) {
    wrapper.html(newNodes)
  } else {
    wrapper.append(newNodes)
  }

  complete(data, newNodes)
}

export default loadAndRender
