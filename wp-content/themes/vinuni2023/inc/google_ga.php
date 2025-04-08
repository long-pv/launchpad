<?php
// Google analytics
function get_ga_multisite()
{
    if (is_multisite()):
        if (is_main_site()):
            ?>
            <!-- vinuni -->
            <script async src=https://www.googletagmanager.com/gtag/js?id=UA-210022430-1></script>
            <script> window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'UA-210022430-1'); </script>

            <!-- Meta Pixel Code -->
            <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '1008267690806174');
            fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1008267690806174&ev=PageView&noscript=1"
            /></noscript>
            <!-- End Meta Pixel Code -->
            <?php
        else:
            $current_blog_id = get_current_blog_id() ?? null;

            // cas
            if ($current_blog_id == 4):
                ?>
                <!-- cas -->
                <script async src=https://www.googletagmanager.com/gtag/js?id=G-TSD2MXR6XD></script>
                <script> window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'G-TSD2MXR6XD'); </script>
                <?php
            endif;

            // cecs
            if ($current_blog_id == 5):
                ?>
                <!-- cecs -->
                <script async src=https://www.googletagmanager.com/gtag/js?id=G-Y9JNVTHK67></script>
                <script> window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'G-Y9JNVTHK67'); </script>

                <?php
            endif;

            // admissions
            if ($current_blog_id == 6):
                ?>
                <!-- admissions -->
                <script async src=https://www.googletagmanager.com/gtag/js?id=G-GN5HM028ZC></script>
                <script> window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'G-GN5HM028ZC'); </script>


                <!-- Meta Pixel Code -->
                <script>
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '1008267690806174');
                fbq('track', 'PageView');
                </script>
                <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id=1008267690806174&ev=PageView&noscript=1"
                /></noscript>
                <!-- End Meta Pixel Code -->
                <?php
            endif;

            // cbm
            if ($current_blog_id == 7):
                ?>
                <!-- cbm -->
                <script async src=https://www.googletagmanager.com/gtag/js?id=G-WT12R2RB18></script>
                <script> window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'G-WT12R2RB18'); </script>
                <?php
            endif;

            // chs
            if ($current_blog_id == 8):
                ?>
                <!-- chs -->
                <script async src=https://www.googletagmanager.com/gtag/js?id=G-3WR61PTDPS></script>
                <script> window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'G-3WR61PTDPS'); </script>
                <?php
            endif;
        endif;
    endif;
}