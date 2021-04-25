<?php
    // PARTE - 3
    $arquivos_usuarios = "usuarios.json";
    $usuarios = [];
    if(file_exists($arquivos_usuarios)){
        $usuarios = json_decode(file_get_contents($arquivos_usuarios),true);
    }

    $postagens = [];
    $arquivo_postagens = "postagens.json"; // PARTE - 6
    if(file_exists($arquivo_postagens)){ 
        $postagens = json_decode(file_get_contents($arquivo_postagens),true);
    }

    $erro_extensao_invalida = false; // PARTE - 7

    // PARTE - 5
    // var_dump($_POST);
    // echo"<br><br>";
    // var_dump($_FILES);
    if(isset($_FILES["foto"]) && count($_POST)){//se a foto foi setada e se existem dados no post
        $nome = $_FILES["foto"]["name"];
        $tam  = $_FILES["foto"]["size"];
        $tipo = $_FILES["foto"]["type"];
        $tmp  = $_FILES["foto"]["tmp_name"];
        $path = "fotos/".$nome;
        
        // PARTE - 6
        $extensoes = ["jpg","jpeg","png"]; 
        $x = explode('.',$nome);        
        $extensao  = $extensao = strtolower(end($x)); //trás o final da extensão  //
        $erro_extensao_invalida = !in_array($extensao,$extensoes);

        if(!$erro_extensao_invalida && $tam > 0){
            move_uploaded_file($tmp,$path); // armazenar a foto no local específico  // PARTE - 5    

            if(isset($_POST["usuario_id"]) && ($_POST["usuario_id"] < count($usuarios))){
                $usuario = $usuarios[$_POST["usuario_id"]]["nome"];
            }else{
                $usuario = "usuario desconhecido";
            }

            $titulo = $_POST["titulo"];
            $msg    = $_POST["msg"];
            $foto   = $path;
            $novo_post = ["usuario"=>$usuario, "titulo"=>$titulo, "msg"=>$msg, "foto"=>$foto];

            $postagens[] = $novo_post;
            file_put_contents($arquivo_postagens,json_encode($postagens));
        }        
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
        <title>Fotolog - Nova Postagem</title>        
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
                <form method="post" enctype="multipart/form-data" action="">
                    <fieldset class="postagem">
                        <legend><span class="titulo">Poste uma foto</span></legend>
                        <label for="usuario">Usuário:</label>
                        <select id="usuario" name="usuario_id" class="campo">
                        <?php
                            // PARTE - 4
                            if(count($usuarios)){
                                echo"<option value='' disabled selected>Quem é você?</option>";
                                foreach($usuarios as $i => $u){
                                    echo"<option value='$i'>".$u["nome"]."</option>";
                                }
                            }else{
                                echo"<option value='' disabled selected>Cadastre um usuário</option>";
                            }
                        ?>
                        </select><br><br>                        
                        <label class="lbl-foto" for="foto"><img src="_icon/photo-camera32.png"></label><!-- envio de arquivo -->
                        <input type="file" id="foto" name="foto"><br><br>
                        <label for="titulo">Titulo do post:</label> 
                        <input type="text" id="titulo" name="titulo" class="campo"><br><br>
                        <label for="msg">Sua mensagem:</label>
                        <textarea type="text" id="msg" name="msg" rows="5"></textarea><br><br>
                        <button class="btn" type="submit">Enviar</button>
                        <button class="btn" type="reset">Limpar</button>
                    </fieldset>
                </form>
                <?php
                // PARTE - 7
                if($erro_extensao_invalida){
                ?>
                    <br><br>
                    <div class="extensao_invalida">
                        <span class="titulo">Erro!</span>
                        <p>O arquivo enviado não é uma imagem.</p>
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