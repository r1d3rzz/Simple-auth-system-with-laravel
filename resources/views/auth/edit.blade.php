<x-layout>
    <x-slot name="title">
        User Edit
    </x-slot>

    <div class="row">
        <div class="col-md-5 mx-auto mt-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="">
                        <div class="fs-3">Edit Profile</div>
                        <div>
                            <small class="text-muted">Logged as {{$user->email}}</small>
                        </div>
                    </div>
                    <div><a href="/users/profile" class="btn btn-sm btn-danger">Back</a></div>
                </div>

                <div class="card-body">
                    <form action="/users/{{$user->email}}/update" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                        <x-form.input name="name" value="{{$user->name}}" />
                        <x-form.input name="username" value="{{$user->username}}" />
                        <x-form.input name="profile" type="file" isShow=true />

                        @if ($user->profile)
                        <div class="my-2 bg-dark rounded d-flex align-items-center">
                            <div>
                                <img class="rounded" src="{{asset('storage/'.$user->profile)}}" width="150" alt="">
                            </div>
                            <div class="ms-3 text-white user-select-none">
                                <input type="checkbox" name="deleteOldPic" class="form-check-input" id="deleteOldPic">
                                <label for="deleteOldPic">Remove Profile</label>
                            </div>
                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>