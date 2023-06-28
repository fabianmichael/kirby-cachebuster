<?php

use Kirby\Cms\App;

@require_once __DIR__ . '/helpers.php';

App::plugin('fabianmichael/cachebuster', [
	'options' => [
		'active' => true,
	],
	'components' => [
		'css' => fn (App $kirby, string $url, $options = null) => cachebuster_versionize($kirby, $url, $options),
		'js' => fn (App $kirby, string $url, $options = null) => cachebuster_versionize($kirby, $url, $options),
	],
]);
