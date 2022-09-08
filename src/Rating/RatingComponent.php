<?php declare(strict_types = 1);

namespace Utilitte\Components\Rating;

use Nette\Application\UI\Control;
use Utilitte\Components\Rating\Model\RatingModelInterface;
use Utilitte\Components\Rating\ValueObject\Rating;
use Utilitte\Components\Utility\TControl;

final class RatingComponent extends Control
{

	use TControl;

	/** @var callable[] */
	private array $onVoted = [];

	private bool $set = false;

	private int $increase = 0;

	public function __construct(
		private RatingModelInterface $model,
		private Rating $rating,
	)
	{
	}

	public function addIncrease(int $amount): self
	{
		$this->increase += $amount;

		return $this;
	}

	public function onVoted(callable $callback): void
	{
		$this->onVoted[] = $callback;
	}

	public function render(mixed ... $arguments): void
	{
		$template = $this->getTemplate();
		$template->setFile($this->getFile(__DIR__ . '/templates/rating.latte'));

		if (!$this->set) {
			$template->rating = $this->rating->getRating() + $this->increase;
			$template->voted = $this->rating->getVoted();
		}

		$template->increase = $this->increase;
		$template->canVote = $this->rating->canVote();

		foreach ($arguments as $name => $value) {
			$template->$name = $value;
		}

		$template->render();
	}

	public function handleVote(int $value): void
	{
		$ajax = $this->getPresenter()->isAjax();
		if (!$this->model->isVoteValueValid($value)) {
			if ($ajax) {
				return;
			}

			$this->redirect('this');
		}

		$result = $this->model->vote($this->rating->getSource(), $value);

		foreach ($this->onVoted as $callback) {
			$callback();
		}

		if ($ajax) {
			$template = $this->getTemplate();
			$template->rating = $this->rating->getRating() + $result->getDifference() + $this->increase;
			$template->voted = $result->getVoted();

			$this->set = true;

			$this->redrawControl();
		} else {
			$this->redirect('this');
		}
	}

}
