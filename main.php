<?php
/*
 *	Handles the main application process
 *  Handles routes registration 
 */
	require_once( dirname(__FILE__)  . "/config.php");
	require_once( dirname(__FILE__) . "/settings.php");

	$objRoute = new Route;
	
	/*
	 * This bit loops through each defined routes in the  routes.php file
	 */
	if (true === file_exists(ROOT_DIR . "/routes.php"))
	{
		include_once(ROOT_DIR . "/routes.php");
		
		$arrRoutes = Register::GetRoutes();
		if (false == empty($arrRoutes))
		{
			foreach($arrRoutes as $strPath => $strHandler)
			{
				$objRoute->Register($strPath, $strHandler);
			}
		}
	}
	
	$objRouting = new Routing($objRoute);
	$objResponse = new Response;
	
	$objServe = new Serve($objRouting, $objResponse);
	$objServe->Page();