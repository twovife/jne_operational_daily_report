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
                <th>Main Id</th>
                <th>Date Runsheet</th>
                <th>HUB</th>

                <th>AWB</th>
                <th>Runsheet</th>
                <th>Kurir</th>
                <th>Remark</th>
                <th>Remark Status</th>
                <th>Follow Up</th>
                <th>Closed Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($performances as $performance)
                <tr>
                    <td>{{ $performance->opr_open_status_id }}</td>
                    <td>{{ $performance->openpod->date }}</td>
                    <td>{{ $performance->openpod->hub }}</td>
                    <td>{{ $performance->awb }}</td>
                    <td>{{ $performance->runsheet }}</td>
                    <td>{{ $performance->employee->nama }}</td>
                    <td>{{ $performance->remark }}</td>
                    <td>{{ $performance->remark_status }}</td>
                    <td>{{ $performance->follow_up }}</td>
                    <td>{{ $performance->closed_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
