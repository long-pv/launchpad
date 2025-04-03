<?php
$post = $args['data'];
$index = $args['index'];
$attr = 'class="tab-pane ' . (($index == 1) ? 'active' : '') . '" id="tabs-' . $index . '" role="tabpanel"';
setup_postdata($post);
?>
<div <?php echo $attr; ?>>
    <div class="storiesItem">
        <div class="row">
            <div class="col-lg-6">
                <div class="storiesItem__content">
                    <h3 class="storiesItem__title">
                        <?php the_title(); ?>
                    </h3>

                    <?php if (get_the_excerpt()): ?>
                        <div class="text-white py-3">
                            <?php echo get_the_excerpt(); ?>
                        </div>
                    <?php endif; ?>

                    <a href="<?php the_permalink(); ?>" class="btnSeeMore testimonialItem__link">
                        <?php _e('See more', 'clvinuni'); ?>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <?php
                if (has_post_thumbnail()):
                    ?>
                    <div class="row no-gutters justify-content-center">
                        <div class="col-md-6 col-lg-12">
                            <div class="imgGroup imgGroup--noEffect storiesItem__img">
                                <img width="300" height="300" src="<?php echo get_the_post_thumbnail_url(); ?>"
                                    alt="<?php the_title(); ?>">
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<?php
wp_reset_postdata();