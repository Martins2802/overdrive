<?php
    session_start();
    require_once '../verify/logout.php';

    $_SESSION['logged'] = $_SESSION['logged'] ?? false;

    if(!$_SESSION['logged']) {
        header('Location: login.php');
        exit();
    }

    require_once '../classes/UsuarioDao.php';
    $card = UsuarioDao::read();

    require_once '../classes/EmpresaDao.php';
    $empresa = EmpresaDao::read();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/31c3656381.js" crossorigin="anonymous"></script>
    <style>

      #navbarSupportedContent li a {
        color: red;
      }
      #navbarSupportedContent li a:hover {
        color: #dc3545;
      }
      .form-control {
        border-color: red;
      }
      .form-control:focus {
        border-color: red;
        box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.7);
      }
      #botao:hover {
        background-color: red;
        color: white;
      }

      #botao {
        color: red;
      }
      .card-img-top{
        width: 120px;
        height: 120px;
      }
    </style>
</head>
  <body>
      <nav class="navbar navbar-expand-lg bg-black bg-gradient">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="images/overdrive.png" style="width: 300px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <?php
              if($_SESSION['tipo'] == "Admin"):
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Admin
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="cadastro.php">Novo usuário</a></li>
              <li><a class="dropdown-item" href="cadastro_empresa.php">Nova empresa</a></li>
            </ul>
          </li>
          <?php endif?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Filtrar
            </a>
            <ul class="dropdown-menu">
              <li><p class="dropdown-item" onclick="selectAll()" style="cursor:pointer; color:#f00;">Todos</p></li>
              <li><p class="dropdown-item" onclick="filterUser()" style="cursor:pointer; color:#f00;">Usuários</p></li>
              <li><p class="dropdown-item" onclick="filterEnterprise()" style="cursor:pointer; color:#f00;">Empresas</p></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="cursor:pointer" href="?logout=1">Sair</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="campo">
          <button class="btn btn-outline-success border-danger" type="submit" id="botao">Search</button>
        </form>
      </div>
    </div>
  </nav>
    <h2 style="text-align: center; color:#f00;" id="users_title" class="mt-3">Usuários</h2>
    <section id="users" class="col-12 p-3 flex-row flex-wrap" style="display: flex;">
    <?php
        foreach($card as $registros):
    ?>
    <div class="borda col-10 col-md-4 col-lg-3 pb-3 d-flex justify-content-center">
        <div class="card border-black" style="width: 18rem;">
          <div class="d-flex justify-content-center"><img src="images/unknow.png" class="card-img-top" alt="..."></div>
        <div class="card-body">
          <div class="d-flex justify-content-center">
            <div>
            <p style="text-align: center;"><b>Nome:</b> <?=$registros['nome']?></p>
            <p style="text-align: center;"><b>Cpf:</b> <?=$registros['cpf']?></p>
            <p style="text-align: center;"><b>Tipo:</b> <?=$registros['tipo']?></p>
            <p style="text-align: center;"><b>Telefone:</b> <?=$registros['telefone']?></p>
            <p style="text-align: center;"><b>Estado:</b> <?=$registros['estado']?></p>
            <p style="text-align: center;"><b>Cidade:</b> <?=$registros['cidade']?></p>
            <p style="text-align: center;"><b>Bairro:</b> <?=$registros['bairro']?></p>
            <p style="text-align: center;"><b>Logradouro:</b> <?=$registros['logradouro']?></p>
            <p style="text-align: center;"><b>CNH:</b> <?=$registros['cnh']?></p>
            <p style="text-align: center;"><b>Empresa:</b> <?=$registros['nome_fantasia']?></p>
            </div>
          </div>
            <?php
                if($_SESSION['tipo'] == "Admin"):
            ?>
            <div class="d-flex justify-content-center p-2">
              <button type="button" class="btn btn-primary ms-2" onclick="window.location.href='updateUser.php?cpf=<?=$registros['cpf']?>'">Update</button>
              <button type="button" class="btn btn-danger ms-2"  onclick="window.location.href='../deletar.php?cpf=<?=$registros['cpf']?>'">Delete</button>
            </div>
            <?php endif;?>
        </div>
      </div>
    </div>
    <?php endforeach;?>
    </section>
    <h2 style="text-align: center; color:#f00;" id="enterprise_title" class="mt-3">Empresas</h2>
    <section class="col-12 p-3 flex-row flex-wrap" id="enterprise" style="display: flex;">
    <?php
        foreach($empresa as $emp):
    ?>
    <div class="borda col-10 col-md-4 col-lg-3 pb-3 d-flex justify-content-center">
        <div class="card border-black" style="width: 18rem;">
          <div class="d-flex justify-content-center"><img src="images/enterprise.png" class="card-img-top" alt="..."></div>
        <div class="card-body">
          <p style="text-align: center;"><b>Nome:</b> <?=$emp['nome_emp']?></p>
          <p style="text-align: center;"><b>CNPJ:</b> <?=$emp['cnpj']?></p>
          <p style="text-align: center;"><b>Fantasia:</b> <?=$emp['nome_fantasia']?></p>
          <p style="text-align: center;"><b>Telefone:</b> <?=$emp['telefone']?></p>
          <p style="text-align: center;"><b>Estado:</b> <?=$emp['estado']?></p>
          <p style="text-align: center;"><b>Cidade:</b> <?=$emp['cidade']?></p>
          <p style="text-align: center;"><b>Bairro:</b> <?=$emp['bairro']?></p>
          <p style="text-align: center;"><b>Logradouro:</b> <?=$emp['logradouro']?></p>
          <p style="text-align: center;"><b>Responsavel:</b> <?=$emp['responsavel']?></p>
          <p style="text-align: center;"><b>Empresa:</b> <?=$emp['nome_fantasia']?></p>
          <?php
              if($_SESSION['tipo'] == "Admin"):
          ?>
          <div class="d-flex justify-content-center p-2">
            <button type="button" class="btn btn-primary ms-2" onclick="window.location.href='updateEnterprise.php?cnpj=<?=$emp['cnpj']?>'">Update</button>
            <button type="button" class="btn btn-danger ms-2"  onclick="window.location.href='../deletar.php?cnpj=<?=$emp['cnpj']?>'">Delete</button>
          </div>
              <?php endif;?>
        </div>
      </div>
    </div>
    <?php endforeach;?>
    </section>
    <script>
      var user = document.getElementById('users');
      var userTitle = document.getElementById('users_title');
      var enterprise = document.getElementById('enterprise');
      var enterpriseTitle = document.getElementById('enterprise_title');

      function filterUser() {
        user.style.display = 'flex';
        userTitle.style.display = 'block';
        enterprise.style.display = 'none';
        enterpriseTitle.style.display = 'none';
      }
      function filterEnterprise() {
        user.style.display = 'none';
        userTitle.style.display = 'none';
        enterprise.style.display = 'flex';
        enterpriseTitle.style.display = 'block';
      }
      function selectAll() {
        user.style.display = 'flex';
        userTitle.style.display = 'block';
        enterprise.style.display = 'flex';
        enterpriseTitle.style.display = 'block';
      }
    </script>
  </body>
</html>