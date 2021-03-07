<link rel="stylesheet" href="//<?= APP_URL ?>/css/auth.css">

<div class="container">

    <div class="row">

        <div class="col-lg-10 col-xl-9 mx-auto my-5">

            <?= $alert ?>

            <div class="card card-signin flex-row">

                <div class="card-body">
                    <h5 class="card-title text-center">Register</h5>
                    <form action="register/register" method="post" class="form-signin">

                        <div class="form-label-group">
                            <input type="text" name="username" id="username" class="form-control" 
                                placeholder="Username" required autofocus value="<?= $_GET['username'] ?? '' ?>">
                            <label for="username">Username</label>
                        </div>

                        <div class="form-label-group">
                            <input type="email" name="email" id="email" class="form-control" 
                                placeholder="Email address" required value="<?= $_GET['email'] ?? '' ?>">
                            <label for="email">Email address</label>
                        </div>

                        <hr>

                        <div class="form-label-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Password" required>
                            <label for="confirmpassword">Confirm password</label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="registerUser">Register</button>
                        <a class="d-block text-center mt-2 small" href="login">Sign In</a>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>