@extends ('layout')

@section ('title')
<title>Applications </title>
@endsection

@section ('script')
<script src="assets/js/editCV.js"></script>
@endsection

@section ('body')

<div class="pagetitle">
    <h1>Applications</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Applications</li>
        </ol>
    </nav>
</div><!-- End Page Title -->


<div class="card">
    <div class="card-body pt-3">
        <div class="tab-pane fade show active profile-overview" id="profile-overview">

            @forelse (Auth::user()->resume->applications as $application)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{$application->job->jobTitle}}</h5>

                    <!-- Basic Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{$application->id}}">Details</button>
                    <!-- details modal  -->

                    <div class="modal fade" id="modal-{{$application->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    Current status: {{$application->status}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                        <!-- end details modal  -->

                    </div>

                </div>

            </div>
            @empty
            <h1 class="card-title" style="text-align: center;">You haven't applied to any jobs yet</h1>
            @endforelse
        </div>
    </div>
</div>

@endsection