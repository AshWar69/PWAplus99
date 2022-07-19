@component('mail::message')
# Plus99 Order
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
<h3>Your Order Is:</h3>
<p>Your Order Is Not Confirmed Yet By <b>ADMIN</b>. Order Is Pending, When Order Get Confirmed You Recieve Confirmation Email On Your Registered Email. </p>
<table style="width:100%">
    <thead>
        <tr>
            <th>SrNo</th>
            <th>Order_details</th>
            <th>Total Price</th>
            <th>Payment_Mode</th>
            <th>Order_Status</th>
        </tr>
    </thead>
    <tbody>
        @php $tot=0; $i=1; @endphp
        @foreach($details as $data)
        <tr>
            <td>{{$i}}</td>
            <td>{{$data->order_details}}</td>
            <td>&#x20b9; {{$data->tprice}}</td>
            <td>{{$data->payment_mode}}</td>
            <td>{{$data->status}}</td>
        </tr>
        @php 
            $tot = $data->tprice;
            $i++;
        @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4"><strong>Total amount to be paid:</strong></td>
            <td id="gtotal">&#x20b9; {{$tot}} </td>
        </tr>
    </tfoot>
</table>

<p><b>Note:</b> Your Order Is Not Accepted Yet. When your order is accepted you will be notified through an email or by getting a confirmation call from our team.</p>
</body>
</html>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
