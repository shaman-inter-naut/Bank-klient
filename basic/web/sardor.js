$(".contracts").click(function(e){

    e.preventDefault();
    $("#modal").modal('show')
        .find('#modalContent')
        .load($(this).attr("href"));

});

$(".bank").click(function(e){

    e.preventDefault();
    $("#modal").modal('show')
        .find('#modalContent')
        .load($(this).attr("href"));

});

$(".bankview").click(function(e){

    e.preventDefault();
    $("#modal").modal('show')
        .find('#modalContent')
        .load($(this).attr("href"));

});

$(".kor").click(function(e){

    e.preventDefault();
    $("#modal").modal('show')
        .find('#modalContent')
        .load($(this).attr("href"));

});

//
// $(".login").click(function(e){
//
//     e.preventDefault();
//     $("#modal").modal('show')
//         .find('#modalContent')
//         .load($(this).attr("href"));
//
// });
