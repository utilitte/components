<?php declare(strict_types = 1);

namespace Utilitte\Components\Rating\Entity;

interface RatingEntityInterface
{

	/**
	 * Returns true if changed
	 */
	public function changeValue(int $value): bool;

}
