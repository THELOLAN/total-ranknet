<?php
 class Platform_State { protected $_css; protected $_js; protected $_css_classes; public function css_classes() { $this->_process(); return $this->_css_classes; } public function css() { $this->_process(); return $this->_css; } public function js() { $this->_process(); return $this->_js; } protected function _process() { if( $this->_css !== null || $this->_js !== null || $this->_css_classes !== null ) { return; } $this->_css = ''; $this->_js = ''; $this->_css_classes = ''; $this->_process_collapsibles(); $this->_process_backgrounds(); $this->_process_colors(); $this->_process_switcher(); $this->_process_general(); $this->_process_feature_management(); $this->_process_views(); } protected function _process_collapsibles() { $prefs = Platform::client_preference('collapsibles'); if( !is_array($prefs) ) { return; } foreach( $prefs as $collapsible => $visible ) { if( preg_match('`[^a-z0-9_.-]+`is', $collapsible) ) { continue; } if( !$visible ) { $this->_css .= '[data-collapsible=' . $collapsible . '] { display: none; }' . "\n"; } else { $this->_css .= '[data-collapsible=' . $collapsible . '] { display: block; }' . "\n"; } } } protected function _process_backgrounds() { if( !Platform::exists('Platform/Backgrounds') ) { return; } $this->_css .= Platform::backgrounds()->css() . "\n"; $this->_js .= Platform::backgrounds()->js() . "\n"; } protected function _process_colors() { if( !Platform::exists('Platform/Colors') ) { return; } $this->_css .= Platform::colors()->css() . "\n"; $this->_js .= Platform::colors()->js() . "\n"; } protected function _process_switcher() { if( !class_exists('Platform_Switcher') ) { return; } $this->_css .= Platform::switcher()->css() . "\n"; } protected function _process_general() { $this->_css .= Platform::general()->board_width_css(); $this->_css .= Platform::general()->avatars_width_css(); if( Platform::exists('Platform/Sidebar') ) { $prefs = Platform::client_preference('collapsibles'); if( (isset($prefs['sidebar']) && !$prefs['sidebar']) || !Platform::template()->would_show('sidebar') ) { $this->_css .= Platform::general()->sidebar_css('hidden'); } else { $this->_css .= Platform::general()->sidebar_css('shown'); } $this->_js .= Platform::general()->sidebar_js(); } } protected function _process_feature_management() { Platform::load('Platform/FeatureManagement'); $this->_css_classes .= ' ' . trim(Platform_FeatureManagement::css()); } protected function _process_views() { if( !Platform::exists('Platform/Views') ) { return; } $this->_css_classes .= ' ' . trim(Platform::views()->css_classes()); } } 