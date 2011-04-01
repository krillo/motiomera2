<script>
  $(function() {
    var $tabs = $('#tabs').tabs();
    //$tabs.tabs('select', 1);
  });
</script>



<h2>Administrationssida för <?php echo $company[0]->name; ?></h2>
<p>
Så fort dina deltagare aktiverat sina MotioMera-konton kan du se dem under fliken <b>Deltagare</b> nedan.
Deltagarna blir automatiskt indelade i lag. Du kan ändra lagindelningen genom att klicka på fliken <b>Lag</b>.
Vill du anmäla fler deltagare till tävlingen gör du det under fliken <b>Tilläggsbeställning</b>.
</p>
<br/>
<h3>Viktiga datum</h3>
<table class="sortable sorted">
    <tr>
    <td class="mmList1"><?php echo $start; ?></td>
    <td class="mmList1">Måndag</td>
    <td class="mmList1">Startdatum för er företagstävling</td>
  </tr>
    <tr>
    <td class="mmList1"><?php echo $stop; ?></td>
    <td class="mmList1">Söndag</td>
    <td class="mmList1">Slutdatum för er företagstävling</td>
  </tr>
    <tr>
    <td class="mmList1"><?php echo $contest_dates['LAST_REG']; ?></td>
    <td class="mmList1">Måndag</td>
    <td class="mmList1">Sista dagen för registrering av steg</td>
  </tr>
    <tr>
    <td class="mmList1"><?php echo $contest_dates['SEND_RESULT_EMAIL']; ?></td>
    <td class="mmList1">Tisdag</td>
    <td class="mmList1">Tävlingsresultatet skickas per mail till alla deltagare</td>
  </tr>
    <tr>
    <td class="mmList1"><?php echo $contest_dates['LAST_ADMIN_DAY']; ?></td>
    <td class="mmList1">Söndag</td>
    <td class="mmList1">Administrationssidan är tillgänglig tom detta datum</td>
  </tr>
</table>
<br/>


<div class="">
<div id="tabs">
	<ul>
		<li><a href="<?php echo base_url() ?>admin/teams">Teams</a></li>
		<li><a href="<?php echo base_url() ?>admin/companysettings">Settings</a></li>
		<li><a href="<?php echo base_url() ?>admin/competitors">Competitors</a></li>
		<li><a href="<?php echo base_url() ?>admin/additionalorders">Additional orders</a></li>
		<li><a href="<?php echo base_url() ?>admin/keys">Keys</a></li>
		<li><a href="<?php echo base_url() ?>admin/reclamation">Reclamation</a></li>
		<li><a href="#tabs-3">Bla bla</a></li>
	</ul>
	<div id="tabs-3">
		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
	</div>
</div>
</div>
