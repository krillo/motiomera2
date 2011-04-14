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
      echo $role_level > 90? '<li><a href="/admin/superadmin">Superadmin</a></li><li><a href="#" title="Debug"  onclick="m_debug(); return false;" >Debug</a></li>   ': '';
      echo $this->session->userdata('simulation') == TRUE ? '<li><a href="/admin/stopsimulate">Stop simulation</a></li>': '';
    ?>
  </ul>
</div>
<div class="clear"></div>
<?php endif; ?>

<?php if ($role_level > 90): ?>
<div id="debug-link">
  <!--a href="#" title="Debug"  onclick="m_debug(); return false;" >debug</a-->
</div>
<div id="debug-msg">
  <a href="#" title="Close debug" onclick="m_close_debug(); return false;" >close debug</a>
  <br/>
  <pre>
    <?php
    echo 'Controller: ';
    print_r($this->form_validation->CI->router->class);
    echo "\n";
    echo 'Method: ';
    print_r($this->form_validation->CI->router->method);
    echo "\n";
    echo 'Uri: ';
    print_r($this->uri->uri_string);
    echo "\n";
    print_r($this->_ci_cached_vars);
    print_r($this->session->userdata);
    echo "\n";
    echo 'Benchmark: ';
    print_r($this->benchmark);
    echo "\n";
    echo 'SQLs: ';
    print_r($this->db->queries);
    echo 'SQL Execution time: ';
    print_r($this->db->query_times);
    echo "\n";
    echo 'Segments: ';
    print_r($this->uri->rsegments);

    //echo "\n";
    //print_r($this);
    ?>
  </pre>
</div>
<br/>
<?php endif; ?>



<!-- ?php include 'v_debug.php'; ? -->