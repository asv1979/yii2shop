<?php
namespace shop\useCases\auth;

use common\entities\User;
use frontend\forms\PasswordResetRequestForm;
use frontend\forms\ResetPasswordForm;
use Yii;

class PasswordResetService
{
    /**
     * @param PasswordResetRequestForm $form
     */
    public function request(PasswordResetRequestForm $form): void
    {
        $user = (new User())->getByEmail($form->email);

        if (!$user->isActive()) {
            throw new \DomainException('User is not active.');
        }

        $user->requestPasswordReset();

        if(!$user->save()){
            throw new \RuntimeException('User saving error.');
        }


        $sent =  Yii::$app
        ->mailer
        ->compose(
            ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
            ['user' => $user]
        )
        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
        ->setTo($user->email)
        ->setSubject('Password reset for ' . Yii::$app->name)
        ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }

    /**
     * @param $token
     */
    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (User::existsByPasswordResetToken($token)) {
            throw new \DomainException('Wrong password reset token.');
        }
    }

    /**
     * @param string $token
     * @param ResetPasswordForm $form
     */
    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = User::findByPasswordResetToken($token);
        if ($user) {
            throw new \DomainException('User is not found.');
        }

        $user->resetPassword($form->password);

        if ($user->save()) {
            throw new \DomainException('User saving error.');
        }
    }
}
