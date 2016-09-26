var widget = document.querySelector('div[id$="_cart_widget-__i__"]');
if (widget) {
  var h3 = widget.getElementsByTagName('H3');

  function addIcon(element) {
    var cart = document.createElement("img");
    cart.style = "padding-top: 12px; padding-left: 12px; height:15px;";
    cart.src = "https://site-production.herokuapp.com/images/cart.png";
    element.parentNode.style = "display:flex;";
    element.parentNode.insertBefore(cart, element);
  }

  var allElements = document.getElementsByTagName('h3');
  for (i = 0; i < allElements.length; i++) {
    if (String(allElements[i].innerText) == String(h3[0].innerText)) {
      addIcon(allElements[i]);
    }
  };
}
