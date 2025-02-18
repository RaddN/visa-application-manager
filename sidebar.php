<style>
    ul.ant-pagination.css-1588u1j {
        display: flex;
    }

    @media (max-width: 768px) {
        .sidebar {
            top: 50px !important;
            left: -250px !important;
            /* Hidden off-screen */
            width: 250px !important;
            height: 100% !important;
            background: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
            transition: right 0.3s ease;
            z-index: 1000 !important;
        }

        .sidebar.active {
            left: 0 !important;
            /* Show the sidebar */
        }

        .applied_visa_card {
            overflow: auto;
        }

        .my_family .family_member_add_card {
            min-width: 100%;
        }

        main.ant-layout-content {
            margin-top: 33px !important;
        }

        .ast-container {
            padding: 0;
        }

        p {
            margin: 0 !important;
        }

        .ant-steps.ant-steps-horizontal {
            flex-direction: column !important;
        }

        .ant-steps-item-container {
            display: flex;
        }

        .ant-steps-item-icon {
            margin-inline-start: 0 !important;
        }

        .ant-steps-item-tail {
            margin-inline: 3px !important;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-tail::after,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-tail::after {
            width: 2px;
            height: 32px;
            margin: 0 !important;
        }

        .ant-steps-item-title {
            font-size: 14px !important;
            margin-top: -16px;
            margin-bottom: 24px;
        }

        .ant-steps-item-content {
            width: 100% !important;
            text-align: left !important;
        }

        ul.ant-menu.ant-menu-root.ant-menu-inline.ant-menu-light.sidebar_menu.css-1588u1j {
            padding: 0;
        }

    }
</style>
<?php $user_id_in_url = isset($_GET['user_id']) ? intval($_GET['user_id']) : ''; 
      $url_with_user_id = $user_id_in_url ? '?user_id=' . $user_id_in_url : '';
?>
<aside id="rsidebar" class="sidebar ant-layout-sider ant-layout-sider-light ant-layout-sider-has-trigger sidebar_menu_wrapper"
    style="box-shadow: rgba(8, 21, 66, 0.05) 0px 10px 20px; border-right: 1px solid rgb(236, 243, 250); overflow: auto; height: 100vh; position: fixed; top: 100px; padding: 0px 10px; left: 0px; z-index: 9; background: rgb(243, 243, 252); flex: 0 0 200px; max-width: 240px; min-width: 240px; width: 240px;">
    <div class="ant-layout-sider-children">
        <ul class="ant-menu ant-menu-root ant-menu-inline ant-menu-light sidebar_menu css-1588u1j"
            role="menu" tabindex="0" data-menu-list="true"
            style="background: rgb(243, 243, 252); color: rgb(115, 116, 140); border-right: 0px;">
            <li class="ant-menu-item" role="menuitem" tabindex="-1"
                data-menu-id="rc-menu-uuid-94723-1-/user/" style="padding-left: 24px;"><svg
                    stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                    class="ant-menu-item-icon" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">
                    </path>
                </svg><span class="ant-menu-title-content"><a class="inline-block custom_link"
                        href="/user/<?php echo $url_with_user_id;?>">Overview</a></span></li>
            <li class="ant-menu-item" role="menuitem" tabindex="-1"
                data-menu-id="rc-menu-uuid-94723-1-/user/profile/" style="padding-left: 24px;"><svg
                    stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
                    class="ant-menu-item-icon" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M858.5 763.6a374 374 0 0 0-80.6-119.5 375.63 375.63 0 0 0-119.5-80.6c-.4-.2-.8-.3-1.2-.5C719.5 518 760 444.7 760 362c0-137-111-248-248-248S264 225 264 362c0 82.7 40.5 156 102.8 201.1-.4.2-.8.3-1.2.5-44.8 18.9-85 46-119.5 80.6a375.63 375.63 0 0 0-80.6 119.5A371.7 371.7 0 0 0 136 901.8a8 8 0 0 0 8 8.2h60c4.4 0 7.9-3.5 8-7.8 2-77.2 33-149.5 87.8-204.3 56.7-56.7 132-87.9 212.2-87.9s155.5 31.2 212.2 87.9C779 752.7 810 825 812 902.2c.1 4.4 3.6 7.8 8 7.8h60a8 8 0 0 0 8-8.2c-1-47.8-10.9-94.3-29.5-138.2zM512 534c-45.9 0-89.1-17.9-121.6-50.4S340 407.9 340 362c0-45.9 17.9-89.1 50.4-121.6S466.1 190 512 190s89.1 17.9 121.6 50.4S684 316.1 684 362c0 45.9-17.9 89.1-50.4 121.6S557.9 534 512 534z">
                    </path>
                </svg><span class="ant-menu-title-content"><a class="inline-block custom_link"
                        href="/user/profile/<?php echo $url_with_user_id;?>">My Profile</a></span></li>
            <li class="ant-menu-item" role="menuitem" tabindex="-1"
                data-menu-id="rc-menu-uuid-94723-1-/user/applied-visa/" style="padding-left: 24px;"><svg
                    stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                    class="ant-menu-item-icon" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 2C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20ZM19 4H5V20H19V4ZM16 16V18H8V16H16ZM12 6C14.2091 6 16 7.79086 16 10C16 12.2091 14.2091 14 12 14C9.79086 14 8 12.2091 8 10C8 7.79086 9.79086 6 12 6ZM12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8Z">
                    </path>
                </svg><span class="ant-menu-title-content"><a class="inline-block custom_link"
                        href="/user/applied-visa/<?php echo $url_with_user_id;?>">My Applied Visa</a></span></li>
            <li class="ant-menu-item" role="menuitem" tabindex="-1"
                data-menu-id="rc-menu-uuid-94723-1-/user/transactions/" style="padding-left: 24px;"><svg
                    stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                    class="ant-menu-item-icon" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 12h2v4h-2z"></path><button type="button" class="ant-btn css-1588u1j ant-btn-default rounded" style="padding: 0px;"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="text-[24px]" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                                                <path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z"></path>
                                                                                            </svg></button>
                    <path
                        d="M20 7V5c0-1.103-.897-2-2-2H5C3.346 3 2 4.346 2 6v12c0 2.201 1.794 3 3 3h15c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zM5 5h13v2H5a1.001 1.001 0 0 1 0-2zm15 14H5.012C4.55 18.988 4 18.805 4 18V8.815c.314.113.647.185 1 .185h15v10z">
                    </path>
                </svg><span class="ant-menu-title-content"><a class="inline-block custom_link"
                        href="/user/transactions/<?php echo $url_with_user_id;?>">My Transactions</a></span></li>
            <li class="ant-menu-item" role="menuitem" tabindex="-1"
                data-menu-id="rc-menu-uuid-94723-1-/user/co-travelers/" style="padding-left: 24px;"><svg
                    stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round" class="ant-menu-item-icon"
                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg><span class="ant-menu-title-content"><a class="inline-block custom_link"
                        href="/user/co-travelers/<?php echo $url_with_user_id;?>">My Co-Travelers</a></span></li>
            <li class="ant-menu-item" role="menuitem" tabindex="-1"
                data-menu-id="rc-menu-uuid-94723-1-/user/documents/" style="padding-left: 24px;"><svg
                    stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24"
                    class="ant-menu-item-icon" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 18H17V16H7V18Z" fill="currentColor"></path>
                    <path d="M17 14H7V12H17V14Z" fill="currentColor"></path>
                    <path d="M7 10H11V8H7V10Z" fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6 2C4.34315 2 3 3.34315 3 5V19C3 20.6569 4.34315 22 6 22H18C19.6569 22 21 20.6569 21 19V9C21 5.13401 17.866 2 14 2H6ZM6 4H13V9H19V19C19 19.5523 18.5523 20 18 20H6C5.44772 20 5 19.5523 5 19V5C5 4.44772 5.44772 4 6 4ZM15 4.10002C16.6113 4.4271 17.9413 5.52906 18.584 7H15V4.10002Z"
                        fill="currentColor"></path>
                </svg><span class="ant-menu-title-content"><a class="inline-block custom_link"
                        href="/user/documents/<?php echo $url_with_user_id;?>">My Documents</a></span></li>
            <li class="ant-menu-item" role="menuitem" tabindex="-1"
                data-menu-id="rc-menu-uuid-94723-1-/user/appointment/" style="padding-left: 24px;"><svg
                    stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                    class="ant-menu-item-icon" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z">
                    </path>
                    <path
                        d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z">
                    </path>
                </svg><span class="ant-menu-title-content"><a class="inline-block custom_link"
                        href="/user/appointment/<?php echo $url_with_user_id;?>">My Appointment</a></span></li>
            <li class="ant-menu-item" role="menuitem" tabindex="-1"
                data-menu-id="rc-menu-uuid-94723-1-/user/checklist/" style="padding-left: 24px;"><svg
                    stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24"
                    class="ant-menu-item-icon" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M20 4H4C3.44771 4 3 4.44772 3 5V19C3 19.5523 3.44772 20 4 20H20C20.5523 20 21 19.5523 21 19V5C21 4.44771 20.5523 4 20 4ZM4 2C2.34315 2 1 3.34315 1 5V19C1 20.6569 2.34315 22 4 22H20C21.6569 22 23 20.6569 23 19V5C23 3.34315 21.6569 2 20 2H4ZM6 7H8V9H6V7ZM11 7C10.4477 7 10 7.44772 10 8C10 8.55228 10.4477 9 11 9H17C17.5523 9 18 8.55228 18 8C18 7.44772 17.5523 7 17 7H11ZM8 11H6V13H8V11ZM10 12C10 11.4477 10.4477 11 11 11H17C17.5523 11 18 11.4477 18 12C18 12.5523 17.5523 13 17 13H11C10.4477 13 10 12.5523 10 12ZM8 15H6V17H8V15ZM10 16C10 15.4477 10.4477 15 11 15H17C17.5523 15 18 15.4477 18 16C18 16.5523 17.5523 17 17 17H11C10.4477 17 10 16.5523 10 16Z"
                        fill="currentColor"></path>
                </svg><span class="ant-menu-title-content"><a class="inline-block custom_link"
                        href="/user/checklist/<?php echo $url_with_user_id;?>">My Checklist</a></span></li>
        </ul>
        <div aria-hidden="true" style="display: none;"></div>
        <div class="user_menu">
            <div class="avatar">
                <?php
                if (is_user_logged_in()) {
                    $current_user = wp_get_current_user();
                    
                    // Get the user's custom profile image URL from user meta (assuming it's stored under 'profile_image')
                    $profile_image_url = get_user_meta($user_id_in_url!==''? $user_id_in_url : $current_user->ID, 'profile_image', true);
                    
                    // Check if the user has a custom profile image
                    if ($profile_image_url) {
                        // If the user has a custom profile image, display it
                        echo '<img src="' . esc_url($profile_image_url) . '" alt="User Avatar" class="user-avatar" width="96" height="96">';
                    } else {
                        // If no custom image, display the default avatar
                        echo get_avatar($user_id_in_url!==''? $user_id_in_url : $current_user->ID, 96); // Default Gravatar fallback
                    }
                } else {
                    echo '<img src="https://secure.gravatar.com/avatar/729ae85bf62b9917e93538db2f2688ca?s=96&d=mm&r=g" alt="Default Avatar" width="96" height="96" />'; // Optional default avatar
                }
                ?>
            </div>
            <div class="info">
                <p class="name"><?php
                                if (is_user_logged_in()) {
                                    // Display first name and last name
                                    echo esc_html(get_user_meta($user_id_in_url!==''? $user_id_in_url : $current_user->ID, 'first_name', true) . ' ' . get_user_meta($user_id_in_url!==''? $user_id_in_url : $current_user->ID, 'last_name', true));
                                } else {
                                    echo 'Guest User';
                                }
                                ?></p>
                <a href="mailto:<?php
                                if (is_user_logged_in()) {
                                    echo esc_html($current_user->user_email);
                                } else {
                                    echo 'guest@example.com'; // Optional default email
                                }
                                ?>" class="mail break-all">
                    <?php
                    if (is_user_logged_in()) {
                        echo esc_html($current_user->user_email);
                    } else {
                        echo 'guest@example.com'; // Optional default email
                    }
                    ?>
                </a>
            </div>
            <div class="action"><a class="inline-block custom_link" href="/user/setting/">
                    <div class="action_btn "><svg stroke="currentColor" fill="currentColor"
                            stroke-width="0" viewBox="0 0 512 512" height="24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M416.3 256c0-21 13.1-38.9 31.7-46.1-4.9-20.5-13-39.7-23.7-57.1-6.4 2.8-13.2 4.3-20.1 4.3-12.6 0-25.2-4.8-34.9-14.4-14.9-14.9-18.2-36.8-10.2-55-17.3-10.7-36.6-18.8-57-23.7C295 82.5 277 95.7 256 95.7S217 82.5 209.9 64c-20.5 4.9-39.7 13-57.1 23.7 8.1 18.1 4.7 40.1-10.2 55-9.6 9.6-22.3 14.4-34.9 14.4-6.9 0-13.7-1.4-20.1-4.3C77 170.3 68.9 189.5 64 210c18.5 7.1 31.7 25 31.7 46.1 0 21-13.1 38.9-31.6 46.1 4.9 20.5 13 39.7 23.7 57.1 6.4-2.8 13.2-4.2 20-4.2 12.6 0 25.2 4.8 34.9 14.4 14.8 14.8 18.2 36.8 10.2 54.9 17.4 10.7 36.7 18.8 57.1 23.7 7.1-18.5 25-31.6 46-31.6s38.9 13.1 46 31.6c20.5-4.9 39.7-13 57.1-23.7-8-18.1-4.6-40 10.2-54.9 9.6-9.6 22.2-14.4 34.9-14.4 6.8 0 13.7 1.4 20 4.2 10.7-17.4 18.8-36.7 23.7-57.1-18.4-7.2-31.6-25.1-31.6-46.2zm-159.4 79.9c-44.3 0-80-35.9-80-80s35.7-80 80-80 80 35.9 80 80-35.7 80-80 80z">
                            </path>
                        </svg></div>
                </a>
                <div class="action_btn logout"><a href="<?php echo wp_logout_url(); ?>" class="logout-button"><svg stroke="currentColor" fill="none" stroke-width="2"
                            viewBox="0 0 24 24" aria-hidden="true" height="24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg></a></div>
            </div>
        </div>
    </div>
    <div class="ant-layout-sider-trigger" style="width: 240px;"><span role="img" aria-label="left"
            class="anticon anticon-left"><svg viewBox="64 64 896 896" focusable="false" data-icon="left"
                width="1em" height="1em" fill="currentColor" aria-hidden="true">
                <path
                    d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                </path>
            </svg></span></div>
</aside>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const currentPath = window.location.pathname + window.location.search;
        console.log(currentPath);

        // Select all menu items
        const menuItems = document.querySelectorAll('.ant-menu-item');

        // Loop through each menu item
        menuItems.forEach(item => {
            // Get the anchor tag within the menu item
            const link = item.querySelector('a.custom_link');

            // Check if the link's href matches the current path
            if (link && link.getAttribute('href') === currentPath) {
                // Add the selected class to the current menu item
                item.classList.add('ant-menu-item-selected');
            }
        });
    });
</script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('rsidebar');
        sidebar.classList.toggle('active'); // Toggle the active class
    }
</script>