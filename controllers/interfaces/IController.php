<?php

interface IControllerREST {
	function createItem($request, $response);
	function listItems($request, $response);
	function showItem($request, $response, $args);
}

abstract class AControllerREST implements IControllerREST {
	
	private $model;
	private $collection;
	protected $container;

	protected function __construct(MongoDB\Collection &$collection, ModelSchema $model) {
		$this->collection = $collection;
		$this->model = $model;
	}

	public function createItem($request, $response) {
		$data = $request->getParsedBody();
		$item = $this->model->validate($data);
		if ($item && !array_key_exists('errors', $item)) {
			$success = $this->collection->insertOne($item);
			if ($success)
				return $response->withJSON(['_id' => (string)$success->getInsertedId()]);
		}	else {
			return $response->withStatus(400)->withJSON($item);
		}
	}
		
	
	abstract public function listItems($request, $response);
	protected function _listItems($request, $response, $query = [], $fields = []) {
		$request_query = $request->getParsedBodyParam('query');
		$request_fields = $request->getParsedBodyParam('fields');
		$full_query = array_merge((array)$request_query, $query);
		$full_fields = array_merge((array)$request_fields, $fields);
		$cursor = $this->collection->find($full_query, [
			'projection' => $full_fields,
			'sort' => [],
			'skip' => 0,
			'limit' => 0
		]);
		return $response->withJSON($cursor->toArray());
	}

	abstract public function showItem($request, $response, $args);
	protected function _showItem($request, $response, $id, $query = [], $fields = []) {
		$query['_id'] = new MongoDB\BSON\ObjectId($id);
		$request_query = $request->getParsedBodyParam('query');
		$request_fields = $request->getParsedBodyParam('fields');
		$full_query = array_merge((array)$request_query, $query);
		$full_fields = array_merge((array)$request_fields, $fields);
		$data = $this->collection->findOne($full_query, [
			'projection' => $full_fields,
			'sort' => [],
			'skip' => 0,
			'limit' => 0
		]);
		if ($data)
			return $response->withJSON($data);
		else
			return $response->withStatus(404);
	}
}
