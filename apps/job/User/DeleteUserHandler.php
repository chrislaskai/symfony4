<?php

namespace Job\User;

use Core\Infrastructure\Contract\User\DeleteUser;
use Core\Repository\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteUserHandler implements MessageHandlerInterface
{
	protected $repository;

	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(DeleteUser $deleteUser)
	{
		$this->repository->delete($deleteUser->id);
	}
}