<p>Run installer...</p>

<p>settings.yml</p>

<?php 
$source = 'config/settings.yml';
$dest = '../../config/settings/settings.yml';
if (file_exists($source)) {
  if (file_exists($dest)) {
    print " Setting file exists ";
  } else {
    if (copy($source, $dest)) {
      print " File copied ";
    } else {
      print " File copy failed ";
    }
    
  }
} ?>

<p>language.yml</p>

<?php 
$source = 'config/language.yml';
$dest = '../../config/settings/language.yml';
if (file_exists($source)) {
  if (file_exists($dest)) {
    print " Language file exists ";
  } else {
    if (copy($source, $dest)) {
      print " File copied ";
    } else {
      print " File copy failed ";
    }
    
  }
} ?>


<p>filekinds.yml</p>

<?php 
$source = 'config/filekinds.yml';
$dest = '../../config/settings/filekinds.yml';
if (file_exists($source)) {
  if (file_exists($dest)) {
    print " File kinds file exists ";
  } else {
    if (copy($source, $dest)) {
      print " File copied ";
    } else {
      print " File copy failed ";
    }
    
  }
} ?>

<p>users.yml</p>

<?php 
$source = 'config/users.yml';
$dest = '../../config/users/users.yml';
if (file_exists($source)) {
  if (file_exists($dest)) {
    print " User file exists ";
  } else {
    if (copy($source, $dest)) {
      print " File copied ";
    } else {
      print " File copy failed ";
    }
    
  }
} ?>

<p>groups.yml</p>

<?php 
$source = 'config/groups.yml';
$dest = '../../config/users/groups.yml';
if (file_exists($source)) {
  if (file_exists($dest)) {
    print " Groups file exists ";
  } else {
    if (copy($source, $dest)) {
      print " File copied ";
    } else {
      print " File copy failed ";
    }
    
  }
} ?>

<p><a href="index.php?step=done">Done</a></p>