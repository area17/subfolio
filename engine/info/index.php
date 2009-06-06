<?php $enabled = file_exists("disabled.php") ? false : true;  ?>
<?php if ($enabled) {  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Subfolio Info</title>	
	
		<style type="text/css" media="screen">
		table { width: 770px;}
		</style>
	</head>
	<body>
		<h1>Subfolio System Information</h1>

		<?php
			$version = file_get_contents('../VERSION.txt');
		?>
		<h2>Subfolio Version: <?php echo $version ?></h2>

		<div id="tests">
			<table cellspacing="0">
			<tr>
				<th>Apache Version</th>
				<?php if (version_compare(apacheversion(), '2.0', '>=')): ?>
				<td class="pass">Pass</td>
				<td class="info"><?php echo apacheversion() ?></td>
				<?php else: $failed = TRUE ?>
				<td class="fail">Subfolio requires Apache 2.0 or newer.</td>
				<td class="info"><?php echo apacheversion() ?></td>
				<?php endif ?>
			</tr>
			<tr>
				<th>PHP Version</th>
				<?php if (version_compare(PHP_VERSION, '5.2', '>=')): ?>
				<td class="pass">Pass</td>
				<td class="info"><?php echo PHP_VERSION ?></td>
				<?php else: $failed = TRUE ?>
				<td class="fail">Subfolio requires PHP 5.2 or newer.</td>
				<td class="info"><?php echo PHP_VERSION ?></td>
				<?php endif ?>
			</tr>

			<tr>
				<th>GD</th>
				<?php if (extension_loaded('gd')): ?>
				<td class="pass">Pass</td>
				<td class="info"><?php echo gdversion() ?></td>
				<?php else: ?>
				<td class="pass">Fail</td>
				<?php endif ?>
			</tr>

			<tr>
			<th>SPL Enabled</th>
			<?php if (function_exists('spl_autoload_register')): ?>
			<td class="pass">Pass</td>
			<?php else: $failed = TRUE ?>
			<td class="fail"><a href="http://php.net/spl">SPL</a> is not enabled.</td>
			<?php endif ?>
			</tr>
			

			<tr>
				<th>PCRE UTF-8</th>
				<?php if ( !function_exists('preg_match')): $failed = TRUE ?>
				<td class="fail"><a href="http://php.net/pcre">PCRE</a> support is missing.</td>
				<?php elseif ( ! @preg_match('/^.$/u', 'ñ')): $failed = TRUE ?>
				<td class="fail"><a href="http://php.net/pcre">PCRE</a> has not been compiled with UTF-8 support.</td>
				<?php elseif ( ! @preg_match('/^\pL$/u', 'ñ')): $failed = TRUE ?>
				<td class="fail"><a href="http://php.net/pcre">PCRE</a> has not been compiled with Unicode property support.</td>
				<?php else: ?>
				<td class="pass">Pass</td>
				<?php endif ?>
			</tr>


			<tr>
				<th>Mod Rewrite</th>
				<?php if (apache_is_module_loaded('mod_rewrite')): ?>
				<td class="pass">Pass</td>
				<?php else: ?>
				<td class="pass">Fail</td>
				<?php endif ?>
			</tr>

			<tr>
				<th>.htaccess file</th>
				<?php if (file_exists('../../.htaccess')): ?>
				<td class="pass">Pass</td>
				<?php else: ?>
				<td class="pass">Fail</td>
				<td class="info">.htaccess</td>
				<td class="action"><a href="#">Generate</a></td>
				<?php endif ?>
			</tr>

			<tr>
				<th>Settings YML</th>
				<?php if (file_exists('../../config/settings/settings.yml')): ?>
				<td class="pass">Pass</td>
				<?php else: ?>
				<td class="pass">Fail</td>
				<td class="info">/config/settings/settings.yml</td>
				<td class="action"><a href="#">Generate</a></td>
				<?php endif ?>
			</tr>

			<tr>
				<th>File Kinds YML</th>
				<?php if (file_exists('../../config/settings/filekinds.yml')): ?>
				<td class="pass">Pass</td>
				<?php else: ?>
				<td class="pass">Fail</td>
				<td class="info">/config/settings/filekinds.yml</td>
				<td class="action"><a href="#">Generate</a></td>
			<?php endif ?>
			</tr>

			<tr>
				<th>Language YML</th>
				<?php if (file_exists('../../config/settings/language.yml')): ?>
				<td class="pass">Pass</td>
				<?php else: ?>
				<td class="pass">Fail</td>
				<td class="info">/config/settings/language.yml</td>
				<td class="action"><a href="#">Generate</a></td>
				<?php endif ?>
			</tr>

			<tr>
				<th>Users YML</th>
				<?php if (file_exists('../../config/users/users.yml')): ?>
				<td class="pass">Pass</td>
				<?php else: ?>
				<td class="pass">Fail</td>
				<td class="info">/config/users/users.yml</td>
				<td class="action"><a href="#">Generate</a></td>
			<?php endif ?>
			</tr>

			<tr>
				<th>Groups YML</th>
				<?php if (file_exists('../../config/users/groups.yml')): ?>
				<td class="pass">Pass</td>
				<?php else: ?>
				<td class="pass">Fail</td>
				<td class="info">/config/users/groups.yml</td>
				<td class="action"><a href="#">Generate</a></td>
			<?php endif ?>
			</tr>

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
			</table>
		</div>
	</body>
</html>
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
    $modules = apache_get_modules();
    return in_array($mod_name, $modules);
 	}

?>