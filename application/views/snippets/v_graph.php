<?php
  $steps = '[';
  foreach ($graph as $key => $value) {
    $steps .= '[' . $key . ',' . $value->steps_day . '], ';
  }
  $steps .= ']';

  $ticks = '[';
  foreach ($graph as $key => $value) {
    $ticks .= '[' . $key . ', "' . $value->weekday . '"], ';
  }
  $ticks .= ']';

  $averages = '[';
  foreach ($average as $key => $value) {
    $averages .= '[' . $key . '.3, "' . $value->average . '"], ';
  }
  $averages .= ']';
?>


  <div class="grid_6">
      <div id="placeholder" style="width:600px;height:300px"></div>
         <!-- p><input id="enableTooltip" type="checkbox">Enable tooltip</p -->


      <script language="javascript" type="text/javascript" src="<?php echo base_url() ?>js/jquery.flot.js"></script>
      <script type="text/javascript">
        $(function () {
          var steps = <?php echo $steps; ?>; //[[1, 7500], [2, 8000], [3, 5600], [4, 14000], [5, 9040], [6, 11500], [7, 13000],];
          var average = <?php echo $averages; ?>;//[[1.3, 8100], [2.3, 8500], [3.3, 9200], [4.3, 8700], [5.3, 8000], [6.3, 7500], [7.3, 9400]];

          var plot =  $.plot($("#placeholder"),
            [
              {label: "<?php echo $label_steps; ?>", data: steps, bars: { show: true, barWidth: 0.6 }, color: "rgba(0, 173, 223, 0.7)"},
              {label: "<?php echo $label_average; ?>", data: average, lines: { show: true }, points: { show: true }, color: "#306EFF"}
            ],
            {
              xaxis: {ticks:
                      <?php echo $ticks; ?> //[[1, "mon"], [2, "tue"], [3, "wed"], [4, "thu"], [5, "fri"], [6, "sat"], [7, "sun"]]
                     },
              grid: {hoverable: true, clickable: true, markings: [ 
                                                        { xaxis: { from: 0, to: 1000 },
                                                          yaxis: { from: 7000, to: 11000 }, color: "#CCCCCC" },
                                                        { xaxis: { from: 0, to: 1000 },
                                                          yaxis: { from: 11000, to: 99000 }, color: "rgba(251, 185, 23, 0.4)" } ]}
            });



        function showTooltip(x, y, contents) {
          $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#fee',
            opacity: 0.80
          }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#placeholder").bind("plothover", function (event, pos, item) {
          $("#x").text(pos.x.toFixed(2));
          $("#y").text(pos.y.toFixed(2));

          //if ($("#enableTooltip:checked").length > 0) {
            if (item) {
              if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;

                $("#tooltip").remove();
                var x = item.datapoint[0].toFixed(2),
                y = item.datapoint[1];//.toFixed(2);

                showTooltip(item.pageX, item.pageY, y);
              }
            /*}
            else {
              $("#tooltip").remove();
              previousPoint = null;
            }
            */
          }
        });

        $("#placeholder").bind("plotclick", function (event, pos, item) {
          if (item) {
            $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
            plot.highlight(item.series, item.datapoint);
          }
        });





                      });
      </script>  
  </div>