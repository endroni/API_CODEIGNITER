# API_CODEIGNITER

## Ao clonar o repositório em uma máquina nova, execute o comando dentro dos diretórios backend e frontend:
    composer install 

    php spark serve


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

