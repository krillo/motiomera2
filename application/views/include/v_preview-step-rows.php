<?php if($records != null):  ?>
  <?php foreach($records as $row):?>
    <?php echo form_open("step/delete/".$row->id); ?>
    <tr>
      <th class="step-table-cell"><?php echo $row->date; ?></th>
      <th class="step-table-cell capitalize"><?php echo $row->name; ?></th>
      <th class="step-table-cell"><?php echo $row->name == 'steg' ? '' : $row->count . ' ' . $row->unit; ?></th>
      <th class="step-table-cell"><?php echo $row->steps; ?> steg</th>
      <td class=""><button id="delete-step-row">Ta bort</button></td>
    </tr>
    <?php echo form_close(); ?>
  <?php endforeach;?>
<?php endif;?>
