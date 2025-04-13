<?php
// Setup theme setting page
if (function_exists('acf_add_options_page')) {
	$name_option = 'Theme Settings';
	acf_add_options_page(
		array(
			'page_title' => $name_option,
			'menu_title' => $name_option,
			'menu_slug' => 'theme-settings',
			'capability' => 'edit_posts',
			'redirect' => false,
			'position' => 80
		)
	);
}

// The function "write_log" is used to write debug logs to a file in PHP.
function write_log($log = null, $title = 'Debug')
{
	if ($log) {
		if (is_array($log) || is_object($log)) {
			$log = print_r($log, true);
		}

		$timestamp = date('Y-m-d H:i:s');
		$text = '[' . $timestamp . '] : ' . $title . ' - Log: ' . $log . "\n";
		$log_file = WP_CONTENT_DIR . '/debug.log';
		$file_handle = fopen($log_file, 'a');
		fwrite($file_handle, $text);
		fclose($file_handle);
	}
}

function display_sidebar_menu($data_sidebar, $level = 1)
{
	echo '<ul class="sidebarMenu__level' . esc_attr($level) . '">';

	foreach ($data_sidebar as $item) {
		$current_class = '';
		$submenu_class = '';
		$icon_class = '';
		$open_new_tab = get_field('open_new_tab', $item['id']);

		if (is_page($item['id']) || is_single($item['id'])) {
			$current_class .= ' sidebarMenu--active';
		} else {
			if (!empty($item['sub_menu'])) {
				$submenu_class .= ' sidebarMenu--subMenu';
			}
		}

		// open new tab function
		$target = '';
		if ($open_new_tab == true) {
			$target = 'target="_blank"';
		}

		if (get_post_type(get_the_ID()) == 'clubs') {
			$page_all_clubs = get_field('page_all_clubs', 'option') ?? '';
			if ($page_all_clubs && $page_all_clubs == $item['id']) {
				$current_class .= ' sidebarMenu--active';
			}
		}

		$icon_sidebar = get_template_directory_uri() . '/assets/images/icon_sidebar.png';
		$icon_img = get_field('icon_menu', $item['id']) ?: $icon_sidebar;

		$icon = '<img class="icon" src="' . $icon_img . '" >';

		echo '<li class="' . $current_class . $submenu_class . '">';
		echo '<a href="' . esc_url($item['link']) . '" ' . $target . ' >' . $icon . esc_html($item['title']) . '</a>';

		// Check has child page
		if (!empty($item['sub_menu'])) {
			if ($current_class) {
				$icon_class .= ' sidebarMenu--open';
			}
			echo '<span class="sidebarMenu__icon ' . $icon_class . '"></span>';
			display_sidebar_menu($item['sub_menu'], $level + 1);
		}

		echo '</li>';
	}

	echo '</ul>';
}

// Get data sidebar by parent id
function get_data_sidebar($parent_id = 0, $level = 1, $max_level = 3)
{
	$data_result = [];

	$args = array(
		'post_type' => ['page'],
		'post_parent' => $parent_id,
		'posts_per_page' => -1,
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'hidden_on_sidebar',
				'compare' => 'NOT EXISTS',
			),
			array(
				'key' => 'hidden_on_sidebar',
				'value' => '1',
				'compare' => '!=',
			),
		),
	);

	$sidebar_query = new WP_Query($args);

	if ($sidebar_query->have_posts() && $level <= $max_level) {
		while ($sidebar_query->have_posts()) {
			$sidebar_query->the_post();

			$data_item = [
				'id' => get_the_ID(),
				'title' => get_the_title(),
				'link' => get_permalink(),
				'level' => $level
			];

			$redirection = get_field('redirection') ?? null;
			if ($redirection) {
				$data_item['link'] = get_permalink($redirection);
			}

			// Check for child pages recursively
			$child_data = get_data_sidebar(get_the_ID(), $level + 1);
			if (!empty($child_data)) {
				$data_item['sub_menu'] = $child_data;
			}

			$data_result[] = $data_item;
		}
	}

	wp_reset_postdata();
	return $data_result;
}

add_action('wp_ajax_nopriv_toggle_cookie_bookmark', 'handle_cookie_bookmark');
add_action('wp_ajax_toggle_cookie_bookmark', 'handle_cookie_bookmark');

function handle_cookie_bookmark()
{
	$post_id = intval($_POST['post_id']);
	$cookie_name = 'bookmarked_pages';
	$cookie_duration = time() + 30 * DAY_IN_SECONDS;

	$current = isset($_COOKIE[$cookie_name]) ? json_decode(stripslashes($_COOKIE[$cookie_name]), true) : [];

	if (!is_array($current)) {
		$current = [];
	}

	if (in_array($post_id, $current)) {
		$current = array_diff($current, [$post_id]);
		setcookie($cookie_name, json_encode(array_values($current)), $cookie_duration, "/");
		wp_send_json_success(['status' => 'removed']);
	} else {
		$current[] = $post_id;
		$current = array_unique($current);
		setcookie($cookie_name, json_encode(array_values($current)), $cookie_duration, "/");
		wp_send_json_success(['status' => 'added']);
	}
}
