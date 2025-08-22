# Laravel Analysis

## Tecnologias

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-%234F5B93.svg?style=for-the-badge&logo=php&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-%230249ED.svg?style=for-the-badge&logo=docker&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-%2307405E.svg?style=for-the-badge&logo=sqlite&logoColor=white)
- **Framework:** Laravel 10  
- **PHP:** ^8.2  
- **Containers:** Docker 
- **Banco de dados:** SQLite  

---

##  Funcionalidade Principal

- A API possui um endpoint que retorna o total dos valores registrados nos últimos 10 anos, multiplicado por 1.07 e arredondado:

    ```http
    GET /api/analysis

    {
      "result": 123.45
    }

---

##  Setup e Uso com Docker

### Pré-requisitos

- Git
- Docker

### Passos

1. Clone o projeto:
   ```bash
   git clone https://github.com/brun0muril0/laravel-analysis.git
   cd laravel-analysis

2. Crie o `.env` baseado no `.env.example`: 
    ```bash
    cp .env.example .env

3. Após criar o `.env`, remova a conexão com o banco MySql e substitua pelo SQLite:
    ```bash
    DB_CONNECTION=sqlite

4. Construa e execute o container:
   ```bash
   docker build -t api_laravel_analysis .
   docker run --rm -d -p 3000:3000/tcp -p 8000:8000/tcp api_laravel_analysis:latest

5. A API estará disponível em:
   ```arduino
   http://localhost:3000

## Rotas Disponíveis

A aplicação possui o seguinte endpoint:

| Método | Endpoint       | Descrição                     |
|--------|----------------|-------------------------------|
| GET    | /api/analysis  | Retorna o resultado da soma dos valores no período solicitado |

**Exemplo de requisição:**

    curl http://localhost:3000/api/analysis

**Exemplo de resposta:**

    {
      "result": 123.45
    }

## Estrutura Interna

A aplicação segue uma arquitetura simples de Model + Controller + Service:

- **Model (`Data`)**  
  - Representa a tabela `data` no banco de dados.  
  - Utilizada pelo `AnalysisService` para consultar os valores dos últimos 10 anos.

- **Controller (`AnalysisController`)**  
  - Expõe o endpoint `/api/analysis`.  
  - Recebe a requisição e delega o processamento para o service.

- **Service (`AnalysisService`)**  
  - Consulta os valores da tabela `data` referentes aos últimos 10 anos via `Data::where(...)`.  
  - Aplica o multiplicador `1.07` e soma os valores.  
  - Retorna o resultado arredondado como float.

- **Resposta JSON**  
  - O controller retorna o resultado em formato JSON:
    ```json
    { "result": 123.45 }

## Boas Práticas Aplicadas

- **Injeção de dependência**: o service (`AnalysisService`) é injetado via construtor no controller, facilitando testes e desacoplamento da lógica de negócio.  
- **Tratamento de erros**: uso de `try/catch` para capturar exceções, registro em logs e retorno de resposta genérica sinalizando o erro ao cliente.  
- **Docker simplificado**: toda a construção e execução da aplicação é feita via Dockerfile. O Dockerfile instala dependências, cria o banco SQLite, ajusta permissões, gera `APP_KEY`, aplica migrations e executa seeders automaticamente.  
- **Volumes e permissões**: o Dockerfile já garante permissões corretas em `storage`, `bootstrap/cache` e `database`, preservando dados e permitindo execução sem problemas de acesso.  
- **Código limpo e organizado**: separação clara entre controller, service e model (`Data`), seguindo padrões Laravel e facilitando manutenção.






