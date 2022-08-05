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
                <th colspan="11">
                    H 0
                </th>
                <th colspan="11">
                    H+1
                </th>
                <th colspan="11">
                    H+2
                </th>
                <th colspan="11">
                    H+3
                </th>
                <th colspan="11">
                    H+4
                </th>
                <th colspan="11">
                    H+5
                </th>
                <th colspan="11">
                    H+6
                </th>
                <th colspan="11">
                    H+7
                </th>

            </tr>
            <tr>
                {{-- h0 --}}
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
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Failed Delivery
                </th>

                {{-- h1 --}}
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
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Failed Delivery
                </th>

                {{-- h2 --}}
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
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Failed Delivery
                </th>
                {{-- h3 --}}
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
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Failed Delivery
                </th>
                {{-- h4 --}}
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
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Failed Delivery
                </th>
                {{-- h5 --}}
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
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Failed Delivery
                </th>
                {{-- h6 --}}
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
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Failed Delivery
                </th>
                {{-- h7 --}}
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
                    %Sukses Del
                </th>
                <th>
                    %Unrunsheet
                </th>
                <th>
                    %Return
                </th>
                <th>
                    %Failed Delivery
                </th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($performances as $performance)
                <tr>
                    <th>
                        {{ date('d/m/Y', strtotime($performance->inbound_date)) }}
                    </th>
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
                        {{ $performance->total_0 }}
                    </td>
                    <td>
                        {{ $performance->ur_0 }}
                    </td>
                    <td>
                        {{ $performance->d_0 }}
                    </td>
                    <td>
                        {{ $performance->cr_0 }}
                    </td>
                    <td>
                        {{ $performance->u_0 }}
                    </td>
                    <td>
                        {{ $performance->o_0 }}
                    </td>
                    <td>
                        {{ $performance->r_0 }}
                    </td>
                    <td>
                        {{ floor(($performance->d_0 / $performance->total_0) * 100) }}%
                    </td>
                    <td>
                        {{ floor(($performance->ur_0 / $performance->total_0) * 100) }}%
                    </td>
                    <td>
                        {{ floor(($performance->r_0 / $performance->total_0) * 100) }}%
                    </td>
                    <td>
                        {{ floor((($performance->total_0 - $performance->d_0) / $performance->total_0) * 100) }}%
                    </td>


                    {{-- h-1 --}}
                    <td>
                        {{ $performance->total_1 }}
                    </td>
                    <td>
                        {{ $performance->ur_1 }}
                    </td>
                    <td>
                        {{ $performance->d_1 }}
                    </td>
                    <td>
                        {{ $performance->cr_1 }}
                    </td>
                    <td>
                        {{ $performance->u_1 }}
                    </td>
                    <td>
                        {{ $performance->o_1 }}
                    </td>
                    <td>
                        {{ $performance->r_1 }}
                    </td>
                    <td>
                        {{ $performance->date_1 ? floor(($performance->d_1 / $performance->total_1) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_1 ? floor(($performance->ur_1 / $performance->total_1) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_1 ? floor(($performance->r_1 / $performance->total_1) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_1 ? floor((($performance->total_1 - $performance->d_1) / $performance->total_1) * 100) . '%' : '' }}
                    </td>


                    {{-- h-2 --}}
                    <td>
                        {{ $performance->total_2 }}
                    </td>
                    <td>
                        {{ $performance->ur_2 }}
                    </td>
                    <td>
                        {{ $performance->d_2 }}
                    </td>
                    <td>
                        {{ $performance->cr_2 }}
                    </td>
                    <td>
                        {{ $performance->u_2 }}
                    </td>
                    <td>
                        {{ $performance->o_2 }}
                    </td>
                    <td>
                        {{ $performance->r_2 }}
                    </td>
                    <td>
                        {{ $performance->date_2 ? floor(($performance->d_2 / $performance->total_2) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_2 ? floor(($performance->ur_2 / $performance->total_2) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_2 ? floor(($performance->r_2 / $performance->total_2) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_2 ? floor((($performance->total_2 - $performance->d_2) / $performance->total_2) * 100) . '%' : '' }}
                    </td>

                    {{-- h-3 --}}
                    <td>
                        {{ $performance->total_3 }}
                    </td>
                    <td>
                        {{ $performance->ur_3 }}
                    </td>
                    <td>
                        {{ $performance->d_3 }}
                    </td>
                    <td>
                        {{ $performance->cr_3 }}
                    </td>
                    <td>
                        {{ $performance->u_3 }}
                    </td>
                    <td>
                        {{ $performance->o_3 }}
                    </td>
                    <td>
                        {{ $performance->r_3 }}
                    </td>
                    <td>
                        {{ $performance->date_3 ? floor(($performance->d_3 / $performance->total_3) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_3 ? floor(($performance->ur_3 / $performance->total_3) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_3 ? floor(($performance->r_3 / $performance->total_3) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_3 ? floor((($performance->total_3 - $performance->d_3) / $performance->total_3) * 100) . '%' : '' }}
                    </td>



                    {{-- h-4 --}}
                    <td>
                        {{ $performance->total_4 }}
                    </td>
                    <td>
                        {{ $performance->ur_4 }}
                    </td>
                    <td>
                        {{ $performance->d_4 }}
                    </td>
                    <td>
                        {{ $performance->cr_4 }}
                    </td>
                    <td>
                        {{ $performance->u_4 }}
                    </td>
                    <td>
                        {{ $performance->o_4 }}
                    </td>
                    <td>
                        {{ $performance->r_4 }}
                    </td>
                    <td>
                        {{ $performance->date_4 ? floor(($performance->d_4 / $performance->total_4) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_4 ? floor(($performance->ur_4 / $performance->total_4) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_4 ? floor(($performance->r_4 / $performance->total_4) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_4 ? floor((($performance->total_4 - $performance->d_4) / $performance->total_4) * 100) . '%' : '' }}
                    </td>


                    {{-- h-5 --}}
                    <td>
                        {{ $performance->total_5 }}
                    </td>
                    <td>
                        {{ $performance->ur_5 }}
                    </td>
                    <td>
                        {{ $performance->d_5 }}
                    </td>
                    <td>
                        {{ $performance->cr_5 }}
                    </td>
                    <td>
                        {{ $performance->u_5 }}
                    </td>
                    <td>
                        {{ $performance->o_5 }}
                    </td>
                    <td>
                        {{ $performance->r_5 }}
                    </td>
                    <td>
                        {{ $performance->date_5 ? floor(($performance->d_5 / $performance->total_5) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_5 ? floor(($performance->ur_5 / $performance->total_5) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_5 ? floor(($performance->r_5 / $performance->total_5) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_5 ? floor((($performance->total_5 - $performance->d_5) / $performance->total_5) * 100) . '%' : '' }}
                    </td>


                    {{-- h-6 --}}
                    <td>
                        {{ $performance->total_6 }}
                    </td>
                    <td>
                        {{ $performance->ur_6 }}
                    </td>
                    <td>
                        {{ $performance->d_6 }}
                    </td>
                    <td>
                        {{ $performance->cr_6 }}
                    </td>
                    <td>
                        {{ $performance->u_6 }}
                    </td>
                    <td>
                        {{ $performance->o_6 }}
                    </td>
                    <td>
                        {{ $performance->r_6 }}
                    </td>
                    <td>
                        {{ $performance->date_6 ? floor(($performance->d_6 / $performance->total_6) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_6 ? floor(($performance->ur_6 / $performance->total_6) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_6 ? floor(($performance->r_6 / $performance->total_6) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_6 ? floor((($performance->total_6 - $performance->d_6) / $performance->total_6) * 100) . '%' : '' }}
                    </td>

                    {{-- h-7 --}}
                    <td>
                        {{ $performance->total_7 }}
                    </td>
                    <td>
                        {{ $performance->ur_7 }}
                    </td>
                    <td>
                        {{ $performance->d_7 }}
                    </td>
                    <td>
                        {{ $performance->cr_7 }}
                    </td>
                    <td>
                        {{ $performance->u_7 }}
                    </td>
                    <td>
                        {{ $performance->o_7 }}
                    </td>
                    <td>
                        {{ $performance->r_7 }}
                    </td>
                    <td>
                        {{ $performance->date_7 ? floor(($performance->d_7 / $performance->total_7) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_7 ? floor(($performance->ur_7 / $performance->total_7) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_7 ? floor(($performance->r_7 / $performance->total_7) * 100) . '%' : '' }}
                    </td>
                    <td>
                        {{ $performance->date_7 ? floor((($performance->total_7 - $performance->d_7) / $performance->total_7) * 100) . '%' : '' }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
