<?php
function get_cities_by_country() {
    if (isset($_POST['country'])) {
        $country = sanitize_text_field($_POST['country']);
        
        $url = "https://countriesnow.space/api/v0.1/countries/cities";
        $postData = json_encode(["country" => $country]);

        $response = wp_remote_post($url, [
            'body'    => $postData,
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $cities = [];

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) == 200) {
            $data = json_decode(wp_remote_retrieve_body($response), true);
            
            if (isset($data['data'])) {
                $cities = $data['data'];
            }
        }

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

