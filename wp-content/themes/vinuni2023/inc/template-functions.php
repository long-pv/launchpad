<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package clvinuni
 */

// Setup theme setting page
if (function_exists('acf_add_options_page')) {
    $name_option = 'Theme Setting';
    acf_add_options_page(
        array(
            'page_title' => $name_option,
            'menu_title' => $name_option,
            'menu_slug' => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        )
    );

    acf_add_options_page(
        array(
            'page_title' => __('Course setting', 'clvinuni'),
            'menu_title' => __('Course setting', 'clvinuni'),
            'menu_slug' => 'course-setting',
            'parent_slug' => 'edit.php?post_type=course',
            'capability' => 'edit_posts',
            'redirect' => false
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

// Replacing underscores and dashes with spaces, capitalizing the first letter of each word, and removing spaces.
function custom_name_block($input)
{
    $normalized = str_replace(['_', '-'], ' ', $input);
    $ucwords = ucwords($normalized);
    $formatted = str_replace(' ', '', $ucwords);

    return 'section' . $formatted;
}

// custom text title by character
function custom_title($text = '', $character = true)
{
    if ($character) {
        $text = preg_replace('/\[{(.*?)}\]/', '<span class="character">$1</span>', $text);
    } else {
        $text = str_replace(['[', ']', '{', '}'], '', $text);
    }

    return $text;
}

// block info general information
function block_info($data_block = null, $display_link = true)
{
    $html = '';

    if ($data_block) {
        $data = [
            'title' => $data_block['title'] ?? null,
            'desc' => $data_block['description'] ?? null,
            'link' => $data_block['link'] ?? null,
        ];

        $layout = $data_block['display_type'] ?? 'left';

        // render html the section
        if ($data['title'] || $data['desc'] || $data['link']) {
            $html .= ($layout == 'center') ? '<div class="row no-gutters justify-content-center"><div class="col-lg-10">' : '';
            $html .= '<div class="secHeading' . (($layout == 'center') ? ' secHeading--center ' : '') . '">';
            $html .= $data['title'] ? '<h2 class="secTitle secHeading__title wow fadeInUp" data-wow-duration="1s">' . custom_title($data['title']) . '</h2>' : '';
            $html .= $data['desc'] ? '<div class="editor secHeading__desc wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">' . $data['desc'] . '</div>' : '';
            $html .= ($layout == 'left' && $display_link) ? '<div class="wow fadeInUp" data-wow-duration="1s">' . custom_btn_link($data['link'], 'secHeading__link', true) . '</div>' : '';
            $html .= '</div>';
            $html .= ($layout == 'center') ? '</div></div>' : '';
        }
    }

    return $html;
}
// end block info

// block editor general
function custom_editor($content = null, $class = null)
{
    return $content ? '<div class="editor ' . ($class ?: '') . '">' . $content . '</div>' : '';
}

// block btn link general
function custom_btn_link($link = null, $class = null, $block = false)
{
    $html = '';

    if ($link) {
        // validate link
        $url = !empty($link['url']) ? $link['url'] : 'javascript:void(0);';
        $title = !empty($link['title']) ? $link['title'] : __('See more', 'clvinuni');
        $target = !empty($link['target']) ? $link['target'] : '_self';
        $class_link = !$block ? ($class ? $class : '') : '';

        // renter html
        $html .= $block ? '<div class="wow fadeInUp ' . $class . '" data-wow-duration="1s">' : '';
        $html .= '<a href="' . $url . '" target="' . $target . '" class="btnSeeMore wow fadeInUp ' . $class_link . '" data-wow-duration="1s">';
        $html .= $title;
        $html .= '</a>';
        $html .= $block ? '</div>' : '';
    }

    return $html;
}

// block image link general
function custom_img_link($link = null, $image = null, $class = null, $alt = null)
{
    $html = '';

    if ($image) {
        // validate link
        $url = !empty($link['url']) ? $link['url'] : 'javascript:void(0);';
        $title = !empty($link['title']) ? $link['title'] : __('See more', 'clvinuni');
        $target = !empty($link['target']) ? $link['target'] : '_self';
        $class_img = empty($link['url']) ? ' imgGroup--noEffect cursor-default ' : '';
        $class_img .= $class ?: '';

        // renter html
        $html .= '<a class="imgGroup ' . $class_img . '" href="' . $url . '" target="' . $target . '">';
        $html .= '<img width="300" height="300" src="' . $image . '" alt="' . ($alt ?: $title) . '">';
        $html .= '</a>';
    }

    return $html;
}

// Count the elements that exist in the array to use check
function custom_count_array($array = [], $keys = [], $requireAll = true)
{
    $count = 0;

    foreach ($array as $item) {
        $hasValues = $requireAll;

        foreach ($keys as $key) {
            if ($requireAll) {
                if (empty($item[$key])) {
                    $hasValues = false;
                    break;
                }
            } else {
                if (!empty($item[$key])) {
                    $hasValues = true;
                    break;
                }
            }
        }

        if ($hasValues) {
            $count++;
        }
    }

    return $count;
}

function hexToRgb($hex)
{
    $hex = str_replace("#", "", $hex);

    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    return $r . ', ' . $g . ', ' . $b;
}

function custom_root_style($fieldKey = null, $variableName = null, $urlType = false)
{
    $fieldValue = get_field($fieldKey, 'option') ?? null;
    $style = '';

    if ($fieldValue) {
        $style .= '<style>:root {';
        $style .= '--' . $variableName . ':';
        $style .= $urlType ? 'url("' : '';
        $style .= $fieldValue;
        $style .= $urlType ? '")' : '';
        $style .= ';}</style>';
    }

    return $style;
}

/**
 * Generates a select dropdown with taxonomy terms, styled with customSelect2.
 *
 * @param string $taxonomy       - Taxonomy name.
 * @param string $placeholder    - Placeholder text for the select element.
 * @param string $optionFirst    - Option text first.
 * @return string                - HTML markup for the select element.
 */
function generate_select_options_with_tax($taxonomy, $placeholder, $optionFirst)
{
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ]);

    $sorted_terms = [];
    foreach ($terms as $term) {
        if ($term->parent == 0) {
            $sorted_terms[] = $term;
            foreach ($terms as $child_term) {
                if ($child_term->parent == $term->term_id) {
                    $sorted_terms[] = $child_term;
                }
            }
        }
    }

    ob_start();
    ?>
    <div class="customSelect2">
        <select class="findJobs__select" data-placeholder="<?php echo esc_attr($placeholder); ?>"
            data-noresult="<?php _e('No results found', 'clvinuni'); ?>" name="<?php echo esc_attr($taxonomy); ?>"
            id="<?php echo esc_attr($taxonomy); ?>">
            <option selected></option>
            <option value="all">
                <?php echo esc_attr($optionFirst); ?>
            </option>
            <?php
            if ($terms):
                foreach ($sorted_terms as $term):
                    ?>
                    <option value="<?php echo esc_attr($term->term_id); ?>"
                        data-classterm="<?php echo $term->parent == 0 ? 'jobType__parent' : 'jobType__child'; ?>">
                        <?php echo esc_html($term->name); ?>
                    </option>
                    <?php
                endforeach;
            endif;
            ?>
        </select>
    </div>
    <?php

    return ob_get_clean();
}

function update_deadline_time_jobs($post_id)
{
    if (get_post_type($post_id) === 'job') {
        $deadline = get_post_meta($post_id, 'recruitment_job_deadline', true);
        $date = DateTime::createFromFormat('Ymd H:i:s', $deadline . ' 00:00:00');
        if ($date) {
            $time = $date->getTimestamp() * 1000;
            update_post_meta($post_id, 'date_jobs', $time);
        }
    }
}
add_action('save_post', 'update_deadline_time_jobs');

function custom_color_tinymce($options)
{
    $options['textcolor_map'] = json_encode(
        array(
            '134D8B',
            'Primary',
            'C72127',
            'Secondary',
            '2E2E2E',
            'Text body'
        )
    );
    return $options;
}
add_filter('tiny_mce_before_init', 'custom_color_tinymce');

// no add class container when in page template aricle
function get_container_class()
{
    $class = "";
    if (!is_page_template(array('page-article.php'))) {
        $class = "container";
    }
    return $class;
}


function modify_search_query($query)
{
    if ($query->is_search() && !is_admin()) {
        // get param on url
        $postTypeSearch = 'all';
        if (isset($_GET["post_type"])) {
            $postTypeSearch = $_GET['post_type'];
        }

        // Returns results according to the desired post types
        if ($postTypeSearch == 'event') {
            $query->set('post_type', 'event');
        } else if ($postTypeSearch == 'post') {
            $query->set('post_type', 'post');
        } else if ($postTypeSearch == 'testimonial') {
            $query->set('post_type', 'testimonial');
        } else if ($postTypeSearch == 'leader') {
            $query->set('post_type', 'leader');
        } else if ($postTypeSearch == 'people') {
            $query->set('post_type', 'people');
        } else {
            $query->set('post_type', ['post', 'event', 'people', 'page']);
        }
    }

    return $query;
}
add_filter('pre_get_posts', 'modify_search_query', 99, 1);

// Get the attachment ID from the image URL
function custom_caption_image($image_url, $type = 'caption')
{
    $attachment_id = attachment_url_to_postid($image_url);

    if ($attachment_id) {
        $attachment = get_post($attachment_id);
        if ($attachment) {
            if ($type == 'caption') {
                return $attachment->post_excerpt;
            } elseif ($type == 'title') {
                return $attachment->post_title;
            } elseif ($type == 'alt') {
                $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

                if ($alt_text) {
                    return $alt_text;
                }
            } elseif ($type == 'desc') {
                $description = get_post_meta($attachment_id, '_wp_attachment_image_description', true);

                if ($description) {
                    return $description;
                }
            }
        }
    }

    return false;
}

/**
 * Add Recommended size image to Featured Image Box
 */
add_filter('admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction($html)
{
    if (get_post_type() === 'post') {
        $html .= '<p>Recommended size: 500x310</p>';
    }
    if (get_post_type() === 'testimonial') {
        $html .= '<p>Recommended size: 500x325</p>';
    }
    if (get_post_type() === 'people') {
        $html .= '<p>Recommended size: 550x470</p>';
    }
    if (get_post_type() === 'club') {
        $html .= '<p>Recommended size: 500x135</p>';
    }

    return $html;
}


// add_action('admin_footer', 'custom_required_featured_image');
function custom_required_featured_image()
{
    global $post_type;

    $post_type_arr = [
        'post',
        'testimonial',
        'people',
        'club',
    ];

    if (in_array($post_type, $post_type_arr)) {
        ?>
        <script>
            jQuery(document).ready(function ($) {
                if ($('#set-post-thumbnail').length > 0) {
                    $('#post').submit(function () {
                        // Check for featured images
                        if ($('#set-post-thumbnail img').length == 0) {
                            // image input area
                            let postimagediv = $('#postimagediv');
                            postimagediv.addClass('error');

                            // Scroll to the image import area
                            $('html, body').animate({
                                scrollTop: postimagediv.offset().top - 100
                            }, 500);

                            // show notification
                            alert('Please enter Featured image.');

                            return false;
                        } else {
                            $('#postimagediv').removeClass('error');
                        }
                    });

                    // If an image is selected, remove the 'error' class
                    $('#set-post-thumbnail').on('click', function () {
                        $('#postimagediv').removeClass('error');
                    });

                    $('#postimagediv h2').html('Featured Image <span style="color:red;margin-left:4px;font-weight:900;">*</span>').css('justify-content', 'flex-start');
                }
            });
        </script>
        <?php
    }
}

function custom_text_people($text)
{
    $text_replace_arr = [
        'phd' => 'PhD',
        'ceo' => 'CEO',
        'llc' => 'LLC',
        'md' => 'MD',
        'of' => 'of',
        'The' => 'the',
        'Mph' => 'MPH',
        'And' => 'and',
        'A/An' => 'a/an',
        'For' => 'for',
        'At' => 'at',
        'In' => 'in',
        'On' => 'on',
        'About' => 'about',
        'Vinacademy' => 'VinAcademy',
        'Jsc' => 'JSC',
        'Mpm' => 'MPM',
        'Mba' => 'MBA',
        'Scd' => 'SCD',
        'Usa' => 'USA',
        'Mit' => 'MIT',
        'Vinuniversity' => 'VinUniversity',

        // bổ sung
        'Np' => 'NP',
        'Rn' => 'RN',
        'Md' => 'MD',
        'Lpn' => 'LPN',
        'Ta' => 'TA',
        'Aa' => 'AA',
        'Ra' => 'RA',
        'Ma' => 'MA',
        'Msc' => 'MSc',
        'Mbus' => 'MBUS',
        'Emba' => 'EMBA',
        'Med' => 'MEd',
        'Meng' => 'MEng',
        'Mbchb' => 'MBChB',
        'Bds' => 'BDS',
        'Bsc' => 'BSc',
        'Fcpa' => 'FCPA',
        'Cfa' => 'CFA',
        'Acma' => 'ACMA',
        'Cgma' => 'CGMA',
        'Cia' => 'CIA',
        'Mn' => 'MN',
        'Ms' => 'MS',
        'Hass' => 'HASS',
        'Cum' => 'cum',

        // tiếng Việt
        'Bs' => 'BS',
        'Gs' => 'GS',
        'Pgs' => 'PGS',
        'Ts' => 'TS',
        'Ths' => 'ThS',
        'Ckii' => 'CKII',
        'Cki' => 'CKI',
        'Tnhh' => 'TNHH',
        'Đh' => 'ĐH',
        'Ii' => 'II',
    ];

    $text = mb_strtolower($text, 'UTF-8');
    $text = mb_convert_case($text, MB_CASE_TITLE, 'UTF-8');

    $patterns = array_map(function ($key) {
        return '/\b(' . preg_quote($key, '/') . ')\b/i';
    }, array_keys($text_replace_arr));

    $replacements = array_values($text_replace_arr);

    $text = preg_replace($patterns, $replacements, $text);

    return $text;
}

// Remove the submit function of the contributor role
add_action('admin_footer', 'remove_submit_role_contributor');
function remove_submit_role_contributor()
{
    $current_user = wp_get_current_user();

    if (in_array('contributor', (array) $current_user->roles)):
        ?>
        <script>
            jQuery(document).ready(function ($) {
                $('#publish').remove();
            });
        </script>
        <?php
    endif;
}

add_action('admin_footer', 'add_javascript_wp_admin');
function add_javascript_wp_admin()
{
    ?>
    <script>
        jQuery(document).ready(function ($) {
            if ($('#acf-group_65f44237f31ce').length > 0) {
                var selectedValue = $('input[name*="field_65f44238a65af"]:checked').val();
                var $groupToShow = $('#acf-group_64900129d46c6');
                var $groupToHide = $('#acf-group_65f444738d19b');

                if (selectedValue == 'default') {
                    $groupToHide.hide();
                } else {
                    $groupToShow.hide();
                }

                $('input[name*="field_65f44238a65af"]').on('change', function () {
                    var val = $(this).val();
                    if (val == 'default') {
                        $groupToShow.show();
                        $groupToHide.hide();
                    } else {
                        $groupToShow.hide();
                        $groupToHide.show();
                    }
                });
            }
        });
    </script>
    <?php
}

// dump + die()
function dd($data)
{
    echo '<div style="background-color: #c0c0c0; border: 1px solid #ddd; color: #333; padding: 20px; margin: 20px;">';
    echo '<div style="font-size: 20px; font-weight: bold; color: #007bff; margin-bottom: 10px;">Debug Data</div>';
    echo '<div style="font-family: monospace;">';
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    echo '</div>';
    echo '</div>';
    die();
}

function get_academic_people($post_id)
{
    $academic_name = '';
    $academic = get_the_terms($post_id, 'college') ?? [];

    if ($academic && $academic[0]) {
        $academic_name = custom_text_people($academic[0]->name);
    }

    return $academic_name;
}

function get_url_search()
{
    $search = get_site_url();
    if (pll_default_language() !== LANG) {
        $search = $search . '/' . LANG . '/';
    }

    return $search;
}

function the_name_people($post_id)
{
    $text = '';
    $title = get_the_title($post_id) ?? '';
    $lang = pll_get_post_language($post_id) ?? LANG;

    $title_list = get_field('title', $post_id) ?? null;
    if ($title_list) {
        $title_arr = [];
        $title_text = '';

        foreach ($title_list as $term) {
            $title_arr[] = $term->name;
        }
        if ($title_arr) {
            if ($lang == 'en' || LANG == 'en') {
                $title_text = implode(', ', $title_arr);
                $text = $title;
                if ($title_text) {
                    $text .= ', ';
                    $text .= $title_text;
                }
            } elseif ($lang == 'vi' || LANG == 'vi') {
                $title_text = implode('.', $title_arr);
                $title_text .= '.';
                $text = $title_text . ' ' . $title;
            }
        }
    } else {
        $text = custom_text_people($title);
    }

    echo $text;
}


function get_name_people($post_id)
{
    $text = '';
    $title = get_the_title($post_id) ?? '';
    $lang = pll_get_post_language($post_id) ?? LANG;

    $title_list = get_field('title', $post_id) ?? null;
    if ($title_list) {
        $title_arr = [];
        $title_text = '';

        foreach ($title_list as $term) {
            $title_arr[] = $term->name;
        }
        if ($title_arr) {
            if ($lang == 'en' || LANG == 'en') {
                $title_text = implode(', ', $title_arr);
                $text = $title;
                if ($title_text) {
                    $text .= ', ';
                    $text .= $title_text;
                }
            } elseif ($lang == 'vi' || LANG == 'vi') {
                $title_text = implode('.', $title_arr);
                $title_text .= '.';
                $text = $title_text . ' ' . $title;
            }
        }
    } else {
        $text = custom_text_people($title);
    }

    return $text;
}

function get_position_people($post_id, $page_url = null, $subsite = 'main')
{
    $position_list = get_field('position_list', $post_id) ?? null;
    $position_arr = [];
    $position_text = [];
    $college = [
        26,
        130,
        28,
        132,
        2,
        123,
        3,
        128
    ];

    if ($position_list) {
        foreach ($position_list as $position) {
            $p_dept_text = [];
            $check_page_current = false;

            if ($position['name'] && $position['name']->name) {
                $p_dept_text[] = $position['name']->name;
            }

            $p_dept = $position['dept_program'];

            if ($p_dept) {
                $add_dept = false;
                $add_parent = false;

                if ($subsite == 'main' || ($subsite == 'subsite' && !in_array($p_dept->term_id, $college))) {
                    $add_dept = true;
                }

                if ($p_dept->parent) {
                    if ($subsite == 'main' || ($subsite == 'subsite' && !in_array($p_dept->parent, $college))) {
                        $add_parent = true;
                    }
                }

                if ($add_dept) {
                    $p_dept_text[] = $p_dept->name;
                }

                if ($add_parent) {
                    $p_dept_parent = get_term($p_dept->parent);
                    $p_dept_text[] = $p_dept_parent->name;
                }
            }

            $p_dept_text = implode(', ', $p_dept_text);

            if (!empty($position['page_url']) && $page_url && strstr($position['page_url'], $page_url) !== false) {
                $check_page_current = true;
            }

            $position_arr[] = [
                'top' => $check_page_current,
                'text' => $p_dept_text,
            ];
        }

        $top_items = array_filter($position_arr, function ($item) {
            return $item['top'] === true;
        });

        $non_top_items = array_filter($position_arr, function ($item) {
            return $item['top'] !== true;
        });

        $new_array = array_merge($top_items, $non_top_items);

        $sorted_texts = array_map(function ($item) {
            return $item['text'];
        }, $new_array);

        $position_text = $sorted_texts;
    } else {
        $position = get_field('position') ?? null;
        $academic_name = get_academic_people(get_the_ID());
        if ($position) {
            $position_text[] = $position;
        }
        if ($academic_name) {
            $position_text[] = $academic_name;
        }
    }

    return $position_text;
}

add_action('admin_footer', 'people_new_desc_after_title');
function people_new_desc_after_title()
{
    global $post_type;

    if ($post_type == 'people'):
        $text_desc = __('Lưu ý: Viết hoa chữ cái đầu. Ví dụ: Nguyễn Văn A');
        ?>
        <script>
            jQuery(document).ready(function ($) {
                $('#titlewrap').append('<?php echo $text_desc; ?>');
            })
        </script>
        <?php
    endif;
}

add_action('save_post', 'save_post_to_parent_categories', 10, 3);
function save_post_to_parent_categories($post_ID, $post, $update)
{
    if (get_post_type($post_ID) == 'post') {
        // Check if category is selected
        $selected_categories = wp_get_post_categories($post_ID);
        if (!empty($selected_categories)) {
            foreach ($selected_categories as $category_id) {
                // all parent categories
                $parent_categories = get_ancestors($category_id, 'category');
                if (!empty($parent_categories)) {
                    foreach ($parent_categories as $parent_category_id) {
                        // Check to see if it has been selected before or not
                        $is_post_in_parent_category = has_term($parent_category_id, 'category', $post_ID);
                        if (!$is_post_in_parent_category) {
                            wp_set_post_categories($post_ID, $parent_category_id, true);
                        }
                    }
                }
            }
        }
    }

    if (get_post_type($post_ID) == 'people') {
        $position_list = get_field('position_list') ?? null;

        if ($position_list) {
            foreach ($position_list as $item) {
                $dept_program = $item['dept_program'] ?? null;

                if ($dept_program) {
                    $check_college = has_term($dept_program->term_id, 'college', $post_ID);
                    if (!$check_college) {
                        wp_set_post_terms($post_ID, $dept_program->term_id, 'college', true);
                    }
                    $parent_colleges = get_ancestors($dept_program->term_id, 'college');

                    if (!empty($parent_colleges)) {
                        foreach ($parent_colleges as $parent_college_id) {
                            $is_post_in_parent_college = has_term($parent_college_id, 'college', $post_ID);
                            if (!$is_post_in_parent_college) {
                                wp_set_post_terms($post_ID, $parent_college_id, 'college', true);
                            }
                        }
                    }
                }
            }
        }
    }
}

add_action('admin_footer', 'custom_edit_post_script');
function custom_edit_post_script()
{
    global $post_type;
    if ($post_type == 'post') { // Kiểm tra nếu là loại bài viết "post"
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('label[for="categorydiv-hide"]').remove();

                $('#post').submit(function () {
                    if ($('#categorychecklist input[type="checkbox"]:checked').length === 0) {
                        alert('Please enter category.');
                        $('html, body').animate({
                            scrollTop: $('#categorydiv').offset().top - 100
                        }, 'slow');
                        return false;
                    }
                });
            });
        </script>
        <?php
    }

    // Check if it is a new post creation page
    if ($post_type == 'post' && isset($_GET['post']) && $_GET['post'] == 0) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#categorychecklist input[type="checkbox"]').prop('checked', false);
            });
        </script>
        <?php
    }

    if (!is_main_site()):
        ?>
        <style>
            #menu-posts-people {
                display: none !important;
            }
        </style>
        <?php
    endif;
}

//  modify wysiwyg editor
add_action('acf/input/admin_head', 'cl_acf_modify_wysiwyg');
function cl_acf_modify_wysiwyg()
{
    ?>
    <style type="text/css">
        .acf-editor-custom iframe {
            height: 150px !important;
        }
    </style>
    <?php
}

// Hook vào filter get_the_excerpt
add_filter('get_the_excerpt', 'custom_people_excerpt', 10, 2);
function custom_people_excerpt($excerpt, $post)
{
    if ($post->post_type === 'people') {
        $data = array();

        // Get data from input fields
        $data[] = get_post_meta($post->ID, 'biography', true);
        $data[] = get_post_meta($post->ID, 'research_interests', true);
        $data[] = get_post_meta($post->ID, 'professional_interests', true);
        $data[] = get_post_meta($post->ID, 'teaching_interests', true);
        $data[] = get_post_meta($post->ID, 'selected_publications', true);
        $data[] = get_post_meta($post->ID, 'education', true);
        $data[] = get_post_meta($post->ID, 'selected_awards_honors', true);
        $data[] = get_post_meta($post->ID, 'related_websites', true);
        $data[] = get_post_meta($post->ID, 'other_activities', true);

        // cut string into excerpt format
        $text_query = implode(' ', $data);
        $excerpt .= strip_tags($text_query);
        $excerpt = wp_trim_words($excerpt, 80, ' […]');
    }
    return $excerpt;
}

/**
 * Changes the wp-login.php page title and removes the default "WordPress" text
 */
add_filter('login_title', function ($login_title) {
    return str_replace(array (' &#8212;', ' — WordPress', __('WordPress'), ), array (' ', ''), $login_title);
});

add_filter('admin_title', function ($admin_title) {
    return str_replace(array (' &#8212;', ' — WordPress', __('WordPress'), ), array (' ', ''), $admin_title);
});

function add_custom_seo_contributor_css()
{
    $current_user = wp_get_current_user();
    if (in_array('seo_contributor', (array) $current_user->roles) || in_array('seo_editor', (array) $current_user->roles)) {
        echo '<style>
        #toplevel_page_wpcf7,
        #menu-posts-public_announcement,
        #menu-posts-sustainability_news,
        #toplevel_page_theme-general-settings,
        #menu-tools,
        #wp-admin-bar-new-content,
        { display: none !important; }
        </style>';
    }
}
add_action('admin_head', 'add_custom_seo_contributor_css');

if (!function_exists('block_info_link')) {
    function block_info_link($data_block = null)
    {
        $html = '';

        if ($data_block) {
            $data = [
                'link' => $data_block['link'] ?? null,
            ];

            // render html the section
            if ($data['link']) {
                $html .= '<div class="secHeading__link">';
                $html .= custom_btn_link($data['link'], 'btnCTA');
                $html .= '</div>';
            }
        }

        return $html;
    }
}
