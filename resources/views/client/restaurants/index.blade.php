<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($restaurants->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($restaurants as $restaurant)
                                <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden">
                                    @if($restaurant->image)
                                        <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-500">No image</span>
                                        </div>
                                    @endif
                                    
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $restaurant->name }}</h3>
                                        
                                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                                            <p><strong>Location:</strong> {{ $restaurant->location }}</p>
                                            <p><strong>Cuisine:</strong> {{ $restaurant->cuisine_type }}</p>
                                            <p><strong>Capacity:</strong> {{ $restaurant->capacity }} guests</p>
                                            @if($restaurant->horaires)
                                                <p><strong>Hours:</strong> {{ $restaurant->horaires }}</p>
                                            @endif
                                        </div>

                                        <a href="{{ route('client.restaurant.show', $restaurant->id) }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition-colors">
                                            {{ __('View Menus') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">{{ __('No restaurants available at the moment.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
