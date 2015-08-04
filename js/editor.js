window.ePagesShop = window.ePagesShop || {};


(function(window, document, undefined) {
  var eps = window.ePagesShop,
      $ = window.jQuery;

  eps.shortcode = {
    tag: "epages"
  };

  eps.selectors = {
    editorPopup:      "#epages-popup-content",
    editorSaveButton: "#epages-save-button",
    placeholder:      ".epages-shop-placeholder",
    textEditor:       "#content"
  };

  eps.keycodes = {
    escape: 27
  };

  // Returns whether Wordpess‘ visual editor is displayed.
  eps.visualEditorVisible = function() {
    return tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden();
  };

  // Returns the content of Wordpress’ visual editor.
  eps.visualEditorContent = function() {
    return tinyMCE.activeEditor.getBody();
  };

  // Returns the content of Wordpress‘ text editor.
  eps.textEditorContent = function(value) {
    if (value === undefined) {
      return $(eps.selectors.textEditor).val();
    }

    $(eps.selectors.textEditor).val(value);
  };

  // Tries to find the Wordpress shortcode for the ePages shop in the
  // given `text`. Returns the shortcode object or `false` in case the
  // shortcode could not be found.
  eps.findShortcode = function(text) {
    var found = false,
        index = 0;

    while (found = wp.shortcode.next("epages", text, index)) {
      if (found) {
        break;
      }
      index = found.index + 1;
    }

    if (typeof found === "undefined") {
      found = false;
    }

    return found;
  };

  // Returns whether Wordpress‘ visual or text editor contains the
  // ePages shop widget.
  eps.editorContainsWidget = function() {
    if (eps.visualEditorVisible()) {
      return $(eps.visualEditorContent()).find(eps.selectors.placeholder).length > 0;
    }

    return eps.findShortcode(eps.textEditorContent());
  };

  eps.openEditorPopup = function() {
    eps.editorPopup.addClass("open");
  };

  eps.closeEditorPopup = function() {
    eps.editorPopup.removeClass("open");
  };

  eps.editorPopupIsOpen = function() {
    return eps.editorPopup.hasClass("open");
  };

  // Enhances the shop placeholder image with buttons to edit
  // and remove the shop placeholder.
  eps.enhancePlaceholder = function() {
    if (eps.visualEditorVisible()) {
      eps.updateEditButton();
      eps.updateRemoveButton();
    }
  };

  // Updates the shop placeholder‘s edit button.
  eps.updateEditButton = function() {
    eps.updateButton({
      id: "epages-shop-edit-button",
      value: "Edit shop",
      callback: eps.openEditorPopup,
      position: {
        top: function(placeholder) {
          return placeholder.offset().top + 110;
        },
        left: function(placeholder, button) {
          return placeholder.offset().left + placeholder.outerWidth() / 2 - button.outerWidth() / 2 - 2;
        }
      }
    });
  };

  // Updates the shop placeholder‘s remove button.
  eps.updateRemoveButton = function() {
    eps.updateButton({
      id: "epages-shop-remove-button",
      value: "&times;",
      callback: eps.removePlaceholder,
      position: {
        top: function(placeholder) {
          return placeholder.offset().top + 10;
        },
        left: function(placeholder) {
          return placeholder.offset().left + 10;
        }
      }
    });
  };

  // Adds, removes or updates the position of a button for the
  // shop placeholder image.
  eps.updateButton = function(options) {
    var body = tinymce.activeEditor.dom.doc.body,
        button = tinymce.activeEditor.dom.select("#" + options.id),
        editorContainsWidget = eps.editorContainsWidget();

    if (editorContainsWidget && button.length == 0) {
      var button = $('<input type="button" id="' + options.id + '" value="' + options.value + '" \
                            contenteditable="false" data-mce-bogus="true">')
          .appendTo(body);

      button.click(options.callback);
    } else if (!editorContainsWidget && button.length > 0) {
      tinymce.activeEditor.dom.remove(button);
    }

    if (editorContainsWidget) {
      var placeholder = $(body).find(eps.selectors.placeholder),
          button = $("#" + options.id, body);

      button.css({
        "position": "absolute",
        "top":      "" + options.position.top(placeholder, button) + "px",
        "left":     "" + options.position.left(placeholder, button) + "px"
      });
    }
  };

  // Removes the shop placeholder from Wordpress‘ visual editor.
  eps.removePlaceholder = function() {
    var placeholder = tinymce.activeEditor.dom.select(eps.selectors.placeholder);
    tinymce.activeEditor.dom.remove(placeholder);
  };


  // DOM ready
  $(function() {
    eps.editorPopup = $(eps.selectors.editorPopup);

    $("#epages-shop-button").click(function(event) {
      event.preventDefault();
      eps.openEditorPopup();
    });

    $(".media-modal-close", eps.editorPopup).click(function(event) {
      event.preventDefault();
      eps.closeEditorPopup();
      return false;
    });

    // Closes the editor popup on `escape`.
    $(document).keydown(function(event) {
      if (event.keyCode === eps.keycodes.escape && eps.editorPopupIsOpen()) {
        eps.closeEditorPopup()
        return false;
      }
    });

    // Toggles the editor popup menu highlighting and content depending
    // on the currently selected menu element.
    $(".media-menu-item", eps.editorPopup).click(function() {
      $(".media-menu .media-menu-item", eps.editorPopup).removeClass("active");
      $(this).addClass("active");

      $(".media-modal-content", eps.editorPopup).attr("data-active-dialog", $(this).attr("data-content"));
      $(".media-menu").removeClass("visible");
      return false;
    });

    // Inserts or updates an existing shortcode when the editor popup‘s
    // save button is clicked.
    $(eps.selectors.editorSaveButton).click(function(event) {
      event.preventDefault();

      tinyMCE.triggerSave(); // Refresh the tinyMCE textarea

      var existingShortcode = eps.findShortcode(eps.textEditorContent());
      var shortcode = {};

      if (!existingShortcode) {
        shortcode.shortcode = new wp.shortcode();
        shortcode.shortcode.tag = eps.shortcode.tag;
        shortcode.shortcode.type = "single";
      } else {
        shortcode = existingShortcode;
      }

      if (existingShortcode) {
        eps.textEditorContent(
          eps.textEditorContent().replace(existingShortcode.content, shortcode.shortcode.string())
        );
        if (tinyMCE.activeEditor) {
          $(eps.visualEditorContent())
            .find(eps.selectors.placeholder)
            .attr("data-epages-shortcode", shortcode.shortcode.string());
        }
      } else {
        if (eps.visualEditorVisible()) {
          tinyMCE.activeEditor.execCommand("mceInsertContent", false, shortcode.shortcode.string());
          tinyMCE.activeEditor.execCommand("mceSetContent", false, eps.visualEditorContent().innerHTML);
          tinyMCE.triggerSave(); // Refresh the tinyMCE textarea
        } else {
          var cursorAt = $(eps.selectors.textEditor).get(0).selectionStart;

          eps.textEditorContent(
            eps.textEditorContent().substr(0, cursorAt) +
              shortcode.shortcode.string() +
              eps.textEditorContent().substr(cursorAt)
          );
        }
      }

      eps.closeEditorPopup();
    });

    var current = "product-settings";
    $(".media-modal-content", eps.editorPopup).attr("data-mode", current);
    $(".media-modal-content", eps.editorPopup).attr("data-active-dialog", current);
    $(".media-menu-item")
        .removeClass("active")
        .filter("[data-content=" + current + "]").addClass("active");

    // Loop to enhance the shop placeholder image.
    setInterval(eps.enhancePlaceholder, 200);
  });

}(window, document));

