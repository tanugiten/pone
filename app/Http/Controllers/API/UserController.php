<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{



    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:api');
       
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');
        return User::paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'user_firstname' => 'required|string|max:191',
            'user_lastname' =>  'required|string|max:191',
            'email' =>  'required|string|email|max:191|unique:users',
            'type' =>  'required|string|max:15',
            'password' =>  'required|string|min:8',
// ฟังชัน เตือนให้ใส่ข้อความ
        ]);

        return User::create([
            'user_firstname' => $request['user_firstname'],
            'user_lastname' => $request['user_lastname'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($request['password']),

        ]);
    }
// ส่งข้อมูลไปยัง database
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request,[
            'user_firstname' => 'required|string|max:191',
            'user_lastname' =>  'required|string|max:191',
            'email' =>  'required|string|email|max:191|unique:users,email,'.$user->id,
            'type' =>  'required|string|max:15',
            'password' =>  'sometimes|min:8',
        ]);


        $user->update($request->all());
        return ['message' => 'Update the User info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);

        //delete the user
        $user->delete();

        return ['message' => 'User Delete'];

      
    }
}
