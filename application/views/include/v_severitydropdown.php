<?php
  //print_r($severity_data);
  if(!empty($severity_data)){
    echo form_dropdown('activity_id', $severity_data, '1', 'id="activity_id"');
  }
?>