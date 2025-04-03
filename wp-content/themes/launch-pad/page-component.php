<?php

/**
 * Template Name: Component
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package launch-pad
 */

// header template
get_header();
?>

<!-- Hand Book -->
<section class="secSpace">
    <div class="container">
        <div class="row">
            <div class="text-center m-4" style="font-weight: 700;">
                HAND BOOK
            </div>
            <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="col-lg-3">
                    <div class="handbook">
                        <a href="#" class="handbook__image">
                            <img src="https://ocafe.net/wp-content/uploads/2024/10/anh-nen-may-tinh-4k-1.jpg"
                                alt="International Student Handbook">
                        </a>
                        <a href="#" class="handbook__link">
                            <h3 class="handbook__title">International Student Handbook</h3>
                        </a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Button Style -->
<section class="secSpace">
    <div class="container">

        <div class="text-center m-4" style="font-weight: 700;">
            BUTTON
        </div>
        <!-- style 1 -->
        <button type="button" class="read_more">Read more</button>

        <!-- style 2 -->
        <button type="button" class="button_1">Read more</button>

        <!-- style 3 -->
        <button type="button" class="button_1 button_1__active">Read more</button>

    </div>
</section>

<!-- Banner -->
<div class="banner">
    <div class="banner__content">
        <div class="banner__social">
            <a href="#" class="banner__social-icon banner__social-icon--facebook"></a>
            <a href="#" class="banner__social-icon banner__social-icon--youtube"></a>
            <a href="#" class="banner__social-icon banner__social-icon--telegram"></a>
        </div>
    </div>
</div>


<?php
// footer template
get_footer();
