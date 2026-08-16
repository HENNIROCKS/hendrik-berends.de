<?php

require_once __DIR__ . '/helpers.php';

\Beebmx\KirbyEnv::load(dirname(__DIR__, 2));

$config = [

	'auth' => [
		'debug' => true,
		'methods' => [
			'password' => ['2fa' => false]
		]
	],

	// The pages cache has no notion of sessions: whatever it stores is handed
	// to every visitor. Private articles depend on the session, so they must
	// never enter it - the unlocked version would be served to everyone. The
	// error page draws a random GIF and would freeze on whichever one landed
	// in the cache first.
	'cache' => [
		'pages' => [
			'active' => true,
			'ignore' => fn ($page) =>
				$page->private()->toBool() || $page->isErrorPage(),
		]
	],

	'content.salt' => env('CONTENT_SALT'),

	'cookie.key' => env('COOKIE_KEY'),

	'date' => [
		'handler' => 'intl',
	],

	'debug' => true,

	// Kirby hardcodes the translation locale to `en` on single-language sites,
	// so the plugin's German translation never applies here.
	'foerdeliebe-sh.kirby-website-carbon.link.title' => 'Mehr über Website Carbon erfahren',

	'locale' => 'de_DE.utf-8',

	'panel' => [
		'language' => 'de',
		'vue.compiler' => false,
	],

	'preview-image' => [
		'criticalCount' => 6,
	],

	'routes' => require_once 'routes.php',

	'sitemap.ignore' => ['error'],

	'slugs' => 'de',

	'thumbs' => require_once 'thumbs.php',
];

return array_merge($config, require_once 'plugins.php');
