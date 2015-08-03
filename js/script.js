jQuery(function() {
  $epagesEditorPopup = jQuery("#epages-popup-content");

  jQuery("#insert-epages-button").click(epages_open_popup);

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
    var shortcode = {};
    shortcode.shortcode = new wp.shortcode();
    shortcode.shortcode.tag = "epages";
    shortcode.shortcode.type = "single";

    if (tinymce.activeEditor && !tinymce.activeEditor.isHidden()) {
      tinymce.activeEditor.execCommand("mceInsertContent", false, shortcode.shortcode.string());
      tinymce.activeEditor.execCommand("mceSetContent", false, tinymce.activeEditor.getBody().innerHTML);
    } else {
      var $content = jQuery("#content");
      var cursorAt = $content.get(0).selectionStart;

      $content.val($content.val().substr(0, cursorAt) + shortcode.shortcode.string() + $content.val().substr(cursorAt));
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

function epages_open_popup() {
  $epagesEditorPopup.addClass("open");
}
