# Nome do Projeto

Descrição breve do seu projeto aqui.

## 🚀 Tecnologias

Este projeto foi desenvolvido com as seguintes tecnologias:

- [Laravel](https://laravel.com/) - Framework PHP
- [Vue.js](https://vuejs.org/) - Framework JavaScript
- [Inertia.js](https://inertiajs.com/) - Para integração Laravel + Vue.js

## 📋 Pré-requisitos

Antes de começar, você precisa ter instalado:

- PHP >= 8.1
- Composer
- Node.js >= 16
- NPM ou Yarn
- MySQL/PostgreSQL (ou outro banco de sua preferência)

## 🔧 Instalação

Siga os passos abaixo para configurar o projeto localmente:

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### 2. Instale as dependências do PHP

```bash
composer install
```

### 3. Instale as dependências do Node.js

```bash
npm install
```

### 4. Configure o arquivo de ambiente

```bash
cp .env.example .env
```

Edite o arquivo `.env` e configure suas variáveis de ambiente, especialmente as credenciais do banco de dados.

### 5. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 6. Execute as migrations

```bash
php artisan migrate
```

### 7. (Opcional) Execute os seeders

```bash
php artisan db:seed
```

## ▶️ Executando o projeto

Para executar o projeto, você precisa rodar dois comandos em terminais separados:

### Terminal 1 - Servidor Laravel

```bash
php artisan serve
```

A aplicação estará disponível em `http://localhost:8000`

### Terminal 2 - Build do front-end (Vue.js)

```bash
npm run dev
```

Isso iniciará o Vite em modo de desenvolvimento e compilará os assets do Vue.js com Inertia.

## 📦 Build para produção

Para gerar os arquivos otimizados para produção:

```bash
npm run build
```

## 📝 Licença

Este projeto está sob a licença MIT.

## ✒️ Autor

Seu Nome - [Seu GitHub](https://github.com/seu-usuario)