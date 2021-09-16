<?php declare(strict_types = 1);

namespace Utilitte\Components\Utility;

trait TControl
{

	private string $file;

	public function setFile(string $file): static
	{
		$this->file = $file;

		return $this;
	}

	protected function getFile(string $default): string
	{
		return $this->file ?? $default;
	}

}
