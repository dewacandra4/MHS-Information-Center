        <!-- Begin Page Content -->
        <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

        <div class="row">
            <div class="col-lg">
                <?php if (validation_errors()) : ?>
                <div class="alert alert-danger text-center alert-dismissible fade show" role="alert"><?= validation_errors(); ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>                
                <?php endif; ?>

                <?= $this->session->flashdata('message');?>


                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">residenceID</th>
                            <th scope="col">Address</th>
                            <th scope="col">Number Of Unit</th>
                            <th scope="col">Size Per Unit(m2)</th>
                            <th scope="col">Monthly Rental(RM)</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($residences as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $sm['residence_id']; ?></td>
                            <td><?= $sm['address']; ?></td>
                            <td><?= $sm['numUnits']; ?></td>
                            <td><?= $sm['sizePerUnit']; ?></td>
                            <td><?= $sm['monthlyRental']; ?></td>
                            <td>
                            <a 
                                href="javascript:;"
                                data-id="<?php echo $sm['residence_id'] ?>"
                                data-address="<?php echo $sm['address'] ?>"
                                data-numUnits="<?php echo $sm['numUnits'] ?>"
                                data-sizePerUnit="<?php echo $sm['sizePerUnit'] ?>"
                                data-toggle="modal" data-target="#apply-data">
                                <button data-toggle="modal" data-target="#apply-data" class="badge badge-pill badge-success">Apply</button>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Modal -->
      <!-- Button trigger modal -->

    <!-- Modal Apply -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="apply-data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Apply for the Residence</h4>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('user/applyResidence')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
            <div class="form-group">
                <input type="hidden" id="residence_id" name="residence_id">
                <input type="text" class="form-control " id="requiredMonth" name="requiredMonth" placeholder="Required Month">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " id="requiredYear" name="requiredYear" placeholder="Required Year">
            </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" type="submit"> Save&nbsp;</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"> Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal Ubah -->
<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#apply-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)
 
            // Isi nilai pada field
            modal.find('#residence_id').attr("value",div.data('residence_id'));
            modal.find('#requiredMonth').attr("value",div.data('requiredMonth'));
            modal.find('#requiredYear').attr("value",div.data('requiredYear'));
        });
    });
</script>