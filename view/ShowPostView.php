<?php
/*
 *	Class ShowPostView - handles the view part based on the returned data in the controller
 */
class ShowPostView{

	/*
	 * define our properties needed
	 */
	private $pArrDataOutput;
	private $pStrCollection;
	
	/*
	 * constructor, initialise ShowPostView criteria
	 * @param Array, String
	 */
	public function __construct($aArrDataOutput, $aStrCollection)
	{
		$this->pStrCollection = $aStrCollection;
		$this->pArrDataOutput = $aArrDataOutput;
    }
	
	/*
	 * This function handles return display for each field needed to be displayed
	 * @return String
	 */
	public function GetPage()
	{		
		if (Constants::COLLECTION_POSTS  == $this->pStrCollection)
		{		
			return $this->DisplayPosts();
		}
		
		if (Constants::COLLECTION_COMMENTS == $this->pStrCollection)
		{
			return $this->DisplayComments();
		}
	}
	
	
	/*
	 * Displays Post information
	 * @return String
	 */
	private function DisplayPosts()
	{	
		if (true == empty($this->pArrDataOutput))
		{
			return $this->DisplayEmpty();
		}
		
		$strHtml = '';
		//title
		$arrTitle = Utils::GetValueByIndex(Constants::TITLE, $this->pArrDataOutput);
		$strTitle = Utils::GetValueByIndex(Constants::RENDERED, $arrTitle);
		$strHtml .= '<h2> ' . $strTitle . ' </h2>';
		
		$arr_Embedded =  Utils::GetValueByIndex(Constants::UNDERSCORE_EMBEDDED, $this->pArrDataOutput);
		$arrWPFeaturedMedia = Utils::GetValueByIndex(Constants::WP_COLON_FEATUREDMEDIA, $arr_Embedded);
		$arrFirstElement = Utils::GetValueByIndex(Constants::INT_ZERO, $arrWPFeaturedMedia);
		$arrMediaDetails = Utils::GetValueByIndex(Constants::MEDIA_DETAILS, $arrFirstElement);
		$arrSizes = Utils::GetValueByIndex(Constants::SIZES, $arrMediaDetails);
		$arrMediumLarge = Utils::GetValueByIndex(Constants::MEDIUM_LARGE, $arrSizes);
		$strSourceUrl = Utils::GetValueByIndex(Constants::SOURCE_URL, $arrMediumLarge, '');
		
		if (null != $strSourceUrl && '' != $strSourceUrl)
		{
			$strHtml .= '<p><img src=" ' . $strSourceUrl . '" /></p>' ;
		}
		
		$strHtml .= '<p>&nbsp;</p>' ;
		
		//content
		$arrContent = Utils::GetValueByIndex(Constants::CONTENT, $this->pArrDataOutput);
		$strContent = Utils::GetValueByIndex(Constants::RENDERED, $arrContent);
		$strHtml .= $strContent;
		
		$strHtml .= '<p>&nbsp;</p>' ;
		
		//author
		$arr_Embedded = Utils::GetValueByIndex(Constants::UNDERSCORE_EMBEDDED, $this->pArrDataOutput);
		$arrAuthor = Utils::GetValueByIndex(Constants::AUTHOR, $arr_Embedded);
		$arrAuthor = Utils::GetValueByIndex(Constants::INT_ZERO, $arrAuthor);
		$strAuthorName = Utils::GetValueByIndex(Constants::NAME, $arrAuthor);
		$strAuthorDescription = Utils::GetValueByIndex(Constants::DESCRIPTION, $arrAuthor);			
		$strHtml .= 'Author : <b>' . $strAuthorName . '</b>';
		$strHtml .= '<span>' . $strAuthorDescription . '</span>';
		
		$strHtml .= '<p>&nbsp;</p>' ;
		
		$strDate = Utils::GetValueByIndex(Constants::PUBLISH_DATE, $this->pArrDataOutput);
		$strHtml .= '<p><i>publish on ' . Utils::PrettyDateFormat($strDate) . ' </i></p>';
		
		$strHtml .= '<p>&nbsp;</p>' ;
		$strHtml .= '<p><a href="' . HOME_URL . '/search">return to search page</a></p>';
		
		return $strHtml;	
	}
	
	/*
	 * Displays Emtpy template
	 * @return String
	 */
	private function DisplayEmpty()
	{
		$strHtml = '<p>&nbsp;</p>' ;
		$strHtml .= '<h3>Sorry no posts matching your criteria. Try another one.</h3>' ;
		return $strHtml;
	}
}
