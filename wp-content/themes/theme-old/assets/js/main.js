(function ($, window) {
    $("main").on("click", function () {
        if (!$(this).hasClass("menu__openSp")) return;
        $(".header__toggle").click();
    });

    $(".header__toggle").on("click", function () {
        $(this).parents(".header").find(".header__menu").toggleClass("header__menu--active");
        $(this).parents(".header").find(".header__toggleItem").toggle();
        $("body").toggleClass("mobile-menu-open");
        $("main").toggleClass("menu__openSp");
    });

    // Scroll hide/show menu
    if ($(window).width() >= 992) {
        let lastScrollTop = 0;
        let header = $(".header");
        let sidebarWrapper = $(".sidebarWrapper");

        $(window).scroll(function () {
            let st = $(this).scrollTop();

            if (st > lastScrollTop) {
                sidebarWrapper.addClass("sidebar_scrollUp");
            } else if (st <= header.outerHeight() + 100) {
                sidebarWrapper.removeClass("sidebar_scrollUp");
            }

            lastScrollTop = st;
        });
    } else {
        if ($("body").hasClass("mobile-menu-open")) {
            $(window).on("scroll", function (e) {
                e.preventDefault();
            });
        }
    }

    // Add slider of banner
    let banner_slider = $(".bannerSlider");
    if (banner_slider.length > 0) {
        banner_slider.slick({
            dots: true,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        dots: true,
                    },
                },
            ],
        });
        banner_slider.find(".slick-dots").addClass("container");
    }

    // Logic only show 5 records (initial)
    $('.portal__listItem').each(function() {
        $(this).find('li:gt(4)').hide();
    });

    // Click "View more"
    $('.portal__view--more').click(function(event) {
        $(this).closest('.portal__item').find('.portal__listItem li').show();
        $(this).parent().find('.portal__view--less').show();
        $(this).hide();

        checkMatchHeight(event);
    });

    // Click "View less"
    $('.portal__view--less').click(function(event) {
        $(this).closest('.portal__item').find('.portal__listItem li:gt(4)').hide();
        $(this).parent().find('.portal__view--more').show();
        $(this).hide();

        checkMatchHeight(event);
    });

    // Check match height, don't change scroll top
    function checkMatchHeight(event) {
        event.stopPropagation();

        let scrollPosition = $(window).scrollTop();

        $('[data-mh="categoryItem"]').matchHeight(true, {
            byRow: true,
            remove: true
        });

        $(window).scrollTop(scrollPosition);
    }

    // Click search button
    $(".banner__searchBtn").on("click", function () {
        performSearch($(this).closest(".banner__boxSearch"));
    });

    // Click reset box search
    $(".banner__clearBtn").on("click", function () {
        resetSearch();

        // Reset the input value
        $(this).parent().find(".banner__searchInput").val("");
        $(this).hide();
    });

    // Keypress event for Enter key in the search input
    $(".banner__searchInput").on("keypress keyup", function (event) {
        if (event.which === 13) {
            performSearch($(this).closest(".banner__boxSearch"));
        }
    });

    // Perform search
    function performSearch(searchBlock) {
        resetSearch();

        let searchValue = searchBlock.find(".banner__searchInput").val().toString().toLowerCase();
        let showTextNoResult = true;

        if (searchValue.trim() !== "") {
            // Show button reset
            searchBlock.find(".banner__clearBtn").show();

            $('.portal').find(".portal__item").each(function () {
                let linksItem = $(this).find(".portal__listItem li");
                let categoryElement = $(this).find('.portal__titleCategory');
                let categoryText = categoryElement.contents().filter(function() {
                    return this.nodeType === 3 && !$(this).closest('.portal__countItem').length;
                }).text().trim();
                let countItemText = categoryElement.find('.portal__countItem').text().trim();
                let indexCategory = categoryText.toLowerCase().indexOf(searchValue);
                let countHighlight = 0;

                // Highlight duplicate key of category text
                if (indexCategory !== -1) {
                    let newCategoryName = categoryText.substring(0, indexCategory) + '<span class="highlight">'
                        + categoryText.substring(indexCategory, indexCategory + searchValue.length) + '</span>'
                        + categoryText.substring(indexCategory + searchValue.length) + ' <span class="portal__countItem">'
                        + countItemText + '</span>';
                    categoryElement.html(newCategoryName);
                    countHighlight++;
                    showTextNoResult = false;
                }

                // Highlight duplicate key of link text
                linksItem.each(function () {
                    let linkElement = $(this).find('.portal__link');
                    let linkText = $(this).text().toString();
                    let indexLink = linkText.toLowerCase().indexOf(searchValue);

                    if (indexLink !== -1) {
                        let newTextLink = linkText.substring(0, indexLink) + '<span class="highlight">'
                            + linkText.substring(indexLink, indexLink + searchValue.length) + '</span>'
                            + linkText.substring(indexLink + searchValue.length);
                        linkElement.html(newTextLink);
                        countHighlight++;
                        showTextNoResult = false;
                    }
                });

                if (countHighlight === 0) {
                    $(this).closest('.portal__col').hide();
                }

                $('.portal__view').hide();
                $(this).find('li').show();
            });

            if (showTextNoResult) {
                $('.portal__noResult').show();
            }

            checkMatchHeightNoNone();
        }
    }

    // Reset result search
    function resetSearch() {
        // Show all items
        $('.portal__view').show();
        $('.portal__view--more').show();
        $('.portal__view--less').hide();
        $('.portal').find(".portal__item").each(function () {
            $('.portal__col').show();
            $('.highlight').contents().unwrap();
            $(this).find('li:gt(4)').hide();
        });

        $('.portal__noResult').hide();
        checkMatchHeightNoNone();
    }

    // Check match height, when display
    function checkMatchHeightNoNone() {
        let visibleItems = $('.portal__col').filter(function() {
            return $(this).css('display') !== 'none';
        });

        $('[data-mh="categoryItem"]').css('height', 'auto');
        visibleItems.find('[data-mh="categoryItem"]').matchHeight(true, {
            byRow: true
        });
    }

    // let urlParams = new URLSearchParams(window.location.search);
    // let code = urlParams.get('code');
    //
    // if (code) {
    //     let postData = {
    //         grant_type: 'authorization_code',
    //         client_id: clientId,
    //         client_secret: clientSecret,
    //         redirect_uri: redirectUri,
    //         code: code,
    //         scope: 'openid profile email'
    //     };
    //
    //     $.ajax({
    //         url: tokenUrl,
    //         type: 'POST',
    //         contentType: 'application/x-www-form-urlencoded',
    //         data: postData,
    //         success: function(response) {
    //             let idToken = response.id_token;
    //             let decodedIdToken = parseJwt(idToken);
    //             console.log('User Name:', decodedIdToken.name);
    //             console.log('response:', response);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Something went wrong:', error);
    //         }
    //     });
    // }
    //
    // function parseJwt(token) {
    //     let base64Url = token.split('.')[1];
    //     let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    //     let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
    //         return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    //     }).join(''));
    //
    //     return JSON.parse(jsonPayload);
    // }
})(jQuery, window);