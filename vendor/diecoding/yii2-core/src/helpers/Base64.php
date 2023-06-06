<?php

namespace diecoding\helpers;

use diecoding\base\BaseDiecoding;

/**
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2019 Die Coding
 * @license BSD-3-Clause
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class Base64 extends BaseDiecoding
{
    /**
     * Encode Base64
     *
     * @param string $path
     * @param string|null $mimeType ex. ```image/png```
     * 
     * @return string base64 format
     */
    public static function encode($path, $mimeType = null)
    {
        $data   = file_get_contents($path);
        $base64 = base64_encode($data);

        return $mimeType ? "data:{$mimeType};base64,{$base64}" : $base64;
    }

    /**
     * Decode Base64
     *
     * @param string $base64
     * @param string|null $mimeType ex. ```image/png```
     * @return void
     */
    public static function decode($base64, $mimeType = null)
    {
        if (strpos($base64, ";base64,") !== false) {
            $data   = explode(";base64,", $base64);
            $output = $mimeType ? "data:{$mimeType};base64,{$data[1]}" : $data;
        } else {
            $output = "data:{$mimeType};base64,{$base64}";
        }

        return $output;
    }
}
