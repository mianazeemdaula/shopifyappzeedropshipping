<div>
    <div class="h-screen flex justify-center items-center flex-col">
        @if ($error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $error }}</span>
            </div>
        @endif
        <div class=" mb-2">
            <img src="{{ asset('Logo.png') }}" alt="" srcset="" class="h-20">
        </div>
        <div class="p-8 rounded-lg bg-white">
            <div class="mb-2">
                <h1 class="text-lg font-bold">Login</h1>
                <h6 class="text-xs">use same ZeeDropshipping account to login</h6>
                <h6 class="text-sm">If you don't have account please create one by
                    <a href="https://zeedropshipping.com" target="_blank" rel="noopener noreferrer"
                        class="text-red-500">clicking here</a>
                </h6>
            </div>
            @if (session()->has('error'))
                <div class="text-sm text-red-500">{{ session('error') }}</div>
            @endif
            <form wire:submit="login">
                @csrf
                <div class="grid gap-4">
                    <div>
                        <input wire:model.debounce.100ms="email" type="text" name="email" placeholder="Email"
                            class="px-2 border rounded-md py-1 w-full">
                        @error('email')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input wire:model.debounce.100ms="password" type="password" name="password"
                            placeholder="Password" class="px-2 border rounded-md py-1 w-full">
                        @error('password')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($loading)
                        <button class="bg-gray-500 text-white rounded-md py-1 w-full" disabled>Loading...</button>
                    @else
                        <button wire:click="login"
                            class="px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-900">Login</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
