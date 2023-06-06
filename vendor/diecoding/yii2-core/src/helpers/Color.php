<?php

namespace diecoding\helpers;

use diecoding\base\BaseDiecoding;
use yii\helpers\Json;

/**
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2019 Die Coding
 * @license BSD-3-Clause
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class Color extends BaseDiecoding
{
    private static $_materialColor;

    /**
     * Material Color HEX
     *
     * @param string|null $color RED - BLUEGREY
     * @param string|null $shade 50 - A700
     * @return mixed
     */
    public static function material($color = null, $shade = null)
    {
        $color = strtolower($color);
        $shade = strtolower($shade);

        if (static::$_materialColor === null) {
            $json = file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "material.color.json");
            static::$_materialColor = Json::decode($json);
        }

        $materialColor = static::$_materialColor;
        if ($color && $shade)
            $materialColor = static::$_materialColor[$color][$shade];
        else if ($color)
            $materialColor = static::$_materialColor[$color];

        return $materialColor;
    }
}
