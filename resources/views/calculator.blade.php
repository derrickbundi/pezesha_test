<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{config('app.name')}}</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .table-header {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            background-color: #f2f2f2;
        }
        .table-body {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5>
                Loan Calculation <a href="{{url()->previous()}}" style="float: right">Go Back &#8594;</a>
            </h5>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h6>Loan Amount {{$result['total_amount_to_repay']}}</h6>
                    <h6>Interst Amount {{$result['total_interest']}}</h6>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table style="width: 100%;border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th class="table-header">#</th>
                                <th class="table-header">Amount</th>
                                <th class="table-header">Interest</th>
                                <th class="table-header">Principal</th>
                                <th class="table-header">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result['repayment_plan'] as $item)
                                <tr>
                                    <td class="table-body">{{$item['id']}}</td>
                                    <td class="table-body">{{$item['amount']}}</td>
                                    <td class="table-body">{{$item['interest_amount']}}</td>
                                    <td class="table-body">{{$item['principal']}}</td>
                                    <td class="table-body">{{$item['balance']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
