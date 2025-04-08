<?php
$event_date = get_field('event_date') ?? null;
$display_detail = get_field('display_detail') ?? null;

if ($event_date):
    // Check whether the date was created successfully or not
    if (LANG == 'vi') {
        $month = custom_convert_time($event_date, "m") ?? '';
        $month = $month ? 'T' . intval($month) : '';
    } else {
        $month = custom_convert_time($event_date, "M") ?? '';
    }
    $day = custom_convert_time($event_date, "j") ?? '';

    $check_content = get_the_content();
    $url = $check_content ? get_permalink() : 'javascript:void(0);';
    ?>
    <div class="keyDates">
        <div class="keyDates__date wow fadeInUp" data-wow-duration="1s">
            <div class="keyDates__month">
                <?php echo $month; ?>
            </div>
            <div class="keyDates__day">
                <?php echo $day; ?>
            </div>
        </div>
        <h4 class="keyDates__title wow fadeInUp" data-wow-duration="1s">
            <?php if ($check_content && $display_detail == 'yes'): ?>
                <a class="line-3" href="<?php echo $url; ?>">
                    <?php the_title(); ?>
                </a>
            <?php else: ?>
                <span class="line-3">
                    <?php the_title(); ?>
                </span>
            <?php endif; ?>
        </h4>
    </div>
<?php endif; ?>