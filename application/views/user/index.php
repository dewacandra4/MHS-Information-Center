        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
            </div>
          </div>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>
            <h1 class="h4 mb-5 text-gray-800 text-center">Wellcome to Applicant Dashboard, <?= $user['name'];?></h1>
            <div class="card-deck">
              <div class="card">
              <a>
                <div class="card-dash fadein text-center my-4"><i class="fa fa-home "></i></div>
              </a>
                <div class="card-body">
                  <h5 class="card-title text-center">Total Residences in MHS Information : <?= $total_residences ;?> </h5>
                  <p class="text-center">This is the total of residence available in the MHS Information Center.</p>
                  <p class="card-text"><small class="text-muted"> <br><br><?php echo date("Y-m-d") ;?> </small></p>
                </div>
              </div>
              <div class="card">
                <a>
                  <div class="card-dash fadein text-center my-4"><i class="fa fa-folder "></i></div>
                </a>
                <div class="card-body">
                  <h5 class="card-title text-center">Total Applications : <?= $total_applications ;?> </h5>
                  <p class="text-center">This is the total application submitted to the residence that you are applying for at the MHS Information Center.</p>
                  <p class="card-text"><small class="text-muted"> <br><br><?php echo date("Y-m-d") ;?> </small></p>
                </div>
              </div>
              <div class="card">
                <a>
                  <div class="card-dash fadein text-center my-4"><i class="fa fa-user-friends "></i></div>
                </a>
                <div class="card-body">
                  <h5 class="card-title text-center">Total User: <?= $total_user ;?> </h5>
                  <p class="text-center">This is the total number of users in the MHS Information Center including Housing Officer and Applicant.</p>
                  <p class="card-text"><small class="text-muted"> <br><br><?php echo date("Y-m-d") ;?> </small></p>
                </div>
              </div>
            </div>
        </div>
      <!-- End of Main Content -->
    </div>
