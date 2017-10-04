$("document").ready(function(){
	var cetScoresLevel = getScoresLevel();  
	$(".chartingCetScores").click(function(){//绘制图表
		var CSContainer = document.getElementById('chart-cetScores');
		var forCSContainer = document.getElementById('cetTab');
		var resizeCSContainer = function () {
			CSContainer.style.width = forCSContainer.clientWidth+'px';
			CSContainer.style.height = forCSContainer.clientHeight+'px';
		};
		resizeCSContainer();
		var myChart = echarts.init(CSContainer);
		var option = {
					title : {
					text: '四六级成绩区段',
					subtext: '2017上半年度\n@暨妹妹 | @南同学',
					x:'center'
					},
					tooltip : {
					trigger: 'item',
					formatter: "{a} <br/>{b} : {c} ({d}%)"
					},
					legend: {
					show : false,
					orient : 'vertical',
					x : 'left',
					data:['学神(610 - 710)','学霸(550 - 610)','学民(425 - 550)','学弱(350 - 425)','学渣(  0 - 350)']
					},
					toolbox: {
					show : true,
					feature : {
						mark : {show: true},
						dataView : {show: false, readOnly: false},
						magicType : {
							show: true, 
							type: ['pie', 'funnel'],
							option: {
								funnel: {
									x: '25%',
									width: '50%',
									funnelAlign: 'left',
									max: 1548
								}
							}
						},
						restore : {show: true},
						saveAsImage : {show: true}
					}
					},
					calculable : true,
					series : [
					{
						name:'成绩段',
						type:'pie',
						radius : '55%',
						center: ['50%', '60%'],
						data:[
							{value:cetScoresLevel[0], name:'学神\n(610-710)'},
							{value:cetScoresLevel[1], name:'学霸\n(550 - 610)'},
							{value:cetScoresLevel[2], name:'学民\n(425 - 550)'},
							{value:cetScoresLevel[3], name:'学弱\n(350 - 425)'},
							{value:cetScoresLevel[4], name:'学渣\n(  0 - 350)'}
						]
					}
					]
				};
		
		myChart.setOption(option);
		window.onresize = function () {
			//重置容器高宽
			resizeCSContainer();
			myChart.resize();
		};
	});

});
