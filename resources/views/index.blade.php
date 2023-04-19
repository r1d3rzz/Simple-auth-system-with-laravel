<x-layout>
    <x-slot name="title">
        Rider
    </x-slot>

    <div class="row text-white">
        @if (session('success'))
        <div class="alert alert-warning text-center">
            {{session('success')}}
        </div>
        @endif
        <div class="col-md">

            @auth
            <h3>Welcome {{auth()->user()->name}}</h3>
            <div class="d-flex align-items-center">
                <div class="me-1">
                    <form action="/users/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
                <div>
                    <a href="/users/create" class="btn btn-primary">Profile</a>
                </div>
            </div>
            @else
            <h3>Hello User</h3>
            <div>
                <a href="/users/login" class="btn btn-primary">Login</a>
                <a href="/users/create" class="btn btn-secondary">Sign Up</a>
            </div>
            @endauth
        </div>
    </div>

</x-layout>