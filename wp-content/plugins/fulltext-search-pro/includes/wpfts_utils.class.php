<?php

class WPFTS_Utils 
{
	public static function GetRawCache($object_id, $object_type, $mtime, $is_force_reindex, $cb)
	{
		global $wpdb, $wpfts_core;

		if (!$wpfts_core) {
			return array();
		}
	
		$idx = $wpfts_core->GetDBPrefix();

		$q = 'select 
				* 
			from `'.$idx.'rawcache`
			where 
				`object_id` = "'.addslashes($object_id).'" and 
				`object_type` = "'.addslashes($object_type).'"';
		$res = $wpdb->get_results($q, ARRAY_A);

		if ((count($res) < 1) || ($res[0]['cached_dt'] != $mtime) || ($is_reset_cache)) {
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
						$wpdb->update(
							$idx.'rawcache', 
							$dbarr,
							array(
								'id' => $res[0]['id']
							));
					} else {
						// Insert
						$wpdb->insert(
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

	public static function GetURLInfo($url)
	{
		$ret = array(
			'is_valid' => false,
			'is_local' => false,
			'local_path' => '',
		);

		$hurl = home_url();

		$p_hurl = parse_url($hurl);
		$purl = parse_url($url);

		if (isset($purl['host']) && (strlen($purl['host']) > 0)) {
			$ret['is_valid'] = true;

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

		return $ret;
	}

	public static function GetCachedFileContent_ByLocalLink($url, $is_force_reindex = false)
	{
		$chunks = array();

		if (strlen($url) > 0) {

			$url_info = self::GetURLInfo($url);

			if ($url_info['is_valid'] && $url_info['is_local']) {

				$local = $url_info['local_path'];

				if ($local && is_file($local) && file_exists($local)) {

					// It's time to check the cache
					$mtime = date('Y-m-d H:i:s', filemtime($local));
					$hash = 'localurl-'.md5('localurl-hash-'.$url);
					
					$chunks = self::GetRawCache(-1, $hash, $mtime, $is_force_reindex, function() use ($url, $local, $mtime)
					{
						global $wpdb, $wpfts_core;

						if (!$wpfts_core) {
							return false;
						}
					
						$chunks = array(
							'post_title' => '',
							'post_content' => '',
						);

						if (function_exists('wpfts_extract_text')) {
							$t = wp_check_filetype($local, wp_get_mime_types());

							if (isset($t['type'])) {
								$t2 = wpfts_extract_text($local, $t['type']);
		
								if (isset($t2['content'])) {
									$chunks['post_content'] = $t2['content'];
								}
		
								$ch2 = $chunks;
								$method = isset($t2['method']) ? $t2['method'] : '';
								unset($ch2['method']);
		
								return array(
									'raw_data' => $ch2,
									'modified_time' => $mtime,
									'error' => $t2['error'],
									'filename' => $url,
									'method_id' => $method,
								);
	
							}
						}

						return false;
					});

				} else {
					$chunks['extract_error'] = 'Local file not exists: '.$local;
				}

			} else {
				$chunks['extract_error'] = 'file link is not correct: '.$url;
			}

		} else {
			$chunks['extract_error'] = 'file url is empty';
		}					

		return $chunks;
	}
}