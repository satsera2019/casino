<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Models\transaction;

class DepositController extends Controller
{
    public function deposit(DepositRequest $request)
    {
        // TODO: დასამატებელია ბარათის შემოწმება არსებობს თუ არა.
        $user = auth()->user();
        $createdTransaction = transaction::store($user->id, $request['type'], $request['amount']);
        if ($createdTransaction) {
            $user->update(['balance' => $user->balance + $request['amount']]);
            return redirect(route("cabinet.main"))->with(['error' => false, 'message' => 'Successful operation.']);
        }
        return redirect(route("cabinet.main"))->with(['error' => true, 'message' => 'Something went wrong.']);
    }

    public function withdraw(DepositRequest $request)
    {
        $user = auth()->user();
        if ($user->balance >= $request['amount']) {
            $createdTransaction = transaction::store($user->id, $request['type'], $request['amount']);
            if ($createdTransaction) {
                $user->update(['balance' => $user->balance - $request['amount']]);
                return redirect(route("cabinet.main"))->with(['error' => false, 'message' => 'Successful operation.']);
            }
            return redirect(route("cabinet.main"))->with(['error' => false, 'message' => 'Something went wrong.']);
        }
        return redirect(route("cabinet.main"))->with(['error' => true, 'message' => 'The balance is not enough.']);
    }
}
