<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        table {
            width: 100%;
        }
        h2{
            text-align: center;
        }
    </style>

</head>
<body>

    <h2>Invoice</h2>
    <p> Dear ,{{$details['name']}} This your last invoice</p>

    <table>
        <tr>
            <th>Amount</th>
            <th>Due date</th>
        </tr>
        <tr>
            <td>{{$details['title']}}</td>
            <td>{{$details['body']}}</td>
        </tr>

    </table>


</body>

</html>