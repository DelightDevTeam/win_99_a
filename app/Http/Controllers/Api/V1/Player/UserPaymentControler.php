<?php

namespace App\Http\Controllers\Api\V1\Player;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentTypeRequest;
use App\Http\Resources\UserPaymentResource;
use App\Models\UserPayment;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPaymentControler extends Controller
{
    use HttpResponses;

    public function agentPayment()
    {
        $player = Auth::user();

        $data = UserPayment::with('paymentType', 'paymentType.paymentImages')->where('user_id', $player->agent_id)->get();

        return $this->success($data, 'Agent Payment List');

    }
}
