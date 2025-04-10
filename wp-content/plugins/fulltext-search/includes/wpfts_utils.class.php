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

class WPFTS_Utils 
{
	public static function GetRawCache($object_id, $object_type, $mtime, $is_force_reindex, $cb)
	{
		global $wpfts_core;

		if (!$wpfts_core) {
			return array();
		}
	
		$idx = $wpfts_core->dbprefix();

		$q = 'select 
				* 
			from `'.$idx.'rawcache`
			where 
				`object_id` = "'.addslashes($object_id).'" and 
				`object_type` = "'.addslashes($object_type).'"';
		$res = $wpfts_core->db->get_results($q, ARRAY_A);

		if ((count($res) < 1) || ($res[0]['cached_dt'] != $mtime) || ($is_force_reindex)) {
			// use callback to extract text data
			if ($cb && is_callable($cb)) {

				$v = $cb();

				if ($v) {
				
					$dbarr = array(
						'object_id' => $object_id,
						'object_type' => $object_type,
						'data' => serialize(isset($v['raw_data']) ? $v['raw_data'] : 'No raw data provided'),
						'insert_dt' => date('Y-m-d H:i:s', current_time('timestamp')),
						'cached_dt' => isset($v['modified_time']) ? $v['modified_time'] : '1970-01-01 00:00:00',
						'error' => isset($v['error']) ? $v['error'] : '',
						'filename' => isset($v['filename']) ? $v['filename'] : '',
						'method_id' => isset($v['method_id']) ? $v['method_id'] : '',
					);

					if (count($res) > 0) {
						// Update
						$wpfts_core->db->update(
							$idx.'rawcache', 
							$dbarr,
							array(
								'id' => $res[0]['id']
							));
					} else {
						// Insert
						$wpfts_core->db->insert(
							$idx.'rawcache', ///
							$dbarr
						);
					}

					return $v['raw_data'];

				} else {
					// Something went wrong!
					return array(
						'extract_error' => 'The callback returned false',
					);
				}

			} else {
				// Not callable
				return array(
					'extract_error' => 'The callback not set or not callable',
				);
			}
		} else {
			// Return from cache
			return @unserialize($res[0]['data']);
		}
	}

	public static function GetURLInfo($encoded_url, $is_local_file = false)
	{
		$ret = array(
			'is_valid' => false,
			'is_local' => false,
			'local_path' => '',
			'file_ext' => '',
		);

		$url = self::DecodeURL($encoded_url);

		if ($is_local_file) {
			// Local file
			if (strlen($url) > 0) {
				$ret['is_valid'] = true;
				$ret['is_local'] = true;
				$ret['local_path'] = $url;

				$rem = basename($url);
				$ext = (($p = strrpos($rem, '.')) !== false) ? str_replace(array('/', "\\"), '', substr($rem, $p + 1)) : '';
				$ret['file_ext'] = $ext;
			}
		} else {
			// URL
			$hurl = home_url();

			$p_hurl = wp_parse_url($hurl);
			$purl = wp_parse_url($url);
	
			if (isset($purl['host']) && (strlen($purl['host']) > 0)) {
				$ret['is_valid'] = true;
	
				// Get extension of the file (if present)
				$rem = basename($purl['path']);
				$ext = (($p = strrpos($rem, '.')) !== false) ? str_replace(array('/', "\\"), '', substr($rem, $p + 1)) : '';
				$ret['file_ext'] = $ext;

				// Check if URL local
				if (isset($p_hurl['host']) && (strlen($p_hurl['host']) > 0)) {
					if (mb_strtolower($p_hurl['host']) == mb_strtolower($purl['host'])) {
						// Same domain, ok. Now check path
						$url_path = isset($purl['path']) ? trim(trim($purl['path']), '/') : '';
						$hurl_path = isset($p_hurl['path']) ? trim(trim($p_hurl['path']), '/') : '';
	
						if ((strlen($hurl_path) < 1) || (substr($url_path, 0, strlen($hurl_path)) == $hurl_path)) {
							// Okay, subpath is the same
							$ret['is_local'] = true;
	
							$ret['local_path'] = rtrim(trim(ABSPATH), '/').'/'.ltrim(substr($url_path, strlen($hurl_path)), '/');
						}
					}
				}
			}	
		}

		return $ret;
	}

	public static function DecodeURL($url)
	{
		$path = $url;
		$prefix = '';
		$matches = array();
		if (preg_match('~^([a-zA-Z_]+)\|(.*)$~', $url, $matches)) {
			$prefix = strtolower($matches[1]);
			$path = $matches[2];
		}

		if (($prefix === '') || ($prefix === 'absolute') || ($prefix === 'url')) {
			return $path;
		} else {
			if ($prefix === 'uploads') {
				// Relative to /wp-content/uploads/ path
				$up = wp_upload_dir();
				$up_dir = isset($up['basedir']) ? $up['basedir'].'/' : get_home_path().'/wp-content/uploads/';
				$path = (strlen($path) > 0) ? $up_dir.$path : false;
			} elseif ($prefix === 'relative') {
				// Relative to website root path
				$up_dir = rtrim(get_home_path(), '/').'/';
				$matches2 = array();
				if (preg_match('~^([^\|]+)\|(.*)$~', $path, $matches2)) {
					$subdir = rtrim($matches2[1], '/').'/';
					$path = (strlen($matches[2]) > 0) ? $up_dir.$subdir.ltrim($matches[2], '/') : false;
				} else {
					$path = (strlen($path) > 0) ? $up_dir.'/'.ltrim($path, '/') : false;
				}
			} else {
				// Absolute
			}

			return $path;
		}
	}

	/**
	 * This method returns cached content of the local file by it's given LINK or direct PATH.
	 * If no cache exists yet, it will extract the content and create the cache first.
	 * The modify timestamp of the file is checked, so if the file was reloaded, it will be re-extracted.
	 * 
	 * @param $url The URL of the file (file should be located on the same domain) or the direct full path to the file
	 * @param $is_force_reindex Setting this TRUE will reset cache and re-extract the file content
	 * @param $is_local_file Setting this to TRUE allows to set $url to the LOCAL PATH instead of URL
	 * @param $is_enable_external_links Allows using extarnal URLs in $url
	 * 
	 */
	public static function GetCachedFileContent_ByLocalLink($url, $is_force_reindex = false, $is_local_file = false, $is_enable_external_links = false)
	{
		$chunks = array();

		return apply_filters('wpfts_get_cached_content_by_local_link', $chunks, $url, $is_force_reindex, $is_local_file, $is_enable_external_links);
	}
}