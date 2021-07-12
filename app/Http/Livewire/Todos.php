<?php

namespace App\Http\Livewire;

use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use App\Models\Todo;

class Todos extends Component
{
    public $title = '';

    public function render()
    {
        // $todos = auth()->user()->todos;
        return view('livewire.todos',[
            'todos' => auth()->user()->todos
        ]);
    }

    public function addTodo(){
        // dd('asdfsdf');
        $this->validate([
            'title' => 'required'
        ]);

        Todo::create([
            'title' => $this->title,
            'user_id' => auth()->user()->id,
            'completed' => false
        ]);

        $this->title = '';

    }


    public function deleteTodo($id){
       Todo::find($id)->delete();
    }


    public function toggleTodo($id){
        $todo = Todo::find($id);

        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function updateTodo($id,$title){
        $todo = Todo::find($id);
        $todo->title = $title;
        $todo->save();
    }
}
