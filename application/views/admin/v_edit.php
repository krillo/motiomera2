<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <?php $controller = $this->form_validation->CI->router->class; ?>


	<title>Edit <?php echo $controller ?></title>
</head>
<body>

<!-- pre>
  < ?php print_r($records);?>
</pre -->


<h1>Edit <?php echo $controller ?></h1>

<?php $filter = array('id', 'created_at', 'updated_at'); ?>
<?php echo form_open("$controller/update/".$this->uri->segment(3)); ?>
 <?php foreach($records as $row):?>
  <?php foreach($row as $key => $value):?>
      <div class="field">
        <?php if(in_array($key, $filter)): ?>
          <?php echo $key . ' ' . $value;?>
        <?php else: ?>
          <label for="<?php echo $key;?>_id"><?php echo $key;?></label><br />
          <input id="<?php echo $key;?>_id" name="<?php echo $key;?>" size="30" type="text" value="<?php echo $value;?>" />
        <?php endif;?>
      </div>
  <?php endforeach;?>
<?php endforeach;?>
<input type="submit" name="update" value="Spara" />
<?php echo form_close(); ?>



</body>
</html>


