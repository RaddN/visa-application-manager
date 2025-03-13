<?php
// Admin page to view payment records
function sslcommerz_admin_menu() {
    add_menu_page('SSLCommerz Payments', 'SSLCommerz', 'manage_options', 'sslcommerz-payments', 'sslcommerz_payments_page', 'dashicons-money', 30);
    add_submenu_page('sslcommerz-payments', 'Settings', 'Settings', 'manage_options', 'sslcommerz-settings', 'sslcommerz_settings_page');
}
add_action('admin_menu', 'sslcommerz_admin_menu');

// Admin page to set SSLCommerz settings
function sslcommerz_settings_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // Save settings if form is submitted
    if (isset($_POST['sslcommerz_save_settings'])) {
        update_option('sslcommerz_store_id', sanitize_text_field($_POST['store_id']));
        update_option('sslcommerz_store_passwd', sanitize_text_field($_POST['store_passwd']));
        update_option('sslcommerz_is_sandbox', isset($_POST['is_sandbox']) ? 1 : 0);
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    // Get current settings
    $store_id = get_option('sslcommerz_store_id', 'visat67cfb76211c99');
    $store_passwd = get_option('sslcommerz_store_passwd', 'visat67cfb76211c99@ssl');
    $is_sandbox = get_option('sslcommerz_is_sandbox', true);
?>
<div class="wrap sslcommerz-settings-wrap">
    <h1>SSLCommerz Settings</h1>
    <div class="sslcommerz-card">
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="store_id">Store ID</label></th>
                    <td><input name="store_id" type="text" id="store_id" value="<?php echo esc_attr($store_id); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="store_passwd">Store Password</label></th>
                    <td><input name="store_passwd" type="password" id="store_passwd" value="<?php echo esc_attr($store_passwd); ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="is_sandbox">Sandbox Mode</label></th>
                    <td><input name="is_sandbox" type="checkbox" id="is_sandbox" <?php checked($is_sandbox); ?> /> Enable Sandbox Mode</td>
                </tr>
            </table>
            <?php submit_button('Save Settings', 'primary', 'sslcommerz_save_settings'); ?>
        </form>
    </div>
</div>
<?php
}

// Admin page callback function
function sslcommerz_payments_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'sslcommerz_payments';

    // Handle delete action
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $payment_id = intval($_GET['id']);
        $nonce = isset($_GET['_wpnonce']) ? $_GET['_wpnonce'] : '';
        if (wp_verify_nonce($nonce, 'delete_payment_' . $payment_id)) {
            $wpdb->delete(
                $table_name,
                ['id' => $payment_id],
                ['%d']
            );
            echo '<div class="notice notice-success is-dismissible"><p>Payment record deleted successfully.</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>Security verification failed.</p></div>';
        }
    }

    // Handle edit action
    if (isset($_POST['edit_payment'])) {
        $payment_id = intval($_POST['payment_id']);
        $nonce = isset($_POST['_wpnonce']) ? $_POST['_wpnonce'] : '';
        if (wp_verify_nonce($nonce, 'edit_payment_' . $payment_id)) {
            $wpdb->update(
                $table_name,
                [
                    'payment_status' => sanitize_text_field($_POST['payment_status']),
                    'customer_name' => sanitize_text_field($_POST['customer_name']),
                    'customer_email' => sanitize_email($_POST['customer_email']),
                    'amount' => floatval($_POST['amount']),
                    'product_name' => sanitize_text_field($_POST['product_name'])
                ],
                ['id' => $payment_id],
                ['%s', '%s', '%s', '%f', '%s'],
                ['%d']
            );
            echo '<div class="notice notice-success is-dismissible"><p>Payment record updated successfully.</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>Security verification failed.</p></div>';
        }
    }

    // Get payments with pagination and search
    $page = isset($_GET['paged']) ? absint($_GET['paged']) : 1;
    $per_page = 10; // Show 20 results per page
    $offset = ($page - 1) * $per_page;
    
    // Search functionality
    $search_term = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
    
    // Build query based on search term
    $search_query = '';
    $search_params = [];
    
    if (!empty($search_term)) {
        $search_query = "WHERE 
            transaction_id LIKE %s 
            OR customer_name LIKE %s 
            OR customer_email LIKE %s 
            OR product_name LIKE %s";
            
        $search_value = '%' . $wpdb->esc_like($search_term) . '%';
        $search_params = [$search_value, $search_value, $search_value, $search_value];
    }
    
    // Get filtered payments
    $query = "SELECT * FROM $table_name $search_query ORDER BY created_at DESC LIMIT %d, %d";
    $prepared_query = !empty($search_params) 
        ? $wpdb->prepare($query, array_merge($search_params, [$offset, $per_page])) 
        : $wpdb->prepare($query, [$offset, $per_page]);
    
    $payments = $wpdb->get_results($prepared_query, ARRAY_A);
    
    // Count total filtered items
    $count_query = "SELECT COUNT(*) FROM $table_name $search_query";
    $total_payments = !empty($search_params) 
        ? $wpdb->get_var($wpdb->prepare($count_query, $search_params)) 
        : $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
        
    $total_pages = ceil($total_payments / $per_page);

    // Display edit form if in edit mode
    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
        $payment_id = intval($_GET['id']);
        $payment = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $payment_id), ARRAY_A);
        if ($payment) {
?>
<div class="wrap sslcommerz-wrap">
    <h1>Edit Payment</h1>
    <div class="sslcommerz-card">
        <form method="post" action="">
            <?php wp_nonce_field('edit_payment_' . $payment_id); ?>
            <input type="hidden" name="payment_id" value="<?php echo esc_attr($payment_id); ?>">
            <table class="form-table">
                <tr>
                    <th>Transaction ID</th>
                    <td><?php echo esc_html($payment['transaction_id']); ?></td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td><input type="text" name="customer_name" value="<?php echo esc_attr($payment['customer_name']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th>Customer Email</th>
                    <td><input type="email" name="customer_email" value="<?php echo esc_attr($payment['customer_email']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td><input type="text" name="amount" value="<?php echo esc_attr($payment['amount']); ?>" class="regular-text"> <?php echo esc_html($payment['currency']); ?></td>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <td><input type="text" name="product_name" value="<?php echo esc_attr($payment['product_name']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th>Payment Status</th>
                    <td>
                        <select name="payment_status">
                            <option value="Initiated" <?php selected($payment['payment_status'], 'Initiated'); ?>>Initiated</option>
                            <option value="Pending" <?php selected($payment['payment_status'], 'Pending'); ?>>Pending</option>
                            <option value="VALID" <?php selected($payment['payment_status'], 'VALID'); ?>>Valid</option>
                            <option value="Success" <?php selected($payment['payment_status'], 'Success'); ?>>Success</option>
                            <option value="Failed" <?php selected($payment['payment_status'], 'Failed'); ?>>Failed</option>
                            <option value="Cancelled" <?php selected($payment['payment_status'], 'Cancelled'); ?>>Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td><?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($payment['created_at']))); ?></td>
                </tr>
            </table>
            <p>
                <?php submit_button('Update Payment', 'primary', 'edit_payment', false); ?>
                <a href="<?php echo esc_url(admin_url('admin.php?page=sslcommerz-payments')); ?>" class="button">Cancel</a>
            </p>
        </form>
    </div>
</div>
<?php
            return;
        }
    }

    // Display payments table
?>
<div class="wrap sslcommerz-wrap">
    <div style="display: flex ; justify-content: space-between; align-items: center;">
    <h1 class="wp-heading-inline">SSLCommerz Payments</h1>
    
    <!-- Search form -->
    <div class="sslcommerz-search-box">
        <form method="get" action="">
            <input type="hidden" name="page" value="sslcommerz-payments">
            <div class="sslcommerz-search-bar">
                <input type="search" id="payment-search-input" name="s" value="<?php echo esc_attr($search_term); ?>" placeholder="Search transactions, customers, products...">
                <button type="submit" class="button">Search</button>
            </div>
        </form>
    </div>
    </div>
    
    <!-- Payments table -->
    <div class="sslcommerz-table-container">
        <table class="wp-list-table widefat fixed striped sslcommerz-payments-table">
            <thead>
                <tr>
                    <th class="column-transaction">Transaction ID</th>
                    <th class="column-customer">Customer</th>
                    <th class="column-amount">Amount</th>
                    <th class="column-product">Entry Id</th>
                    <th class="column-status">Status</th>
                    <th class="column-date">Date</th>
                    <th class="column-actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($payments)) : ?>
                <tr>
                    <td colspan="7"><?php echo !empty($search_term) ? 'No payments found matching your search.' : 'No payments found.'; ?></td>
                </tr>
                <?php else : ?>
                <?php foreach ($payments as $payment) : ?>
                <tr>
                    <td class="column-transaction"><?php echo esc_html($payment['transaction_id']); ?></td>
                    <td class="column-customer">
                        <?php echo esc_html($payment['customer_name']); ?><br>
                        <small><?php echo esc_html($payment['customer_email']); ?></small>
                        <?php if ($payment['user_id']) : ?>
                        <br><small>User ID: <?php echo esc_html($payment['user_id']); ?></small>
                        <?php endif; ?>
                    </td>
                    <td class="column-amount"><?php echo esc_html($payment['amount'] . ' ' . $payment['currency']); ?></td>
                    <td class="column-product"><?php echo esc_html($payment['entry_id']); ?></td>
                    <td class="column-status">
                        <span class="payment-status status-<?php echo strtolower(esc_attr($payment['payment_status'])); ?>">
                            <?php echo esc_html($payment['payment_status']); ?>
                        </span>
                    </td>
                    <td class="column-date"><?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($payment['created_at']))); ?></td>
                    <td class="column-actions">
                        <div class="action-buttons">
                            <a href="#" class="view-details button button-small" data-id="<?php echo esc_attr($payment['id']); ?>">View</a>
                            <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit', 'id' => $payment['id']), admin_url('admin.php?page=sslcommerz-payments'))); ?>" class="button button-small">Edit</a>
                            <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('action' => 'delete', 'id' => $payment['id']), admin_url('admin.php?page=sslcommerz-payments')), 'delete_payment_' . $payment['id'])); ?>" class="button button-small delete-payment" onclick="return confirm('Are you sure you want to delete this payment record?');">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($total_pages > 1) : ?>
    <div class="sslcommerz-pagination">
        <div class="tablenav">
            <div class="tablenav-pages">
                <span class="displaying-num"><?php echo esc_html($total_payments); ?> items</span>
                <span class="pagination-links">
                    <?php
                    echo paginate_links(array(
                        'base' => add_query_arg(array('paged' => '%#%')),
                        'format' => '',
                        'prev_text' => '<span class="screen-reader-text">Previous page</span><span aria-hidden="true">‹</span>',
                        'next_text' => '<span class="screen-reader-text">Next page</span><span aria-hidden="true">›</span>',
                        'total' => $total_pages,
                        'current' => $page,
                    ));
                    ?>
                </span>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Payment Details Modal -->
<div id="payment-details-modal" class="sslcommerz-modal" style="display: none;">
    <div class="sslcommerz-modal-content">
        <span class="close-modal">&times;</span>
        <h2>Payment Details</h2>
        <div id="payment-details-content">Loading...</div>
    </div>
</div>

<style>
/* General Styles */
.sslcommerz-wrap,
.sslcommerz-settings-wrap {
    padding: 20px 0;
}

.sslcommerz-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 20px;
}

/* Search Box */
.sslcommerz-search-box {
    margin: 20px 0;
    display: flex;
    align-items: center;
}

.sslcommerz-search-bar {
    display: flex;
    max-width: 500px;
    width: 100%;
}

.sslcommerz-search-bar input[type="search"] {
    flex-grow: 1;
    margin-right: 5px;
    border-radius: 4px;
    border: 1px solid #ddd;
    padding: 6px 12px;
}

/* Table Styles */
.sslcommerz-table-container {
    overflow-x: auto;
    margin-bottom: 20px;
}

.sslcommerz-payments-table {
    min-width: 800px;
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.sslcommerz-payments-table th {
    background-color: #f1f1f1;
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    color: #444;
    border-bottom: 1px solid #e2e2e2;
}

.sslcommerz-payments-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #f1f1f1;
    vertical-align: middle;
}

.sslcommerz-payments-table tr:last-child td {
    border-bottom: none;
}

.sslcommerz-payments-table tr:hover {
    background-color: #f9f9f9;
}

/* Column Widths */
.column-transaction {
    width: 15%;
}

.column-customer {
    width: 20%;
}

.column-amount {
    width: 10%;
}

.column-product {
    width: 15%;
}

.column-status {
    width: 10%;
}

.column-date {
    width: 15%;
}

.column-actions {
    width: 15%;
}

/* Status Labels */
.payment-status {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    text-align: center;
    min-width: 80px;
    TEXT-TRANSFORM: UPPERCASE;
}

.status-initiated {
    background-color: #f0f0f0;
    color: #333;
}

.status-pending {
    background-color: #FFF3CD;
    color: #856404;
}

.status-valid {
    background-color: #D4EDDA;
    color: #155724;
}

.status-success {
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

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

.action-buttons .button {
    min-width: 50px;
    text-align: center;
}

/* Modal Styles */
.sslcommerz-modal {
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}

.sslcommerz-modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 25px;
    border: 1px solid #888;
    width: 70%;
    max-width: 700px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    position: relative;
}

.close-modal {
    color: #999;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 15px;
}

.close-modal:hover,
.close-modal:focus {
    color: #555;
    text-decoration: none;
    cursor: pointer;
}

#payment-details-content {
    margin-top: 20px;
}

#payment-details-content table {
    width: 100%;
    border-collapse: collapse;
}

#payment-details-content table th {
    text-align: left;
    width: 30%;
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
    color: #555;
    font-weight: 600;
}

#payment-details-content table td {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
}

/* Pagination */
.sslcommerz-pagination {
    margin-top: 20px;
}

.tablenav-pages {
    float: right;
}

.pagination-links {
    margin-left: 10px;
}

.pagination-links a,
.pagination-links span.current {
    display: inline-block;
    min-width: 28px;
    text-align: center;
    padding: 3px 5px;
    margin: 0 2px;
    border: 1px solid #ddd;
    border-radius: 3px;
    background-color: #f7f7f7;
    font-size: 13px;
    line-height: 1.5;
    text-decoration: none;
}

.pagination-links a:hover {
    background-color: #e5e5e5;
}

.pagination-links span.current {
    border-color: #0073aa;
    background-color: #0073aa;
    color: #fff;
}

/* Responsive Styles */
@media screen and (max-width: 782px) {
    .sslcommerz-search-bar {
        max-width: 100%;
    }
    
    .sslcommerz-modal-content {
        width: 90%;
        margin: 15% auto;
        padding: 15px;
    }
    
    .column-customer,
    .column-product {
        min-width: 150px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .action-buttons .button {
        margin-bottom: 5px;
    }
}
</style>

<script type="text/javascript">
jQuery(document).ready(function($) {
    // View Payment Details
    $('.view-details').on('click', function(e) {
        e.preventDefault();
        var paymentId = $(this).data('id');
        $('#payment-details-modal').show();
        $('#payment-details-content').html('<div style="text-align: center; padding: 20px;"><span class="spinner is-active" style="float: none;"></span> Loading...</div>');
        
        // AJAX call to get payment details
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'get_payment_details',
                payment_id: paymentId,
                nonce: '<?php echo wp_create_nonce('get_payment_details_nonce'); ?>'
            },
            success: function(response) {
                $('#payment-details-content').html(response);
            },
            error: function() {
                $('#payment-details-content').html('<div class="notice notice-error"><p>Error loading payment details. Please try again.</p></div>');
            }
        });
    });

    // Close modal
    $('.close-modal').on('click', function() {
        $('#payment-details-modal').hide();
    });

    // Close modal when clicking outside
    $(window).on('click', function(e) {
        if ($(e.target).is('#payment-details-modal')) {
            $('#payment-details-modal').hide();
        }
    });
    
    // Escape key closes modal
    $(document).keyup(function(e) {
        if (e.key === "Escape") {
            $('#payment-details-modal').hide();
        }
    });
    
    // Make columns sortable (if needed)
    // Add sort functionality here
});
</script>
<?php
}

// AJAX handler for getting payment details
function sslcommerz_get_payment_details() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'get_payment_details_nonce')) {
        wp_send_json_error('Security check failed');
        exit;
    }

    // Get payment details
    if (isset($_POST['payment_id'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'sslcommerz_payments';
        $payment_id = intval($_POST['payment_id']);
        $payment = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $payment_id), ARRAY_A);

        if ($payment) {
            // Prepare response
            $html = '<table>';
            $html .= '<tr><th>Transaction ID</th><td>' . esc_html($payment['transaction_id']) . '</td></tr>';
            $html .= '<tr><th>Customer Name</th><td>' . esc_html($payment['customer_name']) . '</td></tr>';
            $html .= '<tr><th>Customer Email</th><td>' . esc_html($payment['customer_email']) . '</td></tr>';
            if ($payment['user_id']) {
                $html .= '<tr><th>User ID</th><td>' . esc_html($payment['user_id']) . '</td></tr>';
            }
            $html .= '<tr><th>Amount</th><td>' . esc_html($payment['amount'] . ' ' . $payment['currency']) . '</td></tr>';
            $html .= '<tr><th>Product</th><td>' . esc_html($payment['product_name']) . '</td></tr>';
            $html .= '<tr><th>Status</th><td><span class="payment-status status-' . strtolower(esc_attr($payment['payment_status'])) . '">' . esc_html($payment['payment_status']) . '</span></td></tr>';
            $html .= '<tr><th>Date</th><td>' . esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($payment['created_at']))) . '</td></tr>';

            // Add additional data if available (stored in meta fields)
            $meta_data = maybe_unserialize($payment['payment_data']);
            if (is_array($meta_data) && !empty($meta_data)) {
                $html .= '<tr><th colspan="2"><h3>Additional Data</h3></th></tr>';
                foreach ($meta_data as $key => $value) {
                    if (is_array($value) || is_object($value)) {
                        $value = json_encode($value);
                    }
                    $html .= '<tr><th>' . esc_html(ucwords(str_replace('_', ' ', $key))) . '</th><td>' . esc_html($value) . '</td></tr>';
                }
            }
            $html .= '</table>';
            
            $html .= '<div style="margin-top: 20px;" class="action-buttons">';
            $html .= '<a href="' . esc_url(add_query_arg(array('action' => 'edit', 'id' => $payment['id']), admin_url('admin.php?page=sslcommerz-payments'))) . '" class="button">Edit</a> ';
            $html .= '<a href="' . esc_url(wp_nonce_url(add_query_arg(array('action' => 'delete', 'id' => $payment['id']), admin_url('admin.php?page=sslcommerz-payments')), 'delete_payment_' . $payment['id'])) . '" class="button" onclick="return confirm(\'Are you sure you want to delete this payment record?\');">Delete</a>';
            $html .= '</div>';

            echo $html;
            exit;
        } else {
            echo '<div class="notice notice-error"><p>Payment not found.</p></div>';
            exit;
        }
    }
    
    echo '<div class="notice notice-error"><p>Invalid request.</p></div>';
    exit;
}
add_action('wp_ajax_get_payment_details', 'sslcommerz_get_payment_details');

