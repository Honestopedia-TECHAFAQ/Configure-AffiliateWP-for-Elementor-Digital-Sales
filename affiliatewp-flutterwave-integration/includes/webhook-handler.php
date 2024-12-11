<?php
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/flutterwave-webhook', [
        'methods' => 'POST',
        'callback' => 'handle_flutterwave_webhook',
        'permission_callback' => '__return_true',
    ]);
});

function handle_flutterwave_webhook(WP_REST_Request $request) {
    $body = $request->get_body();
    $data = json_decode($body, true);

    $secret = 'YOUR_FLUTTERWAVE_SECRET_KEY';
    $signature = $request->get_header('verif-hash');

    if (!$signature || $signature !== $secret) {
        return new WP_REST_Response(['error' => 'Invalid webhook signature'], 403);
    }

    $transaction_id = $data['data']['id'];
    $amount = $data['data']['amount'];
    $referral_id = isset($_COOKIE['affiliate_ref_id']) ? sanitize_text_field($_COOKIE['affiliate_ref_id']) : null;

    if ($referral_id) {
        $referral = affwp_add_referral([
            'affiliate_id' => $referral_id,
            'amount' => $amount,
            'description' => 'Digital Product Sale',
            'reference' => $transaction_id,
            'status' => 'unpaid',
        ]);

        if ($referral) {
            return new WP_REST_Response(['success' => true, 'message' => 'Referral tracked successfully'], 200);
        } else {
            return new WP_REST_Response(['error' => 'Failed to track referral'], 500);
        }
    }

    return new WP_REST_Response(['message' => 'No affiliate referral found'], 200);
}
