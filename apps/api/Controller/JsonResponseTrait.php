<?php

namespace Api\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

trait JsonResponseTrait
{
	/**
	 * Return a success JsonResponse with $data and $status
	 *
	 * @param null $data
	 * @param int  $status
	 *
	 * @return JsonResponse
	 */
	protected function jsonSuccessResponse($data = null, $status = 200)
	{
		$result['success'] = true;
		if ($data !== null) {
			$result['data'] = $data;
		}

		return new JsonResponse($result, $status);
	}

	/**
	 * Return an error JsonResponse with $errors and $status
	 *
	 * @param       $errors
	 * @param int   $status
	 *
	 * @return JsonResponse
	 */
	protected function jsonErrorResponse($errors, $status = 400)
	{
		$result['success'] = false;

		if (!empty($errors)) {
			if (!is_array($errors)) {
				$errors = [$errors];
			}
			$result['errors'] = $errors;
		}

		return new JsonResponse($result, $status);
	}

	/**
	 * Return an error JsonResponse with $errors and $status
	 *
	 * @param array $errors
	 * @param int   $status
	 *
	 * @return JsonResponse
	 */
	protected function jsonValidationErrorResponse(array $errors = [], $status = 400)
	{
		$result['success'] = false;
		$result['message'] = 'Validation error';

		if (!empty($errors)) {
			$result['errors'] = $errors;
		}

		return new JsonResponse($result, $status);
	}

	/**
	 * Return an error JsonResponse with $errors and $status
	 *
	 * @param       $errors
	 * @param int   $status
	 *
	 * @return JsonResponse
	 */
	protected function jsonNotFoundResponse($errors, $status = 404)
	{
		$result['success'] = false;
		$result['message'] = 'Entity not found';

		if (!empty($errors)) {
			if (!is_array($errors)) {
				$errors = [$errors];
			}
			$result['errors'] = $errors;
		}

		return new JsonResponse($result, $status);
	}
}