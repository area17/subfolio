<?php
  $filename = $rss['filename'];
  $url      = $rss['feedurl'];
  $count    = $rss['count'];
  $cache    = $rss['cache'];

  $items = SubfolioFiles::fetch_rss($url, $count, $filename, $cache);
?>  
<div class="rss">
<?php foreach ($items as $item): ?>
  <div class="item">
    <h2><a href="<?php echo $item['link'] ?>"><?php echo $item['title'] ?></a</h2>
    <p><?php echo $item['description'] ?></p>
  </div>
<?php endforeach ?>
</div>
