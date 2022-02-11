<div class="container">
    <div class="row">
        <div class="col-12">
            <?php
                if(!empty($_SESSION['success'])) {
                    echo '
                        <div class="alert alert-success" role="alert">
                            '. $_SESSION['success'] .'
                        </div>';
                    $_SESSION['success'] = "";
                }
            ?>
        </div>
        <div class="col-12 mb-3">
            <h5>Bonjour <?= $_SESSION["user"]["pseudo"] ?> , bienvenue dans la partie administration du blog</h5>
        </div>
        <div class="col-12">
            <table class="table table-striped mb-3">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">title</th>
                        <th scope="col">created_at</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php foreach($articles as $article): ?>
                        <tr>
                            <th scope="row"><?php echo $article->getId() ?></th>
                            <td class="_title"><?php echo $article->getTitle() ?></td>
                            <td><?php echo date('d-M-Y',strtotime($article->getCreatedAt())); ?></td>
                            <td><a href="index.php?page=edit-article&id=<?= $article->getId() ?>"><i class="far fa-edit"></i></a></td>
                            <td><p style="cursor: pointer;" class="_modal" data-bs-toggle="modal" data-bs-target="#modalDelete" data-id="<?php echo ($article->getId()) ?>">
                                    <i class="far fa-trash-alt"></i>
                                </p>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <a href="index.php?page=add-article" class="btn btn-primary">Ajouter un article <i class="far fa-plus-square"></i></a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDelete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>êtes-vous sur de vouloir supprimer l'article <strong><span id="modalTitle"></span></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="index.php?page=delete-article&id=" class="btn btn-primary" id="idDelete">Oui je suis sur</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#tbody').on('click', '._modal', function(){
            $('#idDelete').attr('href','index.php?page=delete-article&id=' + $(this).attr('data-id'));
            $('#modalTitle').text($(this).parent().parent().find('._title').text());
            console.log($('#modalTitle'));
        });
    });
</script>