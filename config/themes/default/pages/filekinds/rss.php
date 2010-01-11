<?php
  $filename = Subfolio::current_file('filename');
  $url      = Subfolio::current_file('feedurl');
  $count    = Subfolio::current_file('count');
  $cache    = Subfolio::current_file('cache');

  $items = SubfolioFiles::fetch_rss($url, $count, $filename, $cache);
?>  
<ul class="rss">
<?php foreach ($items as $item): ?>
  <li class="standard_paragraph item">
    <h4><?php echo $item['title'] ?></h4>
    <p><?php echo $item['description'] ?></p>
    <p><a href="<?php echo $item['link'] ?>">Read more</a></p>
  </li>
<?php endforeach ?>
</ul>
