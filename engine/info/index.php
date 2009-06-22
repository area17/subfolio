<?php $enabled = file_exists("disabled.php") ? false : true;  ?>
<?php if ($enabled) {  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Subfolio Info</title>	

		<link href="css/info.css" type="text/css" rel="stylesheet" >
		
	</head>
	<body>
		<h1 id="logo">Subfolio System Information</h1>

		<hr/ >
		
		<?php
			$version = file_get_contents('../VERSION.txt');
		?>
		<table cellspacing="0">
			<tr>
				<th class="label"><h2>Subfolio Version:</h2></th>
				<td class="sign"></td>
				<td class="version"><h2><?php echo $version ?></h2></td>
				<td class="instructions"></td>
			</tr>
		</table>
		
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
				<?php if (!version_compare(PHP_VERSION, '5.2', '>=')): ?>
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

			<tr>
				<th class="label">.htaccess file</th>
				<?php if (file_exists('../../.htaccess')): ?>
					<td class="sign pass">Pass</td>
					<td class="version">found</td>
					<td class="instructions"></td>
				<?php else: ?>
					<td class="sign fail">Failed</td>
					<td class="version"><span class='red'>Not found</span><span class='grey'>&nbsp;&nbsp;&mdash;&nbsp;&nbsp;/.htaccess</span></td>
					<td class="instructions exclam">Rename the <i>htaccess</i> file on the root to <i>.htaccess</i> (just add a dot to the beginning of the name)</td>
				<?php endif ?>
			</tr>
										
		</table>
		
		<hr/ >

		<table cellspacing="0">
			<tr>
				<td class="label" colspan="4"><h2>Settings:</h2></td>
			</tr>
			<tr>
				<th class="label">Settings file</th>
				<?php if (!file_exists('../../config/settings/settings.yml')): ?>
					<td class="sign pass">Pass</td>
					<td class="version">found</td>
					<td class="instructions"></td>
				<?php else: ?>
					<td class="sign fail">Failed</td>
					<td class="version"><span class='red'>Not found</span><span class='grey'>&nbsp;&nbsp;&mdash;&nbsp;&nbsp;/config/settings/settings.yml</span></td>
					<td class="instructions exclam">Duplicate the <i>settings.sample.yml</i> file and rename it to <i>settings.yml</i></td>
				<?php endif ?>
			</tr>

			<tr>
				<th class="label">File Kinds file</th>
				<?php if (file_exists('../../config/settings/filekinds.yml')): ?>
					<td class="sign pass">Pass</td>
					<td class="version">found</td>
					<td class="instructions"></td>
				<?php else: ?>
					<td class="sign fail">Failed</td>
					<td class="version"><span class='red'>Not found</span><span class='grey'>&nbsp;&nbsp;&mdash;&nbsp;&nbsp;/config/settings/filekinds.yml</span></td>
					<td class="instructions exclam">Duplicate the <i>filekinds.sample.yml</i> file and rename it to <i>filekinds.yml</i></td>
				<?php endif ?>
			</tr>
						
			<tr>
				<th class="label">Language file</th>
				<?php if (file_exists('../../config/settings/language.yml')): ?>
					<td class="sign pass">Pass</td>
					<td class="version">found</td>
					<td class="instructions"></td>
				<?php else: ?>
					<td class="sign fail">Failed</td>
					<td class="version"><span class='red'>Not found</span><span class='grey'>&nbsp;&nbsp;&mdash;&nbsp;&nbsp;/config/settings/language.yml</span></td>
					<td class="instructions exclam">Duplicate the <i>language.sample.yml</i> file and rename it to <i>filekinds.yml</i></td>
				<?php endif ?>
			</tr>
									
		</table>

		<hr/ >

		<table cellspacing="0">
			<tr>
				<td class="label" colspan="4"><h2>Users &amp; groups:</h2></td>
			</tr>
			<tr>
				<th class="label">Users file</th>
				<?php if (file_exists('../../config/users/users.yml')): ?>
					<td class="sign pass">Pass</td>
					<td class="version">found</td>
					<td class="instructions"></td>
				<?php else: ?>
					<td class="sign fail">Failed</td>
					<td class="version"><span class='red'>Not found</span><span class='grey'>&nbsp;&nbsp;&mdash;&nbsp;&nbsp;/config/users/users.yml</span></td>
					<td class="instructions exclam">Duplicate the <i>users.sample.yml</i> file and rename it to <i>users.yml</i></td>
				<?php endif ?>
			</tr>

			<tr>
				<th class="label">Groups file</th>
				<?php if (file_exists('../../config/users/groups.yml')): ?>
					<td class="sign pass">Pass</td>
					<td class="version">found</td>
					<td class="instructions"></td>
				<?php else: ?>
					<td class="sign fail">Failed</td>
					<td class="version"><span class='red'>Not found</span><span class='grey'>&nbsp;&nbsp;&mdash;&nbsp;&nbsp;/config/users/groups.yml</span></td>
					<td class="instructions exclam">Duplicate the <i>groups.sample.yml</i> file and rename it to <i>groups.yml</i></td>
				<?php endif ?>
			</tr>
												
		</table>
		



			<?php /* ?>			
			<tr>
			<th>Reflection Enabled</th>
			<?php if (class_exists('ReflectionClass')): ?>
			<td class="pass">Pass</td>
			<?php else: $failed = TRUE ?>
			<td class="fail">PHP <a href="http://www.php.net/reflection">reflection</a> is either not loaded or not compiled in.</td>
			<?php endif ?>
			</tr>
			<tr>
			<th>Filters Enabled</th>
			<?php if (function_exists('filter_list')): ?>
			<td class="pass">Pass</td>
			<?php else: $failed = TRUE ?>
			<td class="fail">The <a href="http://www.php.net/filter">filter</a> extension is either not loaded or not compiled in.</td>
			<?php endif ?>
			</tr>
			<tr>
			<th>Iconv Extension Loaded</th>
			<?php if (extension_loaded('iconv')): ?>
			<td class="pass">Pass</td>
			<?php else: $failed = TRUE ?>
			<td class="fail">The <a href="http://php.net/iconv">iconv</a> extension is not loaded.</td>
			<?php endif ?>
			</tr>
			
			<?php if (extension_loaded('mbstring')): ?>
			<tr>
			<th>Mbstring Not Overloaded</th>
			<?php if (ini_get('mbstring.func_overload') & MB_OVERLOAD_STRING): $failed = TRUE ?>
			<td class="fail">The <a href="http://php.net/mbstring">mbstring</a> extension is overloading PHP's native string functions.</td>
			<?php else: ?>
			<td class="pass">Pass</td>
			</tr>
			<?php endif ?>
			<?php else: // check for utf8_[en|de]code when mbstring is not available ?>
			<tr>
			<th>XML support</th>
			<?php if ( ! function_exists('utf8_encode')): $failed = TRUE ?>
			<td class="fail">PHP is compiled without <a href="http://php.net/xml">XML</a> support, thus lacking support for <code>utf8_encode()</code>/<code>utf8_decode()</code>.</td>
			<?php else: ?>
			<td class="pass">Pass</td>
			<?php endif ?>
			</tr>
			<?php endif ?>
			<tr>
			<th>URI Determination</th>
			<?php if (isset($_SERVER['REQUEST_URI']) OR isset($_SERVER['PHP_SELF'])): ?>
			<td class="pass">Pass</td>
			<?php else: $failed = TRUE ?>
			<td class="fail">Neither <code>$_SERVER['REQUEST_URI']</code> or <code>$_SERVER['PHP_SELF']</code> is available.</td>
			<?php endif ?>
			</tr>
				<?php */ ?>

				<hr/ >

		<p><small>If you wish to disable this page, create a blank file: /engine/info/disabled.php</small></p>
		
		
	</body>
</html>
<?php } else { ?>
		<p>Subfolio Information page is currently disabled, to enable it delete: /engine/info/disabled.php</p>
<?php } ?>
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