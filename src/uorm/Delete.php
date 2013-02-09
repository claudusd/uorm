<?php
namespace ORM;
/**
 * This class is here to delete Entity in the database. 
 * It's can be dangerous to delete something in the database.
 * @author Claude Dioudonnat
 **/
class Delete 
{
	
	private static $instance;

	public static function getInstance() 
	{
		if (is_null(self::$instance)) {
			self::$instance = new Delete();
		}
		return self::$instance;
	}

	public function addEntityToDelete() 
	{

	}

	public function commit() 
	{

	}

	public function rollBack(Entity $entity = null)
	{

	}
}