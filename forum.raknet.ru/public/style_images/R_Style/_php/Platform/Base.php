<?php
 class Platform_Base { static protected $_singletons = array(); static protected $_skin; static protected $_root; static protected $_instance; static protected $_config; static protected $_client_preference; static protected $_settings; static protected $_write_preference_asap = false; static public function error($message) { echo '<html><body><h1>Oops! Something went wrong.</h1><h5>Error message from a Skinbox skin</h5><p>' . $message . '</p></body></html>'; exit; } static public function is_dev() { if( is_dir(DOC_IPS_ROOT_PATH . 'devkit') ) { return true; } else { return false; } } static public function skin($name) { self::$_skin = $name; if( self::$_write_preference_asap ) { self::write_client_preferences(); } if( Platform::exists('Platform/RevertToDefault') ) { Platform::load('Platform/RevertToDefault'); $revert = new Platform_RevertToDefault(); $revert->process(); } } static public function get_skin() { return self::$_skin; } static public function root() { if( self::$_root === null ) { self::$_root = dirname(__FILE__) . '/../'; if( !is_dir(self::$_root . '../_cache') ) { @mkdir(self::$_root . '../_cache'); if( !is_dir(self::$_root . '../_cache') ) { self::error('Please create a directory in ' . realpath(self::$_root) . ' called _cache.'); } } } return self::$_root; } static public function load($library) { if( !file_exists(self::root() . $library . '.php') ) { if( self::is_dev() ) { throw new Exception('Could not locate library: ' . $library . '.'); self::error('Please add ' . $library . ' on a new line to _php/manifest and rebuild the skin.'); } else { self::error('There is something wrong with the imageset of this skin. Try reinstalling it or contact Skinbox.'); } } require_once self::root() . $library . '.php'; } static public function exists($library) { return file_exists(self::root() . $library . '.php'); } static public function javascript() { if( !class_exists('Platform_Javascript') ) { self::load('Platform/Javascript'); } $args = func_get_args(); return call_user_func_array(array('Platform_Javascript', 'include_files'), $args); } static public function javascripts() { return self::javascript('build', 'dynamic', 'skin'); } static public function css_classes() { if( !class_exists('Platform_State') ) { self::load('Platform/State'); } if( !class_exists('Platform_FeatureManagement') ) { self::load('Platform/FeatureManagement'); } return self::state()->css_classes(); } static public function state() { return self::_singleton('Platform', 'State'); } static public function feature($name) { if( !class_exists('Platform_FeatureManagement') ) { self::load('Platform/FeatureManagement'); } return Platform_FeatureManagement::feature($name); } static public function general() { return self::_singleton('Platform', 'General'); } static public function avatars() { return self::_singleton('Platform', 'Avatars'); } static public function switcher() { return self::_singleton('Platform', 'Switcher'); } static public function backgrounds() { return self::_singleton('Platform', 'Backgrounds'); } static public function colors() { return self::_singleton('Platform', 'Colors'); } static public function style_picker() { return self::_singleton('Platform', 'StylePicker'); } static public function sortable() { return self::_singleton('Platform', 'Sortable'); } static public function hooks() { return self::_singleton('Platform', 'Hooks'); } static public function sidebar() { return self::_singleton('Platform', 'Sidebar'); } static public function views() { return self::_singleton('Platform', 'Views'); } static public function date() { return self::_singleton('Platform', 'Date'); } static public function statistics() { return self::_singleton('Platform', 'Statistics'); } static public function forums() { return self::_singleton('Platform', 'Forums'); } static public function toolbox() { return self::_singleton('Platform', 'Toolbox'); } static public function css() { return self::_singleton('Platform', 'Css'); } static public function template() { return self::_singleton('Platform', 'Template'); } static public function module($name) { $class = 'Platform_Module_' . $name; if( !class_exists($class) ) { self::load('Platform/Module/' . $name); } return new $class(); } static public function config($array = null, $sub = null) { if( $array === null ) { return self::$_config; } elseif( gettype($array) == 'string' ) { if( $sub === null ) { return self::$_config[$array]; } else { return self::$_config[$array][$sub]; } } else { self::$_config = $array; } } static public function client_preference($key) { if( self::$_client_preference === null ) { if( isset($_COOKIE['platform_storage_' . self::$_skin]) ) { if( IPS_MAGIC_QUOTES ) { $_COOKIE['platform_storage_' . self::$_skin] = stripslashes($_COOKIE['platform_storage_' . self::$_skin]); } self::$_client_preference = json_decode($_COOKIE['platform_storage_' . self::$_skin], true); } else { self::$_client_preference = array(); } } if( isset(self::$_client_preference[$key]) ) { return self::$_client_preference[$key]; } else { return null; } } static public function set_client_preference($key, $value, $write = true) { self::client_preference('dummy'); self::$_client_preference[$key] = $value; if( $write === true ) { self::write_client_preferences(); } } static public function unset_client_preference($key, $write = true) { self::client_preference('dummy'); unset(self::$_client_preference[$key]); if( $write === true ) { self::write_client_preferences(); } } static public function write_client_preferences() { if( self::$_skin === null ) { self::$_write_preference_asap = true; return; } setcookie('Platform_storage_' . self::$_skin, json_encode(self::$_client_preference), 10*3600*24+time(), '/'); } static public function settings_mtime($ns) { return filemtime(self::root() . '../_config/' . $ns . '.ini'); } static public function settings($ns, $section = true) { if( self::$_settings !== null && isset(self::$_settings[$ns]) ) { return self::$_settings[$ns]; } $settings = self::root() . '../_cache/settings_' . $ns . '.php'; $file = self::root() . '../_config/' . $ns . '.ini'; if( false && file_exists($settings) && filemtime($settings) >= filemtime($file) ) { self::$_settings[$ns] = include($settings); return self::$_settings[$ns]; } else { $data = self::_parse_ini($file, $section); if( $section ) { $tmp = $data; $data = array(); foreach( $tmp as $key => $value ) { if( strpos($key, '.') !== false ) { $path = explode('.', $key); self::_process_path($data, $value, $path); } else { $data[$key] = $value; } } } $write = '<?php
      
      return unserialize("' . addslashes(serialize($data)) . '");'; if( file_exists($settings) ) @unlink($settings); $fp = @fopen($settings, 'w'); if( !$fp ) return $data; @fwrite($fp, $write); @fclose($fp); return $data; } } static protected function _process_path(&$parent_ref, &$value, &$path, $cursor = 0, $max_depth = 5) { if( $max_depth === ($cursor-1) ) { throw new Exception('INI file: level too deep.'); } if( !isset($path[$cursor]) ) { $parent_ref = $value; return; } if( !isset($parent_ref[ $path[$cursor] ] ) ) { $parent_ref[ $path[$cursor] ] = array(); } $child_ref =& $parent_ref[ $path[$cursor] ]; self::_process_path($child_ref, $value, $path, $cursor+1, $max_depth); } static protected function _parse_ini($file, $section) { if( function_exists('parse_ini_file') ) { $data = parse_ini_file($file, $section); return $data; } else { $lines = file($file); $data = array(); $section_binding =& $data; $value_binding = null; foreach($lines as &$line) { $line = trim($line); if( empty($line) || $line{0} === ';' ) { continue; } $comment_pos = strpos($line, ';'); if( $comment_pos !== false ) { $line = substr($line, 0, $comment_pos); $line = trim($line); } if( $line{0} === '[' && $line{strlen($line)-1} === ']' ) { unset($section_binding); $section_binding =& $data[substr($line, 1, strlen($line)-2)]; if( $section_binding === null ) { $section_binding = array(); } continue; } $parts = explode('=', $line, 2); $parts = array_map('trim', $parts); if( !isset($section_binding[$parts[0]]) ) { $section_binding[$parts[0]] = null; } if( isset($value_binding) ) { unset($value_binding); } $value_binding =& $section_binding[$parts[0]]; if( ($parts[1]{0} === '"' || $parts[1]{0} === '\'') && $parts[1]{strlen($parts[1])-1} === $parts[1]{0} ) { $value_binding = substr($parts[1], 1, strlen($parts[1])-2); } elseif( in_array(strtolower($parts[1]), array('on', 'true')) ) { $value_binding = true; } elseif( in_array(strtolower($parts[1]), array('off', 'false')) ) { $value_binding = false; } elseif( strval(floatval($parts[1])) === $parts[1] ) { $value_binding = floatval($parts[1]); } elseif( strval(intval($parts[1])) === $parts[1] ) { $value_binding = intval($parts[1]); } else { $value_binding = $parts[1]; } } unset($section_binding, $value_binding, $line); return $data; } } static protected function _singleton($namespace, $module) { $class = $namespace . '_' . $module; if( !isset(self::$_singletons[$class]) ) { self::load($namespace . '/' . $module); self::$_singletons[$class] = new $class; } return self::$_singletons[$class]; } } 