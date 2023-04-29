<?php

use Kirby\Cms\App;
use Kirby\Data\Data;
use Kirby\Filesystem\F;

function cachebuster_versionize(App $kirby, string $url, $options = null): string
{
	static $manifest = null;
	static $assetsFolderPath = null;

	if (is_null($manifest)) {
		$assetsFolderPath = ltrim(str_replace($kirby->url('index'), '', $kirby->url('assets')), '/');

		if (F::exists($manifestRoot = $kirby->url('assets') . '/mix-manifest.json')) {
			$manifest = Data::read($manifestRoot);
		} else {
			$manifest = false;
		}
	}

	if (str_starts_with($url, $assetsFolderPath)) {
		$path = substr($url, strlen($assetsFolderPath));

		if (is_array($manifest) && array_key_exists($path, $manifest)) {
			// Use content-based Hash value from mix-manifest.json
			return $assetsFolderPath . $manifest[$path];
		} elseif (F::exists($root = $kirby->root('assets') . $path)) {
			// Calculate id from modified date for performance reason
			// and use md5() to make it look more similar to Laravel Mix’s
			// hash values.
			return $assetsFolderPath . $path .'?id=' . md5(F::modified($root));
		}
	}

	return $url;
}
