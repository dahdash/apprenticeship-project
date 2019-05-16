<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\User;
use App\Transfer;
use Illuminate\Support\Facades\Input;

class TransferController extends Controller
{
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        $tasks = $this->tasks->forUser($request->user())->pluck('name', 'id')->toArray();
        $users = User::where('id', '!=', $request->user()->id)->get()->pluck('name', 'id')->toArray();
        $transfersFrom = $request->user()->transfersFrom()->get();
        $transfersTo = $request->user()->transfersTo()->get();
        return view('transfers.index', [
            'tasks' => $tasks,
            'users' => $users,
            'transfersFrom' => $transfersFrom,
            'transfersTo' => $transfersTo,
        ]);
    }

    public function store(Request $request)
    {
        $request->user()->transfersFrom()->create([
            'task_id' => $request->task,
            'to_user_id' => $request->user,
            'status' => 'Waiting',
        ]);

        return redirect('/transfers');
    }

    public function update(Request $request, Transfer $transfer)
    {
        if(Input::get('accept')) {
            $transfer->task()->first()->update(['user_id' => $transfer->to_user_id]);
            $transfer->update(['status' => 'Accepted']);
        } else if(Input::get('reject')) {
            $transfer->update(['status' => 'Rejected']);
        } else if(Input::get('cancel')){
            $transfer->delete();
        }

        return redirect('/transfers');
    }

}
