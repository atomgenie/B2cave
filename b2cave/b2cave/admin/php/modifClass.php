<?php
class modifClass{
    private $bdd;
    private $tableName;
    private $myText;
    public function __construct($bdd, $tableName){
        $this->bdd = $bdd;
        $this->tableName = $tableName;
    }
    public function updateText($id, $text){
        $req = $this->bdd->prepare('UPDATE '. $this->tableName .' SET text = :myText WHERE id = :id');
        $req->execute(array(
            "myText" => $text,
            "id" => $id
        ));
        $req->CloseCursor();
    }
    
    public function loadText($id){
        $req = $this->bdd->prepare('SELECT * FROM '. $this->tableName .' WHERE id = :id LIMIT 1');
        $req->execute(array(
            "id" => $id
        ));
        $textPrint = "";
        if($req2 = $req->fetch()){
            $textPrint = $req2['text'];
        }
        return $textPrint;
    }
    
}



?>