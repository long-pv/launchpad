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