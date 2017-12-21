<html><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
  

  
  
  

  

  <script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.js"></script>

  

  

  

  
    <link rel="stylesheet" type="text/css" href="/css/result-light.css">
  

  
    
      <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.min.js"></script>
    
  
    
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
    [2010, 100],
    [2011, 33000],
    [2012, 10000000],
    [2013, 835000],
    [2014, 5100000],
    [2015, 15300000],
    [2016, 33400000],
    [2017, ]
];

// points
var data1 = {
    data: d,
    color: "#0086e5",
    points: {
        symbol: "circle",
        fillColor: "#ffffff",
        radius: 5
    },
    lines: {
        show: false
    },
    points: {
        show: true
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
        }
    },
    xaxis: {
        tickColor: '#def2ff',
        tickDecimals: 0,
		min: 2010,
        max: 2017
    },
    yaxis: {
        tickLength: 0,
        show: false
    },
    grid: {
        backgroundColor: {
            colors: ["#effaff", "#d7f3ff"]
        },
        borderWidth: 0
    }
});

var ticklabel = $('.tickLabel');
ticklabel.each(function(index, domElement) {
    var $element = $(domElement);

    if ($element.text() === "2010") {
        $element.hide();
    }

    if ($element.text() === "2017") {
        $element.hide();
    }
}, options);

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