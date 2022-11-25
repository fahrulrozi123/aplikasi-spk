$(".BB_book_title_room").click(function () {
    $(".BB_book_action_room").toggleClass("BB_book_active_room");
    if ($(".BB_book_action_room").hasClass("BB_book_active_room")) {
        $(".child-age").css("display", "block");
    } else {
        $(".child-age").css("display", "none");
    }
});

$(".BB_book_title_package").click(function () {
    $(".BB_book_action_package").toggleClass("BB_book_active_package");
});

$(".BB_book_title_contact").click(function () {
    $(".BB_book_action_contact").toggleClass("BB_book_active_contact");
});

const room_picker = new Litepicker({
    firstDay: 1,
    format: "DD MMMM YYYY",
    lang: "en-US",
    numberOfMonths: 1,
    numberOfColumns: 1,
    minDate: moment(new Date()).format("DD MMMM YYYY"),
    autoApply: true,
    showTooltip: true,
    singleMode: true,
    element: document.getElementById("checkin"),
});

room_picker.setDate(new Date());

var total_room = 1;
var totalChild = 0;

function submit(val) {
    var cek = true;
    var form = "";

    if (val == 1) {
        if (val == 1) {
            var extra_bed = parseInt($("#extra_bed").val());
            var adult_total = parseInt($("#adult_total").val());
            var child_total = parseInt(totalChild);
        }

        var adult_child_total = adult_total + child_total;

        var max_adult_child = total_room * 5 + extra_bed;
        var need_extrabed = total_room * 2 + 1;

        //validation adult
        var max_adult = total_room * 2 + total_room;
        var min_adult = total_room;

        //validation child
        var min_child = 0;
        var max_child = total_room * 2;

        //validation extra bed
        var min_extrabed = Math.floor(adult_total / (total_room + 1));
        var max_extrabed = total_room;
        var check_extrabed = false;
        var max_child = total_room;
        var msg = [];

        if (extra_bed > max_extrabed) {
            msg.push(
                "Extrabed capacity exceeded, each room only allow 1 extra bed"
            );
            check_extrabed = true;
            cek = false;
        }

        if (adult_total < min_adult) {
            msg.push(
                "Minimal adult is not reached, each room must have minimal 1 adult"
            );
            cek = false;
        }
        if (adult_total > max_adult) {
            msg.push("Room capacity exceeded, add more room");
            cek = false;
        }
        if (adult_total >= need_extrabed && extra_bed < min_extrabed) {
            msg.push("Room capacity exceeded, add more room or extrabed");
            cek = false;
        }
        if (adult_child_total > max_adult_child) {
            if (check_extrabed) {
                msg.push(
                    "Room capacity exceeded, room have maximal of 2 child(s) "
                );
            } else {
                msg.push(
                    "Room capacity exceeded, room have maximal of 2 child(s) "
                );
            }
            cek = false;
        }

        if (cek) {
            var child_age = [];
            if (val == 1) {
                var childs = document.getElementsByClassName("child_age");
            } else if (val == 2) {
                var childs =
                    document.getElementsByClassName("child_age_mobile");
            }

            if (childs != null) {
                for (let i = 0; i < childs.length; i++) {
                    const element = childs[i];
                    child_age.push(element.value);
                }
            }
            if (val == 1) {
                $("#child_age").val(child_age.toString());
            } else if (val == 2) {
                $("#child_age_mobile").val(child_age.toString());
            }

            $("#room_reserve").submit();
        } else {
            var message = "";
            var first = true;
            msg.forEach((element) => {
                if (first) {
                    message += "<li align='left'>" + element + "</li>";
                    first = false;
                } else {
                    message += "<li align='left'>" + element + "</li>";
                }
            });
            Swal.fire({
                icon: "warning",
                title: "Your Request below not following our policy :",
                html: message,
            });
        }
    } else {
        $("#room_reserve_mobile").submit();
    }
}

function addChild(n) {
    // console.log(n);
    var html = "";
    var next = totalChild + n;
    if (totalChild == 0 && n == -1) {
    } else if (totalChild + n > 10) {
        alert("Maximal 10 Child!");
    } else if (totalChild > next) {
        $("#age_" + String(totalChild)).fadeOut(300, function () {
            $(this).remove();
        });
        totalChild += n;
    } else {
        totalChild += n;
        var html =
            '<div class="child-age" id="age_' +
            totalChild +
            '">' +
            '<label for="date_check" class="label-modal-reserve">Age</label>' +
            '<div class="BB_book_row">' +
            '<div class="BB_book_column" style="padding-left: 0px; padding-right: 0px;">' +
            '<select style="width:75px;">' +
            '<option value="1">1</option>' +
            '<option value="2">2</option>' +
            '<option value="3">3</option>' +
            '<option value="4">4</option>' +
            '<option value="5">5</option>' +
            '<option value="6">6</option>' +
            "</select></div></div></div>";
        $(html).hide().appendTo("#children").fadeIn(300);
    }
}
