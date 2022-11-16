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
                <th>Date</th>
                <th>HUB</th>
                <th>Runsheet</th>
                <th>Open POD</th>
                <th>AWB Open</th>
                <th>Percentage POD</th>
                <th>Percentage Open</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($performances as $performance)
                <tr>
                    <td>{{ $performance->date }}</td>
                    <td>{{ $performance->hub }}</td>
                    <td>{{ $performance->ttl_runsheet }}</td>
                    <td>{{ $performance->open_pod }}</td>
                    <td>{{ $performance->details_count }}</td>
                    <td>{{ round((($performance->ttl_runsheet - $performance->open_pod) / $performance->ttl_runsheet) * 100, 2) }}
                        %</td>
                    <td>{{ round(($performance->open_pod / $performance->ttl_runsheet) * 100, 2) }} %</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
