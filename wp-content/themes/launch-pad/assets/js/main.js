(function ($, window) {
	//...................longpv
	// $(".search_icon").on("click", function () {
	// 	$("#popup_search").modal("toggle");
	// });
	$(".item_menu").on("click", function () {
		$("#popup_menu").modal("toggle");
		$(this).addClass("active");
	});

	$("#popup_menu").on("hidden.bs.modal", function (e) {
		$(".item_menu").removeClass("active");
	});

	$('select[name="tabs_title"]').on("change", function () {
		const selectedOption = $(this).find("option:selected");
		const dataUrl = selectedOption.data("url");
		const value = selectedOption.val();

		if (dataUrl) {
			window.open(dataUrl, "_blank");
		} else {
			$("#" + value).trigger("click");
		}
	});

	$(".page_mark, .bookmark_icon").on("click", function () {
		const $el = $(this);
		const post_id = $el.data("id");

		$.post(
			ajaxurl,
			{
				action: "toggle_cookie_bookmark",
				post_id: post_id,
			},
			function (response) {
				if (response.success && response.data.status === "added") {
					$el.addClass("active");
				} else if (response.success && response.data.status === "removed") {
					$el.removeClass("active");
				}
			}
		);
	});

	$(".remove-bookmark").on("click", function (e) {
		e.preventDefault();
		const post_id = $(this).data("id");

		$.post(
			ajaxurl,
			{
				action: "toggle_cookie_bookmark",
				post_id: post_id,
			},
			function (response) {
				if (response.success && response.data.status === "removed") {
					location.reload();
				}
			}
		);
	});

	// Logic only show 5 records (initial)
	$(".portal__listItem").each(function () {
		$(this).find("li:gt(4)").hide();
	});

	// Click "View more"
	$(".portal__view--more").click(function (event) {
		$(this).closest(".portal__item").find(".portal__listItem li").show();
		$(this).parent().find(".portal__view--less").show();
		$(this).hide();

		checkMatchHeight(event);
	});

	// Click "View less"
	$(".portal__view--less").click(function (event) {
		$(this).closest(".portal__item").find(".portal__listItem li:gt(4)").hide();
		$(this).parent().find(".portal__view--more").show();
		$(this).hide();

		checkMatchHeight(event);
	});

	// Check match height, don't change scroll top
	function checkMatchHeight(event) {
		event.stopPropagation();

		let scrollPosition = $(window).scrollTop();

		$('[data-mh="categoryItem"]').matchHeight(true, {
			byRow: true,
			remove: true,
		});

		$(window).scrollTop(scrollPosition);
	}
	//
	//
	//
	// ..................vucoder
	//
	//
	//
	// Khi click vào biểu tượng tìm kiếm
	$(".search_icon").on("click", function () {
		// Ẩn search icon và bookmark icon
		$(".search_icon, .bookmark_icon").addClass("d-none");

		// Hiện icon đóng
		$(".search_icon_close").removeClass("d-none");

		// Mở popup
		$("#popup_search").modal("show");
	});

	// Khi click vào biểu tượng đóng
	$(".search_icon_close").on("click", function () {
		// Đóng popup
		$("#popup_search").modal("hide");
	});

	// Khi popup đóng thì reset lại giao diện
	$("#popup_search").on("hidden.bs.modal", function () {
		// Hiện lại search icon và bookmark
		$(".search_icon, .bookmark_icon").removeClass("d-none");

		// Ẩn icon đóng
		$(".search_icon_close").addClass("d-none");
	});
})(jQuery, window);
