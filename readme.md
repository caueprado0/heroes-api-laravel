Heroes API Laravel
===================

O projeto Heroes é um software aberto, desenvolvido pelo Cauê Prado.

Social Media:
```
Github: caueprado0
Instagram: @sigaocaue
```

O objetivo deste software é receber os personagens da Marvel, podendo favoritá-los. O front-end está separado da API.
____

## Instalação
Para efetuar edições neste software,certifique-se que possua os seguintes requisitos:

* Git (versão mínima: 2.7.4)
* Docker (versão mínima: 18.03)
* Docker compose (versão mínima: 1.11.2)

#### 1 - Clone o projeto
____
```
git clone https://github.com/caueprado0/heroes-api-laravel.git
```

#### 2 - Iniciar o container
____
Inicie o container com o seguinte comando:
```
docker-compose up -d
```
#### 3 - Instalando as dependências do PHP
____
Instale as dependências do PHP com o Composer, para isso, é necessário primeiro acessar o container e depois realizar a instalação. Segue abaixo os comandos:
```
docker container exec -it heroes-nginx bash
composer install
```

#### 4 - Criando ambiente de Desenvolvimento
____
**ATENÇÃO esses procedimentos somente devem ser executados em desenvolvimento**

Vamos acessar nosso container, caso, você já esteja dentro dele, ignorar o passo abaixo. Para acessar o container basta:
```
docker container exec -it heroes-nginx bash
```

Agora vamos criar um arquivo com as variáveis de ambiente, esse arquivo é chamado de "*.env*". Para isso basta utilizar o seguinte comando:
```
touch .env
```
Agora com o .env criado, insira o seguinte conteúdo dentro do arquivo:
```
APP_NAME=Heroes
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=single

MARVEL_API_KEY=4...cacb0
MARVEL_API_HASH=4...b440fe

DB_CONNECTION=mongodb
DB_HOST_MONGODB=mongodb
MONGODB_PORT=27017
DB_DATABASE_MONGODB=heroes
DB_USERNAME_MONGODB=heroes
DB_PASSWORD_MONGODB=heroes@mongo

CACHE_DRIVER=redis
SESSION_DRIVER=redis
SESSION_LIFETIME=120
QUEUE_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=heroes@redis
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PASSPORT_TOKENNAME=heroespassport

```
**Atenção nas keys MARVEL_API_KEY e MARVEL_API_HASH você deve informar a sua KEY e a sua HASH.**


Para finalizar o nosso *.env*, execute o seguinte comando:
```
php artisan key:generate
```

Agora vamos informar para o composer mapear os nossos novos arquivos. Dentro container, execute o seguinte comando:
```
composer dump-autoload
```

Com o nosso arquivo *.env* em mãos, vamos criar as tabelas do banco de dados e semear elas com dados de teste. Utilize o seguinte comando:
```
php artisan migrate --seed
```
**Após isso, você está apto para começar o desenvolvimento.**


#### BÔNUS - Criando ambiente de PRODUÇÃO ####
____

Segue abaixo alguns cuidados que devem ser executados quando estivermos em produção:

**Para instalar as dependências  devemos executar:**

```
composer install --no-dev
```

Nunca, ou melhor, devemos ao máximo evitar utilizar o comando composer update em ambiente de produção.


#### 5 - Rotas do Sistema
____

Para todas as rotas é necessário enviar os seguintes cabeçalhos HTTP:
```
Content-Type: application/json
Accept: application/json
```

Já nas rotas protegidas, precisamos passar o Token de Autorização, exemplo:
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aS...
```
Atenção, os exemplos serão sob a library CURL.

**Rotas AUTH:**
```
Cadastrar um usuário: 
curl -X POST \
  http://localhost:8006/api/v1/auth/signup \
  -H 'Accept: application/json' \
  -H 'Content-Type: application/json' \
  -H 'Postman-Token: bb987c4a-ae0c-4ea2-96f6-53c1cbbaac13' \
  -H 'cache-control: no-cache' \
  -d '{
	"nome": "Cauê Prado",
	"email": "caue.prado0@gmail.com",
	"password": "123456",
	"password_confirmation": "123456"
}'

Efetuar login:
curl -X POST \
  http://localhost:8006/api/v1/auth/login \
  -H 'Accept: application/json' \
  -H 'Content-Type: application/json' \
  -H 'Postman-Token: 2f9171f9-519f-4c30-b9e9-349b7cfaa574' \
  -H 'cache-control: no-cache' \
  -d '{
	"email": "caue.prado0@gmail.com",
	"password": "123456"
}'

```

**Rotas Personagens Marvel:**

Lembre-se de obter o token, efetuando o login, antes de atira nesta rota.

```
Obter Todos os Personagens Marvel:
curl -X GET \
  http://localhost:8006/api/v1/personagem \
  -H 'Accept: application/json' \
  -H 'Authorization: Bearer eyJ0eX...' \
  -H 'Content-Type: application/json' \
  -H 'Postman-Token: 0c5bce65-639c-4f81-a128-e8ef31610439' \
  -H 'cache-control: no-cache'

Obter Personagem por ID:
curl -X GET \
  http://localhost:8006/api/v1/personagem/1011164 \
  -H 'Accept: application/json' \
  -H 'Authorization: Bearer eyJ0eX...' \
  -H 'Content-Type: application/json' \
  -H 'Postman-Token: 2fe880df-3154-49f3-af5f-b720f8de1c48' \
  -H 'cache-control: no-cache'

```


**Rotas Resource Favoritar Personagens :**
```
Criar um personagem favorito:
curl -X POST \
  http://localhost:8006/api/v1/favoritos/1011164 \
  -H 'Accept: application/json' \
  -H 'Authorization: Bearer eyJ0eX...' \
  -H 'Content-Type: application/json' \
  -H 'Postman-Token: c0a3a8d3-4048-4751-bf2c-565ffe82bac5' \
  -H 'cache-control: no-cache'

  Obter todos os personagens favoritos cadastrados:
  curl -X GET \
  http://localhost:8006/api/v1/favoritos/ \
  -H 'Accept: application/json' \
  -H 'Authorization: Bearer eyJ0eX...' \
  -H 'Content-Type: application/json' \
  -H 'Postman-Token: 5fac3774-20c3-49b2-a5d3-509bec9729d0' \
  -H 'cache-control: no-cache'

  Deletar um personagem favorito:
  curl -X DELETE \
  http://localhost:8006/api/v1/favoritos/5be8a2143b81eb0020698512 \
  -H 'Accept: application/json' \
  -H 'Content-Type: application/json' \
  -H 'Postman-Token: daa4b7b6-d09d-4481-9a38-8ca01082b31b' \
  -H 'cache-control: no-cache'
```