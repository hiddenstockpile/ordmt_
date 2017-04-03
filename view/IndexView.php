<?php
/*
 *	Class IndexView - handles the view part based on the returned data in the controller
 */
class IndexView{

	/*
	 * define our properties needed
	 */	
	
	/*
	 * constructor, initialise IndexView
	 * 
	 */
	public function __construct()
	{
		
    }
	
	/*
	 * This function handles return display for each field needed to be displayed
	 * @return String
	 */
	public function GetPage()
	{		
		$this->DisplayIndex();
	}
	
	
	/*
	 * Displays Index page
	 * @return String
	 */
	private function DisplayIndex()
	{	
		
	}
	
	/*
	 * Displays Emtpy template
	 * @return String
	 */
	private function DisplayEmpty()
	{
		$strHtml = '<p>&nbsp;</p>' ;
		$strHtml .= '<h3>Sorry, this page is not accessible.</h3>' ;
		return $strHtml;
	}
}
