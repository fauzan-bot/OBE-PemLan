<?php

namespace diecoding\helpers;

use diecoding\base\BaseDiecoding;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2020 Die Coding
 * @license BSD-3-Clause
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class Embedder extends BaseDiecoding
{
    /**
     * @var array
     */
    public static $defaultOptions = [
        "width"       => "100%",
        "height"      => "360",
        "frameborder" => "0",
    ];

    /**
     * Previewer .PDF file
     *
     * @param string $uri the full link with schema.
     * @param array $options the HTML tag attributes (HTML options) in terms of name-value pairs.
     * These will be rendered as the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * If a value is null, the corresponding attribute will not be rendered.
     *
     * For example when using `['class' => 'my-class', 'target' => '_blank', 'value' => null]` it will result in the
     * html attributes rendered like this: `class="my-class" target="_blank"`.
     *
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     * @param string|null $mimeType ex. ```image/png```
     * 
     * @return string base64 format
     */
    public static function pdf($uri, $options = [])
    {
        if (YII_ENV_PROD) {
            $options["src"] = "https://drive.google.com/viewerng/viewer?url={$uri}&embedded=true";

            return Html::tag(
                "iframe",
                null,
                ArrayHelper::merge(static::$defaultOptions, $options)
            );
        }

        $options["src"]  = $uri;
        $options["type"] = "application/pdf";

        return Html::tag(
            "embed",
            null,
            ArrayHelper::merge(static::$defaultOptions, $options)
        );
    }

    /**
     * Previewer .DOC, .DOCX file
     *
     * @param string $uri the full link with schema.
     * @param array $options the HTML tag attributes (HTML options) in terms of name-value pairs.
     * These will be rendered as the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * If a value is null, the corresponding attribute will not be rendered.
     *
     * For example when using `['class' => 'my-class', 'target' => '_blank', 'value' => null]` it will result in the
     * html attributes rendered like this: `class="my-class" target="_blank"`.
     *
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     * @param string|null $mimeType ex. ```image/png```
     * 
     * @return string base64 format
     */
    public static function doc($uri, $options = [])
    {
        $options["src"] = "https://docs.google.com/gview?url={$uri}&embedded=true";

        return Html::tag(
            "iframe",
            null,
            ArrayHelper::merge(static::$defaultOptions, $options)
        );
    }
}
