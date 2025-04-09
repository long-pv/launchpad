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
    jQuery(document).ready(function($) {
        // Add active class to all parent anchors
        var sidebarMenu_active = $(".sidebarMenu--active");
        if (sidebarMenu_active.length > 0) {
            sidebarMenu_active.each(function() {
                var parentAnchors = $(this).parents("ul");

                // Close all other ul elements
                $(".sidebarMenu > ul").not(parentAnchors).hide();

                // Show and active element
                parentAnchors.show().css('display', 'flex');
                $(this).children("ul").show().css('display', 'flex');
                parentAnchors.closest("li").addClass("sidebarMenu--active");
                parentAnchors.closest("li").find(".sidebarMenu__icon").addClass("sidebarMenu--open");
            });
        } else {
            // $(".sidebarMenu .sidebarMenu__content > ul > li > ul").hide();
        }

        // Click show/hide sub sidebar
        $(".sidebarMenu__icon").on("click", function() {
            let sidebar = $(this).siblings("ul");
            sidebar.slideToggle("swing");
            // sidebar.find("ul").slideUp("swing");
            sidebar.css('display', 'flex');

            // Check if the clicked icon is in an open state
            let is_open = $(this).hasClass("sidebarMenu--open");

            // Toggle the class sidebarMenu--open
            $(this).toggleClass("sidebarMenu--open", !is_open);

            // Close all sub-sidebar when closing the parent
            sidebar.find(".sidebarMenu__icon").removeClass("sidebarMenu--open");
        });

        // Click tab to show/hide sidebar with SP
        $(".sidebarMenu__tab").on("click", function() {
            $(".sidebarMenu__content").slideToggle(1000);

            // Open/close icon
            let sidebar_icon = $(".sidebarMenu__tab .sidebarMenu__icon");
            let is_open_icon = sidebar_icon.hasClass("sidebarMenu--open");
            sidebar_icon.toggleClass("sidebarMenu--open", !is_open_icon);
        });
    });
</script>

</body>

</html>