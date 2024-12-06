 <?php
    session_start();
    require_once '../listas.php';
    require_once '../classes/EmpresaDao.php';

    
    $_SESSION['logged'] = $_SESSION['logged'] ?? false;

    if(!$_SESSION['logged']) {
        header('Location: login.php');
        exit();
    }

    if($_SESSION['tipo'] == 'Comum') {
        header('Location: index.php');
    }

    $dados = EmpresaDao::read();
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
        if($d['cnpj'] == $_GET['cnpj']) {
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
    <title>Cadastro Empresa</title>
    <link href="../output.css" rel="stylesheet">
    <style>
        @media (min-width: 768px) {
          .md\:h-screen {
           height: calc(100vh + 280px);
           }
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
                <form action="../atualizarEmpresa.php?cnpj=<?=$registro['cnpj']?>" method="POST" class="flex flex-col" id="cadastro_empresa">
                    <input type="text" placeholder="nome" value="<?=$registro['nome_emp']?>" name="nome" id="nome" oninput="nameValidate()" class="bg-gray-100 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Nome deve ter no mínimo 2 caracteres</span>
                    <input type="text" placeholder="Nome Fantasia" value="<?=$registro['nome_fantasia']?>" name="fantasia" oninput="fantasiaValidate()" id="fantasia" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Fantasia deve ter no mínimo 2 caracteres</span>
                    <input type="text" placeholder="cnpj" value="<?=$registro['cnpj']?>" data-mask="00.000.000/0000-00" oninput="cnpjValidate()" autocomplete="off" name="cnpj" id="cnpj" class="bg-gray-100 p-2 mt-5 outline-none border border-zinc-900">
                    <span class="span-required mb-3">CNPJ inválido</span>
                    <input type="password" required placeholder="senha" oninput="mainPasswordValidate()" name="senha" id="senha" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Senha deve ter no mínimo 8 caracteres</span>
                    <input type="password" required placeholder="repita a senha" name="repete" id="repete" oninput="comparePassword()" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Senhas não coincidem</span>
                    <input type="text" placeholder="CEP" value="<?=$registro['cep']?>" name="cep" id="cep" data-mask="00000-000" oninput="buscaCep()" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Cep inválido</span>
                     <select name="estados" required id="estados" class="mt-5 bg-gray-100 p-2 outline-none border border-zinc-900 campo">
                        <?php
                            foreach($estados as $e):
                        ?>
                        <option  <?php if($e['uf'] == $registro['estado']) echo "selected";?> value="<?=$e['uf']?>"><?=$e['nome'].'('.$e['uf'].')'?></option>
                        <?php endforeach;?>
                    </select>               
                    <input type="text" placeholder="cidade" value="<?=$registro['cidade']?>" name="cidade" id="cidade" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3"></span>
                    <input type="text" placeholder="bairro" value="<?=$registro['bairro']?>" name="bairro" id="bairro" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3"></span>
                    <input type="text" placeholder="logradouro" value="<?=$registro['logradouro']?>" required name="logradouro" id="logradouro" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3"></span>
                    <input type="text" placeholder="numero" required value="<?=$registro['numero']?>" name="numero" id="numero" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3"></span>
                    <input type="text" name="responsavel" value="<?=$registro['responsavel']?>" oninput="responsavelValidate()" placeholder="responsavel" id="responsavel" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Nome do responsável deve ter no mínimo 2 caracteres</span>
                    <input type="text" name="telefone" value="<?=$registro['telefone']?>" data-mask="(00) 00000-0000" placeholder="telefone" id="telefone" oninput="phoneValidate()"  class="bg-gray-100 mt-5 mb-10 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Telefone inválido</span>
                    <input type="submit" value="Atualizar" class="bg-red-600 p-2 mb-3 text-white cursor-pointer transition-all duration-500 hover:bg-red-500">
                </form>
                <p class="mb-5" style="text-align: center;"><a href="index.php" class="text-red-600">Voltar para listagem de registros</a></p>
            </div>
        </div> 
   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        const form = document.getElementById('cadastro_empresa');
        const campos = document.querySelectorAll('input');
        const spans = document.querySelectorAll('.span-required');

    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Impede o envio do formulário

        let valid = true;

        valid = valid && nameValidate();
        valid = valid && fantasiaValidate();
        valid = valid && cnpjValidate();
        valid = valid && cepValidate();
        valid = valid && mainPasswordValidate();
        valid = valid && comparePassword();
        valid = valid && responsavelValidate();
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

        function fantasiaValidate() {
            if(campos[1].value.length < 2) {
                setError(1);
                return false;
            }
            else{
                removeError(1);
                return true;
            }
        }

        function cnpjValidate() {
            if(campos[2].value.length != 18) {
                setError(2);
                return false;
            }
            else {
                removeError(2);
                return true;
            }
        }

        function cepValidate() {
            if(campos[5].value.length != 9) {
                setError(5);
                return false;
            }
            else {
                removeError(5);
                return true;
            }
        }

       function responsavelValidate() {
            if(campos[10].value.length < 2) {
                setError(10);
                return false
            }
            else {
                removeError(10);
                return true;
            }
        }

        function phoneValidate() {
            if(campos[11].value.length != 15) {
                setError(11);
                return false;
            }
            else {
                removeError(11);
                return true;
            }
        }

        function mainPasswordValidate() {
            if(campos[3].value.length < 8) {
                setError(3);
                return false;
            }
            else {
                removeError(3);
                comparePassword();
                return true;
            }
        }
        function comparePassword() {
            if(campos[3].value == campos[4].value && campos[4].value.length >= 8) {
                removeError(4);
                return true;
            }
            else {
                setError(4);
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