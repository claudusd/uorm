<?php
namespace ORM;

class StorageStructureEntity 
{
	private static $instance = null;

	public static function getInstance() 
	{
		if (is_null(self::$instance)) {
			self::$instance = new StorageStructureEntity();
		}
		return self::$instance;
	}

	private $storage = array();

	private function __construct() {}

	public function addStructure(StructureEntity $structure) 
	{
		if (!is_null($structure)) {
			$storage[$structure->getEntityName()] = $structure;
			return true;
		}
		return false;
	}

	public function getStructure($entity_name) 
	{
		if(array_key_exists($entity_name, $this->storage)) {
			return $storage[$entity_name];
		}
		return null;
	}
}