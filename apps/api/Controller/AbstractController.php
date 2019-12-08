<?php

namespace Api\Controller;

use Core\Validator\JsonSerializer2;
use Core\Validator\ObjectValidator;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AbstractController
{
	/**
	 * @var JsonSerializer2
	 */
	protected $serializer;

	/**
	 * @var ObjectValidator
	 */
	protected $validator;

	/**
	 * @var TranslatorInterface
	 */
	protected $translator;

	/**
	 * @var LoggerInterface
	 */
	protected $logger;

	protected $object;

	public function __construct(JsonSerializer2 $serializer, ObjectValidator $validator, LoggerInterface $logger, TranslatorInterface $translator)
	{
		$this->serializer = $serializer;
		$this->validator  = $validator;
		$this->logger     = $logger;
		$this->translator = $translator;
	}

	/**
	 *
	 * Serialize $data with $class into $object
	 * Validates the $object with $class Asserts
	 *
	 * @param $data
	 * @param $class
	 *
	 * @return bool
	 */
	protected function validate($data, $class): bool
	{
		$object = $this->serializer->serialize($data, $class);

		if ($this->validator->validate($object)) {
			$this->object = $object;
			return true;
		}
		return false;
	}
}