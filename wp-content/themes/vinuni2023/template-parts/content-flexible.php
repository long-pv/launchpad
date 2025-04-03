<?php
$flexible_content = get_field('flexible_content') ?? '';

if ($flexible_content):
	foreach ($flexible_content as $index => $flexible):
		// custom class
		$customClass = 'secSpace ';
		$customClass .= custom_name_block($flexible['acf_fc_layout']);
		$customClass .= '  ';
		$customClass .= $flexible['block_info']['custom_class'] ?? '';
		?>
		<section class="<?php echo $customClass; ?>" id="<?php echo custom_name_block($flexible['acf_fc_layout']); ?>">
			<?php
			$args['flexible'] = $flexible;
			$args['index_flexible'] = $index;
			get_template_part('template-parts/block/' . $flexible['acf_fc_layout'], '', $args);
			?>
		</section>
		<?php
	endforeach;
elseif (get_the_content()):
	?>
	<section class="container">
		<?php if(!is_page_template(array('page-article.php'))) : ?>
		<!-- breadcrumbs -->
		<div class="breadcrumbsBlock">
			<?php wp_breadcrumbs(); ?>
		</div>
		<?php endif; ?>

		<div class="space--bottom">
			<?php if(!is_page_template(array('page-article.php'))) : ?>
			<!-- title -->
			<div class="h2 font-weight-bold mb-4">
				<?php the_title(); ?>
			</div>
			<?php endif; ?>

			<!-- post content -->
			<div class="editor">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php
endif;
?>