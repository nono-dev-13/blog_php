<div class="container">
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
            <form id="form" enctype="multipart/form-data" method="post">
                <h3>Contactez moi</h3>

                <div class="form-floating mb-3">
                    <input class="form-control" type="text" id="name" name="name" placeholder="Nom"/>
                    <label for="name">Nom: <span>*</span></label>
                </div>


                <div class="form-floating mb-3">
                    <input class="form-control" type="text" id="email" name="email" placeholder="Email"/>
                    <label for="email">Email: <span>*</span></label><span id="info" class="info"></span>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="text" id="subject" name="subject" placeholder="Demande de renseignement"/>
                    <label for="subject">Sujet: <span>*</span></label>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" id="message" name="message" placeholder="Message..."></textarea>
                    <label for="message">Message:</label>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>    
</div>

