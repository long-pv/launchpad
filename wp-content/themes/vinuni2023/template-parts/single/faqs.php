<?php
$faqs = $args['faqs'] ?? '';
if ($faqs) :
    $key_id = mt_rand(100, 999);
?>
    <div class="accordion" id="accordionFAQs<?php echo $key_id; ?>">
        <?php
        foreach ($faqs as $index => $post) :
            setup_postdata($post);
            if (get_post_status($post) == 'publish' && get_field('question') && get_field('answer')) :
        ?>
                <div class="faqs__item">
                    <div class="faqs__header" id="accordionHeader-<?php echo $key_id; ?>-<?php echo $index; ?>">
                        <h3 class="faqs__title">
                            <button class="faqs__btn btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $key_id; ?>-<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $key_id; ?>-<?php echo $index; ?>">
                                <?php echo get_field('question'); ?>
                            </button>
                        </h3>
                    </div>

                    <div id="collapse-<?php echo $key_id; ?>-<?php echo $index; ?>" class="collapse" aria-labelledby="accordionHeader-<?php echo $key_id; ?>-<?php echo $index; ?>" data-parent="#accordionFAQs<?php echo $key_id; ?>">
                        <div class="faqs__body editor">
                            <?php echo get_field('answer'); ?>
                        </div>
                    </div>
                </div>
        <?php
            endif;
        endforeach;
        wp_reset_postdata();
        ?>
    </div>
<?php endif; ?>