<div id="settings">
<h1>Settings</h1>
<form action="<?php echo base_url() ?>admin/settingsupdate/" method="post">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Description</th>
        <th>Value</th>
        <th>System default</th>
      </tr>
    </thead>
    <tbody>

    <?php
    foreach ($records as $row):
    ?>
      <tr>
        <td><?php echo $row->descr; ?></td>
        <td><input type="text" value="<?php echo $row->value; ?>" style="width:75px;" name="<?php echo $row->key; ?>" id="<?php echo $row->key; ?>"></td>
        <td><?php echo $row->default_value; ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <br/>
  <input type="submit" value="Save" name="save">
</form>

</div>