var cart = JSON.parse(localStorage.getItem('epages-shop-cart-products'));
var shopId = localStorage.getItem("epages-shop-cart-checkoutUrl").split("Shops/")[1].split("/")[0];
var shopUrl = document.querySelector('div .epages-shop-cart.fake').id;
var language = localStorage.getItem("epages-shop-lang") || 'en';
var spinner = document.querySelector('.epages-categories-spinner');

// Translations
es = i18n.create({
  values:{
    "basket": "Cesta",
    "basket-add": "Añadir a la cesta",
    "basket-empty": "Su cesta está vacía.",
    "basket-fail": "¡Vaya! Este proceso ha tardado más de lo esperado. Vuelva a intentarlo ahora.",
    "category": "Categoría",
    "checkout": "Realizar pago",
    "description": "Descripción",
    "manufacturer-price": "Precio anterior",
    "additional-product-information": "Información adicional del producto",
    "exclude-vat": "más IVA y ",
    "exclude-vat-price": "no incluye IVA y ",
    "exclude-vat-prices": "no incluye IVA y ",
    "include-vat-cart": "IVA incluido",
    "include-vat": "Incluye el IVA y ",
    "include-vat-price": "Incluye el IVA y ",
    "include-vat-prices": "Incluye el IVA y ",
    "loading": "Cargando...",
    "sortby": "Ordenar por",
    "name": "Nombre",
    "no-products": "Su búsqueda no ha obtenido ningún resultado.",
    "price-asc": "Precio (de menor a mayor)",
    "price-desc": "Precio (de mayor a menor)",
    "quantity": "Cantidad",
    "search": "Buscar",
    "shipping": "envío",
    "shipping-price": "Precio de envío",
    "ssl": "Sus datos se transferirán a través de una conexión cifrada (SSL) y no se revelarán a terceros.",
    "subtotal": "Subtotal",
    "total-price": "Precio total",
    "unit-price": "Precio",
    "remove-line-item": "Eliminar producto",
    "pieces": "unidad(es)",
    "all-products": "Todos los productos",
    "product-amount-updated": "El producto seleccionado no está disponible en la cantidad solicitada. La cantidad se ha modificado."
  }
})

en = i18n.create({
  values:{
    "basket": "Basket",
    "basket-add": "Add to basket",
    "basket-empty": "Your basket is empty.",
    "basket-fail": "Oops. This took longer than it should. Please try again now.",
    "category": "Category",
    "checkout": "Checkout",
    "description": "Description",
    "manufacturer-price": "Old price",
    "additional-product-information": "Additional product information",
    "exclude-vat": "plus VAT, plus ",
    "exclude-vat-price": "excl. VAT, plus ",
    "exclude-vat-prices": "excl. VAT, plus ",
    "include-vat-cart": "incl. VAT",
    "include-vat": "incl. VAT, plus ",
    "include-vat-price": "incl. VAT, plus ",
    "include-vat-prices": "incl. VAT, plus ",
    "loading": "Loading ...",
    "sortby": "Sort by",
    "name": "Name",
    "no-products": "Your search did not produce any matches.",
    "price-asc": "Price (low to high)",
    "price-desc": "Price (high to low)",
    "quantity": "Quantity",
    "search": "Search",
    "shipping": "delivery",
    "shipping-price": "Delivery price",
    "ssl": "Your data will be transmitted through an encrypted connection (SSL) and will not be disclosed to third parties.",
    "subtotal": "Subtotal",
    "total-price": "Total price",
    "unit-price": "Price",
    "remove-line-item": "Delete product",
    "pieces": "piece(s)",
    "all-products": "All products",
    "product-amount-updated": "The selected product is not available in the amount requested. The amount has been changed."
  }
})

de = i18n.create({
  values:{
    "basket": "Warenkorb",
    "basket-add": "In den Warenkorb",
    "basket-empty": "Ihr Warenkorb ist leer.",
    "basket-fail": "Das hat länger gedauert, als es sollte. Bitte versuchen Sie es erneut.",
    "category": "Kategorie",
    "checkout": "Zur Kasse",
    "description": "Beschreibung",
    "manufacturer-price": "Alter Preis",
    "additional-product-information": "Weitere Produktinformationen",
    "exclude-vat": "zzgl. MwSt., zzgl. ",
    "exclude-vat-price": "zzgl. MwSt., zzgl. ",
    "exclude-vat-prices": "zzgl. MwSt., zzgl. ",
    "include-vat-cart": "inkl. MwSt.",
    "include-vat": "inkl. MwSt. und ",
    "include-vat-price": "inkl. MwSt. und ",
    "include-vat-prices": "inkl. MwSt., plus ",
    "loading": "Seite lädt ...",
    "sortby": "Sortieren nach",
    "name": "Name",
    "no-products": "Ihre Suche ergab keine Treffer.",
    "price-asc": "Preis (aufsteigend)",
    "price-desc": "Preis (absteigend)",
    "quantity": "Anzahl",
    "search": "Suchen",
    "shipping": "Versand",
    "shipping-price": "Versandkosten",
    "ssl": "Ihre Daten werden über eine verschlüsselte Verbindung übertragen (SSL) und nicht an Dritte weitergegeben.",
    "subtotal": "Zwischensumme",
    "total-price": "Gesamtpreis",
    "unit-price": "Preis",
    "remove-line-item": "Produkt löschen",
    "pieces": "piece(s)",
    "all-products": "Alle Produkte",
    "product-amount-updated": "Das Produkt kann nicht in der ausgewählten Anzahl hinzugefügt werden. Die Anzahl wurde angepasst."
  }
})
// -------------

document.querySelector('.epages-shop-cart.fake span').innerHTML = getProductQuantity();

function getProductQuantity() {
  var quantity = 0;
  for (var i in cart) {
    quantity += cart[i].quantity;
  }
  return quantity;
}

function translateEverything() {
  var terms = ["basket", "basket-add", "basket-empty", "basket-fail", "category", "checkout", "description", "manufacturer-price", "additional-product-information", "exclude-vat", "exclude-vat-price", "exclude-vat-prices", "include-vat-cart", "include-vat", "include-vat-price", "include-vat-prices", "loading", "sortby", "name", "no-products", "price-asc", "price-desc", "quantity", "search", "shipping", "shipping-price", "ssl", "subtotal", "total-price", "unit-price", "remove-line-item", "all-products", "pieces", "product-amount-updated"];
  for (var t in terms) {
    var term = terms[t];
    var translate = jQuery("[data-i18n='" + term + "']");
    if (translate.length > 0) {
      for (var e in translate) {
        var elem = translate[e];
        var value = eval(language + '("' + term + '")');
        elem.innerText = value;
      }
    }
  }
}

function createCartElement(element, index, array) {
  var tbody = document.getElementsByTagName("tbody");
  var tr = document.createElement("tr");
  tr.className = "epages-cart-item";
  tr.id = "tr-" + element.productId;

  // Create TD
  var imageD = document.createElement("td");
  var nameD = document.createElement("td");
  var priceD = document.createElement("td");
  var quantityD = document.createElement("td");
  var totalD = document.createElement("td");
  var removeD = document.createElement("td");

  // Create TD elements
  imageD.className = "epages-cart-overlay-image";
  var image = document.createElement("img");
  image.src = element.images[3].url;

  nameD.className = "epages-cart-overlay-name";
  nameD.innerText = element.name;

  priceD.className = "epages-cart-overlay-image";
  priceD.innerText = element.priceInfo.price.formatted;

  quantityD.className = "epages-cart-overlay-quantity";
  var translatedPiece = eval(language + '("piece")');
  quantityD.innerText = translatedPiece;
  var quantity = document.createElement("input");
  quantity.value = element.quantity;
  quantity.className = "epages-cart-overlay-line-item-quantity";

  totalD.className = "epages-cart-overlay-total";
  total = parseFloat(element.lineItemPrice) * parseInt(element.quantity);
  totalD.innerText = total.toFixed(2).toString() + " " + element.lineItemPrice.substr(element.lineItemPrice.length - 1);

  removeD.className = "epages-cart-overlay-remove";
  var remove = document.createElement("button");
  remove.className = "epages-cart-overlay-line-item-remove";
  remove.style = "background: transparent;"
  var tooltip = document.createElement("span");
  tooltip.className = "tooltip";
  tooltip.setAttribute('data-i18n', 'remove-line-item');
  tooltip.innerHTML = 'Delete product'

  // Append to the DOM
  imageD.appendChild(image);
  tr.appendChild(imageD);
  tr.appendChild(nameD);
  tr.appendChild(priceD);
  quantityD.appendChild(quantity);
  tr.appendChild(quantityD);
  tr.appendChild(totalD);
  removeD.appendChild(remove);
  removeD.appendChild(tooltip);
  tr.appendChild(removeD);

  tbody[0].appendChild(tr);
}

function createModal() {
  cart.forEach(createCartElement);

  var subtotal = document.getElementsByClassName("epages-cart-overlay-sub-price");
  subtotal[0].innerText = localStorage.getItem("epages-shop-cart-subTotal").replace(/"/g, "");

  var delivery = document.getElementsByClassName("epages-cart-overlay-delivery-price");
  delivery[0].innerText = localStorage.getItem("epages-shop-cart-delivery").replace(/"/g, "");

  var total = document.getElementsByClassName("epages-cart-overlay-total-price");
  total[0].innerText = localStorage.getItem("epages-shop-cart-total").replace(/"/g, "");

  var link = document.getElementsByClassName("epages-cart-overlay-checkout-button");
}

function checkout() {
  var checkoutWindow, left, top;
  left = screen.width / 2 - 300;
  top = screen.height / 2 - 350;
  checkoutWindow = window.open("https://site-production.herokuapp.com/checkout.html", "newwindow", "width=600,height=620,scrollbars=yes,top=" + top + ",left=" + left);
  return checkoutWindow.location = localStorage.getItem("epages-shop-cart-checkoutUrl").replace(/"/g, "");
}

function deleteFromCart(productId) {
  for (var i = 0; i < cart.length; i++) {
    if (productId == cart[i].productId) {
      cart.splice(i, 1);
    }
  }
  localStorage.setItem('epages-shop-cart-products', JSON.stringify(cart));
}

function buildCart() {
  var newCart = { "lineItems": [] };
  for (var i = 0; i < cart.length; i++) {
    var product = { "productId": cart[i].productId, "quantity": cart[i].quantity }
    newCart.lineItems.push(product);
  }
  localStorage.setItem("epages-shop-updates", JSON.stringify(newCart));
}

function updateLocalStorage(productId, quantity) {
  var localSCart = JSON.parse(localStorage.getItem("epages-shop-updates"));
  for (var i = 0; i < localSCart.lineItems.length; i++) {
    if (localSCart.lineItems[i].productId == productId) {
      if (parseInt(quantity) == 0) {
        localSCart.lineItems.splice(i, 1);
        deleteFromCart(productId);
      } else {
        localSCart.lineItems[i].quantity = quantity;
      }
    }
  }
  localStorage.setItem("epages-shop-update", "true");
  localStorage.setItem("epages-shop-updates", JSON.stringify(localSCart));
}

function updateLocalStorageCart(element, index, array) {
  var cartA = JSON.parse(localStorage.getItem('epages-shop-cart-products'));
  for (var i = 0; i < cart.length; i++) {
    if (element.productId == cart[i].productId) {
      cart[i].quantity = element.quantity.amount;
      cart[i].lineItemPrice = element.lineItemPrice.formatted;
      var product = document.querySelectorAll("tr#tr-" + cart[i].productId + "> td.epages-cart-overlay-total")[0];
      product.innerText = element.lineItemPrice.formatted;
    }
  }
  localStorage.setItem('epages-shop-cart-products', JSON.stringify(cart));
}

function updateCart(productId = 0, quantity = 0) {
  var xhr = new XMLHttpRequest();

  xhr.open("POST", shopUrl + "/carts");
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onload = function() {
    if (xhr.status === 201) {
      var jsonResponse = JSON.parse(xhr.responseText);

      if (productId != 0) {
        var jsonQuantity = 0;
        jsonResponse.lineItemContainer.productLineItems.forEach(function(element) {
          if (element.productId == productId) {
            jsonQuantity = element.quantity.amount;
            return false;
          }
        });

        if (jsonQuantity != 0) {
          var theProduct = document.querySelectorAll("tr#tr-" + productId + "> td.epages-cart-overlay-quantity > input")[0];
          theProduct.value = jsonQuantity;
          spinner.style.visibility = 'hidden';

          updateLocalStorage(productId, jsonQuantity);
        }

        if (document.getElementsByClassName('shop-quantity-change').length > 0) {
          document.getElementsByClassName('shop-quantity-change')[0].remove();
        }

        if (jsonQuantity != quantity) {
          var box = document.createElement('div');
          box.className = 'shop-quantity-change';
          var info = document.createElement('span')
          info.appendChild(document.createTextNode('ⓘ'));
          var text = document.createElement('div');
          text.dataset.i18n = 'product-amount-updated';
          box.appendChild(info);
          box.appendChild(text);
          var child = document.getElementsByClassName('epages-cart-overlay-not-empty')[0];
          document.getElementsByClassName('epages-cart-overlay')[0].insertBefore(box, child);
          translateEverything();
        }
      }
      localStorage.setItem("epages-shop-cart-checkoutUrl", jsonResponse.checkoutUrl);

      var subtotal = document.getElementsByClassName("epages-cart-overlay-sub-price");
      subtotal[0].innerText = jsonResponse.lineItemContainer.lineItemsSubTotal.formatted;

      var delivery = document.getElementsByClassName("epages-cart-overlay-delivery-price");
      delivery[0].innerText = jsonResponse.lineItemContainer.shippingPrice.formatted;

      var total = document.getElementsByClassName("epages-cart-overlay-total-price");
      total[0].innerText = jsonResponse.lineItemContainer.grandTotal.formatted;

      items = jsonResponse.lineItemContainer.productLineItems;
      items.forEach(updateLocalStorageCart);
      document.querySelector('.epages-shop-cart.fake span').innerHTML = getProductQuantity();
    }
    else if (xhr.status !== 201) {
        return 0;
    }
  };
  xhr.send(localStorage.getItem("epages-shop-updates"));
  var empty = document.getElementsByClassName("epages-cart-overlay-is-empty")[0];
  var not_empty = document.getElementsByClassName("epages-cart-overlay-not-empty")[0];
  if (localStorage.getItem("epages-shop-cart-products") === "[]") {
    empty.style.display = "block";
    not_empty.style.display = "none";
  } else {
    empty.style.display = "none";
    not_empty.style.display = "block";
  }
}

function realCart() {
  if (document.getElementsByClassName("epages-shop-widget").length > 0) {
    return true;
  } else {
    return false;
  }
}

function newUpdates() {
  if (localStorage.getItem("epages-shop-update" != null)) {
    return true;
  } else {
    return false;
  }
}

buildCart();

if (realCart()) {
  var widget = document.querySelectorAll("div.epages-shop-cart.fake")[0];
  widget.parentElement.removeChild(widget);
} else {
  createModal();
  updateCart();
  var span = document.getElementsByClassName("close")[0];
  span.onclick = function() {
    modal.style.display = "none";
    document.getElementsByTagName("html")[0].style.overflow = "auto";
    document.getElementsByClassName('shop-quantity-change')[0].remove()
  }
  var buttons = document.querySelectorAll(".epages-cart-overlay-line-item-remove");
  for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", function(event) {
      var row = event.target.parentElement.parentElement;
      var productId = row.id.split("tr-")[1];
      updateLocalStorage(productId, 0);
      row.parentElement.removeChild(row);
      updateCart();
    });
  }
}

var modal = document.getElementById("cartModal");
var btn = document.getElementById("cartShow");
var inputs = document.querySelectorAll(".epages-cart-overlay-line-item-quantity");

for (var i = 0; i < inputs.length; i++) {
  inputs[i].addEventListener("change", function(event) {
    spinner.style.visibility = 'visible';
    var productId = event.target.parentElement.parentElement.id.split("tr-")[1];
    var quantity = event.target.value;
    var json_products = JSON.parse(localStorage.getItem('epages-shop-cart-products'));
    updateLocalStorage(productId, quantity);
    updateCart(productId, quantity);
  });
}

if (btn) {
  btn.onclick = function() {
      modal.style.display = "block";
      modal.style.overflow = "hidden";
      document.getElementsByTagName("html")[0].style.overflow = "hidden";
      var empty = document.getElementsByClassName("epages-cart-overlay-is-empty")[0];
      var not_empty = document.getElementsByClassName("epages-cart-overlay-not-empty")[0];
      if (localStorage.getItem("epages-shop-cart-products") === "[]") {
        empty.style.display = "block";
        not_empty.style.display = "none";
      } else {
        translateEverything();
        empty.style.display = "none";
        not_empty.style.display = "block";
      }
  }
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        document.body.style.overflow = 'hidden';
        document.getElementsByTagName("html")[0].style.overflow = "auto";
    }
}
