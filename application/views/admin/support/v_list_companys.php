<script type="text/javascript">
  $(function() {


    //initial search when the page is loaded
    $(document).ready(function () {
        var dataString = '';
        $.ajax({                         
          type: "POST",
          url: "<?php echo base_url() ?>admin/findcompanys/-1",
          data: dataString,
          cache: false,
          beforeSend: function(html) {
            document.getElementById("insert-search-c").innerHTML = '';
            $("#flash-c").html('<img src="img/ajax-loader.gif" align="absmiddle">&nbsp;Loading Results...');
          },
          success: function(html){  
            $("#insert-search-c").show();
            $("#insert-search-c").append(html);
            $("#flash-c").hide();
          }
        });
    });



    //do the search
    $("#search-box-c").keyup(function() {
      var search_word = $("#search-box-c").val();
      var dataString = 'search='+ search_word;

      if(search_word==''){
      } else{
        $.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>admin/findcompanys/" + search_word,
          data: dataString,
          cache: false,
          beforeSend: function(html) {
            document.getElementById("insert-search-c").innerHTML = '';
            $("#flash").show();
            $("#searchword").show();
            $(".searchword").html(search_word);
            $("#flash-c").html('<img src="img/ajax-loader.gif" align="absmiddle">&nbsp;Loading Results...');
          },
          success: function(html){
            $("#insert-search-c").show();
            $("#insert-search-c").append(html);
            $("#flash-c").hide();
          }
        });
      }
      return false;
    });

  });
</script>

<h2>Companys</h2>
<div>
  <div style="width:920px">
    <div style="margin-top:20px; text-align:left">
      <form method="get" action="">
        <input type="text" name="search" id="search-box-c" class='search-box-c'/>
      </form>
    </div>
    <div>
      <div id="searchword">Search results for <span class="searchword"></span></div>
      <div id="flash-c"></div>
      <br/>
      <br/>
      <span id="insert-search-c"></span>
    </div>
  </div>
</div>
<div style="margin-bottom:20px;"></div>