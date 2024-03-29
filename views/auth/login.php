<link rel="stylesheet" href="//<?= APP_URL ?>/css/auth.css">

<div class="container">

    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto my-5">

            <?= $alert ?>

            <div class="card card-signin">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form action="login/login" method="POST" class="form-signin">
                        <div class="form-label-group">
                            <input type="email" name="email" id="email" class="form-control" 
                                placeholder="Email address" required autofocus value="<?= $_GET['email'] ?? '' ?>">
                            <label for="email">Email address</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>

                        <!-- <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                        </div> -->

                        <button class="btn btn-lg btn-primary btn-block text-uppercase w-100" type="submit" name="loginUser">Sign in</button>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>