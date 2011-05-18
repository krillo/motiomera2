<script type="text/javascript">
  $(function(){

  });

 
  function addRow(rowId){
      var name         = $('#name'+rowId).attr('value');
      var multiplicity = $('#multiplicity'+rowId).attr('value');
      var severity     = $('#severity'+rowId).attr('value');
      var unit         = $('#unit'+rowId).attr('value');
      var desc         = $('#desc'+rowId).attr('value');
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/createactivity",
        data: "name="+ name +"&multiplicity="+ multiplicity +"&severity="+ severity +"&unit="+ unit +"&desc="+ desc,
        success: function(data){
          $('#activity-list').html(data);
        }
      });
      return false;
  }



  function deleteRow(rowId){
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/deleteactivity/" + rowId,
        data: '',
        success: function(data){
          $('#activity-list').html(data);
        }
      });
      return false;
  }


  function editRow(rowId){
    var e_name         = $('#name'+rowId).html();
    var e_multiplicity = $('#multiplicity'+rowId).html();
    var e_severity     = $('#severity'+rowId).html();
    var e_unit         = $('#unit'+rowId).html();
    var e_desc         = $('#desc'+rowId).html();
    $('#tr'+rowId).replaceWith('<tr id="tr0" >'+
                                 '<td><input id="name'+rowId+'" class="input-text" type="text" value=""></td>'+
                                 '<td><input id="multiplicity'+rowId+'" class="input-text" type="text" value=""></td>'+
                                 '<td><input id="severity'+rowId+'" class="input-text" type="text" value=""></td>'+
                                 '<td><input id="unit'+rowId+'" class="input-text" type="text" value=""></td>'+
                                 '<td><input id="desc'+rowId+'" class="input-text" type="text" value=""></td>'+
                                 '<td colspan="2"><button onclick="updateRow('+rowId+');return false;">Save</button></td>'+
                               '</tr>');
    $('#name'+rowId).val(e_name);
    $('#multiplicity'+rowId).val(e_multiplicity);
    $('#severity'+rowId).val(e_severity);
    $('#unit'+rowId).val(e_unit);
    $('#desc'+rowId).val(e_desc);
    $('.manipulation').replaceWith('');
    $('#newrow').replaceWith('');
  }



 function updateRow(rowId){
      var name         = $('#name'+rowId).attr('value');
      var multiplicity = $('#multiplicity'+rowId).attr('value');
      var severity     = $('#severity'+rowId).attr('value');
      var unit         = $('#unit'+rowId).attr('value');
      var desc         = $('#desc'+rowId).attr('value');
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/updateactivity/",
        data: "activityid="+ rowId+ "&name="+ name +"&multiplicity="+ multiplicity +"&severity="+ severity +"&unit="+ unit +"&desc="+ desc,
        success: function(data){
          $('#activity-list').html(data);
        }
      });
      return false;
  }




</script>



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
      <tr id="tr<?php echo $row->id; ?>">
        <td><span id="name<?php echo $row->id; ?>"><?php echo $row->name; ?></span></td>
        <td id="multiplicity<?php echo $row->id; ?>"><?php echo $row->multiplicity; ?> </td>
        <td id="severity<?php echo $row->id; ?>"><?php echo $row->severity; ?></td>
        <td id="unit<?php echo $row->id; ?>"><?php echo $row->unit; ?> </td>
        <td id="desc<?php echo $row->id; ?>"><?php echo $row->desc; ?> </td>
        <td><a href="" onclick="editRow(<?php echo $row->id; ?>);return false;" class="manipulation"><span class="ui-icon ui-icon-pencil"></span></a></td>
        <td><a href="" onclick="deleteRow(<?php echo $row->id; ?>);return false;" class="manipulation"><span class="ui-icon ui-icon-trash"></span></a></td>
      </tr>
    <?php endforeach; ?>
      <tr id="newrow">
        <td><input type="text" id="name-new" class="input-text" value=""></td>
        <td><input type="text" id="multiplicity-new" class="input-text" value=""></td>
        <td><input type="text" id="severity-new" class="input-text" value=""></td>
        <td><input type="text" id="unit-new" class="input-text" value=""></td>
        <td><input type="text" id="desc-new" class="input-text" value=""></td>
        <td colspan="2"><button id="submit-activity" onclick="addRow('-new');return false;">Save</button></td>
      </tr>
    </tbody>
  </table>
<?php else: ?>
  <p>No Results found</p>
<?php endif; ?>
</div>






