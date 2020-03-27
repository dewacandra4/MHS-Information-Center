        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">

                <?=  form_open_multipart('user/edit');?>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $applicant['email'];?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'];?>" >
                        <?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="monthlyIncome" class="col-sm-2 col-form-label">Monthly Income</label>
                        <div class="col-sm-10">
                        <input type="number" step="0.01" class="form-control" id="monthlyIncome" name="monthlyIncome" value="<?= $applicant['monthlyIncome'];?>" >
                        <?= form_error('monthlyIncome','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Picture</div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?=base_url('assets/img/').$user['image'];?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" >
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>

                        </div>
                </form>

                </div>
            </div>
            
        </div>
      <!-- End of Main Content -->
    </div>
