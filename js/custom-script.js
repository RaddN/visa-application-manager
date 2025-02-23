jQuery(document).ready(function($) {
    $('.nidinfoform').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        console.log('Form submitted!'); // Debugging line
        
        const nid = $('#nid').val();
        const address = $('#address').val();
        const user_id = $('#user_id').val();

        // AJAX request to save data
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'save_user_info',
                nid: nid,
                address: address,
                user_id: user_id,
                // nonce: your_nonce // Add nonce if you're using it
            },
            success: function(response) {
                console.log(response); // Log response for debugging
                if (response.success) {
                    alert(response.data); // Show success message
                    location.reload(); // Optionally, reset the form or close the modal
                    // Optionally, reset the form or close the modal
                } else {
                    alert('Failed to save data.');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr); // Log error for debugging
                alert('An error occurred. Please try again.');
            }
        });
    });
    
    
    const $siderTrigger = $('.ant-layout-sider-trigger');
    const $sidebar = $('.sidebar_menu_wrapper');
    const $userInfo = $('.ant-layout-sider-children .user_menu .info');
    const $userActionBtn = $('.ant-layout-sider-children .user_menu .action');
    const $next = $('#__next');

    $siderTrigger.on('click', function() {
        // Check the current width of the sidebar
        const currentWidth = $sidebar.css('width');

        // Toggle the width of the sidebar
        if (currentWidth === '90px' || currentWidth === '0px') {
            $sidebar.css({
                'width': '240px', // Expand to original width
                'padding': '0px 10px' // Restore padding
            });
            $siderTrigger.css('width', '240px');
            $userInfo.show(); // Show user info
            $userActionBtn.css('display', 'flex'); // Show user action button
            
            // Update next max width with !important
            $next.css('max-width', '86vw'); 
            $next[0].style.setProperty('max-width', '86vw', 'important');
        } else {
            $sidebar.css({
                'width': '90px', // Collapse to minimum width
                'min-width': '90px', // Set minimum width
                'padding': '0' // Remove padding
            });
            $siderTrigger.css('width', '90px');
            $userInfo.hide(); // Hide user info
            $userActionBtn.hide(); // Hide user action button
            
            // Update next max width with !important
            $next.css('max-width', '94vw');
            $next[0].style.setProperty('max-width', '94vw', 'important');
        }
    });



});


jQuery(document).ready(function ($) {
    // Add a click event listener to the new submit button
    $('.rcustom-submit-btn').on('click', function () {
        const entryId = 25; // The entry ID to update
        // Gather form data from the existing form
        const formData = $('#wpforms-form-17').serializeArray();
        const dataObj = {};

        // Create the desired data structure
        $.each(formData, function (index, field) {
            const fieldName = field.name.replace('wpforms[fields][', '').replace(']', ''); // Extract field ID
            const fieldValue = field.value;

            // Construct the field object
            dataObj[fieldName] = {
                name: fieldName, // Placeholder for name; update as needed
                value: fieldValue,
                id: parseInt(fieldName), // Ensure the ID is an integer
                type: '' // Placeholder for the type; set later
            };
        });

        // Assign specific names and types based on field ID
        dataObj['62'] = {
            name: 'goingto',
            value: dataObj['62'].value,
            id: 62,
            type: 'hidden'
        };

        dataObj['63'] = {
            name: 'visacata',
            value: dataObj['63'].value,
            id: 63,
            type: 'hidden'
        };

        dataObj['52'] = {
            name: 'Select VISAThing Services',
            value: 'Document Legalization - $17,000.00\nVisa Consultancy - $10,000.00',
            value_choice: 'Document Legalization\nVisa Consultancy',
            value_raw: '1,2',
            amount: '27,000.00',
            amount_raw: 27000,
            currency: 'USD',
            images: [],
            id: 52,
            type: 'payment-checkbox'
        };

        // Set additional field properties
        dataObj['13'].name = 'First Name';
        dataObj['13'].type = 'name';

        dataObj['14'].name = 'Last Name';
        dataObj['14'].type = 'name';

        dataObj['15'].name = 'Email';
        dataObj['15'].type = 'email';

        dataObj['16'].name = 'Phone Number';
        dataObj['16'].type = 'phone';

        dataObj['31'].name = 'Address';
        dataObj['31'].type = 'text';

        dataObj['32'].name = 'City';
        dataObj['32'].type = 'text';

        dataObj['33'].name = 'State/Province';
        dataObj['33'].type = 'text';

        dataObj['21'].name = 'Given Name';
        dataObj['21'].type = 'name';

        dataObj['22'].name = 'Surname';
        dataObj['22'].type = 'name';

        dataObj['25'].name = 'Passport Number';
        dataObj['25'].type = 'text';

        dataObj['26'] = {
            name: 'Issue Date',
            value: $('#wpforms-17-field_26').val(),
            id: 26,
            type: 'date-time',
            date: $('#wpforms-17-field_26').val(),
            time: '',
            unix: Math.floor(new Date($('#wpforms-17-field_26').val()).getTime() / 1000)
        };

        dataObj['27'] = {
            name: 'Expire Date',
            value: $('#wpforms-17-field_27').val(),
            id: 27,
            type: 'date-time',
            date: $('#wpforms-17-field_27').val(),
            time: '',
            unix: Math.floor(new Date($('#wpforms-17-field_27').val()).getTime() / 1000)
        };

        dataObj['28'] = {
            name: 'Birth Date',
            value: $('#wpforms-17-field_28').val(),
            id: 28,
            type: 'date-time',
            date: $('#wpforms-17-field_28').val(),
            time: '',
            unix: Math.floor(new Date($('#wpforms-17-field_28').val()).getTime() / 1000)
        };

        dataObj['40'] = {
            name: 'Checkboxes',
            value: 'By continuing, you agree to VISAThing Terms & Condition.',
            value_raw: 'By continuing, you agree to VISAThing Terms & Condition.',
            id: 40,
            type: 'checkbox'
        };

        dataObj['53'] = {
            name: 'Stripe Credit Card',
            value: '',
            id: 53,
            type: 'stripe-credit-card'
        };

        // Prepare the AJAX request
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'update_wpforms_entry',
                entry_id: entryId,
                data: dataObj // Send the formatted data
            },
            success: function (response) {
                if (response.success) {
                    alert('Entry updated successfully!');
                } else {
                    alert('Failed to update entry: ' + response.data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log error for debugging
                alert('An error occurred. Please try again.');
            }
        });
    });
});