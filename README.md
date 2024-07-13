## Instalação
1. Clone o repositório
2. Na raíz do projeto, vá para o diretório do docker `cd docker-conf`
3. Crie a rede do docker `docker network create --subnet=172.18.0.0/16 php-apache`
4. Suba os containers `docker-compose up -d --build`
5. Acesse o container do php `docker exec -it docker_conf-php81-1 bash`
6. Dentro do container, instale as dependências do projeto `composer install`
7. Gere a chave do projeto `php artisan key:generate`

### Erros comuns
- Caso algum container não suba, verifique se a porta que ele está tentando subir não está ocupada
- Ao tentar acessar o projeto, se aparecer um erro de permissão, rode o comando `chmod -R 777 storage/ public/` na raíz do projeto
