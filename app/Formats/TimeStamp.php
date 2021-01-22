<?php


namespace App\Formats;
use Carbon\Carbon;

class TimeStamp implements FormatValue
{
	public function __construct($param1)
	{
		$this->value = $param1;
	}

    public function format()
    {
        $value = Carbon::createFromTimestamp(strtotime($this->value))->isoFormat('Do MMMM, H:mm');
        $this->value = $value;

        return $this;
    }

    public function getFormatedValue()
    {
        $this->format();
        return $this->value;
    }
}
