tinymce.PluginManager.add("epages", function(editor) {
  editor.onBeforeSetContent.add( function(editor, e) {
    if (e.content) {

      found = epages_find_shortcode(e.content);

      if (!found) return;

      var content = e.content;
      var store = '<img src="' + epages_base_url + '/images/shop_placeholder.svg" data-epages-shortcode="' + window.encodeURIComponent(found.content) + '" data-mce-placeholder="true" data-mce-resize="false" class="epages-shop-placeholder">';

      e.content = e.content.substr(0, found.index) + store + e.content.substr(found.index + found.content.length);
    }
  });

  editor.onPostProcess.add(function(editor, e) {
    if (e.get) {
      return e.content = e.content.replace(/(<img [^>]*data-epages-shortcode=[^>]+>)/g, function(match, tag) {
        var data = window.decodeURIComponent(jQuery(tag).attr("data-epages-shortcode"));

        if (data) {
          return data;
        }

        return match;
      });
    }
  });

  editor.onMouseUp.add(function(editor, event) {
    var node = event.target;

    if (jQuery.inArray("epages-shop-remove-widget", node.classList) !== -1) {
      editor.dom.remove(node.parentElement);
    } else if (jQuery.inArray("epages-shop-edit-button", node.classList) !== -1) {
      epages_open_popup();
    }
  });

});  
