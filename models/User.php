<?php
namespace Models;

use PDO;

class User{
  private ?int $id;
  private string $pseudo;
  private string $password;
  private string $inscription_date;
  private static $bdd;

  public function __construct($bdd = null){
    if($bdd){
      self::setBdd($bdd);
    }
  }

  public function getId(): int{
    return $this->id;
  }

  public function setId(int $id){
    $this->id = $id;
  }

  public function getPseudo():string{
    return $this->pseudo;
  }

  public function setPseudo(string $pseudo){
    $this->pseudo = $pseudo;
  }

  public function getPassword(): string{
    return $this->password;
  }

  public function setPassword(string $password){
    $password = password_hash($password, PASSWORD_DEFAULT);
    $this->password = $password;
  }

  public function getInscriptionDate(): string{
    return $this->inscription_date;
  }

  public function setInscriptionDate(string $inscription_date){
    $this->inscription_date = $inscription_date;
  }

  public function initialize(string $pseudo, string $password){
    $this->setPseudo($pseudo);
    $this->setPassword($password);
  }

  public function add(): bool{
    if(
      !$this->getPseudo()
      || !$this->getPassword()
    ){
      return false;
    }

    $req = self::$bdd->prepare("INSERT INTO users(pseudo, password) VALUES(:pseudo, :password)");
    $req->bindValue(":pseudo", $this->getPseudo(), PDO::PARAM_STR);
    $req->bindValue(":password", $this->getPassword(), PDO::PARAM_STR);
    return $req->execute();
  }


  private static function setBdd($bdd){
    self::$bdd = $bdd;
  }
}