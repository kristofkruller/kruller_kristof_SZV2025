<?php

class KapcsolatTarto
{
  private ?int $id = null;
  private string $nev;
  private string $telefon;
  private string $email;

  public function __construct(
    string $nev,
    string $telefon,
    string $email,
    ?int $id = null
  ) {
    $this->nev = $nev;
    $this->telefon = $telefon;
    $this->email = $email;
    $this->id = $id;
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNev(): string
  {
    return $this->nev;
  }
  public function getTelefon(): string
  {
    return $this->telefon;
  }
  public function getEmail(): string
  {
    return $this->email;
  }
}
