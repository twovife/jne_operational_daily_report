<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>Undel Id</td>
                <td>Action Date</td>
                <td>Last Action</td>
                <td>Follow up</td>
                <td>Description</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($performances as $performance)
                <tr>
                    <td>{{ $performance->opr_undel_id }}</td>
                    <td>{{ $performance->action_date }}</td>
                    <td>{{ $performance->last_action }}</td>
                    <td>{{ $performance->follow_up }}</td>
                    <td>{{ $performance->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
