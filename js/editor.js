function epages_enhance_placeholder() {
  if (tinymce.activeEditor && !tinymce.activeEditor.isHidden()) {
    epages_update_edit_button();
    epages_update_remove_button();
  }
}

function epages_update_edit_button() {
  epages_update_button({
    id: "epages-shop-edit-button",
    value: "Edit shop",
    callback: epages_open_popup,
    position: {
      top: function(placeholder) {
        return placeholder.offset().top + 110;
      },
      left: function(placeholder, button) {
        return placeholder.offset().left + placeholder.outerWidth() / 2 - button.outerWidth() / 2 - 2;
      }
    }
  });
}

function epages_update_remove_button() {
  epages_update_button({
    id: "epages-shop-remove-button",
    value: "&times;",
    callback: epages_remove_placeholder,
    position: {
      top: function(placeholder) {
        return placeholder.offset().top + 10;
      },
      left: function(placeholder) {
        return placeholder.offset().left + 10;
      }
    }
  });
}

function epages_update_button(options) {
  var body = tinymce.activeEditor.dom.doc.body,
      button = tinymce.activeEditor.dom.select("#" + options.id),
      hasWidget = epages_has_widget();

  if (hasWidget && button.length == 0) {
    var button = jQuery('<input type="button" id="' + options.id + '" contenteditable="false" data-mce-bogus="true" value="' + options.value + '">')
        .appendTo(body);

    button.click(options.callback);
  } else if (!hasWidget && button.length > 0) {
    tinymce.activeEditor.dom.remove(button);
  }

  if (hasWidget) {
    var placeholder = jQuery(body).find(".epages-shop-placeholder"),
        button = jQuery("#" + options.id, body);

    button.css({
      "position": "absolute",
      "top": "" + options.position.top(placeholder, button) + "px",
      "left": "" + options.position.left(placeholder, button) + "px"
    });
  }
}

function epages_remove_placeholder() {
  var placeholder = tinymce.activeEditor.dom.select(".epages-shop-placeholder");
  tinymce.activeEditor.dom.remove(placeholder);
}

jQuery(function() {
  setInterval(epages_enhance_placeholder, 200);
});
