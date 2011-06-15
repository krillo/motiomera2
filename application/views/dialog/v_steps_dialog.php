<script type="text/javascript">
  $(function(){
    
    //add the datepicker
    $("#datepicker").datepicker({
      firstDay: 1,
      monthNames: ['jan','feb','mar','apr','maj','jun','jul','aug','sep','okt','nov','dec'],
      dayNamesMin: [ 'sön', 'mån', 'tis', 'ons', 'tor', 'fre', 'lör'],
      altField: "#step-date",
      dateFormat: 'yy-mm-dd',
      minDate: new Date(2011, 1, 15),  //todo set register date
      maxDate: new Date(),
      onSelect: function(dateText, inst) {  //display steps matrix for selected date
        var user_id     = $('#user-id').attr('value');
        var date        = $('#step-date').attr('value');
        $.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>step/showStepsPreview",
          data: "user_id="+ user_id +"&date="+ date,
          success: function(data){
            $('#preview-step-list').html(data).fadeIn();
          }
        });
        return false;
      }
    });



    //on page load - load todays steps list (only first time)  
    var user_id = $('#user-id').attr('value');
    var date1 = $('#step-date').attr('value');
    $.ajax({
      type: "POST",
      url: "<?php echo base_url() ?>step/showStepsPreview",
      data: "user_id="+ user_id +"&date="+ date1,
      success: function(data){
        $('#preview-step-list').html(data).fadeIn();
      }
    });


    //show other actions dropdown
    $("#activity-link").click(function(event){
      event.preventDefault();
      $('#activity-list').fadeIn();
    });


    //get the activity serverities as a dropdown and display it
    $("#activity-list").change(function() {
      var activity_id = $('#activity-cat-id').attr('value');
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>activities/same/" + activity_id,
        success: function(data) {
          $('#step-severity').html(data).fadeIn();
        }
      });
      return false;
    });
    

    //submit steps to db
    $("form#submit-steps").submit(function() {
      //store the values from the form input box, then send via ajax below
      var user_id     = $('#user-id').attr('value');
      var count       = $('#count').attr('value');
      var date        = $('#step-date').attr('value');
      var activity_id = $('#activity_id').attr('value');
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>step/create",
        data: "user_id="+ user_id +"&count="+ count +"&date="+ date +"&activity_id="+ activity_id +"&view=showStepsPreview&status=VALID",
        success: function(data){
          $('#preview-step-list').html(data).fadeIn();
        }
      });
      return false;
    });



  });  //functions below please



  function deleteRow(rowId){
    //alert(rowId);
    var date = $('#step-date').attr('value');
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>step/delete/" + rowId +"/showStepsPreview/" + date,
        data: '',
        success: function(data){
          $('#preview-step-list').html(data).show();
        }
      });
      return false;
  }


  function addMessage(){
    var user_id = $('#user-id').attr('value');
    var date    = $('#step-date').attr('value');
    var msg     = $('#message').attr('value');
    var smiley  = $('input:radio:checked').attr('value');
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>message/usercreate",
        data: "user_id="+ user_id +"&date="+ date +"&message="+ msg +"&smiley="+ smiley,
        success: function(data){
          $('#preview-step-list').html(data).show();
        }
      });
      return false;
  }


  function updateMessage(message_id){
    var user_id = $('#user-id').attr('value');
    var msg     = $('#message').attr('value');
    var smiley  = $('input:radio:checked').attr('value');
    var date    = $('#step-date').attr('value');
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>message/updatebyid/" + message_id,
        data: "user_id="+ user_id +"&message="+ msg +"&smiley="+ smiley+"&date="+ date,
        success: function(data){
          $('#preview-step-list').html(data).show();
        }
      });
      return false;
  }


</script>

<div id="dialog" title="Rapportera steg" >
  <div id="datepicker" ></div>
  <div id="step-data-area">
    <form id="submit-steps" method="post">
      <input type="hidden" name="user-id" id="user-id" value="<?php echo $this->session->userdata('user_id'); ?>" />
      <input type="hidden" name="step-date" id="step-date" value="<?php echo date("Y-m-d"); ?>" />
      <input type="text"  name="count" id="count" value="<?php echo set_value('steps', ''); ?>" /> steg &nbsp;<a href="#" title="Annan aktivitet"  id="activity-link" style="">Annan aktivitet</a>
      &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  name="submit" id="submit" value="Lägg till" /><br/>
      <div id="activity-list" style="display:none;">
        <?php echo form_dropdown('activity_id', $activites_data, '1', 'id="activity-cat-id"'); ?>
      </div>
      <div id="step-severity" style="display:none;"></div>
    </form>
    <div id="preview-step-list" style="display:none;"></div>
  </div>
  <div id="success" style="display: none;">Steps has been added.</div>
</div>
<!--/div-->