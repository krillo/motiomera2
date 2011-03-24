<script type="text/javascript">
  $(function(){

    //create a new activity and save to db
    $("#submit-activity").click(function() {
      var name         = $('#name').attr('value');
      var multiplicity = $('#multiplicity').attr('value');
      var severity     = $('#severity').attr('value');
      var unit         = $('#unit').attr('value');
      var desc         = $('#desc').attr('value');
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/create_activity",
        data: "name="+ name +"&multiplicity="+ multiplicity +"&severity="+ severity +"&unit="+ unit +"&desc="+ desc,
        success: function(data){
          $('#activity-list').html(data);
        }
      });
      return false;
    });










  });

  function deleteRow(rowId){
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/delete_activity/" + rowId,
        data: '',
        success: function(data){
          $('#activity-list').html(data);
        }
      });
      return false;
  }



  function editRow(rowId){
    var e_name         = $('#name29').attr('value');
 /*   var e_multiplicity = $('#multiplicity'+rowId).attr('value');
    var e_severity     = $('#severity'+rowId).attr('value');
    var e_unit         = $('#unit'+rowId).attr('value');
    var e_desc         = $('#desc'+rowId).attr('value');
 */
    alert(e_name);

    $('#edit-row').fadeIn();

  }

/*
         <tr>
        <td><input id="name" class="input-text" type="text"></td>
        <td><input id="multiplicity" class="input-text" type="text"></td>
        <td><input id="severity" class="input-text" type="text"></td>
        <td><input id="unit" class="input-text" type="text"></td>
        <td><input id="desc" class="input-text" type="text"></td>
        <td colspan="2"><button id="submit-activity">Save</button></td>
      </tr>
*/

/*
  function editRow(rowId){
    var e_name         = $('#name'+rowId).attr('value');
    var e_multiplicity = $('#multiplicity'+rowId).attr('value');
    var e_severity     = $('#severity'+rowId).attr('value');
    var e_unit         = $('#unit'+rowId).attr('value');
    var e_desc         = $('#desc'+rowId).attr('value');
    alert(e_name);

    $('#edit-row').fadeIn();

  }

*/

</script>

<div style="display:none;" id="edit-row">
         <tr>
        <td><input id="e_name" class="input-text" type="text"></td>
        <td><input id="e_multiplicity" class="input-text" type="text"></td>
        <td><input id="e_severity" class="input-text" type="text"></td>
        <td><input id="e_unit" class="input-text" type="text"></td>
        <td><input id="e_desc" class="input-text" type="text"></td>
        <td colspan="2"><button id="submit-activity">Save</button></td>
      </tr>

</div>

<div id="activity-list">
<h1>List Activites</h1>
<?php if ($records != null && $records != -1): ?>
  <table >
    <thead>
      <tr>
        <th>Name</th>
        <th>Multiplicity</th>
        <th>Severity</th>
        <th>Unit</th>
        <th>Description</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>

    <?php foreach ($records as $row): ?>
      <tr id="<?php echo $row->id; ?>">
        <td><span id="name<?php echo $row->id; ?>"><?php echo $row->name; ?></span></td>
        <td id="multiplicity<?php echo $row->id; ?>"><?php echo $row->multiplicity; ?> </td>
        <td id="severity<?php echo $row->id; ?>"><?php echo $row->severity; ?></td>
        <td id="unit<?php echo $row->id; ?>"><?php echo $row->unit; ?> </td>
        <td id="desc<?php echo $row->id; ?>"><?php echo $row->desc; ?> </td>
        <td><a href="" onclick="editRow(<?php echo $row->id; ?>);return false;"><span class="ui-icon ui-icon-pencil"></span></a></td>
        <td><a href="" onclick="deleteRow(<?php echo $row->id; ?>);return false;"><span class="ui-icon ui-icon-trash"></span></a></td>
      </tr>
    <?php endforeach; ?>
      <tr>
        <td><input type="text" id="name" class="input-text"></td>
        <td><input type="text" id="multiplicity" class="input-text"></td>
        <td><input type="text" id="severity" class="input-text"></td>
        <td><input type="text" id="unit" class="input-text"></td>
        <td><input type="text" id="desc" class="input-text"></td>
        <td colspan="2"><button id="submit-activity">Save</button></td>
      </tr>
    </tbody>
  </table>
<?php else: ?>
  <p>No Results found</p>
<?php endif; ?>
</div>






