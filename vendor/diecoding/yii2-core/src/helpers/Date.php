<?php

namespace diecoding\helpers;

use diecoding\base\BaseDiecoding;
use Yii;
use yii\db\Connection;
use yii\db\Expression;
use yii\db\Query;

/**
 * BaseDate provides concrete implementation for [[Date]].
 * 
 * Do not use BaseDate. Use [[Date]] instead.
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2019 Die Coding
 * @license BSD-3-Clause
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class Date extends BaseDiecoding
{
    const FORMAT_TIME = "time()";

    /**
     * @var int
     */
    protected static $_currentDate;

    /**
     * Gets current date from database
     * For return time format use `Date::FORMAT_TIME`
     *
     * @param string $format Date Format. Please refer to `date()` documentation.
     * @link https://php.net/manual/en/function.date.php
     * @return string|int
     */
    public static function format($format = 'Y-m-d', $date)
    {
        $time = is_int($date) ? $date : strtotime($date);
        if ($format === self::FORMAT_TIME) {

            return $time;
        }
        $date = date($format, $time);

        $translate = [
            'April'     => Yii::t('diecoding', 'April'),
            'August'    => Yii::t('diecoding', 'August'),
            'December'  => Yii::t('diecoding', 'December'),
            'February'  => Yii::t('diecoding', 'February'),
            'Friday'    => Yii::t('diecoding', 'Friday'),
            'January'   => Yii::t('diecoding', 'January'),
            'July'      => Yii::t('diecoding', 'July'),
            'June'      => Yii::t('diecoding', 'June'),
            'March'     => Yii::t('diecoding', 'March'),
            'May'       => Yii::t('diecoding', 'May'),
            'Monday'    => Yii::t('diecoding', 'Monday'),
            'November'  => Yii::t('diecoding', 'November'),
            'October'   => Yii::t('diecoding', 'October'),
            'Saturday'  => Yii::t('diecoding', 'Saturday'),
            'September' => Yii::t('diecoding', 'September'),
            'Sunday'    => Yii::t('diecoding', 'Sunday'),
            'Thursday'  => Yii::t('diecoding', 'Thursday'),
            'Tuesday'   => Yii::t('diecoding', 'Tuesday'),
            'Wednesday' => Yii::t('diecoding', 'Wednesday'),
        ];

        return strtr($date, $translate);
    }

    /**
     * Gets current date from database
     *
     * @param string $format Date Format. Please refer to `date()` documentation.
     * @param Connection|null $db the database connection used to generate the SQL statement.
     *                            If this parameter is not given, the `db` application
     *                            component will be used.
     * @return string|int `Date::format()`
     */
    public static function currentDate($format = 'Y-m-d', Connection $db = null)
    {
        if (!static::$_currentDate) {
            $expression = new Expression('CURDATE()');
            $now        = (new Query)->select($expression)->scalar($db);

            static::$_currentDate = $now;
        }

        return static::format($format, static::$_currentDate);
    }

    /**
     * Gets current datetime from database
     *
     * @param string $format Datetime Format. Please refer to `date()` documentation.
     * @param Connection|null $db the database connection used to generate the SQL statement.
     *                            If this parameter is not given, the `db` application
     *                            component will be used.
     * @return string|int `Date::format()`
     */
    public static function currentDateTime($format = 'Y-m-d H:i:s', Connection $db = null)
    {
        $expression = new Expression('NOW()');
        $now        = (new Query)->select($expression)->scalar($db);

        return static::format($format, $now);
    }
}
