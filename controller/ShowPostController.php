<?php
/*
 *	Class ShowPostController - manages ShowPostView and ShowPostModel processes
 */
include_once(VIEW_DIR . '/ShowPostView.php');
include_once(MODEL_DIR . '/ShowPostModel.php');

class ShowPostController{
	
	/*
	 * define our properties needed
	 */
	public $pObjResponse;	
	protected $pArrCriteria;
	
	/*
	 * constructor, initialise ShowPostController
	 * @param Object
	 */
	public function __construct(Response $aObjResponse)
	{
		$this->pObjResponse = $aObjResponse;		
		$this->pArrCritera = $_GET;
	}
	
	/*
	 * This function handles the Page to be displayed by the ShowPostView	 
	 */
	public function ShowPost()
	{
		$this->SetShowPage();
	}
	
	/*
	 * This function is called locally to manage the Page to be displayed by the ShowPostView	 
	 */
	private function SetShowPage()
	{
		$objShowPostModel = new ShowPostModel($this->pArrCritera);
		$objShowPostModel->ProcessData();
		$arrGetOutput = $objShowPostModel->GetOutput();
		
		$this->pObjResponse->SetTitle('Show Post Page');
		$strBody = '';
		foreach($arrGetOutput as $strCollection => $arrProcessedData)
		{
			$objShowPostView = new ShowPostView($arrProcessedData, $strCollection);
			$strBody .= $objShowPostView->GetPage();
		}
		$this->pObjResponse->SetBody($strBody);
		
	}
}

