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
                            <th scope="col">Applicant ID</th>
                            <th scope="col">Residence ID</th>
                            <th scope="col">Application Date</th>
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
                            <td><?= $sm['applicant_id']; ?></td>
                            <td><?= $sm['residence_id']; ?></td>
                            <td><?=  date('d F yy', $sm['applicationDate']); ?></td>
                            <td><?= $sm['requiredMonth']; ?></td>
                            <td><?= $sm['requiredYear']; ?></td>
                            <td><?= $sm['status']; ?></td>
                            <td><button data-toggle="modal" data-target="#accData" class="badge badge-pill badge-success">accept</button>
                            <a href="<?=base_url('admin/declineApp/'.$sm['application_id']);?>" class="badge badge-pill badge-danger">Decline</a>
                            <a href="<?=base_url('admin/waitlistApp/'.$sm['application_id']);?>" class="badge badge-pill badge-danger">Waitlist</a></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="accData" class="modal fade">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Set Date and Duration</h4>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?= base_url('admin/approveApp/'.$sm['application_id']); ?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
            <div class="form-group">
                <input type="date" class="form-control " id="fromDate" name="fromDate" placeholder="From Date">
            </div>
            <div class="form-group">
                <input type="date" class="form-control " id="endDate" name="endDate" placeholder="End Date">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " id="duration" name="duration" placeholder="Duration (Month)">
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
<!-- End of Main Content -->

       