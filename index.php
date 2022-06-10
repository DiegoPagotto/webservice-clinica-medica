<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WebService Clínica Médica</title>
    </head>
    <body>
        <h1>WebService Clínica Médica</h1>
        <p>Este webservice JSON didático contém um sistema de exemplo de uma clínica médica, formada por <b>pacientes</b>,
            <b>médicos</b>, <b>especializações</b> e <b>consultas</b>. Para entrar, o usuário deve criar e fazer o login de Admin para realizar qualquer operação no sistema. Veja detalhes do login na rota administradores.php</p>
        <h2>As rotas disponíveis são:</h2>
        <p><a href="administradores.php">administradores.php</a> suporta as seguintes operações:</p>
        <ul>
            <li>PUT- adicionar um novo administradores. Requer parâmetros login e senha.O login deve ser unico</li>
            <li>POST - Usado para login. Requer parâmetros login e senha.</li>
        </ul>
        <p><a href="pacientes.php">pacientes.php</a> suporta as seguintes operações:</p>
        <ul>
            <li>GET - Listar todos os pacientes.</li>
            <li>POST - Adicionar um novo paciente. Requer parâmetros nome e dataNascimento (no formato YYYY-MM-DD)..</li>    
            <li>PUT - Edita um paciente. Requer parâmetro id,nome dataNascimento (no formato YYYY-MM-DD).</li>
            <li>DELETE - Remove um paciente. Requer parâmetro id.</li>
        </ul>
        <p><a href="medicos.php">medicos.php</a> suporta as seguintes operações:</p>
        <ul>
            <li>GET - Listar todos os médicos.</li>
            <li>POST - Adicionar um novo médico. Requer parâmetros nome,id_especialidade.</li>
            <li>PUT - Edita um médico. Requer parâmetro id,nome,id_especialidade.</li>
            <li>DELETE - Remove um médico. Requer parâmetro id.</li>
        </ul>
        <p><a href="consultas.php">consultas.php</a> suporta as seguintes operações:</p>
        <ul>
            <li>GET - Listar todas as consultas.</li>
            <li>POST - Adicionar uma nova consulta. Requer parâmetros idPaciente,idMedico,data (no formato YYYY-MM-DD HH:mm)).</li>
            <li>PUT - Edita uma consulta. Requer parâmetro id,idPaciente,idMedico,data (no formato YYYY-MM-DD HH:mm).</li>
            <li>DELETE - Remove uma consulta. Requer parâmetro id.</li>
        </ul>
        <p><a href="especialidades.php">especialidades.php</a> suporta as seguintes operações:</p>
        <ul>
            <li>GET - Listar todas as especialidades.</li>
        </ul>
    </body>
</html>