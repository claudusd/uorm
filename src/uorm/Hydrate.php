<?php
namespace ORM;
/**
 *
 */
class Hydrate {

	public  static $types = array('string', 'integer', 'datetime');

	public function classHydratation($class, array $values) {
		$return = array();
		$struct_class = array();
		if(is_array($values)) {
			$structure = StorageStructureEntity::getInstance()->getStructure($class);
			if(is_null($structure)) {
				
			}
			if(Storage)
			$r = new ReflectionClass($class);
			$props   = $r->getProperties();
			foreach ($props as $prop) {
				$doc =  $prop->getDocComment();
				preg_match('#@var(.*?)\n#s', $doc, $annotations);
				if(count($annotations) == 2) {
					$value = trim($annotations[1]);
	                                $type = explode(' ', $value);
					$type_name = strtolower($type[0]);
					if(!$this->typeExist($type_name)) {
						$type_name = 'string';
					}
				} else {
					$type_name = 'string';
				}
				$struct_class[$prop->getName()] = $type_name;
			}
			print_r($struct_class);
			foreach($values as $value) {
				//print_r($value);
				$object = new $class();
				//print_r($object);
				$myClassReflection = new ReflectionClass($class);
				foreach($value as $key => $property) {
					if(array_key_exists($key, $struct_class)) {
						$secret = $myClassReflection->getProperty($key);
                                                $secret->setAccessible(true);
						if($struct_class[$key] === "datetime") {
							$date = new DateTime($property);
							$secret->setValue($object, $date);
						} else {
                        	$secret->setValue($object, $property);
						}
					}
				}
				$return[] = $object;
			}
		}
		return $return;
	}
	private function typeExist($value) {
		return in_array($value, self::$types);
	}
}