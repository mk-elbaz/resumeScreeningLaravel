@extends ('layout')

@section ('title')
<title>Dashboard - {{ Auth::user()->name }}</title>
@endsection

@section ('body')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<div class="col-lg-8">
    @if (Auth::user()->role === 'applicant')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">View Profile</h5>
            <a href="{{ route('profile') }}" type="button" class="btn btn-primary"><i class="bi bi-person-circle me-1"></i>View</a>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">See Applications</h5>
            <a href="{{ route('applications') }}" type="button" class="btn btn-primary"><i class="bi-card-checklist me-1"></i>View</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Apply to jobs</h5>
            <a href="{{ route('jobs') }}" type="button" class="btn btn-primary"><i class="bi bi-envelope-fill me-1"></i>View</a>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Manage Jobs</h5>
            <a href="{{ route('manageJobs') }}" type="button" class="btn btn-primary"><i class="bi-card-checklist me-1"></i>View</a>
        </div>
    </div>
    @endif
</div>


<section class="section dashboard">
    <div class="row">




    </div>
</section>
@endsection