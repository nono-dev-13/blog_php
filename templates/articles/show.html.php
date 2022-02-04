
<section class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1><?= $article['title'] ?></h1>
        <?php if(isset($_SESSION['user'])): ?>
        <a href="index.php?page=edit-article&id=<?= $article['id'] ?>" class="btn btn-outline-primary">Modifier l'article</a>
        <?php endif; ?>
    </div>
    
    <p class="mb-3"><small class="text-muted">Ecrit le <?= date('d-M-Y',strtotime($article['created_at'])); ?></small></p>
    <h5><?= $article['sub_title'] ?></h5>
    <p><?= $article['content'] ?></p>
         
    <?php if (count($commentaires) === 0) : ?>
        <h5 class="mb-3">Il n'y a pas encore de commentaires pour cet article</h5>
    <?php else : ?>
        <h5>Il y a déjà <?= count($commentaires) ?> réactions : </h5>
        <?php foreach ($commentaires as $commentaire) : ?>
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-between">
                    <h5>Commentaire de <?= $commentaire->getAuthor() ?></h5>
                    <?php if(isset($_SESSION['user'])): ?>
                    <a href="index.php?page=delete-comment&id=<?= $commentaire->getId()?>" onclick="return window.confirm(`Êtes vous sûr de vouloir supprimer ce commentaire ?!`)">Supprimer</a>
                    <?php endif; ?>
                </div>
                <small>Le <?= $commentaire->getCreatedAtFr() ?></small>
                <blockquote>
                    <em><?= $commentaire->getContent() ?></em>
                </blockquote>
                <hr>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    
    

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
</section>
