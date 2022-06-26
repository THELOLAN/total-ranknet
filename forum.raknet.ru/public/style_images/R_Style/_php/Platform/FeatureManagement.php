<?php
 class Platform_FeatureManagement { static protected $_features; static protected $_js; static protected $_css; static protected function _load() { if( self::$_features === null ) { $settings = Platform::settings('features'); if( Platform::toolbox()->memberData['userAgentKey'] == 'explorer' && isset($settings['ie']) ) { self::$_features = array_merge($settings['all'], $settings['ie']); } else { self::$_features = $settings['all']; } } } static public function features() { self::_load(); return self::$_features; } static public function feature($name, $explicit = false) { self::_load(); if( isset(self::$_features[$name]) ) { return self::$_features[$name]; } else { return $explicit == false ? true : false; } } static public function js() { if( self::$_js === null ) { self::_build(); } return self::$_js; } static public function css($for = 'auto') { if( $for == 'auto' ) { if( Platform::toolbox()->memberData['userAgentKey'] == 'explorer' ) { $browser_class = 'msie-' . self::ie_version(); return $browser_class . ' ' . self::css('all') . ' ' . self::css('ie'); } else { return self::css('all'); } } if( self::$_css === null ) { self::_build(); } if( isset(self::$_css[$for]) ) { return implode(' ', self::$_css[$for]); } } static public function ie_version() { if( preg_match('/MSIE ([0-9]{1})/', $_SERVER['HTTP_USER_AGENT'], $version_string) ) { return intval($version_string[1]); } return false; } static protected function _build() { self::$_css = array(); self::$_js = ''; $settings = Platform::settings('features'); foreach($settings as $for => $features) { self::$_css[$for] = array(); if( $for == 'ie' ) { self::$_js .= 'if( jQuery.browser.msie ){' . "\n"; } foreach($features as $feature => $state) { if( !$state ) { if( method_exists('Platform_FeatureManagement', 'turn_off_' . $feature) ) { self::$_js .= call_user_func_array(array('Platform_FeatureManagement','turn_off_' . $feature), array()); } self::$_css[$for][] = 'feature-' . $feature . '-off'; } else { self::$_css[$for][] = 'feature-' . $feature . '-on'; } } if( $for == 'ie' ) { self::$_js .= '}' . "\n"; } self::$_js .= "\n\n"; } } static public function turn_off_dropdowns() { return 'Platform.dropdowns = function(){};'; } static public function turn_off_toplink() { return 'Platform.topLink = function(){};'; } static public function turn_off_popups() { return 'Platform.boxes = function(){}; Platform.domboxes = function(){};'; } static public function turn_off_post_excerpts() { return 'Platform.hoverToggler = function(){};'; } static public function turn_off_background_picker() { return 'Platform.backgroundPicker = function(){};'; } static public function turn_off_animations() { return 'Platform.getCore().options.animation = false;'; } static public function turn_off_hooks_animations() { return 'Platform.getCore().options.hooks_animations = false;'; } static public function turn_off_sortable() { return 'Platform.sortable = function(){};'; } static public function turn_off_sortable_sidebar() { return 'if(Platform.getCore().options.sortables == undefined) Platform.getCore().options.sortables = {}; Platform.getCore().options.sortables.sidebar = false;'; } static public function turn_off_sortable_categories() { return 'if(Platform.getCore().options.sortables == undefined) Platform.getCore().options.sortables = {}; Platform.getCore().options.sortables.categories = false;'; } } 