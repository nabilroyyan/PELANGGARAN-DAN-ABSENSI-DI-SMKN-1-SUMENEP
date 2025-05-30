@extends('layout.MainLayout')


@section('content')

<div class="page-content">
  <div class="container-fluid">

      <!-- start page title -->
      <div class="row">
          <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                  <div class="page-title-right">
                      <ol class="breadcrumb m-0">
                          <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                      </ol>
                  </div>

              </div>
          </div>
      </div>
      <!-- end page title -->

      <div class="row">
          <div class="col-xl-4">
              <div class="card overflow-hidden">
                  <div class="bg-primary-subtle">
                      <div class="row">
                          <div class="col-7">
                              <div class="text-primary p-3">
                                  <h5 class="text-primary">Welcome Back !</h5>
                                  <p>Skote Dashboard</p>
                              </div>
                          </div>
                          <div class="col-5 align-self-end">
                              <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                          </div>
                      </div>
                  </div>
                  <div class="card-body pt-0">
                      <div class="row">
                          <div class="col-sm-4">
                              <div class="avatar-md profile-user-wid mb-4">
                                  <img src="assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                              </div>
                              {{-- <h5 class="font-size-15 text-truncate">Henry Price</h5>
                              <p class="text-muted mb-0 text-truncate">UI/UX Designer</p> --}}
                          </div>

                          <div class="col-sm-8">
                              <div class="pt-4">

                                  <div class="row">
                                      <div class="col-6">
                                          <h5 class="font-size-15">125</h5>
                                          <p class="text-muted mb-0">Projects</p>
                                      </div>
                                      <div class="col-6">
                                          <h5 class="font-size-15">$1245</h5>
                                          <p class="text-muted mb-0">Revenue</p>
                                      </div>
                                  </div>
                                  <div class="mt-4">
                                      <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-8">
            <div class="row">
              <div class="col-md-4">
                <div class="card mini-stats-wid">
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <p class="text-muted fw-medium">Siswa</p>
                        <!-- Tampilkan jumlah siswa -->
                      </div>
            
                      <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                          <span class="avatar-title">
                            <i class="bx bx-copy-alt font-size-24"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="card mini-stats-wid">
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <p class="text-muted fw-medium">Kelas</p>
                       <!-- Tampilkan jumlah siswa -->
                      </div>
            
                      <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                          <span class="avatar-title">
                            <i class="bx bx-copy-alt font-size-24"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
              <!-- end row -->

              <div class="card">
                  <div class="card-body">
                      <div class="d-sm-flex flex-wrap">
                          <h4 class="card-title mb-4">Prestasi</h4>
                          <div class="ms-auto">
                              <ul class="nav nav-pills">
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Week</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">Month</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link active" href="#">Year</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      
                      <div id="stacked-column-chart" class="apex-charts" data-colors='["--bs-primary", "--bs-warning", "--bs-success"]' dir="ltr"></div>
                  </div>
              </div>
          </div>
      </div>
      <!-- end row -->



  </div>
  <!-- container-fluid -->
</div>

@endsection