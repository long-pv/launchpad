(function ($, window) {
	//...................longpv
	$(".search_icon").on("click", function () {
		$("#popup_search").modal("toggle");
	});
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
	//
	//
	//
	// ..................vucoder
	//
	//
	//
})(jQuery, window);
