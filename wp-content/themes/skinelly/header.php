<?php
if (is_tax("drug-types")) {
    $id = get_queried_object()->term_id;
} else {
    $id = get_the_ID();
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo get_meta($id)["title"]; ?></title>
    <link rel="icon" type="image/svg+xml" href="/wp-content/themes/skinelly/node/src/img/favicon.ico">
    <meta name="title" content="<?php echo get_meta($id)["title"]; ?>">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="<?php echo get_meta($id)["description"]; ?>">
    <meta name="keywords" content="<?php echo get_meta($id)["keywords"]; ?>">
    <meta property="og:title" content="<?php echo get_meta($id)["og_title"]; ?>">
    <meta property="og:description" content="<?php echo get_meta($id)["og_description"]; ?>">
    <meta property="og:url" content="<?php echo get_meta($id)["og_url"]; ?>">
    <script defer src="https://www.youtube.com/iframe_api"></script>
    <?php echo get_meta($id)["og_image"]; ?>
    <?php wp_head(); ?>
    <style>
        body {
            scroll-behavior: smooth;
        }

        body::-webkit-scrollbar {
            width: 6px;
            border-radius: 3px;
        }

        body::-webkit-scrollbar-track {
            background: #E3EAFF;
        }

        body::-webkit-scrollbar-thumb {
            background-color: #7791DF;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?
    (get_field("color", 'option') ? $color = get_field("color", 'option') : $color = '#83AFD4');
    ?>
    <style>
        body {
            --product-color: <?= $color; ?>
        }
    </style>
    <header class="header">

        <div class="header-bar">
            <div class="container">

                <div class="row v-center space-between">

                    <div class="header__toggle">
                        <button>
                            <svg width="54" height="51" viewBox="0 0 54 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line y1="2.42857" x2="54" y2="2.42857" stroke="#83AFD4" stroke-width="3.14286" />
                                <line y1="25.5716" x2="54" y2="25.5716" stroke="#83AFD4" stroke-width="3.14286" />
                                <line y1="48.7142" x2="54" y2="48.7142" stroke="#83AFD4" stroke-width="3.14286" />
                            </svg>
                        </button>
                    </div>

                    <div class="header__logo">
                        <a class="header__logo-wrap" href="/">
                            <img src="<? the_field("logo", 'options'); ?>" alt="logo">
                            <img class="header__logo-flag" src="/wp-content/themes/skinelly/node/src/img/flag.gif" alt="gif">
                        </a>
                    </div>
                    <div class="header__info">
                        <a href="https://directalab.ru/" class="header__info__link" target="_blank">
                            <img src="http://skinelly.ru/wp-content/uploads/2023/10/dl-png-1.png" alt="">
                        </a>
                        <div class="header__info__combined">
                            <div class="header__contacts">
                                <? if (get_field("phone", 'options')) { ?>
                                    <a href="<? echo get_phone_link(get_field("phone", 'options')); ?>">
                                        <? the_field("phone", 'options'); ?>
                                    </a>
                                <? } ?>
                                <? if (get_field("email_header", 'options') && get_field("email", 'options')) { ?>
                                    <a href="mailto:<? the_field("email", 'options'); ?>">
                                        <? the_field("email", 'options'); ?>
                                    </a>
                                <? } ?>
                            </div>
                            <div class="header__call">
                                <button class="button modal-link" data-href="#popup">Заказать звонок</button>
                            </div>
                            <a href="<? echo get_phone_link(get_field("phone", 'options')); ?>" class="header__call-icon">
                                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2306_898)">
                                        <circle cx="40" cy="40" r="40" fill="#83AFD4" />
                                        <g clip-path="url(#clip1_2306_898)">
                                            <path d="M57.2754 46.6015C55.2435 44.9686 53.3796 44.1748 51.5772 44.1748C48.9698 44.1748 47.0924 45.8335 45.3927 47.5326C45.1973 47.7282 44.9606 47.8194 44.648 47.8194C43.2158 47.8195 40.6961 46.0259 37.159 42.4883C32.9978 38.3268 31.4245 35.68 32.4824 34.6217C35.3503 31.7548 36.2456 28.8808 31.8546 23.42C30.2827 21.4636 28.7448 20.5127 27.153 20.5127C25.0063 20.5127 23.3743 22.2287 21.9346 23.7428C21.6856 24.0046 21.4505 24.2518 21.22 24.4823C19.5926 26.1095 19.5935 29.6587 21.2223 33.977C23.0095 38.715 26.5381 43.8691 31.1583 48.49C34.7313 52.0627 38.619 54.9501 42.4012 56.8887C45.7033 58.5813 48.9063 59.4882 51.4201 59.4882C51.4204 59.4882 51.4207 59.4882 51.4211 59.4882C52.9943 59.4882 54.2722 59.145 55.1161 58.4471C56.8304 57.0297 60.0213 54.4044 60 51.2859C59.9883 49.6133 59.0718 48.0459 57.2754 46.6015Z" fill="white" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2306_898">
                                            <rect width="80" height="80" fill="white" />
                                        </clipPath>
                                        <clipPath id="clip1_2306_898">
                                            <rect width="40" height="40" fill="white" transform="translate(20 20)" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>


        <div class="popup-menu">
            <div class="popup-menu__close">
                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.39453 1L14.0006 13.6061" stroke="white" />
                    <path d="M1 13.6055L13.6061 0.999408" stroke="white" />
                </svg>
            </div>
            <?php wp_nav_menu(['theme_location' => 'menu-header']); ?>
            <a href="https://directalab.ru/" class="header__info__link__mob" target="_blank">
                <img src="http://skinelly.ru/wp-content/uploads/2023/10/dl-png-1-2.png" alt="">
            </a>
        </div>

        <div class="header-menu">
            <div class="container">
                <nav class="menu">
                    <?php wp_nav_menu(['theme_location' => 'menu-header']); ?>
                </nav>
            </div>
        </div>

    </header>

    <main>
        <?php if (!is_home() && !is_front_page()) { ?>
            <div class="breadcrumbs-wrap">
                <div class="container">
                    <?php if (function_exists('kama_breadcrumbs')) {
                        kama_breadcrumbs('/');
                    } ?>
                    <?php // breadcrumbs(); 
                    ?>
                </div>
            </div>
        <?php } ?>