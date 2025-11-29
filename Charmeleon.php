<?php
require_once 'Pokemon.php';

class Charmeleon extends Pokemon 
{
    public function __construct() 
    {
        parent::__construct("Charmeleon", "Fire", 16, 58);
    }

   public function specialMove(): string
{
    return "Flamethrower: Serangan api kuat yang dapat membakar lawan dan menyebabkan damage berlanjut!";
}

    public function train(string $type, float $intensity): array
    {
        // Validasi awal
        if (!is_numeric($intensity) || $intensity < 0) {
            throw new InvalidArgumentException("Intensity harus berupa angka positif");
        }

        $type = ucfirst(strtolower($type)); // Normalisasi input (attack/Attack/ATTACK → Attack)

        // Base increase
        $levelIncrease = $intensity * 0.4;
        $hpIncrease    = $intensity * 3;

        // Bonus sesuai tipe latihan
        switch ($type) {
            case "Attack":
                $hpIncrease += 7;
                break;

            case "Defense":
                $levelIncrease += 0.3;
                break;

            case "Speed":
                $hpIncrease += 4;
                break;

            default:
                throw new InvalidArgumentException("Tipe latihan tidak valid. Gunakan: Attack, Defense, atau Speed.");
        }

        // Update status
        $this->setLevel($this->getLevel() + $levelIncrease);
        $this->setHp($this->getHp() + $hpIncrease);

        return [
            'levelIncrease' => $levelIncrease,
            'hpIncrease' => $hpIncrease
        ];
    }
}
