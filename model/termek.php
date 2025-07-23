<?php

enum Statusz: string
{
  case Beerkezett = 'Beérkezett';
  case Hibafeltaras = 'Hibafeltárás';
  case AlkatreszBeszerzesAlatt = 'Alkatrész beszerzés alatt';
  case Javitas = 'Javítás';
  case Kesz = 'Kész';
};

class Termek
{
  private ?int $id = null;
  private string $szeriaSzam;
  private string $gyarto;
  private string $tipus;
  private DateTime $leadas;
  private Statusz $statusz;
  private DateTime $modositas;
  private int $kapcsolattartoId;

  public function __construct(
    string $szeriaSzam,
    string $gyarto,
    string $tipus,
    int $kapcsolattartoId,
    Statusz $statusz = Statusz::Beerkezett,
    ?DateTime $leadas = new DateTime('now'),
    ?DateTime $modositas = new DateTime('now'),
    ?int $id = null
  ) {
    $this->szeriaSzam = $szeriaSzam;
    $this->gyarto = $gyarto;
    $this->tipus = $tipus;
    $this->kapcsolattartoId = $kapcsolattartoId;
    $this->statusz = $statusz;
    $this->leadas = $leadas ?? new DateTime();
    $this->modositas = $modositas ?? new DateTime();
    $this->id = $id;
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getSzeriaSzam(): string
  {
    return $this->szeriaSzam;
  }
  public function getGyarto(): string
  {
    return $this->gyarto;
  }
  public function getTipus(): string
  {
    return $this->tipus;
  }
  public function getLeadas(): DateTime
  {
    return $this->leadas;
  }
  public function getStatusz(): Statusz
  {
    return $this->statusz;
  }
  public function getModositas(): DateTime
  {
    return $this->modositas;
  }
  public function getKapcsolattartoId(): int
  {
    return $this->kapcsolattartoId;
  }

  public function setStatusz(Statusz $newStatusz): void
  {
    $this->statusz = $newStatusz;
    $this->modositas = new DateTime();
  }
};
