/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#showBtn').on('click', function (e) {
    var childData = $("ul.select2-selection__rendered li.select2-selection__choice");
    var values = "";
    for (i = 0; i < childData.length; i++)
    {
        values += childData[i].title + "|";
    }

    var res = values.split("|");
    res.pop();

    $.ajax({
        url: '?r=nossa/ajaxapplsess',
        type: 'POST',
        data: {
            data: res,
            start: $('#startParam').val(),
            end: $('#endParam').val()
        },
        success: function (data) {
            console.log(data);
            var data = $.parseJSON(data);
            var chartdata = {
                labels: data["labelData"],
                datasets: data["allPackets"]
            };
            var ctx = $("#nossaSessionApplCrx");
            ctx.empty();
            
            var barGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                    legend: {
                        display: false,
                        position: 'left'
                    }
                }
            });

            

        }
    });
});