@extends('admin.layouts.admin')

@section('title', 'Roles & Permissions')

@section('content_header')
    <h1>Manage Role Permissions</h1>
@endsection

@section('content')
    @foreach($roles as $role)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ ucfirst($role->name) }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.roles.update-permissions', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="checkbox"
                                           class="form-check-input"
                                           name="permissions[]"
                                           value="{{ $permission->name }}"
                                           id="{{ $role->id }}_{{ $permission->name }}"
                                            {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                           for="{{ $role->id }}_{{ $permission->name }}">
                                        {{ str_replace('_', ' ', ucfirst($permission->name)) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save me-1"></i> Update Permissions
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
