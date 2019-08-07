<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

class MongoTestModel extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    public function __construct()
    {
        $this->MongoDBConnection = DB::connection('mongodb');
        $this->collection_name = 'todo_list';
    }


    //get all todolist
    public function getAllTodo(){
            $todo_list = $this->MongoDBConnection
                          ->collection($this->collection_name)
                          ->select('user_id','_id','title','completed')
                          ->get();
        return $todo_list;
    }

    // insert documents
    public function insertTodo($data){
        if (!empty($data)) {
            $insert_data = $this->MongoDBConnection
                      ->collection($this->collection_name)
                      ->insertGetId($data);
            $result = (string) $insert_data;
        }
        return $result;
    }

    //update todo
    public function updateTodo($data){

        $id = $data['id'];
        $status = $data['completed'];

        if (!empty($data)) {
            $updated = $this->MongoDBConnection
                      ->collection($this->collection_name)
                      ->where('id', '=', $id)
                      ->update(['completed' => $status]);
            $result = (string) $updated;
        }
        return $result;
    }


    //delete todo
    public function deleteTodo($id)
    {
        if (!empty($id)) {
            $deleted = $this->MongoDBConnection
                      ->collection($this->collection_name)
                      ->where('id', '=', $id)
                      ->delete();
            $result = (string) $deleted;
        }
        return $result;
    }
}
