<x-bigmom-auth::layout.main>
  <x-slot name="header">Manage Permissions</x-slot>
  <x-slot name="headerRightSide">
    <a href="{{ route('bigmom-auth.getHome') }}" class="bg-blue-600 hover:bg-blue-800 px-4 py-2 rounded text-white font-bold">Back</a>
  </x-slot>

  <x-bigmom-auth::card class="pt-8">
    <button data-micromodal-trigger="modal-create" class="bg-blue-600 hover:bg-blue-800 text-white font-bold rounded px-6 py-2 mb-6">Add</button>
    <table class="w-full">
      <thead>
        <tr>
          <x-bigmom-auth::table.th>User Identifier</x-bigmom-auth::table.th>
          <x-bigmom-auth::table.th>Model Class</x-bigmom-auth::table.th>
          <x-bigmom-auth::table.th>Permission Name</x-bigmom-auth::table.th>
          <x-bigmom-auth::table.th>Actions</x-bigmom-auth::table.th>
        </tr>
      </thead>
      <tbody>
        @foreach ($userPerms as $userPerm)
        <tr>
          <x-bigmom-auth::table.td>{{ $userPerm->user->{config('bigmom-auth.user-identifier')} }}</x-bigmom-auth::table.td>
          <x-bigmom-auth::table.td>{{ $userPerm->user_type }}</x-bigmom-auth::table.td>
          <x-bigmom-auth::table.td>{{ $userPerm->permission }}</x-bigmom-auth::table.td>
          <x-bigmom-auth::table.td><button data-micromodal-trigger="modal-delete" 
            onclick="document.getElementById('modal-delete-modal-id').value = {{ $userPerm->id }}"
            class="bg-red-600 hover:bg-red-800 px-4 py-2 text-white font-bold rounded"
            >Delete</button>
          </x-bigmom-auth::table.td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </x-bigmom-auth::card>

  @push('modal')
  <div id="modal-create" aria-hidden="true" class="modal fixed top-0 left-0 w-screen h-screen flex justify-center items-center">
    <div tabindex="-1" data-micromodal-close class="w-full h-full bg-gray-600 opacity-50 absolute top-0 left-0"></div>
    <div role="dialog" aria-modal="true" aria-labelled-by="modal-create-title" class="relative bg-white container max-h-3/4 z-30 rounded-lg px-8 py-8 overflow-auto">
      <header>
        <h2 id="modal-create-title" class="font-bold text-2xl text-blue-900">
          Add permission
        </h2>
      </header>
      <div id="modal-create-content" class="text-lg pt-4">
        <form action="{{ route('bigmom-auth.permission.postCreate') }}" method="POST">
          @csrf
          <label for="identifier">
            <p>Identifier (email/username. * to open permission to all users.)</p>
            <input id="identifier" type="text" name="identifier" value="{{ old('identifier') }}" required>
          </label>
          <label for="model">
            <p>Model class</p>
            <input id="model" type="text" name="model" value="{{ old('model', $defaultModel) }}" required>
          </label>
          <label for="permission">
            <p>Permission</p>
            <select id="permission" name="permission" required>
              <option>Select one</option>
              @foreach ($perms as $perm)
              <option value="{{ $perm }}">{{ $perm }}</option>
              @endforeach
            </select>
          </label>
          <div class="pt-4"><button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold rounded px-6 py-2">Add</button></div>
        </form>
      </div>
    </div>
  </div>
  <div id="modal-delete" aria-hidden="true" class="modal fixed top-0 left-0 w-screen h-screen flex justify-center items-center">
    <div tabindex="-1" data-micromodal-close class="w-full h-full bg-gray-600 opacity-50 absolute top-0 left-0"></div>
    <div role="dialog" aria-modal="true" aria-labelled-by="modal-delete-title" class="relative bg-white container max-h-3/4 z-30 rounded-lg px-8 py-8 overflow-auto">
      <header class="py-2">
        <h2 id="modal-delete-title" class="font-bold text-2xl text-blue-900">
          Delete permission
        </h2>
      </header>
      <div id="modal-delete-content">
        <form method="POST" action="{{ route('bigmom-auth.permission.postDelete') }}">
          @csrf
          Are you sure?
          <input id="modal-delete-modal-id" type="hidden" name="model_id">
          <div class="mt-4"><button type="submit" class="bg-red-600 hover:bg-red-800 px-4 py-2 text-white font-bold rounded">Delete</button></div>
        </form>
      </div>
    </div>
  </div>
  @endpush

  @push('script')
  <script src="{{ asset('vendor/bigmom-auth/js/micromodal.js') }}"></script>
  @endpush
</x-bigmom-auth::layout.main>