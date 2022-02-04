<?php 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut() {
        return redirect('/login');
    }

    public function username()
    {
        return 'documento';
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = DB::table('users')
                ->join('role_user','role_user.user_id','=','users.id')
                ->where('users.id', Auth::id())
                ->get();

            $esAgencia = 0;

            for ($i=0; $i < count($user) ; $i++) { 
                if ($user[$i]->role_id == 3) {
                    $esAgencia = 1;
                }
            }

            DB::table('control_login')->insert(array(array( 
                'user_id' => Auth::id(),
                'name' => $user[0]->name,
                'documento' => $user[0]->documento,
                'agencia' => $esAgencia,
                'fecha' => date('Y-m-d H:i:s')
            )));

            return $this->sendLoginResponse($request);
        }

        $email = $request->get($this->username());

        $user = User::where($this->username(), $email)->first();

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        if($user){ 
            if ($user->status == 0) {
                return $this->sendFailedLoginResponse($request, 'auth.failed_status'); 
            } 
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        $credentials['status'] = 1;

        return $credentials;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
