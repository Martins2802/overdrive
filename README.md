## Como utilizar
 1- Baixe o WampServer no site oficial e siga as instruções para instalar na sua máquina
 2- Baixe a base de dados overdrive.sql
 3- Com o Wampserver instalado, inicie o mesmo (isso pode ser feito clicando no ícone da área de trabalho ou na barra de tarefas)
 4- Garanta que o servidor Mysql esteja funcionando corretamente (geralmente o wamp apresenta um ícone verde ou laranja em caso de êxito)
 5- Com o wampserver, inicialize o phpmyadmin e logue com usuário e senha do seu servidor Mysql. Por padrão, o usuário é root e a senha fica em branco
 6- Crie um novo banco de dados com o nome "Overdrive", por exemplo, e importe o sql baixado
 7- Adicionar o projeto na pasta WWW do wamp (geralmente se encontra em C:\wamp\www)
 8- Na barra de endereços do navegador, digite localhost/nomedoseuprojeto na barra de endereços. (substitua "nomedoseuprojeto" pelo nome do seu projeto)
 9- Logue como usuário ou empresa
 10- Em caso de estar logado como admin, teste as funcionalidades de criar, editar e remover usuários e empresas

### Exemplo de usuário admin:
    cpf: 111.111.111-11
    senha: 12345678

### Exemplo de usuário comum:

    cpf: 555.555.555-55
    senha: segredo123

### Exemplo de empresa:
    cnpj: 12.345.678/0001-23
    senha: jeff1234
