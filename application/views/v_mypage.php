<?php include 'include/v_header.php'; ?>


<h1>Min sida</h1>




<script type="text/javascript">
  $(function(){
    $("#btn_report_dialog").click(function(){
      $("#dialog").dialog({title: "Rapportera steg", height: 300, width: 650 });
      $("#dialog").dialog();
    });

  });
</script>



<button id="btn_report_dialog"><img src="/img/m_report_steps.gif" alt="Rapportera Steg"></button>

<br/>
<br/>
<div style="clear:both;"></div>
<div>




<ul>
  <li><a href="/activities/steps">Rapportera DINA STEG</a></li>
  <li>-- </li>
  <li><a href="/admin">Admin</a></li>
</ul>
</div>