window.ePagesShop = window.ePagesShop || {};


(function(window, document, undefined) {
  var eps = window.ePagesShop,
      $ = window.jQuery;

  // The tinyMCE editor plugin.
  tinyMCE.PluginManager.add("epages", function(editor) {
    editor.onBeforeSetContent.add(function(editor, event) {
      if (event.content) {
        found = eps.findShortcode(event.content);

        if (!found) return;

        var content = event.content;
        var store = '<img src="' + eps.baseUrl + '/images/shop_placeholder.svg" \
                       data-epages-shortcode="' + window.encodeURIComponent(found.content) + '" \
                       data-mce-placeholder="true" data-mce-resize="false" class="epages-shop-placeholder">';

        event.content = event.content.substr(0, found.index) +
                        store +
                        event.content.substr(found.index + found.content.length);
      }
    });

    editor.onPostProcess.add(function(editor, event) {
      if (event.get) {
        return event.content = event.content.replace(/(<img [^>]*data-epages-shortcode=[^>]+>)/g, function(match, tag) {
          var data = window.decodeURIComponent($(tag).attr("data-epages-shortcode"));

          if (data) {
            return data;
          }
          return match;
        });
      }
    });

    editor.onMouseUp.add(function(editor, event) {
      var node = event.target;

      if ($.inArray("epages-shop-remove-widget", node.classList) !== -1) {
        editor.dom.remove(node.parentElement);
      } else if ($.inArray("epages-shop-edit-button", node.classList) !== -1) {
        eps.openEditorPopup();
      }
    });

  });

}(window, document));

