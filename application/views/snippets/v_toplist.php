<script type="text/javascript">
  $(function(){
    $('#<?php echo $unique_id . $this->session->userdata('user_id') ?>').addClass("selected");
 });
</script>


<div class="grid_3" style="padding-top: 10px;">
  <div class="toplist">
    <h3 class="toplist-head"><?php echo $toplist_title; ?></h3>
    <ol class="toplist-ol">
      <?php
      if ($toplist > 0) {
        foreach ($toplist as $key => $row): ?>
      <li id="<?php echo $unique_id . $row->user_id; ?>"><span class="toplist-nbr"><?php echo $key+1 . '.'; ?></span><a href="#" class="toplist-a"><?php echo $row->nick; ?></a><span class="toplist-steps"> <?php echo $row->tot_steps; ?></span></li>
      <?php
          endforeach;
        } else {
          echo 'Nothing to show';
        }
      ?>
    </ol>
  </div>
</div>

