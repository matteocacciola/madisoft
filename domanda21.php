<?php

class Account
{
    private $balance;

    public function setBalance(int $balance)
    {
        $this->balance = $balance;

        return $this;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }
}

class Client
{
    public function deposit(Account $account, int $amount)
    {
        $account->setBalance($account->getBalance() + $amount);

        return $this;
    }

    public function withdraw(Account $account, int $amount)
    {
        if (($balance = $account->getBalance()) < $amount) {
            throw new \Exception('...');
        }

        $account->setBalance($balance - $amount);

        return $this;
    }
}