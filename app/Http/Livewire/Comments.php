<?php

namespace App\Http\Livewire;
use App\Models\Books;
use App\Http\Requests\StoreCommentsRequest;
use Livewire\Component;
use App\Models\Comments as Comm;

class Comments extends Component
{

    public $bookId, $comm_text, $currentUser;
    protected $listeners = ['deleteComment'];

    public function resetFields(){
        $this->comm_text = '';
    }

    public function mount($bookId, $currentUser) {
        $this->bookId = $bookId;
        $this->currentUser = $currentUser;
    }

    public function storeComment() {
        if ($this->comm_text == '') return;
        $dbpost = new Comm();
        $dbpost->comment = $this->comm_text;
        $dbpost->books_id = $this->bookId;
        $dbpost->users_id = $this->currentUser;

        $dbpost->save();
        $this->resetFields();
    }

    public function render()
    {
        $comments = Books::find($this->bookId)->comment()->with('users')->get();
        return view('livewire.comments', compact('comments'));
    }

    public function deleteComment($id)
    {
        Comm::find($id)->delete();
    }
}
