<?php

namespace Core\Validator;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonSerializer2
{
	public function serialize($jsonData, $type)
	{
		$normalizers = [new ObjectNormalizer()];
		$serializer = new Serializer($normalizers, [new JsonEncoder()]);

		return $serializer->deserialize($jsonData, $type, 'json');
	}
}