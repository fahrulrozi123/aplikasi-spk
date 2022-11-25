$('.reserveNow').click(function(){
    // console.log("Hello");

    var formReserve = $('#formReserve');
    // console.log(formReserve.css('display'));
    if(formReserve.css('display') == 'block'){
        // console.log('here');
        $('#formReserve').css('display', 'none');
    }else{
        // console.log('here1');
        $('#formReserve').css('display', 'block');
    }


});

$('.reserveNowmobile').click(function(){
    // console.log("Hello");

    var formReservemobile = $('#formReservemobile');
    // console.log("test " + formReservemobile.css('display'));
    // console.log(formReservemobile.css('display') == 'block');
    if(formReservemobile.css('display') == 'block'){
        // ketika form tertutup
        // console.log('here');
        $('#formReservemobile').css('display', 'none');
        $('.reserveNowmobile').css('background-color','var(--quaternary-bg-color)');
        $(".reserveNowmobile").html('Book Now');
        // $('#reserveNowmobile').css('background-color','#D4B580');
    }else{
        // ketika form terbuka
        // console.log('here1');
        $('#formReservemobile').css('display', 'block');
        $('.reserveNowmobile').css('background-color','var(--tertiary-bg-color)');
        $('.reserveNowmobile').css('font-weight','bold');
        $(".reserveNowmobile").html('Close');
        // console.log("test2 " + formReservemobile.css('display'));
    }


});

// $(document).mouseup(function(e)
// {
//     var container = $("#formReservemobile");
//     var datepicker = $("#table-condensed");
//     var btn = $("#reserveNowmobile");

    // if the target of the click isn't the container nor a descendant of the container
    // || !datepicker.is(e.target) && datepicker.has(e.target).length === 0

//     if (!container.is(e.target) && container.has(e.target).length === 0 && !btn.is(e.target) && btn.has(e.target).length === 0)
//     {
//         container.css('display', 'none');
//         $('.reserveNowmobile').css('background-color','#D4B580');
//         $(".reserveNowmobile").html('Book Now');
//     }
// });




$(document).on('scroll', function(){
    // var inp = $(this).find('#datePickerReserveForm');
    $('.inputbox-datepicker .datepicker, .datepicker-dropdown, .dropdown-menu, .datepicker-orient-left, .datepicker-orient-top').css('position', 'fixed');
})
$('#datePickerReserveForm').focusin(function(){
    $('.inputbox-datepicker .datepicker, .datepicker-dropdown, .dropdown-menu, .datepicker-orient-left, .datepicker-orient-top').css('position', 'absolute');
})
$('#datePickerReserveForm').focusout(function(){
    $('.inputbox-datepicker .datepicker, .datepicker-dropdown, .dropdown-menu, .datepicker-orient-left, .datepicker-orient-top').css('position', 'absolute');
})

var inp = $(this).find('#datePickerReserveForm');

// $('#ui-datepicker-div').css('top', inp.offset().top + inp.outerHeight());


