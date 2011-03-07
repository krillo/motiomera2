<div id="debug-link">
  <a href="#" title="Debug"  onclick="m_debug(); return false;" >debug</a> &nbsp;&nbsp;
</div>
<div id="debug-msg">
  <a href="#" title="Close debug" onclick="m_close_debug(); return false;" >close debug</a>
  <br/>
  <pre>
    <?php
    //print_r($this);
    echo "\n";
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
    ?>
  </pre>
</div>
<br/>