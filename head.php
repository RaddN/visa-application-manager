<head>
    <style>
        .ast-container {
            max-width: 100vw !important;
        }

        .entry-content[data-ast-blocks-layout]>* {
            max-width: 1651px !important;
            margin-left: auto !important;
            margin-right: 0 !important;
        }
    </style>
    <!-- <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="_effect-css-1588u1j-antSlideUpOut">
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
    </style>
    <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="_effect-css-1588u1j-antSlideDownIn">
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
    </style>
    <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="_effect-css-1588u1j-antSlideDownOut">
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
    </style>
    <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="qb8zsb" data-token-hash="54mug8"></style>
    <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="19egye5" data-token-hash="54mug8">
        :where(.css-1588u1j).ant-popover {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            color: rgba(0, 0, 0, 0.88);
            font-size: 14px;
            line-height: 1.5714285714285714;
            list-style: none;
            font-family: var(--font-noto-sans);
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1030;
            font-weight: normal;
            white-space: normal;
            text-align: start;
            cursor: auto;
            user-select: text;
            transform-origin: var(--arrow-x, 50%) var(--arrow-y, 50%);
            --antd-arrow-background-color: #ffffff;
            width: max-content;
            max-width: 100vw;
        }

        :where(.css-1588u1j).ant-popover-rtl {
            direction: rtl;
        }

        :where(.css-1588u1j).ant-popover-hidden {
            display: none;
        }

        :where(.css-1588u1j).ant-popover .ant-popover-content {
            position: relative;
        }

        :where(.css-1588u1j).ant-popover .ant-popover-inner {
            background-color: #ffffff;
            background-clip: padding-box;
            border-radius: 8px;
            box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
            padding: 12px;
        }

        :where(.css-1588u1j).ant-popover .ant-popover-title {
            min-width: 177px;
            margin-bottom: 8px;
            color: rgba(0, 0, 0, 0.88);
            font-weight: 600;
            border-bottom: none;
            padding: 0;
        }

        :where(.css-1588u1j).ant-popover .ant-popover-inner-content {
            color: rgba(0, 0, 0, 0.88);
            padding: 0;
        }

        :where(.css-1588u1j).ant-popover .ant-popover-arrow {
            position: absolute;
            z-index: 1;
            display: block;
            pointer-events: none;
            width: 16px;
            height: 16px;
            overflow: hidden;
        }

        :where(.css-1588u1j).ant-popover .ant-popover-arrow::before {
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

        :where(.css-1588u1j).ant-popover .ant-popover-arrow::after {
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

        :where(.css-1588u1j).ant-popover .ant-popover-arrow:before {
            background: var(--antd-arrow-background-color);
        }

        :where(.css-1588u1j).ant-popover-placement-top>.ant-popover-arrow,
        :where(.css-1588u1j).ant-popover-placement-topLeft>.ant-popover-arrow,
        :where(.css-1588u1j).ant-popover-placement-topRight>.ant-popover-arrow {
            bottom: 0;
            transform: translateY(100%) rotate(180deg);
        }

        :where(.css-1588u1j).ant-popover-placement-top>.ant-popover-arrow {
            left: 50%;
            transform: translateX(-50%) translateY(100%) rotate(180deg);
        }

        :where(.css-1588u1j).ant-popover-placement-topLeft>.ant-popover-arrow {
            left: 12px;
        }

        :where(.css-1588u1j).ant-popover-placement-topRight>.ant-popover-arrow {
            right: 12px;
        }

        :where(.css-1588u1j).ant-popover-placement-bottom>.ant-popover-arrow,
        :where(.css-1588u1j).ant-popover-placement-bottomLeft>.ant-popover-arrow,
        :where(.css-1588u1j).ant-popover-placement-bottomRight>.ant-popover-arrow {
            top: 0;
            transform: translateY(-100%);
        }

        :where(.css-1588u1j).ant-popover-placement-bottom>.ant-popover-arrow {
            left: 50%;
            transform: translateX(-50%) translateY(-100%);
        }

        :where(.css-1588u1j).ant-popover-placement-bottomLeft>.ant-popover-arrow {
            left: 12px;
        }

        :where(.css-1588u1j).ant-popover-placement-bottomRight>.ant-popover-arrow {
            right: 12px;
        }

        :where(.css-1588u1j).ant-popover-placement-left>.ant-popover-arrow,
        :where(.css-1588u1j).ant-popover-placement-leftTop>.ant-popover-arrow,
        :where(.css-1588u1j).ant-popover-placement-leftBottom>.ant-popover-arrow {
            right: 0;
            transform: translateX(100%) rotate(90deg);
        }

        :where(.css-1588u1j).ant-popover-placement-left>.ant-popover-arrow {
            top: 50%;
            transform: translateY(-50%) translateX(100%) rotate(90deg);
        }

        :where(.css-1588u1j).ant-popover-placement-leftTop>.ant-popover-arrow {
            top: 8px;
        }

        :where(.css-1588u1j).ant-popover-placement-leftBottom>.ant-popover-arrow {
            bottom: 8px;
        }

        :where(.css-1588u1j).ant-popover-placement-right>.ant-popover-arrow,
        :where(.css-1588u1j).ant-popover-placement-rightTop>.ant-popover-arrow,
        :where(.css-1588u1j).ant-popover-placement-rightBottom>.ant-popover-arrow {
            left: 0;
            transform: translateX(-100%) rotate(-90deg);
        }

        :where(.css-1588u1j).ant-popover-placement-right>.ant-popover-arrow {
            top: 50%;
            transform: translateY(-50%) translateX(-100%) rotate(-90deg);
        }

        :where(.css-1588u1j).ant-popover-placement-rightTop>.ant-popover-arrow {
            top: 8px;
        }

        :where(.css-1588u1j).ant-popover-placement-rightBottom>.ant-popover-arrow {
            bottom: 8px;
        }

        :where(.css-1588u1j).ant-popover-pure {
            position: relative;
            max-width: none;
            margin: 16px;
            display: inline-block;
        }

        :where(.css-1588u1j).ant-popover-pure .ant-popover-content {
            display: inline-block;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-blue {
            --antd-arrow-background-color: #1677ff;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-blue .ant-popover-inner {
            background-color: #1677ff;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-blue .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-purple {
            --antd-arrow-background-color: #722ed1;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-purple .ant-popover-inner {
            background-color: #722ed1;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-purple .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-cyan {
            --antd-arrow-background-color: #13c2c2;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-cyan .ant-popover-inner {
            background-color: #13c2c2;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-cyan .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-green {
            --antd-arrow-background-color: #52c41a;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-green .ant-popover-inner {
            background-color: #52c41a;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-green .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-magenta {
            --antd-arrow-background-color: #eb2f96;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-magenta .ant-popover-inner {
            background-color: #eb2f96;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-magenta .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-pink {
            --antd-arrow-background-color: #eb2f96;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-pink .ant-popover-inner {
            background-color: #eb2f96;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-pink .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-red {
            --antd-arrow-background-color: #f5222d;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-red .ant-popover-inner {
            background-color: #f5222d;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-red .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-orange {
            --antd-arrow-background-color: #fa8c16;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-orange .ant-popover-inner {
            background-color: #fa8c16;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-orange .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-yellow {
            --antd-arrow-background-color: #fadb14;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-yellow .ant-popover-inner {
            background-color: #fadb14;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-yellow .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-volcano {
            --antd-arrow-background-color: #fa541c;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-volcano .ant-popover-inner {
            background-color: #fa541c;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-volcano .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-geekblue {
            --antd-arrow-background-color: #2f54eb;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-geekblue .ant-popover-inner {
            background-color: #2f54eb;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-geekblue .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-lime {
            --antd-arrow-background-color: #a0d911;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-lime .ant-popover-inner {
            background-color: #a0d911;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-lime .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-gold {
            --antd-arrow-background-color: #faad14;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-gold .ant-popover-inner {
            background-color: #faad14;
        }

        :where(.css-1588u1j).ant-popover.ant-popover-gold .ant-popover-arrow {
            background: transparent;
        }

        :where(.css-1588u1j).ant-zoom-big-enter,
        :where(.css-1588u1j).ant-zoom-big-appear {
            animation-duration: 0.2s;
            animation-fill-mode: both;
            animation-play-state: paused;
        }

        :where(.css-1588u1j).ant-zoom-big-leave {
            animation-duration: 0.2s;
            animation-fill-mode: both;
            animation-play-state: paused;
        }

        :where(.css-1588u1j).ant-zoom-big-enter.ant-zoom-big-enter-active,
        :where(.css-1588u1j).ant-zoom-big-appear.ant-zoom-big-appear-active {
            animation-name: css-1588u1j-antZoomBigIn;
            animation-play-state: running;
        }

        :where(.css-1588u1j).ant-zoom-big-leave.ant-zoom-big-leave-active {
            animation-name: css-1588u1j-antZoomBigOut;
            animation-play-state: running;
            pointer-events: none;
        }

        :where(.css-1588u1j).ant-zoom-big-enter,
        :where(.css-1588u1j).ant-zoom-big-appear {
            transform: scale(0);
            opacity: 0;
            animation-timing-function: cubic-bezier(0.08, 0.82, 0.17, 1);
        }

        :where(.css-1588u1j).ant-zoom-big-enter-prepare,
        :where(.css-1588u1j).ant-zoom-big-appear-prepare {
            transform: none;
        }

        :where(.css-1588u1j).ant-zoom-big-leave {
            animation-timing-function: cubic-bezier(0.78, 0.14, 0.15, 0.86);
        }
    </style> -->
    <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="10jpo1f" data-token-hash="54mug8">
        :where(.css-1588u1j).ant-steps {
            font-family: var(--font-noto-sans);
            font-size: 14px;
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-steps::before,
        :where(.css-1588u1j).ant-steps::after {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-steps [class^="ant-steps"],
        :where(.css-1588u1j).ant-steps [class*=" ant-steps"] {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-steps [class^="ant-steps"]::before,
        :where(.css-1588u1j).ant-steps [class*=" ant-steps"]::before,
        :where(.css-1588u1j).ant-steps [class^="ant-steps"]::after,
        :where(.css-1588u1j).ant-steps [class*=" ant-steps"]::after {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-steps {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            color: rgba(0, 0, 0, 0.88);
            font-size: 0;
            line-height: 1.5714285714285714;
            list-style: none;
            font-family: var(--font-noto-sans);
            display: flex;
            width: 100%;
            text-align: initial;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item {
            position: relative;
            display: inline-block;
            flex: 1;
            overflow: hidden;
            vertical-align: top;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item:last-child {
            flex: none;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item:last-child>.ant-steps-item-container>.ant-steps-item-tail,
        :where(.css-1588u1j).ant-steps .ant-steps-item:last-child>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title::after {
            display: none;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-container {
            outline: none;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-container:focus-visible .ant-steps-item-icon {
            outline: 4px solid #85868f;
            outline-offset: 1px;
            transition: outline-offset 0s, outline 0s;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-icon,
        :where(.css-1588u1j).ant-steps .ant-steps-item-content {
            display: inline-block;
            vertical-align: top;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-icon {
            width: 32px;
            height: 32px;
            margin-top: 0;
            margin-bottom: 0;
            margin-inline-start: 0;
            margin-inline-end: 8px;
            font-size: 14px;
            font-family: var(--font-noto-sans);
            line-height: 32px;
            text-align: center;
            border-radius: 32px;
            border: 1px solid transparent;
            transition: background-color 0.3s, border-color 0.3s;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-icon .ant-steps-icon {
            position: relative;
            top: -0.5px;
            color: #2f3268;
            line-height: 1;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-tail {
            position: absolute;
            top: 16px;
            inset-inline-start: 0;
            width: 100%;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-tail::after {
            display: inline-block;
            width: 100%;
            height: 1px;
            background: rgba(5, 5, 5, 0.06);
            border-radius: 1px;
            transition: background 0.3s;
            content: "";
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-title {
            position: relative;
            display: inline-block;
            padding-inline-end: 16px;
            color: rgba(0, 0, 0, 0.88);
            font-size: 16px;
            line-height: 32px;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-title::after {
            position: absolute;
            top: 16px;
            inset-inline-start: 100%;
            display: block;
            width: 9999px;
            height: 1px;
            background: rgba(5, 5, 5, 0.06);
            content: "";
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-subtitle {
            display: inline;
            margin-inline-start: 8px;
            color: rgba(0, 0, 0, 0.45);
            font-weight: normal;
            font-size: 14px;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-description {
            color: rgba(0, 0, 0, 0.45);
            font-size: 14px;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-wait .ant-steps-item-icon {
            background-color: rgba(0, 0, 0, 0.06);
            border-color: transparent;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-wait .ant-steps-item-icon>.ant-steps-icon {
            color: rgba(0, 0, 0, 0.65);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-wait .ant-steps-item-icon>.ant-steps-icon .ant-steps-icon-dot {
            background: rgba(0, 0, 0, 0.25);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-wait.ant-steps-item-custom .ant-steps-item-icon>.ant-steps-icon {
            color: rgba(0, 0, 0, 0.25);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-wait>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title {
            color: rgba(0, 0, 0, 0.45);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-wait>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title::after {
            background-color: rgba(5, 5, 5, 0.06);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-wait>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-description {
            color: rgba(0, 0, 0, 0.45);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-wait>.ant-steps-item-container>.ant-steps-item-tail::after {
            background-color: rgba(5, 5, 5, 0.06);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-process .ant-steps-item-icon {
            background-color: #2f3268;
            border-color: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-process .ant-steps-item-icon>.ant-steps-icon {
            color: #fff;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-process .ant-steps-item-icon>.ant-steps-icon .ant-steps-icon-dot {
            background: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-process.ant-steps-item-custom .ant-steps-item-icon>.ant-steps-icon {
            color: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-process>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title {
            color: rgba(0, 0, 0, 0.88);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-process>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title::after {
            background-color: rgba(5, 5, 5, 0.06);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-process>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-description {
            color: rgba(0, 0, 0, 0.88);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-process>.ant-steps-item-container>.ant-steps-item-tail::after {
            background-color: rgba(5, 5, 5, 0.06);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-process>.ant-steps-item-container>.ant-steps-item-title {
            font-weight: 600;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-finish .ant-steps-item-icon {
            background-color: #9ea0a8;
            border-color: #9ea0a8;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-finish .ant-steps-item-icon>.ant-steps-icon {
            color: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-finish .ant-steps-item-icon>.ant-steps-icon .ant-steps-icon-dot {
            background: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-finish.ant-steps-item-custom .ant-steps-item-icon>.ant-steps-icon {
            color: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-finish>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title {
            color: rgba(0, 0, 0, 0.88);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-finish>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title::after {
            background-color: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-finish>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-description {
            color: rgba(0, 0, 0, 0.45);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-finish>.ant-steps-item-container>.ant-steps-item-tail::after {
            background-color: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-error .ant-steps-item-icon {
            background-color: #ff4d4f;
            border-color: #ff4d4f;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-error .ant-steps-item-icon>.ant-steps-icon {
            color: #fff;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-error .ant-steps-item-icon>.ant-steps-icon .ant-steps-icon-dot {
            background: #ff4d4f;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-error.ant-steps-item-custom .ant-steps-item-icon>.ant-steps-icon {
            color: #ff4d4f;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-error>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title {
            color: #ff4d4f;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-error>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title::after {
            background-color: rgba(5, 5, 5, 0.06);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-error>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-description {
            color: #ff4d4f;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-error>.ant-steps-item-container>.ant-steps-item-tail::after {
            background-color: rgba(5, 5, 5, 0.06);
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item.ant-steps-next-error>.ant-steps-item-title::after {
            background: #ff4d4f;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-disabled {
            cursor: not-allowed;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active)>.ant-steps-item-container[role='button'] {
            cursor: pointer;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active)>.ant-steps-item-container[role='button'] .ant-steps-item-title,
        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active)>.ant-steps-item-container[role='button'] .ant-steps-item-subtitle,
        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active)>.ant-steps-item-container[role='button'] .ant-steps-item-description,
        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active)>.ant-steps-item-container[role='button'] .ant-steps-item-icon .ant-steps-icon {
            transition: color 0.3s;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active)>.ant-steps-item-container[role='button']:hover .ant-steps-item-title,
        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active)>.ant-steps-item-container[role='button']:hover .ant-steps-item-subtitle,
        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active)>.ant-steps-item-container[role='button']:hover .ant-steps-item-description {
            color: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active):not(.ant-steps-item-process)>.ant-steps-item-container[role='button']:hover .ant-steps-item-icon {
            border-color: #2f3268;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item:not(.ant-steps-item-active):not(.ant-steps-item-process)>.ant-steps-item-container[role='button']:hover .ant-steps-item-icon .ant-steps-icon {
            color: #2f3268;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-horizontal:not(.ant-steps-label-vertical) .ant-steps-item {
            padding-inline-start: 16px;
            white-space: nowrap;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-horizontal:not(.ant-steps-label-vertical) .ant-steps-item:first-child {
            padding-inline-start: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-horizontal:not(.ant-steps-label-vertical) .ant-steps-item:last-child .ant-steps-item-title {
            padding-inline-end: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-horizontal:not(.ant-steps-label-vertical) .ant-steps-item-tail {
            display: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-horizontal:not(.ant-steps-label-vertical) .ant-steps-item-description {
            max-width: 140px;
            white-space: normal;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-custom>.ant-steps-item-container>.ant-steps-item-icon {
            height: auto;
            background: none;
            border: 0;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-item-custom>.ant-steps-item-container>.ant-steps-item-icon>.ant-steps-icon {
            top: 0;
            width: 32px;
            height: 32px;
            font-size: 24px;
            line-height: 32px;
        }

        :where(.css-1588u1j).ant-steps:not(.ant-steps-vertical) .ant-steps-item-custom .ant-steps-item-icon {
            width: auto;
            background: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-small.ant-steps-horizontal:not(.ant-steps-label-vertical) .ant-steps-item {
            padding-inline-start: 12px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-small.ant-steps-horizontal:not(.ant-steps-label-vertical) .ant-steps-item:first-child {
            padding-inline-start: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-small .ant-steps-item-icon {
            width: 24px;
            height: 24px;
            margin-top: 0;
            margin-bottom: 0;
            margin-inline: 0 8px;
            font-size: 12px;
            line-height: 24px;
            text-align: center;
            border-radius: 24px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-small .ant-steps-item-title {
            padding-inline-end: 12px;
            font-size: 14px;
            line-height: 24px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-small .ant-steps-item-title::after {
            top: 12px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-small .ant-steps-item-description {
            color: rgba(0, 0, 0, 0.45);
            font-size: 14px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-small .ant-steps-item-tail {
            top: 8px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-small .ant-steps-item-custom .ant-steps-item-icon {
            width: inherit;
            height: inherit;
            line-height: inherit;
            background: none;
            border: 0;
            border-radius: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-small .ant-steps-item-custom .ant-steps-item-icon>.ant-steps-icon {
            font-size: 24px;
            line-height: 24px;
            transform: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical {
            display: flex;
            flex-direction: column;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical>.ant-steps-item {
            display: block;
            flex: 1 0 auto;
            padding-inline-start: 0;
            overflow: visible;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical>.ant-steps-item .ant-steps-item-icon {
            float: left;
            margin-inline-end: 16px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical>.ant-steps-item .ant-steps-item-content {
            display: block;
            min-height: 48px;
            overflow: hidden;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical>.ant-steps-item .ant-steps-item-title {
            line-height: 32px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical>.ant-steps-item .ant-steps-item-description {
            padding-bottom: 12px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical>.ant-steps-item>.ant-steps-item-container>.ant-steps-item-tail {
            position: absolute;
            top: 0;
            inset-inline-start: 15px;
            width: 1px;
            height: 100%;
            padding: 38px 0 6px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical>.ant-steps-item>.ant-steps-item-container>.ant-steps-item-tail::after {
            width: 1px;
            height: 100%;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical>.ant-steps-item:not(:last-child)>.ant-steps-item-container>.ant-steps-item-tail {
            display: block;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical>.ant-steps-item>.ant-steps-item-container>.ant-steps-item-content>.ant-steps-item-title::after {
            display: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-small .ant-steps-item-container .ant-steps-item-tail {
            position: absolute;
            top: 0;
            inset-inline-start: 11px;
            padding: 30px 0 6px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-small .ant-steps-item-container .ant-steps-item-title {
            line-height: 24px;
        }

        :where(.css-1588u1j).ant-steps .ant-steps-horizontal .ant-steps-item-tail {
            transform: translateY(-50%);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-label-vertical .ant-steps-item {
            overflow: visible;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-label-vertical .ant-steps-item-tail {
            margin-inline-start: 56px;
            padding: 0 24px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-label-vertical .ant-steps-item-content {
            display: block;
            width: 112px;
            margin-top: 12px;
            text-align: center;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-label-vertical .ant-steps-item-icon {
            display: inline-block;
            margin-inline-start: 40px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-label-vertical .ant-steps-item-title {
            padding-inline-end: 0;
            padding-inline-start: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-label-vertical .ant-steps-item-title::after {
            display: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-label-vertical .ant-steps-item-subtitle {
            display: block;
            margin-bottom: 4px;
            margin-inline-start: 0;
            line-height: 1.5714285714285714;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-label-vertical.ant-steps-small:not(.ant-steps-dot) .ant-steps-item-icon {
            margin-inline-start: 44px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-title,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-title {
            line-height: 1.5714285714285714;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-tail,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-tail {
            top: 2.5px;
            width: 100%;
            margin-top: 0;
            margin-bottom: 0;
            margin-inline: 70px 0;
            padding: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-tail::after,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-tail::after {
            width: calc(100% - 24px);
            height: 3px;
            margin-inline-start: 12px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-icon,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-icon {
            width: 8px;
            height: 8px;
            margin-inline-start: 66px;
            padding-inline-end: 0;
            line-height: 8px;
            background: transparent;
            border: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-icon .ant-steps-icon-dot,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-icon .ant-steps-icon-dot {
            position: relative;
            float: left;
            width: 100%;
            height: 100%;
            border-radius: 100px;
            transition: all 0.3s;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-icon .ant-steps-icon-dot::after,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-icon .ant-steps-icon-dot::after {
            position: absolute;
            top: -12px;
            inset-inline-start: -26px;
            width: 60px;
            height: 32px;
            background: transparent;
            content: "";
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-content,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-content {
            width: 140px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-process .ant-steps-item-icon,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-process .ant-steps-item-icon {
            position: relative;
            top: -1px;
            width: 10px;
            height: 10px;
            line-height: 10px;
            background: none;
            margin-inline-start: 65px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-dot .ant-steps-item-process .ant-steps-icon:first-child .ant-steps-icon-dot,
        :where(.css-1588u1j).ant-steps.ant-steps-dot.ant-steps-small .ant-steps-item-process .ant-steps-icon:first-child .ant-steps-icon-dot {
            inset-inline-start: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-dot .ant-steps-item-icon {
            margin-top: 12px;
            margin-inline-start: 0;
            background: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-dot .ant-steps-item-process .ant-steps-item-icon {
            margin-top: 11px;
            top: 0;
            inset-inline-start: -1px;
            margin-inline-start: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-dot .ant-steps-item>.ant-steps-item-container>.ant-steps-item-tail {
            top: 12px;
            inset-inline-start: 0;
            margin: 0;
            padding: 16px 0 8px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-dot .ant-steps-item>.ant-steps-item-container>.ant-steps-item-tail::after {
            margin-inline-start: 3.5px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-dot.ant-steps-small .ant-steps-item-icon {
            margin-top: 8px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-dot.ant-steps-small .ant-steps-item-process .ant-steps-item-icon {
            margin-top: 7px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-dot.ant-steps-small .ant-steps-item>.ant-steps-item-container>.ant-steps-item-tail {
            top: 8px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-dot .ant-steps-item:first-child .ant-steps-icon-dot {
            inset-inline-start: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-vertical.ant-steps-dot .ant-steps-item-content {
            width: inherit;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation {
            padding-top: 12px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation.ant-steps-small .ant-steps-item-container {
            margin-inline-start: -12px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item {
            overflow: visible;
            text-align: center;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item-container {
            display: inline-block;
            height: 100%;
            margin-inline-start: -16px;
            padding-bottom: 12px;
            text-align: start;
            transition: opacity 0.3s;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item-container .ant-steps-item-content {
            max-width: auto;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item-container .ant-steps-item-title {
            max-width: 100%;
            padding-inline-end: 0;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item-container .ant-steps-item-title::after {
            display: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item:not(.ant-steps-item-active) .ant-steps-item-container[role='button'] {
            cursor: pointer;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item:not(.ant-steps-item-active) .ant-steps-item-container[role='button']:hover {
            opacity: 0.85;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item:last-child {
            flex: 1;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item:last-child::after {
            display: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item::after {
            position: absolute;
            top: calc(50% - 6px);
            inset-inline-start: 100%;
            display: inline-block;
            width: 12px;
            height: 12px;
            border-top: 1px solid rgba(0, 0, 0, 0.25);
            border-bottom: none;
            border-inline-start: none;
            border-inline-end: 1px solid rgba(0, 0, 0, 0.25);
            transform: translateY(-50%) translateX(-50%) rotate(45deg);
            content: "";
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item::before {
            position: absolute;
            bottom: 0;
            inset-inline-start: 50%;
            display: inline-block;
            width: 0;
            height: 2px;
            background-color: #2f3268;
            transition: width 0.3s, inset-inline-start 0.3s;
            transition-timing-function: ease-out;
            content: "";
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation .ant-steps-item.ant-steps-item-active::before {
            inset-inline-start: 0;
            width: 100%;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation.ant-steps-vertical>.ant-steps-item {
            margin-inline-end: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation.ant-steps-vertical>.ant-steps-item::before {
            display: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation.ant-steps-vertical>.ant-steps-item.ant-steps-item-active::before {
            top: 0;
            inset-inline-end: 0;
            inset-inline-start: unset;
            display: block;
            width: 3px;
            height: calc(100% - 24px);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation.ant-steps-vertical>.ant-steps-item::after {
            position: relative;
            inset-inline-start: 50%;
            display: block;
            width: 8px;
            height: 8px;
            margin-bottom: 8px;
            text-align: center;
            transform: translateY(-50%) translateX(-50%) rotate(135deg);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation.ant-steps-vertical>.ant-steps-item:last-child::after {
            display: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation.ant-steps-vertical>.ant-steps-item>.ant-steps-item-container>.ant-steps-item-tail {
            visibility: hidden;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-navigation.ant-steps-horizontal>.ant-steps-item>.ant-steps-item-container>.ant-steps-item-tail {
            visibility: hidden;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-rtl {
            direction: rtl;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-rtl .ant-steps-item-subtitle {
            float: left;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-rtl.ant-steps-navigation .ant-steps-item::after {
            transform: rotate(-45deg);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-rtl.ant-steps-vertical>.ant-steps-item::after {
            transform: rotate(225deg);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-rtl.ant-steps-vertical>.ant-steps-item .ant-steps-item-icon {
            float: right;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-rtl.ant-steps-dot .ant-steps-item-icon .ant-steps-icon-dot,
        :where(.css-1588u1j).ant-steps.ant-steps-rtl.ant-steps-dot.ant-steps-small .ant-steps-item-icon .ant-steps-icon-dot {
            float: right;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress .ant-steps-item {
            padding-top: 4px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress .ant-steps-item-process .ant-steps-item-container .ant-steps-item-icon .ant-steps-icon {
            color: #fff;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress.ant-steps-vertical>.ant-steps-item {
            padding-inline-start: 4px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress.ant-steps-vertical>.ant-steps-item>.ant-steps-item-container>.ant-steps-item-tail {
            top: 4px;
            inset-inline-start: 19px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress.ant-steps-horizontal .ant-steps-item:first-child,
        :where(.css-1588u1j).ant-steps.ant-steps-with-progress.ant-steps-small.ant-steps-horizontal .ant-steps-item:first-child {
            padding-bottom: 4px;
            padding-inline-start: 4px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress.ant-steps-small.ant-steps-vertical>.ant-steps-item>.ant-steps-item-container>.ant-steps-item-tail {
            inset-inline-start: 15px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress.ant-steps-label-vertical .ant-steps-item .ant-steps-item-tail {
            top: 20px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress .ant-steps-item-icon {
            position: relative;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress .ant-steps-item-icon .ant-progress {
            position: absolute;
            inset-inline-start: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress .ant-steps-item-icon .ant-progress-inner {
            width: 40px !important;
            height: 40px !important;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress.ant-steps-small.ant-steps-label-vertical .ant-steps-item .ant-steps-item-tail {
            top: 16px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-with-progress.ant-steps-small .ant-steps-item-icon .ant-progress-inner {
            width: 28px !important;
            height: 28px !important;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline {
            width: auto;
            display: inline-flex;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item {
            flex: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-container {
            padding: 9px 4px 0;
            margin: 0 2px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-container:hover {
            background: rgba(0, 0, 0, 0.04);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-container[role='button']:hover {
            opacity: 1;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-icon {
            width: 6px;
            height: 6px;
            margin-inline-start: calc(50% - 3px);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-icon>.ant-steps-icon {
            top: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-icon .ant-steps-icon-dot {
            border-radius: 3px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-icon .ant-steps-icon-dot::after {
            display: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-content {
            width: auto;
            margin-top: 7px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-title {
            color: rgba(0, 0, 0, 0.25);
            font-size: 12px;
            line-height: 1.6666666666666667;
            font-weight: normal;
            margin-bottom: 2px;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-description {
            display: none;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-tail {
            margin-inline-start: 0;
            top: 12px;
            transform: translateY(-50%);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-tail:after {
            width: 100%;
            height: 1px;
            border-radius: 0;
            margin-inline-start: 0;
            background: #f0f0f0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item:first-child .ant-steps-item-tail {
            width: 50%;
            margin-inline-start: 50%;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item:last-child .ant-steps-item-tail {
            display: block;
            width: 50%;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-wait .ant-steps-item-icon .ant-steps-icon .ant-steps-icon-dot {
            background-color: #ffffff;
            border: 1px solid #f0f0f0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-wait .ant-steps-item-container .ant-steps-item-content .ant-steps-item-title {
            color: rgba(0, 0, 0, 0.25);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-finish .ant-steps-item-tail::after {
            background-color: #f0f0f0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-finish .ant-steps-item-icon .ant-steps-icon .ant-steps-icon-dot {
            background-color: #f0f0f0;
            border: 1px solid #f0f0f0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-finish .ant-steps-item-container .ant-steps-item-content .ant-steps-item-title {
            color: rgba(0, 0, 0, 0.25);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-error .ant-steps-item-container .ant-steps-item-content .ant-steps-item-title {
            color: rgba(0, 0, 0, 0.25);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-active .ant-steps-item-icon,
        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-process .ant-steps-item-icon {
            width: 6px;
            height: 6px;
            margin-inline-start: calc(50% - 3px);
            top: 0;
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-active .ant-steps-item-container .ant-steps-item-content .ant-steps-item-title,
        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item-process .ant-steps-item-container .ant-steps-item-content .ant-steps-item-title {
            color: rgba(0, 0, 0, 0.25);
        }

        :where(.css-1588u1j).ant-steps.ant-steps-inline .ant-steps-item:not(.ant-steps-item-active)>.ant-steps-item-container[role='button']:hover .ant-steps-item-title {
            color: rgba(0, 0, 0, 0.25);
        }
    </style>
    <!-- <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="ujlknk" data-token-hash="54mug8">
        :where(.css-1588u1j).ant-space {
            display: inline-flex;
        }

        :where(.css-1588u1j).ant-space-rtl {
            direction: rtl;
        }

        :where(.css-1588u1j).ant-space-vertical {
            flex-direction: column;
        }

        :where(.css-1588u1j).ant-space-align {
            flex-direction: column;
        }

        :where(.css-1588u1j).ant-space-align-center {
            align-items: center;
        }

        :where(.css-1588u1j).ant-space-align-start {
            align-items: flex-start;
        }

        :where(.css-1588u1j).ant-space-align-end {
            align-items: flex-end;
        }

        :where(.css-1588u1j).ant-space-align-baseline {
            align-items: baseline;
        }

        :where(.css-1588u1j).ant-space .ant-space-item:empty {
            display: none;
        }

        :where(.css-1588u1j).ant-space .ant-space-item>.ant-badge-not-a-wrapper:only-child {
            display: block;
        }

        :where(.css-1588u1j).ant-space-gap-row-small {
            row-gap: 8px;
        }

        :where(.css-1588u1j).ant-space-gap-row-middle {
            row-gap: 16px;
        }

        :where(.css-1588u1j).ant-space-gap-row-large {
            row-gap: 24px;
        }

        :where(.css-1588u1j).ant-space-gap-col-small {
            column-gap: 8px;
        }

        :where(.css-1588u1j).ant-space-gap-col-middle {
            column-gap: 16px;
        }

        :where(.css-1588u1j).ant-space-gap-col-large {
            column-gap: 24px;
        }

        :where(.css-1588u1j).ant-space-block {
            display: flex;
            width: 100%;
        }

        :where(.css-1588u1j).ant-space-vertical {
            flex-direction: column;
        }
    </style> -->
    <!-- <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="173eb5x" data-token-hash="54mug8">
        :where(.css-1588u1j)[class^="ant-modal"],
        :where(.css-1588u1j)[class*=" ant-modal"] {
            font-family: var(--font-noto-sans);
            font-size: 14px;
            box-sizing: border-box;
        }

        :where(.css-1588u1j)[class^="ant-modal"]::before,
        :where(.css-1588u1j)[class*=" ant-modal"]::before,
        :where(.css-1588u1j)[class^="ant-modal"]::after,
        :where(.css-1588u1j)[class*=" ant-modal"]::after {
            box-sizing: border-box;
        }

        :where(.css-1588u1j)[class^="ant-modal"] [class^="ant-modal"],
        :where(.css-1588u1j)[class*=" ant-modal"] [class^="ant-modal"],
        :where(.css-1588u1j)[class^="ant-modal"] [class*=" ant-modal"],
        :where(.css-1588u1j)[class*=" ant-modal"] [class*=" ant-modal"] {
            box-sizing: border-box;
        }

        :where(.css-1588u1j)[class^="ant-modal"] [class^="ant-modal"]::before,
        :where(.css-1588u1j)[class*=" ant-modal"] [class^="ant-modal"]::before,
        :where(.css-1588u1j)[class^="ant-modal"] [class*=" ant-modal"]::before,
        :where(.css-1588u1j)[class*=" ant-modal"] [class*=" ant-modal"]::before,
        :where(.css-1588u1j)[class^="ant-modal"] [class^="ant-modal"]::after,
        :where(.css-1588u1j)[class*=" ant-modal"] [class^="ant-modal"]::after,
        :where(.css-1588u1j)[class^="ant-modal"] [class*=" ant-modal"]::after,
        :where(.css-1588u1j)[class*=" ant-modal"] [class*=" ant-modal"]::after {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal-wrap-rtl {
            direction: rtl;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal-centered {
            text-align: center;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal-centered::before {
            display: inline-block;
            width: 0;
            height: 100%;
            vertical-align: middle;
            content: "";
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal-centered .ant-modal {
            top: 0;
            display: inline-block;
            padding-bottom: 0;
            text-align: start;
            vertical-align: middle;
        }

        @media (max-width: 767px) {
            :where(.css-1588u1j).ant-modal-root .ant-modal {
                max-width: calc(100vw - 16px);
                margin: 8px auto;
            }

            :where(.css-1588u1j).ant-modal-root .ant-modal-centered .ant-modal {
                flex: 1;
            }
        }

        :where(.css-1588u1j).ant-modal {
            box-sizing: border-box;
            margin: 0 auto;
            padding: 0;
            color: rgba(0, 0, 0, 0.88);
            font-size: 14px;
            line-height: 1.5714285714285714;
            list-style: none;
            font-family: var(--font-noto-sans);
            pointer-events: none;
            position: relative;
            top: 100px;
            width: auto;
            max-width: calc(100vw - 32px);
            padding-bottom: 24px;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-title {
            margin: 0;
            color: rgba(0, 0, 0, 0.88);
            font-weight: 600;
            font-size: 16px;
            line-height: 1.5;
            word-wrap: break-word;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-content {
            position: relative;
            background-color: #ffffff;
            background-clip: padding-box;
            border: 0;
            border-radius: 8px;
            box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08), 0 3px 6px -4px rgba(0, 0, 0, 0.12), 0 9px 28px 8px rgba(0, 0, 0, 0.05);
            pointer-events: auto;
            padding: 20px 24px;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-close {
            position: absolute;
            top: 12px;
            inset-inline-end: 12px;
            z-index: 1010;
            padding: 0;
            color: rgba(0, 0, 0, 0.45);
            font-weight: 600;
            line-height: 1;
            text-decoration: none;
            background: transparent;
            border-radius: 4px;
            width: 32px;
            height: 32px;
            border: 0;
            outline: 0;
            cursor: pointer;
            transition: color 0.2s, background-color 0.2s;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-close-x {
            display: flex;
            font-size: 16px;
            font-style: normal;
            line-height: 32px;
            justify-content: center;
            text-transform: none;
            text-rendering: auto;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-close:hover {
            color: rgba(0, 0, 0, 0.88);
            background-color: rgba(0, 0, 0, 0.06);
            text-decoration: none;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-close:active {
            background-color: rgba(0, 0, 0, 0.15);
        }

        :where(.css-1588u1j).ant-modal .ant-modal-close:focus-visible {
            outline: 4px solid #85868f;
            outline-offset: 1px;
            transition: outline-offset 0s, outline 0s;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-header {
            color: rgba(0, 0, 0, 0.88);
            background: #ffffff;
            border-radius: 8px 8px 0 0;
            margin-bottom: 8px;
            padding: 0;
            border-bottom: none;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-body {
            font-size: 14px;
            line-height: 1.5714285714285714;
            word-wrap: break-word;
            padding: 0;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-body .ant-modal-body-skeleton {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 16px auto;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-footer {
            text-align: end;
            background: transparent;
            margin-top: 12px;
            padding: 0;
            border-top: none;
            border-radius: 0;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-footer>.ant-btn+.ant-btn {
            margin-inline-start: 8px;
        }

        :where(.css-1588u1j).ant-modal .ant-modal-open {
            overflow: hidden;
        }

        :where(.css-1588u1j).ant-modal-pure-panel {
            top: auto;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        :where(.css-1588u1j).ant-modal-pure-panel .ant-modal-content,
        :where(.css-1588u1j).ant-modal-pure-panel .ant-modal-body,
        :where(.css-1588u1j).ant-modal-pure-panel .ant-modal-confirm-body-wrapper {
            display: flex;
            flex-direction: column;
            flex: auto;
        }

        :where(.css-1588u1j).ant-modal-pure-panel .ant-modal-confirm-body {
            margin-bottom: auto;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal-wrap-rtl {
            direction: rtl;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal-wrap-rtl .ant-modal-confirm-body {
            direction: rtl;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal.ant-zoom-enter,
        :where(.css-1588u1j).ant-modal-root .ant-modal.ant-zoom-appear {
            transform: none;
            opacity: 0;
            animation-duration: 0.3s;
            user-select: none;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal.ant-zoom-leave .ant-modal-content {
            pointer-events: none;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal-mask {
            position: fixed;
            inset: 0;
            z-index: 1000;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.45);
            pointer-events: none;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal-mask .ant-modal-hidden {
            display: none;
        }

        :where(.css-1588u1j).ant-modal-root .ant-modal-wrap {
            position: fixed;
            inset: 0;
            z-index: 1000;
            overflow: auto;
            outline: 0;
            -webkit-overflow-scrolling: touch;
        }

        :where(.css-1588u1j).ant-modal-root .ant-fade-enter,
        :where(.css-1588u1j).ant-modal-root .ant-fade-appear {
            animation-duration: 0.2s;
            animation-fill-mode: both;
            animation-play-state: paused;
        }

        :where(.css-1588u1j).ant-modal-root .ant-fade-leave {
            animation-duration: 0.2s;
            animation-fill-mode: both;
            animation-play-state: paused;
        }

        :where(.css-1588u1j).ant-modal-root .ant-fade-enter.ant-fade-enter-active,
        :where(.css-1588u1j).ant-modal-root .ant-fade-appear.ant-fade-appear-active {
            animation-name: css-1588u1j-antFadeIn;
            animation-play-state: running;
        }

        :where(.css-1588u1j).ant-modal-root .ant-fade-leave.ant-fade-leave-active {
            animation-name: css-1588u1j-antFadeOut;
            animation-play-state: running;
            pointer-events: none;
        }

        :where(.css-1588u1j).ant-modal-root .ant-fade-enter,
        :where(.css-1588u1j).ant-modal-root .ant-fade-appear {
            opacity: 0;
            animation-timing-function: linear;
        }

        :where(.css-1588u1j).ant-modal-root .ant-fade-leave {
            animation-timing-function: linear;
        }

        :where(.css-1588u1j).ant-zoom-enter,
        :where(.css-1588u1j).ant-zoom-appear {
            animation-duration: 0.2s;
            animation-fill-mode: both;
            animation-play-state: paused;
        }

        :where(.css-1588u1j).ant-zoom-leave {
            animation-duration: 0.2s;
            animation-fill-mode: both;
            animation-play-state: paused;
        }

        :where(.css-1588u1j).ant-zoom-enter.ant-zoom-enter-active,
        :where(.css-1588u1j).ant-zoom-appear.ant-zoom-appear-active {
            animation-name: css-1588u1j-antZoomIn;
            animation-play-state: running;
        }

        :where(.css-1588u1j).ant-zoom-leave.ant-zoom-leave-active {
            animation-name: css-1588u1j-antZoomOut;
            animation-play-state: running;
            pointer-events: none;
        }

        :where(.css-1588u1j).ant-zoom-enter,
        :where(.css-1588u1j).ant-zoom-appear {
            transform: scale(0);
            opacity: 0;
            animation-timing-function: cubic-bezier(0.08, 0.82, 0.17, 1);
        }

        :where(.css-1588u1j).ant-zoom-enter-prepare,
        :where(.css-1588u1j).ant-zoom-appear-prepare {
            transform: none;
        }

        :where(.css-1588u1j).ant-zoom-leave {
            animation-timing-function: cubic-bezier(0.78, 0.14, 0.15, 0.86);
        }
    </style> -->
    <!-- <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="_effect-css-1588u1j-antFadeIn">
        @keyframes css-1588u1j-antFadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style> -->
    <!-- <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="_effect-css-1588u1j-antFadeOut">
        @keyframes css-1588u1j-antFadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style> -->
    <!-- <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="_effect-css-1588u1j-antZoomIn">
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
    </style> -->
    <!-- <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="_effect-css-1588u1j-antZoomOut">
        @keyframes css-1588u1j-antZoomOut {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0.2);
                opacity: 0;
            }
        }
    </style> -->
    <style data-rc-order="prependQueue" data-rc-priority="-999" data-css-hash="128buyb" data-token-hash="54mug8">
        :where(.css-1588u1j).ant-ribbon-wrapper {
            font-family: var(--font-noto-sans);
            font-size: 14px;
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-ribbon-wrapper::before,
        :where(.css-1588u1j).ant-ribbon-wrapper::after {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-ribbon-wrapper [class^="ant-ribbon"],
        :where(.css-1588u1j).ant-ribbon-wrapper [class*=" ant-ribbon"] {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-ribbon-wrapper [class^="ant-ribbon"]::before,
        :where(.css-1588u1j).ant-ribbon-wrapper [class*=" ant-ribbon"]::before,
        :where(.css-1588u1j).ant-ribbon-wrapper [class^="ant-ribbon"]::after,
        :where(.css-1588u1j).ant-ribbon-wrapper [class*=" ant-ribbon"]::after {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-ribbon-wrapper {
            position: relative;
        }

        :where(.css-1588u1j).ant-ribbon {
            box-sizing: border-box;
            margin: 0;
            padding: 0 8px;
            color: #2f3268;
            font-size: 14px;
            line-height: 22px;
            list-style: none;
            font-family: var(--font-noto-sans);
            position: absolute;
            top: 8px;
            white-space: nowrap;
            background-color: #2f3268;
            border-radius: 4px;
        }

        :where(.css-1588u1j).ant-ribbon .ant-ribbon-text {
            color: #fff;
        }

        :where(.css-1588u1j).ant-ribbon .ant-ribbon-corner {
            position: absolute;
            top: 100%;
            width: 8px;
            height: 8px;
            color: currentcolor;
            border: 4px solid;
            transform: scaleY(0.75);
            transform-origin: top;
            filter: brightness(75%);
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-blue {
            background: #1677ff;
            color: #1677ff;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-purple {
            background: #722ed1;
            color: #722ed1;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-cyan {
            background: #13c2c2;
            color: #13c2c2;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-green {
            background: #52c41a;
            color: #52c41a;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-magenta {
            background: #eb2f96;
            color: #eb2f96;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-pink {
            background: #eb2f96;
            color: #eb2f96;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-red {
            background: #f5222d;
            color: #f5222d;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-orange {
            background: #fa8c16;
            color: #fa8c16;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-yellow {
            background: #fadb14;
            color: #fadb14;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-volcano {
            background: #fa541c;
            color: #fa541c;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-geekblue {
            background: #2f54eb;
            color: #2f54eb;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-lime {
            background: #a0d911;
            color: #a0d911;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-color-gold {
            background: #faad14;
            color: #faad14;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-placement-end {
            inset-inline-end: -8px;
            border-end-end-radius: 0;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-placement-end .ant-ribbon-corner {
            inset-inline-end: 0;
            border-inline-end-color: transparent;
            border-block-end-color: transparent;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-placement-start {
            inset-inline-start: -8px;
            border-end-start-radius: 0;
        }

        :where(.css-1588u1j).ant-ribbon.ant-ribbon-placement-start .ant-ribbon-corner {
            inset-inline-start: 0;
            border-block-end-color: transparent;
            border-inline-start-color: transparent;
        }

        :where(.css-1588u1j).ant-ribbon-rtl {
            direction: rtl;
        }
    </style>
    <style type="text/css">
        .swal-icon--error {
            border-color: #f27474;
            -webkit-animation: animateErrorIcon .5s;
            animation: animateErrorIcon .5s
        }

        .swal-icon--error__x-mark {
            position: relative;
            display: block;
            -webkit-animation: animateXMark .5s;
            animation: animateXMark .5s
        }

        .swal-icon--error__line {
            position: absolute;
            height: 5px;
            width: 47px;
            background-color: #f27474;
            display: block;
            top: 37px;
            border-radius: 2px
        }

        .swal-icon--error__line--left {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            left: 17px
        }

        .swal-icon--error__line--right {
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            right: 16px
        }

        @-webkit-keyframes animateErrorIcon {
            0% {
                -webkit-transform: rotateX(100deg);
                transform: rotateX(100deg);
                opacity: 0
            }

            to {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                opacity: 1
            }
        }

        @keyframes animateErrorIcon {
            0% {
                -webkit-transform: rotateX(100deg);
                transform: rotateX(100deg);
                opacity: 0
            }

            to {
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
                opacity: 1
            }
        }

        @-webkit-keyframes animateXMark {
            0% {
                -webkit-transform: scale(.4);
                transform: scale(.4);
                margin-top: 26px;
                opacity: 0
            }

            50% {
                -webkit-transform: scale(.4);
                transform: scale(.4);
                margin-top: 26px;
                opacity: 0
            }

            80% {
                -webkit-transform: scale(1.15);
                transform: scale(1.15);
                margin-top: -6px
            }

            to {
                -webkit-transform: scale(1);
                transform: scale(1);
                margin-top: 0;
                opacity: 1
            }
        }

        @keyframes animateXMark {
            0% {
                -webkit-transform: scale(.4);
                transform: scale(.4);
                margin-top: 26px;
                opacity: 0
            }

            50% {
                -webkit-transform: scale(.4);
                transform: scale(.4);
                margin-top: 26px;
                opacity: 0
            }

            80% {
                -webkit-transform: scale(1.15);
                transform: scale(1.15);
                margin-top: -6px
            }

            to {
                -webkit-transform: scale(1);
                transform: scale(1);
                margin-top: 0;
                opacity: 1
            }
        }

        .swal-icon--warning {
            border-color: #f8bb86;
            -webkit-animation: pulseWarning .75s infinite alternate;
            animation: pulseWarning .75s infinite alternate
        }

        .swal-icon--warning__body {
            width: 5px;
            height: 47px;
            top: 10px;
            border-radius: 2px;
            margin-left: -2px
        }

        .swal-icon--warning__body,
        .swal-icon--warning__dot {
            position: absolute;
            left: 50%;
            background-color: #f8bb86
        }

        .swal-icon--warning__dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-left: -4px;
            bottom: -11px
        }

        @-webkit-keyframes pulseWarning {
            0% {
                border-color: #f8d486
            }

            to {
                border-color: #f8bb86
            }
        }

        @keyframes pulseWarning {
            0% {
                border-color: #f8d486
            }

            to {
                border-color: #f8bb86
            }
        }

        .swal-icon--success {
            border-color: #a5dc86
        }

        .swal-icon--success:after,
        .swal-icon--success:before {
            content: "";
            border-radius: 50%;
            position: absolute;
            width: 60px;
            height: 120px;
            background: #fff;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg)
        }

        .swal-icon--success:before {
            border-radius: 120px 0 0 120px;
            top: -7px;
            left: -33px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-transform-origin: 60px 60px;
            transform-origin: 60px 60px
        }

        .swal-icon--success:after {
            border-radius: 0 120px 120px 0;
            top: -11px;
            left: 30px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-transform-origin: 0 60px;
            transform-origin: 0 60px;
            -webkit-animation: rotatePlaceholder 4.25s ease-in;
            animation: rotatePlaceholder 4.25s ease-in
        }

        .swal-icon--success__ring {
            width: 80px;
            height: 80px;
            border: 4px solid hsla(98, 55%, 69%, .2);
            border-radius: 50%;
            box-sizing: content-box;
            position: absolute;
            left: -4px;
            top: -4px;
            z-index: 2
        }

        .swal-icon--success__hide-corners {
            width: 5px;
            height: 90px;
            background-color: #fff;
            padding: 1px;
            position: absolute;
            left: 28px;
            top: 8px;
            z-index: 1;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg)
        }

        .swal-icon--success__line {
            height: 5px;
            background-color: #a5dc86;
            display: block;
            border-radius: 2px;
            position: absolute;
            z-index: 2
        }

        .swal-icon--success__line--tip {
            width: 25px;
            left: 14px;
            top: 46px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            -webkit-animation: animateSuccessTip .75s;
            animation: animateSuccessTip .75s
        }

        .swal-icon--success__line--long {
            width: 47px;
            right: 8px;
            top: 38px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            -webkit-animation: animateSuccessLong .75s;
            animation: animateSuccessLong .75s
        }

        @-webkit-keyframes rotatePlaceholder {
            0% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg)
            }

            5% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg)
            }

            12% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg)
            }

            to {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg)
            }
        }

        @keyframes rotatePlaceholder {
            0% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg)
            }

            5% {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg)
            }

            12% {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg)
            }

            to {
                -webkit-transform: rotate(-405deg);
                transform: rotate(-405deg)
            }
        }

        @-webkit-keyframes animateSuccessTip {
            0% {
                width: 0;
                left: 1px;
                top: 19px
            }

            54% {
                width: 0;
                left: 1px;
                top: 19px
            }

            70% {
                width: 50px;
                left: -8px;
                top: 37px
            }

            84% {
                width: 17px;
                left: 21px;
                top: 48px
            }

            to {
                width: 25px;
                left: 14px;
                top: 45px
            }
        }

        @keyframes animateSuccessTip {
            0% {
                width: 0;
                left: 1px;
                top: 19px
            }

            54% {
                width: 0;
                left: 1px;
                top: 19px
            }

            70% {
                width: 50px;
                left: -8px;
                top: 37px
            }

            84% {
                width: 17px;
                left: 21px;
                top: 48px
            }

            to {
                width: 25px;
                left: 14px;
                top: 45px
            }
        }

        @-webkit-keyframes animateSuccessLong {
            0% {
                width: 0;
                right: 46px;
                top: 54px
            }

            65% {
                width: 0;
                right: 46px;
                top: 54px
            }

            84% {
                width: 55px;
                right: 0;
                top: 35px
            }

            to {
                width: 47px;
                right: 8px;
                top: 38px
            }
        }

        @keyframes animateSuccessLong {
            0% {
                width: 0;
                right: 46px;
                top: 54px
            }

            65% {
                width: 0;
                right: 46px;
                top: 54px
            }

            84% {
                width: 55px;
                right: 0;
                top: 35px
            }

            to {
                width: 47px;
                right: 8px;
                top: 38px
            }
        }

        .swal-icon--info {
            border-color: #c9dae1
        }

        .swal-icon--info:before {
            width: 5px;
            height: 29px;
            bottom: 17px;
            border-radius: 2px;
            margin-left: -2px
        }

        .swal-icon--info:after,
        .swal-icon--info:before {
            content: "";
            position: absolute;
            left: 50%;
            background-color: #c9dae1
        }

        .swal-icon--info:after {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-left: -3px;
            top: 19px
        }

        .swal-icon {
            width: 80px;
            height: 80px;
            border-width: 4px;
            border-style: solid;
            border-radius: 50%;
            padding: 0;
            position: relative;
            box-sizing: content-box;
            margin: 20px auto
        }

        .swal-icon:first-child {
            margin-top: 32px
        }

        .swal-icon--custom {
            width: auto;
            height: auto;
            max-width: 100%;
            border: none;
            border-radius: 0
        }

        .swal-icon img {
            max-width: 100%;
            max-height: 100%
        }

        .swal-title {
            color: rgba(0, 0, 0, .65);
            font-weight: 600;
            text-transform: none;
            position: relative;
            display: block;
            padding: 13px 16px;
            font-size: 27px;
            line-height: normal;
            text-align: center;
            margin-bottom: 0
        }

        .swal-title:first-child {
            margin-top: 26px
        }

        .swal-title:not(:first-child) {
            padding-bottom: 0
        }

        .swal-title:not(:last-child) {
            margin-bottom: 13px
        }

        .swal-text {
            font-size: 16px;
            position: relative;
            float: none;
            line-height: normal;
            vertical-align: top;
            text-align: left;
            display: inline-block;
            margin: 0;
            padding: 0 10px;
            font-weight: 400;
            color: rgba(0, 0, 0, .64);
            max-width: calc(100% - 20px);
            overflow-wrap: break-word;
            box-sizing: border-box
        }

        .swal-text:first-child {
            margin-top: 45px
        }

        .swal-text:last-child {
            margin-bottom: 45px
        }

        .swal-footer {
            text-align: right;
            padding-top: 13px;
            margin-top: 13px;
            padding: 13px 16px;
            border-radius: inherit;
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .swal-button-container {
            margin: 5px;
            display: inline-block;
            position: relative
        }

        .swal-button {
            background-color: #7cd1f9;
            color: #fff;
            border: none;
            box-shadow: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 24px;
            margin: 0;
            cursor: pointer
        }

        .swal-button:not([disabled]):hover {
            background-color: #78cbf2
        }

        .swal-button:active {
            background-color: #70bce0
        }

        .swal-button:focus {
            outline: none;
            box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(43, 114, 165, .29)
        }

        .swal-button[disabled] {
            opacity: .5;
            cursor: default
        }

        .swal-button::-moz-focus-inner {
            border: 0
        }

        .swal-button--cancel {
            color: #555;
            background-color: #efefef
        }

        .swal-button--cancel:not([disabled]):hover {
            background-color: #e8e8e8
        }

        .swal-button--cancel:active {
            background-color: #d7d7d7
        }

        .swal-button--cancel:focus {
            box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(116, 136, 150, .29)
        }

        .swal-button--danger {
            background-color: #e64942
        }

        .swal-button--danger:not([disabled]):hover {
            background-color: #df4740
        }

        .swal-button--danger:active {
            background-color: #cf423b
        }

        .swal-button--danger:focus {
            box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(165, 43, 43, .29)
        }

        .swal-content {
            padding: 0 20px;
            margin-top: 20px;
            font-size: medium
        }

        .swal-content:last-child {
            margin-bottom: 20px
        }

        .swal-content__input,
        .swal-content__textarea {
            -webkit-appearance: none;
            background-color: #fff;
            border: none;
            font-size: 14px;
            display: block;
            box-sizing: border-box;
            width: 100%;
            border: 1px solid rgba(0, 0, 0, .14);
            padding: 10px 13px;
            border-radius: 2px;
            transition: border-color .2s
        }

        .swal-content__input:focus,
        .swal-content__textarea:focus {
            outline: none;
            border-color: #6db8ff
        }

        .swal-content__textarea {
            resize: vertical
        }

        .swal-button--loading {
            color: transparent
        }

        .swal-button--loading~.swal-button__loader {
            opacity: 1
        }

        .swal-button__loader {
            position: absolute;
            height: auto;
            width: 43px;
            z-index: 2;
            left: 50%;
            top: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            text-align: center;
            pointer-events: none;
            opacity: 0
        }

        .swal-button__loader div {
            display: inline-block;
            float: none;
            vertical-align: baseline;
            width: 9px;
            height: 9px;
            padding: 0;
            border: none;
            margin: 2px;
            opacity: .4;
            border-radius: 7px;
            background-color: hsla(0, 0%, 100%, .9);
            transition: background .2s;
            -webkit-animation: swal-loading-anim 1s infinite;
            animation: swal-loading-anim 1s infinite
        }

        .swal-button__loader div:nth-child(3n+2) {
            -webkit-animation-delay: .15s;
            animation-delay: .15s
        }

        .swal-button__loader div:nth-child(3n+3) {
            -webkit-animation-delay: .3s;
            animation-delay: .3s
        }

        @-webkit-keyframes swal-loading-anim {
            0% {
                opacity: .4
            }

            20% {
                opacity: .4
            }

            50% {
                opacity: 1
            }

            to {
                opacity: .4
            }
        }

        @keyframes swal-loading-anim {
            0% {
                opacity: .4
            }

            20% {
                opacity: .4
            }

            50% {
                opacity: 1
            }

            to {
                opacity: .4
            }
        }

        .swal-overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0;
            overflow-y: auto;
            background-color: rgba(0, 0, 0, .4);
            z-index: 10000;
            pointer-events: none;
            opacity: 0;
            transition: opacity .3s
        }

        .swal-overlay:before {
            content: " ";
            display: inline-block;
            vertical-align: middle;
            height: 100%
        }

        .swal-overlay--show-modal {
            opacity: 1;
            pointer-events: auto
        }

        .swal-overlay--show-modal .swal-modal {
            opacity: 1;
            pointer-events: auto;
            box-sizing: border-box;
            -webkit-animation: showSweetAlert .3s;
            animation: showSweetAlert .3s;
            will-change: transform
        }

        .swal-modal {
            width: 478px;
            opacity: 0;
            pointer-events: none;
            background-color: #fff;
            text-align: center;
            border-radius: 5px;
            position: static;
            margin: 20px auto;
            display: inline-block;
            vertical-align: middle;
            -webkit-transform: scale(1);
            transform: scale(1);
            -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            z-index: 10001;
            transition: opacity .2s, -webkit-transform .3s;
            transition: transform .3s, opacity .2s;
            transition: transform .3s, opacity .2s, -webkit-transform .3s
        }

        @media (max-width:500px) {
            .swal-modal {
                width: calc(100% - 20px)
            }
        }

        @-webkit-keyframes showSweetAlert {
            0% {
                -webkit-transform: scale(1);
                transform: scale(1)
            }

            1% {
                -webkit-transform: scale(.5);
                transform: scale(.5)
            }

            45% {
                -webkit-transform: scale(1.05);
                transform: scale(1.05)
            }

            80% {
                -webkit-transform: scale(.95);
                transform: scale(.95)
            }

            to {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }

        @keyframes showSweetAlert {
            0% {
                -webkit-transform: scale(1);
                transform: scale(1)
            }

            1% {
                -webkit-transform: scale(.5);
                transform: scale(.5)
            }

            45% {
                -webkit-transform: scale(1.05);
                transform: scale(1.05)
            }

            80% {
                -webkit-transform: scale(.95);
                transform: scale(.95)
            }

            to {
                -webkit-transform: scale(1);
                transform: scale(1)
            }
        }
    </style>


    <style>
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

        :where(.css-1588u1j).ant-skeleton {
            font-family: var(--font-noto-sans);
            font-size: 14px;
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-skeleton::before,
        :where(.css-1588u1j).ant-skeleton::after {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-skeleton [class^="ant-skeleton"],
        :where(.css-1588u1j).ant-skeleton [class*=" ant-skeleton"] {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-skeleton [class^="ant-skeleton"]::before,
        :where(.css-1588u1j).ant-skeleton [class*=" ant-skeleton"]::before,
        :where(.css-1588u1j).ant-skeleton [class^="ant-skeleton"]::after,
        :where(.css-1588u1j).ant-skeleton [class*=" ant-skeleton"]::after {
            box-sizing: border-box;
        }

        :where(.css-1588u1j).ant-skeleton {
            display: table;
            width: 100%;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-header {
            display: table-cell;
            padding-inline-end: 16px;
            vertical-align: top;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-header .ant-skeleton-avatar {
            display: inline-block;
            vertical-align: top;
            background: rgba(0, 0, 0, 0.06);
            width: 32px;
            height: 32px;
            line-height: 32px;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-header .ant-skeleton-avatar-circle {
            border-radius: 50%;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-header .ant-skeleton-avatar-lg {
            width: 40px;
            height: 40px;
            line-height: 40px;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-header .ant-skeleton-avatar-sm {
            width: 24px;
            height: 24px;
            line-height: 24px;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-content {
            display: table-cell;
            width: 100%;
            vertical-align: top;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-content .ant-skeleton-title {
            width: 100%;
            height: 16px;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 4px;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-content .ant-skeleton-title+.ant-skeleton-paragraph {
            margin-block-start: 24px;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-content .ant-skeleton-paragraph {
            padding: 0;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-content .ant-skeleton-paragraph>li {
            width: 100%;
            height: 16px;
            list-style: none;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 4px;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-content .ant-skeleton-paragraph>li+li {
            margin-block-start: 16px;
        }

        :where(.css-1588u1j).ant-skeleton .ant-skeleton-content .ant-skeleton-paragraph>li:last-child:not(:first-child):not(:nth-child(2)) {
            width: 61%;
        }

        :where(.css-1588u1j).ant-skeleton-round .ant-skeleton-content .ant-skeleton-title,
        :where(.css-1588u1j).ant-skeleton-round .ant-skeleton-content .ant-skeleton-paragraph>li {
            border-radius: 100px;
        }

        :where(.css-1588u1j).ant-skeleton-with-avatar .ant-skeleton-content .ant-skeleton-title {
            margin-block-start: 12px;
        }

        :where(.css-1588u1j).ant-skeleton-with-avatar .ant-skeleton-content .ant-skeleton-title+.ant-skeleton-paragraph {
            margin-block-start: 28px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element {
            display: inline-block;
            width: auto;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-button {
            display: inline-block;
            vertical-align: top;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 4px;
            width: 64px;
            min-width: 64px;
            height: 32px;
            line-height: 32px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-button.ant-skeleton-button-circle {
            width: 32px;
            min-width: 32px;
            border-radius: 50%;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-button.ant-skeleton-button-round {
            border-radius: 32px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-button-lg {
            width: 80px;
            min-width: 80px;
            height: 40px;
            line-height: 40px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-button-lg.ant-skeleton-button-circle {
            width: 40px;
            min-width: 40px;
            border-radius: 50%;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-button-lg.ant-skeleton-button-round {
            border-radius: 40px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-button-sm {
            width: 48px;
            min-width: 48px;
            height: 24px;
            line-height: 24px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-button-sm.ant-skeleton-button-circle {
            width: 24px;
            min-width: 24px;
            border-radius: 50%;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-button-sm.ant-skeleton-button-round {
            border-radius: 24px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-avatar {
            display: inline-block;
            vertical-align: top;
            background: rgba(0, 0, 0, 0.06);
            width: 32px;
            height: 32px;
            line-height: 32px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-avatar.ant-skeleton-avatar-circle {
            border-radius: 50%;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-avatar.ant-skeleton-avatar-lg {
            width: 40px;
            height: 40px;
            line-height: 40px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-avatar.ant-skeleton-avatar-sm {
            width: 24px;
            height: 24px;
            line-height: 24px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-input {
            display: inline-block;
            vertical-align: top;
            background: rgba(0, 0, 0, 0.06);
            border-radius: 4px;
            width: 160px;
            min-width: 160px;
            height: 32px;
            line-height: 32px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-input-lg {
            width: 240px;
            min-width: 240px;
            height: 40px;
            line-height: 40px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-input-sm {
            width: 120px;
            min-width: 120px;
            height: 24px;
            line-height: 24px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-image {
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

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-image .ant-skeleton-image-path {
            fill: #bfbfbf;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-image .ant-skeleton-image-svg {
            width: 48px;
            height: 48px;
            line-height: 48px;
            max-width: 192px;
            max-height: 192px;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-image .ant-skeleton-image-svg.ant-skeleton-image-svg-circle {
            border-radius: 50%;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-element .ant-skeleton-image.ant-skeleton-image-circle {
            border-radius: 50%;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-block {
            width: 100%;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-block .ant-skeleton-button {
            width: 100%;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-block .ant-skeleton-input {
            width: 100%;
        }

        :where(.css-1588u1j).ant-skeleton.ant-skeleton-active .ant-skeleton-title,
        :where(.css-1588u1j).ant-skeleton.ant-skeleton-active .ant-skeleton-paragraph>li,
        :where(.css-1588u1j).ant-skeleton.ant-skeleton-active .ant-skeleton-avatar,
        :where(.css-1588u1j).ant-skeleton.ant-skeleton-active .ant-skeleton-button,
        :where(.css-1588u1j).ant-skeleton.ant-skeleton-active .ant-skeleton-input,
        :where(.css-1588u1j).ant-skeleton.ant-skeleton-active .ant-skeleton-image {
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.06) 25%, rgba(0, 0, 0, 0.15) 37%, rgba(0, 0, 0, 0.06) 63%);
            background-size: 400% 100%;
            animation-name: css-1588u1j-ant-skeleton-loading;
            animation-duration: 1.4s;
            animation-timing-function: ease;
            animation-iteration-count: infinite;
        }

        @keyframes css-1588u1j-ant-skeleton-loading {
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
            content: "3hyxim|ant-design-icons|anticon:n18rlk;54mug8|ant-design-icons|anticon:1i7nym9;54mug8|Shared|ant:1ijft1f;54mug8|Layout-Layout|ant-layout|anticon:tnknc0;54mug8|Button-Button|ant-btn|anticon:1cfhi6l;54mug8|Wave-Wave|ant-wave|anticon:6oh8ov;54mug8|Drawer-Drawer|ant-drawer|anticon:oz1ynp;54mug8|Grid-Grid|ant-row|anticon:1w2fmdc;54mug8|Skeleton-Skeleton|ant-skeleton|anticon:1fwx5g5;54mug8|Tour-Tour|ant-tour|anticon:1vvwohf";
        }
    </style>
</head>