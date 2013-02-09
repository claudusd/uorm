<?php
namespace ORM;

/**
 * 
 **/
class ORMCommon implements Constant 
{
	/**
	 * The instance of the singleton.
	 **/
	private static $instance;
	/**
	 *
	 * @return 
	 **/
	public static function getInstance() 
	{
		if(is_null(self::$instance)) {
			self::$instance = new ORMCommon();
		}
		return self::$instance;
	}
	/**
	 *
	 **/
	private $entities_to_save;

	private $pdo;
	/**
	 *
	 **/
	private function __construct() {
		$this->entities_to_save = array();
		//$this->pdo = new \PDO('mysql:dbname=;host=', '',''); 
	}
	/**
	 * 
	 * @param
	 * @return 
	 **/
	public function findAll($entity)
	{
		if(!is_null($entity)) {
			if(is_string($entity)) {
				$entity = new $entity();
			}
			if(is_object($entity) && $entity instanceof Entity) {
				$structure = StructureEntity::getEntityMapping($entity);
				$sql = 'SELECT ';
				$first = FALSE;
				foreach ($structure->getStructure() as $key => $value) {
					if($first) {
						$sql .= ', ';
					} else {
						$first = TRUE;
					}
					$sql .= $key;
				}
				$sql .= ' FROM '.$structure->getTableName();
				echo $sql;
			} else {
				throw new ORMException("The class ".get_class($entity)." is not en Entity of the ORM", 1);
			}
		}
	}
	/**
	 * 
	 * @param
	 * @return 
	 **/
	public function findOne($entity) 
	{

	}
	/**
	 *
	 **/
	public function commit()
	{

	}
	/**
	 *
	 **/
	public function rollBack(Entity $entity = null)
	{
		if(is_null($entity)) {

		} else {

		}
	}
}