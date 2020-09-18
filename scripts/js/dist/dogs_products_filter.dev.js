"use strict";

var urlParams = new URLSearchParams(window.location.search);
$('.category').click(function () {
  var category = convertCategoryGreekToEnglish(this.id);
  if (urlParams.has('price_order')) var price_order = urlParams.get('price_order');
  $.post('filter.php', {
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
}); // $('.order-products').click(function () {
//     var params = [];
//     var price_order = this.id;
//     params.push(price_order);
//     if (urlParams.has('category')) {
//         var category = urlParams.get('category');
//         params.push(category);
//     }
//     alert(params);
//     $.post('filter.php', {
//             action: "price_order",
//             price_order: price_order,
//             category: category
//         })
//         .done(function (data) {
//             urlParams.set('price_order', price_order);
//             window.history.replaceState({}, '', `${location.pathname}?${urlParams}`);
//             $('#products-div').html(data);
//         })
//         .fail(function (xhr, status, error) {
//             var errorMessage = xhr.status + ': ' + xhr.statusText
//             alert('Error - ' + errorMessage);
//         });
// });

function convertCategoryGreekToEnglish(cat) {
  var category_eng = "";

  switch (cat) {
    case "Τροφή":
      category_eng = "trofi";
      break;

    case "Λιχουδιές":
      category_eng = "lichoudies";
      break;

    case "Κολάρα":
      category_eng = "kolara";
      break;

    case "Ρούχα":
      category_eng = "roucha";
      break;

    case "Παιχνίδια":
      category_eng = "paichnidia";
      break;
  }

  return category_eng;
}