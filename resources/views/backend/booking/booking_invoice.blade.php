<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            margin: 0 auto;
            padding: 20px;
            max-width: 800px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f7f7f7;
        }

        .gray {
            background-color: lightgray;
        }

        .font {
            font-size: 15px;
        }

        .authority {
            float: right;
            text-align: center;
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
        }

        .signature {
            font-family: 'Brush Script MT', cursive;
            font-size: 24px;
            color: green;
        }

        .thanks {
            margin-top: 20px;
        }

        .thanks p {
            color: green;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            background: #F7F7F7;
        }

        .header h2 {
            color: green;
            font-size: 26px;
        }

        .header pre {
            text-align: right;
        }

        .table-summary {
            float: right;
            width: auto;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .badge.bg-primary {
            background-color: #007bff;
        }

        .badge.bg-warning {
            background-color: #ffc107;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="header">
            <h2><strong>Mallik Hotel && Resort</strong></h2>
            <pre class="font">
Mallik Hotel
Email: imran@gmail.com
Mob: 1245454545
West Bengal 721633, Osmanpur
            </pre>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Total Room</th>
                    <th>Price</th>
                    <th>Check In / Out Date</th>
                    <th>Total Days</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $editData->room->type->name }}</td>
                    <td>{{ $editData->number_of_rooms }}</td>
                    <td>&#8377;{{ $editData->actual_price }}</td>
                    <td>
                        <span class="badge bg-primary ">{{ $editData->check_in }}</span> /
                        <span class="badge bg-warning text-dark mt-2">{{ $editData->check_out }}</span>
                    </td>
                    <td>{{ $editData->total_night }}</td>
                    <td>&#8377;{{ $editData->actual_price * $editData->number_of_rooms }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table-summary">
            <tr>
                <td>Subtotal</td>
                <td>&#8377;{{ $editData->subtotal }}</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td>&#8377;{{ $editData->discount }}</td>
            </tr>
            <tr>
                <td>Grand Total</td>
                <td>&#8377;{{ $editData->total_price }}</td>
            </tr>
        </table>

        <div class="thanks">
            <p>Thanks For Your Booking..!!</p>
        </div>

        <div class="authority">
            <p>-----------------------------------</p>
            <h5>Authority Signature:</h5>
            <p class="signature">Imran Mallik</p>
        </div>

    </div>

</body>

</html>
