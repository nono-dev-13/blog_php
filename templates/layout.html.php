<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e2e1e6b876.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Blog - <?= $pageTitle ?></title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
    <a class="navbar-brand" href="index.php?page=accueil">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if(!isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=home">Les articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=register">S'inscrire</a>
                    </li>
                <?php else: ?>
                    <?php if($_SESSION['user']['role'] == 2): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=management">Gestion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=logout">Se déconnecter</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=logout">Se déconnecter</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
    
<?= $pageContent ?>
    
<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="index.php?page=accueil" class="nav-link px-2 text-muted">Accueil</a></li>
            <li class="nav-item"><a href="index.php?page=home" class="nav-link px-2 text-muted">Liste des articles</a></li>
        </ul>
        <p class="text-center text-muted">2022 Arnaud BOUBLI</p>
    </footer>
</div>
</body>

</html>