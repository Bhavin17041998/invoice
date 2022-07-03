<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabcart</title>
    <style>
        body{
            background-color: white; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           /* background-color: #0d1033; */
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="body-section">
            <div class="row">
                <div class="col-12">
                    <h3>Shree Maa Tours & Travels</h3>
                    <p style="color:#cc0000">Always serves you best…!!!</p>
                </div>
                <div class="col-6" style="float: right; display:inline">
                    <div class="company-details">
                        <h3 style="color:#cc0000;float: right; display:inline">INVOICE</h3>
                    </div>
                    <div class="company-details" class="col-6" style="">
                        <p class="">51/566 Chandrabhaga Housing Board </p>
                        <p class="">Nr. Nava Vadaj,</p>
                        <p class="">Ahmedabad, Gujarat</p>
                        <p class="">(M) 9723630291</p>
                    </div>
                </div>
        </div>
        <br />
        <div class="row">
            <div class="col-6" style="">
                <p class="sub-heading">DATE: {{ $bill->current_date }}</p>
                <p class="sub-heading">INVOICE #  {{ $bill->id }}</p>
                <p class="sub-heading">Vehicle No. {{ $bill->vehicle->number }} </p>
                @php
                    $from_date = date("d-m-Y", strtotime($bill->from_date));
                    $to_date = date("d-m-Y", strtotime($bill->to_date));
                @endphp
                <p class="sub-heading">Duration {{  $from_date }}  to {{ $to_date }}</p>
                <p class="sub-heading"> {{ $bill->vehicle->name }}</p>
            </div>
        </div>
        <br />
            <div class="row">
                <div class="col-4">
                    <h5 style="background-color: #000066; width:20%; color:white; padding:8px; text-align:center" class="heading">BILL TO:</h5>
                    <p>{{ $bill->customer->address }}</p>
                </div>
                <br>
                <table class="table-bordered" style="width: 100%">
                    <thead>
                        <tr style="background-color: #000066">
                            <th class="w-20 text-white">DESCRIPTION</th>
                            <th class="w-20 text-white">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bill_connection as $item)
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->amount }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="1" class="text-right"><b>Total</b></td>
                            <td>{{ $bill->total_amount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <h3 class="heading" style="background-color: gray;color; width:50%">OTHER COMMENTS</h3>
            <textarea rows="3" style="width:50%"></textarea> <p style="display: inline;float: right; background-color:#87CEEB; padding:3px">Shree Maa Tours & Travels</p>
            <br />
            <br/>
            <p style="text-align: center">If you have any questions about this invoice, please contact</p>
            <p style="text-align: center">Mayur Panchal - 9723630291</p>
            <br />
            <h3 style="text-align: center">Thank You For Your Business!</h3>
                
        </div>      
    </div>
</body>
</html>
{{-- @dd("hi"); --}}