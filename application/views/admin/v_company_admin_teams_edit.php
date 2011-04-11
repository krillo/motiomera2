<script type="text/javascript">
  $(function(){

  });

  function renameteam(teamId){
    var name = $('#new-team-name').attr('value');
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/renameteam/" + teamId +'/'+ name,
        data: '',
        success: function(data){
          $('#edit-team').html(data);
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

<div id="">

<img src="/img/team_avatars/<?php echo $team[0]->img_filename; ?>"  alt="" style="float:left; margin-right: 10px;"><h1 style="float:left;"><?php echo $team[0]->name; ?></h1>
<div class="clear"></div>
<p>


<label for="new-team-name">Rename team</label>
<input name="new-team-name" id="new-team-name" value="<?php echo $team[0]->name; ?>" type="text">
<button onclick="renameteam(<?php echo $team[0]->id; ?>);return false;">ok</button>
<div class="clear"></div>

<button >choose new image</button> or
<div class="clear"></div>
<button >upload an image</button>
<p>Vid uppladdning av egna lagbilder måste bilderna vara av format jpg, png, gif och av storlek 50x50 pixlar.</p>
<br/>
<button onclick="deleteteam(<?php echo $team[0]->id; ?>, <?php echo $team[0]->contest_id; ?>);return false;">delete team</button>


<h2>Medlemmar</h2>
<?php if ($users != null && $users != -1): ?>
  <table class="user-table">
    <thead>
      <tr>
        <th>username</th>
        <th>name</th>
        <th>Remove from team</th>
      </tr>
    </thead>
    <tbody>

    <?php
    foreach ($users as $user):
    ?>
      <tr>
        <td> <?php echo $user->nick; ?></td>
        <td> <?php echo $user->f_name . ' ' . $user->l_name; ?></td>
        <td><a href="" onclick="deleteRow(<?php echo $user->user_id; ?>);return false;" class="manipulation"><span class="ui-icon ui-icon-trash"></span></a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No Results found</p>
<?php endif; ?>


</div>
<hr/>
<br/>
<br/>