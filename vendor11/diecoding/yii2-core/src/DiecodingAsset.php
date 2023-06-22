<?php

namespace diecoding;

use yii\web\AssetBundle;

/**
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2020 Die Coding
 * @license BSD-3-Clause
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class DiecodingAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@diecoding/assets';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->css = YII_DEBUG ? [
            'ajaxcrud.css',
        ] : [
            'ajaxcrud.min.css',
        ];

        $this->js = YII_DEBUG ? [
            'ModalRemote.js',
            'ajaxcrud.js',
            'jquery.steps.custom.js',
            'replace-yii2-dynamic-form.js',
        ] : [
            'ModalRemote.min.js',
            'ajaxcrud.min.js',
            'jquery.steps.custom.min.js',
            'replace-yii2-dynamic-form.min.js',
        ];

        parent::init();
    }
}
