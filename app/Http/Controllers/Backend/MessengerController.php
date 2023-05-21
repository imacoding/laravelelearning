<?php
namespace App\Http\Controllers\Backend;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

class MessengerController extends Controller
{
    public function index(Request $request)
    {
        $thread = "";
        $user=auth()->user();

        $teachers = User::role('teacher')->get()->pluck('name', 'id');

       
        $user->load('threads.messages.user');

        $unreadThreads = [];
        $threads = [];
        foreach ($user->threads as $item) {
            if ($item->userUnreadMessagesCount(auth()->user()->id) > 0) {
                $unreadThreads[] = $item;
            } else {
                $threads[] = $item;
            }
        }
        $threads = Collection::make(array_merge($unreadThreads, $threads));

        if ($request->has('thread') && $request->filled('thread')) {
            $thread = $user->threads()
                ->where('threads.id', '=', $request->thread)
                ->first();

            if ($thread) {
                // Read Thread
                $thread->markAsRead($user->id);
            } else if (empty($thread)) {
                abort(404);
            }
        }

        $agent = new Agent();

        $view = $agent->isMobile() ? 'backend.messages.index-mobile' : 'backend.messages.index-desktop';

        return view($view, [
            'threads' => $threads,
            'teachers' => $teachers,
            'thread' => $thread
        ]);
    }




public function send(Request $request)
{
    $this->validate($request, [
        'recipients' => 'required',
        'message' => 'required'
    ], [
        'recipients.required' => 'Please select at least one recipient',
        'message.required' => 'Please input your message'
    ]);

   $threadId = $request->thread;
    $thread = null;

    if (empty($threadId)) {
        // Create a new thread
        $thread = Thread::create();
    } else {
        $thread = Thread::findOrFail($threadId);
    }


    Participant::create([
            'thread_id' => $thread->id,
            'user_id' => auth()->user()->id,
            'last_read' => null,
        ]);
        $thread->addParticipant($request->recipients);

    $message = Message::create([
        'thread_id' => $thread->id,
        'user_id' => auth()->user()->id,
        'body' => $request->message,
    ]);

    return redirect(route('admin.messages').'?thread='.$thread->id);
}


    public function reply(Request $request)
    {
        $this->validate($request, [
            'message' => 'required'
        ], [
            'message.required' => 'Please input your message'
        ]);

        $thread = Thread::findOrFail($request->thread_id);

        $message = Message::create([
            'thread_id' => $thread->id,
            'user_id' => auth()->user()->id,
            'body' => $request->message,
        ]);

        return redirect(route('admin.messages').'?thread='.$thread->id)->withFlashSuccess('Message sent successfully');
    }

   public function getUnreadMessages(Request $request)
{
     $user = auth()->user();
    
    $unreadThreads = [];

    foreach (auth()->user()->threads as $item) {
        $unreadCount =$item->userUnreadMessagesCount($user->id);

        if ($unreadCount > 0) {
            $data = [
                'thread_id' => $item->id,
                'message' => \Illuminate\Support\Str::limit($item->latestMessage->body, 35),
                'unreadMessagesCount' => $unreadCount,
                'title' => $item->subject,
            ];
            $unreadThreads[] = $data;
        }
    }

    return ['unreadMessageCount' => $unreadMessageCount, 'threads' => $unreadThreads];
}

}
