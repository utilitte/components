<?php declare(strict_types = 1);

namespace Utilitte\Components\Rating;

use Utilitte\Components\Rating\Model\RatingModelInterface;
use Utilitte\Components\Rating\ValueObject\Rating;

interface RatingComponentFactory
{

	/**
	 * @param array<string, mixed> $options
	 */
	public function create(RatingModelInterface $model, Rating $rating, array $options = []): RatingComponent;

}
