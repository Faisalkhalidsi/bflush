/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#showBtn').on('click', function (e) {
    var startParam = $('#startParam').val();
    var endParam = $('#endParam').val();
    $.ajax({
        url: '?r=nossf-osm/ajaxchart',
        type: 'POST',
        data: {
            start: startParam,
            end: endParam
        },
        success: function (data) {
            if (data.length == 23) {
                alert("Empty Data..!");
            } else {
                var data = $.parseJSON(data);
                var chartdata = {
                    labels: data["waktu"],
                    datasets: [
                        {
                            label: 'Queue Total',
                            backgroundColor: 'rgba(0,0,255,0)',
                            borderColor: 'rgba(0,0,255,0.5)',
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            pointBackgroundColor: 'rgba(255,99,132,1)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgba(255,99,132,1)',
                            data: data["queue"]
                        }
                    ],
                };
                var ctx = $("#osmQueueCrx");
                var barGraph = new Chart(ctx, {
                    type: 'line',
                    data: chartdata,
                    options: {
                        legend: {
                            display: true,
                            position: 'left'
                        }
                    }


                });
            }
        }
    });
});