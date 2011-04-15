<div class="toplist">
  <h3 class="toplist-head"><?php echo $toplist_title; ?></h3>
<ol class="toplist-ol">
  <?php
  if($toplist > 0){
    foreach ($toplist as $key => $row): ?>
  <li><a href="#" class="toplist-a"><?php echo $row->nick; ?></a><span class="toplist-steps"> <?php echo $row->tot_steps; ?></span></li>
    <?php endforeach;
  } else {
    echo 'Nothing to show';
  }
  ?>
</ol>
</div>

