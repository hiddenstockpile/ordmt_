<?php
/*
 *	Class SearchView - handles the view part based on the returned data in the controller
 */
class SearchView{

	/*
	 * define our properties needed
	 */
	private $pArrDataOutput;
	private $pStrCollection;
	
	/*
	 * constructor, initialise SearchView criteria
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
	 * Displays Posts information
	 * @return String
	 */
	private function DisplayPosts()
	{
		$arrDataOutput = $this->pArrDataOutput;
		
		if (true == empty($arrDataOutput))
		{
			return $this->DisplayEmpty();
		}
		
		$strHtml = '';
		foreach ($arrDataOutput as $intKey => $arrPostData)
		{
		
			$strHtml .= '<p><hr /></p>' ;
			//title
			$arrTitle = Utils::GetValueByIndex(Constants::TITLE, $arrPostData);
			$strTitle = Utils::GetValueByIndex(Constants::RENDERED, $arrTitle);
			$strHtml .= '<h2> ' . $strTitle . ' </h2>';
			
			$strPostId = Utils::GetValueByIndex(Constants::ID, $arrPostData);
			$strHtml .= '<a href="' . HOME_URL . '/showpost?' . Constants::ID . '=' . $strPostId .'">view this post</a>';
			
			$strHtml .= '<p>&nbsp;</p>' ;
			
			//content
			$arrContent = Utils::GetValueByIndex(Constants::CONTENT, $arrPostData);
			$strContent = Utils::GetValueByIndex(Constants::RENDERED, $arrContent);
			$strHtml .= $strContent;
			
			$strHtml .= '<p>&nbsp;</p>' ;
			
			//author
			$arr_Embedded = Utils::GetValueByIndex(Constants::UNDERSCORE_EMBEDDED, $arrPostData);
			$arrAuthor = Utils::GetValueByIndex(Constants::AUTHOR, $arr_Embedded);
			$arrAuthor = Utils::GetValueByIndex(Constants::INT_ZERO, $arrAuthor);
			$strAuthorName = Utils::GetValueByIndex(Constants::NAME, $arrAuthor);
			$strAuthorDescription = Utils::GetValueByIndex(Constants::DESCRIPTION, $arrAuthor);			
			$strHtml .= '<b>' . $strAuthorName . '</b>';
			$strHtml .= '<span>' . $strAuthorDescription . '</span>';
			
			$strHtml .= '<p>&nbsp;</p>' ;
			
			//date
			$strDate = Utils::GetValueByIndex(Constants::PUBLISH_DATE, $arrPostData);
			$strHtml .= '<i>' . $strDate . '</i>';
			
			$strHtml .= '<p>&nbsp;</p>' ;
			
		}
		
		return $strHtml;	
	}
	
	/*
	 * Displays Comments information
	 * @return String
	 */
	private function DisplayComments()
	{
		$arrDataOutput = $this->pArrDataOutput;
		
		if (true == empty($arrDataOutput))
		{
			return $this->DisplayEmpty();
		}
		
		$strHtml = '';
		foreach ($arrDataOutput as $intKey => $arrPostData)
		{
			$arr_Embedded = Utils::GetValueByIndex(Constants::UNDERSCORE_EMBEDDED, $arrPostData);
			$arrUp = Utils::GetValueByIndex(Constants::UP, $arr_Embedded);
			$arrUpData = Utils::GetValueByIndex(Constants::INT_ZERO, $arrUp);
				
			$strHtml .= '<p><hr /></p>' ;
			//title
			$arrTitle = Utils::GetValueByIndex(Constants::TITLE, $arrUpData);
			$strTitle = Utils::GetValueByIndex(Constants::RENDERED, $arrTitle);
			$strHtml .= '<h2> ' . $strTitle . ' </h2>';
			
			$strPostId = Utils::GetValueByIndex(Constants::POST, $arrPostData);
			$strHtml .= '<a href="' . HOME_URL . '/show_post.php?id='. $strPostId .'">view this post</a>';
			
			//date
			$strDate = Utils::GetValueByIndex(Constants::PUBLISH_DATE, $arrPostData);
			$strHtml .= '<p><i>commented from this post on ' . Utils::PrettyDateFormat($strDate) . ' </i></p>';
			
			$strHtml .= '<p>&nbsp;</p>' ;
			
			//content
			$arrContent = Utils::GetValueByIndex(Constants::CONTENT, $arrPostData);
			$strContent = Utils::GetValueByIndex(Constants::RENDERED, $arrContent);
			$strHtml .= $strContent;
			
			$strHtml .= '<p>&nbsp;</p>' ;
			
			$strAuthorName = Utils::GetValueByIndex(Constants::AUTHOR_NAME, $arrPostData);
			$strHtml .= '<i>posted by : </i><b>' . $strAuthorName . '</b>';
			
			$strHtml .= '<p>&nbsp;</p>' ;
		}
		
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
