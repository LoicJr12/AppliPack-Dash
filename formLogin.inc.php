<main>
    <div class="row container-fluid main-content">
        <div class="col-6 imageLogin">
            <img src="assets/imageLogin.jpg" class="img-fluid" alt="image login authentification" >
        </div>
        <div class="col-6">
            <div class="col authentification">
                <div class="auth-img">
                    <img src="assets/imageLogin2.jpg" alt="image login 2">
                </div>
                <div>
                <!-- Affichage des erreurs si elles existent -->
                <?php if ($codErreur == 1): ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-circle-exclamation fa-xl mr-1" style="color: #ff0000ff;"></i>
                        <div style="font-weight: bold;">
                            incorrect email or password
                        </div>
                    </div>
                <?php elseif($codErreur == 2): ?>
                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                        <i class="fa-solid fa-circle-exclamation fa-xl mr-1" style="color: #ff0000ff;"></i>
                        <div style="font-weight: bold;">
                            fill in form
                        </div>
                    </div>
                <?php endif; ?>
                </div>
                <form action="traitementLogin.php" method="POST" class="formulaire mb-5">
                    <div class="mb-3">
                        <h3 class="auth-text">AUTHENTIFICATION</h3>
                        <span class="text-body-secondary">Entrer vos détails de connexion</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="xxxxx@hotmail.com" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                        <div id="passwordHelpBlock" class="form-text">
                            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                        </div>
                    </div>
                    <div class="mb-3 text-link">
                        <p class="form-text">Forgot password? <a href="#" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Clic here !</a></p>
                    </div>
                    <div class="mb-3 buttons-form">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">reset</button>
                    </div>
                    <div class="text-link">
                        <p class="form-text">Do you have an account? <a href="register.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Sign up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>