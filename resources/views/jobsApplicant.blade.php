@extends ('layout')
@section ('title')
  <title>Job Opportunities</title>
  @endsection

@section ('body')

<div class="pagetitle">
    <h1>Job Opportunities</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Job Opportunities</li>
        </ol>
    </nav>
</div><!-- End Page Title -->


<div class="card">
    <div class="card-body pt-3">
        <div class="tab-pane fade show active profile-overview" id="profile-overview">

            @forelse ($jobs as $job)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $job->jobTitle }}</h5>

                    <!-- Basic Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal-{{$job->id}}">Details</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#apply-{{$job->id}}" data-bs-dismiss="modal">Apply</button>
                    <!-- details modal  -->

                    <div class="modal fade" id="modal-{{$job->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-lg-12 col-md-8 card-title">Description</div>
                                    <div class="col-lg-12 col-md-12">{{$job->jobDescription}}</div>
                                    <div class="col-lg-9 col-md-8 card-title">Responsibilities</div>
                                    <div class="col-lg-12 col-md-12">{{$job->jobResponsibilities}}</div>
                                    <div class="col-lg-9 col-md-8 card-title">Qualifications</div>
                                    <div class="col-lg-12 col-md-12">{{$job->jobQualifications}}</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                        <!-- end details modal  -->

                    </div>

                </div>
                <!-- apply modal  -->
                <div class="modal fade" id="apply-{{$job->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Apply</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                Are you sure you want to apply to "{{$job->jobTitle}}" position?
                            </div>
                            <div class="modal-footer">
                                <form action="apply/{{$job->id}}" enctype="multipart/form-data"
                                    method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-success" value="Apply"
                                        data-bs-dismiss="modal"></input>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                    <!-- end apply modal  -->

                </div><!-- End Basic Modal-->
            </div>
            @empty
            <h1 class="card-title" style="text-align: center;">No available opportunities yet, please check back later!</h1>
            @endforelse
        </div>
    </div>
</div>

@endsection