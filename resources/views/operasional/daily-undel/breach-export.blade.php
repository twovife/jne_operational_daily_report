<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>Undel Id</td>
                <td>Breach Date</td>
                <td>Status</td>
                <td>Reason</td>
                <td>Img</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($performances as $performance)
                <tr>
                    <td>{{ $performance->opr_undel_id }}</td>
                    <td>{{ $performance->date }}</td>
                    <td>{{ $performance->status }}</td>
                    <td>{{ $performance->reason }}</td>
                    <td>{{ asset('storage/' . $performance->img_name) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
