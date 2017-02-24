<?php

require_once 'interfaces/IModel.php';

class CooltainerModel {
	function __invoke() {
		return new ModelSchema(array(
			'name' => [
				'type' => 'string',
			],
			'plant_type' => [
				'type' => 'string',
				'defaultValue' => 'Strawberry'
			],
			'ip' => [
				'type' => 'string',
			],
			'location'=> [
				'type' => 'array',
				'optional' => true
			],
			'status' => [
				'type' => 'string',
				'defaultValue' => 'CREATED'
			],
			'connected' => [
				'type' => 'string',
				'optional' => true
			],
			'day_night_cycle' => [
				'type' => 'number',
				'optional' => true
			],
			'sensors' => [
				'type' => 'array',
				'optional' => true
			]
		));
	}
}
