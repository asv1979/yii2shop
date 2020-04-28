<?php

namespace shop\useCases\manage;

use shop\entities\User\User;
use shop\forms\manage\User\UserCreateForm;
use shop\forms\manage\User\UserEditForm;
use shop\repositories\UserRepository;
use shop\services\newsletter\Newsletter;
use shop\services\RoleManager;
use shop\services\TransactionManager;

class UserManageService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserManageService constructor.
     * @param UserRepository $repository
     */
    public function __construct( UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserCreateForm $form
     * @return User
     * @throws \yii\base\Exception
     */
    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );
        $this->repository->save($user);

        return $user;
    }

    /**
     * @param $id
     * @param UserEditForm $form
     */
    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email
        );

        $this->repository->save($user);
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $user = $this->repository->get($id);
        $this->repository->remove($user);
    }
}
