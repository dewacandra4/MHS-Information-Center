        <!-- Begin Page Content -->
        <div class="container-fluid ">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

        <div class="row">
            <div class="col-lg">
                <?php if (validation_errors()) : ?>
                <div class="alert alert-danger text-center alert-dismissible fade show" role="alert"><?= validation_errors(); ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>                
                <?php endif; ?>

                <?= $this->session->flashdata('message');?>


                <table class="table table-responsive-lg table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Application ID</th>
                            <th scope="col">Residence ID</th>
                            <th scope="col">Num Of Unit Available</th>
                            <th scope="col">Monthly Rental</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Monthly Income</th>
                            <th scope="col">Req Month</th>
                            <th scope="col">Req Year</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($application as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $sm['application_id']; ?></td>
                            <td><?= $sm['residence_id']; ?></td>
                            <td><?= $sm['numunits']; ?></td>
                            <td><?= $sm['monthly_rental']; ?></td>
                            <td><?= $sm['username']; ?></td>
                            <td><?= $sm['monthlyIncome']; ?></td>
                            <td><?= $sm['requiredMonth']; ?></td>
                            <td><?= $sm['requiredYear']; ?></td>
                            <td><?= $sm['status']; ?></td>
                            <td>
                            <a 
                                href="javascript:;"
                                data-application_id="<?php echo $sm['application_id'] ?>"
                                data-residence-id= "<?php echo $sm['residence_id'] ?>"
                                data-toggle="modal" data-target="#acc-data">    
                            <button data-toggle="modal" data-target="#ubah-data" class="badge badge-pill badge-success">Accept</button>

                            <a href="<?=base_url('admin/declineApp/'.$sm['application_id']);?>" class="badge badge-pill badge-danger">Decline</a>
                            <a href="<?=base_url('admin/waitlistApp/'.$sm['application_id']);?>" class="badge badge-pill badge-warning">Waitlist</a></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
            
        </div>
        </div>
    <!-- /.container-fluid -->


</div>
        <?php foreach($application as $i):
             $application_id = $i['application_id'];
             $residence_id = $i['residence_id'];
             $numunits = $i['numunits'];
             $monthly_rental = $i['monthly_rental'];
             $username = $i['username'];
             $monthlyIncome = $i['monthlyIncome'];
             $requiredMonth=$i['requiredMonth'];
             $requiredYear=$i['requiredYear'];
             $status = $i['status'];
            ?>
            <div class="modal fade" id="acc-data" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newSubMenuModalLabel">Allocate Housing</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form-horizontal" action="<?= base_url('admin/approveApp/');?>" method="post" enctype="multipart/form-data" role="form">
                        <div class="modal-body">
                        <label for="fromDate">From Date: </label><br>
                        <div class="form-group">
                            <input type="hidden" id="application_id" name="application_id">
                            <input type="hidden" id="residence_id" name="residence_id">
                            
                            <input type="date" class="form-control " id="fromDate" name="fromDate" placeholder="From Date" min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <label for="duration">Duration: </label><br>
                        <div class="form-group">
                            <input type="radio"  id="duration" name="duration" value="18"> 18 Month &nbsp;&nbsp;
                            <input type="radio"  id="duration" name="duration" value="12"> 12 Month
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Approve</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <!-- End of Main Content -->
    
    <!-- Modal -->
<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#acc-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)
 
            // Isi nilai pada field
            modal.find('#application_id').attr("value",div.data('application_id'));
            modal.find('#residence_id').attr("value",div.data('residence_id'));

        });
    });
</script>

   