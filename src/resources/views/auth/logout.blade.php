<x-bigmom-auth::layout.base>
  <x-slot name="header">Log In</x-slot>

  <x-bigmom-auth::card class="pt-8">
  <form method="POST" action="{{ route('bigmom-auth.postLogout') }}">
    @csrf
    <button type="submit" class="my-2 px-4 py-2 bg-gray-300 rounded">Log out</button>
  </form>
  </x-bigmom-auth::card>
</x-bigmom-auth::layout.base>