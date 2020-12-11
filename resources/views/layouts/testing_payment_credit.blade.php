<!DOCTYPE html>
<html>
<body>

<h2>Testing Notification Payment Credit</h2>

<form method="POST" action="{{ route('credit.notification') }}" enctype="multipart/form-data">
    {{csrf_field()}}

    <label for="TRANSACTIONID">TRANSACTIONID:</label><br>
    <input type="text" id="TRANSACTIONID" name="TRANSACTIONID" value="{{ $transaction_id }}"><br><br>

    <label for="MERCHANTID">MERCHANTID:</label><br>
    <input type="text" id="MERCHANTID" name="MERCHANTID" value="{{ $merchant_id }}"><br><br>

    <label for="MERCHANT_TRANID">MERCHANT_TRANID:</label><br>
    <input type="text" id="MERCHANT_TRANID" name="MERCHANT_TRANID" value="{{ $data->booking_id }}"><br><br>

    <label for="TRANDATE">TRANDATE:</label><br>
    <input type="text" id="TRANDATE" name="TRANDATE" value="{{ $payment_date }}"><br><br>

    <label for="FRAUD_STATUS">FRAUD_STATUS:</label><br>
    <input type="text" id="FRAUD_STATUS" name="FRAUD_STATUS" value="{{ $fraud_status }}"><br><br>

    <label for="USR_MSG">USR_MSG:</label><br>
    <input type="text" id="USR_MSG" name="USR_MSG" value="{{ $status_message }}"><br><br>

    <label for="SIGNATURE">SIGNATURE:</label><br>
    <input type="text" id="SIGNATURE" name="SIGNATURE" value="{{ $signature }}"><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
