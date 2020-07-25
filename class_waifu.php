<?php
class Waifu{
    private $pdo;
    //funções
    public function __construct($dbname, $host, $user, $senha)
    {
        try{
            $this->pd0 = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }
        catch (PDOException $e){
            echo "Erro com banco de dados: ".$e->getMessage();
            exit;
        }
        catch (Exception $e) {
            echo "Erro generico: ".$e->getMessage();
            exit;
        }
    }
    public function Buscar(){
            $res = array();
            $cmd = $this->pdo->query("SELECT * FROM WAIFUS ORDER BY NOME");
            $res = $cmd->fatchAll(PDO::FETCH_ASSOC);
            return $res;
    }
}
?>