<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use App\Http\Models\MongoTestModel;
use App\User;
use SebastianBergmann\Environment\Console;

class MongoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //header("Access-Control-Allow-Origin: *");
       //header('Access-Control-Allow-Methods:POST,GET,DELETE,PUT');
      //header('Access-Control-Allow-Headers', "Origin, X-Requested-With, Content-Type, Accept, Authorization");
    }

     //get Users by id
    public function getAllTodo(Request $request)
    {
       $todoModel = new MongoTestModel();
       $todo_list=$todoModel->getAllTodo();

       $response = array();
       $response['Success']='true';
       $response['Status_code']='200';
       $response['Message']='Todo list';
       $response['data']=$todo_list;
       return response()->json($response);
    }

    //Insert todos
    public function insertTodo(Request $request)
    {
         $data = array();

         $data['user_id'] = $request->input('userId');
         $data['id'] = $request->input('id');
         $data['title'] = $request->input('title');
         $data['completed'] = $request->input('completed');

        $userModel = new MongoTestModel();
        $result = $userModel->insertTodo($data);

        $response = array();
        $response['Success']='true';
        $response['Status_code']='201';
        $response['Message']='Record is inserted.';
        $response['data']=$result;
        return response()->json($response);
    }

    //update todo
    public function updateTodo(Request $request){


         $request_data = array();
      //   $data = $request->all();
      //   $response = array();

         $request_data['user_id']   = $request->input('userId');
         $request_data['id']        = $request->input('id');
         $request_data['title']     = $request->input('title');
         $request_data['completed'] = $request->input('completed');

       //  print_r($request_data);
      //  die;


        $userModel = new MongoTestModel();
        $result = $userModel->updateTodo($request_data);

        $response = array();
        $response['Success']='true';
        $response['Status_code']='200';
        $response['Message']='Record is updated.';
        $response['data']=$result;
        return response()->json($response);
    }

     //delete todo Item
    public function deleteTodo(Request $request){

        $id = $request->input('id');
        $userModel = new MongoTestModel();
        $result = $userModel->deleteTodo($id);

        $response = array();
        $response['Success']='true';
        $response['Status_code']='200';
        $response['Message']='Record is Deleted.';
        $response['data']=$result;
        return response()->json($response);
    }
}
