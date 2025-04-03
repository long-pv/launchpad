<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package clvinuni
 */

get_header();
?>
<?php
// get values
$date_post  = get_the_date('j M Y');
$deadline_date = get_field('recruitment_job_deadline') ?? null;
$deadline_date = custom_convert_time($deadline_date,'j M Y');
if(LANG == 'vi'){
    $date_post = custom_convert_time($date_post,'d/m/Y');
    $deadline_date = custom_convert_time($deadline_date,'d/m/Y');
}
$salary = get_field('recruitment_job_salary') ?? null;
$recruitment_job_apply = get_field('recruitment_job_apply') ?? '';
$show_btn = $recruitment_job_apply['show'] ?? false;
$redirect_link = $recruitment_job_apply['redirect_link'] ?? '';
$location = get_the_terms(get_the_ID(), 'job_location') ?? [];
$employment_type = get_the_terms(get_the_ID(), 'employment_type') ?? [];
$job_division = get_the_terms(get_the_ID(), 'job_division') ?? [];
$devision = "";
if($job_division){
    foreach($job_division as $i => $item){
        $devision = ($item ? $item->name : '');
        if($item->parent != 0){
            $devision_parent = get_term($item->parent,'job_division')->name;
            $devision = $devision_parent . ' - ' . ($item ? $item->name : '');
        }
    }
}
$classCol = $show_btn ? 'col-md-9 col-lg-10' : 'col-12';
$link = [
    'url' => $redirect_link,
    'target' => '_blank',
    'title' => 'Apply'
];
?>
<section class="recruitment space">
    <div class="container">
        <div class="recruitment__heading">
            <div class="row align-items-center no-gutters">
                <div class=" <?php echo $classCol; ?>">
                    <h1 class="h2 recruitment__title">
                        <?php the_title(); ?>
                    </h1>
                </div>
                <?php if ($show_btn) : ?>
                    <div class="col-md-3 col-lg-2 d-none d-md-block">
                        <div class="recruitment__btnWrap">
                            <?php echo custom_btn_link($link, 'btnCTA'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mt-4 mt-xl-5">
                <h2 class="h3 recruitment__subTitle" data-mh="recruitment__subTitle"><?php _e('Date posted', 'clvinuni'); ?></h2>
                <p class="recruitment__text" data-mh="recruitment__text"><?php echo $date_post; ?></p>
            </div>
            <div class="col-lg-3 mt-4 mt-xl-5">
                <h2 class="h3 recruitment__subTitle" data-mh="recruitment__subTitle"><?php _e('Deadline', 'clvinuni'); ?></h2>
                <p class="recruitment__text" data-mh="recruitment__text"><?php echo $deadline_date; ?></p>
            </div>
            <div class="col-lg-6 mt-4 mt-xl-5">
                <h2 class="h3 recruitment__subTitle" data-mh="recruitment__subTitle"><?php _e('Salary', 'clvinuni'); ?></h2>
                <p class="recruitment__text" data-mh="recruitment__text"><?php echo $salary; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mt-4 mt-xl-5">
                <h2 class="h3 recruitment__subTitle" data-mh="recruitment__subTitle"><?php _e('Employment type', 'clvinuni'); ?></h2>
                <p class="recruitment__text" data-mh="recruitment__text"><?php echo $employment_type ? $employment_type[0]->name : ''; ?></p>
            </div>
            <div class="col-lg-3 mt-4 mt-xl-5">
                <h2 class="h3 recruitment__subTitle" data-mh="recruitment__subTitle"><?php _e('Location', 'clvinuni'); ?></h2>
                <p class="recruitment__text" data-mh="recruitment__text"><?php echo $location ? $location[0]->name : ''; ?></p>
            </div>
            <div class="col-lg-6 mt-4 mt-xl-5">
                <h2 class="h3 recruitment__subTitle" data-mh="recruitment__subTitle"><?php _e('Division', 'clvinuni'); ?></h2>
                <p class="recruitment__text" data-mh="recruitment__text"><?php echo $devision; ?></p>
            </div>
        </div>
        <?php if ($show_btn) : ?>
            <div class="row d-md-none mt-5 no-gutters">
                <div class="col-5 col-md-3 col-lg-2">
                    <div class="recruitment__btnWrap">
                        <?php echo custom_btn_link($link, 'btnCTA'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- content -->
<section class="spaceContent space--bottom">
    <div class="container">
        <div class="editor mt-4 recruitment__content">
            <?php the_content(); ?>
        </div>
        <?php if ($show_btn) : ?>
            <div class="row justify-content-center justify-content-md-start no-gutters mt-5">
                <div class="col-5 col-md-3 col-lg-2">
                    <?php echo custom_btn_link($link, 'btnCTA'); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
