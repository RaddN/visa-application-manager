<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
function get_cities_by_country() {
    if (isset($_POST['country'])) {
        $country = sanitize_text_field($_POST['country']);
        
        // Fetch the country data from the local JSON file
        $file_path = plugin_dir_path(__FILE__) . 'countries.json'; // Adjust the file name if necessary
        $response = file_get_contents($file_path);
        $countries = json_decode($response, true);
        
        $cities = [];

        // Find the country and its cities
        foreach ($countries as $item) {
            if (isset($item['country']) && $item['country'] === $country) {
                $cities = $item['cities']; // Get the cities for the matched country
                break;
            }
        }

        // Output cities in dropdown format
        if (!empty($cities)) {
            foreach ($cities as $city) {
                echo "<option value='" . esc_html($city) . "'>" . esc_html($city) . "</option>";
            }
        } else {
            echo "<option value=''>No cities found</option>";
        }
    }
    wp_die(); // Required for WordPress AJAX
}

add_action('wp_ajax_get_cities', 'get_cities_by_country');
add_action('wp_ajax_nopriv_get_cities', 'get_cities_by_country');