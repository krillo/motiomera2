<div id="settings">
<h1>Settings</h1>
<form action="<?php echo base_url() ?>admin/company_settingsupdate/<?php echo $company_id; ?>" method="post">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Description</th>
        <th>Value</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach ($records as $row): ?>
      <tr>
        <td><?php echo $row->descr; ?></td>
        <?php if($row->type == 'radio'): ?>
          <td>
            <input type="radio" value="1" name="<?php echo $row->key; ?>" <?php echo $row->value == 1 ? 'checked' : ''; ?> >on 
            <input type="radio" value="0" name="<?php echo $row->key; ?>" <?php echo $row->value == 0 ? 'checked' : ''; ?> >off
          </td>
        <?php else: ?>
          <td><input type="<?php echo $row->type; ?>" value="<?php echo $row->value; ?>" style="width:75px;" name="<?php echo $row->key; ?>" id="<?php echo $row->key; ?>"></td>
        <?php endif; ?>

      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <br/>
  <input type="submit" value="Save" name="save">
</form>

</div>