<?php

// Create a shortcode to display applied visa applications
function av_display_applied_visas_shortcode($atts) {

    $atts = shortcode_atts(array(
        'application_form_id' => '0', // Default value
        'form_submit_page' => 'form', // Default value
    ), $atts);
        global $wpdb;

        $current_user_id = get_current_user_id() ? get_current_user_id() : 0;
        $total_applied_visa = $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM wp_wpforms_entries WHERE user_id = %d AND form_id = %d",
            $current_user_id , intval($atts['application_form_id'])
        ) );
        $entries_unpaid_visa = $wpdb->get_results( $wpdb->prepare(
            "SELECT entry_id, date_modified FROM wp_wpforms_entries WHERE user_id = %d AND form_id = %d AND type = ''",
            $current_user_id, 
            intval($atts['application_form_id'])
        ) );
    // Check if the user is logged in
    if (!is_user_logged_in()) {
        return '<p>You need to be logged in to view your applied visas.</p>';
    }

    $current_user = wp_get_current_user();

    ob_start(); ?>
        <?php include 'head.php'; ?>
<body>
    <div id="__next">
        <main role="main" id="__main" class="__variable_c389b4 font-noto-sans">
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
<style>
    :where(.css-1588u1j)[class^="ant-form"],
    :where(.css-1588u1j)[class*=" ant-form"] {
        font-family: var(--font-noto-sans);
        font-size: 14px;
        box-sizing: border-box;
    }

    :where(.css-1588u1j)[class^="ant-form"]::before,
    :where(.css-1588u1j)[class*=" ant-form"]::before,
    :where(.css-1588u1j)[class^="ant-form"]::after,
    :where(.css-1588u1j)[class*=" ant-form"]::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"],
    :where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"],
    :where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"],
    :where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"]::before,
    :where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"]::before,
    :where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"]::before,
    :where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"]::before,
    :where(.css-1588u1j)[class^="ant-form"] [class^="ant-form"]::after,
    :where(.css-1588u1j)[class*=" ant-form"] [class^="ant-form"]::after,
    :where(.css-1588u1j)[class^="ant-form"] [class*=" ant-form"]::after,
    :where(.css-1588u1j)[class*=" ant-form"] [class*=" ant-form"]::after {
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

    :where(.css-1588u1j).ant-form input[type="radio"],
    :where(.css-1588u1j).ant-form input[type="checkbox"] {
        line-height: normal;
    }

    :where(.css-1588u1j).ant-form input[type="file"] {
        display: block;
    }

    :where(.css-1588u1j).ant-form input[type="range"] {
        display: block;
        width: 100%;
    }

    :where(.css-1588u1j).ant-form select[multiple],
    :where(.css-1588u1j).ant-form select[size] {
        height: auto;
    }

    :where(.css-1588u1j).ant-form input[type='file']:focus,
    :where(.css-1588u1j).ant-form input[type='radio']:focus,
    :where(.css-1588u1j).ant-form input[type='checkbox']:focus {
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
        padding-inline-end: 12px;
    }

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

    :where(.css-1588u1j).ant-form-item-hidden,
    :where(.css-1588u1j).ant-form-item-hidden.ant-row {
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

    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label {
        position: relative;
        display: inline-flex;
        align-items: center;
        max-width: 100%;
        height: 32px;
        color: rgba(0, 0, 0, 0.88);
        font-size: 14px;
    }

    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label>.anticon {
        font-size: 14px;
        vertical-align: top;
    }

    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label.ant-form-item-required:not(.ant-form-item-required-mark-optional)::before {
        display: inline-block;
        margin-inline-end: 4px;
        color: #ff4d4f;
        font-size: 14px;
        font-family: SimSun, sans-serif;
        line-height: 1;
        content: "*";
    }

    .ant-form-hide-required-mark :where(.css-1588u1j).ant-form-item .ant-form-item-label>label.ant-form-item-required:not(.ant-form-item-required-mark-optional)::before {
        display: none;
    }

    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label .ant-form-item-optional {
        display: inline-block;
        margin-inline-start: 4px;
        color: rgba(0, 0, 0, 0.45);
    }

    .ant-form-hide-required-mark :where(.css-1588u1j).ant-form-item .ant-form-item-label>label .ant-form-item-optional {
        display: none;
    }

    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label .ant-form-item-tooltip {
        color: rgba(0, 0, 0, 0.45);
        cursor: help;
        writing-mode: horizontal-tb;
        margin-inline-start: 4px;
    }

    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label::after {
        content: ":";
        position: relative;
        margin-block: 0;
        margin-inline-start: 2px;
        margin-inline-end: 8px;
    }

    :where(.css-1588u1j).ant-form-item .ant-form-item-label>label.ant-form-item-no-colon::after {
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

    :where(.css-1588u1j).ant-form-item .ant-form-item-explain,
    :where(.css-1588u1j).ant-form-item .ant-form-item-extra {
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

    :where(.css-1588u1j).ant-form-show-help-appear,
    :where(.css-1588u1j).ant-form-show-help-enter {
        opacity: 0;
    }

    :where(.css-1588u1j).ant-form-show-help-appear-active,
    :where(.css-1588u1j).ant-form-show-help-enter-active {
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
        transition: height 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), transform 0.3s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
    }

    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-appear,
    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-enter {
        transform: translateY(-5px);
        opacity: 0;
    }

    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-appear-active,
    :where(.css-1588u1j).ant-form-show-help .ant-form-show-help-item.ant-form-show-help-item-enter-active {
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

    :where(.css-1588u1j).ant-form-horizontal .ant-form-item-label[class$='-24']+.ant-form-item-control,
    :where(.css-1588u1j).ant-form-horizontal .ant-form-item-label[class*='-24 ']+.ant-form-item-control {
        min-width: unset;
    }

    :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label {
        flex-grow: 0;
    }

    :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-control {
        flex: 1 1 0;
        min-width: 0;
    }

    :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label[class$='-24']+.ant-form-item-control,
    :where(.css-1588u1j).ant-form-item-horizontal .ant-form-item-label[class*='-24 ']+.ant-form-item-control {
        min-width: unset;
    }

    :where(.css-1588u1j).ant-form-inline {
        display: flex;
        flex-wrap: wrap;
    }

    :where(.css-1588u1j).ant-form-inline .ant-form-item {
        flex: none;
        margin-inline-end: 16px;
        margin-bottom: 0;
    }

    :where(.css-1588u1j).ant-form-inline .ant-form-item-row {
        flex-wrap: nowrap;
    }

    :where(.css-1588u1j).ant-form-inline .ant-form-item>.ant-form-item-label,
    :where(.css-1588u1j).ant-form-inline .ant-form-item>.ant-form-item-control {
        display: inline-block;
        vertical-align: top;
    }

    :where(.css-1588u1j).ant-form-inline .ant-form-item>.ant-form-item-label {
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

    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label,
    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label,
    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label {
        padding: 0 0 8px;
        margin: 0;
        white-space: initial;
        text-align: start;
    }

    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label>label,
    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label>label,
    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label>label {
        margin: 0;
    }

    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-form-item-label>label::after,
    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-24.ant-form-item-label>label::after,
    :where(.css-1588u1j).ant-form-vertical .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xl-24.ant-form-item-label>label::after {
        visibility: hidden;
    }

    @media (max-width: 575px) {
        :where(.css-1588u1j).ant-form-item .ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form-item .ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form-item .ant-form-item-label>label::after {
            visibility: hidden;
        }

        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item {
            flex-wrap: wrap;
        }

        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-label:not([class*=" ant-col-xs"]),
        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-control:not([class*=" ant-col-xs"]) {
            flex: 0 0 100%;
            max-width: 100%;
        }

        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-xs-24.ant-form-item-label>label::after {
            visibility: hidden;
        }
    }

    @media (max-width: 767px) {
        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-sm-24.ant-form-item-label>label::after {
            visibility: hidden;
        }
    }

    @media (max-width: 991px) {
        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-md-24.ant-form-item-label>label::after {
            visibility: hidden;
        }
    }

    @media (max-width: 1199px) {
        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form .ant-form-item:not(.ant-form-item-horizontal) .ant-col-lg-24.ant-form-item-label>label::after {
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

    :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label,
    :where(.css-1588u1j).ant-col-24.ant-form-item-label,
    :where(.css-1588u1j).ant-col-xl-24.ant-form-item-label {
        padding: 0 0 8px;
        margin: 0;
        white-space: initial;
        text-align: start;
    }

    :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label>label,
    :where(.css-1588u1j).ant-col-24.ant-form-item-label>label,
    :where(.css-1588u1j).ant-col-xl-24.ant-form-item-label>label {
        margin: 0;
    }

    :where(.css-1588u1j).ant-form-item-vertical .ant-form-item-label>label::after,
    :where(.css-1588u1j).ant-col-24.ant-form-item-label>label::after,
    :where(.css-1588u1j).ant-col-xl-24.ant-form-item-label>label::after {
        visibility: hidden;
    }

    @media (max-width: 575px) {
        :where(.css-1588u1j).ant-form-item .ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form-item .ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form-item .ant-form-item-label>label::after {
            visibility: hidden;
        }

        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item {
            flex-wrap: wrap;
        }

        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-label:not([class*=" ant-col-xs"]),
        :where(.css-1588u1j).ant-form:not(.ant-form-inline) .ant-form-item .ant-form-item-control:not([class*=" ant-col-xs"]) {
            flex: 0 0 100%;
            max-width: 100%;
        }

        :where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form-item .ant-col-xs-24.ant-form-item-label>label::after {
            visibility: hidden;
        }
    }

    @media (max-width: 767px) {
        :where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form-item .ant-col-sm-24.ant-form-item-label>label::after {
            visibility: hidden;
        }
    }

    @media (max-width: 991px) {
        :where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form-item .ant-col-md-24.ant-form-item-label>label::after {
            visibility: hidden;
        }
    }

    @media (max-width: 1199px) {
        :where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label {
            padding: 0 0 8px;
            margin: 0;
            white-space: initial;
            text-align: start;
        }

        :where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label>label {
            margin: 0;
        }

        :where(.css-1588u1j).ant-form-item .ant-col-lg-24.ant-form-item-label>label::after {
            visibility: hidden;
        }
    }

    :where(.css-1588u1j).ant-form .ant-motion-collapse-legacy {
        overflow: hidden;
    }

    :where(.css-1588u1j).ant-form .ant-motion-collapse-legacy-active {
        transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
    }

    :where(.css-1588u1j).ant-form .ant-motion-collapse {
        overflow: hidden;
        transition: height 0.2s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.2s cubic-bezier(0.645, 0.045, 0.355, 1) !important;
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

    :where(.css-1588u1j) a:active,
    :where(.css-1588u1j) a:hover {
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

    :where(.css-1588u1j).ant-layout::before,
    :where(.css-1588u1j).ant-layout::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-layout [class^="ant-layout"],
    :where(.css-1588u1j).ant-layout [class*=" ant-layout"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-layout [class^="ant-layout"]::before,
    :where(.css-1588u1j).ant-layout [class*=" ant-layout"]::before,
    :where(.css-1588u1j).ant-layout [class^="ant-layout"]::after,
    :where(.css-1588u1j).ant-layout [class*=" ant-layout"]::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-layout {
        display: flex;
        flex: auto;
        flex-direction: column;
        min-height: 0;
        background: #f5f5f5;
    }

    :where(.css-1588u1j).ant-layout,
    :where(.css-1588u1j).ant-layout * {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-layout.ant-layout-has-sider {
        flex-direction: row;
    }

    :where(.css-1588u1j).ant-layout.ant-layout-has-sider>.ant-layout,
    :where(.css-1588u1j).ant-layout.ant-layout-has-sider>.ant-layout-content {
        width: 0;
    }

    :where(.css-1588u1j).ant-layout .ant-layout-header,
    :where(.css-1588u1j).ant-layout.ant-layout-footer {
        flex: 0 0 auto;
    }

    :where(.css-1588u1j).ant-layout .ant-layout-sider {
        position: relative;
        min-width: 0;
        background: #001529;
        transition: all 0.2s, background 0s;
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

    :where(.css-1588u1j).ant-layout .ant-layout-sider-zero-width>* {
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
        border-inline-start: 0;
    }

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

    :where(.css-1588u1j).ant-btn::before,
    :where(.css-1588u1j).ant-btn::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-btn [class^="ant-btn"],
    :where(.css-1588u1j).ant-btn [class*=" ant-btn"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-btn [class^="ant-btn"]::before,
    :where(.css-1588u1j).ant-btn [class*=" ant-btn"]::before,
    :where(.css-1588u1j).ant-btn [class^="ant-btn"]::after,
    :where(.css-1588u1j).ant-btn [class*=" ant-btn"]::after {
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

    :where(.css-1588u1j).ant-btn>span {
        display: inline-block;
    }

    :where(.css-1588u1j).ant-btn .ant-btn-icon {
        line-height: 1;
    }

    :where(.css-1588u1j).ant-btn>a {
        color: currentColor;
    }

    :where(.css-1588u1j).ant-btn:not(:disabled):focus-visible {
        outline: 4px solid #85868f;
        outline-offset: 1px;
        transition: outline-offset 0s, outline 0s;
    }

    :where(.css-1588u1j).ant-btn.ant-btn-two-chinese-chars::first-letter {
        letter-spacing: 0.34em;
    }

    :where(.css-1588u1j).ant-btn.ant-btn-two-chinese-chars>*:not(.anticon) {
        margin-inline-end: -0.34em;
        letter-spacing: 0.34em;
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
        padding-inline: 0;
    }

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
        transition: width 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    :where(.css-1588u1j).ant-btn.ant-btn-circle.ant-btn {
        min-width: 32px;
        padding-inline-start: 0;
        padding-inline-end: 0;
        border-radius: 50%;
    }

    :where(.css-1588u1j).ant-btn.ant-btn-round.ant-btn {
        border-radius: 32px;
        padding-inline-start: 16px;
        padding-inline-end: 16px;
    }

    :where(.css-1588u1j).ant-btn-sm {
        font-size: 14px;
        line-height: 1.5714285714285714;
        height: 24px;
        padding: 0px 7px;
        border-radius: 4px;
    }

    :where(.css-1588u1j).ant-btn-sm.ant-btn-icon-only {
        width: 24px;
        padding-inline: 0;
    }

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
        transition: width 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    :where(.css-1588u1j).ant-btn.ant-btn-circle.ant-btn-sm {
        min-width: 24px;
        padding-inline-start: 0;
        padding-inline-end: 0;
        border-radius: 50%;
    }

    :where(.css-1588u1j).ant-btn.ant-btn-round.ant-btn-sm {
        border-radius: 24px;
        padding-inline-start: 12px;
        padding-inline-end: 12px;
    }

    :where(.css-1588u1j).ant-btn-lg {
        font-size: 16px;
        line-height: 1.5;
        height: 40px;
        padding: 7px 15px;
        border-radius: 8px;
    }

    :where(.css-1588u1j).ant-btn-lg.ant-btn-icon-only {
        width: 40px;
        padding-inline: 0;
    }

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
        transition: width 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    :where(.css-1588u1j).ant-btn.ant-btn-circle.ant-btn-lg {
        min-width: 40px;
        padding-inline-start: 0;
        padding-inline-end: 0;
        border-radius: 50%;
    }

    :where(.css-1588u1j).ant-btn.ant-btn-round.ant-btn-lg {
        border-radius: 40px;
        padding-inline-start: 20px;
        padding-inline-end: 20px;
    }

    :where(.css-1588u1j).ant-btn.ant-btn-block {
        width: 100%;
    }

    :where(.css-1588u1j).ant-btn-default {
        background: #ffffff;
        border-color: #d9d9d9;
        color: rgba(0, 0, 0, 0.88);
        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.02);
    }

    :where(.css-1588u1j).ant-btn-default:disabled,
    :where(.css-1588u1j).ant-btn-default.ant-btn-disabled {
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

    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous:disabled,
    :where(.css-1588u1j).ant-btn-default.ant-btn-dangerous.ant-btn-disabled {
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

    :where(.css-1588u1j).ant-btn-primary:disabled,
    :where(.css-1588u1j).ant-btn-primary.ant-btn-disabled {
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

    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous:disabled,
    :where(.css-1588u1j).ant-btn-primary.ant-btn-dangerous.ant-btn-disabled {
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

    :where(.css-1588u1j).ant-btn-dashed:disabled,
    :where(.css-1588u1j).ant-btn-dashed.ant-btn-disabled {
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

    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous:disabled,
    :where(.css-1588u1j).ant-btn-dashed.ant-btn-dangerous.ant-btn-disabled {
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

    :where(.css-1588u1j).ant-btn-link:disabled,
    :where(.css-1588u1j).ant-btn-link.ant-btn-disabled {
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

    :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous:disabled,
    :where(.css-1588u1j).ant-btn-link.ant-btn-dangerous.ant-btn-disabled {
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

    :where(.css-1588u1j).ant-btn-text:disabled,
    :where(.css-1588u1j).ant-btn-text.ant-btn-disabled {
        cursor: not-allowed;
        color: rgba(0, 0, 0, 0.25);
    }

    :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous {
        color: #ff4d4f;
    }

    :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous:disabled,
    :where(.css-1588u1j).ant-btn-text.ant-btn-dangerous.ant-btn-disabled {
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

    :where(.css-1588u1j).ant-btn-group>span:not(:last-child),
    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:last-child),
    :where(.css-1588u1j).ant-btn-group>span:not(:last-child)>.ant-btn,
    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:last-child)>.ant-btn {
        border-start-end-radius: 0;
        border-end-end-radius: 0;
    }

    :where(.css-1588u1j).ant-btn-group>span:not(:first-child),
    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:first-child) {
        margin-inline-start: -1px;
    }

    :where(.css-1588u1j).ant-btn-group>span:not(:first-child),
    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:first-child),
    :where(.css-1588u1j).ant-btn-group>span:not(:first-child)>.ant-btn,
    :where(.css-1588u1j).ant-btn-group>.ant-btn:not(:first-child)>.ant-btn {
        border-start-start-radius: 0;
        border-end-start-radius: 0;
    }

    :where(.css-1588u1j).ant-btn-group .ant-btn {
        position: relative;
        z-index: 1;
    }

    :where(.css-1588u1j).ant-btn-group .ant-btn:hover,
    :where(.css-1588u1j).ant-btn-group .ant-btn:focus,
    :where(.css-1588u1j).ant-btn-group .ant-btn:active {
        z-index: 2;
    }

    :where(.css-1588u1j).ant-btn-group .ant-btn[disabled] {
        z-index: 0;
    }

    :where(.css-1588u1j).ant-btn-group .ant-btn-icon-only {
        font-size: 14px;
    }

    :where(.css-1588u1j).ant-btn-group>span:not(:last-child):not(:disabled),
    :where(.css-1588u1j).ant-btn-group>.ant-btn-primary:not(:last-child):not(:disabled),
    :where(.css-1588u1j).ant-btn-group>span:not(:last-child)>.ant-btn-primary:not(:disabled),
    :where(.css-1588u1j).ant-btn-group>.ant-btn-primary:not(:last-child)>.ant-btn-primary:not(:disabled) {
        border-inline-end-color: #484b75;
    }

    :where(.css-1588u1j).ant-btn-group>span:not(:first-child):not(:disabled),
    :where(.css-1588u1j).ant-btn-group>.ant-btn-primary:not(:first-child):not(:disabled),
    :where(.css-1588u1j).ant-btn-group>span:not(:first-child)>.ant-btn-primary:not(:disabled),
    :where(.css-1588u1j).ant-btn-group>.ant-btn-primary:not(:first-child)>.ant-btn-primary:not(:disabled) {
        border-inline-start-color: #484b75;
    }

    :where(.css-1588u1j).ant-btn-group>span:not(:last-child):not(:disabled),
    :where(.css-1588u1j).ant-btn-group>.ant-btn-danger:not(:last-child):not(:disabled),
    :where(.css-1588u1j).ant-btn-group>span:not(:last-child)>.ant-btn-danger:not(:disabled),
    :where(.css-1588u1j).ant-btn-group>.ant-btn-danger:not(:last-child)>.ant-btn-danger:not(:disabled) {
        border-inline-end-color: #ff7875;
    }

    :where(.css-1588u1j).ant-btn-group>span:not(:first-child):not(:disabled),
    :where(.css-1588u1j).ant-btn-group>.ant-btn-danger:not(:first-child):not(:disabled),
    :where(.css-1588u1j).ant-btn-group>span:not(:first-child)>.ant-btn-danger:not(:disabled),
    :where(.css-1588u1j).ant-btn-group>.ant-btn-danger:not(:first-child)>.ant-btn-danger:not(:disabled) {
        border-inline-start-color: #ff7875;
    }

    :where(.css-1588u1j).ant-wave {
        font-family: var(--font-noto-sans);
        font-size: 14px;
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-wave::before,
    :where(.css-1588u1j).ant-wave::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-wave [class^="ant-wave"],
    :where(.css-1588u1j).ant-wave [class*=" ant-wave"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-wave [class^="ant-wave"]::before,
    :where(.css-1588u1j).ant-wave [class*=" ant-wave"]::before,
    :where(.css-1588u1j).ant-wave [class^="ant-wave"]::after,
    :where(.css-1588u1j).ant-wave [class*=" ant-wave"]::after {
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
        transition: box-shadow 0.4s cubic-bezier(0.08, 0.82, 0.17, 1), opacity 2s cubic-bezier(0.08, 0.82, 0.17, 1);
    }

    :where(.css-1588u1j).ant-wave.wave-motion-appear-active {
        box-shadow: 0 0 0 6px currentcolor;
        opacity: 0;
    }

    :where(.css-1588u1j).ant-wave.wave-motion-appear.wave-quick {
        transition: box-shadow 0.3s cubic-bezier(0.645, 0.045, 0.355, 1), opacity 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    :where(.css-1588u1j).ant-drawer {
        font-family: var(--font-noto-sans);
        font-size: 14px;
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-drawer::before,
    :where(.css-1588u1j).ant-drawer::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-drawer [class^="ant-drawer"],
    :where(.css-1588u1j).ant-drawer [class*=" ant-drawer"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-drawer [class^="ant-drawer"]::before,
    :where(.css-1588u1j).ant-drawer [class*=" ant-drawer"]::before,
    :where(.css-1588u1j).ant-drawer [class^="ant-drawer"]::after,
    :where(.css-1588u1j).ant-drawer [class*=" ant-drawer"]::after {
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
        box-shadow: 6px 0 16px 0 rgba(0, 0, 0, 0.08), 3px 0 6px -4px rgba(0, 0, 0, 0.12), 9px 0 28px 8px rgba(0, 0, 0, 0.05);
    }

    :where(.css-1588u1j).ant-drawer-pure.ant-drawer-right {
        box-shadow: -6px 0 16px 0 rgba(0, 0, 0, 0.08), -3px 0 6px -4px rgba(0, 0, 0, 0.12), -9px 0 28px 8px rgba(0, 0, 0, 0.05);
    }

    :where(.css-1588u1j).ant-drawer-pure.ant-drawer-top {
        box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
    }

    :where(.css-1588u1j).ant-drawer-pure.ant-drawer-bottom {
        box-shadow: 0 -6px 16px 0 rgba(0, 0, 0, 0.08), 0 -3px 6px -4px rgba(0, 0, 0, 0.12), 0 -9px 28px 8px rgba(0, 0, 0, 0.05);
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
        box-shadow: 6px 0 16px 0 rgba(0, 0, 0, 0.08), 3px 0 6px -4px rgba(0, 0, 0, 0.12), 9px 0 28px 8px rgba(0, 0, 0, 0.05);
    }

    :where(.css-1588u1j).ant-drawer-right>.ant-drawer-content-wrapper {
        top: 0;
        right: 0;
        bottom: 0;
        box-shadow: -6px 0 16px 0 rgba(0, 0, 0, 0.08), -3px 0 6px -4px rgba(0, 0, 0, 0.12), -9px 0 28px 8px rgba(0, 0, 0, 0.05);
    }

    :where(.css-1588u1j).ant-drawer-top>.ant-drawer-content-wrapper {
        top: 0;
        inset-inline: 0;
        box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
    }

    :where(.css-1588u1j).ant-drawer-bottom>.ant-drawer-content-wrapper {
        bottom: 0;
        inset-inline: 0;
        box-shadow: 0 -6px 16px 0 rgba(0, 0, 0, 0.08), 0 -3px 6px -4px rgba(0, 0, 0, 0.12), 0 -9px 28px 8px rgba(0, 0, 0, 0.05);
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
        margin-inline-end: 8px;
        color: rgba(0, 0, 0, 0.45);
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
        transition: outline-offset 0s, outline 0s;
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

    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave-start {
        transition: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave-active {
        transition: all 0.3s;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter,
    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear {
        opacity: 0;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-appear-active {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-mask-motion-leave-active {
        opacity: 0;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-start {
        transition: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-active {
        transition: all 0.3s;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear {
        opacity: 0.7;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-active {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-active {
        opacity: 0.7;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear {
        transform: translateX(-100%);
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-appear-active {
        transform: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave {
        transform: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-left-leave-active {
        transform: translateX(-100%);
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-start {
        transition: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-active {
        transition: all 0.3s;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear {
        opacity: 0.7;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-active {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-active {
        opacity: 0.7;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear {
        transform: translateX(100%);
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-appear-active {
        transform: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave {
        transform: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-right-leave-active {
        transform: translateX(100%);
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-start {
        transition: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-active {
        transition: all 0.3s;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear {
        opacity: 0.7;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-active {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-active {
        opacity: 0.7;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear {
        transform: translateY(-100%);
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-appear-active {
        transform: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave {
        transform: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-top-leave-active {
        transform: translateY(-100%);
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-start,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-start {
        transition: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-active {
        transition: all 0.3s;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear {
        opacity: 0.7;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-active {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-active {
        opacity: 0.7;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear {
        transform: translateY(100%);
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-enter-active,
    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-appear-active {
        transform: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave {
        transform: none;
    }

    :where(.css-1588u1j).ant-drawer .ant-drawer-panel-motion-bottom-leave-active {
        transform: translateY(100%);
    }

    :where(.css-1588u1j).ant-row {
        font-family: var(--font-noto-sans);
        font-size: 14px;
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-row::before,
    :where(.css-1588u1j).ant-row::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-row [class^="ant-row"],
    :where(.css-1588u1j).ant-row [class*=" ant-row"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-row [class^="ant-row"]::before,
    :where(.css-1588u1j).ant-row [class*=" ant-row"]::before,
    :where(.css-1588u1j).ant-row [class^="ant-row"]::after,
    :where(.css-1588u1j).ant-row [class*=" ant-row"]::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-row {
        display: flex;
        flex-flow: row wrap;
        min-width: 0;
    }

    :where(.css-1588u1j).ant-row::before,
    :where(.css-1588u1j).ant-row::after {
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

    :where(.css-1588u1j).ant-col::before,
    :where(.css-1588u1j).ant-col::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-col [class^="ant-col"],
    :where(.css-1588u1j).ant-col [class*=" ant-col"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-col [class^="ant-col"]::before,
    :where(.css-1588u1j).ant-col [class*=" ant-col"]::before,
    :where(.css-1588u1j).ant-col [class^="ant-col"]::after,
    :where(.css-1588u1j).ant-col [class*=" ant-col"]::after {
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
        margin-inline-start: 100%;
    }

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
        margin-inline-start: 95.83333333333334%;
    }

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
        margin-inline-start: 91.66666666666666%;
    }

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
        margin-inline-start: 87.5%;
    }

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
        margin-inline-start: 83.33333333333334%;
    }

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
        margin-inline-start: 79.16666666666666%;
    }

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
        margin-inline-start: 75%;
    }

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
        margin-inline-start: 70.83333333333334%;
    }

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
        margin-inline-start: 66.66666666666666%;
    }

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
        margin-inline-start: 62.5%;
    }

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
        margin-inline-start: 58.333333333333336%;
    }

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
        margin-inline-start: 54.166666666666664%;
    }

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
        margin-inline-start: 50%;
    }

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
        margin-inline-start: 45.83333333333333%;
    }

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
        margin-inline-start: 41.66666666666667%;
    }

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
        margin-inline-start: 37.5%;
    }

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
        margin-inline-start: 33.33333333333333%;
    }

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
        margin-inline-start: 29.166666666666668%;
    }

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
        margin-inline-start: 25%;
    }

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
        margin-inline-start: 20.833333333333336%;
    }

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
        margin-inline-start: 16.666666666666664%;
    }

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
        margin-inline-start: 12.5%;
    }

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
        margin-inline-start: 8.333333333333332%;
    }

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
        margin-inline-start: 4.166666666666666%;
    }

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
        margin-inline-start: 0;
    }

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
        margin-inline-start: 100%;
    }

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
        margin-inline-start: 95.83333333333334%;
    }

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
        margin-inline-start: 91.66666666666666%;
    }

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
        margin-inline-start: 87.5%;
    }

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
        margin-inline-start: 83.33333333333334%;
    }

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
        margin-inline-start: 79.16666666666666%;
    }

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
        margin-inline-start: 75%;
    }

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
        margin-inline-start: 70.83333333333334%;
    }

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
        margin-inline-start: 66.66666666666666%;
    }

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
        margin-inline-start: 62.5%;
    }

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
        margin-inline-start: 58.333333333333336%;
    }

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
        margin-inline-start: 54.166666666666664%;
    }

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
        margin-inline-start: 50%;
    }

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
        margin-inline-start: 45.83333333333333%;
    }

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
        margin-inline-start: 41.66666666666667%;
    }

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
        margin-inline-start: 37.5%;
    }

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
        margin-inline-start: 33.33333333333333%;
    }

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
        margin-inline-start: 29.166666666666668%;
    }

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
        margin-inline-start: 25%;
    }

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
        margin-inline-start: 20.833333333333336%;
    }

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
        margin-inline-start: 16.666666666666664%;
    }

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
        margin-inline-start: 12.5%;
    }

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
        margin-inline-start: 8.333333333333332%;
    }

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
        margin-inline-start: 4.166666666666666%;
    }

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
        margin-inline-start: 0;
    }

    :where(.css-1588u1j).ant-col-xs-order-0 {
        order: 0;
    }

    :where(.css-1588u1j).ant-col-xs-flex {
        flex: var(--ant-col-xs-flex);
    }

    @media (min-width: 576px) {
        :where(.css-1588u1j).ant-col-sm-24 {
            --ant-display: block;
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
            margin-inline-start: 100%;
        }

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
            margin-inline-start: 95.83333333333334%;
        }

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
            margin-inline-start: 91.66666666666666%;
        }

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
            margin-inline-start: 87.5%;
        }

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
            margin-inline-start: 83.33333333333334%;
        }

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
            margin-inline-start: 79.16666666666666%;
        }

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
            margin-inline-start: 75%;
        }

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
            margin-inline-start: 70.83333333333334%;
        }

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
            margin-inline-start: 66.66666666666666%;
        }

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
            margin-inline-start: 62.5%;
        }

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
            margin-inline-start: 58.333333333333336%;
        }

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
            margin-inline-start: 54.166666666666664%;
        }

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
            margin-inline-start: 50%;
        }

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
            margin-inline-start: 45.83333333333333%;
        }

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
            margin-inline-start: 41.66666666666667%;
        }

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
            margin-inline-start: 37.5%;
        }

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
            margin-inline-start: 33.33333333333333%;
        }

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
            margin-inline-start: 29.166666666666668%;
        }

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
            margin-inline-start: 25%;
        }

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
            margin-inline-start: 20.833333333333336%;
        }

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
            margin-inline-start: 16.666666666666664%;
        }

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
            margin-inline-start: 12.5%;
        }

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
            margin-inline-start: 8.333333333333332%;
        }

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
            margin-inline-start: 4.166666666666666%;
        }

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
            margin-inline-start: 0;
        }

        :where(.css-1588u1j).ant-col-sm-order-0 {
            order: 0;
        }

        :where(.css-1588u1j).ant-col-sm-flex {
            flex: var(--ant-col-sm-flex);
        }
    }

    @media (min-width: 768px) {
        :where(.css-1588u1j).ant-col-md-24 {
            --ant-display: block;
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
            margin-inline-start: 100%;
        }

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
            margin-inline-start: 95.83333333333334%;
        }

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
            margin-inline-start: 91.66666666666666%;
        }

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
            margin-inline-start: 87.5%;
        }

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
            margin-inline-start: 83.33333333333334%;
        }

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
            margin-inline-start: 79.16666666666666%;
        }

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
            margin-inline-start: 75%;
        }

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
            margin-inline-start: 70.83333333333334%;
        }

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
            margin-inline-start: 66.66666666666666%;
        }

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
            margin-inline-start: 62.5%;
        }

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
            margin-inline-start: 58.333333333333336%;
        }

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
            margin-inline-start: 54.166666666666664%;
        }

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
            margin-inline-start: 50%;
        }

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
            margin-inline-start: 45.83333333333333%;
        }

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
            margin-inline-start: 41.66666666666667%;
        }

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
            margin-inline-start: 37.5%;
        }

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
            margin-inline-start: 33.33333333333333%;
        }

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
            margin-inline-start: 29.166666666666668%;
        }

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
            margin-inline-start: 25%;
        }

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
            margin-inline-start: 20.833333333333336%;
        }

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
            margin-inline-start: 16.666666666666664%;
        }

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
            margin-inline-start: 12.5%;
        }

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
            margin-inline-start: 8.333333333333332%;
        }

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
            margin-inline-start: 4.166666666666666%;
        }

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
            margin-inline-start: 0;
        }

        :where(.css-1588u1j).ant-col-md-order-0 {
            order: 0;
        }

        :where(.css-1588u1j).ant-col-md-flex {
            flex: var(--ant-col-md-flex);
        }
    }

    @media (min-width: 992px) {
        :where(.css-1588u1j).ant-col-lg-24 {
            --ant-display: block;
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
            margin-inline-start: 100%;
        }

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
            margin-inline-start: 95.83333333333334%;
        }

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
            margin-inline-start: 91.66666666666666%;
        }

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
            margin-inline-start: 87.5%;
        }

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
            margin-inline-start: 83.33333333333334%;
        }

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
            margin-inline-start: 79.16666666666666%;
        }

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
            margin-inline-start: 75%;
        }

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
            margin-inline-start: 70.83333333333334%;
        }

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
            margin-inline-start: 66.66666666666666%;
        }

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
            margin-inline-start: 62.5%;
        }

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
            margin-inline-start: 58.333333333333336%;
        }

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
            margin-inline-start: 54.166666666666664%;
        }

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
            margin-inline-start: 50%;
        }

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
            margin-inline-start: 45.83333333333333%;
        }

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
            margin-inline-start: 41.66666666666667%;
        }

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
            margin-inline-start: 37.5%;
        }

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
            margin-inline-start: 33.33333333333333%;
        }

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
            margin-inline-start: 29.166666666666668%;
        }

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
            margin-inline-start: 25%;
        }

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
            margin-inline-start: 20.833333333333336%;
        }

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
            margin-inline-start: 16.666666666666664%;
        }

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
            margin-inline-start: 12.5%;
        }

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
            margin-inline-start: 8.333333333333332%;
        }

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
            margin-inline-start: 4.166666666666666%;
        }

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
            margin-inline-start: 0;
        }

        :where(.css-1588u1j).ant-col-lg-order-0 {
            order: 0;
        }

        :where(.css-1588u1j).ant-col-lg-flex {
            flex: var(--ant-col-lg-flex);
        }
    }

    @media (min-width: 1200px) {
        :where(.css-1588u1j).ant-col-xl-24 {
            --ant-display: block;
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
            margin-inline-start: 100%;
        }

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
            margin-inline-start: 95.83333333333334%;
        }

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
            margin-inline-start: 91.66666666666666%;
        }

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
            margin-inline-start: 87.5%;
        }

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
            margin-inline-start: 83.33333333333334%;
        }

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
            margin-inline-start: 79.16666666666666%;
        }

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
            margin-inline-start: 75%;
        }

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
            margin-inline-start: 70.83333333333334%;
        }

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
            margin-inline-start: 66.66666666666666%;
        }

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
            margin-inline-start: 62.5%;
        }

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
            margin-inline-start: 58.333333333333336%;
        }

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
            margin-inline-start: 54.166666666666664%;
        }

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
            margin-inline-start: 50%;
        }

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
            margin-inline-start: 45.83333333333333%;
        }

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
            margin-inline-start: 41.66666666666667%;
        }

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
            margin-inline-start: 37.5%;
        }

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
            margin-inline-start: 33.33333333333333%;
        }

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
            margin-inline-start: 29.166666666666668%;
        }

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
            margin-inline-start: 25%;
        }

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
            margin-inline-start: 20.833333333333336%;
        }

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
            margin-inline-start: 16.666666666666664%;
        }

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
            margin-inline-start: 12.5%;
        }

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
            margin-inline-start: 8.333333333333332%;
        }

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
            margin-inline-start: 4.166666666666666%;
        }

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
            margin-inline-start: 0;
        }

        :where(.css-1588u1j).ant-col-xl-order-0 {
            order: 0;
        }

        :where(.css-1588u1j).ant-col-xl-flex {
            flex: var(--ant-col-xl-flex);
        }
    }

    @media (min-width: 1600px) {
        :where(.css-1588u1j).ant-col-xxl-24 {
            --ant-display: block;
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
            margin-inline-start: 100%;
        }

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
            margin-inline-start: 95.83333333333334%;
        }

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
            margin-inline-start: 91.66666666666666%;
        }

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
            margin-inline-start: 87.5%;
        }

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
            margin-inline-start: 83.33333333333334%;
        }

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
            margin-inline-start: 79.16666666666666%;
        }

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
            margin-inline-start: 75%;
        }

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
            margin-inline-start: 70.83333333333334%;
        }

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
            margin-inline-start: 66.66666666666666%;
        }

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
            margin-inline-start: 62.5%;
        }

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
            margin-inline-start: 58.333333333333336%;
        }

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
            margin-inline-start: 54.166666666666664%;
        }

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
            margin-inline-start: 50%;
        }

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
            margin-inline-start: 45.83333333333333%;
        }

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
            margin-inline-start: 41.66666666666667%;
        }

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
            margin-inline-start: 37.5%;
        }

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
            margin-inline-start: 33.33333333333333%;
        }

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
            margin-inline-start: 29.166666666666668%;
        }

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
            margin-inline-start: 25%;
        }

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
            margin-inline-start: 20.833333333333336%;
        }

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
            margin-inline-start: 16.666666666666664%;
        }

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
            margin-inline-start: 12.5%;
        }

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
            margin-inline-start: 8.333333333333332%;
        }

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
            margin-inline-start: 4.166666666666666%;
        }

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
            margin-inline-start: 0;
        }

        :where(.css-1588u1j).ant-col-xxl-order-0 {
            order: 0;
        }

        :where(.css-1588u1j).ant-col-xxl-flex {
            flex: var(--ant-col-xxl-flex);
        }
    }

    :where(.css-1588u1j)[class^="ant-input"],
    :where(.css-1588u1j)[class*=" ant-input"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j)[class^="ant-input"]::before,
    :where(.css-1588u1j)[class*=" ant-input"]::before,
    :where(.css-1588u1j)[class^="ant-input"]::after,
    :where(.css-1588u1j)[class*=" ant-input"]::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"],
    :where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"],
    :where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"],
    :where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"]::before,
    :where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"]::before,
    :where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"]::before,
    :where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"]::before,
    :where(.css-1588u1j)[class^="ant-input"] [class^="ant-input"]::after,
    :where(.css-1588u1j)[class*=" ant-input"] [class^="ant-input"]::after,
    :where(.css-1588u1j)[class^="ant-input"] [class*=" ant-input"]::after,
    :where(.css-1588u1j)[class*=" ant-input"] [class*=" ant-input"]::after {
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
        transition: all 0.3s, height 0s;
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

    :where(.css-1588u1j).ant-input-rtl,
    :where(.css-1588u1j).ant-input-textarea-rtl {
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

    :where(.css-1588u1j).ant-input-outlined:focus,
    :where(.css-1588u1j).ant-input-outlined:focus-within {
        border-color: #2f3268;
        box-shadow: 0 0 0 2px transparent;
        outline: 0;
        background-color: #ffffff;
    }

    :where(.css-1588u1j).ant-input-outlined.ant-input-disabled,
    :where(.css-1588u1j).ant-input-outlined[disabled] {
        color: rgba(0, 0, 0, 0.25);
        background-color: rgba(0, 0, 0, 0.04);
        border-color: #d9d9d9;
        box-shadow: none;
        cursor: not-allowed;
        opacity: 1;
    }

    :where(.css-1588u1j).ant-input-outlined.ant-input-disabled input[disabled],
    :where(.css-1588u1j).ant-input-outlined[disabled] input[disabled],
    :where(.css-1588u1j).ant-input-outlined.ant-input-disabled textarea[disabled],
    :where(.css-1588u1j).ant-input-outlined[disabled] textarea[disabled] {
        cursor: not-allowed;
    }

    :where(.css-1588u1j).ant-input-outlined.ant-input-disabled:hover:not([disabled]),
    :where(.css-1588u1j).ant-input-outlined[disabled]:hover:not([disabled]) {
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

    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):focus,
    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled):focus-within {
        border-color: #ff4d4f;
        box-shadow: 0 0 0 2px rgba(255, 38, 5, 0.06);
        outline: 0;
        background-color: #ffffff;
    }

    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) .ant-input-prefix,
    :where(.css-1588u1j).ant-input-outlined.ant-input-status-error:not(.ant-input-disabled) .ant-input-suffix {
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

    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):focus,
    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled):focus-within {
        border-color: #faad14;
        box-shadow: 0 0 0 2px rgba(255, 215, 5, 0.1);
        outline: 0;
        background-color: #ffffff;
    }

    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) .ant-input-prefix,
    :where(.css-1588u1j).ant-input-outlined.ant-input-status-warning:not(.ant-input-disabled) .ant-input-suffix {
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

    input:where(.css-1588u1j).ant-input-filled,
    :where(.css-1588u1j).ant-input-filled input,
    textarea:where(.css-1588u1j).ant-input-filled,
    :where(.css-1588u1j).ant-input-filled textarea {
        color: undefined;
    }

    :where(.css-1588u1j).ant-input-filled:hover {
        background: rgba(0, 0, 0, 0.06);
    }

    :where(.css-1588u1j).ant-input-filled:focus,
    :where(.css-1588u1j).ant-input-filled:focus-within {
        outline: 0;
        border-color: #2f3268;
        background-color: #ffffff;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-disabled,
    :where(.css-1588u1j).ant-input-filled[disabled] {
        color: rgba(0, 0, 0, 0.25);
        background-color: rgba(0, 0, 0, 0.04);
        border-color: #d9d9d9;
        box-shadow: none;
        cursor: not-allowed;
        opacity: 1;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-disabled input[disabled],
    :where(.css-1588u1j).ant-input-filled[disabled] input[disabled],
    :where(.css-1588u1j).ant-input-filled.ant-input-disabled textarea[disabled],
    :where(.css-1588u1j).ant-input-filled[disabled] textarea[disabled] {
        cursor: not-allowed;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-disabled:hover:not([disabled]),
    :where(.css-1588u1j).ant-input-filled[disabled]:hover:not([disabled]) {
        border-color: #d9d9d9;
        background-color: rgba(0, 0, 0, 0.04);
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) {
        background: #fff2f0;
        border-width: 1px;
        border-style: solid;
        border-color: transparent;
    }

    input:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled),
    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) input,
    textarea:where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled),
    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) textarea {
        color: #ff4d4f;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):hover {
        background: #fff1f0;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):focus,
    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled):focus-within {
        outline: 0;
        border-color: #ff4d4f;
        background-color: #ffffff;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) .ant-input-prefix,
    :where(.css-1588u1j).ant-input-filled.ant-input-status-error:not(.ant-input-disabled) .ant-input-suffix {
        color: #ff4d4f;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) {
        background: #fffbe6;
        border-width: 1px;
        border-style: solid;
        border-color: transparent;
    }

    input:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled),
    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) input,
    textarea:where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled),
    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) textarea {
        color: #faad14;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):hover {
        background: #fff1b8;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):focus,
    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled):focus-within {
        outline: 0;
        border-color: #faad14;
        background-color: #ffffff;
    }

    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) .ant-input-prefix,
    :where(.css-1588u1j).ant-input-filled.ant-input-status-warning:not(.ant-input-disabled) .ant-input-suffix {
        color: #faad14;
    }

    :where(.css-1588u1j).ant-input-borderless {
        background: transparent;
        border: none;
    }

    :where(.css-1588u1j).ant-input-borderless:focus,
    :where(.css-1588u1j).ant-input-borderless:focus-within {
        outline: none;
    }

    :where(.css-1588u1j).ant-input-borderless.ant-input-disabled,
    :where(.css-1588u1j).ant-input-borderless[disabled] {
        color: rgba(0, 0, 0, 0.25);
    }

    :where(.css-1588u1j).ant-input-borderless.ant-input-status-error,
    :where(.css-1588u1j).ant-input-borderless.ant-input-status-error input,
    :where(.css-1588u1j).ant-input-borderless.ant-input-status-error textarea {
        color: #ff4d4f;
    }

    :where(.css-1588u1j).ant-input-borderless.ant-input-status-warning,
    :where(.css-1588u1j).ant-input-borderless.ant-input-status-warning input,
    :where(.css-1588u1j).ant-input-borderless.ant-input-status-warning textarea {
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

    :where(.css-1588u1j).ant-input[type="search"]::-webkit-search-cancel-button,
    :where(.css-1588u1j).ant-input[type="search"]::-webkit-search-decoration {
        -webkit-appearance: none;
    }

    :where(.css-1588u1j).ant-input-textarea {
        position: relative;
    }

    :where(.css-1588u1j).ant-input-textarea-show-count>.ant-input {
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

    :where(.css-1588u1j).ant-input-textarea-allow-clear>.ant-input,
    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-textarea-has-feedback .ant-input {
        padding-inline-end: 24px;
    }

    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper {
        padding: 0;
    }

    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper>textarea.ant-input {
        font-size: inherit;
        border: none;
        outline: none;
        background: transparent;
    }

    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper>textarea.ant-input:focus {
        box-shadow: none !important;
    }

    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix {
        margin: 0;
    }

    :where(.css-1588u1j).ant-input-textarea-affix-wrapper.ant-input-affix-wrapper .ant-input-suffix>*:not(:last-child) {
        margin-inline: 0;
    }

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
        transition: all 0.3s, height 0s;
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

    :where(.css-1588u1j).ant-input-affix-wrapper-rtl,
    :where(.css-1588u1j).ant-input-affix-wrapper-textarea-rtl {
        direction: rtl;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper:not(.ant-input-disabled):hover {
        z-index: 1;
    }

    .ant-input-search-with-button :where(.css-1588u1j).ant-input-affix-wrapper:not(.ant-input-disabled):hover {
        z-index: 0;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper-focused,
    :where(.css-1588u1j).ant-input-affix-wrapper:focus {
        z-index: 1;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper>input.ant-input {
        padding: 0;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper>input.ant-input,
    :where(.css-1588u1j).ant-input-affix-wrapper>textarea.ant-input {
        font-size: inherit;
        border: none;
        border-radius: 0;
        outline: none;
        background: transparent;
        color: inherit;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper>input.ant-input::-ms-reveal,
    :where(.css-1588u1j).ant-input-affix-wrapper>textarea.ant-input::-ms-reveal {
        display: none;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper>input.ant-input:focus,
    :where(.css-1588u1j).ant-input-affix-wrapper>textarea.ant-input:focus {
        box-shadow: none !important;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper::before {
        display: inline-block;
        width: 0;
        visibility: hidden;
        content: "\a0";
    }

    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix,
    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix {
        display: flex;
        flex: none;
        align-items: center;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix>*:not(:last-child),
    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix>*:not(:last-child) {
        margin-inline-end: 8px;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-show-count-suffix {
        color: rgba(0, 0, 0, 0.45);
    }

    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-show-count-has-suffix {
        margin-inline-end: 4px;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-prefix {
        margin-inline-end: 4px;
    }

    :where(.css-1588u1j).ant-input-affix-wrapper .ant-input-suffix {
        margin-inline-start: 4px;
    }

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
        padding-inline-end: 8px;
    }

    :where(.css-1588u1j).ant-input-group[class*='col-']:last-child {
        padding-inline-end: 0;
    }

    :where(.css-1588u1j).ant-input-group-lg .ant-input,
    :where(.css-1588u1j).ant-input-group-lg>.ant-input-group-addon {
        padding: 7px 11px;
        font-size: 16px;
        line-height: 1.5;
        border-radius: 8px;
    }

    :where(.css-1588u1j).ant-input-group-sm .ant-input,
    :where(.css-1588u1j).ant-input-group-sm>.ant-input-group-addon {
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

    :where(.css-1588u1j).ant-input-group>.ant-input {
        display: table-cell;
    }

    :where(.css-1588u1j).ant-input-group>.ant-input:not(:first-child):not(:last-child) {
        border-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group .ant-input-group-addon,
    :where(.css-1588u1j).ant-input-group .ant-input-group-wrap {
        display: table-cell;
        width: 1px;
        white-space: nowrap;
        vertical-align: middle;
    }

    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:not(:first-child):not(:last-child),
    :where(.css-1588u1j).ant-input-group .ant-input-group-wrap:not(:first-child):not(:last-child) {
        border-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group .ant-input-group-wrap>* {
        display: block !important;
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

    :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select-open .ant-select-selector,
    :where(.css-1588u1j).ant-input-group .ant-input-group-addon .ant-select-focused .ant-select-selector {
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
        border-inline-end-width: 1px;
    }

    :where(.css-1588u1j).ant-input-group .ant-input:hover {
        z-index: 1;
        border-inline-end-width: 1px;
    }

    .ant-input-search-with-button :where(.css-1588u1j).ant-input-group .ant-input:hover {
        z-index: 0;
    }

    :where(.css-1588u1j).ant-input-group>.ant-input:first-child,
    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:first-child {
        border-start-end-radius: 0;
        border-end-end-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group>.ant-input:first-child .ant-select .ant-select-selector,
    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:first-child .ant-select .ant-select-selector {
        border-start-end-radius: 0;
        border-end-end-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group>.ant-input-affix-wrapper:not(:first-child) .ant-input {
        border-start-start-radius: 0;
        border-end-start-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group>.ant-input-affix-wrapper:not(:last-child) .ant-input {
        border-start-end-radius: 0;
        border-end-end-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group>.ant-input:last-child,
    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:last-child {
        border-start-start-radius: 0;
        border-end-start-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group>.ant-input:last-child .ant-select .ant-select-selector,
    :where(.css-1588u1j).ant-input-group .ant-input-group-addon:last-child .ant-select .ant-select-selector {
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

    :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:first-child),
    .ant-input-search :where(.css-1588u1j).ant-input-group .ant-input-affix-wrapper:not(:first-child) {
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

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child),
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child),
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input:not(:first-child):not(:last-child) {
        border-inline-end-width: 1px;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child):hover,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child):hover,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input:not(:first-child):not(:last-child):hover,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-addon:not(:first-child):not(:last-child):focus,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrap:not(:first-child):not(:last-child):focus,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input:not(:first-child):not(:last-child):focus {
        z-index: 1;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>* {
        display: inline-flex;
        float: none;
        vertical-align: top;
        border-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-affix-wrapper,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-number-affix-wrapper,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-picker-range {
        display: inline-flex;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:not(:last-child) {
        margin-inline-end: -1px;
        border-inline-end-width: 1px;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input {
        float: none;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input {
        border-inline-end-width: 1px;
        border-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector:hover,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input:hover,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input:hover,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input:hover,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-selector:focus,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input:focus,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker .ant-input:focus,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-input-group-wrapper .ant-input:focus {
        z-index: 1;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-focused {
        z-index: 1;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select>.ant-select-arrow {
        z-index: 1;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:first-child,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select:first-child>.ant-select-selector,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete:first-child .ant-input,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker:first-child .ant-input {
        border-start-start-radius: 6px;
        border-end-start-radius: 6px;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>*:last-child,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select:last-child>.ant-select-selector,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker:last-child .ant-input,
    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-cascader-picker-focused:last-child .ant-input {
        border-inline-end-width: 1px;
        border-start-end-radius: 6px;
        border-end-end-radius: 6px;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact>.ant-select-auto-complete .ant-input {
        vertical-align: top;
    }

    :where(.css-1588u1j).ant-input-group.ant-input-group-compact .ant-input-group-wrapper+.ant-input-group-wrapper {
        margin-inline-start: -1px;
    }

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
        border-inline-end: 0;
    }

    :where(.css-1588u1j).ant-input-group-wrapper-outlined .ant-input-group-addon:last-child {
        border-inline-start: 0;
    }

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

    :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon input[disabled],
    :where(.css-1588u1j).ant-input-group-wrapper-outlined.ant-input-group-wrapper-disabled .ant-input-group-addon textarea[disabled] {
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
        border-inline-start: 1px solid rgba(5, 5, 5, 0.06);
    }

    :where(.css-1588u1j).ant-input-group-wrapper-filled .ant-input-group .ant-input-filled:not(:focus):not(:focus-within):not(:last-child) {
        border-inline-end: 1px solid rgba(5, 5, 5, 0.06);
    }

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
        border-inline-start: 1px solid #d9d9d9;
        border-top: 1px solid #d9d9d9;
        border-bottom: 1px solid #d9d9d9;
    }

    :where(.css-1588u1j).ant-input-group-wrapper-filled.ant-input-group-wrapper-disabled .ant-input-group-addon:last-child {
        border-inline-end: 1px solid #d9d9d9;
        border-top: 1px solid #d9d9d9;
        border-bottom: 1px solid #d9d9d9;
    }

    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item).ant-input-compact-item .ant-input,
    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item).ant-input-compact-item .ant-input-group-addon {
        border-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-first-item .ant-input,
    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-first-item .ant-input-group-addon {
        border-start-end-radius: 0;
        border-end-end-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item).ant-input-compact-last-item .ant-input,
    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-first-item).ant-input-compact-last-item .ant-input-group-addon {
        border-start-start-radius: 0;
        border-end-start-radius: 0;
    }

    :where(.css-1588u1j).ant-input-group-wrapper:not(.ant-input-compact-last-item).ant-input-compact-item .ant-input-affix-wrapper {
        border-start-end-radius: 0;
        border-end-end-radius: 0;
    }

    :where(.css-1588u1j).ant-input-search .ant-input:hover,
    :where(.css-1588u1j).ant-input-search .ant-input:focus {
        border-color: #484b75;
    }

    :where(.css-1588u1j).ant-input-search .ant-input:hover+.ant-input-group-addon .ant-input-search-button:not(.ant-btn-primary),
    :where(.css-1588u1j).ant-input-search .ant-input:focus+.ant-input-group-addon .ant-input-search-button:not(.ant-btn-primary) {
        border-inline-start-color: #484b75;
    }

    :where(.css-1588u1j).ant-input-search .ant-input-affix-wrapper {
        border-radius: 0;
    }

    :where(.css-1588u1j).ant-input-search .ant-input-lg {
        line-height: 1.4998;
    }

    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child {
        inset-inline-start: -1px;
        padding: 0;
        border: 0;
    }

    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button {
        margin-inline-end: -1px;
        padding-top: 0;
        padding-bottom: 0;
        border-start-start-radius: 0;
        border-start-end-radius: 6px;
        border-end-end-radius: 6px;
        border-end-start-radius: 0;
        box-shadow: none;
    }

    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary) {
        color: rgba(0, 0, 0, 0.45);
    }

    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary):hover {
        color: #484b75;
    }

    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary):active {
        color: #1b1b42;
    }

    :where(.css-1588u1j).ant-input-search>.ant-input-group>.ant-input-group-addon:last-child .ant-input-search-button:not(.ant-btn-primary).ant-btn-loading::before {
        inset-inline-start: 0;
        inset-inline-end: 0;
        inset-block-start: 0;
        inset-block-end: 0;
    }

    :where(.css-1588u1j).ant-input-search .ant-input-search-button {
        height: 32px;
    }

    :where(.css-1588u1j).ant-input-search .ant-input-search-button:hover,
    :where(.css-1588u1j).ant-input-search .ant-input-search-button:focus {
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
        margin-inline-end: -1px;
        border-radius: 0;
    }

    :where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-first-item) .ant-input,
    :where(.css-1588u1j).ant-input-search.ant-input-compact-item:not(.ant-input-compact-first-item) .ant-input-affix-wrapper {
        border-radius: 0;
    }

    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input-group-addon .ant-input-search-button:hover,
    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input:hover,
    :where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:hover,
    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input-group-addon .ant-input-search-button:focus,
    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input:focus,
    :where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:focus,
    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input-group-addon .ant-input-search-button:active,
    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input:active,
    :where(.css-1588u1j).ant-input-search.ant-input-compact-item .ant-input-affix-wrapper:active {
        z-index: 2;
    }

    :where(.css-1588u1j).ant-input-search.ant-input-compact-item>.ant-input-affix-wrapper-focused {
        z-index: 2;
    }

    :where(.css-1588u1j).ant-input-out-of-range,
    :where(.css-1588u1j).ant-input-out-of-range input,
    :where(.css-1588u1j).ant-input-out-of-range textarea,
    :where(.css-1588u1j).ant-input-out-of-range .ant-input-show-count-suffix,
    :where(.css-1588u1j).ant-input-out-of-range .ant-input-data-count {
        color: #ff4d4f;
    }

    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item) {
        margin-inline-end: -1px;
    }

    :where(.css-1588u1j).ant-input-compact-item:hover,
    :where(.css-1588u1j).ant-input-compact-item:focus,
    :where(.css-1588u1j).ant-input-compact-item:active {
        z-index: 2;
    }

    :where(.css-1588u1j).ant-input-compact-item[disabled] {
        z-index: 0;
    }

    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item):not(.ant-input-compact-last-item) {
        border-radius: 0;
    }

    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item,
    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item.ant-input-sm,
    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-last-item).ant-input-compact-first-item.ant-input-lg {
        border-start-end-radius: 0;
        border-end-end-radius: 0;
    }

    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item,
    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item.ant-input-sm,
    :where(.css-1588u1j).ant-input-compact-item:not(.ant-input-compact-first-item).ant-input-compact-last-item.ant-input-lg {
        border-start-start-radius: 0;
        border-end-start-radius: 0;
    }

    :where(.css-1588u1j)[class^="ant-tabs"],
    :where(.css-1588u1j)[class*=" ant-tabs"] {
        font-family: var(--font-noto-sans);
        font-size: 14px;
        box-sizing: border-box;
    }

    :where(.css-1588u1j)[class^="ant-tabs"]::before,
    :where(.css-1588u1j)[class*=" ant-tabs"]::before,
    :where(.css-1588u1j)[class^="ant-tabs"]::after,
    :where(.css-1588u1j)[class*=" ant-tabs"]::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j)[class^="ant-tabs"] [class^="ant-tabs"],
    :where(.css-1588u1j)[class*=" ant-tabs"] [class^="ant-tabs"],
    :where(.css-1588u1j)[class^="ant-tabs"] [class*=" ant-tabs"],
    :where(.css-1588u1j)[class*=" ant-tabs"] [class*=" ant-tabs"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j)[class^="ant-tabs"] [class^="ant-tabs"]::before,
    :where(.css-1588u1j)[class*=" ant-tabs"] [class^="ant-tabs"]::before,
    :where(.css-1588u1j)[class^="ant-tabs"] [class*=" ant-tabs"]::before,
    :where(.css-1588u1j)[class*=" ant-tabs"] [class*=" ant-tabs"]::before,
    :where(.css-1588u1j)[class^="ant-tabs"] [class^="ant-tabs"]::after,
    :where(.css-1588u1j)[class*=" ant-tabs"] [class^="ant-tabs"]::after,
    :where(.css-1588u1j)[class^="ant-tabs"] [class*=" ant-tabs"]::after,
    :where(.css-1588u1j)[class*=" ant-tabs"] [class*=" ant-tabs"]::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-tabs-small>.ant-tabs-nav .ant-tabs-tab {
        padding: 8px 0;
        font-size: 14px;
    }

    :where(.css-1588u1j).ant-tabs-large>.ant-tabs-nav .ant-tabs-tab {
        padding: 16px 0;
        font-size: 16px;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-small>.ant-tabs-nav .ant-tabs-tab {
        padding: 6px 16px;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-small.ant-tabs-bottom>.ant-tabs-nav .ant-tabs-tab {
        border-radius: 0 0 6px 6px;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-small.ant-tabs-top>.ant-tabs-nav .ant-tabs-tab {
        border-radius: 6px 6px 0 0;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-small.ant-tabs-right>.ant-tabs-nav .ant-tabs-tab {
        border-radius: 0 6px 6px 0;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-small.ant-tabs-left>.ant-tabs-nav .ant-tabs-tab {
        border-radius: 6px 0 0 6px;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-large>.ant-tabs-nav .ant-tabs-tab {
        padding: 8px 16px 6px;
    }

    :where(.css-1588u1j).ant-tabs-rtl {
        direction: rtl;
    }

    :where(.css-1588u1j).ant-tabs-rtl .ant-tabs-nav .ant-tabs-tab {
        margin: 0 0 0 32px;
    }

    :where(.css-1588u1j).ant-tabs-rtl .ant-tabs-nav .ant-tabs-tab .ant-tabs-tab:last-of-type {
        margin-left: 0;
    }

    :where(.css-1588u1j).ant-tabs-rtl .ant-tabs-nav .ant-tabs-tab .anticon {
        margin-right: 0;
        margin-left: 12px;
    }

    :where(.css-1588u1j).ant-tabs-rtl .ant-tabs-nav .ant-tabs-tab .ant-tabs-tab-remove {
        margin-right: 8px;
        margin-left: -4px;
    }

    :where(.css-1588u1j).ant-tabs-rtl .ant-tabs-nav .ant-tabs-tab .ant-tabs-tab-remove .anticon {
        margin: 0;
    }

    :where(.css-1588u1j).ant-tabs-rtl.ant-tabs-left>.ant-tabs-nav {
        order: 1;
    }

    :where(.css-1588u1j).ant-tabs-rtl.ant-tabs-left>.ant-tabs-content-holder {
        order: 0;
    }

    :where(.css-1588u1j).ant-tabs-rtl.ant-tabs-right>.ant-tabs-nav {
        order: 0;
    }

    :where(.css-1588u1j).ant-tabs-rtl.ant-tabs-right>.ant-tabs-content-holder {
        order: 1;
    }

    :where(.css-1588u1j).ant-tabs-rtl.ant-tabs-card.ant-tabs-top>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-rtl.ant-tabs-card.ant-tabs-bottom>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-rtl.ant-tabs-card.ant-tabs-top>div>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-rtl.ant-tabs-card.ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab {
        margin-right: 2px;
        margin-left: 0;
    }

    :where(.css-1588u1j).ant-tabs-dropdown-rtl {
        direction: rtl;
    }

    :where(.css-1588u1j).ant-tabs-menu-item .ant-tabs-dropdown-rtl {
        text-align: right;
    }

    :where(.css-1588u1j).ant-tabs-top,
    :where(.css-1588u1j).ant-tabs-bottom {
        flex-direction: column;
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav {
        margin: 0 0 16px 0;
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav::before,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav::before,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav::before,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav::before {
        position: absolute;
        right: 0;
        left: 0;
        border-bottom: 1px solid #f0f0f0;
        content: '';
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-ink-bar {
        height: 2px;
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav .ant-tabs-ink-bar-animated,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav .ant-tabs-ink-bar-animated,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav .ant-tabs-ink-bar-animated,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-ink-bar-animated {
        transition: width 0.3s, left 0.3s, right 0.3s;
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-nav-wrap::after {
        top: 0;
        bottom: 0;
        width: 32px;
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-nav-wrap::before {
        left: 0;
        box-shadow: inset 10px 0 8px -8px rgba(0, 0, 0, 0.08);
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-nav-wrap::after {
        right: 0;
        box-shadow: inset -10px 0 8px -8px rgba(0, 0, 0, 0.08);
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-left::before,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-left::before,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-left::before,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-left::before {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-right::after,
    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-right::after,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-right::after,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-right::after {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav::before,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav::before {
        bottom: 0;
    }

    :where(.css-1588u1j).ant-tabs-top>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-top>div>.ant-tabs-nav .ant-tabs-ink-bar {
        bottom: 0;
    }

    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav {
        order: 1;
        margin-top: 16px;
        margin-bottom: 0;
    }

    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav::before,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav::before {
        top: 0;
    }

    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-ink-bar {
        top: 0;
    }

    :where(.css-1588u1j).ant-tabs-bottom>.ant-tabs-content-holder,
    :where(.css-1588u1j).ant-tabs-bottom>div>.ant-tabs-content-holder {
        order: 0;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav {
        flex-direction: column;
        min-width: 40px;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-tab {
        padding: 8px 24px;
        text-align: center;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab {
        margin: 16px 0 0 0;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-nav-wrap,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-nav-wrap,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-nav-wrap,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-nav-wrap {
        flex-direction: column;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-nav-wrap::after {
        right: 0;
        left: 0;
        height: 32px;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-nav-wrap::before {
        top: 0;
        box-shadow: inset 0 10px 8px -8px rgba(0, 0, 0, 0.08);
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-nav-wrap::after {
        bottom: 0;
        box-shadow: inset 0 -10px 8px -8px rgba(0, 0, 0, 0.08);
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-top::before,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-top::before,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-top::before,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-top::before {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-bottom::after,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-bottom::after,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-bottom::after,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-nav-wrap.ant-tabs-nav-wrap-ping-bottom::after {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-ink-bar {
        width: 2px;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-ink-bar-animated,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-ink-bar-animated,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-ink-bar-animated,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-ink-bar-animated {
        transition: height 0.3s, top 0.3s;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-nav-list,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-nav-list,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-nav-list,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-nav-list,
    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-nav-operations,
    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-nav-operations,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-nav-operations,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-nav-operations {
        flex: 1 0 auto;
        flex-direction: column;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-nav .ant-tabs-ink-bar {
        right: 0;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-content-holder,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-content-holder {
        margin-left: -1px;
        border-left: 1px solid #d9d9d9;
    }

    :where(.css-1588u1j).ant-tabs-left>.ant-tabs-content-holder>.ant-tabs-content>.ant-tabs-tabpane,
    :where(.css-1588u1j).ant-tabs-left>div>.ant-tabs-content-holder>.ant-tabs-content>.ant-tabs-tabpane {
        padding-left: 24px;
    }

    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav {
        order: 1;
    }

    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-nav .ant-tabs-ink-bar {
        left: 0;
    }

    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-content-holder,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-content-holder {
        order: 0;
        margin-right: -1px;
        border-right: 1px solid #d9d9d9;
    }

    :where(.css-1588u1j).ant-tabs-right>.ant-tabs-content-holder>.ant-tabs-content>.ant-tabs-tabpane,
    :where(.css-1588u1j).ant-tabs-right>div>.ant-tabs-content-holder>.ant-tabs-content>.ant-tabs-tabpane {
        padding-right: 24px;
    }

    :where(.css-1588u1j).ant-tabs-dropdown {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        color: rgba(0, 0, 0, 0.88);
        font-size: 14px;
        line-height: 1.5714285714285714;
        list-style: none;
        font-family: var(--font-noto-sans);
        position: absolute;
        top: -9999px;
        left: -9999px;
        z-index: 1050;
        display: block;
    }

    :where(.css-1588u1j).ant-tabs-dropdown-hidden {
        display: none;
    }

    :where(.css-1588u1j).ant-tabs-dropdown .ant-tabs-dropdown-menu {
        max-height: 200px;
        margin: 0;
        padding: 4px 0;
        overflow-x: hidden;
        overflow-y: auto;
        text-align: left;
        list-style-type: none;
        background-color: #ffffff;
        background-clip: padding-box;
        border-radius: 8px;
        outline: none;
        box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
    }

    :where(.css-1588u1j).ant-tabs-dropdown .ant-tabs-dropdown-menu-item {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        display: flex;
        align-items: center;
        min-width: 120px;
        margin: 0;
        padding: 4px 12px;
        color: rgba(0, 0, 0, 0.88);
        font-weight: normal;
        font-size: 14px;
        line-height: 1.5714285714285714;
        cursor: pointer;
        transition: all 0.3s;
    }

    :where(.css-1588u1j).ant-tabs-dropdown .ant-tabs-dropdown-menu-item>span {
        flex: 1;
        white-space: nowrap;
    }

    :where(.css-1588u1j).ant-tabs-dropdown .ant-tabs-dropdown-menu-item-remove {
        flex: none;
        margin-left: 12px;
        color: rgba(0, 0, 0, 0.45);
        font-size: 12px;
        background: transparent;
        border: 0;
        cursor: pointer;
    }

    :where(.css-1588u1j).ant-tabs-dropdown .ant-tabs-dropdown-menu-item-remove:hover {
        color: #484b75;
    }

    :where(.css-1588u1j).ant-tabs-dropdown .ant-tabs-dropdown-menu-item:hover {
        background: rgba(0, 0, 0, 0.04);
    }

    :where(.css-1588u1j).ant-tabs-dropdown .ant-tabs-dropdown-menu-item-disabled,
    :where(.css-1588u1j).ant-tabs-dropdown .ant-tabs-dropdown-menu-item-disabled:hover {
        color: rgba(0, 0, 0, 0.25);
        background: transparent;
        cursor: not-allowed;
    }

    :where(.css-1588u1j).ant-tabs-card>.ant-tabs-nav .ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card>div>.ant-tabs-nav .ant-tabs-tab {
        margin: 0;
        padding: 8px 16px;
        background: rgba(0, 0, 0, 0.02);
        border: 1px solid #f0f0f0;
        transition: all 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    :where(.css-1588u1j).ant-tabs-card>.ant-tabs-nav .ant-tabs-tab-active,
    :where(.css-1588u1j).ant-tabs-card>div>.ant-tabs-nav .ant-tabs-tab-active {
        color: #2f3268;
        background: #ffffff;
    }

    :where(.css-1588u1j).ant-tabs-card>.ant-tabs-nav .ant-tabs-ink-bar,
    :where(.css-1588u1j).ant-tabs-card>div>.ant-tabs-nav .ant-tabs-ink-bar {
        visibility: hidden;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-top>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-bottom>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-top>div>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab {
        margin-left: 2px;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-top>.ant-tabs-nav .ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-top>div>.ant-tabs-nav .ant-tabs-tab {
        border-radius: 8px 8px 0 0;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-top>.ant-tabs-nav .ant-tabs-tab-active,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-top>div>.ant-tabs-nav .ant-tabs-tab-active {
        border-bottom-color: #ffffff;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-bottom>.ant-tabs-nav .ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-tab {
        border-radius: 0 0 8px 8px;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-bottom>.ant-tabs-nav .ant-tabs-tab-active,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-bottom>div>.ant-tabs-nav .ant-tabs-tab-active {
        border-top-color: #ffffff;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-left>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-right>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-left>div>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-right>div>.ant-tabs-nav .ant-tabs-tab+.ant-tabs-tab {
        margin-top: 2px;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-left>.ant-tabs-nav .ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-left>div>.ant-tabs-nav .ant-tabs-tab {
        border-radius: 8px 0 0 8px;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-left>.ant-tabs-nav .ant-tabs-tab-active,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-left>div>.ant-tabs-nav .ant-tabs-tab-active {
        border-right-color: #ffffff;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-right>.ant-tabs-nav .ant-tabs-tab,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-right>div>.ant-tabs-nav .ant-tabs-tab {
        border-radius: 0 8px 8px 0;
    }

    :where(.css-1588u1j).ant-tabs-card.ant-tabs-right>.ant-tabs-nav .ant-tabs-tab-active,
    :where(.css-1588u1j).ant-tabs-card.ant-tabs-right>div>.ant-tabs-nav .ant-tabs-tab-active {
        border-left-color: #ffffff;
    }

    :where(.css-1588u1j).ant-tabs {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        color: rgba(0, 0, 0, 0.88);
        font-size: 14px;
        line-height: 1.5714285714285714;
        list-style: none;
        font-family: var(--font-noto-sans);
        display: flex;
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav {
        position: relative;
        display: flex;
        flex: none;
        align-items: center;
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-wrap,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-wrap {
        position: relative;
        display: flex;
        flex: auto;
        align-self: stretch;
        overflow: hidden;
        white-space: nowrap;
        transform: translate(0);
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-wrap::before,
    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-wrap::after,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-wrap::after {
        position: absolute;
        z-index: 1;
        opacity: 0;
        transition: opacity 0.3s;
        content: '';
        pointer-events: none;
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-list,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-list {
        position: relative;
        display: flex;
        transition: opacity 0.3s;
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-operations,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-operations {
        display: flex;
        align-self: stretch;
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-operations-hidden,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-operations-hidden {
        position: absolute;
        visibility: hidden;
        pointer-events: none;
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-more,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-more {
        position: relative;
        padding: 8px 16px;
        background: transparent;
        border: 0;
        color: rgba(0, 0, 0, 0.88);
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-more::after,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-more::after {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        height: 5px;
        transform: translateY(100%);
        content: '';
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-add,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-add {
        min-width: 40px;
        min-height: 40px;
        margin-left: 2px;
        padding: 0 8px;
        background: transparent;
        border: 1px solid #f0f0f0;
        border-radius: 8px 8px 0 0;
        outline: none;
        cursor: pointer;
        color: rgba(0, 0, 0, 0.88);
        transition: all 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-add:hover,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-add:hover {
        color: #484b75;
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-add:active,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-add:active,
    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-add:focus:not(:focus-visible),
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-add:focus:not(:focus-visible) {
        color: #1b1b42;
    }

    :where(.css-1588u1j).ant-tabs>.ant-tabs-nav .ant-tabs-nav-add:focus-visible,
    :where(.css-1588u1j).ant-tabs>div>.ant-tabs-nav .ant-tabs-nav-add:focus-visible {
        outline: 4px solid #85868f;
        outline-offset: 1px;
        transition: outline-offset 0s, outline 0s;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-extra-content {
        flex: none;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-ink-bar {
        position: absolute;
        background: #2f3268;
        pointer-events: none;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab {
        position: relative;
        -webkit-touch-callout: none;
        -webkit-tap-highlight-color: transparent;
        display: inline-flex;
        align-items: center;
        padding: 12px 0;
        font-size: 14px;
        background: transparent;
        border: 0;
        outline: none;
        cursor: pointer;
        color: rgba(0, 0, 0, 0.88);
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-btn:focus:not(:focus-visible),
    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-remove:focus:not(:focus-visible),
    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-btn:active,
    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-remove:active {
        color: #1b1b42;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-btn:focus-visible,
    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-remove:focus-visible {
        outline: 4px solid #85868f;
        outline-offset: 1px;
        transition: outline-offset 0s, outline 0s;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-btn {
        outline: none;
        transition: all 0.3s;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-btn .ant-tabs-tab-icon:not(:last-child) {
        margin-inline-end: 12px;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-remove {
        flex: none;
        margin-right: -4px;
        margin-left: 8px;
        color: rgba(0, 0, 0, 0.45);
        font-size: 12px;
        background: transparent;
        border: none;
        outline: none;
        cursor: pointer;
        transition: all 0.3s;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab-remove:hover {
        color: rgba(0, 0, 0, 0.88);
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab:hover {
        color: #484b75;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab.ant-tabs-tab-active .ant-tabs-tab-btn {
        color: #2f3268;
        text-shadow: 0 0 0.25px currentcolor;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab.ant-tabs-tab-disabled {
        color: rgba(0, 0, 0, 0.25);
        cursor: not-allowed;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab.ant-tabs-tab-disabled .ant-tabs-tab-btn:focus,
    :where(.css-1588u1j).ant-tabs .ant-tabs-tab.ant-tabs-tab-disabled .ant-tabs-remove:focus,
    :where(.css-1588u1j).ant-tabs .ant-tabs-tab.ant-tabs-tab-disabled .ant-tabs-tab-btn:active,
    :where(.css-1588u1j).ant-tabs .ant-tabs-tab.ant-tabs-tab-disabled .ant-tabs-remove:active {
        color: rgba(0, 0, 0, 0.25);
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab .ant-tabs-tab-remove .anticon {
        margin: 0;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab .anticon:not(:last-child) {
        margin-right: 12px;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tab+.ant-tabs-tab {
        margin: 0 0 0 32px;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-content {
        position: relative;
        width: 100%;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-content-holder {
        flex: auto;
        min-width: 0;
        min-height: 0;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tabpane {
        outline: none;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-tabpane-hidden {
        display: none;
    }

    :where(.css-1588u1j).ant-tabs-centered>.ant-tabs-nav .ant-tabs-nav-wrap:not([class*='.ant-tabs-nav-wrap-ping']),
    :where(.css-1588u1j).ant-tabs-centered>div>.ant-tabs-nav .ant-tabs-nav-wrap:not([class*='.ant-tabs-nav-wrap-ping']) {
        justify-content: center;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-switch-appear,
    :where(.css-1588u1j).ant-tabs .ant-tabs-switch-enter {
        transition: none;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-switch-appear-start,
    :where(.css-1588u1j).ant-tabs .ant-tabs-switch-enter-start {
        opacity: 0;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-switch-appear-active,
    :where(.css-1588u1j).ant-tabs .ant-tabs-switch-enter-active {
        opacity: 1;
        transition: opacity 0.3s;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-switch-leave {
        position: absolute;
        transition: none;
        inset: 0;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-switch-leave-start {
        opacity: 1;
    }

    :where(.css-1588u1j).ant-tabs .ant-tabs-switch-leave-active {
        opacity: 0;
        transition: opacity 0.3s;
    }

    :where(.css-1588u1j).ant-slide-up-enter,
    :where(.css-1588u1j).ant-slide-up-appear {
        animation-duration: 0.2s;
        animation-fill-mode: both;
        animation-play-state: paused;
    }

    :where(.css-1588u1j).ant-slide-up-leave {
        animation-duration: 0.2s;
        animation-fill-mode: both;
        animation-play-state: paused;
    }

    :where(.css-1588u1j).ant-slide-up-enter.ant-slide-up-enter-active,
    :where(.css-1588u1j).ant-slide-up-appear.ant-slide-up-appear-active {
        animation-name: css-1588u1j-antSlideUpIn;
        animation-play-state: running;
    }

    :where(.css-1588u1j).ant-slide-up-leave.ant-slide-up-leave-active {
        animation-name: css-1588u1j-antSlideUpOut;
        animation-play-state: running;
        pointer-events: none;
    }

    :where(.css-1588u1j).ant-slide-up-enter,
    :where(.css-1588u1j).ant-slide-up-appear {
        transform: scale(0);
        transform-origin: 0% 0%;
        opacity: 0;
        animation-timing-function: cubic-bezier(0.23, 1, 0.32, 1);
    }

    :where(.css-1588u1j).ant-slide-up-enter-prepare,
    :where(.css-1588u1j).ant-slide-up-appear-prepare {
        transform: scale(1);
    }

    :where(.css-1588u1j).ant-slide-up-leave {
        animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
    }

    :where(.css-1588u1j).ant-slide-down-enter,
    :where(.css-1588u1j).ant-slide-down-appear {
        animation-duration: 0.2s;
        animation-fill-mode: both;
        animation-play-state: paused;
    }

    :where(.css-1588u1j).ant-slide-down-leave {
        animation-duration: 0.2s;
        animation-fill-mode: both;
        animation-play-state: paused;
    }

    :where(.css-1588u1j).ant-slide-down-enter.ant-slide-down-enter-active,
    :where(.css-1588u1j).ant-slide-down-appear.ant-slide-down-appear-active {
        animation-name: css-1588u1j-antSlideDownIn;
        animation-play-state: running;
    }

    :where(.css-1588u1j).ant-slide-down-leave.ant-slide-down-leave-active {
        animation-name: css-1588u1j-antSlideDownOut;
        animation-play-state: running;
        pointer-events: none;
    }

    :where(.css-1588u1j).ant-slide-down-enter,
    :where(.css-1588u1j).ant-slide-down-appear {
        transform: scale(0);
        transform-origin: 0% 0%;
        opacity: 0;
        animation-timing-function: cubic-bezier(0.23, 1, 0.32, 1);
    }

    :where(.css-1588u1j).ant-slide-down-enter-prepare,
    :where(.css-1588u1j).ant-slide-down-appear-prepare {
        transform: scale(1);
    }

    :where(.css-1588u1j).ant-slide-down-leave {
        animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
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

    :where(.css-1pg9a38) a {
        color: #1677ff;
        text-decoration: none;
        background-color: transparent;
        outline: none;
        cursor: pointer;
        transition: color 0.3s;
        -webkit-text-decoration-skip: objects;
    }

    :where(.css-1pg9a38) a:hover {
        color: #69b1ff;
    }

    :where(.css-1pg9a38) a:active {
        color: #0958d9;
    }

    :where(.css-1pg9a38) a:active,
    :where(.css-1pg9a38) a:hover {
        text-decoration: none;
        outline: 0;
    }

    :where(.css-1pg9a38) a:focus {
        text-decoration: none;
        outline: 0;
    }

    :where(.css-1pg9a38) a[disabled] {
        color: rgba(0, 0, 0, 0.25);
        cursor: not-allowed;
    }

    :where(.css-1pg9a38).ant-skeleton {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-size: 14px;
        box-sizing: border-box;
    }

    :where(.css-1pg9a38).ant-skeleton::before,
    :where(.css-1pg9a38).ant-skeleton::after {
        box-sizing: border-box;
    }

    :where(.css-1pg9a38).ant-skeleton [class^="ant-skeleton"],
    :where(.css-1pg9a38).ant-skeleton [class*=" ant-skeleton"] {
        box-sizing: border-box;
    }

    :where(.css-1pg9a38).ant-skeleton [class^="ant-skeleton"]::before,
    :where(.css-1pg9a38).ant-skeleton [class*=" ant-skeleton"]::before,
    :where(.css-1pg9a38).ant-skeleton [class^="ant-skeleton"]::after,
    :where(.css-1pg9a38).ant-skeleton [class*=" ant-skeleton"]::after {
        box-sizing: border-box;
    }

    :where(.css-1pg9a38).ant-skeleton {
        display: table;
        width: 100%;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-header {
        display: table-cell;
        padding-inline-end: 16px;
        vertical-align: top;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-header .ant-skeleton-avatar {
        display: inline-block;
        vertical-align: top;
        background: rgba(0, 0, 0, 0.06);
        width: 32px;
        height: 32px;
        line-height: 32px;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-header .ant-skeleton-avatar-circle {
        border-radius: 50%;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-header .ant-skeleton-avatar-lg {
        width: 40px;
        height: 40px;
        line-height: 40px;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-header .ant-skeleton-avatar-sm {
        width: 24px;
        height: 24px;
        line-height: 24px;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-content {
        display: table-cell;
        width: 100%;
        vertical-align: top;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-content .ant-skeleton-title {
        width: 100%;
        height: 16px;
        background: rgba(0, 0, 0, 0.06);
        border-radius: 4px;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-content .ant-skeleton-title+.ant-skeleton-paragraph {
        margin-block-start: 24px;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-content .ant-skeleton-paragraph {
        padding: 0;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-content .ant-skeleton-paragraph>li {
        width: 100%;
        height: 16px;
        list-style: none;
        background: rgba(0, 0, 0, 0.06);
        border-radius: 4px;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-content .ant-skeleton-paragraph>li+li {
        margin-block-start: 16px;
    }

    :where(.css-1pg9a38).ant-skeleton .ant-skeleton-content .ant-skeleton-paragraph>li:last-child:not(:first-child):not(:nth-child(2)) {
        width: 61%;
    }

    :where(.css-1pg9a38).ant-skeleton-round .ant-skeleton-content .ant-skeleton-title,
    :where(.css-1pg9a38).ant-skeleton-round .ant-skeleton-content .ant-skeleton-paragraph>li {
        border-radius: 100px;
    }

    :where(.css-1pg9a38).ant-skeleton-with-avatar .ant-skeleton-content .ant-skeleton-title {
        margin-block-start: 12px;
    }

    :where(.css-1pg9a38).ant-skeleton-with-avatar .ant-skeleton-content .ant-skeleton-title+.ant-skeleton-paragraph {
        margin-block-start: 28px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element {
        display: inline-block;
        width: auto;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-button {
        display: inline-block;
        vertical-align: top;
        background: rgba(0, 0, 0, 0.06);
        border-radius: 4px;
        width: 64px;
        min-width: 64px;
        height: 32px;
        line-height: 32px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-button.ant-skeleton-button-circle {
        width: 32px;
        min-width: 32px;
        border-radius: 50%;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-button.ant-skeleton-button-round {
        border-radius: 32px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-button-lg {
        width: 80px;
        min-width: 80px;
        height: 40px;
        line-height: 40px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-button-lg.ant-skeleton-button-circle {
        width: 40px;
        min-width: 40px;
        border-radius: 50%;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-button-lg.ant-skeleton-button-round {
        border-radius: 40px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-button-sm {
        width: 48px;
        min-width: 48px;
        height: 24px;
        line-height: 24px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-button-sm.ant-skeleton-button-circle {
        width: 24px;
        min-width: 24px;
        border-radius: 50%;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-button-sm.ant-skeleton-button-round {
        border-radius: 24px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-avatar {
        display: inline-block;
        vertical-align: top;
        background: rgba(0, 0, 0, 0.06);
        width: 32px;
        height: 32px;
        line-height: 32px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-avatar.ant-skeleton-avatar-circle {
        border-radius: 50%;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-avatar.ant-skeleton-avatar-lg {
        width: 40px;
        height: 40px;
        line-height: 40px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-avatar.ant-skeleton-avatar-sm {
        width: 24px;
        height: 24px;
        line-height: 24px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-input {
        display: inline-block;
        vertical-align: top;
        background: rgba(0, 0, 0, 0.06);
        border-radius: 4px;
        width: 160px;
        min-width: 160px;
        height: 32px;
        line-height: 32px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-input-lg {
        width: 200px;
        min-width: 200px;
        height: 40px;
        line-height: 40px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-input-sm {
        width: 120px;
        min-width: 120px;
        height: 24px;
        line-height: 24px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-image {
        display: flex;
        align-items: center;
        justify-content: center;
        vertical-align: top;
        background: rgba(0, 0, 0, 0.06);
        border-radius: 4px;
        width: 96px;
        height: 96px;
        line-height: 96px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-image .ant-skeleton-image-path {
        fill: #bfbfbf;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-image .ant-skeleton-image-svg {
        width: 48px;
        height: 48px;
        line-height: 48px;
        max-width: 192px;
        max-height: 192px;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-image .ant-skeleton-image-svg.ant-skeleton-image-svg-circle {
        border-radius: 50%;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-element .ant-skeleton-image.ant-skeleton-image-circle {
        border-radius: 50%;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-block {
        width: 100%;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-block .ant-skeleton-button {
        width: 100%;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-block .ant-skeleton-input {
        width: 100%;
    }

    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-active .ant-skeleton-title,
    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-active .ant-skeleton-paragraph>li,
    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-active .ant-skeleton-avatar,
    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-active .ant-skeleton-button,
    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-active .ant-skeleton-input,
    :where(.css-1pg9a38).ant-skeleton.ant-skeleton-active .ant-skeleton-image {
        background: linear-gradient(90deg, rgba(0, 0, 0, 0.06) 25%, rgba(0, 0, 0, 0.15) 37%, rgba(0, 0, 0, 0.06) 63%);
        background-size: 400% 100%;
        animation-name: css-1pg9a38-ant-skeleton-loading;
        animation-duration: 1.4s;
        animation-timing-function: ease;
        animation-iteration-count: infinite;
    }

    @keyframes css-1pg9a38-ant-skeleton-loading {
        0% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0 50%;
        }
    }

    :where(.css-1588u1j).ant-tour {
        font-family: var(--font-noto-sans);
        font-size: 14px;
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-tour::before,
    :where(.css-1588u1j).ant-tour::after {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-tour [class^="ant-tour"],
    :where(.css-1588u1j).ant-tour [class*=" ant-tour"] {
        box-sizing: border-box;
    }

    :where(.css-1588u1j).ant-tour [class^="ant-tour"]::before,
    :where(.css-1588u1j).ant-tour [class*=" ant-tour"]::before,
    :where(.css-1588u1j).ant-tour [class^="ant-tour"]::after,
    :where(.css-1588u1j).ant-tour [class*=" ant-tour"]::after {
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
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03), 0 1px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px 0 rgba(0, 0, 0, 0.02);
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
        transition: background-color 0.2s, color 0.2s;
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
        transition: outline-offset 0s, outline 0s;
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
        margin-inline-end: 6px;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-indicators .ant-tour-indicator-active {
        background: #2f3268;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-buttons {
        margin-inline-start: auto;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-inner .ant-tour-footer .ant-tour-buttons .ant-btn {
        margin-inline-start: 8px;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-primary,
    :where(.css-1588u1j).ant-tour.ant-tour-primary {
        --antd-arrow-background-color: #2f3268;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner,
    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner {
        color: #fff;
        text-align: start;
        text-decoration: none;
        background-color: #2f3268;
        border-radius: 6px;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03), 0 1px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px 0 rgba(0, 0, 0, 0.02);
    }

    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-close,
    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-close {
        color: #fff;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator,
    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator {
        background: rgba(255, 255, 255, 0.15);
    }

    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator-active,
    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-indicators .ant-tour-indicator-active {
        background: #fff;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-prev-btn,
    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-prev-btn {
        color: #fff;
        border-color: rgba(255, 255, 255, 0.15);
        background-color: #2f3268;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-prev-btn:hover,
    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-prev-btn:hover {
        background-color: rgba(255, 255, 255, 0.15);
        border-color: transparent;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-next-btn,
    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-next-btn {
        color: #2f3268;
        border-color: transparent;
        background: #fff;
    }

    :where(.css-1588u1j).ant-tour .ant-tour-primary .ant-tour-inner .ant-tour-next-btn:hover,
    :where(.css-1588u1j).ant-tour.ant-tour-primary .ant-tour-inner .ant-tour-next-btn:hover {
        background: rgb(240, 240, 240);
    }

    :where(.css-1588u1j).ant-tour-mask .ant-tour-placeholder-animated {
        transition: all 0.3s;
    }

    :where(.css-1588u1j)-placement-left .ant-tour-inner,
    :where(.css-1588u1j)-placement-leftTop .ant-tour-inner,
    :where(.css-1588u1j)-placement-leftBottom .ant-tour-inner,
    :where(.css-1588u1j)-placement-right .ant-tour-inner,
    :where(.css-1588u1j)-placement-rightTop .ant-tour-inner,
    :where(.css-1588u1j)-placement-rightBottom .ant-tour-inner {
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

    :where(.css-1588u1j).ant-tour-placement-top>.ant-tour-arrow,
    :where(.css-1588u1j).ant-tour-placement-topLeft>.ant-tour-arrow,
    :where(.css-1588u1j).ant-tour-placement-topRight>.ant-tour-arrow {
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

    :where(.css-1588u1j).ant-tour-placement-bottom>.ant-tour-arrow,
    :where(.css-1588u1j).ant-tour-placement-bottomLeft>.ant-tour-arrow,
    :where(.css-1588u1j).ant-tour-placement-bottomRight>.ant-tour-arrow {
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

    :where(.css-1588u1j).ant-tour-placement-left>.ant-tour-arrow,
    :where(.css-1588u1j).ant-tour-placement-leftTop>.ant-tour-arrow,
    :where(.css-1588u1j).ant-tour-placement-leftBottom>.ant-tour-arrow {
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

    :where(.css-1588u1j).ant-tour-placement-right>.ant-tour-arrow,
    :where(.css-1588u1j).ant-tour-placement-rightTop>.ant-tour-arrow,
    :where(.css-1588u1j).ant-tour-placement-rightBottom>.ant-tour-arrow {
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

    @media screen and (-ms-high-contrast: active),
    (-ms-high-contrast: none) {
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

    .anticon>* {
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

    .anticon>* {
        line-height: 1;
    }

    .anticon svg {
        display: inline-block;
    }

    .anticon .anticon .anticon-icon {
        display: block;
    }

    .data-ant-cssinjs-cache-path {
        content: "3hyxim|ant-design-icons|anticon:n18rlk;54mug8|ant-design-icons|anticon:1i7nym9;54mug8|Shared|ant:1ijft1f;54mug8|Layout-Layout|ant-layout|anticon:tnknc0;54mug8|Button-Button|ant-btn|anticon:1cfhi6l;54mug8|Wave-Wave|ant-wave|anticon:6oh8ov;54mug8|Drawer-Drawer|ant-drawer|anticon:oz1ynp;54mug8|Form-Form|ant-form|anticon:nffb1q;54mug8|Grid-Grid|ant-row|anticon:1w2fmdc;54mug8|Grid-Grid|ant-col|anticon:4t782p;54mug8|Input-Input|ant-input|anticon:rrxlx5;54mug8|Form-item-item|ant-form|anticon:122uzvn;54mug8|Tabs-Tabs|ant-tabs|anticon:hqbuwn;3hyxim|Shared|ant:1rg81o6;3hyxim|Skeleton-Skeleton|ant-skeleton|anticon:1hcfqum;54mug8|Tour-Tour|ant-tour|anticon:1vvwohf";
    }
    input#applicationTracking {
    height: unset;
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
                    <div class="applied_visa_page">
                        <div class="mb-5 flex flex-col justify-between gap-[25px] md:flex-row">
                            <div class="flex items-center gap-3">
                                <p class="text-[18px] font-semibold md:text-[22px]">Your All Applied Visa</p>
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
                                                                </svg></span><input
                                                                placeholder="Search Your application"
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
                        <div class="ant-tabs ant-tabs-top css-1588u1j">
                            <div role="tablist" class="ant-tabs-nav">
                                <div class="ant-tabs-nav-wrap">
                                    <div class="ant-tabs-nav-list" style="transform:translate(0px, 0px)">
                                        <div data-node-key="not-complete" class="ant-tabs-tab ant-tabs-tab-active">
                                            <div role="tab" aria-selected="true" class="ant-tabs-tab-btn" tabindex="0"
                                                id="rc-tabs-0-tab-not-complete"
                                                aria-controls="rc-tabs-0-panel-not-complete">Not Submitted</div>
                                        </div>
                                        <div data-node-key="complete" class="ant-tabs-tab">
                                            <div role="tab" aria-selected="false" class="ant-tabs-tab-btn" tabindex="0"
                                                id="rc-tabs-0-tab-complete" aria-controls="rc-tabs-0-panel-complete">
                                                Submitted</div>
                                        </div>
                                        <div class="ant-tabs-ink-bar ant-tabs-ink-bar-animated"
                                            style="width: 96.0781px; left: 48.0391px; transform: translateX(-50%);">
                                        </div>
                                    </div>
                                </div>
                                <div class="ant-tabs-nav-operations ant-tabs-nav-operations-hidden"><button
                                        type="button" class="ant-tabs-nav-more" style="visibility:hidden;order:1"
                                        tabindex="-1" aria-hidden="true" aria-haspopup="listbox"
                                        aria-controls="rc-tabs-0-more-popup" id="rc-tabs-0-more"
                                        aria-expanded="false"><span role="img" aria-label="ellipsis"
                                            class="anticon anticon-ellipsis"><svg viewBox="64 64 896 896"
                                                focusable="false" data-icon="ellipsis" width="1em" height="1em"
                                                fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M176 511a56 56 0 10112 0 56 56 0 10-112 0zm280 0a56 56 0 10112 0 56 56 0 10-112 0zm280 0a56 56 0 10112 0 56 56 0 10-112 0z">
                                                </path>
                                            </svg></span></button></div>
                            </div>
                            <div class="ant-tabs-content-holder">
                                <div class="ant-tabs-content ant-tabs-content-top">
                                    <div id="rc-tabs-0-panel-not-complete" role="tabpanel" tabindex="0"
                                        aria-labelledby="rc-tabs-0-tab-not-complete" aria-hidden="false"
                                        class="ant-tabs-tabpane ant-tabs-tabpane-active"></div>
                                </div>
                            </div>
                        </div>
                        <div class="applied_visa">
                        <div class="applied_visa_list">
        <div class="ant-row ant-row-center css-1588u1j" style="margin-left:-10px;margin-right:-10px;row-gap:20px">
            <?php if ($entries_unpaid_visa): ?>
                <?php foreach ($entries_unpaid_visa as $entry): ?>
                    <div class="ant-ribbon-wrapper css-1588u1j">
                        <div class="applied_visa_card">
                            <div class="title">
                                <p>Applied for Afghanistan Family Visit form Bangladesh</p>
                            </div>
                            <div class="content">
                                <div class="id">
                                    <p class="text-[var(--text-color)]">- - Not Initiated - -</p>
                                    <p class="mt-1 text-xs 2xl:text-[16px]"><?php echo esc_html($entry->date_modified); ?></p>
                                </div>
                                <div class="separator"></div>
                                <div class="case_processing_not_start w-full max-w-[750px]">
                                    <div class="ant-steps ant-steps-horizontal css-1588u1j ant-steps-default ant-steps-label-vertical ant-steps-dot">
                                        <div class="ant-steps-item ant-steps-item-process ant-steps-item-active">
                                            <div class="ant-steps-item-container">
                                                <div class="ant-steps-item-tail"></div>
                                                <div class="ant-steps-item-icon">
                                                    <span class="ant-steps-icon"><span class="ant-steps-icon-dot"></span></span>
                                                </div>
                                                <div class="ant-steps-item-content">
                                                    <div class="ant-steps-item-title">Payment</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ant-steps-item ant-steps-item-wait">
                                            <div class="ant-steps-item-container">
                                                <div class="ant-steps-item-tail"></div>
                                                <div class="ant-steps-item-icon">
                                                    <span class="ant-steps-icon"><span class="ant-steps-icon-dot"></span></span>
                                                </div>
                                                <div class="ant-steps-item-content">
                                                    <div class="ant-steps-item-title">Applicant Profile</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ant-steps-item ant-steps-item-wait">
                                            <div class="ant-steps-item-container">
                                                <div class="ant-steps-item-tail"></div>
                                                <div class="ant-steps-item-icon">
                                                    <span class="ant-steps-icon"><span class="ant-steps-icon-dot"></span></span>
                                                </div>
                                                <div class="ant-steps-item-content">
                                                    <div class="ant-steps-item-title">Checklist</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ant-steps-item ant-steps-item-wait">
                                            <div class="ant-steps-item-container">
                                                <div class="ant-steps-item-tail"></div>
                                                <div class="ant-steps-item-icon">
                                                    <span class="ant-steps-icon"><span class="ant-steps-icon-dot"></span></span>
                                                </div>
                                                <div class="ant-steps-item-content">
                                                    <div class="ant-steps-item-title">Documents</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ant-steps-item ant-steps-item-wait">
                                            <div class="ant-steps-item-container">
                                                <div class="ant-steps-item-tail"></div>
                                                <div class="ant-steps-item-icon">
                                                    <span class="ant-steps-icon"><span class="ant-steps-icon-dot"></span></span>
                                                </div>
                                                <div class="ant-steps-item-content">
                                                    <div class="ant-steps-item-title">Review & Submission</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator"></div>
                                <div class="ant-space css-1588u1j ant-space-vertical 2xl:mr-[90px]" style="gap: 16px;">
                                    <div class="ant-space-item">
                                        <a href="/<?php echo $atts["form_submit_page"] ?>/?entry_id=<?php echo esc_attr($entry->entry_id); ?>" target="_blank" class="ant-btn css-1588u1j ant-btn-primary ant-btn-lg w-full">
                                            <span>Continue Payment</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ant-ribbon ant-ribbon-placement-end css-1588u1j">
                            <span class="ant-ribbon-text">WEB</span>
                            <div class="ant-ribbon-corner"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No unpaid visa applications found.</p>
            <?php endif; ?>
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
<script id="__NEXT_DATA__"
        type="application/json">{"props":{"pageProps":{}},"page":"/user","query":{},"buildId":"9fmPZqRL0NhrU0EXE1c_j","nextExport":true,"autoExport":true,"isFallback":false,"scriptLoader":[]}</script>
    
    <script id="google-analytics-script" data-nscript="afterInteractive">window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-EBPQ33J7JL');</script>
    <script id="fb-pixel" data-nscript="afterInteractive">!function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '761961522774595');
        fbq('track', 'PageView');</script>
        <p aria-live="assertive" id="__next-route-announcer__" role="alert"
            style="border: 0px; clip: rect(0px, 0px, 0px, 0px); height: 1px; margin: -1px; overflow: hidden; padding: 0px; position: absolute; top: 0px; width: 1px; white-space: nowrap; overflow-wrap: normal;">
        </p>
    </next-route-announcer><iframe id="_hjSafeContext_78308674" title="_hjSafeContext" tabindex="-1" aria-hidden="true"
        src="about:blank"
        style="display: none !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important;"></iframe>
    <div id="veepn-guard-alert"></div>
    <style>
        @font-face {
            font-family: FigtreeVF;
            src: url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"), url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");
            font-weight: 100 1000;
            font-display: swap
        }
    </style>
    <div id="veepn-breach-alert"></div>
    <style>
        @font-face {
            font-family: FigtreeVF;
            src: url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"), url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");
            font-weight: 100 1000;
            font-display: swap
        }
    </style>
</body>
    <?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('applied_visas', 'av_display_applied_visas_shortcode');