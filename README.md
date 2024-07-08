
<div align="center">
    
  <p>
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white">
    <img src="https://img.shields.io/badge/Docker-2CA5E0?style=for-the-badge&logo=docker&logoColor=white">
    <img src="https://img.shields.io/badge/Nginx-009639?style=for-the-badge&logo=nginx&logoColor=white">
    <img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white">
  </p>
</div><br>

<section id="test-db" style="padding: 10px;">
<h2>Running and testing our project.</h2>
<p>Com tudo já configurado chegou de rodar nosso ambiente.</p>
<p>No seu terminal navegue até o diretório <code>/environmentProject/</code> e passe o comando para o docker-compose começar a construir os containers:</p>
<pre>
docker-compose build
</pre>
<p>Assim que a execução do comando for finalizada entre com o comando para começar a rodar os containers:</p>
<pre>
docker-compose up -d
</pre>
<p>Feito isso basta entrar no seu <a href="https://localhost">localhost:8082</a> e pronto! </p>
<p>Caso queira testar sua conexão via Laravel você vai precisar editar o arquivo /example-app/.env e setar as seguintes configurações:</p>
<pre>
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=test_db
DB_USERNAME=devuser
DB_PASSWORD=devpass
</pre>
<p>Feito isso, salve e execute os seguintes comandos no seu terminal:</p>
<pre>
docker exec (container_id) composer dump-autoload
docker exec (container_id) php artisan migrate
</pre>
<p>Caso não receba nenhuma mensagem de erro sua conexão com o banco de dados está ok e você está pronto para começar!</p>
</section>



