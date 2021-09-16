<?php declare(strict_types = 1);

namespace Utilitte\Components\Rating\Model;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Utilitte\Components\Rating\Entity\RatingEntityInterface;
use Utilitte\Doctrine\DoctrineIdentityExtractor;

abstract class DoctrineRatingModel implements RatingModelInterface
{

	public function __construct(
		private EntityManagerInterface $em,
		private DoctrineIdentityExtractor $doctrineIdentityExtractor,
	)
	{
	}

	public function voteByEntity(RatingEntityInterface $entity, int $value): void
	{
		$persisted = $this->em->find(
			get_class($entity),
			$this->doctrineIdentityExtractor->extractIdentities($entity, true)
		);

		if ($persisted) {
			if ($persisted->changeValue($value)) {
				$this->em->persist($persisted);
			} else {
				$this->em->remove($persisted);
			}
		} else {
			$this->em->persist($entity);
		}

		try {
			$this->em->flush();
		} catch (UniqueConstraintViolationException) {
			// nothing, already exists
		}
	}

}
