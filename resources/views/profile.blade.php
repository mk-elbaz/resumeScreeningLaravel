@extends ('layout')

@section ('title')
<title>Profile - {{ Auth::user()->name }}</title>
@endsection

@section ('script')
<script src="assets/js/editCV.js"></script>
@endsection

@section ('body')

<div class="pagetitle">
    <h1>View Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">View Profile</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body pt-3">
        @if (!Auth::user()->filled)
        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#add-resume">Add Resume</button>
            </li>
        </ul>
        <div class="tab-content pt-2">

            <div class="tab-pane fade show active add-resume" id="add-resume">
                <!-- Vertical Form -->

                <form action="/addProfile" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="inputEmail4" class="col-md-4 col-lg-3 col-form-label">Target Job</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" name="targetJob" class="form-control" id="inputEmail4">
                        </div>
                    </div>
                    <h1> </h1>

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Career Level</label>
                        <div class="col-md-8 col-lg-9">
                            <select name="careerLevel" class="form-select" aria-label="Default select example">
                                <option value="a">None</option>
                                <option value="Student/Internship">Student/Internship</option>
                                <option value="Entry Level">Entry Level</option>
                                <option value="Mid Career">Mid Career</option>
                                <option value="Management">Management</option>
                                <option value="Head">Head</option>
                                <option value="Senior Executive">Senior Executive</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputAddress" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" name="phoneNumber" class="form-control" id="inputAddress" placeholder="ex:+2011111111111">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputAddress" class="col-md-4 col-lg-3 col-form-label">Country</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="country" type="text" class="form-control" id="inputAddress" placeholder="">
                        </div>
                    </div>
                    <h1> </h1>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-md-4 col-lg-3 col-form-label">About You</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="about" class="form-control" style="height: 100px"> </textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="resumePdf" class="col-md-4 col-lg-3 col-form-label">Resume Upload</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="resumePdf" class="form-control" type="file" id="resumePdf">
                        </div>
                    </div>

                    <div class="text-center">
                        <button id="addResumeSubmit" type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
        @else
        <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>
            <li class="nav-item">
                <button id="editCVButton" data-careerlevel="{{ Auth::user()->resume->careerLevel }}" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>

            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                    Password</button>
            </li>


        </ul>
        <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">{{ Auth::user()->resume->about }}</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Target Job</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->resume->targetJob }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Career Level</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->resume->careerLevel }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->resume->country }}</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->resume->phoneNumber }}</div>
                </div>



            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="/editProfile" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="fullName" type="text" class="form-control" id="fullName" value="{{ Auth::user()->name }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="targetJob" class="col-md-4 col-lg-3 col-form-label">Target Job</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="targetJob" type="text" class="form-control" id="targetJob" value="{{ Auth::user()->resume->targetJob }}">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Career Level</label>
                        <div class="col-sm-9">
                            <select name="careerLevel" class="form-select" aria-label="Default select example">
                                <option value="None">None</option>
                                <option value="Student/Internship">Student/Internship</option>
                                <option value="Entry Level">Entry Level</option>
                                <option value="Mid Career">Mid Career</option>
                                <option value="Management">Management</option>
                                <option value="Head">Head</option>
                                <option value="Senior Executive">Senior Executive</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="about" class="form-control" id="about" style="height: 100px">{{ Auth::user()->resume->about }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phoneNumber" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="phoneNumber" type="text" class="form-control" id="phoneNumber" value="{{ Auth::user()->resume->phoneNumber }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="resumePdf" class="col-md-4 col-lg-3 col-form-label">Resume Change</label>
                        <div class="col-sm-9">
                            <input name="resumePdf" class="form-control" value="" type="file" id="resumePdf">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form><!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">


            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form>

                    <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
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
                {% endif %}
                @endif
            </div>
        </div><!-- End Bordered Tabs -->

    </div>
</div>

@endsection