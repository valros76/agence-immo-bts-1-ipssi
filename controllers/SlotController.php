<?php

namespace Controllers;

class SlotController {
    public static function play() {
        header('Content-Type: application/json');
        
        // Symboles et leurs poids (proba d'apparition) 
        // Chaque symbole a une probabilité spécifique d’apparaître. Les symboles 
        //avec des gains élevés sont rendus plus rares.


        $symbols_with_weights = [
            '🍋' => 40,
            '🍒' => 30, 
            '⭐' => 15,
            '🔔' => 10,
            '💎' => 5,
        ];

        // Table des gains (combinaison => gain)
        $paytable = [
            '🍋🍋🍋' => 40,
            '🍒🍒🍒' => 50, 
            '⭐⭐⭐' => 100,
            '🔔🔔🔔' => 150,
            '💎💎💎' => 200,
        ];

        // $mise 

        $reel1 = self::getRandomSymbol($symbols_with_weights);
        $reel2 = self::getRandomSymbol($symbols_with_weights);
        $reel3 = self::getRandomSymbol($symbols_with_weights);
        
        $combination = $reel1 . $reel2 . $reel3;
        $gain = isset($paytable[$combination]) ? $paytable[$combination] : 0;

        echo json_encode([
            'success' => true,
            'reels' => [$reel1, $reel2, $reel3],
            'gain' => $gain,
        ]);
    }

    private static function getRandomSymbol($symbols_with_weights) {
        $rand = mt_rand(1, array_sum($symbols_with_weights));
        foreach ($symbols_with_weights as $symbol => $weight) {
            if ($rand <= $weight) {
                return $symbol;
            }
            $rand -= $weight;
        }
        return null;
    }
}
