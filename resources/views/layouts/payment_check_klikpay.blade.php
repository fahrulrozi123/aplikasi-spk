<!DOCTYPE html>
<html>
<body>

<h2>Check Payment Klikpay</h2>

<form method="POST" action="{{ route('klikpay.notification') }}" enctype="multipart/form-data">
    {{csrf_field()}}

    <label for="trx_id">trx_id:</label><br>
    <input type="text" id="trx_id" name="trx_id"><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
