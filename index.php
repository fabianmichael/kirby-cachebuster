<?php

use Kirby\Cms\App as Kirby;

@require_once __DIR__ . '/helpers.php';

Kirby::plugin('fabianmichael/cachebuster', [
	'options' => [
		'active' => true,
	],
	'components' => [
		'css' => fn (Kirby $kirby, string $url, $options = null) => cachebuster_versionize($kirby, $url, $options),
		'js' => fn (Kirby $kirby, string $url, $options = null) => cachebuster_versionize($kirby, $url, $options),
	],
]);
