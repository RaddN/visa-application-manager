<?php

// Create a shortcode to display co-travelers
function ct_display_co_travelers_shortcode()
{
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        return '<p>You need to be logged in to view your co-travelers.</p>';
    }
    global $wpdb;
    $user_id = get_current_user_id();

    // handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['firstName'])) {
        global $wpdb;
        // Sanitize input
        $first_name = sanitize_text_field($_POST['firstName']);
        $last_name = sanitize_text_field($_POST['lastName']);
        $email = sanitize_email($_POST['email']);
        $phone_number = sanitize_text_field($_POST['phoneNumber']);
        $relationship = sanitize_text_field($_POST['relationship']);
        $user_id = get_current_user_id(); // Assuming you want to link to the current user

        // Prepare data for insertion
        $data = [
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
            // Output the last error message
            echo '<div class="notice notice-error">Error saving Co-Traveler information: ' . $wpdb->last_error . '</div>';
        } else {
            echo '<div class="notice notice-success">Co-Traveler information saved successfully!</div>';
        }
    }

    $co_travelers = $wpdb->get_results(
        $wpdb->prepare("SELECT first_name, last_name, email, relationship FROM {$wpdb->prefix}co_travelers_info WHERE user_id = %d", $user_id)
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
                                                    <div class="family_member_card cursor-pointer">
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
                                                    </div>
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
