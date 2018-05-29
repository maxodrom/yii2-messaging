<?php
/**
 * Yii2 messaging module.
 *
 * @author Max Alexandrov <max@7u3.ru>
 * @copyright Copyright (c) Max Alexandrov, 2018
 * @license MIT License
 */

namespace maxodrom\messaging;

/**
 * Class Migration
 * @package maxodrom\messaging\migrations
 * @since 1.0
 */
class Migration extends \yii\db\Migration
{
    /**
     * @return null|string
     */
    public function getTableOptions()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        return $tableOptions;
    }
}