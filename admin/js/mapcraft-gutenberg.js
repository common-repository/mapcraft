(function ($, wp) {
  var el = wp.element.createElement
  var registerBlockType = wp.blocks.registerBlockType
  var SelectControl = wp.components.SelectControl

  registerBlockType('mapcraft/mapcraft', {
    title: 'MapCraft',
    icon: 'location-alt',
    category: 'widgets',
    attributes: {
      shortcode: {
        type: 'string'
      }
    },
    edit: function (props) {
      if (!props.attributes.loaded) {
        props.attributes.loaded = true

        $.post(ajaxurl, {
          action: 'mapcraft_get_maps'
        }).done(function (data) {
          var attr = {
            maps: []
          }

          $.each(data, function (id, settings) {
            attr.maps.push({
              value: '[mapcraft id="' + id + '"]',
              label: settings.general.name
            })
          })

          attr.shortcode = props.attributes.shortcode || attr.maps[0].value

          props.setAttributes(attr)
        })
      }

      return el(
        SelectControl,
        {
          label: 'Select a MapCraft Map',
          value: props.attributes.shortcode,
          options: props.attributes.maps,
          onChange: function (v) {
            props.setAttributes({ shortcode: v })
          }
        }
      )
    },
    save: function (props) {
      return el('', {}, props.attributes.shortcode)
    }
  })
}(
  jQuery,
  window.wp
))
