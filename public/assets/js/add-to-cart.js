$(document).ready(function () {
    // Function to add item to cart
    function addToCart(id, name, price, img_src) {
        var currentCount = parseInt($('#cart_count').text());

        $.ajax({
            url: addToCartUrl, // Defined globally in the blade file
            type: 'POST',
            data: {
                _token: csrfToken, // Defined globally in the blade file
                cartkey: 'customer',
                id: id,
                name: name,
                price: price,
                img_src: img_src
            },
            success: function (data) {
                if (data.success) {
                    $('#cart_count').text(currentCount + 1);
                } else {
                    alert(data.message || 'Failed to add item to cart.');
                }
            },
            error: function () {
                alert('An error occurred while adding the item to the cart.');
            }
        });
    }

    // Attach addToCart function to buttons
    $('.add-to-cart').click(function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        var img_src = $(this).data('img_src');
        addToCart(id, name, price, img_src);
    });
});
