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
</div>
<div class="clear"></div>
<?php endif; ?>


<div id="footer" class="grid_12">
			<div id="" style="float: right;">
				<a href="#" onclick="motiomera_rapportera(); return false;">Uppmärksamma oss på denna sida</a>
			</div>
			<a href="#" onclick="motiomera_kontakt(); return false;">Kontakta oss</a>  
      |  <a target="_blank" href="http://www.integritetspolicy.se/#cookies" rel="external">Om Cookies</a>
      |  <a target="_blank" href="http://www.integritetspolicy.se" rel="external">Integritetspolicy</a>
      |  <a target="_blank" href="http://aller.se/om-aller-media/" rel="external">Om Aller media</a>  <br />
      © Copyright Aller media 2008 - <?php echo date('Y'); ?>
		</div>
	<div class="clear"></div>

  
  </div>  <!-- end container_12 -->
</body>
</html>