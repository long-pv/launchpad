<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package launch-pad
 */

get_header();
?>


<div class="container_xx">
    <div class="page_wrap">
        <div class="page_inner">
            <div class="page_body">
                <div class="card_club">
                    <div class="row">
                        <div class="col-4">
                            <div class="card_club__image-wrapper">
                                <?php $thumbnail_url = get_the_post_thumbnail_url(get_the_ID()); ?>
                                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>"
                                    class="card_club__image" />
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card_club__content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
