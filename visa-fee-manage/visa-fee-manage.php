<?php
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
        echo '<a href="/' . strtolower(esc_attr($fee->country)) . '/apply-online/">';
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


function tracking_id_shortcode()
{
    if (isset($_POST['tracking_id'])) {
        $tracking_id = sanitize_text_field($_POST['tracking_id']);
        return '<p style="font-size:14px;text-align:center;">Your Tracking ID: ' . esc_html($tracking_id) . '</p>';
    } else {
        return '<p style="font-size:14px;text-align:center;">No Tracking ID provided.</p>';
    }
}
add_shortcode('display_tracking_id', 'tracking_id_shortcode');
