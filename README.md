<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Medicom - Sistema de Agendamento de Consultas Online

Bem-vindo ao Medicom, seu Sistema de Agendamento de Consultas Online! Este projeto é projetado para facilitar o agendamento de consultas médicas de forma eficiente e conveniente. Antes de começar, certifique-se de seguir as instruções abaixo para configurar corretamente o ambiente de banco de dados.

## Instalação

1. Clone este repositório:

   ```bash
   git clone https://github.com/seu-usuario/medicom.git

2. Navegue até o diretório do projeto:
   
    ```bash
     cd medicom
    
3. Copie o arquivo de ambiente:

    ```bash
    cp .env.example .env

4. Configure o arquivo .env com suas configurações de banco de dados e outras configurações necessárias.

5. Execute o comando de migração para instalar as dependências do banco de dados:
   
     ```bash
    php artisan migrate

## Execução

Agora que você instalou as dependências do banco de dados, você está pronto para iniciar o Medicom. 

1. Utilize o seguinte comando para iniciar o servidor:
   
    ```bash
    php artisan serve

Acesse http://localhost:8000 em seu navegador para começar a usar o sistema de agendamento de consultas online.

Divirta-se utilizando o Medicom para simplificar o processo de agendamento de consultas!
