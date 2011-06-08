<?php if ($records != null && $records != -1): ?>
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Administrator</th>
        <th>Email</th>
        <th>WL-Name</th>
        <th>Settings</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>

    <?php
    foreach ($records as $row):
      if($search_word != -1){
        $bold_word = '<b>' . $search_word . '</b>';
        $row->id = str_ireplace($search_word, $bold_word, $row->id);
        $row->name = str_ireplace($search_word, $bold_word, $row->name);
      }
    ?>
      <tr>
        <td> <?php echo $row->id; ?></td>
        <td><a href="/admin/administercompany/<?php echo $row->id; ?>"> <?php echo $row->name; ?> </a></td>
        <td> <?php echo $row->user_name; ?></td>
        <td> <?php echo $row->email; ?></td>
        <td> <?php echo $row->wl_name; ?></td>
        <td><a href="/admin/restorecompanysettings/<?php echo $row->id; ?>">restore settings</a></td>
        <td> <?php echo $row->created_at; ?></td>
        <td> <?php echo $row->updated_at; ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No Results found</p>
<?php endif; ?>
