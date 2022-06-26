<?php
 class Platform_Javascript { const JQUERY = '1.7.1'; static public function include_files() { $files = func_get_args(); self::reload_files($files); $jq = ''; if( !defined('JQUERY') ) { define('JQUERY', self::JQUERY); if( file_exists(Platform::root() . '../_js/jquery.js') ) { $jq = '<script type="text/javascript" src="{style_images_url}/_js/jquery.js"></script>'; } else { $jq = '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/' . self::JQUERY . '/jquery.min.js"></script>'; } } return $jq . "\n" . '<script type="text/javascript" src="{style_images_url}/_cache/Platform.js"></script>'; } static public function reload_files($files) { foreach($files as $file) { if( $file == 'dynamic' ) { $mtimes[] = self::get_dynamic_mtime(); } else { $mtimes[] = filemtime(Platform::root() . '../_js/' . $file . '.js'); } } $max_mtime = max($mtimes); if( !(file_exists(Platform::root() . '../_cache/Platform.js') && filemtime(Platform::root() . '../_cache/Platform.js') == $max_mtime) ) { $output = ''; foreach($files as $file) { if( $file == 'dynamic' ) { $output .= self::get_dynamic_file(); } else { $output .= file_get_contents(Platform::root() . '../_js/' . $file . '.js'); $output .= "\n\n\n"; } } if( file_exists(Platform::root() . '../_cache/Platform.js') ) { unlink(Platform::root() . '../_cache/Platform.js'); } $fp = fopen(Platform::root() . '../_cache/Platform.js', 'w'); if( !$fp ) { throw new Exception('Unable to write js to cache'); } fwrite($fp, $output); fclose($fp); touch(Platform::root() . '../_cache/Platform.js', $max_mtime, $max_mtime); } } static public function get_dynamic_file() { Platform::load('Platform/FeatureManagement'); return 'window.skinName = "' . addslashes(Platform::get_skin()) . '"; window.skinBaseUrl = "' . Platform::toolbox()->settings['board_url'] . '/public/style_images/' .Platform::toolbox()->registry->getClass('output')->skin['set_image_dir'] . '";' . "\n\n" . Platform_FeatureManagement::js() . "\n\n" . Platform::state()->js(); } static public function get_dynamic_mtime() { return filemtime(Platform::root() . '../_config/features.ini'); } } 