@extends('mc_core::layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ !empty($data) ? route('roles.update', $data->id) : route('roles.store') }}" method="post" novalidate="novalidate">
            @if(!empty($data))
            <input type="hidden" name="_method" value="PUT">
            @endif
            @csrf
            <div class="default-tab">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Permission</a>
                    </div>
                </nav>
                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="animated fadeIn">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-success">
                                    <label for="name" class="control-label mb-1">Name</label>
                                    <input id="name"
                                        name="name"
                                        type="text"
                                        class="form-control"
                                        value="{{ old('name', $data->name ?? '') }}"
                                        autocomplete="off"
                                        aria-required="true"
                                        aria-invalid="false">
                                    <span class="help-block field-validation-valid" data-valmsg-for="name" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    @php
                                        $permission_ids = [];
                                        $permission_ids = !empty($data) ? $data->permissions->map(function ($it) {
                                            return $it->id;
                                        })->toArray() : [];
                                    @endphp
                                    @if($permissions->isNotEmpty())
                                        @foreach($permissions as $permission)
                                        <div class="checkbox">
                                            <label for="checkbox-{$role->id}" class="form-check-label ">
                                                <input type="checkbox"
                                                    id="checkbox-{$role->id}"
                                                    name="permissions[]"
                                                    value="{{ $permission->id }}"
                                                    class="form-check-input"
                                                    {{ in_array($permission->id, $permission_ids) ? 'checked' : '' }}
                                                    >
                                                {!! $permission->name !!}
                                            </label>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-lg btn-info btn-block">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
