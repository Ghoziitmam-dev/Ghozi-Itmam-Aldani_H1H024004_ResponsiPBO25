<?php

abstract class Pokemon 
{
    protected string $name;
    protected string $type;
    protected float $level;
    protected float $hp;

    public function __construct(string $name, string $type, float $level, float $hp) 
    {
        $this->setName($name);
        $this->setType($type);
        $this->setLevel($level);
        $this->setHp($hp);
    }

    // Getter
    public function getName(): string 
    {
        return $this->name;
    }

    public function getType(): string 
    {
        return $this->type;
    }

    public function getLevel(): float 
    {
        return $this->level;
    }

    public function getHp(): float 
    {
        return $this->hp;
    }

    // Setter
    protected function setName(string $name): void 
    {
        $this->name = trim($name);
    }

    protected function setType(string $type): void 
    {
        $this->type = trim($type);
    }

    public function setLevel(float $level): void 
    {
        if ($level < 1) {
            $level = 1; // Level minimum 1
        }

        $this->level = $level;
    }

    public function setHp(float $hp): void 
    {
        if ($hp < 0) {
            $hp = 0; // tidak boleh minus
        }

        $this->hp = $hp;
    }

    // Abstract methods
    abstract public function specialMove(): string;

    abstract public function train(string $type, float $intensity): array;
}
