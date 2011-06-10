<script type="text/javascript">
  $(function(){

    function test(){
      alert("bepa");
    }

    //refresh the stepdata
    function refreshData(){
      alert("cepa");
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>user/refreshstepdata/<?php echo $user->id; ?>",
        data: '',
        success: function(data){
          $('#step-data').html(data).show();
        }
      });
      return false;
    }


    //open report steps dialog on click
    //when dialog closes update stuff..
    $("#btn-report-dialog").click(function(){
      $("#dialog").dialog({
          title: "Rapportera steg",
          height: 340,
          width: 750,
          close: function() {alert("apa"); test(); refreshData(); }
        });
    });



  });
</script>


<div class="grid_3">
  <button id="btn-report-dialog"><img src="/img/m_report_steps.gif" alt="Rapportera Steg"></button>
</div>