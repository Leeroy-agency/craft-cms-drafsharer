<?php
/**
 * Draft sharer plugin for Craft CMS 3.x
 *
 * Plugin to add a link in the CP to share an entry draft
 *
 * @link      https://github.com/Leeroy-agency
 * @copyright Copyright (c) 2022 Leeroy agency
 */

namespace leeroy\draftsharertests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use leeroy\draftsharer\DraftSharer;

/**
 * ExampleUnitTest
 *
 *
 * @author    Leeroy agency
 * @package   DraftSharer
 * @since     1.0.0
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            DraftSharer::class,
            DraftSharer::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
