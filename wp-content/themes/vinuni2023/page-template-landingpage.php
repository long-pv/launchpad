<?php
/**
 * Template Name: Page Template Landing page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vinuni
 */

get_header();
?>
<div class="wrap animsition animsition-wrapper main-wrapper">

    <script src='<?php echo get_template_directory_uri() . '/assets/inc/countdown/jquery-slim.js' ?>'></script>

    <?php
    $show_banner = get_field('show_banner');
    $show_countdown = get_field('show_countdown');
    $show_about = get_field('show_about');
    $show_time = get_field('show_time');
    $show_participation = get_field('show_participation');
    $show_event = get_field('show_event');
    $show_agenda = get_field('show_agenda');
    $show_booth_layout = get_field('show_booth_layout');
    $show_contact_us = get_field('show_contact_us');
    ?>


    <?php
    if ($show_banner == '1'):
        if (get_field('image_banner')):
            ?>
            <section class="banner py-4 py-lg-5">
                <div class="container">
                    <img src="<?php echo get_field('image_banner'); ?>" alt="banner">
                </div>
            </section>

            <div class="container">
                <div class="hr"></div>
            </div>

            <?php
        endif;
    endif;
    ?>

    <?php
    if ($show_countdown == '1'):
        ?>
        <section class="countdown pt-4 pt-lg-5">
            <div class="container">
                <?php if (get_field('title_countdown')): ?>
                    <h2 class="text-secondary text-center">
                        <?php echo get_field('title_countdown'); ?>
                    </h2>
                <?php endif; ?>

                <!-- đếm ngược thời gian -->
                <div class="py-4 py-lg-5">
                    <?php
                    $date = date_create(get_field('date'));
                    $date_format = date_format($date, "Y-m-d");

                    $day = date('d', strtotime($date_format));
                    $month = date('m', strtotime($date_format));
                    $year = date('Y', strtotime($date_format));

                    ?>
                    <div class="row no-gutters">
                        <div class="col-12 col-lg-2"></div>
                        <div class="col-12 col-lg-8">
                            <div id="countdown" class="row justify-content-center align-items-center"></div>
                        </div>
                    </div>
                    <script
                        src='<?php echo get_template_directory_uri() . '/assets/inc/countdown/countdown.js' ?>'></script>
                    <script>
                        $('#countdown').countdown({
                            year: <?php echo $year; ?>,
                            month: <?php echo $month; ?>,
                            day: <?php echo $day; ?>,
                            hour: 0,
                            minute: 0,
                            second: 0,
                        });
                    </script>
                </div>
                <!-- end đếm ngược -->
            </div>
        </section>

        <?php
        $count_show = 0;
        ?>

        <section class="container d-lg-flex justify-content-center ">
            <div class="button pb-4 pb-lg-5 d-lg-flex justify-content-center flex-wrap">

                <?php
                if ($show_time):
                    if (get_field('title_time')):
                        ?>
                        <div class="button-click text-center d-lg-inline mb-3 text-truncate">
                            <a class="btn btn-vin text-uppercase" data-id="section-1">
                                <?php echo get_field('title_time'); ?>
                            </a>
                        </div>
                        <?php
                        $count_show++;
                    endif;
                endif;
                ?>

                <?php
                if ($show_participation):
                    if (get_field('title_participation')):
                        ?>
                        <div class="button-click text-center d-lg-inline mb-3 text-truncate">
                            <a class="btn btn-vin text-uppercase" data-id="section-2">
                                <?php echo get_field('title_participation'); ?>
                            </a>
                        </div>
                        <?php
                        $count_show++;
                    endif;
                endif;
                ?>

                <?php
                if ($show_event):
                    if (get_field('title_agenda')):
                        ?>
                        <div class="button-click text-center d-lg-inline mb-3 text-truncate">
                            <a class="btn btn-vin text-uppercase" data-id="section-6">
                                <?php echo get_field('title_event'); ?>
                            </a>
                        </div>
                        <?php
                        $count_show++;
                    endif;
                endif;
                ?>

                <?php
                if ($show_agenda):
                    if (get_field('title_agenda')):
                        ?>
                        <div class="button-click text-center d-lg-inline mb-3 text-truncate">
                            <a class="btn btn-vin text-uppercase" data-id="section-3">
                                <?php echo get_field('title_agenda'); ?>
                            </a>
                        </div>
                        <?php
                        $count_show++;
                    endif;
                endif;
                ?>

                <?php
                if ($show_booth_layout):
                    if (get_field('title_booth_layout')):
                        ?>
                        <div class="button-click text-center d-lg-inline mb-3 text-truncate">
                            <a class="btn btn-vin text-uppercase" data-id="section-4">
                                <?php echo get_field('title_booth_layout'); ?>
                            </a>
                        </div>
                        <?php
                        $count_show++;
                    endif;
                endif;
                ?>

                <?php
                if ($show_contact_us):
                    if (get_field('title_contact_us')):
                        ?>
                        <div class="button-click text-center d-lg-inline mb-3 text-truncate">
                            <a class="btn btn-vin text-uppercase" data-id="section-5">
                                <?php echo get_field('title_contact_us'); ?>
                            </a>
                        </div>
                        <?php
                        $count_show++;
                    endif;
                endif;
                ?>
            </div>
        </section>

        <div class="container">
            <div class="hr"></div>
        </div>

        <?php
    endif;
    if ($show_about == '1'):
        ?>

        <section class="about py-4 py-lg-5">
            <div class="container">
                <?php if (get_field('title_about')): ?>
                    <h2 class="text-secondary">
                        <?php echo get_field('title_about'); ?>
                    </h2>
                <?php endif; ?>

                <div class="">
                    <div class="row">
                        <div class="col-12 col-lg-7 pt-3 pt-lg-4">
                            <div class="content post-detail pr-lg-5">
                                <?php echo get_field('content_about'); ?>
                            </div>
                        </div>

                        <!-- The image flips back and forth -->
                        <div class="col-12 col-lg-5">
                            <link rel="stylesheet"
                                href="<?php echo get_template_directory_uri() . '/assets/inc/flip-box/flip-box.css'; ?>">
                            <script
                                src='<?php echo get_template_directory_uri() . '/assets/inc/flip-box/flip-box.js'; ?>'></script>
                            <?php
                            $images = get_field('img_about');
                            $image_1 = $images['image_1'];
                            $image_2 = $images['image_2'];
                            ?>
                            <div class="flex-container">
                                <div class="bod-flip-box flex-column">
                                    <div class="flip-inner">
                                        <div class="flip-front">
                                            <img class='flip-front-image' src="<?php echo $image_1; ?>" alt="image">
                                        </div>
                                        <div class="flip-back">
                                            <img class='flip-back-image' src="<?php echo $image_2; ?>" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end -->
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="hr"></div>
        </div>

        <?php
    endif;
    if ($show_time == '1'):
        ?>

        <section class="time-and-veue py-4 py-lg-5" id="section-1">
            <div class="container">
                <?php if (get_field('title_time')): ?>
                    <h2 class="text-secondary">
                        <?php echo get_field('title_time'); ?>
                    </h2>
                <?php endif; ?>

                <div class="content post-detail pt-3 pt-lg-4">
                    <?php echo get_field('content_time'); ?>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="hr"></div>
        </div>

        <?php
    endif;
    if ($show_participation == '1'):
        ?>

        <section class="participation py-4 py-lg-5" id="section-2">
            <div class="container">
                <?php if (get_field('title_participation')): ?>
                    <h2 class="text-secondary">
                        <?php echo get_field('title_participation'); ?>
                    </h2>
                <?php endif; ?>

                <div class="participation-number px-3 pt-3 pt-lg-4">
                    <div class="row">

                        <script
                            src='<?php echo get_template_directory_uri() . '/assets/inc/numscroller/numscroller.js'; ?>'></script>

                        <?php if (get_field('companies_and_organizations')): ?>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="item">
                                    <div class="number mb-2 numscroller numscroller-big-bottom" data-slno='1' data-min='0'
                                        data-max='<?php echo get_field('companies_and_organizations') ?>' data-delay='2'
                                        data-increment="1">0</div>
                                    <h3 class="title px-4">
                                        <?php _e('PARTICIPATING COMPANIES AND ORGANIZATIONS', 'vinuni'); ?>
                                    </h3>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (get_field('represented_industries')): ?>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="item">
                                    <div class="number mb-2 numscroller numscroller-big-bottom" data-slno='1' data-min='0'
                                        data-max='<?php echo get_field('represented_industries') ?>' data-delay='2'
                                        data-increment="1">0</div>
                                    <h3 class="title px-4">
                                        <?php _e('Represented industries', 'vinuni'); ?>
                                    </h3>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (get_field('expected_attendance')): ?>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="item">
                                    <div class="number mb-2 numscroller numscroller-big-bottom" data-slno='1' data-min='0'
                                        data-max='<?php echo get_field('expected_attendance') ?>' data-delay='2'
                                        data-increment="1">0</div>
                                    <h3 class="title px-4">
                                        <?php _e('Expected attendance', 'vinuni'); ?>
                                    </h3>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <script src='<?php echo get_template_directory_uri() . '/assets//inc/numscroller/slideIn.js'; ?>'></script>

                <!-- sponsor sponsor_diamond -->
                <?php
                $sponsor_diamond = get_field('sponsor_diamond');
                ?>

                <div class="participation-number px-3 pt-3 pt-lg-4">
                    <h3 class="h3 text-center" style="color: #d2ae6d;">
                        <?php
                        echo $sponsor_diamond['title'];
                        ?>
                    </h3>
                    <p class="text-center">
                        <em>
                            <?php
                            echo $sponsor_diamond['note'];
                            ?>
                        </em>
                    </p>
                </div>

                <?php
                $organization = $sponsor_diamond['organization'];
                if ($organization):
                    ?>
                    <div class="organization pt-4 pt-lg-5">
                        <div class="row justify-content-center">
                            <?php
                            foreach ($organization as $i):
                                if ($i['image']):
                                    ?>
                                    <div class="col-6 col-lg-2 js-slidein block">
                                        <div class="item pb-4">
                                            <button class="modal-click" <?php echo ($i['content']) ? ' type="button" data-toggle="modal" data-target="#staticBackdrop" ' : ''; ?>>
                                                <div class="logo">
                                                    <img src="<?php echo $i['image']; ?>" alt="logo">
                                                </div>
                                                <span class="organization-content d-none">
                                                    <?php echo $i['content']; ?>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- sponsor platinum -->
                <?php
                $sponsor_platinum = get_field('sponsor_platinum');
                ?>

                <div class="participation-number px-3 pt-3 pt-lg-4">
                    <h3 class="h3 text-center" style="color: #d2ae6d;">
                        <?php
                        echo $sponsor_platinum['title'];
                        ?>
                    </h3>
                    <p class="text-center">
                        <em>
                            <?php
                            echo $sponsor_platinum['note'];
                            ?>
                        </em>
                    </p>
                </div>

                <?php
                $organization = $sponsor_platinum['organization'];
                if ($organization):
                    ?>
                    <div class="organization pt-4 pt-lg-5">
                        <div class="row justify-content-center">
                            <?php
                            foreach ($organization as $i):
                                if ($i['image']):
                                    ?>
                                    <div class="col-6 col-lg-2 js-slidein block">
                                        <div class="item pb-4">
                                            <button class="modal-click" <?php echo ($i['content']) ? ' type="button" data-toggle="modal" data-target="#staticBackdrop" ' : ''; ?>>
                                                <div class="logo">
                                                    <img src="<?php echo $i['image']; ?>" alt="logo">
                                                </div>
                                                <span class="organization-content d-none">
                                                    <?php echo $i['content']; ?>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- sponsor gold -->
                <?php
                $sponsor_gold = get_field('sponsor_gold');
                ?>

                <div class="participation-number px-3 pt-3 pt-lg-4">
                    <h3 class="h3 text-center" style="color: #d2ae6d;">
                        <?php
                        echo $sponsor_gold['title'];
                        ?>
                    </h3>
                    <p class="text-center">
                        <em>
                            <?php
                            echo $sponsor_gold['note'];
                            ?>
                        </em>
                    </p>
                </div>

                <?php
                $organization = $sponsor_gold['organization'];
                if ($organization):
                    ?>
                    <div class="organization pt-4 pt-lg-5">
                        <div class="row justify-content-center">
                            <?php
                            foreach ($organization as $i):
                                if ($i['image']):
                                    ?>
                                    <div class="col-6 col-lg-2 js-slidein block">
                                        <div class="item pb-4">
                                            <button class="modal-click" <?php echo ($i['content']) ? ' type="button" data-toggle="modal" data-target="#staticBackdrop" ' : ''; ?>>
                                                <div class="logo">
                                                    <img src="<?php echo $i['image']; ?>" alt="logo">
                                                </div>
                                                <span class="organization-content d-none">
                                                    <?php echo $i['content']; ?>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- attending_companies_and_organizations -->
                <?php
                $attending = get_field('attending_companies_and_organizations');
                ?>

                <div class="participation-number px-3 pt-3 pt-lg-4">
                    <h3 class="h3 text-center" style="color: #d2ae6d;">
                        <?php
                        echo $attending['title'];
                        ?>
                    </h3>
                    <p class="text-center">
                        <em>
                            <?php
                            echo $attending['note'];
                            ?>
                        </em>
                    </p>
                </div>

                <?php
                $organization = $attending['organization'];
                ?>

                <div class="organization pt-4 pt-lg-5">
                    <div class="row">
                        <?php
                        foreach ($organization as $i):
                            if ($i['image']):
                                ?>
                                <div class="col-6 col-lg-2 js-slidein block">
                                    <div class="item pb-4">
                                        <button class="modal-click" <?php echo ($i['content']) ? ' type="button" data-toggle="modal" data-target="#staticBackdrop" ' : ''; ?>>
                                            <div class="logo">
                                                <img src="<?php echo $i['image']; ?>" alt="logo">
                                            </div>
                                            <span class="organization-content d-none">
                                                <?php echo $i['content']; ?>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="hr"></div>
        </div>

        <?php
    endif;
    $index = 0;
    if ($show_event == '1'):
        ?>

        <section class="agenda py-4 py-lg-5" id="section-6">
            <div class="container">
                <?php if (get_field('title_event')): ?>
                    <h2 class="text-secondary">
                        <?php echo get_field('title_event'); ?>
                    </h2>
                <?php endif; ?>

                <?php
                $events = get_field('events');
                ?>

                <div class="accordion pt-3 pt-lg-4" id="accordionEvent">
                    <?php
                    foreach ($events as $i):
                        ?>
                        <div class="accordion-item mb-1">
                            <div class="accordion__header" id="heading-<?php echo $index; ?>">
                                <button class="p-3 text-left <?php if ($i['content']) {
                                    echo 'accordion-hover';
                                } ?>" type="button" data-toggle="collapse"
                                    data-target="#collapse-<?php echo $index; ?>" aria-expanded="true"
                                    aria-controls="collapse-<?php echo $index; ?>">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="title">

                                                <span class="icon">
                                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.12756 16L0 8.00017L8.12756 0L16.2535 8.00017L8.12756 16Z"
                                                            fill="#2E5288" />
                                                    </svg>
                                                </span>

                                                <div class="text">
                                                    <?php echo $i['title']; ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <?php if ($i['content']): ?>
                                <div id="collapse-<?php echo $index; ?>" class="collapse"
                                    aria-labelledby="heading-<?php echo $index; ?>" data-parent="#accordionEvent">
                                    <div class="card-body">
                                        <?php echo $i['content']; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                        $index++;
                    endforeach;
                    ?>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="hr"></div>
        </div>
        <?php
    endif;
    if ($show_agenda == '1'):
        ?>

        <section class="agenda py-4 py-lg-5" id="section-3">
            <div class="container">
                <?php if (get_field('title_agenda')): ?>
                    <h2 class="text-secondary">
                        <?php echo get_field('title_agenda'); ?>
                    </h2>
                <?php endif; ?>

                <?php
                $agenda = get_field('agenda');
                ?>

                <div class="accordion pt-3 pt-lg-4" id="accordionExample">
                    <?php
                    foreach ($agenda as $i):
                        ?>
                        <div class="accordion-item mb-1">
                            <div class="accordion__header" id="heading-<?php echo $index; ?>">
                                <button class="p-3 text-left <?php if ($i['content']) {
                                    echo 'accordion-hover';
                                } ?>" type="button" data-toggle="collapse"
                                    data-target="#collapse-<?php echo $index; ?>" aria-expanded="true"
                                    aria-controls="collapse-<?php echo $index; ?>">
                                    <div class="row">
                                        <div class="col-7 col-lg-8">
                                            <div class="title">

                                                <span class="icon">
                                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.12756 16L0 8.00017L8.12756 0L16.2535 8.00017L8.12756 16Z"
                                                            fill="#2E5288" />
                                                    </svg>
                                                </span>

                                                <div class="text editor">
                                                    <?php echo $i['title']; ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-5 col-lg-4">
                                            <div class="time">
                                                <div class="text">
                                                    <?php echo $i['time']; ?>
                                                </div>

                                                <span class="icon">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.99163 1.66666C5.39163 1.66666 1.66663 5.39999 1.66663 9.99999C1.66663 14.6 5.39163 18.3333 9.99163 18.3333C14.6 18.3333 18.3333 14.6 18.3333 9.99999C18.3333 5.39999 14.6 1.66666 9.99163 1.66666ZM9.99996 16.6667C6.31663 16.6667 3.33329 13.6833 3.33329 9.99999C3.33329 6.31666 6.31663 3.33332 9.99996 3.33332C13.6833 3.33332 16.6666 6.31666 16.6666 9.99999C16.6666 13.6833 13.6833 16.6667 9.99996 16.6667Z"
                                                            fill="#A6A6A6" />
                                                        <path
                                                            d="M10.4166 5.83334H9.16663V10.8333L13.5416 13.4583L14.1666 12.4333L10.4166 10.2083V5.83334Z"
                                                            fill="#A6A6A6" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <?php if ($i['content']): ?>
                                <div id="collapse-<?php echo $index; ?>" class="collapse"
                                    aria-labelledby="heading-<?php echo $index; ?>" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <?php echo $i['content']; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                        $index++;
                    endforeach;
                    ?>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="hr"></div>
        </div>

        <?php
    endif;
    if ($show_booth_layout == '1'):
        ?>

        <section class="booth_layout py-4 py-lg-5" id="section-4">
            <div class="container">
                <?php if (get_field('title_booth_layout')): ?>
                    <h2 class="text-secondary">
                        <?php echo get_field('title_booth_layout'); ?>
                    </h2>
                <?php endif; ?>

                <div class="image pt-3 pt-lg-4">
                    <img src="<?php echo get_field('image_booth_layout'); ?>" alt="booth_layout">
                </div>
            </div>
        </section>

        <div class="container">
            <div class="hr"></div>
        </div>

        <?php
    endif;
    if ($show_contact_us == '1'):
        ?>

        <section class="contact-us py-4 py-lg-5" id="section-5">
            <div class="container">
                <?php if (get_field('title_contact_us')): ?>
                    <h2 class="text-secondary">
                        <?php echo get_field('title_contact_us'); ?>
                    </h2>
                <?php endif; ?>

                <?php
                $contact_us = get_field('contact_us');
                ?>
                <div class="contact-list pt-3 pt-lg-4">
                    <div class="row">
                        <?php
                        foreach ($contact_us as $i):
                            ?>
                            <div class="col-12 col-lg-6 mb-3">
                                <h3 class="h3">
                                    <?php echo $i['title'] ?>
                                </h3>
                                <div class="content post-detail editor">
                                    <?php echo $i['content'] ?>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
    endif;
    ?>


</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="height:20px;"></h5>
                <button style="outline:none;border:none;" type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body content post-detail editor">

            </div>
        </div>
    </div>
</div>


<?php
get_footer();
?>

<script>
    $(document).ready(function () {
        $('.modal-click').on('click', function () {
            let str_content = $(this).find('span.organization-content').html();
            $('.modal').find('.modal-body').html(str_content);
        });

        $('.btn-vin').click(function () {
            let id = '#' + $(this).attr('data-id');

            $('html, body').animate({
                scrollTop: $(id).offset().top - 40
            }, 1000);
        });

        if ($(window).width() > 992) {
            $.each($('.button > .button-click'), function () {
                let w = $(this).find('a').width();
                if (w > 230) {
                    $('.button .button-click').css('margin', '0px 20px');
                    $('.button .button-click > a').css('padding', '0px 15px');
                }
            });
        }
    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap');

    .hr {
        border-bottom-width: 1px;
        border-bottom-style: solid;
        border-color: #6b6b6b;
    }

    .flip-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .banner img {
        width: 100%;
        height: auto;
    }

    .text-secondary {
        text-transform: uppercase;
        color: #2e5288 !important;
        font-weight: 700;
    }

    .contact-us h3 {
        font-weight: 700;
    }

    #countdown .wrapper {
        text-align: center;
        color: #6b6b6b;
    }

    #countdown .wrapper .time {
        font-family: 'Merriweather', serif;
        font-size: 85px;
        font-weight: 300;
        display: block;
        line-height: 1;
        white-space: nowrap;
    }

    #countdown .wrapper span {
        display: block;
    }

    #countdown .wrapper span:last-child {
        font-size: 18px;
        display: block;
        margin-top: 10px;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-family: 'Merriweather', serif;
    }

    .button .button-click a {
        padding: 0px 20px;
        font-size: 14px !important;
    }

    .participation-number .item {
        text-align: center;
    }

    .participation-number .number {
        font-size: 59px;
        line-height: 1;
    }

    .participation-number .title {
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 400;
    }

    .organization .item {
        height: 100%;
    }

    .organization .item img {
        width: 100%;
        height: auto;
    }

    .organization .item .logo {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .organization .item .modal-click {
        outline: none;
        border: none;
        background: #FFFFFF;
        height: 100%;
        display: block;
    }

    .accordion-item button {
        width: 100%;
        outline: none;
        border: none;
        background-color: #f5f4f4 !important;
        cursor: default !important;
        border: 1px solid #f5f4f4;
        transition: all 0.4s;
    }

    .accordion-item .time {
        font-weight: 700;
        color: #2e5288;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .accordion-item .time span {
        padding-left: 12px;
    }

    .accordion-item .time .text {
        text-align: end;
    }

    .accordion-item .title {
        display: flex;
        align-items: center;
    }

    .accordion-item .title span {
        padding-right: 12px;
    }

    .accordion-hover:hover {
        border: 1px solid #2e5288 !important;
        background-color: #FFFFFF !important;
    }

    .booth_layout .image {
        overflow: hidden;
        transition: all 1s;
    }

    .booth_layout .image img {
        transform: scale(1);
        transition: all 1s;
    }

    .booth_layout .image:hover img {
        transform: scale(1.2);
        transition: all 1s;
    }

    .contact-us .contact-list h3 {
        color: #2e5288;
    }

    .accordion {
        border-bottom: none;
    }

    .js-slidein {
        opacity: 0;
        transform: translateY(100px);
        -webkit-transition: all 1s ease-in-out;
        transition: all 1s ease-in-out;
    }

    .js-slidein-visible {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }

    @media (min-width: 992px) {

        <?php
        if ($count_show == 6):
            ?>
            .button {
                width: 950px;
            }

            <?php
        endif;
        ?>
        .button .button-click {
            margin: 0px 30px;
            margin-bottom: 30px !important;
        }

        .modal-dialog {
            max-width: 794px;
        }
    }
</style>