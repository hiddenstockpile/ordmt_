<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->GetTitle(); ?></title>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
<?php
	echo $this->GetHeader();
?>
</head>
<body>
	<div class="container">
	<?php
		if(null != $this->GetTemplate())
		{
			$strTemplateFile = TEMPLATE_DIR . "/" . $this->GetTemplate();
			if (true == file_exists($strTemplateFile))
			{
				include_once($strTemplateFile);
			}
		}
		echo $this->GetBody();
	?>
	</div>
<?php
	echo $this->GetFooter();
?>
</body>
</html>