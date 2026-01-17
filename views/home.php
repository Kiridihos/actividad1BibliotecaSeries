<?php
require_once __DIR__ . '/../templates/header.php';
?>
<section class="container centered-content">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <a href="/../index.php?entity=series&action=index">
                    <div class="card">
                        <img class="card-img-top" src="./views/imgs/video-player.png" alt="Series">
                        <div class="card-body">
                            <h2 class="card-title">
                                Series
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/../index.php?entity=actors&action=index">
                    <div class="card">
                        <img class="card-img-top" src="./views/imgs/actor.png" alt="Actores">
                        <div class="card-body">
                            <h2 class="card-title">
                                Actores
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/../index.php?entity=directors&action=index">
                    <div class="card">
                        <img class="card-img-top" src="./views/imgs/director-chair.png" alt="Directores">
                        <div class="card-body">
                            <h2 class="card-title">
                                Directores
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-4">
                <a href="/../index.php?entity=platforms&action=index">
                    <div class="card">
                        <img class="card-img-top" src="./views/imgs/Gemini_Generated_Image_streaming.png"
                            alt="Plataformas">
                        <div class="card-body">
                            <h2 class="card-title">
                                Plataformas
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/../index.php?entity=languages&action=index">
                    <div class="card">
                        <img class="card-img-top" src="./views/imgs/languages.png" alt="Idiomas">
                        <div class="card-body">
                            <h2 class="card-title">
                                Idiomas
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<?php
require_once __DIR__ . '/../templates/footer.php';
?>