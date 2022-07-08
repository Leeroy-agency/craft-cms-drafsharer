<?php
/**
 * Draft sharer plugin for Craft CMS 3.x
 *
 * Plugin to add a link in the CP to share an entry draft
 *
 * @link      https://github.com/Leeroy-agency
 * @copyright Copyright (c) 2022 Leeroy agency
 */

namespace leeroy\draftsharer\controllers;

use craft\elements\Entry;
use craft\helpers\DateTimeHelper;
use craft\helpers\UrlHelper;
use craft\records\Element_SiteSettings;
use leeroy\draftsharer\DraftSharer;

use Craft;
use craft\web\Controller;
use leeroy\draftsharer\models\Settings;
use Throwable;
use yii\console\Response;
use yii\web\BadRequestHttpException;

/**
 * Default Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Leeroy agency
 * @package   DraftSharer
 * @since     1.0.0
 */
class ShareController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected array|int|bool $allowAnonymous = ['preview-draft'];

    // Public Methods
    // =========================================================================

    /**
     * Create a link with a token to share an entry draft
     *
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionDraftSharerLink():string
    {
        $entryId = $this->request->post('entryId');
        $draftId = $this->request->post('draftId');
        $siteId = $this->request->post('siteId');

        if (!isset($entryId) || !isset($draftId)) {
            throw new BadRequestHttpException('Missing entry data');
        }

        $entry = Entry::find()->id($entryId)->one();


        $generalConfig = Craft::$app->getConfig()->getGeneral();
        $expiryDate = null;

        if ($generalConfig->defaultTokenDuration != DraftSharer::$plugin->settings->tokenDuration
        || DraftSharer::$plugin->settings->tokenDuration != Settings::TOKEN_DURATION) {
            $interval = DateTimeHelper::secondsToInterval(DraftSharer::$plugin->settings->tokenDuration);
            $expiryDate = DateTimeHelper::currentUTCDateTime();
            $expiryDate->add($interval);
        }

        $token = Craft::$app->tokens->createToken(['draft-sharer/share/preview-draft', [
            'entryUid' => $entry->uid,
            'draftId' => $draftId,
            'siteId' => $siteId
        ]], null, $expiryDate);

        return UrlHelper::actionUrl("draft-sharer/share/preview-draft", [
            "t" => $token,
            "e" => $entry->uid
        ]);
    }

    /**
     * Display the preview for a given token
     *
     * @return string Html
     * @throws BadRequestHttpException|Throwable
     */
    public function actionPreviewDraft(): string
    {
        $token = Craft::$app->request->getQueryParam('t');
        $uid = Craft::$app->request->getQueryParam('e');

        if (!isset($token) || !isset($uid)) {
            throw new BadRequestHttpException('Missing parameters for this link');
        }

        $tokenResult = Craft::$app->tokens->getTokenRoute($token);

        // Is the entry uid is ok
        if (is_array($tokenResult) && isset($tokenResult[1]) && isset($tokenResult[1]['entryUid']) && $tokenResult[1]['entryUid'] == $uid) {
            $siteId = $tokenResult[1]['siteId'] ?? 2;
            $site = Craft::$app->getSites()->getSiteById($siteId);
            $entry = Entry::find()->draftId($tokenResult[1]['draftId'])->site($site)->one();

            $template = $entry->section->siteSettings[$siteId]->template;

            return $this->view->renderTemplate($template, [
                'entry' => $entry,
                'currentSite' => $site,
                'siteName' => $site->name,
                'siteUrl' => $site->getBaseUrl()
            ]);
        }
        throw new BadRequestHttpException('Invalid or expired link');
    }
}
