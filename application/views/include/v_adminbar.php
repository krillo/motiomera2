<?php 
  $role_level = $this->session->userdata('role_level');
  if ($role_level > 40): ?>

  <div id="adminbar">
    <ul style="float:left;">
      <li >Motiomera</li>
      <li >Admin</li>
    <?php
      echo $role_level > 50? '<li>Support</li>': '';
      echo $role_level > 70? '<li>Avancerade inställningar</li>': '';
      echo $role_level > 90? '<li>Superadmin</li> <li>Debug</li>': '';
    ?>
  </ul>
</div>
<div class="clear"></div>
<?php endif; ?>
