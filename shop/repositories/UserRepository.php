<?php

namespace shop\repositories;

use shop\entities\User\User;

class UserRepository
{

    /**
     * @param $value
     * @return array|\yii\db\ActiveRecord|null
     */
    public function findByUsernameOrEmail($value)
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public function get($id)
    {
        return $this->getBy(['id' => $id]);
    }

    /**
     * @param $token
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getByEmailConfirmToken($token)
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }

    /**
     * @param $email
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getByEmail($email)
    {
        return $this->getBy(['email' => $email]);
    }

    /**
     * @param $token
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getByPasswordResetToken($token)
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    /**
     * @param string $token
     * @return bool
     */
    public function existsByPasswordResetToken(string $token): bool
    {
        return (bool)User::findByPasswordResetToken($token);
    }


    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param User $user
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(User $user): void
    {
        if (!$user->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    /**
     * @param array $condition
     * @return array|\yii\db\ActiveRecord|null
     */
    private function getBy(array $condition)
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found.');
        }
        return $user;

    }

    /**
     * @param $network
     * @param $identity
     * @return array|\yii\db\ActiveRecord|null
     */
    public function findByNetworkIdentity($network, $identity)
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }
}
