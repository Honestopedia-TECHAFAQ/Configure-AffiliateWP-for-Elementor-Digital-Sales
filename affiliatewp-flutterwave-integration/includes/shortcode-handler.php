<?php
add_shortcode('flutterwave_payment', function ($atts) {
    ob_start();
    ?>
    <form id="flutterwave-payment-form">
        <input type="hidden" name="amount" value="50">
        <input type="hidden" name="ref" value="<?php echo isset($_COOKIE['affiliate_ref_id']) ? esc_attr($_COOKIE['affiliate_ref_id']) : ''; ?>">
        <button type="button" onclick="makePayment()">Pay Now</button>
    </form>

    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
        function makePayment() {
            FlutterwaveCheckout({
                public_key: "YOUR_FLUTTERWAVE_PUBLIC_KEY",
                tx_ref: "TX123456",
                amount: 50,
                currency: "USD",
                customer: {
                    email: "user@example.com",
                    phone_number: "1234567890",
                    name: "Customer Name",
                },
                callback: function (data) {
                    alert('Payment Successful');
                },
                onclose: function () {
                    alert('Payment Cancelled');
                },
            });
        }
    </script>
    <?php
    return ob_get_clean();
});
