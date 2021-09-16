<?php declare(strict_types = 1);

namespace Utilitte\Components\Rating\ValueObject;

final class Rating
{

	public function __construct(
		private object $source,
		private int $rating,
		private ?int $voted = null,
		private bool $canVote = true,
	)
	{
	}

	public function canVote(): bool
	{
		return $this->canVote;
	}

	public function getSource(): object
	{
		return $this->source;
	}

	public function getRating(): int
	{
		return $this->rating;
	}

	public function getVoted(): ?int
	{
		return $this->voted;
	}

}
