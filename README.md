# Teste de Desenvolvimento - Full Stack
Teste realizado em php 8.1 com Laravel 10 e Vue.js 3

## Requisitos
- Docker
- PHP 8.1
- MySQL 8.0
- Node 20
- Composer

## Instalação
1. Clone o repositório
2. Copie o arquivo `.env.example` para `.env`
3. Na raíz do projeto, vá para o diretório do docker `cd docker_conf`
4. Crie a rede do docker `docker network create --subnet=172.18.0.0/16 php-apache`
5. Suba os containers `docker compose up -d --build`
6. Gere a chave do projeto `php artisan key:generate`
7. Na raíz do projeto, instale as dependências do projeto `composer install`
8. Na raíz do projeto, instale as dependências do node `npm install`
9. Em uma aba do terminal, rode o comando `npm run dev` para compilar os assets
10. Em outra aba do terminal, rode o comando `php artisan migrate` para criar as tabelas no banco de dados
11. Na mesma aba rode o comando `php artisan serve` para subir o servidor e acesse o projeto em `http://localhost:8000`

## Base de dados
- O banco de dados é criado automaticamente ao rodar o comando `php artisan migrate`
- Acesse o adminer em `http://localhost:8080` com as credenciais:
  - Sistema: MySQL
  - Servidor: db
  - Usuário: root
  - Senha: 1234
  - Banco de dados: prodemge-db

### Erros comuns
- Caso algum container não suba, verifique se a porta que ele está tentando subir não está ocupada
- Ao tentar acessar o projeto, se aparecer um erro de permissão, rode o comando `chmod -R 777 storage/ public/` na raíz do projeto
