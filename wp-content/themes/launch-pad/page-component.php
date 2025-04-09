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

<!-- Accordion -->
<section class="secSapce">
    <div class="container-accordion">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What does Vinuni look for in its first-year applicants?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in felis dignissim, imperdiet
                        nulla
                        vitae, condimentum nulla. Ut scelerisque a nisl sit amet facilisis. Etiam blandit iaculis
                        tellus, vitae
                        condimentum leo congue a. Vivamus in vehicula massa. Pellentesque libero libero, commodo lacinia
                        volutpat non, tincidunt at lectus. Maecenas ipsum turpis, viverra vitae lacus eu, fringilla
                        ultricies
                        erat. Aenean hendrerit maximus sodales.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Item #2
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Quisque sapien augue, ornare id leo a, tristique elementum justo. Praesent non nulla sagittis,
                        sollicitudin justo id, varius erat. Nunc sed pharetra nisl. Cras et suscipit felis, in lacinia
                        sapien.
                        Integer venenatis sagittis massa, eu eleifend nibh venenatis in. Pellentesque a aliquet urna.
                        Curabitur
                        tortor metus, ultrices sed mi at, sagittis imperdiet turpis. Suspendisse nec luctus nunc. Fusce
                        in arcu
                        quis lacus mollis ultrices.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Item #3
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Praesent nec ipsum scelerisque dui condimentum pellentesque eu at lectus. Vivamus purus purus,
                        bibendum
                        in vestibulum ac, pharetra sit amet sapien. Nunc luctus, orci vel luctus cursus, nibh nisl
                        ullamcorper
                        ipsum, eu malesuada arcu augue id nisi. In auctor mi ac ante tincidunt tincidunt.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Card Club -->
<section class="secSpace">
    <div class="container">
        <div class="card_club__inner">
            <div class="card_club">
                <div class="row">
                    <div class="col-4">
                        <div class="card_club__image-wrapper">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/club-img.png'; ?>"
                                alt="Vinista Club Logo" class="card_club__image" />
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card_club__content">
                            <p class="card_club__description">
                                Vinista is a fashion club that is eager to create an environment that encourages
                                students to
                                express and implement their creative ideas freely. At Vinista, we cultivate a strong
                                sense
                                of an
                                inclusive community that appreciates the diversity of styles, cultures, and perspectives
                                within
                                the realm of fashion.
                            </p>
                            <div class="card_club__contact">
                                <h3 class="card_club__contact_title">Contact information</h3>
                                <ul class="card_club__contact_list">
                                    <li><span class="card_club__contact_list--desc">Phone:</span> <span
                                            class="card_club__contact_list--phone">+84919.009.589</span></li>
                                    <li><span class="card_club__contact_list--desc">Email:</span> <span
                                            class="card_club__contact_list--mail">vinista@vinuni.edu.vn</span></li>
                                    <li><span class="card_club__contact_list--desc">Facebook:</span> <a
                                            href="https://facebook.com"
                                            class="card_club__contact_list--facebook">https://facebook.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- List Post -->
<section class="secSpace">
    <div class="card_club__inner">
        <div class="list_post">
            <p class="list_post__title">
                Search result for <span class="list_post__keyword">Associations</span>
            </p>
            <ul class="list_post__list">
                <li class="list_post__item">
                    <h3 class="list_post__heading">Clubs & Associations</h3>
                    <p class="list_post__description">
                        University clubs are student organizations that promote social interaction, skill development,
                        and extracurricular activities across various interests. They enhance the campus experience and
                        foster connections among students.
                    </p>
                </li>
                <li class="list_post__item">
                    <h3 class="list_post__heading">Clubs & Associations</h3>
                    <p class="list_post__description">
                        University clubs are student organizations that promote social interaction, skill development,
                        and extracurricular activities across various interests. They enhance the campus experience and
                        foster connections among students.
                    </p>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- List Mark -->
<section class="secSpace">
    <div class="card_club__inner">
        <div class="list_mark">
            <p class="list_mark__intro">All your bookmarks are listed here:</p>

            <div class="list_mark__item">
                <div class="list_mark__content">
                    <span class="list_mark__index">1.</span>
                    <span class="list_mark__title">Clubs & Associations</span>
                </div>
                <div class="list_mark__actions">
                    <a href="#" class="list_mark__action list_mark__action--visit">Visit</a>
                    <a href="#" class="list_mark__action list_mark__action--remove">Remove</a>
                </div>
            </div>

            <div class="list_mark__item">
                <div class="list_mark__content">
                    <span class="list_mark__index">2</span>
                    <span class="list_mark__title">OASIS Program</span>
                </div>
                <div class="list_mark__actions">
                    <a href="#" class="list_mark__action list_mark__action--visit">Visit</a>
                    <a href="#" class="list_mark__action list_mark__action--remove">Remove</a>
                </div>
            </div>

            <!-- Add more list_mark__item here -->
        </div>
    </div>
</section>

<!-- ACF  -->
<?php
$page_main = get_field('page_main') ?? '';
var_dump($page_main);
?>

<?php
// footer template
get_footer();
