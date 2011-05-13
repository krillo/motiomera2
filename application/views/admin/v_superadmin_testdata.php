<script type="text/javascript">
  $(function(){

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
<button id="deploy-testdata" >Deploy initial testdata</button>
<button id="more-stepdata" >Add stepdata till today</button>
<br/>
<br/>
<div id="testdata-msg"></div>
