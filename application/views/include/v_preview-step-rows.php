
<?php
if ($records != null):
  $defaultActivityId = $this->m_activities->getDefaultActivityId();
?>

  <!--div id="preview-step-list" style="display:none;" -->
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
    <tbody id="preview-step-rows">
    <?php foreach ($records as $row): ?>
      <tr>
        <td class="step-table-cell"><?php echo $row->date; ?></td>
        <td class="step-table-cell-big capitalize"><?php echo $row->activity_id == $defaultActivityId ? $row->name : $row->name . ' (' . $row->severity . ')'; ?></td>
        <td class="step-table-cell"><?php echo $row->activity_id == $defaultActivityId ? '' : $row->count . ' ' . $row->unit; ?></td>
        <td class="step-table-cell-small"><?php echo $row->steps; ?></td>
        <td class="step-table-cell-small">steps</td>
        <td class="step-table-cell"><button id="delete-step-row<?php echo $row->step_id; ?>" onclick="deleteRow(<?php echo $row->step_id; ?>)" >Remove</button></td>
      </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
  </table>
  <!-- /div -->

  <div style="border:#999 solid 1px;padding:10px;height:80px;">
    <div>Comment <?php echo $date; ?></div><div class="clear"></div>
    <div>
      <textarea id="message" name="message"  rows="2" cols="50"><?php echo $message->message ?></textarea>
    </div>
    <div style="float:left;width:285px;">
      <img src="/img/smileys.png" alt=""/>
      <input type="radio" id="smiley1" name="smiley" value="1" style="margin-right:35px; margin-left:16px;" <?php echo $message->smiley == 1 ? 'checked': ''; ?>  />
      <input type="radio" id="smiley2" name="smiley" value="2" style="margin-right:35px;" <?php echo $message->smiley == 2 ? 'checked': ''; ?> />
      <input type="radio" id="smiley3" name="smiley" value="3" style="margin-right:40px;" <?php echo $message->smiley == 3 ? 'checked': ''; ?>/>
      <input type="radio" id="smiley4" name="smiley" value="4" style="margin-right:35px;" <?php echo $message->smiley == 4 ? 'checked': ''; ?>/>
      <input type="radio" id="smiley5" name="smiley" value="5" style="margin-right:0px;"  <?php echo $message->smiley == 5 ? 'checked': ''; ?>/>
    </div>
    <div style="float:left;">
      <?php if($message->id != -1): ?>
        <button id="update-message" onclick="updateMessage(<?php echo $message->id; ?>);" >Update</button>
      <?php else: ?>
        <button id="submit-message" onclick="addMessage();" >Add</button>
      <?php endif; ?>
    </div>
    
  </div>
