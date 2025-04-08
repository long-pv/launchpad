<?php
$display_detail = get_field('display_details', get_the_ID()) ?? 'yes';
$link_page = get_field('link_page', get_the_ID()) ?? [];
$link = ($display_detail == 'yes') ? get_permalink() : ($link_page['url'] ?? 'javascript:void(0);');
?>
<li class="latestNews__item">
    <a class="latestNews__link line-2" href="<?php echo esc_url($link); ?>">
        <?php the_title(); ?>
    </a>
</li>