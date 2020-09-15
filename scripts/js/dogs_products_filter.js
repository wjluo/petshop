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

    $.post("filter.php", {
            filter: "price",
            order: "desc"
        })
        .done(function (data) {
            window.history.replaceState(null, null, "?price=" + price);
            $('#products-div').html(data);
        })
        .fail(function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        });
});