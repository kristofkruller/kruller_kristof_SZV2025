<?php

enum Statusz: string {
  case Beerkezett = 'Beérkezett';
  case Hibafeltaras = 'Hibafeltárás';
  case AlkatreszBeszerzesAlatt = 'Alkatrész beszerzés alatt';
  case Javitas = 'Javítás';
  case Kesz = 'Kész';
};

class Termek {
  private string $szeriaSzam;
  private string $gyarto;
  private string $tipus;
  private DateTime $leadas;
  private Statusz $statusz;
  private DateTime $modositas;

  public function __construct(
    string $szeriaSzam,
    string $gyarto,
    string $tipus,
    Statusz $statusz = Statusz::Beerkezett,
    ?DateTime $leadas = new DateTime('now'),
    ?DateTime $modositas = new DateTime('now')
  ) {
    $this->szeriaSzam = $szeriaSzam;
    $this->gyarto = $gyarto;
    $this->tipus = $tipus;
    $this->statusz = $statusz;
    $this->leadas = $leadas ?? new DateTime();
    $this->modositas = $modositas ?? new DateTime();
  }

  public function getSzeriaSzam(): string {
    return $this->szeriaSzam;
  }
  public function getGyarto(): string {
    return $this->gyarto;
  }
  public function getTipus(): string {
    return $this->tipus;
  }
  public function getLeadas(): DateTime {
    return $this->leadas;
  }
  public function getStatusz(): Statusz {
    return $this->statusz;
  }
  public function getModositas(): DateTime {
    return $this->modositas;
  }

  public function setStatusz(Statusz $newStatusz): void {
    $this->statusz = $newStatusz;
    $this->modositas = new DateTime();
  }
};
?>