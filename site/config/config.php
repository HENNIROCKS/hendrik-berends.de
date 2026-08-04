<?php

return array_merge_recursive([

	'activeTheme' => 'hennirocks/hb-theme-v13',

	'cache' => [
		'pages' => [
			'active' => false
		]
	],

	'date' => [
		'handler' => 'intl',
	],

	'debug' => true,

	'locale' => 'de_DE.utf-8',

	'preview-image' => [
		'criticalCount' => 6,
	],

	'slugs' => 'de',

	/**
	 * Additional config files
	 */

	'panel'   => require_once 'panel.php',
	'plugins' => require_once 'plugins.php',
	'routes'  => require_once 'routes.php',
	'thumbs'  => require_once 'thumbs.php',
], require_once 'private.php');
