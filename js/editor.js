window.ePagesShop = window.ePagesShop || {};


(function(window, document, undefined) {
  var eps = window.ePagesShop,
      $ = window.jQuery;

  eps.baseUrl = window.ePagesPluginBaseUrl;
  eps.shopUrl = window.ePagesShopUrl;
  eps.httpHeaders = window.ePagesHttpHeaders;

  eps.shortcode = {
    tag:  "epages",
    type: "single"
  };

  eps.selectors = {
    textEditor:          "#content",
    editorPopup:         "#epages-popup-content",
    editorSaveButton:    "#epages-save-button",
    shopButton:          "#epages-shop-button",
    placeholder:         ".epages-shop-placeholder",
    categoriesContainer: ".epages-categories-container",
    categoriesCheckbox:  ".categories-checkbox",
    categoriesSpinner:   ".categories-spinner",
    menu:                ".media-menu",
    menuItem:            ".media-menu-item",
    modalContent:        ".media-modal-content",
    closeButton:         ".media-modal-close"
  };

  eps.keycodes = {
    escape: 27
  };

  // Loads the shop‘s categories and returns a Promise.
  eps.loadCategories = function() {
    return $.ajax({
      url: eps.shopUrl + "/categories",
      headers: eps.httpHeaders
    });
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

    while (found = wp.shortcode.next(eps.shortcode.tag, text, index)) {
      if (found) { break; }
      index = found.index + 1;
    }

    if (found === undefined) {
      found = false;
    }

    return found;
  };

  // Returns whether Wordpress‘ visual or text editor
  // contains the ePages shop widget.
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

  // Adds, removes or updates the position of a button
  // for the shop placeholder image.
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

    // Opens the editor popup.
    $(eps.selectors.shopButton).click(function(event) {
      event.preventDefault();
      eps.openEditorPopup();
    });

    // Closes the editor popup.
    $(eps.selectors.closeButton, eps.editorPopup).click(function(event) {
      event.preventDefault();
      eps.closeEditorPopup();
    });

    // Loads the shop‘s categories when clicking
    // on the categories checkbox.
    $(eps.selectors.categoriesCheckbox, eps.editorPopup).click(function(event) {
      $(eps.selectors.categoriesSpinner).css("visibility", "visible");

      eps.loadCategories()
        .done(function(categories) {
          // We expect the first category to contain the
          // actual shop categories to display.
          subCategories = categories[0].subCategories;

          html = subCategories.map(function(subCategory) {
            var hrefSplit = subCategory.href.split("/"),
                categoryId = hrefSplit[hrefSplit.length - 1];

            return $('<li><input type="checkbox" value="' + categoryId + '">' + subCategory.title + '</li>');
          });

          $(eps.selectors.categoriesContainer).html(html);
        }).always(function() {
          $(eps.selectors.categoriesSpinner).css("visibility", "hidden");
        });
    });

    // Closes the editor popup on `escape`.
    $(document).keydown(function(event) {
      if (event.keyCode === eps.keycodes.escape && eps.editorPopupIsOpen()) {
        event.preventDefault();
        eps.closeEditorPopup()
      }
    });

    // Toggles the editor popup menu highlighting and content
    // depending on the currently selected menu element.
    $(eps.selectors.menuItem, eps.editorPopup).click(function(event) {
      event.preventDefault();

      $(eps.selectors.menuItem, eps.editorPopup).removeClass("active");
      $(this).addClass("active");

      $(eps.selectors.modalContent, eps.editorPopup).attr("data-active-dialog", $(this).attr("data-content"));
      $(eps.selectors.menu).removeClass("visible");
    });

    // Inserts or updates an existing shortcode when the editor
    // popup‘s save button is clicked.
    $(eps.selectors.editorSaveButton).click(function(event) {
      event.preventDefault();

      tinyMCE.triggerSave(); // Refresh the tinyMCE textarea

      var existingShortcode = eps.findShortcode(eps.textEditorContent());
      var shortcode = {};

      if (!existingShortcode) {
        shortcode.shortcode = new wp.shortcode();
        shortcode.shortcode.tag = eps.shortcode.tag;
        shortcode.shortcode.type = eps.shortcode.type;
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

    // Activates the current menu item.
    var current = "product-settings";
    $(eps.selectors.modalContent, eps.editorPopup)
      .attr("data-mode", current)
      .attr("data-active-dialog", current);
    $(eps.selectors.menuItem, eps.editorPopup)
        .removeClass("active")
        .filter("[data-content=" + current + "]").addClass("active");

    // Loop to enhance the shop placeholder image.
    setInterval(eps.enhancePlaceholder, 500);
  });

}(window, document));

