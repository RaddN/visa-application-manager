<?php


// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Create a shortcode to display user checklists
function uc_display_user_checklist_shortcode() {
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        return '<p>You need to be logged in to view your checklist.</p>';
    }

    $current_user = wp_get_current_user();
    
    // Fetch checklist items for the current user
    // This is a placeholder for your actual logic to retrieve checklist items
    // You might need to replace this with a database query or API call
    $checklist_items = get_user_meta($current_user->ID, 'user_checklist', true);



    ob_start(); ?>
    <?php include 'head.php'; ?>
<body>
    <div id="__next">
        <main role="main" id="__main" class="__variable_c389b4 font-noto-sans">
            <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="rrxlx5" data-token-hash="54mug8">:where(.css-1588u1j)[class^="ant-input"],:where(.css-1588u1j)[class*=" ant-input"]{box-sizing:border-box;}:where(.css-1588u1j)[class^="ant-input"]::before,:where(.css-1588u1j)[class*=" ant-input"]::before,:where(.css-1588u1j)[class^="ant-input"]::after,:where(.css-1588u1j)[class*=" ant-input"]::after{box-sizing:border-box;}:where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"],:where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"],:where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"],:where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"]{box-sizing:border-box;}:where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"]::before,:where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"]::before,:where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"]::before,:where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"]::before,:where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"]::after,:where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"]::after,:where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"]::after,:where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"]::after{box-sizing:border-box;}:where(.css-1588u1j).ant-input{box-sizing:border-box;margin:0;padding:4px 11px;color:rgba(0, 0, 0, 0.88);font-size:14px;line-height:1.5714285714285714;list-style:none;font-family:var(--font-noto-sans);position:relative;display:inline-block;width:100%;min-width:0;border-radius:6px;transition:all 0.2s;}:where(.css-1588u1j).ant-input::-moz-placeholder{opacity:1;}:where(.css-1588u1j).ant-input::placeholder{color:rgba(0, 0, 0, 0.25);user-select:none;}:where(.css-1588u1j).ant-input:placeholder-shown{text-overflow:ellipsis;}textarea:where(.css-1588u1j).ant-input{max-width:100%;height:auto;min-height:32px;line-height:1.5714285714285714;vertical-align:bottom;transition:all 0.3s,height 0s;resize:vertical;}:where(.css-1588u1j).ant-input-lg{padding:7px 11px;font-size:16px;line-height:1.5;border-radius:8px;}:where(.css-1588u1j).ant-input-sm{padding:0px 7px;font-size:14px;border-radius:4px;}:where(.css-1588u1j).ant-input-rtl,:where(.css-1588u1j).ant-input-textarea-rtl{direction:rtl;}:where(.css-1588u1j).ant-input-outlined{background:#ffffff;border-width:1px;border-style:solid;border-color:#d9d9d9;}:where(.css-1588u1j).ant-input-outlined:hover{border-color:#484b75;background-color:#ffffff;}:where(.css-1588u1j).ant-input-outlined:focus,:where(.css-1588u1j).ant-input-outlined:focus-within{border-color:#2f3268;box-shadow:0 0 0 2px transparent;outline:0;background-color:#ffffff;}:where(.css-1588u1j).ant-input-outlined.ant-input-disabled,:where(.css-1588u1j).ant-input-outlined[disabled]{color:rgba(0, 0, 0, 0.25);background-color:rgba(0, 0, 0, 0.04);border-color:#d9d9d9;box-shadow:none;cursor:not-allowed;opacity:1;}:where(.css-1588u1j).ant-input-outlined.ant-input-disabled input[disabled],:where(.css-1588u1j).ant-input-outlined[disabled] input[disabled],:where(.css-1588u1j).ant-input-outlined.ant-input-disabled textarea[disabled],:where(.css-1588u1j).ant-input-outlined[disabled] textarea[disabled]{cursor:not-allowed;}:where(.css-1588u1j).ant-input-outlined.ant-input-disabled:hover:not([disabled]),:where(.css-1588u1j).ant-input-outlined[disabled]:hover:not([disabled]){border-color:#d9d9d9;background-color:rgba(0, 0, 0, 0.04);}:where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled){background:#ffffff;border-width:1px;border-style:solid;border-color:#ff4d4f;}:where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):hover{border-color:#ffa39e;background-color:#ffffff;}:where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):focus,:where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):focus-within{border-color:#ff4d4f;box-shadow:0 0 0 2px rgba(255, 38, 5, 0.06);outline:0;background-color:#ffffff;}:where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) .ant-input-prefix,:where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) .ant-input-suffix{color:#ff4d4f;}:where(.css-1588u1j).ant-input-outlined.ant-input-status-error.ant-input-disabled{border-color:#ff4d4f;}:where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled){background:#ffffff;border-width:1px;border-style:solid;border-color:#faad14;}:where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):hover{border-color:#ffd666;background-color:#ffffff;}:where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):focus,:where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):focus-within{border-color:#faad14;box-shadow:0 0 0 2px rgba(255, 215, 5, 0.1);outline:0;background-color:#ffffff;}:where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) .ant-input-prefix,:where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) .ant-input-suffix{color:#faad14;}:where(.css-1588u1j).ant-input-outlined.ant-input-status-warning.ant-input-disabled{border-color:#faad14;}:where(.css-1588u1j).ant-input-filled{background:rgba(0, 0, 0, 0.04);border-width:1px;border-style:solid;border-color:transparent;}input:where(.css-1588u1j).ant-input-filled,:where(.css-1588u1j).ant-input-filled input,textarea:where(.css-1588u1j).ant-input-filled,:where(.css-1588u1j).ant-input-filled textarea{color:undefined;}:where(.css-1588u1j).ant-input-filled:hover{background:rgba(0, 0, 0, 0.06);}:where(.css-1588u1j).ant-input-filled:focus,:where(.css-1588u1j).ant-input-filled:focus-within{outline:0;border-color:#2f3268;background-color:#ffffff;}:where(.css-1588u1j).ant-input-filled.ant-input-disabled,:where(.css-1588u1j).ant-input-filled[disabled]{color:rgba(0, 0, 0, 0.25);background-color:rgba(0, 0, 0, 0.04);border-color:#d9d9d9;box-shadow:none;cursor:not-allowed;opacity:1;}:where(.css-1588u1j).ant-input-filled.ant-input-disabled input[disabled],:where(.css-1588u1j).ant-input-filled[disabled] input[disabled],:where(.css-1588u1j).ant-input-filled.ant-input-disabled textarea[disabled],:where(.css-1588u1j).ant-input-filled[disabled] textarea[disabled]{cursor:not-allowed;}:where(.css-1588u1j).ant-input-filled.ant-input-disabled:hover:not([disabled]),:where(.css-1588u1j).ant-input-filled[disabled]:hover:not([disabled]){border-color:#d9d9d9;background-color:rgba(0, 0, 0, 0.04);}:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled){background:#fff2f0;border-width:1px;border-style:solid;border-color:transparent;}input:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled),:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) input,textarea:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled),:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) textarea{color:#ff4d4f;}:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):hover{background:#fff1f0;}:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):focus,:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):focus-within{outline:0;border-color:#ff4d4f;background-color:#ffffff;}:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) .ant-input-prefix,:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) .ant-input-suffix{color:#ff4d4f;}:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled){background:#fffbe6;border-width:1px;border-style:solid;border-color:transparent;}input:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled),:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) input,textarea:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled),:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) textarea{color:#faad14;}:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):hover{background:#fff1b8;}:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):focus,:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):focus-within{outline:0;border-color:#faad14;background-color:#ffffff;}:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) .ant-input-prefix,:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) .ant-input-suffix{color:#faad14;}:where(.css-1588u1j).ant-input-borderless{background:transparent;border:none;}:where(.css-1588u1j).ant-input-borderless:focus,:where(.css-1588u1j).ant-input-borderless:focus-within{outline:none;}:where(.css-1588u1j).ant-input-borderless.ant-input-disabled,:where(.css-1588u1j).ant-input-borderless[disabled]{color:rgba(0, 0, 0, 0.25);}:where(.css-1588u1j).ant-input-borderless.ant-input-status-error,:where(.css-1588u1j).ant-input-borderless.ant-input-status-error input,:where(.css-1588u1j).ant-input-borderless.ant-input-status-error textarea{color:#ff4d4f;}:where(.css-1588u1j).ant-input-borderless.ant-input-status-warning,:where(.css-1588u1j).ant-input-borderless.ant-input-status-warning input,:where(.css-1588u1j).ant-input-borderless.ant-input-status-warning textarea{color:#faad14;}:where(.css-1588u1j).ant-input[type="color"]{height:32px;}:where(.css-1588u1j).ant-input[type="color"].ant-input-lg{height:40px;}:where(.css-1588u1j).ant-input[type="color"].ant-input-sm{height:24px;padding-top:3px;padding-bottom:3px;}:where(.css-1588u1j).ant-input[type="search"]::-webkit-search-cancel-button,:where(.css-1588u1j).ant-input[type="search"]::-webkit-search-decoration{-webkit-appearance:none;}:where(.css-1588u1j).ant-input-textarea{position:relative;}:where(.css-1588u1j).ant-input-textarea-show-count >.ant-input{height:100%;}:where(.css-1588u1j).ant-input-textarea-show-count .ant-input-data-count{position:absolute;bottom:-22px;inset-inline-end:0;color:rgba(0, 0, 0, 0.45);white-space:nowrap;pointer-events:none;}:where(.css-1588u1j).ant-input-textarea-allow-clear>.ant-input,:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-textarea-has-feedback .ant-input{padding-inline-end:24px;}:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper{padding:0;}:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper >textarea.ant-input{font-size:inherit;border:none;outline:none;background:transparent;}:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper >textarea.ant-input:focus{box-shadow:none!important;}:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix{margin:0;}:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix >*:not(:last-child){margin-inline:0;}:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix .ant-input-clear-icon{position:absolute;inset-inline-end:11px;inset-block-start:8px;}:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix .ant-input-textarea-suffix{position:absolute;top:0;inset-inline-end:11px;bottom:0;z-index:1;display:inline-flex;align-items:center;margin:auto;pointer-events:none;}:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper-sm .ant-input-suffix .ant-input-clear-icon{inset-inline-end:7px;}:where(.css-1588u1j).ant-input-affix-wrapper{position:relative;display:inline-flex;width:100%;min-width:0;padding:4px 11px;color:rgba(0, 0, 0, 0.88);font-size:14px;line-height:1.5714285714285714;border-radius:6px;transition:all 0.2s;}:where(.css-1588u1j).ant-input-affix-wrapper::-moz-placeholder{opacity:1;}:where(.css-1588u1j).ant-input-affix-wrapper::placeholder{color:rgba(0, 0, 0, 0.25);user-select:none;}:where(.css-1588u1j).ant-input-affix-wrapper:placeholder-shown{text-overflow:ellipsis;}textarea:where(.css-1588u1j).ant-input-affix-wrapper{max-width:100%;height:auto;min-height:32px;line-height:1.5714285714285714;vertical-align:bottom;transition:all 0.3s,height 0s;resize:vertical;}:where(.css-1588u1j).ant-input-affix-wrapper-lg{padding:7px 11px;font-size:16px;line-height:1.5;border-radius:8px;}:where(.css-1588u1j).ant-input-affix-wrapper-sm{padding:0px 7px;font-size:14px;border-radius:4px;}:where(.css-1588u1j).ant-input-affix-wrapper-rtl,:where(.css-1588u1j).ant-input-affix-wrapper-textarea-rtl{direction:rtl;}:where(.css-1588u1j).ant-input-affix-wrapper:not(.ant-input-disabled):hover{z-index:1;}.ant-input-search-with-button :where(.css-1588u1j).ant-input-affix-wrapper:not(.ant-input-disabled):hover{z-index:0;}:where(.css-1588u1j).ant-input-affix-wrapper-focused,:where(.css-1588u1j).ant-input-affix-wrapper:focus{z-index:1;}:where(.css-1588u1j).ant-input-affix-wrapper >input.ant-input{padding:0;}:where(.css-1588u1j).ant-input-affix-wrapper >input.ant-input,:where(.css-1588u1j).ant-input-affix-wrapper >textarea.ant-input{font-size:inherit;border:none;border-radius:0;outline:none;background:transparent;color:inherit;}:where(.css-1588u1j).ant-input-affix-wrapper >input.ant-input::-ms-reveal,:where(.css-1588u1j).ant-input-affix-wrapper >textarea.ant-input::-ms-reveal{display:none;}:where(.css-1588u1j).ant-input-affix-wrapper >input.ant-input:focus,:where(.css-1588u1j).ant-input-affix-wrapper >textarea.ant-input:focus{box-shadow:none!important;}:where(.css-1588u1j).ant-input-affix-wrapper::before{display:inline-block;width:0;visibility:hidden;content:"\a0";}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix,:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix{display:flex;flex:none;align-items:center;}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix >*:not(:last-child),:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix >*:not(:last-child){margin-inline-end:8px;}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-show-count-suffix{color:rgba(0, 0, 0, 0.45);}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-show-count-has-suffix{margin-inline-end:4px;}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix{margin-inline-end:4px;}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix{margin-inline-start:4px;}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon{margin:0;color:rgba(0, 0, 0, 0.25);font-size:12px;vertical-align:-1px;cursor:pointer;transition:color 0.3s;}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon:hover{color:rgba(0, 0, 0, 0.45);}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon:active{color:rgba(0, 0, 0, 0.88);}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon-hidden{visibility:hidden;}:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon-has-suffix{margin:0 4px;}:where(.css-1588u1j).ant-input-affix-wrapper .anticon.ant-input-password-icon{color:rgba(0, 0, 0, 0.45);cursor:pointer;transition:all 0.3s;}:where(.css-1588u1j).ant-input-affix-wrapper .anticon.ant-input-password-icon:hover{color:rgba(0, 0, 0, 0.88);}:where(.css-1588u1j).ant-input-group{box-sizing:border-box;margin:0;padding:0;color:rgba(0, 0, 0, 0.88);font-size:14px;line-height:1.5714285714285714;list-style:none;font-family:var(--font-noto-sans);position:relative;display:table;width:100%;border-collapse:separate;border-spacing:0;}:where(.css-1588u1j).ant-input-group[class*='col-']{padding-inline-end:8px;}:where(.css-1588u1j).ant-input-group[class*='col-']:last-child{padding-inline-end:0;}:where(.css-1588u1j).ant-input-group-lg .ant-input,:where(.css-1588u1j).ant-input-group-lg>.ant-input-group-addon{padding:7px 11px;font-size:16px;line-height:1.5;border-radius:8px;}:where(.css-1588u1j).ant-input-group-sm .ant-input,:where(.css-1588u1j).ant-input-group-sm>.ant-input-group-addon{padding:0px 7px;font-size:14px;border-radius:4px;}:where(.css-1588u1j).ant-input-group-lg .ant-select-single .ant-select-selector{height:40px;}:where(.css-1588u1j).ant-input-group-sm .ant-select-single .ant-select-selector{height:24px;}:where(.css-1588u1j).ant-input-group >.ant-input{display:table-cell;}:where(.css-1588u1j).ant-input-group >.ant-input:not(:first-child):not(:last-child){border-radius:0;}:where(.css-1588u1j).ant-input-group .ant-input-group-addon,:where(.css-1588u1j).ant-input-group .ant-input-group-wrap{display:table-cell;width:1px;white-space:nowrap;vertical-align:middle;}:where(.css-1588u1j).ant-input-group .ant-input-group-addon:not(:first-child):not(:last-child),:where(.css-1588u1j).ant-input-group .ant-input-group-wrap:not(:first-child):not(:last-child){border-radius:0;}:where(.css-1588u1j).ant-input-group .ant-input-group-wrap>*{display:block!important;}:where(.css-1588u1j).ant-input-group .ant-input-group-addon{position:relative;padding:0 11px;color:rgba(0, 0, 0, 0.88);font-weight:normal;font-size:14px;text-align:center;border-radius:6px;transition:all 0.3s;line-height:1;}:where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select{margin:-5px -11px;}:where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select.ant-select-single:not(.ant-select-customize-input):not(.ant-pagination-size-changer) .ant-select-selector{background-color:inherit;border:1px solid transparent;box-shadow:none;}:where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select-open .ant-select-selector,:where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select-focused .ant-select-selector{color:#2f3268;}:where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-cascader-picker{margin:-9px -11px;background-color:transparent;}:where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-cascader-picker .ant-cascader-input{text-align:start;border:0;box-shadow:none;}:where(.css-1588u1j).ant-input-group .ant-input{width:100%;margin-bottom:0;text-align:inherit;}:where(.css-1588u1j).ant-input-group .ant-input:focus{z-index:1;border-inline-end-width:1px;}:where(.css-1588u1j).ant-input-group .ant-input:hover{z-index:1;border-inline-end-width:1px;}.ant-input-search-with-button :where(.css-1588u1j).ant-input-group .ant-input:hover{z-index:0;}:where(.css-1588u1j).ant-input-group >.ant-input:first-child,:where(.css-1588u1j).ant-input-group .ant-input-group-addon:first-child{border-start-end-radius:0;border-end-end-radius:0;}:where(.css-1588u1j).ant-input-group >.ant-input:first-child .ant-select .ant-select-selector,:where(.css-1588u1j).ant-input-group .ant-input-group-addon:first-child .ant-select .ant-select-selector{border-start-end-radius:0;border-end-end-radius:0;}:where(.css-1588u1j).ant-input-group >.ant-input-affix-wrapper:not(:first-child) .ant-input{border-start-start-radius:0;border-end-start-radius:0;}:where(.css-1588u1j).ant-input-group >.ant-input-affix-wrapper:not(:last-child) .ant-input{border-start-end-radius:0;border-end-end-radius:0;}:where(.css-1588u1j).ant-input-group >.ant-input:last-child,:where(.css-1588u1j).ant-input-group .ant-input-group-addon:last-child{border-start-start-radius:0;border-end-start-radius:0;}:where(.css-1588u1j).ant-input-group >.ant-input:last-child .ant-select .ant-select-selector,:where(.css-1588u1j).ant-input-group .ant-input-group-addon:last-child .ant-select .ant-select-selector{border-start-start-radius:0;border-end-start-radius:0;}:where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:last-child){border-start-end-radius:0;border-end-end-radius:0;}.ant-input-search :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:last-child){border-start-start-radius:6px;border-end-start-radius:6px;}:where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:first-child),.ant-input-search :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:first-child){border-start-start-radius:0;border-end-start-radius:0;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact{display:block;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact::before{display:table;content:"";}:where(.css-1588u1j).ant-input-group.ant-input-group-compact::after{display:table;clear:both;content:"";}:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child),:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child),:where(.css-1588u1j).ant-input-group.ant-input-group-compact >.ant-input:not(:first-child):not(:last-child){border-inline-end-width:1px;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child):hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child):hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact >.ant-input:not(:first-child):not(:last-child):hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child):focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child):focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact >.ant-input:not(:first-child):not(:last-child):focus{z-index:1;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>*{display:inline-flex;float:none;vertical-align:top;border-radius:0;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-affix-wrapper,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-number-affix-wrapper,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-picker-range{display:inline-flex;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:not(:last-child){margin-inline-end:-1px;border-inline-end-width:1px;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input{float:none;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input{border-inline-end-width:1px;border-radius:0;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector:hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input:hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input:hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input:hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector:focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input:focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input:focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input:focus{z-index:1;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-focused{z-index:1;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-arrow{z-index:1;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:first-child,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select:first-child>.ant-select-selector,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete:first-child .ant-input,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker:first-child .ant-input{border-start-start-radius:6px;border-end-start-radius:6px;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:last-child,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select:last-child>.ant-select-selector,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker:last-child .ant-input,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker-focused:last-child .ant-input{border-inline-end-width:1px;border-start-end-radius:6px;border-end-end-radius:6px;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input{vertical-align:top;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper+.ant-input-group-wrapper{margin-inline-start:-1px;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper+.ant-input-group-wrapper .ant-input-affix-wrapper{border-radius:0;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper:not(:last-child).ant-input-search>.ant-input-group>.ant-input-group-addon>.ant-input-search-button{border-radius:0;}:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper:not(:last-child).ant-input-search>.ant-input-group>.ant-input{border-start-start-radius:6px;border-start-end-radius:0;border-end-end-radius:0;border-end-start-radius:6px;}:where(.css-1588u1j).ant-input-group-rtl{direction:rtl;}:where(.css-1588u1j).ant-input-group-wrapper{display:inline-block;width:100%;text-align:start;vertical-align:top;}:where(.css-1588u1j).ant-input-group-wrapper-rtl{direction:rtl;}:where(.css-1588u1j).ant-input-group-wrapper-lg .ant-input-group-addon{border-radius:8px;font-size:16px;}:where(.css-1588u1j).ant-input-group-wrapper-sm .ant-input-group-addon{border-radius:4px;}:where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon{background:rgba(0, 0, 0, 0.02);border:1px solid #d9d9d9;}:where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon:first-child{border-inline-end:0;}:where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon:last-child{border-inline-start:0;}:where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-status-error .ant-input-group-addon{border-color:#ff4d4f;color:#ff4d4f;}:where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-status-warning .ant-input-group-addon{border-color:#faad14;color:#faad14;}:where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon{color:rgba(0, 0, 0, 0.25);background-color:rgba(0, 0, 0, 0.04);border-color:#d9d9d9;box-shadow:none;cursor:not-allowed;opacity:1;}:where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon input[disabled],:where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon textarea[disabled]{cursor:not-allowed;}:where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon:hover:not([disabled]){border-color:#d9d9d9;background-color:rgba(0, 0, 0, 0.04);}:where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group-addon{background:rgba(0, 0, 0, 0.04);}:where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group .ant-input-filled:not(:focus):not(:focus-within):not(:first-child){border-inline-start:1px solid rgba(5, 5, 5, 0.06);}:where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group .ant-input-filled:not(:focus):not(:focus-within):not(:last-child){border-inline-end:1px solid rgba(5, 5, 5, 0.06);}:where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-status-error .ant-input-group-addon{background:#fff2f0;color:#ff4d4f;}:where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-status-warning .ant-input-group-addon{background:#fffbe6;color:#faad14;}:where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon{background:rgba(0, 0, 0, 0.04);color:rgba(0, 0, 0, 0.25);}:where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon:first-child{border-inline-start:1px solid #d9d9d9;border-top:1px solid #d9d9d9;border-bottom:1px solid #d9d9d9;}:where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon:last-child{border-inline-end:1px solid #d9d9d9;border-top:1px solid #d9d9d9;border-bottom:1px solid #d9d9d9;}:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item).ant-input-compact-item .ant-input,:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item).ant-input-compact-item .ant-input-group-addon{border-radius:0;}:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-first-item .ant-input,:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-first-item .ant-input-group-addon{border-start-end-radius:0;border-end-end-radius:0;}:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item).ant-input-compact-last-item .ant-input,:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item).ant-input-compact-last-item .ant-input-group-addon{border-start-start-radius:0;border-end-start-radius:0;}:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-item .ant-input-affix-wrapper{border-start-end-radius:0;border-end-end-radius:0;}:where(.css-1588u1j).ant-input-search .ant-input:hover,:where(.css-1588u1j).ant-input-search .ant-input:focus{border-color:#484b75;}:where(.css-1588u1j).ant-input-search .ant-input:hover +.ant-input-group-addon .ant-input-search-button:not(.ant-btn-primary),:where(.css-1588u1j).ant-input-search .ant-input:focus +.ant-input-group-addon .ant-input-search-button:not(.ant-btn-primary){border-inline-start-color:#484b75;}:where(.css-1588u1j).ant-input-search .ant-input-affix-wrapper{border-radius:0;}:where(.css-1588u1j).ant-input-search .ant-input-lg{line-height:1.4998;}:where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child{inset-inline-start:-1px;padding:0;border:0;}:where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button{margin-inline-end:-1px;padding-top:0;padding-bottom:0;border-start-start-radius:0;border-start-end-radius:6px;border-end-end-radius:6px;border-end-start-radius:0;box-shadow:none;}:where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary){color:rgba(0, 0, 0, 0.45);}:where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary):hover{color:#484b75;}:where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary):active{color:#1b1b42;}:where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary).ant-btn-loading::before{inset-inline-start:0;inset-inline-end:0;inset-block-start:0;inset-block-end:0;}:where(.css-1588u1j).ant-input-search .ant-input-search-button{height:32px;}:where(.css-1588u1j).ant-input-search .ant-input-search-button:hover,:where(.css-1588u1j).ant-input-search .ant-input-search-button:focus{z-index:1;}:where(.css-1588u1j).ant-input-search-large .ant-input-search-button{height:40px;}:where(.css-1588u1j).ant-input-search-small .ant-input-search-button{height:24px;}:where(.css-1588u1j).ant-input-search-rtl{direction:rtl;}:where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-last-item) .ant-input-group-addon .ant-input-search-button{margin-inline-end:-1px;border-radius:0;}:where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-first-item) .ant-input,:where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-first-item) .ant-input-affix-wrapper{border-radius:0;}:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input-group-addon .ant-input-search-button:hover,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input:hover,:where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:hover,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input-group-addon .ant-input-search-button:focus,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input:focus,:where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:focus,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input-group-addon .ant-input-search-button:active,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input:active,:where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:active{z-index:2;}:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input-affix-wrapper-focused{z-index:2;}:where(.css-1588u1j).ant-input-out-of-range,:where(.css-1588u1j).ant-input-out-of-range input,:where(.css-1588u1j).ant-input-out-of-range textarea,:where(.css-1588u1j).ant-input-out-of-range .ant-input-show-count-suffix,:where(.css-1588u1j).ant-input-out-of-range .ant-input-data-count{color:#ff4d4f;}:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item){margin-inline-end:-1px;}:where(.css-1588u1j).ant-input-compact-item:hover,:where(.css-1588u1j).ant-input-compact-item:focus,:where(.css-1588u1j).ant-input-compact-item:active{z-index:2;}:where(.css-1588u1j).ant-input-compact-item[disabled]{z-index:0;}:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item){border-radius:0;}:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item,:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item.ant-input-sm,:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item.ant-input-lg{border-start-end-radius:0;border-end-end-radius:0;}:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item,:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item.ant-input-sm,:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item.ant-input-lg{border-start-start-radius:0;border-end-start-radius:0;}</style>
            <style>
                input[type="text"], input[type="number"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type=reset], input[type=tel], input[type=date], select {
                    height: unset;
                }
                .ant-progress-inner {
                    position: relative !important;
                    display: flex
                ;
                    justify-content: center;
                    align-items: center;
                }
                span.ant-progress-text {
                    position: absolute;
                }
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
                    <div class="checklist_page">
                        <div class="mb-5 flex flex-col justify-between gap-[25px] md:flex-row">
                            <div class="flex items-center gap-3">
                                <p class="text-[18px] font-semibold md:text-[22px]">Your All checklist</p>
                            </div>
                            <div class="flex items-center gap-5">
                                <div class="flex justify-end"></div>
                                <form class="ant-form ant-form-horizontal css-1588u1j">
                                    <div class="ant-form-item css-1588u1j">
                                        <div class="ant-row ant-form-item-row css-1588u1j">
                                            <div class="ant-col ant-form-item-control css-1588u1j">
                                                <div class="ant-form-item-control-input">
                                                    <div class="ant-form-item-control-input-content"><span
                                                            class="ant-input-affix-wrapper ant-input-affix-wrapper-lg css-1588u1j ant-input-outlined h-9 lg:w-[440px]"><span
                                                                class="ant-input-prefix"><svg stroke="currentColor"
                                                                    fill="currentColor" stroke-width="0"
                                                                    viewBox="0 0 16 16" class="color-[#2A2E6A] mr-2 w-5"
                                                                    height="1em" width="1em"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0">
                                                                    </path>
                                                                </svg></span><input placeholder="Search Your checklist"
                                                                id="applicationTracking"
                                                                class="ant-input ant-input-lg css-1588u1j" type="text"
                                                                value=""><span class="ant-input-suffix"><span
                                                                    class="ant-input-clear-icon ant-input-clear-icon-hidden"
                                                                    role="button" tabindex="-1"><span role="img"
                                                                        aria-label="close-circle"
                                                                        class="anticon anticon-close-circle"><svg
                                                                            fill-rule="evenodd" viewBox="64 64 896 896"
                                                                            focusable="false" data-icon="close-circle"
                                                                            width="1em" height="1em" fill="currentColor"
                                                                            aria-hidden="true">
                                                                            <path
                                                                                d="M512 64c247.4 0 448 200.6 448 448S759.4 960 512 960 64 759.4 64 512 264.6 64 512 64zm127.98 274.82h-.04l-.08.06L512 466.75 384.14 338.88c-.04-.05-.06-.06-.08-.06a.12.12 0 00-.07 0c-.03 0-.05.01-.09.05l-45.02 45.02a.2.2 0 00-.05.09.12.12 0 000 .07v.02a.27.27 0 00.06.06L466.75 512 338.88 639.86c-.05.04-.06.06-.06.08a.12.12 0 000 .07c0 .03.01.05.05.09l45.02 45.02a.2.2 0 00.09.05.12.12 0 00.07 0c.02 0 .04-.01.08-.05L512 557.25l127.86 127.87c.04.04.06.05.08.05a.12.12 0 00.07 0c.03 0 .05-.01.09-.05l45.02-45.02a.2.2 0 00.05-.09.12.12 0 000-.07v-.02a.27.27 0 00-.05-.06L557.25 512l127.87-127.86c.04-.04.05-.06.05-.08a.12.12 0 000-.07c0-.03-.01-.05-.05-.09l-45.02-45.02a.2.2 0 00-.09-.05.12.12 0 00-.07 0z">
                                                                            </path>
                                                                        </svg></span></span></span></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="application_list">
                            <div class="ant-row ant-row-center css-1588u1j"
                                style="margin-left: -10px; margin-right: -10px; row-gap: 20px;">
                                <div class="ant-col ant-col-xs-24 ant-col-md-12 ant-col-lg-24 css-1588u1j"
                                    style="padding-left: 10px; padding-right: 10px; width: 100%;">
                                    <div class="application_card odd">
                                        <div class="id">
                                            <p><span class="text-black">1</span></p>
                                        </div>
                                        <div class="submit">
                                            <p>Submitted date</p>
                                            <h5>January 27 2025</h5>
                                        </div>
                                        <div class="status">
                                            <p>Current Status</p>
                                            <div class="progress_wrapper mt-5" style="display: flex ; justify-content: center;">
                                                <div class="ant-progress ant-progress-status-normal ant-progress-circle ant-progress-show-info ant-progress-default css-1588u1j"
                                                    role="progressbar" aria-valuenow="64" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="ant-progress-inner"
                                                        style="width: 120px; height: 120px; font-size: 24px;"><svg
                                                            class="ant-progress-circle" viewBox="0 0 100 100"
                                                            role="presentation">
                                                            <circle class="ant-progress-circle-trail" r="45" cx="50"
                                                                cy="50" stroke="#FDBA74" stroke-linecap="round"
                                                                stroke-width="10"
                                                                style="stroke: rgb(253, 186, 116); stroke-dasharray: 282.743px, 282.743; stroke-dashoffset: 0; transform: rotate(-90deg); transform-origin: 50px 50px; transition: stroke-dashoffset 0.3s, stroke-dasharray 0.3s, stroke 0.3s, stroke-width 0.06s 0.3s, opacity 0.3s; fill-opacity: 0;">
                                                            </circle>
                                                            <circle class="ant-progress-circle-path" r="45" cx="50"
                                                                cy="50" stroke-linecap="round" stroke-width="10"
                                                                opacity="1"
                                                                style="stroke: rgb(249, 115, 22); stroke-dasharray: 282.743px, 282.743; stroke-dashoffset: 105.035; transform: rotate(-90deg); transform-origin: 50px 50px; transition: stroke-dashoffset, stroke-dasharray, stroke, stroke-width 0.3s, opacity; fill-opacity: 0;">
                                                            </circle>
                                                            <circle class="ant-progress-circle-path" r="45" cx="50"
                                                                cy="50" stroke-linecap="round" stroke-width="10"
                                                                opacity="0"
                                                                style="stroke: rgb(82, 196, 26); stroke-dasharray: 282.743px, 282.743; stroke-dashoffset: 282.733; transform: rotate(-90deg); transform-origin: 50px 50px; transition: stroke-dashoffset, stroke-dasharray, stroke, stroke-width 0.3s, opacity; fill-opacity: 0;">
                                                            </circle>
                                                        </svg><span class="ant-progress-text"
                                                            title="64.62%">64.62%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="handler"><a class="inline-block custom_link"
                                                href="/user/checklist/2606/"><button type="button"
                                                    class="ant-btn css-1588u1j ant-btn-default"><span>Details</span></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end pt-10">
                                <ul class="ant-pagination css-1588u1j">
                                    <li title="Previous Page" class="ant-pagination-prev ant-pagination-disabled"
                                        aria-disabled="true"><button class="ant-pagination-item-link" type="button"
                                            tabindex="-1" disabled=""><span role="img" aria-label="left"
                                                class="anticon anticon-left"><svg viewBox="64 64 896 896"
                                                    focusable="false" data-icon="left" width="1em" height="1em"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                                                    </path>
                                                </svg></span></button></li>
                                    <li title="1"
                                        class="ant-pagination-item ant-pagination-item-1 ant-pagination-item-active"
                                        tabindex="0"><a rel="nofollow">1</a></li>
                                    <li title="Next Page" class="ant-pagination-next ant-pagination-disabled"
                                        aria-disabled="true"><button class="ant-pagination-item-link" type="button"
                                            tabindex="-1" disabled=""><span role="img" aria-label="right"
                                                class="anticon anticon-right"><svg viewBox="64 64 896 896"
                                                    focusable="false" data-icon="right" width="1em" height="1em"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                                                    </path>
                                                </svg></span></button></li>
                                </ul>
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
add_shortcode('user_checklist', 'uc_display_user_checklist_shortcode');