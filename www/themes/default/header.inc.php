<?php
    $showHide = "showSwitch";
    $showHideLabel = "collapse header";
    if (isset($_COOKIE['logo'])) {
        if ($_COOKIE['logo'] == "hideSwitch") {
            $showHide = "hideSwitch";
            $showHideLabel = "expand header";
        }
    }
?>
<div id="header">
	<h1 id="logo" class="logo <?php print "".$showHide;?>"><a href='/' ><?php echo $site_title ?></a></div>
</div>

<div id="navigation">
<div id="path">
  PATH
</div>
<div id="pathlinks">
    <?php
    if (true) {
        print "<a title='Logout' alt='' href='/system/logout/'>logout</a> | ";
    }

    $subject = "Link from " . $_SERVER["SERVER_NAME"];
    $body = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    ?>
  <script>
    <!--
    document.write('<a href="mailto:?subject=<?php print "".$subject?>&body='+location.href+'">send page</a>');
    -->
  </script>
  | <a id="showHideSwitch" href="javascript:showHideSwitch('logo', document.getElementById('hideText')); "><FONT id="hideText"><?php print "".$showHideLabel;?></FONT></a>
</div>
</div>