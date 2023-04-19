<x-layout>
    <x-slot name="title">
        User Create
    </x-slot>

    <div class="row">
        <div class="col-md-5 mx-auto mt-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="fs-3">Register</div>
                    <div><a href="/" class="btn btn-sm btn-danger">Home</a></div>
                </div>

                <div class="card-body">
                    <form action="/users/store" method="POST">

                        @csrf

                        <x-form.input name="name" />
                        <x-form.input name="username" />
                        <x-form.input name="email" type="email" />
                        <x-form.input name="password" type="password" />

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>