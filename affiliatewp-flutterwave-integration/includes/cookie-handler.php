<?php
add_action('init', function () {
    if (isset($_GET['ref'])) {
        $affiliate_id = intval($_GET['ref']);
        setcookie('affiliate_ref_id', $affiliate_id, time() + (30 * DAY_IN_SECONDS), COOKIEPATH, COOKIE_DOMAIN);
    }
});
