<?php
$display_detail = get_field('display_details', get_the_ID()) ?? 'yes';
$link_page = get_field('link_page', get_the_ID()) ?? [];
$link = ($display_detail == 'yes') ? get_permalink() : ($link_page['url'] ?? 'javascript:void(0);');
?>
<a href="<?php echo $link; ?>" class="line-4">
    <?php echo get_the_title(); ?>
</a>