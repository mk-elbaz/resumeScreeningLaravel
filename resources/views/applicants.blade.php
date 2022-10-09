@extends ('layout')

@section ('title')
<title>Applicants - {{$job->jobTitle}}</title>
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
            <li class="breadcrumb-item"><a href="{{ route('manageJobs') }}">Jobs</a></li>
            <li class="breadcrumb-item active">{{$job->jobTitle}}</li>
        </ol>
    </nav>
</div><!-- End Page Title -->


<div class="card">
    <div class="card-body pt-3">
        <div class="tab-pane fade show active profile-overview" id="profile-overview">

            @if ($applications->count() && $job->active == true )
            <div class="card w-full">
                <form method="POST" action="/rank-{{$job->id}}">
                    @csrf
                    <a type="button" href="/rank-{{$job->id}}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-primary w-100"><i class="bi bi-list-task me-sm-1 "></i>Rank</a>
                </form>
            </div>
            @endif
            @forelse ($applications as $app)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{$app->resume->user->name}}</h5>
                    <!-- Basic Modal -->
                    <div>
                        <span class="badge bg-info-light text-dark me-2"><i class="bi bi-info-square-fill me-1"></i>
                            {{$app->status}}</span><span class="badge bg-primary-light text-dark"><i class="bi bi-clipboard2-data me-1"></i>
                            {{$app->score}}</span>
                    </div>
                    <h1> </h1>
                    <div class="w-50">
                        <button type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#modal-{{$app->resume->id}}">Details</button>
                    </div>
                    <!-- details modal  -->

                    <div class="modal fade" id="modal-{{$app->resume->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="card-title">About</h5>
                                        <p class="small fst-italic">{{ $app->resume->about }}</p>

                                        <h5 class="card-title">Profile Details</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                            <div class="col-lg-9 col-md-8">{{ $app->resume->user->name }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Target Job</div>
                                            <div class="col-lg-9 col-md-8">{{ $app->resume->targetJob }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Career Level</div>
                                            <div class="col-lg-9 col-md-8">{{ $app->resume->careerLevel }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Country</div>
                                            <div class="col-lg-9 col-md-8">{{ $app->resume->country }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Phone</div>
                                            <div class="col-lg-9 col-md-8">{{ $app->resume->phoneNumber }}</div>
                                        </div>


                                    </div>
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
            <h1 class="card-title" style="text-align: center;">No applicants yet</h1>
            @endforelse
        </div>
    </div>
</div>

@endsection