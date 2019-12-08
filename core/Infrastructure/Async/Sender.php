<?php

namespace Core\Infrastructure\Async;

use Core\Infrastructure\Contract\Contract;
use Core\Validator\ObjectValidator;
use Symfony\Component\Messenger\MessageBusInterface;

class Sender
{
	/**
	 * @var MessageBusInterface
	 */
	private $bus;

	/**
	 * @var ObjectValidator
	 */
	private $validator;

	/**
	 * @var array
	 */
	private $errors;

	public function __construct(MessageBusInterface $bus, ObjectValidator $validator)
	{
		$this->bus       = $bus;
		$this->validator = $validator;
	}

	public function execute(Contract $message)
	{
		if (!$this->validator->validate($message)) {
			$this->errors = $this->validator->getErrors();
			return false;
		}

		$this->bus->dispatch($message);
		return true;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}