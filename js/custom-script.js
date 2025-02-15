jQuery(document).ready(function($) {
    $('.nidinfoform').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        console.log('Form submitted!'); // Debugging line
        
        const nid = $('#nid').val();
        const address = $('#address').val();

        // AJAX request to save data
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'save_user_info',
                nid: nid,
                address: address,
                // nonce: your_nonce // Add nonce if you're using it
            },
            success: function(response) {
                console.log(response); // Log response for debugging
                if (response.success) {
                    alert(response.data); // Show success message
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

