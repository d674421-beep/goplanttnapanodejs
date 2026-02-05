<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReminderController extends Controller
{
    public function index(Request $request)
	{
		$order = $request->get('order', 'time_asc');

		$query = Reminder::where('user_id', auth()->id());

		switch ($order) {
			case 'time_desc':
				$query->orderBy('remind_at', 'desc');
				break;

			case 'status_waiting':
				$query->orderBy('email_sent', 'asc')
					  ->orderBy('remind_at', 'asc');
				break;

			case 'status_sent':
				$query->orderBy('email_sent', 'desc')
					  ->orderBy('remind_at', 'asc');
				break;

			case 'time_asc':
			default:
				$query->orderBy('remind_at', 'asc');
				break;
		}

		$reminders = $query->get();

		return view('user.reminders.index', compact('reminders', 'order'));
	}



    public function create()
    {
        return view('user.reminders.create');
    }

    public function store(Request $request)
	{
		$request->validate([
			'title'     => 'required',
			'remind_at' => 'required|date',
		]);

		Reminder::create([
			'user_id'    => auth()->id(),
			'title'      => $request->title,
			'description'=> $request->description,
			'remind_at' => Carbon::createFromFormat(
				'Y-m-d\TH:i',
				$request->remind_at,
				'Asia/Jakarta'
			)->utc(),

			'email_sent' => 0,
		]);

		return redirect()->route('user.reminders.index');
	}


    public function edit(Reminder $reminder)
    {
        abort_if($reminder->user_id !== auth()->id(), 403);

        return view('user.reminders.edit', compact('reminder'));
    }

    public function update(Request $request, Reminder $reminder)
	{
		$request->validate([
			'title'     => 'required',
			'remind_at' => 'required|date',
		]);

		$reminder->update([
			'title'      => $request->title,
			'description'=> $request->description,
			'remind_at'  => Carbon::createFromFormat(
				'Y-m-d\TH:i',
				$request->remind_at,
				'Asia/Jakarta'
			)->utc(),
			'email_sent' => 0,
			'sent_at'    => null,
		]);

		return redirect()->route('user.reminders.index');
	}


    public function destroy(Reminder $reminder)
	{
		abort_if($reminder->user_id !== auth()->id(), 403);

		$reminder->delete();

		return redirect()
			->route('user.reminders.index')
			->with('success', 'Reminder berhasil dihapus');
	}


}
