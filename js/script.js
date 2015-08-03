jQuery(function() {
  var $popup = jQuery("#epages-popup-content");

  jQuery("#insert-epages-button").click(epages_open_popup);

  jQuery(".media-modal-close", $popup).click(function() {
    $popup.removeClass("open");
    return false;
  });

  jQuery(document).keydown(function(e) {
    if (e.keyCode == 27 && $popup.hasClass("open")) {
      $popup.removeClass("open");
      return false;
    }
  });

  jQuery(".media-menu-item", $popup).click(function() {
    jQuery(".media-menu .media-menu-item", $popup).removeClass("active");
    jQuery(this).addClass("active");

    jQuery(".media-modal-content", $popup).attr("data-active-dialog", jQuery(this).attr("data-content"));
    jQuery(".media-menu").removeClass("visible");
    return false;
  });

  var current = "product-settings";
  jQuery(".media-modal-content", $popup).attr("data-mode", current);
  jQuery(".media-modal-content", $popup).attr("data-active-dialog", current);
  jQuery(".media-menu-item")
      .removeClass("active")
      .filter("[data-content=" + current + "]").addClass("active");
  
  function epages_open_popup() {
    $popup.addClass("open");
  }
});
