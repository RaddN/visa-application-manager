<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Create a shortcode to display co-travelers
function ct_display_co_travelers_shortcode()
{
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        return '<p>You need to be logged in to view your co-travelers.</p>';
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

    // handle form submission

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['firstName'])) {
        global $wpdb;

        // Sanitize input
        $first_name = sanitize_text_field($_POST['firstName']);
        $last_name = sanitize_text_field($_POST['lastName']);
        $email = sanitize_email($_POST['email']);
        $phone_number = sanitize_text_field($_POST['phoneNumber']);
        $relationship = sanitize_text_field($_POST['relationship']);

        // Generate a random password
        $password = wp_generate_password();

        // Check if the user already exists
        if (email_exists($email)) {
            $co_traveler_id = email_exists($email);
        } else {
            // Create new user
            $user_data = [
                'user_login' => $email,
                'user_email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'user_pass' => $password,
                'role' => 'subscriber'
            ];
            $co_traveler_id = wp_insert_user($user_data);

            // Check if user creation was successful
            if (is_wp_error($co_traveler_id)) {
                echo '<div class="notice notice-error">Error creating user: ' . $co_traveler_id->get_error_message() . '</div>';
                return;
            }
        }
        $user_id = get_current_user_id();
        // Prepare data for insertion
        $data = [
            'co_traveler_id' => $co_traveler_id, // Store new user ID
            'user_id' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'relationship' => $relationship,
        ];

        // Insert into database
        $inserted = $wpdb->insert($wpdb->prefix . 'co_travelers_info', $data);

        // Check for errors
        if ($inserted === false) {
            echo '<div class="notice notice-error">Error saving Co-Traveler information: ' . $wpdb->last_error . '</div>';
        } else {
            echo '<div class="notice notice-success">Co-Traveler information saved successfully!</div>';
        }
    }


    $co_travelers = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM {$wpdb->prefix}co_travelers_info WHERE user_id = %d", $user_id)
    );



    ob_start(); ?>
    <?php include 'head.php'; ?>

    <body>
        <div id="__next">
            <main role="main" id="__main" class="__variable_c389b4 font-noto-sans">

                <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="4t782p" data-token-hash="54mug8">
                    :where(.css-1588u1j).ant-col {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-col::before,
                    :where(.css-1588u1j).ant-col::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-col [class^="ant-col"],
                    :where(.css-1588u1j).ant-col [class*=" ant-col"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-col [class^="ant-col"]::before,
                    :where(.css-1588u1j).ant-col [class*=" ant-col"]::before,
                    :where(.css-1588u1j).ant-col [class^="ant-col"]::after,
                    :where(.css-1588u1j).ant-col [class*=" ant-col"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-col {
                        position: relative;
                        max-width: 100%;
                        min-height: 1px;
                    }

                    :where(.css-1588u1j).ant-col-24 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 100%;
                        max-width: 100%;
                    }

                    :where(.css-1588u1j).ant-col-push-24 {
                        inset-inline-start: 100%;
                    }

                    :where(.css-1588u1j).ant-col-pull-24 {
                        inset-inline-end: 100%;
                    }

                    :where(.css-1588u1j).ant-col-offset-24 {
                        margin-inline-start: 100%;
                    }

                    :where(.css-1588u1j).ant-col-order-24 {
                        order: 24;
                    }

                    :where(.css-1588u1j).ant-col-23 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 95.83333333333334%;
                        max-width: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-push-23 {
                        inset-inline-start: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-pull-23 {
                        inset-inline-end: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-offset-23 {
                        margin-inline-start: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-order-23 {
                        order: 23;
                    }

                    :where(.css-1588u1j).ant-col-22 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 91.66666666666666%;
                        max-width: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-push-22 {
                        inset-inline-start: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-pull-22 {
                        inset-inline-end: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-offset-22 {
                        margin-inline-start: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-order-22 {
                        order: 22;
                    }

                    :where(.css-1588u1j).ant-col-21 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 87.5%;
                        max-width: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-push-21 {
                        inset-inline-start: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-pull-21 {
                        inset-inline-end: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-offset-21 {
                        margin-inline-start: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-order-21 {
                        order: 21;
                    }

                    :where(.css-1588u1j).ant-col-20 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 83.33333333333334%;
                        max-width: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-push-20 {
                        inset-inline-start: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-pull-20 {
                        inset-inline-end: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-offset-20 {
                        margin-inline-start: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-order-20 {
                        order: 20;
                    }

                    :where(.css-1588u1j).ant-col-19 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 79.16666666666666%;
                        max-width: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-push-19 {
                        inset-inline-start: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-pull-19 {
                        inset-inline-end: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-offset-19 {
                        margin-inline-start: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-order-19 {
                        order: 19;
                    }

                    :where(.css-1588u1j).ant-col-18 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 75%;
                        max-width: 75%;
                    }

                    :where(.css-1588u1j).ant-col-push-18 {
                        inset-inline-start: 75%;
                    }

                    :where(.css-1588u1j).ant-col-pull-18 {
                        inset-inline-end: 75%;
                    }

                    :where(.css-1588u1j).ant-col-offset-18 {
                        margin-inline-start: 75%;
                    }

                    :where(.css-1588u1j).ant-col-order-18 {
                        order: 18;
                    }

                    :where(.css-1588u1j).ant-col-17 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 70.83333333333334%;
                        max-width: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-push-17 {
                        inset-inline-start: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-pull-17 {
                        inset-inline-end: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-offset-17 {
                        margin-inline-start: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-order-17 {
                        order: 17;
                    }

                    :where(.css-1588u1j).ant-col-16 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 66.66666666666666%;
                        max-width: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-push-16 {
                        inset-inline-start: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-pull-16 {
                        inset-inline-end: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-offset-16 {
                        margin-inline-start: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-order-16 {
                        order: 16;
                    }

                    :where(.css-1588u1j).ant-col-15 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 62.5%;
                        max-width: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-push-15 {
                        inset-inline-start: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-pull-15 {
                        inset-inline-end: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-offset-15 {
                        margin-inline-start: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-order-15 {
                        order: 15;
                    }

                    :where(.css-1588u1j).ant-col-14 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 58.333333333333336%;
                        max-width: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-push-14 {
                        inset-inline-start: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-pull-14 {
                        inset-inline-end: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-offset-14 {
                        margin-inline-start: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-order-14 {
                        order: 14;
                    }

                    :where(.css-1588u1j).ant-col-13 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 54.166666666666664%;
                        max-width: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-push-13 {
                        inset-inline-start: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-pull-13 {
                        inset-inline-end: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-offset-13 {
                        margin-inline-start: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-order-13 {
                        order: 13;
                    }

                    :where(.css-1588u1j).ant-col-12 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 50%;
                        max-width: 50%;
                    }

                    :where(.css-1588u1j).ant-col-push-12 {
                        inset-inline-start: 50%;
                    }

                    :where(.css-1588u1j).ant-col-pull-12 {
                        inset-inline-end: 50%;
                    }

                    :where(.css-1588u1j).ant-col-offset-12 {
                        margin-inline-start: 50%;
                    }

                    :where(.css-1588u1j).ant-col-order-12 {
                        order: 12;
                    }

                    :where(.css-1588u1j).ant-col-11 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 45.83333333333333%;
                        max-width: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-push-11 {
                        inset-inline-start: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-pull-11 {
                        inset-inline-end: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-offset-11 {
                        margin-inline-start: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-order-11 {
                        order: 11;
                    }

                    :where(.css-1588u1j).ant-col-10 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 41.66666666666667%;
                        max-width: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-push-10 {
                        inset-inline-start: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-pull-10 {
                        inset-inline-end: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-offset-10 {
                        margin-inline-start: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-order-10 {
                        order: 10;
                    }

                    :where(.css-1588u1j).ant-col-9 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 37.5%;
                        max-width: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-push-9 {
                        inset-inline-start: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-pull-9 {
                        inset-inline-end: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-offset-9 {
                        margin-inline-start: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-order-9 {
                        order: 9;
                    }

                    :where(.css-1588u1j).ant-col-8 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 33.33333333333333%;
                        max-width: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-push-8 {
                        inset-inline-start: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-pull-8 {
                        inset-inline-end: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-offset-8 {
                        margin-inline-start: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-order-8 {
                        order: 8;
                    }

                    :where(.css-1588u1j).ant-col-7 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 29.166666666666668%;
                        max-width: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-push-7 {
                        inset-inline-start: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-pull-7 {
                        inset-inline-end: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-offset-7 {
                        margin-inline-start: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-order-7 {
                        order: 7;
                    }

                    :where(.css-1588u1j).ant-col-6 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 25%;
                        max-width: 25%;
                    }

                    :where(.css-1588u1j).ant-col-push-6 {
                        inset-inline-start: 25%;
                    }

                    :where(.css-1588u1j).ant-col-pull-6 {
                        inset-inline-end: 25%;
                    }

                    :where(.css-1588u1j).ant-col-offset-6 {
                        margin-inline-start: 25%;
                    }

                    :where(.css-1588u1j).ant-col-order-6 {
                        order: 6;
                    }

                    :where(.css-1588u1j).ant-col-5 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 20.833333333333336%;
                        max-width: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-push-5 {
                        inset-inline-start: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-pull-5 {
                        inset-inline-end: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-offset-5 {
                        margin-inline-start: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-order-5 {
                        order: 5;
                    }

                    :where(.css-1588u1j).ant-col-4 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 16.666666666666664%;
                        max-width: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-push-4 {
                        inset-inline-start: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-pull-4 {
                        inset-inline-end: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-offset-4 {
                        margin-inline-start: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-order-4 {
                        order: 4;
                    }

                    :where(.css-1588u1j).ant-col-3 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 12.5%;
                        max-width: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-push-3 {
                        inset-inline-start: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-pull-3 {
                        inset-inline-end: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-offset-3 {
                        margin-inline-start: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-order-3 {
                        order: 3;
                    }

                    :where(.css-1588u1j).ant-col-2 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 8.333333333333332%;
                        max-width: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-push-2 {
                        inset-inline-start: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-pull-2 {
                        inset-inline-end: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-offset-2 {
                        margin-inline-start: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-order-2 {
                        order: 2;
                    }

                    :where(.css-1588u1j).ant-col-1 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 4.166666666666666%;
                        max-width: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-push-1 {
                        inset-inline-start: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-pull-1 {
                        inset-inline-end: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-offset-1 {
                        margin-inline-start: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-order-1 {
                        order: 1;
                    }

                    :where(.css-1588u1j).ant-col-0 {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-col-push-0 {
                        inset-inline-start: auto;
                    }

                    :where(.css-1588u1j).ant-col-pull-0 {
                        inset-inline-end: auto;
                    }

                    :where(.css-1588u1j).ant-col-offset-0 {
                        margin-inline-start: 0;
                    }

                    :where(.css-1588u1j).ant-col-order-0 {
                        order: 0;
                    }

                    :where(.css-1588u1j).ant-col-flex {
                        flex: var(--ant-col-flex);
                    }

                    :where(.css-1588u1j).ant-col-xs-24 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 100%;
                        max-width: 100%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-24 {
                        inset-inline-start: 100%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-24 {
                        inset-inline-end: 100%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-24 {
                        margin-inline-start: 100%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-24 {
                        order: 24;
                    }

                    :where(.css-1588u1j).ant-col-xs-23 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 95.83333333333334%;
                        max-width: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-23 {
                        inset-inline-start: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-23 {
                        inset-inline-end: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-23 {
                        margin-inline-start: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-23 {
                        order: 23;
                    }

                    :where(.css-1588u1j).ant-col-xs-22 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 91.66666666666666%;
                        max-width: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-22 {
                        inset-inline-start: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-22 {
                        inset-inline-end: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-22 {
                        margin-inline-start: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-22 {
                        order: 22;
                    }

                    :where(.css-1588u1j).ant-col-xs-21 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 87.5%;
                        max-width: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-21 {
                        inset-inline-start: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-21 {
                        inset-inline-end: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-21 {
                        margin-inline-start: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-21 {
                        order: 21;
                    }

                    :where(.css-1588u1j).ant-col-xs-20 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 83.33333333333334%;
                        max-width: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-20 {
                        inset-inline-start: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-20 {
                        inset-inline-end: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-20 {
                        margin-inline-start: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-20 {
                        order: 20;
                    }

                    :where(.css-1588u1j).ant-col-xs-19 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 79.16666666666666%;
                        max-width: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-19 {
                        inset-inline-start: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-19 {
                        inset-inline-end: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-19 {
                        margin-inline-start: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-19 {
                        order: 19;
                    }

                    :where(.css-1588u1j).ant-col-xs-18 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 75%;
                        max-width: 75%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-18 {
                        inset-inline-start: 75%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-18 {
                        inset-inline-end: 75%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-18 {
                        margin-inline-start: 75%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-18 {
                        order: 18;
                    }

                    :where(.css-1588u1j).ant-col-xs-17 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 70.83333333333334%;
                        max-width: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-17 {
                        inset-inline-start: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-17 {
                        inset-inline-end: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-17 {
                        margin-inline-start: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-17 {
                        order: 17;
                    }

                    :where(.css-1588u1j).ant-col-xs-16 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 66.66666666666666%;
                        max-width: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-16 {
                        inset-inline-start: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-16 {
                        inset-inline-end: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-16 {
                        margin-inline-start: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-16 {
                        order: 16;
                    }

                    :where(.css-1588u1j).ant-col-xs-15 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 62.5%;
                        max-width: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-15 {
                        inset-inline-start: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-15 {
                        inset-inline-end: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-15 {
                        margin-inline-start: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-15 {
                        order: 15;
                    }

                    :where(.css-1588u1j).ant-col-xs-14 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 58.333333333333336%;
                        max-width: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-14 {
                        inset-inline-start: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-14 {
                        inset-inline-end: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-14 {
                        margin-inline-start: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-14 {
                        order: 14;
                    }

                    :where(.css-1588u1j).ant-col-xs-13 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 54.166666666666664%;
                        max-width: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-13 {
                        inset-inline-start: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-13 {
                        inset-inline-end: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-13 {
                        margin-inline-start: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-13 {
                        order: 13;
                    }

                    :where(.css-1588u1j).ant-col-xs-12 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 50%;
                        max-width: 50%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-12 {
                        inset-inline-start: 50%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-12 {
                        inset-inline-end: 50%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-12 {
                        margin-inline-start: 50%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-12 {
                        order: 12;
                    }

                    :where(.css-1588u1j).ant-col-xs-11 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 45.83333333333333%;
                        max-width: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-11 {
                        inset-inline-start: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-11 {
                        inset-inline-end: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-11 {
                        margin-inline-start: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-11 {
                        order: 11;
                    }

                    :where(.css-1588u1j).ant-col-xs-10 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 41.66666666666667%;
                        max-width: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-10 {
                        inset-inline-start: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-10 {
                        inset-inline-end: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-10 {
                        margin-inline-start: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-10 {
                        order: 10;
                    }

                    :where(.css-1588u1j).ant-col-xs-9 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 37.5%;
                        max-width: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-9 {
                        inset-inline-start: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-9 {
                        inset-inline-end: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-9 {
                        margin-inline-start: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-9 {
                        order: 9;
                    }

                    :where(.css-1588u1j).ant-col-xs-8 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 33.33333333333333%;
                        max-width: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-8 {
                        inset-inline-start: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-8 {
                        inset-inline-end: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-8 {
                        margin-inline-start: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-8 {
                        order: 8;
                    }

                    :where(.css-1588u1j).ant-col-xs-7 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 29.166666666666668%;
                        max-width: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-7 {
                        inset-inline-start: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-7 {
                        inset-inline-end: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-7 {
                        margin-inline-start: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-7 {
                        order: 7;
                    }

                    :where(.css-1588u1j).ant-col-xs-6 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 25%;
                        max-width: 25%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-6 {
                        inset-inline-start: 25%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-6 {
                        inset-inline-end: 25%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-6 {
                        margin-inline-start: 25%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-6 {
                        order: 6;
                    }

                    :where(.css-1588u1j).ant-col-xs-5 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 20.833333333333336%;
                        max-width: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-5 {
                        inset-inline-start: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-5 {
                        inset-inline-end: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-5 {
                        margin-inline-start: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-5 {
                        order: 5;
                    }

                    :where(.css-1588u1j).ant-col-xs-4 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 16.666666666666664%;
                        max-width: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-4 {
                        inset-inline-start: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-4 {
                        inset-inline-end: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-4 {
                        margin-inline-start: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-4 {
                        order: 4;
                    }

                    :where(.css-1588u1j).ant-col-xs-3 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 12.5%;
                        max-width: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-3 {
                        inset-inline-start: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-3 {
                        inset-inline-end: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-3 {
                        margin-inline-start: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-3 {
                        order: 3;
                    }

                    :where(.css-1588u1j).ant-col-xs-2 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 8.333333333333332%;
                        max-width: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-2 {
                        inset-inline-start: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-2 {
                        inset-inline-end: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-2 {
                        margin-inline-start: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-2 {
                        order: 2;
                    }

                    :where(.css-1588u1j).ant-col-xs-1 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 4.166666666666666%;
                        max-width: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-1 {
                        inset-inline-start: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-1 {
                        inset-inline-end: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-1 {
                        margin-inline-start: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-1 {
                        order: 1;
                    }

                    :where(.css-1588u1j).ant-col-xs-0 {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-col-push-0 {
                        inset-inline-start: auto;
                    }

                    :where(.css-1588u1j).ant-col-pull-0 {
                        inset-inline-end: auto;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-0 {
                        inset-inline-start: auto;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-0 {
                        inset-inline-end: auto;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-0 {
                        margin-inline-start: 0;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-0 {
                        order: 0;
                    }

                    :where(.css-1588u1j).ant-col-xs-flex {
                        flex: var(--ant-col-xs-flex);
                    }

                    @media (min-width: 576px) {
                        :where(.css-1588u1j).ant-col-sm-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-sm-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-sm-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-sm-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-sm-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-sm-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-sm-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-sm-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-sm-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-sm-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-sm-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-sm-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-sm-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-sm-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-sm-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-sm-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-sm-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-sm-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-sm-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-sm-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-sm-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-sm-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-sm-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-sm-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-sm-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-sm-flex {
                            flex: var(--ant-col-sm-flex);
                        }
                    }

                    @media (min-width: 768px) {
                        :where(.css-1588u1j).ant-col-md-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-md-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-md-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-md-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-md-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-md-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-md-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-md-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-md-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-md-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-md-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-md-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-md-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-md-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-md-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-md-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-md-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-md-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-md-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-md-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-md-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-md-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-md-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-md-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-md-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-md-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-md-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-md-flex {
                            flex: var(--ant-col-md-flex);
                        }
                    }

                    @media (min-width: 992px) {
                        :where(.css-1588u1j).ant-col-lg-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-lg-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-lg-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-lg-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-lg-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-lg-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-lg-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-lg-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-lg-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-lg-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-lg-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-lg-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-lg-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-lg-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-lg-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-lg-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-lg-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-lg-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-lg-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-lg-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-lg-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-lg-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-lg-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-lg-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-lg-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-lg-flex {
                            flex: var(--ant-col-lg-flex);
                        }
                    }

                    @media (min-width: 1200px) {
                        :where(.css-1588u1j).ant-col-xl-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-xl-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-xl-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-xl-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-xl-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-xl-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-xl-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-xl-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-xl-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-xl-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-xl-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-xl-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-xl-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-xl-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-xl-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-xl-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-xl-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-xl-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-xl-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-xl-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-xl-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-xl-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-xl-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-xl-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-xl-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-xl-flex {
                            flex: var(--ant-col-xl-flex);
                        }
                    }

                    @media (min-width: 1600px) {
                        :where(.css-1588u1j).ant-col-xxl-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-xxl-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-xxl-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-xxl-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-xxl-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-xxl-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-xxl-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-xxl-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-xxl-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-xxl-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-xxl-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-xxl-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-xxl-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-xxl-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-xxl-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-xxl-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-xxl-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-xxl-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-xxl-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-xxl-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-xxl-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-xxl-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-xxl-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-xxl-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-xxl-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-xxl-flex {
                            flex: var(--ant-col-xxl-flex);
                        }
                    }
                </style>
                <style>
                    .my_family .family_member_add_card {
                        min-width: 300px;
                    }

                    .my_family .family_member_card img {
                        height: 95px;
                    }

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
                <style>
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

                    :where(.css-1588u1j).ant-row {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-row::before,
                    :where(.css-1588u1j).ant-row::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-row [class^="ant-row"],
                    :where(.css-1588u1j).ant-row [class*=" ant-row"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-row [class^="ant-row"]::before,
                    :where(.css-1588u1j).ant-row [class*=" ant-row"]::before,
                    :where(.css-1588u1j).ant-row [class^="ant-row"]::after,
                    :where(.css-1588u1j).ant-row [class*=" ant-row"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-row {
                        display: flex;
                        flex-flow: row wrap;
                        min-width: 0;
                    }

                    :where(.css-1588u1j).ant-row::before,
                    :where(.css-1588u1j).ant-row::after {
                        display: flex;
                    }

                    :where(.css-1588u1j).ant-row-no-wrap {
                        flex-wrap: nowrap;
                    }

                    :where(.css-1588u1j).ant-row-start {
                        justify-content: flex-start;
                    }

                    :where(.css-1588u1j).ant-row-center {
                        justify-content: center;
                    }

                    :where(.css-1588u1j).ant-row-end {
                        justify-content: flex-end;
                    }

                    :where(.css-1588u1j).ant-row-space-between {
                        justify-content: space-between;
                    }

                    :where(.css-1588u1j).ant-row-space-around {
                        justify-content: space-around;
                    }

                    :where(.css-1588u1j).ant-row-space-evenly {
                        justify-content: space-evenly;
                    }

                    :where(.css-1588u1j).ant-row-top {
                        align-items: flex-start;
                    }

                    :where(.css-1588u1j).ant-row-middle {
                        align-items: center;
                    }

                    :where(.css-1588u1j).ant-row-bottom {
                        align-items: flex-end;
                    }

                    :where(.css-1588u1j).ant-col {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-col::before,
                    :where(.css-1588u1j).ant-col::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-col [class^="ant-col"],
                    :where(.css-1588u1j).ant-col [class*=" ant-col"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-col [class^="ant-col"]::before,
                    :where(.css-1588u1j).ant-col [class*=" ant-col"]::before,
                    :where(.css-1588u1j).ant-col [class^="ant-col"]::after,
                    :where(.css-1588u1j).ant-col [class*=" ant-col"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-col {
                        position: relative;
                        max-width: 100%;
                        min-height: 1px;
                    }

                    :where(.css-1588u1j).ant-col-24 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 100%;
                        max-width: 100%;
                    }

                    :where(.css-1588u1j).ant-col-push-24 {
                        inset-inline-start: 100%;
                    }

                    :where(.css-1588u1j).ant-col-pull-24 {
                        inset-inline-end: 100%;
                    }

                    :where(.css-1588u1j).ant-col-offset-24 {
                        margin-inline-start: 100%;
                    }

                    :where(.css-1588u1j).ant-col-order-24 {
                        order: 24;
                    }

                    :where(.css-1588u1j).ant-col-23 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 95.83333333333334%;
                        max-width: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-push-23 {
                        inset-inline-start: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-pull-23 {
                        inset-inline-end: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-offset-23 {
                        margin-inline-start: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-order-23 {
                        order: 23;
                    }

                    :where(.css-1588u1j).ant-col-22 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 91.66666666666666%;
                        max-width: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-push-22 {
                        inset-inline-start: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-pull-22 {
                        inset-inline-end: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-offset-22 {
                        margin-inline-start: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-order-22 {
                        order: 22;
                    }

                    :where(.css-1588u1j).ant-col-21 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 87.5%;
                        max-width: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-push-21 {
                        inset-inline-start: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-pull-21 {
                        inset-inline-end: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-offset-21 {
                        margin-inline-start: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-order-21 {
                        order: 21;
                    }

                    :where(.css-1588u1j).ant-col-20 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 83.33333333333334%;
                        max-width: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-push-20 {
                        inset-inline-start: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-pull-20 {
                        inset-inline-end: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-offset-20 {
                        margin-inline-start: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-order-20 {
                        order: 20;
                    }

                    :where(.css-1588u1j).ant-col-19 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 79.16666666666666%;
                        max-width: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-push-19 {
                        inset-inline-start: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-pull-19 {
                        inset-inline-end: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-offset-19 {
                        margin-inline-start: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-order-19 {
                        order: 19;
                    }

                    :where(.css-1588u1j).ant-col-18 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 75%;
                        max-width: 75%;
                    }

                    :where(.css-1588u1j).ant-col-push-18 {
                        inset-inline-start: 75%;
                    }

                    :where(.css-1588u1j).ant-col-pull-18 {
                        inset-inline-end: 75%;
                    }

                    :where(.css-1588u1j).ant-col-offset-18 {
                        margin-inline-start: 75%;
                    }

                    :where(.css-1588u1j).ant-col-order-18 {
                        order: 18;
                    }

                    :where(.css-1588u1j).ant-col-17 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 70.83333333333334%;
                        max-width: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-push-17 {
                        inset-inline-start: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-pull-17 {
                        inset-inline-end: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-offset-17 {
                        margin-inline-start: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-order-17 {
                        order: 17;
                    }

                    :where(.css-1588u1j).ant-col-16 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 66.66666666666666%;
                        max-width: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-push-16 {
                        inset-inline-start: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-pull-16 {
                        inset-inline-end: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-offset-16 {
                        margin-inline-start: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-order-16 {
                        order: 16;
                    }

                    :where(.css-1588u1j).ant-col-15 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 62.5%;
                        max-width: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-push-15 {
                        inset-inline-start: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-pull-15 {
                        inset-inline-end: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-offset-15 {
                        margin-inline-start: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-order-15 {
                        order: 15;
                    }

                    :where(.css-1588u1j).ant-col-14 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 58.333333333333336%;
                        max-width: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-push-14 {
                        inset-inline-start: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-pull-14 {
                        inset-inline-end: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-offset-14 {
                        margin-inline-start: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-order-14 {
                        order: 14;
                    }

                    :where(.css-1588u1j).ant-col-13 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 54.166666666666664%;
                        max-width: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-push-13 {
                        inset-inline-start: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-pull-13 {
                        inset-inline-end: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-offset-13 {
                        margin-inline-start: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-order-13 {
                        order: 13;
                    }

                    :where(.css-1588u1j).ant-col-12 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 50%;
                        max-width: 50%;
                    }

                    :where(.css-1588u1j).ant-col-push-12 {
                        inset-inline-start: 50%;
                    }

                    :where(.css-1588u1j).ant-col-pull-12 {
                        inset-inline-end: 50%;
                    }

                    :where(.css-1588u1j).ant-col-offset-12 {
                        margin-inline-start: 50%;
                    }

                    :where(.css-1588u1j).ant-col-order-12 {
                        order: 12;
                    }

                    :where(.css-1588u1j).ant-col-11 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 45.83333333333333%;
                        max-width: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-push-11 {
                        inset-inline-start: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-pull-11 {
                        inset-inline-end: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-offset-11 {
                        margin-inline-start: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-order-11 {
                        order: 11;
                    }

                    :where(.css-1588u1j).ant-col-10 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 41.66666666666667%;
                        max-width: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-push-10 {
                        inset-inline-start: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-pull-10 {
                        inset-inline-end: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-offset-10 {
                        margin-inline-start: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-order-10 {
                        order: 10;
                    }

                    :where(.css-1588u1j).ant-col-9 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 37.5%;
                        max-width: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-push-9 {
                        inset-inline-start: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-pull-9 {
                        inset-inline-end: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-offset-9 {
                        margin-inline-start: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-order-9 {
                        order: 9;
                    }

                    :where(.css-1588u1j).ant-col-8 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 33.33333333333333%;
                        max-width: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-push-8 {
                        inset-inline-start: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-pull-8 {
                        inset-inline-end: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-offset-8 {
                        margin-inline-start: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-order-8 {
                        order: 8;
                    }

                    :where(.css-1588u1j).ant-col-7 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 29.166666666666668%;
                        max-width: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-push-7 {
                        inset-inline-start: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-pull-7 {
                        inset-inline-end: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-offset-7 {
                        margin-inline-start: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-order-7 {
                        order: 7;
                    }

                    :where(.css-1588u1j).ant-col-6 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 25%;
                        max-width: 25%;
                    }

                    :where(.css-1588u1j).ant-col-push-6 {
                        inset-inline-start: 25%;
                    }

                    :where(.css-1588u1j).ant-col-pull-6 {
                        inset-inline-end: 25%;
                    }

                    :where(.css-1588u1j).ant-col-offset-6 {
                        margin-inline-start: 25%;
                    }

                    :where(.css-1588u1j).ant-col-order-6 {
                        order: 6;
                    }

                    :where(.css-1588u1j).ant-col-5 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 20.833333333333336%;
                        max-width: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-push-5 {
                        inset-inline-start: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-pull-5 {
                        inset-inline-end: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-offset-5 {
                        margin-inline-start: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-order-5 {
                        order: 5;
                    }

                    :where(.css-1588u1j).ant-col-4 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 16.666666666666664%;
                        max-width: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-push-4 {
                        inset-inline-start: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-pull-4 {
                        inset-inline-end: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-offset-4 {
                        margin-inline-start: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-order-4 {
                        order: 4;
                    }

                    :where(.css-1588u1j).ant-col-3 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 12.5%;
                        max-width: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-push-3 {
                        inset-inline-start: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-pull-3 {
                        inset-inline-end: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-offset-3 {
                        margin-inline-start: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-order-3 {
                        order: 3;
                    }

                    :where(.css-1588u1j).ant-col-2 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 8.333333333333332%;
                        max-width: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-push-2 {
                        inset-inline-start: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-pull-2 {
                        inset-inline-end: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-offset-2 {
                        margin-inline-start: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-order-2 {
                        order: 2;
                    }

                    :where(.css-1588u1j).ant-col-1 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 4.166666666666666%;
                        max-width: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-push-1 {
                        inset-inline-start: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-pull-1 {
                        inset-inline-end: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-offset-1 {
                        margin-inline-start: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-order-1 {
                        order: 1;
                    }

                    :where(.css-1588u1j).ant-col-0 {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-col-push-0 {
                        inset-inline-start: auto;
                    }

                    :where(.css-1588u1j).ant-col-pull-0 {
                        inset-inline-end: auto;
                    }

                    :where(.css-1588u1j).ant-col-offset-0 {
                        margin-inline-start: 0;
                    }

                    :where(.css-1588u1j).ant-col-order-0 {
                        order: 0;
                    }

                    :where(.css-1588u1j).ant-col-flex {
                        flex: var(--ant-col-flex);
                    }

                    :where(.css-1588u1j).ant-col-xs-24 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 100%;
                        max-width: 100%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-24 {
                        inset-inline-start: 100%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-24 {
                        inset-inline-end: 100%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-24 {
                        margin-inline-start: 100%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-24 {
                        order: 24;
                    }

                    :where(.css-1588u1j).ant-col-xs-23 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 95.83333333333334%;
                        max-width: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-23 {
                        inset-inline-start: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-23 {
                        inset-inline-end: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-23 {
                        margin-inline-start: 95.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-23 {
                        order: 23;
                    }

                    :where(.css-1588u1j).ant-col-xs-22 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 91.66666666666666%;
                        max-width: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-22 {
                        inset-inline-start: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-22 {
                        inset-inline-end: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-22 {
                        margin-inline-start: 91.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-22 {
                        order: 22;
                    }

                    :where(.css-1588u1j).ant-col-xs-21 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 87.5%;
                        max-width: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-21 {
                        inset-inline-start: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-21 {
                        inset-inline-end: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-21 {
                        margin-inline-start: 87.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-21 {
                        order: 21;
                    }

                    :where(.css-1588u1j).ant-col-xs-20 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 83.33333333333334%;
                        max-width: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-20 {
                        inset-inline-start: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-20 {
                        inset-inline-end: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-20 {
                        margin-inline-start: 83.33333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-20 {
                        order: 20;
                    }

                    :where(.css-1588u1j).ant-col-xs-19 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 79.16666666666666%;
                        max-width: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-19 {
                        inset-inline-start: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-19 {
                        inset-inline-end: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-19 {
                        margin-inline-start: 79.16666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-19 {
                        order: 19;
                    }

                    :where(.css-1588u1j).ant-col-xs-18 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 75%;
                        max-width: 75%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-18 {
                        inset-inline-start: 75%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-18 {
                        inset-inline-end: 75%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-18 {
                        margin-inline-start: 75%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-18 {
                        order: 18;
                    }

                    :where(.css-1588u1j).ant-col-xs-17 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 70.83333333333334%;
                        max-width: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-17 {
                        inset-inline-start: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-17 {
                        inset-inline-end: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-17 {
                        margin-inline-start: 70.83333333333334%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-17 {
                        order: 17;
                    }

                    :where(.css-1588u1j).ant-col-xs-16 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 66.66666666666666%;
                        max-width: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-16 {
                        inset-inline-start: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-16 {
                        inset-inline-end: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-16 {
                        margin-inline-start: 66.66666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-16 {
                        order: 16;
                    }

                    :where(.css-1588u1j).ant-col-xs-15 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 62.5%;
                        max-width: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-15 {
                        inset-inline-start: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-15 {
                        inset-inline-end: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-15 {
                        margin-inline-start: 62.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-15 {
                        order: 15;
                    }

                    :where(.css-1588u1j).ant-col-xs-14 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 58.333333333333336%;
                        max-width: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-14 {
                        inset-inline-start: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-14 {
                        inset-inline-end: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-14 {
                        margin-inline-start: 58.333333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-14 {
                        order: 14;
                    }

                    :where(.css-1588u1j).ant-col-xs-13 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 54.166666666666664%;
                        max-width: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-13 {
                        inset-inline-start: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-13 {
                        inset-inline-end: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-13 {
                        margin-inline-start: 54.166666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-13 {
                        order: 13;
                    }

                    :where(.css-1588u1j).ant-col-xs-12 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 50%;
                        max-width: 50%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-12 {
                        inset-inline-start: 50%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-12 {
                        inset-inline-end: 50%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-12 {
                        margin-inline-start: 50%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-12 {
                        order: 12;
                    }

                    :where(.css-1588u1j).ant-col-xs-11 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 45.83333333333333%;
                        max-width: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-11 {
                        inset-inline-start: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-11 {
                        inset-inline-end: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-11 {
                        margin-inline-start: 45.83333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-11 {
                        order: 11;
                    }

                    :where(.css-1588u1j).ant-col-xs-10 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 41.66666666666667%;
                        max-width: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-10 {
                        inset-inline-start: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-10 {
                        inset-inline-end: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-10 {
                        margin-inline-start: 41.66666666666667%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-10 {
                        order: 10;
                    }

                    :where(.css-1588u1j).ant-col-xs-9 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 37.5%;
                        max-width: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-9 {
                        inset-inline-start: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-9 {
                        inset-inline-end: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-9 {
                        margin-inline-start: 37.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-9 {
                        order: 9;
                    }

                    :where(.css-1588u1j).ant-col-xs-8 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 33.33333333333333%;
                        max-width: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-8 {
                        inset-inline-start: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-8 {
                        inset-inline-end: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-8 {
                        margin-inline-start: 33.33333333333333%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-8 {
                        order: 8;
                    }

                    :where(.css-1588u1j).ant-col-xs-7 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 29.166666666666668%;
                        max-width: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-7 {
                        inset-inline-start: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-7 {
                        inset-inline-end: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-7 {
                        margin-inline-start: 29.166666666666668%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-7 {
                        order: 7;
                    }

                    :where(.css-1588u1j).ant-col-xs-6 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 25%;
                        max-width: 25%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-6 {
                        inset-inline-start: 25%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-6 {
                        inset-inline-end: 25%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-6 {
                        margin-inline-start: 25%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-6 {
                        order: 6;
                    }

                    :where(.css-1588u1j).ant-col-xs-5 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 20.833333333333336%;
                        max-width: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-5 {
                        inset-inline-start: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-5 {
                        inset-inline-end: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-5 {
                        margin-inline-start: 20.833333333333336%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-5 {
                        order: 5;
                    }

                    :where(.css-1588u1j).ant-col-xs-4 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 16.666666666666664%;
                        max-width: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-4 {
                        inset-inline-start: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-4 {
                        inset-inline-end: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-4 {
                        margin-inline-start: 16.666666666666664%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-4 {
                        order: 4;
                    }

                    :where(.css-1588u1j).ant-col-xs-3 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 12.5%;
                        max-width: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-3 {
                        inset-inline-start: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-3 {
                        inset-inline-end: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-3 {
                        margin-inline-start: 12.5%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-3 {
                        order: 3;
                    }

                    :where(.css-1588u1j).ant-col-xs-2 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 8.333333333333332%;
                        max-width: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-2 {
                        inset-inline-start: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-2 {
                        inset-inline-end: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-2 {
                        margin-inline-start: 8.333333333333332%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-2 {
                        order: 2;
                    }

                    :where(.css-1588u1j).ant-col-xs-1 {
                        --ant-display: block;
                        display: block;
                        display: var(--ant-display);
                        flex: 0 0 4.166666666666666%;
                        max-width: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-1 {
                        inset-inline-start: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-1 {
                        inset-inline-end: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-1 {
                        margin-inline-start: 4.166666666666666%;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-1 {
                        order: 1;
                    }

                    :where(.css-1588u1j).ant-col-xs-0 {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-col-push-0 {
                        inset-inline-start: auto;
                    }

                    :where(.css-1588u1j).ant-col-pull-0 {
                        inset-inline-end: auto;
                    }

                    :where(.css-1588u1j).ant-col-xs-push-0 {
                        inset-inline-start: auto;
                    }

                    :where(.css-1588u1j).ant-col-xs-pull-0 {
                        inset-inline-end: auto;
                    }

                    :where(.css-1588u1j).ant-col-xs-offset-0 {
                        margin-inline-start: 0;
                    }

                    :where(.css-1588u1j).ant-col-xs-order-0 {
                        order: 0;
                    }

                    :where(.css-1588u1j).ant-col-xs-flex {
                        flex: var(--ant-col-xs-flex);
                    }

                    @media (min-width: 576px) {
                        :where(.css-1588u1j).ant-col-sm-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-sm-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-sm-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-sm-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-sm-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-sm-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-sm-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-sm-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-sm-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-sm-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-sm-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-sm-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-sm-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-sm-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-sm-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-sm-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-sm-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-sm-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-sm-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-sm-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-sm-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-sm-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-sm-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-sm-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-sm-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-sm-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-sm-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-sm-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-sm-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-sm-flex {
                            flex: var(--ant-col-sm-flex);
                        }
                    }

                    @media (min-width: 768px) {
                        :where(.css-1588u1j).ant-col-md-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-md-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-md-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-md-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-md-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-md-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-md-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-md-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-md-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-md-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-md-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-md-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-md-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-md-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-md-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-md-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-md-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-md-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-md-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-md-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-md-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-md-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-md-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-md-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-md-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-md-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-md-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-md-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-md-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-md-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-md-flex {
                            flex: var(--ant-col-md-flex);
                        }
                    }

                    @media (min-width: 992px) {
                        :where(.css-1588u1j).ant-col-lg-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-lg-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-lg-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-lg-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-lg-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-lg-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-lg-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-lg-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-lg-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-lg-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-lg-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-lg-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-lg-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-lg-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-lg-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-lg-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-lg-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-lg-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-lg-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-lg-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-lg-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-lg-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-lg-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-lg-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-lg-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-lg-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-lg-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-lg-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-lg-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-lg-flex {
                            flex: var(--ant-col-lg-flex);
                        }
                    }

                    @media (min-width: 1200px) {
                        :where(.css-1588u1j).ant-col-xl-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-xl-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-xl-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-xl-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-xl-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-xl-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-xl-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-xl-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-xl-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-xl-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-xl-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-xl-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-xl-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-xl-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-xl-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-xl-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-xl-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-xl-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-xl-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-xl-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-xl-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-xl-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-xl-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-xl-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-xl-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-xl-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-xl-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-xl-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-xl-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-xl-flex {
                            flex: var(--ant-col-xl-flex);
                        }
                    }

                    @media (min-width: 1600px) {
                        :where(.css-1588u1j).ant-col-xxl-24 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-24 {
                            inset-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-24 {
                            inset-inline-end: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-24 {
                            margin-inline-start: 100%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-24 {
                            order: 24;
                        }

                        :where(.css-1588u1j).ant-col-xxl-23 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 95.83333333333334%;
                            max-width: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-23 {
                            inset-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-23 {
                            inset-inline-end: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-23 {
                            margin-inline-start: 95.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-23 {
                            order: 23;
                        }

                        :where(.css-1588u1j).ant-col-xxl-22 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 91.66666666666666%;
                            max-width: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-22 {
                            inset-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-22 {
                            inset-inline-end: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-22 {
                            margin-inline-start: 91.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-22 {
                            order: 22;
                        }

                        :where(.css-1588u1j).ant-col-xxl-21 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 87.5%;
                            max-width: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-21 {
                            inset-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-21 {
                            inset-inline-end: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-21 {
                            margin-inline-start: 87.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-21 {
                            order: 21;
                        }

                        :where(.css-1588u1j).ant-col-xxl-20 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 83.33333333333334%;
                            max-width: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-20 {
                            inset-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-20 {
                            inset-inline-end: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-20 {
                            margin-inline-start: 83.33333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-20 {
                            order: 20;
                        }

                        :where(.css-1588u1j).ant-col-xxl-19 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 79.16666666666666%;
                            max-width: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-19 {
                            inset-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-19 {
                            inset-inline-end: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-19 {
                            margin-inline-start: 79.16666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-19 {
                            order: 19;
                        }

                        :where(.css-1588u1j).ant-col-xxl-18 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 75%;
                            max-width: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-18 {
                            inset-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-18 {
                            inset-inline-end: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-18 {
                            margin-inline-start: 75%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-18 {
                            order: 18;
                        }

                        :where(.css-1588u1j).ant-col-xxl-17 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 70.83333333333334%;
                            max-width: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-17 {
                            inset-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-17 {
                            inset-inline-end: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-17 {
                            margin-inline-start: 70.83333333333334%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-17 {
                            order: 17;
                        }

                        :where(.css-1588u1j).ant-col-xxl-16 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 66.66666666666666%;
                            max-width: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-16 {
                            inset-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-16 {
                            inset-inline-end: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-16 {
                            margin-inline-start: 66.66666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-16 {
                            order: 16;
                        }

                        :where(.css-1588u1j).ant-col-xxl-15 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 62.5%;
                            max-width: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-15 {
                            inset-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-15 {
                            inset-inline-end: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-15 {
                            margin-inline-start: 62.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-15 {
                            order: 15;
                        }

                        :where(.css-1588u1j).ant-col-xxl-14 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 58.333333333333336%;
                            max-width: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-14 {
                            inset-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-14 {
                            inset-inline-end: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-14 {
                            margin-inline-start: 58.333333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-14 {
                            order: 14;
                        }

                        :where(.css-1588u1j).ant-col-xxl-13 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 54.166666666666664%;
                            max-width: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-13 {
                            inset-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-13 {
                            inset-inline-end: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-13 {
                            margin-inline-start: 54.166666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-13 {
                            order: 13;
                        }

                        :where(.css-1588u1j).ant-col-xxl-12 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 50%;
                            max-width: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-12 {
                            inset-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-12 {
                            inset-inline-end: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-12 {
                            margin-inline-start: 50%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-12 {
                            order: 12;
                        }

                        :where(.css-1588u1j).ant-col-xxl-11 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 45.83333333333333%;
                            max-width: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-11 {
                            inset-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-11 {
                            inset-inline-end: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-11 {
                            margin-inline-start: 45.83333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-11 {
                            order: 11;
                        }

                        :where(.css-1588u1j).ant-col-xxl-10 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 41.66666666666667%;
                            max-width: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-10 {
                            inset-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-10 {
                            inset-inline-end: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-10 {
                            margin-inline-start: 41.66666666666667%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-10 {
                            order: 10;
                        }

                        :where(.css-1588u1j).ant-col-xxl-9 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 37.5%;
                            max-width: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-9 {
                            inset-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-9 {
                            inset-inline-end: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-9 {
                            margin-inline-start: 37.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-9 {
                            order: 9;
                        }

                        :where(.css-1588u1j).ant-col-xxl-8 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 33.33333333333333%;
                            max-width: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-8 {
                            inset-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-8 {
                            inset-inline-end: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-8 {
                            margin-inline-start: 33.33333333333333%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-8 {
                            order: 8;
                        }

                        :where(.css-1588u1j).ant-col-xxl-7 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 29.166666666666668%;
                            max-width: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-7 {
                            inset-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-7 {
                            inset-inline-end: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-7 {
                            margin-inline-start: 29.166666666666668%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-7 {
                            order: 7;
                        }

                        :where(.css-1588u1j).ant-col-xxl-6 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 25%;
                            max-width: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-6 {
                            inset-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-6 {
                            inset-inline-end: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-6 {
                            margin-inline-start: 25%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-6 {
                            order: 6;
                        }

                        :where(.css-1588u1j).ant-col-xxl-5 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 20.833333333333336%;
                            max-width: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-5 {
                            inset-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-5 {
                            inset-inline-end: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-5 {
                            margin-inline-start: 20.833333333333336%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-5 {
                            order: 5;
                        }

                        :where(.css-1588u1j).ant-col-xxl-4 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 16.666666666666664%;
                            max-width: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-4 {
                            inset-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-4 {
                            inset-inline-end: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-4 {
                            margin-inline-start: 16.666666666666664%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-4 {
                            order: 4;
                        }

                        :where(.css-1588u1j).ant-col-xxl-3 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 12.5%;
                            max-width: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-3 {
                            inset-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-3 {
                            inset-inline-end: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-3 {
                            margin-inline-start: 12.5%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-3 {
                            order: 3;
                        }

                        :where(.css-1588u1j).ant-col-xxl-2 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 8.333333333333332%;
                            max-width: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-2 {
                            inset-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-2 {
                            inset-inline-end: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-2 {
                            margin-inline-start: 8.333333333333332%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-2 {
                            order: 2;
                        }

                        :where(.css-1588u1j).ant-col-xxl-1 {
                            --ant-display: block;
                            display: block;
                            display: var(--ant-display);
                            flex: 0 0 4.166666666666666%;
                            max-width: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-1 {
                            inset-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-1 {
                            inset-inline-end: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-1 {
                            margin-inline-start: 4.166666666666666%;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-1 {
                            order: 1;
                        }

                        :where(.css-1588u1j).ant-col-xxl-0 {
                            display: none;
                        }

                        :where(.css-1588u1j).ant-col-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-xxl-push-0 {
                            inset-inline-start: auto;
                        }

                        :where(.css-1588u1j).ant-col-xxl-pull-0 {
                            inset-inline-end: auto;
                        }

                        :where(.css-1588u1j).ant-col-xxl-offset-0 {
                            margin-inline-start: 0;
                        }

                        :where(.css-1588u1j).ant-col-xxl-order-0 {
                            order: 0;
                        }

                        :where(.css-1588u1j).ant-col-xxl-flex {
                            flex: var(--ant-col-xxl-flex);
                        }
                    }

                    :where(.css-1588u1j)[class^="ant-image"],
                    :where(.css-1588u1j)[class*=" ant-image"] {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-image"]::before,
                    :where(.css-1588u1j)[class*=" ant-image"]::before,
                    :where(.css-1588u1j)[class^="ant-image"]::after,
                    :where(.css-1588u1j)[class*=" ant-image"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-image"] [class^="ant-image"],
                    :where(.css-1588u1j)[class*=" ant-image"] [class^="ant-image"],
                    :where(.css-1588u1j)[class^="ant-image"] [class*=" ant-image"],
                    :where(.css-1588u1j)[class*=" ant-image"] [class*=" ant-image"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-image"] [class^="ant-image"]::before,
                    :where(.css-1588u1j)[class*=" ant-image"] [class^="ant-image"]::before,
                    :where(.css-1588u1j)[class^="ant-image"] [class*=" ant-image"]::before,
                    :where(.css-1588u1j)[class*=" ant-image"] [class*=" ant-image"]::before,
                    :where(.css-1588u1j)[class^="ant-image"] [class^="ant-image"]::after,
                    :where(.css-1588u1j)[class*=" ant-image"] [class^="ant-image"]::after,
                    :where(.css-1588u1j)[class^="ant-image"] [class*=" ant-image"]::after,
                    :where(.css-1588u1j)[class*=" ant-image"] [class*=" ant-image"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-image {
                        position: relative;
                        display: inline-block;
                    }

                    :where(.css-1588u1j).ant-image .ant-image-img {
                        width: 100%;
                        height: auto;
                        vertical-align: middle;
                    }

                    :where(.css-1588u1j).ant-image .ant-image-img-placeholder {
                        background-color: rgba(0, 0, 0, 0.04);
                        background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTQuNSAyLjVoLTEzQS41LjUgMCAwIDAgMSAzdjEwYS41LjUgMCAwIDAgLjUuNWgxM2EuNS41IDAgMCAwIC41LS41VjNhLjUuNSAwIDAgMC0uNS0uNXpNNS4yODEgNC43NWExIDEgMCAwIDEgMCAyIDEgMSAwIDAgMSAwLTJ6bTguMDMgNi44M2EuMTI3LjEyNyAwIDAgMS0uMDgxLjAzSDIuNzY5YS4xMjUuMTI1IDAgMCAxLS4wOTYtLjIwN2wyLjY2MS0zLjE1NmEuMTI2LjEyNiAwIDAgMSAuMTc3LS4wMTZsLjAxNi4wMTZMNy4wOCAxMC4wOWwyLjQ3LTIuOTNhLjEyNi4xMjYgMCAwIDEgLjE3Ny0uMDE2bC4wMTUuMDE2IDMuNTg4IDQuMjQ0YS4xMjcuMTI3IDAgMCAxLS4wMi4xNzV6IiBmaWxsPSIjOEM4QzhDIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48L3N2Zz4=');
                        background-repeat: no-repeat;
                        background-position: center center;
                        background-size: 30%;
                    }

                    :where(.css-1588u1j).ant-image .ant-image-mask {
                        position: absolute;
                        inset: 0;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: #fff;
                        background: rgba(0, 0, 0, 0.5);
                        cursor: pointer;
                        opacity: 0;
                        transition: opacity 0.3s;
                    }

                    :where(.css-1588u1j).ant-image .ant-image-mask .ant-image-mask-info {
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                        padding: 0 4px;
                    }

                    :where(.css-1588u1j).ant-image .ant-image-mask .ant-image-mask-info .anticon {
                        margin-inline-end: 4px;
                    }

                    :where(.css-1588u1j).ant-image .ant-image-mask .ant-image-mask-info .anticon svg {
                        vertical-align: baseline;
                    }

                    :where(.css-1588u1j).ant-image .ant-image-mask:hover {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-image .ant-image-placeholder {
                        position: absolute;
                        inset: 0;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview {
                        height: 100%;
                        text-align: center;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-body {
                        position: absolute;
                        inset: 0;
                        overflow: hidden;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-img {
                        max-width: 100%;
                        max-height: 70%;
                        vertical-align: middle;
                        transform: scale3d(1, 1, 1);
                        cursor: grab;
                        transition: transform 0.3s cubic-bezier(0.215, 0.61, 0.355, 1) 0s;
                        user-select: none;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-img-wrapper {
                        position: absolute;
                        inset: 0;
                        transition: transform 0.3s cubic-bezier(0.215, 0.61, 0.355, 1) 0s;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-img-wrapper>* {
                        pointer-events: auto;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-img-wrapper::before {
                        display: inline-block;
                        width: 1px;
                        height: 50%;
                        margin-inline-end: -1px;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-moving .ant-image-preview-preview-img {
                        cursor: grabbing;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-moving .ant-image-preview-preview-img-wrapper {
                        transition-duration: 0s;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-wrap {
                        z-index: 1080;
                    }

                    :where(.css-1588u1j).ant-image-preview-operations-wrapper {
                        position: fixed;
                        z-index: 1081;
                    }

                    :where(.css-1588u1j) .ant-image-preview-footer {
                        position: fixed;
                        bottom: 32px;
                        left: 50%;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        color: rgba(255, 255, 255, 0.65);
                        transform: translateX(-50%);
                    }

                    :where(.css-1588u1j) .ant-image-preview-progress {
                        margin-bottom: 16px;
                    }

                    :where(.css-1588u1j) .ant-image-preview-close {
                        position: fixed;
                        top: 32px;
                        right: 32px;
                        display: flex;
                        color: #fff;
                        background-color: rgba(0, 0, 0, 0.1);
                        border-radius: 50%;
                        padding: 12px;
                        outline: 0;
                        border: 0;
                        cursor: pointer;
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j) .ant-image-preview-close:hover {
                        background-color: rgba(0, 0, 0, 0.2);
                    }

                    :where(.css-1588u1j) .ant-image-preview-close>.anticon {
                        font-size: 18px;
                    }

                    :where(.css-1588u1j) .ant-image-preview-operations {
                        display: flex;
                        align-items: center;
                        padding: 0 24px;
                        background-color: rgba(0, 0, 0, 0.1);
                        border-radius: 100px;
                    }

                    :where(.css-1588u1j) .ant-image-preview-operations-operation {
                        margin-inline-start: 12px;
                        padding: 12px;
                        cursor: pointer;
                        transition: all 0.3s;
                        user-select: none;
                    }

                    :where(.css-1588u1j) .ant-image-preview-operations-operation:not(.ant-image-preview-operations-operation-disabled):hover>.anticon {
                        color: rgba(255, 255, 255, 0.85);
                    }

                    :where(.css-1588u1j) .ant-image-preview-operations-operation-disabled {
                        color: rgba(255, 255, 255, 0.25);
                        cursor: not-allowed;
                    }

                    :where(.css-1588u1j) .ant-image-preview-operations-operation:first-of-type {
                        margin-inline-start: 0;
                    }

                    :where(.css-1588u1j) .ant-image-preview-operations-operation>.anticon {
                        font-size: 18px;
                    }

                    :where(.css-1588u1j) .ant-image-preview-switch-left,
                    :where(.css-1588u1j) .ant-image-preview-switch-right {
                        position: fixed;
                        inset-block-start: 50%;
                        z-index: 1081;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        width: 40px;
                        height: 40px;
                        margin-top: -20px;
                        color: rgba(255, 255, 255, 0.65);
                        background: rgba(0, 0, 0, 0.1);
                        border-radius: 50%;
                        transform: translateY(-50%);
                        cursor: pointer;
                        transition: all 0.3s;
                        user-select: none;
                    }

                    :where(.css-1588u1j) .ant-image-preview-switch-left:hover,
                    :where(.css-1588u1j) .ant-image-preview-switch-right:hover {
                        background: rgba(0, 0, 0, 0.2);
                    }

                    :where(.css-1588u1j) .ant-image-preview-switch-left-disabled,
                    :where(.css-1588u1j) .ant-image-preview-switch-right-disabled,
                    :where(.css-1588u1j) .ant-image-preview-switch-left-disabled:hover,
                    :where(.css-1588u1j) .ant-image-preview-switch-right-disabled:hover {
                        color: rgba(255, 255, 255, 0.25);
                        background: transparent;
                        cursor: not-allowed;
                    }

                    :where(.css-1588u1j) .ant-image-preview-switch-left-disabled>.anticon,
                    :where(.css-1588u1j) .ant-image-preview-switch-right-disabled>.anticon,
                    :where(.css-1588u1j) .ant-image-preview-switch-left-disabled:hover>.anticon,
                    :where(.css-1588u1j) .ant-image-preview-switch-right-disabled:hover>.anticon {
                        cursor: not-allowed;
                    }

                    :where(.css-1588u1j) .ant-image-preview-switch-left>.anticon,
                    :where(.css-1588u1j) .ant-image-preview-switch-right>.anticon {
                        font-size: 18px;
                    }

                    :where(.css-1588u1j) .ant-image-preview-switch-left {
                        inset-inline-start: 12px;
                    }

                    :where(.css-1588u1j) .ant-image-preview-switch-right {
                        inset-inline-end: 12px;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview.ant-zoom-enter,
                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview.ant-zoom-appear {
                        transform: none;
                        opacity: 0;
                        animation-duration: 0.3s;
                        user-select: none;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview.ant-zoom-leave .ant-image-preview-content {
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-mask {
                        position: fixed;
                        inset: 0;
                        z-index: 1000;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.45);
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-mask .ant-image-preview-hidden {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-image-preview-wrap {
                        position: fixed;
                        inset: 0;
                        z-index: 1000;
                        overflow: auto;
                        outline: 0;
                        -webkit-overflow-scrolling: touch;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-fade-enter,
                    :where(.css-1588u1j).ant-image-preview-root .ant-fade-appear {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-fade-leave {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-fade-enter.ant-fade-enter-active,
                    :where(.css-1588u1j).ant-image-preview-root .ant-fade-appear.ant-fade-appear-active {
                        animation-name: css-1588u1j-antFadeIn;
                        animation-play-state: running;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-fade-leave.ant-fade-leave-active {
                        animation-name: css-1588u1j-antFadeOut;
                        animation-play-state: running;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-fade-enter,
                    :where(.css-1588u1j).ant-image-preview-root .ant-fade-appear {
                        opacity: 0;
                        animation-timing-function: linear;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-fade-leave {
                        animation-timing-function: linear;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-enter,
                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-appear {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-leave {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-enter.ant-zoom-enter-active,
                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-appear.ant-zoom-appear-active {
                        animation-name: css-1588u1j-antZoomIn;
                        animation-play-state: running;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-leave.ant-zoom-leave-active {
                        animation-name: css-1588u1j-antZoomOut;
                        animation-play-state: running;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-enter,
                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-appear {
                        transform: scale(0);
                        opacity: 0;
                        animation-timing-function: cubic-bezier(0.08, 0.82, 0.17, 1);
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-enter-prepare,
                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-appear-prepare {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-image-preview-root .ant-zoom-leave {
                        animation-timing-function: cubic-bezier(0.78, 0.14, 0.15, 0.86);
                    }

                    :where(.css-1588u1j).ant-fade-enter,
                    :where(.css-1588u1j).ant-fade-appear {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-fade-leave {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-fade-enter.ant-fade-enter-active,
                    :where(.css-1588u1j).ant-fade-appear.ant-fade-appear-active {
                        animation-name: css-1588u1j-antFadeIn;
                        animation-play-state: running;
                    }

                    :where(.css-1588u1j).ant-fade-leave.ant-fade-leave-active {
                        animation-name: css-1588u1j-antFadeOut;
                        animation-play-state: running;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-fade-enter,
                    :where(.css-1588u1j).ant-fade-appear {
                        opacity: 0;
                        animation-timing-function: linear;
                    }

                    :where(.css-1588u1j).ant-fade-leave {
                        animation-timing-function: linear;
                    }

                    @keyframes css-1588u1j-antFadeIn {
                        0% {
                            opacity: 0;
                        }

                        100% {
                            opacity: 1;
                        }
                    }

                    @keyframes css-1588u1j-antFadeOut {
                        0% {
                            opacity: 1;
                        }

                        100% {
                            opacity: 0;
                        }
                    }

                    @keyframes css-1588u1j-antZoomIn {
                        0% {
                            transform: scale(0.2);
                            opacity: 0;
                        }

                        100% {
                            transform: scale(1);
                            opacity: 1;
                        }
                    }

                    @keyframes css-1588u1j-antZoomOut {
                        0% {
                            transform: scale(1);
                        }

                        100% {
                            transform: scale(0.2);
                            opacity: 0;
                        }
                    }

                    :where(.css-1588u1j).ant-upload-wrapper {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper::before,
                    :where(.css-1588u1j).ant-upload-wrapper::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper [class^="ant-upload"],
                    :where(.css-1588u1j).ant-upload-wrapper [class*=" ant-upload"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper [class^="ant-upload"]::before,
                    :where(.css-1588u1j).ant-upload-wrapper [class*=" ant-upload"]::before,
                    :where(.css-1588u1j).ant-upload-wrapper [class^="ant-upload"]::after,
                    :where(.css-1588u1j).ant-upload-wrapper [class*=" ant-upload"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload {
                        outline: 0;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload input[type='file'] {
                        cursor: pointer;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-select {
                        display: inline-block;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-disabled {
                        color: rgba(0, 0, 0, 0.25);
                        cursor: not-allowed;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag {
                        position: relative;
                        width: 100%;
                        height: 100%;
                        text-align: center;
                        background: rgba(0, 0, 0, 0.02);
                        border: 1px dashed #d9d9d9;
                        border-radius: 8px;
                        cursor: pointer;
                        transition: border-color 0.3s;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag .ant-upload {
                        padding: 16px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag .ant-upload-btn {
                        display: table;
                        width: 100%;
                        height: 100%;
                        outline: none;
                        border-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag .ant-upload-btn:focus-visible {
                        outline: 4px solid #85868f;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag .ant-upload-drag-container {
                        display: table-cell;
                        vertical-align: middle;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag:not(.ant-upload-disabled):hover,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag-hover:not(.ant-upload-disabled) {
                        border-color: #484b75;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag p.ant-upload-drag-icon {
                        margin-bottom: 16px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag p.ant-upload-drag-icon .anticon {
                        color: #2f3268;
                        font-size: 48px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag p.ant-upload-text {
                        margin: 0 0 4px;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 16px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag p.ant-upload-hint {
                        color: rgba(0, 0, 0, 0.45);
                        font-size: 14px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag.ant-upload-disabled p.ant-upload-drag-icon .anticon,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag.ant-upload-disabled p.ant-upload-text,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-drag.ant-upload-disabled p.ant-upload-hint {
                        color: rgba(0, 0, 0, 0.25);
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item {
                        position: relative;
                        height: 66px;
                        padding: 8px;
                        border: 1px solid #d9d9d9;
                        border-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item:hover,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item:hover,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item:hover {
                        background: transparent;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item .ant-upload-list-item-thumbnail,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item .ant-upload-list-item-thumbnail,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item .ant-upload-list-item-thumbnail {
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                        width: 48px;
                        height: 48px;
                        line-height: 60px;
                        text-align: center;
                        flex: none;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item .ant-upload-list-item-thumbnail .anticon,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item .ant-upload-list-item-thumbnail .anticon,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item .ant-upload-list-item-thumbnail .anticon {
                        font-size: 30px;
                        color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item .ant-upload-list-item-thumbnail img,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item .ant-upload-list-item-thumbnail img,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item .ant-upload-list-item-thumbnail img {
                        display: block;
                        width: 100%;
                        height: 100%;
                        overflow: hidden;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item .ant-upload-list-item-progress,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item .ant-upload-list-item-progress,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item .ant-upload-list-item-progress {
                        bottom: 12px;
                        width: calc(100% - 24px);
                        margin-top: 0;
                        padding-inline-start: 56px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item-error,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-error,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-error {
                        border-color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item-error .ant-upload-list-item-thumbnail .anticon svg path[fill='#e6f4ff'],
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-error .ant-upload-list-item-thumbnail .anticon svg path[fill='#e6f4ff'],
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-error .ant-upload-list-item-thumbnail .anticon svg path[fill='#e6f4ff'] {
                        fill: #fff2f0;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item-error .ant-upload-list-item-thumbnail .anticon svg path[fill='#1677ff'],
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-error .ant-upload-list-item-thumbnail .anticon svg path[fill='#1677ff'],
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-error .ant-upload-list-item-thumbnail .anticon svg path[fill='#1677ff'] {
                        fill: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item-uploading,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading {
                        border-style: dashed;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture .ant-upload-list-item-uploading .ant-upload-list-item-name,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading .ant-upload-list-item-name,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading .ant-upload-list-item-name {
                        margin-bottom: 12px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item::before,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item .ant-upload-list-item-thumbnail {
                        border-radius: 50%;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper {
                        display: block;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper::before {
                        display: table;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper::after,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper::after {
                        display: table;
                        clear: both;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload.ant-upload-select,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload.ant-upload-select {
                        width: 102px;
                        height: 102px;
                        text-align: center;
                        vertical-align: top;
                        background-color: rgba(0, 0, 0, 0.02);
                        border: 1px dashed #d9d9d9;
                        border-radius: 8px;
                        cursor: pointer;
                        transition: border-color 0.3s;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload.ant-upload-select>.ant-upload,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload.ant-upload-select>.ant-upload {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100%;
                        text-align: center;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload.ant-upload-select:not(.ant-upload-disabled):hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload.ant-upload-select:not(.ant-upload-disabled):hover {
                        border-color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle {
                        display: flex;
                        flex-wrap: wrap;
                    }

                    @supports not (gap: 1px) {

                        :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card>*,
                        :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card>*,
                        :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle>*,
                        :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle>* {
                            margin-block-end: 8px;
                            margin-inline-end: 8px;
                        }
                    }

                    @supports (gap: 1px) {

                        :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card,
                        :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card,
                        :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle,
                        :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle {
                            gap: 8px;
                        }
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-container,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-container,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-container,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-container {
                        display: inline-block;
                        width: 102px;
                        height: 102px;
                        vertical-align: top;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card::after,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card::after,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle::after,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle::after {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle::before {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item {
                        height: 100%;
                        margin: 0;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item::before {
                        position: absolute;
                        z-index: 1;
                        width: calc(100% - 16px);
                        height: calc(100% - 16px);
                        background-color: rgba(0, 0, 0, 0.45);
                        opacity: 0;
                        transition: all 0.3s;
                        content: " ";
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item:hover::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item:hover::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item:hover::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item:hover::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item:hover .ant-upload-list-item-actions,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item:hover .ant-upload-list-item-actions,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item:hover .ant-upload-list-item-actions,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item:hover .ant-upload-list-item-actions {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions {
                        position: absolute;
                        inset-inline-start: 0;
                        z-index: 10;
                        width: 100%;
                        white-space: nowrap;
                        text-align: center;
                        opacity: 0;
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-eye,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-eye,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-eye,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-eye,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-download,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-download,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-download,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-download,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-delete,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-delete,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-delete,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-delete {
                        z-index: 10;
                        width: 16px;
                        margin: 0 4px;
                        font-size: 16px;
                        cursor: pointer;
                        transition: all 0.3s;
                        color: #fff;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-eye:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-eye:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-eye:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-eye:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-download:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-download:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-download:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-download:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-delete:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-delete:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-delete:hover,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-delete:hover {
                        color: #fff;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-eye svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-eye svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-eye svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-eye svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-download svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-download svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-download svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-download svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-delete svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-actions .anticon-delete svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-delete svg,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-actions .anticon-delete svg {
                        vertical-align: baseline;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-thumbnail,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-thumbnail,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-thumbnail,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-thumbnail,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-thumbnail img,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-thumbnail img,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-thumbnail img,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-thumbnail img {
                        position: static;
                        display: block;
                        width: 100%;
                        height: 100%;
                        object-fit: contain;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-name,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-name,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-name,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-name {
                        display: none;
                        text-align: center;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-file+.ant-upload-list-item-name,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-file+.ant-upload-list-item-name,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-file+.ant-upload-list-item-name,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-file+.ant-upload-list-item-name {
                        position: absolute;
                        bottom: 16px;
                        display: block;
                        width: calc(100% - 16px);
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading.ant-upload-list-item,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading.ant-upload-list-item,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading.ant-upload-list-item,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading.ant-upload-list-item {
                        background-color: rgba(0, 0, 0, 0.02);
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading::before,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading .anticon-eye,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading .anticon-eye,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading .anticon-eye,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading .anticon-eye,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading .anticon-download,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading .anticon-download,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading .anticon-download,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading .anticon-download,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading .anticon-delete,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-uploading .anticon-delete,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading .anticon-delete,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-uploading .anticon-delete {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-progress,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-progress,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-progress,
                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload-list.ant-upload-list-picture-circle .ant-upload-list-item-progress {
                        bottom: 32px;
                        width: calc(100% - 16px);
                        padding-inline-start: 0;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper.ant-upload-picture-circle-wrapper .ant-upload.ant-upload-select {
                        border-radius: 50%;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list {
                        line-height: 1.5714285714285714;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list::before {
                        display: table;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list::after {
                        display: table;
                        clear: both;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item {
                        position: relative;
                        height: 22px;
                        margin-top: 8px;
                        font-size: 14px;
                        display: flex;
                        align-items: center;
                        transition: background-color 0.3s;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item:hover {
                        background-color: rgba(0, 0, 0, 0.04);
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-list-item-name {
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                        padding: 0 8px;
                        line-height: 1.5714285714285714;
                        flex: auto;
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-list-item-actions {
                        white-space: nowrap;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-list-item-actions .ant-upload-list-item-action {
                        opacity: 0;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-list-item-actions .anticon {
                        color: rgba(0, 0, 0, 0.45);
                        transition: all 0.3s;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-list-item-actions .ant-upload-list-item-action:focus-visible,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-list-item-actions.picture .ant-upload-list-item-action {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-list-item-actions .ant-upload-list-item-action.ant-btn {
                        height: 20px;
                        border: 0;
                        line-height: 1;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-icon .anticon {
                        color: rgba(0, 0, 0, 0.45);
                        font-size: 14px;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-list-item-progress {
                        position: absolute;
                        bottom: -12px;
                        width: 100%;
                        padding-inline-start: 22px;
                        font-size: 14px;
                        line-height: 0;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item .ant-upload-list-item-progress>div {
                        margin: 0;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item:hover .ant-upload-list-item-action {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item-error {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item-error .ant-upload-list-item-name,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item-error .ant-upload-icon .anticon {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item-error .ant-upload-list-item-actions .anticon,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item-error .ant-upload-list-item-actions .anticon:hover {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item-error .ant-upload-list-item-actions .ant-upload-list-item-action {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item-container {
                        transition: opacity 0.3s, height 0.3s;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-list .ant-upload-list-item-container::before {
                        display: table;
                        width: 0;
                        height: 0;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-animate-inline-appear,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-animate-inline-enter,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-animate-inline-leave {
                        animation-duration: 0.3s;
                        animation-timing-function: cubic-bezier(0.78, 0.14, 0.15, 0.86);
                        animation-fill-mode: forwards;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-animate-inline-appear,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-animate-inline-enter {
                        animation-name: css-1588u1j-uploadAnimateInlineIn;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-upload-animate-inline-leave {
                        animation-name: css-1588u1j-uploadAnimateInlineOut;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-fade-enter,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-fade-appear {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-fade-leave {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-fade-enter.ant-fade-enter-active,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-fade-appear.ant-fade-appear-active {
                        animation-name: css-1588u1j-antFadeIn;
                        animation-play-state: running;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-fade-leave.ant-fade-leave-active {
                        animation-name: css-1588u1j-antFadeOut;
                        animation-play-state: running;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-fade-enter,
                    :where(.css-1588u1j).ant-upload-wrapper .ant-fade-appear {
                        opacity: 0;
                        animation-timing-function: linear;
                    }

                    :where(.css-1588u1j).ant-upload-wrapper .ant-fade-leave {
                        animation-timing-function: linear;
                    }

                    :where(.css-1588u1j).ant-upload-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-upload .ant-motion-collapse-legacy {
                        overflow: hidden;
                    }

                    :where(.css-1588u1j).ant-upload .ant-motion-collapse-legacy-active {
                        transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
                    }

                    :where(.css-1588u1j).ant-upload .ant-motion-collapse {
                        overflow: hidden;
                        transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
                    }

                    @keyframes css-1588u1j-uploadAnimateInlineIn {
                        from {
                            width: 0;
                            height: 0;
                            padding: 0;
                            opacity: 0;
                            margin: -4px;
                        }
                    }

                    @keyframes css-1588u1j-uploadAnimateInlineOut {
                        to {
                            width: 0;
                            height: 0;
                            padding: 0;
                            opacity: 0;
                            margin: -4px;
                        }
                    }

                    :where(.css-1588u1j)[class^="ant-modal"],
                    :where(.css-1588u1j)[class*=" ant-modal"] {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-modal"]::before,
                    :where(.css-1588u1j)[class*=" ant-modal"]::before,
                    :where(.css-1588u1j)[class^="ant-modal"]::after,
                    :where(.css-1588u1j)[class*=" ant-modal"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-modal"] [class^="ant-modal"],
                    :where(.css-1588u1j)[class*=" ant-modal"] [class^="ant-modal"],
                    :where(.css-1588u1j)[class^="ant-modal"] [class*=" ant-modal"],
                    :where(.css-1588u1j)[class*=" ant-modal"] [class*=" ant-modal"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-modal"] [class^="ant-modal"]::before,
                    :where(.css-1588u1j)[class*=" ant-modal"] [class^="ant-modal"]::before,
                    :where(.css-1588u1j)[class^="ant-modal"] [class*=" ant-modal"]::before,
                    :where(.css-1588u1j)[class*=" ant-modal"] [class*=" ant-modal"]::before,
                    :where(.css-1588u1j)[class^="ant-modal"] [class^="ant-modal"]::after,
                    :where(.css-1588u1j)[class*=" ant-modal"] [class^="ant-modal"]::after,
                    :where(.css-1588u1j)[class^="ant-modal"] [class*=" ant-modal"]::after,
                    :where(.css-1588u1j)[class*=" ant-modal"] [class*=" ant-modal"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal-wrap-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal-centered {
                        text-align: center;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal-centered::before {
                        display: inline-block;
                        width: 0;
                        height: 100%;
                        vertical-align: middle;
                        content: "";
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal-centered .ant-modal {
                        top: 0;
                        display: inline-block;
                        padding-bottom: 0;
                        text-align: start;
                        vertical-align: middle;
                    }

                    @media (max-width: 767px) {
                        :where(.css-1588u1j).ant-modal-root .ant-modal {
                            max-width: calc(100vw - 16px);
                            margin: 8px auto;
                        }

                        :where(.css-1588u1j).ant-modal-root .ant-modal-centered .ant-modal {
                            flex: 1;
                        }
                    }

                    :where(.css-1588u1j).ant-modal {
                        box-sizing: border-box;
                        margin: 0 auto;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                        pointer-events: none;
                        position: relative;
                        top: 100px;
                        width: auto;
                        max-width: calc(100vw - 32px);
                        padding-bottom: 24px;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-title {
                        margin: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-weight: 600;
                        font-size: 16px;
                        line-height: 1.5;
                        word-wrap: break-word;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-content {
                        position: relative;
                        background-color: #ffffff;
                        background-clip: padding-box;
                        border: 0;
                        border-radius: 8px;
                        box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
                        pointer-events: auto;
                        padding: 20px 24px;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-close {
                        position: absolute;
                        top: 12px;
                        inset-inline-end: 12px;
                        z-index: 1010;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.45);
                        font-weight: 600;
                        line-height: 1;
                        text-decoration: none;
                        background: transparent;
                        border-radius: 4px;
                        width: 32px;
                        height: 32px;
                        border: 0;
                        outline: 0;
                        cursor: pointer;
                        transition: color 0.2s, background-color 0.2s;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-close-x {
                        display: flex;
                        font-size: 16px;
                        font-style: normal;
                        line-height: 32px;
                        justify-content: center;
                        text-transform: none;
                        text-rendering: auto;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-close:hover {
                        color: rgba(0, 0, 0, 0.88);
                        background-color: rgba(0, 0, 0, 0.06);
                        text-decoration: none;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-close:active {
                        background-color: rgba(0, 0, 0, 0.15);
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-close:focus-visible {
                        outline: 4px solid #85868f;
                        outline-offset: 1px;
                        transition: outline-offset 0s, outline 0s;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-header {
                        color: rgba(0, 0, 0, 0.88);
                        background: #ffffff;
                        border-radius: 8px 8px 0 0;
                        margin-bottom: 8px;
                        padding: 0;
                        border-bottom: none;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-body {
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        word-wrap: break-word;
                        padding: 0;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-body .ant-modal-body-skeleton {
                        width: 100%;
                        height: 100%;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        margin: 16px auto;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-footer {
                        text-align: end;
                        background: transparent;
                        margin-top: 12px;
                        padding: 0;
                        border-top: none;
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-footer>.ant-btn+.ant-btn {
                        margin-inline-start: 8px;
                    }

                    :where(.css-1588u1j).ant-modal .ant-modal-open {
                        overflow: hidden;
                    }

                    :where(.css-1588u1j).ant-modal-pure-panel {
                        top: auto;
                        padding: 0;
                        display: flex;
                        flex-direction: column;
                    }

                    :where(.css-1588u1j).ant-modal-pure-panel .ant-modal-content,
                    :where(.css-1588u1j).ant-modal-pure-panel .ant-modal-body,
                    :where(.css-1588u1j).ant-modal-pure-panel .ant-modal-confirm-body-wrapper {
                        display: flex;
                        flex-direction: column;
                        flex: auto;
                    }

                    :where(.css-1588u1j).ant-modal-pure-panel .ant-modal-confirm-body {
                        margin-bottom: auto;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal-wrap-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal-wrap-rtl .ant-modal-confirm-body {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal.ant-zoom-enter,
                    :where(.css-1588u1j).ant-modal-root .ant-modal.ant-zoom-appear {
                        transform: none;
                        opacity: 0;
                        animation-duration: 0.3s;
                        user-select: none;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal.ant-zoom-leave .ant-modal-content {
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal-mask {
                        position: fixed;
                        inset: 0;
                        z-index: 1000;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.45);
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal-mask .ant-modal-hidden {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-modal-wrap {
                        position: fixed;
                        inset: 0;
                        z-index: 1000;
                        overflow: auto;
                        outline: 0;
                        -webkit-overflow-scrolling: touch;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-fade-enter,
                    :where(.css-1588u1j).ant-modal-root .ant-fade-appear {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-fade-leave {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-fade-enter.ant-fade-enter-active,
                    :where(.css-1588u1j).ant-modal-root .ant-fade-appear.ant-fade-appear-active {
                        animation-name: css-1588u1j-antFadeIn;
                        animation-play-state: running;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-fade-leave.ant-fade-leave-active {
                        animation-name: css-1588u1j-antFadeOut;
                        animation-play-state: running;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-fade-enter,
                    :where(.css-1588u1j).ant-modal-root .ant-fade-appear {
                        opacity: 0;
                        animation-timing-function: linear;
                    }

                    :where(.css-1588u1j).ant-modal-root .ant-fade-leave {
                        animation-timing-function: linear;
                    }

                    :where(.css-1588u1j).ant-zoom-enter,
                    :where(.css-1588u1j).ant-zoom-appear {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-zoom-leave {
                        animation-duration: 0.2s;
                        animation-fill-mode: both;
                        animation-play-state: paused;
                    }

                    :where(.css-1588u1j).ant-zoom-enter.ant-zoom-enter-active,
                    :where(.css-1588u1j).ant-zoom-appear.ant-zoom-appear-active {
                        animation-name: css-1588u1j-antZoomIn;
                        animation-play-state: running;
                    }

                    :where(.css-1588u1j).ant-zoom-leave.ant-zoom-leave-active {
                        animation-name: css-1588u1j-antZoomOut;
                        animation-play-state: running;
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-zoom-enter,
                    :where(.css-1588u1j).ant-zoom-appear {
                        transform: scale(0);
                        opacity: 0;
                        animation-timing-function: cubic-bezier(0.08, 0.82, 0.17, 1);
                    }

                    :where(.css-1588u1j).ant-zoom-enter-prepare,
                    :where(.css-1588u1j).ant-zoom-appear-prepare {
                        transform: none;
                    }

                    :where(.css-1588u1j).ant-zoom-leave {
                        animation-timing-function: cubic-bezier(0.78, 0.14, 0.15, 0.86);
                    }

                    :where(.css-1588u1j).ant-collapse {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-collapse::before,
                    :where(.css-1588u1j).ant-collapse::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-collapse [class^="ant-collapse"],
                    :where(.css-1588u1j).ant-collapse [class*=" ant-collapse"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-collapse [class^="ant-collapse"]::before,
                    :where(.css-1588u1j).ant-collapse [class*=" ant-collapse"]::before,
                    :where(.css-1588u1j).ant-collapse [class^="ant-collapse"]::after,
                    :where(.css-1588u1j).ant-collapse [class*=" ant-collapse"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-collapse {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                        background-color: rgba(0, 0, 0, 0.02);
                        border: 1px solid #d9d9d9;
                        border-radius: 8px;
                    }

                    :where(.css-1588u1j).ant-collapse-rtl {
                        direction: rtl;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item {
                        border-bottom: 1px solid #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item:last-child,
                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item:last-child>.ant-collapse-header {
                        border-radius: 0 0 8px 8px;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item>.ant-collapse-header {
                        position: relative;
                        display: flex;
                        flex-wrap: nowrap;
                        align-items: flex-start;
                        padding: 12px 16px;
                        color: rgba(0, 0, 0, 0.88);
                        line-height: 1.5714285714285714;
                        cursor: pointer;
                        transition: all 0.3s, visibility 0s;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item>.ant-collapse-header>.ant-collapse-header-text {
                        flex: auto;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item>.ant-collapse-header:focus {
                        outline: none;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item>.ant-collapse-header .ant-collapse-expand-icon {
                        height: 22px;
                        display: flex;
                        align-items: center;
                        padding-inline-end: 12px;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item>.ant-collapse-header .ant-collapse-arrow {
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
                        font-size: 12px;
                        transition: transform 0.3s;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item>.ant-collapse-header .ant-collapse-arrow>* {
                        line-height: 1;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item>.ant-collapse-header .ant-collapse-arrow svg {
                        transition: transform 0.3s;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item>.ant-collapse-header .ant-collapse-header-text {
                        margin-inline-end: auto;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item .ant-collapse-icon-collapsible-only {
                        cursor: unset;
                    }

                    :where(.css-1588u1j).ant-collapse>.ant-collapse-item .ant-collapse-icon-collapsible-only .ant-collapse-expand-icon {
                        cursor: pointer;
                    }

                    :where(.css-1588u1j).ant-collapse .ant-collapse-content {
                        color: rgba(0, 0, 0, 0.88);
                        background-color: #ffffff;
                        border-top: 1px solid #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-collapse .ant-collapse-content>.ant-collapse-content-box {
                        padding: 16px 16px;
                    }

                    :where(.css-1588u1j).ant-collapse .ant-collapse-content-hidden {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-collapse-small>.ant-collapse-item>.ant-collapse-header {
                        padding: 8px 12px;
                        padding-inline-start: 8px;
                    }

                    :where(.css-1588u1j).ant-collapse-small>.ant-collapse-item>.ant-collapse-header>.ant-collapse-expand-icon {
                        margin-inline-start: 4px;
                    }

                    :where(.css-1588u1j).ant-collapse-small>.ant-collapse-item>.ant-collapse-content>.ant-collapse-content-box {
                        padding: 12px;
                    }

                    :where(.css-1588u1j).ant-collapse-large>.ant-collapse-item {
                        font-size: 16px;
                        line-height: 1.5;
                    }

                    :where(.css-1588u1j).ant-collapse-large>.ant-collapse-item>.ant-collapse-header {
                        padding: 16px 24px;
                        padding-inline-start: 16px;
                    }

                    :where(.css-1588u1j).ant-collapse-large>.ant-collapse-item>.ant-collapse-header>.ant-collapse-expand-icon {
                        height: 24px;
                        margin-inline-start: 8px;
                    }

                    :where(.css-1588u1j).ant-collapse-large>.ant-collapse-item>.ant-collapse-content>.ant-collapse-content-box {
                        padding: 24px;
                    }

                    :where(.css-1588u1j).ant-collapse .ant-collapse-item:last-child {
                        border-bottom: 0;
                    }

                    :where(.css-1588u1j).ant-collapse .ant-collapse-item:last-child>.ant-collapse-content {
                        border-radius: 0 0 8px 8px;
                    }

                    :where(.css-1588u1j).ant-collapse .ant-collapse-item-disabled>.ant-collapse-header,
                    :where(.css-1588u1j).ant-collapse .ant-collapse-item-disabled>.ant-collapse-header>.arrow {
                        color: rgba(0, 0, 0, 0.25);
                        cursor: not-allowed;
                    }

                    :where(.css-1588u1j).ant-collapse.ant-collapse-icon-position-end>.ant-collapse-item>.ant-collapse-header .ant-collapse-expand-icon {
                        order: 1;
                        padding-inline-end: 0;
                        padding-inline-start: 12px;
                    }

                    :where(.css-1588u1j).ant-collapse-borderless {
                        background-color: rgba(0, 0, 0, 0.02);
                        border: 0;
                    }

                    :where(.css-1588u1j).ant-collapse-borderless>.ant-collapse-item {
                        border-bottom: 1px solid #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-collapse-borderless>.ant-collapse-item:last-child,
                    :where(.css-1588u1j).ant-collapse-borderless>.ant-collapse-item:last-child .ant-collapse-header {
                        border-radius: 0;
                    }

                    :where(.css-1588u1j).ant-collapse-borderless>.ant-collapse-item:last-child {
                        border-bottom: 0;
                    }

                    :where(.css-1588u1j).ant-collapse-borderless>.ant-collapse-item>.ant-collapse-content {
                        background-color: transparent;
                        border-top: 0;
                    }

                    :where(.css-1588u1j).ant-collapse-borderless>.ant-collapse-item>.ant-collapse-content>.ant-collapse-content-box {
                        padding-top: 4px;
                    }

                    :where(.css-1588u1j).ant-collapse-ghost {
                        background-color: transparent;
                        border: 0;
                    }

                    :where(.css-1588u1j).ant-collapse-ghost>.ant-collapse-item {
                        border-bottom: 0;
                    }

                    :where(.css-1588u1j).ant-collapse-ghost>.ant-collapse-item>.ant-collapse-content {
                        background-color: transparent;
                        border: 0;
                    }

                    :where(.css-1588u1j).ant-collapse-ghost>.ant-collapse-item>.ant-collapse-content>.ant-collapse-content-box {
                        padding-block: 12px;
                    }

                    :where(.css-1588u1j).ant-collapse-rtl>.ant-collapse-item>.ant-collapse-header .ant-collapse-arrow {
                        transform: rotate(180deg);
                    }

                    :where(.css-1588u1j).ant-collapse .ant-motion-collapse-legacy {
                        overflow: hidden;
                    }

                    :where(.css-1588u1j).ant-collapse .ant-motion-collapse-legacy-active {
                        transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
                    }

                    :where(.css-1588u1j).ant-collapse .ant-motion-collapse {
                        overflow: hidden;
                        transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
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
                        content: "3hyxim|ant-design-icons|anticon:n18rlk;54mug8|ant-design-icons|anticon:1i7nym9;54mug8|Shared|ant:1ijft1f;54mug8|Layout-Layout|ant-layout|anticon:tnknc0;54mug8|Button-Button|ant-btn|anticon:1cfhi6l;54mug8|Wave-Wave|ant-wave|anticon:6oh8ov;54mug8|Drawer-Drawer|ant-drawer|anticon:oz1ynp;54mug8|Grid-Grid|ant-row|anticon:1w2fmdc;54mug8|Grid-Grid|ant-col|anticon:4t782p;54mug8|Image-Image|ant-image|anticon:1rudh1y;54mug8|Upload-Upload|ant-upload|anticon:134nq3v;54mug8|Modal-Modal|ant-modal|anticon:173eb5x;54mug8|Collapse-Collapse|ant-collapse|anticon:1ghqsvt;54mug8|Tour-Tour|ant-tour|anticon:1vvwohf";
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
                            <div class="p-5">
                                <div class="mb-5 flex flex-col justify-between gap-[25px] md:flex-row">
                                    <div class="flex items-center gap-3">
                                        <p class="text-[18px] font-semibold md:text-[22px]">Co-Traveler</p>
                                    </div>
                                    <div class="flex items-center gap-5">
                                        <div class="flex justify-end"></div>
                                    </div>
                                </div>
                                <section class="my_family">
                                    <div class="ant-row css-1588u1j"
                                        style="margin-left: -10px; margin-right: -10px; row-gap: 20px;"><?php
                                                                                                        if ($co_travelers) {
                                                                                                            foreach ($co_travelers as $traveler) {
                                                                                                        ?>
                                                <div class="ant-col ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-6 ant-col-xl-4 css-1588u1j" style="padding-left: 10px; padding-right: 10px;">
                                                    <a href="/user/profile/?user_id=<?php echo $traveler->co_traveler_id; ?>" class="family_member_card cursor-pointer">
                                                        <div class="delete_edit_icon cursor-pointer">
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                                viewBox="0 0 24 24" class="edit" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path>
                                                                <path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path>
                                                            </svg>
                                                        </div>
                                                        <img alt="family member" loading="lazy" width="0" height="0" decoding="async" data-nimg="1"
                                                            srcset="https://visathing.com/_next/image/?url=%2Fimages%2Ffamily_members%2Fbrother.png&w=1920&q=75"
                                                            src="https://visathing.com/_next/image/?url=%2Fimages%2Ffamily_members%2Fbrother.png&w=1920&q=75"
                                                            style="color: transparent;">
                                                        <div>
                                                            <h4><?php echo esc_html($traveler->first_name . ' ' . $traveler->last_name); ?></h4>
                                                            <h5><?php echo esc_html($traveler->relationship); ?></h5>
                                                            <h6><?php echo esc_html($traveler->email); ?></h6>
                                                        </div>
                                                    </a>
                                                </div>
                                        <?php
                                                                                                            }
                                                                                                        } ?>
                                        <div class="ant-col ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-6 ant-col-xl-4 css-1588u1j"
                                            style="padding-left: 10px; padding-right: 10px;">
                                            <div class="family_member_add_card"><svg stroke="currentColor" fill="currentColor"
                                                    stroke-width="0" viewBox="0 0 1024 1024" class="plus_icon" height="1em"
                                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8Z"></path>
                                                    <path d="M192 474h672q8 0 8 8v60q0 8-8 8H160q-8 0-8-8v-60q0-8 8-8Z"></path>
                                                </svg></div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="ant-modal-root css-1588u1j">
                                <div tabindex="-1" class="ant-modal-wrap co-traveleradd_modal" style="z-index: 9999; display: none;">
                                    <div role="dialog" aria-labelledby=":r8:" aria-modal="true" class="ant-modal css-1588u1j"
                                        style="width: 520px; transform-origin: -292px 182px;">
                                        <div tabindex="0" aria-hidden="true"
                                            style="width: 0px; height: 0px; overflow: hidden; outline: none;"></div>
                                        <div tabindex="-1" style="outline: none;">
                                            <div class="ant-modal-content"><button type="button" aria-label="Close"
                                                    class="ant-modal-close"><span class="ant-modal-close-x co-traveler_modal_close"><span role="img"
                                                            aria-label="close"
                                                            class="anticon anticon-close ant-modal-close-icon"><svg
                                                                fill-rule="evenodd" viewBox="64 64 896 896" focusable="false"
                                                                data-icon="close" width="1em" height="1em" fill="currentColor"
                                                                aria-hidden="true">
                                                                <path
                                                                    d="M799.86 166.31c.02 0 .04.02.08.06l57.69 57.7c.04.03.05.05.06.08a.12.12 0 010 .06c0 .03-.02.05-.06.09L569.93 512l287.7 287.7c.04.04.05.06.06.09a.12.12 0 010 .07c0 .02-.02.04-.06.08l-57.7 57.69c-.03.04-.05.05-.07.06a.12.12 0 01-.07 0c-.03 0-.05-.02-.09-.06L512 569.93l-287.7 287.7c-.04.04-.06.05-.09.06a.12.12 0 01-.07 0c-.02 0-.04-.02-.08-.06l-57.69-57.7c-.04-.03-.05-.05-.06-.07a.12.12 0 010-.07c0-.03.02-.05.06-.09L454.07 512l-287.7-287.7c-.04-.04-.05-.06-.06-.09a.12.12 0 010-.07c0-.02.02-.04.06-.08l57.7-57.69c.03-.04.05-.05.07-.06a.12.12 0 01.07 0c.03 0 .05.02.09.06L512 454.07l287.7-287.7c.04-.04.06-.05.09-.06a.12.12 0 01.07 0z">
                                                                </path>
                                                            </svg></span></span></button>
                                                <div class="ant-modal-header">
                                                    <div class="ant-modal-title" id=":r8:">Create a new family member</div>
                                                </div>
                                                <div class="ant-modal-body">
                                                    <form class="ant-form ant-form-vertical ant-form-large css-1588u1j" method="post" action="">
                                                        <div class="ant-row css-1588u1j"
                                                            style="margin-left: -16px; margin-right: -16px;">
                                                            <div class="ant-col ant-col-xs-24 ant-col-md-12 css-1588u1j"
                                                                style="padding-left: 16px; padding-right: 16px;">
                                                                <div class="ant-form-item css-1588u1j">
                                                                    <div class="ant-row ant-form-item-row css-1588u1j">
                                                                        <div class="ant-col ant-form-item-label css-1588u1j">
                                                                            <label for="firstName"
                                                                                class="ant-form-item-required"
                                                                                title="First Name">First Name</label>
                                                                        </div>
                                                                        <div class="ant-col ant-form-item-control css-1588u1j">
                                                                            <div class="ant-form-item-control-input">
                                                                                <div
                                                                                    class="ant-form-item-control-input-content">
                                                                                    <input placeholder="Enter a first name"
                                                                                        id="firstName" name="firstName" aria-required="true"
                                                                                        class="ant-input ant-input-lg css-1588u1j ant-input-outlined"
                                                                                        type="text" value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ant-col ant-col-xs-24 ant-col-md-12 css-1588u1j"
                                                                style="padding-left: 16px; padding-right: 16px;">
                                                                <div class="ant-form-item css-1588u1j">
                                                                    <div class="ant-row ant-form-item-row css-1588u1j">
                                                                        <div class="ant-col ant-form-item-label css-1588u1j">
                                                                            <label for="lastName" class="ant-form-item-required"
                                                                                title="Last Name">Last Name</label>
                                                                        </div>
                                                                        <div class="ant-col ant-form-item-control css-1588u1j">
                                                                            <div class="ant-form-item-control-input">
                                                                                <div
                                                                                    class="ant-form-item-control-input-content">
                                                                                    <input placeholder="Enter a last name"
                                                                                        id="lastName" name="lastName" aria-required="true"
                                                                                        class="ant-input ant-input-lg css-1588u1j ant-input-outlined"
                                                                                        type="text" value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ant-col ant-col-xs-24 css-1588u1j"
                                                                style="padding-left: 16px; padding-right: 16px;">
                                                                <div class="ant-form-item css-1588u1j">
                                                                    <div class="ant-row ant-form-item-row css-1588u1j flex-col" style="display: flex; flex-direction: column !important;">
                                                                        <div class="ant-col ant-form-item-label css-1588u1j">
                                                                            <label for="email" class="ant-form-item-required"
                                                                                title="Email">Email</label>
                                                                        </div>
                                                                        <div class="ant-col ant-form-item-control css-1588u1j">
                                                                            <div class="ant-form-item-control-input">
                                                                                <div
                                                                                    class="ant-form-item-control-input-content">
                                                                                    <input placeholder="Enter a email"
                                                                                        id="email" name="email" aria-required="true"
                                                                                        class="ant-input ant-input-lg css-1588u1j ant-input-outlined"
                                                                                        type="text" value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ant-col ant-col-xs-24 ant-col-md-12 css-1588u1j"
                                                                style="padding-left: 16px; padding-right: 16px;">
                                                                <div class="ant-form-item css-1588u1j">
                                                                    <div class="ant-row ant-form-item-row css-1588u1j">
                                                                        <div class="ant-col ant-form-item-label css-1588u1j">
                                                                            <label for="phoneNumber"
                                                                                class="ant-form-item-required"
                                                                                title="Phone Number">Phone Number</label>
                                                                        </div>
                                                                        <div class="ant-col ant-form-item-control css-1588u1j">
                                                                            <div class="ant-form-item-control-input">
                                                                                <div
                                                                                    class="ant-form-item-control-input-content">
                                                                                    <div class=" react-tel-input ">
                                                                                        <div class="special-label">Phone</div>
                                                                                        <input class="form-control tel-input"
                                                                                            placeholder="1 (702) 123-4567" name="phoneNumber"
                                                                                            type="tel" value="+880">
                                                                                        <div class="flag-dropdown ">
                                                                                            <div class="selected-flag"
                                                                                                title="Bangladesh: + 880"
                                                                                                tabindex="0" role="button"
                                                                                                aria-haspopup="listbox">
                                                                                                <div class="flag bd">
                                                                                                    <div class="arrow"></div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ant-col ant-col-xs-24 ant-col-md-12 css-1588u1j"
                                                                style="padding-left: 16px; padding-right: 16px;">
                                                                <div class="ant-form-item css-1588u1j">
                                                                    <div class="ant-row ant-form-item-row css-1588u1j">
                                                                        <div class="ant-col ant-form-item-label css-1588u1j">
                                                                            <label for="relationship"
                                                                                class="ant-form-item-required"
                                                                                title="Relationship">Relationship</label>
                                                                        </div>
                                                                        <div class="ant-col ant-form-item-control css-1588u1j">
                                                                            <div class="ant-form-item-control-input">
                                                                                <div
                                                                                    class="ant-form-item-control-input-content">
                                                                                    <div class="ant-select ant-select-lg ant-select-outlined ant-select-in-form-item css-1588u1j ant-select-single ant-select-show-arrow"
                                                                                        aria-required="true">
                                                                                        <div class="ant-select-selector"><span
                                                                                                class="ant-select-selection-search">
                                                                                                <select aria-required="true" id="relationship" name="relationship">
                                                                                                    <option value="Parent">Parent</option>
                                                                                                    <option value="Brother">Brother</option>
                                                                                                    <option value="Sister">Sister</option>
                                                                                                    <option value="Mother">Mother</option>
                                                                                                    <option value="Spouse">Spouse</option>
                                                                                                    <option value="Friend">Friend</option>
                                                                                                    <option value="Children">Children</option>
                                                                                                    <option value="Co-Worker">Co-Worker</option>
                                                                                                    <option value="Other">Other</option>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="ant-col ant-col-24 css-1588u1j"
                                                                    style="padding-left: 16px; padding-right: 16px;">
                                                                    <div class="ant-form-item text-center css-1588u1j">
                                                                        <div class="ant-row ant-form-item-row css-1588u1j">
                                                                            <div class="ant-col ant-form-item-control css-1588u1j">
                                                                                <div class="ant-form-item-control-input">
                                                                                    <div
                                                                                        class="ant-form-item-control-input-content">
                                                                                        <button type="submit"
                                                                                            class="ant-btn css-1588u1j ant-btn-primary ant-btn-lg"><span>Submit</span></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div tabindex="0" aria-hidden="true"
                                            style="width: 0px; height: 0px; overflow: hidden; outline: none;"></div>
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




        <p aria-live="assertive" id="__next-route-announcer__" role="alert"
            style="border: 0px; clip: rect(0px, 0px, 0px, 0px); height: 1px; margin: -1px; overflow: hidden; padding: 0px; position: absolute; top: 0px; width: 1px; white-space: nowrap; overflow-wrap: normal;">
        </p>
        </next-route-announcer><iframe id="_hjSafeContext_78308674" title="_hjSafeContext" tabindex="-1" aria-hidden="true"
            src="about:blank"
            style="display: none !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important;"></iframe>
        <div id="veepn-guard-alert"></div>

        <div id="veepn-breach-alert"></div>


        <script>
            jQuery(document).ready(function($) {
                // Function to open a modal
                function openModal(modalSelector) {
                    $(modalSelector).show();
                }

                // Function to close a modal
                function closeModal(modalSelector) {
                    $(modalSelector).hide();
                }

                // Event listener for user profile modal
                $('.family_member_add_card').on('click', function() {
                    openModal('.co-traveleradd_modal');

                });

                // Close user profile modal when clicking the close button
                $('.co-traveler_modal_close').on('click', function() {
                    closeModal('.co-traveleradd_modal');
                });

                // Close user profile modal when clicking outside of it
                $(window).on('click', function(event) {
                    if ($(event.target).is('.co-traveleradd_modal')) {
                        closeModal('.co-traveleradd_modal');
                    }
                });

            });
        </script>
    </body>

<?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('co_travelers', 'ct_display_co_travelers_shortcode');
