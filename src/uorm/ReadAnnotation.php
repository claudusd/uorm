<?php
namespace ORM;

/**
 * A class's tool to read annotation an translat in a array of mapping information.
 * @author Claude DIOUDONNAT
 **/
class ReadAnnotation implements Constant 
{
	/**
	 * Read the annotation of entity's property and return the mapping information.
	 * @param string Annotation of the property.
	 * @return array The mapping information.
	 **/
	public static function getPropertyMapping($annotation) 
	{
		$return = array();
		if(strlen($annotation) > 0) {
			preg_match('#@ORM(.*?)\n#s', $annotation, $ORMAnotation);
			if(count($ORMAnotation) > 0) {
				preg_match('|Column\((.*)\)|', $ORMAnotation[1], $column);
				if(count($column) > 0) {
					$return = self::getColumnMapping($column[1]);
				} else {
					preg_match('|Join\((.*)\)|', $ORMAnotation[1], $join);
					if(count($join) > 0) {
						$return = self::getJoinMapping($join[1]);
					} else {
						throw new ORMException("Unknow annotation type.", 1);
					}
				}
			}
		}
		return $return;
	}
	/**
	 *
	 * @param
	 * @return
	 **/
	private static function getColumnMapping($value) 
	{
		$return = array();
		if(strlen($value) >= 1) {
			$explode = explode(',', $value);
			$tempConstraint;
			foreach ($explode as $parameter) {
				$explode2 = explode('=', $parameter);
				if(count($explode2) == 2) {
					$parameterValue = trim($explode2[1]);
					switch (trim($explode2[0])) {
						case self::NAME :
							$return[self::NAME] = $parameterValue;
							break;
						case self::TYPE :
							if(self::typeExist($parameterValue)) {
								$return[self::TYPE] = $parameterValue;
							} else {
								throw new ORMException("The type ".$parameterValue." is unknow or not suported by the ORM.", 1);
							}
							break;
						case self::CONSTRAINT :
							if(StringUtil::startsWith($parameterValue, '{')) {
								$tempConstraint = array();
								$unique = false;
								if(StringUtil::endsWith($parameterValue, '}')) {
									$length = count($parameterValue)-1;
									$unique = true;
								} else {
									$length = count($parameterValue)+1;
								}
								$tempConstraint[] = substr($parameterValue, 1, $length);
								if($unique) {
									$return[self::CONSTRAINT] = $tempConstraint;
									unset($tempConstraint);
								}
							} else {
								$return[self::CONSTRAINT] = array($parameterValue);
							}
							break;
						default:
							break;
					}
				} else {
					if(is_array($tempConstraint) && count($tempConstraint) > 0) {
						if(StringUtil::endsWith($parameter, '}')) {
							$tempConstraint[] =trim(substr($parameter, 0, -1));
							$return[self::CONSTRAINT] = $tempConstraint;
							unset($tempConstraint);
						} else {
							$tempConstraint[] = trim($parameter);
						}
					}
				}
			}
		}
		return $return;
	}
	/**
	 * 
	 * @param 
	 * @return 
	 **/
	public static function getJoinMapping($value) 
	{
		$return = array();
		if(strlen($value) >= 1) {
			$explode = explode(',', $value);
			foreach ($variable as $value) {
				$explode2 = explode('=', $parameter);
				if(count($explode2) == 2) {
					$parameterValue = trim($explode2[1]);
					switch (trim($explode2[0])) {
						case self::TYPE :
							if(self::joinTypeExist($parameterValue)) {
								$return[TYPE] = $parameterValue;
							} else {
								throw new ORMException("Unknow join type.", 1);
							}
							break;
						case self::TO :
							$return[TO] = $parameterValue;
							break;
						case self::IN :
							$return[IN] = $parameterValue;
							break;
						case self::OUT :
							$return[$OUT] = $parameterValue;
							break;
						default:
							break;
					}
				}
			}
		}
		return $return;
	}

	/**
	 *
	 * @param
	 * @return
	 **/
	private static function typeExist($typeName) 
	{
		$arrayListType = array(
			self::TYPE_STRING, 
			self::TYPE_DATETIME, 
			self::TYPE_INT
		);
		return in_array($typeName, $arrayListType);
	}
	/**
	 *
	 * @param
	 * @return
	 **/
	private static function joinTypeExist($typeJoinName) 
	{
		$arrayListType = array(
			self::JOIN_O_T_O,
			self::JOIN_O_T_M,
			self::JOIN_M_T_M
		);
		return in_array($typeJoinName, $arrayListType);
	}

	public static function getEntityMapping($annotation) 
	{
		if(strlen($annotation) > 0) {
			preg_match('#@ORM(.*?)\n#s', $annotation, $ORMAnotation);
			if(count($ORMAnotation) > 0) {
				preg_match('|Table\((.*)\)|', $ORMAnotation[1], $table);
				if(count($table) > 0) {
					if(strlen($table[1]) >= 1) {
						$explode = explode(',', $table[1]);
						if(count($explode) > 0) {
							foreach ($explode as $value) {
								$explode2 = explode("=", $value);
								if(count($explode2) == 2) {
									if(trim($explode2[0]) == self::NAME) {
										return trim($explode2[1]);
									}
								}
							}
						}
					}
				}
			}	
		}
		return null;
	}
}