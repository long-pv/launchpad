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


<div class="pageArticle space--bottom">
	<div class="container">
		<!-- Breadcrumbs -->
		<div class="breadcrumbsBlock">
			<?php wp_breadcrumbs(); ?>
		</div>
		<!-- /End Breadcrumbs -->

		<div class="row">
			<div class="col-lg-4">
				<?php get_template_part('template-parts/block/sidebar_menu'); ?>
			</div>
			<div class="col-lg-8 pageArticle__content">
				<div class="secHeading">
					<h1 class="secTitle secHeading__title wow fadeInUp" data-wow-duration="1s">
						<?php
						$current_category = get_queried_object();
						echo custom_title($current_category->name);
						?>
					</h1>
				</div>

				<div class="whyWorking">
					<div class="row whyWorking__list">
						<?php
						while (have_posts()):
							the_post();
							if (get_the_title() && has_post_thumbnail()):
								?>
								<div class="col-md-6">
									<div class="whyWorking__item whyWorking--hover">
										<div class="whyWorking__img"
											style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 48.44%, rgba(0, 0, 0, 0.80) 100%), url(<?php echo get_the_post_thumbnail_url(); ?>) center/cover no-repeat, lightgray 50%;">
										</div>
										<div class="whyWorking__content">
											<h3 class="h5 whyWorking__title wow fadeInUp" data-wow-duration="1s">
												<a href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</h3>
										</div>

										<a class="whyWorking__link" href="<?php the_permalink(); ?>"></a>
									</div>
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
</div>

<?php
get_footer();
