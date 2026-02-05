<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;   // ⬅️ INI YANG HILANG
use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index(Request $request)
	{
		// Ambil parameter sort dari URL
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
					  ->orderBy('remind_at', 'desc');
				break;

			case 'time_asc':
			default:
				$query->orderBy('remind_at', 'asc');
				break;
		}

		$reminders = $query->get();

		// ⚠️ INI PENTING: kirim $order ke Blade
		return view('admin.reminders.index', compact('reminders', 'order'));
	}



    public function create()
    {
        return view('admin.reminders.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'title' => 'required',
            'remind_at' => 'required|date'
        ]);

        Reminder::create([
            'user_id' => auth()->id(),
            'title' => $r->title,
            'description' => $r->description,
            'remind_at' => $r->remind_at
        ]);

        return redirect()->route('admin.reminders.index');
    }

    public function edit(Reminder $reminder)
    {
        $this->authorize('update', $reminder);

        return view('admin.reminders.edit', compact('reminder'));
    }

    public function update(Request $r, Reminder $reminder)
    {
        $this->authorize('update', $reminder);

        $r->validate([
            'title' => 'required',
            'remind_at' => 'required|date'
        ]);

        $reminder->update([
            'title' => $r->title,
            'description' => $r->description,
            'remind_at' => $r->remind_at,
            'email_sent' => false
        ]);

        return redirect()->route('admin.reminders.index');
    }

    public function destroy(Reminder $reminder)
	{
		$this->authorize('delete', $reminder);

		$reminder->delete();

		return back();
	}
	
}

