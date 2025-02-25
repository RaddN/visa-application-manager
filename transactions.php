<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Create a shortcode to display user transactions
function ut_display_user_transactions_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'application_form_id' => '0'
    ), $atts);
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        return '<p>You need to be logged in to view your transactions.</p>';
    }

    global $wpdb;
    $user_id = get_current_user_id();

    // Check if the user_id from GET is a co-traveler of the current user
    $co_traveler_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : '';

    if ($co_traveler_id !== 0) {
        // Perform a database query to check the co-traveler relationship
        $table_name = $wpdb->prefix . 'co_travelers_info';
        $query = $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE co_traveler_id = %d AND user_id = %d",
            $co_traveler_id,
            $user_id
        );

        $count = $wpdb->get_var($query);
    } else {
        $count = 0;
    }


    if (isset($_GET['user_id'])) {
        if (current_user_can('administrator')) {
            $user_id = intval($_GET['user_id']); // Sanitize to ensure it's an integer
        } elseif ($count > 0) {
            $user_id = intval($_GET['user_id']); // Sanitize to ensure it's an integer
        }
    }
    $current_user_id = $user_id; // Get the current user ID

    // Query to get the entries for form ID 17, type "payment", and current user ID
    $results = $wpdb->get_results($wpdb->prepare(
        "SELECT entry_id, fields FROM {$wpdb->prefix}wpforms_entries 
        WHERE form_id = %d AND type = %s AND user_id = %d",
        intval($atts['application_form_id']),
        'payment',
        $current_user_id
    ));

    // Initialize arrays to hold entry IDs and fields
    $entry_ids = [];
    $fields_data = [];

    // Loop through the results to extract entry IDs and fields
    foreach ($results as $row) {
        $entry_ids[] = $row->entry_id;
        $fields_data[] = json_decode($row->fields, true); // Decode the JSON fields
    }

    $table_rows = '';

    foreach ($fields_data as $fields) {
        // Initialize variables to hold extracted values
        $amount = 'N/A';
        $status = 'N/A';
        $payment_method = 'N/A';
    
        // Iterate through the fields to find the necessary values
        foreach ($fields as $field) {
            if ($field['name'] === 'Select VISAThing Services') {
                $amount = isset($field['amount']) ? $field['amount'] : 'N/A'; // Assuming Amount is stored under this name
            } elseif ($field['name'] === 'visacata') {
                $status = $field['value']; // Assuming Status is stored under this name
            } elseif ($field['name'] === 'Stripe Credit Card') {
                $payment_method = $field['value']; // Assuming Payment Method is stored under this name
            }
        }
    
        // Create a table row
        $table_rows .= '<tr>';
        $table_rows .= '<td class="ant-table-cell">' . esc_html($row->entry_id) . '</td>';
        $table_rows .= '<td class="ant-table-cell">Processed</td>';
        $table_rows .= '<td class="ant-table-cell">৳ ' . esc_html($amount) . '</td>';
        $table_rows .= '<td class="ant-table-cell">' . esc_html($payment_method) . '</td>';
        $table_rows .= '<td class="ant-table-cell"></td>'; // Replace with actual action
        $table_rows .= '</tr>';
    }

    ob_start(); ?>
    <?php include 'head.php'; ?>

    <body>
        <div id="__next">
            <main role="main" id="__main" class="__variable_c389b4 font-noto-sans">
                <style>
                    input[type="text"],
                    input[type="number"],
                    input[type="email"],
                    input[type="url"],
                    input[type="password"],
                    input[type="search"],
                    input[type=reset],
                    input[type=tel],
                    input[type=date],
                    select {
                        height: unset;
                    }

                    :where(.css-1588u1j) a {
                        color: #0f0f24;
                        text-decoration: none;
                        background-color: transparent;
                        outline: none;
                        cursor: pointer;
                        transition: color 0.3s;
                        -webkit-text-decoration-skip: objects;
                    }

                    :where(.css-1588u1j) a:hover {
                        color: #2d2e3d;
                    }

                    :where(.css-1588u1j) a:active {
                        color: #000000;
                    }

                    :where(.css-1588u1j) a:active,
                    :where(.css-1588u1j) a:hover {
                        text-decoration: none;
                        outline: 0;
                    }

                    :where(.css-1588u1j) a:focus {
                        text-decoration: none;
                        outline: 0;
                    }

                    :where(.css-1588u1j) a[disabled] {
                        color: rgba(0, 0, 0, 0.25);
                        cursor: not-allowed;
                    }

                    :where(.css-1588u1j).ant-layout {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-layout::before,
                    :where(.css-1588u1j).ant-layout::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-layout [class^="ant-layout"],
                    :where(.css-1588u1j).ant-layout [class*=" ant-layout"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-layout [class^="ant-layout"]::before,
                    :where(.css-1588u1j).ant-layout [class*=" ant-layout"]::before,
                    :where(.css-1588u1j).ant-layout [class^="ant-layout"]::after,
                    :where(.css-1588u1j).ant-layout [class*=" ant-layout"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-layout {
                        display: flex;
                        flex: auto;
                        flex-direction: column;
                        min-height: 0;
                        background: #f5f5f5;
                    }

                    :where(.css-1588u1j).ant-layout,
                    :where(.css-1588u1j).ant-layout * {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-layout.ant-layout-has-sider {
                        flex-direction: row;
                    }

                    :where(.css-1588u1j).ant-layout.ant-layout-has-sider>.ant-layout,
                    :where(.css-1588u1j).ant-layout.ant-layout-has-sider>.ant-layout-content {
                        width: 0;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-header,
                    :where(.css-1588u1j).ant-layout.ant-layout-footer {
                        flex: 0 0 auto;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider {
                        position: relative;
                        min-width: 0;
                        background: #001529;
                        transition: all 0.2s, background 0s;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-children {
                        height: 100%;
                        margin-top: -0.1px;
                        padding-top: 0.1px;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-children .ant-menu.ant-menu-inline-collapsed {
                        width: auto;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-has-trigger {
                        padding-bottom: 48px;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-right {
                        order: 1;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-trigger {
                        position: fixed;
                        bottom: 0;
                        z-index: 1;
                        height: 48px;
                        color: #fff;
                        line-height: 48px;
                        text-align: center;
                        background: #002140;
                        cursor: pointer;
                        transition: all 0.2s;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width>* {
                        overflow: hidden;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width-trigger {
                        position: absolute;
                        top: 64px;
                        inset-inline-end: -40px;
                        z-index: 1;
                        width: 40px;
                        height: 40px;
                        color: #fff;
                        font-size: 20px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: #001529;
                        border-start-start-radius: 0;
                        border-start-end-radius: 6px;
                        border-end-end-radius: 6px;
                        border-end-start-radius: 0;
                        cursor: pointer;
                        transition: background 0.3s ease;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width-trigger::after {
                        position: absolute;
                        inset: 0;
                        background: transparent;
                        transition: all 0.3s;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width-trigger:hover::after {
                        background: rgba(255, 255, 255, 0.2);
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width-trigger-right {
                        inset-inline-start: -40px;
                        border-start-start-radius: 6px;
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                        border-end-start-radius: 6px;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-light {
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-light .ant-layout-sider-trigger {
                        color: rgba(0, 0, 0, 0.88);
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-layout .ant-layout-sider-light .ant-layout-sider-zero-width-trigger {
                        color: rgba(0, 0, 0, 0.88);
                        background: #ffffff;
                        border: 1px solid #f5f5f5;
                        border-inline-start: 0;
                    }

                    :where(.css-1588u1j).ant-layout-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-layout-header {
                        height: 64px;
                        padding: 0 50px;
                        color: rgba(0, 0, 0, 0.88);
                        line-height: 64px;
                        background: #001529;
                    }

                    :where(.css-1588u1j).ant-layout-header .ant-menu {
                        line-height: inherit;
                    }

                    :where(.css-1588u1j).ant-layout-footer {
                        padding: 24px 50px;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        background: #f5f5f5;
                    }

                    :where(.css-1588u1j).ant-layout-content {
                        flex: auto;
                        color: rgba(0, 0, 0, 0.88);
                        min-height: 0;
                    }

                    :where(.css-1588u1j).ant-btn {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-btn::before,
                    :where(.css-1588u1j).ant-btn::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-btn [class^="ant-btn"],
                    :where(.css-1588u1j).ant-btn [class*=" ant-btn"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-btn [class^="ant-btn"]::before,
                    :where(.css-1588u1j).ant-btn [class*=" ant-btn"]::before,
                    :where(.css-1588u1j).ant-btn [class^="ant-btn"]::after,
                    :where(.css-1588u1j).ant-btn [class*=" ant-btn"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-btn {
                        outline: none;
                        position: relative;
                        display: inline-flex;
                        gap: 8px;
                        align-items: center;
                        justify-content: center;
                        font-weight: 400;
                        white-space: nowrap;
                        text-align: center;
                        background-image: none;
                        background: transparent;
                        border: 1px solid transparent;
                        cursor: pointer;
                        transition: all 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
                        user-select: none;
                        touch-action: manipulation;
                        color: rgba(0, 0, 0, 0.88);
                    }

                    :where(.css-1588u1j).ant-btn:disabled>* {
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-btn>span {
                        display: inline-block;
                    }

                    :where(.css-1588u1j).ant-btn .ant-btn-icon {
                        line-height: 1;
                    }

                    :where(.css-1588u1j).ant-btn>a {
                        color: currentColor;
                    }

                    :where(.css-1588u1j).ant-btn:not(:disabled):focus-visible {
                        outline: 4px solid #85868f;
                        outline-offset: 1px;
                        transition: outline-offset 0s, outline 0s;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-two-chinese-chars::first-letter {
                        letter-spacing: 0.34em;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-two-chinese-chars>*:not(.anticon) {
                        margin-inline-end: -0.34em;
                        letter-spacing: 0.34em;
                    }

                    :where(.css-1588u1j).ant-btn-icon-end {
                        flex-direction: row-reverse;
                    }

                    :where(.css-1588u1j).ant-btn {
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        height: 32px;
                        padding: 4px 15px;
                        border-radius: 4px;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-icon-only {
                        width: 32px;
                        padding-inline: 0;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-icon-only.ant-btn-compact-item {
                        flex: none;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-icon-only.ant-btn-round {
                        width: auto;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-icon-only .anticon {
                        font-size: 16px;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-loading {
                        opacity: 0.65;
                        cursor: default;
                    }

                    :where(.css-1588u1j).ant-btn .ant-btn-loading-icon {
                        transition: width 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-circle.ant-btn {
                        min-width: 32px;
                        padding-inline-start: 0;
                        padding-inline-end: 0;
                        border-radius: 50%;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-round.ant-btn {
                        border-radius: 32px;
                        padding-inline-start: 16px;
                        padding-inline-end: 16px;
                    }

                    :where(.css-1588u1j).ant-btn-sm {
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        height: 24px;
                        padding: 0px 7px;
                        border-radius: 4px;
                    }

                    :where(.css-1588u1j).ant-btn-sm.ant-btn-icon-only {
                        width: 24px;
                        padding-inline: 0;
                    }

                    :where(.css-1588u1j).ant-btn-sm.ant-btn-icon-only.ant-btn-compact-item {
                        flex: none;
                    }

                    :where(.css-1588u1j).ant-btn-sm.ant-btn-icon-only.ant-btn-round {
                        width: auto;
                    }

                    :where(.css-1588u1j).ant-btn-sm.ant-btn-icon-only .anticon {
                        font-size: 14px;
                    }

                    :where(.css-1588u1j).ant-btn-sm.ant-btn-loading {
                        opacity: 0.65;
                        cursor: default;
                    }

                    :where(.css-1588u1j).ant-btn-sm .ant-btn-loading-icon {
                        transition: width 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-circle.ant-btn-sm {
                        min-width: 24px;
                        padding-inline-start: 0;
                        padding-inline-end: 0;
                        border-radius: 50%;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-round.ant-btn-sm {
                        border-radius: 24px;
                        padding-inline-start: 12px;
                        padding-inline-end: 12px;
                    }

                    :where(.css-1588u1j).ant-btn-lg {
                        font-size: 16px;
                        line-height: 1.5;
                        height: 40px;
                        padding: 7px 15px;
                        border-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-btn-lg.ant-btn-icon-only {
                        width: 40px;
                        padding-inline: 0;
                    }

                    :where(.css-1588u1j).ant-btn-lg.ant-btn-icon-only.ant-btn-compact-item {
                        flex: none;
                    }

                    :where(.css-1588u1j).ant-btn-lg.ant-btn-icon-only.ant-btn-round {
                        width: auto;
                    }

                    :where(.css-1588u1j).ant-btn-lg.ant-btn-icon-only .anticon {
                        font-size: 18px;
                    }

                    :where(.css-1588u1j).ant-btn-lg.ant-btn-loading {
                        opacity: 0.65;
                        cursor: default;
                    }

                    :where(.css-1588u1j).ant-btn-lg .ant-btn-loading-icon {
                        transition: width 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-circle.ant-btn-lg {
                        min-width: 40px;
                        padding-inline-start: 0;
                        padding-inline-end: 0;
                        border-radius: 50%;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-round.ant-btn-lg {
                        border-radius: 40px;
                        padding-inline-start: 20px;
                        padding-inline-end: 20px;
                    }

                    :where(.css-1588u1j).ant-btn.ant-btn-block {
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-btn-default {
                        background: #ffffff;
                        border-color: #d9d9d9;
                        color: rgba(0, 0, 0, 0.88);
                        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.02);
                    }

                    :where(.css-1588u1j).ant-btn-default:disabled,
                    :where(.css-1588u1j).ant-btn-default.ant-btn-disabled {
                        cursor: not-allowed;
                        border-color: #d9d9d9;
                        color: rgba(0, 0, 0, 0.25);
                        background: rgba(0, 0, 0, 0.04);
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-default:not(:disabled):not(.ant-btn-disabled):hover {
                        color: #484b75;
                        border-color: #484b75;
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-btn-default:not(:disabled):not(.ant-btn-disabled):active {
                        color: #1b1b42;
                        border-color: #1b1b42;
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-background-ghost {
                        color: #ffffff;
                        background: transparent;
                        border-color: #ffffff;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-background-ghost:disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                        border-color: #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous {
                        color: #ff4d4f;
                        border-color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                        color: #ff7875;
                        border-color: #ffa39e;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                        color: #d9363e;
                        border-color: #d9363e;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-background-ghost {
                        color: #ff4d4f;
                        background: transparent;
                        border-color: #ff4d4f;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-background-ghost:disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                        border-color: #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous:disabled,
                    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-disabled {
                        cursor: not-allowed;
                        border-color: #d9d9d9;
                        color: rgba(0, 0, 0, 0.25);
                        background: rgba(0, 0, 0, 0.04);
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-primary {
                        color: #fff;
                        background: #2f3268;
                        box-shadow: 0 2px 0 transparent;
                    }

                    :where(.css-1588u1j).ant-btn-primary:disabled,
                    :where(.css-1588u1j).ant-btn-primary.ant-btn-disabled {
                        cursor: not-allowed;
                        border-color: #d9d9d9;
                        color: rgba(0, 0, 0, 0.25);
                        background: rgba(0, 0, 0, 0.04);
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-primary:not(:disabled):not(.ant-btn-disabled):hover {
                        color: #fff;
                        background: #484b75;
                    }

                    :where(.css-1588u1j).ant-btn-primary:not(:disabled):not(.ant-btn-disabled):active {
                        color: #fff;
                        background: #1b1b42;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-background-ghost {
                        color: #2f3268;
                        background: transparent;
                        border-color: #2f3268;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                        background: transparent;
                        color: #484b75;
                        border-color: #484b75;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                        background: transparent;
                        color: #1b1b42;
                        border-color: #1b1b42;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-background-ghost:disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                        border-color: #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous {
                        background: #ff4d4f;
                        box-shadow: 0 2px 0 rgba(255, 38, 5, 0.06);
                        color: #fff;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                        background: #ff7875;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                        background: #d9363e;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-background-ghost {
                        color: #ff4d4f;
                        background: transparent;
                        border-color: #ff4d4f;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                        background: transparent;
                        color: #ff7875;
                        border-color: #ff7875;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                        background: transparent;
                        color: #d9363e;
                        border-color: #d9363e;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-background-ghost:disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                        border-color: #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous:disabled,
                    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-disabled {
                        cursor: not-allowed;
                        border-color: #d9d9d9;
                        color: rgba(0, 0, 0, 0.25);
                        background: rgba(0, 0, 0, 0.04);
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-dashed {
                        background: #ffffff;
                        border-color: #d9d9d9;
                        color: rgba(0, 0, 0, 0.88);
                        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.02);
                        border-style: dashed;
                    }

                    :where(.css-1588u1j).ant-btn-dashed:disabled,
                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-disabled {
                        cursor: not-allowed;
                        border-color: #d9d9d9;
                        color: rgba(0, 0, 0, 0.25);
                        background: rgba(0, 0, 0, 0.04);
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-dashed:not(:disabled):not(.ant-btn-disabled):hover {
                        color: #484b75;
                        border-color: #484b75;
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-btn-dashed:not(:disabled):not(.ant-btn-disabled):active {
                        color: #1b1b42;
                        border-color: #1b1b42;
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-background-ghost {
                        color: #ffffff;
                        background: transparent;
                        border-color: #ffffff;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-background-ghost:disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                        border-color: #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous {
                        color: #ff4d4f;
                        border-color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                        color: #ff7875;
                        border-color: #ffa39e;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                        color: #d9363e;
                        border-color: #d9363e;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-background-ghost {
                        color: #ff4d4f;
                        background: transparent;
                        border-color: #ff4d4f;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-background-ghost:disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                        border-color: #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous:disabled,
                    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-disabled {
                        cursor: not-allowed;
                        border-color: #d9d9d9;
                        color: rgba(0, 0, 0, 0.25);
                        background: rgba(0, 0, 0, 0.04);
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-link {
                        color: #0f0f24;
                    }

                    :where(.css-1588u1j).ant-btn-link:not(:disabled):not(.ant-btn-disabled):hover {
                        color: #2d2e3d;
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-link:not(:disabled):not(.ant-btn-disabled):active {
                        color: #000000;
                    }

                    :where(.css-1588u1j).ant-btn-link:disabled,
                    :where(.css-1588u1j).ant-btn-link.ant-btn-disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                    }

                    :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                        color: #ff7875;
                    }

                    :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                        color: #d9363e;
                    }

                    :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous:disabled,
                    :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous.ant-btn-disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                    }

                    :where(.css-1588u1j).ant-btn-text:not(:disabled):not(.ant-btn-disabled):hover {
                        color: rgba(0, 0, 0, 0.88);
                        background: rgba(0, 0, 0, 0.06);
                    }

                    :where(.css-1588u1j).ant-btn-text:not(:disabled):not(.ant-btn-disabled):active {
                        color: rgba(0, 0, 0, 0.88);
                        background: rgba(0, 0, 0, 0.15);
                    }

                    :where(.css-1588u1j).ant-btn-text:disabled,
                    :where(.css-1588u1j).ant-btn-text.ant-btn-disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                    }

                    :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous:disabled,
                    :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous.ant-btn-disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                    }

                    :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                        color: #ff7875;
                        background: #fff2f0;
                    }

                    :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                        color: #ff7875;
                        background: #ffccc7;
                    }

                    :where(.css-1588u1j).ant-btn-ghost.ant-btn-background-ghost {
                        color: #ffffff;
                        background: transparent;
                        border-color: #ffffff;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-btn-ghost.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-ghost.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-btn-ghost.ant-btn-background-ghost:disabled {
                        cursor: not-allowed;
                        color: rgba(0, 0, 0, 0.25);
                        border-color: #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-btn-group {
                        position: relative;
                        display: inline-flex;
                    }

                    :where(.css-1588u1j).ant-btn-group>span:not(:last-child),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:last-child),
                    :where(.css-1588u1j).ant-btn-group>span:not(:last-child)>.ant-btn,
                    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:last-child)>.ant-btn {
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-btn-group>span:not(:first-child),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:first-child) {
                        margin-inline-start: -1px;
                    }

                    :where(.css-1588u1j).ant-btn-group>span:not(:first-child),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:first-child),
                    :where(.css-1588u1j).ant-btn-group>span:not(:first-child)>.ant-btn,
                    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:first-child)>.ant-btn {
                        border-start-start-radius: 0;
                        border-end-start-radius: 0;
                    }

                    :where(.css-1588u1j).ant-btn-group .ant-btn {
                        position: relative;
                        z-index: 1;
                    }

                    :where(.css-1588u1j).ant-btn-group .ant-btn:hover,
                    :where(.css-1588u1j).ant-btn-group .ant-btn:focus,
                    :where(.css-1588u1j).ant-btn-group .ant-btn:active {
                        z-index: 2;
                    }

                    :where(.css-1588u1j).ant-btn-group .ant-btn[disabled] {
                        z-index: 0;
                    }

                    :where(.css-1588u1j).ant-btn-group .ant-btn-icon-only {
                        font-size: 14px;
                    }

                    :where(.css-1588u1j).ant-btn-group>span:not(:last-child):not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn-primary:not(:last-child):not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>span:not(:last-child)>.ant-btn-primary:not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn-primary:not(:last-child)>.ant-btn-primary:not(:disabled) {
                        border-inline-end-color: #484b75;
                    }

                    :where(.css-1588u1j).ant-btn-group>span:not(:first-child):not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn-primary:not(:first-child):not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>span:not(:first-child)>.ant-btn-primary:not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn-primary:not(:first-child)>.ant-btn-primary:not(:disabled) {
                        border-inline-start-color: #484b75;
                    }

                    :where(.css-1588u1j).ant-btn-group>span:not(:last-child):not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn-danger:not(:last-child):not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>span:not(:last-child)>.ant-btn-danger:not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn-danger:not(:last-child)>.ant-btn-danger:not(:disabled) {
                        border-inline-end-color: #ff7875;
                    }

                    :where(.css-1588u1j).ant-btn-group>span:not(:first-child):not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn-danger:not(:first-child):not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>span:not(:first-child)>.ant-btn-danger:not(:disabled),
                    :where(.css-1588u1j).ant-btn-group>.ant-btn-danger:not(:first-child)>.ant-btn-danger:not(:disabled) {
                        border-inline-start-color: #ff7875;
                    }

                    :where(.css-1588u1j).ant-wave {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-wave::before,
                    :where(.css-1588u1j).ant-wave::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-wave [class^="ant-wave"],
                    :where(.css-1588u1j).ant-wave [class*=" ant-wave"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-wave [class^="ant-wave"]::before,
                    :where(.css-1588u1j).ant-wave [class*=" ant-wave"]::before,
                    :where(.css-1588u1j).ant-wave [class^="ant-wave"]::after,
                    :where(.css-1588u1j).ant-wave [class*=" ant-wave"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-wave {
                        position: absolute;
                        background: transparent;
                        pointer-events: none;
                        box-sizing: border-box;
                        color: var(--wave-color, #2f3268);
                        box-shadow: 0 0 0 0 currentcolor;
                        opacity: 0.2;
                    }

                    :where(.css-1588u1j).ant-wave.wave-motion-appear {
                        transition: box-shadow 0.4s cubic-bezier(0.08, 0.82, 0.17, 1), opacity 2s cubic-bezier(0.08, 0.82, 0.17, 1);
                    }

                    :where(.css-1588u1j).ant-wave.wave-motion-appear-active {
                        box-shadow: 0 0 0 6px currentcolor;
                        opacity: 0;
                    }

                    :where(.css-1588u1j).ant-wave.wave-motion-appear.wave-quick {
                        transition: box-shadow 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
                    }

                    :where(.css-1588u1j).ant-drawer {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-drawer::before,
                    :where(.css-1588u1j).ant-drawer::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-drawer [class^="ant-drawer"],
                    :where(.css-1588u1j).ant-drawer [class*=" ant-drawer"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-drawer [class^="ant-drawer"]::before,
                    :where(.css-1588u1j).ant-drawer [class*=" ant-drawer"]::before,
                    :where(.css-1588u1j).ant-drawer [class^="ant-drawer"]::after,
                    :where(.css-1588u1j).ant-drawer [class*=" ant-drawer"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-drawer {
                        position: fixed;
                        inset: 0;
                        z-index: 1000;
                        pointer-events: none;
                        color: rgba(0, 0, 0, 0.88);
                    }

                    :where(.css-1588u1j).ant-drawer-pure {
                        position: relative;
                        background: #ffffff;
                        display: flex;
                        flex-direction: column;
                    }

                    :where(.css-1588u1j).ant-drawer-pure.ant-drawer-left {
                        box-shadow: 6px 0 16px 0 rgba(0, 0, 0, 0.08), 3px 0 6px -4px rgba(0, 0, 0, 0.12), 9px 0 28px 8px rgba(0, 0, 0, 0.05);
                    }

                    :where(.css-1588u1j).ant-drawer-pure.ant-drawer-right {
                        box-shadow: -6px 0 16px 0 rgba(0, 0, 0, 0.08), -3px 0 6px -4px rgba(0, 0, 0, 0.12), -9px 0 28px 8px rgba(0, 0, 0, 0.05);
                    }

                    :where(.css-1588u1j).ant-drawer-pure.ant-drawer-top {
                        box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
                    }

                    :where(.css-1588u1j).ant-drawer-pure.ant-drawer-bottom {
                        box-shadow: 0 -6px 16px 0 rgba(0, 0, 0, 0.08), 0 -3px 6px -4px rgba(0, 0, 0, 0.12), 0 -9px 28px 8px rgba(0, 0, 0, 0.05);
                    }

                    :where(.css-1588u1j).ant-drawer-inline {
                        position: absolute;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask {
                        position: absolute;
                        inset: 0;
                        z-index: 1000;
                        background: rgba(0, 0, 0, 0.45);
                        pointer-events: auto;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-content-wrapper {
                        position: absolute;
                        z-index: 1000;
                        max-width: 100vw;
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-content-wrapper-hidden {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-drawer-left>.ant-drawer-content-wrapper {
                        top: 0;
                        bottom: 0;
                        left: 0;
                        box-shadow: 6px 0 16px 0 rgba(0, 0, 0, 0.08), 3px 0 6px -4px rgba(0, 0, 0, 0.12), 9px 0 28px 8px rgba(0, 0, 0, 0.05);
                    }

                    :where(.css-1588u1j).ant-drawer-right>.ant-drawer-content-wrapper {
                        top: 0;
                        right: 0;
                        bottom: 0;
                        box-shadow: -6px 0 16px 0 rgba(0, 0, 0, 0.08), -3px 0 6px -4px rgba(0, 0, 0, 0.12), -9px 0 28px 8px rgba(0, 0, 0, 0.05);
                    }

                    :where(.css-1588u1j).ant-drawer-top>.ant-drawer-content-wrapper {
                        top: 0;
                        inset-inline: 0;
                        box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
                    }

                    :where(.css-1588u1j).ant-drawer-bottom>.ant-drawer-content-wrapper {
                        bottom: 0;
                        inset-inline: 0;
                        box-shadow: 0 -6px 16px 0 rgba(0, 0, 0, 0.08), 0 -3px 6px -4px rgba(0, 0, 0, 0.12), 0 -9px 28px 8px rgba(0, 0, 0, 0.05);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-content {
                        display: flex;
                        flex-direction: column;
                        width: 100%;
                        height: 100%;
                        overflow: auto;
                        background: #ffffff;
                        pointer-events: auto;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-header {
                        display: flex;
                        flex: 0;
                        align-items: center;
                        padding: 16px 24px;
                        font-size: 16px;
                        line-height: 1.5;
                        border-bottom: 1px solid rgba(5, 5, 5, 0.06);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-header-title {
                        display: flex;
                        flex: 1;
                        align-items: center;
                        min-width: 0;
                        min-height: 0;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-extra {
                        flex: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-close {
                        display: inline-flex;
                        width: 24px;
                        height: 24px;
                        border-radius: 4px;
                        justify-content: center;
                        align-items: center;
                        margin-inline-end: 8px;
                        color: rgba(0, 0, 0, 0.45);
                        font-weight: 600;
                        font-size: 16px;
                        font-style: normal;
                        line-height: 1;
                        text-align: center;
                        text-transform: none;
                        text-decoration: none;
                        background: transparent;
                        border: 0;
                        cursor: pointer;
                        transition: all 0.2s;
                        text-rendering: auto;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-close:hover {
                        color: rgba(0, 0, 0, 0.88);
                        background-color: rgba(0, 0, 0, 0.06);
                        text-decoration: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-close:active {
                        background-color: rgba(0, 0, 0, 0.15);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-close:focus-visible {
                        outline: 4px solid #85868f;
                        outline-offset: 1px;
                        transition: outline-offset 0s, outline 0s;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-title {
                        flex: 1;
                        margin: 0;
                        font-weight: 600;
                        font-size: 16px;
                        line-height: 1.5;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-body {
                        flex: 1;
                        min-width: 0;
                        min-height: 0;
                        padding: 24px;
                        overflow: auto;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-body .ant-drawer-body-skeleton {
                        width: 100%;
                        height: 100%;
                        display: flex;
                        justify-content: center;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-footer {
                        flex-shrink: 0;
                        padding: 8px 16px;
                        border-top: 1px solid rgba(5, 5, 5, 0.06);
                    }

                    :where(.css-1588u1j).ant-drawer-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave-start {
                        transition: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave-active {
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear {
                        opacity: 0;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear-active {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave-active {
                        opacity: 0;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-start {
                        transition: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-active {
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear {
                        opacity: 0.7;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-active {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-active {
                        opacity: 0.7;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear {
                        transform: translateX(-100%);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-active {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-active {
                        transform: translateX(-100%);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-start {
                        transition: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-active {
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear {
                        opacity: 0.7;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-active {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-active {
                        opacity: 0.7;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear {
                        transform: translateX(100%);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-active {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-active {
                        transform: translateX(100%);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-start {
                        transition: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-active {
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear {
                        opacity: 0.7;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-active {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-active {
                        opacity: 0.7;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear {
                        transform: translateY(-100%);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-active {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-active {
                        transform: translateY(-100%);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-start,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-start {
                        transition: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-active {
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear {
                        opacity: 0.7;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-active {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-active {
                        opacity: 0.7;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear {
                        transform: translateY(100%);
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-active,
                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-active {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-active {
                        transform: translateY(100%);
                    }

                    :where(.css-1588u1j).ant-space-compact {
                        display: inline-flex;
                    }

                    :where(.css-1588u1j).ant-space-compact-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-space-compact-vertical {
                        flex-direction: column;
                    }

                    :where(.css-1588u1j).ant-space-compact-align {
                        flex-direction: column;
                    }

                    :where(.css-1588u1j).ant-space-compact-align-center {
                        align-items: center;
                    }

                    :where(.css-1588u1j).ant-space-compact-align-start {
                        align-items: flex-start;
                    }

                    :where(.css-1588u1j).ant-space-compact-align-end {
                        align-items: flex-end;
                    }

                    :where(.css-1588u1j).ant-space-compact-align-baseline {
                        align-items: baseline;
                    }

                    :where(.css-1588u1j).ant-space-compact .ant-space-compact-item:empty {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-space-compact .ant-space-compact-item>.ant-badge-not-a-wrapper:only-child {
                        display: block;
                    }

                    :where(.css-1588u1j).ant-space-compact-gap-row-small {
                        row-gap: 8px;
                    }

                    :where(.css-1588u1j).ant-space-compact-gap-row-middle {
                        row-gap: 16px;
                    }

                    :where(.css-1588u1j).ant-space-compact-gap-row-large {
                        row-gap: 24px;
                    }

                    :where(.css-1588u1j).ant-space-compact-gap-col-small {
                        column-gap: 8px;
                    }

                    :where(.css-1588u1j).ant-space-compact-gap-col-middle {
                        column-gap: 16px;
                    }

                    :where(.css-1588u1j).ant-space-compact-gap-col-large {
                        column-gap: 24px;
                    }

                    :where(.css-1588u1j).ant-space-compact-block {
                        display: flex;
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-space-compact-vertical {
                        flex-direction: column;
                    }

                    :where(.css-1588u1j)[class^="ant-input"],
                    :where(.css-1588u1j)[class*=" ant-input"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-input"]::before,
                    :where(.css-1588u1j)[class*=" ant-input"]::before,
                    :where(.css-1588u1j)[class^="ant-input"]::after,
                    :where(.css-1588u1j)[class*=" ant-input"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"],
                    :where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"],
                    :where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"],
                    :where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"]::before,
                    :where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"]::before,
                    :where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"]::before,
                    :where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"]::before,
                    :where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"]::after,
                    :where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"]::after,
                    :where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"]::after,
                    :where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-input {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 4px 11px;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                        position: relative;
                        display: inline-block;
                        width: 100%;
                        min-width: 0;
                        border-radius: 6px;
                        transition: all 0.2s;
                    }

                    :where(.css-1588u1j).ant-input::-moz-placeholder {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-input::placeholder {
                        color: rgba(0, 0, 0, 0.25);
                        user-select: none;
                    }

                    :where(.css-1588u1j).ant-input:placeholder-shown {
                        text-overflow: ellipsis;
                    }

                    textarea:where(.css-1588u1j).ant-input {
                        max-width: 100%;
                        height: auto;
                        min-height: 32px;
                        line-height: 1.5714285714285714;
                        vertical-align: bottom;
                        transition: all 0.3s, height 0s;
                        resize: vertical;
                    }

                    :where(.css-1588u1j).ant-input-lg {
                        padding: 7px 11px;
                        font-size: 16px;
                        line-height: 1.5;
                        border-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-input-sm {
                        padding: 0px 7px;
                        font-size: 14px;
                        border-radius: 4px;
                    }

                    :where(.css-1588u1j).ant-input-rtl,
                    :where(.css-1588u1j).ant-input-textarea-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-input-outlined {
                        background: #ffffff;
                        border-width: 1px;
                        border-style: solid;
                        border-color: #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-input-outlined:hover {
                        border-color: #484b75;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-input-outlined:focus,
                    :where(.css-1588u1j).ant-input-outlined:focus-within {
                        border-color: #2f3268;
                        box-shadow: 0 0 0 2px transparent;
                        outline: 0;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-disabled,
                    :where(.css-1588u1j).ant-input-outlined[disabled] {
                        color: rgba(0, 0, 0, 0.25);
                        background-color: rgba(0, 0, 0, 0.04);
                        border-color: #d9d9d9;
                        box-shadow: none;
                        cursor: not-allowed;
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-disabled input[disabled],
                    :where(.css-1588u1j).ant-input-outlined[disabled] input[disabled],
                    :where(.css-1588u1j).ant-input-outlined.ant-input-disabled textarea[disabled],
                    :where(.css-1588u1j).ant-input-outlined[disabled] textarea[disabled] {
                        cursor: not-allowed;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-disabled:hover:not([disabled]),
                    :where(.css-1588u1j).ant-input-outlined[disabled]:hover:not([disabled]) {
                        border-color: #d9d9d9;
                        background-color: rgba(0, 0, 0, 0.04);
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) {
                        background: #ffffff;
                        border-width: 1px;
                        border-style: solid;
                        border-color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):hover {
                        border-color: #ffa39e;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):focus,
                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):focus-within {
                        border-color: #ff4d4f;
                        box-shadow: 0 0 0 2px rgba(255, 38, 5, 0.06);
                        outline: 0;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) .ant-input-prefix,
                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) .ant-input-suffix {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error.ant-input-disabled {
                        border-color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) {
                        background: #ffffff;
                        border-width: 1px;
                        border-style: solid;
                        border-color: #faad14;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):hover {
                        border-color: #ffd666;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):focus,
                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):focus-within {
                        border-color: #faad14;
                        box-shadow: 0 0 0 2px rgba(255, 215, 5, 0.1);
                        outline: 0;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) .ant-input-prefix,
                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) .ant-input-suffix {
                        color: #faad14;
                    }

                    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning.ant-input-disabled {
                        border-color: #faad14;
                    }

                    :where(.css-1588u1j).ant-input-filled {
                        background: rgba(0, 0, 0, 0.04);
                        border-width: 1px;
                        border-style: solid;
                        border-color: transparent;
                    }

                    input:where(.css-1588u1j).ant-input-filled,
                    :where(.css-1588u1j).ant-input-filled input,
                    textarea:where(.css-1588u1j).ant-input-filled,
                    :where(.css-1588u1j).ant-input-filled textarea {
                        color: undefined;
                    }

                    :where(.css-1588u1j).ant-input-filled:hover {
                        background: rgba(0, 0, 0, 0.06);
                    }

                    :where(.css-1588u1j).ant-input-filled:focus,
                    :where(.css-1588u1j).ant-input-filled:focus-within {
                        outline: 0;
                        border-color: #2f3268;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-disabled,
                    :where(.css-1588u1j).ant-input-filled[disabled] {
                        color: rgba(0, 0, 0, 0.25);
                        background-color: rgba(0, 0, 0, 0.04);
                        border-color: #d9d9d9;
                        box-shadow: none;
                        cursor: not-allowed;
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-disabled input[disabled],
                    :where(.css-1588u1j).ant-input-filled[disabled] input[disabled],
                    :where(.css-1588u1j).ant-input-filled.ant-input-disabled textarea[disabled],
                    :where(.css-1588u1j).ant-input-filled[disabled] textarea[disabled] {
                        cursor: not-allowed;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-disabled:hover:not([disabled]),
                    :where(.css-1588u1j).ant-input-filled[disabled]:hover:not([disabled]) {
                        border-color: #d9d9d9;
                        background-color: rgba(0, 0, 0, 0.04);
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) {
                        background: #fff2f0;
                        border-width: 1px;
                        border-style: solid;
                        border-color: transparent;
                    }

                    input:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled),
                    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) input,
                    textarea:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled),
                    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) textarea {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):hover {
                        background: #fff1f0;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):focus,
                    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):focus-within {
                        outline: 0;
                        border-color: #ff4d4f;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) .ant-input-prefix,
                    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) .ant-input-suffix {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) {
                        background: #fffbe6;
                        border-width: 1px;
                        border-style: solid;
                        border-color: transparent;
                    }

                    input:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled),
                    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) input,
                    textarea:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled),
                    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) textarea {
                        color: #faad14;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):hover {
                        background: #fff1b8;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):focus,
                    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):focus-within {
                        outline: 0;
                        border-color: #faad14;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) .ant-input-prefix,
                    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) .ant-input-suffix {
                        color: #faad14;
                    }

                    :where(.css-1588u1j).ant-input-borderless {
                        background: transparent;
                        border: none;
                    }

                    :where(.css-1588u1j).ant-input-borderless:focus,
                    :where(.css-1588u1j).ant-input-borderless:focus-within {
                        outline: none;
                    }

                    :where(.css-1588u1j).ant-input-borderless.ant-input-disabled,
                    :where(.css-1588u1j).ant-input-borderless[disabled] {
                        color: rgba(0, 0, 0, 0.25);
                    }

                    :where(.css-1588u1j).ant-input-borderless.ant-input-status-error,
                    :where(.css-1588u1j).ant-input-borderless.ant-input-status-error input,
                    :where(.css-1588u1j).ant-input-borderless.ant-input-status-error textarea {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-input-borderless.ant-input-status-warning,
                    :where(.css-1588u1j).ant-input-borderless.ant-input-status-warning input,
                    :where(.css-1588u1j).ant-input-borderless.ant-input-status-warning textarea {
                        color: #faad14;
                    }

                    :where(.css-1588u1j).ant-input[type="color"] {
                        height: 32px;
                    }

                    :where(.css-1588u1j).ant-input[type="color"].ant-input-lg {
                        height: 40px;
                    }

                    :where(.css-1588u1j).ant-input[type="color"].ant-input-sm {
                        height: 24px;
                        padding-top: 3px;
                        padding-bottom: 3px;
                    }

                    :where(.css-1588u1j).ant-input[type="search"]::-webkit-search-cancel-button,
                    :where(.css-1588u1j).ant-input[type="search"]::-webkit-search-decoration {
                        -webkit-appearance: none;
                    }

                    :where(.css-1588u1j).ant-input-textarea {
                        position: relative;
                    }

                    :where(.css-1588u1j).ant-input-textarea-show-count>.ant-input {
                        height: 100%;
                    }

                    :where(.css-1588u1j).ant-input-textarea-show-count .ant-input-data-count {
                        position: absolute;
                        bottom: -22px;
                        inset-inline-end: 0;
                        color: rgba(0, 0, 0, 0.45);
                        white-space: nowrap;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-input-textarea-allow-clear>.ant-input,
                    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-textarea-has-feedback .ant-input {
                        padding-inline-end: 24px;
                    }

                    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper {
                        padding: 0;
                    }

                    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper>textarea.ant-input {
                        font-size: inherit;
                        border: none;
                        outline: none;
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper>textarea.ant-input:focus {
                        box-shadow: none !important;
                    }

                    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix {
                        margin: 0;
                    }

                    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix>*:not(:last-child) {
                        margin-inline: 0;
                    }

                    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix .ant-input-clear-icon {
                        position: absolute;
                        inset-inline-end: 11px;
                        inset-block-start: 8px;
                    }

                    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix .ant-input-textarea-suffix {
                        position: absolute;
                        top: 0;
                        inset-inline-end: 11px;
                        bottom: 0;
                        z-index: 1;
                        display: inline-flex;
                        align-items: center;
                        margin: auto;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper-sm .ant-input-suffix .ant-input-clear-icon {
                        inset-inline-end: 7px;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper {
                        position: relative;
                        display: inline-flex;
                        width: 100%;
                        min-width: 0;
                        padding: 4px 11px;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        border-radius: 6px;
                        transition: all 0.2s;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper::-moz-placeholder {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper::placeholder {
                        color: rgba(0, 0, 0, 0.25);
                        user-select: none;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper:placeholder-shown {
                        text-overflow: ellipsis;
                    }

                    textarea:where(.css-1588u1j).ant-input-affix-wrapper {
                        max-width: 100%;
                        height: auto;
                        min-height: 32px;
                        line-height: 1.5714285714285714;
                        vertical-align: bottom;
                        transition: all 0.3s, height 0s;
                        resize: vertical;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper-lg {
                        padding: 7px 11px;
                        font-size: 16px;
                        line-height: 1.5;
                        border-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper-sm {
                        padding: 0px 7px;
                        font-size: 14px;
                        border-radius: 4px;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper-rtl,
                    :where(.css-1588u1j).ant-input-affix-wrapper-textarea-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper:not(.ant-input-disabled):hover {
                        z-index: 1;
                    }

                    .ant-input-search-with-button :where(.css-1588u1j).ant-input-affix-wrapper:not(.ant-input-disabled):hover {
                        z-index: 0;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper-focused,
                    :where(.css-1588u1j).ant-input-affix-wrapper:focus {
                        z-index: 1;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper>input.ant-input {
                        padding: 0;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper>input.ant-input,
                    :where(.css-1588u1j).ant-input-affix-wrapper>textarea.ant-input {
                        font-size: inherit;
                        border: none;
                        border-radius: 0;
                        outline: none;
                        background: transparent;
                        color: inherit;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper>input.ant-input::-ms-reveal,
                    :where(.css-1588u1j).ant-input-affix-wrapper>textarea.ant-input::-ms-reveal {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper>input.ant-input:focus,
                    :where(.css-1588u1j).ant-input-affix-wrapper>textarea.ant-input:focus {
                        box-shadow: none !important;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper::before {
                        display: inline-block;
                        width: 0;
                        visibility: hidden;
                        content: "\a0";
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix,
                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix {
                        display: flex;
                        flex: none;
                        align-items: center;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix>*:not(:last-child),
                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix>*:not(:last-child) {
                        margin-inline-end: 8px;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-show-count-suffix {
                        color: rgba(0, 0, 0, 0.45);
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-show-count-has-suffix {
                        margin-inline-end: 4px;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix {
                        margin-inline-end: 4px;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix {
                        margin-inline-start: 4px;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon {
                        margin: 0;
                        color: rgba(0, 0, 0, 0.25);
                        font-size: 12px;
                        vertical-align: -1px;
                        cursor: pointer;
                        transition: color 0.3s;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon:hover {
                        color: rgba(0, 0, 0, 0.45);
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon:active {
                        color: rgba(0, 0, 0, 0.88);
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon-hidden {
                        visibility: hidden;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon-has-suffix {
                        margin: 0 4px;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .anticon.ant-input-password-icon {
                        color: rgba(0, 0, 0, 0.45);
                        cursor: pointer;
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-input-affix-wrapper .anticon.ant-input-password-icon:hover {
                        color: rgba(0, 0, 0, 0.88);
                    }

                    :where(.css-1588u1j).ant-input-group {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                        position: relative;
                        display: table;
                        width: 100%;
                        border-collapse: separate;
                        border-spacing: 0;
                    }

                    :where(.css-1588u1j).ant-input-group[class*='col-'] {
                        padding-inline-end: 8px;
                    }

                    :where(.css-1588u1j).ant-input-group[class*='col-']:last-child {
                        padding-inline-end: 0;
                    }

                    :where(.css-1588u1j).ant-input-group-lg .ant-input,
                    :where(.css-1588u1j).ant-input-group-lg>.ant-input-group-addon {
                        padding: 7px 11px;
                        font-size: 16px;
                        line-height: 1.5;
                        border-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-input-group-sm .ant-input,
                    :where(.css-1588u1j).ant-input-group-sm>.ant-input-group-addon {
                        padding: 0px 7px;
                        font-size: 14px;
                        border-radius: 4px;
                    }

                    :where(.css-1588u1j).ant-input-group-lg .ant-select-single .ant-select-selector {
                        height: 40px;
                    }

                    :where(.css-1588u1j).ant-input-group-sm .ant-select-single .ant-select-selector {
                        height: 24px;
                    }

                    :where(.css-1588u1j).ant-input-group>.ant-input {
                        display: table-cell;
                    }

                    :where(.css-1588u1j).ant-input-group>.ant-input:not(:first-child):not(:last-child) {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon,
                    :where(.css-1588u1j).ant-input-group .ant-input-group-wrap {
                        display: table-cell;
                        width: 1px;
                        white-space: nowrap;
                        vertical-align: middle;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:not(:first-child):not(:last-child),
                    :where(.css-1588u1j).ant-input-group .ant-input-group-wrap:not(:first-child):not(:last-child) {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-group-wrap>* {
                        display: block !important;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon {
                        position: relative;
                        padding: 0 11px;
                        color: rgba(0, 0, 0, 0.88);
                        font-weight: normal;
                        font-size: 14px;
                        text-align: center;
                        border-radius: 6px;
                        transition: all 0.3s;
                        line-height: 1;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select {
                        margin: -5px -11px;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select.ant-select-single:not(.ant-select-customize-input):not(.ant-pagination-size-changer) .ant-select-selector {
                        background-color: inherit;
                        border: 1px solid transparent;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select-open .ant-select-selector,
                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select-focused .ant-select-selector {
                        color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-cascader-picker {
                        margin: -9px -11px;
                        background-color: transparent;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-cascader-picker .ant-cascader-input {
                        text-align: start;
                        border: 0;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input {
                        width: 100%;
                        margin-bottom: 0;
                        text-align: inherit;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input:focus {
                        z-index: 1;
                        border-inline-end-width: 1px;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input:hover {
                        z-index: 1;
                        border-inline-end-width: 1px;
                    }

                    .ant-input-search-with-button :where(.css-1588u1j).ant-input-group .ant-input:hover {
                        z-index: 0;
                    }

                    :where(.css-1588u1j).ant-input-group>.ant-input:first-child,
                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:first-child {
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group>.ant-input:first-child .ant-select .ant-select-selector,
                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:first-child .ant-select .ant-select-selector {
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group>.ant-input-affix-wrapper:not(:first-child) .ant-input {
                        border-start-start-radius: 0;
                        border-end-start-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group>.ant-input-affix-wrapper:not(:last-child) .ant-input {
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group>.ant-input:last-child,
                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:last-child {
                        border-start-start-radius: 0;
                        border-end-start-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group>.ant-input:last-child .ant-select .ant-select-selector,
                    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:last-child .ant-select .ant-select-selector {
                        border-start-start-radius: 0;
                        border-end-start-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:last-child) {
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                    }

                    .ant-input-search :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:last-child) {
                        border-start-start-radius: 6px;
                        border-end-start-radius: 6px;
                    }

                    :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:first-child),
                    .ant-input-search :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:first-child) {
                        border-start-start-radius: 0;
                        border-end-start-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact {
                        display: block;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact::before {
                        display: table;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact::after {
                        display: table;
                        clear: both;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child),
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child),
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input:not(:first-child):not(:last-child) {
                        border-inline-end-width: 1px;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child):hover,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child):hover,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input:not(:first-child):not(:last-child):hover,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child):focus,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child):focus,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input:not(:first-child):not(:last-child):focus {
                        z-index: 1;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>* {
                        display: inline-flex;
                        float: none;
                        vertical-align: top;
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-affix-wrapper,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-number-affix-wrapper,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-picker-range {
                        display: inline-flex;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:not(:last-child) {
                        margin-inline-end: -1px;
                        border-inline-end-width: 1px;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input {
                        float: none;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input {
                        border-inline-end-width: 1px;
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector:hover,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input:hover,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input:hover,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input:hover,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector:focus,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input:focus,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input:focus,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input:focus {
                        z-index: 1;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-focused {
                        z-index: 1;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-arrow {
                        z-index: 1;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:first-child,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select:first-child>.ant-select-selector,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete:first-child .ant-input,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker:first-child .ant-input {
                        border-start-start-radius: 6px;
                        border-end-start-radius: 6px;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:last-child,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select:last-child>.ant-select-selector,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker:last-child .ant-input,
                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker-focused:last-child .ant-input {
                        border-inline-end-width: 1px;
                        border-start-end-radius: 6px;
                        border-end-end-radius: 6px;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input {
                        vertical-align: top;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper+.ant-input-group-wrapper {
                        margin-inline-start: -1px;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper+.ant-input-group-wrapper .ant-input-affix-wrapper {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper:not(:last-child).ant-input-search>.ant-input-group>.ant-input-group-addon>.ant-input-search-button {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper:not(:last-child).ant-input-search>.ant-input-group>.ant-input {
                        border-start-start-radius: 6px;
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                        border-end-start-radius: 6px;
                    }

                    :where(.css-1588u1j).ant-input-group-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper {
                        display: inline-block;
                        width: 100%;
                        text-align: start;
                        vertical-align: top;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-lg .ant-input-group-addon {
                        border-radius: 8px;
                        font-size: 16px;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-sm .ant-input-group-addon {
                        border-radius: 4px;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon {
                        background: rgba(0, 0, 0, 0.02);
                        border: 1px solid #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon:first-child {
                        border-inline-end: 0;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon:last-child {
                        border-inline-start: 0;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-status-error .ant-input-group-addon {
                        border-color: #ff4d4f;
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-status-warning .ant-input-group-addon {
                        border-color: #faad14;
                        color: #faad14;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon {
                        color: rgba(0, 0, 0, 0.25);
                        background-color: rgba(0, 0, 0, 0.04);
                        border-color: #d9d9d9;
                        box-shadow: none;
                        cursor: not-allowed;
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon input[disabled],
                    :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon textarea[disabled] {
                        cursor: not-allowed;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon:hover:not([disabled]) {
                        border-color: #d9d9d9;
                        background-color: rgba(0, 0, 0, 0.04);
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group-addon {
                        background: rgba(0, 0, 0, 0.04);
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group .ant-input-filled:not(:focus):not(:focus-within):not(:first-child) {
                        border-inline-start: 1px solid rgba(5, 5, 5, 0.06);
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group .ant-input-filled:not(:focus):not(:focus-within):not(:last-child) {
                        border-inline-end: 1px solid rgba(5, 5, 5, 0.06);
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-status-error .ant-input-group-addon {
                        background: #fff2f0;
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-status-warning .ant-input-group-addon {
                        background: #fffbe6;
                        color: #faad14;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon {
                        background: rgba(0, 0, 0, 0.04);
                        color: rgba(0, 0, 0, 0.25);
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon:first-child {
                        border-inline-start: 1px solid #d9d9d9;
                        border-top: 1px solid #d9d9d9;
                        border-bottom: 1px solid #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon:last-child {
                        border-inline-end: 1px solid #d9d9d9;
                        border-top: 1px solid #d9d9d9;
                        border-bottom: 1px solid #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item).ant-input-compact-item .ant-input,
                    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item).ant-input-compact-item .ant-input-group-addon {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-first-item .ant-input,
                    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-first-item .ant-input-group-addon {
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item).ant-input-compact-last-item .ant-input,
                    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item).ant-input-compact-last-item .ant-input-group-addon {
                        border-start-start-radius: 0;
                        border-end-start-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-item .ant-input-affix-wrapper {
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-search .ant-input:hover,
                    :where(.css-1588u1j).ant-input-search .ant-input:focus {
                        border-color: #484b75;
                    }

                    :where(.css-1588u1j).ant-input-search .ant-input:hover+.ant-input-group-addon .ant-input-search-button:not(.ant-btn-primary),
                    :where(.css-1588u1j).ant-input-search .ant-input:focus+.ant-input-group-addon .ant-input-search-button:not(.ant-btn-primary) {
                        border-inline-start-color: #484b75;
                    }

                    :where(.css-1588u1j).ant-input-search .ant-input-affix-wrapper {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-search .ant-input-lg {
                        line-height: 1.4998;
                    }

                    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child {
                        inset-inline-start: -1px;
                        padding: 0;
                        border: 0;
                    }

                    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button {
                        margin-inline-end: -1px;
                        padding-top: 0;
                        padding-bottom: 0;
                        border-start-start-radius: 0;
                        border-start-end-radius: 6px;
                        border-end-end-radius: 6px;
                        border-end-start-radius: 0;
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary) {
                        color: rgba(0, 0, 0, 0.45);
                    }

                    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary):hover {
                        color: #484b75;
                    }

                    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary):active {
                        color: #1b1b42;
                    }

                    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary).ant-btn-loading::before {
                        inset-inline-start: 0;
                        inset-inline-end: 0;
                        inset-block-start: 0;
                        inset-block-end: 0;
                    }

                    :where(.css-1588u1j).ant-input-search .ant-input-search-button {
                        height: 32px;
                    }

                    :where(.css-1588u1j).ant-input-search .ant-input-search-button:hover,
                    :where(.css-1588u1j).ant-input-search .ant-input-search-button:focus {
                        z-index: 1;
                    }

                    :where(.css-1588u1j).ant-input-search-large .ant-input-search-button {
                        height: 40px;
                    }

                    :where(.css-1588u1j).ant-input-search-small .ant-input-search-button {
                        height: 24px;
                    }

                    :where(.css-1588u1j).ant-input-search-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-last-item) .ant-input-group-addon .ant-input-search-button {
                        margin-inline-end: -1px;
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-first-item) .ant-input,
                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-first-item) .ant-input-affix-wrapper {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input-group-addon .ant-input-search-button:hover,
                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input:hover,
                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:hover,
                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input-group-addon .ant-input-search-button:focus,
                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input:focus,
                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:focus,
                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input-group-addon .ant-input-search-button:active,
                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input:active,
                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:active {
                        z-index: 2;
                    }

                    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input-affix-wrapper-focused {
                        z-index: 2;
                    }

                    :where(.css-1588u1j).ant-input-out-of-range,
                    :where(.css-1588u1j).ant-input-out-of-range input,
                    :where(.css-1588u1j).ant-input-out-of-range textarea,
                    :where(.css-1588u1j).ant-input-out-of-range .ant-input-show-count-suffix,
                    :where(.css-1588u1j).ant-input-out-of-range .ant-input-data-count {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item) {
                        margin-inline-end: -1px;
                    }

                    :where(.css-1588u1j).ant-input-compact-item:hover,
                    :where(.css-1588u1j).ant-input-compact-item:focus,
                    :where(.css-1588u1j).ant-input-compact-item:active {
                        z-index: 2;
                    }

                    :where(.css-1588u1j).ant-input-compact-item[disabled] {
                        z-index: 0;
                    }

                    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item) {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item,
                    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item.ant-input-sm,
                    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item.ant-input-lg {
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item,
                    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item.ant-input-sm,
                    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item.ant-input-lg {
                        border-start-start-radius: 0;
                        border-end-start-radius: 0;
                    }

                    :where(.css-1588u1j)[class^="ant-table"],
                    :where(.css-1588u1j)[class*=" ant-table"] {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-table"]::before,
                    :where(.css-1588u1j)[class*=" ant-table"]::before,
                    :where(.css-1588u1j)[class^="ant-table"]::after,
                    :where(.css-1588u1j)[class*=" ant-table"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-table"] [class^="ant-table"],
                    :where(.css-1588u1j)[class*=" ant-table"] [class^="ant-table"],
                    :where(.css-1588u1j)[class^="ant-table"] [class*=" ant-table"],
                    :where(.css-1588u1j)[class*=" ant-table"] [class*=" ant-table"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-table"] [class^="ant-table"]::before,
                    :where(.css-1588u1j)[class*=" ant-table"] [class^="ant-table"]::before,
                    :where(.css-1588u1j)[class^="ant-table"] [class*=" ant-table"]::before,
                    :where(.css-1588u1j)[class*=" ant-table"] [class*=" ant-table"]::before,
                    :where(.css-1588u1j)[class^="ant-table"] [class^="ant-table"]::after,
                    :where(.css-1588u1j)[class*=" ant-table"] [class^="ant-table"]::after,
                    :where(.css-1588u1j)[class^="ant-table"] [class*=" ant-table"]::after,
                    :where(.css-1588u1j)[class*=" ant-table"] [class*=" ant-table"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-table-wrapper {
                        clear: both;
                        max-width: 100%;
                    }

                    :where(.css-1588u1j).ant-table-wrapper::before {
                        display: table;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-table-wrapper::after {
                        display: table;
                        clear: both;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                        background: #ffffff;
                        border-radius: 8px 8px 0 0;
                        scrollbar-color: rgba(0, 0, 0, 0.25) rgba(5, 5, 5, 0.06);
                    }

                    :where(.css-1588u1j).ant-table-wrapper table {
                        width: 100%;
                        text-align: start;
                        border-radius: 8px 8px 0 0;
                        border-collapse: separate;
                        border-spacing: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper tfoot>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper tfoot>tr>td {
                        position: relative;
                        padding: 16px 16px;
                        overflow-wrap: break-word;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-title {
                        padding: 16px 16px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead>tr>td {
                        position: relative;
                        color: rgba(0, 0, 0, 0.88);
                        font-weight: 600;
                        text-align: start;
                        background: #fafafa;
                        border-bottom: 1px solid #f0f0f0;
                        transition: background 0.2s ease;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead>tr>th[colspan]:not([colspan='1']),
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead>tr>td[colspan]:not([colspan='1']) {
                        text-align: center;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead>tr>th:not(:last-child):not(.ant-table-selection-column):not(.ant-table-row-expand-icon-cell):not([colspan])::before,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead>tr>td:not(:last-child):not(.ant-table-selection-column):not(.ant-table-row-expand-icon-cell):not([colspan])::before {
                        position: absolute;
                        top: 50%;
                        inset-inline-end: 0;
                        width: 1px;
                        height: 1.6em;
                        background-color: #f0f0f0;
                        transform: translateY(-50%);
                        transition: background-color 0.2s;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead>tr:not(:last-child)>th[colspan] {
                        border-bottom: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td {
                        transition: background 0.2s, border-color 0.2s;
                        border-bottom: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th>.ant-table-wrapper:only-child .ant-table,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td>.ant-table-wrapper:only-child .ant-table,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th>.ant-table-expanded-row-fixed>.ant-table-wrapper:only-child .ant-table,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td>.ant-table-expanded-row-fixed>.ant-table-wrapper:only-child .ant-table {
                        margin-block: -16px;
                        margin-inline: 32px -16px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th>.ant-table-expanded-row-fixed>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td>.ant-table-expanded-row-fixed>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td {
                        border-bottom: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td:first-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td:first-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th>.ant-table-expanded-row-fixed>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td:first-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td>.ant-table-expanded-row-fixed>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td:first-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td:last-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td:last-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th>.ant-table-expanded-row-fixed>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td:last-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>td>.ant-table-expanded-row-fixed>.ant-table-wrapper:only-child .ant-table .ant-table-tbody>tr:last-child>td:last-child {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr>th {
                        position: relative;
                        color: rgba(0, 0, 0, 0.88);
                        font-weight: 600;
                        text-align: start;
                        background: #fafafa;
                        border-bottom: 1px solid #f0f0f0;
                        transition: background 0.2s ease;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-footer {
                        padding: 16px 16px;
                        color: rgba(0, 0, 0, 0.88);
                        background: #fafafa;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-pagination.ant-pagination {
                        margin: 16px 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-pagination {
                        display: flex;
                        flex-wrap: wrap;
                        row-gap: 8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-pagination>* {
                        flex: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-pagination-left {
                        justify-content: flex-start;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-pagination-center {
                        justify-content: center;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-pagination-right {
                        justify-content: flex-end;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-summary {
                        position: relative;
                        z-index: 2;
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-summary>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-summary>tr>td {
                        border-bottom: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper div.ant-table-summary {
                        box-shadow: 0 -1px 0 #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead th.ant-table-column-has-sorters {
                        outline: none;
                        cursor: pointer;
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead th.ant-table-column-has-sorters:hover {
                        background: #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead th.ant-table-column-has-sorters:hover::before {
                        background-color: transparent !important;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead th.ant-table-column-has-sorters:focus-visible {
                        color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead th.ant-table-column-has-sorters.ant-table-cell-fix-left:hover,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead th.ant-table-column-has-sorters.ant-table-cell-fix-right:hover {
                        background: #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead th.ant-table-column-sort {
                        background: #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-thead th.ant-table-column-sort::before {
                        background-color: transparent !important;
                    }

                    :where(.css-1588u1j).ant-table-wrapper td.ant-table-column-sort {
                        background: #fafafa;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-title {
                        position: relative;
                        z-index: 1;
                        flex: 1;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorters {
                        display: flex;
                        flex: auto;
                        align-items: center;
                        justify-content: space-between;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorters::after {
                        position: absolute;
                        inset: 0;
                        width: 100%;
                        height: 100%;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorters-tooltip-target-sorter::after {
                        content: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorter {
                        margin-inline-start: 4px;
                        color: rgba(0, 0, 0, 0.29);
                        font-size: 0;
                        transition: color 0.3s;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorter-inner {
                        display: inline-flex;
                        flex-direction: column;
                        align-items: center;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorter-up,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorter-down {
                        font-size: 12px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorter-up.active,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorter-down.active {
                        color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorter .ant-table-column-sorter-up+.ant-table-column-sorter-down {
                        margin-top: -0.3em;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-column-sorters:hover .ant-table-column-sorter {
                        color: rgba(0, 0, 0, 0.57);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-filter-column {
                        display: flex;
                        justify-content: space-between;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-filter-trigger {
                        position: relative;
                        display: flex;
                        align-items: center;
                        margin-block: -4px;
                        margin-inline: 4px -8px;
                        padding: 0 4px;
                        color: rgba(0, 0, 0, 0.29);
                        font-size: 12px;
                        border-radius: 6px;
                        cursor: pointer;
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-filter-trigger:hover {
                        color: rgba(0, 0, 0, 0.45);
                        background: rgba(0, 0, 0, 0.06);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-filter-trigger.active {
                        color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                        min-width: 120px;
                        background-color: #ffffff;
                        border-radius: 6px;
                        box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
                        overflow: hidden;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-dropdown-menu {
                        max-height: 264px;
                        overflow-x: hidden;
                        border: 0;
                        box-shadow: none;
                        border-radius: unset;
                        background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-dropdown-menu:empty::after {
                        display: block;
                        padding: 8px 0;
                        color: rgba(0, 0, 0, 0.25);
                        font-size: 12px;
                        text-align: center;
                        content: "Not Found";
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-tree {
                        padding-block: 8px 0;
                        padding-inline: 8px;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-tree .ant-tree {
                        padding: 0;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-tree .ant-tree-treenode .ant-tree-node-content-wrapper:hover {
                        background-color: rgba(0, 0, 0, 0.04);
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-tree .ant-tree-treenode-checkbox-checked .ant-tree-node-content-wrapper,
                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-tree .ant-tree-treenode-checkbox-checked .ant-tree-node-content-wrapper:hover {
                        background-color: #9ea0a8;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-search {
                        padding: 8px;
                        border-bottom: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-search-input input {
                        min-width: 140px;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-search-input .anticon {
                        color: rgba(0, 0, 0, 0.25);
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-checkall {
                        width: 100%;
                        margin-bottom: 4px;
                        margin-inline-start: 4px;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-table-filter-dropdown-btns {
                        display: flex;
                        justify-content: space-between;
                        padding: 7px 8px;
                        overflow: hidden;
                        border-top: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown .ant-checkbox-wrapper+span,
                    :where(.css-1588u1j).ant-table-filter-dropdown-submenu .ant-checkbox-wrapper+span {
                        padding-inline-start: 8px;
                        color: rgba(0, 0, 0, 0.88);
                    }

                    :where(.css-1588u1j).ant-dropdown .ant-table-filter-dropdown>ul,
                    :where(.css-1588u1j).ant-table-filter-dropdown-submenu>ul {
                        max-height: calc(100vh - 130px);
                        overflow-x: hidden;
                        overflow-y: auto;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-title {
                        border: 1px solid #f0f0f0;
                        border-bottom: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container {
                        border-inline-start: 1px solid #f0f0f0;
                        border-top: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>thead>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>thead>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>thead>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>thead>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>thead>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>thead>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>thead>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>thead>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tbody>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tbody>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tbody>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tbody>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tbody>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tbody>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tbody>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tbody>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tfoot>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tfoot>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tfoot>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tfoot>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tfoot>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tfoot>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tfoot>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tfoot>tr>td {
                        border-inline-end: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>thead>tr:not(:last-child)>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>thead>tr:not(:last-child)>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>thead>tr:not(:last-child)>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>thead>tr:not(:last-child)>th {
                        border-bottom: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>thead>tr>th::before,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>thead>tr>th::before,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>thead>tr>th::before,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>thead>tr>th::before {
                        background-color: transparent !important;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>thead>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>thead>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>thead>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>thead>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tbody>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tbody>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tbody>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tbody>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tfoot>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tfoot>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tfoot>tr>.ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tfoot>tr>.ant-table-cell-fix-right-first::after {
                        border-inline-end: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tbody>tr>th>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tbody>tr>th>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tbody>tr>th>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tbody>tr>th>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tbody>tr>td>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tbody>tr>td>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tbody>tr>td>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tbody>tr>td>.ant-table-expanded-row-fixed {
                        margin: -16px -17px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tbody>tr>th>.ant-table-expanded-row-fixed::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tbody>tr>th>.ant-table-expanded-row-fixed::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tbody>tr>th>.ant-table-expanded-row-fixed::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tbody>tr>th>.ant-table-expanded-row-fixed::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-content>table>tbody>tr>td>.ant-table-expanded-row-fixed::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-header>table>tbody>tr>td>.ant-table-expanded-row-fixed::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-body>table>tbody>tr>td>.ant-table-expanded-row-fixed::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-container>.ant-table-summary>table>tbody>tr>td>.ant-table-expanded-row-fixed::after {
                        position: absolute;
                        top: 0;
                        inset-inline-end: 1px;
                        bottom: 0;
                        border-inline-end: 1px solid #f0f0f0;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-scroll-horizontal>.ant-table-container>.ant-table-body>table>tbody>tr.ant-table-expanded-row>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-scroll-horizontal>.ant-table-container>.ant-table-body>table>tbody>tr.ant-table-placeholder>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-scroll-horizontal>.ant-table-container>.ant-table-body>table>tbody>tr.ant-table-expanded-row>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-scroll-horizontal>.ant-table-container>.ant-table-body>table>tbody>tr.ant-table-placeholder>td {
                        border-inline-end: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-middle>.ant-table-container>.ant-table-content>table>tbody>tr>th>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-middle>.ant-table-container>.ant-table-body>table>tbody>tr>th>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-middle>.ant-table-container>.ant-table-content>table>tbody>tr>td>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-middle>.ant-table-container>.ant-table-body>table>tbody>tr>td>.ant-table-expanded-row-fixed {
                        margin: -12px -9px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-small>.ant-table-container>.ant-table-content>table>tbody>tr>th>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-small>.ant-table-container>.ant-table-body>table>tbody>tr>th>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-small>.ant-table-container>.ant-table-content>table>tbody>tr>td>.ant-table-expanded-row-fixed,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered.ant-table-small>.ant-table-container>.ant-table-body>table>tbody>tr>td>.ant-table-expanded-row-fixed {
                        margin: -8px -9px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-bordered>.ant-table-footer {
                        border: 1px solid #f0f0f0;
                        border-top: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell .ant-table-container:first-child {
                        border-top: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-scrollbar:not([rowspan]) {
                        box-shadow: 0 1px 0 1px #fafafa;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-bordered .ant-table-cell-scrollbar {
                        border-inline-end: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table .ant-table-title,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table .ant-table-header {
                        border-radius: 8px 8px 0 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table .ant-table-title+.ant-table-container {
                        border-start-start-radius: 0;
                        border-start-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table .ant-table-title+.ant-table-container .ant-table-header,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table .ant-table-title+.ant-table-container table {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table .ant-table-title+.ant-table-container table>thead>tr:first-child th:first-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table .ant-table-title+.ant-table-container table>thead>tr:first-child th:last-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table .ant-table-title+.ant-table-container table>thead>tr:first-child td:first-child,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table .ant-table-title+.ant-table-container table>thead>tr:first-child td:last-child {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-container {
                        border-start-start-radius: 8px;
                        border-start-end-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-container table>thead>tr:first-child>*:first-child {
                        border-start-start-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-container table>thead>tr:first-child>*:last-child {
                        border-start-end-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-footer {
                        border-radius: 0 0 8px 8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-expand-icon-col {
                        width: 48px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon-cell {
                        text-align: center;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon-cell .ant-table-row-expand-icon {
                        display: inline-flex;
                        float: none;
                        vertical-align: sub;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-indent {
                        height: 1px;
                        float: left;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon {
                        color: inherit;
                        text-decoration: none;
                        outline: none;
                        cursor: pointer;
                        transition: all 0.3s;
                        position: relative;
                        float: left;
                        box-sizing: border-box;
                        width: 17px;
                        height: 17px;
                        padding: 0;
                        line-height: 17px;
                        background: #ffffff;
                        border: 1px solid #f0f0f0;
                        border-radius: 6px;
                        transform: scale(0.9411764705882353);
                        user-select: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon:focus,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon:hover {
                        color: #2d2e3d;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon:active {
                        color: #000000;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon:focus,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon:hover,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon:active {
                        border-color: currentcolor;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon::before,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon::after {
                        position: absolute;
                        background: currentcolor;
                        transition: transform 0.3s ease-out;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon::before {
                        top: 7px;
                        inset-inline-end: 3px;
                        inset-inline-start: 3px;
                        height: 1px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon::after {
                        top: 3px;
                        bottom: 3px;
                        inset-inline-start: 7px;
                        width: 1px;
                        transform: rotate(90deg);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon-collapsed::before {
                        transform: rotate(-180deg);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon-collapsed::after {
                        transform: rotate(0deg);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon-spaced {
                        background: transparent;
                        border: 0;
                        visibility: hidden;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon-spaced::before,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-expand-icon-spaced::after {
                        display: none;
                        content: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-row-indent+.ant-table-row-expand-icon {
                        margin-top: 2.5px;
                        margin-inline-end: 8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper tr.ant-table-expanded-row>th,
                    :where(.css-1588u1j).ant-table-wrapper tr.ant-table-expanded-row:hover>th,
                    :where(.css-1588u1j).ant-table-wrapper tr.ant-table-expanded-row>td,
                    :where(.css-1588u1j).ant-table-wrapper tr.ant-table-expanded-row:hover>td {
                        background: rgba(0, 0, 0, 0.02);
                    }

                    :where(.css-1588u1j).ant-table-wrapper tr.ant-table-expanded-row .ant-descriptions-view {
                        display: flex;
                    }

                    :where(.css-1588u1j).ant-table-wrapper tr.ant-table-expanded-row .ant-descriptions-view table {
                        flex: auto;
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-expanded-row-fixed {
                        position: relative;
                        margin: -16px -16px;
                        padding: 16px 16px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-summary {
                        position: relative;
                        z-index: 2;
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-summary>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-summary>tr>td {
                        border-bottom: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper div.ant-table-summary {
                        box-shadow: 0 -1px 0 #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr.ant-table-placeholder {
                        text-align: center;
                        color: rgba(0, 0, 0, 0.25);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr.ant-table-placeholder:hover>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr.ant-table-placeholder:hover>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody>tr.ant-table-placeholder {
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-selection-col {
                        width: 32px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-selection-col.ant-table-selection-col-with-dropdown {
                        width: 48px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-bordered .ant-table-selection-col {
                        width: 48px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-bordered .ant-table-selection-col.ant-table-selection-col-with-dropdown {
                        width: 64px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper table tr th.ant-table-selection-column,
                    :where(.css-1588u1j).ant-table-wrapper table tr td.ant-table-selection-column,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-selection-column {
                        padding-inline-end: 8px;
                        padding-inline-start: 8px;
                        text-align: center;
                    }

                    :where(.css-1588u1j).ant-table-wrapper table tr th.ant-table-selection-column .ant-radio-wrapper,
                    :where(.css-1588u1j).ant-table-wrapper table tr td.ant-table-selection-column .ant-radio-wrapper,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-selection-column .ant-radio-wrapper {
                        margin-inline-end: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper table tr th.ant-table-selection-column.ant-table-cell-fix-left {
                        z-index: 3;
                    }

                    :where(.css-1588u1j).ant-table-wrapper table tr th.ant-table-selection-column::after {
                        background-color: transparent !important;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-selection {
                        position: relative;
                        display: inline-flex;
                        flex-direction: column;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-selection-extra {
                        position: absolute;
                        top: 0;
                        z-index: 1;
                        cursor: pointer;
                        transition: all 0.3s;
                        margin-inline-start: 100%;
                        padding-inline-start: 4px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-selection-extra .anticon {
                        color: rgba(0, 0, 0, 0.29);
                        font-size: 12px;
                        vertical-align: baseline;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-selection-extra .anticon:hover {
                        color: rgba(0, 0, 0, 0.57);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody .ant-table-row.ant-table-row-selected>.ant-table-cell {
                        background: #9ea0a8;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody .ant-table-row.ant-table-row-selected>.ant-table-cell-row-hover {
                        background: #92949c;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody .ant-table-row>.ant-table-cell-row-hover {
                        background: #fafafa;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-fix-left,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-fix-right {
                        position: sticky !important;
                        z-index: 2;
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-fix-left-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-fix-left-last::after {
                        position: absolute;
                        top: 0;
                        right: 0;
                        bottom: -1px;
                        width: 30px;
                        transform: translateX(100%);
                        transition: box-shadow 0.3s;
                        content: "";
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-fix-left-all::after {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-fix-right-last::after {
                        position: absolute;
                        top: 0;
                        bottom: -1px;
                        left: 0;
                        width: 30px;
                        transform: translateX(-100%);
                        transition: box-shadow 0.3s;
                        content: "";
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-container {
                        position: relative;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-container::before,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-container::after {
                        position: absolute;
                        top: 0;
                        bottom: 0;
                        z-index: 4;
                        width: 30px;
                        transition: box-shadow 0.3s;
                        content: "";
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-container::before {
                        inset-inline-start: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-container::after {
                        inset-inline-end: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-ping-left:not(.ant-table-has-fix-left) .ant-table-container::before {
                        box-shadow: inset 10px 0 8px -8px rgba(5, 5, 5, 0.06);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-ping-left .ant-table-cell-fix-left-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-ping-left .ant-table-cell-fix-left-last::after {
                        box-shadow: inset 10px 0 8px -8px rgba(5, 5, 5, 0.06);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-ping-left .ant-table-cell-fix-left-last::before {
                        background-color: transparent !important;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-ping-right:not(.ant-table-has-fix-right) .ant-table-container::after {
                        box-shadow: inset -10px 0 8px -8px rgba(5, 5, 5, 0.06);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-ping-right .ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-ping-right .ant-table-cell-fix-right-last::after {
                        box-shadow: inset -10px 0 8px -8px rgba(5, 5, 5, 0.06);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-fixed-column-gapped .ant-table-cell-fix-left-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-fixed-column-gapped .ant-table-cell-fix-left-last::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-fixed-column-gapped .ant-table-cell-fix-right-first::after,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-fixed-column-gapped .ant-table-cell-fix-right-last::after {
                        box-shadow: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-sticky-holder {
                        position: sticky;
                        z-index: 3;
                        background: #ffffff;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-sticky-scroll {
                        position: sticky;
                        bottom: 0;
                        height: 8px !important;
                        z-index: 3;
                        display: flex;
                        align-items: center;
                        background: rgba(5, 5, 5, 0.06);
                        border-top: 1px solid #f0f0f0;
                        opacity: 0.65;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-sticky-scroll:hover {
                        transform-origin: center bottom;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-sticky-scroll-bar {
                        height: 8px;
                        background-color: rgba(0, 0, 0, 0.25);
                        border-radius: 100px;
                        transition: all 0.3s, transform none;
                        position: absolute;
                        bottom: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-sticky-scroll-bar:hover,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-sticky-scroll-bar-active {
                        background-color: rgba(0, 0, 0, 0.88);
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-ellipsis {
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                        word-break: keep-all;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-ellipsis.ant-table-cell-fix-left-last,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-ellipsis.ant-table-cell-fix-right-first {
                        overflow: visible;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-ellipsis.ant-table-cell-fix-left-last .ant-table-cell-content,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-ellipsis.ant-table-cell-fix-right-first .ant-table-cell-content {
                        display: block;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-cell-ellipsis .ant-table-column-title {
                        overflow: hidden;
                        text-overflow: ellipsis;
                        word-break: keep-all;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle {
                        font-size: 14px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-title,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-footer,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-cell,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-thead>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-tbody>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-tbody>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle tfoot>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle tfoot>tr>td {
                        padding: 12px 8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-filter-trigger {
                        margin-inline-end: -4px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-expanded-row-fixed {
                        margin: -12px -8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-tbody .ant-table-wrapper:only-child .ant-table {
                        margin-block: -12px;
                        margin-inline: 40px -8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-middle .ant-table-selection-extra {
                        padding-inline-start: 2px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small {
                        font-size: 14px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-title,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-footer,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-cell,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-thead>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-tbody>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-tbody>tr>td,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small tfoot>tr>th,
                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small tfoot>tr>td {
                        padding: 8px 8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-filter-trigger {
                        margin-inline-end: -4px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-expanded-row-fixed {
                        margin: -8px -8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-tbody .ant-table-wrapper:only-child .ant-table {
                        margin-block: -8px;
                        margin-inline: 40px -8px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table.ant-table-small .ant-table-selection-extra {
                        padding-inline-start: 2px;
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl table {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl .ant-table-pagination-left {
                        justify-content: flex-end;
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl .ant-table-pagination-right {
                        justify-content: flex-start;
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl .ant-table-row-expand-icon {
                        float: right;
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl .ant-table-row-expand-icon::after {
                        transform: rotate(-90deg);
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl .ant-table-row-expand-icon-collapsed::before {
                        transform: rotate(180deg);
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl .ant-table-row-expand-icon-collapsed::after {
                        transform: rotate(0deg);
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl .ant-table-container::before {
                        inset-inline-start: unset;
                        inset-inline-end: 0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl .ant-table-container::after {
                        inset-inline-start: 0;
                        inset-inline-end: unset;
                    }

                    :where(.css-1588u1j).ant-table-wrapper-rtl .ant-table-container .ant-table-row-indent {
                        float: right;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody-virtual .ant-table-row:not(tr) {
                        display: flex;
                        box-sizing: border-box;
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody-virtual .ant-table-cell {
                        border-bottom: 1px solid #f0f0f0;
                        transition: background 0.2s;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-tbody-virtual .ant-table-expanded-row .ant-table-expanded-row-cell.ant-table-expanded-row-cell-fixed {
                        position: sticky;
                        inset-inline-start: 0;
                        overflow: hidden;
                        width: calc(var(--virtual-width) - 1px);
                        border-inline-end: none;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-bordered .ant-table-tbody-virtual:after {
                        content: "";
                        inset-inline: 0;
                        bottom: 0;
                        border-bottom: 1px solid #f0f0f0;
                        position: absolute;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-bordered .ant-table-tbody-virtual .ant-table-cell {
                        border-inline-end: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-bordered .ant-table-tbody-virtual .ant-table-cell.ant-table-cell-fix-right-first:before {
                        content: "";
                        position: absolute;
                        inset-block: 0;
                        inset-inline-start: -1px;
                        border-inline-start: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-table-wrapper .ant-table-bordered.ant-table-virtual .ant-table-placeholder .ant-table-cell {
                        border-inline-end: 1px solid #f0f0f0;
                        border-bottom: 1px solid #f0f0f0;
                    }

                    :where(.css-1588u1j).ant-spin {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-spin::before,
                    :where(.css-1588u1j).ant-spin::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-spin [class^="ant-spin"],
                    :where(.css-1588u1j).ant-spin [class*=" ant-spin"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-spin [class^="ant-spin"]::before,
                    :where(.css-1588u1j).ant-spin [class*=" ant-spin"]::before,
                    :where(.css-1588u1j).ant-spin [class^="ant-spin"]::after,
                    :where(.css-1588u1j).ant-spin [class*=" ant-spin"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-spin {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        color: #2f3268;
                        font-size: 0;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                        position: absolute;
                        display: none;
                        text-align: center;
                        vertical-align: middle;
                        opacity: 0;
                        transition: transform 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86);
                    }

                    :where(.css-1588u1j).ant-spin-spinning {
                        position: relative;
                        display: inline-block;
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-text {
                        font-size: 14px;
                        padding-top: 5px;
                    }

                    :where(.css-1588u1j).ant-spin-fullscreen {
                        position: fixed;
                        width: 100vw;
                        height: 100vh;
                        background-color: rgba(0, 0, 0, 0.45);
                        z-index: 1000;
                        inset: 0;
                        display: flex;
                        align-items: center;
                        flex-direction: column;
                        justify-content: center;
                        opacity: 0;
                        visibility: hidden;
                        transition: all 0.2s;
                    }

                    :where(.css-1588u1j).ant-spin-fullscreen-show {
                        opacity: 1;
                        visibility: visible;
                    }

                    :where(.css-1588u1j).ant-spin-fullscreen .ant-spin .ant-spin-dot-holder {
                        color: #fff;
                    }

                    :where(.css-1588u1j).ant-spin-fullscreen .ant-spin .ant-spin-text {
                        color: #fff;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading {
                        position: relative;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin {
                        position: absolute;
                        top: 0;
                        inset-inline-start: 0;
                        z-index: 4;
                        display: block;
                        width: 100%;
                        height: 100%;
                        max-height: 400px;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin .ant-spin-dot {
                        position: absolute;
                        top: 50%;
                        inset-inline-start: 50%;
                        margin: -10px;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin .ant-spin-text {
                        position: absolute;
                        top: 50%;
                        width: 100%;
                        text-shadow: 0 1px 2px #ffffff;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin.ant-spin-show-text .ant-spin-dot {
                        margin-top: -20px;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin-sm .ant-spin-dot {
                        margin: -7px;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin-sm .ant-spin-text {
                        padding-top: 2px;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin-sm.ant-spin-show-text .ant-spin-dot {
                        margin-top: -17px;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin-lg .ant-spin-dot {
                        margin: -16px;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin-lg .ant-spin-text {
                        padding-top: 11px;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading>div>.ant-spin-lg.ant-spin-show-text .ant-spin-dot {
                        margin-top: -26px;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading .ant-spin-container {
                        position: relative;
                        transition: opacity 0.3s;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading .ant-spin-container::after {
                        position: absolute;
                        top: 0;
                        inset-inline-end: 0;
                        bottom: 0;
                        inset-inline-start: 0;
                        z-index: 10;
                        width: 100%;
                        height: 100%;
                        background: #ffffff;
                        opacity: 0;
                        transition: all 0.3s;
                        content: "";
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading .ant-spin-blur {
                        clear: both;
                        opacity: 0.5;
                        user-select: none;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-spin-nested-loading .ant-spin-blur::after {
                        opacity: 0.4;
                        pointer-events: auto;
                    }

                    :where(.css-1588u1j).ant-spin-tip {
                        color: rgba(0, 0, 0, 0.45);
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-holder {
                        width: 1em;
                        height: 1em;
                        font-size: 20px;
                        display: inline-block;
                        transition: transform 0.3s ease, opacity 0.3s ease;
                        transform-origin: 50% 50%;
                        line-height: 1;
                        color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-holder-hidden {
                        transform: scale(0.3);
                        opacity: 0;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-progress {
                        position: absolute;
                        top: 50%;
                        transform: translateY(-50%);
                        inset-inline-start: 0;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot {
                        position: relative;
                        display: inline-block;
                        font-size: 20px;
                        width: 1em;
                        height: 1em;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-item {
                        position: absolute;
                        display: block;
                        width: 9px;
                        height: 9px;
                        background: currentColor;
                        border-radius: 100%;
                        transform: scale(0.75);
                        transform-origin: 50% 50%;
                        opacity: 0.3;
                        animation-name: css-1588u1j-antSpinMove;
                        animation-duration: 1s;
                        animation-iteration-count: infinite;
                        animation-timing-function: linear;
                        animation-direction: alternate;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-item:nth-child(1) {
                        top: 0;
                        inset-inline-start: 0;
                        animation-delay: 0s;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-item:nth-child(2) {
                        top: 0;
                        inset-inline-end: 0;
                        animation-delay: 0.4s;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-item:nth-child(3) {
                        inset-inline-end: 0;
                        bottom: 0;
                        animation-delay: 0.8s;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-item:nth-child(4) {
                        bottom: 0;
                        inset-inline-start: 0;
                        animation-delay: 1.2s;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-spin {
                        transform: rotate(45deg);
                        animation-name: css-1588u1j-antRotate;
                        animation-duration: 1.2s;
                        animation-iteration-count: infinite;
                        animation-timing-function: linear;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-circle {
                        stroke-linecap: round;
                        transition: stroke-dashoffset 0.3s ease, stroke-dasharray 0.3s ease, stroke 0.3s ease, stroke-width 0.3s ease, opacity 0.3s ease;
                        fill-opacity: 0;
                        stroke: currentcolor;
                    }

                    :where(.css-1588u1j).ant-spin .ant-spin-dot-circle-bg {
                        stroke: rgba(0, 0, 0, 0.06);
                    }

                    :where(.css-1588u1j).ant-spin-sm .ant-spin-dot,
                    :where(.css-1588u1j).ant-spin-sm .ant-spin-dot-holder {
                        font-size: 14px;
                    }

                    :where(.css-1588u1j).ant-spin-sm .ant-spin-dot-holder i {
                        width: 6px;
                        height: 6px;
                    }

                    :where(.css-1588u1j).ant-spin-lg .ant-spin-dot,
                    :where(.css-1588u1j).ant-spin-lg .ant-spin-dot-holder {
                        font-size: 32px;
                    }

                    :where(.css-1588u1j).ant-spin-lg .ant-spin-dot-holder i {
                        width: 14px;
                        height: 14px;
                    }

                    :where(.css-1588u1j).ant-spin.ant-spin-show-text .ant-spin-text {
                        display: block;
                    }

                    @keyframes css-1588u1j-antSpinMove {
                        to {
                            opacity: 1;
                        }
                    }

                    @keyframes css-1588u1j-antRotate {
                        to {
                            transform: rotate(405deg);
                        }
                    }

                    :where(.css-1588u1j).ant-empty {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-empty::before,
                    :where(.css-1588u1j).ant-empty::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-empty [class^="ant-empty"],
                    :where(.css-1588u1j).ant-empty [class*=" ant-empty"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-empty [class^="ant-empty"]::before,
                    :where(.css-1588u1j).ant-empty [class*=" ant-empty"]::before,
                    :where(.css-1588u1j).ant-empty [class^="ant-empty"]::after,
                    :where(.css-1588u1j).ant-empty [class*=" ant-empty"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-empty {
                        margin-inline: 8px;
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        text-align: center;
                    }

                    :where(.css-1588u1j).ant-empty .ant-empty-image {
                        height: 100px;
                        margin-bottom: 8px;
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-empty .ant-empty-image img {
                        height: 100%;
                    }

                    :where(.css-1588u1j).ant-empty .ant-empty-image svg {
                        max-width: 100%;
                        height: 100%;
                        margin: auto;
                    }

                    :where(.css-1588u1j).ant-empty .ant-empty-description {
                        color: rgba(0, 0, 0, 0.45);
                    }

                    :where(.css-1588u1j).ant-empty .ant-empty-footer {
                        margin-top: 16px;
                    }

                    :where(.css-1588u1j).ant-empty-normal {
                        margin-block: 32px;
                        color: rgba(0, 0, 0, 0.45);
                    }

                    :where(.css-1588u1j).ant-empty-normal .ant-empty-description {
                        color: rgba(0, 0, 0, 0.45);
                    }

                    :where(.css-1588u1j).ant-empty-normal .ant-empty-image {
                        height: 40px;
                    }

                    :where(.css-1588u1j).ant-empty-small {
                        margin-block: 8px;
                        color: rgba(0, 0, 0, 0.45);
                    }

                    :where(.css-1588u1j).ant-empty-small .ant-empty-image {
                        height: 35px;
                    }

                    :where(.css-1588u1j).ant-tour {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-tour::before,
                    :where(.css-1588u1j).ant-tour::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-tour [class^="ant-tour"],
                    :where(.css-1588u1j).ant-tour [class*=" ant-tour"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-tour [class^="ant-tour"]::before,
                    :where(.css-1588u1j).ant-tour [class*=" ant-tour"]::before,
                    :where(.css-1588u1j).ant-tour [class^="ant-tour"]::after,
                    :where(.css-1588u1j).ant-tour [class*=" ant-tour"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-tour {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                        position: absolute;
                        z-index: undefined;
                        max-width: fit-content;
                        visibility: visible;
                        width: 520px;
                        --antd-arrow-background-color: #ffffff;
                    }

                    :where(.css-1588u1j).ant-tour-pure {
                        max-width: 100%;
                        position: relative;
                    }

                    :where(.css-1588u1j).ant-tour.ant-tour-hidden {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-content {
                        position: relative;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner {
                        text-align: start;
                        text-decoration: none;
                        border-radius: 8px;
                        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03), 0 1px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px 0 rgba(0, 0, 0, 0.02);
                        position: relative;
                        background-color: #ffffff;
                        border: none;
                        background-clip: padding-box;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-close {
                        position: absolute;
                        top: 16px;
                        inset-inline-end: 16px;
                        color: rgba(0, 0, 0, 0.45);
                        background: none;
                        border: none;
                        width: 22px;
                        height: 22px;
                        border-radius: 4px;
                        transition: background-color 0.2s, color 0.2s;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-close:hover {
                        color: rgba(0, 0, 0, 0.88);
                        background-color: rgba(0, 0, 0, 0.06);
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-close:active {
                        background-color: rgba(0, 0, 0, 0.15);
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-close:focus-visible {
                        outline: 4px solid #85868f;
                        outline-offset: 1px;
                        transition: outline-offset 0s, outline 0s;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-cover {
                        text-align: center;
                        padding: 46px 16px 0;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-cover img {
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-header {
                        padding: 16px 16px 8px;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-header .ant-tour-title {
                        font-weight: 600;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-description {
                        padding: 0 16px;
                        word-wrap: break-word;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer {
                        padding: 8px 16px 16px;
                        text-align: end;
                        border-radius: 0 0 2px 2px;
                        display: flex;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-indicators {
                        display: inline-block;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-indicators .ant-tour-indicator {
                        width: 6px;
                        height: 6px;
                        display: inline-block;
                        border-radius: 50%;
                        background: rgba(0, 0, 0, 0.15);
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-indicators .ant-tour-indicator:not(:last-child) {
                        margin-inline-end: 6px;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-indicators .ant-tour-indicator-active {
                        background: #2f3268;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-buttons {
                        margin-inline-start: auto;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-buttons .ant-btn {
                        margin-inline-start: 8px;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-primary,
                    :where(.css-1588u1j).ant-tour.ant-tour-primary {
                        --antd-arrow-background-color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner,
                    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner {
                        color: #fff;
                        text-align: start;
                        text-decoration: none;
                        background-color: #2f3268;
                        border-radius: 6px;
                        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03), 0 1px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px 0 rgba(0, 0, 0, 0.02);
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-close,
                    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-close {
                        color: #fff;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator,
                    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator {
                        background: rgba(255, 255, 255, 0.15);
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator-active,
                    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator-active {
                        background: #fff;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-prev-btn,
                    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-prev-btn {
                        color: #fff;
                        border-color: rgba(255, 255, 255, 0.15);
                        background-color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-prev-btn:hover,
                    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-prev-btn:hover {
                        background-color: rgba(255, 255, 255, 0.15);
                        border-color: transparent;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-next-btn,
                    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-next-btn {
                        color: #2f3268;
                        border-color: transparent;
                        background: #fff;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-next-btn:hover,
                    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-next-btn:hover {
                        background: rgb(240, 240, 240);
                    }

                    :where(.css-1588u1j).ant-tour-mask .ant-tour-placeholder-animated {
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j)-placement-left .ant-tour-inner,
                    :where(.css-1588u1j)-placement-leftTop .ant-tour-inner,
                    :where(.css-1588u1j)-placement-leftBottom .ant-tour-inner,
                    :where(.css-1588u1j)-placement-right .ant-tour-inner,
                    :where(.css-1588u1j)-placement-rightTop .ant-tour-inner,
                    :where(.css-1588u1j)-placement-rightBottom .ant-tour-inner {
                        border-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-arrow {
                        position: absolute;
                        z-index: 1;
                        display: block;
                        pointer-events: none;
                        width: 16px;
                        height: 16px;
                        overflow: hidden;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-arrow::before {
                        position: absolute;
                        bottom: 0;
                        inset-inline-start: 0;
                        width: 16px;
                        height: 8px;
                        background: var(--antd-arrow-background-color);
                        clip-path: polygon(1.6568542494923806px 100%, 50% 1.6568542494923806px, 14.34314575050762px 100%, 1.6568542494923806px 100%);
                        clip-path: path('M 0 8 A 4 4 0 0 0 2.82842712474619 6.82842712474619 L 6.585786437626905 3.0710678118654755 A 2 2 0 0 1 9.414213562373096 3.0710678118654755 L 13.17157287525381 6.82842712474619 A 4 4 0 0 0 16 8 Z');
                        content: "";
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-arrow::after {
                        content: "";
                        position: absolute;
                        width: 8.970562748477143px;
                        height: 8.970562748477143px;
                        bottom: 0;
                        inset-inline: 0;
                        margin: auto;
                        border-radius: 0 0 2px 0;
                        transform: translateY(50%) rotate(-135deg);
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.05);
                        z-index: 0;
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-tour .ant-tour-arrow:before {
                        background: var(--antd-arrow-background-color);
                    }

                    :where(.css-1588u1j).ant-tour-placement-top>.ant-tour-arrow,
                    :where(.css-1588u1j).ant-tour-placement-topLeft>.ant-tour-arrow,
                    :where(.css-1588u1j).ant-tour-placement-topRight>.ant-tour-arrow {
                        bottom: 0;
                        transform: translateY(100%) rotate(180deg);
                    }

                    :where(.css-1588u1j).ant-tour-placement-top>.ant-tour-arrow {
                        left: 50%;
                        transform: translateX(-50%) translateY(100%) rotate(180deg);
                    }

                    :where(.css-1588u1j).ant-tour-placement-topLeft>.ant-tour-arrow {
                        left: 12px;
                    }

                    :where(.css-1588u1j).ant-tour-placement-topRight>.ant-tour-arrow {
                        right: 12px;
                    }

                    :where(.css-1588u1j).ant-tour-placement-bottom>.ant-tour-arrow,
                    :where(.css-1588u1j).ant-tour-placement-bottomLeft>.ant-tour-arrow,
                    :where(.css-1588u1j).ant-tour-placement-bottomRight>.ant-tour-arrow {
                        top: 0;
                        transform: translateY(-100%);
                    }

                    :where(.css-1588u1j).ant-tour-placement-bottom>.ant-tour-arrow {
                        left: 50%;
                        transform: translateX(-50%) translateY(-100%);
                    }

                    :where(.css-1588u1j).ant-tour-placement-bottomLeft>.ant-tour-arrow {
                        left: 12px;
                    }

                    :where(.css-1588u1j).ant-tour-placement-bottomRight>.ant-tour-arrow {
                        right: 12px;
                    }

                    :where(.css-1588u1j).ant-tour-placement-left>.ant-tour-arrow,
                    :where(.css-1588u1j).ant-tour-placement-leftTop>.ant-tour-arrow,
                    :where(.css-1588u1j).ant-tour-placement-leftBottom>.ant-tour-arrow {
                        right: 0;
                        transform: translateX(100%) rotate(90deg);
                    }

                    :where(.css-1588u1j).ant-tour-placement-left>.ant-tour-arrow {
                        top: 50%;
                        transform: translateY(-50%) translateX(100%) rotate(90deg);
                    }

                    :where(.css-1588u1j).ant-tour-placement-leftTop>.ant-tour-arrow {
                        top: 8px;
                    }

                    :where(.css-1588u1j).ant-tour-placement-leftBottom>.ant-tour-arrow {
                        bottom: 8px;
                    }

                    :where(.css-1588u1j).ant-tour-placement-right>.ant-tour-arrow,
                    :where(.css-1588u1j).ant-tour-placement-rightTop>.ant-tour-arrow,
                    :where(.css-1588u1j).ant-tour-placement-rightBottom>.ant-tour-arrow {
                        left: 0;
                        transform: translateX(-100%) rotate(-90deg);
                    }

                    :where(.css-1588u1j).ant-tour-placement-right>.ant-tour-arrow {
                        top: 50%;
                        transform: translateY(-50%) translateX(-100%) rotate(-90deg);
                    }

                    :where(.css-1588u1j).ant-tour-placement-rightTop>.ant-tour-arrow {
                        top: 8px;
                    }

                    :where(.css-1588u1j).ant-tour-placement-rightBottom>.ant-tour-arrow {
                        bottom: 8px;
                    }

                    :where(.css-1588u1j).ant-btn-compact-item:not(.ant-btn-compact-last-item) {
                        margin-inline-end: -1px;
                    }

                    :where(.css-1588u1j).ant-btn-compact-item:hover,
                    :where(.css-1588u1j).ant-btn-compact-item:focus,
                    :where(.css-1588u1j).ant-btn-compact-item:active {
                        z-index: 2;
                    }

                    :where(.css-1588u1j).ant-btn-compact-item[disabled] {
                        z-index: 0;
                    }

                    :where(.css-1588u1j).ant-btn-compact-item:not(.ant-btn-compact-first-item):not(.ant-btn-compact-last-item) {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-btn-compact-item:not(.ant-btn-compact-last-item).ant-btn-compact-first-item,
                    :where(.css-1588u1j).ant-btn-compact-item:not(.ant-btn-compact-last-item).ant-btn-compact-first-item.ant-btn-sm,
                    :where(.css-1588u1j).ant-btn-compact-item:not(.ant-btn-compact-last-item).ant-btn-compact-first-item.ant-btn-lg {
                        border-start-end-radius: 0;
                        border-end-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-btn-compact-item:not(.ant-btn-compact-first-item).ant-btn-compact-last-item,
                    :where(.css-1588u1j).ant-btn-compact-item:not(.ant-btn-compact-first-item).ant-btn-compact-last-item.ant-btn-sm,
                    :where(.css-1588u1j).ant-btn-compact-item:not(.ant-btn-compact-first-item).ant-btn-compact-last-item.ant-btn-lg {
                        border-start-start-radius: 0;
                        border-end-start-radius: 0;
                    }

                    :where(.css-1588u1j).ant-btn-compact-vertical-item:not(.ant-btn-compact-vertical-last-item) {
                        margin-bottom: -1px;
                    }

                    :where(.css-1588u1j).ant-btn-compact-vertical-item:hover,
                    :where(.css-1588u1j).ant-btn-compact-vertical-item:focus,
                    :where(.css-1588u1j).ant-btn-compact-vertical-item:active {
                        z-index: 2;
                    }

                    :where(.css-1588u1j).ant-btn-compact-vertical-item[disabled] {
                        z-index: 0;
                    }

                    :where(.css-1588u1j).ant-btn-compact-vertical-item:not(.ant-btn-compact-vertical-first-item):not(.ant-btn-compact-vertical-last-item) {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-btn-compact-vertical-item.ant-btn-compact-vertical-first-item:not(.ant-btn-compact-vertical-last-item),
                    :where(.css-1588u1j).ant-btn-compact-vertical-item.ant-btn-compact-vertical-first-item:not(.ant-btn-compact-vertical-last-item).ant-btn-sm,
                    :where(.css-1588u1j).ant-btn-compact-vertical-item.ant-btn-compact-vertical-first-item:not(.ant-btn-compact-vertical-last-item).ant-btn-lg {
                        border-end-end-radius: 0;
                        border-end-start-radius: 0;
                    }

                    :where(.css-1588u1j).ant-btn-compact-vertical-item.ant-btn-compact-vertical-last-item:not(.ant-btn-compact-vertical-first-item),
                    :where(.css-1588u1j).ant-btn-compact-vertical-item.ant-btn-compact-vertical-last-item:not(.ant-btn-compact-vertical-first-item).ant-btn-sm,
                    :where(.css-1588u1j).ant-btn-compact-vertical-item.ant-btn-compact-vertical-last-item:not(.ant-btn-compact-vertical-first-item).ant-btn-lg {
                        border-start-start-radius: 0;
                        border-start-end-radius: 0;
                    }

                    :where(.css-1588u1j).ant-btn-compact-item.ant-btn-primary:not([disabled])+.ant-btn-compact-item.ant-btn-primary:not([disabled]) {
                        position: relative;
                    }

                    :where(.css-1588u1j).ant-btn-compact-item.ant-btn-primary:not([disabled])+.ant-btn-compact-item.ant-btn-primary:not([disabled]):before {
                        position: absolute;
                        top: -1px;
                        inset-inline-start: -1px;
                        display: inline-block;
                        width: 1px;
                        height: calc(100% + 1px * 2);
                        background-color: #484b75;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-btn-compact-vertical-item.ant-btn-primary:not([disabled])+.ant-btn-compact-vertical-item.ant-btn-primary:not([disabled]) {
                        position: relative;
                    }

                    :where(.css-1588u1j).ant-btn-compact-vertical-item.ant-btn-primary:not([disabled])+.ant-btn-compact-vertical-item.ant-btn-primary:not([disabled]):before {
                        position: absolute;
                        top: -1px;
                        inset-inline-start: -1px;
                        display: inline-block;
                        width: calc(100% + 1px * 2);
                        height: 1px;
                        background-color: #484b75;
                        content: "";
                    }

                    .anticon {
                        display: inline-flex;
                        align-items: center;
                        color: inherit;
                        font-style: normal;
                        line-height: 0;
                        text-align: center;
                        text-transform: none;
                        vertical-align: -0.125em;
                        text-rendering: optimizeLegibility;
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale;
                    }

                    .anticon>* {
                        line-height: 1;
                    }

                    .anticon svg {
                        display: inline-block;
                    }

                    .anticon .anticon .anticon-icon {
                        display: block;
                    }

                    .anticon {
                        display: inline-flex;
                        align-items: center;
                        color: inherit;
                        font-style: normal;
                        line-height: 0;
                        text-align: center;
                        text-transform: none;
                        vertical-align: -0.125em;
                        text-rendering: optimizeLegibility;
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale;
                    }

                    .anticon>* {
                        line-height: 1;
                    }

                    .anticon svg {
                        display: inline-block;
                    }

                    .anticon .anticon .anticon-icon {
                        display: block;
                    }

                    .data-ant-cssinjs-cache-path {
                        content: "3hyxim|ant-design-icons|anticon:n18rlk;54mug8|ant-design-icons|anticon:1i7nym9;54mug8|Shared|ant:1ijft1f;54mug8|Layout-Layout|ant-layout|anticon:tnknc0;54mug8|Button-Button|ant-btn|anticon:1cfhi6l;54mug8|Wave-Wave|ant-wave|anticon:6oh8ov;54mug8|Drawer-Drawer|ant-drawer|anticon:oz1ynp;54mug8|Space-Space|ant-space-compact|anticon:1ctqiar;54mug8|Input-Input|ant-input|anticon:rrxlx5;54mug8|Button-compact|ant-btn|anticon:bxyxqe;54mug8|Table-Table|ant-table|anticon:16r4ttw;54mug8|Spin-Spin|ant-spin|anticon:viqlbj;54mug8|Empty-Empty|ant-empty|anticon:11hsw6y;54mug8|Tour-Tour|ant-tour|anticon:1vvwohf";
                    }
                </style>
                <style>
                    #nprogress {
                        pointer-events: none;
                    }

                    #nprogress .bar {
                        background: #2a2e6a;
                        position: fixed;
                        z-index: 9999;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 3px;
                    }

                    #nprogress .peg {
                        display: block;
                        position: absolute;
                        right: 0px;
                        width: 100px;
                        height: 100%;
                        box-shadow: 0 0 10px #2a2e6a, 0 0 5px #2a2e6a;
                        opacity: 1;
                        -webkit-transform: rotate(3deg) translate(0px, -4px);
                        -ms-transform: rotate(3deg) translate(0px, -4px);
                        transform: rotate(3deg) translate(0px, -4px);
                    }

                    #nprogress .spinner {
                        display: block;
                        position: fixed;
                        z-index: 1031;
                        top: 15px;
                        right: 15px;
                    }

                    #nprogress .spinner-icon {
                        width: 18px;
                        height: 18px;
                        box-sizing: border-box;
                        border: solid 2px transparent;
                        border-top-color: #2a2e6a;
                        border-left-color: #2a2e6a;
                        border-radius: 50%;
                        -webkit-animation: nprogresss-spinner 400ms linear infinite;
                        animation: nprogress-spinner 400ms linear infinite;
                    }

                    .nprogress-custom-parent {
                        overflow: hidden;
                        position: relative;
                    }

                    .nprogress-custom-parent #nprogress .spinner,
                    .nprogress-custom-parent #nprogress .bar {
                        position: absolute;
                    }

                    @-webkit-keyframes nprogress-spinner {
                        0% {
                            -webkit-transform: rotate(0deg);
                        }

                        100% {
                            -webkit-transform: rotate(360deg);
                        }
                    }

                    @keyframes nprogress-spinner {
                        0% {
                            transform: rotate(0deg);
                        }

                        100% {
                            transform: rotate(360deg);
                        }
                    }
                </style>
                <div class="ant-layout ant-layout-has-sider css-1588u1j" style="min-height:100vh">
                    <?php include 'header.php';
                    include 'sidebar.php';
                    ?>
                    <div class="ant-layout flex flex-col justify-between css-1588u1j"
                        style="background: rgb(243, 243, 252); padding: 0px 14px 14px;">
                        <main class="ant-layout-content css-1588u1j"
                            style="border-radius: 5px; min-height: 280px; margin-top: 110px; margin-left: 0px; margin-right: 14px; background: rgb(255, 255, 255);">
                            <div class="transactions">
                                <div class="transaction_table">
                                    <div class="table_header">
                                        <h5 class="title font-semibold text-[var(--color-chinese-black)]">Transactions History
                                        </h5>
                                        <div class="input_wrapper">
                                            <div class="ant-space-compact css-1588u1j"><input placeholder="Transaction Id"
                                                    class="ant-input css-1588u1j ant-input-outlined h-[50px] ant-input-compact-item ant-input-compact-first-item"
                                                    type="text" value=""><input placeholder="Payment Date"
                                                    class="ant-input css-1588u1j ant-input-outlined h-[50px] ant-input-compact-item"
                                                    type="text" value=""><button type="button"
                                                    class="ant-btn css-1588u1j ant-btn-primary ant-btn-compact-item ant-btn-compact-last-item !h-[50px]"><svg
                                                        stroke="currentColor" fill="currentColor" stroke-width="0"
                                                        viewBox="0 0 24 24" class="text-xl" height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z">
                                                        </path>
                                                    </svg></button></div>
                                        </div>
                                    </div>
                                    <div class="ant-table-wrapper css-1588u1j">
                                        <div class="ant-spin-nested-loading css-1588u1j">
                                            <div class="ant-spin-container">
                                                <div class="ant-table ant-table-empty css-1588u1j">
                                                    <div class="ant-table-container">
                                                        <div class="ant-table-content">
                                                            <table style="table-layout: auto;">
                                                                <colgroup></colgroup>
                                                                <thead class="ant-table-thead">
                                                                    <tr>
                                                                        <th class="ant-table-cell" scope="col">Application Code
                                                                        </th>
                                                                        <th class="ant-table-cell" scope="col">status</th>
                                                                        <th class="ant-table-cell" scope="col">Amount</th>
                                                                        <th class="ant-table-cell" scope="col">Payment Method
                                                                        </th>
                                                                        <th class="ant-table-cell" scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="ant-table-tbody">
                                                                    <?php if ($table_rows !== '') {
                                                                        echo $table_rows;
                                                                    }

                                                                    if ($table_rows == '') { ?>
                                                                        <tr class="ant-table-placeholder">
                                                                            <td class="ant-table-cell" colspan="5">
                                                                                <div class="css-1588u1j ant-empty ant-empty-normal">
                                                                                    <div class="ant-empty-image"><svg width="64"
                                                                                            height="41" viewBox="0 0 64 41"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <title>Simple Empty</title>
                                                                                            <g transform="translate(0 1)"
                                                                                                fill="none" fill-rule="evenodd">
                                                                                                <ellipse fill="#f5f5f5" cx="32"
                                                                                                    cy="33" rx="32" ry="7">
                                                                                                </ellipse>
                                                                                                <g fill-rule="nonzero"
                                                                                                    stroke="#d9d9d9">
                                                                                                    <path
                                                                                                        d="M55 12.76L44.854 1.258C44.367.474 43.656 0 42.907 0H21.093c-.749 0-1.46.474-1.947 1.257L9 12.761V22h46v-9.24z">
                                                                                                    </path>
                                                                                                    <path
                                                                                                        d="M41.613 15.931c0-1.605.994-2.93 2.227-2.931H55v18.137C55 33.26 53.68 35 52.05 35h-40.1C10.32 35 9 33.259 9 31.137V13h11.16c1.233 0 2.227 1.323 2.227 2.928v.022c0 1.605 1.005 2.901 2.237 2.901h14.752c1.232 0 2.237-1.308 2.237-2.913v-.007z"
                                                                                                        fill="#fafafa"></path>
                                                                                                </g>
                                                                                            </g>
                                                                                        </svg></div>
                                                                                    <div class="ant-empty-description">No data</div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </main>
        </div>
        </div>
        </div>
        </main>
        </div>
        </div>
        </main>
        </div>
        <script id="__NEXT_DATA__"
            type="application/json">
            {
                "props": {
                    "pageProps": {}
                },
                "page": "/user",
                "query": {},
                "buildId": "9fmPZqRL0NhrU0EXE1c_j",
                "nextExport": true,
                "autoExport": true,
                "isFallback": false,
                "scriptLoader": []
            }
        </script>

        <script id="google-analytics-script" data-nscript="afterInteractive">
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-EBPQ33J7JL');
        </script>
        <script id="fb-pixel" data-nscript="afterInteractive">
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '761961522774595');
            fbq('track', 'PageView');
        </script>
        <p aria-live="assertive" id="__next-route-announcer__" role="alert"
            style="border: 0px; clip: rect(0px, 0px, 0px, 0px); height: 1px; margin: -1px; overflow: hidden; padding: 0px; position: absolute; top: 0px; width: 1px; white-space: nowrap; overflow-wrap: normal;">
        </p>
        </next-route-announcer><iframe id="_hjSafeContext_78308674" title="_hjSafeContext" tabindex="-1" aria-hidden="true"
            src="about:blank"
            style="display: none !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important;"></iframe>
        <div id="veepn-guard-alert"></div>
        <style>
            @font-face {
                font-family: FigtreeVF;
                src: url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"), url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");
                font-weight: 100 1000;
                font-display: swap
            }
        </style>
        <div id="veepn-breach-alert"></div>
        <style>
            @font-face {
                font-family: FigtreeVF;
                src: url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"), url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");
                font-weight: 100 1000;
                font-display: swap
            }
        </style>
    </body>
<?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('user_transactions', 'ut_display_user_transactions_shortcode');
