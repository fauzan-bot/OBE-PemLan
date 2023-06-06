<?php

namespace diecoding\helpers;

use diecoding\base\BaseDiecoding;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2019 Die Coding
 * @license BSD-3-Clause
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class Icon extends BaseDiecoding
{
    private static $_materialIcon;

    /**
     * Material Icon HEX
     * 
     * ```json
     * ...
     * [
     *     "access-point" => [
     *         "id" => "4F013652-22DE-48CF-886B-A0FB995E8B41",
     *         "name" => "access-point",
     *         "codepoint" => "F002",
     *         "aliases" => ["wireless"],
     *         "tags" => [],
     *         "author" => "Cody",
     *         "version" => "1.5.54",
     *         "path" => "M4.93,4.93C3.12,6.74..."
     *     ]
     * ]
     * ...
     * ````
     *
     * @param string|null $name icon name
     * @param string|null $prefix
     * @return array
     */
    public static function material($name = null, $prefix = "mdi mdi-")
    {
        $name = strtolower($name);

        if (static::$_materialIcon === null) {
            $json = file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "material.icon.json");
            $array = Json::decode($json);
            static::$_materialIcon = ArrayHelper::index($array, function ($element) use ($prefix) {
                return "{$prefix}{$element['name']}";
            });
        }

        $materialIcon = static::$_materialIcon;
        if ($name)
            $materialIcon = static::$_materialIcon[$prefix . $name];

        return $materialIcon;
    }
}
