<?php 
/*******************************************************************
*                                                                  *
* If you see this plain text file, it means that your server is    *
* not running PHP.  You can’t install Subfolio on it.              *
*                                                                  *
* Ask your system administrator to install PHP.                    *
*                                                                  *
*******************************************************************/
?>
<?php
  $is_ready = true;
  if (version_compare(apacheversion(), '2.0', '>=') != true) {
    $is_ready = false;
  }

  if (version_compare(PHP_VERSION, '5.2', '>=') != true) {
    $is_ready = false;
  }

	if (extension_loaded('gd') != true) {
	  $is_ready = false;
	}

	if (function_exists('spl_autoload_register') != true) {
	  $is_ready = false;
	}
	if (apache_is_module_loaded('mod_rewrite') != true) {
	  $is_ready = false;
	}

	if ( ! function_exists('preg_match')) {
	   $is_ready = false;
	} 

  if ( ! @preg_match('/^.$/u', 'ñ')) { 
	  $is_ready = false;
  } 
  
  if ( ! @preg_match('/^\pL$/u', 'ñ')) {
    $is_ready = false;
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Subfolio Info</title>	

		<link href="http://www.subfolio.com/checker/css/info.css" type="text/css" rel="stylesheet" >
		
	</head>
	<body>
		<h1 id="logo">Subfolio System Information</h1>

		<hr/ >

    <h2>Installation requirements tested for Subfolio.</h2>

    <?php if ($is_ready) { ?>
      <h3 class="ready">You are good to go!</h3>
      <p>It appears that your system is ready to run the latest version of Subfolio (v 1.0)</p>
    <?php } else { ?>
      <h3 class="not-ready">Ops, it seems that your system may not be ready.</h3>
      <p>It appears that your system may NOT be ready to run the latest version of Subfolio (v 1.0)</p>
    <?php } ?>

    <p>The chart below details the tests carried out on your system.</p>

		<hr/ >
		
		<table cellspacing="0">
			<tr>
				<td class="label" colspan="4"><h2>Server Requirements:</h2></td>
			</tr>
			<tr>
				<th class="label">Apache Version</th>
				<?php if (version_compare(apacheversion(), '2.0', '>=')): ?>
					<td class="sign pass">Pass</td>
					<td class="version"><?php echo apacheversion() ?></td>
					<td class="instructions"></td>
				<?php else: $failed = TRUE ?>
					<td class="sign fail">Failed</td>
					<td class="version"><?php echo apacheversion() ?></td>
					<td class="instructions exclam">Subfolio requires Apache 2.0 or newer</td>
				<?php endif ?>
			</tr>
			
			<tr>
				<th class="label">PHP Version</th>
				<?php if (version_compare(PHP_VERSION, '5.2', '>=')): ?>
					<td class="sign pass">Pass</td>
					<td class="version"><?php echo PHP_VERSION ?></td>
					<td class="instructions"></td>
				<?php else: $failed = TRUE ?>
					<td class="sign fail">Failed</td>
					<td class="version"><?php echo PHP_VERSION ?></td>
					<td class="instructions exclam">Subfolio requires PHP 5.2 or newer</td>
				<?php endif ?>
			</tr>
				
			<tr>
				<th class="label">GD Enabled</th>
				<?php if (extension_loaded('gd')): ?>
					<td class="sign pass">Pass</td>
					<td class="version"><?php echo gdversion() ?></td>
					<td class="instructions"></td>
				<?php else: $failed = TRUE ?>
					<td class="sign fail">Failed</td>
					<td class="version red">GD is not enabled</td>
					<td class="instructions exclam">Ask your system administrator to install the <a href="http://php.net/gd" target="_blank">GD Library</a> on your server</td>
				<?php endif ?>
			</tr>
				
			<tr>
				<th class="label">SPL Enabled</th>
				<?php if (function_exists('spl_autoload_register')): ?>
					<td class="sign pass">Pass</td>
					<td class="version"></td>
					<td class="instructions"></td>
				<?php else: $failed = TRUE ?>
					<td class="sign fail">Failed</td>
					<td class="version red">SPL is not enabled</td>
					<td class="instructions exclam">Ask your system administrator to add <a href="http://php.net/spl" target="_blank">SPL</a> support to your server</td>
				<?php endif ?>
			</tr>

			<tr>
				<th class="label">PCRE UTF-8</th>
				<?php if ( ! function_exists('preg_match')): $failed = TRUE ?>
					<td class="sign fail">Failed</td>
					<td class="version red">PCRE support is missing</td>
					<td class="instructions exclam">Ask your system administrator to add <a href="http://php.net/pcre" target="_blank">PCRE</a> support to your server</td>
				<?php elseif ( ! @preg_match('/^.$/u', 'ñ')): $failed = TRUE ?>
					<td class="sign fail">Failed</td>
					<td class="version red">No UTF-8 support</td>
					<td class="instructions exclam"><a href="http://php.net/pcre" target="_blank">PCRE</a> has not been compiled with UTF-8 suppor.</td>
				<?php elseif ( ! @preg_match('/^\pL$/u', 'ñ')): $failed = TRUE ?>
					<td class="sign fail">Failed</td>
					<td class="version red">No Unicode support</td>
					<td class="instructions exclam"><a href="http://php.net/pcre" target="_blank">PCRE</a> has not been compiled with Unicode property support</td>
				<?php else: ?>
					<td class="sign pass">Pass</td>
					<td class="version"></td>
					<td class="instructions"></td>
				<?php endif ?>
			</tr>

			<tr>
				<th class="label">Mod Rewrite</th>
				<?php $have_module = apache_is_module_loaded('mod_rewrite'); ?>
				<?php if ($have_module) { ?>
					<td class="sign pass">Pass</td>
					<td class="version"></td>
					<td class="instructions"></td>
				<?php } else if ($have_module == null) { ?>
					<td class="sign gloups">Unknown</td>
					<td class="version">Unknown</td>
					<td class="instructions exclam">We could not determine if Mod Rewrite was enabled or not</td>
				<?php } else { ?>
					<td class="sign fail">Failed</td>
					<td class="version red">Not enabled</td>
					<td class="instructions exclam">Ask your system administrator to enable Mod Rewrite for your site</td>					
				<?php } ?>
			</tr>

		</table>
		
		<hr />
		
	</body>
</html>
<?php 
  function apacheversion() {
    $ver = split("[/ ]",$_SERVER['SERVER_SOFTWARE']);
    $apver = "$ver[1] $ver[2]";
  	return $apver;
  }

  function gdversion() {
		$gd = gd_info(); 
    $ver = $gd['GD Version'];
  	return $ver;
  }

	function apache_is_module_loaded($mod_name) {
    if (function_exists('apache_get_modules')) {
      $modules = apache_get_modules();
      return in_array($mod_name, $modules);
    } else {
      return null;
    }
 	}

?>