/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $(document).on('click', '.fc-day', function () {
        var date = $(this).attr('data-date');
        $.get('index.php?r=event/create', {'date': date}, function (data) {
            $('.modal').modal('show')
                    .find('#modelContent')
                    .html(data);
        });
    });
    $('#createBtn').on('click', function (e) {
        var date = $(this).attr('data-date');
        $.get('index.php?r=event/create', {'date': date}, function (data) {
            $('.modal').modal('show')
                    .find('#modelContent')
                    .html(data);
        });
    });

    $(document).on('click', '.fc-content', function () {
        console.log($($(this).attr('data-date')));
//        var date = $(this).attr('data-date');
//        $.get('index.php?r=event/create', {'date': date}, function (data) {
//            $('.modal').modal('show')
//                    .find('#modelContent')
//                    .html(data);
//        });
    });


});