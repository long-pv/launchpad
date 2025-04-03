<?php
$deadline_date = get_field('recruitment_job_deadline') ?? null;
$deadline_date = custom_convert_time($deadline_date,'j M Y');
if(LANG == 'vi'){
    $deadline_date = custom_convert_time($deadline_date,'d/m/Y');
}
if ($deadline_date && get_the_title()):
    ?>
    <div class="jobsItem">
        <div class="row jobsItem__inner">
            <div class="col-lg-7">
                <h3 class="jobsItem__title">
                    <a class="jobsItem__link" href="<?php echo get_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
            </div>
            <div class="col-5 col-md-3 col-lg-3">
                <div class="jobsItem__deadline">
                    <?php echo $deadline_date; ?>
                </div>
            </div>
            <div class="col-7 col-md-9 col-lg-2">
                <div class="jobsItem__btnWrap">
                    <a href="<?php echo get_permalink(); ?>" class="btnSeeMore btnCTA jobsItem__btn">
                        <?php _e('View detail', 'clvinuni'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>