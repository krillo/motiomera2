<script type="text/javascript">
  $(function(){

    /*
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
*/
/*
  //refresh the stepdata
  function refreshData(){
    alert("bepa");
    //var user_id = $('#user-id').attr('value');
    //var user_id = <?php echo $user->id; ?>;
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
*/

    //get a gift
    //setTimeout(function(){$('#gift-area').html('<img src="/img/icons/cappuccino.jpg" alt="cappuccino" />');}, 1000);

    //check for gifts
    setTimeout(function(){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>game/gift/1",
        data: "",
        success: function(data){
          $('#gift-area').html(data).fadeIn();
        }
      });
      return false;
    }, 3000);



  });
</script>