<!DOCTYPE html>
<html>
<body>

<h2>Check Payment</h2>

<form method="POST" action="{{ route('status.payment') }}" enctype="multipart/form-data">
    {{csrf_field()}}

    <label for="trx_id">trx_id:</label><br>
    <input type="text" id="trx_id" name="trx_id"><br><br>

    <label for="bill_no">bill_no:</label><br>
    <input type="text" id="bill_no" name="bill_no"><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>