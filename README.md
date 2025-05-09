# CRM Laravel - Projeto CRUD com Autenticação

Este projeto é um sistema simples de CRM desenvolvido com Laravel. Ele permite o gerenciamento de registros (CRUD) e possui autenticação de usuários (login e registro).

## ✅ Funcionalidades

- Cadastro, edição e exclusão de clientes (CRUD)
- Autenticação com login, registro e logout
- Validações de formulário
- Interface simples e funcional

## 🚀 Tecnologias Utilizadas

- PHP >= 8.1
- Laravel >= 10.x
- MySQL
- Composer
- Blade (template engine)
- Laravel Breeze ou outro pacote de autenticação (dependendo do seu setup)

## 🧰 Pré-requisitos

Antes de rodar o projeto, certifique-se de ter os seguintes softwares instalados:

- PHP (>= 8.1)
- Composer

## 💻 Como rodar o projeto

Siga os passos abaixo para configurar o projeto na sua máquina local:




 ### 1. Comandos para rodas o projeto

 - composer install
 - php artisan key:generate
 - php artisan migrate
 - Por fim, rode php artisan serve


### Configure o banco
```bash


APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
