<?php
/**
 * Yii2 messaging module.
 *
 * @author Max Alexandrov <max@7u3.ru>
 * @copyright Copyright (c) Max Alexandrov, 2018
 * @license MIT License
 */

namespace maxodrom\messaging;

use Yii;
use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApp;
use yii\db\Connection;
use yii\di\Instance;
use yii\web\Application as WebApp;

/**
 * Class Module
 * @package maxodrom\messaging
 * @since 1.0
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = 'maxodrom\messaging\controllers';
    /**
     * @var \yii\db\Connection|array|string DB component.
     */
    public $db = 'db';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::class);
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $this->setAliases([
            '@messaging' => '@vendor/maxodrom/yii2-messaging/src',
        ]);

        if ($app instanceof WebApp) {
            // do nothing
        } elseif ($app instanceof ConsoleApp) {
            $this->controllerNamespace = 'maxodrom\messaging\commands';
            Yii::setAlias('@maxodrom/messaging/commands', __DIR__ . '/commands');
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $this->db->tablePrefix = $this->id . '_';

        return true;
    }
}