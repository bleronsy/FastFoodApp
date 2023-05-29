$(document).ready(function() {
    var totalPrice = parseFloat(sessionStorage.getItem('totalPrice')) || 0;

    $('.add-to-cart').on('click', function() {
        var name = $(this).data('name');
        var price = parseFloat($(this).data('price'));
        var item = "<div>" + name + ": " + price.toFixed(2) + "€ <button class='remove-item'>Remove</button></div>";
        $('#chart').append(item);

        totalPrice += price;
        updateTotalPrice();
        saveCartItems();
    });

    $('#chart').on('click', '.remove-item', function() {
        var item = $(this).parent();
        var price = parseFloat(item.contents().get(0).nodeValue.match(/(\d+\.\d+)/)[0]);
        item.remove();

        totalPrice -= price;
        updateTotalPrice();
        saveCartItems();
    });

    function updateTotalPrice() {
        $('#total').text(totalPrice.toFixed(2));
    }

    function saveCartItems() {
        var cartItems = $('#chart').html();
        sessionStorage.setItem('cartItems', cartItems);
        sessionStorage.setItem('totalPrice', totalPrice.toFixed(2));
    }

    function loadCartItems() {
        var cartItems = sessionStorage.getItem('cartItems');
        if (cartItems) {
            $('#chart').html(cartItems);
        }
    }

    function clearCart() {
        $('#chart').empty();
        totalPrice = 0;
        updateTotalPrice();
        saveCartItems();
    }

    function completeOrder() {
        alert('Payment successful. Your order has been completed. Thank you!');
        clearCart();
    }

    function initiatePayPalCheckout() {
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: totalPrice.toFixed(2),
                            currency_code: 'EUR'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Check if the payment is successful
                    if (details.status === 'COMPLETED') {
                        completeOrder();
                    } else {
                        alert('Payment was not successful. Please try again.');
                    }
                });
            }
        }).render('#checkout');

        // Disable the PayPal button after it is clicked
        $('#paypal-button').prop('disabled', true);
    }

    $('#cash-button').on('click', function() {
        alert('Order received. Thank you!');
        clearCart();
    });

    $('#paypal-button').on('click', function() {
        initiatePayPalCheckout();
    });

    // Initial update of the total price and cart items
    updateTotalPrice();
    loadCartItems();
});