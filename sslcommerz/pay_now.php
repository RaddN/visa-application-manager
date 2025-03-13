<?php

/**
 * Enhanced WordPress Shortcode for SSLCommerz Pay Now Button
 * - Uses logged-in user info
 * - Shows popup for guest users to collect required info
 * - Stores payment information in database
 * 
 * [sslcommerz_pay_button amount="100" currency="BDT" product_name="Product Name" success_url="" cancel_url="" fail_url=""]
 */

// Register the shortcode
function sslcommerz_pay_button_shortcode($atts)
{
    // Default attributes
    $atts = shortcode_atts(
        array(
            'amount' => '100',
            'currency' => 'BDT',
            'product_name' => 'Product Purchase',
            'success_url' => home_url('/payment-success'),
            'cancel_url' => home_url('/payment-cancelled'),
            'fail_url' => home_url('/payment-failed'),
            'button_text' => 'Pay Now',
            'button_class' => 'sslcommerz-pay-button',
        ),
        $atts,
        'sslcommerz_pay_button'
    );

    // Generate a unique transaction ID
    $transaction_id = 'SSLCZ_' . uniqid();

    // Check if user is logged in
    $user_logged_in = is_user_logged_in();
    $current_user = wp_get_current_user();

    // Get user info if logged in
    $customer_name = $user_logged_in ? $current_user->display_name : '';
    $customer_email = $user_logged_in ? $current_user->user_email : '';

    // Button HTML with hidden form for submission
    $form_id = 'sslcommerz_form_' . esc_attr($transaction_id);

    // Get the total from the URL and convert it to a float
    $total = isset($_GET['total']) ? $_GET['total'] : $atts['amount'];
    $entry_id = isset($_GET['entry_id']) ? $_GET['entry_id'] : 0;

    // Remove dollar sign and commas for conversion
    $amount = (float) str_replace(['$', ','], '', $total);

    $output = '
    <form action="' . esc_url(admin_url('admin-ajax.php')) . '" method="post" id="' . esc_attr($form_id) . '">
        <input type="hidden" name="action" value="sslcommerz_checkout">
        <input type="hidden" name="transaction_id" value="' . esc_attr($transaction_id) . '">
        <input type="hidden" name="amount" value="' . esc_attr($amount) . '">
        <input type="hidden" name="entry_id" value="' . esc_attr($entry_id) . '">
        <input type="hidden" name="currency" value="' . esc_attr($atts['currency']) . '">
        <input type="hidden" name="product_name" value="' . esc_attr($atts['product_name']) . '">
        <input type="hidden" name="customer_name" value="' . esc_attr($customer_name) . '" id="' . esc_attr($form_id) . '_customer_name">
        <input type="hidden" name="customer_email" value="' . esc_attr($customer_email) . '" id="' . esc_attr($form_id) . '_customer_email">
        <input type="hidden" name="success_url" value="' . esc_url($atts['success_url']) . '">
        <input type="hidden" name="cancel_url" value="' . esc_url($atts['cancel_url']) . '">
        <input type="hidden" name="fail_url" value="' . esc_url($atts['fail_url']) . '">
        <input type="hidden" name="is_user_logged_in" value="' . ($user_logged_in ? '1' : '0') . '">
        <input type="hidden" name="user_id" value="' . ($user_logged_in ? (int)esc_attr($current_user->ID) : '0') . '">
        <button type="submit" class="' . esc_attr($atts['button_class']) . '">' . esc_html($atts['button_text']) . '</button>
    </form>';


    // Add popup modal for guest users
    if (!$user_logged_in) {
        $output .= '
        <div id="' . $form_id . '_modal" class="sslcommerz-modal" style="display: none;">
            <div class="sslcommerz-modal-content">
                <span class="sslcommerz-close">&times;</span>
                <h3>Customer Information</h3>
                <p>Please provide your information to continue with payment.</p>
                <div class="sslcommerz-form-group">
                    <label for="' . $form_id . '_modal_name">Name:</label>
                    <input type="text" id="' . $form_id . '_modal_name" class="sslcommerz-input" required>
                </div>
                <div class="sslcommerz-form-group">
                    <label for="' . $form_id . '_modal_email">Email:</label>
                    <input type="email" id="' . $form_id . '_modal_email" class="sslcommerz-input" required>
                </div>
                <button type="button" id="' . $form_id . '_modal_submit" class="sslcommerz-modal-button">Continue to Payment</button>
            </div>
        </div>';
    }

    return $output;
}
add_shortcode('sslcommerz_pay_button', 'sslcommerz_pay_button_shortcode');

// Handle AJAX request for checkout
function sslcommerz_checkout_handler()
{
    global $wpdb;

    // Store ID and Password (replace with your own)
    $store_id = get_option('sslcommerz_store_id', 'visat67cfb76211c99');
    $store_passwd = get_option('sslcommerz_store_passwd', 'visat67cfb76211c99@ssl');
    $is_sandbox = get_option('sslcommerz_is_sandbox', true);

    // Sanitize input
    $transaction_id = sanitize_text_field($_POST['transaction_id']);
    $amount = sanitize_text_field($_POST['amount']);
    $entry_id = sanitize_text_field($_POST['entry_id']);
    $currency = sanitize_text_field($_POST['currency']);
    $product_name = sanitize_text_field($_POST['product_name']);
    $customer_name = sanitize_text_field($_POST['customer_name']);
    $customer_email = sanitize_email($_POST['customer_email']);
    $user_id = intval($_POST['user_id']);

    // Validate required fields
    if (empty($customer_name) || empty($customer_email)) {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Customer name and email are required.'
        ));
        wp_die();
    }

    // API endpoint
    $api_url = $is_sandbox ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php' : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

    // Transaction data
    $post_data = array(
        'store_id' => $store_id,
        'store_passwd' => $store_passwd,
        'total_amount' => $amount,
        'entry_id' => $entry_id,
        'currency' => $currency,
        'tran_id' => $transaction_id,
        'success_url' => esc_url_raw($_POST['success_url']),
        'fail_url' => esc_url_raw($_POST['fail_url']),
        'cancel_url' => esc_url_raw($_POST['cancel_url']),
        'cus_name' => $customer_name,
        'cus_email' => $customer_email,
        'cus_add1' => 'Customer Address',
        'cus_city' => 'Customer City',
        'cus_state' => 'Customer State',
        'cus_postcode' => '1234',
        'cus_country' => 'Bangladesh',
        'cus_phone' => '01711111111',
        'shipping_method' => 'NO',
        'product_name' => $product_name,
        'product_category' => 'General',
        'product_profile' => 'general',
    );

    // Record payment attempt in database
    $table_name = $wpdb->prefix . 'sslcommerz_payments';
    $wp_form_payment_table = $wpdb->prefix . 'wpforms_payments';
    $wpdb->insert(
        $table_name,
        array(
            'user_id' => $user_id > 0 ? $user_id : null,
            'transaction_id' => $transaction_id,
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'amount' => $amount,
            'entry_id' => $entry_id,
            'currency' => $currency,
            'product_name' => $product_name,
            'payment_status' => 'INITIATED',
            'gateway_response' => '',
        )
    );
    $wpdb->insert(
        $wp_form_payment_table,
        array(
            'form_id' => 17,
            'status' => 'VALID',
            'subtotal_amount' => $amount,
            'discount_amount' => 0,
            'total_amount' => $amount,
            'currency' => $currency,
            'entry_id' => $entry_id,
            'gateway' => "stripe",
            'type' => "one-time",
            'mode' => "",
            'transaction_id' => $transaction_id,
            'customer_id' => $user_id > 0 ? $user_id : 0,
            'title' => $customer_name,
            'date_created_gmt' => current_time('mysql', 1),
            'date_updated_gmt' => current_time('mysql', 1),

        )
    );

    // Make the API request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Process the response
    $sslc_data = json_decode($response);

    if (isset($sslc_data->status) && $sslc_data->status == 'SUCCESS') {
        // Update database record with gateway response
        $wpdb->update(
            $table_name,
            array(
                'gateway_response' => $response,
            ),
            array('transaction_id' => $transaction_id)
        );

        echo json_encode(array(
            'status' => 'success',
            'redirect' => $sslc_data->GatewayPageURL
        ));
    } else {
        // Update database record with failed status
        $wpdb->update(
            $table_name,
            array(
                'payment_status' => 'FAILED',
                'gateway_response' => $response,
            ),
            array('transaction_id' => $transaction_id)
        );

        echo json_encode(array(
            'status' => 'failed',
            'message' => isset($sslc_data->failedreason) ? $sslc_data->failedreason : 'Payment initialization failed'
        ));
    }

    wp_die();
}
add_action('wp_ajax_sslcommerz_checkout', 'sslcommerz_checkout_handler');
add_action('wp_ajax_nopriv_sslcommerz_checkout', 'sslcommerz_checkout_handler');

// Handle payment success callback
function sslcommerz_payment_success()
{
    global $wpdb;

    if (isset($_POST['tran_id']) && isset($_POST['status'])) {
        $transaction_id = sanitize_text_field($_POST['tran_id']);
        $status = sanitize_text_field($_POST['status']);

        // Update payment status in database
        $table_name = $wpdb->prefix . 'sslcommerz_payments';
        $wpdb->update(
            $table_name,
            array(
                'payment_status' => $status,
                'gateway_response' => json_encode($_POST),
            ),
            array('transaction_id' => $transaction_id)
        );

        // Additional custom actions on successful payment
        do_action('sslcommerz_payment_completed', $transaction_id, $_POST);
    }
}
add_action('init', 'sslcommerz_payment_success');

// Add scripts and styles
function sslcommerz_enqueue_scripts()
{
    wp_enqueue_script('jquery');

    // Add inline script for AJAX submission and modal handling
    $script = "
    jQuery(document).ready(function($) {
        // Form submission handler
        $('form[id^=\"sslcommerz_form_\"]').on('submit', function(e) {
            e.preventDefault();
            
            var form = $(this);
            var formId = form.attr('id');
            var isLoggedIn = form.find('input[name=\"is_user_logged_in\"]').val();
            
            // Show modal if user is not logged in
            if (isLoggedIn === '0') {
                $('#' + formId + '_modal').css('display', 'block');
                return false;
            }
            
            // Process payment directly if user is logged in
            processPayment(form);
        });
        
        // Modal close button
        $('.sslcommerz-close').on('click', function() {
            $(this).closest('.sslcommerz-modal').css('display', 'none');
        });
        
        // Modal submit button
        $('button[id$=\"_modal_submit\"]').on('click', function() {
            var modalId = $(this).closest('.sslcommerz-modal').attr('id');
            var formId = modalId.replace('_modal', '');
            var form = $('#' + formId);
            
            // Get customer info from modal
            var name = $('#' + formId + '_modal_name').val();
            var email = $('#' + formId + '_modal_email').val();
            
            // Validate inputs
            if (!name || !email) {
                alert('Please fill in all required fields.');
                return;
            }
            
            if (!isValidEmail(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            
            // Update form with customer info
            $('#' + formId + '_customer_name').val(name);
            $('#' + formId + '_customer_email').val(email);
            
            // Close modal
            $('#' + modalId).css('display', 'none');
            
            // Process payment
            processPayment(form);
        });
        
        // Email validation function
        function isValidEmail(email) {
            var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return pattern.test(email);
        }
        
        // Process payment function
        function processPayment(form) {
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    form.find('button').prop('disabled', true).text('Processing...');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = response.redirect;
                    } else {
                        alert(response.message);
                        form.find('button').prop('disabled', false).text('Pay Now');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                    form.find('button').prop('disabled', false).text('Pay Now');
                }
            });
        }
        
        // Close modal when clicking outside
        $(window).on('click', function(e) {
            $('.sslcommerz-modal').each(function() {
                if (e.target == this) {
                    $(this).css('display', 'none');
                }
            });
        });
    });
    ";

    wp_add_inline_script('jquery', $script);

    // Add custom CSS for the button and modal
    $css = "
    /* Pay Button Styles */
    .sslcommerz-pay-button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
        font-size: 16px;
    }
    .sslcommerz-pay-button:hover {
        background-color: #0056b3;
    }
    
    /* Modal Styles */
    .sslcommerz-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }
    
    .sslcommerz-modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 400px;
        max-width: 90%;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .sslcommerz-close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    
    .sslcommerz-close:hover,
    .sslcommerz-close:focus {
        color: black;
        text-decoration: none;
    }
    
    .sslcommerz-form-group {
        margin-bottom: 15px;
    }
    
    .sslcommerz-form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .sslcommerz-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    .sslcommerz-modal-button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
        margin-top: 10px;
        width: 100%;
    }
    
    .sslcommerz-modal-button:hover {
        background-color: #0056b3;
    }
    ";

    wp_add_inline_style('wp-block-library', $css);
}
add_action('wp_enqueue_scripts', 'sslcommerz_enqueue_scripts');

require_once 'admin.php';
