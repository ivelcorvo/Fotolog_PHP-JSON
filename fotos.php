<?php
    //PARTE - 8
    $postagens = [];
    $arquivo_postagens = "postagens.json";
    if(file_exists($arquivo_postagens)){
        $postagens = json_decode(file_get_contents($arquivo_postagens),true);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Levi Alves Junior">
        <meta name="description" content="rede de fotos">
        <meta name="robots" content="index, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Fotolog - Fotos</title>
        <link rel="stylesheet" type="text/css" href="_css/estilo.css">
        <link rel="shortcut icon" type="imagem/png" href="_icon/photo-camera32.png">
    </head>
    <body>
        <header>
            <nav class="menu-wrapper">
                <!-- menu desktop -->
                <ul class="menu-desktop">
                    <li><a href="index.php">Nova Postagem</a></li>
                    <li><a href="usuarios.php">Usuários</a></li>
                    <li><a href="fotos.php">Fotos</a></li>
                </ul>
                <!-- menu mobile -->
                <label class="lbl-mobile" for="check-mobile">&#8801;</label>
                <input type="checkbox" id="check-mobile">
                <ul class="menu-mobile">
                    <li><a href="index.php">Nova Postagem</a></li>
                    <li><a href="usuarios.php">Usuários</a></li>
                    <li><a href="fotos.php">Fotos</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section class="principal conteiner">
                <div class="fotos">                                    
                <?php
                    //PARTE - 8
                    if(count($postagens)){
                        foreach($postagens as $i => $p){
                            
                            echo"<figure>";
                                echo"<img src=".$p["foto"]." class='img-responsivo'>";
                                echo"<figcaption>";
                                    echo"<span class='titulo2'>".$p["titulo"]."</span>";
                                    echo"<p>".$p["msg"]."</p>";
                                echo"</figcaption>";
                            echo"</figure>";                            
                        }
                    }else{
                ?>
                    <div class="sem-postagem">
                        <span class="titulo">Não há fotos!</span>
                        <p>Cadastre um usuário e poste fotos.</p>
                    </div>
                <?php
                    }
                ?>
                </div>
            </section>
        </main>
        <footer>

        </footer>
    </body>
</html>