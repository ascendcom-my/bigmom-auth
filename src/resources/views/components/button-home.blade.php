@if (\Bigmom\Auth\Facades\Permission::allows(Auth::guard('bigmom')->user(), 'auth-access'))
<a {{ $attributes->merge(['href' => route('bigmom-auth.getHome'), 'class' => "bg-blue-600 hover:bg-blue-800 text-white font-bold px-4 py-2 rounded"]) }}>{{ $slot }}</a>
@endif