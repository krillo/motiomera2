<script type="text/javascript">
  $(function(){

  });


  function editRow(teamId){
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/teamedit/" + teamId,
        data: '',
        success: function(data){
          $('#teams').show();
          $('#edit-team').show().html(data);

        }
      });
      return false;
  }


  function deleteteam(teamId, contestId){
    var x=window.confirm("Are you sure you want to delete the team?");
    if (x){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/teamdelete/" + teamId  +'/'+ contestId,
        data: '',
        success: function(data){
          $('#edit-team').hide();
          $('#teams').html(data);
        }
      });
    }
    return false;
  }

</script>

<div id="edit-team"></div>

<div id="teams">

För att göra det enkelt för dig delar MotioMeras system automatiskt in deltagarna i lag. Men om du istället helt själv vill bestämma hur lagen ska se ut är det möjligt.
Nedan kan du ta bort eller lägga till deltagare i lagen och du kan också skapa helt nya lag.
Du kan också byta namn på lagen och lägga till egna lagsymboler om du vill.
<br/>
<br/>

<?php
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

<br/>
<br/>
<?php if ($teams != null && $teams != -1): ?>
  <table class="admin-table" style="border-bottom: solid 1px #A19B9E ;">
    <thead>
      <tr>
        <th></th>
        <th>Team</th>
        <th>Members</th>
        <th>Edit</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($teams as $team):
    ?>
      <tr>
        <td> <img src="/img/team_avatars/<?php echo $team->img_filename; ?>" class="avatar-mini"> </td>
        <td> <?php echo $team->name; ?></td>
        <td> <?php echo $team->nof_users; ?></td>
        <td><a href="" onclick="editRow(<?php echo $team->id; ?>);return false;" class="manipulation"><span class="ui-icon ui-icon-pencil"></span></a></td>
        <td><a href="" onclick="deleteteam(<?php echo $team->id . ', '. $team->contest_id; ?>);return false;" class="manipulation"><span class="ui-icon ui-icon-trash"></span></a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No Results found</p>
<?php endif; ?>

<br/>
<button class="button-space">Create a new team</button>
<div class="clear"></div>
<button class="button-space">Remove all teams</button>
<div class="clear"></div>
<button class="button-space">Make new random teams</button>

</div>