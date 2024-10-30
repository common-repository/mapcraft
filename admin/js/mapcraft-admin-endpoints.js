window.MapCraftCreateMap = (id) => {
  console.log('Created map ' + id)
}

window.MapCraftEditMap = (id, settings) => {
  // console.log('Edit map ' + id + ' with settings: ')
  // console.log(JSON.stringify(settings))

  document.querySelector('#mapcraft-modal-wrap').style.display = 'flex'
  window.initGoogleMapsEditor(settings)

  const eventSaveSuccess = new CustomEvent('mcp-save-success')
  const eventSaveError = new CustomEvent('mcp-save-error')
  const eventUploadImageDone = new CustomEvent('mcp-upload-image-done', {
    detail: {
      url: '',
      sender: ''
    }
  })

  document.addEventListener('mcp-save', () => {
    var editedSettings = window.mapcraftGetSettings()
    window.MapCraftAdmin.saveMap(id, editedSettings, (success) => {
      document.dispatchEvent(eventSaveSuccess)
    }, () => {
      document.dispatchEvent(eventSaveError)
    })
  })
  document.addEventListener('mcp-close', () => {
    location.reload()
  })
  document.addEventListener('mcp-upload-image', e => {
    wp.media.frames.gk_frame = wp.media({
      title: 'Select Media',
      multiple: false,
      library: {
        type: 'image'
      },
      button: {
        text: 'Use Selected Media'
      }
    })

    var gk_media_set_image = function() {
      var selection = wp.media.frames.gk_frame.state().get('selection')
      
      if (!selection) {
        return
      }

      selection.each(function(attachment) {
        var url = attachment.attributes.url
        
        eventUploadImageDone.detail.url = url
        eventUploadImageDone.detail.sender = e.detail.sender
        document.dispatchEvent(eventUploadImageDone)
      })
    }

    wp.media.frames.gk_frame.on('select', gk_media_set_image)
    wp.media.frames.gk_frame.open()
  })
}
