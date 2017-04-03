<?php

/*
 *	Class Route - Handles the route process to determine which controller we use to handle the page load
 */
class Route{
	
	/*
	 * define our properties needed
	 */
	private $pArrRegisteredRoutes;
	
	const CONTROLLER = "controller";
	const ACTION = "action";
	
	/*
	 * constructor, initialise Route
	 * 
	 */
	public function __construct()
	{
		$this->pArrRegisteredRoutes = array();
	}
	
	/*
	 * This will add the Registered Route in Class Register that will be used by Routing to point us in the right controller for the page requested
	 * @param String, String
	 */
	public function Register($aStrPath, $aStrHandler)
	{
		$arrHandler = explode('@', $aStrHandler);
		if (false == is_array($arrHandler) || true == empty($arrHandler))
		{
			return;
		}
		
		$this->pArrRegisteredRoutes[$aStrPath] = array(
			self::ACTION => $arrHandler[0],
			self::CONTROLLER => $arrHandler[1],
		);
	}
	
	/*
	 * Get all registered Routes
	 * @return Array
	 */	
	public function GetRoutes()
	{
		return $this->pArrRegisteredRoutes;
	}
}