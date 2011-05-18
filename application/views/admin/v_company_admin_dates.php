<script type="text/javascript">
  $(function(){

  });


  function updateStart(rowId){
      var name         = $('#name'+rowId).attr('value');
      var multiplicity = $('#multiplicity'+rowId).attr('value');
      var severity     = $('#severity'+rowId).attr('value');
      var unit         = $('#unit'+rowId).attr('value');
      var desc         = $('#desc'+rowId).attr('value');
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/updateactivity/",
        data: "activityid="+ rowId+ "&name="+ name +"&multiplicity="+ multiplicity +"&severity="+ severity +"&unit="+ unit +"&desc="+ desc,
        success: function(data){
          $('#activity-list').html(data);
        }
      });
      return false;
  }
</script>



<div style="height:300px;">
<h3>Important dates</h3>

<?php if($editable): ?>
  <form action="<?php echo base_url() ?>admin/companydatesupdate/<?php echo $contest['id']?>" method="post">
<?php endif; ?>
<table class="admin-table" style="border-bottom: solid 1px #A19B9E ;">
  <thead>
    <tr>
      <th>Info</th>
      <th>Veckodag</th>
      <th>Datum</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="">Startdatum för er företagstävling</td>
      <td class=""><?php echo $contest['start_weekday']; ?></td>
      <?php if($editable): ?>
        <td class=""><input type="text" value="<?php echo $contest['start']; ?>" style="width:75px;" name="start"></td>
        <!--td><button onclick="update('start');return false;">Save</button></td-->
      <?php else: ?>
        <td class=""><?php echo $contest['start']; ?></td>
      <?php endif; ?>
    </tr>
    <tr>
      <td class="">Slutdatum för er företagstävling</td>
      <td class=""><?php echo $contest['stop_weekday']; ?></td>
      <?php if($editable): ?>
        <td class=""><input type="text" value="<?php echo $contest['stop']; ?>" style="width:75px;" name="stop"></td>
        <!-- td><button onclick="update('start');return false;">Save</button></td -->
      <?php else: ?>
        <td class=""><?php echo $contest['stop']; ?></td>
      <?php endif; ?>
    </tr>
    <tr>
      <td class="">Sista dagen för registrering av steg</td>
      <td class=""><?php echo $contest_dates['LAST_REG_WEEKDAY']; ?></td>
      <td class=""><?php echo $contest_dates['LAST_REG']; ?></td>
    </tr>
    <tr>
      <td class="">Tävlingsresultatet skickas per mail till alla deltagare</td>
      <td class=""><?php echo $contest_dates['SEND_RESULT_EMAIL_WEEKDAY']; ?></td>
      <td class=""><?php echo $contest_dates['SEND_RESULT_EMAIL']; ?></td>
    </tr>
    <tr>
      <td class="">Administrationssidan är tillgänglig tom detta datum</td>
      <td class=""><?php echo $contest_dates['LAST_ADMIN_DAY_WEEKDAY']; ?></td>
      <td class=""><?php echo $contest_dates['LAST_ADMIN_DAY']; ?></td>
    </tr>
  </tbody>
</table>

<?php if($editable): ?>
  <input type="hidden" value="<?php echo $contest['id']; ?>" name="contest_id">
  <button onclick="updateRow('+rowId+');return false;">Save</button>
</form>
<?php endif; ?>
</div>