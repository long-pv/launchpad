<?php
// Get values
$block_info = $args['flexible']['block_info'] ?? [];
$index_flexible = $args['index_flexible'];
$terms = get_terms(array(
    'taxonomy'   => 'club_category',
    'hide_empty' => true,
));

$club_args = [
    'post_type' => 'club',
    'posts_per_page' => -1,
];
$the_post = new WP_Query($club_args);
?>

<div class="searchClub space">
    <div class="container">
        <?php echo block_info($block_info); ?>
        <?php if ($terms) : ?>
            <div class="searchClub__inner secHeading wow fadeInUp" data-wow-duration="1s">
                <div class="row no-gutters">
                    <div class="col-md-7">
                        <input type="text" name="club" class="searchClub__input" placeholder="<?php _e('Search by keyword', 'clvinuni') ?>">
                    </div>
                    <div class="col-md-3">
                        <a class="btnSearch btnSeeMore btnCTA searchClub__btnSearch "><span><?php _e('Search', 'clvinuni') ?></span></a>
                    </div>
                    <div class="col-md-2">
                        <div class="ml-md-2 ml-lg-3 searchClub__btnWrap">
                            <a class="btnSearch btnSeeMore btnCTA searchClub__btnReset "><span><?php _e('Reset', 'clvinuni') ?></span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion clubCategories" id="accordionclubs<?php echo $index_flexible; ?>">
                <?php
                foreach ($terms as $index => $term) :
                    $club_cate = $term->slug;
                ?>
                    <div class="faqs__item clubCategories__item wow fadeInUp" data-wow-duration="1s">
                        <div class="faqs__header clubCategories__header" id="accordionHeader-<?php echo $index_flexible; ?>-<?php echo $index; ?>">
                            <h3 class="faqs__title clubCategories__title">
                                <button class="faqs__btn clubCategories__btn btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $index_flexible; ?>-<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $index_flexible; ?>-<?php echo $index; ?>">
                                    <?php echo $term->name; ?>
                                </button>
                            </h3>
                        </div>

                        <div id="collapse-<?php echo $index_flexible; ?>-<?php echo $index; ?>" class="collapse" aria-labelledby="accordionHeader-<?php echo $index_flexible; ?>-<?php echo $index; ?>">
                            <?php
                            if ($the_post->have_posts()) :
                            ?>
                                <div class="clubs">
                                    <div class="row">
                                        <?php
                                        while ($the_post->have_posts()) : $the_post->the_post();
                                            if (has_term($club_cate, 'club_category', get_the_ID())) :
                                        ?>
                                                <div class="col-md-4 col-lg-3 clubs__col">
                                                    <?php get_template_part('template-parts/single/club'); ?>
                                                </div>
                                        <?php endif;
                                        endwhile; ?>
                                    </div>
                                </div>
                            <?php wp_reset_query();
                            endif; ?>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>