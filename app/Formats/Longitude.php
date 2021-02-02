<?php

namespace App\Formats;

class Longitude implements FormatValue
{
	protected $value;
	protected $param;
	public function __construct($param)
	{
		$this->param = $param;
	}

	public function format()
	{
		$this->value = $this->param;
	}

	public function getFormatedValue()
	{
		$this->format();
		return $this->value;
	}
}
