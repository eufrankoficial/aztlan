<?php


namespace App\Formats;


use App\Enums\FieldTypeEnum;

class GiveMeTheFormatClass
{
	public function __construct($type, $data)
	{
		$this->type = $type;
		$this->data = $data;
	}

	public function getValue()
	{
		$instance = $this->instanceClass();
		$value = is_string($instance) || is_integer($instance) ? $instance : $instance->getFormatedValue();

		return $value;
	}

	private function instanceClass()
	{
		switch ($this->type) {
			case FieldTypeEnum::PORCENTAGEM:
				return new Percent($this->data['value'], isset($this->data['value2']) ?: null);
			case FieldTypeEnum::TEMPERATURA:
				return new Temperature($this->data['value']);
			case FieldTypeEnum::DATA:
				return new TimeStamp($this->data['value']);
			default:
				return $this->data['value'];
		}
	}

}
