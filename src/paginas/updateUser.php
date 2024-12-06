<?php
    session_start();
    require_once '../listas.php';
    require_once '../classes/UsuarioDao.php';

    
    $_SESSION['logged'] = $_SESSION['logged'] ?? false;

    if(!$_SESSION['logged']) {
        header('Location: login.php');
        exit();
    }

    if($_SESSION['tipo'] == 'Comum') {
        header('Location: index.php');
    }

    $dados = UsuarioDao::read();
    $estados = [
    [
    "uf" => "AC",
    "nome" => "Acre"
    ],
    [
    "uf" => "AL",
    "nome" => "Alagoas"
    ],
    [
    "uf" => "AM",
    "nome" => "Amazonas"
    ],
    [
    "uf" => "AP",
    "nome" => "Amapá"
    ],
    [
    "uf" => "BA",
    "nome" => "Bahia"
    ],
    [
    "uf" => "CE",
    "nome" => "Ceará"
    ],
    [
    "uf" => "DF",
    "nome" => "Distrito Federal"
    ],
    [
    "uf" => "ES",
    "nome" => "Espírito Santo"
    ],
    [
        "uf" => "GO",
        "nome" => "Goiás"
    ],
    [
        "uf" => "MA",
        "nome" => "Maranhão"
    ],
    [
        "uf" => "MG",
        "nome" => "Minas Gerais"
    ],
    [
        "uf" => "MS",
        "nome" => "Mato Grosso do Sul"
    ],
    [
        "uf" => "MT",
        "nome" => "Mato Grosso"
    ],
    [
        "uf" => "PA",
        "nome" => "Pará"
    ],
    [
        "uf" => "PB",
        "nome" => "Paraíba"
    ],
    [
        "uf" => "PE",
        "nome" => "Pernambuco"
    ],
    [
        "uf" => "PI",
        "nome" => "Piauí"
    ],
    [
        "uf" => "PR",
        "nome" => "Paraná"
    ],
    [
        "uf" => "RJ",
        "nome" => "Rio de Janeiro"
    ],
    [
        "uf" => "RN",
        "nome" => "Rio Grande do Norte"
    ],
    [
        "uf" => "RO",
        "nome" => "Rondônia"
    ],
    [
        "uf" => "RR",
        "nome" => "Roraima"
    ],
    [
        "uf" => "RS",
        "nome" => "Rio Grande do Sul"
    ],
    [
        "uf" => "SC",
        "nome" => "Santa Catarina"
    ],
    [
        "uf" => "SE",
        "nome" => "Sergipe"
    ],
    [
        "uf" => "SP",
        "nome" => "São Paulo"
    ],
    [
        "uf" => "TO",
        "nome" => "Tocantins"
    ]

];

    foreach($dados as $d) {
        if($d['cpf'] == $_GET['cpf']) {
            $registro = $d;
            break;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="../output.css" rel="stylesheet">
    <style>
        @media (min-width: 768px) {
          .md\:h-screen {
           height: calc(100vh + 280px);
           }
        }
        #cep{
            appearance: none;
            -moz-appearance: textfield;
        }
        #logo-fixo {
            position: fixed;
            top: 35%; 
            left: 25%; 
            transform: translateX(-50%); 
            z-index: 999; 
        }
        .span-required {
            color: #f00;
            font-size: 12px;
            margin: 3px 0px 0px 1px;
            display: none;
        }
    </style>
</head>
<body>
   <div class="flex">
        <div class="hidden md:flex-1 md:bg-zinc-900 md:flex md:justify-center md:items-center">
            <img src="images/logo.png" alt="logo da overdrive" id="logo-fixo">
        </div>
        <div class="flex-1 flex justify-center items-center">
            <div class="flex justify-center items-center flex-col md:w-1/2 md:inline md:h-auto">
                <div class="flex justify-center">
                   <h1 class="text-2xl font-bold text-center mb-5 text-red-600 flex">ATUALIZAR</h1>
                   <img src="images/logo.png" class="w-10 h-10 ml-2 md:hidden">
                </div>
                <form action="../atualizarUsuario.php?cpf=<?=$registro['cpf']?>" method="post" class="flex flex-col" id="cadastro">                    
                    <input type="text" placeholder="nome" value="<?=$registro['nome']?>" name="nome" id="nome" class="bg-gray-100 p-2 outline-none border border-zinc-900 campo" oninput="nameValidate()">
                    <span class="span-required mb-3">Nome deve ter no mínimo 2 caracteres</span>
                    <input type="text" data-mask="000.000.000-00" value="<?=$registro['cpf']?>" required placeholder="cpf" oninput="cpfValidate()" autocomplete="off" name="cpf" id="cpf" class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900 campo">
                     <span class="span-required mb-3">Digite um CPF válido</span>
                    <input type="password" required placeholder="senha" name="senha" id="senha" class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900 campo" oninput="mainPasswordValidate()">
                    <span class="span-required mb-3">Senha deve ter no mínimo 8 caracteres</span>
                    <input type="password" required placeholder="repita sua senha" name="repita" id="repita" class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900 campo" oninput="comparePassword()">
                    <span class="span-required mb-3">Senhas devem ser correspondentes</span>
                    <input type="text" placeholder="CEP" data-mask="00000-000" value="<?=$registro['cep']?>" oninput="buscaCep()" name="cep" id="cep" class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900 campo">
                    <span class="span-required mb-3">Digite um CEP válido</span>
                    <select name="estados" required id="estados" class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900 campo">
                        <?php
                            foreach($estados as $e):
                        ?>
                        <option  <?php if($e['uf'] == $registro['estado']) echo "selected";?> value="<?=$e['uf']?>"><?=$e['nome'].'('.$e['uf'].')'?></option>
                        <?php endforeach;?>
                    </select>                    
                    <input type="text" placeholder="cidade" value="<?=$registro['cidade']?>" name="cidade" id="cidade" class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900 campo">
                    <span class="span-required mb-3">Digite um número válido</span>
                    <input type="text" placeholder="bairro" value="<?=$registro['bairro']?>" name="bairro" id="bairro" class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900 campo">
                    <span class="span-required mb-3">Digite um número válido</span>
                    <input type="text" placeholder="logradouro" required name="logradouro" value="<?=$registro['logradouro']?>" id="logradouro" class="mt-5 bg-gray-100 mb-3 p-2 outline-none border border-zinc-900 campo">
                    <span class="span-required mb-3">Digite um número válido</span>
                    <input type="text" placeholder="numero" value="<?=$registro['numero']?>" required name="numero" id="numero" class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Digite um número válido</span>
                    <select name="cnh" id="cnh" required class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900">
                        <option value="">Selecione um tipo de CNH</option>
                        <option value="NULL">Não possuo CNH</option>
                        <option <?php if($registro['cnh'] == "Tipo A") echo "selected";?> value="Tipo A">Tipo A: Motocicletas</option>
                        <option <?php if($registro['cnh'] == "Tipo B") echo "selected";?> value="Tipo B">Tipo B: Veículos de passeio</option>
                        <option <?php if($registro['cnh'] == "Tipo C") echo "selected";?> value="Tipo C">Tipo C: Veículos de carga</option>
                        <option <?php if($registro['cnh'] == "Tipo D") echo "selected";?> value="Tipo D">Tipo D: Veículos de passageiros</option>
                        <option <?php if($registro['cnh'] == "Tipo E") echo "selected";?> value="Tipo E">Tipo E: Veículos com trailer ou carreta</option>
                    </select>
                    <select name="empresas" id="empresas" required class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900">
                        <?php foreach ($listaEmpresas as $emp): ?>
                            <option <?php if($emp['cnpj'] == $registro['cnpj']) echo "selected";?> value="<?= $emp['cnpj'] ?>"> <?= $emp['nome_emp'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" value="<?=$registro['telefone']?>" name="telefone" data-mask="(00) 00000-0000" oninput="phoneValidate()" placeholder="telefone" id="telefone" autocomplete="off"  class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Digite um número válido</span>
                    <input type="text" value="<?=$registro['carro']?>" placeholder="carro" name="carro" id="carro" class="bg-gray-100 mt-5 mb-10 p-2 outline-none border border-zinc-900">
                    <input type="submit" value="Atualizar" class="bg-red-600 p-2 mb-3 text-white cursor-pointer transition-all duration-500 hover:bg-red-500">
                </form>
               <p class="mb-5" style="text-align: center;"><a href="index.php" class="text-red-600">Voltar para listagem de registros</a></p>
            </div>
        </div> 
   </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        const form = document.getElementById('cadastro');
        const campos = document.querySelectorAll('input');
        const spans = document.querySelectorAll('.span-required');

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Impede o envio do formulário

        let valid = true;

        valid = valid && nameValidate();
        valid = valid && cpfValidate();
        valid = valid && mainPasswordValidate();
        valid = valid && comparePassword();
        valid = valid && cepValidate();
        valid = valid && phoneValidate();

        if (valid) {
            form.submit(); // Envia o formulário se todas as validações forem bem-sucedidas
        }
    });

        function setError(index) {
            campos[index].style.border = '2px solid #f00'
            spans[index].style.display = 'block';
        }

        function removeError(index) {
            campos[index].style.border = ''
            spans[index].style.display = 'none';
        }
 
        function nameValidate() {
            if(campos[0].value.length < 2) {
                setError(0);
                return false;
            }
            else{
                removeError(0);
                return true;
            }
        }

        function cpfValidate() {
            if(campos[1].value.length !=14) {
                setError(1);
                return false;
            }
            else{
                removeError(1);
                return true;
            }
        }

        function cepValidate() {
            if(campos[4].value.length != 9) {
                setError(4);
                return false;
            }
            else {
                removeError(4);
                return true;
            }
        }

        function phoneValidate() {
            if(campos[9].value.length < 15) {
                setError(9);
                return false;
            }
            else {
                removeError(9);
                return true;
            }
        }

        function mainPasswordValidate() {
            if(campos[2].value.length < 8) {
                setError(2);
                return false;
            }
            else {
                removeError(2);
                comparePassword();
                return true;
            }
        }
        function comparePassword() {
            if(campos[2].value == campos[3].value && campos[3].value.length >= 8) {
                removeError(3);
                return true;
            }
            else {
                setError(3);
                return false;
            }
        }
   </script>
   <script>
    function buscaCep() {
    let inputCep = document.querySelector('input[name=cep]')
    let cep = inputCep.value.replace(/[^0-9]/g, '')

    if(cep.length == 8) {
        let url = 'http://viacep.com.br/ws/' + cep + '/json'
        let xhr = new XMLHttpRequest()
        xhr.open('GET', url, true)
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200)
                    preencheCampos(JSON.parse(xhr.responseText))
            }
        }
        xhr.send();
    } else {
        document.querySelector('input[name=logradouro]').value = ''
        document.querySelector('input[name=bairro]').value = ''
        document.querySelector('input[name=cidade]').value = ''
    }
    cepValidate();
}

function preencheCampos(json) {

    if(json.localidade !== undefined){

        document.querySelector('input[name=logradouro]').value = json.logradouro
        document.querySelector('input[name=bairro]').value = json.bairro
        document.querySelector('input[name=cidade]').value = json.localidade
    } 
    }
   </script>
</body>
</html>