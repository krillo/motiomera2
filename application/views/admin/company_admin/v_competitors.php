Här kan du se vilka deltagare som har registrerat sig på sajten med den kod de fått i sina stegräknarpaket. Du kan också välja att avregistrera en deltagare från tävlingen. Företagsnyckeln frigörs då och kan användas av någon annan om så önskas.

<br/>
<br/>

<?php
  $simulation = $settings['ALLOW_SIMULATION']->value;
  $total_keys = $competition_data['total_keys'];
  $total_used_keys = $competition_data['total_used_keys'];
  $users_no_team = $competition_data['total_users_no_team'];

  $msg = '%s of %s competitors have registered sofar.';
  printf($msg, $total_used_keys, $total_keys);


  if($users_no_team > 0){
    echo '<br/>';
    $msg = '<span style="color:red;">Notice! %s competitors are not yet in any team. </span>';
    printf($msg, $users_no_team);
  }
?>

<?php echo $simulation;  ?>

<br/>
<br/>
<?php if ($competitors != null && $competitors != -1): ?>
  <table class="admin-table">
    <thead>
      <tr>
        <th></th>
        <th>Nick name</th>
        <th>Name</th>
        <?php if($simulation): ?>
          <th>Simulate</th>
        <?php endif;?>
        <th>Team</th>
        <th>Key</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>

    <?php
    foreach ($competitors as $row):
      if($row->team_id != null){
        $team = $teams[$row->team_id];
      } else {
        $team = '<span style="color:red;">No team</span>';
      }
    ?>
      <tr>
        <td> <img src="/img/avatars/<?php echo $row->avatar_filename; ?>" class="avatar-mini"> </td>
        <td> <?php echo $row->nick ?></td>
        <td><a href="/profile/index/<?php echo $row->user_id ?>" ><?php echo $row->f_name. ' ' .$row->l_name?></a></td>
        <?php if($simulation): ?>
          <td><a href="/admin/simulate/<?php echo $row->user_id ?>" >Simulate</a></td>
        <?php endif;?>
        <td> <?php echo $team ?></td>
        <td> <?php echo $row->key ?> </td>
        <td> Avreg från tävling </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No Results found</p>
<?php endif; ?>