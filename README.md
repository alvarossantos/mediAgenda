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

* MySQL
* MariaDB
* Views SQL para relatórios e consultas otimizadas

### Frontend

* HTML5
* CSS3
* Bootstrap 5
* Font Awesome 6
* Select2
* SweetAlert2

---

## 🏗️ Arquitetura

O projeto segue uma estrutura baseada em PHP estruturado, organizada para separar responsabilidades entre interface, persistência de dados e regras de negócio.

Principais componentes:

* Interface de usuário construída com Bootstrap.
* Persistência de dados em MySQL/MariaDB.
* Configuração segura de credenciais via arquivo `.env`.
* Controle de autenticação baseado em sessões PHP.

---

## 📋 Requisitos

* PHP 7.4 ou superior
* Composer 2.x
* MySQL 8+ ou MariaDB 10+
* Navegador moderno
* Extensões PHP:

  * pdo_mysql
  * mbstring

---

# 🚀 Instalação

## Linux

### 1. Instalar dependências

Ubuntu/Debian:

```bash
sudo apt update
sudo apt install php php-cli php-mysql php-mbstring mariadb-server composer
```

### 2. Clonar o repositório

```bash
git clone https://github.com/alvarossantos/mediagenda.git
cd mediagenda
```

### 3. Instalar dependências PHP

```bash
composer install
```

### 4. Criar o banco de dados

```bash
sudo mysql -u root -p
```

```sql
source script.sql;
exit;
```

### 5. Configurar ambiente

```bash
cp .env.example .env
```

Edite o arquivo `.env` com suas credenciais:

```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=labdbprog2
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

### 6. Executar o sistema

```bash
php -S localhost:8000
```

Acesse:

```text
http://localhost:8000
```

---

## Windows

### 1. Instalar dependências

Recomenda-se:

* Laragon
* XAMPP

Instale também:

* Composer

### 2. Clonar o projeto

```bash
git clone https://github.com/alvarossantos/mediagenda.git
```

Mova a pasta para:

**XAMPP**

```text
C:\xampp\htdocs\mediagenda
```

**Laragon**

```text
C:\laragon\www\mediagenda
```

### 3. Instalar dependências

```cmd
composer install
```

### 4. Importar banco de dados

Acesse:

```text
http://localhost/phpmyadmin
```

Importe o arquivo:

```text
script.sql
```

### 5. Configurar o arquivo .env

Crie uma cópia de:

```text
.env.example
```

Renomeie para:

```text
.env
```

Exemplo:

```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=labdbprog2
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Executar

Acesse:

```text
http://localhost/mediagenda
```

---

## 🔑 Usuários de Teste

> ⚠️ Credenciais destinadas apenas para ambiente de desenvolvimento.

| Perfil        | Usuário   | Senha        |
| ------------- | --------- | ------------ |
| Administrador | professor | professor123 |
| Operador      | aluno     | 123456       |

---

## 📁 Estrutura do Projeto

```text
mediagenda/
│
├── conexao.php
├── index.php
├── login.php
├── principal.php
├── cadastro_agendas.php
├── cadastro_medicos.php
├── cadastro_especialidades.php
├── perfil.php
├── script.sql
├── .env.example
└── vendor/
```

### Arquivos Principais

| Arquivo                     | Descrição                                          |
| --------------------------- | -------------------------------------------------- |
| conexao.php                 | Conexão com banco utilizando variáveis de ambiente |
| index.php                   | Página inicial                                     |
| login.php                   | Autenticação de usuários                           |
| principal.php               | Dashboard principal                                |
| cadastro_agendas.php        | Gerenciamento de consultas                         |
| cadastro_medicos.php        | Gerenciamento de médicos                           |
| cadastro_especialidades.php | Gerenciamento de especialidades                    |
| perfil.php                  | Atualização de perfil                              |
| script.sql                  | Estrutura e dados iniciais do banco                |

---

## 🔒 Segurança

* Credenciais armazenadas em arquivo `.env`
* Proteção de sessões PHP
* Uso de soft delete para preservação de histórico
* Separação de configuração sensível do código-fonte

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
