<?php
namespace ORM;

/**
 *
 * @author Claude DIOUDONNAT
 **/
class StringUtil 
{
	/**
	 * To know if a string start by the string.
	 * @param string The string who want test.
	 * @param string The string value who want know the finish by.
	 * @return boolean True if the string start by the exepected string else false.
	 **/
	public static function startsWith($haystack, $needle) 
	{
    	return !strncmp($haystack, $needle, strlen($needle));
	}
	/**
	 * To know if a string finish by the the string.
	 * @param string The string who want to test.
	 * @param string The string value who want the start by.
	 * @return boolean True if the string finish by the exepected string else false.
	 **/
	public static function endsWith($haystack, $needle) 
	{
	    $length = strlen($needle);
	    if ($length == 0) {
	        return true;
	    }
	    return (substr($haystack, -$length) === $needle);
	}
	/**
	 *
	 * @param string The string who want remove some chars.
	 * @param string The String 
	 * @param
	 * @return
	 **/
	public static function removeFromStart($haystack, $needle, $most = 0)
	{
		
	}
}