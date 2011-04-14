<div id="key-data">
<?php $count = count($free_keys); ?>

<h2>Nycklar som inte har använts ännu (<?php echo $count; ?> st):</h2>
<p id="key-list">
  <?php
  if($count > 0){
    foreach ($free_keys as $key => $row){
      echo $row . '<br>';
    }
  } else {
    echo 'Inga lediga nycklar.';
  }
  ?>
</p>
</div>