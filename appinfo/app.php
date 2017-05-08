<?php
/**
 * ownCloud - gallery application
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Olivier Paroz <owncloud@interfasys.ch>
 * @author Robin Appelman <icewind@owncloud.com>
 *
 * @copyright Olivier Paroz 2014-2016
 * @copyright Robin Appelman 2014-2015
 */

namespace OCA\Gallery\AppInfo;

use OCP\Util;

$app = new Application();
$c = $app->getContainer();
$appName = $c->query('AppName');

/**
 * Loading translations
 *
 * The string has to match the app's folder name
 */
Util::addTranslations('gallery');

// Hack which only loads the scripts in the Files app
$request = $c->query('Request');
if (isset($request->server['REQUEST_URI'])) {
	$url = $request->server['REQUEST_URI'];
	if (preg_match('/apps\/files(_sharing)?$/', $url)
		|| preg_match('%apps/files(_sharing)?[/?]%', $url)
		|| preg_match('%^((?!/apps/).)*/s/\b(.*)\b(?<!/authenticate)$%', $url)
	) {
		// @codeCoverageIgnoreStart
		/**
		 * Scripts for the Files app
		 */
		Util::addScript($appName, 'vendor/bigshot/bigshot-compressed');
		Util::addScript($appName, 'vendor/dompurify/src/purify');
		Util::addScript($appName, 'galleryutility');
		Util::addScript($appName, 'galleryfileaction');
		Util::addScript($appName, 'slideshow');
		Util::addScript($appName, 'slideshowcontrols');
		Util::addScript($appName, 'slideshowzoomablepreview');

		/**
		 * Styles for the Files app
		 */
		Util::addStyle($appName, 'slideshow');
	}
}// @codeCoverageIgnoreEnd
