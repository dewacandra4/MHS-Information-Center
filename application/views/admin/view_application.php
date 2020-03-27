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
                            <th scope="col">ApplicationID</th>
                            <th scope="col">ApplicantID</th>
                            <th scope="col">ResidenceID</th>
                            <th scope="col">ApplicationDate</th>
                            <th scope="col">RequiredMonth</th>
                            <th scope="col">RequiredYear</th>
                            <th scope="col">Status</th>


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
                            <td><?= $sm['applicationDate']; ?></td>
                            <td><?= $sm['requiredMonth']; ?></td>
                            <td><?= $sm['requiredYear']; ?></td>
                            <td><?= $sm['status']; ?></td>


                            <td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

       