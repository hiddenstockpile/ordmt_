<?php
	$objFormData = new FormData($this->GetPostData());
?>
		<h1>PHP Application Specification Document</h1>
		<form id="frmSearchBox" enctype="multipart/form-data" method="POST" action="">
		<div class="row">
			<div class="col-xs-6">
				
				<div class="form-group">
					<label for="txtSearchBox">Search Box</label>
					<input type="text" class="form-control" id="txtSearchBox" name="search" value="<?php echo $objFormData->GetDataByField(Constants::SEARCH); ?>" placeholder="Enter text here" />
				</div>
				<div class="form-group">
					<label>Posts</label>
					<input type="radio" name="collection[]" value="<?php echo Constants::COLLECTION_POSTS; ?>" 
						<?php
							$arrSelectedCollections = $objFormData->GetDataByField(Constants::COLLECTION);
							if (false == is_array($arrSelectedCollections))
							{
								$arrSelectedCollections = array(
									Constants::COLLECTION_POSTS
								);
							}
							echo (true == in_array(Constants::COLLECTION_POSTS, $arrSelectedCollections)) ? 'checked="checked"' : ''; 
						?>
					/>
					<label>Comments</label>
					<input type="radio" name="collection[]" value="<?php echo Constants::COLLECTION_COMMENTS; ?>" 
						<?php echo (true == in_array(Constants::COLLECTION_COMMENTS, $arrSelectedCollections)) ? 'checked="checked"' : '';  ?>
					/>
				</div>
				<div class="form-group">
					<label for="selPerPage">Display Per Page</label>
					<select class="form-control" id="selPerPage" name="per_page">
					
						<?php
						
							$strSelectedValue = $objFormData->GetDataByField(Constants::PER_PAGE);
							if ('' == $strSelectedValue)
							{
								$strSelectedValue = 5;
							}
							
							$arrOptions = array(
								0 => 'all',
								1 => '1',
								2 => '2',
								3 => '3',
								5 => '5',
								10 => '10',
							);
							foreach ($arrOptions as $strOptionValue => $strOptionLabel)
							{
								if ($strOptionValue == 0)
								{
									$strOptionValue = '';
								}
								
								$strSelected = '';
								if($strOptionValue == $strSelectedValue)
								{
									$strSelected = 'selected';
								}
								echo '<option value="' . $strOptionValue . '" ' . $strSelected . '> ' . $strOptionLabel . ' </option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">	
					<label for="selOrderBy">Order By</label>
					<select class="form-control" id="selOrderBy" name="orderby">
						<?php
						
							$strSelectedValue = $objFormData->GetDataByField(Constants::ORDERBY);
							if ('' == $strSelectedValue)
							{
								$strSelectedValue = Constants::PUBLISH_DATE;
							}
							
							$arrOptions = array(
								Constants::PUBLISH_DATE => 'date',
								Constants::TITLE => 'title',
							);
							foreach ($arrOptions as $strOptionValue => $strOptionLabel)
							{
								$strSelected = '';
								if($strOptionValue == $strSelectedValue)
								{
									$strSelected = 'selected';
								}
								echo '<option value="' . $strOptionValue . '" ' . $strSelected . '> ' . $strOptionLabel . ' </option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">	
					<label for="selOrder">Order</label>
					<select class="form-control" id="selOrder" name="order">
						<?php
						
							$strSelectedValue = $objFormData->GetDataByField(Constants::ORDERBY);
							if ('' == $strSelectedValue)
							{
								$strSelectedValue = Constants::DESC;
							}
						
							$arrOptions = array(
								Constants::ASC => 'ascending',
								Constants::DESC => 'descending',
							);
							foreach ($arrOptions as $strOptionValue => $strOptionLabel)
							{
								$strSelected = '';
								if($strOptionValue == $objFormData->GetDataByField(Constants::ORDER))
								{
									$strSelected = 'selected';
								}
								echo '<option value="' . $strOptionValue . '" ' . $strSelected . '> ' . $strOptionLabel . ' </option>';
							}
						?>
					</select>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-xs-6">
				
				<label>Published Date</label>
				<div class="input-group input-daterange">
					<input class="form-control" type="text" name="after" id="after" placeholder="from" value="<?php echo $objFormData->GetDataByField(Constants::AFTER); ?>" />
					<div class="input-group-addon">to</div>
					<input class="form-control" type="text" name="before" id="before" placeholder="to" value="<?php echo $objFormData->GetDataByField(Constants::BEFORE); ?>" />
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-3">
				<p>&nbsp;</p>
				<input type="submit" value="Search Now" />
				<input type="button" value="Reset" onclick="window.location.href = '<?php echo HOME_URL; ?>/search';"/>
			</div>
		</div>
		</form>		