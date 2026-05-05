<script src="AjaxJS/livesupportlibrary.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // =============== Quantity buttons ================== //
    document.querySelectorAll('.product-card').forEach(function(card) {
        // ========== Decrease quantity (minimum: 1) =============== //
        card.querySelector('.qty-minus').addEventListener('click', function() {
            let input = card.querySelector('.qty-input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
        // ============ Increase quantity (maximum: 99) =============== //
        card.querySelector('.qty-plus').addEventListener('click', function() {
            let input = card.querySelector('.qty-input');
            if (parseInt(input.value) < 99) {
                input.value = parseInt(input.value) + 1;
            }
        });
    });
    $(document).ready(function () {
        // ================= Add Cart ======================= //
        $('.add-to-cart-form').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            $.ajax({
                url: '/products_cart_store/',
                type: 'POST',
                data: data,
                success: function (res) {
                    alert(res.message);
                    $('#cart-count').text(res.cart_count);
                    setTimeout(function () {
                        $('#ajax-message').fadeOut();
                    }, 3000);
                },
                error: function () {
                    alert('Failed to add product');
                }
            });
        });

        // ============= UPDATE Ajax =============== //
        $(document).on('click', '.btn-update-ajax', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var key = $(this).data('id');
            var qty = $('.qty-input[data-id="' + key + '"]').val();
            $.ajax({
                url: '/cart_update/' + key,
                type: 'POST',
                data: { quantity: qty },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        var price    = parseFloat($('#row_' + key).data('price'));
                        var newTotal = (price * qty).toFixed(2);
                        $('.item-total', '#row_' + key).text('$' + parseFloat(newTotal).toLocaleString('en', {minimumFractionDigits:2}));
                        recalculateGrandTotal();
                        $('#cart-count').text(response.cart_count);
                    }   
                },
                error: function() {
                    showMessage('Something went wrong!', 'danger');
                }
            });
        });

        // ========== DELETE Ajax ============ //
        $(document).on('click', '.btn-remove-ajax', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var key = $(this).data('id');

            if(!confirm('Do you want to delete this item?')) {
                return false;
            }

            $.ajax({
                url: '/cart_delete/' + key,
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        $('#row_' + key).remove();
                        recalculateGrandTotal();
                        $('#cart-count').text(response.cart_count);

                        if ($('tbody tr').length === 0) {
                            $('.cart-wrapper').html('<p style="text-align:center; font-size:20px;color:#777;">Your cart is empty.</p>');
                            $('.cart-total').hide();
                        }
                    }
                },
                error: function() {
                    showMessage('Something went wrong!', 'danger');
                }
            });
        });
        
        // ========== DELETE ALL Ajax ============ //
        $(document).on('click', '#btn-delete-all-cart', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if(!confirm('Do you want to delete all items?')) {
                return false;
            }

            $.ajax({
                url: '/cart_delete_all',
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        $('.cart-wrapper').html('<p style="text-align:center; font-size:20px;color:#777;">Your cart is empty.</p>');
                        $('.cart-total').hide();
                        $('#cart-count').text(response.cart_count);
                    }
                },
                error: function() {
                    showMessage('Something went wrong!', 'danger');
                }
            });
        });
    });
    // ================= RECALCULATE GRAND TOTAL ================= //
    function recalculateGrandTotal() {
        var grandTotal = 0;
        $('tbody tr').each(function() {
            var totalText = $(this).find('.item-total').text().replace('$','').replace(/,/g, '');
            grandTotal += parseFloat(totalText) || 0;
        });
        $('#grand-total').text('$' + grandTotal.toLocaleString('en', {minimumFractionDigits:2, maximumFractionDigits:2}));
    }
</script>