<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="<?php echo base_url()?>css/style.css" rel="stylesheet" type="text/css" media="screen" />
  <script type="text/javascript" src="<?php echo base_url(); ?>js/step.js"></script>



<?php $controller = $this->form_validation->CI->router->class; ?>

	<title>List <?php echo $controller ?></title>
</head>
<body>

<pre>
  <!--?php
    //print_r($records);
    print_r($this->form_validation->CI->router->class);
    echo "\n";
    print_r($this->form_validation->CI->router->method);
    echo "\n";
    print_r($this->uri->uri_string);
    echo "\n";
    echo "krillo \n";
    echo "\n";
    print_r($this);
  ?-->
</pre>





<h1>List <?php echo $controller ?></h1>

<?php $filter = array('id', 'created_at', 'updated_at'); ?>
<?php echo form_open("$controller/create"); ?>
<table>
  <tr>
   <?php $row = $records[0]; ?>
   <?php foreach($row as $key => $value):?>
     <th><?php echo $key;?></th>
   <?php endforeach;?>
     <th></th>
     <th></th>
  </tr>
 <?php foreach($records as $row):?>
   <tr>
   <?php foreach($row as $key => $value):?>
      <td><?php echo $value;?></td>
  <?php endforeach;?>
    <td><?php echo anchor("$controller/edit/$row->id", 'editera', 'title="update"');?></td>
    <td><?php echo anchor("$controller/delete/$row->id", 'ta bort', 'title="delete"');?></td>
  </tr>
 <?php endforeach;?>

  <tr>
   <?php $row = $records[0]; ?>
   <?php foreach($row as $key => $value):?>
     <?php if(!in_array($key, $filter)): ?>
        <td><input type="text" class="input-text" name="<?php echo $key;?>" value="<?php echo set_value($key, ''); ?>" /></td>
     <?php else: ?>
        <td> - </td>
     <?php endif; ?>     
   <?php endforeach;?>
     <td><input type="submit" name="add" value="Lägg till" /></td>
     <td></td>
  </tr>
</table>
<?php echo form_close(); ?>


 

</body>
</html>


