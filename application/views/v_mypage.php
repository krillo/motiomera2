<?php include 'include/v_header.php'; ?>


<h1>Min sida</h1>




<script type="text/javascript">
  $(function(){
    $("#btn-report-dialog").click(function(){
alert('krillo');
      $("#dialog").dialog({title: "Rapportera steg", height: 340, width: 750 });      
      $("#dialog").dialog();            
    });

  });
</script>



<button id="btn-report-dialog"><img src="/img/m_report_steps.gif" alt="Rapportera Steg"></button>

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