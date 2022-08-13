<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="whitespace-nowrap">
                <th scope="col" class="py-3 px-6">
                    Id
                </th>
                <th scope="col" class="py-3 px-6">
                    Date
                </th>
                <th scope="col" class="py-3 px-6">
                    No. AWB
                </th>
                <th scope="col" class="py-3 px-6">
                    Origin
                </th>
                <th scope="col" class="py-3 px-6">
                    HUB
                </th>
                <th scope="col" class="py-3 px-6 ">
                    Courier / Shipper
                </th>
                <th scope="col" class="py-3 px-6">
                    Cnee
                </th>
                <th scope="col" class="py-3 px-6">
                    Cnee Addrs
                </th>
                <th scope="col" class="py-3 px-6">
                    Cnee Phone
                </th>
                <th scope="col" class="py-3 px-6">
                    Goods Desc
                </th>
                <th scope="col" class="py-3 px-6">
                    Code
                </th>
                <th scope="col" class="py-3 px-6">
                    Undel Desc
                </th>
                <th scope="col" class="py-3 px-6">
                    Date Inb
                </th>
                <th scope="col" class="py-3 px-6">
                    Cust id
                </th>
                <th scope="col" class="py-3 px-6">
                    Cust Name
                </th>
                <th scope="col" class="py-3 px-6">
                    SLA HOLD
                </th>
                <th scope="col" class="py-3 px-6">
                    Return Date
                </th>
                <th scope="col" class="py-3 px-6 bg-indigo-200">
                    Last Action Date
                </th>
                <th scope="col" class="py-3 px-6 bg-indigo-200">
                    Follow Up
                </th>
                <th scope="col" class="py-3 px-6 bg-indigo-200">
                    Last Action
                </th>
                <th scope="col" class="py-3 px-6 bg-indigo-200">
                    Note
                </th>
                <th scope="col" class="py-3 px-6 bg-indigo-200">
                    Status
                </th>


            </tr>
        </thead>
        <tbody>
            @foreach ($performances as $performance)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->id }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->date }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->no_awb }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $performance->origin }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $performance->hub }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $performance->shipper_name->nama }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->consignee }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $performance->consignee_addr }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->phone }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $performance->goods_desc }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $performance->undel_code }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $performance->undel_desc }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $performance->date_inbound }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $performance->customer_account->nomor_account }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->customer_account->customer_name }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->sla }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->date_return }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->date_return }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->date_return }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->date_return }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->date_return }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        {{ $performance->status == 1 ? ($performance->breach ? 'Breach' : 'CLosed') : 'Open' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
