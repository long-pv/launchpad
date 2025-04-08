(function ($, window) {
	// ------------------ Longpv ---------------------//
	var banner_slider = $(".banner_slider, .bannerSlider");
	if (banner_slider.length > 0) {
		banner_slider.slick({
			dots: true,
			arrows: false,
			autoplay: true,
			autoplaySpeed: 5000,
			fade: Boolean(banner_slider.data("fade")),
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

	// all action menu
	var header_search = $(".header__search, .header__searchSp");
	var header_toggle = $(".header__toggle");

	$("main").on("click", function () {
		if (!$(this).hasClass("menu__openSp")) return;
		header_toggle.click();
	});

	header_search.on("click", function () {
		if ($(".header__menu").hasClass("header__menu--active")) {
			header_toggle.click();
		}

		$(this).parents(".header").find(".header__formSearch").toggleClass("header__formSearch--active");
		$(this).parents(".header").find(".header__searchIcon, .header__searchSpIcon").toggle();
	});

	header_toggle.on("click", function () {
		if ($(".header__formSearch").hasClass("header__formSearch--active")) {
			$(".header__searchSp").click();
		}

		$(this).parents(".header").find(".header__menu").toggleClass("header__menu--active");
		$(this).parents(".header").find(".header__toggleItem").toggle();
		$("body").toggleClass("mobile-menu-open");
		$("main").toggleClass("menu__openSp");
	});

	var header_sub_icon = $("<span></span>", {
		class: "header__subIcon",
		click: function () {
			$(this).toggleClass("header__subIcon--active");
			$(this).parents("li").find(".sub-menu").slideToggle("swing");
			$(this).parents("li").children("a").toggleClass("active");
		},
	});

	$(".header ul.menu > li.menu-item-has-children").append(header_sub_icon);

	// scroll hide/show menu
	if ($(window).width() >= 992) {
		var lastScrollTop = 0;
		var header = $(".header");
		var sidebarWrapper = $(".sidebarWrapper");

		$(window).scroll(function () {
			var st = $(this).scrollTop();

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

	// milestones
	var milestones = $(".milestones");
	var milestones_slider = $(".milestones__slider");
	var width = $(window).width();

	if (milestones.length > 0) {
		// init load page
		milestones_slider.slick({
			infinite: false,
			slidesToShow: 7,
			slidesToScroll: 1,
			swipe: false,

			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 5,
					},
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 3,
						swipe: true,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
					},
				},
			],
		});

		var obj_setting = {
			dots: true,
			arrows: true,
			infinite: false,
			slidesToShow: 3,
			slidesToScroll: 2,

			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		};

		// variable initialization
		var itemInner = $(".milestones__itemInner");
		var event = $(".milestones__event");
		var eventWrap = $(".milestones__eventWrap");
		var itemContentFirst = $(".milestones__itemContent--first");

		if (width > 992) {
			// Check if there are more than 3 items before using slick
			let first_items = parseInt(itemContentFirst.data("items"));
			if (first_items > 3) {
				event.slick(obj_setting);
			}

			// mouse scroll action
			event.on("wheel", function (e) {
				e.preventDefault();

				if ($(this).hasClass("slick-initialized")) {
					if (e.originalEvent.deltaY < 0) {
						$(this).slick("slickPrev");
					} else {
						$(this).slick("slickNext");
					}
				}
			});
		} else {
			event.slick(obj_setting);
			eventWrap.removeClass("milestones__eventWrap--smallItem");
		}

		// Get the height of box items equal
		$(".milestones__eventWrap .milestones__eventInner").matchHeight();

		// Click action on 1 year
		itemInner.on("click", function (e) {
			e.preventDefault();

			// Check to see if it is the current year
			let class_active = "milestones__itemInner--active";
			if ($(this).hasClass(class_active)) {
				return;
			}

			// Add active class for selected year
			itemInner.removeClass(class_active);
			$(this).addClass(class_active);

			// Remove slick when the content is a slider
			if (event.hasClass("slick-initialized")) {
				event.slick("unslick");
			}

			// get values
			let itemContent = $(this).parents(".milestones__item").find(".milestones__itemContent");
			let htmlEvent = itemContent.html();
			let get_items = parseInt(itemContent.data("items"));
			let classSmallItem = "milestones__eventWrap--smallItem";

			// inject new content into the event stream
			event.empty().append(htmlEvent);

			if (width > 992) {
				if (get_items > 3) {
					event.slick(obj_setting);
					eventWrap.removeClass(classSmallItem);
				} else {
					eventWrap.addClass(classSmallItem);
				}
			} else {
				event.slick(obj_setting);
			}

			$(".milestones__eventWrap .milestones__eventInner").hide().fadeIn(300);
			$(".milestones__eventWrap .milestones__eventInner").matchHeight();
		});
	}

	// Create space from the header downwards
	paddingBody();
	$(window).on("load resize", paddingBody);

	function paddingBody() {
		if ($(window).width() < 992) {
			var heightHeader = $(".header").height();
			$("body").css("padding-top", heightHeader);

			if ($("#wpadminbar").length > 0) {
				$(".header").css("margin-top", $("#wpadminbar").outerHeight(true));
			}
		}
	}

	// faculty stories
	var tabSlider = $(".stories__tabSlider");
	var selecDropdown = $(".selecDropdown ul");
	var stories_slider = $(".stories__slider");

	if (tabSlider.length > 0) {
		if ($(window).width() >= 768) {
			tabSlider.each(function () {
				let sliderShow = $(this).data("slide");
				$(this).slick({
					slidesToShow: sliderShow,
					infinite: false,
					responsive: [
						{
							breakpoint: 992,
							settings: {
								slidesToShow: 2,
							},
						},
					],
				});
			});
		} else {
			selecDropdown.each(function () {
				let li_first_child = $(this).children("li").eq(0);
				li_first_child.addClass("selected");
				let first_option = $("<li></li>", {
					class: "nav-item stories__tabItem init",
				});
				$(this).prepend(first_option.append(li_first_child.html()));
			});

			selecDropdown.on("click", ".init", function () {
				$(this).closest("ul").children("li:not(.init)").toggle();
				$(this).toggleClass("active");
			});

			selecDropdown.on("click", "li:not(.init)", function () {
				let allOptions = $(this).closest("ul").children("li:not(.init)");
				let ul_select = $(this).closest("ul");
				allOptions.removeClass("selected");
				$(this).addClass("selected");
				ul_select.children(".init").html($(this).html());
				ul_select.children(".init").toggleClass("active");
				allOptions.toggle();
			});
		}

		$(".nav-link").on("click", function () {
			$(this).parents(".stories__tabSlider").find(".nav-link").removeClass("active");
		});
	}

	if (stories_slider.length > 0) {
		stories_slider.slick({
			autoplay: true,
			autoplaySpeed: 5000,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
						dots: true,
					},
				},
			],
		});

		stories_slider_height();
		$(window).on("load resize", stories_slider_height);

		function stories_slider_height() {
			if ($(window).width() < 992) {
				$(".storiesItem__title").matchHeight();
				$(".storiesItem__position").matchHeight();
				$(".storiesItem__quote").matchHeight();
			}
		}
	}

	// ------------------ Ankt -----------------------//
	// Counter
	// Check on page load
	checkIfInView();

	// Check on scroll
	$(window).on("scroll", function () {
		checkIfInView();
	});

	function checkIfInView() {
		$(".counter").each(function () {
			let counter = $(this);
			let statsNumberTop = counter.offset().top;

			if ($(window).scrollTop() >= statsNumberTop - $(window).height() && !counter.hasClass("animated")) {
				animateCounter(counter);
				counter.addClass("animated");
			}
		});
	}

	function animateCounter(counter) {
		let characterSpan = counter.find(".character");
		let originalContent = counter.text();

		// Check if the content is a valid number
		if (isNumber(originalContent)) {
			counter.prop("Counter", 0).animate(
				{
					Counter: originalContent.replace(/,/g, ""), // Remove existing commas, if any
				},
				{
					duration: 3000,
					easing: "swing",
					step: function (now) {
						let formattedNumber = formatNumberWithCommas(Math.ceil(now));
						counter.text(formattedNumber);
						animateCounterStep(counter, characterSpan);
					},
					complete: function () {
						animateCounterStep(counter, characterSpan);
					},
				}
			);
		} else {
			// If not a number, set the text without animation
			counter.text(originalContent);
		}
	}

	function animateCounterStep(counter, characterSpan) {
		if (characterSpan.length > 0) {
			let characterText = counter.text();
			counter.empty();

			let character = $("<span></span>", {
				class: "character",
				text: characterText,
			});
			counter.append(character);
		}
	}

	// Add commas to the number
	function formatNumberWithCommas(number) {
		return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	// Check if the value is a valid number
	function isNumber(value) {
		return !isNaN(parseFloat(value)) && isFinite(value);
	}

	// Video
	if ($(".videoBlock__playAction").length) {
		let videoSrc;
		let btnVideo = $(".videoBlock__playAction");
		let videoId = $("#video");
		let videoUrl = $("#videoUrl");

		// Add click event for each .videoBlock__playAction
		btnVideo.click(function () {
			videoSrc = $(this).data("src");
		});

		videoUrl.on("shown.bs.modal", function (e) {
			videoId.attr("src", videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
		});

		videoUrl.on("hide.bs.modal", function (e) {
			videoId.attr("src", "");
		});
	}
	// End video

	// Click coreValues
	if ($(".coreValue--desc").length > 0) {
		var class_core_value_item = "coreValue__imgItem--1";

		$(".coreValue__item").on("click", function () {
			// Get content

			let highlight = $(this).find(".coreValue__highlights").text();
			let title = ": " + $(this).find(".coreValue__title").text();
			let description = $(this).find(".coreValue__desc").text();
			let img_content_wrap = $(".coreValue__imgContentWrap");
			let index = $(this).data("index");

			// Check if the content is different from the current content
			if (!img_content_wrap.hasClass("coreValue__imgItem--" + index) && highlight && title && description) {
				let el_content = $(".coreValue__textHighlight, .coreValue__textTitle, .coreValue__imgDesc");
				img_content_wrap.removeClass(class_core_value_item);
				class_core_value_item = "coreValue__imgItem--" + index;

				// Hide old text and display new text with effect
				el_content.fadeOut(400, function () {
					// Assign value
					$(".coreValue__textHighlight").text(highlight);
					$(".coreValue__textTitle").text(title);
					$(".coreValue__imgDesc").text(description);
					img_content_wrap.addClass(class_core_value_item);

					// Display new text with effect
					el_content.fadeIn(400);
				});
			}
		});
	}

	// Slick sliders list
	var slidersList = $(".sliders__list");
	if (slidersList.length > 0) {
		slidersList.slick({
			slidesToShow: 4,
			autoplay: true,
			autoplaySpeed: 2000,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 3,
						arrows: false,
						dots: true,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
						arrows: false,
						dots: true,
					},
				},
			],
		});
	}

	// LeadersBlock
	var leadersList = $(".leaders__slider");
	if (leadersList.length > 0) {
		leadersList.slick({
			autoplay: true,
			fade: true,
			autoplaySpeed: 5000,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
						dots: true,
					},
				},
			],
		});

		leaders_list();
		$(window).on("resize", leaders_list);
	}

	// Function position slick arrow leaders
	function leaders_list() {
		// Calculate the left margin for the container based on window width and container width
		let mrWrap = ($(window).width() - $(".leaders .container").width()) / 2;

		// Get the height of the heading element with the class "leaders__heading"
		let h_heading = $(".leaders__heading").height();

		// Set the height of all elements with the class "leaders__content" to be equal using the matchHeight plugin
		$(".leaders__content").matchHeight();

		// Initialize a variable to set the top position of the arrows
		var top_heading = -24;

		// Check if an element with the class "secHeading__title" exists
		if ($(".leaders .secHeading__title").length > 0) {
			top_heading = 42;
		} else if ($(".leaders .secHeading__desc").length > 0 || $(".leaders .secHeading__link").length > 0) {
			top_heading = 32;
		}

		// Find all elements with the class "slick-arrow" within the "leadersList" element and adjust their CSS properties
		leadersList.find(".slick-arrow").css({ right: mrWrap, left: "auto", top: top_heading - h_heading });
	}

	// Postition secHeading collaborators
	if ($(".collaborators").length > 0) {
		collaborators();
		$(window).on("resize", collaborators);
	}

	// Function to handle adjustments related to collaborators section
	function collaborators() {
		if ($(window).width() >= 1200) {
			// Check if the title element in collaborators section is visible
			var isTitleVisible = $(".collaborators .secHeading__title").is(":visible");

			// If the title is visible, adjust the position of the link
			if (isTitleVisible) {
				var titleHeight = $(".collaborators .secHeading__title").height();

				$(".collaborators .secHeading__link").css("top", titleHeight);
			} else {
				$(".collaborators .secHeading__link").css("top", "0");
			}
		} else {
			// Match height itemChild
			$(".collaborators__itemChild--0").matchHeight();
			$(".collaborators__itemChild--1").matchHeight();
		}
	}

	// when submit form
	$(".wpcf7-form").on("submit", function () {
		$('input[type="submit"]').addClass("pointer-events");
	});

	// submit error or success
	document.addEventListener(
		"wpcf7submit",
		function (event) {
			$('input[type="submit"]').removeClass("pointer-events");
		},
		false
	);

	// Select all elements with the class "studentActivity__slider"
	const scrollContainerss = $(".studentActivity__slider");

	// Iterate over each selected container
	scrollContainerss.each(function () {
		// Get the scroll width of the container
		const scrollWidth = $(this).get(0).scrollWidth;
		let isHovered = false;

		// Add a window load event listener
		// Set an interval function to handle scrolling logic
		setInterval(() => {
			if (!isHovered) {
				// Get the first element with the class "studentActivity__bgImage" inside the container
				const first = $(this).find(".studentActivity__bgImage").first();

				// Check if the first element is not in the viewport
				if (!isElementInViewport(first)) {
					// Append the first element to the end of the container
					$(this).append(first);
					// Scroll the container to the left by the width of the first element
					$(this).scrollLeft($(this).scrollLeft() - first.outerWidth());
				}

				// Check if the container is not scrolled to the end
				if ($(this).scrollLeft() !== scrollWidth) {
					// Scroll the container to the right by 1 pixel
					$(this).scrollLeft($(this).scrollLeft() + 1);
				}
			}
		}, 15);

		$(this).hover(
			function () {
				isHovered = true;
			},
			function () {
				isHovered = false;
			}
		);

		// Function to check if an element is in the viewport
		function isElementInViewport(el) {
			// Get the bounding rectangle of the element
			const elementRect = el.get(0).getBoundingClientRect();
			// Check if the right edge of the element is greater than 0 (fully visible)
			return elementRect.right > 0;
		}
	});

	// Add slider gallery student activities
	if ($('[data-fancybox="gallery"]').length > 0) {
		$('[data-fancybox="gallery"]').fancybox({
			buttons: ["close"],
			slideShow: {
				autoStart: true,
			},
		});
	}

	// Click gallery
	$(".studentActivity").each(function () {
		$(document).on("click", ".studentActivity__item", function () {
			let index = $(this).data("index");

			// Check item gallery
			$(".studentActivity__galleryList--" + index)
				.find("a")
				.eq(0)
				.click();
		});
	});

	$(".about").each(function () {
		var aboutContainer = $(this);
		var about_slider = aboutContainer.find(".about__slider");

		if (about_slider.length > 0) {
			var slickOptions = {
				slidesToShow: 1,
				autoplay: true,
				autoplaySpeed: 4000,
				arrows: false,
				dots: true,
			};

			// Find the .slick-slider-dots element within the scope of .about
			var dotsContainer = aboutContainer.find(".slick-slider-dots");

			// Check if the .slick-slider-dots element exists
			if (dotsContainer.length > 0 && $(window).width() >= 992) {
				slickOptions.appendDots = dotsContainer;
			}

			about_slider.slick(slickOptions);
		}
	});

	updateSlickConfig();
	$(window).on("load resize", updateSlickConfig);

	function updateSlickConfig() {
		$(".about__slider").each(function () {
			var currentSlider = $(this);
			var aboutContainer = currentSlider.closest(".about");

			if ($(window).width() >= 992) {
				currentSlider.slick("slickSetOption", "appendDots", aboutContainer.find(".slick-slider-dots"), true);
			} else {
				currentSlider.slick("slickSetOption", "appendDots", null, false);
			}
		});
	}

	// func find people
	var pageResearchPeople_select = $(".pageResearchPeople__select");
	if (pageResearchPeople_select.length > 0) {
		// get element
		var url = $(".pageResearchPeople").data("url");
		var collegeId = $("#college");
		var research_area = $("#research_area");
		var lastNameId = $("#last_name");

		// change select to select2
		pageResearchPeople_select.each(function () {
			let placeholder = $(this).data("placeholder");
			let noresult = $(this).data("noresult");
			$(this).select2({
				placeholder: placeholder,
				minimumResultsForSearch: -1,
				language: {
					noResults: function (params) {
						return noresult;
					},
				},
			});
		});

		$(".pageResearchPeople__search").on("click", function () {
			// get values
			let college_val = collegeId.val() ?? "all";
			let lastName_val = lastNameId.val() ?? "all";
			let research_area_val = research_area.val() ?? "all";

			// window.location
			window.location.href =
				url + "?college=" + college_val + "&research_area=" + research_area_val + "&last_name=" + lastName_val;
		});
	}

	function updateSliderInfo(blockClass, sliderClass, innerClass, lengthNumber = "3") {
		$(blockClass).each(function () {
			var block = $(this);
			var slider = block.find(sliderClass);
			var inner = block.find(innerClass);

			if (!block.find(".secHeading").text().trim() || !block.find(".secHeading").length) {
				if (slider.length && slider.children().length > lengthNumber) {
					inner.addClass("sectionSlider--noBlockInfo");
				} else {
					inner.removeClass("sectionSlider--noBlockInfo");
				}
			}
		});
	}

	if ($(".testimonials").length > 0) {
		updateSliderInfo(".testimonials", ".testimonials__slider", ".testimonials__inner");
	}

	if ($(".research").length > 0) {
		updateSliderInfo(".research", ".research__slider", ".research__inner");
	}

	if ($(".highlights").length > 0) {
		updateSliderInfo(".highlights", ".highlights__slider", ".highlights__inner");
	}

	var selecDropdownCate = $(".selecDropdownCate ul");
	// Add slider image highlights
	var slider_category = $(".categoryBlock__list");
	if (slider_category.length > 0) {
		var contentCategory = $(".categoryBlock").data("title");

		if ($(window).width() >= 992) {
			var catItemCurrent = $(catItemCurrentId);
			var indexToGet = $(".categoryBlock__list .categoryBlock__item").index(catItemCurrent);
			var soLuongPhanTu = parseInt(count_cat_item);

			slider_category.slick({
				slidesToShow: 6,
				initialSlide: soLuongPhanTu > 6 ? indexToGet : null,
				centerMode: soLuongPhanTu > 6 ? true : false,
				centerPadding: "0px",
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 4,
							initialSlide: soLuongPhanTu > 4 ? indexToGet : null,
							centerMode: soLuongPhanTu > 4 ? true : false,
						},
					},
				],
			});
		} else {
			selecDropdownCate.each(function () {
				let li_first_child = $(this).find("li").has("a.active");
				let htmlDropdown = "";

				if (li_first_child.length === 0) {
					htmlDropdown = $("<a href='javascript:void(0);'></a>")
						.html(contentCategory)
						.addClass("categoryBlock__link selected active");
				} else {
					let content = li_first_child.find("a.active").text();
					htmlDropdown = $("<a href='javascript:void(0);'></a>")
						.html(content)
						.addClass("categoryBlock__link selected active");
				}

				let first_option = $("<li></li>", {
					class: "categoryBlock__item init",
				});
				$(this).prepend(first_option.append(htmlDropdown));
			});

			selecDropdownCate.on("click", ".init", function () {
				$(this).closest("ul").children("li:not(.init)").toggle();
				$(this).toggleClass("active");
			});

			selecDropdownCate.on("click", "li:not(.init)", function () {
				let allOptions = $(this).closest("ul").children("li:not(.init)");
				allOptions.removeClass("selected");
				$(this).addClass("selected");
			});

			$(document).on("click", function (event) {
				// Checks whether the clicked element is part of a dropdown or not
				if (!$(event.target).closest(selecDropdownCate).length) {
					// If not part of the dropdown, hide the items in the dropdown and remove the active class from the init element
					selecDropdownCate.find("li:not(.init)").hide();
					selecDropdownCate.find(".init").removeClass("active");
				}
			});
		}
	}
	// ------------------ End Ankt ---------------------//

	// ------------------ Huongnt ---------------------//
	// Show/hide menu introduction level 1
	if ($(".admissionIntro__title").length > 0) {
		$(".admissionIntro__title").on("click", function (event) {
			// Prevent click events from spreading outside the level 1 menu
			event.stopPropagation();
			let menu_list = $(this).next(".admissionIntro__list");
			menu_list.slideToggle("swing");
			$(this).find(".arrow").toggleClass("arrow--active");

			// Close all sub-menu when close menu
			menu_list.find(".sub-menu").hide();
			menu_list.find(".sub-arrow").removeClass("sub-arrow--active");
		});

		// Show/hide menu introduction level 2
		var sub_arrow = $("<span></span>", {
			class: "sub-arrow",
			click: function (event) {
				// Prevent click events from spreading outside the level 2 menu
				event.stopPropagation();
				let sub_menu_list = $(this).parents("li").find(".sub-menu");
				$(this).toggleClass("sub-arrow--active");
				sub_menu_list.slideToggle("swing");
			},
		});

		// Add sub arrow
		$(".admissionIntro__list .menu-item-has-children").append(sub_arrow);

		// Close menu when clicking outside
		$(document).on("click", function (event) {
			// Check if the click is within the range of the menu
			if (!$(event.target).closest(".admissionIntro__list").length) {
				// Close all level 1 menus and level 2 menus
				$(".admissionIntro__list").slideUp("swing");
				$(".arrow, .sub-arrow").removeClass("arrow--active sub-arrow--active");
			}
		});
	}

	// Add slider image highlights
	var slider_highlight = $(".highlights__slider");
	if (slider_highlight.length > 0) {
		slider_highlight.slick({
			slidesToShow: 3,
			autoplay: true,
			autoplaySpeed: 6000,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 2,
						arrows: false,
						dots: true,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						arrows: false,
						dots: true,
					},
				},
			],
		});
	}

	// Click gallery
	$(document).on("click", ".highlights__item", function () {
		let index = $(this).data("index");
		let layout = $(this).data("layout");

		// Check item gallery
		if (layout == "slider_gallery") {
			$(".highlights__galleryList--" + index)
				.find("a")
				.eq(0)
				.click();
		}
	});

	// Add slider testimonials
	var slider_testimonial = $(".testimonials__slider");
	loadSlider(slider_testimonial);

	// Add slider research
	var slider_research = $(".research__slider");
	loadSlider(slider_research);

	// Add active class to all parent anchors
	var sidebarMenu_active = $(".sidebarMenu--active");
	if (sidebarMenu_active.length > 0) {
		sidebarMenu_active.each(function () {
			var parentAnchors = $(this).parents("ul");

			// Close all other ul elements
			$(".sidebarMenu ul").not(parentAnchors).hide();

			// Show and active element
			parentAnchors.show();
			$(this).children("ul").show();
			parentAnchors.closest("li").addClass("sidebarMenu--active");
			parentAnchors.closest("li").find(".sidebarMenu__icon").addClass("sidebarMenu--open");
		});
	} else {
		$(".sidebarMenu .sidebarMenu__content > ul > li > ul").hide();
	}

	// Click show/hide sub sidebar
	$(".sidebarMenu__icon").on("click", function () {
		let sidebar = $(this).siblings("ul");
		sidebar.slideToggle("swing");
		sidebar.find("ul").slideUp("swing");

		// Check if the clicked icon is in an open state
		let is_open = $(this).hasClass("sidebarMenu--open");

		// Toggle the class sidebarMenu--open
		$(this).toggleClass("sidebarMenu--open", !is_open);

		// Close all sub-sidebar when closing the parent
		sidebar.find(".sidebarMenu__icon").removeClass("sidebarMenu--open");
	});

	// Click tab to show/hide sidebar with SP
	$(".sidebarMenu__tab").on("click", function () {
		$(".sidebarMenu__content").slideToggle(1000);

		// Open/close icon
		let sidebar_icon = $(".sidebarMenu__tab .sidebarMenu__icon");
		let is_open_icon = sidebar_icon.hasClass("sidebarMenu--open");
		sidebar_icon.toggleClass("sidebarMenu--open", !is_open_icon);
	});

	// Load and initialize the slick slider for the block
	function loadSlider(slider_block) {
		if (slider_block.length > 0) {
			slider_block.slick({
				slidesToShow: 3,
				autoplay: true,
				autoplaySpeed: 5000,
				responsive: [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 2,
							arrows: false,
							dots: true,
						},
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							arrows: false,
							dots: true,
						},
					},
				],
			});
		}
	}
	// ------------------ End Huongnt ---------------------//

	// ------------------ Start Longbn ---------------------//
	// func find jobs
	var findJobs_select = $(".findJobs__select");
	if (findJobs_select.length > 0) {
		// get url page result
		var url = $(".findJobs").data("url");
		var params = new URLSearchParams(window.location.href.split("?")[1]);
		// get element
		var jobDivisionId = $("#job_division");
		var locationId = $("#job_location");
		if (params) {
			params.forEach(function (value, key) {
				switch (key) {
					case "job_division":
						jobDivisionId.val(value).trigger("change");
						break;
					case "work_location":
						locationId.val(value).trigger("change");
						break;
					default:
						break;
				}
			});
		}

		// change select to select2
		findJobs_select.each(function () {
			let placeholder = $(this).data("placeholder");
			let noresult = $(this).data("noresult");
			$(this).select2({
				placeholder: placeholder,
				minimumResultsForSearch: -1,
				language: {
					noResults: function (params) {
						return noresult;
					},
				},
				templateResult: function (option) {
					if (!option.id) {
						return option.text;
					}
					var resultoption = $("<span></span>");
					resultoption.text(option.text);
					var classTerm = option.element.getAttribute("data-classterm");
					if (classTerm) {
						resultoption.addClass(classTerm);
					}
					return resultoption;
				},
			});
		});

		$(".findJobs__btn").on("click", function () {
			// get values
			let jobDivision = jobDivisionId.val() ?? "";
			let location = locationId.val() ?? "";

			// window.location
			window.location.href = url + "?job_division=" + jobDivision + "&work_location=" + location;
		});
	}

	// why vinuni slider
	var whyVinuni__slide = $(".whyVinuni__slide");
	if (whyVinuni__slide.length > 0) {
		if ($(window).width() <= 480) {
			whyVinuni__slide.find(".whyVinuni__item--hidden").remove();
		}
		whyVinuni__slide.slick({
			infinite: false,
			slidesToShow: 3.46,
			slidesToScroll: 2,
			arrows: false,
			dots: false,
			speed: 800,

			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 2.5,
						swipe: true,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2.2,
						swipe: true,
					},
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						dots: true,
						autoplay: true,
						speed: 500,
						autoplaySpeed: 5000,
					},
				},
			],
		});

		// get value margin
		function getAndDisplayMargin() {
			var marginLeft = parseInt($(".whyVinuni .container").css("margin-left"));
			$(".whyVinuni__slide").css({
				"padding-left": marginLeft + "px",
			});
		}

		getAndDisplayMargin();
		// Call the function when changing the screen size
		$(window).on("resize", function () {
			getAndDisplayMargin();
		});

		whyVinuni__slide.on("hover mousewheel wheel scroll", function (e) {
			var slickCurrentSlide = $(this).slick("slickCurrentSlide");
			var totalSlides = $(this).slick("getSlick").slideCount;
			var slidesToShowValue = $(this).slick("slickGetOption", "slidesToShow");
			var isFirstSlide = slickCurrentSlide === 0;
			var isLastSlide = slickCurrentSlide + slidesToShowValue >= totalSlides;

			if (e.originalEvent.deltaY < 0 && isFirstSlide) {
				$(this).scrollTop($(this).scrollTop() - e.originalEvent.deltaY);
			} else if (e.originalEvent.deltaY > 0 && isLastSlide) {
				$(this).scrollTop($(this).scrollTop() - e.originalEvent.deltaY);
			} else {
				e.preventDefault();

				if (e.originalEvent.deltaY < 0) {
					$(this).slick("slickPrev");
				} else {
					$(this).slick("slickNext");
				}
			}
		});
	}

	//  wow
	WOW.prototype.addBox = function (element) {
		this.boxes.push(element);
	};
	var wow = new WOW();
	wow.init();

	// search club
	var searchClub = $(".searchClub__btnSearch");
	var resetSearchClub = $(".searchClub__btnReset");
	var searchInput = $(".searchClub__input");

	if (searchClub.length > 0) {
		searchClub.on("click", function () {
			performSearch($(this).closest(".searchClub"));
		});
	}

	if (resetSearchClub.length > 0) {
		resetSearchClub.on("click", function () {
			resetSearch($(this).closest(".searchClub"));
		});
	}

	// Keypress event for Enter key in the search input
	if (searchInput.length > 0) {
		searchInput.on("keypress keyup", function (event) {
			if (event.which === 13) {
				performSearch($(this).closest(".searchClub"));
				event.preventDefault();
			}
		});
	}

	function performSearch(searchBlock) {
		var searchValue = searchBlock.find(".searchClub__input").val().toString().toLowerCase();

		if (searchValue.trim() !== "") {
			searchBlock.find(".clubCategories__item").each(function () {
				var clubsItem = $(this).find(".clubs__item");
				var accordion = $(this).find(".collapse");
				var isValue = false;

				clubsItem.each(function () {
					var clubText = $(this).text().toString().toLowerCase();
					if (clubText.indexOf(searchValue) === -1) {
						$(this).parents(".clubs__col").hide();
					} else {
						isValue = true;
						$(this).parents(".clubs__col").show();
					}
				});

				if (isValue) {
					accordion.collapse("show");
				} else {
					accordion.collapse("hide");
					$(this).find(".clubs__col").show();
				}
			});
		} else {
			resetSearch(searchBlock);
		}
	}

	function resetSearch(searchBlock) {
		// Reset the input value
		searchBlock.find(".searchClub__input").val("");

		// Show all items and collapse all accordions within the specific search block
		searchBlock.find(".clubCategories__item").each(function () {
			$(this).find(".collapse.show").collapse("hide");
			$(this).find(".clubs__col").show();
		});
	}

	// service
	var service_slide = $(".service__slider");
	if (service_slide.length > 0) {
		service_slide.slick({
			slidesToShow: 4,
			autoplay: true,
			autoplaySpeed: 5000,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 3,
						arrows: false,
						dots: true,
					},
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 2,
						arrows: false,
						dots: true,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						arrows: false,
						dots: true,
					},
				},
			],
		});
	}

	// draw circle in block resources

	function isElementInViewport(element) {
		if (element.length > 0) {
			var rect = element[0].getBoundingClientRect();
			return (
				rect.top >= 0 && rect.left >= 0 && rect.bottom <= $(window).height() && rect.right <= $(window).width()
			);
		}
	}

	function drawCircles() {
		var moreResources = $(".moreResources");
		if(moreResources.length > 0) {
			moreResources.each(function() {

				var smallCircles = $(this).find('.resourcesItem');
				var largeCircle = $(this).find(".resources__inner");

				if (smallCircles.length > 0 && largeCircle.length > 0) {
					var numberOfCircles = smallCircles.length;

					if (numberOfCircles % 2 === 0 && $(window).width() >= 768) {
						$(".resources").css({
							"margin-bottom": "32px",
						});
					} else if (numberOfCircles == 7 && $(window).width() >= 768) {
						$(".resources").css({
							"margin-bottom": "16px",
						});
					} else {
						$(".resources").css({
							"margin-bottom": "0px",
						});
					}

					smallCircles.each(function (index) {
						var angle = (360 / numberOfCircles) * index;
						var offsetAngle = 270; // The corner starts at 12 o'clock
						var finalAngle = offsetAngle + angle;

						var radius = largeCircle.width() / 2;

						var x = radius * Math.cos(degreesToRadians(finalAngle));
						var y = radius * Math.sin(degreesToRadians(finalAngle));

						$(this).css({
							left: x + radius - 4.5 - $(this).width() / 2 + "px",
							top: y + radius - $(this).height() / 2 + "px",
							transform: "unset",
						});
					});
				}
			});
		}
	}

	function degreesToRadians(degrees) {
		return degrees * (Math.PI / 180);
	}

	function checkAndDraw() {
		var resourcesInner = $(".resources__inner");

		if (isElementInViewport(resourcesInner) && !resourcesInner.hasClass("drawn")) {
			drawCircles();
			resourcesInner.addClass("drawn");
		}
	}

	// Check and redraw from the beginning
	checkAndDraw();

	$(window).on("resize", function () {
		drawCircles();
	});

	// Call back the checkAndDraw function on scroll
	$(window).on("scroll", function () {
		checkAndDraw();
	});

	// accreditation slider
	function accreditationSlider() {
		let accreditation_slide = $(".accreditation__slide");
		accreditation_slide.slick({
			infinite: true,
			autoplay: true,
			autoplaySpeed: 5000,
			slidesToShow: 5,
			dots: false,
			arrows: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 4,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
					},
				},
			],
		});
	}

	accreditationSlider();

	//  scroll to top
	var btnbackToTop = $(".backToTop");
	$(window).scroll(function () {
		if ($(window).scrollTop() > 300) {
			btnbackToTop.addClass("show");
		} else {
			btnbackToTop.removeClass("show");
		}
	});

	btnbackToTop.on("click", function (e) {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "1000");
	});

	// banner video in gallery detail
	if($('.gallerySingle__playAction').length > 0){
		$('.gallerySingle__playAction').on("click",function(){
			$('.gallerySingle__videoPreview').hide();
			let iframevideo = $('.gallerySingle__videoIframe');
			var videoSrc = iframevideo.attr('src');
			var newVideoSrc = videoSrc + '&autoplay=1';
			iframevideo.attr('src', newVideoSrc);
		});
	}

	// slider image in gallery detail
	if($('.gallerySingle__slider').length > 0){
		$('.gallerySingle__slider').slick({
			infinite: false,
			autoplay: true,
			autoplaySpeed: 5000,
			slidesToShow: 1,
			dots: false,
			arrows: true,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
						dots: true,
					},
				},
			],
		});

		// gallery image in gallery detail
		if ($('[data-fancybox="gallery-image"]').length > 0) {
			$('[data-fancybox="gallery-image"]').fancybox({
				buttons: [
					"close",
					"thumbs",
				],
				thumbs: {
					autoStart: true
				},
				arrows: false,
				loop: true,
				afterShow: function(instance, slide) {
					var index = instance.currIndex;
					$('.gallerySingle__slider').slick('slickGoTo', index);
				}
			});
		}
	}

	// search key word 
	var campusGallerybtnSearch = $('.campusGallery__btnSearch');
	var campusGallerySearchInput = $('.campusGallery__input');
	if (campusGallerybtnSearch.length > 0) {
		campusGallerybtnSearch.on('click', function(event) {
			event.preventDefault();
			performCampusGallerySearch($(this).closest('.campusGallery'));
		});
	}

	// Keypress event for Enter key in the search input
	if (campusGallerySearchInput.length > 0) {
		campusGallerySearchInput.on("keypress keyup", function (event) {
			if (event.which === 13) {
				event.preventDefault();
				performCampusGallerySearch($(this).closest(".campusGallery"));
			}
		});
	}

	function performCampusGallerySearch(campusGalleryBlock) {
		var url = $('#campusGalleryInfo').data("url");
		window.location.href = url + "?search_keyword=" + campusGalleryBlock.find('.campusGallery__input').val();
	}

	var scroll_key = $('#campusGalleryInfo').data("scroll");
	if (scroll_key) { 
		campusGalleryScroll();
	} else {
		var hash = window.location.hash;
		if (hash === '#campusGallery') {
			campusGalleryScroll();
		}
	}

	function campusGalleryScroll() {
		if($('#campusGallery').length > 0){
			$('html, body').stop().animate({
				'scrollTop': $('#campusGallery').offset().top
			}, 1000, 'swing');
		}
	}

	if($('.campusGallery__filterBtn').length > 0){
		$('.campusGallery__filterBtn').on('click',function(e){
			e.stopPropagation();
			$(this).closest('.campusGallery').find('.campusGallery__filterCat').slideToggle(600,'swing');
		});
		$(document).on('click', function(event) {
			$('.campusGallery__filterCat').slideUp(600,'swing');
		});
		$('.campusGallery__filterCatWrap').on('click', function(event) {
			event.stopPropagation();
		});
	}

	var campusGallery__select = $(".campusGallery__select");
	var campusGallery__btnReset = $(".campusGallery__btnReset");
	if (campusGallery__select.length > 0) {
		// get url page result
		var url = $('#campusGalleryInfo').data("url");
		var params = new URLSearchParams(window.location.href.split("?")[1]);
		// get element
		var galleryCatId = $("#cp_gallery_category");
		var galleryCollegeId = $("#cp_gallery_college");
		var galleryYearId = $("#cp_gallery_year");
		var galleryTagsId = $("#cp_gallery_tags");
		if (params) {
			params.forEach(function (value, key) {
				switch (key) {
					case "cp_gallery_cat":
						galleryCatId.val(value).trigger("change");
						break;
					case "cp_gallery_college":
						galleryCollegeId.val(value).trigger("change");
						break;
					case "cp_year":
						galleryYearId.val(value).trigger("change");
						break;
					case "cp_tags":
						galleryTagsId.val(value).trigger("change");
						break;
					default:
						break;
				}
			});
		}

		// change select to select2
		campusGallery__select.each(function () {
			let placeholder = $(this).data("placeholder");
			let noresult = $(this).data("noresult");
			$(this).select2({
				minimumResultsForSearch: -1,
				language: {
					noResults: function (params) {
						return noresult;
					},
				},
			});
		});

		$(".campusGallery__btnFilter").on("click", function () {
			// get values
			let gallery_category = galleryCatId.val() ?? "";
			let gallery_college = galleryCollegeId.val() ?? "";
			let cp_year = galleryYearId.val() ?? "";
			let cp_tags = galleryTagsId.val() ?? "";
			// window.location
			window.location.href = url + "?cp_gallery_cat=" + gallery_category + "&cp_gallery_college=" + gallery_college + "&cp_year=" + cp_year + "&cp_tags=" + cp_tags;
		});
		campusGallery__btnReset.on("click", function () {
			galleryCatId.val('all').trigger("change");
			galleryCollegeId.val('all').trigger("change");
			galleryYearId.val('all').trigger("change");
			galleryTagsId.val('all').trigger("change");
		});
	}

	// show content of block more resources 
	var resourcesItem__showContent = $('.resourcesItem__showContent');
	if(resourcesItem__showContent.length > 0){
		resourcesItem__showContent.on('click', function(){
			let resourcesitemkey = $(this).data('resourcesitemkey');
			let moreresourcesid = $(this).data('moreresourcesid');
			$('.resourcesItem__content').removeClass('active');
			$('.resourcesItem__content[data-resourcesitemkey="'+ resourcesitemkey +'"').addClass('active');
			if ($(window).width() <= 768) {
				$('html, body').stop().animate({
					'scrollTop': $('#'+moreresourcesid).offset().top - 60
				}, 1000, 'swing');
			}
		});
	}

	// ------------------ End Longbn ---------------------//
	if ($(".categoryBlock__list").length > 0) {
		if ($(window).width() >= 992) {
			$(".categoryBlock__item").hover(function () {
				if ($(".hover-childCat").length > 0) {
					remove_cat_active();
				}

				var position = $(this).offset();
				var top = position.top;
				var left = position.left + 16;
				var contentHtml = $(this).find(".categoryBlock__childCat").html();

				if (contentHtml) {
					$(this).find("a").addClass("active");
					var cat_id = $(this).attr("id");
					var hoverContent = $('<ul data-id="' + cat_id + '" class="hover-childCat"></ul>').html(contentHtml);

					hoverContent.css({
						position: "absolute",
						top: top + $(this).outerHeight() + "px",
						left: left + "px",
						width: $(this).width(),
						zIndex: 9999,
					});

					$("body").append(hoverContent);
				}
			});

			$(document).on("click scroll", remove_cat_active);
			$(".categoryBlock__list").on("afterChange", remove_cat_active);
		}

		function remove_cat_active() {
			$(".hover-childCat").remove();
			$(".categoryBlock__item a").removeClass("active");
			$(catItemCurrentId + " a").addClass("active");
		}
	}

	// lấy giá trị nhập từ ô search đưa sang ô nhập cho google api
	$('input[name="s"]').on("input", function () {
		var searchValue = $(this).val();
		$('input[name="q"]').val(searchValue);
	});


	if ($(".relatedPostsList").length > 0) {
		$(".relatedPostsList").slick({
			slidesToShow: 3,
			autoplay: true,
			autoplaySpeed: 6000,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 2,
						arrows: false,
						dots: true,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						arrows: false,
						dots: true,
					},
				},
			],
		});
	}
})(jQuery, window);
