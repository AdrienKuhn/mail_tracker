<?php namespace MailTracker\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use MailTracker\Email;
use MailTracker\Http\Requests;
use MailTracker\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class AdminDashboardController extends Controller {

	/**
	 * Display the dashboard.
	 *
	 * @return Response
	 */
	public function showDashboard()
	{
		// Statistics
		$sent_email_nb = Email::where('user_id', Auth::id())->withTrashed()->count();
		$active_email_nb = Email::where('user_id', Auth::id())->count();
		$last_email = Email::with('email_trackings')->where('user_id', Auth::id())->get()->last();
		$last_email_read_nb = $last_email->email_trackings->count();

		return View::make('admin.dashboard',array(
												'sent_email_nb' => $sent_email_nb,
												'active_email_nb' => $active_email_nb,
												'last_email_read_nb' => $last_email_read_nb,
												'last_email' => $last_email));
	}

}
