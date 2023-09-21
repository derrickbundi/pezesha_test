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
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5>Loan calculator</h5>
            <hr>
            <form method="POST" action="{{route('calculator')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" placeholder="Enter amount" name="amount">
                    </div>
                    <div class="col-md-6">
                        <label for="loan_term">Loan Term (in months)</label>
                        <select class="form-control" id="loan_term" name="loan_term">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="amount">Interest Rate (per annum)</label>
                        <input type="number" class="form-control" id="interest_rate" name="interest_rate" placeholder="Enter interest rate">
                    </div>
                    <div class="col-md-6">
                        <label for="repayment_frequency">Repayment Frequency</label>
                        <select class="form-control" id="repayment_frequency" name="repayment_frequency">
                            <option value="monthly">Monthly</option>
                            <option value="bi_monthly">Bi-monthly</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">Calculate &#8594;</button>
                    </div>
                </div>
              </form>
        </div>
    </div>    
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
