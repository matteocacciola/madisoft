<?php

class App
{
    function formatSoccerPlayer()
    {
        $sp = new SoccerPlayer();
        $spf = new PlayerFormatter();

        $spf->format($sp);
    }

    function formatBasketPlayer()
    {
        $bp = new BasketPlayer();
        $bpf = new PlayerFormatter();

        $bpf->format($bp);
    }
}

interface PlayerInterface
{
    public function getFullName(): string;

    public function getStatsDescription(): string;
}

abstract class Player implements PlayerInterface
{
    protected $name;

    protected $surname;

    protected $gamePlayed;

    public function getFullName(): string
    {
        return "{$this->name} {$this->surname}";
    }

    abstract public function getStatsDescription(): string;
}

class SoccerPlayer extends Player
{
    private $goals;

    private $assists;

    private $ycNr;

    private $rcNr;

    public function getStatsDescription(): string
    {
        return "I've scored {$this->goals} in {$this->gamePlayed} match(es). I've also made {$this->assists}. Other stats: {$this->ycNr} yellow card(s) and {$this->rcNr} red card(s)";
    }
}

class BasketPlayer extends Player
{
    private $scores;

    private $offensiveRebounds;

    private $defensiveRebounds;

    public function getStatsDescription(): string
    {
        return "I've scored {$this->scores} in {$this->gamePlayed} match(es). Other stats: {$this->offensiveRebounds} offensive and {$this->defensiveRebounds} defensive rebound(s)";
    }
}

class PlayerFormatter
{
    public function format(Player $player): void
    {
        echo "Here comes {$player->getFullName()}";
        echo "Stats from {$player->getFullName()} {$player->getStatsDescription()}";
    }
}