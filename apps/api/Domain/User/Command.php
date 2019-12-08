<?php

namespace Api\Domain\User;

use Core\Exception\EmailTakenException;
use Core\Infrastructure\Async\Sender;
use Core\Infrastructure\Contract\User\CreateUser;
use Core\Infrastructure\Contract\User\DeleteUser;
use Core\Infrastructure\Contract\User\UpdateUser;
use Core\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;

class Command
{
	/**
	 * @var Sender
	 */
	protected $sender;

	/**
	 * @var UserRepository
	 */
	protected $repository;

	public function __construct(Sender $sender, UserRepository $repository)
	{
		$this->sender     = $sender;
		$this->repository = $repository;
	}

	public function create(CreateUser $createUser): bool
	{
		if ($this->repository->findByEmail($createUser->email)) {
			throw new EmailTakenException();
		}

		$this->send($createUser);

		return true;
	}

	public function update(UpdateUser $updateUser): bool
	{
		if (!$this->repository->find($updateUser->id)) {
			throw EntityNotFoundException::fromClassNameAndIdentifier('User', [$updateUser->id]);
		}

		$this->send($updateUser);

		return true;
	}

	public function delete(DeleteUser $deleteUser): bool
	{
		if (!$this->repository->find($deleteUser->id)) {
			throw EntityNotFoundException::fromClassNameAndIdentifier('User', [$deleteUser->id]);
		}

		$this->send($deleteUser);

		return true;
	}

	protected function send($user)
	{
		if (!$this->sender->execute($user)) {
			throw new \Exception('Sender error');
		}
	}
}