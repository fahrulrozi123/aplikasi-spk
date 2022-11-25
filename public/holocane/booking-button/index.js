document.write(
  "<link rel='stylesheet' href='https://bookingrecerva.tripasysfo.com/booking-button/css/booking-button.css' type='text/css' /> "
);

document.write(
  "<link rel='stylesheet' href='https://bookingrecerva.tripasysfo.com/booking-button/css/quadro.css' type='text/css' /> "
);

document.write(
  "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css' type='text/css' /> "
);

document.write(
  "<script type='text/javascript' src='https://bookingrecerva.tripasysfo.com/booking-button/js/jquery-1.11.3.min.js'></script>"
);

document.write(
  "<script type='text/javascript' src='https://bookingrecerva.tripasysfo.com/booking-button/js/moment.min.js'></script>"
);

document.write(
  "<script type='text/javascript' src='https://bookingrecerva.tripasysfo.com/booking-button/js/TweenMax.min.js'></script>"
);

document.write(
  "<script type='text/javascript' src='https://bookingrecerva.tripasysfo.com/booking-button/js/neon-custom.js'></script>"
);

document.write(
  "<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>"
);

document.write(
  "<script src='https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js'></script>"
);

document.write(
  "<script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/js/all.min.js'></script>"
);

document.write(
  "<script type='text/javascript' src='https://bookingrecerva.tripasysfo.com/booking-button/js/booking-button.js'></script>"
);

var html =
  "<div id='BB_book'> <div class='BB_book_action_room'> <p class='BB_book_title_room'>Rooms</p><div class='BB_book_card_room'> <form id='room_reserve' method='GET' action='https://bookingrecerva.tripasysfo.com/reservation' target='_blank'></form> <div class='BB_book_row'> <div class='BB_book_column'> <label for='checkin'>Check In</label> <input form='room_reserve' type='text' id='checkin' name='checkin' readonly required> <span class='date-checkin'><i class='fas fa-calendar-week'></i></span> </div><div class='BB_book_column'> <label for='stay_total'>Duration of Stay</label> <select form='room_reserve' id='stay_total' name='stay_total'> <option value='1'>1 Night</option> <option value='2'>2 Night</option> <option value='3'>3 Night</option> <option value='4'>4 Night</option> <option value='5'>5 Night</option> </select> </div></div><div class='BB_book_row'> <div class='BB_book_column'> <label for='room_total'>Rooms</label> <select form='room_reserve' id='room_total' name='room_total'> <option value='1'>1</option> <option value='2'>2</option> <option value='3'>3</option> <option value='4'>4</option> <option value='5'>5</option> </select> </div><div class='BB_book_column'> <label for='extra_bed'>Extra Bed</label> <select form='room_reserve' id='extra_bed' name='extra_bed'> <option value='0'>0</option> <option value='1'>1</option> <option value='2'>2</option> <option value='3'>3</option> <option value='4'>4</option> <option value='5'>5</option> </select> </div></div><div class='BB_book_row'> <div class='BB_book_column'> <label for='adult_total'>Adults</label> <select form='room_reserve' id='adult_total' name='adult_total'> <option value='1'>1</option> <option value='2'>2</option> <option value='3'>3</option> <option value='4'>4</option> <option value='5'>5</option> </select> </div><div class='BB_book_column'> <label for='child_total'>Children</label> <div class='input-spinner'> <button type='button' id='button_left' data-step='-1' onclick='addChild(-1);'>-</button> <input form='room_reserve' type='text' id='child_total' name='child_total' class='size-3' value='0' data-min='0' data-max='10' readonly> <button type='button' id='button_right' data-step='1' onclick='addChild(1);'>+</button> </div></div></div><div class='BB_book_children_room' id='children'> <input form='room_reserve' type='hidden' id='child_age' name='child_age'> </div><div class='BB_book_link_room'> <input type='button' onclick='submit(1);' value='Find Room'> </div></div></div><div class='BB_book_action_package'> <p class='BB_book_title_package'>Packages</p><div class='BB_book_card_package'> <p class='BB_book_description_package'>Maximize your stay with our other offers and experience much more than just our accommodation!</p><div class='BB_book_find_package'> <a class='BB_book_link_package'' target=' _blank' href='https://bookingrecerva.tripasysfo.com/package-reservation/'>Find Package</a> </div></div></div><div class='BB_book_action_contact'> <p class='BB_book_title_contact'>Contact Us</p><div class='BB_book_card_contact'> <p class='BB_book_description_contact'>Need something specific to fit to your needs? Reach out to us and tell anything!</p><div class='BB_book_find_contact'> <a class='BB_book_link_contact'' target=' _blank' href='https://bookingrecerva.tripasysfo.com/inquiry/'>Contact</a> </div></div></div></div>";

var tempElement = document.createElement("div");
tempElement.innerHTML = html;
document.getElementsByTagName("body")[0].appendChild(tempElement.firstChild);
