# API_CODEIGNITER

## Ao clonar o repositório em uma máquina nova, execute o comando dentro dos diretórios backend e frontend:
    composer install 

    php spark serve

## Ao atualizar seu repositório substitua o composer install por 
    composer update

## Dependendo do tipo de instalação ou distribuição do PHP, você irá precisar descomentar linhas de extensões no arquivo php.ini:
    extension=curl
    extension=intl

## Para o banco de dados SQLite3, você também irá precisar descomentar linhas no arquivo php.ini:
    extension=pdo_sqlite
    extension=sqlite3

## Ativando roteamento automático:
Em “app/Config/Routes.php”, adicione a seguinte linha de código:
    $routes->setAutoRoute(true);

No arquivo “app/Config/Feature.php”, altere a seguinte variável para true:
    public bool $autoRoutesImproved = true;


## Enquanto em desenvolvimento: 
Alterar a extensão do arquivo env para .env
Descomentar a linha que declara a constante “CI_ENVIRONMENT”. 
Altere o valor dessa linha para:
    CI_ENVIRONMENT = development


## Primeira Instalação. Para um novo projeto
Para instalar o CodeIgniter digitamos os seguintes comandos: 

    composer create-project codeigniter4/appstarter backend

    composer create-project codeigniter4/appstarter frontend

