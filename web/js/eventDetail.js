/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#showBtn').on('click', function (e) {
    var startDate = $('#startParam').val();
    var endDate = $('#endParam').val();

    $.get('index.php?r=event/ajaxeventdetail', {'startDate': startDate,'endDate': endDate}, function (data) {
        $('#detailList').html(data);
    });
});

$('.activity-view-link').click(function () {
    var id = $(this).closest('tr').data('key');
    $.get('index.php?r=event/view', {'id': id}, function (data) {
        $('.modal').modal('show')
                .find('#modelContent')
                .html(data);
    });
});


