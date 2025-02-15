<?php

function wpforms_prefill_shortcode() {
    global $wpdb;

$entry_id = isset($_GET['entry_id']) ? intval($_GET['entry_id']) : 0;

if ($entry_id) {
    $entry = $wpdb->get_row($wpdb->prepare(
        "SELECT fields FROM wp_wpforms_entries WHERE entry_id = %d",
        $entry_id
    ));

    if ($entry) {
        $fields = json_decode($entry->fields, true); // Decode the JSON data
    }
}
    ob_start();  
    ?>
    <script>
        
    document.addEventListener("DOMContentLoaded", function() {
        const entryData = <?php echo json_encode($fields); ?>;

        for (const key in entryData) {
            if (entryData.hasOwnProperty(key)) {
                const field = entryData[key];
                
                const inputField = document.querySelector(`input[name="wpforms[fields][${key}]"]`);

                if (inputField) {
                    if (field.type === "checkbox") {
                        const checkboxes = document.querySelectorAll(`input[name="wpforms[fields][${key}][]"]`);
                        checkboxes.forEach(checkbox => {
                            if (checkbox.value === field.value_raw) {
                                checkbox.checked = true;
                            }
                        });
                    } else {
                        inputField.value = field.value;
                    }
                }
            }
        }
    });
</script>

<?php

return ob_get_clean();

}
add_shortcode('wpforms_prefill', 'wpforms_prefill_shortcode');