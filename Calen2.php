<?php


    
$dataInput = "";
$compromissoInput = "";
$descricaoInput = "";

    if (isset($_POST["data"])){
        $dataInput = $_POST["data"];
    }
    if (isset($_POST["compromisso"])){
        $compromissoInput = $_POST["compromisso"];
    }   
    if (isset($_POST["descricao"])){
        $descricaoInput = $_POST["descricao"];
    }

    //database connecting
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "dbCalen";
    
    
    $conn = mysqli_connect($servername, $username, $password, $dbname); // Create connection
    
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error()); // Check connection
        }
    

$mes = isset($_GET['mes']) ? $_GET['mes'] : date("n");
$ano = isset($_GET['ano']) ? $_GET['ano'] : date("Y");
$data = mktime(0,0,0, $mes, 1, $ano);
$nomeAno = date('Y', $data);
$numeroDoMes = date('n', $data);
$diaDaSemanaInicioMes = date('w', $data);
$qtdDias = date('t', $data);
$diaDaSemanaTerminoMes = date('w', mktime(0,0,0, $mes, $qtdDias, $ano));
$anterior = $mes-1 . "&ano=" . $ano;
$proximo = $mes+1 . "&ano=" . $ano;

if($mes >= 12){
    $proximo = "1&ano=" . ($ano+1);
}

if($mes <= 1){
    $anterior = "12&ano=" . ($ano-1);
}

$mesEstenso = array(
    1=>'Janeiro',
    2=>'Fevereiro',
    3=>'Março',
    4=>'Abril',
    5=>'Maio',
    6=>'Junho',
    7=>'Julho',
    8=>'Agosto',
    9=>'Setembro',
    10=>'Outubro',
    11=>'Novembro',
    12=>'Dezembro',
);

$nomeDoMes = $mesEstenso[$numeroDoMes];

?>
<!DOCTYPE html>
    <html lang="en">
        
        <head>
            
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                
                <title>Document</title>

                <style>
       
                    
                
                    th {
                     text-align: center
                     }

                     h2 {
                         text-align: center
                     }
                 
                     .superior {
                         text-align: center
                     }
                 
                     .col {
                         padding-top: 20px
                     }

                     .d-flex{
                         padding-left: 10px
                     }
                     .formInsert {
                        display:none
                    }
                    .formUpdate {
                        display:none
                    }
                     
                     #anterior {
                         margin-right: 10px
                     }
                     #proximo {
                         margin-left: 10px
                     }
    
                </style>
        </head>
    
    <body>
        

        <div class="row">

            <div class="col">

                <div class="superior">
                    <a href="/teste/Calen2.php?mes=<?= $anterior ?>" class="btn btn-primary mb-2" id="anterior">&lt;</a>

                    <strong><?= $nomeDoMes . '/' . $nomeAno ?></strong>

                    <a href="/teste/Calen2.php?mes=<?= $proximo ?>" class="btn btn-primary mb-2" id="proximo">&gt;</a>
                </div>

    <table class="table table-striped table-bordered">
        <thead>
            <th scope="col">Domingo</th>
            <th scope="col">Segunda</th>
            <th scope="col">Terca</th>
            <th scope="col">Quarta</th>
            <th scope="col">Quinta</th>
            <th scope="col">Sexta</th>
            <th scope="col">Sabado</th>
        </thead>
    
        <tbody>
<?php

// colocar espacamento ate chegar no dia da semana do inicio do mes

    for($i = 1; $i <= $diaDaSemanaInicioMes; $i++){
        echo "<th>" . "" . "</th>";
    }

// percorrer todos os dias montando o calendario

    for($i = 1, $j = $diaDaSemanaInicioMes; $i <= $qtdDias; $i++){
        $j++;
        if($j%7==1){
       
            echo "</tr>" . "<tr>";
        }
    
    echo "<th>" . "<a href='javascript:;' onclick='data(\"" . str_pad("$i", 2, "0", STR_PAD_LEFT) . "\",\"" . str_pad("$mes", 2, "0", STR_PAD_LEFT) . "\",\"$ano\"); revelarInsert();'>" . $i . "</a>" . "</th>";
    
    }

// completar o espacamento que resta

    for($i = $diaDaSemanaTerminoMes; $i < 6; $i++){
        echo "<th>" . "" . "</th>";
    }

?>


        </tbody>
    </table>

</div>

<div class="col">

    <form class="formInsert" id="formInsert" name="form" method="post" action="insert.php" autocomplete="off">
    
        <h1>Cadastro de Compromisso</h1>
        
        <div class="form-row">
        
            <div class="form-group col-md-3">
                <label for="data">Data</label>
                <input type="text" readonly class="form-control" id="data" name="data"></input>
            </div>

            <div class="form-group col-md-6">
                <label for="compromisso">Compromisso</label>
                <input type="text" class="form-control" id="compromisso" name="compromisso"></input>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-9">
                <label for="descreva">Descreva seu compromisso</label>
                <textarea class="form-control" name="descricao" id="descreva" rows="3"></textarea>
            </div>
        </div>

        <input type="submit" class="btn btn-primary mb-2" name="submit" value="Criar compromisso">
        </input>

    </form>
</div>

</div>

<div class="col">

    <form class="formUpdate" id="formUpdate" name="formUpdate" method="post" action="update.php" autocomplete="off">
    
        <h1>Edição de Compromisso</h1>
        
        <div class="form-row">
            
            <div class="form-group col-md-3">
                <label for="id">ID</label>
                <input type="text" readonly class="form-control" id="idUpdate" name="id"></input>
            </div>
            
            
            <div class="form-group col-md-3">
                <label for="data">Data</label>
                <input type="text" readonly class="form-control" id="dataUpdate" name="data"></input>
            </div>

            <div class="form-group col-md-6">
                <label for="compromisso">Compromisso</label>
                <input type="text" class="form-control" id="compromissoUpdate" name="compromisso"></input>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-9">
                <label for="descreva">Descreva seu compromisso</label>
                <textarea class="form-control" name="descricao" id="descricaoUpdate" rows="3"></textarea>
            </div>
        </div>

        <input type="submit" class="btn btn-primary mb-2" name="submit" value="Editar compromisso">
        </input>

    </form>
</div>

</div>

<div>
    <?php 
    
    $sqlSelect = "SELECT * FROM compromisso";

   

        if($result = mysqli_query($conn, $sqlSelect)){

           
           

            if(mysqli_num_rows($result) > 0){
                
                
                    ?>
                    
                    <h2 class="d-flex justify-content-left">Compromissos do Mês</h2>
                    <table class="d-flex table table-striped table-bordered">
                    <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Compromisso</th>
                    <th>Descrição</th>
                    </tr>
                    <?php
                    
                
                while($row = mysqli_fetch_array($result)){
                    
                    $id = $row['id'];
                    $databd = $row['data'];
                    $data = explode("-", $databd);
        
                    $dataOutput = $data[2] . "/" . $data[1] . "/" . $data[0];

                    if($mes == $data[1] && $ano == $data[0]){

                        ?>
                            <th id="id"><?=$id?> </th>
                            <th id="dataOutput"><?=$dataOutput?></th>
                            <th id="compromissoOutput"><?=$row['compromisso']?></th>
                            <th id="descricaoOutput"><?=$row['descricao']?></th>
                            <th><a href='javascript:;' onclick='editarData(document.getElementById("dataOutput").value); editarCompromisso(document.getElementById("compromissoOutput")); editarDescricao(document.getElementById("descricaoOutput")); pegarId(document.getElementById("id")); revelarUpdate();'>Editar Compromisso</a></th>
                            </tr>
                        
                            
                        
            <?php
                    }

                }

                    echo "</table>";
                    

            }
        }
    $conn->close(); 
    ?>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    function data(i, mes, ano){
        document.form.data.value = (i + "/" + mes + "/" + ano);
    }

    function revelarInsert(){
        document.getElementById('formInsert').style.display = 'inline';
    }
    function revelarUpdate(){
        document.getElementById('formUpdate').style.display = 'inline';
    }

    function editarData(dataOuput){
        document.getElementById('dataUpdate').value = (dataOutput.innerHTML);
    }
    function editarCompromisso(compromissoOutput){
        document.getElementById('compromissoUpdate').value = (compromissoOutput.innerHTML);
    }
    function editarDescricao(descricaoOutput){
        document.getElementById('descricaoUpdate').value = (descricaoOutput.innerHTML);
    }
    function pegarId(id){
        document.getElementById('idUpdate').value = (id.innerHTML);
    }
</script>

    </body>
</html>