<?php
if ($records != null):
  $defaultActivityId = $this->m_activities->getDefaultActivityId();
?>
<?php foreach ($records as $row): ?>

    <tr>
      <td class="step-table-cell"><?php echo $row->date; ?></td>
      <td class="step-table-cell-big capitalize"><?php echo $row->activity_id == $defaultActivityId ? $row->name : $row->name . ' (' . $row->severity . ')'; ?></td>
      <td class="step-table-cell"><?php echo $row->activity_id == $defaultActivityId ? '' : $row->count . ' ' . $row->unit; ?></td>
      <td class="step-table-cell-small"><?php echo $row->steps; ?></td>
      <td class="step-table-cell-small">steg</td>
      <td class="step-table-cell"><button id="delete-step-row<?php echo $row->step_id; ?>" onclick="deleteRow(<?php echo $row->step_id; ?>)" >Ta bort</button></td>
    </tr>
<?php endforeach; ?>
<?php endif; ?>