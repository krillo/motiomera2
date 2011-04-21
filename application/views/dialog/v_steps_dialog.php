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
            $('#preview-step-list').fadeIn();
            $('#preview-step-rows').html(data).fadeIn();
          }
        });
        return false;
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
          $('#preview-step-list').fadeIn();
          $('#preview-step-rows').html(data).fadeIn();
        }
      });
      return false;
    });


  });

  function deleteRow(rowId){
    //alert(rowId);
    var date = $('#step-date').attr('value');
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>step/delete/" + rowId +"/showStepsPreview/" + date,
        data: '',
        success: function(data){
          $('#preview-step-list').show();
          $('#preview-step-rows').html(data).show();
        }
      });
      return false;
  }
</script>
<style type="text/css">
  .blue { color: blue; }
  ul {list-style-type: none}
  /* img {padding-right: 20px; float:left} */
  #datepicker{ font-size:13px;float:left;width:250px;}


  #infolist {width:500px}
  #dialog{display: none;}
  #step-severity{display: none;}
  #preview-step-list{margin-top: 20px;}
  .step-table-cell{width:120px;}
  .step-table-cell-big{width:220px;}
  .step-table-cell-small{width:40px;}
  table td, table th {text-align:left;vertical-align:top;}
  #preview-step-rows{color:#999;}
  #activity-link{color:#1C94C4;}

</style>





<div id="dialog" title="Rapportera steg" >
  <div id="datepicker" ></div>

  <div id="">
    <form id="submit-steps" method="post">
      <input type="hidden" name="user-id" id="user-id" value="<?php echo $this->session->userdata('user_id'); ?>" />
      <input type="hidden" name="step-date" id="step-date" value="" />
      <input type="text"  name="count" id="count" value="<?php echo set_value('steps', ''); ?>" /> steg &nbsp;<a href="#" title="Annan aktivitet"  id="activity-link" style="">Annan aktivitet</a>
      &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  name="submit" id="submit" value="Lägg till" /><br/>

      <div id="activity-list" style="display:none;">
        <?php echo form_dropdown('activity_id', $activites_data, '1', 'id="activity-cat-id"'); ?>
      </div>
      <div id="step-severity" style="display:none;"></div>
    </form>
      <div id="preview-step-list" style="display:none;">
        <table style="display: block;" id="motiomera_steg_preview_header" class="motiomera_steg_preview_table" border="0" cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th class="step-table-cell">Datum</th>
              <th class="step-table-cell-big">Aktivitet</th>
              <th class="step-table-cell">Tid</th>
              <th colspan="2">Antal</th>
              <th class="step-table-cell"></th>
            </tr>
          </thead>
          <tbody id="preview-step-rows"></tbody>
        </table>
      </div>

  </div>

  <div id="success" style="display: none;">Steps has been added.</div>


</div>



</div>







