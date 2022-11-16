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
                <td>Source</td>
                <td>Breach Date</td>
                <td>Inbound Date</td>
                <td>Hub</td>
                <td>Origin</td>
                <td>Status Breach</td>
                <td>AWB</td>
                <td>Reason</td>
                <td>Img Link</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($performances as $performance)
                <tr>
                    <td>{{ $performance->opr_undel_id ? 'Undel' : 'Arrival' }}</td>
                    <td>{{ $performance->date }}</td>
                    <td>{{ $performance->undelivery->date_inbound ?? $performance->arrivebreach->date_inbound }}</td>
                    <td>{{ $performance->undelivery->hub ?? $performance->arrivebreach->hub }}</td>
                    <td>{{ $performance->undelivery->origin ?? $performance->arrivebreach->origin }}</td>
                    <td>{{ $performance->status }}</td>
                    <td>{{ $performance->undelivery->no_awb ?? $performance->arrivebreach->no_awb }}</td>
                    <td>{{ $performance->reason }}</td>
                    <td><a href="{{ asset('storage/' . $performance->img_name) }}">Link</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
