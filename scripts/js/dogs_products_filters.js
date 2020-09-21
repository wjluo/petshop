var urlParams = new URLSearchParams(window.location.search);

$("#products-div").load("pagination.php?page=1");

$(".page-link").click(function () {

    var page = $(this).attr("data-id");
    var select_page = $(this).parent().attr("id");

    if (urlParams.has('category')) urlParams.delete('category');

    var price_order;

    if (urlParams.has('price_order'))
        price_order = urlParams.get('price_order');
    else {
        price_order = "asc";
    }

    $.get('pagination.php', {
            page: page,
            price_order: price_order,
        })
        .done(function (data) {

            $("#products-div").html(data);
            $(".pageitem").removeClass("active");
            $("#" + select_page).addClass("active");
            window.history.replaceState({}, '', `${location.pathname}?${urlParams}`);

        })
        .fail(function (xhr, status, error) {

            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);

        });
});

$('.category').click(function () {

    var category = convertCategoryGreekToEnglish(this.id);

    if (urlParams.has('price_order'))
        var price_order = urlParams.get('price_order');

    $.post('filter.php', {
            action: "category",
            category: category,
            price_order: price_order
        })
        .done(function (data) {

            urlParams.set('category', category);
            window.history.replaceState({}, '', `${location.pathname}?${urlParams}`);
            $('#products-div').html(data);
        })
        .fail(function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        });
});

$('.order-products').click(function () {

    var price_order = this.id;

    var category;

    if (urlParams.has('category')) {
        category = urlParams.get('category');
    }

    $.post('filter.php', {
            action: "price_order",
            price_order: price_order,
            category: category
        })
        .done(function (data) {

            urlParams.set('price_order', price_order);
            if (!isEmpty(category)) urlParams.set('category', category);

            window.history.replaceState({}, '', `${location.pathname}?${urlParams}`);

            $('#products-div').html(data);
        })
        .fail(function (xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        });
});

function convertCategoryGreekToEnglish(cat) {

    var category_eng = "";

    switch (cat) {

        case "ΤΡΟΦΗ":
            category_eng = "trofi"
            break;

        case "ΛΙΧΟΥΔΙΕΣ":
            category_eng = "lichoudies"
            break;

        case "ΚΟΛΑΡΑ":
            category_eng = "kolara"
            break;

        case "ΡΟΥΧΑ":
            category_eng = "roucha"
            break;

        case "ΠΑΙΧΝΙΔΙΑ":
            category_eng = "paichnidia"
            break;
    }

    return category_eng;
}

function isEmpty(val) {
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}