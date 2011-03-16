<!-- ?php include 'include/v_header.php'; ? -->

<script type="text/javascript">
  $(function(){
    //report steps dialog
    $("#btn-report-dialog").click(function(){
      $("#dialog").dialog({title: "Rapportera steg", height: 340, width: 750 });
      $("#dialog").dialog();
    });

    //get a gift
    //setTimeout(function(){$('#gift-area').html('<img src="/img/icons/cappuccino.jpg" alt="cappuccino" />');}, 1000);



    //check for gifts
    setTimeout(function(){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>game/gift/1",
        data: "",
        success: function(data){
          $('#gift-area2').html(data).fadeIn();
        }
      });
      return false;
    }, 3000);


  });
</script>


<img src="/img/googlemaps.png" alt="googlemaps">
<div class="clear"></div>

<button id="btn-report-dialog"><img src="/img/m_report_steps.gif" alt="Rapportera Steg"></button>
<div class="clear"></div>

<div style="margin:25px 0  0 350px;" id="gift-area">Blah blah blah</div>
<div class="clear"></div>

<div style="margin:25px 0  0 50px;" id="gift-area2"> TOTALT <br/>101 195 steg <br/>5 060 kcal
</div>