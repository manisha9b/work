<html><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
  

  
  
  

  

 <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

  

  

  

  
  

  
    
<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.min.js"></script>
    
  
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/jquery.flot.resize.min.js"></script>
    
      <script type="text/javascript" src="https://cdn.rawgit.com/MichaelZinsmaier/CurvedLines/1.1.1/curvedLines.js"></script>
    
  

  <style type="text/css">
    #homechart {
    height: 300px;
}

  </style>

  <title></title>

  
    




<script type="text/javascript">//<![CDATA[
$(window).load(function(){
var d = [
    [2010, 10],
    [2011, 50],
    [2012, 100],
    [2013, 80],
    [2014, 51],
    [2015, 150],
    [2016, 330],
    [2017, ]
];
var d2 = [
    [2010, 20],
    [2011, 10],
    [2012, 100],
    [2013, 50],
    [2014, 80],
    [2015, 70],
    [2016, 40],
    [2017, ]
];
 var line_data2 = {
      data:  [["Jan", 110], ["Feb", 66.5], ["Mar", 150.5], ["Apr", 69.8], ["May", 71], ["June", 71.8]],
      color: "#bad0d2"
    };
    var line_data21 = {
      data:  [["Jan", 165], ["Feb", 180.5], ["Mar", 100.5], ["Apr", 169.8], ["May", 171], ["June", 171.8]],
      color: "#ccafaa"
    };
// points
var data1 = {
    data: d2,
    color: "#0086e5",
    points: {
        show: false
    },
    lines: {
        show: true
    },
    curvedLines: {
        apply: true,
        monotonicFit: true
    }
};

// curvedline
var data2 = {
    data: d,
    color: "#0086e5",
    lines: {
        show: true
    },
    points: {
        show: false
    },
    curvedLines: {
        apply: true,
        monotonicFit: true
    }
};

var options = {
    series: {
        curvedLines: {
            active: true
        }
    }
};

/*series: {
            lines: { show: true },
            points: { show: true },
            curvedLines: {active: true}         
        },*/

$.plot("#homechart", [data1, data2], {
    series: {
        curvedLines: {
            active: true
        },
		shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
    },
    xaxis: {
        mode: "categories",
        tickLength: 0
      },
    yaxis: {
        show: true,
    },
   grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3",
       
      },
});



});//]]> 

</script>

  
</head>

<body>
  <div id="homechart" style="padding: 0px; position: relative;"></div>

  
  <script>
  // tell the embed parent frame the height of the content
  if (window.parent && window.parent.parent){
    window.parent.parent.postMessage(["resultsFrame", {
      height: document.body.getBoundingClientRect().height,
      slug: "None"
    }], "*")
  }
</script>





</body></html>