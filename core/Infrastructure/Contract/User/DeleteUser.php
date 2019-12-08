<?php

namespace Core\Infrastructure\Contract\User;

use Core\Infrastructure\Contract\Contract;
use Symfony\Component\Validator\Constraints as Assert;

class DeleteUser implements Contract
{
	/**
	 * @Assert\NotBlank()
	 */
	public $id;
}