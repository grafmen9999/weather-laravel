<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{

    use RedirectsUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('auth', [
            'only' => [
                'viewIndex',
            
            ]
        ]);
    }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255'],
    //         'message' => ['required'],
    //     ]);
    // }

    // Post method, create new feedback
    public function send(Request $request) {
        // return $data;
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required',
        ]);

        // $v = $this->validator($request->all());

        $this->create($request->all());
        return redirect()->intended($this->redirectPath());
    }

    // Views page for feedback send
    public function sendIndex() {
        return view('feedback-send');
    }

    protected function create(array $data)
    {
        return Feedback::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);

    }
    // Views page for feedback list
    public function viewIndex() {
        $feedbacks = Feedback::all();

        return view('feedback-views', [
            'feedbacks' => $feedbacks,
        ]);
    }

    public function viewIndexOne($id) {
        $feedback = Feedback::find($id);
        return view('feedback-views', [
            'feedback' => $feedback,
            'lastIndex' => Feedback::count(),
        ]);
    }
}
