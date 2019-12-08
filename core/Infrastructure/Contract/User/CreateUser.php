<?php

namespace Core\Infrastructure\Contract\User;

use Core\Infrastructure\Contract\Contract;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUser implements Contract
{
	/**
	 * @Assert\NotBlank()
	 * @Assert\Length(min=5)
	 */
	public $name;

	/**
	 * @Assert\NotBlank()
	 * @Assert\Email
	 */
	public $email;

	/**
	 * @Assert\NotBlank()
	 * @Assert\Length(min=8)
	 */
	public $phone;

	/**
	 * @Assert\NotBlank()
	 * @Assert\Length(min=5)
	 */
	public $city;
}