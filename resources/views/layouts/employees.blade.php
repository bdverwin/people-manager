@extends('welcome')

@section('content')
<div>
    <table class="table table-light table-hover w-100">
        <thead class="table-dark">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Created</th>
                <th class="text-center">Last Updated</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>    
        <tbody id="employee-table-body">
            @foreach($employees as $employee)
            <tr>
                <td class="px-4 py-2 font-sm">{{$employee->id}}</td>
                <td class="px-4 py-2">{{$employee->name}}</td>
                <td class="px-4 py-2">{{$employee->email}}</td>
                <td class="px-4 py-2">{{$employee->created_at}}</td>
                <td class="px-4 py-2">{{$employee->updated_at}}</td>
                <td class="px-4 py-2">
                    <button class="p-1 btn btn-outline-secondary edit-btn" data-id="{{ $employee->id }}"><i class="bi bi-pen"></i></button>
                    <button class="p-1 btn btn-outline-secondary delete-employee" data-id="{{ $employee->id }}"><i class="bi bi-trash3"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <a href="/department" class="btn btn-secondary"><i class="bi bi-box-arrow-in-left"></i> Go Back</a>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newEmployee"><i class="bi bi-plus-square"></i> Add New</a>
    </div>

    <!-- New employee modal -->
    <div class="modal fade" id="newEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add new employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="new_employee" action="/employee" method="POST">
                        @csrf
                        <label class="d-block p-2">
                            Name:
                            <input type="text" name="name" class="form-control text-center mt-2" required>
                        </label>
                        <label class="d-block p-2">
                            Email:
                            <input type="email" name="email" class="form-control text-center mt-2" required>
                        </label>
                        <input type="hidden" name="department_id" value="{{ $id }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark" id="save-employee">Save changes</button>
                </div>
            </div>
        </div>
    </div>
        
</div>
@endsection