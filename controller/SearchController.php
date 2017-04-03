<?php
/*
 *	Class SearchController - manages SearchView and SearchModel processes
 */
include_once(VIEW_DIR . '/SearchView.php');
include_once(MODEL_DIR . '/SearchModel.php');

class SearchController{
	
	/*
	 * define our properties needed
	 */
	private $pObjResponse;
	protected $pArrCriteria;
	
	/*
	 * constructor, initialise SearchController
	 * @param Object
	 */
	public function __construct(Response $aObjResponse)
	{
		$this->pObjResponse = $aObjResponse;
		$this->pArrCritera = $_POST;
	}
	
	/*
	 * This function handles the Page to be displayed by the SearchView	 
	 */
	public function Search()
	{
		$this->SetSearchPage();
	}
	
	/*
	 * This function is called locally to manage the Page to be displayed by the SearchView	 
	 */
	private function SetSearchPage()
	{
		if (false == empty($this->pArrCritera))
		{
			$objSearchModel = new SearchModel($this->pArrCritera);
			$objSearchModel->ProcessData();
			$arrGetOutput = $objSearchModel->GetOutput();
			
			$strBody = '';
			foreach($arrGetOutput as $strCollection => $arrProcessedData)
			{
				$objSearchView = new SearchView($arrProcessedData, $strCollection);
				$strBody .= $objSearchView->GetPage();
			}
			$this->pObjResponse->SetBody($strBody);
		}
		
		$this->pObjResponse->SetTitle('Search Page');
		
		$strScriptOnHead = '
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
		';
		$this->pObjResponse->SetHeader($strScriptOnHead);
		$this->pObjResponse->SetTemplate('tp-search.php');
		
		$strScriptOnFooter = '
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
			<script src="' . JAVASCRIPT_URL . '/search.js"></script>
		';
		$this->pObjResponse->SetFooter($strScriptOnFooter);
	}
}

