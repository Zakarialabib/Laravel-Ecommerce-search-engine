<div class="py-12">
    <div class="max-w-12xl mx-auto lg:px-12">
        <div class="bg-white overflow-hidden shadow-xl lg:rounded-lg">
            <!-- <table> -->
            <table class="p-7">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ID</th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Name</th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Account ID</th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Compaign ID
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ads as $ad)
                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $ad[0]->id }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $ad[0]->name }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $ad[0]->account_id }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $ad[0]->campaign_id }}</td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $ad[0]->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>