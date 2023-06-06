<?php

namespace diecoding\behaviors;

use Yii;
use diecoding\helpers\Date as DateHelper;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

/**
 * @inheritdoc
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2019 Die Coding
 * @license MIT
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class TouchDbBehavior extends Behavior
{
    /**
     * 
     */
    public $createdAt = 'created_at';

    /**
     * 
     */
    public $updatedAt = 'updated_at';

    /**
     * 
     */
    public $createdUser = 'created_user';

    /**
     * 
     */
    public $updatedUser = 'updated_user';

    /**
     * 
     */
    public $valueAt;

    /**
     * 
     */
    public $valueUser;

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'createLog',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'updateLog',
        ];
    }

    /**
     * @param \yii\base\Event $event
     */
    public function createLog(Event $event)
    {
        /**
         * @var ActiveRecord $owner
         */
        $owner = $this->owner;

        $createdAt   = $this->createdAt;
        $updatedAt   = $this->updatedAt;
        $createdUser = $this->createdUser;
        $updatedUser = $this->updatedUser;

        if ($createdAt)
            $owner->$createdAt = $this->valueAt ?: DateHelper::currentDateTime();

        if ($updatedAt)
            $owner->$updatedAt = $this->valueAt ?: DateHelper::currentDateTime();

        if ($createdUser)
            $owner->$createdUser = $this->valueUser ?: @Yii::$app->user->identity->username;

        if ($updatedUser)
            $owner->$updatedUser = $this->valueUser ?: @Yii::$app->user->identity->username;

        return $owner;
    }

    /**
     * @param \yii\base\Event $event
     */
    public function updateLog(Event $event)
    {
        /**
         * @var ActiveRecord $owner
         */
        $owner = $this->owner;

        $updatedAt   = $this->updatedAt;
        $updatedUser = $this->updatedUser;

        if ($updatedAt)
            $owner->$updatedAt = $this->valueAt ?: DateHelper::currentDateTime();

        if ($updatedUser)
            $owner->$updatedUser = $this->valueUser ?: @Yii::$app->user->identity->username;

        return $owner;
    }
}
