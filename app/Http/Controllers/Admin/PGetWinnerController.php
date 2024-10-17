<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


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