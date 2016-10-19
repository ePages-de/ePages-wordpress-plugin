var cart = JSON.parse(localStorage.getItem('epages-shop-cart-products'));
var shopId = localStorage.getItem("epages-shop-cart-checkoutUrl").split("Shops/")[1].split("/")[0];
var shopUrl = document.querySelector('div .epages-shop-cart.fake').id;

document.querySelector('.epages-shop-cart.fake span').innerHTML = cart.length;

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
  priceD.innerText = element.lineItemPrice;

  quantityD.className = "epages-cart-overlay-quantity";
  quantityD.innerText = "piece(s)"
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

  // Append to the DOM
  imageD.appendChild(image);
  tr.appendChild(imageD);
  tr.appendChild(nameD);
  tr.appendChild(priceD);
  quantityD.appendChild(quantity);
  tr.appendChild(quantityD);
  tr.appendChild(totalD);
  removeD.appendChild(remove);
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

function updateCart() {
  var xhr = new XMLHttpRequest();

  xhr.open("POST", shopUrl + "/carts");
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onload = function() {
    if (xhr.status === 201) {
      var jsonResponse = JSON.parse(xhr.responseText);
      localStorage.setItem("epages-shop-cart-checkoutUrl", jsonResponse.checkoutUrl);

      var subtotal = document.getElementsByClassName("epages-cart-overlay-sub-price");
      subtotal[0].innerText = jsonResponse.lineItemContainer.lineItemsSubTotal.formatted;

      var delivery = document.getElementsByClassName("epages-cart-overlay-delivery-price");
      delivery[0].innerText = jsonResponse.lineItemContainer.shippingPrice.formatted;

      var total = document.getElementsByClassName("epages-cart-overlay-total-price");
      total[0].innerText = jsonResponse.lineItemContainer.grandTotal.formatted;

      items = jsonResponse.lineItemContainer.productLineItems;
      items.forEach(updateLocalStorageCart);
      document.querySelector('.epages-shop-cart.fake span').innerHTML = cart.length;
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
    productId = event.target.parentElement.parentElement.id.split("tr-")[1];
    quantity = event.target.value;
    updateLocalStorage(productId, quantity);
    updateCart();
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
