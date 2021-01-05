<!DOCTYPE html>
<html>
<body>

<h2>Testing One Disable Payment</h2>

    <div class="form-group">
        <label class="control-label" for="payment-channel" style="font-size:12px; font-weight:bold;">Choose Bank</label>
        <select id="payment-channel" name="payment-channel" class="form-control visitor-input">
            @php
                foreach ($listPaymentChannels as $listPaymentChannel => $item) {
                    if ($item['pg_code'] == 801) {
                        unset($listPaymentChannels[$listPaymentChannel]);
                    }
                }

                foreach ($listPaymentChannels as $listPaymentChannel ) {
                    echo"<option value='$listPaymentChannel[pg_code]'>$listPaymentChannel[pg_name]</option>";
                }

            @endphp
        </select>
    </div>

</body>
</html>
