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

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=heroes
DB_USERNAME=heroes
DB_PASSWORD=heroes@mysql


MONGODB_HOST=mongodb
MONGODB_PORT=27017
MONGODB_DATABASE=heroes
MONGODB_USERNAME=heroes
MONGODB_PASSWORD=heroes@mongo

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

```
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
