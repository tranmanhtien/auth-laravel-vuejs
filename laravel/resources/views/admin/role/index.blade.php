@extends('admin.app')
@section('content')
    <main>
        @include('admin.alert.alert-message')
        @include('admin.alert.alert-errors')
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1><a href="{{ route('admin.role.index') }}">{{$breadcrumds['title']}}</a></h1>
                        <div class="top-right-button-container">
                            <a href="{{route('admin.role.create')}}"
                               class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</a>
                            <div class="btn-group">
                                <div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
                                    <label class="custom-control custom-checkbox mb-0 d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </div>
                                <button type="button"
                                        class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" id="deleteRole">Delete</button>
                                </div>
                            </div>
                        </div>
                        @include('admin.layouts.breadcrumbs',['breadcrumds' => $breadcrumds,])
                    </div>

                    <div class="mb-2">
                        <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                           role="button" aria-expanded="true" aria-controls="displayOptions">
                            Display Options
                            <i class="simple-icon-arrow-down align-middle"></i>
                        </a>
                        <div class="collapse dont-collapse-sm" id="displayOptions">
                            <div class="d-block d-md-inline-block">
                                <form id="formSearch" action="{{ route('admin.role.index') }}" method="GET">
                                    <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                        <input id="inputSearch" name="search" placeholder="Search..." value="{{ $_GET['search'] ?? '' }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 list" data-check-all="checkAll">
                    @foreach($roles as $item)
                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                                <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                    <a class="list-item-heading mb-0 truncate w-40 w-xs-100"
                                       href="{{ route('admin.role.update',['role' => $item->id]) }}">
                                        {{$item->name}}
                                    </a>
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">{{$item->guard_name}}</p>
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">{{$item->created_at}}</p>
                                </div>
                                <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                    @include('admin.layouts.pagination', ['paginator' => $roles->withQueryString()])
                </div>
            </div>
        </div>
    </main>
@endsection
@push('script')
    <script>
        $('#deleteRole').on('click', function () {
        });
    </script>
@endpush
