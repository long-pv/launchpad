<?php
/**
 * The template for displaying archive event pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package clvinuni
 */

get_header();
?>
<div class="archiveEvent space--bottom">
    <div class="container">
        <div class="breadcrumbsBlock">
            <?php wp_breadcrumbs(); ?>
        </div>
        <div class="archiveEvent__events">
            <div class="archiveEvent__header">
                <h1 class="archiveEvent__title">
                    <?php _e('Events', 'clvinuni'); ?>
                </h1>
            </div>
            <div class="archiveEvent__list">
                <div class="row archiveEvent__gutters">
                    <?php
					while (have_posts()): the_post();
						if (get_field('event_date')):
					?>
                    <div class="col-md-4">
                        <?php get_template_part('template-parts/single/content-key_dates'); ?>
                    </div>
                    <?php
						endif;
					endwhile;
					?>
                </div>
            </div>
			<div class="pagination">
				<?php
				echo paginate_links(
					array(
						'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
						'total' => $wp_query->max_num_pages,
						'current' => max(1, get_query_var('paged')),
						'format' => '?paged=%#%',
						'show_all' => false,
						'type' => 'plain',
						'end_size' => 2,
						'mid_size' => 1,
						'prev_next' => true,
						'prev_text' => sprintf('<span class="pagination__prev"></span>'),
						'next_text' => sprintf('<span class="pagination__next"></span>'),
						'add_args' => false,
						'add_fragment' => '',
					)
				);
				?>
			</div>
        </div>
    </div>
</div>
<?php
get_footer();
