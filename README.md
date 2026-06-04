# 🏥 MediAgenda

Sistema web para gerenciamento de clínicas médicas desenvolvido em PHP e MySQL. O projeto permite controlar consultas, médicos, especialidades e usuários, centralizando as principais operações administrativas de uma clínica em uma única plataforma.

---

## ✨ Funcionalidades

* 📅 Visualização mensal de consultas em calendário.
* 👨‍⚕️ Cadastro e gerenciamento de médicos.
* 🩺 Controle de especialidades médicas.
* 📋 Agendamento, edição, confirmação e cancelamento de consultas.
* 🔐 Sistema de autenticação e gerenciamento de sessões.
* 👤 Atualização de perfil de usuário.
* 🗑️ Cancelamento lógico (soft delete) de registros.

---

## 🛠️ Tecnologias Utilizadas

### Backend

* PHP 7.4+
* Composer
* vlucas/phpdotenv

### Banco de Dados

* MySQL / MariaDB
* Views SQL para relatórios e consultas otimizadas

### Frontend

* HTML5 / CSS3
* Bootstrap 5
* Font Awesome 6
* Select2
* SweetAlert2

### Infraestrutura
* Docker & Docker Compose

---

## 🏗️ Arquitetura

O projeto segue uma estrutura baseada em PHP estruturado, organizada para separar responsabilidades entre interface, persistência de dados e regras de negócio.

Principais componentes:

* Interface de usuário construída com Bootstrap.
* Persistência de dados em MySQL/MariaDB.
* Configuração segura de credenciais via arquivo `.env`.
* Controle de autenticação baseado em sessões PHP.
* Orquestração do ambiente de desenvolvimento e produção através de containers Docker.

---

## 📋 Requisitos

**Para rodar via Docker (Recomendado):**
* Docker
* Docker Compose
* Composer (para instalar as dependências localmente antes de rodar os containers)

**Para rodar nativamente:**
* PHP 7.4 ou superior
* Composer 2.x
* MySQL 8+ ou MariaDB 10+
* Extensões PHP: `pdo_mysql`, `mysqli`, `mbstring`

---

# 🚀 Instalação

## 🐳 Via Docker (Recomendado)

A forma mais rápida, padronizada e segura de executar o projeto é utilizando o Docker.

### 1. Clonar o repositório

```bash
git clone [https://github.com/alvarossantos/mediagenda.git](https://github.com/alvarossantos/mediagenda.git)
cd mediagenda

```

### 2. Instalar dependências PHP

Execute o Composer na raiz do projeto para baixar os pacotes necessários na pasta `vendor/`:

```bash
composer install

```

### 3. Configurar ambiente

Crie uma cópia de `.env.example` para `.env`:

```bash
cp .env.example .env

```

*(No Windows, utilize: `copy .env.example .env`)*

Abra o arquivo `.env` gerado e ajuste o `DB_HOST` para `db` (nome do serviço no Docker) e as demais credenciais caso tenha alterado no arquivo `docker-compose.yml`. Exemplo:

```env
DB_HOST=db
DB_PORT=3306
DB_DATABASE=labdbprog2
DB_USERNAME=root
DB_PASSWORD=sua_senha

```

### 4. Iniciar os Containers

Execute o comando abaixo na raiz do projeto. O Docker irá construir a imagem do PHP c/ Apache, baixar a imagem do MariaDB e executar automaticamente o `script.sql` para inicializar as tabelas do banco:

```bash
docker-compose up -d

```

Acesse o sistema no navegador:

```text
http://localhost:8000

```

*(Para parar a aplicação, utilize `docker-compose down`)*

---

## 🖥️ Instalação Tradicional (Nativa)

### Linux (Ubuntu/Debian)

1. Instale as dependências:

```bash
sudo apt update
sudo apt install php php-cli php-mysql php-mbstring mariadb-server composer
# Arch: 
# sudo pacman -Syu
# sudo pacman install php php-cli php-mysql php-mbstring mariadb-server
# Fedora:
# sudo dnf update
# sudo dnf install php php-cli php-mysql php-mbstring mariadb-server
```

2. Configure o banco de dados:

```bash
sudo mysql -u root -p
source script.sql;
exit;

```

3. Instale as bibliotecas e inicie o servidor PHP embutido (apontando para a pasta `src/`):

```bash
composer install
cp .env.example .env # Não se esqueça de preencher as credenciais!
php -S localhost:8000 -t src/

```

### Windows (Laragon / XAMPP)

1. Clone o projeto na sua pasta de projetos web (Ex: `C:\xampp\htdocs\mediagenda` ou `C:\laragon\www\mediagenda`).
2. Abra o terminal na raiz do projeto e rode `composer install`.
3. Importe o arquivo `script.sql` no banco de dados via interface (ex: phpMyAdmin).
4. Crie o arquivo `.env` baseado no `.env.example` e coloque suas credenciais do banco local.
5. Acesse o projeto via navegador, lembrando de apontar para a pasta `src/`. Ex: `http://localhost/mediagenda/src`.

---

## 🔑 Usuários de Teste

> ⚠️ Credenciais destinadas apenas para ambiente de desenvolvimento.

| Perfil | Usuário | Senha |
| --- | --- | --- |
| Administrador | professor | professor123 |
| Operador | aluno | 123456 |

---

## 📁 Estrutura do Projeto

Com a adoção do Docker, a estrutura do projeto foi otimizada para aumentar a segurança.

```text
mediagenda/
│
├── src/                      # Código fonte da aplicação web (DocumentRoot)
│   ├── conexao.php
│   ├── index.php
│   ├── login.php
│   ├── principal.php
│   ├── cadastro_agendas.php
│   ├── cadastro_medicos.php
│   ├── cadastro_especialidades.php
│   └── perfil.php
├── docker-compose.yml        # Configuração dos serviços Docker (App e Banco)
├── Dockerfile                # Configuração da imagem do PHP com Apache e mysqli
├── script.sql                # Estrutura e dados iniciais do banco
├── composer.json             # Dependências do PHP
├── .env.example              # Exemplo de variáveis de ambiente
└── vendor/                   # Instalado via composer (Fica fora do DocumentRoot)

```

---

## 🔒 Segurança

* As credenciais sensíveis são armazenadas exclusivamente no arquivo `.env`.
* A pasta `src/` está mapeada como a raiz exposta do servidor (DocumentRoot) no Docker. Isso é uma excelente prática, pois impede que usuários acessarem seu arquivo `.env` ou o código-fonte das dependências (`vendor/`) diretamente pela URL.
* O sistema conta com proteção de sessões PHP e exclusão lógica (soft delete) para preservação de histórico.

---

## 🚧 Melhorias Futuras

* Notificações por e-mail
* Dashboard com métricas e gráficos
* Controle de permissões por perfil
* Histórico completo de consultas
* API REST para integração externa
* Responsividade avançada para dispositivos móveis

---

## 📄 Licença

Este projeto está licenciado sob a licença MIT.

Consulte o arquivo `LICENSE` para mais informações.

```