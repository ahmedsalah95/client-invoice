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
    <h1 class="text-center">clients</h1>


    {{--Card Start--}}
    <div class="card">
        <div class="card-header">
            Add New client
            <div class="float-right">
            <a href="{{route('invoices')}}" class="btn btn-success">Go to Add Invoice</a>
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

            {{--Submit button feild--}}
            <button id="submit" type="submit" name="">submit</button>
        </div>
        {{--Card body End--}}

    </div>
    {{--Card End--}}


</div>

{{--Section client-list Start--}}

<section class="client-list" style="padding-top: 60px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Clients

                    </div>

                    {{--Card body Start--}}
                    <div class="card-body">

                        {{--clientTable  Start--}}
                        <table id="clientTable" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Client Email</th>
                                <th>Client Name</th>
                                <th>Mobile Number</th>

                            </tr>
                            </thead>
                            <tbody>


                            {{--Get the $clients values in foreach --}}

                            @foreach($clients as $client )
                                <tr>
                                    <td>{{$client->id}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->mobile}}</td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table>
                        {{--table End--}}

                    </div>
                    {{--Section invoice-list End--}}

                </div>
            </div>
        </div>
    </div>
</section>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    {{--Add Client data with ajax--}}

    $("#submit").click(function () {
//define the data

        var name = $("input[name=name]").val();
        var mobile= document.getElementById('mobile').value;
        var email= document.getElementById('email').value;
        var submit= document.getElementById('submit');



// The data we are going to send in our request

        var data = {
            name:name,
            mobile:mobile,
            email:email,


        };
        console.log(data);

        //ajax request to send

        $.ajax({
            type:     "post",
            data:     data,
            cache:    false,
            url:      "http://localhost:8000/api/clients",
            error: function(xhr) {

                alert("check your data please!!");


            },

            success: function () {
                console.log(data);
                $("#submit").click(function(){
                    $("#submit").hide();
                });
                alert(" Done ! ");
                //if success clear the data of the inputs in the form
                $('#name').val('');
                $('#mobile').val('');
                $('#email').val('');
            }
        });




    });


</script>
</body>
</html>