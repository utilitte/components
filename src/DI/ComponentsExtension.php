<?php declare(strict_types = 1);

namespace Utilitte\Components\DI;

use Nette\DI\CompilerExtension;
use Utilitte\Components\Comments\Factory\CommentComponentFactory;
use Utilitte\Components\Comments\Factory\CommentFormComponentFactory;
use Utilitte\Components\Comments\Factory\CommentsComponentFactory;
use Utilitte\Components\Comments\Factory\CommentsLayoutComponentFactory;
use Utilitte\Components\Rating\RatingComponentFactory;

final class ComponentsExtension extends CompilerExtension
{

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		// rating
		$builder->addFactoryDefinition($this->prefix('rating'))
			->setImplement(RatingComponentFactory::class);

		// comments
//		$builder->addFactoryDefinition($this->prefix('comments.factory.comment'))
//			->setImplement(CommentComponentFactory::class);
//
//		$builder->addFactoryDefinition($this->prefix('comments.factory.comments'))
//			->setImplement(CommentsComponentFactory::class);
//
//		$builder->addFactoryDefinition($this->prefix('comments.factory.commentsLayout'))
//			->setImplement(CommentsLayoutComponentFactory::class);
//
//		$builder->addFactoryDefinition($this->prefix('comments.factory.commentForm'))
//			->setImplement(CommentFormComponentFactory::class);
	}

}
