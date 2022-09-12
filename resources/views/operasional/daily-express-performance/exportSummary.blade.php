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
                <th rowspan="2" scope="col">
                    Date Inbound
                </th>
                <th rowspan="2" scope="col">
                    Zone
                </th>
                <th rowspan="2" scope="col">
                    Total Ship COD
                </th>
                <th rowspan="2" scope="col">
                    Total Nominal COD
                </th>
                <th colspan="14" scope="col">
                    H 0
                </th>
                <th colspan="14" scope="col">
                    H+1
                </th>
                <th colspan="14" scope="col">
                    > H+1
                </th>

            </tr>
            <tr>
                {{-- h0 --}}
                <th scope="col">
                    TTL Cnote
                </th>
                <th scope="col">
                    Un Runsheet
                </th>
                <th scope="col">
                    Delivered
                </th>
                <th scope="col">
                    Success Return
                </th>
                <th scope="col">
                    CR
                </th>
                <th scope="col">
                    Undel
                </th>
                <th scope="col">
                    Un Status
                </th>
                <th scope="col">
                    Return
                </th>
                <th scope="col">
                    WH1
                </th>
                <th scope="col">
                    %Sukses Del
                </th>
                <th scope="col">
                    %Unrunsheet
                </th>
                <th scope="col">
                    %Return
                </th>
                <th scope="col">
                    %Hold WH
                </th>
                <th scope="col">
                    %Failed Delivery
                </th>

                {{-- h1 --}}
                <th scope="col">
                    TTL Cnote
                </th>
                <th scope="col">
                    Un Runsheet
                </th>
                <th scope="col">
                    Delivered
                </th>
                <th scope="col">
                    Success Return
                </th>
                <th scope="col">
                    CR
                </th>
                <th scope="col">
                    Undel
                </th>
                <th scope="col">
                    Un Status
                </th>
                <th scope="col">
                    Return
                </th>
                <th scope="col">
                    WH1
                </th>
                <th scope="col">
                    %Sukses Del
                </th>
                <th scope="col">
                    %Unrunsheet
                </th>
                <th scope="col">
                    %Return
                </th>
                <th scope="col">
                    %Hold WH
                </th>
                <th scope="col">
                    %Failed Delivery
                </th>

                {{-- h2 --}}
                <th scope="col">
                    TTL Cnote
                </th>
                <th scope="col">
                    Un Runsheet
                </th>
                <th scope="col">
                    Delivered
                </th>
                <th scope="col">
                    Success Return
                </th>
                <th scope="col">
                    CR
                </th>
                <th scope="col">
                    Undel
                </th>
                <th scope="col">
                    Un Status
                </th>
                <th scope="col">
                    Return
                </th>
                <th scope="col">
                    WH1
                </th>
                <th scope="col">
                    %Sukses Del
                </th>
                <th scope="col">
                    %Unrunsheet
                </th>
                <th scope="col">
                    %Return
                </th>
                <th scope="col">
                    %Hold WH
                </th>
                <th scope="col">
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
                        {{ $performance->zone }}
                    </td>

                    <td>
                        {{ $performance->total_shipment_cod }}
                    </td>
                    <td>
                        {{ $performance->total_nominal_cod }}
                    </td>


                    {{-- h-0 --}}
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
                        {{ $performance->total_1 ? round((($performance->delivered_1 + $performance->successreturn_1) / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->total_1 ? round(($performance->unrunsheet_1 / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->total_1 ? round(($performance->return_1 / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->total_1 ? round(($performance->wh_1 / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->total_1 ? round((($performance->unrunsheet_1 + $performance->cr_1 + $performance->undel_1 + $performance->open_1 + $performance->return_1 + $performance->wh_1) / $performance->total_1) * 100, 2) . '%' : '' }}
                    </td>


                    {{-- h-2 --}}
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
                        {{ $performance->total_2 ? round((($performance->delivered_2 + $performance->successreturn_2) / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->total_2 ? round(($performance->unrunsheet_2 / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->total_2 ? round(($performance->return_2 / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->total_2 ? round(($performance->wh_2 / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->total_2 ? round((($performance->unrunsheet_2 + $performance->cr_2 + $performance->undel_2 + $performance->open_2 + $performance->return_2 + $performance->wh_2) / $performance->total_2) * 100, 2) . '%' : '' }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
