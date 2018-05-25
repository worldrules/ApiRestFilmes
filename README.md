# ApiRestFilmes

Teste Realizado para Empresa

Senhores, estou a realizar um teste na qual foi solicitado realizar uma API Rest , em qualquer linguagem , qualquer modinha, digo qualquer framework

e então se possível hospedar no heroku , e lá vamos nós.


Sobre o APP em sí:

- CRUD básico para Filmes ! (Create, Read, Update and Delete)
- Usando REST ( Representational State Transfer )
- Banco de Dados MySQL



Para iniciantes: Foi usado somente PHP , e servidor APACHE com XAMPP. Hospedagem cloud com HEROKU, Banco de Dados MySQL.



---- Possível Solução para o Problema do HackerRank ----



$handle = fopen("php://stdin","r");

$n = intval(fgets($handle));


for ($rows = 0; $rows < $n; $rows++) {

    for ($columns = 0; $columns < $n - $rows - 1; $columns++) {

        echo " ";
    }

    for ($columns = 0; $columns < $rows + 1; $columns++) {

        echo "#";
    }

echo "\n";

}


