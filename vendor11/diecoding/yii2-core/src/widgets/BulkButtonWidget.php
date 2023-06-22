<?php

namespace diecoding\widgets;

use yii\base\Widget;

/**
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2020 Die Coding
 * @license BSD-3-Clause
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class BulkButtonWidget extends Widget
{
    /**
     * @var string $buttons
     */
    public $buttons;

    /**
     * @var string $withSelected
     */
    public $withSelectedLabel = "Data terpilih";

    /**
     * @var string $template
     */
    public $template = <<< HTML
<div class="pull-left">
    <i class="fa fa-check-square" aria-hidden="true"></i> {withSelectedLabel}
    {buttons}
</div>
HTML;

    /**
     * 
     */
    protected $_content;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->_content = strtr($this->template, [
            '{buttons}'           => $this->buttons,
            '{withSelectedLabel}' => $this->withSelectedLabel,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->_content;
    }
}
