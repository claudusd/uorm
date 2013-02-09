<?php
namespace ORM;
/**
 *
 **/
interface Constant 
{
	/** **/
	const TYPE_STRING = 'string';
	/** **/
	const TYPE_DATETIME = 'datetime';
	/** **/
	const TYPE_INT = 'int';
	/** **/
	const CONSTRAINT_PRIMARY_KEY = 'PRIMARY KEY';
	/** **/
	const CONSTRAINT_NOT_NULL = 'NOT NULL';

	const CONSTRAINT_AUTO_INCREMENT = 'AUTO_INCREMENT'; 

	const NAME = "name";

	const TYPE = "type";

	const CONSTRAINT = "constraint";

	const JOIN_O_T_O = "oto";

	const JOIN_O_T_M = "otm";

	const JOIN_M_T_M = "mtm";

	const TO = "to";

	const IN = "in";

	const OUT = "out";

	const JOINT = "joint";
}