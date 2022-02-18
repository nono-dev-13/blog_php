
<section class="container">
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
    <a href="index.php?page=home" class="btn btn-primary mb-3">Retour liste Article</a>
    
    <div class="d-flex align-items-center justify-content-between">
        <h1><?= $article->getTitle() ?></h1>
        <?php if(isset($_SESSION['user'])): ?>
            <?php if($_SESSION['user']['role'] == 2): ?>
                <a href="index.php?page=edit-article&id=<?= $article->getId() ?>" class="btn btn-outline-primary">Modifier l'article</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    
    <p class="mb-3"><small class="text-muted">Ecrit le <?= date('d-M-Y',strtotime($article->getCreatedAt())); ?></small></p>
    <h5><?= $article->getSubTitle() ?></h5>
    <p><?= $article->getContent() ?></p>
         
    <?php if (count($commentaires) === 0) : ?>
        <h5 class="mb-3">Il n'y a pas encore de commentaires pour cet article</h5>
    <?php else : ?>
        <?php foreach ($commentaires as $commentaire) : ?>
            <?php if($commentaire->getStatus() == ROLE_USER): ?>
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5>Commentaire de <?= $commentaire->getAuthor() ?></h5>
                        <?php if(isset($_SESSION['user'])): ?>
                            <?php if($_SESSION['user']['role'] == ROLE_ADMIN): ?>
                                <a href="index.php?page=delete-comment&id=<?= $commentaire->getId()?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                            <?php endif; ?>        
                        <?php endif; ?>
                    </div>
                    <small>Le <?= $commentaire->getCreatedAtFr() ?></small>
                    <blockquote>
                        <em><?= $commentaire->getContent() ?></em>
                    </blockquote>
                    <hr>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>
    
    
    <?php if(isset($_SESSION['user'])): ?>
        <form action="index.php?page=save-comment" method="POST">
            <h5 class="mb-3">Envoyez vos commentaires</h5>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="author" id="floatingInput" placeholder="Votre pseudo">
                <label for="floatingInput">Votre pseudo</label>
            </div>
            
            <div class="form-floating mb-3">
                <textarea class="form-control" name="content" placeholder="Votre commentaire" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">Votre commentaire</label>
            </div>
            <input type="hidden" name="article_id" value="<?= $article_id ?>">
            <button type="submit" class="btn btn-primary">Commenter !</button>
        </form>
    <?php else: ?>
        <div>
            <p>Pour commenter cet article vous devez être <a href="index.php?page=login">connecter</a></p>
        </div>
    <?php endif ?>

    
</section>
