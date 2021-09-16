<?php declare(strict_types = 1);

namespace Utilitte\Components\Rating\Model;

interface RatingModelInterface
{

	public function isVoteValueValid(int $value): bool;

	public function vote(object $source, int $value): VoteResult;

}
