<!-- Rafael Santos Salgado 2TID -->
<?php
  $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,"2tid");  
    mysqli_set_charset($con,"utf8");

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Atividade Diagnóstica</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>
        <div class="navs_tab">
            <ul>
                <li>
                    <input type="radio" name="navbar" id="rad_consulta" checked>
                    <label for="rad_consulta" class="btn">Consulta</label>
                    <div class="content">
                        <article>
                            <h3>Consultar Aluno</h3>
                            <form name="consulta" method="post" action="" class="form_consult">
                                <input type="text" name="consult_alu" placeholder="Aluno..." title="Nome do aluno" size="20" required autofocus>
                                
                                <input type="text" name="consult_curso" placeholder="Cursando..." title="em qual curso ele está cadastrado" size="30" >
                                
                                <input type="submit" name="btn_consult" value="Consultar">
                            </form>
                            <div class="registros">
                               <?php
                                if(isset($_POST["btn_consult"])){
                                        
                                    $nome1=$_POST["consult_alu"];
                                    $curso1=$_POST["consult_curso"];
                                    
                                     $sql1="SELECT * FROM tb_aluno WHERE nome LIKE '%$nome1%' AND curso LIKE '%$curso1%'";
                                    
                                    $res=mysqli_query($con,$sql1);
                                    
                                     $lin1=mysqli_num_rows($res);

                                    
                                    
                                    
                                    
                                    if($lin1>0){ 
                                     while($row_info=mysqli_fetch_assoc($res)){

                                    echo "<hr>";
                                     echo " Id: ".$row_info['id']."<br>";
                                   // echo "<hr>";
                                    echo " Nome: ".$row_info['nome']."<br>";
                                    // echo "<hr>";
                                    echo " Celular: ".$row_info['cel']."<br>";
                                   //  echo "<hr>";
                                    echo " Email: ".$row_info['email']."<br>";
                                    // echo "<hr>";
                                    echo " Curso: ".$row_info['curso']."<br>";
                                    echo "<hr>";
                                    
                                    }
                                 }else{echo "Nenhum Registro encontrado";}
                                }
                                ?>
                            </div>
                        </article>
                    </div>
                </li>
                <li>
                    <input type="radio" name="navbar" id="rad_cadastro">
                    <label for="rad_cadastro" class="btn">Cadastro</label>
                    <div class="content">
                        <article>
                           <h3>Cadastrar Aluno</h3>

                              <form name="cad" method="post" action="" class="form_cad">
                                  
                                <input type="text" name="cad_nome" placeholder="Nome Completo" size="60" maxlength="60" pattern="([A-ZÀ-Ú]{1})([a-zà-ú]{1,})(([\s]{1})([A-ZÀ-Ú]{1})([a-zà-ú]{1,}))+" title="Exemplo:Rafael Santos" required >
                             
                                
                                <input type="text" name="cad_cel" placeholder="Celular: DDD XXXXX-XXXX" size="20" maxlength="20" pattern="([0-9]{2})([\s]{1})([0-9]{5})([-]{1})([0-9]{4})" title="Exemplo: DDD xxxxx-xxxx" required>
                                  
                                <input type="email" name="cad_email" placeholder="Email: "size="30" maxlength="50" required>
                                  
                                <input type="text" name="cad_curso" placeholder="Curso: "size="60" maxlength="35" required>
                                  <br>
                                <input type="submit" name="btn_cad" value="Cadastrar" required >
                            </form>
                        </article>
                    </div>
                </li>
            </ul>
        </div>
    </body>
</html>
<?php
    if(isset($_POST["btn_cad"])){
        $nome=$_POST["cad_nome"];
        $cel=$_POST["cad_cel"];
        $email=$_POST["cad_email"];
        $curso=$_POST["cad_curso"];
        
        $sql="INSERT INTO tb_aluno(id,nome,cel,email,curso)VALUES(NULL,'$nome','$cel','$email','$curso')";
        
        mysqli_query($con,$sql);
        $lin=mysqli_affected_rows($con);
        
          if($lin>0){
         echo "<script>alert('Cadastro realizado')</script>";
     }else{
         echo "<script>alert('Erro ao Cadastrar')</script>";
     }
    }

    mysqli_close($con);
?>