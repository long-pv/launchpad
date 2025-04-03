<?php
// Get values
$block_info       = $args['flexible']['block_info'] ?? [];
$display_type     = $block_info['display_type'] ?? '';
$class_block_info = ($display_type == 'left') ? 'col-lg-5' : '';
$class_countdown  = ($display_type == 'left') ? 'col-lg-7' : '';
$dateTime         = $args['flexible']['block_content']['date'] ?? '';
$day = $month = $year = 0;

if (!empty($dateTime)) {
    $date        = date_create($dateTime);
    $date_format = date_format($date, "Y-m-d");
    $day         = date('d', strtotime($date_format));
    $month       = date('m', strtotime($date_format));
    $year        = date('Y', strtotime($date_format));
}

// Get timezone
$offsetInHours = getTimezoneOffsetInHours();
?>
<script src='<?php echo get_template_directory_uri() . '/assets/inc/countdown/jquery-slim.js' ?>'></script>

<div class="countdown">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="countdown__blockInfo">
                    <?php
                        echo block_info($block_info, false);
                        echo block_info_link($block_info)
                    ?>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="countdown__wrap">
                    <div id="countdown" class="countdown__time"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src='<?php echo get_template_directory_uri() . '/assets/inc/countdown/countdown.js' ?>'></script>
<script>
    $('#countdown').countdown({
        year: <?php echo $year; ?>,
        month: <?php echo $month; ?>,
        day: <?php echo $day; ?>,
        hour: 0,
        minute: 0,
        second: 0,
        timezone: <?php echo $offsetInHours; ?>,
    });
</script>