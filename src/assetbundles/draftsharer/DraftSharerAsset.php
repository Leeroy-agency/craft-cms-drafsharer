<?php
/**
 * Draft sharer plugin for Craft CMS 3.x
 *
 * Plugin to add a link in the CP to share an entry draft
 *
 * @link      https://github.com/Leeroy-agency
 * @copyright Copyright (c) 2022 Leeroy agency
 */

namespace leeroy\draftsharer\assetbundles\draftsharer;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * DraftSharerAsset AssetBundle
 *
 * AssetBundle represents a collection of asset files, such as CSS, JS, images.
 *
 * Each asset bundle has a unique name that globally identifies it among all asset bundles used in an application.
 * The name is the [fully qualified class name](http://php.net/manual/en/language.namespaces.rules.php)
 * of the class representing it.
 *
 * An asset bundle can depend on other asset bundles. When registering an asset bundle
 * with a view, all its dependent asset bundles will be automatically registered.
 *
 * http://www.yiiframework.com/doc-2.0/guide-structure-assets.html
 *
 * @author    Leeroy agency
 * @package   DraftSharer
 * @since     1.0.0
 */
class DraftSharerAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * Initializes the bundle.
     */
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = "@leeroy/draftsharer/assetbundles/draftsharer/dist";

        // define the dependencies
        $this->depends = [
            CpAsset::class,
        ];

        $this->css = [
            "css/draft-sharer.css"
        ];

        $this->js = [
            "js/draft-sharer.js"
        ];

        parent::init();
    }
}
