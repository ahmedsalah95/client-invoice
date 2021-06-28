<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>


<div class="container ">
    <h1 class="text-center">Invoices</h1>

    {{--Card Start--}}
    <div class="card">
            <div class="card-header">
                Add New Invoice
                <div class="float-right">
                    <a href="{{route('clients')}}" class="btn btn-success">Go to Add Client</a>
                </div>
            </div>
        {{--Card body Start--}}
            <div class="card-body">

                {{--name feild--}}
                <div class="form-group">
                    <label for="name">Client Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>


                {{--Email feild--}}
                <div class="form-group">
                    <label for="email">Client email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>


                {{--Mobile feild--}}
                <div class="form-group">
                    <label for="mobile">Client mobile number</label>
                    <input type="number" class="form-control" id="mobile" name="mobile">
                </div>

                {{--Amount feild--}}
                <div class="form-group">
                    <label for="amount">Invoice amount</label>
                    <input type="text" class="form-control" id="amount" name="amount">
                </div>


                {{--Invoice feild--}}
                <div class="form-group">
                    <label for="due_date">Invoice Due date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date">
                </div>


                {{--Submit button feild--}}
                <button id="submit" type="submit" name="">submit</button>

            </div>
        {{--Card body End--}}

    </div>
    {{--Card End--}}


</div>
{{--Continer End--}}

{{--Section invoice-list Start--}}
    <section class="invoice-list" style="padding-top: 60px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Invoices

                        </div>


                        {{--Card body Start--}}
                        <div class="card-body">


                            {{--Table invoice-list Start--}}
                            <table id="invoiceTable" class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Email</th>
                                    <th>Client Name</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>

                                </tr>
                                </thead>
                                <tbody>
                                {{--Get the $invoices values in foreach --}}

                                @foreach($invoices as $invoice )
                                    <tr>
                                        <td>{{$invoice->id}}</td>
                                        <td>{{$invoice->client->email}}</td>
                                        <td>{{$invoice->client->name}}</td>
                                        <td>{{$invoice->amount}}</td>
                                        <td>{{$invoice->due_date}}</td>
                                    </tr>

                                @endforeach
                                </tbody>

                            </table>

                            {{--Table invoice-list End--}}

                        </div>

                        {{--Section invoice-list End--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--Section invoice-list End--}}






    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

{{--Add Invoice data with ajax--}}

        $("#submit").click(function () {
//define the data
    var name = $("input[name=name]").val();
    var mobile= document.getElementById('mobile').value;
    var email= document.getElementById('email').value;
    var amount= document.getElementById('amount').value;
    var due_date= document.getElementById('due_date').value;
    var submit= document.getElementById('submit');


        const url = 'http://localhost:8000/api/invoices';
// The data we are going to send in our request

        var data = {
            name:name,
            mobile:mobile,
            email:email,
            amount:amount,
            due_date:due_date

        };
        console.log(data);

//ajax request to send
            $.ajax({
            type:     "post",
            data:     data,
            cache:    false,
            url:      "http://localhost:8000/api/invoices",
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert("Please fill all fields");
            },

            success: function () {
                console.log(data);
                $("#submit").click(function(){
                    $("#submit").hide();
                });
                alert(" Done ! ");
                //if success clear the data of the inputs in the form
                $('#due_date').val('');
                $('#name').val('');
                $('#mobile').val('');
                $('#amount').val('');
                $('#email').val('');
            }
        });




        });



</script>
</body>
</html>