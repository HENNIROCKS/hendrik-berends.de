<?php

return [

	'activeTheme' => 'hennirocks/hb-theme-v13',

	'date' => [
		'handler' => 'intl',
	],

	'debug' => true,

	'locale' => 'de_DE.utf-8',

	'slugs' => 'de',

	/** 
	 * Additional config files
	 */

	'panel'   => require_once 'panel.php',
	'private' => require_once 'private.php',
	'routes'  => require_once 'routes.php',
	'thumbs'  => require_once 'thumbs.php',
];
