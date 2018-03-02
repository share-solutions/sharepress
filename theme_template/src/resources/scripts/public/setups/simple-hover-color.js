$(function () {
  const dataHoverColorElements = $('[data-hover-color]')
  dataHoverColorElements.each(function (index, item) {
    const elem = $(item)
    elem.attr('data-original-color', elem.css('color'))
  })
  dataHoverColorElements.on('mouseover', function () {
    const elem = $(this)
    const color = elem.data('hover-color')
    elem.find('> a').css('color', color)
  })
  dataHoverColorElements.on('mouseout', function () {
    const elem = $(this)
    const color = elem.data('original-color')
    elem.find('> a').css('color', color)
  })
}(jQuery))
