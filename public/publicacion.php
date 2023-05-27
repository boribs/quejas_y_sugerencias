<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../assets/css/publicacion_dialogo.css">
    <title>Quejas FCC | Publicacion</title>
    <link rel="icon" type="image/png" href="../assets/images/escudo-buap.png">
</head>
<body>
    <div id="header-and-main">
        <header id="top-header" class="row">
            <a href="https://www.buap.mx">
                <img id="BUAP-logo" src="../assets/images/logo-buap-h.png">
            </a>
            <div class="separator"></div>
            <div class="header-right header-button">
                <a href="#" class="no-decor">Contacto FCC</a>
            </div>
            <div class="header-right header-button">
                <a href="#" class="no-decor">Otra cosa</a>
            </div>
            <!-- <div class="header-right">Contacto FCC</div>
            <div class="header-right">
                <a href="index.html">
                    <img class="round-image" src="../assets/images/usuario.png" alt="Descripción de la imagen">
                </a>
            </div> -->
            <!-- Podriamos poner esto para mostrar cuando se logee el usuario y si no dejamos que diga bienvenido -->
        </header>

        <main>
            <div id="main-content">
                <div id="forum-container">
                    <div class="comments-container">
                        <h1>Titulo Publicacion</h1>

                        <ul id="comments-list" class="comments-list">
                            <li>
                                <div class="comment-main-level">
                                    <!-- Avatar -->
                                    <div class="comment-avatar"><img src="../assets/images/shiji.png" alt=""></div>
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name by-author">Shinji Ikari</h6>
                                            <span>24/05/2023 14:23:01</span> <!--Ver si poner la hora de publicacion del comentario--><!--Checar si no quitar-->
                                            <i class="fa fa-reply"><a href="respuestaformulario.html">Responder</a></i> <!--Area para responder-->
                                            <i class="fa fa-heart"></i> <!--Area para poner si ya fue resuelto o no-->
                                            <!--El area de reply solo estara activa hasta que se se responda la publicacion o algo asi-->
                                        </div>
                                        <div class="comment-content">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                        </div>
                                    </div>
                                </div>
                                <!-- Respuestas de los comentarios -->
                                <ul class="comments-list reply-list">
                                    <li>
                                        <!-- Avatar -->
                                        <div class="comment-avatar"><img src="../assets/images/rei.png" alt=""></div>
                                        <!-- Contenedor del Comentario -->
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                <h6 class="comment-name">Rei Ayanami</a></h6>
                                                <span>24/05/2023 14:33:21</span>
                                                <i class="fa fa-reply"></i>
                                                <i class="fa fa-heart">Estudiante</i> <!--Usar esta area para ver quien le respondio al usuario-->
                                            </div>
                                            <div class="comment-content">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <!-- Avatar -->
                                        <div class="comment-avatar"><img src="../assets/images/misato.jpg" alt=""></div>
                                        <!-- Contenedor del Comentario -->
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                <h6 class="comment-name">Misato Katsuragi</a></h6>
                                                <span>24/05/2023 15:13:21</span>
                                                <i class="fa fa-reply"></i>
                                                <i class="fa fa-heart">Administracion</i> <!--Usar esta area para ver quien le respondio al usuario-->
                                            </div>
                                            <div class="comment-content">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <!-- Avatar -->
                                        <div class="comment-avatar"><img src="../assets/images/shiji.png" alt=""></div>
                                        <!-- Contenedor del Comentario -->
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                <h6 class="comment-name by-author">Shinji Ikari</h6>
                                                <span>25/05/2023 11:13:21</span>
                                                <i class="fa fa-reply"></i>
                                                <i class="fa fa-heart"></i> <!--El autor puede o no llevar la identificacion si es estudiante o no, checar esto-->
                                            </div>
                                            <div class="comment-content">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer class="row">
        <div class="footer-text-element">BUAP 2023</div>
        <div class="separator"></div>
        <div class="footer-text-element">Cristian Gotchev</div>
        <div class="footer-text-element">Irving Hernández</div>
    </footer>
</body>
</html>
