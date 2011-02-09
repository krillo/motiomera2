<?php include 'include/v_header.php';?>



<div class="error">
  <?php echo validation_errors('<p class="error-msg">'); ?>
</div>
<div id="add-steps">

  

<!-- form onsubmit="motiomera_steg_addSteg(); return false;" id="motiomera_form_rapporteraSteg" name="stegRapport" method="post" action="/actions/save.php?table=steg&amp;id=" -->
  <?php echo form_open('step/store'); ?>
    <input type="text" name="steps" id="m-steps-count" value="<?php echo set_value('steps', ''); ?>" /> steg eller
    <a href="#" title="Välj en annan aktivitet" onclick="m_step_showActivities(); return false;" id="step-ActivityLink" style="">Annan aktivitet</a>
    <br/>
    <div id="activity-list" style="display:none;">
      <?php
      //print_r($activites_data);
      echo form_dropdown('activity', $activites_data, '1');
      ?>
    </div>



    <input type="submit" name="add" value="Lägg till" />
  <?php echo form_close(); ?>
</div>







Tjoho