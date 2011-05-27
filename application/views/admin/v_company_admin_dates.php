
<div style="height:300px;">
<h3>Important dates</h3>

Your competition lasts for <?php echo $contest['nof_weeks']; ?> weeks.
<br/>
<br/>


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
      <td class="" id="start-weekday"><?php echo $contest['start_weekday']; ?></td>
      <?php if($editable): ?>
        <td class=""><input type="text" value="<?php echo $contest['start']; ?>" style="width:75px;" name="start" id="start"></td>
        <!--td><button onclick="update('start');return false;">Save</button></td-->
      <?php else: ?>
        <td class=""><?php echo $contest['start']; ?></td>
      <?php endif; ?>
    </tr>
    <tr>
      <td class="">Slutdatum för er företagstävling</td>
      <td class="" id=""stop-weekday><?php echo $contest['stop_weekday']; ?></td>
      <?php if($editable): ?>
        <td class=""><input type="text" value="<?php echo $contest['stop']; ?>" style="width:75px;" name="stop"></td>
        <!-- td><button onclick="update('start');return false;">Save</button></td -->
      <?php else: ?>
        <td class=""><?php echo $contest['stop']; ?></td>
      <?php endif; ?>
    </tr>
    <tr>
      <td class="">Sista dagen för registrering av steg</td>
      <td class="" id="last-reg-weekday"><?php echo $contest_dates['LAST_REG_WEEKDAY']; ?></td>
      <td class="" id="last-reg"><?php echo $contest_dates['LAST_REG']; ?></td>
    </tr>
    <tr>
      <td class="">Tävlingsresultatet skickas per mail till alla deltagare</td>
      <td class="" id="send-result-email-weekday"><?php echo $contest_dates['SEND_RESULT_EMAIL_WEEKDAY']; ?></td>
      <td class="" id="send-result-email"><?php echo $contest_dates['SEND_RESULT_EMAIL']; ?></td>
    </tr>
    <tr>
      <td class="">Administrationssidan är tillgänglig tom detta datum</td>
      <td class="" id="last-admin-day-weekday"><?php echo $contest_dates['LAST_ADMIN_DAY_WEEKDAY']; ?></td>
      <td class="" id="last-admin-day"><?php echo $contest_dates['LAST_ADMIN_DAY']; ?></td>
    </tr>
  </tbody>
</table>

<?php if($editable): ?>
  <br/>
  <input type="hidden" value="<?php echo $contest['id']; ?>" name="contest_id">
  <input type="submit" value="Save" name="save">
</form>
<?php endif; ?>
</div>