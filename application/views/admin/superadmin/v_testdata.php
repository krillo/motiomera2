<script type="text/javascript">
  $(function(){


    $("#regenerate-settings").click(function(){
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/regeneratesettings/",
        data: '',
        success: function(data){
          $('#testdata-msg').show().html(data);
        }
      });
      return false;
    });

    $("#deploy-testdata").click(function(){
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/deploytestdata/",
        data: '',
        success: function(data){
          $('#testdata-msg').show().html(data);
        }
      });
      return false;
    });

    $("#more-stepdata").click(function(){
     $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>admin/morestepdata/",
        data: '',
        success: function(data){
          $('#testdata-msg').show().html(data);
        }
      });
      return false;
    });


  });
</script>

<p>Use this testdata feature only for development</p>
<button id="regenerate-settings" >Regenerate WL-settings file</button>
<button id="deploy-testdata" >Deploy initial testdata</button>
<button id="more-stepdata" >Add stepdata till today</button>



<br/>
<br/>
<div id="testdata-msg"></div>
