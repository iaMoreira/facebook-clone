## Projeto: Facebook Clone with Laravel, TDD, Vue & Tailwind CSS

<p  align="center"><img  src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
<p  align="center">

<a  href="https://travis-ci.org/laravel/framework"><img  src="https://travis-ci.org/laravel/framework.svg"  alt="Build Status"></a>

<a  href="https://packagist.org/packages/laravel/framework"><img  src="https://poser.pugx.org/laravel/framework/v/stable.svg"  alt="Latest Stable Version"></a>

![Image of Yaktocat](https://github.com/iaMoreira/facebook-clone/blob/master/prints/print1.png?raw=true)

## Instalação

Clone o repositório:

`git clone https://github.com/iaMoreira/facebook-clone.git`

Entre na pasta:

`cd facebook-clone`

Instale as dependências usando o Composer:

`composer install`

 Copie o arquivo de exemplo de configuração `.env.example` para `.env` e edite o que for necessário:  

`$ cp .env.example .env `

Gere uma nova chave para aplicação:

`php artisan key:generate`

 Faça a migração e popule o seu banco de dados:

`$ php artisan migrate`

Baixe as dependências do VueJs: 

`$ npm install`

Transpile o código do VueJs:  

`$ npm run dev`

Inicie o seu próprio servidor:

`$ php artisan serve`

Ou entre pelo servidor HTTP Apache.

## Executando Teste TDD 

No diretótio do projeto execute o `phpunit` para executar o script de testes

`$ ./vendor/bin/phpunit`

