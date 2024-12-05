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
                   <h1 class="text-2xl font-bold text-center mb-5 text-red-600 flex">CADASTRO</h1>
                   <img src="images/logo.png" class="w-10 h-10 ml-2 md:hidden">
                </div>
                <form action="../inserir_cadastro_empresa.php" method="POST" class="flex flex-col" id="cadastro_empresa">
                    <input type="text" placeholder="nome" name="nome" id="nome" oninput="nameValidate()" class="bg-gray-100 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Nome deve ter no mínimo 2 caracteres</span>
                    <input type="text" placeholder="Nome Fantasia" name="fantasia" oninput="fantasiaValidate()" id="fantasia" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Fantasia deve ter no mínimo 2 caracteres</span>
                    <input type="text" placeholder="cnpj" data-mask="00.000.000/0000-00" oninput="cnpjValidate()" autocomplete="off" name="cnpj" id="cnpj" class="bg-gray-100 p-2 mt-5 outline-none border border-zinc-900">
                    <span class="span-required mb-3">CNPJ inválido</span>
                    <input type="password" required placeholder="senha" oninput="mainPasswordValidate()" name="senha" id="senha" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Senha deve ter no mínimo 8 caracteres</span>
                    <input type="password" required placeholder="repita a senha" name="repete" id="repete" oninput="comparePassword()" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Senhas não coincidem</span>
                    <input type="text" placeholder="CEP" name="cep" id="cep" data-mask="00000-000" oninput="buscaCep()" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Cep inválido</span>
                    <select name="estados" required id="estados" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                        <option value="">Selecione um estado</option>
                        <option value="AC">Acre (AC)</option>
                        <option value="AL">Alagoas (AL)</option>
                        <option value="AP">Amapá (AP)</option>
                        <option value="AM">Amazonas (AM)</option>
                        <option value="BA">Bahia (BA)</option>
                        <option value="CE">Ceará (CE)</option>
                        <option value="DF">Distrito Federal (DF)</option>
                        <option value="ES">Espírito Santo (ES)</option>
                        <option value="GO">Goiás (GO)</option>
                        <option value="MA">Maranhão (MA)</option>
                        <option value="MT">Mato Grosso (MT)</option>
                        <option value="MS">Mato Grosso do Sul (MS)</option>
                        <option value="MG">Minas Gerais (MG)</option>
                        <option value="PA">Pará (PA)</option>
                        <option value="PB">Paraíba (PB)</option>
                        <option value="PR">Paraná (PR)</option>
                        <option value="PE">Pernambuco (PE)</option>
                        <option value="PI">Piauí (PI)</option>
                        <option value="RJ">Rio de Janeiro (RJ)</option>
                        <option value="RN">Rio Grande do Norte (RN)</option>
                        <option value="RS">Rio Grande do Sul (RS)</option>
                        <option value="RO">Rondônia (RO)</option>
                        <option value="RR">Roraima (RR)</option>
                        <option value="SC">Santa Catarina (SC)</option>
                        <option value="SP">São Paulo (SP)</option>
                        <option value="SE">Sergipe (SE)</option>
                        <option value="TO">Tocantins (TO)</option>
                    </select>                    
                    <input type="text" placeholder="cidade" name="cidade" id="cidade" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3"></span>
                    <input type="text" placeholder="bairro" name="bairro" id="bairro" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3"></span>
                    <input type="text" placeholder="logradouro" required name="logradouro" id="logradouro" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3"></span>
                    <input type="text" placeholder="numero" required name="numero" id="numero" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3"></span>
                    <input type="text" name="responsavel" oninput="responsavelValidate()" placeholder="responsavel" id="responsavel" class="bg-gray-100 mt-5 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Nome do responsável deve ter no mínimo 2 caracteres</span>
                    <input type="text" name="telefone" data-mask="(00) 00000-0000" placeholder="telefone" id="telefone" oninput="phoneValidate()"  class="bg-gray-100 mt-5 mb-10 p-2 outline-none border border-zinc-900">
                    <span class="span-required mb-3">Telefone inválido</span>
                     <input type="submit" value="Cadastrar" class="bg-red-600 p-2 mb-3 text-white cursor-pointer transition-all duration-500 hover:bg-red-500">
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