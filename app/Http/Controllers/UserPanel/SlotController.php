<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\BetRequest;
use App\Models\User;

class SlotController extends Controller
{
    public function index()
    {
        return view('userPanel.slot.index');
    }

    public function spin(BetRequest $request)
    {
        $randomNumberArray = self::randomNumberArray(12, 9);
        $checkSpinResult = self::checkSpinResult($randomNumberArray, $request['bet']);
        self::changeBalance($checkSpinResult['win'], $request['bet']);
        return view('userPanel.slot.index')->with(['randomNumberArray' => array_chunk($randomNumberArray, 4), 'checkSpinResult' => $checkSpinResult['win']]);
        // return redirect(route("cabinet.slots.index"))->with(['randomNumberArray' => array_chunk($randomNumberArray, 4), 'checkSpinResult' => $checkSpinResult['win']]);
    }

    public function changeBalance(float $win, float $bet)
    {
        $user = auth()->user();
        if($win > 0){
            return $user->update(['balance' => $user->balance + $win]);    
        }
        return $user->update(['balance' => $user->balance - $bet]);
    }
    

    /**
     * @param dimension
     * @param percentage 
     * @return array
     */
    public function randomNumberArray(int $n, int $p)
    {
        // TODO: add to percentage 
        for ($i = 0; $i < $n; $i++) {
            $random_number_array[] = mt_rand(1, $p);
        }
        return $random_number_array;
    }

    /**
     * @param randomNumberArray
     * @param bet
     * @return double
     */
    public function checkSpinResult(array $array, float $bet)
    {
        $line = array_chunk($array, 4);
        $lineResult = array_count_values($line[1]); // check only middle line
        // TODO: Add all line checking logic
        if (in_array(2, $lineResult)) {
            return ['win' => $bet * 1.5];
        }
        if (in_array(3, $lineResult)) {
            return ['win' => $bet * 2];
        }
        if (in_array(4, $lineResult)) {
            return ['win' => $bet * 2.5];
        }
        return ['win' => 0];
    }
}
