<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package launch-pad
 */

get_header();
?>

<div class="container_xx">
	<div class="page_wrap">
		<div class="page_inner">
			<?php
			if (have_posts()) :
				while (have_posts()) :
					the_post();
			?>
					xxxx
			<?php

				endwhile;
			endif;
			?>
		</div>
	</div>
</div>

<?php
get_footer();
