<section class="container">
    <h3>Ajouter des articles</h3>
    <div class="row">
        <?php
        if(!empty($_SESSION['error'])) {
            echo '<div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            '. $_SESSION['error'] .'
                        </div>
                   </div>';
            $_SESSION['error'] = "";
        }
        if(!empty($_SESSION['success'])) {
            echo '<div class="col-12">
                        <div class="alert alert-success" role="alert">
                            '. $_SESSION['success'] .'
                        </div>
                </div>';
            $_SESSION['success'] = "";
        }
        ?>
        <div class="col-12 col-lg-6 offset-lg-3">
            <form method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de l'article</label>
                    <input type="text" name="title" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="subtitle" class="form-label">Sous-titre de l'article</label>
                    <input type="text" name="subtitle" class="form-control" id="subtitle">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenu article</label>
                    <textarea name="content" class="form-control" rows="10" id="content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter un article</button>
            </form>
        </div>
    </div>
</section>
