@extends('mc_core::layouts.master')

@section('content')
<div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">General</strong>
                </div>
                <div class="card-body">
                    <form action="{{ !empty($data) ? route('users.update', $data->id) : route('users.store') }}" method="post" novalidate="novalidate">
                        @if(!empty($data))
                        <input type="hidden" name="_method" value="PUT">
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-12"><label class=" form-control-label">Roles</label></div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    @php 
                                        $role_ids = $data->roles->map(function($it) {
                                            return $it->id;
                                        })->toArray();
                                    @endphp
                                    @if($roles->isNotEmpty())
                                        @foreach($roles as $role)
                                        <div class="checkbox">
                                            <label for="checkbox-{$role->id}" class="form-check-label ">
                                                <input type="checkbox" 
                                                    id="checkbox-{$role->id}" 
                                                    name="roles[]" 
                                                    value="{{ $role->id }}" 
                                                    class="form-check-input"
                                                    {{ in_array( $role->id, $role_ids) ? 'checked' : '' }}
                                                    >
                                                {!! $role->name !!}
                                            </label>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
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
                        <div class="form-group">
                            <label for="email" class="control-label mb-1">Email</label>
                            <input id="email" 
                                name="email" 
                                type="email" 
                                class="form-control" 
                                value="{{ old('email', $data->email ?? '') }}" 
                                data-val="true" 
                                data-val-required="Please enter email" 
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label mb-1">Password</label>
                            <input id="password" name="password" type="password" class="form-control" aria-required="true" aria-invalid="false" value="">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-lg btn-info btn-block">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection