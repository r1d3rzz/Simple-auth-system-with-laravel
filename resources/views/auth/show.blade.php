<x-layout>
    <x-slot name="title">
        Profile | {{$user->name}}
    </x-slot>


    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-md-9 col-lg-7 col-xl-5 mt-5">

            @if (session('success'))
            <div class="alert alert-primary text-center">{{session('success')}}</div>
            @endif

            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex text-black align-items-center">
                        @if ($user->profile)
                        <div class="flex-shrink-0">
                            <img src="{{asset('storage/'.$user->profile)}}" alt="Generic placeholder image"
                                class="img-fluid" style="width: 180px; border-radius: 10px;">
                        </div>
                        @endif
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">{{$user->name}}</h5>
                            <p class="mb-2 pb-1" style="color: #2b2a2a;">{{$user->email}}</p>
                            <div class="d-flex pt-1">
                                <form action="/users/{{$user->email}}/delete" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure delete your account?')" type="submit"
                                        class="btn btn-danger me-1 flex-grow-1">Delete</button>
                                </form>
                                <a href="/users/{{$user->username}}/edit" type="button"
                                    class="btn btn-outline-primary me-1 flex-grow-1">Edit</a>
                                <a href="/" type="button" class="btn btn-dark me-1 flex-grow-1">Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>