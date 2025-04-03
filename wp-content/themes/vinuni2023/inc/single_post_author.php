<?php
function accordion_author_post($authors = [])
{
    // switch_to_blog(get_main_site_id());
    $authors = (array) $authors;
    if ($authors):
        foreach ($authors as $author):
            ?>
            <div class="postContent__authorItem">
                <div class="row">
                    <?php if (get_the_post_thumbnail_url($author)): ?>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <div class="">
                                <div class="imgGroup imgGroup--noEffect leaderDetail__img">
                                    <img src="<?php echo get_the_post_thumbnail_url($author); ?>" alt="<?php the_title($author); ?>">
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="<?php echo get_the_post_thumbnail_url($author) ? 'col-lg-8' : 'col-12'; ?>">
                        <div class="">

                            <h3 class="h3 leaderDetail__title">
                                <a href="<?php echo get_permalink($author); ?>">
                                    <?php the_name_people($author); ?>
                                </a>
                            </h3>

                            <?php
                            $position = get_position_people_single($author);
                            if ($position):
                                echo $position;
                            endif;
                            ?>

                            <?php
                            $email = get_field('email', $author) ?? null;
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

                <?php
                $data_author = get_post($author);
                if (get_field('biography', $author)):
                    ?>
                    <div class="postContent__authorBio">
                        <div class="editor">
                            <?php
                            the_field('biography', $author);
                            ?>
                        </div>
                    </div>
                    <?php
                elseif ($data_author->post_content):
                    ?>
                    <div class="postContent__authorBio">
                        <div class="editor">
                            <?php echo $data_author->post_content; ?>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
            <?php
        endforeach;
    endif;
    // restore_current_blog();
}


function by_author_post($authors = [])
{
    // switch_to_blog(get_main_site_id());
    $authors = (array) $authors;
    if ($authors):
        $html_author = [];
        foreach ($authors as $author) {
            $html_author[] = '<a href="' . get_permalink($author) . '">' . get_name_people($author) . '</a>';
        }
        $html_author = implode(' | ', $html_author);
        ?>
        <div class="postContent__authorBy">
            <span>By: </span><?php echo $html_author; ?>
        </div>
        <?php
    endif;
    // restore_current_blog();
}
