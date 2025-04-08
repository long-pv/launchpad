<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package clvinuni
 */

?>
</main>

<?php
$footer_setting = get_field('footer_setting_' . LANG, 'option') ?? null;
?>
<footer id="footer_page" class="footer">
    <div class="footer__inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer__intro">
                        <a href="<?php echo home_url(); ?>" class="footer__logo">
                            <?php
                            $logo_url = get_template_directory_uri() . '/assets/images/logo_white.png';
                            if (get_field('logo_footer', 'option')) {
                                $logo_url = get_field('logo_footer', 'option');
                            }
                            ?>
                            <img src="<?php echo $logo_url; ?>" alt="logo">
                        </a>

                        <?php if (!empty($footer_setting) && $footer_setting['copyright']): ?>
                            <div class="footer__copyright">
                                <?php echo $footer_setting['copyright']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer__item">
                                <?php if (!empty($footer_setting) && $footer_setting['title_menu_1']): ?>
                                    <div class="footer__title">
                                        <?php echo $footer_setting['title_menu_1']; ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                if (has_nav_menu('footer-1')) {
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer-1',
                                            'container' => 'div',
                                            'container_class' => 'footer__menu',
                                            'depth' => 1,
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer__item">
                                <?php if (!empty($footer_setting) && $footer_setting['title_menu_2']): ?>
                                    <div class="footer__title">
                                        <?php echo $footer_setting['title_menu_2']; ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                if (has_nav_menu('footer-2')) {
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer-2',
                                            'container' => 'div',
                                            'container_class' => 'footer__menu',
                                            'depth' => 1,
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer__item">
                                <?php if (!empty($footer_setting) && $footer_setting['title_menu_3']): ?>
                                    <div class="footer__title">
                                        <?php echo $footer_setting['title_menu_3']; ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                if (has_nav_menu('footer-3')) {
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer-3',
                                            'container' => 'div',
                                            'container_class' => 'footer__menu',
                                            'depth' => 1,
                                        )
                                    );
                                }
                                ?>

                                <div class="socialPc">
                                    <?php
                                    $social_html = '';
                                    ob_start();
                                    ?>
                                    <div class="footer__social">
                                        <?php
                                        if (!empty($footer_setting) && $footer_setting['faceboook']):
                                            ?>
                                            <a target="_blank" href="<?php echo $footer_setting['faceboook']; ?>">
                                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M20.5547 10.0781C20.5547 4.55813 16.0747 0.078125 10.5547 0.078125C5.03469 0.078125 0.554688 4.55813 0.554688 10.0781C0.554688 14.9181 3.99469 18.9481 8.55469 19.8781V13.0781H6.55469V10.0781H8.55469V7.57812C8.55469 5.64813 10.1247 4.07812 12.0547 4.07812H14.5547V7.07812H12.5547C12.0047 7.07812 11.5547 7.52812 11.5547 8.07812V10.0781H14.5547V13.0781H11.5547V20.0281C16.6047 19.5281 20.5547 15.2681 20.5547 10.0781Z"
                                                        fill="white" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>

                                        <?php
                                        if (!empty($footer_setting) && $footer_setting['youtube']):
                                            ?>
                                            <a target="_blank" href="<?php echo $footer_setting['youtube']; ?>">
                                                <svg width="20" height="15" viewBox="0 0 20 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8 10.0508L13.19 7.05078L8 4.05078V10.0508ZM19.56 2.22078C19.69 2.69078 19.78 3.32078 19.84 4.12078C19.91 4.92078 19.94 5.61078 19.94 6.21078L20 7.05078C20 9.24078 19.84 10.8508 19.56 11.8808C19.31 12.7808 18.73 13.3608 17.83 13.6108C17.36 13.7408 16.5 13.8308 15.18 13.8908C13.88 13.9608 12.69 13.9908 11.59 13.9908L10 14.0508C5.81 14.0508 3.2 13.8908 2.17 13.6108C1.27 13.3608 0.69 12.7808 0.44 11.8808C0.31 11.4108 0.22 10.7808 0.16 9.98078C0.0900001 9.18078 0.0599999 8.49078 0.0599999 7.89078L0 7.05078C0 4.86078 0.16 3.25078 0.44 2.22078C0.69 1.32078 1.27 0.740781 2.17 0.490781C2.64 0.360781 3.5 0.270781 4.82 0.210781C6.12 0.140781 7.31 0.110781 8.41 0.110781L10 0.0507812C14.19 0.0507812 16.8 0.210781 17.83 0.490781C18.73 0.740781 19.31 1.32078 19.56 2.22078Z"
                                                        fill="white" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>


                                        <?php
                                        if (!empty($footer_setting) && $footer_setting['mail']):
                                            ?>
                                            <a target="_blank" href="<?php echo $footer_setting['mail']; ?>">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.5273 3.52344H7.52734C4.52734 3.52344 2.52734 5.02344 2.52734 8.52344V15.5234C2.52734 19.0234 4.52734 20.5234 7.52734 20.5234H17.5273C20.5273 20.5234 22.5273 19.0234 22.5273 15.5234V8.52344C22.5273 5.02344 20.5273 3.52344 17.5273 3.52344ZM17.9973 9.61344L14.8673 12.1134C14.2073 12.6434 13.3673 12.9034 12.5273 12.9034C11.6873 12.9034 10.8373 12.6434 10.1873 12.1134L7.05734 9.61344C6.73734 9.35344 6.68734 8.87344 6.93734 8.55344C7.19734 8.23344 7.66734 8.17344 7.98734 8.43344L11.1173 10.9334C11.8773 11.5434 13.1673 11.5434 13.9273 10.9334L17.0573 8.43344C17.3773 8.17344 17.8573 8.22344 18.1073 8.55344C18.3673 8.87344 18.3173 9.35344 17.9973 9.61344Z"
                                                        fill="white" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    $social_html = ob_get_clean();
                                    echo $social_html;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-end">
                                <div class="col-8 d-lg-none">
                                    <?php if (!empty($footer_setting) && $footer_setting['copyright']): ?>
                                        <div class="footer__copyright">
                                            <?php echo $footer_setting['copyright']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-4 d-lg-none">
                                    <?php echo $social_html; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="backToTop">
    <span class="backToTop__icon"></span>
</div>

<?php wp_footer(); ?>

<?php 
$vinViewSP = isset($_GET['view']) ? $_GET['view'] : '';
    if($vinViewSP == 'mobi' ){
        ?>
        <script>
            $(document).ready(function() {
                var urlParams = new URLSearchParams(window.location.href.split("?")[1]);
                var viewParam = urlParams.get('view');
                if (viewParam === 'mobi') {
                    $('#footer_page').remove();
                    $('#header').remove();
                    if($('.breadcrumbsBlock').length > 0){
                        $('.breadcrumbsBlock').remove();
                    }
                } 
                $('a').each(function() {
                    let link = $(this).attr('href');
                    let params = new URLSearchParams(link.split('?')[1]);
                    let viewParam = params.get('view');
                    if (viewParam !== 'mobi') {
                        if (link.indexOf('?') !== -1) {
                            link += '&view=mobi';
                        } else {
                            link += '?view=mobi';
                        }
                        $(this).attr('href', link);
                    }
                });
            });
        </script>
        <?php
    }
?>

</body>

</html>