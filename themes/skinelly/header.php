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
                            <line y1="2.42857" x2="54" y2="2.42857" stroke="#83AFD4" stroke-width="3.14286"/>
                            <line y1="25.5716" x2="54" y2="25.5716" stroke="#83AFD4" stroke-width="3.14286"/>
                            <line y1="48.7142" x2="54" y2="48.7142" stroke="#83AFD4" stroke-width="3.14286"/>
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
                    <div class="header__contacts">
						<? if (get_field("phone", 'options')) { ?>
                            <a href="tel:<? echo get_phone_link(get_field("phone", 'options')); ?>">
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
                        <svg width="76" height="76" viewBox="0 0 76 76" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <circle cx="38" cy="38" r="38" fill="#83AFD4"/>
                            <rect x="19" y="19" width="38" height="38" fill="url(#pattern0)"/>
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_81_825" transform="scale(0.00195312)"/>
                                </pattern>
                                <image id="image0_81_825" width="512" height="512" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAABN2lDQ1BBZG9iZSBSR0IgKDE5OTgpAAAokZWPv0rDUBSHvxtFxaFWCOLgcCdRUGzVwYxJW4ogWKtDkq1JQ5ViEm6uf/oQjm4dXNx9AidHwUHxCXwDxamDQ4QMBYvf9J3fORzOAaNi152GUYbzWKt205Gu58vZF2aYAoBOmKV2q3UAECdxxBjf7wiA10277jTG+38yH6ZKAyNguxtlIYgK0L/SqQYxBMygn2oQD4CpTto1EE9AqZf7G1AKcv8ASsr1fBBfgNlzPR+MOcAMcl8BTB1da4Bakg7UWe9Uy6plWdLuJkEkjweZjs4zuR+HiUoT1dFRF8jvA2AxH2w3HblWtay99X/+PRHX82Vun0cIQCw9F1lBeKEuf1UYO5PrYsdwGQ7vYXpUZLs3cLcBC7dFtlqF8hY8Dn8AwMZP/fNTP8gAAAAJcEhZcwAADE4AAAxOAX93jCMAAATtaVRYdFhNTDpjb20uYWRvYmUueG1wAAAAAAA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA2LjAtYzAwMiA3OS4xNjQ0ODgsIDIwMjAvMDcvMTAtMjI6MDY6NTMgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdEV2dD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlRXZlbnQjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCAyMi4wIChXaW5kb3dzKSIgeG1wOkNyZWF0ZURhdGU9IjIwMjItMDgtMjNUMTc6NDc6NTYrMDM6MDAiIHhtcDpNb2RpZnlEYXRlPSIyMDIyLTA4LTIzVDE3OjQ4OjIzKzAzOjAwIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDIyLTA4LTIzVDE3OjQ4OjIzKzAzOjAwIiBkYzpmb3JtYXQ9ImltYWdlL3BuZyIgcGhvdG9zaG9wOkNvbG9yTW9kZT0iMyIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0ZTA2YWZmYy1iMjM3LTVmNDYtODE2My0xYTJiYjI2YjFmZjkiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NGUwNmFmZmMtYjIzNy01ZjQ2LTgxNjMtMWEyYmIyNmIxZmY5IiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6NGUwNmFmZmMtYjIzNy01ZjQ2LTgxNjMtMWEyYmIyNmIxZmY5Ij4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo0ZTA2YWZmYy1iMjM3LTVmNDYtODE2My0xYTJiYjI2YjFmZjkiIHN0RXZ0OndoZW49IjIwMjItMDgtMjNUMTc6NDc6NTYrMDM6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMi4wIChXaW5kb3dzKSIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7R7FdpAAAp8UlEQVR4nO3dd7hdVZnH8W9uKj2gCIL0Lr0jUkZEqoKCSLGLIMogFlBHcFRAUJlRGRUFBwVs4zCAIyKCKEUgg/QqRSSIEDqEQEISSOaPlWNuktvOvXvvd6+9v5/nuc8dMDnnN4/X+77nXWuvNWru3LmoFpYDdgVWA1bu9bUE8DTwDPAEcD1wNfBgTExJUhOMsgEI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"/>
                            </defs>
                        </svg>
                    </a>
                </div>

            </div>

        </div>
    </div>


    <div class="popup-menu">
        <div class="popup-menu__close">
            <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.39453 1L14.0006 13.6061" stroke="white"/>
                <path d="M1 13.6055L13.6061 0.999408" stroke="white"/>
            </svg>
        </div>
		<?php wp_nav_menu(['theme_location' => 'menu-header']); ?>
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
				<?php if (function_exists('kama_breadcrumbs'))
					kama_breadcrumbs('/'); ?>
				<?php // breadcrumbs(); ?>
            </div>
        </div>
	<?php } ?>
