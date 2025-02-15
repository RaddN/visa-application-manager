<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Create a shortcode to display user settings
function us_display_user_settings_shortcode() {
     // Check if the user is logged in
     if (!is_user_logged_in()) {
        return '<p>You need to be logged in to reset your password.</p>';
    }

    $message = ''; // Initialize message variable

    // Handle form submission to reset password
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
        $new_password = sanitize_text_field($_POST['newPassword']);
        $confirm_password = sanitize_text_field($_POST['confirmPassword']);

        if ($new_password === $confirm_password) {
            $current_user = wp_get_current_user();
            wp_set_password($new_password, $current_user->ID);
            $message = '<p>Your password has been reset successfully!</p>';
        } else {
            $message = '<p>Passwords do not match. Please try again.</p>';
        }
    }

    ob_start(); ?>
    <?php include 'head.php'; ?>
<body>
    <div id="__next">
        <main role="main" id="__main" class="__variable_c389b4 font-noto-sans">
        <style>
            :where(.css-1588u1j)[class^="ant-form"],:where(.css-1588u1j)[class*=" ant-form"] {
                font-family: var(--font-noto-sans);
                font-size: 14px;
                box-sizing: border-box;
            }

            :where(.css-1588u1j)[class^="ant-form"]::before,:where(.css-1588u1j)[class*=" ant-form"]::before,:where(.css-1588u1j)[class^="ant-form"]::after,:where(.css-1588u1j)[class*=" ant-form"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"],:where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"],:where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"],:where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"]::before,:where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"]::before,:where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"]::before,:where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"]::before,:where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"]::after,:where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"]::after,:where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"]::after,:where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-form {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
                line-height: 1.5714285714285714;
                list-style: none;
                font-family: var(--font-noto-sans);
            }

            :where(.css-1588u1j).ant-form legend {
                display: block;
                width: 100%;
                margin-bottom: 24px;
                padding: 0;
                color: rgba(0, 0, 0, 0.45);
                font-size: 16px;
                line-height: inherit;
                border: 0;
                border-bottom: 1px solid #d9d9d9;
            }

            :where(.css-1588u1j).ant-form input[type="search"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-form input[type="radio"],:where(.css-1588u1j).ant-form input[type="checkbox"] {
                line-height: normal;
            }

            :where(.css-1588u1j).ant-form input[type="file"] {
                display: block;
            }

            :where(.css-1588u1j).ant-form input[type="range"] {
                display: block;
                width: 100%;
            }

            :where(.css-1588u1j).ant-form select[multiple],:where(.css-1588u1j).ant-form select[size] {
                height: auto;
            }

            :where(.css-1588u1j).ant-form input[type='file']:focus,:where(.css-1588u1j).ant-form input[type='radio']:focus,:where(.css-1588u1j).ant-form input[type='checkbox']:focus {
                outline: 0;
                box-shadow: 0 0 0 2px transparent;
            }

            :where(.css-1588u1j).ant-form output {
                display: block;
                padding-top: 15px;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
                line-height: 1.5714285714285714;
            }

            :where(.css-1588u1j).ant-form .ant-form-text {
                display: inline-block;
                padding-inline-end:12px;}

            :where(.css-1588u1j).ant-form-small .ant-form-item .ant-form-item-label>label {
                height: 24px;
            }

            :where(.css-1588u1j).ant-form-small .ant-form-item .ant-form-item-control-input {
                min-height: 24px;
            }

            :where(.css-1588u1j).ant-form-large .ant-form-item .ant-form-item-label>label {
                height: 40px;
            }

            :where(.css-1588u1j).ant-form-large .ant-form-item .ant-form-item-control-input {
                min-height: 40px;
            }

            :where(.css-1588u1j).ant-form-item {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
                line-height: 1.5714285714285714;
                list-style: none;
                font-family: var(--font-noto-sans);
                margin-bottom: 24px;
                vertical-align: top;
            }

            :where(.css-1588u1j).ant-form-item-with-help {
                transition: none;
            }

            :where(.css-1588u1j).ant-form-item-hidden,:where(.css-1588u1j).ant-form-item-hidden.ant-row {
                display: none;
            }

            :where(.css-1588u1j).ant-form-item-has-warning .ant-form-item-split {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-form-item-has-error .ant-form-item-split {
                color: #faad14;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-label {
                flex-grow: 0;
                overflow: hidden;
                white-space: nowrap;
                text-align: end;
                vertical-align: middle;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-label-left {
                text-align: start;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-label-wrap {
                overflow: unset;
                line-height: 1.5714285714285714;
                white-space: unset;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-label >label {
                position: relative;
                display: inline-flex;
                align-items: center;
                max-width: 100%;
                height: 32px;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-label >label >.anticon {
                font-size: 14px;
                vertical-align: top;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-label >label.ant-form-item-required:not(.ant-form-item-required-mark-optional)::before {
                display: inline-block;
                margin-inline-end:4px;color: #ff4d4f;
                font-size: 14px;
                font-family: SimSun,sans-serif;
                line-height: 1;
                content: "*";
            }

            .ant-form-hide-required-mark :where(.css-1588u1j).ant-form-item .ant-form-item-label >label.ant-form-item-required:not(.ant-form-item-required-mark-optional)::before {
                display: none;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-label >label .ant-form-item-optional {
                display: inline-block;
                margin-inline-start:4px;color: rgba(0, 0, 0, 0.45);
            }

            .ant-form-hide-required-mark :where(.css-1588u1j).ant-form-item .ant-form-item-label >label .ant-form-item-optional {
                display: none;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-label >label .ant-form-item-tooltip {
                color: rgba(0, 0, 0, 0.45);
                cursor: help;
                writing-mode: horizontal-tb;
                margin-inline-start:4px;}

            :where(.css-1588u1j).ant-form-item .ant-form-item-label >label::after {
                content: ":";
                position: relative;
                margin-block:0;margin-inline-start:2px;margin-inline-end:8px;}

            :where(.css-1588u1j).ant-form-item .ant-form-item-label >label.ant-form-item-no-colon::after {
                content: "\a0";
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-control {
                --ant-display: flex;
                flex-direction: column;
                flex-grow: 1;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-control:first-child:not([class^="'ant-col-'"]):not([class*="' ant-col-'"]) {
                width: 100%;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-control-input {
                position: relative;
                display: flex;
                align-items: center;
                min-height: 32px;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-control-input-content {
                flex: auto;
                max-width: 100%;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-explain,:where(.css-1588u1j).ant-form-item .ant-form-item-extra {
                clear: both;
                color: rgba(0, 0, 0, 0.45);
                font-size: 14px;
                line-height: 1.5714285714285714;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-explain-connected {
                width: 100%;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-extra {
                min-height: 24px;
                transition: color 0.2s cubic-bezier(0.215, 0.61, 0.355, 1);
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-explain-error {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-explain-warning {
                color: #faad14;
            }

            :where(.css-1588u1j).ant-form-item-with-help .ant-form-item-explain {
                height: auto;
                opacity: 1;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon {
                font-size: 14px;
                text-align: center;
                visibility: visible;
                animation-name: css-1588u1j-antZoomIn;
                animation-duration: 0.2s;
                animation-timing-function: cubic-bezier(0.12, 0.4, 0.29, 1.46);
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-success {
                color: #52c41a;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-error {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-warning {
                color: #faad14;
            }

            :where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-validating {
                color: #2f3268;
            }

            :where(.css-1588u1j).ant-form-show-help {
                transition: opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
            }

            :where(.css-1588u1j).ant-form-show-help-appear,:where(.css-1588u1j).ant-form-show-help-enter {
                opacity: 0;
            }

            :where(.css-1588u1j).ant-form-show-help-appear-active,:where(.css-1588u1j).ant-form-show-help-enter-active {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-form-show-help-leave {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-form-show-help-leave-active {
                opacity: 0;
            }

            :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item {
                overflow: hidden;
                transition: height 0.3s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1),transform 0.3s cubic-bezier(0.645, 0.045, 0.355, 1)!important;
            }

            :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-appear,:where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-enter {
                transform: translateY(-5px);
                opacity: 0;
            }

            :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-appear-active,:where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-enter-active {
                transform: translateY(0);
                opacity: 1;
            }

            :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-leave-active {
                transform: translateY(-5px);
            }

            :where(.css-1588u1j).ant-form-horizontal .ant-form-item-label {
                flex-grow: 0;
            }

            :where(.css-1588u1j).ant-form-horizontal .ant-form-item-control {
                flex: 1 1 0;
                min-width: 0;
            }

            :where(.css-1588u1j).ant-form-horizontal .ant-form-item-label[class$='-24']+.ant-form-item-control,:where(.css-1588u1j).ant-form-horizontal .ant-form-item-label[class*='-24 ']+.ant-form-item-control {
                min-width: unset;
            }

            :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label {
                flex-grow: 0;
            }

            :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-control {
                flex: 1 1 0;
                min-width: 0;
            }

            :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label[class$='-24']+.ant-form-item-control,:where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label[class*='-24 ']+.ant-form-item-control {
                min-width: unset;
            }

            :where(.css-1588u1j).ant-form-inline {
                display: flex;
                flex-wrap: wrap;
            }

            :where(.css-1588u1j).ant-form-inline .ant-form-item {
                flex: none;
                margin-inline-end:16px;margin-bottom: 0;
            }

            :where(.css-1588u1j).ant-form-inline .ant-form-item-row {
                flex-wrap: nowrap;
            }

            :where(.css-1588u1j).ant-form-inline .ant-form-item >.ant-form-item-label,:where(.css-1588u1j).ant-form-inline .ant-form-item >.ant-form-item-control {
                display: inline-block;
                vertical-align: top;
            }

            :where(.css-1588u1j).ant-form-inline .ant-form-item >.ant-form-item-label {
                flex: none;
            }

            :where(.css-1588u1j).ant-form-inline .ant-form-item .ant-form-text {
                display: inline-block;
            }

            :where(.css-1588u1j).ant-form-inline .ant-form-item .ant-form-item-has-feedback {
                display: inline-block;
            }

            :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-row {
                flex-direction: column;
            }

            :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label>label {
                height: auto;
            }

            :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-control {
                width: 100%;
            }

            :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label {
                padding: 0 0 8px;
                margin: 0;
                white-space: initial;
                text-align: start;
            }

            :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label >label,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label >label,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label >label {
                margin: 0;
            }

            :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label >label::after,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label >label::after,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label >label::after {
                visibility: hidden;
            }

            @media (max-width: 575px) {
                :where(.css-1588u1j).ant-form-item .ant-form-item-label {
                    padding:0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form-item .ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form-item .ant-form-item-label >label::after {
                    visibility: hidden;
                }

                :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item {
                    flex-wrap: wrap;
                }

                :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-label:not([class*=" ant-col-xs"]),:where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-control:not([class*=" ant-col-xs"]) {
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label {
                    padding: 0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label >label::after {
                    visibility: hidden;
                }
            }

            @media (max-width: 767px) {
                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label {
                    padding:0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label >label::after {
                    visibility: hidden;
                }
            }

            @media (max-width: 991px) {
                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label {
                    padding:0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label >label::after {
                    visibility: hidden;
                }
            }

            @media (max-width: 1199px) {
                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label {
                    padding:0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label >label::after {
                    visibility: hidden;
                }
            }

            :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-row {
                flex-direction: column;
            }

            :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label>label {
                height: auto;
            }

            :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-control {
                width: 100%;
            }

            :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label,:where(.css-1588u1j).ant-col-24.ant-form-item-label,:where(.css-1588u1j).ant-col-xl-24.ant-form-item-label {
                padding: 0 0 8px;
                margin: 0;
                white-space: initial;
                text-align: start;
            }

            :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label >label,:where(.css-1588u1j).ant-col-24.ant-form-item-label >label,:where(.css-1588u1j).ant-col-xl-24.ant-form-item-label >label {
                margin: 0;
            }

            :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label >label::after,:where(.css-1588u1j).ant-col-24.ant-form-item-label >label::after,:where(.css-1588u1j).ant-col-xl-24.ant-form-item-label >label::after {
                visibility: hidden;
            }

            @media (max-width: 575px) {
                :where(.css-1588u1j).ant-form-item .ant-form-item-label {
                    padding:0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form-item .ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form-item .ant-form-item-label >label::after {
                    visibility: hidden;
                }

                :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item {
                    flex-wrap: wrap;
                }

                :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-label:not([class*=" ant-col-xs"]),:where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-control:not([class*=" ant-col-xs"]) {
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                :where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label {
                    padding: 0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label >label::after {
                    visibility: hidden;
                }
            }

            @media (max-width: 767px) {
                :where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label {
                    padding:0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label >label::after {
                    visibility: hidden;
                }
            }

            @media (max-width: 991px) {
                :where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label {
                    padding:0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label >label::after {
                    visibility: hidden;
                }
            }

            @media (max-width: 1199px) {
                :where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label {
                    padding:0 0 8px;
                    margin: 0;
                    white-space: initial;
                    text-align: start;
                }

                :where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label >label {
                    margin: 0;
                }

                :where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label >label::after {
                    visibility: hidden;
                }
            }

            :where(.css-1588u1j).ant-form .ant-motion-collapse-legacy {
                overflow: hidden;
            }

            :where(.css-1588u1j).ant-form .ant-motion-collapse-legacy-active {
                transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1)!important;
            }

            :where(.css-1588u1j).ant-form .ant-motion-collapse {
                overflow: hidden;
                transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1)!important;
            }

            @keyframes css-1588u1j-antZoomIn {
                0% {
                    transform: scale(0.2);
                    opacity: 0;
                }

                100% {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            :where(.css-1588u1j) a {
                color: #0f0f24;
                text-decoration: none;
                background-color: transparent;
                outline: none;
                cursor: pointer;
                transition: color 0.3s;
                -webkit-text-decoration-skip: objects;
            }

            :where(.css-1588u1j) a:hover {
                color: #2d2e3d;
            }

            :where(.css-1588u1j) a:active {
                color: #000000;
            }

            :where(.css-1588u1j) a:active,:where(.css-1588u1j) a:hover {
                text-decoration: none;
                outline: 0;
            }

            :where(.css-1588u1j) a:focus {
                text-decoration: none;
                outline: 0;
            }

            :where(.css-1588u1j) a[disabled] {
                color: rgba(0, 0, 0, 0.25);
                cursor: not-allowed;
            }

            :where(.css-1588u1j).ant-layout {
                font-family: var(--font-noto-sans);
                font-size: 14px;
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-layout::before,:where(.css-1588u1j).ant-layout::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-layout [class^="ant-layout"],:where(.css-1588u1j).ant-layout [class*=" ant-layout"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-layout [class^="ant-layout"]::before,:where(.css-1588u1j).ant-layout [class*=" ant-layout"]::before,:where(.css-1588u1j).ant-layout [class^="ant-layout"]::after,:where(.css-1588u1j).ant-layout [class*=" ant-layout"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-layout {
                display: flex;
                flex: auto;
                flex-direction: column;
                min-height: 0;
                background: #f5f5f5;
            }

            :where(.css-1588u1j).ant-layout,:where(.css-1588u1j).ant-layout * {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-layout.ant-layout-has-sider {
                flex-direction: row;
            }

            :where(.css-1588u1j).ant-layout.ant-layout-has-sider >.ant-layout,:where(.css-1588u1j).ant-layout.ant-layout-has-sider >.ant-layout-content {
                width: 0;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-header,:where(.css-1588u1j).ant-layout.ant-layout-footer {
                flex: 0 0 auto;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider {
                position: relative;
                min-width: 0;
                background: #001529;
                transition: all 0.2s,background 0s;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-children {
                height: 100%;
                margin-top: -0.1px;
                padding-top: 0.1px;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-children .ant-menu.ant-menu-inline-collapsed {
                width: auto;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-has-trigger {
                padding-bottom: 48px;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-right {
                order: 1;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-trigger {
                position: fixed;
                bottom: 0;
                z-index: 1;
                height: 48px;
                color: #fff;
                line-height: 48px;
                text-align: center;
                background: #002140;
                cursor: pointer;
                transition: all 0.2s;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width >* {
                overflow: hidden;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width-trigger {
                position: absolute;
                top: 64px;
                inset-inline-end: -40px;
                z-index: 1;
                width: 40px;
                height: 40px;
                color: #fff;
                font-size: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #001529;
                border-start-start-radius: 0;
                border-start-end-radius: 6px;
                border-end-end-radius: 6px;
                border-end-start-radius: 0;
                cursor: pointer;
                transition: background 0.3s ease;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width-trigger::after {
                position: absolute;
                inset: 0;
                background: transparent;
                transition: all 0.3s;
                content: "";
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width-trigger:hover::after {
                background: rgba(255, 255, 255, 0.2);
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width-trigger-right {
                inset-inline-start: -40px;
                border-start-start-radius: 6px;
                border-start-end-radius: 0;
                border-end-end-radius: 0;
                border-end-start-radius: 6px;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-light {
                background: #ffffff;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-light .ant-layout-sider-trigger {
                color: rgba(0, 0, 0, 0.88);
                background: #ffffff;
            }

            :where(.css-1588u1j).ant-layout .ant-layout-sider-light .ant-layout-sider-zero-width-trigger {
                color: rgba(0, 0, 0, 0.88);
                background: #ffffff;
                border: 1px solid #f5f5f5;
                border-inline-start:0;}

            :where(.css-1588u1j).ant-layout-rtl {
                direction: rtl;
            }

            :where(.css-1588u1j).ant-layout-header {
                height: 64px;
                padding: 0 50px;
                color: rgba(0, 0, 0, 0.88);
                line-height: 64px;
                background: #001529;
            }

            :where(.css-1588u1j).ant-layout-header .ant-menu {
                line-height: inherit;
            }

            :where(.css-1588u1j).ant-layout-footer {
                padding: 24px 50px;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
                background: #f5f5f5;
            }

            :where(.css-1588u1j).ant-layout-content {
                flex: auto;
                color: rgba(0, 0, 0, 0.88);
                min-height: 0;
            }

            :where(.css-1588u1j).ant-btn {
                font-family: var(--font-noto-sans);
                font-size: 14px;
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-btn::before,:where(.css-1588u1j).ant-btn::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-btn [class^="ant-btn"],:where(.css-1588u1j).ant-btn [class*=" ant-btn"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-btn [class^="ant-btn"]::before,:where(.css-1588u1j).ant-btn [class*=" ant-btn"]::before,:where(.css-1588u1j).ant-btn [class^="ant-btn"]::after,:where(.css-1588u1j).ant-btn [class*=" ant-btn"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-btn {
                outline: none;
                position: relative;
                display: inline-flex;
                gap: 8px;
                align-items: center;
                justify-content: center;
                font-weight: 400;
                white-space: nowrap;
                text-align: center;
                background-image: none;
                background: transparent;
                border: 1px solid transparent;
                cursor: pointer;
                transition: all 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
                user-select: none;
                touch-action: manipulation;
                color: rgba(0, 0, 0, 0.88);
            }

            :where(.css-1588u1j).ant-btn:disabled>* {
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-btn >span {
                display: inline-block;
            }

            :where(.css-1588u1j).ant-btn .ant-btn-icon {
                line-height: 1;
            }

            :where(.css-1588u1j).ant-btn >a {
                color: currentColor;
            }

            :where(.css-1588u1j).ant-btn:not(:disabled):focus-visible {
                outline: 4px solid #85868f;
                outline-offset: 1px;
                transition: outline-offset 0s,outline 0s;
            }

            :where(.css-1588u1j).ant-btn.ant-btn-two-chinese-chars::first-letter {
                letter-spacing: 0.34em;
            }

            :where(.css-1588u1j).ant-btn.ant-btn-two-chinese-chars>*:not(.anticon) {
                margin-inline-end:-0.34em;letter-spacing: 0.34em;
            }

            :where(.css-1588u1j).ant-btn-icon-end {
                flex-direction: row-reverse;
            }

            :where(.css-1588u1j).ant-btn {
                font-size: 14px;
                line-height: 1.5714285714285714;
                height: 32px;
                padding: 4px 15px;
                border-radius: 4px;
            }

            :where(.css-1588u1j).ant-btn.ant-btn-icon-only {
                width: 32px;
                padding-inline:0;}

            :where(.css-1588u1j).ant-btn.ant-btn-icon-only.ant-btn-compact-item {
                flex: none;
            }

            :where(.css-1588u1j).ant-btn.ant-btn-icon-only.ant-btn-round {
                width: auto;
            }

            :where(.css-1588u1j).ant-btn.ant-btn-icon-only .anticon {
                font-size: 16px;
            }

            :where(.css-1588u1j).ant-btn.ant-btn-loading {
                opacity: 0.65;
                cursor: default;
            }

            :where(.css-1588u1j).ant-btn .ant-btn-loading-icon {
                transition: width 0.3s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
            }

            :where(.css-1588u1j).ant-btn.ant-btn-circle.ant-btn {
                min-width: 32px;
                padding-inline-start:0;padding-inline-end:0;border-radius: 50%;
            }

            :where(.css-1588u1j).ant-btn.ant-btn-round.ant-btn {
                border-radius: 32px;
                padding-inline-start:16px;padding-inline-end:16px;}

            :where(.css-1588u1j).ant-btn-sm {
                font-size: 14px;
                line-height: 1.5714285714285714;
                height: 24px;
                padding: 0px 7px;
                border-radius: 4px;
            }

            :where(.css-1588u1j).ant-btn-sm.ant-btn-icon-only {
                width: 24px;
                padding-inline:0;}

            :where(.css-1588u1j).ant-btn-sm.ant-btn-icon-only.ant-btn-compact-item {
                flex: none;
            }

            :where(.css-1588u1j).ant-btn-sm.ant-btn-icon-only.ant-btn-round {
                width: auto;
            }

            :where(.css-1588u1j).ant-btn-sm.ant-btn-icon-only .anticon {
                font-size: 14px;
            }

            :where(.css-1588u1j).ant-btn-sm.ant-btn-loading {
                opacity: 0.65;
                cursor: default;
            }

            :where(.css-1588u1j).ant-btn-sm .ant-btn-loading-icon {
                transition: width 0.3s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
            }

            :where(.css-1588u1j).ant-btn.ant-btn-circle.ant-btn-sm {
                min-width: 24px;
                padding-inline-start:0;padding-inline-end:0;border-radius: 50%;
            }

            :where(.css-1588u1j).ant-btn.ant-btn-round.ant-btn-sm {
                border-radius: 24px;
                padding-inline-start:12px;padding-inline-end:12px;}

            :where(.css-1588u1j).ant-btn-lg {
                font-size: 16px;
                line-height: 1.5;
                height: 40px;
                padding: 7px 15px;
                border-radius: 8px;
            }

            :where(.css-1588u1j).ant-btn-lg.ant-btn-icon-only {
                width: 40px;
                padding-inline:0;}

            :where(.css-1588u1j).ant-btn-lg.ant-btn-icon-only.ant-btn-compact-item {
                flex: none;
            }

            :where(.css-1588u1j).ant-btn-lg.ant-btn-icon-only.ant-btn-round {
                width: auto;
            }

            :where(.css-1588u1j).ant-btn-lg.ant-btn-icon-only .anticon {
                font-size: 18px;
            }

            :where(.css-1588u1j).ant-btn-lg.ant-btn-loading {
                opacity: 0.65;
                cursor: default;
            }

            :where(.css-1588u1j).ant-btn-lg .ant-btn-loading-icon {
                transition: width 0.3s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
            }

            :where(.css-1588u1j).ant-btn.ant-btn-circle.ant-btn-lg {
                min-width: 40px;
                padding-inline-start:0;padding-inline-end:0;border-radius: 50%;
            }

            :where(.css-1588u1j).ant-btn.ant-btn-round.ant-btn-lg {
                border-radius: 40px;
                padding-inline-start:20px;padding-inline-end:20px;}

            :where(.css-1588u1j).ant-btn.ant-btn-block {
                width: 100%;
            }

            :where(.css-1588u1j).ant-btn-default {
                background: #ffffff;
                border-color: #d9d9d9;
                color: rgba(0, 0, 0, 0.88);
                box-shadow: 0 2px 0 rgba(0, 0, 0, 0.02);
            }

            :where(.css-1588u1j).ant-btn-default:disabled,:where(.css-1588u1j).ant-btn-default.ant-btn-disabled {
                cursor: not-allowed;
                border-color: #d9d9d9;
                color: rgba(0, 0, 0, 0.25);
                background: rgba(0, 0, 0, 0.04);
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-default:not(:disabled):not(.ant-btn-disabled):hover {
                color: #484b75;
                border-color: #484b75;
                background: #ffffff;
            }

            :where(.css-1588u1j).ant-btn-default:not(:disabled):not(.ant-btn-disabled):active {
                color: #1b1b42;
                border-color: #1b1b42;
                background: #ffffff;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-background-ghost {
                color: #ffffff;
                background: transparent;
                border-color: #ffffff;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-background-ghost:disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
                border-color: #d9d9d9;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous {
                color: #ff4d4f;
                border-color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                color: #ff7875;
                border-color: #ffa39e;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                color: #d9363e;
                border-color: #d9363e;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-background-ghost {
                color: #ff4d4f;
                background: transparent;
                border-color: #ff4d4f;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-background-ghost:disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
                border-color: #d9d9d9;
            }

            :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous:disabled,:where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-disabled {
                cursor: not-allowed;
                border-color: #d9d9d9;
                color: rgba(0, 0, 0, 0.25);
                background: rgba(0, 0, 0, 0.04);
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-primary {
                color: #fff;
                background: #2f3268;
                box-shadow: 0 2px 0 transparent;
            }

            :where(.css-1588u1j).ant-btn-primary:disabled,:where(.css-1588u1j).ant-btn-primary.ant-btn-disabled {
                cursor: not-allowed;
                border-color: #d9d9d9;
                color: rgba(0, 0, 0, 0.25);
                background: rgba(0, 0, 0, 0.04);
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-primary:not(:disabled):not(.ant-btn-disabled):hover {
                color: #fff;
                background: #484b75;
            }

            :where(.css-1588u1j).ant-btn-primary:not(:disabled):not(.ant-btn-disabled):active {
                color: #fff;
                background: #1b1b42;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-background-ghost {
                color: #2f3268;
                background: transparent;
                border-color: #2f3268;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                background: transparent;
                color: #484b75;
                border-color: #484b75;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                background: transparent;
                color: #1b1b42;
                border-color: #1b1b42;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-background-ghost:disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
                border-color: #d9d9d9;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous {
                background: #ff4d4f;
                box-shadow: 0 2px 0 rgba(255, 38, 5, 0.06);
                color: #fff;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                background: #ff7875;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                background: #d9363e;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-background-ghost {
                color: #ff4d4f;
                background: transparent;
                border-color: #ff4d4f;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                background: transparent;
                color: #ff7875;
                border-color: #ff7875;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                background: transparent;
                color: #d9363e;
                border-color: #d9363e;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-background-ghost:disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
                border-color: #d9d9d9;
            }

            :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous:disabled,:where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-disabled {
                cursor: not-allowed;
                border-color: #d9d9d9;
                color: rgba(0, 0, 0, 0.25);
                background: rgba(0, 0, 0, 0.04);
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-dashed {
                background: #ffffff;
                border-color: #d9d9d9;
                color: rgba(0, 0, 0, 0.88);
                box-shadow: 0 2px 0 rgba(0, 0, 0, 0.02);
                border-style: dashed;
            }

            :where(.css-1588u1j).ant-btn-dashed:disabled,:where(.css-1588u1j).ant-btn-dashed.ant-btn-disabled {
                cursor: not-allowed;
                border-color: #d9d9d9;
                color: rgba(0, 0, 0, 0.25);
                background: rgba(0, 0, 0, 0.04);
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-dashed:not(:disabled):not(.ant-btn-disabled):hover {
                color: #484b75;
                border-color: #484b75;
                background: #ffffff;
            }

            :where(.css-1588u1j).ant-btn-dashed:not(:disabled):not(.ant-btn-disabled):active {
                color: #1b1b42;
                border-color: #1b1b42;
                background: #ffffff;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-background-ghost {
                color: #ffffff;
                background: transparent;
                border-color: #ffffff;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-background-ghost:disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
                border-color: #d9d9d9;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous {
                color: #ff4d4f;
                border-color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                color: #ff7875;
                border-color: #ffa39e;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                color: #d9363e;
                border-color: #d9363e;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-background-ghost {
                color: #ff4d4f;
                background: transparent;
                border-color: #ff4d4f;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-background-ghost:disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
                border-color: #d9d9d9;
            }

            :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous:disabled,:where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-disabled {
                cursor: not-allowed;
                border-color: #d9d9d9;
                color: rgba(0, 0, 0, 0.25);
                background: rgba(0, 0, 0, 0.04);
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-link {
                color: #0f0f24;
            }

            :where(.css-1588u1j).ant-btn-link:not(:disabled):not(.ant-btn-disabled):hover {
                color: #2d2e3d;
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-link:not(:disabled):not(.ant-btn-disabled):active {
                color: #000000;
            }

            :where(.css-1588u1j).ant-btn-link:disabled,:where(.css-1588u1j).ant-btn-link.ant-btn-disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
            }

            :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                color: #ff7875;
            }

            :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                color: #d9363e;
            }

            :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous:disabled,:where(.css-1588u1j).ant-btn-link.ant-btn-dangerous.ant-btn-disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
            }

            :where(.css-1588u1j).ant-btn-text:not(:disabled):not(.ant-btn-disabled):hover {
                color: rgba(0, 0, 0, 0.88);
                background: rgba(0, 0, 0, 0.06);
            }

            :where(.css-1588u1j).ant-btn-text:not(:disabled):not(.ant-btn-disabled):active {
                color: rgba(0, 0, 0, 0.88);
                background: rgba(0, 0, 0, 0.15);
            }

            :where(.css-1588u1j).ant-btn-text:disabled,:where(.css-1588u1j).ant-btn-text.ant-btn-disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
            }

            :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous:disabled,:where(.css-1588u1j).ant-btn-text.ant-btn-dangerous.ant-btn-disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
            }

            :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):hover {
                color: #ff7875;
                background: #fff2f0;
            }

            :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous:not(:disabled):not(.ant-btn-disabled):active {
                color: #ff7875;
                background: #ffccc7;
            }

            :where(.css-1588u1j).ant-btn-ghost.ant-btn-background-ghost {
                color: #ffffff;
                background: transparent;
                border-color: #ffffff;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-btn-ghost.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):hover {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-ghost.ant-btn-background-ghost:not(:disabled):not(.ant-btn-disabled):active {
                background: transparent;
            }

            :where(.css-1588u1j).ant-btn-ghost.ant-btn-background-ghost:disabled {
                cursor: not-allowed;
                color: rgba(0, 0, 0, 0.25);
                border-color: #d9d9d9;
            }

            :where(.css-1588u1j).ant-btn-group {
                position: relative;
                display: inline-flex;
            }

            :where(.css-1588u1j).ant-btn-group >span:not(:last-child),:where(.css-1588u1j).ant-btn-group >.ant-btn:not(:last-child),:where(.css-1588u1j).ant-btn-group >span:not(:last-child)>.ant-btn,:where(.css-1588u1j).ant-btn-group >.ant-btn:not(:last-child)>.ant-btn {
                border-start-end-radius: 0;
                border-end-end-radius: 0;
            }

            :where(.css-1588u1j).ant-btn-group >span:not(:first-child),:where(.css-1588u1j).ant-btn-group >.ant-btn:not(:first-child) {
                margin-inline-start:-1px;}

            :where(.css-1588u1j).ant-btn-group >span:not(:first-child),:where(.css-1588u1j).ant-btn-group >.ant-btn:not(:first-child),:where(.css-1588u1j).ant-btn-group >span:not(:first-child)>.ant-btn,:where(.css-1588u1j).ant-btn-group >.ant-btn:not(:first-child)>.ant-btn {
                border-start-start-radius: 0;
                border-end-start-radius: 0;
            }

            :where(.css-1588u1j).ant-btn-group .ant-btn {
                position: relative;
                z-index: 1;
            }

            :where(.css-1588u1j).ant-btn-group .ant-btn:hover,:where(.css-1588u1j).ant-btn-group .ant-btn:focus,:where(.css-1588u1j).ant-btn-group .ant-btn:active {
                z-index: 2;
            }

            :where(.css-1588u1j).ant-btn-group .ant-btn[disabled] {
                z-index: 0;
            }

            :where(.css-1588u1j).ant-btn-group .ant-btn-icon-only {
                font-size: 14px;
            }

            :where(.css-1588u1j).ant-btn-group >span:not(:last-child):not(:disabled),:where(.css-1588u1j).ant-btn-group >.ant-btn-primary:not(:last-child):not(:disabled),:where(.css-1588u1j).ant-btn-group >span:not(:last-child)>.ant-btn-primary:not(:disabled),:where(.css-1588u1j).ant-btn-group >.ant-btn-primary:not(:last-child)>.ant-btn-primary:not(:disabled) {
                border-inline-end-color:#484b75;}

            :where(.css-1588u1j).ant-btn-group >span:not(:first-child):not(:disabled),:where(.css-1588u1j).ant-btn-group >.ant-btn-primary:not(:first-child):not(:disabled),:where(.css-1588u1j).ant-btn-group >span:not(:first-child)>.ant-btn-primary:not(:disabled),:where(.css-1588u1j).ant-btn-group >.ant-btn-primary:not(:first-child)>.ant-btn-primary:not(:disabled) {
                border-inline-start-color:#484b75;}

            :where(.css-1588u1j).ant-btn-group >span:not(:last-child):not(:disabled),:where(.css-1588u1j).ant-btn-group >.ant-btn-danger:not(:last-child):not(:disabled),:where(.css-1588u1j).ant-btn-group >span:not(:last-child)>.ant-btn-danger:not(:disabled),:where(.css-1588u1j).ant-btn-group >.ant-btn-danger:not(:last-child)>.ant-btn-danger:not(:disabled) {
                border-inline-end-color:#ff7875;}

            :where(.css-1588u1j).ant-btn-group >span:not(:first-child):not(:disabled),:where(.css-1588u1j).ant-btn-group >.ant-btn-danger:not(:first-child):not(:disabled),:where(.css-1588u1j).ant-btn-group >span:not(:first-child)>.ant-btn-danger:not(:disabled),:where(.css-1588u1j).ant-btn-group >.ant-btn-danger:not(:first-child)>.ant-btn-danger:not(:disabled) {
                border-inline-start-color:#ff7875;}

            :where(.css-1588u1j).ant-wave {
                font-family: var(--font-noto-sans);
                font-size: 14px;
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-wave::before,:where(.css-1588u1j).ant-wave::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-wave [class^="ant-wave"],:where(.css-1588u1j).ant-wave [class*=" ant-wave"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-wave [class^="ant-wave"]::before,:where(.css-1588u1j).ant-wave [class*=" ant-wave"]::before,:where(.css-1588u1j).ant-wave [class^="ant-wave"]::after,:where(.css-1588u1j).ant-wave [class*=" ant-wave"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-wave {
                position: absolute;
                background: transparent;
                pointer-events: none;
                box-sizing: border-box;
                color: var(--wave-color, #2f3268);
                box-shadow: 0 0 0 0 currentcolor;
                opacity: 0.2;
            }

            :where(.css-1588u1j).ant-wave.wave-motion-appear {
                transition: box-shadow 0.4s cubic-bezier(0.08, 0.82, 0.17, 1),opacity 2s cubic-bezier(0.08, 0.82, 0.17, 1);
            }

            :where(.css-1588u1j).ant-wave.wave-motion-appear-active {
                box-shadow: 0 0 0 6px currentcolor;
                opacity: 0;
            }

            :where(.css-1588u1j).ant-wave.wave-motion-appear.wave-quick {
                transition: box-shadow 0.3s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
            }

            :where(.css-1588u1j).ant-drawer {
                font-family: var(--font-noto-sans);
                font-size: 14px;
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-drawer::before,:where(.css-1588u1j).ant-drawer::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-drawer [class^="ant-drawer"],:where(.css-1588u1j).ant-drawer [class*=" ant-drawer"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-drawer [class^="ant-drawer"]::before,:where(.css-1588u1j).ant-drawer [class*=" ant-drawer"]::before,:where(.css-1588u1j).ant-drawer [class^="ant-drawer"]::after,:where(.css-1588u1j).ant-drawer [class*=" ant-drawer"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-drawer {
                position: fixed;
                inset: 0;
                z-index: 1000;
                pointer-events: none;
                color: rgba(0, 0, 0, 0.88);
            }

            :where(.css-1588u1j).ant-drawer-pure {
                position: relative;
                background: #ffffff;
                display: flex;
                flex-direction: column;
            }

            :where(.css-1588u1j).ant-drawer-pure.ant-drawer-left {
                box-shadow: 6px 0 16px 0 rgba(0, 0, 0, 0.08),3px 0 6px -4px rgba(0, 0, 0, 0.12),9px 0 28px 8px rgba(0, 0, 0, 0.05);
            }

            :where(.css-1588u1j).ant-drawer-pure.ant-drawer-right {
                box-shadow: -6px 0 16px 0 rgba(0, 0, 0, 0.08),-3px 0 6px -4px rgba(0, 0, 0, 0.12),-9px 0 28px 8px rgba(0, 0, 0, 0.05);
            }

            :where(.css-1588u1j).ant-drawer-pure.ant-drawer-top {
                box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08),0 3px 6px -4px rgba(0, 0, 0, 0.12),0 9px 28px 8px rgba(0, 0, 0, 0.05);
            }

            :where(.css-1588u1j).ant-drawer-pure.ant-drawer-bottom {
                box-shadow: 0 -6px 16px 0 rgba(0, 0, 0, 0.08),0 -3px 6px -4px rgba(0, 0, 0, 0.12),0 -9px 28px 8px rgba(0, 0, 0, 0.05);
            }

            :where(.css-1588u1j).ant-drawer-inline {
                position: absolute;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-mask {
                position: absolute;
                inset: 0;
                z-index: 1000;
                background: rgba(0, 0, 0, 0.45);
                pointer-events: auto;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-content-wrapper {
                position: absolute;
                z-index: 1000;
                max-width: 100vw;
                transition: all 0.3s;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-content-wrapper-hidden {
                display: none;
            }

            :where(.css-1588u1j).ant-drawer-left>.ant-drawer-content-wrapper {
                top: 0;
                bottom: 0;
                left: 0;
                box-shadow: 6px 0 16px 0 rgba(0, 0, 0, 0.08),3px 0 6px -4px rgba(0, 0, 0, 0.12),9px 0 28px 8px rgba(0, 0, 0, 0.05);
            }

            :where(.css-1588u1j).ant-drawer-right>.ant-drawer-content-wrapper {
                top: 0;
                right: 0;
                bottom: 0;
                box-shadow: -6px 0 16px 0 rgba(0, 0, 0, 0.08),-3px 0 6px -4px rgba(0, 0, 0, 0.12),-9px 0 28px 8px rgba(0, 0, 0, 0.05);
            }

            :where(.css-1588u1j).ant-drawer-top>.ant-drawer-content-wrapper {
                top: 0;
                inset-inline: 0;
                box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08),0 3px 6px -4px rgba(0, 0, 0, 0.12),0 9px 28px 8px rgba(0, 0, 0, 0.05);
            }

            :where(.css-1588u1j).ant-drawer-bottom>.ant-drawer-content-wrapper {
                bottom: 0;
                inset-inline: 0;
                box-shadow: 0 -6px 16px 0 rgba(0, 0, 0, 0.08),0 -3px 6px -4px rgba(0, 0, 0, 0.12),0 -9px 28px 8px rgba(0, 0, 0, 0.05);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-content {
                display: flex;
                flex-direction: column;
                width: 100%;
                height: 100%;
                overflow: auto;
                background: #ffffff;
                pointer-events: auto;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-header {
                display: flex;
                flex: 0;
                align-items: center;
                padding: 16px 24px;
                font-size: 16px;
                line-height: 1.5;
                border-bottom: 1px solid rgba(5, 5, 5, 0.06);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-header-title {
                display: flex;
                flex: 1;
                align-items: center;
                min-width: 0;
                min-height: 0;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-extra {
                flex: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-close {
                display: inline-flex;
                width: 24px;
                height: 24px;
                border-radius: 4px;
                justify-content: center;
                align-items: center;
                margin-inline-end:8px;color: rgba(0, 0, 0, 0.45);
                font-weight: 600;
                font-size: 16px;
                font-style: normal;
                line-height: 1;
                text-align: center;
                text-transform: none;
                text-decoration: none;
                background: transparent;
                border: 0;
                cursor: pointer;
                transition: all 0.2s;
                text-rendering: auto;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-close:hover {
                color: rgba(0, 0, 0, 0.88);
                background-color: rgba(0, 0, 0, 0.06);
                text-decoration: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-close:active {
                background-color: rgba(0, 0, 0, 0.15);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-close:focus-visible {
                outline: 4px solid #85868f;
                outline-offset: 1px;
                transition: outline-offset 0s,outline 0s;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-title {
                flex: 1;
                margin: 0;
                font-weight: 600;
                font-size: 16px;
                line-height: 1.5;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-body {
                flex: 1;
                min-width: 0;
                min-height: 0;
                padding: 24px;
                overflow: auto;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-body .ant-drawer-body-skeleton {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-footer {
                flex-shrink: 0;
                padding: 8px 16px;
                border-top: 1px solid rgba(5, 5, 5, 0.06);
            }

            :where(.css-1588u1j).ant-drawer-rtl {
                direction: rtl;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter-start,:where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear-start,:where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave-start {
                transition: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear-active,:where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave-active {
                transition: all 0.3s;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter,:where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear {
                opacity: 0;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear-active {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave-active {
                opacity: 0;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-start,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-start,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-start {
                transition: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-active {
                transition: all 0.3s;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear {
                opacity: 0.7;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-active {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-active {
                opacity: 0.7;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear {
                transform: translateX(-100%);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-active {
                transform: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave {
                transform: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-active {
                transform: translateX(-100%);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-start,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-start,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-start {
                transition: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-active {
                transition: all 0.3s;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear {
                opacity: 0.7;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-active {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-active {
                opacity: 0.7;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear {
                transform: translateX(100%);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-active {
                transform: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave {
                transform: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-active {
                transform: translateX(100%);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-start,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-start,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-start {
                transition: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-active {
                transition: all 0.3s;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear {
                opacity: 0.7;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-active {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-active {
                opacity: 0.7;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear {
                transform: translateY(-100%);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-active {
                transform: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave {
                transform: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-active {
                transform: translateY(-100%);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-start,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-start,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-start {
                transition: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-active {
                transition: all 0.3s;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear {
                opacity: 0.7;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-active {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-active {
                opacity: 0.7;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear {
                transform: translateY(100%);
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-active,:where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-active {
                transform: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave {
                transform: none;
            }

            :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-active {
                transform: translateY(100%);
            }

            :where(.css-1588u1j).ant-dropdown {
                position: absolute;
                top: -9999px;
                left: -9999px;
                z-index: 1050;
                display: block;
            }

            :where(.css-1588u1j).ant-dropdown::before {
                position: absolute;
                inset-block: -4px;
                z-index: -9999;
                opacity: 0.0001;
                content: "";
            }

            :where(.css-1588u1j).ant-dropdown-trigger.ant-btn>.anticon-down,:where(.css-1588u1j).ant-dropdown-trigger.ant-btn>.ant-btn-icon>.anticon-down {
                font-size: 12px;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-wrap {
                position: relative;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-wrap .ant-btn>.anticon-down {
                font-size: 12px;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-wrap .anticon-down::before {
                transition: transform 0.2s;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-wrap-open .anticon-down::before {
                transform: rotate(180deg);
            }

            :where(.css-1588u1j).ant-dropdown-hidden,:where(.css-1588u1j).ant-dropdown-menu-hidden,:where(.css-1588u1j).ant-dropdown-menu-submenu-hidden {
                display: none;
            }

            :where(.css-1588u1j).ant-dropdown.ant-slide-down-enter.ant-slide-down-enter-active.ant-dropdown-placement-bottomLeft,:where(.css-1588u1j).ant-dropdown.ant-slide-down-appear.ant-slide-down-appear-active.ant-dropdown-placement-bottomLeft,:where(.css-1588u1j).ant-dropdown.ant-slide-down-enter.ant-slide-down-enter-active.ant-dropdown-placement-bottom,:where(.css-1588u1j).ant-dropdown.ant-slide-down-appear.ant-slide-down-appear-active.ant-dropdown-placement-bottom,:where(.css-1588u1j).ant-dropdown.ant-slide-down-enter.ant-slide-down-enter-active.ant-dropdown-placement-bottomRight,:where(.css-1588u1j).ant-dropdown.ant-slide-down-appear.ant-slide-down-appear-active.ant-dropdown-placement-bottomRight {
                animation-name: css-1588u1j-antSlideUpIn;
            }

            :where(.css-1588u1j).ant-dropdown.ant-slide-up-enter.ant-slide-up-enter-active.ant-dropdown-placement-topLeft,:where(.css-1588u1j).ant-dropdown.ant-slide-up-appear.ant-slide-up-appear-active.ant-dropdown-placement-topLeft,:where(.css-1588u1j).ant-dropdown.ant-slide-up-enter.ant-slide-up-enter-active.ant-dropdown-placement-top,:where(.css-1588u1j).ant-dropdown.ant-slide-up-appear.ant-slide-up-appear-active.ant-dropdown-placement-top,:where(.css-1588u1j).ant-dropdown.ant-slide-up-enter.ant-slide-up-enter-active.ant-dropdown-placement-topRight,:where(.css-1588u1j).ant-dropdown.ant-slide-up-appear.ant-slide-up-appear-active.ant-dropdown-placement-topRight {
                animation-name: css-1588u1j-antSlideDownIn;
            }

            :where(.css-1588u1j).ant-dropdown.ant-slide-down-leave.ant-slide-down-leave-active.ant-dropdown-placement-bottomLeft,:where(.css-1588u1j).ant-dropdown.ant-slide-down-leave.ant-slide-down-leave-active.ant-dropdown-placement-bottom,:where(.css-1588u1j).ant-dropdown.ant-slide-down-leave.ant-slide-down-leave-active.ant-dropdown-placement-bottomRight {
                animation-name: css-1588u1j-antSlideUpOut;
            }

            :where(.css-1588u1j).ant-dropdown.ant-slide-up-leave.ant-slide-up-leave-active.ant-dropdown-placement-topLeft,:where(.css-1588u1j).ant-dropdown.ant-slide-up-leave.ant-slide-up-leave-active.ant-dropdown-placement-top,:where(.css-1588u1j).ant-dropdown.ant-slide-up-leave.ant-slide-up-leave-active.ant-dropdown-placement-topRight {
                animation-name: css-1588u1j-antSlideDownOut;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-arrow {
                position: absolute;
                z-index: 1;
                display: block;
                pointer-events: none;
                width: 16px;
                height: 16px;
                overflow: hidden;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-arrow::before {
                position: absolute;
                bottom: 0;
                inset-inline-start: 0;
                width: 16px;
                height: 8px;
                background: #ffffff;
                clip-path: polygon(1.6568542494923806px 100%, 50% 1.6568542494923806px, 14.34314575050762px 100%, 1.6568542494923806px 100%);
                clip-path: path('M 0 8 A 4 4 0 0 0 2.82842712474619 6.82842712474619 L 6.585786437626905 3.0710678118654755 A 2 2 0 0 1 9.414213562373096 3.0710678118654755 L 13.17157287525381 6.82842712474619 A 4 4 0 0 0 16 8 Z');
                content: "";
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-arrow::after {
                content: "";
                position: absolute;
                width: 8.970562748477143px;
                height: 8.970562748477143px;
                bottom: 0;
                inset-inline: 0;
                margin: auto;
                border-radius: 0 0 2px 0;
                transform: translateY(50%) rotate(-135deg);
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.05);
                z-index: 0;
                background: transparent;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-arrow:before {
                background: #ffffff;
            }

            :where(.css-1588u1j).ant-dropdown-placement-top>.ant-dropdown-arrow,:where(.css-1588u1j).ant-dropdown-placement-topLeft>.ant-dropdown-arrow,:where(.css-1588u1j).ant-dropdown-placement-topRight>.ant-dropdown-arrow {
                bottom: 0;
                transform: translateY(100%) rotate(180deg);
            }

            :where(.css-1588u1j).ant-dropdown-placement-top>.ant-dropdown-arrow {
                left: 50%;
                transform: translateX(-50%) translateY(100%) rotate(180deg);
            }

            :where(.css-1588u1j).ant-dropdown-placement-topLeft>.ant-dropdown-arrow {
                left: 12px;
            }

            :where(.css-1588u1j).ant-dropdown-placement-topRight>.ant-dropdown-arrow {
                right: 12px;
            }

            :where(.css-1588u1j).ant-dropdown-placement-bottom>.ant-dropdown-arrow,:where(.css-1588u1j).ant-dropdown-placement-bottomLeft>.ant-dropdown-arrow,:where(.css-1588u1j).ant-dropdown-placement-bottomRight>.ant-dropdown-arrow {
                top: 0;
                transform: translateY(-100%);
            }

            :where(.css-1588u1j).ant-dropdown-placement-bottom>.ant-dropdown-arrow {
                left: 50%;
                transform: translateX(-50%) translateY(-100%);
            }

            :where(.css-1588u1j).ant-dropdown-placement-bottomLeft>.ant-dropdown-arrow {
                left: 12px;
            }

            :where(.css-1588u1j).ant-dropdown-placement-bottomRight>.ant-dropdown-arrow {
                right: 12px;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu {
                position: relative;
                margin: 0;
            }

            :where(.css-1588u1j).ant-dropdown-menu-submenu-popup {
                position: absolute;
                z-index: 1050;
                background: transparent;
                box-shadow: none;
                transform-origin: 0 0;
            }

            :where(.css-1588u1j).ant-dropdown-menu-submenu-popup ul,:where(.css-1588u1j).ant-dropdown-menu-submenu-popup li {
                list-style: none;
                margin: 0;
            }

            :where(.css-1588u1j).ant-dropdown,:where(.css-1588u1j).ant-dropdown-menu-submenu {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
                line-height: 1.5714285714285714;
                list-style: none;
                font-family: var(--font-noto-sans);
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu {
                padding: 4px;
                list-style-type: none;
                background-color: #ffffff;
                background-clip: padding-box;
                border-radius: 8px;
                outline: none;
                box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08),0 3px 6px -4px rgba(0, 0, 0, 0.12),0 9px 28px 8px rgba(0, 0, 0, 0.05);
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu:focus-visible,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu:focus-visible {
                outline: 4px solid #85868f;
                outline-offset: 1px;
                transition: outline-offset 0s,outline 0s;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu:empty,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu:empty {
                padding: 0;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-group-title,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-group-title {
                padding: 5px 12px;
                color: rgba(0, 0, 0, 0.45);
                transition: all 0.2s;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item {
                position: relative;
                display: flex;
                align-items: center;
                white-space: nowrap;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-icon,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-icon {
                min-width: 14px;
                margin-inline-end:8px;font-size: 12px;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-title-content,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-title-content {
                flex: auto;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-title-content >a,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-title-content >a {
                color: inherit;
                transition: all 0.2s;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-title-content >a:hover,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-title-content >a:hover {
                color: inherit;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-title-content >a::after,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-title-content >a::after {
                position: absolute;
                inset: 0;
                content: "";
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title {
                clear: both;
                margin: 0;
                padding: 5px 12px;
                color: rgba(0, 0, 0, 0.88);
                font-weight: normal;
                font-size: 14px;
                line-height: 1.5714285714285714;
                cursor: pointer;
                transition: all 0.2s;
                border-radius: 4px;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item:hover,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item:hover,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title:hover,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title:hover,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-active,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-active,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title-active,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title-active {
                background-color: rgba(0, 0, 0, 0.04);
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item:focus-visible,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item:focus-visible,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title:focus-visible,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title:focus-visible {
                outline: 4px solid #85868f;
                outline-offset: 1px;
                transition: outline-offset 0s,outline 0s;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-selected,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-selected,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title-selected,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title-selected {
                color: #2f3268;
                background-color: #9ea0a8;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-selected:hover,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-selected:hover,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title-selected:hover,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title-selected:hover,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-selected-active,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-selected-active,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title-selected-active,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title-selected-active {
                background-color: #92949c;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-disabled,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-disabled,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title-disabled,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title-disabled {
                color: rgba(0, 0, 0, 0.25);
                cursor: not-allowed;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-disabled:hover,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-disabled:hover,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title-disabled:hover,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title-disabled:hover {
                color: rgba(0, 0, 0, 0.25);
                background-color: #ffffff;
                cursor: not-allowed;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-disabled a,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-disabled a,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title-disabled a,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title-disabled a {
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-divider,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-divider,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title-divider,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title-divider {
                height: 1px;
                margin: 4px 0;
                overflow: hidden;
                line-height: 0;
                background-color: rgba(5, 5, 5, 0.06);
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item .ant-dropdown-menu-submenu-expand-icon,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item .ant-dropdown-menu-submenu-expand-icon,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title .ant-dropdown-menu-submenu-expand-icon,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title .ant-dropdown-menu-submenu-expand-icon {
                position: absolute;
                inset-inline-end: 8px;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item .ant-dropdown-menu-submenu-expand-icon .ant-dropdown-menu-submenu-arrow-icon,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item .ant-dropdown-menu-submenu-expand-icon .ant-dropdown-menu-submenu-arrow-icon,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title .ant-dropdown-menu-submenu-expand-icon .ant-dropdown-menu-submenu-arrow-icon,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title .ant-dropdown-menu-submenu-expand-icon .ant-dropdown-menu-submenu-arrow-icon {
                margin-inline-end:0!important;color: rgba(0, 0, 0, 0.45);
                font-size: 12px;
                font-style: normal;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item-group-list,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item-group-list {
                margin: 0 8px;
                padding: 0;
                list-style: none;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-title,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-title {
                padding-inline-end:24px;}

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-vertical,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-vertical {
                position: relative;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu.ant-dropdown-menu-submenu-disabled .ant-dropdown-menu-submenu-title,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu.ant-dropdown-menu-submenu-disabled .ant-dropdown-menu-submenu-title,:where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu.ant-dropdown-menu-submenu-disabled .ant-dropdown-menu-submenu-title .ant-dropdown-menu-submenu-arrow-icon,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu.ant-dropdown-menu-submenu-disabled .ant-dropdown-menu-submenu-title .ant-dropdown-menu-submenu-arrow-icon {
                color: rgba(0, 0, 0, 0.25);
                background-color: #ffffff;
                cursor: not-allowed;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-submenu-selected .ant-dropdown-menu-submenu-title,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-submenu-selected .ant-dropdown-menu-submenu-title {
                color: #2f3268;
            }

            :where(.css-1588u1j).ant-slide-up-enter,:where(.css-1588u1j).ant-slide-up-appear {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-slide-up-leave {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-slide-up-enter.ant-slide-up-enter-active,:where(.css-1588u1j).ant-slide-up-appear.ant-slide-up-appear-active {
                animation-name: css-1588u1j-antSlideUpIn;
                animation-play-state: running;
            }

            :where(.css-1588u1j).ant-slide-up-leave.ant-slide-up-leave-active {
                animation-name: css-1588u1j-antSlideUpOut;
                animation-play-state: running;
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-slide-up-enter,:where(.css-1588u1j).ant-slide-up-appear {
                transform: scale(0);
                transform-origin: 0% 0%;
                opacity: 0;
                animation-timing-function: cubic-bezier(0.23, 1, 0.32, 1);
            }

            :where(.css-1588u1j).ant-slide-up-enter-prepare,:where(.css-1588u1j).ant-slide-up-appear-prepare {
                transform: scale(1);
            }

            :where(.css-1588u1j).ant-slide-up-leave {
                animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            }

            :where(.css-1588u1j).ant-slide-down-enter,:where(.css-1588u1j).ant-slide-down-appear {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-slide-down-leave {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-slide-down-enter.ant-slide-down-enter-active,:where(.css-1588u1j).ant-slide-down-appear.ant-slide-down-appear-active {
                animation-name: css-1588u1j-antSlideDownIn;
                animation-play-state: running;
            }

            :where(.css-1588u1j).ant-slide-down-leave.ant-slide-down-leave-active {
                animation-name: css-1588u1j-antSlideDownOut;
                animation-play-state: running;
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-slide-down-enter,:where(.css-1588u1j).ant-slide-down-appear {
                transform: scale(0);
                transform-origin: 0% 0%;
                opacity: 0;
                animation-timing-function: cubic-bezier(0.23, 1, 0.32, 1);
            }

            :where(.css-1588u1j).ant-slide-down-enter-prepare,:where(.css-1588u1j).ant-slide-down-appear-prepare {
                transform: scale(1);
            }

            :where(.css-1588u1j).ant-slide-down-leave {
                animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            }

            :where(.css-1588u1j).ant-move-up-enter,:where(.css-1588u1j).ant-move-up-appear {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-move-up-leave {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-move-up-enter.ant-move-up-enter-active,:where(.css-1588u1j).ant-move-up-appear.ant-move-up-appear-active {
                animation-name: css-1588u1j-antMoveUpIn;
                animation-play-state: running;
            }

            :where(.css-1588u1j).ant-move-up-leave.ant-move-up-leave-active {
                animation-name: css-1588u1j-antMoveUpOut;
                animation-play-state: running;
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-move-up-enter,:where(.css-1588u1j).ant-move-up-appear {
                opacity: 0;
                animation-timing-function: cubic-bezier(0.08, 0.82, 0.17, 1);
            }

            :where(.css-1588u1j).ant-move-up-leave {
                animation-timing-function: cubic-bezier(0.78, 0.14, 0.15, 0.86);
            }

            :where(.css-1588u1j).ant-move-down-enter,:where(.css-1588u1j).ant-move-down-appear {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-move-down-leave {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-move-down-enter.ant-move-down-enter-active,:where(.css-1588u1j).ant-move-down-appear.ant-move-down-appear-active {
                animation-name: css-1588u1j-antMoveDownIn;
                animation-play-state: running;
            }

            :where(.css-1588u1j).ant-move-down-leave.ant-move-down-leave-active {
                animation-name: css-1588u1j-antMoveDownOut;
                animation-play-state: running;
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-move-down-enter,:where(.css-1588u1j).ant-move-down-appear {
                opacity: 0;
                animation-timing-function: cubic-bezier(0.08, 0.82, 0.17, 1);
            }

            :where(.css-1588u1j).ant-move-down-leave {
                animation-timing-function: cubic-bezier(0.78, 0.14, 0.15, 0.86);
            }

            :where(.css-1588u1j).ant-zoom-big-enter,:where(.css-1588u1j).ant-zoom-big-appear {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-zoom-big-leave {
                animation-duration: 0.2s;
                animation-fill-mode: both;
                animation-play-state: paused;
            }

            :where(.css-1588u1j).ant-zoom-big-enter.ant-zoom-big-enter-active,:where(.css-1588u1j).ant-zoom-big-appear.ant-zoom-big-appear-active {
                animation-name: css-1588u1j-antZoomBigIn;
                animation-play-state: running;
            }

            :where(.css-1588u1j).ant-zoom-big-leave.ant-zoom-big-leave-active {
                animation-name: css-1588u1j-antZoomBigOut;
                animation-play-state: running;
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-zoom-big-enter,:where(.css-1588u1j).ant-zoom-big-appear {
                transform: scale(0);
                opacity: 0;
                animation-timing-function: cubic-bezier(0.08, 0.82, 0.17, 1);
            }

            :where(.css-1588u1j).ant-zoom-big-enter-prepare,:where(.css-1588u1j).ant-zoom-big-appear-prepare {
                transform: none;
            }

            :where(.css-1588u1j).ant-zoom-big-leave {
                animation-timing-function: cubic-bezier(0.78, 0.14, 0.15, 0.86);
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item.ant-dropdown-menu-item-danger:not(.ant-dropdown-menu-item-disabled),:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item.ant-dropdown-menu-item-danger:not(.ant-dropdown-menu-item-disabled) {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-dropdown .ant-dropdown-menu .ant-dropdown-menu-item.ant-dropdown-menu-item-danger:not(.ant-dropdown-menu-item-disabled):hover,:where(.css-1588u1j).ant-dropdown-menu-submenu .ant-dropdown-menu .ant-dropdown-menu-item.ant-dropdown-menu-item-danger:not(.ant-dropdown-menu-item-disabled):hover {
                color: #fff;
                background-color: #ff4d4f;
            }

            @keyframes css-1588u1j-antSlideUpIn {
                0% {
                    transform: scaleY(0.8);
                    transform-origin: 0% 0%;
                    opacity: 0;
                }

                100% {
                    transform: scaleY(1);
                    transform-origin: 0% 0%;
                    opacity: 1;
                }
            }

            @keyframes css-1588u1j-antSlideDownIn {
                0% {
                    transform: scaleY(0.8);
                    transform-origin: 100% 100%;
                    opacity: 0;
                }

                100% {
                    transform: scaleY(1);
                    transform-origin: 100% 100%;
                    opacity: 1;
                }
            }

            @keyframes css-1588u1j-antSlideUpOut {
                0% {
                    transform: scaleY(1);
                    transform-origin: 0% 0%;
                    opacity: 1;
                }

                100% {
                    transform: scaleY(0.8);
                    transform-origin: 0% 0%;
                    opacity: 0;
                }
            }

            @keyframes css-1588u1j-antSlideDownOut {
                0% {
                    transform: scaleY(1);
                    transform-origin: 100% 100%;
                    opacity: 1;
                }

                100% {
                    transform: scaleY(0.8);
                    transform-origin: 100% 100%;
                    opacity: 0;
                }
            }

            @keyframes css-1588u1j-antMoveUpIn {
                0% {
                    transform: translate3d(0, -100%, 0);
                    transform-origin: 0 0;
                    opacity: 0;
                }

                100% {
                    transform: translate3d(0, 0, 0);
                    transform-origin: 0 0;
                    opacity: 1;
                }
            }

            @keyframes css-1588u1j-antMoveUpOut {
                0% {
                    transform: translate3d(0, 0, 0);
                    transform-origin: 0 0;
                    opacity: 1;
                }

                100% {
                    transform: translate3d(0, -100%, 0);
                    transform-origin: 0 0;
                    opacity: 0;
                }
            }

            @keyframes css-1588u1j-antMoveDownIn {
                0% {
                    transform: translate3d(0, 100%, 0);
                    transform-origin: 0 0;
                    opacity: 0;
                }

                100% {
                    transform: translate3d(0, 0, 0);
                    transform-origin: 0 0;
                    opacity: 1;
                }
            }

            @keyframes css-1588u1j-antMoveDownOut {
                0% {
                    transform: translate3d(0, 0, 0);
                    transform-origin: 0 0;
                    opacity: 1;
                }

                100% {
                    transform: translate3d(0, 100%, 0);
                    transform-origin: 0 0;
                    opacity: 0;
                }
            }

            @keyframes css-1588u1j-antZoomBigIn {
                0% {
                    transform: scale(0.8);
                    opacity: 0;
                }

                100% {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            @keyframes css-1588u1j-antZoomBigOut {
                0% {
                    transform: scale(1);
                }

                100% {
                    transform: scale(0.8);
                    opacity: 0;
                }
            }

            :where(.css-1588u1j).ant-row {
                font-family: var(--font-noto-sans);
                font-size: 14px;
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-row::before,:where(.css-1588u1j).ant-row::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-row [class^="ant-row"],:where(.css-1588u1j).ant-row [class*=" ant-row"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-row [class^="ant-row"]::before,:where(.css-1588u1j).ant-row [class*=" ant-row"]::before,:where(.css-1588u1j).ant-row [class^="ant-row"]::after,:where(.css-1588u1j).ant-row [class*=" ant-row"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-row {
                display: flex;
                flex-flow: row wrap;
                min-width: 0;
            }

            :where(.css-1588u1j).ant-row::before,:where(.css-1588u1j).ant-row::after {
                display: flex;
            }

            :where(.css-1588u1j).ant-row-no-wrap {
                flex-wrap: nowrap;
            }

            :where(.css-1588u1j).ant-row-start {
                justify-content: flex-start;
            }

            :where(.css-1588u1j).ant-row-center {
                justify-content: center;
            }

            :where(.css-1588u1j).ant-row-end {
                justify-content: flex-end;
            }

            :where(.css-1588u1j).ant-row-space-between {
                justify-content: space-between;
            }

            :where(.css-1588u1j).ant-row-space-around {
                justify-content: space-around;
            }

            :where(.css-1588u1j).ant-row-space-evenly {
                justify-content: space-evenly;
            }

            :where(.css-1588u1j).ant-row-top {
                align-items: flex-start;
            }

            :where(.css-1588u1j).ant-row-middle {
                align-items: center;
            }

            :where(.css-1588u1j).ant-row-bottom {
                align-items: flex-end;
            }

            :where(.css-1588u1j).ant-col {
                font-family: var(--font-noto-sans);
                font-size: 14px;
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-col::before,:where(.css-1588u1j).ant-col::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-col [class^="ant-col"],:where(.css-1588u1j).ant-col [class*=" ant-col"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-col [class^="ant-col"]::before,:where(.css-1588u1j).ant-col [class*=" ant-col"]::before,:where(.css-1588u1j).ant-col [class^="ant-col"]::after,:where(.css-1588u1j).ant-col [class*=" ant-col"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-col {
                position: relative;
                max-width: 100%;
                min-height: 1px;
            }

            :where(.css-1588u1j).ant-col-24 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 100%;
                max-width: 100%;
            }

            :where(.css-1588u1j).ant-col-push-24 {
                inset-inline-start: 100%;
            }

            :where(.css-1588u1j).ant-col-pull-24 {
                inset-inline-end: 100%;
            }

            :where(.css-1588u1j).ant-col-offset-24 {
                margin-inline-start:100%;}

            :where(.css-1588u1j).ant-col-order-24 {
                order: 24;
            }

            :where(.css-1588u1j).ant-col-23 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 95.83333333333334%;
                max-width: 95.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-push-23 {
                inset-inline-start: 95.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-pull-23 {
                inset-inline-end: 95.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-offset-23 {
                margin-inline-start:95.83333333333334%;}

            :where(.css-1588u1j).ant-col-order-23 {
                order: 23;
            }

            :where(.css-1588u1j).ant-col-22 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 91.66666666666666%;
                max-width: 91.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-push-22 {
                inset-inline-start: 91.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-pull-22 {
                inset-inline-end: 91.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-offset-22 {
                margin-inline-start:91.66666666666666%;}

            :where(.css-1588u1j).ant-col-order-22 {
                order: 22;
            }

            :where(.css-1588u1j).ant-col-21 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 87.5%;
                max-width: 87.5%;
            }

            :where(.css-1588u1j).ant-col-push-21 {
                inset-inline-start: 87.5%;
            }

            :where(.css-1588u1j).ant-col-pull-21 {
                inset-inline-end: 87.5%;
            }

            :where(.css-1588u1j).ant-col-offset-21 {
                margin-inline-start:87.5%;}

            :where(.css-1588u1j).ant-col-order-21 {
                order: 21;
            }

            :where(.css-1588u1j).ant-col-20 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 83.33333333333334%;
                max-width: 83.33333333333334%;
            }

            :where(.css-1588u1j).ant-col-push-20 {
                inset-inline-start: 83.33333333333334%;
            }

            :where(.css-1588u1j).ant-col-pull-20 {
                inset-inline-end: 83.33333333333334%;
            }

            :where(.css-1588u1j).ant-col-offset-20 {
                margin-inline-start:83.33333333333334%;}

            :where(.css-1588u1j).ant-col-order-20 {
                order: 20;
            }

            :where(.css-1588u1j).ant-col-19 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 79.16666666666666%;
                max-width: 79.16666666666666%;
            }

            :where(.css-1588u1j).ant-col-push-19 {
                inset-inline-start: 79.16666666666666%;
            }

            :where(.css-1588u1j).ant-col-pull-19 {
                inset-inline-end: 79.16666666666666%;
            }

            :where(.css-1588u1j).ant-col-offset-19 {
                margin-inline-start:79.16666666666666%;}

            :where(.css-1588u1j).ant-col-order-19 {
                order: 19;
            }

            :where(.css-1588u1j).ant-col-18 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 75%;
                max-width: 75%;
            }

            :where(.css-1588u1j).ant-col-push-18 {
                inset-inline-start: 75%;
            }

            :where(.css-1588u1j).ant-col-pull-18 {
                inset-inline-end: 75%;
            }

            :where(.css-1588u1j).ant-col-offset-18 {
                margin-inline-start:75%;}

            :where(.css-1588u1j).ant-col-order-18 {
                order: 18;
            }

            :where(.css-1588u1j).ant-col-17 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 70.83333333333334%;
                max-width: 70.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-push-17 {
                inset-inline-start: 70.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-pull-17 {
                inset-inline-end: 70.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-offset-17 {
                margin-inline-start:70.83333333333334%;}

            :where(.css-1588u1j).ant-col-order-17 {
                order: 17;
            }

            :where(.css-1588u1j).ant-col-16 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 66.66666666666666%;
                max-width: 66.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-push-16 {
                inset-inline-start: 66.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-pull-16 {
                inset-inline-end: 66.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-offset-16 {
                margin-inline-start:66.66666666666666%;}

            :where(.css-1588u1j).ant-col-order-16 {
                order: 16;
            }

            :where(.css-1588u1j).ant-col-15 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 62.5%;
                max-width: 62.5%;
            }

            :where(.css-1588u1j).ant-col-push-15 {
                inset-inline-start: 62.5%;
            }

            :where(.css-1588u1j).ant-col-pull-15 {
                inset-inline-end: 62.5%;
            }

            :where(.css-1588u1j).ant-col-offset-15 {
                margin-inline-start:62.5%;}

            :where(.css-1588u1j).ant-col-order-15 {
                order: 15;
            }

            :where(.css-1588u1j).ant-col-14 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 58.333333333333336%;
                max-width: 58.333333333333336%;
            }

            :where(.css-1588u1j).ant-col-push-14 {
                inset-inline-start: 58.333333333333336%;
            }

            :where(.css-1588u1j).ant-col-pull-14 {
                inset-inline-end: 58.333333333333336%;
            }

            :where(.css-1588u1j).ant-col-offset-14 {
                margin-inline-start:58.333333333333336%;}

            :where(.css-1588u1j).ant-col-order-14 {
                order: 14;
            }

            :where(.css-1588u1j).ant-col-13 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 54.166666666666664%;
                max-width: 54.166666666666664%;
            }

            :where(.css-1588u1j).ant-col-push-13 {
                inset-inline-start: 54.166666666666664%;
            }

            :where(.css-1588u1j).ant-col-pull-13 {
                inset-inline-end: 54.166666666666664%;
            }

            :where(.css-1588u1j).ant-col-offset-13 {
                margin-inline-start:54.166666666666664%;}

            :where(.css-1588u1j).ant-col-order-13 {
                order: 13;
            }

            :where(.css-1588u1j).ant-col-12 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 50%;
                max-width: 50%;
            }

            :where(.css-1588u1j).ant-col-push-12 {
                inset-inline-start: 50%;
            }

            :where(.css-1588u1j).ant-col-pull-12 {
                inset-inline-end: 50%;
            }

            :where(.css-1588u1j).ant-col-offset-12 {
                margin-inline-start:50%;}

            :where(.css-1588u1j).ant-col-order-12 {
                order: 12;
            }

            :where(.css-1588u1j).ant-col-11 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 45.83333333333333%;
                max-width: 45.83333333333333%;
            }

            :where(.css-1588u1j).ant-col-push-11 {
                inset-inline-start: 45.83333333333333%;
            }

            :where(.css-1588u1j).ant-col-pull-11 {
                inset-inline-end: 45.83333333333333%;
            }

            :where(.css-1588u1j).ant-col-offset-11 {
                margin-inline-start:45.83333333333333%;}

            :where(.css-1588u1j).ant-col-order-11 {
                order: 11;
            }

            :where(.css-1588u1j).ant-col-10 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 41.66666666666667%;
                max-width: 41.66666666666667%;
            }

            :where(.css-1588u1j).ant-col-push-10 {
                inset-inline-start: 41.66666666666667%;
            }

            :where(.css-1588u1j).ant-col-pull-10 {
                inset-inline-end: 41.66666666666667%;
            }

            :where(.css-1588u1j).ant-col-offset-10 {
                margin-inline-start:41.66666666666667%;}

            :where(.css-1588u1j).ant-col-order-10 {
                order: 10;
            }

            :where(.css-1588u1j).ant-col-9 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 37.5%;
                max-width: 37.5%;
            }

            :where(.css-1588u1j).ant-col-push-9 {
                inset-inline-start: 37.5%;
            }

            :where(.css-1588u1j).ant-col-pull-9 {
                inset-inline-end: 37.5%;
            }

            :where(.css-1588u1j).ant-col-offset-9 {
                margin-inline-start:37.5%;}

            :where(.css-1588u1j).ant-col-order-9 {
                order: 9;
            }

            :where(.css-1588u1j).ant-col-8 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 33.33333333333333%;
                max-width: 33.33333333333333%;
            }

            :where(.css-1588u1j).ant-col-push-8 {
                inset-inline-start: 33.33333333333333%;
            }

            :where(.css-1588u1j).ant-col-pull-8 {
                inset-inline-end: 33.33333333333333%;
            }

            :where(.css-1588u1j).ant-col-offset-8 {
                margin-inline-start:33.33333333333333%;}

            :where(.css-1588u1j).ant-col-order-8 {
                order: 8;
            }

            :where(.css-1588u1j).ant-col-7 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 29.166666666666668%;
                max-width: 29.166666666666668%;
            }

            :where(.css-1588u1j).ant-col-push-7 {
                inset-inline-start: 29.166666666666668%;
            }

            :where(.css-1588u1j).ant-col-pull-7 {
                inset-inline-end: 29.166666666666668%;
            }

            :where(.css-1588u1j).ant-col-offset-7 {
                margin-inline-start:29.166666666666668%;}

            :where(.css-1588u1j).ant-col-order-7 {
                order: 7;
            }

            :where(.css-1588u1j).ant-col-6 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 25%;
                max-width: 25%;
            }

            :where(.css-1588u1j).ant-col-push-6 {
                inset-inline-start: 25%;
            }

            :where(.css-1588u1j).ant-col-pull-6 {
                inset-inline-end: 25%;
            }

            :where(.css-1588u1j).ant-col-offset-6 {
                margin-inline-start:25%;}

            :where(.css-1588u1j).ant-col-order-6 {
                order: 6;
            }

            :where(.css-1588u1j).ant-col-5 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 20.833333333333336%;
                max-width: 20.833333333333336%;
            }

            :where(.css-1588u1j).ant-col-push-5 {
                inset-inline-start: 20.833333333333336%;
            }

            :where(.css-1588u1j).ant-col-pull-5 {
                inset-inline-end: 20.833333333333336%;
            }

            :where(.css-1588u1j).ant-col-offset-5 {
                margin-inline-start:20.833333333333336%;}

            :where(.css-1588u1j).ant-col-order-5 {
                order: 5;
            }

            :where(.css-1588u1j).ant-col-4 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 16.666666666666664%;
                max-width: 16.666666666666664%;
            }

            :where(.css-1588u1j).ant-col-push-4 {
                inset-inline-start: 16.666666666666664%;
            }

            :where(.css-1588u1j).ant-col-pull-4 {
                inset-inline-end: 16.666666666666664%;
            }

            :where(.css-1588u1j).ant-col-offset-4 {
                margin-inline-start:16.666666666666664%;}

            :where(.css-1588u1j).ant-col-order-4 {
                order: 4;
            }

            :where(.css-1588u1j).ant-col-3 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 12.5%;
                max-width: 12.5%;
            }

            :where(.css-1588u1j).ant-col-push-3 {
                inset-inline-start: 12.5%;
            }

            :where(.css-1588u1j).ant-col-pull-3 {
                inset-inline-end: 12.5%;
            }

            :where(.css-1588u1j).ant-col-offset-3 {
                margin-inline-start:12.5%;}

            :where(.css-1588u1j).ant-col-order-3 {
                order: 3;
            }

            :where(.css-1588u1j).ant-col-2 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 8.333333333333332%;
                max-width: 8.333333333333332%;
            }

            :where(.css-1588u1j).ant-col-push-2 {
                inset-inline-start: 8.333333333333332%;
            }

            :where(.css-1588u1j).ant-col-pull-2 {
                inset-inline-end: 8.333333333333332%;
            }

            :where(.css-1588u1j).ant-col-offset-2 {
                margin-inline-start:8.333333333333332%;}

            :where(.css-1588u1j).ant-col-order-2 {
                order: 2;
            }

            :where(.css-1588u1j).ant-col-1 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 4.166666666666666%;
                max-width: 4.166666666666666%;
            }

            :where(.css-1588u1j).ant-col-push-1 {
                inset-inline-start: 4.166666666666666%;
            }

            :where(.css-1588u1j).ant-col-pull-1 {
                inset-inline-end: 4.166666666666666%;
            }

            :where(.css-1588u1j).ant-col-offset-1 {
                margin-inline-start:4.166666666666666%;}

            :where(.css-1588u1j).ant-col-order-1 {
                order: 1;
            }

            :where(.css-1588u1j).ant-col-0 {
                display: none;
            }

            :where(.css-1588u1j).ant-col-push-0 {
                inset-inline-start: auto;
            }

            :where(.css-1588u1j).ant-col-pull-0 {
                inset-inline-end: auto;
            }

            :where(.css-1588u1j).ant-col-offset-0 {
                margin-inline-start:0;}

            :where(.css-1588u1j).ant-col-order-0 {
                order: 0;
            }

            :where(.css-1588u1j).ant-col-flex {
                flex: var(--ant-col-flex);
            }

            :where(.css-1588u1j).ant-col-xs-24 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 100%;
                max-width: 100%;
            }

            :where(.css-1588u1j).ant-col-xs-push-24 {
                inset-inline-start: 100%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-24 {
                inset-inline-end: 100%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-24 {
                margin-inline-start:100%;}

            :where(.css-1588u1j).ant-col-xs-order-24 {
                order: 24;
            }

            :where(.css-1588u1j).ant-col-xs-23 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 95.83333333333334%;
                max-width: 95.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-xs-push-23 {
                inset-inline-start: 95.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-23 {
                inset-inline-end: 95.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-23 {
                margin-inline-start:95.83333333333334%;}

            :where(.css-1588u1j).ant-col-xs-order-23 {
                order: 23;
            }

            :where(.css-1588u1j).ant-col-xs-22 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 91.66666666666666%;
                max-width: 91.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-push-22 {
                inset-inline-start: 91.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-22 {
                inset-inline-end: 91.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-22 {
                margin-inline-start:91.66666666666666%;}

            :where(.css-1588u1j).ant-col-xs-order-22 {
                order: 22;
            }

            :where(.css-1588u1j).ant-col-xs-21 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 87.5%;
                max-width: 87.5%;
            }

            :where(.css-1588u1j).ant-col-xs-push-21 {
                inset-inline-start: 87.5%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-21 {
                inset-inline-end: 87.5%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-21 {
                margin-inline-start:87.5%;}

            :where(.css-1588u1j).ant-col-xs-order-21 {
                order: 21;
            }

            :where(.css-1588u1j).ant-col-xs-20 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 83.33333333333334%;
                max-width: 83.33333333333334%;
            }

            :where(.css-1588u1j).ant-col-xs-push-20 {
                inset-inline-start: 83.33333333333334%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-20 {
                inset-inline-end: 83.33333333333334%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-20 {
                margin-inline-start:83.33333333333334%;}

            :where(.css-1588u1j).ant-col-xs-order-20 {
                order: 20;
            }

            :where(.css-1588u1j).ant-col-xs-19 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 79.16666666666666%;
                max-width: 79.16666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-push-19 {
                inset-inline-start: 79.16666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-19 {
                inset-inline-end: 79.16666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-19 {
                margin-inline-start:79.16666666666666%;}

            :where(.css-1588u1j).ant-col-xs-order-19 {
                order: 19;
            }

            :where(.css-1588u1j).ant-col-xs-18 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 75%;
                max-width: 75%;
            }

            :where(.css-1588u1j).ant-col-xs-push-18 {
                inset-inline-start: 75%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-18 {
                inset-inline-end: 75%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-18 {
                margin-inline-start:75%;}

            :where(.css-1588u1j).ant-col-xs-order-18 {
                order: 18;
            }

            :where(.css-1588u1j).ant-col-xs-17 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 70.83333333333334%;
                max-width: 70.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-xs-push-17 {
                inset-inline-start: 70.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-17 {
                inset-inline-end: 70.83333333333334%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-17 {
                margin-inline-start:70.83333333333334%;}

            :where(.css-1588u1j).ant-col-xs-order-17 {
                order: 17;
            }

            :where(.css-1588u1j).ant-col-xs-16 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 66.66666666666666%;
                max-width: 66.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-push-16 {
                inset-inline-start: 66.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-16 {
                inset-inline-end: 66.66666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-16 {
                margin-inline-start:66.66666666666666%;}

            :where(.css-1588u1j).ant-col-xs-order-16 {
                order: 16;
            }

            :where(.css-1588u1j).ant-col-xs-15 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 62.5%;
                max-width: 62.5%;
            }

            :where(.css-1588u1j).ant-col-xs-push-15 {
                inset-inline-start: 62.5%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-15 {
                inset-inline-end: 62.5%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-15 {
                margin-inline-start:62.5%;}

            :where(.css-1588u1j).ant-col-xs-order-15 {
                order: 15;
            }

            :where(.css-1588u1j).ant-col-xs-14 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 58.333333333333336%;
                max-width: 58.333333333333336%;
            }

            :where(.css-1588u1j).ant-col-xs-push-14 {
                inset-inline-start: 58.333333333333336%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-14 {
                inset-inline-end: 58.333333333333336%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-14 {
                margin-inline-start:58.333333333333336%;}

            :where(.css-1588u1j).ant-col-xs-order-14 {
                order: 14;
            }

            :where(.css-1588u1j).ant-col-xs-13 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 54.166666666666664%;
                max-width: 54.166666666666664%;
            }

            :where(.css-1588u1j).ant-col-xs-push-13 {
                inset-inline-start: 54.166666666666664%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-13 {
                inset-inline-end: 54.166666666666664%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-13 {
                margin-inline-start:54.166666666666664%;}

            :where(.css-1588u1j).ant-col-xs-order-13 {
                order: 13;
            }

            :where(.css-1588u1j).ant-col-xs-12 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 50%;
                max-width: 50%;
            }

            :where(.css-1588u1j).ant-col-xs-push-12 {
                inset-inline-start: 50%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-12 {
                inset-inline-end: 50%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-12 {
                margin-inline-start:50%;}

            :where(.css-1588u1j).ant-col-xs-order-12 {
                order: 12;
            }

            :where(.css-1588u1j).ant-col-xs-11 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 45.83333333333333%;
                max-width: 45.83333333333333%;
            }

            :where(.css-1588u1j).ant-col-xs-push-11 {
                inset-inline-start: 45.83333333333333%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-11 {
                inset-inline-end: 45.83333333333333%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-11 {
                margin-inline-start:45.83333333333333%;}

            :where(.css-1588u1j).ant-col-xs-order-11 {
                order: 11;
            }

            :where(.css-1588u1j).ant-col-xs-10 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 41.66666666666667%;
                max-width: 41.66666666666667%;
            }

            :where(.css-1588u1j).ant-col-xs-push-10 {
                inset-inline-start: 41.66666666666667%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-10 {
                inset-inline-end: 41.66666666666667%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-10 {
                margin-inline-start:41.66666666666667%;}

            :where(.css-1588u1j).ant-col-xs-order-10 {
                order: 10;
            }

            :where(.css-1588u1j).ant-col-xs-9 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 37.5%;
                max-width: 37.5%;
            }

            :where(.css-1588u1j).ant-col-xs-push-9 {
                inset-inline-start: 37.5%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-9 {
                inset-inline-end: 37.5%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-9 {
                margin-inline-start:37.5%;}

            :where(.css-1588u1j).ant-col-xs-order-9 {
                order: 9;
            }

            :where(.css-1588u1j).ant-col-xs-8 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 33.33333333333333%;
                max-width: 33.33333333333333%;
            }

            :where(.css-1588u1j).ant-col-xs-push-8 {
                inset-inline-start: 33.33333333333333%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-8 {
                inset-inline-end: 33.33333333333333%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-8 {
                margin-inline-start:33.33333333333333%;}

            :where(.css-1588u1j).ant-col-xs-order-8 {
                order: 8;
            }

            :where(.css-1588u1j).ant-col-xs-7 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 29.166666666666668%;
                max-width: 29.166666666666668%;
            }

            :where(.css-1588u1j).ant-col-xs-push-7 {
                inset-inline-start: 29.166666666666668%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-7 {
                inset-inline-end: 29.166666666666668%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-7 {
                margin-inline-start:29.166666666666668%;}

            :where(.css-1588u1j).ant-col-xs-order-7 {
                order: 7;
            }

            :where(.css-1588u1j).ant-col-xs-6 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 25%;
                max-width: 25%;
            }

            :where(.css-1588u1j).ant-col-xs-push-6 {
                inset-inline-start: 25%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-6 {
                inset-inline-end: 25%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-6 {
                margin-inline-start:25%;}

            :where(.css-1588u1j).ant-col-xs-order-6 {
                order: 6;
            }

            :where(.css-1588u1j).ant-col-xs-5 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 20.833333333333336%;
                max-width: 20.833333333333336%;
            }

            :where(.css-1588u1j).ant-col-xs-push-5 {
                inset-inline-start: 20.833333333333336%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-5 {
                inset-inline-end: 20.833333333333336%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-5 {
                margin-inline-start:20.833333333333336%;}

            :where(.css-1588u1j).ant-col-xs-order-5 {
                order: 5;
            }

            :where(.css-1588u1j).ant-col-xs-4 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 16.666666666666664%;
                max-width: 16.666666666666664%;
            }

            :where(.css-1588u1j).ant-col-xs-push-4 {
                inset-inline-start: 16.666666666666664%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-4 {
                inset-inline-end: 16.666666666666664%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-4 {
                margin-inline-start:16.666666666666664%;}

            :where(.css-1588u1j).ant-col-xs-order-4 {
                order: 4;
            }

            :where(.css-1588u1j).ant-col-xs-3 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 12.5%;
                max-width: 12.5%;
            }

            :where(.css-1588u1j).ant-col-xs-push-3 {
                inset-inline-start: 12.5%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-3 {
                inset-inline-end: 12.5%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-3 {
                margin-inline-start:12.5%;}

            :where(.css-1588u1j).ant-col-xs-order-3 {
                order: 3;
            }

            :where(.css-1588u1j).ant-col-xs-2 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 8.333333333333332%;
                max-width: 8.333333333333332%;
            }

            :where(.css-1588u1j).ant-col-xs-push-2 {
                inset-inline-start: 8.333333333333332%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-2 {
                inset-inline-end: 8.333333333333332%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-2 {
                margin-inline-start:8.333333333333332%;}

            :where(.css-1588u1j).ant-col-xs-order-2 {
                order: 2;
            }

            :where(.css-1588u1j).ant-col-xs-1 {
                --ant-display: block;
                display: block;
                display: var(--ant-display);
                flex: 0 0 4.166666666666666%;
                max-width: 4.166666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-push-1 {
                inset-inline-start: 4.166666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-pull-1 {
                inset-inline-end: 4.166666666666666%;
            }

            :where(.css-1588u1j).ant-col-xs-offset-1 {
                margin-inline-start:4.166666666666666%;}

            :where(.css-1588u1j).ant-col-xs-order-1 {
                order: 1;
            }

            :where(.css-1588u1j).ant-col-xs-0 {
                display: none;
            }

            :where(.css-1588u1j).ant-col-push-0 {
                inset-inline-start: auto;
            }

            :where(.css-1588u1j).ant-col-pull-0 {
                inset-inline-end: auto;
            }

            :where(.css-1588u1j).ant-col-xs-push-0 {
                inset-inline-start: auto;
            }

            :where(.css-1588u1j).ant-col-xs-pull-0 {
                inset-inline-end: auto;
            }

            :where(.css-1588u1j).ant-col-xs-offset-0 {
                margin-inline-start:0;}

            :where(.css-1588u1j).ant-col-xs-order-0 {
                order: 0;
            }

            :where(.css-1588u1j).ant-col-xs-flex {
                flex: var(--ant-col-xs-flex);
            }

            @media (min-width: 576px) {
                :where(.css-1588u1j).ant-col-sm-24 {
                    --ant-display:block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                :where(.css-1588u1j).ant-col-sm-push-24 {
                    inset-inline-start: 100%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-24 {
                    inset-inline-end: 100%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-24 {
                    margin-inline-start:100%;}

                :where(.css-1588u1j).ant-col-sm-order-24 {
                    order: 24;
                }

                :where(.css-1588u1j).ant-col-sm-23 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 95.83333333333334%;
                    max-width: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-sm-push-23 {
                    inset-inline-start: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-23 {
                    inset-inline-end: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-23 {
                    margin-inline-start:95.83333333333334%;}

                :where(.css-1588u1j).ant-col-sm-order-23 {
                    order: 23;
                }

                :where(.css-1588u1j).ant-col-sm-22 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 91.66666666666666%;
                    max-width: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-push-22 {
                    inset-inline-start: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-22 {
                    inset-inline-end: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-22 {
                    margin-inline-start:91.66666666666666%;}

                :where(.css-1588u1j).ant-col-sm-order-22 {
                    order: 22;
                }

                :where(.css-1588u1j).ant-col-sm-21 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 87.5%;
                    max-width: 87.5%;
                }

                :where(.css-1588u1j).ant-col-sm-push-21 {
                    inset-inline-start: 87.5%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-21 {
                    inset-inline-end: 87.5%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-21 {
                    margin-inline-start:87.5%;}

                :where(.css-1588u1j).ant-col-sm-order-21 {
                    order: 21;
                }

                :where(.css-1588u1j).ant-col-sm-20 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 83.33333333333334%;
                    max-width: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-sm-push-20 {
                    inset-inline-start: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-20 {
                    inset-inline-end: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-20 {
                    margin-inline-start:83.33333333333334%;}

                :where(.css-1588u1j).ant-col-sm-order-20 {
                    order: 20;
                }

                :where(.css-1588u1j).ant-col-sm-19 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 79.16666666666666%;
                    max-width: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-push-19 {
                    inset-inline-start: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-19 {
                    inset-inline-end: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-19 {
                    margin-inline-start:79.16666666666666%;}

                :where(.css-1588u1j).ant-col-sm-order-19 {
                    order: 19;
                }

                :where(.css-1588u1j).ant-col-sm-18 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 75%;
                    max-width: 75%;
                }

                :where(.css-1588u1j).ant-col-sm-push-18 {
                    inset-inline-start: 75%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-18 {
                    inset-inline-end: 75%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-18 {
                    margin-inline-start:75%;}

                :where(.css-1588u1j).ant-col-sm-order-18 {
                    order: 18;
                }

                :where(.css-1588u1j).ant-col-sm-17 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 70.83333333333334%;
                    max-width: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-sm-push-17 {
                    inset-inline-start: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-17 {
                    inset-inline-end: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-17 {
                    margin-inline-start:70.83333333333334%;}

                :where(.css-1588u1j).ant-col-sm-order-17 {
                    order: 17;
                }

                :where(.css-1588u1j).ant-col-sm-16 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 66.66666666666666%;
                    max-width: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-push-16 {
                    inset-inline-start: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-16 {
                    inset-inline-end: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-16 {
                    margin-inline-start:66.66666666666666%;}

                :where(.css-1588u1j).ant-col-sm-order-16 {
                    order: 16;
                }

                :where(.css-1588u1j).ant-col-sm-15 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 62.5%;
                    max-width: 62.5%;
                }

                :where(.css-1588u1j).ant-col-sm-push-15 {
                    inset-inline-start: 62.5%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-15 {
                    inset-inline-end: 62.5%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-15 {
                    margin-inline-start:62.5%;}

                :where(.css-1588u1j).ant-col-sm-order-15 {
                    order: 15;
                }

                :where(.css-1588u1j).ant-col-sm-14 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 58.333333333333336%;
                    max-width: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-sm-push-14 {
                    inset-inline-start: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-14 {
                    inset-inline-end: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-14 {
                    margin-inline-start:58.333333333333336%;}

                :where(.css-1588u1j).ant-col-sm-order-14 {
                    order: 14;
                }

                :where(.css-1588u1j).ant-col-sm-13 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 54.166666666666664%;
                    max-width: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-sm-push-13 {
                    inset-inline-start: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-13 {
                    inset-inline-end: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-13 {
                    margin-inline-start:54.166666666666664%;}

                :where(.css-1588u1j).ant-col-sm-order-13 {
                    order: 13;
                }

                :where(.css-1588u1j).ant-col-sm-12 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 50%;
                    max-width: 50%;
                }

                :where(.css-1588u1j).ant-col-sm-push-12 {
                    inset-inline-start: 50%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-12 {
                    inset-inline-end: 50%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-12 {
                    margin-inline-start:50%;}

                :where(.css-1588u1j).ant-col-sm-order-12 {
                    order: 12;
                }

                :where(.css-1588u1j).ant-col-sm-11 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 45.83333333333333%;
                    max-width: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-sm-push-11 {
                    inset-inline-start: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-11 {
                    inset-inline-end: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-11 {
                    margin-inline-start:45.83333333333333%;}

                :where(.css-1588u1j).ant-col-sm-order-11 {
                    order: 11;
                }

                :where(.css-1588u1j).ant-col-sm-10 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 41.66666666666667%;
                    max-width: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-sm-push-10 {
                    inset-inline-start: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-10 {
                    inset-inline-end: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-10 {
                    margin-inline-start:41.66666666666667%;}

                :where(.css-1588u1j).ant-col-sm-order-10 {
                    order: 10;
                }

                :where(.css-1588u1j).ant-col-sm-9 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 37.5%;
                    max-width: 37.5%;
                }

                :where(.css-1588u1j).ant-col-sm-push-9 {
                    inset-inline-start: 37.5%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-9 {
                    inset-inline-end: 37.5%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-9 {
                    margin-inline-start:37.5%;}

                :where(.css-1588u1j).ant-col-sm-order-9 {
                    order: 9;
                }

                :where(.css-1588u1j).ant-col-sm-8 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 33.33333333333333%;
                    max-width: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-sm-push-8 {
                    inset-inline-start: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-8 {
                    inset-inline-end: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-8 {
                    margin-inline-start:33.33333333333333%;}

                :where(.css-1588u1j).ant-col-sm-order-8 {
                    order: 8;
                }

                :where(.css-1588u1j).ant-col-sm-7 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 29.166666666666668%;
                    max-width: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-sm-push-7 {
                    inset-inline-start: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-7 {
                    inset-inline-end: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-7 {
                    margin-inline-start:29.166666666666668%;}

                :where(.css-1588u1j).ant-col-sm-order-7 {
                    order: 7;
                }

                :where(.css-1588u1j).ant-col-sm-6 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 25%;
                    max-width: 25%;
                }

                :where(.css-1588u1j).ant-col-sm-push-6 {
                    inset-inline-start: 25%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-6 {
                    inset-inline-end: 25%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-6 {
                    margin-inline-start:25%;}

                :where(.css-1588u1j).ant-col-sm-order-6 {
                    order: 6;
                }

                :where(.css-1588u1j).ant-col-sm-5 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 20.833333333333336%;
                    max-width: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-sm-push-5 {
                    inset-inline-start: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-5 {
                    inset-inline-end: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-5 {
                    margin-inline-start:20.833333333333336%;}

                :where(.css-1588u1j).ant-col-sm-order-5 {
                    order: 5;
                }

                :where(.css-1588u1j).ant-col-sm-4 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 16.666666666666664%;
                    max-width: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-sm-push-4 {
                    inset-inline-start: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-4 {
                    inset-inline-end: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-4 {
                    margin-inline-start:16.666666666666664%;}

                :where(.css-1588u1j).ant-col-sm-order-4 {
                    order: 4;
                }

                :where(.css-1588u1j).ant-col-sm-3 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 12.5%;
                    max-width: 12.5%;
                }

                :where(.css-1588u1j).ant-col-sm-push-3 {
                    inset-inline-start: 12.5%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-3 {
                    inset-inline-end: 12.5%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-3 {
                    margin-inline-start:12.5%;}

                :where(.css-1588u1j).ant-col-sm-order-3 {
                    order: 3;
                }

                :where(.css-1588u1j).ant-col-sm-2 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 8.333333333333332%;
                    max-width: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-sm-push-2 {
                    inset-inline-start: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-2 {
                    inset-inline-end: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-2 {
                    margin-inline-start:8.333333333333332%;}

                :where(.css-1588u1j).ant-col-sm-order-2 {
                    order: 2;
                }

                :where(.css-1588u1j).ant-col-sm-1 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 4.166666666666666%;
                    max-width: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-push-1 {
                    inset-inline-start: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-pull-1 {
                    inset-inline-end: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-sm-offset-1 {
                    margin-inline-start:4.166666666666666%;}

                :where(.css-1588u1j).ant-col-sm-order-1 {
                    order: 1;
                }

                :where(.css-1588u1j).ant-col-sm-0 {
                    display: none;
                }

                :where(.css-1588u1j).ant-col-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-sm-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-sm-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-sm-offset-0 {
                    margin-inline-start:0;}

                :where(.css-1588u1j).ant-col-sm-order-0 {
                    order: 0;
                }

                :where(.css-1588u1j).ant-col-sm-flex {
                    flex: var(--ant-col-sm-flex);
                }
            }

            @media (min-width: 768px) {
                :where(.css-1588u1j).ant-col-md-24 {
                    --ant-display:block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                :where(.css-1588u1j).ant-col-md-push-24 {
                    inset-inline-start: 100%;
                }

                :where(.css-1588u1j).ant-col-md-pull-24 {
                    inset-inline-end: 100%;
                }

                :where(.css-1588u1j).ant-col-md-offset-24 {
                    margin-inline-start:100%;}

                :where(.css-1588u1j).ant-col-md-order-24 {
                    order: 24;
                }

                :where(.css-1588u1j).ant-col-md-23 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 95.83333333333334%;
                    max-width: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-md-push-23 {
                    inset-inline-start: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-md-pull-23 {
                    inset-inline-end: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-md-offset-23 {
                    margin-inline-start:95.83333333333334%;}

                :where(.css-1588u1j).ant-col-md-order-23 {
                    order: 23;
                }

                :where(.css-1588u1j).ant-col-md-22 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 91.66666666666666%;
                    max-width: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-push-22 {
                    inset-inline-start: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-pull-22 {
                    inset-inline-end: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-offset-22 {
                    margin-inline-start:91.66666666666666%;}

                :where(.css-1588u1j).ant-col-md-order-22 {
                    order: 22;
                }

                :where(.css-1588u1j).ant-col-md-21 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 87.5%;
                    max-width: 87.5%;
                }

                :where(.css-1588u1j).ant-col-md-push-21 {
                    inset-inline-start: 87.5%;
                }

                :where(.css-1588u1j).ant-col-md-pull-21 {
                    inset-inline-end: 87.5%;
                }

                :where(.css-1588u1j).ant-col-md-offset-21 {
                    margin-inline-start:87.5%;}

                :where(.css-1588u1j).ant-col-md-order-21 {
                    order: 21;
                }

                :where(.css-1588u1j).ant-col-md-20 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 83.33333333333334%;
                    max-width: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-md-push-20 {
                    inset-inline-start: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-md-pull-20 {
                    inset-inline-end: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-md-offset-20 {
                    margin-inline-start:83.33333333333334%;}

                :where(.css-1588u1j).ant-col-md-order-20 {
                    order: 20;
                }

                :where(.css-1588u1j).ant-col-md-19 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 79.16666666666666%;
                    max-width: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-push-19 {
                    inset-inline-start: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-pull-19 {
                    inset-inline-end: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-offset-19 {
                    margin-inline-start:79.16666666666666%;}

                :where(.css-1588u1j).ant-col-md-order-19 {
                    order: 19;
                }

                :where(.css-1588u1j).ant-col-md-18 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 75%;
                    max-width: 75%;
                }

                :where(.css-1588u1j).ant-col-md-push-18 {
                    inset-inline-start: 75%;
                }

                :where(.css-1588u1j).ant-col-md-pull-18 {
                    inset-inline-end: 75%;
                }

                :where(.css-1588u1j).ant-col-md-offset-18 {
                    margin-inline-start:75%;}

                :where(.css-1588u1j).ant-col-md-order-18 {
                    order: 18;
                }

                :where(.css-1588u1j).ant-col-md-17 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 70.83333333333334%;
                    max-width: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-md-push-17 {
                    inset-inline-start: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-md-pull-17 {
                    inset-inline-end: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-md-offset-17 {
                    margin-inline-start:70.83333333333334%;}

                :where(.css-1588u1j).ant-col-md-order-17 {
                    order: 17;
                }

                :where(.css-1588u1j).ant-col-md-16 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 66.66666666666666%;
                    max-width: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-push-16 {
                    inset-inline-start: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-pull-16 {
                    inset-inline-end: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-offset-16 {
                    margin-inline-start:66.66666666666666%;}

                :where(.css-1588u1j).ant-col-md-order-16 {
                    order: 16;
                }

                :where(.css-1588u1j).ant-col-md-15 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 62.5%;
                    max-width: 62.5%;
                }

                :where(.css-1588u1j).ant-col-md-push-15 {
                    inset-inline-start: 62.5%;
                }

                :where(.css-1588u1j).ant-col-md-pull-15 {
                    inset-inline-end: 62.5%;
                }

                :where(.css-1588u1j).ant-col-md-offset-15 {
                    margin-inline-start:62.5%;}

                :where(.css-1588u1j).ant-col-md-order-15 {
                    order: 15;
                }

                :where(.css-1588u1j).ant-col-md-14 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 58.333333333333336%;
                    max-width: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-md-push-14 {
                    inset-inline-start: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-md-pull-14 {
                    inset-inline-end: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-md-offset-14 {
                    margin-inline-start:58.333333333333336%;}

                :where(.css-1588u1j).ant-col-md-order-14 {
                    order: 14;
                }

                :where(.css-1588u1j).ant-col-md-13 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 54.166666666666664%;
                    max-width: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-md-push-13 {
                    inset-inline-start: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-md-pull-13 {
                    inset-inline-end: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-md-offset-13 {
                    margin-inline-start:54.166666666666664%;}

                :where(.css-1588u1j).ant-col-md-order-13 {
                    order: 13;
                }

                :where(.css-1588u1j).ant-col-md-12 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 50%;
                    max-width: 50%;
                }

                :where(.css-1588u1j).ant-col-md-push-12 {
                    inset-inline-start: 50%;
                }

                :where(.css-1588u1j).ant-col-md-pull-12 {
                    inset-inline-end: 50%;
                }

                :where(.css-1588u1j).ant-col-md-offset-12 {
                    margin-inline-start:50%;}

                :where(.css-1588u1j).ant-col-md-order-12 {
                    order: 12;
                }

                :where(.css-1588u1j).ant-col-md-11 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 45.83333333333333%;
                    max-width: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-md-push-11 {
                    inset-inline-start: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-md-pull-11 {
                    inset-inline-end: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-md-offset-11 {
                    margin-inline-start:45.83333333333333%;}

                :where(.css-1588u1j).ant-col-md-order-11 {
                    order: 11;
                }

                :where(.css-1588u1j).ant-col-md-10 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 41.66666666666667%;
                    max-width: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-md-push-10 {
                    inset-inline-start: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-md-pull-10 {
                    inset-inline-end: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-md-offset-10 {
                    margin-inline-start:41.66666666666667%;}

                :where(.css-1588u1j).ant-col-md-order-10 {
                    order: 10;
                }

                :where(.css-1588u1j).ant-col-md-9 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 37.5%;
                    max-width: 37.5%;
                }

                :where(.css-1588u1j).ant-col-md-push-9 {
                    inset-inline-start: 37.5%;
                }

                :where(.css-1588u1j).ant-col-md-pull-9 {
                    inset-inline-end: 37.5%;
                }

                :where(.css-1588u1j).ant-col-md-offset-9 {
                    margin-inline-start:37.5%;}

                :where(.css-1588u1j).ant-col-md-order-9 {
                    order: 9;
                }

                :where(.css-1588u1j).ant-col-md-8 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 33.33333333333333%;
                    max-width: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-md-push-8 {
                    inset-inline-start: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-md-pull-8 {
                    inset-inline-end: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-md-offset-8 {
                    margin-inline-start:33.33333333333333%;}

                :where(.css-1588u1j).ant-col-md-order-8 {
                    order: 8;
                }

                :where(.css-1588u1j).ant-col-md-7 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 29.166666666666668%;
                    max-width: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-md-push-7 {
                    inset-inline-start: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-md-pull-7 {
                    inset-inline-end: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-md-offset-7 {
                    margin-inline-start:29.166666666666668%;}

                :where(.css-1588u1j).ant-col-md-order-7 {
                    order: 7;
                }

                :where(.css-1588u1j).ant-col-md-6 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 25%;
                    max-width: 25%;
                }

                :where(.css-1588u1j).ant-col-md-push-6 {
                    inset-inline-start: 25%;
                }

                :where(.css-1588u1j).ant-col-md-pull-6 {
                    inset-inline-end: 25%;
                }

                :where(.css-1588u1j).ant-col-md-offset-6 {
                    margin-inline-start:25%;}

                :where(.css-1588u1j).ant-col-md-order-6 {
                    order: 6;
                }

                :where(.css-1588u1j).ant-col-md-5 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 20.833333333333336%;
                    max-width: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-md-push-5 {
                    inset-inline-start: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-md-pull-5 {
                    inset-inline-end: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-md-offset-5 {
                    margin-inline-start:20.833333333333336%;}

                :where(.css-1588u1j).ant-col-md-order-5 {
                    order: 5;
                }

                :where(.css-1588u1j).ant-col-md-4 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 16.666666666666664%;
                    max-width: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-md-push-4 {
                    inset-inline-start: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-md-pull-4 {
                    inset-inline-end: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-md-offset-4 {
                    margin-inline-start:16.666666666666664%;}

                :where(.css-1588u1j).ant-col-md-order-4 {
                    order: 4;
                }

                :where(.css-1588u1j).ant-col-md-3 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 12.5%;
                    max-width: 12.5%;
                }

                :where(.css-1588u1j).ant-col-md-push-3 {
                    inset-inline-start: 12.5%;
                }

                :where(.css-1588u1j).ant-col-md-pull-3 {
                    inset-inline-end: 12.5%;
                }

                :where(.css-1588u1j).ant-col-md-offset-3 {
                    margin-inline-start:12.5%;}

                :where(.css-1588u1j).ant-col-md-order-3 {
                    order: 3;
                }

                :where(.css-1588u1j).ant-col-md-2 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 8.333333333333332%;
                    max-width: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-md-push-2 {
                    inset-inline-start: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-md-pull-2 {
                    inset-inline-end: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-md-offset-2 {
                    margin-inline-start:8.333333333333332%;}

                :where(.css-1588u1j).ant-col-md-order-2 {
                    order: 2;
                }

                :where(.css-1588u1j).ant-col-md-1 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 4.166666666666666%;
                    max-width: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-push-1 {
                    inset-inline-start: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-pull-1 {
                    inset-inline-end: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-md-offset-1 {
                    margin-inline-start:4.166666666666666%;}

                :where(.css-1588u1j).ant-col-md-order-1 {
                    order: 1;
                }

                :where(.css-1588u1j).ant-col-md-0 {
                    display: none;
                }

                :where(.css-1588u1j).ant-col-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-md-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-md-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-md-offset-0 {
                    margin-inline-start:0;}

                :where(.css-1588u1j).ant-col-md-order-0 {
                    order: 0;
                }

                :where(.css-1588u1j).ant-col-md-flex {
                    flex: var(--ant-col-md-flex);
                }
            }

            @media (min-width: 992px) {
                :where(.css-1588u1j).ant-col-lg-24 {
                    --ant-display:block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                :where(.css-1588u1j).ant-col-lg-push-24 {
                    inset-inline-start: 100%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-24 {
                    inset-inline-end: 100%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-24 {
                    margin-inline-start:100%;}

                :where(.css-1588u1j).ant-col-lg-order-24 {
                    order: 24;
                }

                :where(.css-1588u1j).ant-col-lg-23 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 95.83333333333334%;
                    max-width: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-lg-push-23 {
                    inset-inline-start: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-23 {
                    inset-inline-end: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-23 {
                    margin-inline-start:95.83333333333334%;}

                :where(.css-1588u1j).ant-col-lg-order-23 {
                    order: 23;
                }

                :where(.css-1588u1j).ant-col-lg-22 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 91.66666666666666%;
                    max-width: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-push-22 {
                    inset-inline-start: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-22 {
                    inset-inline-end: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-22 {
                    margin-inline-start:91.66666666666666%;}

                :where(.css-1588u1j).ant-col-lg-order-22 {
                    order: 22;
                }

                :where(.css-1588u1j).ant-col-lg-21 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 87.5%;
                    max-width: 87.5%;
                }

                :where(.css-1588u1j).ant-col-lg-push-21 {
                    inset-inline-start: 87.5%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-21 {
                    inset-inline-end: 87.5%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-21 {
                    margin-inline-start:87.5%;}

                :where(.css-1588u1j).ant-col-lg-order-21 {
                    order: 21;
                }

                :where(.css-1588u1j).ant-col-lg-20 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 83.33333333333334%;
                    max-width: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-lg-push-20 {
                    inset-inline-start: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-20 {
                    inset-inline-end: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-20 {
                    margin-inline-start:83.33333333333334%;}

                :where(.css-1588u1j).ant-col-lg-order-20 {
                    order: 20;
                }

                :where(.css-1588u1j).ant-col-lg-19 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 79.16666666666666%;
                    max-width: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-push-19 {
                    inset-inline-start: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-19 {
                    inset-inline-end: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-19 {
                    margin-inline-start:79.16666666666666%;}

                :where(.css-1588u1j).ant-col-lg-order-19 {
                    order: 19;
                }

                :where(.css-1588u1j).ant-col-lg-18 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 75%;
                    max-width: 75%;
                }

                :where(.css-1588u1j).ant-col-lg-push-18 {
                    inset-inline-start: 75%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-18 {
                    inset-inline-end: 75%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-18 {
                    margin-inline-start:75%;}

                :where(.css-1588u1j).ant-col-lg-order-18 {
                    order: 18;
                }

                :where(.css-1588u1j).ant-col-lg-17 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 70.83333333333334%;
                    max-width: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-lg-push-17 {
                    inset-inline-start: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-17 {
                    inset-inline-end: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-17 {
                    margin-inline-start:70.83333333333334%;}

                :where(.css-1588u1j).ant-col-lg-order-17 {
                    order: 17;
                }

                :where(.css-1588u1j).ant-col-lg-16 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 66.66666666666666%;
                    max-width: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-push-16 {
                    inset-inline-start: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-16 {
                    inset-inline-end: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-16 {
                    margin-inline-start:66.66666666666666%;}

                :where(.css-1588u1j).ant-col-lg-order-16 {
                    order: 16;
                }

                :where(.css-1588u1j).ant-col-lg-15 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 62.5%;
                    max-width: 62.5%;
                }

                :where(.css-1588u1j).ant-col-lg-push-15 {
                    inset-inline-start: 62.5%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-15 {
                    inset-inline-end: 62.5%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-15 {
                    margin-inline-start:62.5%;}

                :where(.css-1588u1j).ant-col-lg-order-15 {
                    order: 15;
                }

                :where(.css-1588u1j).ant-col-lg-14 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 58.333333333333336%;
                    max-width: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-lg-push-14 {
                    inset-inline-start: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-14 {
                    inset-inline-end: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-14 {
                    margin-inline-start:58.333333333333336%;}

                :where(.css-1588u1j).ant-col-lg-order-14 {
                    order: 14;
                }

                :where(.css-1588u1j).ant-col-lg-13 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 54.166666666666664%;
                    max-width: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-lg-push-13 {
                    inset-inline-start: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-13 {
                    inset-inline-end: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-13 {
                    margin-inline-start:54.166666666666664%;}

                :where(.css-1588u1j).ant-col-lg-order-13 {
                    order: 13;
                }

                :where(.css-1588u1j).ant-col-lg-12 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 50%;
                    max-width: 50%;
                }

                :where(.css-1588u1j).ant-col-lg-push-12 {
                    inset-inline-start: 50%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-12 {
                    inset-inline-end: 50%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-12 {
                    margin-inline-start:50%;}

                :where(.css-1588u1j).ant-col-lg-order-12 {
                    order: 12;
                }

                :where(.css-1588u1j).ant-col-lg-11 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 45.83333333333333%;
                    max-width: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-lg-push-11 {
                    inset-inline-start: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-11 {
                    inset-inline-end: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-11 {
                    margin-inline-start:45.83333333333333%;}

                :where(.css-1588u1j).ant-col-lg-order-11 {
                    order: 11;
                }

                :where(.css-1588u1j).ant-col-lg-10 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 41.66666666666667%;
                    max-width: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-lg-push-10 {
                    inset-inline-start: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-10 {
                    inset-inline-end: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-10 {
                    margin-inline-start:41.66666666666667%;}

                :where(.css-1588u1j).ant-col-lg-order-10 {
                    order: 10;
                }

                :where(.css-1588u1j).ant-col-lg-9 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 37.5%;
                    max-width: 37.5%;
                }

                :where(.css-1588u1j).ant-col-lg-push-9 {
                    inset-inline-start: 37.5%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-9 {
                    inset-inline-end: 37.5%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-9 {
                    margin-inline-start:37.5%;}

                :where(.css-1588u1j).ant-col-lg-order-9 {
                    order: 9;
                }

                :where(.css-1588u1j).ant-col-lg-8 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 33.33333333333333%;
                    max-width: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-lg-push-8 {
                    inset-inline-start: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-8 {
                    inset-inline-end: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-8 {
                    margin-inline-start:33.33333333333333%;}

                :where(.css-1588u1j).ant-col-lg-order-8 {
                    order: 8;
                }

                :where(.css-1588u1j).ant-col-lg-7 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 29.166666666666668%;
                    max-width: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-lg-push-7 {
                    inset-inline-start: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-7 {
                    inset-inline-end: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-7 {
                    margin-inline-start:29.166666666666668%;}

                :where(.css-1588u1j).ant-col-lg-order-7 {
                    order: 7;
                }

                :where(.css-1588u1j).ant-col-lg-6 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 25%;
                    max-width: 25%;
                }

                :where(.css-1588u1j).ant-col-lg-push-6 {
                    inset-inline-start: 25%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-6 {
                    inset-inline-end: 25%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-6 {
                    margin-inline-start:25%;}

                :where(.css-1588u1j).ant-col-lg-order-6 {
                    order: 6;
                }

                :where(.css-1588u1j).ant-col-lg-5 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 20.833333333333336%;
                    max-width: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-lg-push-5 {
                    inset-inline-start: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-5 {
                    inset-inline-end: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-5 {
                    margin-inline-start:20.833333333333336%;}

                :where(.css-1588u1j).ant-col-lg-order-5 {
                    order: 5;
                }

                :where(.css-1588u1j).ant-col-lg-4 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 16.666666666666664%;
                    max-width: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-lg-push-4 {
                    inset-inline-start: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-4 {
                    inset-inline-end: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-4 {
                    margin-inline-start:16.666666666666664%;}

                :where(.css-1588u1j).ant-col-lg-order-4 {
                    order: 4;
                }

                :where(.css-1588u1j).ant-col-lg-3 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 12.5%;
                    max-width: 12.5%;
                }

                :where(.css-1588u1j).ant-col-lg-push-3 {
                    inset-inline-start: 12.5%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-3 {
                    inset-inline-end: 12.5%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-3 {
                    margin-inline-start:12.5%;}

                :where(.css-1588u1j).ant-col-lg-order-3 {
                    order: 3;
                }

                :where(.css-1588u1j).ant-col-lg-2 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 8.333333333333332%;
                    max-width: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-lg-push-2 {
                    inset-inline-start: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-2 {
                    inset-inline-end: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-2 {
                    margin-inline-start:8.333333333333332%;}

                :where(.css-1588u1j).ant-col-lg-order-2 {
                    order: 2;
                }

                :where(.css-1588u1j).ant-col-lg-1 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 4.166666666666666%;
                    max-width: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-push-1 {
                    inset-inline-start: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-pull-1 {
                    inset-inline-end: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-lg-offset-1 {
                    margin-inline-start:4.166666666666666%;}

                :where(.css-1588u1j).ant-col-lg-order-1 {
                    order: 1;
                }

                :where(.css-1588u1j).ant-col-lg-0 {
                    display: none;
                }

                :where(.css-1588u1j).ant-col-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-lg-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-lg-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-lg-offset-0 {
                    margin-inline-start:0;}

                :where(.css-1588u1j).ant-col-lg-order-0 {
                    order: 0;
                }

                :where(.css-1588u1j).ant-col-lg-flex {
                    flex: var(--ant-col-lg-flex);
                }
            }

            @media (min-width: 1200px) {
                :where(.css-1588u1j).ant-col-xl-24 {
                    --ant-display:block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                :where(.css-1588u1j).ant-col-xl-push-24 {
                    inset-inline-start: 100%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-24 {
                    inset-inline-end: 100%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-24 {
                    margin-inline-start:100%;}

                :where(.css-1588u1j).ant-col-xl-order-24 {
                    order: 24;
                }

                :where(.css-1588u1j).ant-col-xl-23 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 95.83333333333334%;
                    max-width: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xl-push-23 {
                    inset-inline-start: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-23 {
                    inset-inline-end: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-23 {
                    margin-inline-start:95.83333333333334%;}

                :where(.css-1588u1j).ant-col-xl-order-23 {
                    order: 23;
                }

                :where(.css-1588u1j).ant-col-xl-22 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 91.66666666666666%;
                    max-width: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-push-22 {
                    inset-inline-start: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-22 {
                    inset-inline-end: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-22 {
                    margin-inline-start:91.66666666666666%;}

                :where(.css-1588u1j).ant-col-xl-order-22 {
                    order: 22;
                }

                :where(.css-1588u1j).ant-col-xl-21 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 87.5%;
                    max-width: 87.5%;
                }

                :where(.css-1588u1j).ant-col-xl-push-21 {
                    inset-inline-start: 87.5%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-21 {
                    inset-inline-end: 87.5%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-21 {
                    margin-inline-start:87.5%;}

                :where(.css-1588u1j).ant-col-xl-order-21 {
                    order: 21;
                }

                :where(.css-1588u1j).ant-col-xl-20 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 83.33333333333334%;
                    max-width: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-xl-push-20 {
                    inset-inline-start: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-20 {
                    inset-inline-end: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-20 {
                    margin-inline-start:83.33333333333334%;}

                :where(.css-1588u1j).ant-col-xl-order-20 {
                    order: 20;
                }

                :where(.css-1588u1j).ant-col-xl-19 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 79.16666666666666%;
                    max-width: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-push-19 {
                    inset-inline-start: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-19 {
                    inset-inline-end: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-19 {
                    margin-inline-start:79.16666666666666%;}

                :where(.css-1588u1j).ant-col-xl-order-19 {
                    order: 19;
                }

                :where(.css-1588u1j).ant-col-xl-18 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 75%;
                    max-width: 75%;
                }

                :where(.css-1588u1j).ant-col-xl-push-18 {
                    inset-inline-start: 75%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-18 {
                    inset-inline-end: 75%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-18 {
                    margin-inline-start:75%;}

                :where(.css-1588u1j).ant-col-xl-order-18 {
                    order: 18;
                }

                :where(.css-1588u1j).ant-col-xl-17 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 70.83333333333334%;
                    max-width: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xl-push-17 {
                    inset-inline-start: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-17 {
                    inset-inline-end: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-17 {
                    margin-inline-start:70.83333333333334%;}

                :where(.css-1588u1j).ant-col-xl-order-17 {
                    order: 17;
                }

                :where(.css-1588u1j).ant-col-xl-16 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 66.66666666666666%;
                    max-width: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-push-16 {
                    inset-inline-start: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-16 {
                    inset-inline-end: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-16 {
                    margin-inline-start:66.66666666666666%;}

                :where(.css-1588u1j).ant-col-xl-order-16 {
                    order: 16;
                }

                :where(.css-1588u1j).ant-col-xl-15 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 62.5%;
                    max-width: 62.5%;
                }

                :where(.css-1588u1j).ant-col-xl-push-15 {
                    inset-inline-start: 62.5%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-15 {
                    inset-inline-end: 62.5%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-15 {
                    margin-inline-start:62.5%;}

                :where(.css-1588u1j).ant-col-xl-order-15 {
                    order: 15;
                }

                :where(.css-1588u1j).ant-col-xl-14 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 58.333333333333336%;
                    max-width: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-xl-push-14 {
                    inset-inline-start: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-14 {
                    inset-inline-end: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-14 {
                    margin-inline-start:58.333333333333336%;}

                :where(.css-1588u1j).ant-col-xl-order-14 {
                    order: 14;
                }

                :where(.css-1588u1j).ant-col-xl-13 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 54.166666666666664%;
                    max-width: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-xl-push-13 {
                    inset-inline-start: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-13 {
                    inset-inline-end: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-13 {
                    margin-inline-start:54.166666666666664%;}

                :where(.css-1588u1j).ant-col-xl-order-13 {
                    order: 13;
                }

                :where(.css-1588u1j).ant-col-xl-12 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 50%;
                    max-width: 50%;
                }

                :where(.css-1588u1j).ant-col-xl-push-12 {
                    inset-inline-start: 50%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-12 {
                    inset-inline-end: 50%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-12 {
                    margin-inline-start:50%;}

                :where(.css-1588u1j).ant-col-xl-order-12 {
                    order: 12;
                }

                :where(.css-1588u1j).ant-col-xl-11 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 45.83333333333333%;
                    max-width: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-xl-push-11 {
                    inset-inline-start: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-11 {
                    inset-inline-end: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-11 {
                    margin-inline-start:45.83333333333333%;}

                :where(.css-1588u1j).ant-col-xl-order-11 {
                    order: 11;
                }

                :where(.css-1588u1j).ant-col-xl-10 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 41.66666666666667%;
                    max-width: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-xl-push-10 {
                    inset-inline-start: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-10 {
                    inset-inline-end: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-10 {
                    margin-inline-start:41.66666666666667%;}

                :where(.css-1588u1j).ant-col-xl-order-10 {
                    order: 10;
                }

                :where(.css-1588u1j).ant-col-xl-9 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 37.5%;
                    max-width: 37.5%;
                }

                :where(.css-1588u1j).ant-col-xl-push-9 {
                    inset-inline-start: 37.5%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-9 {
                    inset-inline-end: 37.5%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-9 {
                    margin-inline-start:37.5%;}

                :where(.css-1588u1j).ant-col-xl-order-9 {
                    order: 9;
                }

                :where(.css-1588u1j).ant-col-xl-8 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 33.33333333333333%;
                    max-width: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-xl-push-8 {
                    inset-inline-start: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-8 {
                    inset-inline-end: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-8 {
                    margin-inline-start:33.33333333333333%;}

                :where(.css-1588u1j).ant-col-xl-order-8 {
                    order: 8;
                }

                :where(.css-1588u1j).ant-col-xl-7 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 29.166666666666668%;
                    max-width: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-xl-push-7 {
                    inset-inline-start: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-7 {
                    inset-inline-end: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-7 {
                    margin-inline-start:29.166666666666668%;}

                :where(.css-1588u1j).ant-col-xl-order-7 {
                    order: 7;
                }

                :where(.css-1588u1j).ant-col-xl-6 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 25%;
                    max-width: 25%;
                }

                :where(.css-1588u1j).ant-col-xl-push-6 {
                    inset-inline-start: 25%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-6 {
                    inset-inline-end: 25%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-6 {
                    margin-inline-start:25%;}

                :where(.css-1588u1j).ant-col-xl-order-6 {
                    order: 6;
                }

                :where(.css-1588u1j).ant-col-xl-5 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 20.833333333333336%;
                    max-width: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-xl-push-5 {
                    inset-inline-start: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-5 {
                    inset-inline-end: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-5 {
                    margin-inline-start:20.833333333333336%;}

                :where(.css-1588u1j).ant-col-xl-order-5 {
                    order: 5;
                }

                :where(.css-1588u1j).ant-col-xl-4 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 16.666666666666664%;
                    max-width: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-xl-push-4 {
                    inset-inline-start: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-4 {
                    inset-inline-end: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-4 {
                    margin-inline-start:16.666666666666664%;}

                :where(.css-1588u1j).ant-col-xl-order-4 {
                    order: 4;
                }

                :where(.css-1588u1j).ant-col-xl-3 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 12.5%;
                    max-width: 12.5%;
                }

                :where(.css-1588u1j).ant-col-xl-push-3 {
                    inset-inline-start: 12.5%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-3 {
                    inset-inline-end: 12.5%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-3 {
                    margin-inline-start:12.5%;}

                :where(.css-1588u1j).ant-col-xl-order-3 {
                    order: 3;
                }

                :where(.css-1588u1j).ant-col-xl-2 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 8.333333333333332%;
                    max-width: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-xl-push-2 {
                    inset-inline-start: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-2 {
                    inset-inline-end: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-2 {
                    margin-inline-start:8.333333333333332%;}

                :where(.css-1588u1j).ant-col-xl-order-2 {
                    order: 2;
                }

                :where(.css-1588u1j).ant-col-xl-1 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 4.166666666666666%;
                    max-width: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-push-1 {
                    inset-inline-start: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-pull-1 {
                    inset-inline-end: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-xl-offset-1 {
                    margin-inline-start:4.166666666666666%;}

                :where(.css-1588u1j).ant-col-xl-order-1 {
                    order: 1;
                }

                :where(.css-1588u1j).ant-col-xl-0 {
                    display: none;
                }

                :where(.css-1588u1j).ant-col-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-xl-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-xl-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-xl-offset-0 {
                    margin-inline-start:0;}

                :where(.css-1588u1j).ant-col-xl-order-0 {
                    order: 0;
                }

                :where(.css-1588u1j).ant-col-xl-flex {
                    flex: var(--ant-col-xl-flex);
                }
            }

            @media (min-width: 1600px) {
                :where(.css-1588u1j).ant-col-xxl-24 {
                    --ant-display:block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-24 {
                    inset-inline-start: 100%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-24 {
                    inset-inline-end: 100%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-24 {
                    margin-inline-start:100%;}

                :where(.css-1588u1j).ant-col-xxl-order-24 {
                    order: 24;
                }

                :where(.css-1588u1j).ant-col-xxl-23 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 95.83333333333334%;
                    max-width: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-23 {
                    inset-inline-start: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-23 {
                    inset-inline-end: 95.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-23 {
                    margin-inline-start:95.83333333333334%;}

                :where(.css-1588u1j).ant-col-xxl-order-23 {
                    order: 23;
                }

                :where(.css-1588u1j).ant-col-xxl-22 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 91.66666666666666%;
                    max-width: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-22 {
                    inset-inline-start: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-22 {
                    inset-inline-end: 91.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-22 {
                    margin-inline-start:91.66666666666666%;}

                :where(.css-1588u1j).ant-col-xxl-order-22 {
                    order: 22;
                }

                :where(.css-1588u1j).ant-col-xxl-21 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 87.5%;
                    max-width: 87.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-21 {
                    inset-inline-start: 87.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-21 {
                    inset-inline-end: 87.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-21 {
                    margin-inline-start:87.5%;}

                :where(.css-1588u1j).ant-col-xxl-order-21 {
                    order: 21;
                }

                :where(.css-1588u1j).ant-col-xxl-20 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 83.33333333333334%;
                    max-width: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-20 {
                    inset-inline-start: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-20 {
                    inset-inline-end: 83.33333333333334%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-20 {
                    margin-inline-start:83.33333333333334%;}

                :where(.css-1588u1j).ant-col-xxl-order-20 {
                    order: 20;
                }

                :where(.css-1588u1j).ant-col-xxl-19 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 79.16666666666666%;
                    max-width: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-19 {
                    inset-inline-start: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-19 {
                    inset-inline-end: 79.16666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-19 {
                    margin-inline-start:79.16666666666666%;}

                :where(.css-1588u1j).ant-col-xxl-order-19 {
                    order: 19;
                }

                :where(.css-1588u1j).ant-col-xxl-18 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 75%;
                    max-width: 75%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-18 {
                    inset-inline-start: 75%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-18 {
                    inset-inline-end: 75%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-18 {
                    margin-inline-start:75%;}

                :where(.css-1588u1j).ant-col-xxl-order-18 {
                    order: 18;
                }

                :where(.css-1588u1j).ant-col-xxl-17 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 70.83333333333334%;
                    max-width: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-17 {
                    inset-inline-start: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-17 {
                    inset-inline-end: 70.83333333333334%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-17 {
                    margin-inline-start:70.83333333333334%;}

                :where(.css-1588u1j).ant-col-xxl-order-17 {
                    order: 17;
                }

                :where(.css-1588u1j).ant-col-xxl-16 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 66.66666666666666%;
                    max-width: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-16 {
                    inset-inline-start: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-16 {
                    inset-inline-end: 66.66666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-16 {
                    margin-inline-start:66.66666666666666%;}

                :where(.css-1588u1j).ant-col-xxl-order-16 {
                    order: 16;
                }

                :where(.css-1588u1j).ant-col-xxl-15 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 62.5%;
                    max-width: 62.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-15 {
                    inset-inline-start: 62.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-15 {
                    inset-inline-end: 62.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-15 {
                    margin-inline-start:62.5%;}

                :where(.css-1588u1j).ant-col-xxl-order-15 {
                    order: 15;
                }

                :where(.css-1588u1j).ant-col-xxl-14 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 58.333333333333336%;
                    max-width: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-14 {
                    inset-inline-start: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-14 {
                    inset-inline-end: 58.333333333333336%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-14 {
                    margin-inline-start:58.333333333333336%;}

                :where(.css-1588u1j).ant-col-xxl-order-14 {
                    order: 14;
                }

                :where(.css-1588u1j).ant-col-xxl-13 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 54.166666666666664%;
                    max-width: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-13 {
                    inset-inline-start: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-13 {
                    inset-inline-end: 54.166666666666664%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-13 {
                    margin-inline-start:54.166666666666664%;}

                :where(.css-1588u1j).ant-col-xxl-order-13 {
                    order: 13;
                }

                :where(.css-1588u1j).ant-col-xxl-12 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 50%;
                    max-width: 50%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-12 {
                    inset-inline-start: 50%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-12 {
                    inset-inline-end: 50%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-12 {
                    margin-inline-start:50%;}

                :where(.css-1588u1j).ant-col-xxl-order-12 {
                    order: 12;
                }

                :where(.css-1588u1j).ant-col-xxl-11 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 45.83333333333333%;
                    max-width: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-11 {
                    inset-inline-start: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-11 {
                    inset-inline-end: 45.83333333333333%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-11 {
                    margin-inline-start:45.83333333333333%;}

                :where(.css-1588u1j).ant-col-xxl-order-11 {
                    order: 11;
                }

                :where(.css-1588u1j).ant-col-xxl-10 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 41.66666666666667%;
                    max-width: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-10 {
                    inset-inline-start: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-10 {
                    inset-inline-end: 41.66666666666667%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-10 {
                    margin-inline-start:41.66666666666667%;}

                :where(.css-1588u1j).ant-col-xxl-order-10 {
                    order: 10;
                }

                :where(.css-1588u1j).ant-col-xxl-9 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 37.5%;
                    max-width: 37.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-9 {
                    inset-inline-start: 37.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-9 {
                    inset-inline-end: 37.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-9 {
                    margin-inline-start:37.5%;}

                :where(.css-1588u1j).ant-col-xxl-order-9 {
                    order: 9;
                }

                :where(.css-1588u1j).ant-col-xxl-8 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 33.33333333333333%;
                    max-width: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-8 {
                    inset-inline-start: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-8 {
                    inset-inline-end: 33.33333333333333%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-8 {
                    margin-inline-start:33.33333333333333%;}

                :where(.css-1588u1j).ant-col-xxl-order-8 {
                    order: 8;
                }

                :where(.css-1588u1j).ant-col-xxl-7 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 29.166666666666668%;
                    max-width: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-7 {
                    inset-inline-start: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-7 {
                    inset-inline-end: 29.166666666666668%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-7 {
                    margin-inline-start:29.166666666666668%;}

                :where(.css-1588u1j).ant-col-xxl-order-7 {
                    order: 7;
                }

                :where(.css-1588u1j).ant-col-xxl-6 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 25%;
                    max-width: 25%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-6 {
                    inset-inline-start: 25%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-6 {
                    inset-inline-end: 25%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-6 {
                    margin-inline-start:25%;}

                :where(.css-1588u1j).ant-col-xxl-order-6 {
                    order: 6;
                }

                :where(.css-1588u1j).ant-col-xxl-5 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 20.833333333333336%;
                    max-width: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-5 {
                    inset-inline-start: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-5 {
                    inset-inline-end: 20.833333333333336%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-5 {
                    margin-inline-start:20.833333333333336%;}

                :where(.css-1588u1j).ant-col-xxl-order-5 {
                    order: 5;
                }

                :where(.css-1588u1j).ant-col-xxl-4 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 16.666666666666664%;
                    max-width: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-4 {
                    inset-inline-start: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-4 {
                    inset-inline-end: 16.666666666666664%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-4 {
                    margin-inline-start:16.666666666666664%;}

                :where(.css-1588u1j).ant-col-xxl-order-4 {
                    order: 4;
                }

                :where(.css-1588u1j).ant-col-xxl-3 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 12.5%;
                    max-width: 12.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-3 {
                    inset-inline-start: 12.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-3 {
                    inset-inline-end: 12.5%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-3 {
                    margin-inline-start:12.5%;}

                :where(.css-1588u1j).ant-col-xxl-order-3 {
                    order: 3;
                }

                :where(.css-1588u1j).ant-col-xxl-2 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 8.333333333333332%;
                    max-width: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-2 {
                    inset-inline-start: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-2 {
                    inset-inline-end: 8.333333333333332%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-2 {
                    margin-inline-start:8.333333333333332%;}

                :where(.css-1588u1j).ant-col-xxl-order-2 {
                    order: 2;
                }

                :where(.css-1588u1j).ant-col-xxl-1 {
                    --ant-display: block;
                    display: block;
                    display: var(--ant-display);
                    flex: 0 0 4.166666666666666%;
                    max-width: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-push-1 {
                    inset-inline-start: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-1 {
                    inset-inline-end: 4.166666666666666%;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-1 {
                    margin-inline-start:4.166666666666666%;}

                :where(.css-1588u1j).ant-col-xxl-order-1 {
                    order: 1;
                }

                :where(.css-1588u1j).ant-col-xxl-0 {
                    display: none;
                }

                :where(.css-1588u1j).ant-col-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-xxl-push-0 {
                    inset-inline-start: auto;
                }

                :where(.css-1588u1j).ant-col-xxl-pull-0 {
                    inset-inline-end: auto;
                }

                :where(.css-1588u1j).ant-col-xxl-offset-0 {
                    margin-inline-start:0;}

                :where(.css-1588u1j).ant-col-xxl-order-0 {
                    order: 0;
                }

                :where(.css-1588u1j).ant-col-xxl-flex {
                    flex: var(--ant-col-xxl-flex);
                }
            }

            :where(.css-1588u1j)[class^="ant-input"],:where(.css-1588u1j)[class*=" ant-input"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j)[class^="ant-input"]::before,:where(.css-1588u1j)[class*=" ant-input"]::before,:where(.css-1588u1j)[class^="ant-input"]::after,:where(.css-1588u1j)[class*=" ant-input"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"],:where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"],:where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"],:where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"]::before,:where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"]::before,:where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"]::before,:where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"]::before,:where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"]::after,:where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"]::after,:where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"]::after,:where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-input {
                box-sizing: border-box;
                margin: 0;
                padding: 4px 11px;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
                line-height: 1.5714285714285714;
                list-style: none;
                font-family: var(--font-noto-sans);
                position: relative;
                display: inline-block;
                width: 100%;
                min-width: 0;
                border-radius: 6px;
                transition: all 0.2s;
            }

            :where(.css-1588u1j).ant-input::-moz-placeholder {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-input::placeholder {
                color: rgba(0, 0, 0, 0.25);
                user-select: none;
            }

            :where(.css-1588u1j).ant-input:placeholder-shown {
                text-overflow: ellipsis;
            }

            textarea:where(.css-1588u1j).ant-input {
                max-width: 100%;
                height: auto;
                min-height: 32px;
                line-height: 1.5714285714285714;
                vertical-align: bottom;
                transition: all 0.3s,height 0s;
                resize: vertical;
            }

            :where(.css-1588u1j).ant-input-lg {
                padding: 7px 11px;
                font-size: 16px;
                line-height: 1.5;
                border-radius: 8px;
            }

            :where(.css-1588u1j).ant-input-sm {
                padding: 0px 7px;
                font-size: 14px;
                border-radius: 4px;
            }

            :where(.css-1588u1j).ant-input-rtl,:where(.css-1588u1j).ant-input-textarea-rtl {
                direction: rtl;
            }

            :where(.css-1588u1j).ant-input-outlined {
                background: #ffffff;
                border-width: 1px;
                border-style: solid;
                border-color: #d9d9d9;
            }

            :where(.css-1588u1j).ant-input-outlined:hover {
                border-color: #484b75;
                background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-input-outlined:focus,:where(.css-1588u1j).ant-input-outlined:focus-within {
                border-color: #2f3268;
                box-shadow: 0 0 0 2px transparent;
                outline: 0;
                background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-disabled,:where(.css-1588u1j).ant-input-outlined[disabled] {
                color: rgba(0, 0, 0, 0.25);
                background-color: rgba(0, 0, 0, 0.04);
                border-color: #d9d9d9;
                box-shadow: none;
                cursor: not-allowed;
                opacity: 1;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-disabled input[disabled],:where(.css-1588u1j).ant-input-outlined[disabled] input[disabled],:where(.css-1588u1j).ant-input-outlined.ant-input-disabled textarea[disabled],:where(.css-1588u1j).ant-input-outlined[disabled] textarea[disabled] {
                cursor: not-allowed;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-disabled:hover:not([disabled]),:where(.css-1588u1j).ant-input-outlined[disabled]:hover:not([disabled]) {
                border-color: #d9d9d9;
                background-color: rgba(0, 0, 0, 0.04);
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) {
                background: #ffffff;
                border-width: 1px;
                border-style: solid;
                border-color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):hover {
                border-color: #ffa39e;
                background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):focus,:where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):focus-within {
                border-color: #ff4d4f;
                box-shadow: 0 0 0 2px rgba(255, 38, 5, 0.06);
                outline: 0;
                background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) .ant-input-prefix,:where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) .ant-input-suffix {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-error.ant-input-disabled {
                border-color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) {
                background: #ffffff;
                border-width: 1px;
                border-style: solid;
                border-color: #faad14;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):hover {
                border-color: #ffd666;
                background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):focus,:where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):focus-within {
                border-color: #faad14;
                box-shadow: 0 0 0 2px rgba(255, 215, 5, 0.1);
                outline: 0;
                background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) .ant-input-prefix,:where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) .ant-input-suffix {
                color: #faad14;
            }

            :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning.ant-input-disabled {
                border-color: #faad14;
            }

            :where(.css-1588u1j).ant-input-filled {
                background: rgba(0, 0, 0, 0.04);
                border-width: 1px;
                border-style: solid;
                border-color: transparent;
            }

            input:where(.css-1588u1j).ant-input-filled,:where(.css-1588u1j).ant-input-filled input,textarea:where(.css-1588u1j).ant-input-filled,:where(.css-1588u1j).ant-input-filled textarea {
                color: undefined;
            }

            :where(.css-1588u1j).ant-input-filled:hover {
                background: rgba(0, 0, 0, 0.06);
            }

            :where(.css-1588u1j).ant-input-filled:focus,:where(.css-1588u1j).ant-input-filled:focus-within {
                outline: 0;
                border-color: #2f3268;
                background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-disabled,:where(.css-1588u1j).ant-input-filled[disabled] {
                color: rgba(0, 0, 0, 0.25);
                background-color: rgba(0, 0, 0, 0.04);
                border-color: #d9d9d9;
                box-shadow: none;
                cursor: not-allowed;
                opacity: 1;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-disabled input[disabled],:where(.css-1588u1j).ant-input-filled[disabled] input[disabled],:where(.css-1588u1j).ant-input-filled.ant-input-disabled textarea[disabled],:where(.css-1588u1j).ant-input-filled[disabled] textarea[disabled] {
                cursor: not-allowed;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-disabled:hover:not([disabled]),:where(.css-1588u1j).ant-input-filled[disabled]:hover:not([disabled]) {
                border-color: #d9d9d9;
                background-color: rgba(0, 0, 0, 0.04);
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) {
                background: #fff2f0;
                border-width: 1px;
                border-style: solid;
                border-color: transparent;
            }

            input:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled),:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) input,textarea:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled),:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) textarea {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):hover {
                background: #fff1f0;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):focus,:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):focus-within {
                outline: 0;
                border-color: #ff4d4f;
                background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) .ant-input-prefix,:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) .ant-input-suffix {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) {
                background: #fffbe6;
                border-width: 1px;
                border-style: solid;
                border-color: transparent;
            }

            input:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled),:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) input,textarea:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled),:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) textarea {
                color: #faad14;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):hover {
                background: #fff1b8;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):focus,:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):focus-within {
                outline: 0;
                border-color: #faad14;
                background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) .ant-input-prefix,:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) .ant-input-suffix {
                color: #faad14;
            }

            :where(.css-1588u1j).ant-input-borderless {
                background: transparent;
                border: none;
            }

            :where(.css-1588u1j).ant-input-borderless:focus,:where(.css-1588u1j).ant-input-borderless:focus-within {
                outline: none;
            }

            :where(.css-1588u1j).ant-input-borderless.ant-input-disabled,:where(.css-1588u1j).ant-input-borderless[disabled] {
                color: rgba(0, 0, 0, 0.25);
            }

            :where(.css-1588u1j).ant-input-borderless.ant-input-status-error,:where(.css-1588u1j).ant-input-borderless.ant-input-status-error input,:where(.css-1588u1j).ant-input-borderless.ant-input-status-error textarea {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-input-borderless.ant-input-status-warning,:where(.css-1588u1j).ant-input-borderless.ant-input-status-warning input,:where(.css-1588u1j).ant-input-borderless.ant-input-status-warning textarea {
                color: #faad14;
            }

            :where(.css-1588u1j).ant-input[type="color"] {
                height: 32px;
            }

            :where(.css-1588u1j).ant-input[type="color"].ant-input-lg {
                height: 40px;
            }

            :where(.css-1588u1j).ant-input[type="color"].ant-input-sm {
                height: 24px;
                padding-top: 3px;
                padding-bottom: 3px;
            }

            :where(.css-1588u1j).ant-input[type="search"]::-webkit-search-cancel-button,:where(.css-1588u1j).ant-input[type="search"]::-webkit-search-decoration {
                -webkit-appearance: none;
            }

            :where(.css-1588u1j).ant-input-textarea {
                position: relative;
            }

            :where(.css-1588u1j).ant-input-textarea-show-count >.ant-input {
                height: 100%;
            }

            :where(.css-1588u1j).ant-input-textarea-show-count .ant-input-data-count {
                position: absolute;
                bottom: -22px;
                inset-inline-end: 0;
                color: rgba(0, 0, 0, 0.45);
                white-space: nowrap;
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-input-textarea-allow-clear>.ant-input,:where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-textarea-has-feedback .ant-input {
                padding-inline-end:24px;}

            :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper {
                padding: 0;
            }

            :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper >textarea.ant-input {
                font-size: inherit;
                border: none;
                outline: none;
                background: transparent;
            }

            :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper >textarea.ant-input:focus {
                box-shadow: none!important;
            }

            :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix {
                margin: 0;
            }

            :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix >*:not(:last-child) {
                margin-inline:0;}

            :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix .ant-input-clear-icon {
                position: absolute;
                inset-inline-end: 11px;
                inset-block-start: 8px;
            }

            :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix .ant-input-textarea-suffix {
                position: absolute;
                top: 0;
                inset-inline-end: 11px;
                bottom: 0;
                z-index: 1;
                display: inline-flex;
                align-items: center;
                margin: auto;
                pointer-events: none;
            }

            :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper-sm .ant-input-suffix .ant-input-clear-icon {
                inset-inline-end: 7px;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper {
                position: relative;
                display: inline-flex;
                width: 100%;
                min-width: 0;
                padding: 4px 11px;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
                line-height: 1.5714285714285714;
                border-radius: 6px;
                transition: all 0.2s;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper::-moz-placeholder {
                opacity: 1;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper::placeholder {
                color: rgba(0, 0, 0, 0.25);
                user-select: none;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper:placeholder-shown {
                text-overflow: ellipsis;
            }

            textarea:where(.css-1588u1j).ant-input-affix-wrapper {
                max-width: 100%;
                height: auto;
                min-height: 32px;
                line-height: 1.5714285714285714;
                vertical-align: bottom;
                transition: all 0.3s,height 0s;
                resize: vertical;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper-lg {
                padding: 7px 11px;
                font-size: 16px;
                line-height: 1.5;
                border-radius: 8px;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper-sm {
                padding: 0px 7px;
                font-size: 14px;
                border-radius: 4px;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper-rtl,:where(.css-1588u1j).ant-input-affix-wrapper-textarea-rtl {
                direction: rtl;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper:not(.ant-input-disabled):hover {
                z-index: 1;
            }

            .ant-input-search-with-button :where(.css-1588u1j).ant-input-affix-wrapper:not(.ant-input-disabled):hover {
                z-index: 0;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper-focused,:where(.css-1588u1j).ant-input-affix-wrapper:focus {
                z-index: 1;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper >input.ant-input {
                padding: 0;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper >input.ant-input,:where(.css-1588u1j).ant-input-affix-wrapper >textarea.ant-input {
                font-size: inherit;
                border: none;
                border-radius: 0;
                outline: none;
                background: transparent;
                color: inherit;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper >input.ant-input::-ms-reveal,:where(.css-1588u1j).ant-input-affix-wrapper >textarea.ant-input::-ms-reveal {
                display: none;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper >input.ant-input:focus,:where(.css-1588u1j).ant-input-affix-wrapper >textarea.ant-input:focus {
                box-shadow: none!important;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper::before {
                display: inline-block;
                width: 0;
                visibility: hidden;
                content: "\a0";
            }

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix,:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix {
                display: flex;
                flex: none;
                align-items: center;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix >*:not(:last-child),:where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix >*:not(:last-child) {
                margin-inline-end:8px;}

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-show-count-suffix {
                color: rgba(0, 0, 0, 0.45);
            }

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-show-count-has-suffix {
                margin-inline-end:4px;}

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix {
                margin-inline-end:4px;}

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix {
                margin-inline-start:4px;}

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon {
                margin: 0;
                color: rgba(0, 0, 0, 0.25);
                font-size: 12px;
                vertical-align: -1px;
                cursor: pointer;
                transition: color 0.3s;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon:hover {
                color: rgba(0, 0, 0, 0.45);
            }

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon:active {
                color: rgba(0, 0, 0, 0.88);
            }

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon-hidden {
                visibility: hidden;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-clear-icon-has-suffix {
                margin: 0 4px;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper .anticon.ant-input-password-icon {
                color: rgba(0, 0, 0, 0.45);
                cursor: pointer;
                transition: all 0.3s;
            }

            :where(.css-1588u1j).ant-input-affix-wrapper .anticon.ant-input-password-icon:hover {
                color: rgba(0, 0, 0, 0.88);
            }

            :where(.css-1588u1j).ant-input-group {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
                line-height: 1.5714285714285714;
                list-style: none;
                font-family: var(--font-noto-sans);
                position: relative;
                display: table;
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }

            :where(.css-1588u1j).ant-input-group[class*='col-'] {
                padding-inline-end:8px;}

            :where(.css-1588u1j).ant-input-group[class*='col-']:last-child {
                padding-inline-end:0;}

            :where(.css-1588u1j).ant-input-group-lg .ant-input,:where(.css-1588u1j).ant-input-group-lg>.ant-input-group-addon {
                padding: 7px 11px;
                font-size: 16px;
                line-height: 1.5;
                border-radius: 8px;
            }

            :where(.css-1588u1j).ant-input-group-sm .ant-input,:where(.css-1588u1j).ant-input-group-sm>.ant-input-group-addon {
                padding: 0px 7px;
                font-size: 14px;
                border-radius: 4px;
            }

            :where(.css-1588u1j).ant-input-group-lg .ant-select-single .ant-select-selector {
                height: 40px;
            }

            :where(.css-1588u1j).ant-input-group-sm .ant-select-single .ant-select-selector {
                height: 24px;
            }

            :where(.css-1588u1j).ant-input-group >.ant-input {
                display: table-cell;
            }

            :where(.css-1588u1j).ant-input-group >.ant-input:not(:first-child):not(:last-child) {
                border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-group-addon,:where(.css-1588u1j).ant-input-group .ant-input-group-wrap {
                display: table-cell;
                width: 1px;
                white-space: nowrap;
                vertical-align: middle;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-group-addon:not(:first-child):not(:last-child),:where(.css-1588u1j).ant-input-group .ant-input-group-wrap:not(:first-child):not(:last-child) {
                border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-group-wrap>* {
                display: block!important;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-group-addon {
                position: relative;
                padding: 0 11px;
                color: rgba(0, 0, 0, 0.88);
                font-weight: normal;
                font-size: 14px;
                text-align: center;
                border-radius: 6px;
                transition: all 0.3s;
                line-height: 1;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select {
                margin: -5px -11px;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select.ant-select-single:not(.ant-select-customize-input):not(.ant-pagination-size-changer) .ant-select-selector {
                background-color: inherit;
                border: 1px solid transparent;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select-open .ant-select-selector,:where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select-focused .ant-select-selector {
                color: #2f3268;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-cascader-picker {
                margin: -9px -11px;
                background-color: transparent;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-cascader-picker .ant-cascader-input {
                text-align: start;
                border: 0;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-input-group .ant-input {
                width: 100%;
                margin-bottom: 0;
                text-align: inherit;
            }

            :where(.css-1588u1j).ant-input-group .ant-input:focus {
                z-index: 1;
                border-inline-end-width:1px;}

            :where(.css-1588u1j).ant-input-group .ant-input:hover {
                z-index: 1;
                border-inline-end-width:1px;}

            .ant-input-search-with-button :where(.css-1588u1j).ant-input-group .ant-input:hover {
                z-index: 0;
            }

            :where(.css-1588u1j).ant-input-group >.ant-input:first-child,:where(.css-1588u1j).ant-input-group .ant-input-group-addon:first-child {
                border-start-end-radius: 0;
                border-end-end-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group >.ant-input:first-child .ant-select .ant-select-selector,:where(.css-1588u1j).ant-input-group .ant-input-group-addon:first-child .ant-select .ant-select-selector {
                border-start-end-radius: 0;
                border-end-end-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group >.ant-input-affix-wrapper:not(:first-child) .ant-input {
                border-start-start-radius: 0;
                border-end-start-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group >.ant-input-affix-wrapper:not(:last-child) .ant-input {
                border-start-end-radius: 0;
                border-end-end-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group >.ant-input:last-child,:where(.css-1588u1j).ant-input-group .ant-input-group-addon:last-child {
                border-start-start-radius: 0;
                border-end-start-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group >.ant-input:last-child .ant-select .ant-select-selector,:where(.css-1588u1j).ant-input-group .ant-input-group-addon:last-child .ant-select .ant-select-selector {
                border-start-start-radius: 0;
                border-end-start-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:last-child) {
                border-start-end-radius: 0;
                border-end-end-radius: 0;
            }

            .ant-input-search :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:last-child) {
                border-start-start-radius: 6px;
                border-end-start-radius: 6px;
            }

            :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:first-child),.ant-input-search :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:first-child) {
                border-start-start-radius: 0;
                border-end-start-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact {
                display: block;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact::before {
                display: table;
                content: "";
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact::after {
                display: table;
                clear: both;
                content: "";
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child),:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child),:where(.css-1588u1j).ant-input-group.ant-input-group-compact >.ant-input:not(:first-child):not(:last-child) {
                border-inline-end-width:1px;}

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child):hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child):hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact >.ant-input:not(:first-child):not(:last-child):hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child):focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child):focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact >.ant-input:not(:first-child):not(:last-child):focus {
                z-index: 1;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>* {
                display: inline-flex;
                float: none;
                vertical-align: top;
                border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-affix-wrapper,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-number-affix-wrapper,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-picker-range {
                display: inline-flex;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:not(:last-child) {
                margin-inline-end:-1px;border-inline-end-width:1px;}

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input {
                float: none;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input {
                border-inline-end-width:1px;border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector:hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input:hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input:hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input:hover,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector:focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input:focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input:focus,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input:focus {
                z-index: 1;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-focused {
                z-index: 1;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-arrow {
                z-index: 1;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:first-child,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select:first-child>.ant-select-selector,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete:first-child .ant-input,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker:first-child .ant-input {
                border-start-start-radius: 6px;
                border-end-start-radius: 6px;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:last-child,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select:last-child>.ant-select-selector,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker:last-child .ant-input,:where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker-focused:last-child .ant-input {
                border-inline-end-width:1px;border-start-end-radius: 6px;
                border-end-end-radius: 6px;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input {
                vertical-align: top;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper+.ant-input-group-wrapper {
                margin-inline-start:-1px;}

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper+.ant-input-group-wrapper .ant-input-affix-wrapper {
                border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper:not(:last-child).ant-input-search>.ant-input-group>.ant-input-group-addon>.ant-input-search-button {
                border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper:not(:last-child).ant-input-search>.ant-input-group>.ant-input {
                border-start-start-radius: 6px;
                border-start-end-radius: 0;
                border-end-end-radius: 0;
                border-end-start-radius: 6px;
            }

            :where(.css-1588u1j).ant-input-group-rtl {
                direction: rtl;
            }

            :where(.css-1588u1j).ant-input-group-wrapper {
                display: inline-block;
                width: 100%;
                text-align: start;
                vertical-align: top;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-rtl {
                direction: rtl;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-lg .ant-input-group-addon {
                border-radius: 8px;
                font-size: 16px;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-sm .ant-input-group-addon {
                border-radius: 4px;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon {
                background: rgba(0, 0, 0, 0.02);
                border: 1px solid #d9d9d9;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon:first-child {
                border-inline-end:0;}

            :where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon:last-child {
                border-inline-start:0;}

            :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-status-error .ant-input-group-addon {
                border-color: #ff4d4f;
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-status-warning .ant-input-group-addon {
                border-color: #faad14;
                color: #faad14;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon {
                color: rgba(0, 0, 0, 0.25);
                background-color: rgba(0, 0, 0, 0.04);
                border-color: #d9d9d9;
                box-shadow: none;
                cursor: not-allowed;
                opacity: 1;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon input[disabled],:where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon textarea[disabled] {
                cursor: not-allowed;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon:hover:not([disabled]) {
                border-color: #d9d9d9;
                background-color: rgba(0, 0, 0, 0.04);
            }

            :where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group-addon {
                background: rgba(0, 0, 0, 0.04);
            }

            :where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group .ant-input-filled:not(:focus):not(:focus-within):not(:first-child) {
                border-inline-start:1px solid rgba(5, 5, 5, 0.06);}

            :where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group .ant-input-filled:not(:focus):not(:focus-within):not(:last-child) {
                border-inline-end:1px solid rgba(5, 5, 5, 0.06);}

            :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-status-error .ant-input-group-addon {
                background: #fff2f0;
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-status-warning .ant-input-group-addon {
                background: #fffbe6;
                color: #faad14;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon {
                background: rgba(0, 0, 0, 0.04);
                color: rgba(0, 0, 0, 0.25);
            }

            :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon:first-child {
                border-inline-start:1px solid #d9d9d9;border-top: 1px solid #d9d9d9;
                border-bottom: 1px solid #d9d9d9;
            }

            :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon:last-child {
                border-inline-end:1px solid #d9d9d9;border-top: 1px solid #d9d9d9;
                border-bottom: 1px solid #d9d9d9;
            }

            :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item).ant-input-compact-item .ant-input,:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item).ant-input-compact-item .ant-input-group-addon {
                border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-first-item .ant-input,:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-first-item .ant-input-group-addon {
                border-start-end-radius: 0;
                border-end-end-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item).ant-input-compact-last-item .ant-input,:where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item).ant-input-compact-last-item .ant-input-group-addon {
                border-start-start-radius: 0;
                border-end-start-radius: 0;
            }

            :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-item .ant-input-affix-wrapper {
                border-start-end-radius: 0;
                border-end-end-radius: 0;
            }

            :where(.css-1588u1j).ant-input-search .ant-input:hover,:where(.css-1588u1j).ant-input-search .ant-input:focus {
                border-color: #484b75;
            }

            :where(.css-1588u1j).ant-input-search .ant-input:hover +.ant-input-group-addon .ant-input-search-button:not(.ant-btn-primary),:where(.css-1588u1j).ant-input-search .ant-input:focus +.ant-input-group-addon .ant-input-search-button:not(.ant-btn-primary) {
                border-inline-start-color:#484b75;}

            :where(.css-1588u1j).ant-input-search .ant-input-affix-wrapper {
                border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-search .ant-input-lg {
                line-height: 1.4998;
            }

            :where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child {
                inset-inline-start: -1px;
                padding: 0;
                border: 0;
            }

            :where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button {
                margin-inline-end:-1px;padding-top: 0;
                padding-bottom: 0;
                border-start-start-radius: 0;
                border-start-end-radius: 6px;
                border-end-end-radius: 6px;
                border-end-start-radius: 0;
                box-shadow: none;
            }

            :where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary) {
                color: rgba(0, 0, 0, 0.45);
            }

            :where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary):hover {
                color: #484b75;
            }

            :where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary):active {
                color: #1b1b42;
            }

            :where(.css-1588u1j).ant-input-search >.ant-input-group >.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary).ant-btn-loading::before {
                inset-inline-start: 0;
                inset-inline-end: 0;
                inset-block-start: 0;
                inset-block-end: 0;
            }

            :where(.css-1588u1j).ant-input-search .ant-input-search-button {
                height: 32px;
            }

            :where(.css-1588u1j).ant-input-search .ant-input-search-button:hover,:where(.css-1588u1j).ant-input-search .ant-input-search-button:focus {
                z-index: 1;
            }

            :where(.css-1588u1j).ant-input-search-large .ant-input-search-button {
                height: 40px;
            }

            :where(.css-1588u1j).ant-input-search-small .ant-input-search-button {
                height: 24px;
            }

            :where(.css-1588u1j).ant-input-search-rtl {
                direction: rtl;
            }

            :where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-last-item) .ant-input-group-addon .ant-input-search-button {
                margin-inline-end:-1px;border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-first-item) .ant-input,:where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-first-item) .ant-input-affix-wrapper {
                border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input-group-addon .ant-input-search-button:hover,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input:hover,:where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:hover,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input-group-addon .ant-input-search-button:focus,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input:focus,:where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:focus,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input-group-addon .ant-input-search-button:active,:where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input:active,:where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:active {
                z-index: 2;
            }

            :where(.css-1588u1j).ant-input-search.ant-input-compact-item >.ant-input-affix-wrapper-focused {
                z-index: 2;
            }

            :where(.css-1588u1j).ant-input-out-of-range,:where(.css-1588u1j).ant-input-out-of-range input,:where(.css-1588u1j).ant-input-out-of-range textarea,:where(.css-1588u1j).ant-input-out-of-range .ant-input-show-count-suffix,:where(.css-1588u1j).ant-input-out-of-range .ant-input-data-count {
                color: #ff4d4f;
            }

            :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item) {
                margin-inline-end:-1px;}

            :where(.css-1588u1j).ant-input-compact-item:hover,:where(.css-1588u1j).ant-input-compact-item:focus,:where(.css-1588u1j).ant-input-compact-item:active {
                z-index: 2;
            }

            :where(.css-1588u1j).ant-input-compact-item[disabled] {
                z-index: 0;
            }

            :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item) {
                border-radius: 0;
            }

            :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item,:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item.ant-input-sm,:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item.ant-input-lg {
                border-start-end-radius: 0;
                border-end-end-radius: 0;
            }

            :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item,:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item.ant-input-sm,:where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item.ant-input-lg {
                border-start-start-radius: 0;
                border-end-start-radius: 0;
            }

            :where(.css-1588u1j).ant-tour {
                font-family: var(--font-noto-sans);
                font-size: 14px;
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-tour::before,:where(.css-1588u1j).ant-tour::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-tour [class^="ant-tour"],:where(.css-1588u1j).ant-tour [class*=" ant-tour"] {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-tour [class^="ant-tour"]::before,:where(.css-1588u1j).ant-tour [class*=" ant-tour"]::before,:where(.css-1588u1j).ant-tour [class^="ant-tour"]::after,:where(.css-1588u1j).ant-tour [class*=" ant-tour"]::after {
                box-sizing: border-box;
            }

            :where(.css-1588u1j).ant-tour {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                color: rgba(0, 0, 0, 0.88);
                font-size: 14px;
                line-height: 1.5714285714285714;
                list-style: none;
                font-family: var(--font-noto-sans);
                position: absolute;
                z-index: undefined;
                max-width: fit-content;
                visibility: visible;
                width: 520px;
                --antd-arrow-background-color: #ffffff;
            }

            :where(.css-1588u1j).ant-tour-pure {
                max-width: 100%;
                position: relative;
            }

            :where(.css-1588u1j).ant-tour.ant-tour-hidden {
                display: none;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-content {
                position: relative;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner {
                text-align: start;
                text-decoration: none;
                border-radius: 8px;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03),0 1px 6px -1px rgba(0, 0, 0, 0.02),0 2px 4px 0 rgba(0, 0, 0, 0.02);
                position: relative;
                background-color: #ffffff;
                border: none;
                background-clip: padding-box;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-close {
                position: absolute;
                top: 16px;
                inset-inline-end: 16px;
                color: rgba(0, 0, 0, 0.45);
                background: none;
                border: none;
                width: 22px;
                height: 22px;
                border-radius: 4px;
                transition: background-color 0.2s,color 0.2s;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-close:hover {
                color: rgba(0, 0, 0, 0.88);
                background-color: rgba(0, 0, 0, 0.06);
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-close:active {
                background-color: rgba(0, 0, 0, 0.15);
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-close:focus-visible {
                outline: 4px solid #85868f;
                outline-offset: 1px;
                transition: outline-offset 0s,outline 0s;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-cover {
                text-align: center;
                padding: 46px 16px 0;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-cover img {
                width: 100%;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-header {
                padding: 16px 16px 8px;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-header .ant-tour-title {
                font-weight: 600;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-description {
                padding: 0 16px;
                word-wrap: break-word;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer {
                padding: 8px 16px 16px;
                text-align: end;
                border-radius: 0 0 2px 2px;
                display: flex;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-indicators {
                display: inline-block;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-indicators .ant-tour-indicator {
                width: 6px;
                height: 6px;
                display: inline-block;
                border-radius: 50%;
                background: rgba(0, 0, 0, 0.15);
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-indicators .ant-tour-indicator:not(:last-child) {
                margin-inline-end:6px;}

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-indicators .ant-tour-indicator-active {
                background: #2f3268;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-buttons {
                margin-inline-start:auto;}

            :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-buttons .ant-btn {
                margin-inline-start:8px;}

            :where(.css-1588u1j).ant-tour .ant-tour-primary,:where(.css-1588u1j).ant-tour.ant-tour-primary {
                --antd-arrow-background-color: #2f3268;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner,:where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner {
                color: #fff;
                text-align: start;
                text-decoration: none;
                background-color: #2f3268;
                border-radius: 6px;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03),0 1px 6px -1px rgba(0, 0, 0, 0.02),0 2px 4px 0 rgba(0, 0, 0, 0.02);
            }

            :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-close,:where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-close {
                color: #fff;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator,:where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator {
                background: rgba(255, 255, 255, 0.15);
            }

            :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator-active,:where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator-active {
                background: #fff;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-prev-btn,:where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-prev-btn {
                color: #fff;
                border-color: rgba(255, 255, 255, 0.15);
                background-color: #2f3268;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-prev-btn:hover,:where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-prev-btn:hover {
                background-color: rgba(255, 255, 255, 0.15);
                border-color: transparent;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-next-btn,:where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-next-btn {
                color: #2f3268;
                border-color: transparent;
                background: #fff;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-next-btn:hover,:where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-next-btn:hover {
                background: rgb(240, 240, 240);
            }

            :where(.css-1588u1j).ant-tour-mask .ant-tour-placeholder-animated {
                transition: all 0.3s;
            }

            :where(.css-1588u1j)-placement-left .ant-tour-inner,:where(.css-1588u1j)-placement-leftTop .ant-tour-inner,:where(.css-1588u1j)-placement-leftBottom .ant-tour-inner,:where(.css-1588u1j)-placement-right .ant-tour-inner,:where(.css-1588u1j)-placement-rightTop .ant-tour-inner,:where(.css-1588u1j)-placement-rightBottom .ant-tour-inner {
                border-radius: 8px;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-arrow {
                position: absolute;
                z-index: 1;
                display: block;
                pointer-events: none;
                width: 16px;
                height: 16px;
                overflow: hidden;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-arrow::before {
                position: absolute;
                bottom: 0;
                inset-inline-start: 0;
                width: 16px;
                height: 8px;
                background: var(--antd-arrow-background-color);
                clip-path: polygon(1.6568542494923806px 100%, 50% 1.6568542494923806px, 14.34314575050762px 100%, 1.6568542494923806px 100%);
                clip-path: path('M 0 8 A 4 4 0 0 0 2.82842712474619 6.82842712474619 L 6.585786437626905 3.0710678118654755 A 2 2 0 0 1 9.414213562373096 3.0710678118654755 L 13.17157287525381 6.82842712474619 A 4 4 0 0 0 16 8 Z');
                content: "";
            }

            :where(.css-1588u1j).ant-tour .ant-tour-arrow::after {
                content: "";
                position: absolute;
                width: 8.970562748477143px;
                height: 8.970562748477143px;
                bottom: 0;
                inset-inline: 0;
                margin: auto;
                border-radius: 0 0 2px 0;
                transform: translateY(50%) rotate(-135deg);
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.05);
                z-index: 0;
                background: transparent;
            }

            :where(.css-1588u1j).ant-tour .ant-tour-arrow:before {
                background: var(--antd-arrow-background-color);
            }

            :where(.css-1588u1j).ant-tour-placement-top>.ant-tour-arrow,:where(.css-1588u1j).ant-tour-placement-topLeft>.ant-tour-arrow,:where(.css-1588u1j).ant-tour-placement-topRight>.ant-tour-arrow {
                bottom: 0;
                transform: translateY(100%) rotate(180deg);
            }

            :where(.css-1588u1j).ant-tour-placement-top>.ant-tour-arrow {
                left: 50%;
                transform: translateX(-50%) translateY(100%) rotate(180deg);
            }

            :where(.css-1588u1j).ant-tour-placement-topLeft>.ant-tour-arrow {
                left: 12px;
            }

            :where(.css-1588u1j).ant-tour-placement-topRight>.ant-tour-arrow {
                right: 12px;
            }

            :where(.css-1588u1j).ant-tour-placement-bottom>.ant-tour-arrow,:where(.css-1588u1j).ant-tour-placement-bottomLeft>.ant-tour-arrow,:where(.css-1588u1j).ant-tour-placement-bottomRight>.ant-tour-arrow {
                top: 0;
                transform: translateY(-100%);
            }

            :where(.css-1588u1j).ant-tour-placement-bottom>.ant-tour-arrow {
                left: 50%;
                transform: translateX(-50%) translateY(-100%);
            }

            :where(.css-1588u1j).ant-tour-placement-bottomLeft>.ant-tour-arrow {
                left: 12px;
            }

            :where(.css-1588u1j).ant-tour-placement-bottomRight>.ant-tour-arrow {
                right: 12px;
            }

            :where(.css-1588u1j).ant-tour-placement-left>.ant-tour-arrow,:where(.css-1588u1j).ant-tour-placement-leftTop>.ant-tour-arrow,:where(.css-1588u1j).ant-tour-placement-leftBottom>.ant-tour-arrow {
                right: 0;
                transform: translateX(100%) rotate(90deg);
            }

            :where(.css-1588u1j).ant-tour-placement-left>.ant-tour-arrow {
                top: 50%;
                transform: translateY(-50%) translateX(100%) rotate(90deg);
            }

            :where(.css-1588u1j).ant-tour-placement-leftTop>.ant-tour-arrow {
                top: 8px;
            }

            :where(.css-1588u1j).ant-tour-placement-leftBottom>.ant-tour-arrow {
                bottom: 8px;
            }

            :where(.css-1588u1j).ant-tour-placement-right>.ant-tour-arrow,:where(.css-1588u1j).ant-tour-placement-rightTop>.ant-tour-arrow,:where(.css-1588u1j).ant-tour-placement-rightBottom>.ant-tour-arrow {
                left: 0;
                transform: translateX(-100%) rotate(-90deg);
            }

            :where(.css-1588u1j).ant-tour-placement-right>.ant-tour-arrow {
                top: 50%;
                transform: translateY(-50%) translateX(-100%) rotate(-90deg);
            }

            :where(.css-1588u1j).ant-tour-placement-rightTop>.ant-tour-arrow {
                top: 8px;
            }

            :where(.css-1588u1j).ant-tour-placement-rightBottom>.ant-tour-arrow {
                bottom: 8px;
            }

            @media screen and (-ms-high-contrast: active),(-ms-high-contrast: none) {
                :where(.css-1588u1j).ant-form-item-control {
                    display: flex;
                }
            }

            .anticon {
                display: inline-flex;
                align-items: center;
                color: inherit;
                font-style: normal;
                line-height: 0;
                text-align: center;
                text-transform: none;
                vertical-align: -0.125em;
                text-rendering: optimizeLegibility;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            .anticon >* {
                line-height: 1;
            }

            .anticon svg {
                display: inline-block;
            }

            .anticon .anticon .anticon-icon {
                display: block;
            }

            .anticon {
                display: inline-flex;
                align-items: center;
                color: inherit;
                font-style: normal;
                line-height: 0;
                text-align: center;
                text-transform: none;
                vertical-align: -0.125em;
                text-rendering: optimizeLegibility;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            .anticon >* {
                line-height: 1;
            }

            .anticon svg {
                display: inline-block;
            }

            .anticon .anticon .anticon-icon {
                display: block;
            }

            .data-ant-cssinjs-cache-path {
                content: "3hyxim|ant-design-icons|anticon:n18rlk;54mug8|ant-design-icons|anticon:1i7nym9;54mug8|Shared|ant:1ijft1f;54mug8|Layout-Layout|ant-layout|anticon:tnknc0;54mug8|Button-Button|ant-btn|anticon:1cfhi6l;54mug8|Wave-Wave|ant-wave|anticon:6oh8ov;54mug8|Drawer-Drawer|ant-drawer|anticon:oz1ynp;54mug8|Form-Form|ant-form|anticon:nffb1q;54mug8|Dropdown-Dropdown|ant-dropdown|anticon:zn7yoh;54mug8|Grid-Grid|ant-row|anticon:1w2fmdc;54mug8|Grid-Grid|ant-col|anticon:4t782p;54mug8|Input-Input|ant-input|anticon:rrxlx5;54mug8|Form-item-item|ant-form|anticon:122uzvn;54mug8|Tour-Tour|ant-tour|anticon:1vvwohf";
            }
        </style>
            <style data-rc-order="prependQueue" data-rc-priority="-1000" data-css-hash="nffb1q" data-token-hash="54mug8">:where(.css-1588u1j)[class^="ant-form"],:where(.css-1588u1j)[class*=" ant-form"]{font-family:var(--font-noto-sans);font-size:14px;box-sizing:border-box;}:where(.css-1588u1j)[class^="ant-form"]::before,:where(.css-1588u1j)[class*=" ant-form"]::before,:where(.css-1588u1j)[class^="ant-form"]::after,:where(.css-1588u1j)[class*=" ant-form"]::after{box-sizing:border-box;}:where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"],:where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"],:where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"],:where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"]{box-sizing:border-box;}:where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"]::before,:where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"]::before,:where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"]::before,:where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"]::before,:where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"]::after,:where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"]::after,:where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"]::after,:where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"]::after{box-sizing:border-box;}:where(.css-1588u1j).ant-form{box-sizing:border-box;margin:0;padding:0;color:rgba(0, 0, 0, 0.88);font-size:14px;line-height:1.5714285714285714;list-style:none;font-family:var(--font-noto-sans);}:where(.css-1588u1j).ant-form legend{display:block;width:100%;margin-bottom:24px;padding:0;color:rgba(0, 0, 0, 0.45);font-size:16px;line-height:inherit;border:0;border-bottom:1px solid #d9d9d9;}:where(.css-1588u1j).ant-form input[type="search"]{box-sizing:border-box;}:where(.css-1588u1j).ant-form input[type="radio"],:where(.css-1588u1j).ant-form input[type="checkbox"]{line-height:normal;}:where(.css-1588u1j).ant-form input[type="file"]{display:block;}:where(.css-1588u1j).ant-form input[type="range"]{display:block;width:100%;}:where(.css-1588u1j).ant-form select[multiple],:where(.css-1588u1j).ant-form select[size]{height:auto;}:where(.css-1588u1j).ant-form input[type='file']:focus,:where(.css-1588u1j).ant-form input[type='radio']:focus,:where(.css-1588u1j).ant-form input[type='checkbox']:focus{outline:0;box-shadow:0 0 0 2px transparent;}:where(.css-1588u1j).ant-form output{display:block;padding-top:15px;color:rgba(0, 0, 0, 0.88);font-size:14px;line-height:1.5714285714285714;}:where(.css-1588u1j).ant-form .ant-form-text{display:inline-block;padding-inline-end:12px;}:where(.css-1588u1j).ant-form-small .ant-form-item .ant-form-item-label>label{height:24px;}:where(.css-1588u1j).ant-form-small .ant-form-item .ant-form-item-control-input{min-height:24px;}:where(.css-1588u1j).ant-form-large .ant-form-item .ant-form-item-label>label{height:40px;}:where(.css-1588u1j).ant-form-large .ant-form-item .ant-form-item-control-input{min-height:40px;}:where(.css-1588u1j).ant-form-item{box-sizing:border-box;margin:0;padding:0;color:rgba(0, 0, 0, 0.88);font-size:14px;line-height:1.5714285714285714;list-style:none;font-family:var(--font-noto-sans);margin-bottom:24px;vertical-align:top;}:where(.css-1588u1j).ant-form-item-with-help{transition:none;}:where(.css-1588u1j).ant-form-item-hidden,:where(.css-1588u1j).ant-form-item-hidden.ant-row{display:none;}:where(.css-1588u1j).ant-form-item-has-warning .ant-form-item-split{color:#ff4d4f;}:where(.css-1588u1j).ant-form-item-has-error .ant-form-item-split{color:#faad14;}:where(.css-1588u1j).ant-form-item .ant-form-item-label{flex-grow:0;overflow:hidden;white-space:nowrap;text-align:end;vertical-align:middle;}:where(.css-1588u1j).ant-form-item .ant-form-item-label-left{text-align:start;}:where(.css-1588u1j).ant-form-item .ant-form-item-label-wrap{overflow:unset;line-height:1.5714285714285714;white-space:unset;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label{position:relative;display:inline-flex;align-items:center;max-width:100%;height:32px;color:rgba(0, 0, 0, 0.88);font-size:14px;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label >.anticon{font-size:14px;vertical-align:top;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label.ant-form-item-required:not(.ant-form-item-required-mark-optional)::before{display:inline-block;margin-inline-end:4px;color:#ff4d4f;font-size:14px;font-family:SimSun,sans-serif;line-height:1;content:"*";}.ant-form-hide-required-mark :where(.css-1588u1j).ant-form-item .ant-form-item-label >label.ant-form-item-required:not(.ant-form-item-required-mark-optional)::before{display:none;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label .ant-form-item-optional{display:inline-block;margin-inline-start:4px;color:rgba(0, 0, 0, 0.45);}.ant-form-hide-required-mark :where(.css-1588u1j).ant-form-item .ant-form-item-label >label .ant-form-item-optional{display:none;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label .ant-form-item-tooltip{color:rgba(0, 0, 0, 0.45);cursor:help;writing-mode:horizontal-tb;margin-inline-start:4px;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label::after{content:":";position:relative;margin-block:0;margin-inline-start:2px;margin-inline-end:8px;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label.ant-form-item-no-colon::after{content:"\a0";}:where(.css-1588u1j).ant-form-item .ant-form-item-control{--ant-display:flex;flex-direction:column;flex-grow:1;}:where(.css-1588u1j).ant-form-item .ant-form-item-control:first-child:not([class^="'ant-col-'"]):not([class*="' ant-col-'"]){width:100%;}:where(.css-1588u1j).ant-form-item .ant-form-item-control-input{position:relative;display:flex;align-items:center;min-height:32px;}:where(.css-1588u1j).ant-form-item .ant-form-item-control-input-content{flex:auto;max-width:100%;}:where(.css-1588u1j).ant-form-item .ant-form-item-explain,:where(.css-1588u1j).ant-form-item .ant-form-item-extra{clear:both;color:rgba(0, 0, 0, 0.45);font-size:14px;line-height:1.5714285714285714;}:where(.css-1588u1j).ant-form-item .ant-form-item-explain-connected{width:100%;}:where(.css-1588u1j).ant-form-item .ant-form-item-extra{min-height:24px;transition:color 0.2s cubic-bezier(0.215, 0.61, 0.355, 1);}:where(.css-1588u1j).ant-form-item .ant-form-item-explain-error{color:#ff4d4f;}:where(.css-1588u1j).ant-form-item .ant-form-item-explain-warning{color:#faad14;}:where(.css-1588u1j).ant-form-item-with-help .ant-form-item-explain{height:auto;opacity:1;}:where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon{font-size:14px;text-align:center;visibility:visible;animation-name:css-1588u1j-antZoomIn;animation-duration:0.2s;animation-timing-function:cubic-bezier(0.12, 0.4, 0.29, 1.46);pointer-events:none;}:where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-success{color:#52c41a;}:where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-error{color:#ff4d4f;}:where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-warning{color:#faad14;}:where(.css-1588u1j).ant-form-item .ant-form-item-feedback-icon-validating{color:#2f3268;}:where(.css-1588u1j).ant-form-show-help{transition:opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);}:where(.css-1588u1j).ant-form-show-help-appear,:where(.css-1588u1j).ant-form-show-help-enter{opacity:0;}:where(.css-1588u1j).ant-form-show-help-appear-active,:where(.css-1588u1j).ant-form-show-help-enter-active{opacity:1;}:where(.css-1588u1j).ant-form-show-help-leave{opacity:1;}:where(.css-1588u1j).ant-form-show-help-leave-active{opacity:0;}:where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item{overflow:hidden;transition:height 0.3s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1),transform 0.3s cubic-bezier(0.645, 0.045, 0.355, 1)!important;}:where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-appear,:where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-enter{transform:translateY(-5px);opacity:0;}:where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-appear-active,:where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-enter-active{transform:translateY(0);opacity:1;}:where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-leave-active{transform:translateY(-5px);}:where(.css-1588u1j).ant-form-horizontal .ant-form-item-label{flex-grow:0;}:where(.css-1588u1j).ant-form-horizontal .ant-form-item-control{flex:1 1 0;min-width:0;}:where(.css-1588u1j).ant-form-horizontal .ant-form-item-label[class$='-24']+.ant-form-item-control,:where(.css-1588u1j).ant-form-horizontal .ant-form-item-label[class*='-24 ']+.ant-form-item-control{min-width:unset;}:where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label{flex-grow:0;}:where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-control{flex:1 1 0;min-width:0;}:where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label[class$='-24']+.ant-form-item-control,:where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label[class*='-24 ']+.ant-form-item-control{min-width:unset;}:where(.css-1588u1j).ant-form-inline{display:flex;flex-wrap:wrap;}:where(.css-1588u1j).ant-form-inline .ant-form-item{flex:none;margin-inline-end:16px;margin-bottom:0;}:where(.css-1588u1j).ant-form-inline .ant-form-item-row{flex-wrap:nowrap;}:where(.css-1588u1j).ant-form-inline .ant-form-item >.ant-form-item-label,:where(.css-1588u1j).ant-form-inline .ant-form-item >.ant-form-item-control{display:inline-block;vertical-align:top;}:where(.css-1588u1j).ant-form-inline .ant-form-item >.ant-form-item-label{flex:none;}:where(.css-1588u1j).ant-form-inline .ant-form-item .ant-form-text{display:inline-block;}:where(.css-1588u1j).ant-form-inline .ant-form-item .ant-form-item-has-feedback{display:inline-block;}:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-row{flex-direction:column;}:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label>label{height:auto;}:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-control{width:100%;}:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label >label,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label >label,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label >label::after,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label >label::after,:where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label >label::after{visibility:hidden;}@media (max-width: 575px){:where(.css-1588u1j).ant-form-item .ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label::after{visibility:hidden;}:where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item{flex-wrap:wrap;}:where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-label:not([class*=" ant-col-xs"]),:where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-control:not([class*=" ant-col-xs"]){flex:0 0 100%;max-width:100%;}:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label >label::after{visibility:hidden;}}@media (max-width: 767px){:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label >label::after{visibility:hidden;}}@media (max-width: 991px){:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label >label::after{visibility:hidden;}}@media (max-width: 1199px){:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label >label::after{visibility:hidden;}}:where(.css-1588u1j).ant-form-item-vertical .ant-form-item-row{flex-direction:column;}:where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label>label{height:auto;}:where(.css-1588u1j).ant-form-item-vertical .ant-form-item-control{width:100%;}:where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label,:where(.css-1588u1j).ant-col-24.ant-form-item-label,:where(.css-1588u1j).ant-col-xl-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label >label,:where(.css-1588u1j).ant-col-24.ant-form-item-label >label,:where(.css-1588u1j).ant-col-xl-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label >label::after,:where(.css-1588u1j).ant-col-24.ant-form-item-label >label::after,:where(.css-1588u1j).ant-col-xl-24.ant-form-item-label >label::after{visibility:hidden;}@media (max-width: 575px){:where(.css-1588u1j).ant-form-item .ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form-item .ant-form-item-label >label::after{visibility:hidden;}:where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item{flex-wrap:wrap;}:where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-label:not([class*=" ant-col-xs"]),:where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-control:not([class*=" ant-col-xs"]){flex:0 0 100%;max-width:100%;}:where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label >label::after{visibility:hidden;}}@media (max-width: 767px){:where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label >label::after{visibility:hidden;}}@media (max-width: 991px){:where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label >label::after{visibility:hidden;}}@media (max-width: 1199px){:where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label{padding:0 0 8px;margin:0;white-space:initial;text-align:start;}:where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label >label{margin:0;}:where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label >label::after{visibility:hidden;}}:where(.css-1588u1j).ant-form .ant-motion-collapse-legacy{overflow:hidden;}:where(.css-1588u1j).ant-form .ant-motion-collapse-legacy-active{transition:height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1)!important;}:where(.css-1588u1j).ant-form .ant-motion-collapse{overflow:hidden;transition:height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1),opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1)!important;}</style>
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
                style="background: rgb(243, 243, 252); padding: 0px 14px 14px;">
                <main class="ant-layout-content css-1588u1j"
                    style="border-radius: 5px; min-height: 280px; margin-top: 110px; margin-left: 0px; margin-right: 14px; background: rgb(255, 255, 255);">
                    <section class="setting">
                        <div class="mb-5 flex flex-col justify-between gap-[25px] md:flex-row">
                            <div class="flex items-center gap-3">
                                <p class="text-[18px] font-semibold md:text-[22px]">Settings</p>
                            </div>
                            <div class="flex items-center gap-5">
                                <div class="flex justify-end"></div>
                            </div>
                        </div>
                        <?php 
                        // Display message (if any)
                        if (!empty($message)) {
                            echo $message;
                        }
                        ?>
                        <div class="flex flex-wrap gap-[32px]">
                            <div class="update_password h-full min-w-[100%] md:min-w-[390px]">
                                <h2 class="title">Password</h2>
                                <form class="ant-form ant-form-vertical ant-form-hide-required-mark" method="post" action="">
                                    <div class="ant-form-item ant-dropdown-trigger">
                                        <div class="ant-row ant-form-item-row">
                                            <div class="ant-col ant-form-item-label">
                                                <label for="newPassword" class="ant-form-item-required" title="New Password">New Password</label>
                                            </div>
                                            <div class="ant-col ant-form-item-control">
                                                <div class="ant-form-item-control-input">
                                                    <div class="ant-form-item-control-input-content">
                                                        <span class="ant-input-affix-wrapper ant-input-password">
                                                            <input placeholder="*********" id="newPassword" name="newPassword" aria-required="true" type="password" class="ant-input ant-input-lg" required>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ant-form-item">
                                        <div class="ant-row ant-form-item-row">
                                            <div class="ant-col ant-form-item-label">
                                                <label for="confirmPassword" class="ant-form-item-required" title="Re-enter Password">Re-enter Password</label>
                                            </div>
                                            <div class="ant-col ant-form-item-control">
                                                <div class="ant-form-item-control-input">
                                                    <div class="ant-form-item-control-input-content">
                                                        <span class="ant-input-affix-wrapper ant-input-password">
                                                            <input placeholder="*********" id="confirmPassword" name="confirmPassword" aria-required="true" type="password" class="ant-input ant-input-lg" required>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ant-form-item mt-5 flex justify-center">
                                        <div class="ant-row ant-form-item-row">
                                            <div class="ant-col ant-form-item-control">
                                                <div class="ant-form-item-control-input">
                                                    <div class="ant-form-item-control-input-content">
                                                        <button type="submit" name="reset_password" class="ant-btn css-1588u1j ant-btn-primary ant_global_btn"><span>Save</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
        <div class="ant-dropdown ant-dropdown-hidden css-1588u1j ant-dropdown-placement-bottomLeft"
            style="--arrow-x: 179px; --arrow-y: -2px; inset: 323px auto auto 250px; box-sizing: border-box; min-width: 358px; pointer-events: none;">
            <ul class="ant-dropdown-menu ant-dropdown-menu-root ant-dropdown-menu-vertical ant-dropdown-menu-light css-1588u1j"
                role="menu" tabindex="0" data-menu-list="true">
                <li class="ant-dropdown-menu-item ant-dropdown-menu-item-only-child" title="Password Health"
                    role="menuitem" tabindex="-1" data-menu-id="rc-menu-uuid-73560-2-0"><span
                        class="ant-dropdown-menu-title-content">
                        <div class="flex items-center justify-center gap-1">
                            <p>Strength</p>
                            <div class="ant-progress ant-progress-status-normal ant-progress-line ant-progress-line-align-end ant-progress-line-position-outer ant-progress-show-info ant-progress-default css-1588u1j"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <div class="ant-progress-outer" style="width: 100%;">
                                    <div class="ant-progress-inner">
                                        <div class="ant-progress-bg ant-progress-bg-outer"
                                            style="width: 0%; height: 8px; --progress-line-stroke-color: #ffce08; background: rgb(255, 206, 8); --progress-percent: 0;">
                                        </div>
                                    </div><span class="ant-progress-text ant-progress-text-end ant-progress-text-outer"
                                        title="0%">0%</span>
                                </div>
                            </div>
                        </div>
                    </span></li>
                <li class="ant-dropdown-menu-item ant-dropdown-menu-item-only-child" title="length" role="menuitem"
                    tabindex="-1" data-menu-id="rc-menu-uuid-73560-2-1"><span class="ant-dropdown-menu-title-content">
                        <div class="flex items-center justify-start gap-1"><svg stroke="currentColor"
                                fill="currentColor" stroke-width="0" viewBox="0 0 24 24" color="red" height="20"
                                width="20" xmlns="http://www.w3.org/2000/svg" style="color: red;">
                                <path
                                    d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 9.5C12.8284 9.5 13.5 8.82843 13.5 8C13.5 7.17157 12.8284 6.5 12 6.5C11.1716 6.5 10.5 7.17157 10.5 8C10.5 8.82843 11.1716 9.5 12 9.5ZM14 15H13V10.5H10V12.5H11V15H10V17H14V15Z">
                                </path>
                            </svg>Password have to greater than 8 character.</div>
                    </span></li>
                <li class="ant-dropdown-menu-item ant-dropdown-menu-item-only-child" title="number" role="menuitem"
                    tabindex="-1" data-menu-id="rc-menu-uuid-73560-2-2"><span class="ant-dropdown-menu-title-content">
                        <div class="flex items-center justify-start gap-1"><svg stroke="currentColor"
                                fill="currentColor" stroke-width="0" viewBox="0 0 24 24" color="red" height="20"
                                width="20" xmlns="http://www.w3.org/2000/svg" style="color: red;">
                                <path
                                    d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 9.5C12.8284 9.5 13.5 8.82843 13.5 8C13.5 7.17157 12.8284 6.5 12 6.5C11.1716 6.5 10.5 7.17157 10.5 8C10.5 8.82843 11.1716 9.5 12 9.5ZM14 15H13V10.5H10V12.5H11V15H10V17H14V15Z">
                                </path>
                            </svg>Password must have one number character.</div>
                    </span></li>
                <li class="ant-dropdown-menu-item ant-dropdown-menu-item-only-child" title="uppercase" role="menuitem"
                    tabindex="-1" data-menu-id="rc-menu-uuid-73560-2-3"><span class="ant-dropdown-menu-title-content">
                        <div class="flex items-center justify-start gap-1"><svg stroke="currentColor"
                                fill="currentColor" stroke-width="0" viewBox="0 0 24 24" color="red" height="20"
                                width="20" xmlns="http://www.w3.org/2000/svg" style="color: red;">
                                <path
                                    d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 9.5C12.8284 9.5 13.5 8.82843 13.5 8C13.5 7.17157 12.8284 6.5 12 6.5C11.1716 6.5 10.5 7.17157 10.5 8C10.5 8.82843 11.1716 9.5 12 9.5ZM14 15H13V10.5H10V12.5H11V15H10V17H14V15Z">
                                </path>
                            </svg>Password must have one uppercase character.</div>
                    </span></li>
                <li class="ant-dropdown-menu-item ant-dropdown-menu-item-only-child" title="lowercase" role="menuitem"
                    tabindex="-1" data-menu-id="rc-menu-uuid-73560-2-4"><span class="ant-dropdown-menu-title-content">
                        <div class="flex items-center justify-start gap-1"><svg stroke="currentColor"
                                fill="currentColor" stroke-width="0" viewBox="0 0 24 24" color="red" height="20"
                                width="20" xmlns="http://www.w3.org/2000/svg" style="color: red;">
                                <path
                                    d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 9.5C12.8284 9.5 13.5 8.82843 13.5 8C13.5 7.17157 12.8284 6.5 12 6.5C11.1716 6.5 10.5 7.17157 10.5 8C10.5 8.82843 11.1716 9.5 12 9.5ZM14 15H13V10.5H10V12.5H11V15H10V17H14V15Z">
                                </path>
                            </svg>Password must have one lower character.</div>
                    </span></li>
            </ul>
            <div aria-hidden="true" style="display: none;"></div>
        </div>
    </main>
</div>



    <?php

     

    return ob_get_clean();
}

// Register the shortcode
add_shortcode('user_settings', 'us_display_user_settings_shortcode');