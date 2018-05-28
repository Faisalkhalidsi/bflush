/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#showBtn').on('click', function (e) {
    var date = $('#timeParam').val()
    $.get('index.php?r=nossf-osm/ajaxorderqueue', {'date': date}, function (data) {
        $('#queueList').html(data);
    });
});