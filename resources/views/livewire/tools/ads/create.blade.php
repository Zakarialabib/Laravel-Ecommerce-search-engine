<div>
    <div class="my-4">
        <div class="mx-auto block p-6 max-w-lg my-4 bg-white rounded-xl border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mtext-2xl font-bold tracking-tight text-gray-900 px-3 mb-4">{{__('Create :adsType', ['adsType' => $adsType->type_name])}}</h5>

            <div class="w-full px-3 pb-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    *{{__('Package Type')}}
                </label>
                <select wire:model="ads_package_id" id="paket_view" class="w-full border rounded p-2">
                    <option value="">{{__('Select Package Type')}}</option>
                    @foreach($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full px-3 pb-4">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    *{{__('Title')}}
                </label>
                <input wire:model="ads_title" class="w-full border rounded p-2" id="grid-password" type="text" placeholder="">
                <p class="text-gray-600 text-xs italic">{{__('Enter the Ad title')}}</p>
            </div>

            <div class="w-full px-3 pb-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                    {{__('Create Ad')}}
                </button>
            </div>
        </div>
    </div>
</div>