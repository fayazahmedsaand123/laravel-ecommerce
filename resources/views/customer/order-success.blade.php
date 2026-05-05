{{-- resources/views/customer/order-success.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .success-box { margin-top: 100px; animation: fadeInUp 1s ease-in-out; }
        .check-icon { font-size: 80px; color: #28a745; animation: pop 0.6s ease-in-out; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pop { 0% { transform: scale(0.5); } 100% { transform: scale(1); } }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center shadow success-box">
                <div class="card-body p-5">
                    <div class="check-icon mb-3">✔</div>
                    <h2 class="text-success fw-bold">Order Placed!</h2>
                    <p class="mt-3 fs-5">Click below to confirm your order via OTP sent to your email.</p>
                    <p class="text-muted">📧 {{ $userEmail }}</p>
                    <button type="button" id="sendOtpBtn" class="btn btn-success btn-lg mt-3">Confirm Order</button>
                    <div id="otpMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- OTP Modal --}}
<div class="modal fade" id="otpModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enter OTP</h5>
            </div>
            <div class="modal-body text-center">
                <p>OTP sent to <strong>{{ $userEmail }}</strong></p>
                <input type="text" id="otpInput" class="form-control text-center fs-4 fw-bold"
                       maxlength="6" placeholder="------" style="letter-spacing:8px;">
                <div id="otpError" class="text-danger mt-2" style="display:none;"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" id="resendOtpBtn" class="btn btn-link text-muted">Resend OTP</button>
                <button type="button" id="verifyOtpBtn" class="btn btn-primary">Verify OTP</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const orderId = {{ $order->id }};
    const otpModal = new bootstrap.Modal(document.getElementById('otpModal'));

    function sendOtp() {
        $('#sendOtpBtn').text('Sending...').prop('disabled', true);
        $('#resendOtpBtn').text('Resending...').prop('disabled', true);
        $('#otpError').text('').hide();
        $('#otpInput').val('');
        $.ajax({
            url: '{{ route('order.sendOtp') }}',
            method: 'POST',
            data: { _token: '{{ csrf_token() }}', order_id: orderId },
            success: function(res) {
                if (res.success) {
                    if (!$('#otpModal').hasClass('show')) {
                        otpModal.show();
                    }
                    $('#sendOtpBtn').text('Confirm Order').prop('disabled', false);
                    $('#resendOtpBtn').text('Resend OTP').prop('disabled', false);
                } else {
                    $('#otpMessage').html('<div class="alert alert-danger">' + res.message + '</div>');
                    $('#sendOtpBtn').text('Confirm Order').prop('disabled', false);
                    $('#resendOtpBtn').text('Resend OTP').prop('disabled', false);
                }
            },
            error: function(xhr) {
                let msg = xhr.responseJSON?.message ?? 'Failed to send OTP. Try again.';
                $('#otpMessage').html('<div class="alert alert-danger">' + msg + '</div>');
                $('#sendOtpBtn').text('Confirm Order').prop('disabled', false);
                $('#resendOtpBtn').text('Resend OTP').prop('disabled', false);
            }
        });
    }

    $('#sendOtpBtn').click(function() { sendOtp(); });
    $('#resendOtpBtn').click(function() { sendOtp(); });

    $('#verifyOtpBtn').click(function() {
        const otp = $('#otpInput').val().trim();
        if (otp.length !== 6) {
            $('#otpError').text('Please enter 6-digit OTP.').show();
            return;
        }
        $('#verifyOtpBtn').text('Verifying...').prop('disabled', true);
        $.ajax({
            url: '{{ route('order.verifyOtp') }}',
            method: 'POST',
            data: { _token: '{{ csrf_token() }}', order_id: orderId, otp: otp },
            success: function(res) {
                if (res.success) {
                    otpModal.hide();
                    $('.card-body').html(`
                        <div style="font-size:80px; color:#28a745;">✔</div>
                        <h2 class="text-success fw-bold mt-3">Order Confirmed!</h2>
                        <p class="fs-5 mt-3">Your order has been confirmed.<br>You will receive it very soon!</p>
                        <a href="{{ route('index') }}" class="btn btn-primary mt-4">Continue Shopping</a>
                    `);
                } else {
                    $('#otpError').text(res.message || 'Invalid OTP.').show();
                    $('#verifyOtpBtn').text('Verify OTP').prop('disabled', false);
                }
            },
            error: function() {
                $('#otpError').text('Something went wrong. Try again.').show();
                $('#verifyOtpBtn').text('Verify OTP').prop('disabled', false);
            }
        });
    });

    $('#otpInput').on('input', function() {
        $('#otpError').text('').hide();
    });
</script>
</body>
</html>