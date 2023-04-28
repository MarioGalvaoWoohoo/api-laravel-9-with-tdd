# Desenvolvimento de Aplicação Web com Test Driven Development, Docker, Laravel 9 ,PHP 8.2 e CI/CD Github Action
Este é um projeto de demonstração que utiliza a metodologia de desenvolvimento Test Driven Development (TDD) para criar uma aplicação web utilizando o framework Laravel 9 e PHP 8.2. A fim de tornar a instalação e execução do projeto mais fácil e conveniente, a aplicação está contida em um ambiente Docker.

Além disso, o projeto conta com integração contínua e entrega contínua (CI/CD) através do GitHub Actions. O GitHub Actions é uma ferramenta de automação que permite configurar fluxos de trabalho automatizados, como testes e implantação de código. Neste projeto, são realizados testes automatizados sempre que um pull request é aberto ou uma alteração é feita no código, garantindo a qualidade do software produzido.

Com o uso do GitHub Actions, também é possível implementar a entrega contínua, permitindo a implantação automática da aplicação em um servidor de produção sempre que uma alteração no código é realizada e passa nos testes automatizados. Isso reduz o tempo entre a escrita do código e a implantação, garantindo que os usuários tenham acesso às últimas atualizações do software.

Em resumo, este projeto demonstra a utilização de TDD em conjunto com o Docker, Laravel 9 e PHP 8.2, bem como a integração contínua e entrega contínua através do GitHub Actions. Isso ajuda a garantir a qualidade do código produzido e a aumentar a eficiência do processo de desenvolvimento de software.

# Instalação
Antes de começar, certifique-se de ter o Docker instalado em sua máquina. Você pode baixá-lo em https://www.docker.com/products/docker-desktop.

Para instalar e executar este projeto, siga os seguintes passos:

* Clone este repositório em sua máquina local usando o comando git clone https://github.com/MarioGalvaoWoohoo/api-laravel-9-with-tdd.git
* Navegue até dentro do diretório do projeto clonado.
* Crie um arquivo .env na raiz do projeto e copie o conteúdo do arquivo .env.example para ele.
* Execute o comando docker-compose up -d para iniciar o ambiente Docker.
* Com o projeto up, execute o comando docker exec -it api-message bash . Desta forma vc entrará dentro do container.
* Execute o comando composer install e espere a instalação das dependências.
* Execute o comando php artisan key:generate para gerar a chave de criptografia do Laravel.
* Execute o comando php artisan artisan migrate para criar as tabelas do banco de dados.

Pronto! Você pode acessar a aplicação em http://localhost:8181.

## Testes
Este projeto usa TDD, o que significa que os testes são escritos antes do código. Os testes estão localizados no diretório tests e podem ser executados usando o comando docker-compose exec app php artisan test, mas se tiver dentro do container, precisará digitar apenas php artisan test.

## CI/CD Github Action
Ao realizar um push na branch main, automaticamente é executado a pipe executando os testes, o deploy e build da imagem no DockerHub.
* **Step de testes** - *Executa todos os testes da aplicação, se todos forem executados com sucesso passará para o proximo step* 
* **Step de deploy** - *Executa deploy atualizando o ambiente de produção. Apena será executado se passar nos teste* 
* **Step de Build** - *Executa o build da imagem no Dockerhub, só é executado se deploy executar com sucesso* 

## Conclusão
Este é apenas um projeto de demonstração que usa TDD para criar uma aplicação web usando o Laravel 9 e PHP 8.2. Você pode usar este projeto como ponto de partida para criar sua própria aplicação usando TDD e Laravel.

Se você tiver alguma dúvida ou sugestão, sinta-se à vontade para abrir uma issue neste repositório. Obrigado por usar este projeto!






