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
	//
	//
	//
	// ..................vucoder
	//
	//
	//
})(jQuery, window);
