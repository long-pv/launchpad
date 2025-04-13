<?php
$flexible_content = get_field('lp_flexible_content') ?? '';

if ($flexible_content):
    foreach ($flexible_content as $index => $flexible):
    ?>
        <section id="<?php echo custom_name_block($flexible['acf_fc_layout']); ?>">
            <?php
            $args['flexible'] = $flexible;
            $args['index_flexible'] = $index;
            get_template_part('template-parts/block/' . $flexible['acf_fc_layout'], '', $args);
            ?>
        </section>
    <?php
    endforeach;
endif;