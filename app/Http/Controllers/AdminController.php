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
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v1;

class AdminController extends userController
{
public function registerForm(){
    return view('register');
}
public function register(Request $request){

    $validator = Validator::make($request->all(), [
        'email' => 'required|unique:users,email',
        'password' => 'required',
        'employee_id' => 'required',
        'role' => 'required',
    ]);
    $employee = Employee::find($request->employee_id);

    if ($validator->fails()) {
        return  redirect('/register')->with('validation','you should fill your input');
    }
    elseif($employee){

        $auth = Auth::user();
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'user']) || !Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])){
        $user =  User::create(['email' => $request->email,'password' => bcrypt($request->password) ,'employee_id' => $request->employee_id, 'role' => $request->role,'remember_token' => Str::random(10)]);
        return redirect('/register')->with('created','created successfully');
        }
        else{
            return redirect()->with('found','you are already registered');
        }
    }
    else{
        return redirect('/addEmployee')->with('attention','you must add him to employees table');
    }

}
public function loginForm()
    {
        return view('index');
    }

public function login(Request $request){

    if(empty($request->email) || empty($request->password)){
        return redirect('/')->with('fill','Please Fill Your Inputs');
    }
    else{



    if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            $user = Auth::user();
            $token['token'] = $user->createToken('MyToken')->plainTextToken;
           if ($user->tokens()->count() >= 1) {

                 $this->refreshToken($request);
                 return view('admin.home');
    }
         }


            else{
                return redirect('/')->with('message','unauthorized');
            }

        }
}

    public function showUsers(){
        $user = Employee::select('id','name','department','meals')->paginate(5);
        $count = Employee::all();

        return view('showUsers',compact('user','count'));
    }
    public function addEmployee(){

        return view('admin.users.addEmployee');
    }
    public function Employee_ADD(Request $request){
        $validator = Validator::make($request->all(), ['name' => 'required','department' => 'required','meals' => 'required']
        );

        if ($validator->fails()) {
            return redirect()->back()->with('message','please fill your inputs');
        }
else{
    $employee = Employee::find($request->id);
    if(!$employee){
    $user = Employee::create(['id'=>$request->id,'name' => $request->name,'department' => $request->department,'meals' => $request->meals]);
}
else{
    return redirect()->back()->with('error','this id is exist');
}
    if($user)
    {
        return redirect()->back()->with('created','Created Successfully');
    }
}

    }
    public function editEmployee($id){
        $user = Employee::find($id);
        return view('editEmployee',compact('user'));
    }
    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), ['name' => 'required','department' => 'required','meals' => 'required']
    );

    if ($validator->fails()) {
        return redirect()->back()->with('message','please fill your inputs');
    }
    else{
        $employee = Employee::find($id);

        $user =$employee-> update(['id'=>$request->id,'name' => $request->name,'department' => $request->department,'meals' => $request->meals]);

        if($user)
        {
            return redirect()->back()->with('created','Created Successfully');
        }
    }
    }
public function showRequest(){
    $user = Employee_Request::select('id','created_at','employee_id','status')->paginate(5);
    $count = Employee_Request::all();
    $sum = 0;
    foreach($user as $value){
        $sum += $value->Employee->meals;
    }
    return view('showRequest',compact('user','count','sum'));
}
    public function export(Request $request)
    {
         return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function deleteEmployee(Request $request,$id){
        $employee = Employee::find($id);
         $employee->delete();
         $this->Re_autoIncrement('requests');
         $this->Re_autoIncrement('users');
         return redirect()->back()->with('deleted','Deleted Successfully');
    }

        public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
       return redirect('/');
    }
public function showRatings(){
    $user = Rating::select('rating','comment','created_at','employee_id')->paginate(5);
    $count = Rating::all();
    $sum = Rating::sum('rating');
    return view('showRatings',compact('user','count','sum'));
}
public function search(Request $request){

    $user = Employee::select('id','name','department','meals')->Where('id',$request->search)->paginate(1);
    $employee = Employee_Request::select('id','created_at','employee_id','status')->Where('employee_id',$request->search)->get();
    $rating = Rating::select('rating','comment','created_at','employee_id')->Where('employee_id',$request->search)->get();
    $sum = 0;
    foreach($employee as $value){
        $sum += $value->Employee->meals;
    }
    return view('search',compact('user','employee','rating','sum'));
}

}
