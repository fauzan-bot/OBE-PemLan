<?php

namespace diecoding\components;

use diecoding\base\BaseDiecoding;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * 
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright 2020 Die Coding
 * @license BSD-3-Clause
 * @link https://www.diecoding.com
 * @since 2.0.14
 */
class Assign extends BaseDiecoding
{
    private $_available_roles = [];

    /**
     * Is auth_active == $assign
     *
     * @param string|array $assign
     * @return boolean
     */
    public function is($assign)
    {
        if (is_array($assign)) {
            $_bool = false;
            foreach ($assign as $_assign) {
                $_bool = $_bool || $this->is($_assign);
            }

            return $_bool;
        }

        return $this->getActive() === $assign;
    }

    /**
     * User was login but not have role
     *
     * @return boolean
     */
    public function getIsGuest()
    {
        return empty($this->getActive());
    }

    /**
     * get assign active | auth_active
     *
     * @return string
     */
    public function getActive()
    {
        if (Yii::$app->user->isGuest) {
            return null;
        }

        return $this->setAssign(Yii::$app->user->identity->auth_active);
    }

    /**
     * Change assign active if User has permission|role
     *
     * @param string|null $assign
     * @return string
     */
    public function setAssign($assign = null)
    {
        $listAssign = array_values($this->getListAssign());
        $class = Yii::$app->user->identityClass;
        $user = $class::findIdentity(Yii::$app->user->id);
        if ($assign) {
            if (in_array($assign, $listAssign)) {
                $user->auth_active = $assign;
            } else {
                $user->auth_active = null;
            }
        } else if (!in_array($user->auth_active, $listAssign)) {
            if (isset($listAssign[0])) {
                $user->auth_active = $listAssign[0];
            } else {
                $user->auth_active = null;
            }
        }

        $user->save(false);

        return $user->auth_active;
    }

    /**
     * Check has permission|role
     *
     * @param string|array $assign
     * @param int|null $user_id
     * @return boolean
     */
    public function hasAssign($assign, $user_id = null)
    {
        $user_id = $user_id ?: @Yii::$app->user->id;
        if (is_array($assign)) {
            $_bool = false;
            foreach ($assign as $_assign) {
                $_bool = $_bool || $this->hasAssign($_assign, $user_id);
            }

            return $_bool;
        }
        $listAssign = array_values($this->getListAssign($user_id));

        return in_array($assign, $listAssign);
    }

    /**
     * Add user permission|role
     *
     * @param int $user_id
     * @param string|array $assign
     * @return boolean
     */
    public function addAssign($user_id, $assign)
    {
        if (is_array($assign)) {
            $_bool = false;
            foreach ($assign as $_assign) {
                $_bool = $_bool || $this->addAssign($user_id, $_assign);
            }

            return $_bool;
        }

        try {
            $auth = Yii::$app->authManager;
            $item = $auth->getRole($assign);
            $auth->assign($item, $user_id);

            return true;
        } catch (\Exception $e) {
        }

        return false;
    }

    /**
     * Revoke user permission|role
     *
     * @param int $user_id
     * @param string|array $assign
     * @return boolean
     */
    public function revokeAssign($user_id, $assign)
    {
        if (is_array($assign)) {
            $_bool = false;
            foreach ($assign as $_assign) {
                $_bool = $_bool || $this->revokeAssign($user_id, $_assign);
            }

            return $_bool;
        }

        try {
            $auth = Yii::$app->authManager;
            $item = $auth->getRole($assign);
            $auth->revoke($item, $user_id);

            return true;
        } catch (\Exception $e) {
        }

        return false;
    }

    /**
     * List permission|role user
     *
     * @param int|null $user_id
     * @return array
     */
    public function getListAssign($user_id = null)
    {
        $user_id = $user_id ?: @Yii::$app->user->id;
        $listAssign = Yii::$app->authManager->getRolesByUser($user_id);
        $listAssign = ArrayHelper::map($listAssign, 'name', 'name');

        return $listAssign;
    }

    /**
     * List all permissions|roles application
     *
     * @return array
     */
    public function getListAvailableAssign()
    {
        if (empty($this->_available_roles)) {
            $this->_available_roles = Yii::$app->authManager->getRoles();
            $this->_available_roles = ArrayHelper::map($this->_available_roles, 'name', 'name');
        }

        return $this->_available_roles;
    }
}
