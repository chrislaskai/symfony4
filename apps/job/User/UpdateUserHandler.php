<?php

namespace Job\User;

use Core\Infrastructure\Contract\User\UpdateUser;
use Core\Repository\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdateUserHandler implements MessageHandlerInterface
{
	protected $repository;

	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(UpdateUser $updateUser)
	{
		$user = $this->repository->find($updateUser->id);

		$user->setName($updateUser->name);
		$user->setCity($updateUser->city);
		$user->setEmail($updateUser->email);
		$user->setPhone($updateUser->phone);
		$user->setStatus(1);
		$this->repository->save($user);
	}
}