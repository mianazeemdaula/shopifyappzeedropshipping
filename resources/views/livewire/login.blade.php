<div>
    <div class="flex justify-center items-center h-screen">
        <div class="p-8 rounded-lg bg-white">
            <div class="mb-2">
                <h1 class="text-lg font-bold">Login</h1>
                <h6 class="text-sm">Zee Dropshipping Account</h6>
            </div>
            @if (session()->has('error'))
                <div class="text-sm text-red-500">{{ session('error') }}</div>
            @endif
            <form wire:submit.prevent="login" method="post">
                @csrf
                <div class="grid gap-4">
                    <div>
                        <input wire:model.debounce.100ms="email" type="text" name="email" placeholder="Email" class="px-2 border rounded-md py-1 w-full">
                        @error('email')<div class="text-sm text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <input wire:model.debounce.100ms="password" type="password" name="password" placeholder="Password" class="px-2 border rounded-md py-1 w-full">
                        @error('password')<div class="text-sm text-red-500">{{ $message }}</div> @enderror
                    </div>
                    @if($loading)
                        <button class="bg-gray-500 text-white rounded-md py-1 w-full" disabled>Loading...</button>
                    @else
                        <button type="submit" class="px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-900">Login</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
