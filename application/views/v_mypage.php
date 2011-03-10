<?php include 'include/v_header.php'; ?>


<h1>Min sida</h1>




<script type="text/javascript">
  $(function(){
    $("#btn-report-dialog").click(function(){
      $("#dialog").dialog({title: "Rapportera steg", height: 340, width: 750 });      
      $("#dialog").dialog();            
    });

  });
</script>



<button id="btn-report-dialog"><img src="/img/m_report_steps.gif" alt="Rapportera Steg"></button>

