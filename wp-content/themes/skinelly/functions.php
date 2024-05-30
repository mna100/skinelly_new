<?php

function debug($param)
{
	echo "<pre style='padding: 10px; background: rgba(0,0,0,.2); border: 1px solid black; color=black; font-size: 16px; line-height: 120%'>";
	var_dump($param);
	echo "</pre>";
}

/**
 * Отключаем принудительную проверку новых версий WP, плагинов и темы в админке,
 * чтобы она не тормозила, когда долго не заходил и зашел...
 * Все проверки будут происходить незаметно через крон или при заходе на страницу: "Консоль > Обновления".
 *
 * @see https://wp-kama.ru/filecode/wp-includes/update.php
 * @author Kama (https://wp-kama.ru)
 * @version 1.1
 */
if (is_admin()) {
	// отключим проверку обновлений при любом заходе в админку...
	remove_action('admin_init', '_maybe_update_core');
	remove_action('admin_init', '_maybe_update_plugins');
	remove_action('admin_init', '_maybe_update_themes');

	// отключим проверку обновлений при заходе на специальную страницу в админке...
	remove_action('load-plugins.php', 'wp_update_plugins');
	remove_action('load-themes.php', 'wp_update_themes');

	// оставим принудительную проверку при заходе на страницу обновлений...
	//remove_action( 'load-update-core.php', 'wp_update_plugins' );
	//remove_action( 'load-update-core.php', 'wp_update_themes' );

	// внутренняя страница админки "Update/Install Plugin" или "Update/Install Theme" - оставим не мешает...
	//remove_action( 'load-update.php', 'wp_update_plugins' );
	//remove_action( 'load-update.php', 'wp_update_themes' );

	// событие крона не трогаем, через него будет проверяться наличие обновлений - тут все отлично!
	//remove_action( 'wp_version_check', 'wp_version_check' );
	//remove_action( 'wp_update_plugins', 'wp_update_plugins' );
	//remove_action( 'wp_update_themes', 'wp_update_themes' );

	/**
	 * отключим проверку необходимости обновить браузер в консоли - мы всегда юзаем топовые браузеры!
	 * эта проверка происходит раз в неделю...
	 * @see https://wp-kama.ru/function/wp_check_browser_version
	 */
	add_filter('pre_site_transient_browser_' . md5($_SERVER['HTTP_USER_AGENT']), '__return_empty_array');
}
/**
 * Register CSS
 */
function mna100_styles()
{
	wp_enqueue_style('bundle', get_template_directory_uri() . '/public/public.css', array(), 7.10);
}

add_action('wp_enqueue_scripts', 'mna100_styles', 8);

/**
 * Register JS scripts
 */
function mna100_scripts()
{
	wp_deregister_script('jquery-core');
	wp_deregister_script('jquery');

	wp_register_script('bundle', get_template_directory_uri() . '/public/public.js', '', null, true);
	wp_enqueue_script('bundle');
}

add_action('wp_enqueue_scripts', 'mna100_scripts');
add_filter('script_loader_tag', 'clean_script_tag');
function clean_script_tag($src)
{
	return str_replace("type='text/javascript'", '', $src);
}

add_theme_support('post-thumbnails');

/**
 * Remove library-block min css
 */

function wpassist_remove_block_library_css()
{
	wp_dequeue_style('wp-block-library');
}

add_action('wp_enqueue_scripts', 'wpassist_remove_block_library_css');

function mywptheme_child_deregister_styles()
{
	wp_dequeue_style('classic-theme-styles');
}

add_action('wp_enqueue_scripts', 'mywptheme_child_deregister_styles', 20);

/**
 * Menu register
 */
add_action('after_setup_theme', function () {
	register_nav_menus([
		'menu-header'        => 'Header',
		'menu-mobile'        => 'Mobile',
		'menu-intimate'      => 'Intimate',
		'menu-footer-first'  => 'Первое меню в футере',
		'menu-footer-second' => 'Второе меню в футере',
	]);
	show_admin_bar(false);
});


add_filter('wp_nav_menu_args', 'filter_wp_menu_args');
function filter_wp_menu_args($args)
{
	$args['container']  = false;
	$args['items_wrap'] = '<ul>%3$s</ul>';
	return $args;
}

add_filter('nav_menu_item_id', 'filter_menu_item_css_id', 10, 4);
function filter_menu_item_css_id($menu_id, $item, $args, $depth)
{
	return '';
}

add_filter('nav_menu_css_class', 'filter_nav_menu_css_classes', 10, 4);
function filter_nav_menu_css_classes($classes, $item, $args, $depth)
{
	//$classes = [''];
	if ($item->current) {
		$classes[] = 'is-active';
	}
	return $classes;
}

add_filter('nav_menu_submenu_css_class', 'filter_nav_menu_submenu_css_class', 10, 3);
function filter_nav_menu_submenu_css_class($classes, $args, $depth)
{
	$classes = [
		'dropdown',
	];
	return $classes;
}

add_filter('nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 4);
function filter_nav_menu_link_attributes($atts, $item, $args, $depth)
{
	/*
			if ($item->current) {
					$atts['class'] .= 'is-active';
			}
			*/
	if (get_the_post_thumbnail_url($item->object_id, 'thumbnail')) {
	}
	return $atts;
}

add_filter('nav_menu_item_title', __NAMESPACE__ . '\\filter_nav_menu_item_title', 10, 4);
function filter_nav_menu_item_title($title)
{
	return "<span>$title</span>";
}

add_filter('walker_nav_menu_start_el', 'nav_item_description', 10, 4);
function nav_item_description($item_output, $item, $depth, $args)
{
	if (!empty($item->description)) {
		$item_output
			= str_replace($args->link_after . '</a>', '<span class="description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output);
	}

	return $item_output;
}

//Хлебные крошки
include_once 'includes/breadcrumbs.php';

// изменяем крошки(убираем категори препараты)
add_action('kama_breadcrumbs_home_after', 'my_breadcrumbs_home_after', 10, 4);

function my_breadcrumbs_home_after($false, $linkpatt, $sep, $ptype)
{
	$qo = get_queried_object();
	if ($qo->post_type == 'drug') {
		return sprintf($linkpatt, get_permalink($page), $page->post_title);
	}
	return $false;
}

//old Хлебные крошки
function breadcrumbs()
{
	/* === OPTIONS === */
	$text['home']     = 'Главная страница';                  // text for the 'Home' link
	$text['category'] = 'Категория "%s"';                    // text for a category page
	$text['search']   = 'Результаты поиска по запросу "%s"'; // text for a search results page
	$text['tag']      = 'Записи с тегом "%s"';               // text for a tag page
	$text['author']   = 'Статьи автора %s';                  // text for an author page
	$text['404']      = 'Ошибка 404';                        // text for the 404 page
	$text['page']     = 'Страница %s';                       // text 'Page N'
	$text['cpage']    = 'Страница комментариев %s';          // text 'Comment Page N'

	$wrap_before = '<div class="breadcrumbs">';                     // the opening wrapper tag
	$wrap_after  = '</div>';                                        // the closing wrapper tag
	$sep         = '<span class="breadcrumbs__separator">/</span>'; // separator between crumbs
	$before      = '<span class="breadcrumbs__current">';           // tag before the current crumb
	$after       = '</span>';                                       // tag after the current crumb

	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_current   = 1; // 1 - show current page title, 0 - don't show
	$show_last_sep  = 1; // 1 - show last separator, when current page title is not displayed, 0 - don't show
	/* === END OF OPTIONS === */

	global $post;
	$home_url  = home_url('/');
	$link      = '<span itemprop="itemListElement">';
	$link      .= '<a class="breadcrumbs__link" href="%1$s"><span>%2$s</span></a>';
	$link      .= '<meta content="%3$s" />';
	$link      .= '</span>';
	$parent_id = ($post) ? $post->post_parent : '';
	$home_link = sprintf($link, $home_url, $text['home'], 1);

	if (is_home() || is_front_page()) {
		if ($show_on_home) {
			echo $wrap_before . $home_link . $wrap_after;
		}
	} else {
		$position = 0;
		echo $wrap_before;
		if ($show_home_link) {
			$position += 1;
			echo $home_link;
		}
		if (is_category()) {
			$parents = get_ancestors(get_query_var('cat'), 'category');
			foreach (array_reverse($parents) as $cat) {
				$position += 1;
				if ($position > 1) {
					echo $sep;
				}
				echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
			}
			if (get_query_var('paged')) {
				$position += 1;
				$cat      = get_query_var('cat');
				echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
				echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_current) {
					if ($position >= 1) {
						echo $sep;
					}
					echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
				} elseif ($show_last_sep) {
					echo $sep;
				}
			}
		} elseif (is_search()) {
			if (get_query_var('paged')) {
				$position += 1;
				if ($show_home_link) {
					echo $sep;
				}
				echo sprintf($link, $home_url . '?s=' . get_search_query(), sprintf($text['search'], get_search_query()), $position);
				echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_current) {
					if ($position >= 1) {
						echo $sep;
					}
					echo $before . sprintf($text['search'], get_search_query()) . $after;
				} elseif ($show_last_sep) {
					echo $sep;
				}
			}
		} elseif (is_tax("drug-types")) {
			$current_term = get_term(get_queried_object()->term_id);

			if ($current_term->parent !== 0) {
				$parents = get_ancestors($current_term->term_id, "drug-types");
				foreach (array_reverse($parents) as $pageID) {
					$position += 1;
					if ($position > 1) {
						echo $sep;
					}
					echo sprintf($link, get_term_link($pageID), get_term($pageID)->name, $position);
				}
			}

			if ($show_current) {
				echo $sep . $before . $current_term->name . $after;
			} elseif ($show_last_sep) {
				echo $sep;
			}
		} elseif (is_year()) {
			if ($show_home_link && $show_current) {
				echo $sep;
			}
			if ($show_current) {
				echo $before . get_the_time('Y') . $after;
			} elseif ($show_home_link && $show_last_sep) {
				echo $sep;
			}
		} elseif (is_month()) {
			if ($show_home_link) {
				echo $sep;
			}
			$position += 1;
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position);
			if ($show_current) {
				echo $sep . $before . get_the_time('F') . $after;
			} elseif ($show_last_sep) {
				echo $sep;
			}
		} elseif (is_day()) {
			if ($show_home_link) {
				echo $sep;
			}
			$position += 1;
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position) . $sep;
			$position += 1;
			echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'), $position);
			if ($show_current) {
				echo $sep . $before . get_the_time('d') . $after;
			} elseif ($show_last_sep) {
				echo $sep;
			}
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post') {

				// Changes for additional template
				if ($show_current) {
					$product_data_name_short = get_post_meta(get_the_ID(), 'product_data_name_short', true);
					if ($product_data_name_short && get_post_meta(get_the_ID(), 'additional_template', true) == 'true') {
						$current_title = $product_data_name_short;
					} else {
						$current_title = get_the_title();
					}
					echo $sep . $before . $current_title . $after;
				} elseif ($show_last_sep) {
					echo $sep;
				}
			} else {
				$cat       = get_the_category();
				$catID     = $cat[0]->cat_ID;
				$parents   = get_ancestors($catID, 'category');
				$parents   = array_reverse($parents);
				$parents[] = $catID;
				foreach ($parents as $cat) {
					$position += 1;
					if ($position > 1) {
						echo $sep;
					}
					echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
				}
				if (get_query_var('cpage')) {
					$position += 1;
					echo $sep . sprintf($link, get_permalink(), get_the_title(), $position);
					echo $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
				} else {
					if ($show_current) {
						echo $sep . $before . get_the_title() . $after;
					} elseif ($show_last_sep) {
						echo $sep;
					}
				}
			}
		} elseif (is_post_type_archive()) {
			$post_type = get_post_type_object(get_post_type());
			if (get_query_var('paged')) {
				$position += 1;
				if ($position > 1) {
					echo $sep;
				}
				echo sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label, $position);
				echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_home_link && $show_current) {
					echo $sep;
				}
				if ($show_current) {
					echo $before . $post_type->label . $after;
				} elseif ($show_home_link && $show_last_sep) {
					echo $sep;
				}
			}
		} elseif (is_attachment()) {
			$parent    = get_post($parent_id);
			$cat       = get_the_category($parent->ID);
			$catID     = $cat[0]->cat_ID;
			$parents   = get_ancestors($catID, 'category');
			$parents   = array_reverse($parents);
			$parents[] = $catID;
			foreach ($parents as $cat) {
				$position += 1;
				if ($position > 1) {
					echo $sep;
				}
				echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
			}
			$position += 1;
			echo $sep . sprintf($link, get_permalink($parent), $parent->post_title, $position);
			if ($show_current) {
				echo $sep . $before . get_the_title() . $after;
			} elseif ($show_last_sep) {
				echo $sep;
			}
		} elseif (is_page() && !$parent_id) {
			if ($show_home_link && $show_current) {
				echo $sep;
			}
			if ($show_current) {
				echo $before . get_the_title() . $after;
			} elseif ($show_home_link && $show_last_sep) {
				echo $sep;
			}
		} elseif (is_page() && $parent_id) {
			$parents = get_post_ancestors(get_the_ID());
			foreach (array_reverse($parents) as $pageID) {
				$position += 1;
				if ($position > 1) {
					echo $sep;
				}
				echo sprintf($link, get_page_link($pageID), get_the_title($pageID), $position);
			}
			if ($show_current) {
				echo $sep . $before . get_the_title() . $after;
			} elseif ($show_last_sep) {
				echo $sep;
			}
		} elseif (is_tag()) {
			if (get_query_var('paged')) {
				$position += 1;
				$tagID    = get_query_var('tag_id');
				echo $sep . sprintf($link, get_tag_link($tagID), single_tag_title('', false), $position);
				echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_home_link && $show_current) {
					echo $sep;
				}
				if ($show_current) {
					echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
				} elseif ($show_home_link && $show_last_sep) {
					echo $sep;
				}
			}
		} elseif (is_author()) {
			$author = get_userdata(get_query_var('author'));
			if (get_query_var('paged')) {
				$position += 1;
				echo $sep . sprintf($link, get_author_posts_url($author->ID), sprintf($text['author'], $author->display_name), $position);
				echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			} else {
				if ($show_home_link && $show_current) {
					echo $sep;
				}
				if ($show_current) {
					echo $before . sprintf($text['author'], $author->display_name) . $after;
				} elseif ($show_home_link && $show_last_sep) {
					echo $sep;
				}
			}
		} elseif (is_404()) {
			if ($show_home_link && $show_current) {
				echo $sep;
			}
			if ($show_current) {
				echo $before . $text['404'] . $after;
			} elseif ($show_last_sep) {
				echo $sep;
			}
		} elseif (has_post_format() && !is_singular()) {
			if ($show_home_link && $show_current) {
				echo $sep;
			}
			echo get_post_format_string(get_post_format());
		}
		echo $wrap_after;
	}
}

/**
 * Import custom functions
 */


function get_meta($id)
{
	$data = [];

	if (is_single() || is_page() || is_category()) {
		$data["h1"]             = get_field("seo_meta_page_h1", $id);
		$data["title"]          = get_field("seo_meta_page_title", $id);
		$data["description"]    = get_field("seo_meta_page_description", $id);
		$data["keywords"]       = get_field("seo_meta_page_keywords", $id);
		$data["og_title"]       = get_field("seo_meta_page_og_title", $id);
		$data["og_description"] = get_field("seo_meta_page_og_description", $id);

		if (get_field("seo_meta_post_og_image", $id)) {
			$data["og_image"]
				= "<meta property=\"og:image\" content=\"" . get_field("seo_meta_page_og_image", $id) . "\"/>";
		} else {
			$data["og_image"] = "";
		}
	} else {
		if (is_tax("drug-types")) {
			$data["h1"]             = get_field("seo_meta_page_h1", "drug-types_" . $id);
			$data["title"]          = get_field("seo_meta_page_title", "drug-types_" . $id);
			$data["description"]    = get_field("seo_meta_page_description", "drug-types_" . $id);
			$data["keywords"]       = get_field("seo_meta_page_keywords", "drug-types_" . $id);
			$data["og_title"]       = get_field("seo_meta_page_og_title", "drug-types_" . $id);
			$data["og_description"] = get_field("seo_meta_page_og_description", "drug-types_" . $id);
			if (get_field("seo_meta_post_og_image", "drug-types_" . $id)) {
				$data["og_image"]
					= "<meta property=\"og:image\" content=\"" . get_field("seo_meta_page_og_image", "drug-types_" . $id) . "\"/>";
			} else {
				$data["og_image"] = "";
			}
		} else {
			if (is_404()) {
				$data["title"]          = "Страница не найдена";
				$data["description"]    = "";
				$data["keywords"]       = "";
				$data["og_title"]       = "";
				$data["og_description"] = "";
				$data["og_image"]       = "";
			}
		}
	}
	$data["og_url"] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
		. "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	return $data;
}


$acfePhpDir = new DirectoryIterator(get_stylesheet_directory() . '/acfe-php');
foreach ($acfePhpDir as $fileinfo) {
	if (!$fileinfo->isDot()) {
		require_once get_stylesheet_directory() . '/acfe-php/' . $fileinfo->getFilename();
	}
}


/**
 * Disable the emoji's
 */
function disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}

add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, ['wpemoji']);
	} else {
		return [];
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array  $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
	if ('dns-prefetch' == $relation_type) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

		$urls = array_diff($urls, [$emoji_svg_url]);
	}

	return $urls;
}


/**
 * Get phone link
 */
function get_phone_link($phone)
{
	$phone_link = "tel:" . preg_replace("/[^0-9]/", "", $phone);
	return $phone_link;
}


/**
 * Debug
 */
function dd($el)
{
	echo "<pre>";
	var_dump($el);
	echo "</pre>";
}

function show_in_debug_log($el)
{
	error_log(print_r($el, 1));
}

## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter('get_the_archive_title', function ($title) {
	return preg_replace('~^[^:]+: ~', '', $title);
});
//картинка для страницы мероприятий
add_image_size('skinelly-events', 412, 392, true);

// UTM метки
add_action('init', 'set_utm_cookie');

function set_utm_cookie()
{
	$utm = [
		'utm_source'        => isset($_GET["utm_source"]) ? htmlspecialchars($_GET["utm_source"]) : '',
		'utm_medium'        => isset($_GET["utm_medium"]) ? htmlspecialchars($_GET["utm_medium"]) : '',
		'utm_campaign'      => isset($_GET["utm_campaign"]) ? htmlspecialchars($_GET["utm_campaign"]) : '',
		'utm_content'       => isset($_GET["utm_content"]) ? htmlspecialchars($_GET["utm_content"]) : '',
		'utm_term'          => isset($_GET["utm_term"]) ? htmlspecialchars($_GET["utm_term"]) : '',
		'utm_position_type' => isset($_GET["utm_position_type"]) ? htmlspecialchars($_GET["utm_position_type"]) : '',
		'utm_position'      => isset($_GET["utm_position"]) ? htmlspecialchars($_GET["utm_position"]) : '',
		'utm_placement'     => isset($_GET["utm_placement"]) ? htmlspecialchars($_GET["utm_placement"]) : '',
		'ip'                => ''
	];

	if (getenv('HTTP_CLIENT_IP')) {
		$utm['ip'] = getenv('HTTP_CLIENT_IP');
	} elseif (getenv('HTTP_X_FORWARDED_FOR')) {
		$utm['ip'] = getenv('HTTP_X_FORWARDED_FOR');
	} elseif (getenv('HTTP_X_FORWARDED')) {
		$utm['ip'] = getenv('HTTP_X_FORWARDED');
	} elseif (getenv('HTTP_FORWARDED_FOR')) {
		$utm['ip'] = getenv('HTTP_FORWARDED_FOR');
	} elseif (getenv('HTTP_FORWARDED')) {
		$utm['ip'] = getenv('HTTP_FORWARDED');
	} elseif (getenv('REMOTE_ADDR')) {
		$utm['ip'] = getenv('REMOTE_ADDR');
	} else {
		$utm['ip'] = 'UNKNOWN';
	}

	set_cookie_if_isset('utm_source', $utm);
	set_cookie_if_isset('utm_medium', $utm);
	set_cookie_if_isset('utm_term', $utm);
	set_cookie_if_isset('utm_content', $utm);
	set_cookie_if_isset('utm_campaign', $utm);
	set_cookie_if_isset('utm_position_type', $utm);
	set_cookie_if_isset('utm_position', $utm);
	set_cookie_if_isset('utm_placement', $utm);
	set_cookie_if_isset('ip', $utm);
}

function set_cookie_if_isset($key, $utm)
{
	global $_SERVER;

	if (isset($utm[$key])) {
		setcookie($key, $utm[$key], time() + 3600 * 60 * 24 * 7, '/', $_SERVER['SERVER_NAME'], 1);
	}
}

// form handler
function handle_form_submission()
{
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$input = json_decode(file_get_contents('php://input'), true);

		$user_phone = isset($input['phone']) ? sanitize_text_field($input['phone']) : '';
		$user_question = isset($input['question']) ? sanitize_textarea_field($input['question']) : '';
		$user_name = isset($input['name']) ? sanitize_text_field($input['name']) : '';
		$user_email = isset($input['email']) ? sanitize_email($input['email']) : '';
		$email_title = isset($input['email_title']) ? sanitize_text_field($input['email_title']) : '';
		$ya_goal = isset($input['ya_goal']) ? sanitize_text_field($input['ya_goal']) : '';
		$form_id = isset($input['form_id']) ? sanitize_text_field($input['form_id']) : '';
		$events_name = isset($input['events_name']) ? sanitize_text_field($input['events_name']) : '';
		$referrer = isset($_SERVER['HTTP_REFERER']) ? sanitize_text_field($_SERVER['HTTP_REFERER']) : '';

		// Извлекаем UTM-метки из запроса или куки
		$utm_source = isset($_GET['utm_source']) ? sanitize_text_field($_GET['utm_source']) : (isset($_COOKIE['utm_source']) ? sanitize_text_field($_COOKIE['utm_source']) : '');
		$utm_medium = isset($_GET['utm_medium']) ? sanitize_text_field($_GET['utm_medium']) : (isset($_COOKIE['utm_medium']) ? sanitize_text_field($_COOKIE['utm_medium']) : '');
		$utm_campaign = isset($_GET['utm_campaign']) ? sanitize_text_field($_GET['utm_campaign']) : (isset($_COOKIE['utm_campaign']) ? sanitize_text_field($_COOKIE['utm_campaign']) : '');
		$utm_term = isset($_GET['utm_term']) ? sanitize_text_field($_GET['utm_term']) : (isset($_COOKIE['utm_term']) ? sanitize_text_field($_COOKIE['utm_term']) : '');
		$utm_content = isset($_GET['utm_content']) ? sanitize_text_field($_GET['utm_content']) : (isset($_COOKIE['utm_content']) ? sanitize_text_field($_COOKIE['utm_content']) : '');

		$to = 'noreply1@skinelly.ru, noreply@skinelly.ru, shevarev@dekalaser.ru, sales@marketing-na100.ru, ai@mna100.ru';
		$subject = 'Заявка с сайта Skinelly';

		$message = '';

		if (!empty($email_title)) {
			$message .= 'Заголовок письма: ' . esc_html($email_title) . '<br>';
		}
		if (!empty($user_name)) {
			$message .= 'Имя: ' . esc_html($user_name) . '<br>';
		}
		if (!empty($user_email)) {
			$message .= 'Email: <a href="mailto:' . esc_attr($user_email) . '">' . esc_html($user_email) . '</a><br>';
		}
		if (!empty($user_phone)) {
			$message .= 'Телефон: <a href="tel:' . esc_attr($user_phone) . '">' . esc_html($user_phone) . '</a><br>';
		}
		if (!empty($user_question)) {
			$message .= 'Вопрос: ' . esc_html($user_question) . '<br>';
		}
		if (!empty($ya_goal)) {
			$message .= 'Цель метрики: ' . esc_html($ya_goal) . '<br>';
		}
		if (!empty($form_id)) {
			$message .= 'ID формы: ' . esc_html($form_id) . '<br>';
		}
		if (!empty($events_name)) {
			$message .= 'Название события: ' . esc_html($events_name) . '<br>';
		}
		if (!empty($referrer)) {
			$message .= 'Страница отправки: ' . esc_html($referrer) . '<br>';
		}

		// Добавляем UTM-метки в сообщение
		if (!empty($utm_source)) {
			$message .= 'UTM Source: ' . esc_html($utm_source) . '<br>';
		}
		if (!empty($utm_medium)) {
			$message .= 'UTM Medium: ' . esc_html($utm_medium) . '<br>';
		}
		if (!empty($utm_campaign)) {
			$message .= 'UTM Campaign: ' . esc_html($utm_campaign) . '<br>';
		}
		if (!empty($utm_term)) {
			$message .= 'UTM Term: ' . esc_html($utm_term) . '<br>';
		}
		if (!empty($utm_content)) {
			$message .= 'UTM Content: ' . esc_html($utm_content) . '<br>';
		}

		$headers = ['Content-Type: text/html; charset=UTF-8'];
		$mail_sent = wp_mail($to, $subject, $message, $headers);

		if ($mail_sent) {
			wp_send_json_success(['message' => 'Форма успешно отправлена']);
		} else {
			wp_send_json_error(['message' => 'Не удалось отправить письмо']);
		}
	} else {
		wp_send_json_error(['message' => 'Неверный запрос']);
	}
}

add_action('wp_ajax_handle_form_submission', 'handle_form_submission');
add_action('wp_ajax_nopriv_handle_form_submission', 'handle_form_submission');



@ini_set('upload_max_size', '6400M');
@ini_set('post_max_size', '6400M');
@ini_set('max_execution_time', '3000');
