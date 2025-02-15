<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Create a shortcode to display user appointments
function ua_display_user_appointments_shortcode() {
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        return '<p>You need to be logged in to view your appointments.</p>';
    }

    $current_user = wp_get_current_user();
    
    // Fetch appointments for the current user
    // This is a placeholder for your actual logic to retrieve appointments
    // You might need to replace this with a database query or API call
    $appointments = get_user_meta($current_user->ID, 'user_appointments', true);



    ob_start(); ?>
    <?php include 'head.php'; ?>
<body>
    <div id="__next">
        <main role="main" id="__main" class="__variable_c389b4 font-noto-sans">
            <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="1y6sfhs" data-token-hash="54mug8">:where(.css-1588u1j).ant-pagination{font-family:var(--font-noto-sans);font-size:14px;box-sizing:border-box;}:where(.css-1588u1j).ant-pagination::before,:where(.css-1588u1j).ant-pagination::after{box-sizing:border-box;}:where(.css-1588u1j).ant-pagination [class^="ant-pagination"],:where(.css-1588u1j).ant-pagination [class*=" ant-pagination"]{box-sizing:border-box;}:where(.css-1588u1j).ant-pagination [class^="ant-pagination"]::before,:where(.css-1588u1j).ant-pagination [class*=" ant-pagination"]::before,:where(.css-1588u1j).ant-pagination [class^="ant-pagination"]::after,:where(.css-1588u1j).ant-pagination [class*=" ant-pagination"]::after{box-sizing:border-box;}:where(.css-1588u1j).ant-pagination{box-sizing:border-box;margin:0;padding:0;color:rgba(0, 0, 0, 0.88);font-size:14px;line-height:1.5714285714285714;list-style:none;font-family:var(--font-noto-sans);display:flex;}:where(.css-1588u1j).ant-pagination-start{justify-content:start;}:where(.css-1588u1j).ant-pagination-center{justify-content:center;}:where(.css-1588u1j).ant-pagination-end{justify-content:end;}:where(.css-1588u1j).ant-pagination ul,:where(.css-1588u1j).ant-pagination ol{margin:0;padding:0;list-style:none;}:where(.css-1588u1j).ant-pagination::after{display:block;clear:both;height:0;overflow:hidden;visibility:hidden;content:"";}:where(.css-1588u1j).ant-pagination .ant-pagination-total-text{display:inline-block;height:32px;margin-inline-end:8px;line-height:30px;vertical-align:middle;}:where(.css-1588u1j).ant-pagination .ant-pagination-item{display:inline-block;min-width:32px;height:32px;margin-inline-end:8px;font-family:var(--font-noto-sans);line-height:30px;text-align:center;vertical-align:middle;list-style:none;background-color:#ffffff;border:1px solid transparent;border-radius:6px;outline:0;cursor:pointer;user-select:none;}:where(.css-1588u1j).ant-pagination .ant-pagination-item a{display:block;padding:0 6px;color:rgba(0, 0, 0, 0.88);}:where(.css-1588u1j).ant-pagination .ant-pagination-item a:hover{text-decoration:none;}:where(.css-1588u1j).ant-pagination .ant-pagination-item:not(.ant-pagination-item-active):hover{transition:all 0.2s;background-color:rgba(0, 0, 0, 0.06);}:where(.css-1588u1j).ant-pagination .ant-pagination-item:not(.ant-pagination-item-active):active{background-color:rgba(0, 0, 0, 0.15);}:where(.css-1588u1j).ant-pagination .ant-pagination-item-active{font-weight:600;background-color:#ffffff;border-color:#2f3268;}:where(.css-1588u1j).ant-pagination .ant-pagination-item-active a{color:#2f3268;}:where(.css-1588u1j).ant-pagination .ant-pagination-item-active:hover{border-color:#484b75;}:where(.css-1588u1j).ant-pagination .ant-pagination-item-active:hover a{color:#484b75;}:where(.css-1588u1j).ant-pagination .ant-pagination-jump-prev,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-next{outline:0;}:where(.css-1588u1j).ant-pagination .ant-pagination-jump-prev .ant-pagination-item-container,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-next .ant-pagination-item-container{position:relative;}:where(.css-1588u1j).ant-pagination .ant-pagination-jump-prev .ant-pagination-item-container .ant-pagination-item-link-icon,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-next .ant-pagination-item-container .ant-pagination-item-link-icon{color:#2f3268;font-size:12px;opacity:0;transition:all 0.2s;}:where(.css-1588u1j).ant-pagination .ant-pagination-jump-prev .ant-pagination-item-container .ant-pagination-item-link-icon-svg,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-next .ant-pagination-item-container .ant-pagination-item-link-icon-svg{top:0;inset-inline-end:0;bottom:0;inset-inline-start:0;margin:auto;}:where(.css-1588u1j).ant-pagination .ant-pagination-jump-prev .ant-pagination-item-container .ant-pagination-item-ellipsis,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-next .ant-pagination-item-container .ant-pagination-item-ellipsis{position:absolute;top:0;inset-inline-end:0;bottom:0;inset-inline-start:0;display:block;margin:auto;color:rgba(0, 0, 0, 0.25);font-family:Arial,Helvetica,sans-serif;letter-spacing:2px;text-align:center;text-indent:0.13em;opacity:1;transition:all 0.2s;}:where(.css-1588u1j).ant-pagination .ant-pagination-jump-prev:hover .ant-pagination-item-link-icon,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-next:hover .ant-pagination-item-link-icon{opacity:1;}:where(.css-1588u1j).ant-pagination .ant-pagination-jump-prev:hover .ant-pagination-item-ellipsis,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-next:hover .ant-pagination-item-ellipsis{opacity:0;}:where(.css-1588u1j).ant-pagination .ant-pagination-prev,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-prev,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-next{margin-inline-end:8px;}:where(.css-1588u1j).ant-pagination .ant-pagination-prev,:where(.css-1588u1j).ant-pagination .ant-pagination-next,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-prev,:where(.css-1588u1j).ant-pagination .ant-pagination-jump-next{display:inline-block;min-width:32px;height:32px;color:rgba(0, 0, 0, 0.88);font-family:var(--font-noto-sans);line-height:32px;text-align:center;vertical-align:middle;list-style:none;border-radius:6px;cursor:pointer;transition:all 0.2s;}:where(.css-1588u1j).ant-pagination .ant-pagination-prev,:where(.css-1588u1j).ant-pagination .ant-pagination-next{font-family:Arial,Helvetica,sans-serif;outline:0;}:where(.css-1588u1j).ant-pagination .ant-pagination-prev button,:where(.css-1588u1j).ant-pagination .ant-pagination-next button{color:rgba(0, 0, 0, 0.88);cursor:pointer;user-select:none;}:where(.css-1588u1j).ant-pagination .ant-pagination-prev .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination .ant-pagination-next .ant-pagination-item-link{display:block;width:100%;height:100%;padding:0;font-size:12px;text-align:center;background-color:transparent;border:1px solid transparent;border-radius:6px;outline:none;transition:all 0.2s;}:where(.css-1588u1j).ant-pagination .ant-pagination-prev:hover .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination .ant-pagination-next:hover .ant-pagination-item-link{background-color:rgba(0, 0, 0, 0.06);}:where(.css-1588u1j).ant-pagination .ant-pagination-prev:active .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination .ant-pagination-next:active .ant-pagination-item-link{background-color:rgba(0, 0, 0, 0.15);}:where(.css-1588u1j).ant-pagination .ant-pagination-prev.ant-pagination-disabled:hover .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination .ant-pagination-next.ant-pagination-disabled:hover .ant-pagination-item-link{background-color:transparent;}:where(.css-1588u1j).ant-pagination .ant-pagination-slash{margin-inline-end:12px;margin-inline-start:12px;}:where(.css-1588u1j).ant-pagination .ant-pagination-options{display:inline-block;margin-inline-start:16px;vertical-align:middle;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-size-changer{display:inline-block;width:auto;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-size-changer .ant-select-arrow:not(:last-child){opacity:1;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper{display:inline-block;height:32px;margin-inline-start:8px;line-height:32px;vertical-align:top;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input{position:relative;display:inline-block;width:50px;min-width:0;padding:4px 11px;color:rgba(0, 0, 0, 0.88);font-size:14px;line-height:1.5714285714285714;border-radius:6px;transition:all 0.2s;background:#ffffff;border-width:1px;border-style:solid;border-color:#d9d9d9;height:32px;box-sizing:border-box;margin:0;margin-inline-start:8px;margin-inline-end:8px;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input::-moz-placeholder{opacity:1;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input::placeholder{color:rgba(0, 0, 0, 0.25);user-select:none;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input:placeholder-shown{text-overflow:ellipsis;}textarea:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input{max-width:100%;height:auto;min-height:32px;line-height:1.5714285714285714;vertical-align:bottom;transition:all 0.3s,height 0s;resize:vertical;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input-lg{padding:7px 11px;font-size:16px;line-height:1.5;border-radius:8px;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input-sm{padding:0px 7px;font-size:14px;border-radius:4px;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input-rtl,:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input-textarea-rtl{direction:rtl;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input:hover{border-color:#484b75;background-color:#ffffff;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input:focus,:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input:focus-within{border-color:#2f3268;box-shadow:0 0 0 2px transparent;outline:0;background-color:#ffffff;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input[disabled]{color:rgba(0, 0, 0, 0.25);background-color:rgba(0, 0, 0, 0.04);border-color:#d9d9d9;box-shadow:none;cursor:not-allowed;opacity:1;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input[disabled] input[disabled],:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input[disabled] textarea[disabled]{cursor:not-allowed;}:where(.css-1588u1j).ant-pagination .ant-pagination-options-quick-jumper input[disabled]:hover:not([disabled]){border-color:#d9d9d9;background-color:rgba(0, 0, 0, 0.04);}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-prev,:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-next{height:24px;line-height:24px;vertical-align:top;}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-prev .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-next .ant-pagination-item-link{height:24px;background-color:transparent;border:0;}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-prev .ant-pagination-item-link:hover,:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-next .ant-pagination-item-link:hover{background-color:rgba(0, 0, 0, 0.06);}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-prev .ant-pagination-item-link:active,:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-next .ant-pagination-item-link:active{background-color:rgba(0, 0, 0, 0.15);}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-prev .ant-pagination-item-link::after,:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-next .ant-pagination-item-link::after{height:24px;line-height:24px;}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-simple-pager{display:inline-block;height:24px;margin-inline-end:8px;}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-simple-pager input{box-sizing:border-box;height:100%;padding:0 6px;text-align:center;background-color:#ffffff;border:1px solid #d9d9d9;border-radius:6px;outline:none;transition:border-color 0.2s;color:inherit;}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-simple-pager input:hover{border-color:#2f3268;}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-simple-pager input:focus{border-color:#484b75;box-shadow:0px 0 2px transparent;}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-simple-pager input[disabled]{color:rgba(0, 0, 0, 0.25);background-color:rgba(0, 0, 0, 0.04);border-color:#d9d9d9;cursor:not-allowed;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-total-text,:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-simple-pager{height:24px;line-height:24px;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-item{min-width:24px;height:24px;margin:0;line-height:22px;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini:not(.ant-pagination-disabled) .ant-pagination-item:not(.ant-pagination-item-active){background-color:transparent;border-color:transparent;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini:not(.ant-pagination-disabled) .ant-pagination-item:not(.ant-pagination-item-active):hover{background-color:rgba(0, 0, 0, 0.06);}:where(.css-1588u1j).ant-pagination.ant-pagination-mini:not(.ant-pagination-disabled) .ant-pagination-item:not(.ant-pagination-item-active):active{background-color:rgba(0, 0, 0, 0.15);}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-prev,:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-next{min-width:24px;height:24px;margin:0;line-height:24px;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini:not(.ant-pagination-disabled) .ant-pagination-prev:hover .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination.ant-pagination-mini:not(.ant-pagination-disabled) .ant-pagination-next:hover .ant-pagination-item-link{background-color:rgba(0, 0, 0, 0.06);}:where(.css-1588u1j).ant-pagination.ant-pagination-mini:not(.ant-pagination-disabled) .ant-pagination-prev:active .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination.ant-pagination-mini:not(.ant-pagination-disabled) .ant-pagination-next:active .ant-pagination-item-link{background-color:rgba(0, 0, 0, 0.15);}:where(.css-1588u1j).ant-pagination.ant-pagination-mini:not(.ant-pagination-disabled) .ant-pagination-prev.ant-pagination-disabled:hover .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination.ant-pagination-mini:not(.ant-pagination-disabled) .ant-pagination-next.ant-pagination-disabled:hover .ant-pagination-item-link{background-color:transparent;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-prev .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-next .ant-pagination-item-link{background-color:transparent;border-color:transparent;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-prev .ant-pagination-item-link::after,:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-next .ant-pagination-item-link::after{height:24px;line-height:24px;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-jump-prev,:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-jump-next{height:24px;margin-inline-end:0;line-height:24px;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-options{margin-inline-start:2px;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-options-size-changer{top:0;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-options-quick-jumper{height:24px;line-height:24px;}:where(.css-1588u1j).ant-pagination.ant-pagination-mini .ant-pagination-options-quick-jumper input{padding:0px 7px;font-size:14px;border-radius:4px;width:44px;height:24px;}:where(.css-1588u1j).ant-pagination .ant-pagination-disabled,:where(.css-1588u1j).ant-pagination .ant-pagination-disabled:hover{cursor:not-allowed;}:where(.css-1588u1j).ant-pagination .ant-pagination-disabled .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination .ant-pagination-disabled:hover .ant-pagination-item-link{color:rgba(0, 0, 0, 0.25);cursor:not-allowed;}:where(.css-1588u1j).ant-pagination .ant-pagination-disabled:focus-visible{cursor:not-allowed;}:where(.css-1588u1j).ant-pagination .ant-pagination-disabled:focus-visible .ant-pagination-item-link{color:rgba(0, 0, 0, 0.25);cursor:not-allowed;}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled{cursor:not-allowed;}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item{cursor:not-allowed;}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item:hover,:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item:active{background-color:transparent;}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item a{color:rgba(0, 0, 0, 0.25);background-color:transparent;border:none;cursor:not-allowed;}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-active{border-color:#d9d9d9;background-color:rgba(0, 0, 0, 0.15);}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-active:hover,:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-active:active{background-color:rgba(0, 0, 0, 0.15);}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-active a{color:rgba(0, 0, 0, 0.25);}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-link{color:rgba(0, 0, 0, 0.25);cursor:not-allowed;}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-link:hover,:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-link:active{background-color:transparent;}.ant-pagination-simple:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-link{background-color:transparent;}.ant-pagination-simple:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-link:hover,.ant-pagination-simple:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-item-link:active{background-color:transparent;}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-simple-pager{color:rgba(0, 0, 0, 0.25);}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-jump-prev .ant-pagination-item-link-icon,:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-jump-next .ant-pagination-item-link-icon{opacity:0;}:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-jump-prev .ant-pagination-item-ellipsis,:where(.css-1588u1j).ant-pagination.ant-pagination-disabled .ant-pagination-jump-next .ant-pagination-item-ellipsis{opacity:1;}:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-prev.ant-pagination-disabled .ant-pagination-item-link:hover,:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-next.ant-pagination-disabled .ant-pagination-item-link:hover,:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-prev.ant-pagination-disabled .ant-pagination-item-link:active,:where(.css-1588u1j).ant-pagination.ant-pagination-simple .ant-pagination-next.ant-pagination-disabled .ant-pagination-item-link:active{background-color:transparent;}@media only screen and (max-width: 992px){:where(.css-1588u1j).ant-pagination .ant-pagination-item-after-jump-prev,:where(.css-1588u1j).ant-pagination .ant-pagination-item-before-jump-next{display:none;}}@media only screen and (max-width: 576px){:where(.css-1588u1j).ant-pagination .ant-pagination-options{display:none;}}:where(.css-1588u1j).ant-pagination-rtl{direction:rtl;}:where(.css-1588u1j).ant-pagination:not(.ant-pagination-disabled) .ant-pagination-item:focus-visible{outline:4px solid #85868f;outline-offset:1px;transition:outline-offset 0s,outline 0s;}:where(.css-1588u1j).ant-pagination:not(.ant-pagination-disabled) .ant-pagination-jump-prev:focus-visible,:where(.css-1588u1j).ant-pagination:not(.ant-pagination-disabled) .ant-pagination-jump-next:focus-visible{outline:4px solid #85868f;outline-offset:1px;transition:outline-offset 0s,outline 0s;}:where(.css-1588u1j).ant-pagination:not(.ant-pagination-disabled) .ant-pagination-jump-prev:focus-visible .ant-pagination-item-link-icon,:where(.css-1588u1j).ant-pagination:not(.ant-pagination-disabled) .ant-pagination-jump-next:focus-visible .ant-pagination-item-link-icon{opacity:1;}:where(.css-1588u1j).ant-pagination:not(.ant-pagination-disabled) .ant-pagination-jump-prev:focus-visible .ant-pagination-item-ellipsis,:where(.css-1588u1j).ant-pagination:not(.ant-pagination-disabled) .ant-pagination-jump-next:focus-visible .ant-pagination-item-ellipsis{opacity:0;}:where(.css-1588u1j).ant-pagination:not(.ant-pagination-disabled) .ant-pagination-prev:focus-visible .ant-pagination-item-link,:where(.css-1588u1j).ant-pagination:not(.ant-pagination-disabled) .ant-pagination-next:focus-visible .ant-pagination-item-link{outline:4px solid #85868f;outline-offset:1px;transition:outline-offset 0s,outline 0s;}</style>
            <style>
                #nprogress {
                    pointer-events: none;
                }

                #nprogress .bar {
                    background: #2a2e6a;
                    position: fixed;
                    z-index: 9999;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 3px;
                }

                #nprogress .peg {
                    display: block;
                    position: absolute;
                    right: 0px;
                    width: 100px;
                    height: 100%;
                    box-shadow: 0 0 10px #2a2e6a, 0 0 5px #2a2e6a;
                    opacity: 1;
                    -webkit-transform: rotate(3deg) translate(0px, -4px);
                    -ms-transform: rotate(3deg) translate(0px, -4px);
                    transform: rotate(3deg) translate(0px, -4px);
                }

                #nprogress .spinner {
                    display: block;
                    position: fixed;
                    z-index: 1031;
                    top: 15px;
                    right: 15px;
                }

                #nprogress .spinner-icon {
                    width: 18px;
                    height: 18px;
                    box-sizing: border-box;
                    border: solid 2px transparent;
                    border-top-color: #2a2e6a;
                    border-left-color: #2a2e6a;
                    border-radius: 50%;
                    -webkit-animation: nprogresss-spinner 400ms linear infinite;
                    animation: nprogress-spinner 400ms linear infinite;
                }

                .nprogress-custom-parent {
                    overflow: hidden;
                    position: relative;
                }

                .nprogress-custom-parent #nprogress .spinner,
                .nprogress-custom-parent #nprogress .bar {
                    position: absolute;
                }

                @-webkit-keyframes nprogress-spinner {
                    0% {
                        -webkit-transform: rotate(0deg);
                    }

                    100% {
                        -webkit-transform: rotate(360deg);
                    }
                }

                @keyframes nprogress-spinner {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(360deg);
                    }
                }
            </style>
            <div class="ant-layout ant-layout-has-sider css-1588u1j" style="min-height:100vh">
                <?php include 'header.php'; 
                include 'sidebar.php';
                ?>
            <div class="ant-layout flex flex-col justify-between css-1588u1j"
                style="background: rgb(243, 243, 252);  padding: 0px 14px 14px;">
                <main class="ant-layout-content css-1588u1j"
                    style="border-radius: 5px; min-height: 280px; margin-top: 110px; margin-left: 0px; margin-right: 14px; background: rgb(255, 255, 255);">
                    <div class="appointment_details">
                        <div class="mb-5 flex flex-col justify-between gap-[25px] md:flex-row">
                            <div class="flex items-center gap-3">
                                <p class="text-[18px] font-semibold md:text-[22px]">Your Appointments</p>
                            </div>
                            <div class="flex items-center gap-5">
                                <div class="flex justify-end"></div>
                            </div>
                        </div>
                        <div class="appointment_table">
                            <div class="ant-table-wrapper css-1588u1j">
                                <div class="ant-spin-nested-loading css-1588u1j">
                                    <div class="ant-spin-container">
                                        <div class="ant-table css-1588u1j">
                                            <div class="ant-table-container">
                                                <div class="ant-table-content">
                                                    <table style="table-layout:auto">
                                                        <colgroup></colgroup>
                                                        <thead class="ant-table-thead">
                                                            <tr>
                                                                <th class="ant-table-cell" scope="col">#</th>
                                                                <th class="ant-table-cell" scope="col">Name</th>
                                                                <th class="ant-table-cell" scope="col">Phone</th>
                                                                <th class="ant-table-cell" scope="col">Country</th>
                                                                <th class="ant-table-cell" scope="col">Visa Category
                                                                </th>
                                                                <th class="ant-table-cell" scope="col">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="ant-table-tbody">
                                                            <tr class="ant-table-row ant-table-row-level-0"
                                                                data-row-key="1135">
                                                                <td class="ant-table-cell">1</td>
                                                                <td class="ant-table-cell">Raihan Hossain</td>
                                                                <td class="ant-table-cell">8801863995432</td>
                                                                <td class="ant-table-cell">India</td>
                                                                <td class="ant-table-cell">Study Visa</td>
                                                                <td class="ant-table-cell">
                                                                    <p>29.01.2025 (11:30 AM - 12:00 PM)</p>
                                                                </td>
                                                            </tr>
                                                            <tr class="ant-table-row ant-table-row-level-0"
                                                                data-row-key="1134">
                                                                <td class="ant-table-cell">2</td>
                                                                <td class="ant-table-cell">Raihan Hossain</td>
                                                                <td class="ant-table-cell">8801863995432</td>
                                                                <td class="ant-table-cell">India</td>
                                                                <td class="ant-table-cell">Study Visa</td>
                                                                <td class="ant-table-cell">
                                                                    <p>30.01.2025 (10:00 AM - 10:30 AM)</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <ul
                                            class="ant-pagination ant-table-pagination ant-table-pagination-right css-1588u1j">
                                            <li title="Previous Page"
                                                class="ant-pagination-prev ant-pagination-disabled"
                                                aria-disabled="true"><button class="ant-pagination-item-link"
                                                    type="button" tabindex="-1" disabled=""><span role="img"
                                                        aria-label="left" class="anticon anticon-left"><svg
                                                            viewBox="64 64 896 896" focusable="false" data-icon="left"
                                                            width="1em" height="1em" fill="currentColor"
                                                            aria-hidden="true">
                                                            <path
                                                                d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                                                            </path>
                                                        </svg></span></button></li>
                                            <li title="1"
                                                class="ant-pagination-item ant-pagination-item-1 ant-pagination-item-active"
                                                tabindex="0"><a rel="nofollow">1</a></li>
                                            <li title="Next Page" class="ant-pagination-next ant-pagination-disabled"
                                                aria-disabled="true"><button class="ant-pagination-item-link"
                                                    type="button" tabindex="-1" disabled=""><span role="img"
                                                        aria-label="right" class="anticon anticon-right"><svg
                                                            viewBox="64 64 896 896" focusable="false" data-icon="right"
                                                            width="1em" height="1em" fill="currentColor"
                                                            aria-hidden="true">
                                                            <path
                                                                d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                                                            </path>
                                                        </svg></span></button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
</div>
    <?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('user_appointments', 'ua_display_user_appointments_shortcode');