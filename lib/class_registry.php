<?php

/**
 * Classe Registry
 *
 * @package IdeYou
 * @author Isaque Costa
 * @copyright 2021
 **/

abstract class Registry
{
  static $objects = array();


  /**
   * Registry::get()
   * 
   * @param mixed $name
   * @return
   */
  public static function get($name)
  {
    return isset(self::$objects[$name]) ? self::$objects[$name] : null;
  }

  /**
   * Registry::set()
   * 
   * @param mixed $name
   * @param mixed $object
   * @return
   */
  public static function set($name, $object)
  {
    self::$objects[$name] = $object;
  }
}
