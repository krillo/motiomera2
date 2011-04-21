<script type="text/javascript">
  $(function(){
    //open report steps dialog on click
    //when dialog closes update stuff..
    $("#btn-report-dialog").click(function(){
      $("#dialog").dialog({
          title: "Rapportera steg",
          height: 340,
          width: 750,
          close: function() {refreshData();}
        });
    });


  });
</script>


<div class="grid_3">
  <button id="btn-report-dialog"><img src="/img/m_report_steps.gif" alt="Rapportera Steg"></button>
</div>