@component('mail::message')
# New Order
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
<h3>Your New Order Is:</h3>
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
            <td colspan="4"><strong>Total money to recieve:</strong></td>
            <td id="gtotal">&#x20b9; {{$tot}} </td>
        </tr>
    </tfoot>
</table>

</pre>
</body>
</html>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
