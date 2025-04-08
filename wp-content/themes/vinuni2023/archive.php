<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package clvinuni
 */

get_header();
?>

<section class="space--bottom">
	<div class="container">
		<div class="breadcrumbsBlock">
			<?php wp_breadcrumbs(); ?>
		</div>

		<div class="newsEvents">
			<div class="newsCate">
				<div class="newsCate__header">
					<h1 class="newsCate__title">
						<?php
						$current_category = get_queried_object();

						if (is_tag()) {
							echo __('Tag', 'clvinuni') . ': ' . $current_category->name;
						} else {
							echo $current_category->name;
						}
						?>
					</h1>
				</div>
				<div class="newsCate__listNews">
					<div class="row newsCate__newsGutters">
						<?php
						while (have_posts()):
							the_post();
							if (get_the_title() && has_post_thumbnail()):
								?>
								<div class="col-md-6 col-lg-4">
									<?php get_template_part('template-parts/single/content-news'); ?>
								</div>
								<?php
							endif;
						endwhile;
						?>
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

						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
