<?php
  $key = 'key';
  $keys = 'keys';
?>

<script type="text/javascript">
  $(function(){
    $("#submit-keys").click(function(){
     var count = $('#add-keys').attr('value');
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/addkeys/<?php echo $contest_id?>/" + count,
        data: "",
        success: function(data){
          $('#key-list').html(data);
          //location.reload();
        }
      });
      return false;

    });
  });
</script>

<h3>Add keys to this current competition</h3>


<select id="add-keys">
  <option value="1">1 <?php echo $key; ?></option>
  <option value="2">2 <?php echo $keys; ?></option>
  <option value="3">3 <?php echo $keys; ?></option>
  <option value="4">4 <?php echo $keys; ?></option>
  <option value="5">5 <?php echo $keys; ?></option>
  <option value="6">6 <?php echo $keys; ?></option>
  <option value="7">7 <?php echo $keys; ?></option>
  <option value="8">8 <?php echo $keys; ?></option>
  <option value="9">9 <?php echo $keys; ?></option>
  <option value="10">10 <?php echo $keys; ?></option>
</select>
<button id="submit-keys" >Add</button>

<hr/>