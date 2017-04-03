<?php
/*
 *	Class Register - Accepts Routing that will be registered during run time to determine how we serve page
 */

class Register{
	
	/*
	 * define our properties needed
	 */
	private static $pArrRoutes;
	
	/*
	 * Add the route to the Routes Array, which will then be processed By Class Route
	 * @param String, String	 
	 */	
	public static function Route($aStrPath, $aStrHandler)
	{
		self::$pArrRoutes[$aStrPath] = $aStrHandler;
	}
	
	/*
	 * Get all registered Routes
	 * @return Array
	 */	
	public static function GetRoutes()
	{
		return self::$pArrRoutes;
	}
}