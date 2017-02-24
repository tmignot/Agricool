<?php

require_once 'interfaces/IModel.php';

class CooltainerModel {
	function __invoke() {
		return new ModelSchema(array(
			'name' => [
				'type' => 'string',
			],
			'ip' => [
				'type' => 'string',
			],
			'plant_type' => [
				'type' => 'string',
				'defaultValue' => 'Strawberry'
			],
			'location'=> [
				'type' => 'array',
				'optional' => true
			]
		));
	}
}
