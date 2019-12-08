<?php

namespace Core\Infrastructure\Contract\User;

use Core\Infrastructure\Contract\Contract;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUser implements Contract
{
	/**
	 * @Assert\NotBlank()
	 */
	public $id;

	/**
	 * @Assert\Length(min=5)
	 */
	public $name;

	/**
	 * @Assert\Email
	 */
	public $email;

	/**
	 * @Assert\Length(min=8)
	 */
	public $phone;

	/**
	 * @Assert\Length(min=5)
	 */
	public $city;
}