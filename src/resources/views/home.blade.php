<x-bigmom-auth::layout.main>
  <x-slot name="header">Bigmom Home</x-slot>
  <ul>
    @foreach ($packages as $package)
    <li>
      <x-bigmom-auth::card class="pt-8">
        <h4 class="font-bold text-xl">{{ $package['name'] }}</h4>
        <p class="pb-4">{{ $package['description'] }}</p>
        <ul>
          @foreach ($package['routes'] as $route)
          @if ($route['can_access'] === true)
          <li><a href="{{ route($route['name']) }}" class="underline text-blue-700 hover:text-blue-900">{{ $route['title'] }}</a></li>
          @endif
          @endforeach
        </ul>
      </x-bigmom-auth::card>
    </li>
    @endforeach
  </ul>
</x-bigmom-auth::layout.main>