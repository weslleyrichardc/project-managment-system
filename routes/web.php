<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'name' => 'Sistema de Gerenciamento de Projetos',
        'description' => 'Este sistema de gerenciamento de projetos foi desenvolvida com Laravel 10, MySQL e BrazilAPI. Com ele, os usuários podem criar projetos, adicionar tarefas. O sistema utiliza autenticação JWT para garantir a segurança dos dados e proteger os endpoints de acesso não autorizado. A documentação usando o postman, juntamente com testes automatizados, garante a qualidade do código e a facilidade de manutenção. Com este sistema, os usuários podem gerenciar seus projetos.',
        'author' => 'Weslley Richard',
        'endpoints' => [
            'auth' => [
                'login' => [
                    'url' => '/api/login',
                    'method' => 'POST',
                    'description' => 'Realiza a autenticação do usuário e retorna o token de acesso.',
                    'parameters' => [
                        'email' => 'E-mail do usuário',
                        'password' => 'Senha do usuário',
                    ],
                ],
                'register' => [
                    'url' => '/api/register',
                    'method' => 'POST',
                    'description' => 'Realiza o cadastro de um novo usuário.',
                    'parameters' => [
                        'name' => 'Nome do usuário',
                        'email' => 'E-mail do usuário',
                        'password' => 'Senha do usuário',
                        'password_confirmation' => 'Confirmação da senha do usuário',
                    ],
                ],
                'logout' => [
                    'url' => '/api/logout',
                    'method' => 'POST',
                    'description' => 'Realiza o logout do usuário.',
                    'parameters' => [],
                ],
                'refresh' => [
                    'url' => '/api/refresh',
                    'method' => 'POST',
                    'description' => 'Atualiza o token de acesso do usuário.',
                    'parameters' => [],
                ],
            ],
            'addresses' => [
                'store' => [
                    'url' => '/api/addresses',
                    'method' => 'POST',
                    'description' => 'Cria um novo endereço para o usuário autenticado. O endereço é completado utilizando a API BrazilAPI quando informado apenas zip_code e number.',
                    'parameters' => [
                        'zip_code' => 'CEP do endereço',
                        'number' => 'Número do endereço',
                        'street' => 'Rua do endereço',
                        'neighborhood' => 'Bairro do endereço',
                        'city' => 'Cidade do endereço',
                        'state' => 'Estado do endereço',
                    ],
                ],
                'update' => [
                    'url' => '/api/addresses/{id}',
                    'method' => 'PUT',
                    'description' => 'Atualiza os dados de um endereço específico.',
                    'parameters' => [
                        'id' => 'ID do endereço',
                        'zip_code' => 'CEP do endereço',
                        'number' => 'Número do endereço',
                        'street' => 'Rua do endereço',
                        'neighborhood' => 'Bairro do endereço',
                        'city' => 'Cidade do endereço',
                        'state' => 'Estado do endereço',
                    ],
                ],
                'destroy' => [
                    'url' => '/api/addresses/{id}',
                    'method' => 'DELETE',
                    'description' => 'Remove um endereço específico.',
                    'parameters' => [
                        'id' => 'ID do endereço',
                    ],
                ],
            ],
            'projects' => [
                'index' => [
                    'url' => '/api/projects',
                    'method' => 'GET',
                    'description' => 'Retorna todos os projetos do usuário autenticado.',
                    'parameters' => [],
                ],
                'store' => [
                    'url' => '/api/projects',
                    'method' => 'POST',
                    'description' => 'Cria um novo projeto para o usuário autenticado.',
                    'parameters' => [
                        'name' => 'Nome do projeto',
                        'description' => 'Descrição do projeto',
                    ],
                ],
                'show' => [
                    'url' => '/api/projects/{id}',
                    'method' => 'GET',
                    'description' => 'Retorna os dados de um projeto específico.',
                    'parameters' => [
                        'id' => 'ID do projeto',
                    ],
                ],
                'update' => [
                    'url' => '/api/projects/{id}',
                    'method' => 'PUT',
                    'description' => 'Atualiza os dados de um projeto específico.',
                    'parameters' => [
                        'id' => 'ID do projeto',
                        'name' => 'Nome do projeto',
                        'description' => 'Descrição do projeto',
                    ],
                ],
                'destroy' => [
                    'url' => '/api/projects/{id}',
                    'method' => 'DELETE',
                    'description' => 'Remove um projeto específico.',
                    'parameters' => [
                        'id' => 'ID do projeto',
                    ],
                ],
            ],
            'tasks' => [
                'index' => [
                    'url' => '/api/tasks',
                    'method' => 'GET',
                    'description' => 'Retorna todas as tarefas do usuário autenticado.',
                    'parameters' => [],
                ],
                'store' => [
                    'url' => '/api/tasks',
                    'method' => 'POST',
                    'description' => 'Cria uma nova tarefa para o usuário autenticado.',
                    'parameters' => [
                        'name' => 'Nome da tarefa',
                        'description' => 'Descrição da tarefa',
                        'project_id' => 'ID do projeto',
                    ],
                ],
                'show' => [
                    'url' => '/api/tasks/{id}',
                    'method' => 'GET',
                    'description' => 'Retorna os dados de uma tarefa específica.',
                    'parameters' => [
                        'id' => 'ID da tarefa',
                    ],
                ],
                'update' => [
                    'url' => '/api/tasks/{id}',
                    'method' => 'PUT',
                    'description' => 'Atualiza os dados de uma tarefa específica.',
                    'parameters' => [
                        'id' => 'ID da tarefa',
                        'name' => 'Nome da tarefa',
                        'description' => 'Descrição da tarefa',
                        'project_id' => 'ID do projeto',
                    ],
                ],
                'destroy' => [
                    'url' => '/api/tasks/{id}',
                    'method' => 'DELETE',
                    'description' => 'Remove uma tarefa específica.',
                    'parameters' => [
                        'id' => 'ID da tarefa',
                    ],
                ],
            ],
            'users' => [
                'show' => [
                    'url' => '/api/user',
                    'method' => 'GET',
                    'description' => 'Retorna os dados do usuário autenticado.',
                    'parameters' => [],
                ],
            ],
        ],
    ]);
});
