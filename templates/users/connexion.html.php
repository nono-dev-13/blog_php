<div class="container">
    <?php
    if(!empty($_SESSION['error'])) {
        echo '<div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        '. $_SESSION['error'] .'
                    </div>
            </div>';
        $_SESSION['error'] = "";
    }
    ?>
    <div class="row">
        <div class="col-12 col-lg-4 offset-lg-4">
            <main class="mt-5 mb-5">
                <form method="post">
                    <h1 class="h3 mb-3 fw-normal">Connexion</h1>
                    
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" name="email" placeholder="name@example.com">
                        <label for="floatingInput">Adresse email</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="pass" placeholder="Mot de passe">
                        <label for="floatingPassword">Mot de passe</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Me connecter</button>
                </form>
            </main>
        </div>
    </div>
</div>