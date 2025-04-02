<?php
function custom_name_block($input)
{
	$normalized = str_replace(['_', '-'], ' ', $input);
	$ucwords = ucwords($normalized);
	$formatted = str_replace(' ', '', $ucwords);

	return 'section' . $formatted;
}

$flexible_content = get_field('flexible_content') ?? '';

if ($flexible_content):
	foreach ($flexible_content as $key => $flexible):
		// custom class
		$customClass = 'secSpace ';
		$sectionId = custom_name_block($flexible['acf_fc_layout']);
		$customClass .= $sectionId;
		$customClass .= !empty($flexible['block_info']['custom_class']) ? ' ' . $flexible['block_info']['custom_class'] : '';
?>
		<section class="<?php echo $customClass; ?>" id="<?php echo $sectionId . '_' . $key; ?>">
			<?php require get_template_directory() . 'template-parts/block/' . $flexible['acf_fc_layout'] . '.php'; ?>
		</section>
<?php
	endforeach;
endif;
?>