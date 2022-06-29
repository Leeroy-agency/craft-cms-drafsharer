<?php
/**
 * Draft sharer plugin for Craft CMS 3.x
 *
 * Plugin to add a link in the CP to share an entry draft
 *
 * @link      https://github.com/Leeroy-agency
 * @copyright Copyright (c) 2022 Leeroy agency
 */

namespace leeroy\draftsharer\models;

use leeroy\draftsharer\DraftSharer;

use Craft;
use craft\base\Model;

/**
 * DraftSharer Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Leeroy agency
 * @package   DraftSharer
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    const TOKEN_DURATION = 86400;

    /**
     * Token duration
     *
     * @var int
     */
    public int $tokenDuration = self::TOKEN_DURATION;

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['tokenDuration', 'integer'],
            ['tokenDuration', 'default', 'value' => self::TOKEN_DURATION],
        ];
    }
}
