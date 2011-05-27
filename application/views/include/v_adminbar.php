<?php
  $role_level = $this->session->userdata('role_level');
  if ($role_level > 40): ?>

  <div id="adminbar">
    <ul style="float:left;">
      <li><a href="/start">Motiomera</a></li>
      <li><a href="/admin/companyadmin">Admin</a></li>
    <?php
      echo $role_level > 50? '<li><a href="/admin/support">Support</a></li>': '';
      echo $role_level > 70? '<li><a href="/admin/advsettings">Avancerade inställningar</a></li>': '';
      echo $role_level > 90? '<li><a href="/admin/superadmin">Superadmin</a></li> ': '';
      echo $this->session->userdata('simulation') == TRUE ? '<li><a href="/admin/stopsimulate">Stop simulation</a></li>': '';
    ?>
  </ul>
</div>
<div class="clear"></div>
<?php endif; ?>
