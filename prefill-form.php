<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

function wpforms_prefill_shortcode()
{
    global $wpdb;

    $entry_id = isset($_GET['entry_id']) ? intval($_GET['entry_id']) : 0;
    ob_start();
    if ($entry_id) {
        $table_name = $wpdb->prefix . 'wpforms_entries';
        $entry = $wpdb->get_row($wpdb->prepare(
            "SELECT fields FROM $table_name WHERE entry_id = %d",
            $entry_id
        ));

        if ($entry) {
            $fields = json_decode($entry->fields, true); // Decode the JSON data
        }
?>
        <style>
            .wpforms-submit {
                display: none !important;
            }

            button.rcustom-submit-btn {
                background: #ffffff !important;
                border: 1px solid #d9d9d9 !important;
                color: rgba(0, 0, 0, 0.88);
                box-shadow: 0 2px 0 rgba(0, 0, 0, 0.02) !important;
                padding: 0 15px !important;
                height: 43px !important;
                border-radius: 3px !important;
            }
        </style>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Select all existing submit buttons
                const submitButtons = document.querySelectorAll('.wpforms-submit');

                submitButtons.forEach(function(existingSubmitButton) {
                    // Create a new button element
                    const newSubmitButton = document.createElement('button');

                    // Set properties for the new button
                    newSubmitButton.textContent = 'Update'; // Button text
                    newSubmitButton.type = 'button'; // Prevent it from submitting the form by default
                    newSubmitButton.className = 'rcustom-submit-btn'; // Optional: add a class for styling

                    // Insert the new button next to the existing submit button
                    existingSubmitButton.parentNode.insertBefore(newSubmitButton, existingSubmitButton.nextSibling);
                });

                const entryData = <?php echo json_encode($fields); ?>;

                for (const key in entryData) {
                    if (entryData.hasOwnProperty(key)) {
                        const field = entryData[key];


                        const inputField = document.querySelector(`input[name="wpforms[fields][${key}]"]`);
                        const checkboxField = document.querySelectorAll(`input[name="wpforms[fields][${key}][]"]`);

                        if (inputField) {
                            inputField.value = field.value;
                        } else if (checkboxField) {
                            checkboxField.forEach((checkbox) => {
                                const filedvalue = field.value.replace(/&#36;/g, '$').split('\r\n');
                                if (filedvalue.includes(checkbox.nextElementSibling.innerText)) {
                                    checkbox.checked = true;
                                }
                            });
                        }
                    }
                }
            });
        </script>

<?php
    }
    return ob_get_clean();
}
add_shortcode('wpforms_prefill', 'wpforms_prefill_shortcode');
