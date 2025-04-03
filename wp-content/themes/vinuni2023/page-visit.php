<?php

/**
 * Template name: Visit
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package clvinuni
 */

// page redirection
$redirection = get_field('redirection') ?? null;
if ($redirection) {
    wp_redirect($redirection);
    exit;
}

get_header();
?>
<!-- Banner -->
<?php
get_template_part('template-parts/content-banner-page');
?>
<!-- /End Banner -->

<div class="pageVisit space">
    <div class="container">
        <h1 class="secTitle secHeading__title wow fadeInUp" data-wow-duration="1s">
            <?php echo custom_title(get_the_title()); ?>
        </h1>

        <div class="editor secHeading__desc wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
            <?php the_content(); ?>
        </div>

        <?php
        $virtual_tour = 'https://vinuni.edu.vn/virtual-tour/index.html';
        if (get_field('virtual_tour')) {
            $virtual_tour = get_field('virtual_tour');
        }
        ?>
        <div class="video-container mt-4 mt-lg-5">
            <iframe width="560" height="315" src="<?php echo $virtual_tour; ?>" title="Visual Tour" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>

        <?php
        $continue_exploring = get_field('continue_exploring');
        if ($continue_exploring):
            ?>
            <div class="continueExploring space--top">
                <h2 class="secTitle secHeading__title wow fadeInUp" data-wow-duration="1s">
                    <?php _e('Continue Exploring …', 'clvinuni'); ?>
                </h2>

                <div class="row continueExploring__list">
                    <?php
                    foreach ($continue_exploring as $item):
                        if ($item['link']['url'] && $item['link']['title']):
                            ?>
                            <div class="col-md-4 col-lg-3 mb-3">
                                <a class="btnSeeMore btnCTA w-100" href="<?php echo $item['link']['url']; ?>"
                                    target="<?php echo $item['link']['target']; ?>">
                                    <?php echo $item['link']['title']; ?>
                                </a>
                            </div>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
            <?php
        endif;
        ?>
    </div>
</div>

<style>
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

<?php
get_footer();