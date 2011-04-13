<script>
  $(function() {
    var $tabs = $('#tabs').tabs();
    //$tabs.tabs('select', 1);
  });
</script>

<div class="">
<div id="tabs">
	<ul>
		<li><a href="#settings">General</a></li>
		<li><a href="<?php echo base_url() ?>admin/testdata/">Testdata</a></li>
    <li><a href="<?php echo base_url() ?>admin/supportlegacy">Legacy</a></li>
		<li><a href="#tabs-3">bla bla</a></li>
	</ul>
	<div id="settings">
    <h2>Super admin page</h2>
		<p>Allmänna inställningar</a>
	</div>
	<div id="tabs-3">
		<p>ksksdlkdö Use this  feature only for development</p>

	</div>
</div>

</div>