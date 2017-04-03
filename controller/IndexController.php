<?php
/*
 *	Class IndexController - manages IndexView processes
 */
include_once(VIEW_DIR . '/IndexView.php');

class IndexController{
	
	/*
	 * define our properties needed
	 */
	public $pObjResponse;
	
	/*
	 * constructor, initialise IndexController
	 * @param Object
	 */
	public function __construct(Response $aObjResponse)
	{
		$this->pObjResponse = $aObjResponse;		
	}
	
	/*
	 * This function handles the Page to be displayed by the ShowPostView	 
	 */
	public function Index()
	{
		$this->SetShowPage();
	}
	
	/*
	 * This function is called locally to manage the Page to be displayed by the IndexView	 
	 */
	private function SetShowPage()
	{
		$this->pObjResponse->SetTitle('Index Page');
		$strBody = '';
		
		$objIndexView = new IndexView;
		$strBody .= $objIndexView->GetPage();
		$this->pObjResponse->SetBody($strBody);
		
		$this->pObjResponse->SetTemplate('tp-index.php');
		
	}
}

