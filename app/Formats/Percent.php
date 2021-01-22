<?php


namespace App\Formats;


class Percent implements FormatValue
{
	protected $param1;
	protected $param2;
	protected $value;

	public function __construct($param1, $param2 = null)
	{
		$this->$param1 = $param1;
		$this->$param2 = $param2;
	}

    public function format()
    {
    	$this->value = $this->param1;
		$this->value = $this->value . '%';
		return $this;
    }

    public function getFormatedValue()
	{
		$this->format();
		return $this->value;
	}

}
