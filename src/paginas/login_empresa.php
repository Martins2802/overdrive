<?php
    session_start();
    $_SESSION['logged'] = $_SESSION['logged'] ?? false;

    if($_SESSION['logged']) {
        header('Location:index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login empresa</title>
    <link href="../output.css" rel="stylesheet">
</head>
<body>
   <div class="flex">
        <div class="hidden md:flex-1 md:bg-zinc-900 md:h-screen md:flex md:justify-center md:items-center">
            <img src="images/logo.png" alt="logo da overdrive">
        </div>
        <div class="flex-1 flex justify-center items-center">
            <div class="flex justify-center items-center h-screen flex-col md:w-1/2 md:inline md:h-auto">
                <div class="flex justify-center">
                   <h1 class="text-2xl font-bold text-center mb-5 text-red-600 flex">LOGIN</h1>
                   <img src="images/logo.png" class="w-10 h-10 ml-2 md:hidden">
                </div>
                <form action="#" method="post" class="flex flex-col" id="loginForm">
                    <label for="cnpj" class="text-red-600">CNPJ</label>
                    <input type="text" placeholder="cnpj" data-mask="00.000.000/0000-00" autocomplete="off" name="cnpj" id="cnpj" class="bg-gray-100 p-2 mb-3 outline-none border border-zinc-900">
                    <label for="senha" class="text-red-600">Senha</label>
                    <input type="password" placeholder="senha" name="senha" id="senha" class="bg-gray-100 mb-10 p-2 outline-none border border-zinc-900">
                    <input type="submit" value="Entrar" class="bg-red-600 p-2 mb-3 text-white cursor-pointer transition-all duration-500 hover:bg-red-500">
                    <?php
                       if(isset($_GET['error']) && $_GET['error'] == 1)
                       echo "<div style='color:red; text-align:center;'>Usuário ou senha incorretos</div>";
                    ?>
                </form>
                <p><a href="login.php" class="text-red-600">Entrar como usuário</a></p>
            </div>
        </div> 
   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>
</html>
