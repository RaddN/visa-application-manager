<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
// Add a new admin menu for Visa Fee Management
add_action('admin_menu', 'visa_fee_menu');

function visa_fee_menu()
{
    add_menu_page(
        'Visa Fee Manage', // Page title
        'Visa Fee Manage', // Menu title
        'manage_options',  // Capability
        'visa-fee-manage', // Menu slug
        'visa_fee_manage_page', // Function to display the management page
        'dashicons-admin-users', // Icon
        6 // Position
    );

    // New submenu for adding/editing visa fees
    add_submenu_page(
        'visa-fee-manage', // Parent slug
        'Visa Fee', // Page title
        'Add Visa Fee', // Menu title
        'manage_options', // Capability
        'add-edit-visa-fee', // Menu slug
        'visa_fee_add_edit_page' // Function to display the add/edit page
    );

    // Submenu for Applicants
    add_submenu_page(
        'visa-fee-manage', // Parent slug
        'Applicants', // Page title
        'Applicants', // Menu title
        'manage_options', // Capability
        'visa-fee-applicants', // Menu slug
        'visa_fee_applicants_page' // Function to display the applicants page
    );

    add_submenu_page(
        'visa-fee-manage', // Parent slug
        'Pages', // Page title
        'Pages', // Menu title
        'manage_options', // Capability
        'visa-pages', // Menu slug
        'visa_pages' // Function to display the applicants page
    );
}


// Display the Visa Fee Management page
function visa_fee_manage_page()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'visa_fees';

    // Handle form submissions for deleting visa fees
    if (isset($_GET['delete'])) {
        $wpdb->delete($table_name, ['id' => intval($_GET['delete'])]);
        echo '<div class="updated"><p>Visa Fee deleted successfully!</p></div>';
    }

    // Pagination setup
    $limit = 30; // Number of entries per page
    $offset = 0; // Default offset

    if (isset($_GET['paged'])) {
        $paged = intval($_GET['paged']);
        $offset = ($paged - 1) * $limit;
    } else {
        $paged = 1;
    }

    // Fetch the total number of entries
    $total_entries = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    $total_pages = ceil($total_entries / $limit);

    // Fetch the existing visa fees with pagination
    $visa_fees = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table_name LIMIT %d OFFSET %d",
        $limit,
        $offset
    ));

?>
    <div class="wrap">
        <h1>Manage Visa Fees</h1>
        <a href="/wp-admin/admin.php?page=add-edit-visa-fee" id="add-new-visa-fee" class="button button-primary">Add New Visa Fee</a>

        <table class="widefat fixed">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Entry Details</th>
                    <th>Processing Time</th>
                    <th>Service Available</th>
                    <th>Visa Fee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($visa_fees as $fee): ?>
                    <tr>
                        <td><?php echo $fee->country; ?></td>
                        <td><?php echo $fee->category; ?></td>
                        <td><?php echo $fee->title; ?></td>
                        <td><?php echo $fee->entry_details; ?></td>
                        <td><?php echo $fee->processing_time; ?></td>
                        <td><?php echo $fee->service_available; ?></td>
                        <td><?php echo $fee->visa_fee; ?></td>
                        <td>
                            <a href="admin.php?page=add-edit-visa-fee&edit=<?php echo $fee->id; ?>">Edit</a>
                            |
                            <a href="?page=visa-fee-manage&delete=<?php echo $fee->id; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <style>
            .widefat {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .widefat th,
            .widefat td {
                padding: 12px;
                text-align: left;
                border: 1px solid #ccc;
            }

            .widefat th {
                background-color: #f1f1f1;
                font-weight: bold;
                color: #333;
            }

            .widefat tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .widefat tbody tr:hover {
                background-color: #f0f0f0;
            }

            .widefat td {
                vertical-align: middle;
            }

            .widefat td a {
                color: #0073aa;
                text-decoration: none;
            }

            .widefat td a:hover {
                text-decoration: underline;
            }

            .tablenav {
                margin: 20px 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .tablenav-pages {
                display: flex;
                flex-wrap: wrap;
            }

            .tablenav-pages a {
                display: inline-block;
                padding: 8px 12px;
                margin: 0 2px;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #f9f9f9;
                color: #0073aa;
                text-decoration: none;
                transition: background-color 0.3s, color 0.3s;
            }

            .tablenav-pages a:hover {
                background-color: #0073aa;
                color: white;
            }

            .tablenav-pages a.current {
                background-color: #0073aa;
                color: white;
                border-color: #0073aa;
            }

            .tablenav-pages a.current:hover {
                background-color: #005177;
            }
        </style>
        <!-- Pagination Links -->
        <div class="tablenav">
            <div class="tablenav-pages">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=visa-fee-manage&paged=<?php echo $i; ?>" class="<?php echo ($i === $paged) ? 'current' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
<?php
}

function visa_fee_add_edit_page()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'visa_fees';

    // Handle form submissions for adding/editing visa fees
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_visa_fee'])) {
            $wpdb->insert($table_name, [
                'country' => sanitize_text_field($_POST['country']),
                'country_short' => sanitize_text_field($_POST['country_short']),
                'category' => sanitize_text_field($_POST['category']),
                'title' => sanitize_text_field($_POST['title']),
                'entry_details' => sanitize_textarea_field($_POST['entry_details']),
                'processing_time' => sanitize_text_field($_POST['processing_time']),
                'service_available' => sanitize_text_field($_POST['service_available']),
                'visa_fee' => sanitize_text_field($_POST['visa_fee']),
            ]);
            echo '<div class="updated"><p>Visa Fee added successfully!</p></div>';
        }

        if (isset($_POST['edit_visa_fee'])) {
            $wpdb->update($table_name, [
                'country' => sanitize_text_field($_POST['country']),
                'country_short' => sanitize_text_field($_POST['country_short']),
                'category' => sanitize_text_field($_POST['category']),
                'title' => sanitize_text_field($_POST['title']),
                'entry_details' => sanitize_textarea_field($_POST['entry_details']),
                'processing_time' => sanitize_text_field($_POST['processing_time']),
                'service_available' => sanitize_text_field($_POST['service_available']),
                'visa_fee' => sanitize_text_field($_POST['visa_fee']),
            ], ['id' => intval($_POST['id'])]);
            echo '<div class="updated"><p>Visa Fee updated successfully!</p></div>';
        }
    }

    // Check if editing a specific visa fee
    $editing_fee = null;
    if (isset($_GET['edit'])) {
        $editing_fee = $wpdb->get_row("SELECT * FROM $table_name WHERE id = " . intval($_GET['edit']));
    }

?>
    <style>
        .visa-fee-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .visa-fee-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .visa-fee-form input[type="text"],
        .visa-fee-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .visa-fee-form input[type="submit"] {
            background-color: #0073aa;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
        }

        .visa-fee-form input[type="submit"]:hover {
            background-color: #005177;
        }

        @media (max-width: 600px) {
            .visa-fee-form {
                padding: 15px;
            }

            .visa-fee-form input[type="text"],
            .visa-fee-form textarea {
                font-size: 16px;
            }

            .visa-fee-form input[type="submit"] {
                padding: 12px 20px;
                font-size: 18px;
            }
        }
    </style>
    <div class="wrap">
        <h1><?php echo $editing_fee ? 'Edit Visa Fee' : 'Add New Visa Fee'; ?></h1>
        <form class="visa-fee-form" method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $editing_fee ? $editing_fee->id : ''; ?>">
            <label for="country">Select Country:</label>
            <input type="text" name="country" id="country" required value="<?php echo $editing_fee ? esc_attr($editing_fee->country) : ''; ?>">

            <label for="country_short">Country Short Form:</label>
            <input type="text" name="country_short" id="country_short" required value="<?php echo $editing_fee ? esc_attr($editing_fee->country_short) : ''; ?>">

            <label for="category">Select Category:</label>
            <input type="text" name="category" id="category" required value="<?php echo $editing_fee ? esc_attr($editing_fee->category) : ''; ?>">

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required value="<?php echo $editing_fee ? esc_attr($editing_fee->title) : ''; ?>">

            <label for="entry_details">Entry Details:</label>
            <textarea name="entry_details" id="entry_details" required><?php echo $editing_fee ? esc_textarea($editing_fee->entry_details) : ''; ?></textarea>

            <label for="processing_time">Processing Time:</label>
            <input type="text" name="processing_time" id="processing_time" required value="<?php echo $editing_fee ? esc_attr($editing_fee->processing_time) : ''; ?>">

            <label for="service_available">Service Available:</label>
            <input type="text" name="service_available" id="service_available" required value="<?php echo $editing_fee ? esc_attr($editing_fee->service_available) : ''; ?>">

            <label for="visa_fee">Visa Fee:</label>
            <input type="text" name="visa_fee" id="visa_fee" required value="<?php echo $editing_fee ? esc_attr($editing_fee->visa_fee) : ''; ?>">

            <input type="submit" name="<?php echo $editing_fee ? 'edit_visa_fee' : 'add_visa_fee'; ?>" value="<?php echo $editing_fee ? 'Update Visa Fee' : 'Add Visa Fee'; ?>" class="button button-primary">
        </form>
    </div>
<?php
}

// Create a shortcode to display Visa Fees
add_shortcode('visa_fees', 'display_visa_fees');
function display_visa_fees()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'visa_fees';

    // Fetch all visa fees
    $visa_fees = $wpdb->get_results("SELECT * FROM $table_name");

    // Get unique countries and categories for filtering
    $countries = array_unique(array_map(function ($fee) {
        return $fee->country;
    }, $visa_fees));

    $categories = array_unique(array_map(function ($fee) {
        return $fee->category;
    }, $visa_fees));

    // Start output buffering
    ob_start();

    echo '
    
    <style>
.item {
    background-color: #fff;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #eaebf0;
    cursor: pointer;
    transition: border .5s, box-shadow .5s;
}
    .item * {
 text-align: center;
}
 .item p{
 margin: 0 !important;
}

.visa_fees {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1rem;
    margin-top: 2rem;
}
    @media only screen and (min-width: 768px) {
    .item .title {
        font-size: .875rem;
        line-height: 1.25rem;
    }
}
.item .title {
    color: #595b86;
    font-size: .75rem;
    line-height: 1rem;
    line-height: normal;
}
    @media only screen and (min-width: 768px) {
    .item .no_of_entries {
        font-size: 15px;
        font-weight: 500;
    }
}
.item .no_of_entries {
    color: var(--primary-900);
    font-size: .875rem;
    line-height: 1.25rem;
    font-weight: 500;
    line-height: normal;
}
    @media (min-width: 768px) {
    .item .purpose {
        font-size: .75rem;
        line-height: 1rem;
    }
}
.item .purpose {
    color: #666885;
    font-size: 11px;
}
    .item .travel-purpose {
    margin-top: 10px;
    padding: 6px 10px;
    background-color: #f9f9fb;
    border-radius: 5px;
}
    .filter {
        margin-bottom: 20px;
    }
    .category-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    .category-tab {
        cursor: pointer;
        padding: 10px;
        background-color: #fff;
        border-radius: 5px;
    }
    .category-tab.active {
        background-color: #2f3268;
        color: #fff;
    }
select#country-filter {
    width: max-content;
}
    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 5px;
    }
    .pagination a {
        padding: 5px 10px;
        border: 1px solid #eaebf0;
        border-radius: 5px;
        text-decoration: none;
        color: #2f3268;
cursor: pointer;
    }
    .pagination a.active {
        border-color: #2f3268;
    }
    .pagination .disabled {
        color: #ccc;
        pointer-events: none;
    }
        @media(max-width:767px){
.category-tabs {
    overflow-x: scroll;
}
    .category-tab {
    min-width: max-content;
}
}
    </style>
    <div class="filter category_search !mt-0 flex flex-col justify-center sm:flex-row gap-2 items-center">
    <p class="text-lg m-0" style="margin:0;">Search by Country:</p>
        <select id="country-filter">
            <option value="">All Countries</option>';

    foreach ($countries as $country) {
        echo '<option value="' . esc_attr($country) . '">' . esc_html($country) . '</option>';
    }

    echo '
        </select>
    </div>

    <div class="category-tabs">
        <div class="category-tab active" data-category="all">All Categories</div>';

    foreach ($categories as $category) {
        echo '<div class="category-tab" data-category="' . esc_attr($category) . '">' . esc_html($category) . '</div>';
    }

    echo '</div>';

    echo '<div class="visa_fees" id="visa-fees-container">';
    $plugin_url = plugin_dir_url(__FILE__);

    foreach ($visa_fees as $fee) {
        $country_code = strtolower($fee->country_short);
        $image_src = $plugin_url . '../asstes/countries/' . $country_code . '.svg';
        echo '<a href="/' . strtolower(str_replace(' ', '-', esc_attr($fee->country))) . '/apply-online/">';
        echo '<div class="item" data-country="' . esc_attr($fee->country) . '" data-category="' . esc_attr($fee->category) . '">';
        echo '<p class="title">' . esc_html($fee->title) . '</p>';
        echo '<p class="no_of_entries">' . esc_html($fee->entry_details) . '</p>';
        echo '<hr style="border-bottom: 1px solid #eaebf0; margin: 10px 0; ">';
        echo '<div class="travel-purpose"><p class="purpose">Processing Time</p>';
        echo '<p class="title"><span><svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 30 30" class="inline-block" height="16" width="16" xmlns="http://www.w3.org/2000/svg"><path d="M3.74,14.47c0-2.04,0.51-3.93,1.52-5.66s2.38-3.1,4.11-4.11s3.61-1.51,5.64-1.51c1.52,0,2.98,0.3,4.37,0.89
        s2.58,1.4,3.59,2.4s1.81,2.2,2.4,3.6s0.89,2.85,0.89,4.39c0,1.52-0.3,2.98-0.89,4.37s-1.4,2.59-2.4,3.59s-2.2,1.8-3.59,2.39
        s-2.84,0.89-4.37,0.89c-1.53,0-3-0.3-4.39-0.89s-2.59-1.4-3.6-2.4s-1.8-2.2-2.4-3.58S3.74,16,3.74,14.47z M6.22,14.47
        c0,2.37,0.86,4.43,2.59,6.18c1.73,1.73,3.79,2.59,6.2,2.59c1.58,0,3.05-0.39,4.39-1.18s2.42-1.85,3.21-3.2s1.19-2.81,1.19-4.39
        s-0.4-3.05-1.19-4.4s-1.86-2.42-3.21-3.21s-2.81-1.18-4.39-1.18s-3.05,0.39-4.39,1.18S8.2,8.72,7.4,10.07S6.22,12.89,6.22,14.47z
        M14.14,14.47V7.81c0-0.23,0.08-0.43,0.24-0.59s0.36-0.24,0.59-0.24s0.43,0.08,0.59,0.24s0.24,0.36,0.24,0.59v5.82h3.78
        c0.23,0,0.43,0.08,0.59,0.24s0.24,0.36,0.24,0.59c0,0.22-0.08,0.42-0.24,0.59c-0.16,0.17-0.36,0.25-0.59,0.25h-4.44
        c-0.03,0.01-0.09,0.01-0.18,0.01c-0.23,0-0.43-0.08-0.59-0.24S14.14,14.71,14.14,14.47z"></path></svg></span><span>' . esc_html($fee->processing_time) . '</span></p></div>';
        echo '<div class="travel-purpose"><p class="purpose">Service Available</p>';
        echo '<p>' . esc_html($fee->service_available) . '</p></div>';
        echo '<hr style="border-bottom: 1px solid #eaebf0; margin: 10px 0; ">';
        echo '<div class="flex" style="justify-content: space-between;">
        <div class="flex items-center gap-[5px]"><img class="h-5 w-8 rounded-[3px] md:h-6 md:w-10" src="' . esc_url($image_src) . '"> <p>' . esc_html($fee->country) . '</p></div>';
        echo '<p class="flex flex-col justify-center items-center gap-2"><span class="title-regular-11 -mb-2 hidden text-[var(--gray-500)] md:inline">Visa Fee</span><span style="color:#0f0f24;"> ' . esc_html($fee->visa_fee) . '</span></p></div>';
        echo '</div>'; // Close item
        echo '</a>';
    }

    echo '</div>'; // Close visa_fees

    // Pagination
    echo '<div class="pagination" id="pagination-container"></div>';

    // Include JavaScript for filtering and pagination
?>
    <script>
        const itemsPerPage = 16;
        let currentPage = 1;

        function renderPagination(totalItems) {

            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const paginationContainer = document.getElementById('pagination-container');
            paginationContainer.innerHTML = '';

            // Previous Button
            const prevButton = document.createElement('a');
            prevButton.innerHTML = '<';
            prevButton.className = currentPage === 1 ? 'disabled' : '';
            prevButton.onclick = () => {
                if (currentPage > 1) changePage(currentPage - 1);
            };
            paginationContainer.appendChild(prevButton);

            // Page Number Links
            for (let i = 1; i <= totalPages; i++) {
                const pageLink = document.createElement('a');
                pageLink.innerText = i;
                pageLink.className = i === currentPage ? 'active' : '';
                pageLink.onclick = () => changePage(i);
                paginationContainer.appendChild(pageLink);
            }

            // Next Button
            const nextButton = document.createElement('a');
            nextButton.innerHTML = '>';
            nextButton.className = currentPage === totalPages ? 'disabled' : '';
            nextButton.onclick = () => {
                if (currentPage < totalPages) changePage(currentPage + 1);
            };
            paginationContainer.appendChild(nextButton);
        }

        function changePage(page) {
            currentPage = page;
            console.log('Current Page:', currentPage);
            const items = document.querySelectorAll('.visa_fees .item');
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            items.forEach((item, index) => {
                item.style.display = index >= start && index < end ? 'block' : 'none';
            });

            renderPagination(items.length); // Update pagination after filtering
        }

        document.getElementById('country-filter').addEventListener('change', function() {
            var selectedCountry = this.value;
            var items = document.querySelectorAll('.visa_fees .item');
            let visibleItems = 0;
            items.forEach(function(item) {
                if (selectedCountry === '' || item.getAttribute('data-country') === selectedCountry) {
                    item.style.display = 'block';
                    visibleItems++;
                } else {
                    item.style.display = 'none';
                }
            });
            renderPagination(visibleItems); // Update pagination based on visible items
            // changePage(1); // Reset to first page after filtering
            document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
        });

        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const selectedCategory = this.getAttribute('data-category');
                const items = document.querySelectorAll('.visa_fees .item');

                items.forEach(item => item.style.display = 'none'); // Hide all items initially

                let visibleItems = 0; // Counter for visible items
                items.forEach(item => {
                    if (selectedCategory === 'all' || item.getAttribute('data-category') === selectedCategory) {
                        item.style.display = 'block'; // Show matching items
                        visibleItems++;
                    }
                });

                renderPagination(visibleItems); // Update pagination based on visible items
                // changePage(1); // Reset to first page after filtering
                document.getElementById('country-filter').value = ''; // Reset country filter
            });
        });


        // Initial render
        renderPagination(<?php echo count($visa_fees); ?>);
        changePage(1); // Show first page on initial load
    </script>
<?php

    // Return the output
    return ob_get_clean();
}


function tracking_form_shortcode()
{
    ob_start(); ?>
    <style>
        .widget {
            margin: 0;
        }
    </style>
    <form class="ant-input-group-wrapper ant-input-group-wrapper-outlined css-1588u1j ant-input-search ant-input-search-with-button app_track !flex !w-[125px] items-center justify-center xl:!w-[160px]" method="post" action="<?php echo esc_url(home_url('/application-status/')); ?>">
        <input type="text" name="tracking_id" placeholder="Tracking ID" required class="ant-input css-1588u1j ant-input-outlined" style="font-size: 14px;border-radius: 5px 0 0 5px;" value="<?php echo isset($_POST['tracking_id']) ? esc_attr($_POST['tracking_id']) : ''; ?>">
        <button type="submit" class="ant-btn css-1588u1j ant-btn-primary ant-input-search-button" style="height: 39px !important; padding:0 15px;border-radius: 0 5px 5px 0;">
            <svg stroke="currentColor" fill="#fff" stroke-width="0" viewBox="0 0 512 512" class="text-lg" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path d="M456.69 421.39 362.6 327.3a173.81 173.81 0 0 0 34.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 0 0 327.3 362.6l94.09 94.09a25 25 0 0 0 35.3-35.3zM97.92 222.72a124.8 124.8 0 1 1 124.8 124.8 124.95 124.95 0 0 1-124.8-124.8z"></path>
            </svg>
        </button>
    </form>
    <?php return ob_get_clean();
}
add_shortcode('tracking_form', 'tracking_form_shortcode');


function tracking_id_shortcode($atts)
{
    if (isset($_POST['tracking_id'])) {
        $tracking_id = sanitize_text_field($_POST['tracking_id']);
        global $wpdb;
        $atts = shortcode_atts(array(
            'application_form_id' => '0'
        ), $atts);
        $results = $wpdb->get_results($wpdb->prepare(
            "SELECT entry_id, fields, status FROM {$wpdb->prefix}wpforms_entries 
        WHERE form_id = %d AND type = %s AND entry_id = %d",
            intval($atts['application_form_id']),
            'payment',
            $tracking_id
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
            $going_form = 'N/A';
            $going_to = 'N/A';
            $visa_cata = 'N/A';

            // Iterate through the fields to find the necessary values
            foreach ($fields as $field) {
                if ($field['name'] === 'Select TTGVISAHUB Services') {
                    $amount = isset($field['amount']) ? $field['amount'] : 'N/A'; // Assuming Amount is stored under this name
                } elseif ($field['name'] === 'visacata') {
                    $visa_cata = $field['value'];
                } elseif ($field['name'] === 'goingform') {
                    $going_form = $field['value'];
                } elseif ($field['name'] === 'goingto') {
                    $going_to = $field['value'];
                }
            }

            // Create a table row
            $table_rows .= '<tr>';
            $table_rows .= '<td class="ant-table-cell">' . esc_html($row->entry_id) . '</td>';
            $table_rows .= '<td class="ant-table-cell">' . esc_html($going_form) . '</td>';
            $table_rows .= '<td class="ant-table-cell">' . esc_html($going_to) . '</td>';
            $table_rows .= '<td class="ant-table-cell">' . esc_html($visa_cata) . '</td>';
            $table_rows .= '<td class="ant-table-cell status ' . $row->status . '"><p style="margin:0;">' . $row->status . '</p></td>';
            $table_rows .= '</tr>';
        }
        ob_start();
        if ($table_rows) {

    ?>
            <style>
                .timeline .status span {
                    background: #4a5568;
                    width: max-content;
                    color: #ffffff;
                    border-radius: 0.3rem;
                    padding: 0.4rem;
                }

                .timeline .timeline-contents p {
                    margin: 0;
                }

                .timeline .status.rejected span {
                    background: #e53e3e;
                }

                .timeline .status.approved span {
                    background: #38a169;
                }

                .timeline {
                    position: relative;
                    /* max-width: 800px;
                    margin: auto;
                    padding: 20px; */
                    /* background: white; */
                    border-radius: 8px;
                    display: flex;
                    gap: 2rem;
                }

                .application-info {
                    margin-bottom: 20px;
                    padding: 40px;
                    background-color: #e7f3fe;
                    border: 1px solid #b3e0fd;
                    border-radius: 5px;
                }

                .timeline-contents {
                    padding-left: 2rem;
                    position: relative;
                }

                .timeline-contents:before {
                    content: "";
                    height: 82%;
                    width: 5px;
                    background: #b1d9f5;
                    position: absolute;
                    left: 11px;
                    top: 39px;
                    z-index: -1;
                }

                .timeline-contents::after {
                    content: "";
                    height: calc(82% - 59%);
                    width: 5px;
                    background: #3498db;
                    position: absolute;
                    left: 11px;
                    top: 41px;
                }

                .timeline-item {
                    position: relative;
                    margin: 20px 0;
                    padding: 20px;
                    background-color: white;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    transition: background-color 0.3s;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 1rem;
                }

                .timeline-item:hover {
                    background-color: #f9f9f9;
                }

                .timeline-item:before {
                    content: '';
                    position: absolute;
                    left: -30px;
                    top: 20px;
                    width: 20px;
                    height: 20px;
                    border-radius: 50%;
                    background: #3498db;
                    box-shadow: 0 0 0 4px white;
                }

                .timeline-item.failed::before {
                    background: #a7d8f9;
                }

                .timeline h3 {
                    margin: 0 0 10px 0;
                    font-size: 1.2em;
                    color: #333;
                }

                .timeline .checkmark {
                    color: green;
                    font-weight: bold;
                }

                .timeline .status {
                    font-size: 0.9em;
                    color: #666;
                    margin: 5px 0;
                }

                .timeline .rejection-reason {
                    color: red;
                    font-style: italic;
                }

                .timeline span {
                    font-size: 0.85em;
                    color: #999;
                    margin-left: auto;
                    /* Align to the right */
                }

                .timeline a {
                    color: #3498db;
                    text-decoration: none;
                    font-weight: bold;
                }

                .timeline a:hover {
                    text-decoration: underline;
                }

                @media (max-width: 600px) {
                    .timeline {
                        padding: 15px;
                        display: block;
                        padding: 0;
                    }

                    .timeline-item {
                        padding: 15px;
                        display: block;
                    }

                    .application-info {
                        padding: 10px;
                    }

                    .timeline-item:before {
                        width: 15px;
                        height: 15px;
                    }

                    .timeline-contents:before {
                        left: 8px;
                    }

                    .timeline-contents::after {
                        left: 8px;
                        top: 39px;
                    }
                }
            </style>
            <?php $application_status = get_application_status_by_entry_id($row->entry_id);
            ?>
            <div class="timeline">
                <div class="application-info">
                    <h3>Application Info</h3>
                    <p><strong>Tracking ID:</strong> <?php echo esc_html($application_status["entry_id"]); ?></p>
                    <p><strong>Going From:</strong> <?php echo esc_html(ucwords($going_form === "" ? "N/A" : $going_form ?? "N/A")); ?></p>
                    <p><strong>Going To:</strong> <?php echo esc_html(ucwords($going_to === "" ? "N/A" : $going_to ?? "N/A")); ?></p>
                    <p><strong>Category:</strong> <?php echo esc_html(ucwords($visa_cata === "" ? "N/A" : $visa_cata ?? "N/A")); ?></p>
                    <p class="status <?php echo esc_html($application_status["payment_status"]); ?>"><strong>Payment Status:</strong> <span><?php echo esc_html($application_status["payment_status"]); ?></span></p>
                </div>

                <div class="timeline-contents">
                    <div class="timeline-item success">
                        <div>
                            <h3>Application Received</h3>
                            <p class="status">Status: <?php echo esc_html($application_status["application_received_status"]); ?></p>
                        </div>
                        <div>
                            <span>Received On: <?php echo esc_html($application_status["application_received_status_updated_at"]); ?></span>
                        </div>
                    </div>
                    <div class="timeline-item <?php echo $application_status["document_process_status"] === "Rejected" ? 'failed' : 'success'; ?>">
                        <div>
                            <h3>Document Process</h3>
                            <p class="status">
                                <?php echo $application_status["document_process_status"] === "Not Added" ? 'Not added yet. <a href="/user/documents/" target="_blank">Add your document now</a>.' : 'Status: ' . esc_html($application_status["document_process_status"]); ?></p>
                        </div>
                        <div>
                            <span>Updated On: <?php echo esc_html($application_status["document_process_status_updated_at"]); ?></span>
                        </div>
                    </div>
                    <?php if (!empty($application_status["document_rejection_reason"]) && $application_status["document_process_status"] !== "Done" && $application_status["document_process_status"] !== "Pending"): ?>
                        <style>
                            .timeline-contents::after {
                                height: calc(82% - 64%);
                            }
                        </style>
                        <div class="timeline-item failed">
                            <div>
                                <h3>Document Rejection Reason</h3>
                                <p class="rejection-reason"><?php echo esc_html($application_status["document_rejection_reason"]); ?></p>
                            </div>
                            <div>
                                <span>Updated On: <?php echo esc_html($application_status["document_process_status_updated_at"]); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="timeline-item <?php echo $application_status["submitted_for_visa_status"] === "Submitted" ? 'success' : 'failed'; ?>">
                        <?php echo $application_status["submitted_for_visa_status"] === "Submitted" ? '<style>.timeline-contents::after {height: calc(82% - 31%);}</style>' : "" ?>
                        <div>
                            <h3>Submitted For Visa</h3>
                            <p class="status">Status: <?php echo esc_html($application_status["submitted_for_visa_status"]); ?></p>
                        </div>
                        <div>
                            <span>Updated On: <?php echo esc_html($application_status["submitted_for_visa_status_updated_at"]); ?></span>
                        </div>
                    </div>
                    <div class="timeline-item <?php echo $application_status["immigration_status"] === "Approved" ? 'success' : 'failed'; ?>">
                        <div>
                            <h3>Immigration Status</h3>
                            <p class="status">Status: <?php echo esc_html($application_status["immigration_status"]); ?></p>
                        </div>
                        <div>
                            <span>Updated On: <?php echo esc_html($application_status["immigration_status_updated_at"]); ?></span>
                        </div>
                    </div>
                    <?php if (!empty($application_status["immigration_rejection_reason"]) && $application_status["immigration_status"] !== "Approved" && $application_status["immigration_status"] !== "Pending"): ?>
                        <style>
                            .timeline-contents::after {
                                height: calc(82% - 66%);
                            }
                        </style>
                        <?php echo $application_status["submitted_for_visa_status"] === "Submitted" ? '<style>.timeline-contents::after {height: calc(82% - 44%);}</style>' : "" ?>
                        <div class="timeline-item failed">
                            <div>
                                <h3>Immigration Rejection Reason</h3>
                                <p class="rejection-reason"><?php echo esc_html($application_status["immigration_rejection_reason"]); ?></p>
                            </div>
                            <div>
                                <span>Updated On: <?php echo esc_html($application_status["immigration_status_updated_at"]); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        } else { ?>
            <div class="wp-block-group is-layout-constrained wp-block-group-is-layout-constrained">
                <figure class="wp-block-image aligncenter size-full"><img decoding="async" src="/wp-content/uploads/2025/02/empty-inbox.svg" alt="" class="wp-image-1890"></figure>
                <p class="has-text-align-center has-text-color has-link-color wp-elements-0c73d6eefa1869c1916b18b979482e15" style="color:#6b7280;font-size:14px">The Tracking ID may be incorrect or the status update is not yet available. Please, verify your Tracking ID and try again later.</p>
            </div>
        <?php
        }
        return ob_get_clean();
    } else {
        return '<p style="font-size:14px;text-align:center;">No Tracking ID provided.</p>';
    }
}
add_shortcode('display_tracking_id', 'tracking_id_shortcode');



function visa_fee_applicants_page()
{
    global $wpdb;

    // Get the stored application form ID, or set to default if not set
    $application_form_id = get_option('application_form_id', 17);

    // Check if a new form ID is submitted
    if (isset($_POST['application_form_id'])) {
        $new_form_id = intval($_POST['application_form_id']);
        if ($new_form_id > 0) {
            // Update the option to store the new application form ID
            update_option('application_form_id', $new_form_id);
            // Refresh the stored value
            $application_form_id = $new_form_id;
        }
    }

    // Get all subscribers
    $args = array(
        // 'role' => 'subscriber',
        'orderby' => 'user_login',
        'order' => 'ASC'
    );
    $subscribers = get_users($args);

    // Begin the output
    echo '<div class="wrap">';
    echo '<h1>Applicants</h1>';

    // Form for entering application form ID
    echo '<form method="post" style="display:none;">';
    echo '<label for="application_form_id">Enter Application Form ID:</label>';
    echo '<input disabled type="number" name="application_form_id" id="application_form_id" value="' . esc_attr($application_form_id) . '" />';
    echo '<input disabled type="submit" value="Submit" class="button button-primary" />';
    echo '</form>';

    if (!empty($subscribers)) {
        echo '<table class="widefat fixed striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Username</th>';
        echo '<th>Name</th>';
        echo '<th>Email</th>';
        echo '<th>Number of Applied Visas</th>'; // New Column
        echo '<th>All Tracking Id</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($subscribers as $subscriber) {
            // Get the count of applied visas for the specified form ID
            $total_applied_visa = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}wpforms_entries WHERE user_id = %d AND form_id = %d",
                $subscriber->ID,
                $application_form_id
            ));

            // Get the entry IDs for the specified form ID
            $entry_ids = $wpdb->get_col($wpdb->prepare(
                "SELECT entry_id FROM {$wpdb->prefix}wpforms_entries WHERE user_id = %d AND form_id = %d",
                $subscriber->ID,
                $application_form_id
            ));

            echo '<tr>';
            echo '<td><a href="' . esc_url(home_url('user/?user_id=' . $subscriber->ID)) . '" target="_blank">' . esc_html($subscriber->user_login) . '</a></td>';
            echo '<td>' . esc_html($subscriber->display_name) . '</td>';
            echo '<td>' . esc_html($subscriber->user_email) . '</td>';
            echo '<td>' . esc_html($total_applied_visa) . '</td>'; // Show the count
            echo '<td>';
            foreach ($entry_ids as $index => $entry_id) {
                echo '<a href="' . esc_url(admin_url('admin.php?page=wpforms-entries&view=details&entry_id=' . $entry_id)) . '" target="_blank">' . esc_html($entry_id) . '</a>';
                if ($index < count($entry_ids) - 1) {
                    echo ', ';
                }
            }
            echo '</td>';
            echo '<td><button class="button button-secondary update-status-btn" data-user-id="' . esc_attr($subscriber->ID) . '">Update Status</button></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const updateButtons = document.querySelectorAll('.update-status-btn');

                updateButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const userId = this.getAttribute('data-user-id');
                        const popup = document.createElement('div');
                        popup.classList.add('popup-overlay');
                        popup.innerHTML = `
                <div class="popup-content">
                <h2>Update Status for User ID: ${userId}</h2>
                <form id="update-status-form">
                <label for="entry_id">Select Entry ID:</label>
                <select name="entry_id" id="entry_id" required>
                <option value="">Select Entry ID</option>
                ${getEntryIds(userId)}
                </select>
                
                <label for="status">Payment Status:</label>
                <select name="status" id="status">
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
                <option value="Not Paid">Not Paid</option>
                </select>
                
                <label for="application_received_status">Application Received Status:</label>
                <select name="application_received_status" id="application_received_status">
                <option value="Pending">Pending</option>
                <option value="Rejected">Rejected</option>
                <option value="Done">Done</option>
                </select>
                
                <label for="document_process_status">Document Process Status:</label>
                <select name="document_process_status" id="document_process_status">
                <option value="Not Added">Not Added</option>
                <option value="Pending">Pending</option>
                <option value="Rejected">Rejected</option>
                <option value="Done">Done</option>
                </select>
                
                <label for="document_rejection_reason">Document Rejection Reason:</label>
                <textarea name="document_rejection_reason" id="document_rejection_reason" placeholder="Provide reason if rejected"></textarea>
                
                <label for="submitted_for_visa_status">Submitted for Visa Status:</label>
                <select name="submitted_for_visa_status" id="submitted_for_visa_status">
                <option value="Submitted">Submitted</option>
                <option value="Not Submitted">Not Submitted</option>
                </select>
                
                <label for="immigration_status">Immigration Status:</label>
                <select name="immigration_status" id="immigration_status">
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Pending">Pending</option>
                </select>
                
                <label for="immigration_rejection_reason">Immigration Rejection Reason:</label>
                <textarea name="immigration_rejection_reason" id="immigration_rejection_reason" placeholder="Provide reason if rejected"></textarea>
                
                <input type="hidden" name="user_id" value="${userId}">
                <button type="submit" class="button button-primary">Update</button>
                <button type="button" class="button button-secondary" id="close-popup">Cancel</button>
                </form>
                </div>
            `;
                        document.body.appendChild(popup);

                        const entryIdSelect = document.getElementById('entry_id');
                        entryIdSelect.addEventListener('change', function() {
                            const entryId = this.value;
                            if (entryId) {
                                fetchEntryDetails(entryId);
                            }
                        });

                        document.getElementById('close-popup').addEventListener('click', function() {
                            document.body.removeChild(popup);
                        });

                        document.getElementById('update-status-form').addEventListener('submit', function(e) {
                            e.preventDefault();
                            const formData = new FormData(this);
                            formData.append('action', 'update_entry_status');

                            fetch(ajaxurl, {
                                    method: 'POST',
                                    body: formData,
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert('Status updated successfully!');
                                    } else {
                                        alert('Failed to update status.');
                                    }
                                    document.body.removeChild(popup);
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('An error occurred.');
                                    document.body.removeChild(popup);
                                });
                        });
                    });
                });

                function fetchEntryDetails(entryId) {
                    const formData = new FormData();
                    formData.append('action', 'fetch_entry_status_details');
                    formData.append('entry_id', entryId);

                    fetch(ajaxurl, {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.data && data.data.details) {
                                const details = data.data.details;
                                document.getElementById('document_process_status').value = details.document_process_status || 'not_added';
                                document.getElementById('document_rejection_reason').value = details.document_rejection_reason || '';
                                document.getElementById('status').value = details.payment_status || 'pending';
                                document.getElementById('application_received_status').value = details.application_received_status || 'pending';
                                document.getElementById('submitted_for_visa_status').value = details.submitted_for_visa_status || 'Not Submitted';
                                document.getElementById('immigration_status').value = details.immigration_status || 'pending';
                                document.getElementById('immigration_rejection_reason').value = details.immigration_rejection_reason || '';
                            } else {
                                console.error('Error: data.details is undefined or improperly structured.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while fetching entry details.');
                        });
                }

                function getEntryIds(userId) {
                    let options = '';
                    <?php
                    $subscribers = get_users(array('orderby' => 'user_login', 'order' => 'ASC'));
                    foreach ($subscribers as $subscriber) {
                        $entry_ids = $wpdb->get_col($wpdb->prepare(
                            "SELECT entry_id FROM {$wpdb->prefix}wpforms_entries WHERE user_id = %d AND form_id = %d",
                            $subscriber->ID,
                            get_option('application_form_id', 17)
                        ));
                        echo "if (userId == '{$subscriber->ID}') {";
                        foreach ($entry_ids as $entry_id) {
                            echo "options += '<option value=\"{$entry_id}\">{$entry_id}</option>';";
                        }
                        echo "}";
                    }
                    ?>
                    return options;
                }
            });
        </script>
        <style>
            .popup-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.6);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

            .popup-content {
                background: #ffffff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                width: 70%;
                max-width: 90%;
                text-align: left;
                font-family: Arial, sans-serif;
            }

            .popup-content h2 {
                margin-top: 0;
                font-size: 1.5rem;
                color: #333333;
                border-bottom: 2px solid #f0f0f0;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            .popup-content form {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            @media (min-width: 768px) {
                .popup-content form {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 15px;
                }
            }

            .popup-content label {
                font-weight: bold;
                font-size: 0.9rem;
                color: #555555;
            }

            .popup-content select,
            .popup-content textarea,
            .popup-content input[type="text"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #cccccc;
                border-radius: 5px;
                font-size: 0.9rem;
                color: #333333;
                background-color: #f9f9f9;
                transition: border-color 0.3s;
            }

            .popup-content select:focus,
            .popup-content textarea:focus,
            .popup-content input[type="text"]:focus {
                border-color: #0073aa;
                outline: none;
                background-color: #ffffff;
            }

            .popup-content textarea {
                resize: vertical;
                min-height: 80px;
                max-width: 400px;
                width: 73%;
            }

            .popup-content button {
                padding: 10px 15px;
                font-size: 0.9rem;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s;
            }

            .popup-content .button-primary {
                background-color: #0073aa;
                color: #ffffff;
                border: none;
            }

            .popup-content .button-primary:hover {
                background-color: #005177;
            }

            .popup-content .button-secondary {
                background-color: #f0f0f0;
                color: #333333;
                border: none;
            }

            .popup-content .button-secondary:hover {
                background-color: #e0e0e0;
            }

            @media (max-width: 480px) {
                .popup-content {
                    padding: 20px;
                }

                .popup-content h2 {
                    font-size: 1.2rem;
                }

                .popup-content button {
                    font-size: 0.8rem;
                }
            }
        </style>

    <?php
    } else {
        echo '<p>No applicants found.</p>';
    }

    echo '</div>';
}
add_action('wp_ajax_update_entry_status', 'update_entry_status');
function update_entry_status()
{
    global $wpdb;

    $entry_id = intval($_POST['entry_id']);
    $status = sanitize_text_field($_POST['status']);
    $application_received_status = sanitize_text_field($_POST['application_received_status']);
    $document_process_status = sanitize_text_field($_POST['document_process_status']);
    $document_rejection_reason = sanitize_textarea_field($_POST['document_rejection_reason']);
    $submitted_for_visa_status = sanitize_text_field($_POST['submitted_for_visa_status']);
    $immigration_status = sanitize_text_field($_POST['immigration_status']);
    $immigration_rejection_reason = sanitize_textarea_field($_POST['immigration_rejection_reason']);

    $timestamps = [
        'application_received_status_updated_at' => null,
        'document_process_status_updated_at' => null,
        'submitted_for_visa_status_updated_at' => null,
        'immigration_status_updated_at' => null,
    ];

    // Update timestamps if statuses have changed
    $existing_entry = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}application_status WHERE entry_id = %d",
        $entry_id
    ));

    if ($existing_entry) {
        if ($existing_entry->application_received_status !== $application_received_status) {
            $timestamps['application_received_status_updated_at'] = current_time('mysql');
        }
        if ($existing_entry->document_process_status !== $document_process_status) {
            $timestamps['document_process_status_updated_at'] = current_time('mysql');
        }
        if ($existing_entry->submitted_for_visa_status !== $submitted_for_visa_status) {
            $timestamps['submitted_for_visa_status_updated_at'] = current_time('mysql');
        }
        if ($existing_entry->immigration_status !== $immigration_status) {
            $timestamps['immigration_status_updated_at'] = current_time('mysql');
        }
    } else {
        $timestamps = array_map(fn() => current_time('mysql'), $timestamps);
    }

    // Update wpforms_entries table
    $updated = $wpdb->update(
        "{$wpdb->prefix}wpforms_entries",
        ['status' => $status],
        ['entry_id' => $entry_id],
        ['%s'],
        ['%d']
    );

    if ($existing_entry) {
        // Update existing record in wp_application_status
        $wpdb->update(
            "{$wpdb->prefix}application_status",
            array_merge(
                [
                    'payment_status' => $status,
                    'application_received_status' => $application_received_status,
                    'document_process_status' => $document_process_status,
                    'document_rejection_reason' => $document_rejection_reason,
                    'submitted_for_visa_status' => $submitted_for_visa_status,
                    'immigration_status' => $immigration_status,
                    'immigration_rejection_reason' => $immigration_rejection_reason,
                    'updated_at' => current_time('mysql'),
                ],
                array_filter($timestamps)
            ),
            ['entry_id' => $entry_id],
            ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'],
            ['%d']
        );
    } else {
        // Insert new record into wp_application_status
        $wpdb->insert(
            "{$wpdb->prefix}application_status",
            array_merge(
                [
                    'entry_id' => $entry_id,
                    'payment_status' => $status,
                    'application_received_status' => $application_received_status,
                    'document_process_status' => $document_process_status,
                    'document_rejection_reason' => $document_rejection_reason,
                    'submitted_for_visa_status' => $submitted_for_visa_status,
                    'immigration_status' => $immigration_status,
                    'immigration_rejection_reason' => $immigration_rejection_reason,
                    'created_at' => current_time('mysql'),
                    'updated_at' => current_time('mysql'),
                ],
                $timestamps
            ),
            ['%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s']
        );
    }

    if ($updated !== false) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
function visa_pages()
{
    // Check for form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['visa_create_page'])) {
        // Handle form submission to create a page
        create_apply_page();
    }

    // Handle edit request
    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['page_id'])) {
        edit_apply_page($_GET['page_id']);
        return; // Exit after handling edit to prevent displaying the list again
    }

    // Handle delete request
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['page_id'])) {
        delete_apply_page($_GET['page_id']);
    }

    // Display the button to show the form
    ?>
    <div class="wrap">
        <h1>Create Apply Page</h1>
        <button id="toggle-form" class="button button-primary">Create Apply Page</button>

        <div id="apply-page-form" style="display:none; margin-top: 20px;">
            <form method="post">
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="page_name">Page Name</label></th>
                        <td><input type="text" name="page_name" id="page_name" required /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="slug">Slug</label></th>
                        <td><input type="text" name="slug" id="slug" required /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="country_name">Country Name</label></th>
                        <td><input type="text" name="country_name" id="country_name" required /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="title">Title</label></th>
                        <td><input type="text" name="title" id="title" required /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="basic_info_url">Basic Info URL</label></th>
                        <td><input type="url" name="basic_info_url" id="basic_info_url" required /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="embassy_details_url">Embassy Details URL</label></th>
                        <td><input type="url" name="embassy_details_url" id="embassy_details_url" required /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="requirement_title">Requirement Title</label></th>
                        <td><input type="text" name="requirement_title" id="requirement_title" required /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="requirement_description">Requirement Description</label></th>
                        <td><textarea name="requirement_description" id="requirement_description" required></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="steps_json">Steps (JSON)</label></th>
                        <td><textarea name="steps_json" id="steps_json" required placeholder='[{"title":"","description":""}]'></textarea></td>
                    </tr>
                </table>
                <?php submit_button('Create Page', 'primary', 'visa_create_page'); ?>
            </form>
        </div>

        <h2>List of Apply Pages</h2>
        <table class="widefat fixed striped">
            <thead>
                <tr>
                    <th>Page Title</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display the list of pages marked as apply pages
                $apply_pages = get_posts(array(
                    'post_type' => 'page',
                    'meta_key' => 'is_apply_page',
                    'meta_value' => '1',
                ));

                if ($apply_pages) {
                    foreach ($apply_pages as $page) {
                        echo '<tr>';
                        echo '<td>' . esc_html($page->post_title) . '</td>';
                        echo '<td><a href="' . esc_url(get_permalink($page->ID)) . '" target="_blank">' . esc_url(get_permalink($page->ID)) . '</a></td>';
                        echo '<td>';
                        echo '<a href="' . esc_url(admin_url('admin.php?page=visa-pages&action=edit&page_id=' . $page->ID)) . '" class="button">Edit</a>';
                        echo ' <a href="' . esc_url(admin_url('admin.php?page=visa-pages&action=delete&page_id=' . $page->ID)) . '" class="button" onclick="return confirm(\'Are you sure you want to delete this page?\');">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="3">No apply pages found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('toggle-form').addEventListener('click', function() {
            var form = document.getElementById('apply-page-form');
            if (form.style.display === 'none') {
                form.style.display = 'block';
                this.textContent = 'Hide Apply Page Form';
            } else {
                form.style.display = 'none';
                this.textContent = 'Create Apply Page';
            }
        });
    </script>
<?php
}

function apply_page_content($country_name, $title, $basic_info_url, $embassy_details_url, $requirement_title, $requirement_description, $steps_json)
{

    $steps_json = stripslashes(trim($_POST['steps_json'])); // Remove slashes and trim whitespace
    $steps = json_decode($steps_json, true);
    $steps_content = '';
    if (json_last_error() !== JSON_ERROR_NONE) {
        $steps_content .= '<p>Error decoding JSON: ' . esc_html(json_last_error_msg()) . '</p>';
    } else {
        if (is_array($steps)) {
            $index = 01;
            foreach ($steps as $step) {
                if (isset($step['title']) && isset($step['description'])) {
                    $steps_content .= '<!-- wp:uagb/info-box {"classMigrate":true,"tempHeadingDesc":"' . wp_kses_post($step['description']) . '","headingAlign":"left","headingColor":"","subHeadingColor":"","prefixColor":"","headFontSize":20,"headFontSizeMobile":16,"subHeadFontSize":16,"subHeadFontSizeMobile":14,"block_id":"7f75f742","showPrefix":true,"showIcon":false,"btnBorderTopWidth":1,"btnBorderLeftWidth":1,"btnBorderRightWidth":1,"btnBorderBottomWidth":1,"btnBorderTopLeftRadius":0,"btnBorderTopRightRadius":0,"btnBorderBottomLeftRadius":0,"btnBorderBottomRightRadius":0,"btnBorderStyle":"solid","btnBorderColor":"#333"} -->
<div class="wp-block-uagb-info-box uagb-block-7f75f742 uagb-infobox__content-wrap  uagb-infobox-icon-above-title uagb-infobox-image-valign-top"><div class="uagb-ifb-content"><div class="uagb-ifb-title-wrap"><span class="uagb-ifb-title-prefix">0' . $index . '</span><h3 class="uagb-ifb-title">' . esc_html($step['title']) . '</h3></div><p class="uagb-ifb-desc">' . wp_kses_post($step['description']) . '</p></div></div>
<!-- /wp:uagb/info-box -->';
                }
                $index++;
            }
        } else {
            $steps_content .= '<p>Decoded steps is not an array.</p>'; // Debug if not an array
        }
    }
    return '<!-- wp:block {"ref":1935} /-->

<!-- wp:uagb/container {"block_id":"024c4d3f","backgroundType":"image","backgroundImageDesktop":{"id":743,"title":"bg-visa","filename":"bg-visa.png","url":"http://visathing.local/wp-content/uploads/2025/02/bg-visa.png","link":"http://visathing.local/about-us/bg-visa/","alt":"","author":"1","description":"","caption":"","name":"bg-visa","status":"inherit","uploadedTo":720,"date":"2025-02-19T08:51:07.000Z","modified":"2025-02-19T08:51:07.000Z","menuOrder":0,"mime":"image/png","type":"image","subtype":"png","icon":"http://visathing.local/wp-includes/images/media/default.svg","dateFormatted":"February 19, 2025","nonces":{"update":"477bcfe13e","delete":"617d22907a","edit":"7e4333d6ef"},"editLink":"http://visathing.local/wp-admin/post.php?post=743\u0026action=edit","meta":false,"authorName":"Raju Hossain","authorLink":"http://visathing.local/wp-admin/profile.php","uploadedToTitle":"About us","uploadedToLink":"http://visathing.local/wp-admin/post.php?post=720\u0026action=edit","filesizeInBytes":251640,"filesizeHumanReadable":"246 KB","context":"","height":357,"width":1909,"orientation":"landscape","sizes":{"thumbnail":{"height":150,"width":150,"url":"http://visathing.local/wp-content/uploads/2025/02/bg-visa-150x150.png","orientation":"landscape"},"medium":{"height":56,"width":300,"url":"http://visathing.local/wp-content/uploads/2025/02/bg-visa-300x56.png","orientation":"landscape"},"large":{"height":191,"width":1024,"url":"http://visathing.local/wp-content/uploads/2025/02/bg-visa-1024x191.png","orientation":"landscape"},"full":{"url":"http://visathing.local/wp-content/uploads/2025/02/bg-visa.png","height":357,"width":1909,"orientation":"landscape"}},"compat":{"item":"","meta":""}},"topPaddingDesktop":50,"bottomPaddingDesktop":150,"topPaddingMobile":30,"bottomPaddingMobile":130,"leftPaddingMobile":10,"rightPaddingMobile":10,"paddingLink":false,"variationSelected":true,"isBlockRootParent":true,"containerBorderTopLeftRadius":0,"containerBorderTopRightRadius":0,"containerBorderBottomLeftRadius":60,"containerBorderBottomRightRadius":60,"containerBorderRadiusLink":false} -->
<div class="wp-block-uagb-container uagb-block-024c4d3f alignfull uagb-is-root-container"><div class="uagb-container-inner-blocks-wrap"><!-- wp:uagb/icon-list {"block_id":"ce5cee4e","classMigrate":true,"childMigrate":true,"fontTransform":"capitalize","icon_layout":"horizontal","iconColor":"#ffffff","labelColor":"#ffffff"} -->
<div class="wp-block-uagb-icon-list uagb-block-ce5cee4e"><div class="uagb-icon-list__wrap"><!-- wp:uagb/icon-list-child {"block_id":"02a59305","label":"' . $country_name . '","icon":"house","label_color":"","link":"/","disableLink":true} -->
<div class="wp-block-uagb-icon-list-child uagb-block-02a59305"><a target="_self" aria-label="' . $country_name . '" rel="noopener noreferrer" href="/"> </a><span class="uagb-icon-list__source-wrap"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z"></path></svg></span><span class="uagb-icon-list__label">' . $country_name . '</span></div>
<!-- /wp:uagb/icon-list-child -->

<!-- wp:uagb/icon-list-child {"block_id":"82358ad1","label":"' . $country_name . '","icon":"angle-right","label_color":"","link":"/' . $country_name . '/","disableLink":true} -->
<div class="wp-block-uagb-icon-list-child uagb-block-82358ad1"><a target="_self" aria-label="' . $country_name . '" rel="noopener noreferrer" href="/' . $country_name . '/"> </a><span class="uagb-icon-list__source-wrap"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"></path></svg></span><span class="uagb-icon-list__label">' . $country_name . '</span></div>
<!-- /wp:uagb/icon-list-child -->

<!-- wp:uagb/icon-list-child {"block_id":"0d277bdf","label":"Apply","icon":"angle-right","label_color":""} -->
<div class="wp-block-uagb-icon-list-child uagb-block-0d277bdf"><span class="uagb-icon-list__source-wrap"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"></path></svg></span><span class="uagb-icon-list__label">Apply</span></div>
<!-- /wp:uagb/icon-list-child --></div></div>
<!-- /wp:uagb/icon-list -->

<!-- wp:heading {"level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|ast-global-color-5"}}}},"textColor":"ast-global-color-5"} -->
<h1 class="wp-block-heading has-ast-global-color-5-color has-text-color has-link-color">' . $title . '</h1>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"36%"} -->
<div class="wp-block-column" style="flex-basis:36%"><!-- wp:uagb/icon-list {"block_id":"49034ab7","classMigrate":true,"childMigrate":true,"icon_layout":"horizontal","className":"buttons","UAGHideMob":true,"UAGHideTab":true,"UAGResponsiveConditions":true} -->
<div class="wp-block-uagb-icon-list uagb-block-49034ab7 buttons uag-hide-tab uag-hide-mob"><div class="uagb-icon-list__wrap"><!-- wp:uagb/icon-list-child {"block_id":"2ce9caac","label":"Basic Information","icon":"flag","label_color":"","link":"' . $basic_info_url . '","disableLink":true} -->
<div class="wp-block-uagb-icon-list-child uagb-block-2ce9caac"><a target="_self" aria-label="Basic Information" rel="noopener noreferrer" href="' . $basic_info_url . '"> </a><span class="uagb-icon-list__source-wrap"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 496C64 504.8 56.75 512 48 512h-32C7.25 512 0 504.8 0 496V32c0-17.75 14.25-32 32-32s32 14.25 32 32V496zM476.3 0c-6.365 0-13.01 1.35-19.34 4.233c-45.69 20.86-79.56 27.94-107.8 27.94c-59.96 0-94.81-31.86-163.9-31.87C160.9 .3055 131.6 4.867 96 15.75v350.5c32-9.984 59.87-14.1 84.85-14.1c73.63 0 124.9 31.78 198.6 31.78c31.91 0 68.02-5.971 111.1-23.09C504.1 355.9 512 344.4 512 332.1V30.73C512 11.1 495.3 0 476.3 0z"></path></svg></span><span class="uagb-icon-list__label">Basic Information</span></div>
<!-- /wp:uagb/icon-list-child -->

<!-- wp:uagb/icon-list-child {"block_id":"dfb9da18","label":"Embassy Details","image_icon":"image","icon":"house-chimney-window","image":{"uploading":false,"date":1740216602000,"filename":"embassy-1-2.svg","menuOrder":0,"uploadedTo":59,"id":1718,"title":"embassy (1)","url":"http://visathing.local/wp-content/uploads/2025/02/embassy-1-2.svg","link":"http://visathing.local/apply-online/embassy-1-3/","alt":"","author":"1","description":"","caption":"","name":"embassy-1-3","status":"inherit","modified":1740216602000,"mime":"image/svg+xml","type":"image","subtype":"svg+xml","icon":"http://visathing.local/wp-includes/images/media/default.svg","dateFormatted":"February 22, 2025","nonces":{"update":"1193200fc7","delete":"512427ec4d","edit":"765fcfd929"},"editLink":"http://visathing.local/wp-admin/post.php?post=1718\u0026action=edit","meta":false,"authorName":"Raju Hossain","authorLink":"http://visathing.local/wp-admin/profile.php","uploadedToTitle":"apply-online","uploadedToLink":"http://visathing.local/wp-admin/post.php?post=59\u0026action=edit","filesizeInBytes":2183,"filesizeHumanReadable":"2 KB","context":"","sizes":{"full":{"url":"http://visathing.local/wp-content/uploads/2025/02/embassy-1-2.svg"}},"compat":{"item":"","meta":""}},"label_color":"","link":"' . $embassy_details_url . '","disableLink":true,"imgTagHeight":16,"imgTagWidth":24} -->
<div class="wp-block-uagb-icon-list-child uagb-block-dfb9da18"><a target="_self" aria-label="Embassy Details" rel="noopener noreferrer" href="' . $embassy_details_url . '"> </a><span class="uagb-icon-list__source-wrap"><img class="uagb-icon-list__source-image" src="http://visathing.local/wp-content/uploads/2025/02/embassy-1-2.svg" width="16" height="16" loading="lazy" alt=""/></span><span class="uagb-icon-list__label">Embassy Details</span></div>
<!-- /wp:uagb/icon-list-child --></div></div>
<!-- /wp:uagb/icon-list --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"80%"} -->
<div class="wp-block-column" style="flex-basis:80%"><!-- wp:block {"ref":1943} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:uagb/container -->

<!-- wp:uagb/container {"block_id":"f9654ed4","directionDesktop":"row","alignItemsDesktop":"flex-start","bottomPaddingDesktop":50,"leftPaddingDesktop":10,"rightPaddingDesktop":10,"paddingLink":false,"topMarginDesktop":-120,"bottomMarginDesktop":0,"leftMarginDesktop":0,"rightMarginDesktop":0,"marginLink":false,"variationSelected":true,"isBlockRootParent":true} -->
<div class="wp-block-uagb-container uagb-block-f9654ed4 alignfull uagb-is-root-container"><div class="uagb-container-inner-blocks-wrap"><!-- wp:uagb/container {"block_id":"29da02dc","widthDesktop":65,"widthSetByUser":true} -->
<div class="wp-block-uagb-container uagb-block-29da02dc"><!-- wp:block {"ref":1936} /-->

<!-- wp:block {"ref":1938} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}},"border":{"radius":"16px"}},"backgroundColor":"ast-global-color-4","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-ast-global-color-4-background-color has-background" style="border-radius:16px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:heading {"className":"section_title"} -->
<h2 class="wp-block-heading section_title">' . $requirement_title . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . $requirement_description . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"steps","style":{"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"}},"border":{"radius":"16px"}},"backgroundColor":"ast-global-color-4","layout":{"type":"constrained"}} -->
<div class="wp-block-group steps has-ast-global-color-4-background-color has-background" style="border-radius:16px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:buttons {"style":{"typography":{"fontSize":"14px"}},"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons has-custom-font-size" style="font-size:14px"><!-- wp:button {"className":"is-style-outline collapsall","style":{"typography":{"fontSize":"14px"},"border":{"radius":"0px","width":"0px","style":"none"},"spacing":{"padding":{"left":"0px","right":"0px","top":"0px","bottom":"0px"}}}} -->
<div class="wp-block-button has-custom-font-size is-style-outline collapsall" id="toggleAll" style="font-size:14px"><a class="wp-block-button__link wp-element-button" style="border-style:none;border-width:0px;border-radius:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px">Collapse All</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

' . $steps_content . '
</div>
<!-- /wp:group --></div>
<!-- /wp:uagb/container -->

<!-- wp:block {"ref":1937} /--></div></div>
<!-- /wp:uagb/container -->

<!-- wp:block {"ref":1939} /-->';
}

function create_apply_page()
{
    // Handle form submission to create a page
    $page_name = sanitize_text_field($_POST['page_name']);
    $slug = sanitize_title($_POST['slug']);
    $country_name = sanitize_title($_POST['country_name']);
    $title = wp_kses_post($_POST['title']);
    $basic_info_url = esc_url($_POST['basic_info_url']);
    $embassy_details_url = esc_url($_POST['embassy_details_url']);
    $requirement_title = wp_kses_post($_POST['requirement_title']);
    $requirement_description = wp_kses_post($_POST['requirement_description']);
    $steps_json = sanitize_textarea_field($_POST['steps_json']);

    // Create a new WordPress page
    $new_page_id = wp_insert_post(array(
        'post_title' => $page_name,
        'post_content' => apply_page_content($country_name, $title, $basic_info_url, $embassy_details_url, $requirement_title, $requirement_description, $steps_json),
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => $slug,
        'post_parent' => get_page_by_path($country_name)->ID
    ));

    if ($new_page_id) {
        update_post_meta($new_page_id, 'is_apply_page', true);
        update_post_meta($new_page_id, 'country_name', $country_name);
        update_post_meta($new_page_id, 'basic_info_url', $basic_info_url);
        update_post_meta($new_page_id, 'embassy_details_url', $embassy_details_url);
        update_post_meta($new_page_id, 'requirement_title', $requirement_title);
        update_post_meta($new_page_id, 'requirement_description', $requirement_description);
        update_post_meta($new_page_id, 'steps_json', $steps_json);

        echo '<div class="notice notice-success"><p>Page created successfully! <a href="' . esc_url(get_permalink($new_page_id)) . '">View Page</a></p></div>';
    } else {
        echo '<div class="notice notice-error"><p>Failed to create page.</p></div>';
    }
}

function edit_apply_page($page_id)
{
    // Fetch the existing page details
    $page = get_post($page_id);

    if (!$page) {
        echo '<div class="notice notice-error"><p>Page not found.</p></div>';
        return;
    }

    // Process the edit form submission
    if (isset($_POST['visa_update_page'])) {
        update_apply_page($page_id);
    }

    // Display the edit form
?>
    <div class="wrap">
        <h1>Edit Apply Page</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="page_name">Page Name</label></th>
                    <td><input type="text" name="page_name" id="page_name" value="<?php echo esc_attr($page->post_title); ?>" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="slug">Slug</label></th>
                    <td><input type="text" name="slug" id="slug" value="<?php echo esc_attr($page->post_name); ?>" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="country_name">Country Name</label></th>
                    <td><input type="text" name="country_name" id="country_name" value="<?php echo esc_attr($page->country_name); ?>" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="title">Title</label></th>
                    <td><input type="text" name="title" id="title" value="<?php echo esc_html($page->post_title); ?>" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="basic_info_url">Basic Info URL</label></th>
                    <td><input type="url" name="basic_info_url" id="basic_info_url" value="<?php echo esc_url(get_post_meta($page_id, 'basic_info_url', true)); ?>" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="embassy_details_url">Embassy Details URL</label></th>
                    <td><input type="url" name="embassy_details_url" id="embassy_details_url" value="<?php echo esc_url(get_post_meta($page_id, 'embassy_details_url', true)); ?>" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="requirement_title">Requirement Title</label></th>
                    <td><input type="text" name="requirement_title" id="requirement_title" value="<?php echo esc_html(get_post_meta($page_id, 'requirement_title', true)); ?>" required /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="requirement_description">Requirement Description</label></th>
                    <td><textarea name="requirement_description" id="requirement_description" required><?php echo esc_textarea(get_post_meta($page_id, 'requirement_description', true)); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="steps_json">Steps (JSON)</label></th>
                    <td><textarea name="steps_json" id="steps_json" required><?php echo esc_textarea(get_post_meta($page_id, 'steps_json', true)); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button('Update Page', 'primary', 'visa_update_page'); ?>
        </form>
    </div>
<?php
}

function update_apply_page($page_id)
{
    // Handle form submission to update a page
    $page_name = sanitize_text_field($_POST['page_name']);
    $slug = sanitize_title($_POST['slug']);
    $country_name = sanitize_title($_POST['country_name']);
    $title = wp_kses_post($_POST['title']);
    $basic_info_url = esc_url($_POST['basic_info_url']);
    $embassy_details_url = esc_url($_POST['embassy_details_url']);
    $requirement_title = wp_kses_post($_POST['requirement_title']);
    $requirement_description = wp_kses_post($_POST['requirement_description']);
    $steps_json = sanitize_textarea_field($_POST['steps_json']);

    // Update the page
    $updated = wp_update_post(array(
        'ID' => $page_id,
        'post_title' => $page_name,
        'post_name' => $slug,
        'post_content' => apply_page_content($country_name, $title, $basic_info_url, $embassy_details_url, $requirement_title, $requirement_description, $steps_json),
        'post_status' => 'publish',
    ));

    // Update post meta
    if ($updated) {
        update_post_meta($page_id, 'basic_info_url', $basic_info_url);
        update_post_meta($page_id, 'country_name', $country_name);
        update_post_meta($page_id, 'embassy_details_url', $embassy_details_url);
        update_post_meta($page_id, 'requirement_title', $requirement_title);
        update_post_meta($page_id, 'requirement_description', $requirement_description);
        update_post_meta($page_id, 'steps_json', $steps_json);

        echo '<div class="notice notice-success"><p>Page updated successfully! <a href="' . esc_url(get_permalink($page_id)) . '">View Page</a></p></div>';
    } else {
        echo '<div class="notice notice-error"><p>Failed to update page.</p></div>';
    }
}

function delete_apply_page($page_id)
{
    // Delete the page and its related data
    $deleted = wp_delete_post($page_id, true); // true to force delete

    if ($deleted) {
        echo '<div class="notice notice-success"><p>Page deleted successfully.</p></div>';
    } else {
        echo '<div class="notice notice-error"><p>Failed to delete page.</p></div>';
    }
}
function get_application_status_by_entry_id($entry_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'application_status';

    $query = $wpdb->prepare(
        "SELECT * FROM $table_name WHERE entry_id = %d",
        intval($entry_id)
    );

    $result = $wpdb->get_row($query, ARRAY_A);

    return $result;
}

add_action('wp_ajax_fetch_entry_status_details', 'fetch_entry_status_details');
function fetch_entry_status_details()
{
    if (!isset($_POST['entry_id'])) {
        wp_send_json_error(['message' => 'Entry ID is required.']);
    }

    $entry_id = intval($_POST['entry_id']);

    $entry_details = get_application_status_by_entry_id($entry_id);

    if ($entry_details) {
        wp_send_json_success(['details' => $entry_details]);
    } else {
        wp_send_json_error(['message' => 'No details found for the provided Entry ID.']);
    }
}
