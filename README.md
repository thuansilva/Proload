<p align="center"><a href="https://www.zapito.com.br/" target="_blank"><img src="https://www.zapito.com.br/landing/img/logo.png" width="400"></a></p>

<!-- <p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p> -->

# Proload - Avaliação de Desenvovimento

Criar um sistema que busca notícias de um feed RSS e usa a API do Zapito para enviá-las por WhatsApp a celulares cadastrados em um painel admin.

## Requistos

-   [x] Desenvolver o sistema usando [Laravel](https://laravel.com/)
-   [x] Criar o painel usando o [Laravel Backpack](https://backpackforlaravel.com);

    -   Não é necessário comprar uma licensa para [instalar](https://backpackforlaravel.com/docs/4.1/installation) o Backpack;
    -   É possível criar [CRUDs simples](https://backpackforlaravel.com/docs/4.1/getting-started-basics) com o Backpack com apenas um `Controller`, sem a necessidade de HTML.

-   [x] Criar um [Dockerfile](https://docs.docker.com/engine/reference/builder/) com o PHP e as dependências para facilitar o _deploy_;

    -   [x] [Docker Compose](https://docs.docker.com/compose/) pode ser utilizado para executar outros serviços, como o servidor HTTP.

-   [ ] Subir o código e rodar o sistema em uma [máquina grátis](https://aws.amazon.com/pt/free) da AWS ;

-   [x] Enviar por e-mail a URL do repositório público contendo o código e o IP do servidor para contato@zapito.com.br com o assunto `TESTE - ZAPITO`.

Mais Informações no [Link](https://github.com/jaysongyn/proload-desafio-2021)

## Detalhes

O sistema deve ter um painel com uma tela de CRUD (criar, listar, atualizar e deletar) dos **destinatários** das mensagens, com no mínimo:

-   Nome
-   Telefone
-   Ativo/Inativo

De tempos em tempos o sistema deve, automaticamente, buscar e processar o feed RSS do [G1](https://g1.globo.com/rss/g1/).

Então, o sistema deve preparar e enviar mensagens via WhatsApp para os telefones dos **destinatários** usando o endpoint `POST /messages` API do Zapito. Olhe no [Documento do zapito](https://zapito.com.br/api/docs).

-   É necessário criar uma conta no [Zapito](https://zapito.com.br) para acessar o token da API;
-   Não é necessário contratar um plano, as mensagens podem ser enviadas com a flag `test_mode`;
-   A mensagem deve conter ao menos o nome do **destinatário** e o título da notícia.

## Rodando o projeto localmente

-   Clone o Projeto;
-   Tenha em sua Maquina o [Composer](https://getcomposer.org/), o [PHP](https://www.php.net/) e o [Docker](https://www.docker.com/) instalado;
-   Ao final execute o comando em seu terminal `composer install`, para instalar todas as dependencias do projeto;
-   Na raiz do projeto crie um novo arquivo chamado `.env` e compie os dados de `.env-exemple`.Mude as variaveis de ambiente caso necessario, e `TOKEN_ZAPITO` (obrigatório). Gere o seu token em [Zapito](https://zapito.com.br).
-   Rode o comando `php artisan key:generate`, para gerar uma nova chave para o projeto, que poderá ser visto em `.env`.

---

-   Ao final do processo feito anteriormente rode o comando `docker-compose up` e aguarde a finalização;
-   Para colocar as tabelas no Banco de dadaos rode `php artisan migrate`;

---

-   Em seu navegado coloque a url `http://localhost/admin/`.Crie seu cadastro e acesse.
-   Ao acessar vá para a opção `Tags` e cadastre o destinatário ao qual será enviada a notícia (em Status são aceito os campos `Ativo/Inativo`).

-   Para enviar as mensagens acesse a rota `http://localhost/admin/tag/messages`.
