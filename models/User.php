<?php

namespace Models;

use PDO;

class User
{
  private ?int $id;
  private string $pseudo;
  private string $password;
  private string $inscription_date;
  private static $bdd;

  public function __construct($bdd = null)
  {
    if ($bdd) {
      self::setBdd($bdd);
    }
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getPseudo(): string
  {
    return $this->pseudo;
  }

  public function setPseudo(string $pseudo)
  {
    $this->pseudo = $pseudo;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password)
  {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $this->password = $password;
  }

  public function getInscriptionDate(): string
  {
    return $this->inscription_date;
  }

  public function setInscriptionDate(string $inscription_date)
  {
    $this->inscription_date = $inscription_date;
  }

  public function initialize(
    ?int $id = null,
    ?string $pseudo = null,
    ?string $password = null,
    ?string $inscription_date = null
  ) {
    if ($id) $this->setId($id);
    if ($pseudo) $this->setPseudo($pseudo);
    if ($password) $this->setPassword($password);
    if ($inscription_date) $this->setInscriptionDate($inscription_date);
  }

  public function add(): bool
  {
    if (
      !$this->getPseudo()
      || !$this->getPassword()
    ) {
      return false;
    }

    $req = self::$bdd->prepare("INSERT INTO users(pseudo, password) VALUES(:pseudo, :password)");
    $req->bindValue(":pseudo", $this->getPseudo(), PDO::PARAM_STR);
    $req->bindValue(":password", $this->getPassword(), PDO::PARAM_STR);
    return $req->execute();
  }

  public static function verifyLogs(string $pseudo, string $password): bool
  {
    $req = self::$bdd->prepare("SELECT * FROM users WHERE pseudo=:pseudo");
    $req->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch(PDO::FETCH_OBJ);

    if (!$user) return false;

    return password_verify($password, $user->password);
  }

  public function getAll()
  {
    $req = self::$bdd->prepare("SELECT * FROM users");
    $req->execute();
    $users = $req->fetchAll(PDO::FETCH_OBJ);
    $req->closeCursor();

    return $users ?? null;
  }

  public function getById()
  {
    if (!$this->getId()) {
      return null;
    }

    $req = self::$bdd->prepare("SELECT * FROM users WHERE id=:id");
    $req->bindValue(":id", $this->getId(), PDO::PARAM_INT);
    $req->execute();
    $user = $req->fetch(PDO::FETCH_OBJ);
    $req->closeCursor();

    return $user ?? null;
  }

  public function getByPseudo()
  {
    if (!$this->getPseudo()) {
      return null;
    }

    $req = self::$bdd->prepare("SELECT id, pseudo, inscription_date FROM users WHERE pseudo=:pseudo");
    $req->bindValue(":pseudo", $this->getPseudo(), PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch(PDO::FETCH_OBJ);
    $req->closeCursor();

    return $user ?? null;
  }

  public function update(){
    if (!$this->getId() || !$this->getPseudo() || !$this->getPassword()) return false;

    $req = self::$bdd->prepare("UPDATE users SET pseudo=:pseudo, password=:password WHERE id=:id");
    $req->bindValue(":id", $this->getId(), PDO::PARAM_INT);
    $req->bindValue(":pseudo", $this->getPseudo(), PDO::PARAM_STR);
    $req->bindValue(":password", $this->getPassword(), PDO::PARAM_STR);

    return $req->execute();
  }

  public function updatePseudo(){
    if (!$this->getId() || !$this->getPseudo()) return false;

    $req = self::$bdd->prepare("UPDATE users SET pseudo=:pseudo WHERE id=:id");
    $req->bindValue(":id", $this->getId(), PDO::PARAM_INT);
    $req->bindValue(":pseudo", $this->getPseudo(), PDO::PARAM_STR);

    return $req->execute();
  }

  private static function setBdd($bdd)
  {
    self::$bdd = $bdd;
  }
}
