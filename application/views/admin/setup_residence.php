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

                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add Residence</a>

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
                                data-residence_id="<?php echo $sm['residence_id'] ?>"
                                data-address="<?php echo $sm['address'] ?>"
                                data-numUnits="<?php echo $sm['numUnits'] ?>"
                                data-sizePerUnit="<?php echo $sm['sizePerUnit'] ?>"
                                data-toggle="modal" data-target="#edit-data">

                                <button data-toggle="modal" data-target="#ubah-data" class="badge badge-pill badge-success">Edit</button>

                                <a href="<?=base_url('admin/hapusS/'.$sm['residence_id']);?>" class="badge badge-pill badge-danger">Delete</a>
                            </td>
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

    <!-- Modal Add Residence-->
    <div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="newSubMenuModalLabel">Add Residence</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="<?= base_url('admin/addResidence'); ?>" method="post">
            <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control " id="address" name="address" placeholder="Address">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " id="numUnits" name="numUnits" placeholder="Number Of Unit">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " id="sizePerUnit" name="sizePerUnit" placeholder="Size Per Unit">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " id="monthlyRental" name="monthlyRental" placeholder="Monthly Rental">
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-primary">Add</button>
            </div>
        </form>
        </div>
    </div>
    </div>
    <!-- Modal Edit -->
    <?php 
        foreach($residences as $i):
            $residence_id=$i['residence_id'];
            $address=$i['address'];
            $numUnits=$i['numUnits'];
            $sizePerUnit=$i['sizePerUnit'];
            $monthlyRental=$i['monthlyRental'];
        ?>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Residence</h4>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('admin/ubahResidence')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
            <div class="form-group">
                <input type="hidden" id="residence_id" name="residence_id">
                <input type="text" class="form-control " id="address" name="address" placeholder="Address" value="<?php echo $address;?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " id="numUnits" name="numUnits" placeholder="Number Of Unit" value="<?php echo $numUnits;?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " id="sizePerUnit" name="sizePerUnit" placeholder="Size Per Unit" value="<?php echo $sizePerUnit;?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control " id="monthlyRental" name="monthlyRental" placeholder="Monthly Rental" value="<?php echo $monthlyRental;?>">
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
<?php endforeach;?>
<!-- END Modal edit -->
<script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js');?>"></script>
<script>
    $(document).ready(function() {
        // Untuk sunting
        $('#edit-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)
 
            // Isi nilai pada field
            modal.find('#residence_id').attr("value",div.data('residence_id'));
            modal.find('#address').attr("value",div.data('address'));
            modal.find('#numUnits').attr("value",div.data('numUnits'));
            modal.find('#sizePerUnit').attr("value",div.data('sizePerUnit'));
            modal.find('#monthlyRental').attr("value",div.data('monthlyRental'));  
        });
    });
</script>