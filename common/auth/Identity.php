<?php

namespace common\auth;

use shop\entities\User\User;
use yii\web\IdentityInterface;

class Identity
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

}
