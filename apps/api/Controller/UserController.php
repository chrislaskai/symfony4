<?php

namespace Api\Controller;

use Api\Domain\User\Command;
use Api\Domain\User\Query;
use Core\Exception\EmailTakenException;
use Core\Infrastructure\Contract\User\CreateUser;
use Core\Infrastructure\Contract\User\DeleteUser;
use Core\Infrastructure\Contract\User\GetUser;
use Core\Infrastructure\Contract\User\UpdateUser;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
	use JsonResponseTrait;

	/**
	 * Validate $request with CreateUser Asserts
	 * Call $manager
	 * Handle errors and exceptions
	 *
	 * @param Request $request
	 * @param Command $manager
	 *
	 * @return JsonResponse
	 */
	public function create(Request $request, Command $manager)
	{
		try {
			// Happy Path
			if ($this->validate($request->getContent(), CreateUser::class)) {
				$manager->create($this->object);
				return $this->jsonSuccessResponse(null, 201);
			}

			// Validation Error
			return $this->jsonValidationErrorResponse($this->validator->getErrors());
		} catch (EmailTakenException $e) {
			return $this->jsonErrorResponse('Email is already taken');
		} catch (\Exception $e) {
			$this->logger->error($e->getMessage(), $e->getTrace());
			return $this->jsonErrorResponse('An error occurred, please try again later');
		}
	}

	/**
	 * Validate $request with UpdateUser Asserts
	 * Call $manager
	 * Handle errors and exceptions
	 *
	 * @param Request $request
	 * @param Command $manager
	 *
	 * @return JsonResponse
	 */
	public function update(Request $request, Command $manager)
	{
		try {
			// Happy Path
			if ($this->validate($request->getContent(), UpdateUser::class)) {
				$manager->update($this->object);
				return $this->jsonSuccessResponse(null, 202);
			}

			// Validation Error
			return $this->jsonValidationErrorResponse($this->validator->getErrors());
		} catch (EntityNotFoundException $e) {
			return $this->jsonNotFoundResponse($e->getMessage());
		} catch (\Exception $e) {
			$this->logger->error($e->getMessage(), $e->getTrace());
			return $this->jsonErrorResponse('An error occurred, please try again later');
		}
	}

	/**
	 * Validate $request with DeleteUser Asserts
	 * Call $manager
	 * Handle errors and exceptions
	 *
	 * @param Request $request
	 * @param Command $manager
	 *
	 * @return JsonResponse
	 */
	public function delete(Request $request, Command $manager)
	{
		try {
			// Happy Path
			if ($this->validate($request->getContent(), DeleteUser::class)) {
				$manager->delete($this->object);
				return $this->jsonSuccessResponse(null, 204);
			}

			// Validation Error
			return $this->jsonValidationErrorResponse($this->validator->getErrors());
		} catch (EntityNotFoundException $e) {
			return $this->jsonNotFoundResponse($e->getMessage());
		} catch (\Exception $e) {
			$this->logger->error($e->getMessage(), $e->getTrace());
			return $this->jsonErrorResponse('An error occurred, please try again later');
		}
	}

	public function get(Request $request, Query $manager)
	{
		try {
			// Happy Path
			if ($this->validate($request->getContent(), GetUser::class)) {
				$user = $manager->get($this->object);
				return $this->jsonSuccessResponse($user, 200);
			}

			// Validation Error
			return $this->jsonValidationErrorResponse($this->validator->getErrors());
		} catch (EntityNotFoundException $e) {
			return $this->jsonNotFoundResponse($e->getMessage());
		} catch (\Exception $e) {
			$this->logger->error($e->getMessage(), $e->getTrace());
			return $this->jsonErrorResponse('An error occurred, please try again later');
		}
	}

	public function getAll(Request $request, Query $manager)
	{
		try {
			// Happy Path
			$users = $manager->getAll();
			return $this->jsonSuccessResponse($users, 200);
		} catch (\Exception $e) {
			$this->logger->error($e->getMessage(), $e->getTrace());
			return $this->jsonErrorResponse('An error occurred, please try again later');
		}
	}
}