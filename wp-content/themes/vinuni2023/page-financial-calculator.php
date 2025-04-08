<?php
/**
 * Template Name: Financial Calculator
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package clvinuni
 */
get_header();
?>

<h1 class="pageTitle">
    <?php the_title(); ?>
</h1>

<div class="pageArticle space--bottom">
    <div class="container">
        <div class="breadcrumbsBlock">
            <?php wp_breadcrumbs(); ?>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <?php get_template_part('template-parts/block/sidebar_menu'); ?>
            </div>
            <div class="col-lg-8 pageArticle__content">
                <div class="financialCalculator">
                    <section class="ask-question space">
                        <div class="page-block post-detail">
                            <img loading="lazy" class="alignnone wp-image-8449 size-full mb-4"
                                src="https://vinuni.edu.vn/wp-content/uploads/2021/05/calculator.jpg"
                                style="width: 100%">

                            <div style="font-size: 1em">
                                <h3><span style="color: #CD3B3F"><strong>
                                            <?php _e('Cost of Attendance for First Year Student', 'clvinuni'); ?>
                                        </strong></span></h3>
                                <p>
                                    <?php _e('The Financial Calculator is designed with the aim of providing the quickest and most convenient tool for First Year Students to calculate their total expenses during their first year of study. You can customize it based on your Major; Term (semester or academic year); and Expected Scholarship/ Financial Aid Offered.', 'clvinuni'); ?>
                                </p>
                                <p>
                                    <?php _e('The Total expenses are classified into 2 categories: Fixed fees (including Tuition Fees, Accommodation) and Variable expenses. You can adjust the Variable expenses based on your personal needs.', 'clvinuni'); ?>
                                </p>
                                <p>
                                    <?php _e('Detailed description of each item is provided below.', 'clvinuni'); ?>
                                </p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <?php _e('Major', 'clvinuni'); ?>
                                </div>
                                <div class="col-md-9">
                                    <select id="major" class="major_element pull-right" style="max-width: 75%">
                                        <option selected style=" text-align-last: center"></option>
                                        <option value="CS">
                                            <?php _e('Bachelor of Computer Science', 'clvinuni'); ?>
                                        </option>
                                        <option value="EE">
                                            <?php _e('Bachelor of Electrical Engineering', 'clvinuni'); ?>
                                        </option>
                                        <option value="ME">
                                            <?php _e('Bachelor of Mechanical Engineering', 'clvinuni'); ?>
                                        </option>
                                        <option value="BA">
                                            <?php _e('Bachelor of Business Administration', 'clvinuni'); ?>
                                        </option>
                                        <option value="HM">
                                            <?php _e('Bachelor of Hospitality Management', 'clvinuni'); ?>
                                        </option>
                                        <option value="NR">
                                            <?php _e('Bachelor of Nursing', 'clvinuni'); ?>
                                        </option>
                                        <option value="MD">
                                            <?php _e('Medical Doctor Program', 'clvinuni'); ?>
                                        </option>
                                    </select>
                                    <a id="hide1" class="pull-right"
                                        style="position: absolute; display: none; color: red"><i>*
                                            <?php _e('Please select this field', 'clvinuni'); ?>
                                        </i></a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <?php _e('Term', 'clvinuni'); ?>
                                </div>
                                <div class="col-md-9">
                                    <select id="term" class="pull-right" style="max-width: 30%">
                                        <option value="sem" selected>
                                            <?php _e('Semester', 'clvinuni'); ?>
                                        </option>
                                        <option value="year">
                                            <?php _e('Year', 'clvinuni'); ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <?php _e('Expected Scholarship / Financial Aid Offered', 'clvinuni'); ?>
                                </div>
                                <div class="col-md-9">
                                    <select id="saving" class="pull-right" style="max-width: 50%">
                                        <option value="35" selected>35%
                                            <?php _e('Financial Aid', 'clvinuni'); ?>
                                        </option>
                                        <option value="50">50%
                                            <?php _e('Financial Aid', 'clvinuni'); ?>
                                        </option>
                                        <option value="60">60%
                                            <?php _e('Financial Aid', 'clvinuni'); ?>
                                        </option>
                                        <option value="65" class="nr">65%
                                            <?php _e('Financial Aid', 'clvinuni'); ?>
                                        </option>
                                        <option value="70">70%
                                            <?php _e('Financial Aid', 'clvinuni'); ?>
                                        </option>
                                        <option value="75" class="nr">75%
                                            <?php _e('Financial Aid', 'clvinuni'); ?>
                                        </option>
                                        <option value="80">80%
                                            <?php _e('Financial Aid', 'clvinuni'); ?>
                                        </option>
                                        <option value="85" class="nr">85%
                                            <?php _e('Financial Aid', 'clvinuni'); ?>
                                        </option>
                                        <option value="90">90%
                                            <?php _e('Scholarship', 'clvinuni'); ?>
                                        </option>
                                        <option value="100">100%
                                            <?php _e('Scholarship', 'clvinuni'); ?>
                                        </option>
                                        <option value="Full">
                                            <?php _e('Full Scholarship', 'clvinuni'); ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <?php _e('Currency', 'clvinuni'); ?>
                                </div>
                                <div class="col-md-9">
                                    <select id="currency" class="pull-right" style="max-width: 20%">
                                        <option value="VND" selected>VND</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>


                            <table class="table border-primary" style="width: 100%;font-size: 1em">
                                <TR class="text-center" style="background-color:#2d5088">
                                    <TD style="color: white;  width: 25%"><strong>
                                            <?php _e('Expenditure', 'clvinuni'); ?>
                                        </strong></TD>
                                    <TD style="color: white; width: 60%"><strong>
                                            <?php _e('Cost', 'clvinuni'); ?>
                                        </strong></TD>
                                    <TD style="color: white; width: 15%"><strong>
                                            <?php _e('Term', 'clvinuni'); ?>
                                        </strong></TD>
                                </TR>
                                <TR>
                                    <TD class="text-center"><strong>
                                            <?php _e('Tuition Fees', 'clvinuni'); ?>
                                        </strong>
                                        <p class="fa fa-info-circle details1" style="position: relative; top: -7px">
                                            <span style="text-align: justify">
                                                <?php _e('The tuition fees include all academic expenses such as teaching, research, internships, clinical practice, industry-immersion semester, and regular campus educational activities.', 'clvinuni'); ?>
                                            </span>
                                        </p>
                                    </TD>
                                    <TD class="text-center">
                                        <div class="major_tuition"></div>
                                    </TD>
                                    <TD class="text-center">
                                        <div class="term">
                                            <?php _e('Semester', 'clvinuni'); ?>
                                        </div>
                                    </TD>


                                </TR>
                                <TR>
                                    <TD class="text-center"><strong>
                                            <?php _e('Accommodation', 'clvinuni'); ?>
                                        </strong><i class="fa fa-info-circle details2"
                                            style="position: relative; top: -7px"><span style="text-align: justify">
                                                <?php _e('The accommodation fees include dormitory facilities, internet, common restroom area, technical fee, parking, electricity and water. First-year students are required to stay in the VinUni\'s dormitory.', 'clvinuni'); ?>
                                            </span></i></TD>
                                    <TD class="text-center">
                                        <div class="saving_amount">15,000,000</div>
                                    </TD>
                                    <TD class="text-center">
                                        <div class="term1">
                                            <?php _e('Semester', 'clvinuni'); ?>
                                        </div>
                                    </TD>


                                </TR>
                                <TR class="text-center">
                                    <TD><strong>
                                            <?php _e('Food', 'clvinuni'); ?>
                                        </strong><i class="fa fa-info-circle details2"
                                            style="position: relative; top: -7px"><span style="text-align: justify">
                                                <p>
                                                    <?php _e('The food fees depend on individual\'s need. For references, each meal at VinUni\'s canteen cost 35,000 VND (~1.5 USD).', 'clvinuni'); ?>
                                                </p>
                                            </span></i></TD>
                                    <TD>
                                        <div class="range-wrap">
                                            <div class="range-value" id="range1"></div>
                                            <input id="range01" type="range" min="3000000" max="20000000"
                                                value="3000000" step="100000" style="position:absolute; left: 9%">
                                        </div>
                                    </TD>
                                    <TD class="text-center">
                                        <?php _e('Month', 'clvinuni'); ?>
                                    </TD>
                                </TR>


                                <TR class="text-center">
                                    <TD><strong>
                                            <?php _e('Personal Care', 'clvinuni'); ?>
                                        </strong><i class="fa fa-info-circle details2"
                                            style="position: relative; top: -7px"><span style="text-align: justify">
                                                <?php _e('Personal care includes hygiene products and laundry supplies. We recommend the fees for personal care range from 1,000,000 to 2,000,000 VND (~45 to 90 USD).', 'clvinuni'); ?>
                                            </span></i></TD>
                                    <TD>
                                        <div class="range-wrap">
                                            <div class="range-value" id="range2"></div>
                                            <input id="range02" type="range" min="500000" max="20000000" value="500000"
                                                step="100000" style="position:absolute; left: 9%">
                                        </div>
                                    </TD>
                                    <TD class="text-center">
                                        <?php _e('Month', 'clvinuni'); ?>
                                    </TD>

                                </TR>

                                <TR class="text-center">
                                    <TD><strong>
                                            <?php _e('Basic Shopping', 'clvinuni'); ?>
                                        </strong><i class="fa fa-info-circle details2"
                                            style="position: relative; top: -7px"><span style="text-align: justify">
                                                <?php _e('Basic shopping includes clothes, school supplies (books, learning tools). The costs for school supplies may vary depend on each course\'s requirements. We recommend the minimum budget of 1,000,000 VND (~45 USD).', 'clvinuni'); ?>
                                            </span></i></TD>
                                    <TD>
                                        <div class="range-wrap">
                                            <div class="range-value" id="range5"></div>
                                            <input id="range05" type="range" min="1000000" max="20000000"
                                                value="1000000" step="100000" style="position:absolute; left: 9%">
                                        </div>
                                    </TD>
                                    <TD class="text-center">
                                        <?php _e('Month', 'clvinuni'); ?>
                                    </TD>

                                </TR>

                                <TR class="text-center">
                                    <TD><strong>
                                            <?php _e('Social Activities', 'clvinuni'); ?>
                                        </strong><i class="fa fa-info-circle details2"
                                            style="position: relative; top: -7px"><span style="text-align: justify">
                                                <?php _e('Social activities can be described as meeting social, cultural, recreational, or welfare needs of college students. For example: Entertainment fee, club fee, ...', 'clvinuni'); ?>
                                            </span></i></TD>
                                    <TD>
                                        <div class="range-wrap">
                                            <div class="range-value" id="range3"></div>
                                            <input id="range03" type="range" min="1000000" max="20000000"
                                                value="1000000" step="100000" style="position:absolute; left: 9%">
                                        </div>
                                    </TD>
                                    <TD class="text-center">
                                        <?php _e('Month', 'clvinuni'); ?>
                                    </TD>
                                </TR>

                                <TR class="text-center">
                                    <TD><strong>
                                            <?php _e('Other', 'clvinuni'); ?>
                                        </strong></TD>
                                    <TD>
                                        <div class="range-wrap">
                                            <div class="range-value" id="range4"></div>
                                            <input id="range04" type="range" min="0" max="20000000" value="0"
                                                step="100000" style="position:absolute; top: -8%; left: 9%">
                                        </div>
                                    </TD>
                                    <TD class="text-center">
                                        <?php _e('Month', 'clvinuni'); ?>
                                    </TD>
                                </TR>

                            </table>
                            <p style="color: gray; font-size: 1.2em; line-height: 0.75em"><small><i>*
                                        <?php _e('The USD to VND conversion rate is 1 : 23,310.', 'clvinuni'); ?>
                                    </i></small></p>
                            <p style="color: gray; font-size: 1.2em; line-height: 0.75em"><small><i>*
                                        <?php _e('The above fees don\'t include one time purchase items such as laptop, computer, calculator,...', 'clvinuni'); ?>
                                    </i></small></p>
                            <p style="color: gray; font-size: 1.2em; ; line-height: 1em"><small><i>*
                                        <?php _e('The above fees don\'t include Health Insurance. Student without valid Health Insurance card will have to pay for the compulsory health insurance package during the period of study at the VinUniversity.', 'clvinuni'); ?>
                                    </i></small></p>
                            <p style="color: gray; font-size: 1.2em; margin-left: 5%; line-height: 1em">
                                <small><i>
                                        <?php _e('Compulsory health insurance fee for Vietnamese Students: 563,220 VND (~25 USD) per year', 'clvinuni'); ?>
                                    </i></small>
                            </p>
                            <p style="color: gray; font-size: 1.2em; margin-left: 5%; line-height: 1em">
                                <small><i>
                                        <?php _e('Compulsory health insurance fee for International Students: 5,700,000 VND (~245 USD) per year', 'clvinuni'); ?>
                                    </i></small>
                            </p>
                            <div class="text-center d-flex justify-content-center mt-4">
                                <a class="btnSeeMore btnCTA" style="max-width: 200px;" href="javascript:void()"
                                    role="button" onclick="showDiv()">
                                    <?php _e('Calculate', 'clvinuni'); ?>
                                </a>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div id="hide" style="display: none">
                                <h3><span style="color: #CD3B3F"><strong>
                                            <?php _e('Your Result', 'clvinuni'); ?>
                                        </strong></span></h3>

                                <table class="table border-primary"
                                    style="width:100%; margin-left:auto; font-size: 1em">
                                    <TR class="text-center" style="background-color:#2d5088;">
                                        <TD style="color: white; width: 34%"><strong>
                                                <?php _e('Expenditure', 'clvinuni'); ?>
                                            </strong></TD>
                                        <TD style="color: white" colspan="3"><strong>
                                                <?php _e('Cost', 'clvinuni'); ?>
                                            </strong></TD>
                                    </TR>
                                    <TR class="text-center">
                                        <TD></TD>
                                        <TD>
                                            <?php _e('Month', 'clvinuni'); ?>
                                        </TD>
                                        <TD>
                                            <?php _e('Semester', 'clvinuni'); ?>
                                        </TD>
                                        <TD>
                                            <?php _e('Year', 'clvinuni'); ?>
                                        </TD>
                                    </TR>
                                    <TR class="text-center">
                                        <TD>
                                            <div class="Vinuni_fee" style="font-weight: bold; display:inline"></div>
                                            <strong>
                                                <?php _e('Total Fee', 'clvinuni'); ?>
                                            </strong>
                                        </TD>
                                        <TD></TD>
                                        <TD>
                                            <div class="Vinuni_fee_sem"></div>
                                        </TD>
                                        <TD>
                                            <div class="Vinuni_fee_year"></div>
                                        </TD>
                                    </TR>
                                    <TR class="text-center">
                                        <TD>
                                            <div class="Sponsor_fee" style="font-weight: bold; display:inline"></div>
                                            <strong>
                                                <?php _e('Fee sponsored by VinUni', 'clvinuni'); ?>
                                            </strong>
                                        </TD>
                                        <TD></TD>
                                        <TD>
                                            <div class="sponsor_sem"></div>
                                        </TD>
                                        <TD>
                                            <div class="sponsor_year"></div>
                                        </TD>
                                    </TR>
                                    <TR class="text-center">
                                        <TD style="color: #CD3B3F"><strong>
                                                <?php _e('Family Contribution', 'clvinuni'); ?>
                                            </strong></TD>
                                        <TD></TD>
                                        <TD>
                                            <div class="total_living_sem"></div>
                                        </TD>
                                        <TD>
                                            <div class="total_living_year"></div>
                                        </TD>
                                    </TR>
                                    <TR class="text-center" style="font-size: 0.9em">
                                        <TD><strong>
                                                <?php _e('Fixed Expenses', 'clvinuni'); ?>
                                            </strong><i class="fa fa-info-circle details4"
                                                style="position: relative; top: -7px"><span style="text-align: justify">
                                                    <?php _e('Including tuition fees and accommodation in the first year.', 'clvinuni'); ?>
                                                </span></i></TD>
                                        <TD></TD>
                                        <TD>
                                            <div class="total_sem"></div>
                                        </TD>
                                        <TD>
                                            <div class="total_year"></div>
                                        </TD>
                                    </TR>
                                    <TR class="text-center" style="font-size: 0.9em">
                                        <TD><strong>
                                                <?php _e('Variable Expenses', 'clvinuni'); ?>
                                            </strong><i class="fa fa-info-circle details4"
                                                style="position: relative; top: -7px"><span style="text-align: justify">
                                                    <?php _e('Personal expenses that depend on individual student needs.', 'clvinuni'); ?>
                                                </span></i></TD>
                                        <TD>
                                            <div class="month_living"></div>
                                        </TD>
                                        <TD>
                                            <div class="sem_living"></div>
                                        </TD>
                                        <TD>
                                            <div class="year_living"></div>
                                        </TD>
                                    </TR>
                                </table>
                                <p style="color: gray; font-size: 1.2em"><small><i><strong>
                                                <?php _e('Disclaimer', 'clvinuni'); ?>:
                                            </strong>
                                            <?php _e('This table is for reference only and does not represent the exact actual cost of attendance.', 'clvinuni'); ?>
                                        </i></small></p>

                                <div id="chart-container"
                                    style="width: 25em; margin-top: -5%; margin-left: auto; margin-right: auto">
                                    <canvas id="chart-area"></canvas>
                                </div>
                                <br>
                                <p style="color:gray; font-size: 1.2em"><small><i>
                                            <?php _e('The Financial Calculator is developed by Nguyen Minh Tuan and Tran Tuan Viet (Class of 2024) - First year Students at the College of Engineering & Computer Science, VinUniversity', 'clvinuni'); ?>
                                        </i></small></p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
