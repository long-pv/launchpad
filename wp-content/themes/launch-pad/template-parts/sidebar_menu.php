<!-- Build sidebar Menu -->
<div class="sidebarMenu">
    <?php
    // Get parent page id
    $current_page_id = get_the_ID();
    $data_sidebar = get_data_sidebar(0);
    // Show sidebar
    ?>
    <div class="sidebarMenu__content">
        <?php display_sidebar_menu($data_sidebar); ?>
    </div>
</div>
