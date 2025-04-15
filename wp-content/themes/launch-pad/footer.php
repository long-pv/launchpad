<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package launch-pad
 */

?>
</div>
<?php wp_footer(); ?>

<script>
    jQuery(document).ready(function ($) {
        // Add active class to all parent anchors
        var sidebarMenu_active = $(".sidebarMenu--active");
        if (sidebarMenu_active.length > 0) {
            sidebarMenu_active.each(function () {
                var parentAnchors = $(this).parents("ul");

                // Close all other ul elements
                $(".sidebarMenu > ul").not(parentAnchors).hide();

                // Show and active element
                parentAnchors.show().css('display', 'flex');
                $(this).children("ul").show().css('display', 'flex');
                parentAnchors.closest("li").addClass("sidebarMenu--active");
                parentAnchors.closest("li").find(".sidebarMenu__icon").addClass("sidebarMenu--open");
            });
        }

        // Click show/hide sub sidebar
        $(".sidebarMenu__icon").on("click", function () {
            let sidebar = $(this).siblings("ul");
            sidebar.slideToggle("swing");
            sidebar.css('display', 'flex');

            // Check if the clicked icon is in an open state
            let is_open = $(this).hasClass("sidebarMenu--open");

            // Toggle the class sidebarMenu--open
            $(this).toggleClass("sidebarMenu--open", !is_open);

            // Close all sub-sidebar when closing the parent
            sidebar.find(".sidebarMenu__icon").removeClass("sidebarMenu--open");
        });
    });
</script>

<?php
if (is_page_template('page-home.php')) {
    ?>
    <script>
        jQuery(document).ready(function ($) {
            adjustTabBodyHeight();

            $(window).on('resize', function () {
                adjustTabBodyHeight();
            });

            function adjustTabBodyHeight() {
                var windowWidth = $(window).width();

                if (windowWidth >= 1200) {
                    var windowHeight = $(window).height();
                    var headerHeight = $('.banner').outerHeight(true) || 0;
                    var titleHeight = $('.sec_title').outerHeight(true) || 0;
                    var navTabHeight = $('.tabs_home_pc').outerHeight(true) || 0;
                    var otherPadding = 150; // tuỳ chỉnh theo giao diện
                    var usedHeight = headerHeight + titleHeight + navTabHeight + otherPadding;
                    var availableHeight = windowHeight - usedHeight;

                    $('.tab_scroll').css({
                        'max-height': availableHeight + 'px',
                        'min-height': availableHeight + 'px',
                        'overflow-y': 'auto',
                        'overflow-x': 'hidden',
                    });
                } else {
                    // Reset lại để không giới hạn chiều cao khi nhỏ hơn 1200
                    $('.tab_scroll').css({
                        'max-height': 'none',
                        'min-height': 'none',
                        'overflow-y': 'visible',
                        'overflow-x': 'visible',
                    });
                }
            }
        });
    </script>
    <?php
} else {
    ?>
    <script>
        jQuery(document).ready(function ($) {
            adjustTabBodyHeight();

            $(window).on('resize', function () {
                adjustTabBodyHeight();
            });

            function adjustTabBodyHeight() {
                var windowWidth = $(window).width();

                if (windowWidth >= 1200) {
                    var windowHeight = $(window).height();
                    var headerHeight = $('.banner').outerHeight(true) || 0;
                    var titleHeight = $('.sec_title').outerHeight(true) || 0;
                    var otherPadding = 180; // tuỳ chỉnh theo giao diện
                    if ($('.page_scroll').hasClass('page_scroll_block')) {
                        otherPadding = 100;
                    }
                    var usedHeight = headerHeight + titleHeight + otherPadding;
                    var availableHeight = windowHeight - usedHeight;

                    $('.page_scroll').css({
                        'max-height': availableHeight + 'px',
                        'min-height': availableHeight + 'px',
                        'overflow-y': 'auto',
                        'overflow-x': 'hidden',
                    }).filter('.page_scroll_club_single').css('min-height', 'unset');
                } else {
                    // Reset lại để không giới hạn chiều cao khi nhỏ hơn 1200
                    $('.page_scroll').css({
                        'max-height': 'none',
                        'min-height': 'none',
                        'overflow-y': 'visible',
                        'overflow-x': 'visible',
                    });
                }
            }

            $('.page_section.sectionTab').prev().addClass('sectionTab_prev');
            $('.page_section.sectionTab').next().addClass('sectionTab_next');
        });
    </script>
<?php } ?>

</body>

</html>