<?php

namespace shop\useCases\auth;

use shop\entities\User\User;
use shop\forms\auth\SignupForm;
use shop\repositories\UserRepository;

class SignupService
{
    private $users;


    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function signup(SignupForm $form)
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );
        $this->users->save($user);

        // If we will use confirm registration by email
        //        $sent = $this->mailer->compose(
//            ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
//            ['user' =>$user]
//        )
//            ->setTo($form->email)
//            ->setSubject('Signup confirm from - ' . \Yii::$app->name)
//            ->send();
//
//        if (!$sent) {
//            throw new \RuntimeException('Sending error.');
//        }

        return $user;

    }

    /**
     * @param $token
     */
    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }
        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }

}
