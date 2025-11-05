# CRUD Mundo – Sistema de Gerenciamento de Países e Cidades

## Descrição do Projeto
O **CRUD Mundo** é uma aplicação web completa desenvolvida para gerenciar o cadastro de países e cidades. O sistema implementa as operações básicas de CRUD (Criar, Ler, Atualizar, Deletar) para ambas as entidades, estabelecendo um relacionamento de 1:N (um país pode ter várias cidades).

O projeto é construído com foco em mostrar minhas habilidades em desenvolvimento completo de sites.

## Tecnologias Utilizadas
*   **Front-end:** HTML5, CSS3, JavaScript (Vanilla)
*   **Back-end:** PHP (sem frameworks)
*   **Banco de Dados:** MySQL
*   **Integrações:**
    *   REST Countries API (para dados de países)
    *   OpenWeatherMap API (para dados de clima de cidades)

## Instruções de Instalação e Execução

### 1. Pré-requisitos
Certifique-se de ter um ambiente de servidor web (como XAMPP, WAMP, MAMP ou Docker) com:
*   Servidor HTTP (Apache ou Nginx)
*   PHP (versão 7.4 ou superior)
*   MySQL/MariaDB

### 2. Configuração do Banco de Dados
1.  Crie um banco de dados chamado \`bd_mundo\` no seu servidor MySQL.
2.  Importe o arquivo \`db/bd_mundo.sql\` para criar as tabelas \`paises\` e \`cidades\` e popular com dados iniciais.
3.  Edite o arquivo \`backend/config.php\` com as credenciais corretas do seu banco de dados (\`DB_USER\` e \`DB_PASS\`).

### 3. Execução
1.  Coloque a pasta \`crud_mundo\` no diretório raiz do seu servidor web (ex: \`htdocs\` ou \`www\`).
2.  Acesse a aplicação pelo seu navegador: \`http://localhost/crud_mundo/frontend/index.html\` (ou o caminho correspondente).

----
*Este projeto foi desenvolvido como parte de um exercício prático de desenvolvimento web.*
