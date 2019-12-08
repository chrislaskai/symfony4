<?php

namespace Api\Domain\User;

use Core\Infrastructure\Contract\User\GetUser;
use Core\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Serializer\SerializerInterface;

class Query
{
	/**
	 * @var UserRepository
	 */
	protected $repository;

	/**
	 * @var SerializerInterface
	 */
	protected $serializer;

	public function __construct(UserRepository $repository, SerializerInterface $serializer)
	{
		$this->repository = $repository;
		$this->serializer = $serializer;
	}

	public function get(GetUser $getUser)
	{
		$user = $this->repository->find($getUser->id);
		if (!$user) {
			throw new EntityNotFoundException();
		}

		return json_decode($this->serializer->serialize($user, 'json', ['groups' => ['web']]), true);
	}

	public function getAll()
	{
		$users = $this->repository->findBy(['status' => 1]);
		return json_decode($this->serializer->serialize($users, 'json', ['groups' => ['web']]), true);
	}
}