## Sistema de cadastro de Produtos

Esse projeto tem como objetivo, criar um sistema (CRUD) de cadastro de produtos, utilizando Laravel 8.
*Necessário ter instalado o PHP 7.3 ou superior para rodar toda a aplicação
*Necessário habilitar algumas extensões no php.ini para realizar a correta instalação da aplicação.

## Conteúdos
- [Instalação](#Instalação)

## Observações:
A criação de usuario administrador esta na ***UserSeeder.php*** dentro de: database/seeders. Caso queira iniciar o sistema com outro usuario ADMINISTRADOR, por favor realizar as alterações de usuario e senha deste arquivo!


## Instalação

1. Clone o repositorio:
   ```bash
   git clone https://github.com/geovanykam190/app-product.git
    ```

2. Va até o diretorio da aplicação:
    ```bash
    cd app-product
    ```

3. Instale as dependencias usando Composer:
   ```bash
   composer install
    ```

4. Configure suas variaveis de ambiente copiando o arquivo `.env.example` e crie seu .env principal:
   ```bash
   cp .env.example .env
    ```

5. Configure conexões de banco de dados e smtp no arquivo `.env` criado.
    *para o smtp um exemplo:
    MAIL_MAILER=smtp
    MAIL_HOST="smtp.hostinger.com"
    MAIL_PORT=465
    MAIL_USERNAME="sendmail@moosetech.com.br"
    MAIL_PASSWORD="Send@123"
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="sendmail@moosetech.com.br"

6. Rode o comando customizado do artisan para criar toda a estrutura de funcionamento do sistema:
    ```bash
    php artisan app:start-project
    ```
  
7. Para iniciar o sistema em Laravel para uso, é necessário rodar o seguinte comando:
   ```bash
   php artisan serve
    ```


## Envio de e-mail para reset de senha
Para testar a funcionalidade de reset de senha, é necessario criar um usuario com um e-mail *válido* e realizar as configurações corretas de SMTP
