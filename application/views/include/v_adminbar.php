<?php 
  $role_level = $this->session->userdata('role_level');
  if ($role_level > 40): ?>

  <div id="adminbar">
    <ul style="float:left;">
      <li><a href="/start">Motiomera</a></li>
      <li><a href="/admin/companyadmin">Admin</a></li>
    <?php
      echo $role_level > 50? '<li><a href="/admin/support">Support</a></li>': '';
      echo $role_level > 70? '<li><a href="/admin/settings">Avancerade inställningar</a></li>': '';
      echo $role_level > 90? '<li><button id="superadmin">Superadmin</button></li>': '';
      include $role_level > 90? 'v_debug.php' : 'v_empty.php';
    ?>
  </ul>
</div>
<div class="clear"></div>
<?php endif; ?>


<!-- ?php include 'v_debug.php'; ? -->