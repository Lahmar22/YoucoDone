<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $menu->name }}
            </h2>
            <a href="{{ route('client.restaurant.show', $menu->restaurant_id) }}" class="text-indigo-600 hover:text-indigo-700">
                {{ __('← Back to Restaurant') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Menu Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full md:w-1/2 h-64 object-cover rounded-lg mb-4">
                    @else
                        <div class="w-full md:w-1/2 h-64 bg-gray-200 flex items-center justify-center rounded-lg mb-4">
                            <span class="text-gray-500">No image</span>
                        </div>
                    @endif
                    <h1 class="text-3xl font-bold text-gray-900">{{ $menu->name }}</h1>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">{{ __('Items') }}</h2>

                    @if($items->count() > 0)
                        <div class="space-y-4">
                            @foreach($items as $item)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $item->name }}</h3>
                                            @if($item->description)
                                                <p class="text-gray-600 text-sm mt-1">{{ $item->description }}</p>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-xl font-bold text-indigo-600">
                                                ${{ number_format($item->price, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">{{ __('No items in this menu.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
