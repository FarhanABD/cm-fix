@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        
        <h4 class="fw-bold py-3 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="text-muted me-2">
                <i class="bx bx-arrow-back"></i>
            </a>
            <span class="text-muted fw-light">Profile Settings /</span> Account
        </h4>
        

      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
            </li>
          </ul>
          <div class="card mb-4">
            <h5 class="card-header">Update Profile</h5>
            <!-- Account -->
            <form method="post" class="needs-validation" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
            <div class="card-body">
             
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <div class="mb-3">
                  <img height="100" width="100" src="{{asset(Auth::user()->image)}}" alt="" class="d-block rounded">
                </div>
                <label>Image</label>
                <!-- FETCH IMAGE FROM AUTH --->
                <input type="file" name="image" class="account-file-input" >
              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
             
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Name</label>
                    <input
                      class="form-control"
                      type="text"
                      name="name"
                      value="{{ Auth::user()->name }}"
                      autofocus
                    />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Username</label>
                    <input class="form-control" type="text" name="username" id="username" value="{{ Auth::user()->username }}" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">E-mail</label>
                    <input
                      class="form-control"
                      type="text"
                      id="email"
                      name="email"
                      value="{{ Auth::user()->email }}"
                      placeholder="john.doe@example.com"
                    />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Role</label>
                    <input
                      type="text"
                      class="form-control"
                      id="role"
                      name="role"
                      value="{{ Auth::user()->role }}"
                    />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Phone</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone"
                      name="phone"
                      value="{{ Auth::user()->phone }}"
                    />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ Auth::user()->status }}" />
                  </div>
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Save changes</button>
                  <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
              </form>
            </div>
            <!-- /Account -->
          </div>
          <div class="card">
            <h5 class="card-header">Update Password</h5>
            <form method="post" class="needs-validation" novalidate="" action="{{route('admin.password.update')}}" enctype="multipart/form-data">
                @csrf
            <div class="card-body">
              <div class="mb-3 col-12">
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Current Password</label>
                    <input class="form-control" type="password" name="current_pass" id="password" value="{{ Auth::user()->password }}" />
                  </div>
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">New Password</label>
                    <input class="form-control" type="password" name="password" id="password" />
                  </div>
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirm" id="password_confirm" />
                  </div>
                
              </div>
              
                <div class="form-check mb-3">
                 
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->

   

    <div class="content-backdrop fade"></div>
  </div>
@endsection
