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
    'Config:Initialized' => 'Plugin Draft sharer chargé',

    'Admin:DraftSharerButtonLabel' => 'Partager votre brouillon',
    'Admin:CopySharerLinkLabel' => 'Copier le lien de partage de votre brouillon',
    'Admin:CopyToClipboard' => 'Copier dans le presse-papier',

    'Setting:TokenDurationLabel' => 'Durée du jeton de lien de partage',
    'Setting:TokenDurationInstructions' => 'Entrer la durée en seconde (par défaut 24 heures)',
];
