<?php

namespace diecoding\base;

use Yii;
use yii\base\Component;

/**
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2020 Die Coding
 * @license BSD-3-Clause
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class BaseDiecoding extends Component
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!isset(Yii::$app->i18n->translations['diecoding'])) {
            Yii::$app->i18n->translations['diecoding'] = [
                'class'          => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath'       => '@diecoding/languages',
            ];
        }
    }
}
