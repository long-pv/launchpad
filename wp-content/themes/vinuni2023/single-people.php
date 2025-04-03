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

<div class="leaderDetail">
    <div class="container">
        <div class="breadcrumbsBlock">
            <?php wp_breadcrumbs(); ?>
        </div>
    </div>
    <div class="leaderDetail__bg">
        <div class="container">
            <div class="row leaderDetail__gutters">
                <?php if (get_the_post_thumbnail_url()): ?>
                    <div class="col-lg-4">
                        <div class="leaderDetail__imgWrap">
                            <div class="imgGroup imgGroup--noEffect leaderDetail__img">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="<?php echo get_the_post_thumbnail_url() ? 'col-lg-8' : 'col-12'; ?>">
                    <div class="leaderDetail__content">

                        <h1 class="h3 leaderDetail__title">
                            <?php the_name_people(get_the_ID()); ?>
                        </h1>

                        <?php
                        $position = get_position_people_single(get_the_ID());
                        if ($position):
                            echo $position;
                        else:
                            $position = get_field('position') ?? null;
                            if ($position):
                                ?>
                                <h3 class="h6 leaderDetail__position">
                                    <?php echo custom_text_people($position); ?>
                                </h3>
                                <?php
                            endif;
                            $academic_name = get_academic_people(get_the_ID());
                            if ($academic_name):
                                ?>
                                <div class="h6 leaderDetail__position">
                                    <?php echo $academic_name; ?>
                                </div>
                                <?php
                            endif;
                        endif;
                        ?>

                        <?php
                        $email = get_field('email') ?? null;
                        if ($email):
                            ?>
                            <div class="leaderDetail__email mt-3">
                                <?php _e(' Email:', 'clvinuni'); ?>
                                <a href="mailto:<?php echo $email; ?>">
                                    <?php echo $email; ?>
                                </a>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="secSpace">
        <div class="container">
            <?php
            if (get_field('biography')):
                ?>
                <div class="leaderDetail__biography">
                    <h2 class="secTitle secHeading__title">
                        <?php _e('Biography', 'clvinuni'); ?>
                    </h2>
                    <div class="editor">
                        <?php
                        the_field('biography');
                        ?>
                    </div>
                </div>
                <?php
            else:
                if (get_the_content()):
                    ?>
                    <div class="editor mb-4">
                        <?php
                        the_content();
                        ?>
                    </div>
                    <?php
                endif;
            endif;
            ?>

            <?php
            $arr_field = [
                'research_interests' => __('Research Interests', 'clvinuni'),
                'professional_interests' => __('Professional interests', 'clvinuni'),
                'teaching_interests' => __('Teaching Interests', 'clvinuni'),
                'selected_publications' => __('Selected Publications', 'clvinuni'),
                'education' => __('Education', 'clvinuni'),
                'selected_awards_honors' => __('Selected Awards & Honors', 'clvinuni'),
                'related_websites' => __('Related websites', 'clvinuni'),
                'other_activities' => __('Other Activities', 'clvinuni'),
            ];
            ?>
            <div class="faqs faqs--people">
                <div class="faqs__inner">
                    <div class="accordion" id="accordionFAQs">
                        <?php
                        foreach ($arr_field as $key => $field):
                            $content = get_field($key);
                            if ($content):
                                ?>
                                <div class="faqs__item">
                                    <div class="faqs__header" id="accordionHeader--<?php echo $key; ?>">
                                        <h3 class="faqs__title">
                                            <button class="faqs__btn btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapse--<?php echo $key; ?>"
                                                aria-expanded="false" aria-controls="collapse--<?php echo $key; ?>">
                                                <?php echo $field; ?>
                                            </button>
                                        </h3>
                                    </div>

                                    <div id="collapse--<?php echo $key; ?>" class="collapse"
                                        aria-labelledby="accordionHeader--<?php echo $key; ?>" data-parent="#accordionFAQs">
                                        <div class="faqs__body editor">
                                            <?php echo $content; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
get_footer();
