<!DOCTYPE html>
<html>
<body>

<h2>Testing Notification Payment</h2>

<form method="POST" action="{{ route('payment.notification') }}" enctype="multipart/form-data">
    {{csrf_field()}}

    <label for="trx_id">trx_id:</label><br>
    <input type="text" id="trx_id" name="trx_id" value="{{ $transaction_id }}"><br><br>

    <label for="merchant_id">merchant_id:</label><br>
    <input type="text" id="merchant_id" name="merchant_id" value="{{ $merchant_id }}"><br><br>

    <label for="bill_no">bill_no:</label><br>
    <input type="text" id="bill_no" name="bill_no" value="{{ $data->booking_id }}"><br><br>

    <label for="payment_channel">payment_channel:</label><br>
    <input type="text" id="payment_channel" name="payment_channel" value="{{ $payment_channel }}"><br><br>

    <label for="signature">signature:</label><br>
    <input type="text" id="signature" name="signature" value="{{ $signature }}"><br><br>

    <label for="payment_status_code">payment_status_code:</label><br>
    <input type="text" id="payment_status_code" name="payment_status_code" value="{{ $payment_status_code }}"><br><br>

    <label for="payment_status_desc">payment_status_desc:</label><br>
    <input type="text" id="payment_status_desc" name="payment_status_desc" value="{{ $payment_status_desc }}"><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
