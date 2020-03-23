<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.min.css">
  <link href="<?= base_url('assets/'); ?>css\fontawesome-free\css\all.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style.css">
</head>
<body>
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><h1><span>MHS</span>Center</h1></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      </ul>
      <ul class="navbar-nav navbar-right">
        <li><a href="<?=base_url('auth/registration'); ?>" class="px-2 "><button type="button" class="btn btn-primary my-2"><i class="fas fa-door-open "></i> Register</button></a></li>
        <li><a href="<?=base_url('auth/login'); ?>" class="px-2"><button type="button" class="btn btn-primary my-2"><i class="fas fa-sign-in-alt"></i> Login</button></a></li>
        
      </ul>
    </div>
  </nav>
  <!-- Header -->
  
  <?= $this->session->flashdata('message'); ?>
  <div class="container mt-3">
    <div class="welcome">
      <h1>WELCOME TO <span>MHS</span> INFORMATION CENTER</h1>
    </div>
      <img src="<?= base_url('assets/'); ?>images/logo/logoMHS.png" >
  </div>
  <!-- End of Header -->
  <!-- Feature -->
  <div class="container">
    <h1 class="mb-4">Services</h1>
    <div class="responsive">
      <div class="gallery">
        <a>
            <div class="circle fadein">
              <i class="fa fa-home"></i>
            </div>
        </a>
          <h2>Setup residences</h2>
          <div class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</div>
      </div>
    </div>
    <div class="responsive">
      <div class="gallery ">
        <a>
            <div class="circle fadein">
              <i class="fa fa-folder"></i>
            </div>
        </a>
          <h2>Apply Residence</h2>
          <div class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
      </div>
    </div>
    <div class="responsive">
      <div class="gallery ">
        <a>
            <div class="circle fadein">
              <i class="fa fa-location-arrow"></i>
            </div>
        </a>
          <h2>Power Ranger</h2>
          <div class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</div>
      </div>
    </div>
    <div class="responsive">
      <div class="gallery ">
        <a>
          <div class="circle fadein">
            <i class="fa fa-comments"></i>
          </div>
        </a>
          <h2>Ultramen Realgood</h2>
          <div class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <!-- End of Features -->
  <div class="interest">
    <h2>Are you interested?</h2>
    <h3>Create your account now here !</h3>
    <button class="btn- btn-primary"><a href="#">Click Here!</a></button>
  </div>
  <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; MHSCenter 2020</span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->
  </footer>
  <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script> 
  <script src="<?= base_url('assets/'); ?>js/javascript.js"></script>
  <script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
</body>
</html>