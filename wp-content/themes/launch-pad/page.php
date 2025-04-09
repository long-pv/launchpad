<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package launch-pad
 */

// header template
get_header();
?>
<!-- ACF  -->
<?php
$page_main = get_field('page_main');
var_dump($page_main);

if (have_rows('page_main')) {

}
?>

<?php
$page_main = get_field('page_main');
$accordion_index = 0;

if (!empty($page_main)):
    foreach ($page_main as $layout):
        if (
            isset($layout['acf_fc_layout']) &&
            $layout['acf_fc_layout'] === 'accordion' &&
            !empty($layout['accordion_item'])
        ):
            ?>
            <section class="secSapce">
                <div class="container-accordion">
                    <div class="accordion" id="accordionExample">
                        <?php foreach ($layout['accordion_item'] as $item):
                            $header = $item['accordion_header'] ?? '';
                            $content = $item['accordion_content'] ?? '';
                            $is_first = ($accordion_index === 0);
                            $collapse_id = 'collapse' . $accordion_index;
                            $heading_id = 'heading' . $accordion_index;
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
                                    <button class="accordion-button <?php echo $is_first ? '' : 'collapsed'; ?>" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapse_id); ?>"
                                        aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                                        aria-controls="<?php echo esc_attr($collapse_id); ?>">
                                        <?php echo esc_html($header); ?>
                                    </button>
                                </h2>
                                <div id="<?php echo esc_attr($collapse_id); ?>"
                                    class="accordion-collapse collapse <?php echo $is_first ? 'show' : ''; ?>"
                                    aria-labelledby="<?php echo esc_attr($heading_id); ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo wp_kses_post($content); ?>
                                    </div>
                                </div>
                            </div>
                            <?php $accordion_index++;
                        endforeach; ?>
                    </div>
                </div>
            </section>
            <?php
        endif;
    endforeach;
endif;
?>


<!--  -->
<div class="container">
    <div class="page_wrap">
        <div class="page_inner">
            <?php
            // get_template_part('template-parts/content-flexible');
            ?>
        </div>
    </div>
</div>

<?php
// footer template
get_footer();
