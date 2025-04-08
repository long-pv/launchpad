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
<section class="secSpace">
    <div class="container">
        <div class="text-center m-4" style="font-weight: 700;">
            BANNER
        </div>

        <div class="banner">
            <div class="banner__content">
                <div class="banner__social">
                    <a href="#" class="banner__social-icon banner__social-icon--facebook"></a>
                    <a href="#" class="banner__social-icon banner__social-icon--youtube"></a>
                    <a href="#" class="banner__social-icon banner__social-icon--telegram"></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery -->

<!-- Table -->
<section class="secSpace">
    <div class="container">
        <div class="text-center m-4" style="font-weight: 700;">
            TABLE
        </div>

        <table class="table_info">
            <thead>
                <th>Program</th>
                <th>Per Semester</th>
                <th>Per Year</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2</td>
                    <td>2</td>
                </tr>
            </tbody>

        </table>
    </div>
</section>

<!-- Tabs -->
<section class="secSpace navItem">
    <div class="container">
        <div class="p-3 shadow">
            <h2 class="text-center p-3">Card with Tabs</h2>
            <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <p><strong>This is some placeholder content the Home tab's associated content.</strong>
                        Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript
                        swaps
                        classes to control the content visibility and styling. You can use it with tabs, pills, and any
                        other <code>.nav</code>-powered navigation.</p>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <p><strong>This is some placeholder content the Profile tab's associated content.</strong>
                        Clicking another tab will toggle the visibility of this one for the next.
                        The tab JavaScript swaps classes to control the content visibility and styling. You can use it
                        with
                        tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <p><strong>This is some placeholder content the Contact tab's associated content.</strong>
                        Clicking another tab will toggle the visibility of this one for the next.
                        The tab JavaScript swaps classes to control the content visibility and styling. You can use it
                        with
                        tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form Search -->
<section class="secSpace">
    <div class="container">
        <div class="inner_form">
            <div class="text-center m-4" style="font-weight: 700;">
                FORM SEARCH
            </div>

            <form action="#" class="form_search">
                <input type="text" name="s" id="search__input" placeholder="Enter the keywords">
                <button class="styled-link" type="submit"></button>
            </form>
        </div>

    </div>
</section>



<?php
// footer template
get_footer();
