<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class User
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @Groups({"web"})
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @Groups({"web"})
	 */
	protected $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @Groups({"web"})
	 */
	protected $email;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @Groups({"web"})
	 */
	protected $phone;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @Groups({"web"})
	 */
	protected $city;

	/**
	 * @ORM\Column(type="smallint")
	 * @Groups({"web"})
	 */
	protected $status;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $created_at;

	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $updated_at;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}

	public function getPhone(): ?string
	{
		return $this->phone;
	}

	public function setPhone(string $phone): self
	{
		$this->phone = $phone;

		return $this;
	}

	public function getCity(): ?string
	{
		return $this->city;
	}

	public function setCity(string $city): self
	{
		$this->city = $city;

		return $this;
	}

	public function getStatus(): ?int
	{
		return $this->status;
	}

	public function setStatus(int $status): self
	{
		$this->status = $status;

		return $this;
	}

	public function getCreatedAt(): ?\DateTimeInterface
	{
		return $this->created_at;
	}

	public function setCreatedAt(\DateTimeInterface $created_at): self
	{
		$this->created_at = $created_at;

		return $this;
	}

	public function getUpdatedAt(): ?\DateTimeInterface
	{
		return $this->updated_at;
	}

	public function setUpdatedAt(?\DateTimeInterface $updated_at): self
	{
		$this->updated_at = $updated_at;

		return $this;
	}

	/**
	 * @ORM\PrePersist
	 * @ORM\PreUpdate
	 */
	public function updatedTimestamps(): void
	{
		$this->setUpdatedAt(new \DateTime('now'));
		if ($this->getCreatedAt() === null) {
			$this->setCreatedAt(new \DateTime('now'));
		}
	}
}