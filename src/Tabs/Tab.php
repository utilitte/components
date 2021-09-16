<?php declare(strict_types = 1);

namespace Utilitte\Components\Tabs;

use Nette\Application\UI\Link;

final class Tab
{

	public function __construct(
		public string $name,
		public Link $link,
		public array $options,
	)
	{
	}

}
