<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Activities</title>
</head>
<body>

<h1>Activities</h1>


<!--pre>
< ?php print_r($records);?>
</pre -->



<table>
    <tr>
      <th>id</th>
      <th>name</th>
      <th>multiplicity</th>
      <th>severity</th>
      <th>unit</th>
      <th>created_at</th>
      <th>updated_at</th>
      <th></th>
      <th></th>
    </tr>
  <?php foreach($records as $row):?>
    <tr>
      <td><?php echo $row->id;?></td>
      <td><?php echo $row->name;?></td>
      <td><?php echo $row->multiplicity;?></td>
      <td><?php echo $row->severity;?></td>
      <td><?php echo $row->unit;?></td>
      <td><?php echo $row->created_at;?></td>
      <td><?php echo $row->updated_at;?></td>
      <td><?php echo anchor('activities/edit/'.$row->id, 'editera', 'title="update"');?></td>
      <td><?php echo anchor('activities/delete/'.$row->id, 'ta bort', 'title="delete"');?></td>
    </tr>
  <?php endforeach;?>

  <?php echo form_open('activities/create'); ?>
    <tr>
      <td></td>
      <td><input type="text" name="name" value="<?php echo set_value('name', ''); ?>" /></td>
      <td><input type="text" name="multiplicity" value="<?php echo set_value('multiplicity', ''); ?>" /></td>
      <td><input type="text" name="severity" value="<?php echo set_value('severity', ''); ?>" /></td>
      <td><input type="text" name="unit" value="<?php echo set_value('unit', ''); ?>" /></td>
      <td></td>
      <td></td>
      <td><input type="submit" name="add" value="Lägg till" /></td>
    </tr>
  <?php echo form_close(); ?>
</table>
<div class="error">
  <?php echo validation_errors('<p class="error-msg">'); ?>
</div>

</body>
</html>

