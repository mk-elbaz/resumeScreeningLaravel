@extends ('layout')

@section ('title')
<title>Manage Jobs </title>
@endsection


@section ('script')
<script src="assets/js/editCV.js"></script>
@endsection

@section ('body')

<div class="pagetitle">
    <h1>Manage Jobs</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Manage Jobs</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body pt-3">
        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Jobs
                    List</button>
            </li>
            <li class="nav-item">
                <button id="editCVButton" class="nav-link" data-bs-toggle="tab" data-bs-target="#add-job">Add Job</button>
            </li>

            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                    Password</button>
            </li>


        </ul>
        <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                @forelse ($jobs as $job)
                <div class="card">
                    <div class="card-body">
                        @if ($job->active == true)
                        <h5 class="card-title"> {{$job->jobTitle}} </h5>
                        @else
                        <h5 class="card-title"> {{$job->jobTitle}}
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-exclamation-triangle me-1"></i>Closed Job</span>
                        </h5>
                        @endif

                        <!-- Basic Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{$job->id}}">Details </button>
                        <a type="button" class="btn btn-secondary" href="/applicants-{{$job->id}}">Applicants </a>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-{{$job->id}}" data-bs-dismiss="modal">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{$job->id}}" data-bs-dismiss="modal">Delete</button>
                        @if ($job->active == true)
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#close-{{$job->id}}" data-bs-dismiss="modal">Close Job</button>
                        @endif



                    </div>
                    <!-- details modal  -->

                    <div class="modal fade" id="modal-{{$job->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                        <!-- end details modal  -->
                        <!-- delete modal  -->
                    </div>

                </div>
                <div class="modal fade" id="delete-{{$job->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete "{{$job->jobTitle}}"
                            </div>
                            <div class="modal-footer">
                                <form action="/deleteJob/{{$job->id}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Delete" data-bs-dismiss="modal"></input>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- end delete modal  -->
                <div class="modal fade" id="close-{{$job->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Close Job</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                Are you sure you want to close "{{$job->jobTitle}}" and reject all the remaining
                                applications?
                            </div>
                            <div class="modal-footer">
                                <form action="closeJob/{{$job->id}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Close Job" data-bs-dismiss="modal"></input>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="edit-{{$job->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit {{$job->jobTitle}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </div>
                            <div class="modal-body">
                                <form action="/editJob/{{$job->id}}" enctype="multipart/form-data" method="POST">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="jobTitle" class="col-md-4 col-lg-5 col-form-label">Job Title</label>
                                        <div class="col-md-12 col-lg-12">
                                            <input name="jobTitle" value="{{$job->jobTitle}}" type="text" class="form-control" id="jobTitle">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="jobDescription" class="col-md-4 col-lg-5 col-form-label">Job
                                            Description</label>
                                        <div class="col-md-12 col-lg-12">
                                            <textarea name="jobDescription" class="form-control" id="jobDescription" style="height: 100px">{{$job->jobDescription}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="jobResponsibilities" class="col-md-4 col-lg-5 col-form-label">Job
                                            Responsibilities</label>
                                        <div class="col-md-12 col-lg-12">
                                            <textarea name="jobResponsibilities" class="form-control" id="jobResponsibilities" style="height: 100px">{{$job->jobResponsibilities}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="jobQualifications" class="col-md-4 col-lg-5 col-form-label">Job
                                            Qualifications</label>
                                        <div class="col-md-12 col-lg-12">
                                            <textarea name="jobQualifications" class="form-control" id="jobQualifications" style="height: 100px">{{$job->jobQualifications}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="keywords" class="col-md-4 col-lg-5 col-form-label">Job
                                            Keywords</label>
                                        <div class="col-md-12 col-lg-12">
                                            <textarea name="keywords" class="form-control" id="keywords" style="height: 100px">{{$job->keywords}}</textarea>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary">Save Job</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </form><!-- End Profile Edit Form -->
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->

                </div>
                @empty
                <h1 class="card-title" style="text-align: center;">No jobs yet</h1>
                @endforelse
            </div>

            <div class="tab-pane fade add-job pt-3" id="add-job">

                <!-- Add Job Form -->
                <form action="/addJob" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label for="jobTitle" class="col-md-4 col-lg-3 col-form-label">Job Title</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="jobTitle" type="text" class="form-control" id="jobTitle">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jobDescription" class="col-md-4 col-lg-3 col-form-label">Job Description</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="jobDescription" class="form-control" id="jobDescription" style="height: 100px"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jobResponsibilities" class="col-md-4 col-lg-3 col-form-label">Job
                            Responsibilities</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="jobResponsibilities" class="form-control" id="jobResponsibilities" style="height: 100px"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jobQualifications" class="col-md-4 col-lg-3 col-form-label">Job
                            Qualifications</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="jobQualifications" class="form-control" id="jobQualifications" style="height: 100px"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="keywords" class="col-md-4 col-lg-3 col-form-label">Job
                            Keywords</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="keywords" class="form-control" id="keywords" style="height: 100px"></textarea>
                        </div>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add Job</button>
                    </div>
                </form><!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">


            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form>

                    <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                            Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="password" type="password" class="form-control" id="currentPassword">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                            Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form><!-- End Change Password Form -->
            </div>
        </div><!-- End Bordered Tabs -->

    </div>
</div>


@endsection