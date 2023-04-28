# Projeto TDD com Docker, Laravel 9 e PHP 8.2
Este é um projeto de demonstração que usa Test Driven Development (TDD) para criar uma aplicação web usando o framework Laravel 9 e PHP 8.2. A aplicação está contida em um ambiente Docker, o que torna a instalação e execução do projeto mais fácil e conveniente.

# Instalação
Antes de começar, certifique-se de ter o Docker instalado em sua máquina. Você pode baixá-lo em https://www.docker.com/products/docker-desktop.

Para instalar e executar este projeto, siga os seguintes passos:

* Clone este repositório em sua máquina local usando o comando git clone https://github.com/MarioGalvaoWoohoo/api-message.git
* Navegue até o diretório do projeto usando cd nome-do-repositorio
* Execute o comando docker-compose up -d para iniciar o ambiente Docker.
* Execute o comando docker-compose exec app composer install para instalar as dependências do Laravel.
* Crie um arquivo .env na raiz do projeto e copie o conteúdo do arquivo .env.example para ele.
* Execute o comando docker-compose exec app php artisan key:generate para gerar a chave de criptografia do Laravel.
* Execute o comando docker-compose exec app php artisan migrate para criar as tabelas do banco de dados.

Pronto! Você pode acessar a aplicação em http://localhost:8181.

## Testes
Este projeto usa TDD, o que significa que os testes são escritos antes do código. Os testes estão localizados no diretório tests e podem ser executados usando o comando docker-compose exec app php artisan test.

## Conclusão
Este é apenas um projeto de demonstração que usa TDD para criar uma aplicação web usando o Laravel 9 e PHP 8.2. Você pode usar este projeto como ponto de partida para criar sua própria aplicação usando TDD e Laravel.

Se você tiver alguma dúvida ou sugestão, sinta-se à vontade para abrir uma issue neste repositório. Obrigado por usar este projeto!






