<?php
 if( class_exists('Platform') ) { return true; } require_once dirname(__FILE__) . '/Platform/Base.php'; class Platform extends Platform_Base { } $skin = Platform::settings('skin', false); Platform::skin($skin['name']); Platform::load('Platform/Collection'); Platform::load('Platform/Getter'); Platform::toolbox();