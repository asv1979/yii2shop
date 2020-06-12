<?php

namespace common\auth;

use shop\entities\User\User;
use shop\readModels\UserReadRepository;
use yii\web\IdentityInterface;

class Identity
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function findIdentity($id)
    {
        $user = self::getRepository()->findActiveById($id);
        return $user ? new self($user): null;
    }

    private static function getRepository(): UserReadRepository
    {
        return \Yii::$container->get(UserReadRepository::class);
    }

}
