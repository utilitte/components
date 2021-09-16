<?php declare(strict_types = 1);

namespace Utilitte\Components\Tabs;

use Nette\Application\UI\Control;
use Nette\Application\UI\Link;
use Utilitte\Components\Utility\TControl;

final class TabsComponent extends Control
{

	use TControl;

	/** @var Tab[] */
	private array $tabs = [];

	private bool $compareParameters = true;

	public function add(string $name, Link $link, array $options = []): self
	{
		$this->tabs[] = new Tab($name, $link, $options);

		return $this;
	}

	public function setCompareParameters(bool $compareParameters): self
	{
		$this->compareParameters = $compareParameters;

		return $this;
	}

	private function isCurrentLink(Link $link): bool
	{
		return $this->getPresenter()->isLinkCurrent(
			$link->getDestination(),
			$this->compareParameters ? $link->getParameters() : []
		);
	}

	public function render(): void
	{
		$template = $this->getTemplate();
		$template->setFile($this->getFile(__DIR__ . '/templates/tabs.latte'));

		$template->tabs = $this->tabs;
		$template->addFunction('isCurrentLink', fn (Link $link) => $this->isCurrentLink($link));

		$template->render();
	}

}
