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
                <th rowspan="2">
                    Date Inbound
                </th>
                <th rowspan="2">
                    Closed At
                </th>
                <th rowspan="2">
                    Zone
                </th>
                <th rowspan="2">
                    Hub
                </th>
                <th rowspan="2">
                    Total Ship COD
                </th>
                <th rowspan="2">
                    Total Nominal COD
                </th>
                <th colspan="15">
                    H 0
                </th>
                <th colspan="15">
                    H+1
                </th>
                <th colspan="15">
                    > H+1
                </th>

            </tr>
            <tr>
                {{-- h0 --}}
                <th>
                    Status
                </th>
                <th>
                    TTL Cnote
                </th>
                <th>
                    Un Runsheet
                </th>
                <th>
                    Delivered
                </th>
                <th>
                    Sukses Return
                </th>
                <th>
                    CR
                </th>
                <th>
                    Undel
                </th>
                <th>
                    Un Status
                </th>
                <th>
                    Return
                </th>
                <th>
                    WH1
                </th>
                <th>
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Hold WH
                </th>
                <th>
                    %Failed Delivery
                </th>

                {{-- h1 --}}
                <th>
                    Status
                </th>
                <th>
                    TTL Cnote
                </th>
                <th>
                    Un Runsheet
                </th>
                <th>
                    Delivered
                </th>
                <th>
                    Sukses Return
                </th>
                <th>
                    CR
                </th>
                <th>
                    Undel
                </th>
                <th>
                    Un Status
                </th>
                <th>
                    Return
                </th>
                <th>
                    WH1
                </th>
                <th>
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Hold WH
                </th>
                <th>
                    %Failed Delivery
                </th>

                {{-- h2 --}}
                <th>
                    Status
                </th>
                <th>
                    TTL Cnote
                </th>
                <th>
                    Un Runsheet
                </th>
                <th>
                    Delivered
                </th>
                <th>
                    Sukses Return
                </th>
                <th>
                    CR
                </th>
                <th>
                    Undel
                </th>
                <th>
                    Un Status
                </th>
                <th>
                    Return
                </th>
                <th>
                    WH1
                </th>
                <th>
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Hold WH
                </th>
                <th>
                    %Failed Delivery
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($performances as $performance)
                <tr>
                    <th>

                        {{ date('d/m/Y', strtotime($performance->inbound_date)) }}
                    </th>
                    <td>
                        {{ is_null($performance->closed) ? 'Open' : 'H+' . $performance->closed }}
                    </td>
                    <td>
                        {{ $performance->zone }}
                    </td>
                    <td>
                        {{ $performance->hub }}
                    </td>
                    <td>
                        {{ $performance->total_shipment_cod }}
                    </td>
                    <td>
                        {{ $performance->total_nominal_cod }}
                    </td>

                    {{-- h-0 --}}
                    <td>
                        {{ $performance->islate->islate_d0 == '0' ? 'late' : ($performance->islate->islate_d0 == '1' ? 'on time' : '') }}
                    </td>
                    <td>
                        {{ $performance->total_0 }}
                    </td>
                    <td>
                        {{ $performance->unrunsheet_0 }}
                    </td>
                    <td>
                        {{ $performance->delivered_0 }}
                    </td>
                    <td>
                        {{ $performance->successreturn_0 }}
                    </td>
                    <td>
                        {{ $performance->cr_0 }}
                    </td>
                    <td>
                        {{ $performance->undel_0 }}
                    </td>
                    <td>
                        {{ $performance->open_0 }}
                    </td>
                    <td>
                        {{ $performance->return_0 }}
                    </td>
                    <td>
                        {{ $performance->wh_0 }}
                    </td>
                    <td>
                        {{ round((($performance->delivered_0 + $performance->successreturn_0) / $performance->total_0) * 100, 2) }}%
                    </td>
                    <td>
                        {{ round(($performance->unrunsheet_0 / $performance->total_0) * 100, 2) }}%
                    </td>
                    <td>
                        {{ round(($performance->return_0 / $performance->total_0) * 100, 2) }}%
                    </td>
                    <td>
                        {{ round(($performance->wh_0 / $performance->total_0) * 100, 2) }}%
                    </td>
                    <td>
                        {{ round((($performance->unrunsheet_0 + $performance->cr_0 + $performance->undel_0 + $performance->open_0 + $performance->return_0 + $performance->wh_0) / $performance->total_0) * 100, 2) }}%
                    </td>


                    {{-- h-1 --}}
                    <td>
                        {{ $performance->islate->islate_d1 == '0' ? 'late' : ($performance->islate->islate_d1 == '1' ? 'on time' : '') }}
                    </td>
                    <td>
                        {{ $performance->total_1 }}
                    </td>
                    <td>
                        {{ $performance->unrunsheet_1 }}
                    </td>
                    <td>
                        {{ $performance->delivered_1 }}
                    </td>
                    <td>
                        {{ $performance->successreturn_1 }}
                    </td>
                    <td>
                        {{ $performance->cr_1 }}
                    </td>
                    <td>
                        {{ $performance->undel_1 }}
                    </td>
                    <td>
                        {{ $performance->open_1 }}
                    </td>
                    <td>
                        {{ $performance->return_1 }}
                    </td>
                    <td>
                        {{ $performance->wh_1 }}
                    </td>
                    <td>
                        {{ $performance->date_1 ? round((($performance->delivered_1 + $performance->successreturn_1) / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_1 ? round(($performance->unrunsheet_1 / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_1 ? round(($performance->return_1 / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_1 ? round(($performance->wh_1 / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_1 ? round((($performance->unrunsheet_1 + $performance->cr_1 + $performance->undel_1 + $performance->open_1 + $performance->return_1 + $performance->wh_1) / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>


                    {{-- h-2 --}}
                    <td>
                        {{ $performance->islate->islate_d2 == '0' ? 'late' : ($performance->islate->islate_d2 == '1' ? 'on time' : '') }}
                    </td>
                    <td>
                        {{ $performance->total_2 }}
                    </td>
                    <td>
                        {{ $performance->unrunsheet_2 }}
                    </td>
                    <td>
                        {{ $performance->delivered_2 }}
                    </td>
                    <td>
                        {{ $performance->successreturn_2 }}
                    </td>
                    <td>
                        {{ $performance->cr_2 }}
                    </td>
                    <td>
                        {{ $performance->undel_2 }}
                    </td>
                    <td>
                        {{ $performance->open_2 }}
                    </td>
                    <td>
                        {{ $performance->return_2 }}
                    </td>
                    <td>
                        {{ $performance->wh_2 }}
                    </td>
                    <td>
                        {{ $performance->date_2 ? round((($performance->delivered_2 + $performance->successreturn_2) / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_2 ? round(($performance->unrunsheet_2 / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_2 ? round(($performance->return_2 / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_2 ? round(($performance->wh_2 / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_2 ? round((($performance->unrunsheet_2 + $performance->cr_2 + $performance->undel_2 + $performance->open_2 + $performance->return_2 + $performance->wh_2) / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
