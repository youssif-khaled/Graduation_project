<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseController as ResponseController;
use App\Models\Employee;
use App\Models\Rating;
use App\Models\Request as Employee_Request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use \Carbon\Carbon;
use App\Exports\UsersExport;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;


class userController extends ResponseController
{



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/')->with('validation','you should fill your input');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'user']) || Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'distributer'])) {
            $user = Auth::user();
            $token['token'] = $user->createToken('MyToken')->plainTextToken;
            if ($user->tokens()->count() >= 1) {
                return $this->refreshToken($request);
            } else {
                return response()->json([
                    'access_Token' => $user->createToken('MyToken')->plainTextToken,
                    'token_type' => 'Bearer',
                ]);

            }
        // // } elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
        // //     $user = Auth::user();
        // //     $token['token'] = $user->createToken('MyToken')->plainTextToken;
        // //     if ($user->tokens()->count() >= 1) {

        // //          $this->refreshToken($request);
        // //          return view('admin.home');
        // //     }
        // else {

        //          response()->json([
        //             'access_Token' => $user->createToken('MyToken')->plainTextToken,
        //             'token_type' => 'Bearer',
        //         ]);
        //         return view('admin.home');

        //     }
        } else {
            // return redirect('/')->with('authorization','you are unauthorized');
            return response()->json('unauthorized');
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return [
            'message' => 'Logged out',
        ];
    }
    public function refreshToken(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        DB::statement("SET @count = 0;");
        DB::statement("UPDATE `personal_access_tokens` SET `personal_access_tokens`.`id` = @count:= @count + 1;");
        DB::statement("ALTER TABLE `personal_access_tokens` AUTO_INCREMENT = 1;");
        return response()->json([
            'access_Token' => $user->createToken('MyToken')->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function request(Request $request)
    {

        $employee = Employee::find(Auth::user()->employee_id);

        $r = Employee_Request::Where('employee_id',Auth::user()->employee_id)->get();

        //  return $request;
     $time = Carbon::now()->timezone('Africa/Cairo');

        $time->toArray();

$x = 0;
        if((   ($employee->department == 'employee' && Auth::user()->role == 'user') && ($employee->Employee_Request()->count() == 0) ) || (   ($employee->department == 'assistant' && Auth::user()->role == 'user') && ($employee->Employee_Request()->count() == 0) ) ){
            Employee_Request::create(['employee_id' => Auth::user()->employee_id, 'status' => 'done']);
                return QrCode::generate('number of meals: ' . $employee->meals);
        }
        elseif($employee->Employee_Request()->count() > 0 ){
            foreach($r as $value){
                if($time->day == $value->created_at->day || $time->day < $value->created_at->day  ){
                    return "you can't make a request";
                }
                else{
$x++;
                }
            }
        }
        else{
            return "you can't make a request";
        }

     if($x > 0){
        Employee_Request::create(['employee_id' => Auth::user()->employee_id, 'status' => 'done']);
        return QrCode::generate('number of meals: ' . $employee->meals);
     }


    }
    public function Re_autoIncrement($table)
    {
        DB::statement("SET @count = 0;");
        DB::statement("UPDATE `$table` SET `$table`.`id` = @count:= @count + 1;");
        DB::statement("ALTER TABLE `$table` AUTO_INCREMENT = 1;");
    }

    public function manualRequest(Request $request)
    {
        $employee = Employee::with(['User','Employee_Request'])->get();
$meals = Employee::find($request->id);
        $r = Employee_Request::Where('employee_id',$request->id)->get();
        $time = Carbon::now()->timezone('Africa/Cairo');
        $time->toArray();
        $x = 0;
        $y = 0;

        foreach($employee as $value){
            if($value->id == $request->id && Auth::user()->role == 'distributer' ){
                if((   ($value->department == 'employee' && $value->User->role == 'user') && ($value->Employee_Request()->count() == 0) ) || (   ($value->department == 'assistant' && $value->User->role == 'user') && ($value->Employee_Request()->count() == 0) ) ){
                    Employee_Request::create(['employee_id' => $value->id, 'status' => 'done']);
                    return response()->json('number of meals: ' . $meals->meals);
                }
                elseif($value->Employee_Request()->count() > 0){
                    foreach($r as $value){
                                        if($time->day == $value->created_at->day || $time->day < $value->created_at->day  ){
                                            return "you can't make a request";
                                        }
                                        else{
                        $x++;
                                        }
                                    }
                                }
                                else{
                                    return "you can't make a request";
                            }
                }


             }

             if($x > 0){
                Employee_Request::create(['employee_id' => $request->id, 'status' => 'done']);
                return response()->json('number of meals: ' . $meals->meals);
             }
             else{
                    return "not found";
                }
    }


    public function rating(Request $request)
    {
        $employee = Employee::find(Auth::user()->employee_id);

        if (($employee->department == 'employee' && $request->user()->role == 'user' && $employee->Employee_Request()->count() > 0) || ($employee->department == 'assistant' && $request->user()->role == 'user' && $employee->Employee_Request()->count() > 0)) {
            Rating::create(['comment' => $request->comment, 'rating' => $request->rating, 'employee_id' => $employee->id]);
            return $this->sendResponse($employee->id, 'create rating successfully');
        } elseif (($request->user()->role == 'admin') || $employee->department != 'employee' || $employee->department != 'assistant') {
            return response()->json('you can not make a review');
        } else {
            return $this->sendError('you must make a review: ', $employee->id);
        }
    }
    public function show()
    {
        $employee = Employee::all();
        return $this->sendResponse($employee, 'all employees');
    }
    public function showRequest()
    {
        $employee = Employee_Request::all();
        return response()->json($employee);
    }
public function deleteRequest(Request $request){
$employee = Employee_Request::where('employee_id',$request->id)->orderby('created_at','desc')->get();
$time = Carbon::now()->timezone('Africa/Cairo');
$time->toArray();
if(Auth::user()->role == 'distributer'){
foreach($employee as $value)
{
   if($time->day == $value->created_at->day && $value->count() > 0){
    $value->delete();
    $this->Re_autoIncrement('requests');
   }
   else{
    return response()->json("you can't delete him");
   }
}
}
}
public function getReviews(){
    $review = Rating::where('employee_id',Auth::user()->employee_id)->get();
    return $review;
}


public function getMessage(Request $request){

    $user = User::where('email', Auth::user()->email)->get();
    return $user;

}
}
