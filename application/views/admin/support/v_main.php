<script>
  $(function() {
    var $tabs = $('#tabs').tabs();
    $tabs.tabs('select', <?php echo $tab; ?>);
  });
</script>

<div class="grid_12">
<div id="tabs">
	<ul>
		<li><a href="#settings">General</a></li>
		<li><a href="<?php echo base_url() ?>admin/users">Users</a></li>
		<li><a href="<?php echo base_url() ?>admin/companys">Companys</a></li>
		<li><a href="<?php echo base_url() ?>admin/supportlegacy">Legacy</a></li>
		<li><a href="#tabs-3">Bla bla</a></li>
	</ul>
	<div id="settings">
		<p>Allmänna inställningar</p>
	</div>
	<div id="tabs-3">
		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
	</div>
</div>
</div>