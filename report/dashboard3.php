<div class="row">
    <div class="col s12">
      <ul class="tabs"><li class="tab col s4"><a href="#daily_summary">SUMMARY</a></li><li class="tab col s4"><a href="#daily_register">DAILY REGISTER</a></li><li class="tab col s4"><a href="#customer_balance">CUSTOMER BALANCE</a></li></ul></div><div class="col s12" id="daily_summary"><div class="row" ><div class="col s12 m6"><div class="card">
            <div class="card-content">
              <span class="card-title black-text">Sales</span>
              <div id="sales"></div>
            </div>
            <div class="card-action">
              <a href="#"></a>
              <a href="#"></a>            </div>
          </div>
  </div><div class="col s12 m6"><div class="card">
            <div class="card-content">
              <span class="card-title black-text">Daily Register</span>
              <div id="register"></div>
            </div>
            <div class="card-action">
              <a href="#"></a>
              <a href="#"></a>            </div>
          </div>
  </div><div class="col s12 m6"><div class="card">
            <div class="card-content">
              <span class="card-title black-text">Customer Balance</span>
              <div id="balance"></div>
            </div>
            <div class="card-action">
              <a href="#"></a>
              <a href="#"></a>            </div>
          </div>
  </div>
  <div class="col s12 m6"><div class="card">
            <div class="card-content">
              <span class="card-title black-text">Aged Receivables</span>
              <div id="receivable"></div>
            </div>
            <div class="card-action">
              <a href="#"></a>
              <a href="#"></a>            </div>
          </div>
  </div>
  </div></div>
  <?php require_once "daily_register.php" ?>
  <?php require_once "customer_balance.php" ?>
  </div>
 <script type="text/javascript"> var ar=$('ul.tabs').find('a');
 						var ids=new Array;
 						$.each(ar,function(i,v)
						{
							ids.push($(v).attr('href'));
							$(v).click(function()
							{
								var tr=ids.join(",");
								$(''+tr).hide();
								pr=$(this).attr('href');
								$(''+pr).show();
							})
						})
 
 </script>
    <script type="text/javascript">
	
	var jsonData=new Array();
	var mData =[['getDashboard.php?sales=1','sales','Sales in 30 Days','line','dual-y',"Sales Revenue","Number Sold"],['getDashboard.php?register=1','register','Transactions Today','column','dual-y',"Transaction Amount","Number of Transaction"],['getDashboard.php?balance=1','balance','Total Customer Balance','pie',''],['getDashboard.php?receivable=1','receivable','Aged Invoices','pie','']]
      // Load the Visualization API and the piechart package.
     google.charts.load('current', {packages: ['corechart']});


      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
	  
	  for(i=0;i<mData.length;i++)
	  {
	   		jsonData[i] = $.ajax({
          url: mData[i][0],
          dataType:"json",
          async: false
          }).responseText;
		
        // Create the data table.
        var data = new google.visualization.DataTable(jsonData[i]);
     
        // Set chart options
        var options = {'title':mData[i][2],
                       'width':$('#'+mData[i][2]).width(),
                       'height':300,
					   'animation':{'duration': 1000,'easing': 'out','startup':true},
					   'titleTextStyle': {color: 'black', fontSize: 12},
					   'hAxis':{textStyle: {color: 'black'}},
					   'vAxis':{textStyle: {color: 'black'}},
					   'legend':{'position':'right', textStyle: {color: 'black', fontSize: 14}}
					   };
					   
		if(mData[i][4]=='stacked')
		{
			options.legend= { position: 'top', maxLines: 3 };
			options.bar = { groupWidth: '75%' };
        	options.isStacked= true;
			
		}else if(mData[i][4]=='piehole')
		{
			options.pieHole= 0.4;
		}else if(mData[i][4]=='dual-y')
		{
			options.series= { 0: {targetAxisIndex: 0},
          1: {targetAxisIndex: 1}

						};
			options.vAxes={0: {title: mData[i][5]},
          1: {title: mData[i][6]}
            } 

		}
        // Instantiate and draw our chart, passing in some options.
        if(mData[i][3]=="column")
			var chart = new google.visualization.ColumnChart(document.getElementById(mData[i][1]));
		else if (mData[i][3]=="pie")
			var chart = new google.visualization.PieChart(document.getElementById(mData[i][1]));
		else if (mData[i][3]=="line")
			var chart = new google.visualization.LineChart(document.getElementById(mData[i][1]));
        chart.draw(data, options);
		}
      }
	 
    </script>