<?php
/* functions.php */
add_action('wp_ajax_link_check_click_counter', 'link_check_click_counter');
add_action('wp_ajax_nopriv_link_check_click_counter', 'link_check_click_counter');
function link_check_click_counter()
{
    if (isset($_POST['nonce']) &&  isset($_POST['post_id']) && wp_verify_nonce($_POST['nonce'], 'link_check_click_counter')) {
        if (!get_current_user_id()) {
            $count = get_post_meta($_POST['post_id'], 'link_anonymous_click_counter', true);
            update_post_meta($_POST['post_id'], 'link_anonymous_click_counter', ($count === '' ? 1 : $count + 1));
        } else {
            $count = get_post_meta($_POST['post_id'], 'link_login_click_counter', true);
            update_post_meta($_POST['post_id'], 'link_login_click_counter', ($count === '' ? 1 : $count + 1));
        }
    }
    exit();
}


// add_action( 'wp_footer', 'link_click' );
add_action('wp_head', 'link_click');
function link_click()
{
?>
    <script type="text/javascript">
        jQuery(function($) {
            $('.portal__link').on('click', function() {
                let postID = this.id.replace('link_count__', '');
                var ajax_options = {
                    action: 'link_check_click_counter',
                    nonce: '<?php echo wp_create_nonce('link_check_click_counter'); ?>',
                    ajaxurl: '<?php echo admin_url('admin-ajax.php'); ?>',
                    post_id: postID
                };

                var href = $(this).attr("href");
                if (href) {
                    var redirectWindow = window.open(href, '_blank');
                    $.post(ajax_options.ajaxurl, ajax_options, function() {
                        redirectWindow.location;
                    });
                } else $.post(ajax_options.ajaxurl, ajax_options, function() {});

                return false;
            });
        });
    </script>
<?php
}

add_filter('manage_link_posts_columns', 'custom_links_columns');
function custom_links_columns($column)
{
    $column['link_login_click_counter']     = 'Login Click';
    $column['link_anonymous_click_counter'] = 'Anonymous Click';
    return $column;
}

add_action('manage_link_posts_custom_column', 'manage_link_custom_column', 10, 3);
function manage_link_custom_column($column_name, $post_id)
{
    switch ($column_name) {
        case 'link_anonymous_click_counter':
            echo get_post_meta($post_id, 'link_anonymous_click_counter', true) ?? '';
            break;
        case 'link_login_click_counter':
            echo get_post_meta($post_id, 'link_login_click_counter', true) ?? '';
            break;
        default:
            echo '';
    }
}

function link_sortable_columns($columns)
{
    $columns['link_anonymous_click_counter'] = array('anonymous_click', 1);
    $columns['link_login_click_counter'] = array('login_click', 1);
    return $columns;
}
add_filter('manage_edit-link_sortable_columns', 'link_sortable_columns');


function link_click_orderby($query)
{
    if (!is_admin())
        return;

    $orderby = $query->get('orderby');

    if ('anonymous_click' == $orderby || 'login_click' == $orderby) {
        $meta_key = 'link_' . $orderby . '_counter';

        $meta_query = array(
            'relation' => 'OR',
            array(
                'key' => $meta_key,
                'compare' => 'NOT EXISTS', // see note above
            ),
            array(
                'key' => $meta_key,
                'compare' => 'EXISTS',
            ),
        );

        $query->set('meta_query', $meta_query);
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'link_click_orderby');

add_action('admin_footer', 'click_counter_column_css');
function click_counter_column_css()
{
    echo '<style type="text/css">';
    echo '.column-link_login_click_counter { text-align: center !important; width: 380px !important; }';
    echo '.column-link_anonymous_click_counter { text-align: center !important; width: 380px !important; }';
    echo '#link_login_click_counter a { width: 100%; display: flex; align-items: center; justify-content: center; }';
    echo '#link_anonymous_click_counter a { width: 100%; display: flex; align-items: center; justify-content: center; }';
    echo 'tfoot > tr > th.column-link_login_click_counter a { width: 100%; display: flex; align-items: center; justify-content: center; }';
    echo 'tfoot > tr > th.column-link_anonymous_click_counter a { width: 100%; display: flex; align-items: center; justify-content: center; }';
    echo '</style>';
}

?>