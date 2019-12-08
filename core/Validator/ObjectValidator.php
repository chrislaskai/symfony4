<?php

namespace Core\Validator;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ObjectValidator
{
	/**
	 * @var ConstraintViolationListInterface
	 */
	private $violations;

	/**
	 * @var ValidatorInterface
	 */
	private $validator;

	public function __construct(ValidatorInterface $validator)
	{
		$this->validator = $validator;
	}

	public function validate($object) : bool
	{
		$this->violations = $this->validator->validate($object);

		if ($this->violations->count() > 0) {
			return false;
		}
		return true;
	}

	public function getErrors()
	{
		$formatedViolationList = [];
		if ($this->violations->count() > 0) {
			$formatedViolationList = [];
			for ($i = 0; $i < $this->violations->count(); $i++) {
				$violation = $this->violations->get($i);

				$formatedViolationList[$violation->getPropertyPath()][]= $violation->getMessage();
			}
		}
		return $formatedViolationList;
	}
}