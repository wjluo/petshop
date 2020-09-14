$('.category').click(function() {

    var category = this.id;

    $.post("filter_by_category.php", {
            action: "filter",
            category: category
        })
        .done(function(data) {
            $('#products-div').html(data);
        })
        .fail(function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        });
});