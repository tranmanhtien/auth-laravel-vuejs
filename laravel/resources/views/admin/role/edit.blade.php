@extends('admin.app')
@section('content')
    <main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>{{$breadcrumds['title']}}</h1>
                        @include('admin.layouts.breadcrumbs',['breadcrumds' => $breadcrumds,])
                    </div>

                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-4">Edit Role</h5>
                    <form action="{{route('admin.updateRole',['role' => $role->id])}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" name="id" value="{{ $role->id }}">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') ?? $role->name }}">
                            </div>
                            @if($errors->has('name'))
                                <div class="offset-sm-2 col-sm-10 text-danger mt-2">
                                    {{$errors->first('name')}}
                                </li>
                            @endif
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary mb-0">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
