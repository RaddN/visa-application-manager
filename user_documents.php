<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

function up_handle_form_per_user_documents()
{
    if (isset($_POST['title']) && isset($_FILES['file'])) {

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

        // Sanitize and prepare data
        $title = sanitize_text_field($_POST['title']);
        $uploader_id = get_current_user_id(); // Assuming the uploader is the current user
        $created_at = current_time('mysql');

        // Handle file upload
        $uploaded_file = $_FILES['file'];
        $upload_overrides = array('test_form' => false);

        // Move the uploaded file to the WordPress uploads directory
        $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

        if ($movefile && !isset($movefile['error'])) {
            // File is successfully uploaded
            $file_url = $movefile['url'];

            // Insert data into the database
            $table_name = $wpdb->prefix . 'per_user_document';
            $wpdb->insert($table_name, array(
                'title' => $title,
                'user_id' => $user_id,
                'uploader_id' => $uploader_id,
                'file_url' => $file_url, // Store the file URL
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ));

            // Optionally, you can redirect or display a success message
            wp_safe_redirect($_SERVER['REQUEST_URI']);
            exit;
        } else {
        }
    }
}

// Hook to process before headers are sent
add_action('template_redirect', 'up_handle_form_per_user_documents');
// Create a shortcode to display co-travelers
function ud_display_per_user_documents_shortcode()
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
    $documents = get_user_documents($user_id);

    ob_start();


?>
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
                <style data-rc-order="prependQueue" data-rc-priority="-1000" data-css-hash="nffb1q" data-token-hash="54mug8">
                    :where(.css-1588u1j)[class^="ant-form"],
                    :where(.css-1588u1j)[class*=" ant-form"] {
                        font-family: var(--font-noto-sans);
                        font-size: 14px;
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-form"]::before,
                    :where(.css-1588u1j)[class*=" ant-form"]::before,
                    :where(.css-1588u1j)[class^="ant-form"]::after,
                    :where(.css-1588u1j)[class*=" ant-form"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"],
                    :where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"],
                    :where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"],
                    :where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"]::before,
                    :where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"]::before,
                    :where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"]::before,
                    :where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"]::before,
                    :where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"]::after,
                    :where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"]::after,
                    :where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"]::after,
                    :where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"]::after {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-form {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                    }

                    :where(.css-1588u1j).ant-form legend {
                        display: block;
                        width: 100%;
                        margin-bottom: 24px;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.45);
                        font-size: 16px;
                        line-height: inherit;
                        border: 0;
                        border-bottom: 1px solid #d9d9d9;
                    }

                    :where(.css-1588u1j).ant-form input[type="search"] {
                        box-sizing: border-box;
                    }

                    :where(.css-1588u1j).ant-form input[type="radio"],
                    :where(.css-1588u1j).ant-form input[type="checkbox"] {
                        line-height: normal;
                    }

                    :where(.css-1588u1j).ant-form input[type="file"] {
                        display: block;
                    }

                    :where(.css-1588u1j).ant-form input[type="range"] {
                        display: block;
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-form select[multiple],
                    :where(.css-1588u1j).ant-form select[size] {
                        height: auto;
                    }

                    :where(.css-1588u1j).ant-form input[type='file']:focus,
                    :where(.css-1588u1j).ant-form input[type='radio']:focus,
                    :where(.css-1588u1j).ant-form input[type='checkbox']:focus {
                        outline: 0;
                        box-shadow: 0 0 0 2px transparent;
                    }

                    :where(.css-1588u1j).ant-form output {
                        display: block;
                        padding-top: 15px;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                    }

                    :where(.css-1588u1j).ant-form .ant-form-text {
                        display: inline-block;
                        padding-inline-end: 12px;
                    }

                    :where(.css-1588u1j).ant-form-small .ant-form-item .ant-form-item-label>label {
                        height: 24px;
                    }

                    :where(.css-1588u1j).ant-form-small .ant-form-item .ant-form-item-control-input {
                        min-height: 24px;
                    }

                    :where(.css-1588u1j).ant-form-large .ant-form-item .ant-form-item-label>label {
                        height: 40px;
                    }

                    :where(.css-1588u1j).ant-form-large .ant-form-item .ant-form-item-control-input {
                        min-height: 40px;
                    }

                    :where(.css-1588u1j).ant-form-item {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                        list-style: none;
                        font-family: var(--font-noto-sans);
                        margin-bottom: 24px;
                        vertical-align: top;
                    }

                    :where(.css-1588u1j).ant-form-item-with-help {
                        transition: none;
                    }

                    :where(.css-1588u1j).ant-form-item-hidden,
                    :where(.css-1588u1j).ant-form-item-hidden.ant-row {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-form-item-has-warning .ant-form-item-split {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-form-item-has-error .ant-form-item-split {
                        color: #faad14;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label {
                        flex-grow: 0;
                        overflow: hidden;
                        white-space: nowrap;
                        text-align: end;
                        vertical-align: middle;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label-left {
                        text-align: start;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label-wrap {
                        overflow: unset;
                        line-height: 1.5714285714285714;
                        white-space: unset;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label {
                        position: relative;
                        display: inline-flex;
                        align-items: center;
                        max-width: 100%;
                        height: 32px;
                        color: rgba(0, 0, 0, 0.88);
                        font-size: 14px;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label>.anticon {
                        font-size: 14px;
                        vertical-align: top;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label.ant-form-item-required:not(.ant-form-item-required-mark-optional)::before {
                        display: inline-block;
                        margin-inline-end: 4px;
                        color: #ff4d4f;
                        font-size: 14px;
                        font-family: SimSun, sans-serif;
                        line-height: 1;
                        content: "*";
                    }

                    .ant-form-hide-required-mark :where(.css-1588u1j).ant-form-item .ant-form-item-label>label.ant-form-item-required:not(.ant-form-item-required-mark-optional)::before {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label .ant-form-item-optional {
                        display: inline-block;
                        margin-inline-start: 4px;
                        color: rgba(0, 0, 0, 0.45);
                    }

                    .ant-form-hide-required-mark :where(.css-1588u1j).ant-form-item .ant-form-item-label>label .ant-form-item-optional {
                        display: none;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label .ant-form-item-tooltip {
                        color: rgba(0, 0, 0, 0.45);
                        cursor: help;
                        writing-mode: horizontal-tb;
                        margin-inline-start: 4px;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label::after {
                        content: ":";
                        position: relative;
                        margin-block: 0;
                        margin-inline-start: 2px;
                        margin-inline-end: 8px;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label.ant-form-item-no-colon::after {
                        content: "\a0";
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-control {
                        --ant-display: flex;
                        flex-direction: column;
                        flex-grow: 1;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-control:first-child:not([class^="'ant-col-'"]):not([class*="' ant-col-'"]) {
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-control-input {
                        position: relative;
                        display: flex;
                        align-items: center;
                        min-height: 32px;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-control-input-content {
                        flex: auto;
                        max-width: 100%;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-explain,
                    :where(.css-1588u1j).ant-form-item .ant-form-item-extra {
                        clear: both;
                        color: rgba(0, 0, 0, 0.45);
                        font-size: 14px;
                        line-height: 1.5714285714285714;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-explain-connected {
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-extra {
                        min-height: 24px;
                        transition: color 0.2s cubic-bezier(0.215, 0.61, 0.355, 1);
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-explain-error {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-explain-warning {
                        color: #faad14;
                    }

                    :where(.css-1588u1j).ant-form-item-with-help .ant-form-item-explain {
                        height: auto;
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon {
                        font-size: 14px;
                        text-align: center;
                        visibility: visible;
                        animation-name: css-1588u1j-antZoomIn;
                        animation-duration: 0.2s;
                        animation-timing-function: cubic-bezier(0.12, 0.4, 0.29, 1.46);
                        pointer-events: none;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-success {
                        color: #52c41a;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-error {
                        color: #ff4d4f;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-warning {
                        color: #faad14;
                    }

                    :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-validating {
                        color: #2f3268;
                    }

                    :where(.css-1588u1j).ant-form-show-help {
                        transition: opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
                    }

                    :where(.css-1588u1j).ant-form-show-help-appear,
                    :where(.css-1588u1j).ant-form-show-help-enter {
                        opacity: 0;
                    }

                    :where(.css-1588u1j).ant-form-show-help-appear-active,
                    :where(.css-1588u1j).ant-form-show-help-enter-active {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-form-show-help-leave {
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-form-show-help-leave-active {
                        opacity: 0;
                    }

                    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item {
                        overflow: hidden;
                        transition: height 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), transform 0.3s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
                    }

                    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-appear,
                    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-enter {
                        transform: translateY(-5px);
                        opacity: 0;
                    }

                    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-appear-active,
                    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-enter-active {
                        transform: translateY(0);
                        opacity: 1;
                    }

                    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-leave-active {
                        transform: translateY(-5px);
                    }

                    :where(.css-1588u1j).ant-form-horizontal .ant-form-item-label {
                        flex-grow: 0;
                    }

                    :where(.css-1588u1j).ant-form-horizontal .ant-form-item-control {
                        flex: 1 1 0;
                        min-width: 0;
                    }

                    :where(.css-1588u1j).ant-form-horizontal .ant-form-item-label[class$='-24']+.ant-form-item-control,
                    :where(.css-1588u1j).ant-form-horizontal .ant-form-item-label[class*='-24 ']+.ant-form-item-control {
                        min-width: unset;
                    }

                    :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label {
                        flex-grow: 0;
                    }

                    :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-control {
                        flex: 1 1 0;
                        min-width: 0;
                    }

                    :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label[class$='-24']+.ant-form-item-control,
                    :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label[class*='-24 ']+.ant-form-item-control {
                        min-width: unset;
                    }

                    :where(.css-1588u1j).ant-form-inline {
                        display: flex;
                        flex-wrap: wrap;
                    }

                    :where(.css-1588u1j).ant-form-inline .ant-form-item {
                        flex: none;
                        margin-inline-end: 16px;
                        margin-bottom: 0;
                    }

                    :where(.css-1588u1j).ant-form-inline .ant-form-item-row {
                        flex-wrap: nowrap;
                    }

                    :where(.css-1588u1j).ant-form-inline .ant-form-item>.ant-form-item-label,
                    :where(.css-1588u1j).ant-form-inline .ant-form-item>.ant-form-item-control {
                        display: inline-block;
                        vertical-align: top;
                    }

                    :where(.css-1588u1j).ant-form-inline .ant-form-item>.ant-form-item-label {
                        flex: none;
                    }

                    :where(.css-1588u1j).ant-form-inline .ant-form-item .ant-form-text {
                        display: inline-block;
                    }

                    :where(.css-1588u1j).ant-form-inline .ant-form-item .ant-form-item-has-feedback {
                        display: inline-block;
                    }

                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-row {
                        flex-direction: column;
                    }

                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label>label {
                        height: auto;
                    }

                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-control {
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label,
                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label,
                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label {
                        padding: 0 0 8px;
                        margin: 0;
                        white-space: initial;
                        text-align: start;
                    }

                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label>label,
                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label>label,
                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label>label {
                        margin: 0;
                    }

                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label>label::after,
                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label>label::after,
                    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label>label::after {
                        visibility: hidden;
                    }

                    @media (max-width: 575px) {
                        :where(.css-1588u1j).ant-form-item .ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-form-item-label>label::after {
                            visibility: hidden;
                        }

                        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item {
                            flex-wrap: wrap;
                        }

                        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-label:not([class*=" ant-col-xs"]),
                        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-control:not([class*=" ant-col-xs"]) {
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label>label::after {
                            visibility: hidden;
                        }
                    }

                    @media (max-width: 767px) {
                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label>label::after {
                            visibility: hidden;
                        }
                    }

                    @media (max-width: 991px) {
                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label>label::after {
                            visibility: hidden;
                        }
                    }

                    @media (max-width: 1199px) {
                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label>label::after {
                            visibility: hidden;
                        }
                    }

                    :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-row {
                        flex-direction: column;
                    }

                    :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label>label {
                        height: auto;
                    }

                    :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-control {
                        width: 100%;
                    }

                    :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label,
                    :where(.css-1588u1j).ant-col-24.ant-form-item-label,
                    :where(.css-1588u1j).ant-col-xl-24.ant-form-item-label {
                        padding: 0 0 8px;
                        margin: 0;
                        white-space: initial;
                        text-align: start;
                    }

                    :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label>label,
                    :where(.css-1588u1j).ant-col-24.ant-form-item-label>label,
                    :where(.css-1588u1j).ant-col-xl-24.ant-form-item-label>label {
                        margin: 0;
                    }

                    :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label>label::after,
                    :where(.css-1588u1j).ant-col-24.ant-form-item-label>label::after,
                    :where(.css-1588u1j).ant-col-xl-24.ant-form-item-label>label::after {
                        visibility: hidden;
                    }

                    @media (max-width: 575px) {
                        :where(.css-1588u1j).ant-form-item .ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-form-item-label>label::after {
                            visibility: hidden;
                        }

                        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item {
                            flex-wrap: wrap;
                        }

                        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-label:not([class*=" ant-col-xs"]),
                        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-control:not([class*=" ant-col-xs"]) {
                            flex: 0 0 100%;
                            max-width: 100%;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label>label::after {
                            visibility: hidden;
                        }
                    }

                    @media (max-width: 767px) {
                        :where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label>label::after {
                            visibility: hidden;
                        }
                    }

                    @media (max-width: 991px) {
                        :where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label>label::after {
                            visibility: hidden;
                        }
                    }

                    @media (max-width: 1199px) {
                        :where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label {
                            padding: 0 0 8px;
                            margin: 0;
                            white-space: initial;
                            text-align: start;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label>label {
                            margin: 0;
                        }

                        :where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label>label::after {
                            visibility: hidden;
                        }
                    }

                    :where(.css-1588u1j).ant-form .ant-motion-collapse-legacy {
                        overflow: hidden;
                    }

                    :where(.css-1588u1j).ant-form .ant-motion-collapse-legacy-active {
                        transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
                    }

                    :where(.css-1588u1j).ant-form .ant-motion-collapse {
                        overflow: hidden;
                        transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
                    }
                </style>
                <div class="ant-layout ant-layout-has-sider css-1588u1j" style="min-height:100vh">
                    <?php include 'header.php';
                    include 'sidebar.php';
                    ?>
                    <div class="ant-layout flex flex-col justify-between css-1588u1j" style="background: rgb(243, 243, 252);  padding: 0px 14px 14px;">
                        <main class="ant-layout-content css-1588u1j" style="border-radius: 5px; min-height: 280px; margin-top: 110px; margin-left: 0px; margin-right: 14px; background: rgb(255, 255, 255);">
                            <div class="h-full p-2 md:border-r-2 md:p-5">
                                <div class="mb-5 flex flex-col justify-between gap-[25px] md:flex-row">
                                    <div class="flex items-center gap-3">
                                        <div class="w-[35px]"><button type="button" class="ant-btn css-1588u1j ant-btn-primary ant-btn-icon-only !flex !h-auto items-center justify-center rounded-sm bg-[var(--primary-500)] text-white"><span class="ant-btn-icon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path>
                                                    </svg></span></button></div>
                                        <p class="text-[18px] font-semibold md:text-[22px]" style="margin: 0;">User document upload for <?php
                                                                                                                                        if (is_user_logged_in()) {
                                                                                                                                            // Display first name and last name
                                                                                                                                            echo esc_html(get_user_meta($user_id, 'first_name', true) . ' ' . get_user_meta($user_id, 'last_name', true));
                                                                                                                                        } else {
                                                                                                                                            echo 'Guest User';
                                                                                                                                        }
                                                                                                                                        ?></p>
                                    </div>
                                    <div class="flex items-center gap-5">
                                        <div class="flex justify-end"><button type="button" class="ant-btn css-1588u1j ant-btn-primary document_add"><span>Create</span></button></div>
                                    </div>
                                </div>
                                <div class="ant-table-wrapper css-1588u1j">
                                    <div class="ant-spin-nested-loading css-1588u1j">
                                        <div class="ant-spin-container">
                                            <div class="ant-table ant-table-empty css-1588u1j ant-table-has-fix-right">
                                                <div class="ant-table-container">
                                                    <div class="ant-table-content">
                                                        <table style="table-layout: auto;">
                                                            <colgroup></colgroup>
                                                            <thead class="ant-table-thead">
                                                                <tr>
                                                                    <th class="ant-table-cell" scope="col">Title</th>
                                                                    <th class="ant-table-cell" scope="col">Uploaded Item</th>
                                                                    <th class="ant-table-cell ant-table-cell-fix-right ant-table-cell-fix-right-first" scope="col" style="position: sticky; right: 0px;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="ant-table-tbody">
                                                                <?php if (!empty($documents)) {
                                                                    foreach ($documents as $document) { ?>
                                                                        <tr class="ant-table-row ant-table-row-level-0" data-row-key="499">
                                                                            <td class="ant-table-cell">
                                                                                <p class="min-w-[100px]"><?php echo  esc_html($document->title); ?></p>
                                                                            </td>
                                                                            <td class="ant-table-cell">
                                                                                <div class="flex min-w-[100px] gap-3">
                                                                                    <style>
                                                                                        .ant-image-mask {
                                                                                            display: none;
                                                                                            transition: all 1s;
                                                                                        }

                                                                                        .ant-image {
                                                                                            cursor: pointer;
                                                                                        }

                                                                                        .ant-image:hover .ant-image-mask {
                                                                                            display: flex;
                                                                                        }
                                                                                    </style>
                                                                                    <div sizes="100vw" class="ant-image css-1588u1j" style="width: 100px; height: 100px; position:relative;"><img sizes="100vw" alt="Preview" class="ant-image-img h-16 w-16 object-cover css-1588u1j" src="<?php echo esc_url($document->file_url); ?>" width="100" height="100" style="height: 100px;">
                                                                                        <a href="<?php echo esc_url($document->file_url); ?>" target="_blank">
                                                                                            <div class="ant-image-mask" style="position: absolute; inset: 0; margin: auto; background: #00000052; align-items: center; justify-content: center; color: #fff;">
                                                                                                <div class="ant-image-mask-info"><span role="img" aria-label="eye" class="anticon anticon-eye"><svg viewBox="64 64 896 896" focusable="false" data-icon="eye" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                                                                            <path d="M942.2 486.2C847.4 286.5 704.1 186 512 186c-192.2 0-335.4 100.5-430.2 300.3a60.3 60.3 0 000 51.5C176.6 737.5 319.9 838 512 838c192.2 0 335.4-100.5 430.2-300.3 7.7-16.2 7.7-35 0-51.5zM512 766c-161.3 0-279.4-81.8-362.7-254C232.6 339.8 350.7 258 512 258c161.3 0 279.4 81.8 362.7 254C791.5 684.2 673.4 766 512 766zm-4-430c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm0 288c-61.9 0-112-50.1-112-112s50.1-112 112-112 112 50.1 112 112-50.1 112-112 112z"></path>
                                                                                                        </svg></span>Preview</div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="ant-table-cell ant-table-cell-fix-right ant-table-cell-fix-right-first" style="position: sticky; right: 0px;">
                                                                                <div class="flex gap-2"><?php echo generate_delete_button("per_user_document", $document->document_id, "ant-btn-primary ant-btn-dangerous", "padding:4px 15px;"); ?></div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }
                                                                } else { ?>
                                                                    <tr class="ant-table-placeholder">
                                                                        <td class="ant-table-cell" colspan="3">
                                                                            <div class="css-1588u1j ant-empty ant-empty-normal">
                                                                                <div class="ant-empty-image"><svg width="64" height="41" viewBox="0 0 64 41" xmlns="http://www.w3.org/2000/svg">
                                                                                        <title>Simple Empty</title>
                                                                                        <g transform="translate(0 1)" fill="none" fill-rule="evenodd">
                                                                                            <ellipse fill="#f5f5f5" cx="32" cy="33" rx="32" ry="7"></ellipse>
                                                                                            <g fill-rule="nonzero" stroke="#d9d9d9">
                                                                                                <path d="M55 12.76L44.854 1.258C44.367.474 43.656 0 42.907 0H21.093c-.749 0-1.46.474-1.947 1.257L9 12.761V22h46v-9.24z"></path>
                                                                                                <path d="M41.613 15.931c0-1.605.994-2.93 2.227-2.931H55v18.137C55 33.26 53.68 35 52.05 35h-40.1C10.32 35 9 33.259 9 31.137V13h11.16c1.233 0 2.227 1.323 2.227 2.928v.022c0 1.605 1.005 2.901 2.237 2.901h14.752c1.232 0 2.237-1.308 2.237-2.913v-.007z" fill="#fafafa"></path>
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
                                            <ul class="ant-pagination ant-table-pagination ant-table-pagination-right css-1588u1j">
                                                <li title="Previous Page" class="ant-pagination-prev ant-pagination-disabled" aria-disabled="true"><button class="ant-pagination-item-link" type="button" tabindex="-1" disabled=""><span role="img" aria-label="left" class="anticon anticon-left"><svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                                <path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path>
                                                            </svg></span></button></li>
                                                <li title="1" class="ant-pagination-item ant-pagination-item-1 ant-pagination-item-active" tabindex="0"><a rel="nofollow">1</a></li>
                                                <li title="Next Page" class="ant-pagination-next ant-pagination-disabled" aria-disabled="true"><button class="ant-pagination-item-link" type="button" tabindex="-1" disabled=""><span role="img" aria-label="right" class="anticon anticon-right"><svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                                <path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path>
                                                            </svg></span></button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>

                    <div class="ant-drawer ant-drawer-right css-1588u1j ant-drawer-open" tabindex="-1">
                        <!-- <div class="ant-drawer-mask"></div> -->
                        <div tabindex="0" aria-hidden="true" data-sentinel="start" style="width: 0px; height: 0px; overflow: hidden; outline: none; position: absolute;"></div>
                        <div class="ant-drawer-content-wrapper ant-drawer-content-wrapper-hidden" style="width: 378px;">
                            <div class="ant-drawer-content" role="dialog" aria-modal="true">
                                <div class="ant-drawer-header">
                                    <div class="ant-drawer-header-title"><button type="button" aria-label="Close" class="ant-drawer-close"><span role="img" aria-label="close" class="anticon anticon-close"><svg fill-rule="evenodd" viewBox="64 64 896 896" focusable="false" data-icon="close" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                                    <path d="M799.86 166.31c.02 0 .04.02.08.06l57.69 57.7c.04.03.05.05.06.08a.12.12 0 010 .06c0 .03-.02.05-.06.09L569.93 512l287.7 287.7c.04.04.05.06.06.09a.12.12 0 010 .07c0 .02-.02.04-.06.08l-57.7 57.69c-.03.04-.05.05-.07.06a.12.12 0 01-.07 0c-.03 0-.05-.02-.09-.06L512 569.93l-287.7 287.7c-.04.04-.06.05-.09.06a.12.12 0 01-.07 0c-.02 0-.04-.02-.08-.06l-57.69-57.7c-.04-.03-.05-.05-.06-.07a.12.12 0 010-.07c0-.03.02-.05.06-.09L454.07 512l-287.7-287.7c-.04-.04-.05-.06-.06-.09a.12.12 0 010-.07c0-.02.02-.04.06-.08l57.7-57.69c.03-.04.05-.05.07-.06a.12.12 0 01.07 0c.03 0 .05.02.09.06L512 454.07l287.7-287.7c.04-.04.06-.05.09-.06a.12.12 0 01.07 0z"></path>
                                                </svg></span></button>
                                        <div class="ant-drawer-title">Upload Documents</div>
                                    </div>
                                </div>
                                <div class="ant-drawer-body">
                                    <form class="ant-form ant-form-vertical ant-form-large css-1588u1j" id="document_form" method="post" enctype="multipart/form-data" action="">
                                        <div class="ant-form-item css-1588u1j">
                                            <div class="ant-row ant-form-item-row css-1588u1j">
                                                <div class="ant-col ant-form-item-label css-1588u1j"><label for="title" class="ant-form-item-required" title="Title">Title</label></div>
                                                <div class="ant-col ant-form-item-control css-1588u1j">
                                                    <div class="ant-form-item-control-input">
                                                        <div class="ant-form-item-control-input-content"><input placeholder="Write title" id="title" name="title" aria-required="true" class="ant-input ant-input-lg css-1588u1j ant-input-outlined" type="text" value=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ant-form-item dragger_wrapper mt-10 css-1588u1j">
                                            <div class="ant-row ant-form-item-row css-1588u1j">
                                                <div class="ant-col ant-form-item-label css-1588u1j"><label for="links" class="ant-form-item-required" title="Upload Scanned Copy">Upload Scanned Copy</label></div>
                                                <input type="file" name="file" id="file" class="ant-upload mt-5">
                                            </div>
                                        </div>
                                        <div class="mt-10">
                                            <div class="ant-form-item css-1588u1j">
                                                <div class="ant-row ant-form-item-row css-1588u1j">
                                                    <div class="ant-col ant-form-item-control css-1588u1j">
                                                        <div class="ant-form-item-control-input">
                                                            <div class="ant-form-item-control-input-content"><button type="submit" class="ant-btn css-1588u1j ant-btn-primary ant-btn-lg lg:w-36"><span>Submit</span></button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div tabindex="0" aria-hidden="true" data-sentinel="end" style="width: 0px; height: 0px; overflow: hidden; outline: none; position: absolute;"></div>
                    </div>

                    <script>
                        jQuery(document).ready(function($) {
                            $('.ant-drawer-close').on('click', function() {
                                $('.ant-drawer-open').removeClass('ant-drawer-open');
                                $('.ant-drawer-mask').remove();
                                $('.ant-drawer-content-wrapper').addClass('ant-drawer-content-wrapper-hidden');
                            });
                            $('.document_add').on('click', function() {
                                $('.ant-drawer-content-wrapper').removeClass('ant-drawer-content-wrapper-hidden');

                            });
                        });
                    </script>


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
    </body>
    <!-- handle delete item -->
<script>
jQuery(document).ready(function($) {
    $(".removeitem").on("click", function() {
        var table = $(this).data("table"); // Get table name
        var entryId = $(this).data("id"); // Get entry ID

        if (!confirm("Are you sure you want to delete this entry?")) {
            return;
        }

        $.ajax({
            type: "POST",
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                action: "delete_entry",
                table: table,
                entry_id: entryId
            },
            success: function(response) {
                if (response.success) {
                    alert("Entry deleted successfully.");
                    location.reload(); // Refresh or remove the element dynamically
                } else {
                    alert("Error: " + response.data);
                }
            },
            error: function() {
                alert("An error occurred.");
            }
        });
    });
});
</script>

<?php
    return ob_get_clean();
}


// Register the shortcode
add_shortcode('per_user_documents', 'ud_display_per_user_documents_shortcode');


function get_user_documents($user_id)
{
    global $wpdb;

    // Check if the user ID is valid
    if ($user_id) {
        // Define the table name
        $table_name = $wpdb->prefix . 'per_user_document';

        // Query to get documents for the specified user
        $documents = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $table_name WHERE user_id = %d",
                $user_id
            )
        );

        return $documents; // Returns an array of documents
    }

    return []; // Return an empty array if the user ID is not valid
}
