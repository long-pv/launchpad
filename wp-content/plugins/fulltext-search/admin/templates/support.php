<?php

/**  
 * Copyright 2013-2024 Epsiloncool
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 ******************************************************************************
 *  I am thank you for the help by buying PRO version of this plugin 
 *  at https://fulltextsearch.org/ 
 *  It will keep me working further on this useful product.
 ******************************************************************************
 * 
 *  @copyright 2013-2024
 *  @license GPLv3
 *  @package WP Fast Total Search
 *  @author Epsiloncool <info@e-wm.org>
 */

$version_text = '<b>v' . WPFTS_VERSION . '</b>';

$kses = array('p' => array(), 'b' => array(), 'a' => array('href' => array(), 'target' => array(), 'br' => array()));

?>
<h4><?php echo esc_html(__('Support & Docs', 'fulltext-search')); ?></h4>
<form method="post" id="wpftsi_form6">

	<div class="row">
		<div class="col-12">

			<div class="bd-callout bd-callout-info bg-white">
				<p><?php echo esc_html(__('Do you have any questions or difficulties using the plugin? You can find a solution yourself or contact the community.', 'fulltext-search')); ?></p>
				<p><?php echo wp_kses(sprintf(__('Don\'t forget to specify the current version of the plugin %s when you ask questions.', 'fulltext-search'), $version_text), $kses); ?></p>
			</div>
		</div>
	</div>

	<div style="background: #f8f9fa;">
		<table class="table table-bordered table-striped">
			<tr>
				<td>
					<a href="https://fulltextsearch.org/" target="_blank"><?php echo esc_html(__('WPFTS Home', 'fulltext-search')); ?></a>
				</td>
				<td>
					<?php echo esc_html(__('The WP Fast Total Search plugin website', 'fulltext-search')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<a href="https://fulltextsearch.org/documentation" target="_blank"><?php echo esc_html(__('Documentation', 'fulltext-search')); ?></a>
				</td>
				<td>
					<?php echo esc_html(__('Usage and API description', 'fulltext-search')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<a href="https://docs.fulltextsearch.org/forum/" target="_blank"><?php echo esc_html(__('Community Forum', 'fulltext-search')); ?></a>
				</td>
				<td>
					<?php echo esc_html(__('The Community Forum where you can find a solution, ask any question, get the answer and discuss, 100% free for all users.', 'fulltext-search')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<a href="https://wordpress.org/support/plugin/fulltext-search/" target="_blank"><?php echo esc_html(__('Wordpress.org Support', 'fulltext-search')); ?></a>
				</td>
				<td>
					<?php echo esc_html(__('The official Wordpress.org support page for the WP Fast Total Search plugin (only for free version)', 'fulltext-search')); ?>
				</td>
			</tr>
			<tr>
				<td>
					<a href="https://fulltextsearch.org" target="_blank" class="text-danger"><?php echo esc_html(__('Live Chat', 'fulltext-search')); ?></a>
				</td>
				<td>
					<?php echo wp_kses(sprintf(__('The priority direct support that is available for %1s Pro license %2s owners', 'fulltext-search'), '<a href="https://fulltextsearch.org/buy/?from=core_support" target="_blank">', '</a>'), $kses); ?>
				</td>
			</tr>
		</table>

	</div>
</form>
<?php
