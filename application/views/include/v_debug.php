<?php if($this->session->userdata('role_level') > SUPER_ADM_LEVEL): ?>

<script type="text/javascript">
  $(function(){

    $("#k-debug").click(function () {
      if($('#k-debug-msg').hasClass("hide")){
        $("#k-debug-msg").removeClass("hide");
        $("#k-debug").html('close debug');
      } else {
        $("#k-debug-msg").addClass("hide");
        $("#k-debug").html('debug');
      }
    });
  });
</script>

<div class="grid_2">
<button id="k-debug" style="margin-top: 5px;">debug</button>
<div id="k-debug-msg" class="hide">
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
<?php endif; ?>
</div>