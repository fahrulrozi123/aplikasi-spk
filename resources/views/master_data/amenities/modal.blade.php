{{-- modal delete --}}
<div id="modal-1" class="modal">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-body">
                <h3><i class="text-danger fa fa-trash"></i> Confirm to Delete</h3>
                <h4>Are you sure you want to delete this?</h4>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="text-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
{{-- modal radio --}}
<div id="modal-2" class="modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <h3>SELECT ICON</h3>
                <hr>
                <div class="row" id="icon_list">
                    @php
                        $icon_name = ['wifi.svg', 'towel.svg', 'toilet.svg', 'swimming-pool.svg', 'suitcase.svg', 'plate.svg', 'parking.svg', 'outdoor-cafe.svg', 'no-smoking.svg', 'mountain.svg', 'laundry.svg', 'karaoke.svg', 'housekeeping.svg', 'gym.svg', 'foodservice.svg', 'disabled.svg', 'custservice.svg', 'credit-card.svg', 'coffee.svg', 'biliard.svg', 'bed.svg', 'bar.svg', 'atm.svg', 'ac.svg', 'bowling.svg', 'bathroom.svg', 'shower.svg', 'shapes.svg'];
                        $n = 0;
                    @endphp
                    @foreach ($icon_name as $icon)
                        <div class="col-lg-3 pb">
                            <div class="checkbox checkbox-replace color-primary">
                                <input class="radio_icon" type="radio" id="rd-{{ $n }}" name="radio1"
                                    value='{{ $icon }}'>
                                <label style="padding-top: 5px;">
                                    <svg width="17px" height="17px" class="horison-icon">
                                        {!! file_get_contents($path . $icon, false, stream_context_create($arrContextOptions)) !!}
                                    </svg>
                                </label>
                            </div>
                        </div>
                        @php $n++; @endphp
                    @endforeach
                </div>
                <br>
                <div class="modal-footer">
                    <a class="btn btn-horison-gold btn-lg" href="#" onclick='changeIcon();'>
                        Use
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var icon_class = document.getElementsByClassName('radio_icon');

    function checkIcon(iconName) {
        icon_class.forEach(element => {
            if (element.value == iconName) {
                element.click();
            }
        });
    }

    function changeIcon() {
        icon_class.forEach(element => {
            if (element.checked == true) {
                document.getElementById("icon" + window.idName).src = "{{ $path }}" + element
                    .value;
                document.getElementById("input" + window.idName).value = element.value;
            }
        });
        if (document.getElementById("amenities_" + window.idName).value == "0") {
            document.getElementById("amenities_" + window.idName).value = "1";
        }

        jQuery('#modal-2').modal('hide');
    }
</script>
