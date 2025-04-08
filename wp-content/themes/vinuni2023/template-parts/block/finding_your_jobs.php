<?php
// get values
$block_info = $args['flexible']['block_info'] ?? [];
$page_results = $args['flexible']['block_content']['page_results'] ?? '';
$arr_tax = [
    [
        'job_division',
        __('Job Division', 'clvinuni'),
        __('All Job Division', 'clvinuni')
    ],
    [
        'job_location',
        __('location', 'clvinuni'),
        __('All Location', 'clvinuni')
    ]
];
?>
<div class="findJobs space" data-url="<?php echo $page_results; ?>">
    <div class="container">
        <?php echo block_info($block_info); ?>
        <div class="findJobs__inner wow fadeInUp" data-wow-duration="2s">
            <div class="row no-gutters">
                <?php foreach ($arr_tax as $i => $item): 
                    $colClass = $i == 0 ? 'col-lg-5' : 'col-lg-3';   
                ?>
                    <div class="<?php echo $colClass; ?> findJobs__item">
                        <?php echo generate_select_options_with_tax($item[0], $item[1], $item[2]); ?>
                    </div>
                <?php endforeach; ?>
                <div class="col-lg-4 findJobs__btnWrap">
                    <a class="btnSearch btnSeeMore btnCTA findJobs__btn"><span>
                            <?php _e('Filter', 'clvinuni'); ?>
                        </span></a>
                </div>
            </div>
        </div>
    </div>
</div>