<?php
    // PARTE - 1
    $arquivos_usuarios = "usuarios.json";
    $usuarios = []; //para conter totos os usários
    if(count($_POST)){
        // var_dump($_POST);
        $usuario = $_POST;
        if(file_exists($arquivos_usuarios)){
            $usuarios = json_decode(file_get_contents($arquivos_usuarios),true);
        }
        $usuarios[] = $usuario;
        file_put_contents($arquivos_usuarios, json_encode($usuarios));
    }
    //trás os usuários ja existentes
    if(file_exists($arquivos_usuarios)){
        $usuarios = json_decode(file_get_contents($arquivos_usuarios),true);
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
        <title>Fotolog - Usuários</title>
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
                <form method="post">
                    <fieldset>
                        <legend><span class="titulo">Cadastre um novo usuário</span></legend>
                        <div class="usuario-input">
                            <div class="input-nome">
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" id="nome" class="campo" placeholder="Nome ou Apelido" required autofocus><br><br>
                            </div>
                            <div class="input-email">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="campo" placeholder="email@dominio.com" required><br><br>
                            </div>
                        </div>
                        <button class="btn" type="submit">Cadastrar</button>
                    </fieldset>
                </form><br><br>
                <?php
                    // PARTE - 2
                    if(count($usuarios)){
                        echo"<ul class='usuario'>";
                        foreach($usuarios as $i => $u){
                            echo"<li class='flex'>";
                                echo"<img src='_icon/user32.png' class='circulo'>";                                
                                echo"<span>".$u["nome"]."<br>".$u["email"]."</span>";                                
                            echo"</li>";
                        }
                        echo"</ul>";
                    }else{
                ?>
                        <div class="sem-usuario">
                            <span class="titulo">Não há usuários</span>
                            <p>você não possui usuários cadastrados!</p>
                        </div>
                <?php   
                    }
                ?>
            </section>
        </main>
        <footer>

        </footer>
    </body>
</html>