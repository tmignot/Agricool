<?php

require_once 'interfaces/IController.php';
require_once '../models/cooltainer.php';

class CooltainersController extends AControllerREST {
	
	public function __construct($container) {
		$collection = $container['db']->cooltainers;
		$model = new CooltainerModel();
		parent::__construct($collection, $model());
	}

	public function listItems($request, $response) {
		$query = [];
		$fields = ['sensors' => 0];
		return parent::_listItems($request, $response, $query, $fields);
	}

	public function showItem($request, $response, $args) {
		return parent::_showItem($request, $response, $args['id']);
	}
}
