<?php

use Kirby\Cms\App as Kirby;

Kirby::plugin('fabianmichael/cachebuster', [
	'options' => [
		'active' => true,
	],
	'components' => [
		'css' => fn (Kirby $kirby, string $url, $options = null) => cachebuster_versionize($kirby, $url, $options),
		'js' => fn (Kirby $kirby, string $url, $options = null) => cachebuster_versionize($kirby, $url, $options),
	],
]);