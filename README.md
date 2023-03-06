# Sistema de Gerenciamento de Projetos

Este sistema de gerenciamento de projetos foi desenvolvida com Laravel 10, MySQL e BrazilAPI. Com ele, os usuários podem criar projetos, adicionar tarefas. O sistema utiliza autenticação JWT para garantir a segurança dos dados e proteger os endpoints de acesso não autorizado. A documentação usando o postman, juntamente com testes automatizados, garante a qualidade do código e a facilidade de manutenção. Com este sistema, os usuários podem gerenciar seus projetos.

## Tecnologias Utilizadas

- Laravel 10
- MySQL 8.0

## Instalação

- Clone este repositório para o seu ambiente local `git clone https://github.com/weslleyrichardc/project-managment-system.git`
- Execute o comando `cp .env.example .env` para criar um arquivo .env
- Abra o arquivo .env e configure as credenciais do banco de dados, sail usa as abaixo por padrão
    - DB_CONNECTION=mysql
    - DB_HOST=mysql
    - DB_PORT=3306
    - DB_DATABASE=project_managment_system
    - DB_USERNAME=sail
    - DB_PASSWORD=password
- Execute o comando `./vendor/bin/sail up` para iniciar o ambiente de desenvolvimento que ficará disponivel enquanto tiver o terminal aberto, ou use `./vendor/bin/sail up -d` para rodar em segundo plano
- Execute o comando `./vendor/bin/sail artisan key:generate` para gerar uma chave de segurança no .env
- Execute o comando `./vendor/bin/sail artisan migrate:fresh` para criar as tabelas do banco de dados

## Uso

- Após iniciar o ambiente de desenvolvimento com o Sail, você pode acessar o sistema através do seu navegador no endereço [localhost](http://localhost). A partir daí, você pode:
    - Registrar, logar, deslogar e atualizar token JWT para acesso ao sistema
    - Criar, atualizar e excluir endereço
        - Ao cadastrar endereço informando apenas CEP e Número, as outras informações são completadas usando a [BrazilAPI](https://brasilapi.com.br/)
    - Criar, visualizar, atualizar e excluir projetos
    - Criar, visualizar, atualizar e excluir tarefas

## [Endpoints](https://elements.getpostman.com/redirect?entityId=248672-8b01a9b4-b9af-4263-966e-1441d92cad77&entityType=collection)
