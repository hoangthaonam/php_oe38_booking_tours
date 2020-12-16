<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\BookingNotification;
use Pusher\Pusher;
use Auth;

class NotificationController extends Controller
{
    public static function notifyNewTourBooked($payment_id)
    {
        $user = User::where('role', config('app.admin_role'))->first();
        $data = [
            'title' => 'New Tour Booked',
            'content' => 'Tour booked by '.Auth::user()->name,
            'payment_id' => $payment_id,
        ];
        $user->notify(new BookingNotification($data));
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_KEY'),
            env('PUSHER_SECRET'),
            env('PUSHER_ID'),
            $options
        );
        $data["id"] = $user->notifications->first()->id;
        $pusher->trigger('NotificationEvent', 'send-message', $data);
    }
    
    public function markAsRead($id)
    {
        $user = User::find(Auth::user()->user_id);
        $notification = $user->notifications->where('id', $id)->first();
        $notification->markAsRead();
        $html = "
        <a class=\"dropdown-item\" id=\"#noti{$notification->id}\" 
            href=\"http://127.0.0.1:8000/admin/payment/{$notification->data['payment_id']}\" >
            <span>{$notification->data['title']}</span><br>
            <small>{$notification->data['content']}</small>
        </a>
        <hr>";
        return $html;
    }
}
