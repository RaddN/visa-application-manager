<?php
/**
 * WordPress Shortcode to display SSLCommerz payment success details
 * Usage: [sslcommerz_payment_success]
 */

// Register the shortcode for payment success page
function sslcommerz_payment_success_shortcode() {
    global $wpdb;
    $output = '';
    
    // Check if transaction ID exists in URL or POST data
    $transaction_id = '';
    if (isset($_GET['tran_id'])) {
        $transaction_id = sanitize_text_field($_GET['tran_id']);
    } elseif (isset($_POST['tran_id'])) {
        $transaction_id = sanitize_text_field($_POST['tran_id']);
    }
    
    // If no transaction ID found, display a message
    if (empty($transaction_id)) {
        return '<div class="sslcommerz-error">No transaction details found.</div>';
    }
    
    // Retrieve payment details from database
    $table_name = $wpdb->prefix . 'sslcommerz_payments';
    $payment = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE transaction_id = %s",
            $transaction_id
        ),
        ARRAY_A
    );
    
    // If payment not found, display error message
    if (!$payment) {
        return '<div class="sslcommerz-error">Payment details not found for this transaction.</div>';
    }
    
    // Get additional data from SSLCommerz response
    $val_id = isset($_POST['val_id']) ? sanitize_text_field($_POST['val_id']) : '';
    $amount = isset($_POST['amount']) ? sanitize_text_field($_POST['amount']) : $payment['amount'];
    $currency = isset($_POST['currency']) ? sanitize_text_field($_POST['currency']) : $payment['currency'];
    $card_type = isset($_POST['card_type']) ? sanitize_text_field($_POST['card_type']) : '';
    $card_brand = isset($_POST['card_brand']) ? sanitize_text_field($_POST['card_brand']) : '';
    $payment_status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : $payment['payment_status'];
    $bank_tran_id = isset($_POST['bank_tran_id']) ? sanitize_text_field($_POST['bank_tran_id']) : '';
    $tran_date = isset($_POST['tran_date']) ? sanitize_text_field($_POST['tran_date']) : '';
    
    // Get customer info from database
    $customer_name = $payment['customer_name'];
    $customer_email = $payment['customer_email'];
    $product_name = $payment['product_name'];
    
    // Format status for display
    $status_class = 'status-' . strtolower($payment_status);
    
    // Build the HTML output
    $output .= '<div class="sslcommerz-success-container">';
    
    // Success message
    if ($payment_status == 'VALID' || $payment_status == 'SUCCESS') {
        $output .= '<div class="sslcommerz-success-header">';
        $output .= '<div class="sslcommerz-success-icon">✓</div>';
        $output .= '<h2>Payment Successful</h2>';
        $output .= '<p>Your payment has been processed successfully.</p>';
        $output .= '</div>';
    } else {
        $output .= '<div class="sslcommerz-error-header">';
        $output .= '<div class="sslcommerz-error-icon">!</div>';
        $output .= '<h2>Payment ' . esc_html($payment_status) . '</h2>';
        $output .= '</div>';
    }
    
    // Transaction details
    $output .= '<div class="sslcommerz-details">';
    $output .= '<h3>Transaction Details</h3>';
    $output .= '<table class="sslcommerz-details-table">';
    
    // Customer information
    $output .= '<tr><th>Customer Name</th><td>' . esc_html($customer_name) . '</td></tr>';
    $output .= '<tr><th>Customer Email</th><td>' . esc_html($customer_email) . '</td></tr>';
    
    // Product & Payment information
    $output .= '<tr><th>Product</th><td>' . esc_html($product_name) . '</td></tr>';
    $output .= '<tr><th>Amount</th><td>' . esc_html($amount) . ' ' . esc_html($currency) . '</td></tr>';
    $output .= '<tr><th>Transaction ID</th><td>' . esc_html($transaction_id) . '</td></tr>';
    
    if (!empty($val_id)) {
        $output .= '<tr><th>Validation ID</th><td>' . esc_html($val_id) . '</td></tr>';
    }
    
    if (!empty($bank_tran_id)) {
        $output .= '<tr><th>Bank Transaction ID</th><td>' . esc_html($bank_tran_id) . '</td></tr>';
    }
    
    if (!empty($card_type)) {
        $output .= '<tr><th>Payment Method</th><td>' . esc_html($card_type);
        if (!empty($card_brand)) {
            $output .= ' (' . esc_html($card_brand) . ')';
        }
        $output .= '</td></tr>';
    }
    
    if (!empty($tran_date)) {
        $output .= '<tr><th>Transaction Date</th><td>' . esc_html($tran_date) . '</td></tr>';
    } else {
        $output .= '<tr><th>Transaction Date</th><td>' . esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($payment['created_at']))) . '</td></tr>';
    }
    
    $output .= '<tr><th>Status</th><td><span class="payment-status ' . esc_attr($status_class) . '">' . esc_html($payment_status) . '</span></td></tr>';
    
    $output .= '</table>';
    $output .= '</div>';
    
    // Add return to home link
    $output .= '<div class="sslcommerz-actions">';
    $output .= '<a href="' . esc_url(home_url()) . '" class="sslcommerz-button">Return to Home</a>';
    $output .= '<a href="' . esc_url(home_url().'/user') . '" class="sslcommerz-button" style="background: green;">Return to Dashboard</a>';
    $output .= '</div>';
    
    $output .= '</div>';
    
    // Add CSS for styling
    $output .= '<style>
        .sslcommerz-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }
        .sslcommerz-success-container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .sslcommerz-success-header {
            text-align: center;
            margin-bottom: 30px;
            color: #155724;
        }
        .sslcommerz-error-header {
            text-align: center;
            margin-bottom: 30px;
            color: #721c24;
        }
        .sslcommerz-success-icon {
            width: 60px;
            height: 60px;
            background: #d4edda;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #155724;
            margin: 0 auto 15px;
        }
        .sslcommerz-error-icon {
            width: 60px;
            height: 60px;
            background: #f8d7da;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #721c24;
            margin: 0 auto 15px;
        }
        .sslcommerz-details {
            margin-bottom: 30px;
        }
        .sslcommerz-details h3 {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .sslcommerz-details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .sslcommerz-details-table th, 
        .sslcommerz-details-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .sslcommerz-details-table th {
            width: 40%;
            font-weight: 600;
        }
        .payment-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }
        .status-valid, .status-success {
            background-color: #D4EDDA;
            color: #155724;
        }
        .status-failed {
            background-color: #F8D7DA;
            color: #721C24;
        }
        .status-cancelled {
            background-color: #E2E3E5;
            color: #383D41;
        }
        .status-pending {
            background-color: #FFF3CD;
            color: #856404;
        }
        .status-initiated {
            background-color: #f0f0f0;
            color: #333;
        }
        .sslcommerz-actions {
            text-align: center;
            margin-top: 30px;
        }
        .sslcommerz-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .sslcommerz-button:hover {
            background-color: #0056b3;
            text-decoration: none;
            color: white;
        }
        .sslcommerz-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>';
    
    return $output;
}
add_shortcode('sslcommerz_payment_success', 'sslcommerz_payment_success_shortcode');