// import setupAccordeons from './accordeon'
// import setupContentCardsContainers from './content-cards-container'
// import setupCoverImages from './cover-images'
// import setupSidedata from './sidedata'
import loadAndRender from '../utilities/load-and-render'
// import presentFormMessage from './form-messages'

let loadTargets = [];

(function ($) {
  let element,
    fadeSpeed = 600
  const setupLoader = (loader) => {
    const loaderData = loadTargets[loader].data,
      wrapper = $(loaderData.loadmoreTarget),
      template = $(loaderData.loadmoreTemplate),
      noData = $(loaderData.loadmoreNodata),
      showHideContainer = loaderData.loadmoreShowhidecontainer,
      wait = loaderData.loadmoreWait
    loader.click(evt => {
      evt.preventDefault()
      if (!loader.hasClass('is-loading')) {
        if (noData) noData.slideUp()
        loader.addClass('is-loading')
        loadAndRender({
          url: window[loaderData.loadmoreHandler].url,
          wrapper,
          template,
          replace: false,
          ajaxSettings: {
            dataType: 'json',
            method: 'post',
            data: Object.assign({
              action: loaderData.loadmoreHandler,
              nonce: window[loaderData.loadmoreHandler].nonce,
              page: loaderData.loadmorePage
            }, loaderData.loadmoreParams)
          }
        }, (data, newNodes) => {
          loader.removeClass('is-loading')
          if (data.data.length === 0) {
            if (wrapper.children().length === 0) {
              if (noData) noData.fadeIn()
              if (showHideContainer) {
                showHideContainer.hide()
              }
            }
            loader.hide()
          } else {
            if (showHideContainer) {
              showHideContainer.show()
            }
                        // show new elements
            newNodes.map((node) => {
              $(node).fadeIn(fadeSpeed)
            })
                        // setupAccordeons()
                        // setupContentCardsContainers()
                        // setupCoverImages()
                        /*
                        if(!!data.sidedata) {
                            setupSidedata(data.sidedata)
                        }
                        */
            const nextPage = data.paging.next
            if (nextPage === -1 || nextPage === '') {
              loader.hide()
            }
            loaderData.loadmorePage = nextPage
          }
        }, (error) => {
                    // presentFormMessage("error")
          console.warn(error)
          loader.removeClass('is-loading')
          loader.hide()
        })
      }
    })
    if (!wait) {
      loader.click()
    }
  }
  $('[data-loadmore-target]').each((index, item) => {
    element = $(item)
    loadTargets[element] = {
      data: element.data()
    }
    setupLoader(element)
  })
}(jQuery))
