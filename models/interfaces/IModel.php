<?php

interface IModelSchema {
	public function validate($data);
}

class ModelSchema implements IModelSchema {
	private $schema;

	public function __construct($schema) {
		$this->schema = $schema;
	}

	public function getSchema() {
		return $this->schema;
	}
	
	public function validate($data) {
		$data = $this->filterKeys($data);
		$errors = [];
		foreach ($this->schema as $key => $val) {
			if (!array_key_exists($key, $data) && array_key_exists('defaultValue', $val))
				$data[$key] = $val['defaultValue'];

			if (!array_key_exists($key, $data) && !(array_key_exists('optional', $val) && $val['optional'] == true))
				array_push($errors, ['key' => $key, 'msg' => "$key is required"]);

			if (!array_key_exists('type', $val))
				array_push($errors, ['key' => $key, 'msg' => "Definition of $key type is required in the model"]);

			if (array_key_exists($key, $data) && $val['type'] != gettype($data[$key]))
			array_push($errors, ['key' => $key, 'msg' => "$key have too be  of type ".$val['type'].""]);
		}
		if (count($errors))
			return ['errors' => $errors ];
		return $data;
	}

	private function filterKeys($data) {
		$d = array();

		foreach ($this->schema as $key => $val) {
			if (array_key_exists($key, $data))
					$d[$key] = $data[$key];
		}
		return $d;
	}
}
