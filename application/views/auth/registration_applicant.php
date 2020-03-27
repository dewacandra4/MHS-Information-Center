  <div class="container">
    <div class="card o-hidden border-0 shadow-lg mt-lg-5 col-lg-7 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post" action="<?= base_url('auth/registration_applicant');?>">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?=set_value('name');?>">
                    <?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?=set_value('username');?>">
                    <?= form_error('username','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group">
                  <input placeholder="Enter monthly income or 0 if not" type="number" id="monthlyIncome" name="monthlyIncome" class="form-control form-control-user pt-1 pb-1"  style="border-radius: 18px;" value="<?=set_value('monthlyIncome');?>">
                  <?= form_error('monthlyIncome','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?=set_value('email');?>">
                  <?= form_error('email','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                    <?= form_error('password1','<small class="text-danger pl-3">','</small>'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <h5>Already have an account ?</h5>
                <a class="medium" href="<?=base_url('auth/login');?>">Login here!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

