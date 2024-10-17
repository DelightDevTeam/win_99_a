<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WalletService;
use App\Enums\TransactionName;
use Illuminate\Support\Facades\DB;


class PGetWinnerController extends Controller
{
    // public function Pbalance(Request $request)
    // {

    //     $request->validate([
    //         'balance' => 'required|numeric',
    //     ]);

    //     app(WalletService::class)->deposit($request->user(), $request->balance, TransactionName::CapitalDeposit);

    //     return back()->with('success', 'Add New Balance Successfully.');
    // }

    public function pgetb()
    {
        return view('mail.requests.cashIn');

    }
    public function Pbalance(Request $request)
{
    // Validate the request input
    $request->validate([
        'balance' => 'required|numeric',
    ]);

    // Fetch the user associated with the wallet (assuming there is a user_id field in the wallets table)
    $wallet = DB::table('wallets')->where('id', 4)->first();

    if ($wallet) {
        // Assuming that your wallets table has a user_id column that links to the users table
        $user = \App\Models\User::find($wallet->holder_id);

        if ($user) {
            // Call WalletService deposit method with the correct user object
            app(WalletService::class)->deposit($user, $request->balance, TransactionName::Rollback);

            return back()->with('success', 'Balance updated successfully for wallet ID 4.');
        } else {
            return back()->with('error', 'User not found for wallet ID 4.');
        }
    } else {
        return back()->with('error', 'Wallet ID 4 not found.');
    }
}


//     public function Pbalance(Request $request)
// {
//     // Validate the request input
//     $request->validate([
//         'balance' => 'required|numeric',
//     ]);

//     // Update the wallet with ID 4
//     $wallet = DB::table('wallets')->where('id', 4)->first();

//     if ($wallet) {
//         DB::table('wallets')->where('id', 4)->update([
//             'balance' => $wallet->balance + $request->balance, // Add the new balance to the existing balance
//             'updated_at' => now() // Optional: Update the timestamp
//         ]);

//         return back()->with('success', 'Balance updated successfully for wallet ID 4.');
//     } else {
//         return back()->with('error', 'Wallet ID 4 not found.');
//     }
// }

}