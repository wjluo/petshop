$('.category').click(function () {

    var category = this.id;

    $.post("filter.php", {
            filter: "category",
            category: category
        })
        .done(function (data) {
            window.history.replaceState(null, null, "?category=" + category);
            $('#products-div').html(data);
        })
        .fail(function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        });
});

$('#order-desc').click(function () {

    var order = "desc";

    $.post("filter.php", {

            filter: "price",
            order: order
        })
        .done(function (data) {
            window.history.replaceState(null, null, "?category=&price_order=" + order);
            $('#products-div').html(data);
        })
        .fail(function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        });
});