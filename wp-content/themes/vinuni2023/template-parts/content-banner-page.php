<?php
$args['flexible']['select_style'] = get_field('select_style') ?? '';
$args['flexible']['slider_bg'] = get_field('slider_bg') ?? '';
$args['flexible']['background_image'] = get_field('background_image') ?? '';

if ($args['flexible']['slider_bg'] || $args['flexible']['background_image']): ?>
	<section class="sectionBanner">
		<?php get_template_part('template-parts/block/banner', '', $args); ?>
	</section>
	<?php
endif;
?>