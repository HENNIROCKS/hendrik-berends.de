<?php

\Beebmx\KirbyEnv::load(dirname(__DIR__, 2));

return [

	'activeTheme' => 'hennirocks/hb-theme-v13',

	'auth' => [
		'debug' => true,
		'methods' => [
			'password' => ['2fa' => false]
		]
	],

	'cache' => [
		'pages' => [
			'active' => false
		]
	],

	'content.salt' => env('CONTENT_SALT'),

	'cookie.key' => env('COOKIE_KEY'),

	'date' => [
		'handler' => 'intl',
	],

	'debug' => true,

	'locale' => 'de_DE.utf-8',

	'panel' => [
		'language' => 'de',
		'vue.compiler' => false,
	],

	'plugins' => require_once 'plugins.php',

	'preview-image' => [
		'criticalCount' => 6,
	],

	'routes' => require_once 'routes.php',

	'sitemap.ignore' => ['error'],

	'slugs' => 'de',

	'thumbs' => require_once 'thumbs.php',
];
