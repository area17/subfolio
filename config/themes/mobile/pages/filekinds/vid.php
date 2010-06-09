<EMBED 
  src='<?php echo Subfolio::current_file('url') ?>' 
  autoplay=<?php echo Subfolio::current_file('autoplay') ?>
  pluginspage='http://public.apple.com/quicktime/' 
  width='100%' 
  height='auto'
  scale='noscale' 
  controller='true'>
</EMBED>
This uses EMBED tag and Subfolio default src : php echo Subfolio::current_file('url') to output <?php echo Subfolio::current_file('url') ?>. It's broken.

<EMBED 
  src='http://dev.subfolio.com/kittie.mp4' 
  autoplay=<?php echo Subfolio::current_file('autoplay') ?>
  pluginspage='http://public.apple.com/quicktime/' 
  width='100%' 
  height='auto'
  scale='noscale' 
  controller='true'>
</EMBED>
Same parameters except the video is located at http://dev.subfolio.com/kittie.mp4, outside of Subfolio 'directory' folder. Click on the play icon to launch the video.

<video width="100%" height="auto" controls autoplay>
	<!-- MP4 must be first for iPad! -->
	<source src="http://dev.subfolio.com/kittie.mp4"  type="video/mp4"  /><!-- WebKit video    -->
</video>
The video above uses the html5 VIDEO tag and is located at http://dev.subfolio.com/kittie.mp4, outside of Subfolio 'directory' folder. Its width is 100% and height is set on 'auto'. Click on the play icon to launch the video.






<?php require("_download_box.php"); ?>