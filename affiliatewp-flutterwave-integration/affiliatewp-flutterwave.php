<?php
/*
Plugin Name: AffiliateWP - Flutterwave Integration
Description: Custom integration for AffiliateWP with Flutterwave payment gateway.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) exit;

// Include functionality files
require_once plugin_dir_path(__FILE__) . 'includes/webhook-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/cookie-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode-handler.php';

// Activation Hook
register_activation_hook(__FILE__, function () {
    flush_rewrite_rules();
});

// Deactivation Hook
register_deactivation_hook(__FILE__, function () {
    flush_rewrite_rules();
});
