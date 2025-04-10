<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package launch-pad
 */

get_header();
?>

<div class="container_xx">
	<div class="page_wrap">
		<div class="page_inner">
			<div class="container pt-4 pt-lg-0">
				<div class="page_body">
					<div class="page_scroll d-block">
						<div class="py-5">
							<h2 style="text-align:center;font-weight:bold;color:#C72127;font-size:80px;line-height:1;">
								<?php _e('404', 'launch-pad'); ?>
							</h2>
							<p style="text-align:center;">
								<?php _e('Page not found', 'launch-pad'); ?>
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="page_bottom">
				<div class="container">
					<div class="inner">
						<a href="javascript:void(0);" class="logo">
							<?php $logo_url = get_template_directory_uri() . '/assets/images/logo_vin.svg'; ?>
							<img src="<?php echo $logo_url; ?>" alt="logo">
						</a>

						<?php
						$copyright = get_field('copyright', 'option') ?? '';
						if ($copyright) {
							?>
							<div class="copyright">
								<?php echo $copyright; ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function ($) {
		adjustTabBodyHeight();

		$(window).on('resize', function () {
			adjustTabBodyHeight();
		});

		function adjustTabBodyHeight() {
			var windowWidth = $(window).width();

			if (windowWidth >= 1200) {
				var windowHeight = $(window).height();
				var headerHeight = $('.banner').outerHeight(true) || 0;
				var titleHeight = $('.sec_title').outerHeight(true) || 0;
				var otherPadding = 180; // tuỳ chỉnh theo giao diện
				var usedHeight = headerHeight + titleHeight + otherPadding;
				var availableHeight = windowHeight - usedHeight;

				$('.page_scroll').css({
					'max-height': availableHeight + 'px',
					'min-height': availableHeight + 'px',
					'overflow-y': 'auto',
					'overflow-x': 'hidden',
				});
			} else {
				// Reset lại để không giới hạn chiều cao khi nhỏ hơn 1200
				$('.page_scroll').css({
					'max-height': 'none',
					'min-height': 'none',
					'overflow-y': 'visible',
					'overflow-x': 'visible',
				});
			}
		}
	});
</script>

<?php
get_footer();
