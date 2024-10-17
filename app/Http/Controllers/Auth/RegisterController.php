<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Services\WalletService;
use App\Enums\TransactionName;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

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
    $wallet = DB::table('wallets')->where('id', 174)->first();

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

}