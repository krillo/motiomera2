<script type="text/javascript">

    //initial search when the page is loaded
    $(document).ready(function () {
        var dataString = '';
        $.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>admin/findusers/-1",
          data: dataString,
          cache: false,
          beforeSend: function(html) {
            document.getElementById("insert_search").innerHTML = '';
            $("#flash").html('<img src="img/ajax-loader.gif" align="absmiddle">&nbsp;Loading Results...');
          },
          success: function(html){
            $("#insert_search").show();
            $("#insert_search").append(html);
            $("#flash").hide();
          }
        });
    });


  //do the ajax user search
  $(function() {
    $("#search_box").keyup(function() {
      var search_word = $("#search_box").val();
      var dataString = 'search='+ search_word;

      if(search_word==''){
      } else{
        $.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>admin/findusers/" + search_word,
          data: dataString,
          cache: false,
          beforeSend: function(html) {
            document.getElementById("insert_search").innerHTML = '';
            $("#flash").show();
            $("#searchword").show();
            $(".searchword").html(search_word);
            $("#flash").html('<img src="img/ajax-loader.gif" align="absmiddle">&nbsp;Loading Results...');
          },
          success: function(html){
            $("#insert_search").show();
            $("#insert_search").append(html);
            $("#flash").hide();
          }
        });
      }
      return false;
    });
  });
</script>

<h2>Users</h2>
<div>
  <div style="width:920px">
    <div style="margin-top:20px; text-align:left">
      <form method="get" action="">
        <input type="text" name="search" id="search_box" class='search_box'/>
      </form>
    </div>
    <div>
      <div id="searchword">Search results for <span class="searchword"></span></div>
      <div id="flash"></div>
      <br/>
      <br/>
      <span id="insert_search"></span>
    </div>
  </div>
</div>
<div style="margin-bottom:20px;"></div>