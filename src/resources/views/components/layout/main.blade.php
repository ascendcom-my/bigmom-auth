<x-bigmom-auth::layout.base>
  <x-slot name="header">{{ $header }}</x-slot>
  <x-slot name="headerRightSide">
    <form action="{{ route('bigmom-auth.postLogout') }}" method="POST">
      @csrf
      {{ $headerRightSide ?? '' }}
      <button type="submit" class="bg-gray-200 hover:bg-gray-500 text-black font-bold rounded px-4 py-2">Log Out</button>
    </form>
  </x-slot>
  {{ $slot }}
</x-bigmom-auth::layout.base>