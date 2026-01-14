@extends('welcome')

@section('content')
<div class="container">
    <h2 class="mb-4 text-light text-center">Departments</h2>

    <div class="row g-3">
        @foreach($departments as $department)
            <div class="col-12 col-md-6 col-lg-4">
                <a href="/employee/department/{{$department->id}}" class="text-decoration-none">
                    <div class="card bg-dark text-light shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">{{ $department->name }}</span>
                            <i class="bi bi-chevron-right text-secondary"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
