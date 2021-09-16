<?php declare(strict_types = 1);

namespace Utilitte\Components\Rating\Model;

final class VoteResult
{

	public function __construct(
		private int $difference,
		private int $voted,
	)
	{
	}

	public function getDifference(): int
	{
		return $this->difference;
	}

	public function getVoted(): int
	{
		return $this->voted;
	}

}
