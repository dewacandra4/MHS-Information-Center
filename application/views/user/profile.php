        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <?= $this->session->flashdata('message'); ?>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
          </div>
          <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                    <img src="<?=base_url('assets/img/').$user['image'];?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?=$user['name'];?> </h5>
                        <p class="card-text">Username      : <?=$user['username'];?></p>
                        <p class="card-text">Email Address      : <?=$applicant['email'];?></p>
                        <p class="card-text"> Monthly Income    : RM<?=$applicant['monthlyIncome'];?></p>
                        <p class="card-text"><small class="text-muted">Member since <?= date('d F yy', $user['date_created']);?></small></p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- End of Main Content -->
    </div>

