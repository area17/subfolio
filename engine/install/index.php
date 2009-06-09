<?php $step = "start"; 

if (isset($_GET['step']) && $_GET['step'] == 'setup') {
  $step = 'setup';
} else if (isset($_GET['step']) && $_GET['step'] == 'done')  {
  $step = 'done';
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Subfolio Install</title>	
	
		<style type="text/css" media="screen">
		</style>
	</head>
	<body>
    <?php 
    if ($step == "start") {
    	include("start.inc");
    } else if ($step == "setup") {
    	include("setup.inc");
    } else if ($step == "done") {
    	include("done.inc");
    }
    ?>
	</body>
</html>