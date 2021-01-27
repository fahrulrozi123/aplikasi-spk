<!DOCTYPE html>
<html>
<body>

<h2>Check Payment Credit</h2>

<form method="POST" action="{{ route('status.payment.credit') }}" enctype="multipart/form-data">
    {{csrf_field()}}

    <label for="tranid">tranid:</label><br>
    <input type="text" id="tranid" name="tranid"><br><br>

    <label for="amount">amount:</label><br>
    <input type="text" id="amount" name="amount"><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
