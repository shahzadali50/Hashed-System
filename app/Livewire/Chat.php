<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class Chat extends Component
{
    public $users;
    public $selectedUser;
    public $selectUserMessages;
    public $message;
    public $loginID;

    public function mount()
    {
        $this->users = User::where('id', '!=', Auth::id())->get();
        $this->selectedUser = $this->users->first();
        $this->loadMessages();
        $this->loginID = Auth::id();
    }

    public function selectUser($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->loadMessages();
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|min:1',
        ]);

        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->selectedUser->id,
            'message' => $this->message,
        ]);
        $this->selectUserMessages->push($message);
        $this->dispatch('messageSent');
        broadcast(new MessageSent($message));
    }
    public function updatedMessage($value){
        $this->dispatch("userTyping", userID: $this->loginID, userName: Auth::user()->name, selectedUserId: $this->selectedUser->id);
    }

    public function getListeners()
    {
        return [
            'echo-private:chat.' . $this->loginID . ',MessageSent' => "newChatMessageNotification",
        ];
    }

    public function newChatMessageNotification($message){
        if($message['sender_id'] == $this->selectedUser->id){
            $messageObj=ChatMessage::find($message['id']);
            $this->selectUserMessages->push($messageObj);
        }
    }


    public function loadMessages()
    {
        $this->selectUserMessages = ChatMessage::where('sender_id', Auth::id())->where('receiver_id', $this->selectedUser->id)->orWhere('sender_id', $this->selectedUser->id)->where('receiver_id', Auth::id())->get();
    }

        public function render()
    {
        return view('livewire.chat');
    }
}
