<?php


namespace App\Formats;


class Temperature implements FormatValue
{

	public function __construct($param1)
	{
		$this->param1 = $param1;
	}

    public function format()
    {
		$this->value = $this->param1;
		$this->value = $this->value . 'ºC';
		return $this;
    }

    public function getFormatedValue()
    {
		$this->format();
		return $this->value;
    }
}
