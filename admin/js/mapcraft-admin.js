
(function ($) {
  window['mapCraftProIsWP'] = true
  'use strict'

  var MapCraftAdmin = function () {
    var self = this

    /**
     * Edit button
     */
    $('#mapcraft-list').on('click', '.edit a', function (e) {
      e.preventDefault()
      var id = $(this).data('id')
      window.MapCraftEditMap(id, self.maps[id])
    })

    /**
     * Delete button
     */
    $('#mapcraft-list').on('click', '.trash a', function (e) {
      e.preventDefault()
      var id = $(this).data('id')

      var confirmed = window.confirm('Are you sure you want to delete this map?')

      if (!confirmed) {
        return
      }

      self.request('mapcraft_delete_map', { id: id }, function () {
        self.loadMaps()
      })
    })

    /**
     * Create button
     */
    $('#mapcraft-create').on('click', function () {
      self.request('mapcraft_create_map', {}, function (data) {
        window.MapCraftCreateMap(data.id)
        self.loadMaps()
      })
    })

    /**
     * Set API key button
     */
    $('#mapcraft-set-api-key').on('click', function () {
      $('#mapcraft-set-api-key').html('Saving...').attr('disabled', '')
      self.request('mapcraft_set_api_key', { key: $('#input-api-key').val() }, function (data) {
        $('#mapcraft-set-api-key').html('Save').removeAttr('disabled')
      })
    })
  }

  MapCraftAdmin.prototype.maps = {}

  MapCraftAdmin.prototype.request = function (action, data, success, error) {
    data.action = action
    $.ajax({
      url: mapcraft.ajaxurl,
      method: 'post',
      data: data,
      success: function (data) {
        success(data)
      },
      error: function(data) {
        error(data)
      }
    })
  }

  MapCraftAdmin.prototype.loadMaps = function () {
    var self = this
    var wrapper = $('#mapcraft-list')
    var loading = $('#mapcraft-list-loading')

    loading.show()

    wrapper.find('tr:not(#mapcraft-list-loading)').remove()

    this.request('mapcraft_get_maps', {}, function (data) {
      self.maps = {}
      loading.hide()
      $.each(data, function (id, settings) {
        self.maps[id] = settings
        wrapper.append(
          '<tr>' +
            '<td>' +
                settings.general.name +
            '</td>' +
            '<td>' +
                '<code>[mapcraft id="' + id + '"]</code>' +
            '</td>' +
            '<td>' +
                '<div class="row-actions visible">' +
                    '<span class="edit">' +
                        '<a href="#" aria-label="Edit" data-id="' + id + '">Edit</a> | </span>' +
                    '<span class="trash">' +
                        '<a href="#" aria-label="Delete" data-id="' + id + '">Delete</a></span>' +
                '</div>' +
            '</td>' +
          '</tr>'
        )
      })
    })
  }

  MapCraftAdmin.prototype.saveMap = function (id, settings, success, error) {
    success = success || function () {}
    this.request('mapcraft_save_map', {
      id: id,
      settings: JSON.stringify(settings)
    }, function (data) {
      success(data)
    }, function (data) {
      error(data)
    })
  }

  MapCraftAdmin.prototype.loadAPIKey = function (success) {
    var self = this
    success = success || function () {}
    this.request('mapcraft_get_api_key', {}, function (data) {

      // If there is no key in the database, set a temporary one
      if (data.key == 'false' || data.key == false) {
        console.log('Did not find API key')
        data.key = 'AIzaSyDfo9oX2ARzpE-X_S9rG8FOzpTlIqeCGk4'

        // Save the temporary key to DB
        self.request('mapcraft_set_api_key', { key: 'AIzaSyDfo9oX2ARzpE-X_S9rG8FOzpTlIqeCGk4' }, function (data) {
          console.log('API key saved')
        })
      } else {
        console.log('API key found')
      }

      // Set the input field value to the API key
      success(data)
      $('#input-api-key').val(data.key)
    })
  }

  MapCraftAdmin.prototype.detectCachingPlugins = function (success) {
    success = success || function () {}
    this.request('mapcraft_detect_caching_plugins', {}, function (data) {
      success(data)

      if (data.name.length > 0 && data.dashboard.length > 0) {
        $('#cache-warning').show()
        $('#cache-plugin-name').html(data.name)
        $('#cache-plugin-link').attr('href', data.dashboard)
      } else {
        $('#cache-warning').hide()
      }
    })
  }

  MapCraftAdmin.prototype.getPluginsURL = function () {
    this.request('mapcraft_get_plugins_url', {}, function (data) {
      document.querySelector('#mapcraft-plugins-url').innerHTML = data.url
    }, function (error) {
      console.log(error)
    })
  }

  $(function () {
    window.MapCraftAdmin = new MapCraftAdmin($)
    window.MapCraftAdmin.loadMaps()
    window.MapCraftAdmin.loadAPIKey()
    window.MapCraftAdmin.detectCachingPlugins()
    window.MapCraftAdmin.getPluginsURL()
  })
})(jQuery)
