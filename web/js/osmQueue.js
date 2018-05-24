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
            alert(data);
            // process data
        }
    });
});