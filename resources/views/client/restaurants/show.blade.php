<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $restaurant->name }}
            </h2>
            <a href="{{ route('client.restaurants') }}" class="text-indigo-600 hover:text-indigo-700">
                {{ __('← Back to Restaurants') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Restaurant Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @if($restaurant->image)
                                <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}" class="w-full h-64 object-cover rounded-lg">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                                    <span class="text-gray-500">No image</span>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $restaurant->name }}</h1>
                            
                            <div class="space-y-3 text-gray-700">
                                <p><strong class="text-gray-900">Location:</strong> {{ $restaurant->location }}</p>
                                <p><strong class="text-gray-900">Cuisine Type:</strong> {{ $restaurant->cuisine_type }}</p>
                                <p><strong class="text-gray-900">Capacity:</strong> {{ $restaurant->capacity }} guests</p>
                                @if($restaurant->horaires)
                                    <p><strong class="text-gray-900">Hours:</strong> {{ $restaurant->horaires }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menus -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">{{ __('Menus') }}</h2>

                    @if($menus->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($menus as $menu)
                                <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden">
                                    @if($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-500">No image</span>
                                        </div>
                                    @endif
                                    
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $menu->name }}</h3>
                                        <p class="text-sm text-gray-600 mb-4">
                                            <strong>Items:</strong> {{ $menu->items()->count() }}
                                        </p>
                                        
                                        <a href="{{ route('client.menu.show', $menu->id) }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition-colors w-full text-center">
                                            {{ __('View Items') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">{{ __('No menus available for this restaurant.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
