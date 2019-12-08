<?php

namespace Job\User;

use Core\Infrastructure\Contract\User\CreateUser;
use Core\Repository\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Core\Entity\User;

class CreateUserHandler implements MessageHandlerInterface
{
	protected $repository;

	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(CreateUser $createUser)
	{
		$user = new User();
		$user->setName($createUser->name);
		$user->setCity($createUser->city);
		$user->setEmail($createUser->email);
		$user->setPhone($createUser->phone);
		$user->setStatus(1);
		$this->repository->save($user);
	}
}