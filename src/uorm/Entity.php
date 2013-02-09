<?php
namespace ORM;

/**
 * All entities who use the ORM could herite of this Entity class.
 **/
abstract class Entity 
{
	/**
	 * The MD5 sum to control if the entity properties has changed or not.
	 **/
	private $md5 = null;
	/**
	 * The constructor of the Entity, calcul the original MD5 sum.
	 **/
	public function __construct() 
	{
		$this->md5 = $this->calculMD5();
	}
	/**
	 * This method calcul the MD5 sum of the entity.
	 * @return string The MD5 sum.
	 **/
	private function calculMD5() 
	{
		$temp = $this->md5;
		$this->md5 = null;
		$serialize = serialize($this);
		$this->md5 = $temp;
		return md5($serialize);
	}
	/**
	 * To know if the entity has be modified, this method return true if the entity has change or false.
	 * @return boolean True if entity has be modified else false.
	 **/
	public function isChange() 
	{
		$new_md5 = $this->calculMD5();
		if($new_md5 == $this->md5) {
			return false;
		} else {
			return true;
		}
	}
	/**
	 * 
	 **/
	public function save() 
	{
		if($this6>isChange()) {

		}
	}
	/**
	 *
	 **/
	public function commit() 
	{
		ORMCommon::getInstance()->commit();
	}

    public function __call($name, $arguments)
    {
       if(StringUtil::startsWith($name, 'findAll')) {
			ORMCommon::getInstance()->findAll($this);
		} else if (StringUtil::startsWith($name, 'findOn')) {

		} else {

		}
    }
}