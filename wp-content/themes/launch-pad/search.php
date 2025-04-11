<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package launch-pad
 */

get_header();
?>

<div class="container_xx">
	<div class="page_wrap">
		<div class="page_inner">
			<div class="container">
				<h2 class="sec_title">
					<?php _e('Search results', 'launch-pad'); ?>
				</h2>
				<div class="page_body">
					<div class="page_scroll d-block">
						<?php if (get_search_query()): ?>
							<div class="list_post__title">
								<?php _e("Search result for", "launch-pad"); ?>
								<span class="list_post__keyword">
									<?php echo esc_html(get_search_query()); ?>
								</span>
							</div>
						<?php endif; ?>

						<div class="list_post__list">
							<?php
							if (have_posts()):
								while (have_posts()):
									the_post();
									?>
									<div class="list_post__item">
										<a href="<?php the_permalink(); ?>" class="list_post__link">
											<h3 class=" list_post__heading"><?php the_title(); ?></h3>
										</a>
										<div class="list_post__description">
											<?php echo preg_replace('/<a\b[^>]*>(.*?)<\/a>/is', '$1', get_the_excerpt()); ?>
										</div>
									</div>
									<?php
								endwhile;
							endif;
							?>
						</div>
					</div>
				</div>
			</div>

			<div class="page_bottom">
				<div class="container">
					<div class="inner">
						<a href="javascript:void(0);" class="logo">
							<?php $logo_url = get_template_directory_uri() . '/assets/images/logo_vin.svg'; ?>
							<img src="<?php echo $logo_url; ?>" alt="logo">
						</a>

						<?php
						$copyright = get_field('copyright', 'option') ?? '';
						if ($copyright) {
							?>
							<div class="copyright">
								<?php echo $copyright; ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
