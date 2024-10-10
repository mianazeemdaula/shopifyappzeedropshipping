<div>
    <div class="h-screen flex justify-center items-center flex-col">
        <div class=" mb-2">
            <img src="{{ asset('Logo.png') }}" alt="" srcset="" class="h-16">
        </div>
        <div class="p-8 rounded-lg bg-white w-4/12">
            <div class="mb-2 ">
                <h1 class="text-sm font-bold my-3 text-center">Welcome,
                    {{ $data->user ?? 'N/A' }}
                </h1>
                <h1 class="text-sm font-semibold my-3 text-center">{{ $user->name ?? 'N/A' }}
                </h1>
                <div class="grid gap-4 grid-cols-2 ">
                    @foreach ($data as $key => $item)
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <div class="text-center flex items-center justify-between">
                                <div>
                                    <h1 class="text-base font-semibold uppercase text-red-500">{{ $key }}
                                    </h1>
                                </div>
                                <div class="my-4">
                                    <h1 class="text-base font-bold">{{ $item }}</h1>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <button wire:click="logout"
                    class="w-full px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-900">Logout</button>
            </div>
        </div>
    </div>
