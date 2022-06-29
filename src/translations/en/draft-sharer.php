<?php
/**
 * Draft sharer plugin for Craft CMS 3.x
 *
 * Plugin to add a link in the CP to share an entry draft
 *
 * @link      https://github.com/Leeroy-agency
 * @copyright Copyright (c) 2022 Leeroy agency
 */

/**
 * Draft sharer en Translation
 *
 * Returns an array with the string to be translated (as passed to `Craft::t('draft-sharer', '...')`) as
 * the key, and the translation as the value.
 *
 * http://www.yiiframework.com/doc-2.0/guide-tutorial-i18n.html
 *
 * @author    Leeroy agency
 * @package   DraftSharer
 * @since     1.0.0
 */
return [
    'Config:Initialized' => 'Draft sharer plugin loaded',

    'Admin:DraftSharerButtonLabel' => 'Share your draft',
    'Admin:CopySharerLinkLabel' => 'Copy the draft sharer link',
    'Admin:CopyToClipboard' => 'Copy to clipboard',

    'Setting:TokenDurationLabel' => 'Sharing Link Token Duration',
    'Setting:TokenDurationInstructions' => 'Enter duration in seconds (default 24 hours)',
];
