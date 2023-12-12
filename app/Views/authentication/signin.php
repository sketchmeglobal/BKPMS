<?= view('component/login_header') ?>
<style>
    #login_form .error { color: red !important; position: relative;}
    #login_form label.error {padding:7px;}
</style>
</head>

<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-5 p-0">
                            <div class="card-body text-center" style="background-image: url('http://sketchmeglobal.com/demo-baazarkolkata-pms/dist/assets/img/banner.png');background-repeat: no-repeat;background-size: cover;padding: 0;background-position: center;"></div>
                        </div>
                        <div class="card col-md-7 bg-white">
                            <div class="p-3">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <h5>Login to Account</h5>
                                </div>

                                <?php if (session()->getFlashdata('msg')) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                                <?php endif; ?>
                                
                                <form id="login_form" method="post">
        
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput"
                                            placeholder="name@example.com" name="email" required
                                            value="<?=isset($email) ? $email : ''?>">
                                        <label for="floatingInput">Email address</label>
                                        <span class="error"><?= (isset($validation) ? $validation['email'] : ''); ?></span>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <!-- min="8" -->
                                        <input minlength="8" type="password" class="form-control" id="floatingPassword"
                                            placeholder="Password" name="password" required
                                            value="<?=isset($pass) ? $pass : ''?>">
                                        <label for="floatingPassword">Password</label>
                                        <span class="error"><?= (isset($validation) ? $validation['password'] : ''); ?></span>
                                    </div>
        
                                    <div class="row">
                                      <div class="col-6">
                                        <input class="btn btn-primary" type="submit" value="Sign In" name="submit">
                                      </div>
                                      <div class="col-6 text-end">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-link px-0" type="button">Forgot password?</a>
                                      </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>
    
    <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                <button class="btn btn-outline-secondary btn-secondary text-white" type="button">Email ID</button>
                <!--<ul class="dropdown-menu">-->
                <!--  <li><a class="dropdown-item">Email ID</a></li>-->
                <!--  <li><hr class="dropdown-divider"></li>-->
                <!--  <li class=""><a class="dropdown-item">Mobile Number</a></li>-->
                <!--</ul>-->
                <input type="text" class="form-control" aria-label="Text input with dropdown button">
                <input type="submit" class="btn btn-warning" value="Send Code">
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" aria-label="Text input with dropdown button">
                <a href="forget-password.html" class="btn btn-success">Validate</a>
              </div>              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <!-- JavaScript Libraries -->
    <?= view('component/login_js') ?>
    <script>
    $("#login_form").validate();
    </script>
</body>

</html>