<header class="ant-layout-header md:!h-[100px] css-1588u1j"
    style="position:fixed;width:100%;background:#F3F3FC;padding:0;display:flex;align-items:center;justify-content:space-between;z-index:8;right:0;top:0;box-shadow:0 0 20px #0815420d;border-bottom:1px solid #ecf3fa">
    <div class="main_navigation flex items-center border-b px-3 md:h-[100px]"
        style="background:#F3F3FC">
        <div class="nav flex w-full justify-between">
            <div class="nav_brand"><a class="inline-block custom_link" href="/"><img
                        alt="Visathing Logo" fetchpriority="high" width="180" height="0"
                        decoding="async" data-nimg="1" class="logo" style="color:transparent"
                        src="https://visathing.com/images/logo.svg"></a>
                <div class="user_greetings hidden md:block">
                    <h2>Hi, <?php
                            if (is_user_logged_in()) {
                                $current_user = wp_get_current_user();
                                // Display first name and last name
                                echo esc_html($current_user->first_name . ' ' . $current_user->last_name);
                            } else {
                                echo 'Guest User';
                            }
                            ?></h2>
                    <p>Welcome back to the VISAThing Dashboard User</p>
                </div>
            </div>
            <?php if (wp_is_mobile()) : ?>
                <button type="button" class="ant-btn css-1588u1j ant-btn-default ant-btn-icon-only menu_btn" onclick="toggleSidebar()">
                    <span class="ant-btn-icon">
                        <span class="inline-block transition-transform duration-500">
                            <svg stroke="currentColor" fill="none" stroke-width="0" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 18.0048C22 18.5544 21.5544 19 21.0048 19H12.9952C12.4456 19 12 18.5544 12 18.0048C12 17.4552 12.4456 17.0096 12.9952 17.0096H21.0048C21.5544 17.0096 22 17.4552 22 18.0048Z" fill="currentColor"></path>
                                <path d="M22 12.0002C22 12.5499 21.5544 12.9954 21.0048 12.9954H2.99519C2.44556 12.9954 2 12.5499 2 12.0002C2 11.4506 2.44556 11.0051 2.99519 11.0051H21.0048C21.5544 11.0051 22 11.4506 22 12.0002Z" fill="currentColor"></path>
                                <path d="M21.0048 6.99039C21.5544 6.99039 22 6.54482 22 5.99519C22 5.44556 21.5544 5 21.0048 5H8.99519C8.44556 5 8 5.44556 8 5.99519C8 6.54482 8.44556 6.99039 8.99519 6.99039H21.0048Z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </span>
                </button>
            <?php endif; ?>
        </div>
    </div>
</header>