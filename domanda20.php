<?php

class Alunno
{
    /** @var string $codiceFiscale */
    private $codiceFiscale;

    /**
     * @return string
     */
    public function getCodiceFiscale(): string
    {
        return $this->codiceFiscale;
    }

}

class Classe
{
    /** @var array $alunni */
    private $alunni = [];

    /**
     * @param Alunno $alunno
     *
     * @return $this
     */
    public function aggiungiAlunno(Alunno $alunno): self
    {
        $this->alunni[] = $alunno;

        return $this;
    }

    /**
     * @return array
     */
    public function getAlunni(): array
    {
        return $this->alunni;
    }
}

class AlunnoService
{

    /**
     * @param Alunno $alunno
     * @param Classe $classe
     *
     * @return $this
     * @throws AlunnoGiaPresenteException
     * @throws TroppiAlunniException
     */
    public function aggiungiAlunno(Alunno $alunno, Classe $classe)
    {
        $alunni = $classe->getAlunni();

        if (($numAlunni = count($alunni)) >= 10) {
            throw new TroppiAlunniException();
        }

        if ($this->trovaAlunno($alunno, $alunni, $numAlunni)) {
            throw new AlunnoGiaPresenteException();
        }

        $classe->aggiungiAlunno($alunno);

        return $this;
    }

    /**
     * @param Alunno $alunno
     * @param array $alunni
     * @param int $numAlunni
     *
     * @return bool
     */
    private function trovaAlunno(Alunno $alunno, array $alunni, int $numAlunni)
    {
        for ($i = 0, $trovato = false; $i < $numAlunni && !$trovato; $i++) {
            $trovato = $alunni[$i]->getCodiceFiscale() == $alunno->getCodiceFiscale();
        }

        return $trovato;
    }

}

class AlunnoGiaPresenteException extends Exception
{

}

class TroppiAlunniException extends Exception
{

}