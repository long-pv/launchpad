<div class="pageArticle space--bottom">
	<div class="container">
		<div class="breadcrumbsBlock">
			<?php wp_breadcrumbs(); ?>
		</div>

		<div class="row">
			<div class="col-lg-4">
				<?php get_template_part('template-parts/block/sidebar_menu'); ?>
			</div>
			<div class="col-lg-8 pageArticle__content">
				<?php get_template_part('template-parts/content-flexible-post-type'); ?>
			</div>
		</div>
	</div>
</div>