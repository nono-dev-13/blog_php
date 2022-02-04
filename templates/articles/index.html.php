<section class="container">
    <h1>Nos articles</h1>
    <div class="row">
        
        <?php foreach ($articles as $article) : ?>
            
            <article class="col-12 col-md-6 col-lg-4">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h2><?= $article->getTitle() ?></h2>
                        <small>Ecrit le <?= date('d-M-Y',strtotime($article->getCreatedAt())); ?></small>
                        <p><?= $article->getSubTitle() ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="index.php?page=article&id=<?= $article->getId() ?>" class="btn btn-primary">Lire la suite</a>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach ?>
    </div>
    
</section>
