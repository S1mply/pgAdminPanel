$(document).ready(function(){

    var labels = new Array();
    var visitors = new Array();
    var new_visitors = new Array();
    var denial = new Array();
    var visit_time = new Array();
    var depth = new Array();
    var phrases = new Array();
    var page_views = new Array();
    var url = new Array();
    var metrika_id = $('.project_id').html();

    $.ajax({
        url: "https://api-metrika.yandex.ru/stat/traffic/summary.json?id="+metrika_id+"&pretty=1&oauth_token=8e48da40c8b2432c9bdfc807742e49a5",
        type: "POST",
        dataType: "jsonp",
        beforeSend: function(){
            $('.box-body').after('<div class="overlay" id="overlay"> <i class="fa fa-refresh fa-spin"></i> </div>');
        },
        complete: function(){
            $('.overlay').remove();
        },
        success: function(msg){
            for(i = 0; i< msg.data.length; i++){
                var day =msg.data[i].date.slice(6,8);
                var month = msg.data[i].date.slice(4,6);
                var year = msg.data[i].date.slice(0,4);
                var date = day+"."+month+"."+year;
                labels[i] = date;
                visitors[i] = msg.data[i].visitors;
                new_visitors[i] = msg.data[i].new_visitors;
                denial[i] = (msg.data[i].denial * 100).toFixed(2);
                visit_time[i] = (Math.floor(msg.data[i].visit_time / 60) + '.' + msg.data[i].visit_time % 60);
                depth[i] = (msg.data[i].depth).toFixed(2);




            }
            $("#visitors").html(msg.totals.visitors);
            $("#new_visitors").html(msg.totals.new_visitors);
            $("#denial").html((msg.totals.denial * 100).toFixed(2)+" %");
            $("#visit_time").html((Math.floor(msg.totals.visit_time / 60) + ':' + msg.totals.visit_time % 60));
            $("#depth").html((msg.totals.depth).toFixed(2));
            chart(labels, visitors, new_visitors, denial, visit_time, depth,msg);

        }
    });


    $.ajax({
        url: "https://api-metrika.yandex.ru/stat/sources/phrases.json?id="+metrika_id+"&pretty=1&oauth_token=8e48da40c8b2432c9bdfc807742e49a5",
        type: "POST",
        dataType: "jsonp",
        success: function(msg){
            console.log(msg.data);
            for(i = 0; i< 10; i++){
                phrases = msg.data[i].phrase;
                visit = msg.data[i].visits;
                $('#phrases').append('<tr height="30"> <td><a href="http://google.by/?q='+phrases+'">'+phrases+'</a></td> <td>'+visit+'</td> </tr>');
            }
        }
    });

    $.ajax({
        url: "https://api-metrika.yandex.ru/stat/content/entrance.json?id="+metrika_id+"&pretty=1&oauth_token=8e48da40c8b2432c9bdfc807742e49a5",
        type: "POST",
        dataType: "jsonp",
        success: function(msg){
            console.log(msg.data);
            for(i = 0; i< 10; i++){
                page_views = msg.data[i].page_views;
                url = msg.data[i].url;
                $('#entrance').append('<tr height="30"> <td><a href="'+url+'">'+url+'</a></td> <td>'+page_views+'</td> </tr>');
            }
        }
    });


    function chart(labels, visitors, new_visitors, denial, visit_time, depth){

        function data(visitors, labels) {
            var ret = [];
            for (var x = 0; x < visitors.length; x ++) {
                ret.push({
                    x: visitors[x],
                    y: labels[x]
                });
            }
            return ret;
        }
        var graph = Morris.Line({
            element: 'line-chart',
            data: data(visitors, labels),
            xkey: 'y',
            ykeys: 'x',
            labels: ['Посетители'],
            parseTime: false,
            hideHover: true
        });
        var graph2 = Morris.Line({
            element: 'line-chart2',
            data: data(new_visitors, labels),
            xkey: 'y',
            ykeys: 'x',
            labels: ['Посетители'],
            parseTime: false,
            hideHover: true
        });

        var graph3 = Morris.Line({
            element: 'line-chart3',
            data: data(denial, labels),
            xkey: 'y',
            ykeys: 'x',
            labels: ['Посетители'],
            parseTime: false,
            hideHover: true
        });

        var graph4 = Morris.Line({
            element: 'line-chart4',
            data: data(visit_time, labels),
            xkey: 'y',
            ykeys: 'x',
            labels: ['Посетители'],
            parseTime: false,
            hideHover: true
        });

        var graph5 = Morris.Line({
            element: 'line-chart5',
            data: data(depth,  labels),
            xkey: 'y',
            ykeys: 'x',
            labels: ['Посетители'],
            parseTime: false,
            hideHover: true
        });






        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        /*var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            {
                value: 700,
                color: "#f56954",
                highlight: "#f56954",
                label: "Chrome"
            },
            {
                value: 500,
                color: "#00a65a",
                highlight: "#00a65a",
                label: "IE"
            },
            {
                value: 400,
                color: "#f39c12",
                highlight: "#f39c12",
                label: "FireFox"
            },
            {
                value: 600,
                color: "#00c0ef",
                highlight: "#00c0ef",
                label: "Safari"
            },
            {
                value: 300,
                color: "#3c8dbc",
                highlight: "#3c8dbc",
                label: "Opera"
            },
            {
                value: 100,
                color: "#d2d6de",
                highlight: "#d2d6de",
                label: "Navigator"
            }
        ];
        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: false,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);




        var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
        var pieChart2 = new Chart(pieChartCanvas2);
        pieChart2.Doughnut(PieData, pieOptions);

        var pieChartCanvas3 = $("#pieChart3").get(0).getContext("2d");
        var pieChart3 = new Chart(pieChartCanvas3);
        pieChart3.Doughnut(PieData, pieOptions);**/
    }





    $('#reservation').daterangepicker({
        "locale": {
            "separator": " - ",
            "applyLabel": "Принять",
            "cancelLabel": "Отмена",
            "fromLabel": "С",
            "toLabel": "По",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Вс",
                "Пн",
                "Вт",
                "Ср",
                "Чт",
                "Пт",
                "Сб"
            ],
            "monthNames": [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            "firstDay": 1
        }
    });

    var date = new Date();

    var today = date.setDate(date.getDate());
    var yesterday= date.setDate(date.getDate() - 1);
    var week= date.setDate(date.getDate() - 7);
    var month= date.setDate(date.getDate() - 31);
    var quarter= date.setDate(date.getDate() - 92);
    var year= date.setDate(date.getDate() - 365);

    function dates(data){
        days = new Date(data).getDate();
        if(days < 10){
            days = '0'+days;
        }
        month = new Date(data).getMonth();
        if(month< 10){
            month = '0'+month;
        }
        year = new Date(data).getFullYear();

        day  = year+''+month+''+days;
        return day;
    }


    function datas(date1, date2){
        $.ajax({
            url: "https://api-metrika.yandex.ru/stat/traffic/summary.json?id="+metrika_id+"&pretty=1&oauth_token=8e48da40c8b2432c9bdfc807742e49a5&date1="+date1+"&date2="+date2,
            type: "POST",
            dataType: "jsonp",
            beforeSend: function(){
                $('.box-body').after('<div class="overlay" id="overlay"> <i class="fa fa-refresh fa-spin"></i> </div>');
            },
            complete: function(){
                $('.overlay').remove();
            },
            success: function(msg){
                console.log(msg.data);
                for(i = 0; i< msg.data.length; i++){
                    var day =msg.data[i].date.slice(6,8);
                    var month = msg.data[i].date.slice(4,6);
                    var year = msg.data[i].date.slice(0,4);
                    var date = day+"."+month+"."+year;
                    labels[i] = date;
                    visitors[i] = msg.data[i].visitors;
                    new_visitors[i] = msg.data[i].new_visitors;
                    denial[i] = (msg.data[i].denial * 100).toFixed(2);
                    visit_time[i] = (Math.floor(msg.data[i].visit_time / 60) + '.' + msg.data[i].visit_time % 60);
                    depth[i] = (msg.data[i].depth).toFixed(2);





                }
                $("#denial").html((msg.totals.denial * 100).toFixed(2)+" %");
                $("#visit_time").html((Math.floor(msg.totals.visit_time / 60) + ':' + msg.totals.visit_time % 60));
                $("#depth").html((msg.totals.depth).toFixed(2));
                $("#visitors").html(msg.totals.visitors);
                $("#new_visitors").html(msg.totals.new_visitors);
                $('#line-chart').html('');
                $('#line-chart2').html('');
                $('#line-chart3').html('');
                $('#line-chart4').html('');
                $('#line-chart5').html('');
                chart(labels, visitors, new_visitors, denial, visit_time, depth);


            }
        });


        $.ajax({
            url: "https://api-metrika.yandex.ru/stat/sources/phrases.json?id="+metrika_id+"&pretty=1&oauth_token=8e48da40c8b2432c9bdfc807742e49a5&date1="+date1+"&date2="+date2,
            type: "POST",
            dataType: "jsonp",
            success: function(msg){
                console.log(msg.data);
                $('#phrases').html('');
                for(i = 0; i< 10; i++){
                    phrases = msg.data[i].phrase;
                    visit = msg.data[i].visits;
                    $('#phrases').append('<tr height="30"> <td><a href="http://google.by/?q='+phrases+'">'+phrases+'</a></td> <td>'+visit+'</td> </tr>');
                }
            }
        });

        $.ajax({
            url: "https://api-metrika.yandex.ru/stat/content/entrance.json?id="+metrika_id+"&pretty=1&oauth_token=8e48da40c8b2432c9bdfc807742e49a5&date1="+date1+"&date2="+date2,
            type: "POST",
            dataType: "jsonp",
            success: function(msg){
                console.log(msg.data);
                $('#entrance').html('');
                for(i = 0; i< 10; i++){
                    page_views = msg.data[i].page_views;
                    url = msg.data[i].url;
                    $('#entrance').append('<tr height="30"> <td><a href="'+url+'">'+url+'</a></td> <td>'+page_views+'</td> </tr>');
                }
            }
        });
    }


    $('#today').click(function(){
        var day = dates(today);
        var now = dates(today);
        datas(day,now);
    });
    $('#yesterday').click(function(){
        var day = dates(yesterday);
        var now = dates(today);
        datas(day,now);
    });
    $('#week').click(function(){
        var day = dates(week);
        var now = dates(today);
        datas(day,now);
    });
    $('#month').click(function(){
        var day = dates(month);
        var now = dates(today);
        datas(day,now);
    });
    $('#quarter').click(function(){
        var day = dates(quarter);
        var now = dates(today);
        datas(day,now);
    });
    $('#year').click(function(){
        var day = dates(year);
        var now = dates(today);
        datas(day,now);
    });

    $(".applyBtn").click(function(){
        var min = $('#input_mini').val();
        var max = $('#input_max').val();

        var day =min.slice(0,2);
        var month = min.slice(3,5);
        var year = min.slice(6,10);
        var min_date =year+month+day;

        var max_day =max.slice(0,2);
        var max_month =max.slice(3,5);
        var max_year = max.slice(6,10);
        var max_date =max_year+max_month+max_day;

        datas(min_date,max_date);
    });
});