<x-poll::button.colorless {{ $attributes->merge(['class' => 'bg-red-600 text-white font-bold hover:bg-red-800']) }}>
    {{ $slot }}
</x-poll::button.colorless>