$(document).ready(function () {

     
    // Attach click event to add-to-cart buttons
    $('.add-to-cart').click(function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        var img_src = $(this).data('img_src');

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
                    $('#cart_count').text(data.total_items);
                    $('.quantity-input').val(1);
                    $('.checkout-btn').removeClass('d-none').addClass('d-block');
                    $('.quantity').removeClass('d-none').addClass('d-block');
                    $('.add-to-cart').removeClass('d-block').addClass('d-none');
                } else {
                    alert(data.message || 'Failed to add item to cart.');
                }
            },
            error: function () {
                alert('An error occurred while adding the item to the cart.');
            }
        });
    });
 

    // Listener to quantity inputs
    $('.quantity-input').change(function () {
        var id = $(this).data('id');
        var quantity = $(this).val();

        if (quantity == 0) {
            // Remove
            $.post(removeFromCartUrl, { _token: csrfToken, cartkey: 'customer', id: id }, function (data) {
                if (data.success) {
                    $('#cart_count').text(data.total_items);
                    $('.add-to-cart').removeClass('d-none').addClass('d-block');
                    $('.quantity').removeClass('d-block').addClass('d-none');
                    $('.checkout-btn').removeClass('d-block').addClass('d-none');
                }
            });
        } else {
            // Update
            $.post(updateCartUrl, { _token: csrfToken, cartkey: 'customer', id: id, quantity: quantity }, function (data) {
                if (data.success) {
                    $('#cart_count').text(data.total_items);
                }
            });
        }
    });

    
    // Plus button listener
    $('.plus').on('click', function () {
        if ($(this).prev().val()) {
            $(this).prev().val(+$(this).prev().val() + 1).trigger('change');
        }
    });

    // Minus button listener
    $('.minus').on('click', function () {
        if ($(this).next().val() > 0) {
            $(this).next().val(+$(this).next().val() - 1).trigger('change');
        }
    });


});
