<?php
namespace ORM;

/**
 *
 */
class StructureEntity implements Constant 
{	
	/**
	 * 
	 * @param 
	 * @return 
	 **/
	public static function getEntityMapping($entity) 
	{
		if(is_object($entity) && $entity instanceof Entity) {
			$instance_StorageStructureEntity = StorageStructureEntity::getInstance();
			$class_name = get_class($entity);
			$entity_structure = $instance_StorageStructureEntity->getStructure($class_name);
			if(is_null($entity_structure)) {
				$structure = array();
				$r = new \ReflectionClass($entity);
				$props   = $r->getProperties();
				foreach ($props as $prop) {
					$struc = ReadAnnotation::getPropertyMapping($prop->getDocComment());
					$structure[$prop->getName()] = $struc;
				}
				$table_name = ReadAnnotation::getEntityMapping($r->getDocComment());
				$entity_structure = new StructureEntity($class_name, $structure, $table_name);
				$instance_StorageStructureEntity->addStructure($entity_structure);
			}
			return $entity_structure;
		} else {
			throw new ORMException("The object is not e entity.", 1);
		}
	}

	private $entity_name;

	private $structure;

	private $table_name;
	/**
	 *
	 * @param
	 * @param
	 * @param
	 **/
	private function __construct($entity_name, array $structure, $table_name = null) {
		if(is_null($table_name)) {
			$part = explode('\\', $entity_name );
			$count = count($part);
			$count--;
			$this->table_name = $part[$count];
		} else {
			$this->table_name = $table_name;
		}

		if(!is_null($structure) && is_array($structure)) {
			$this->structure = $structure;
		} else {
			$this->structure = array();
		}

		$this->entity_name = $entity_name;
	}

	public function getEntityName() 
	{
		return $this->entity_name;
	}

	public function getTableName() 
	{
		return $this->table_name;
	}

	public function getStructure() 
	{
		return $this->structure;
	}
	
	public function getPrimaryKeys() 
	{
		$retour = array();
		foreach ($this->structure as $key => $value) {
			if (array_key_exists(self::CONSTRAINT, $value)) {
				if (in_array('pk', $value[self::CONSTRAINT])) {
					$retour[] = $key;
				}
			}
		}
		return $retour;
	}

	public function getJoints() 
	{
		$retour = array();
		foreach ($this->structure as $key => $value) {
			if (array_key_exists(self::JOINT, $value)) {
				$retour[] = $key;
			}
		}
		return $retour;
	}
}