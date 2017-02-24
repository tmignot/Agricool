<?php

require '../vendor/autoload.php';

$faker = Faker\Factory::create();
$mongo = new \MongoDB\Client();

class Cooltainer
{
	var $data;

	function __construct($faker) {
		$this->data = array(
			'name' => $faker->name,
			'plant_type' => 'Strawberry',
			'ip' => $faker->ipv4,
			'location'=> array(
				'address'=> $faker->address,
				'lat' => $faker->randomFloat(null, 0, 60),
				'lng' => $faker->randomFloat(null, 0, 60),
			),
			'status' => 'CREATED',
			'connected' => 'ONLINE',
			'day_night_cycle' => $faker->numberBetween(0, 100),
			'sensors' => array(
				'electrical_installation' => 'OK',
				'power_consumption' => $faker->numberBetween(1000, 10000), // watt
				'door_status' => 'CLOSED',
				'light_status' => 'OK',
				'light_percent' => $faker->numberBetween(0, 100),
				'fan_status' => 'OK',
				'air_flow' => $faker->numberBetween(0,250), // m3/h
				'air_temperature_ext' => $faker->numberBetween(-5, 35),
				'air_temperature_int' => $faker->numberBetween(-5, 35),
				'air_filters_status' => 'OK',
				'air_pressure_ext' => $faker->numberBetween(950, 1150),
				'air_pressure_int' => $faker->numberBetween(950, 1150),
				'air_humidity' => $faker->numberBetween(0, 100),
				'air_quality' => 'OK',
				'air_particules' => array(
					'co2' => 400.0,
					'co' => 0.0,
					'no2' => 0.02,
					'o3' => 0.01,
					'VOCs' => 1.9,
					'particulates' => 0.0
				),
				'pump_status' => 'OK',
				'water_flow' => $faker->numberBetween(5, 500),
				'water_temperature' => $faker->numberBetween(10, 35),
				'water_volume' => $faker->numberBetween(0, 500),
				'water_pH' => 6.8,
				'water_ec' => 1.5,
				'water_particules' => array(
					'nh4' => 0.0,
					'nh3' => 0.0,
					'cl' => 0.0,
					'f' => 0.0,
					'no3' => 0.0,
					'ca' => 0.0 
				),
				'fertilizer_volume' => $faker->numberBetween(0,100),
				'sickness_detected' => 'NULL'
			)
		);
	}

	function __destruct() {}
}

$collection = $mongo->agricool->cooltainers;

$count = $collection->count();
for ($count; $count<20; ++$count) {
	$c = new Cooltainer($faker);
	$collection->insertOne($c->data);
}
