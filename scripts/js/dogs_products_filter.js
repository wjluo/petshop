var urlParams = new URLSearchParams(window.location.search);

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

    var params = [];
    var price_order = this.id;
    params.push(price_order);

    if (urlParams.has('category')) {
        var category = urlParams.get('category');
        params.push(category);
    }
    
    $.post('filter.php', {
            action: "price_order",
            price_order: price_order,
            category: category
        })
        .done(function (data) {

            urlParams.set('price_order', price_order);
            urlParams.set('category', category);
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

    switch(cat) {

        case "ΤΡΟΦΗ": category_eng = "trofi"
        break;

        case "ΛΙΧΟΥΔΙΕΣ": category_eng = "lichoudies"
        break;
        
        case "ΚΟΛΑΡΑ": category_eng = "kolara"
        break;

        case "ΡΟΥΧΑ": category_eng = "roucha"
        break;

        case "ΠΑΙΧΝΙΔΙΑ": category_eng = "paichnidia"
        break;
    }

    return category_eng;    
}