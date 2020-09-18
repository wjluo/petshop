"use strict";

var urlParams = new URLSearchParams(window.location.search);
$('.category').click(function () {
  var category = this.id;
  if (urlParams.has('price_order')) var price_order = urlParams.get('price_order');
  $.post("filter.php", {
    action: "category",
    category: category,
    price_order: price_order
  }).done(function (data) {
    urlParams.set('category', category);
    window.history.replaceState({}, '', "".concat(location.pathname, "?").concat(urlParams));
    $('#products-div').html(data);
  }).fail(function (xhr, status, error) {
    var errorMessage = xhr.status + ': ' + xhr.statusText;
    alert('Error - ' + errorMessage);
  });
});
$('.order-products').click(function () {
  var price_order = this.id;
  if (urlParams.has('category')) var category = urlParams.get('category');
  $.post('filter.php', {
    action: "price_order",
    price_order: price_order,
    category: category
  }).done(function (data) {
    urlParams.set('price_order', price_order);
    window.history.replaceState({}, '', "".concat(location.pathname, "?").concat(urlParams));
    $('#products-div').html(data);
  }).fail(function (xhr, status, error) {
    var errorMessage = xhr.status + ': ' + xhr.statusText;
    alert('Error - ' + errorMessage);
  });
});