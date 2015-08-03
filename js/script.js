jQuery(function() {
  $epagesEditorPopup = jQuery("#epages-popup-content");

  jQuery("#epages-shop-button").click(epages_open_popup);

  jQuery(".media-modal-close", $epagesEditorPopup).click(function() {
    $epagesEditorPopup.removeClass("open");
    return false;
  });

  jQuery(document).keydown(function(e) {
    if (e.keyCode == 27 && $epagesEditorPopup.hasClass("open")) {
      $epagesEditorPopup.removeClass("open");
      return false;
    }
  });

  jQuery(".media-menu-item", $epagesEditorPopup).click(function() {
    jQuery(".media-menu .media-menu-item", $epagesEditorPopup).removeClass("active");
    jQuery(this).addClass("active");

    jQuery(".media-modal-content", $epagesEditorPopup).attr("data-active-dialog", jQuery(this).attr("data-content"));
    jQuery(".media-menu").removeClass("visible");
    return false;
  });

  jQuery(".button-primary", $epagesEditorPopup).click(function() {
    var existingShortcode = epages_find_shortcode(jQuery("#content").val());
    var shortcode = {};

    if (!existingShortcode) {
      shortcode.shortcode = new wp.shortcode();
      shortcode.shortcode.tag = "epages";
      shortcode.shortcode.type = "single";
    } else {
      shortcode = existingShortcode;
    }

    if (existingShortcode) {
      jQuery("#content").val(
        jQuery("#content").val().replace(existingShortcode.content, shortcode.shortcode.string())
      );
      if (tinyMCE.activeEditor) {
        jQuery(tinymce.activeEditor.getBody()).find(".epages-shop-placeholder").attr("data-epages-shortcode", shortcode.shortcode.string());
      }
    } else {
      if (tinymce.activeEditor && !tinymce.activeEditor.isHidden()) {
        tinymce.activeEditor.execCommand("mceInsertContent", false, shortcode.shortcode.string());
        tinymce.activeEditor.execCommand("mceSetContent", false, tinymce.activeEditor.getBody().innerHTML);
      } else {
        var $content = jQuery("#content");
        var cursorAt = $content.get(0).selectionStart;

        $content.val($content.val().substr(0, cursorAt) + shortcode.shortcode.string() + $content.val().substr(cursorAt));
      }
    }

    jQuery("#epages-popup-content").removeClass("open");
  });

  var current = "product-settings";
  jQuery(".media-modal-content", $epagesEditorPopup).attr("data-mode", current);
  jQuery(".media-modal-content", $epagesEditorPopup).attr("data-active-dialog", current);
  jQuery(".media-menu-item")
      .removeClass("active")
      .filter("[data-content=" + current + "]").addClass("active");
});

function epages_has_widget() {
  if (tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()) {
    content = tinyMCE.activeEditor.getBody();
    return jQuery(content).find(".epages-shop-placeholder").length > 0;
  }

  return epages_find_shortcode(jQuery("#content").val());
}

function epages_open_popup() {
  $epagesEditorPopup.addClass("open");
}

function epages_find_shortcode(content) {
  var found = false;
  var index = 0;

  while (found = wp.shortcode.next("epages", content, index)) {
    if (found) {
      break;
    }
    index = found.index + 1;
  }

  if (typeof found == 'undefined') {
    found = false;
  }

  return found;
}
