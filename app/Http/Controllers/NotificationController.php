<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\BookingNotification;
use Pusher\Pusher;
use Auth;
use DB;
use Session;

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
        $data["id"] = $user->notifications->first()->id;
        $data["numberOfUnReadNotification"] =  self::getNumberOfUnReadNotification();
        $pusher = self::configPusher();
        $pusher->trigger('NotificationEvent', 'send-message', $data);
    }
    
    public static function notifyStatusTourBooked($payment_id, $user)
    {
        $data = [
            'title' => 'Tour Status Notification',
            'content' => 'Tour update by admin',
            'payment_id' => $payment_id,
        ];
        $user->notify(new BookingNotification($data));
        $data["id"] = $user->notifications->first()->id;
        $pusher = self::configPusher();
        $pusher->trigger('NotificationEvent', 'send-message', $data);
    }

    public static function configPusher()
    {
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

        return $pusher;
    }

    public function markAsRead($id, $type)
    {
        $user = User::find(Auth::user()->user_id);
        $notification = $user->notifications->where('id', $id)->first();
        $notification->markAsRead();
        $html="";
        if($type){
            $html .= "
            <a class=\"nav-link\" id=\"#noti{$notification->id}\" 
                href=\"http://127.0.0.1:8000/payment/{$notification->data['payment_id']}\" >
                <span>{$notification->data['title']}</span><br>
                <small>{$notification->data['content']}</small>
            </a>
            <hr>";
        } else {
            $html .= "
            <a class=\"dropdown-item\" id=\"#noti{$notification->id}\" 
                href=\"http://127.0.0.1:8000/admin/payment/{$notification->data['payment_id']}\" >
                <span>{$notification->data['title']}</span><br>
                <small>{$notification->data['content']}</small>
            </a>
            <hr>";
        }
        return $html;
    }

    public function markAllAsRead($type)
    {
        $user = User::find(Auth::user()->user_id);
        $user->unreadNotifications->markAsRead();
        $html="";
        if($type){
            foreach($user->notifications as $notification){
                $html .= "
                <a class=\"nav-link\" id=\"#noti{$notification->id}\" 
                    href=\"http://127.0.0.1:8000/payment/{$notification->data['payment_id']}\" >
                    <span>{$notification->data['title']}</span><br>
                    <small>{$notification->data['content']}</small>
                </a>
                <hr>";
            }
        } else {
            foreach($user->notifications as $notification){
                $html .= "
                <div id=\"noti{{$notification->id}}\">
                    <a class=\"dropdown-item\" id=\"#noti{$notification->id}\" 
                        href=\"http://127.0.0.1:8000/admin/payment/{$notification->data['payment_id']}\" >
                        <span>{$notification->data['title']}</span><br>
                        <small>{$notification->data['content']}</small>
                    </a>
                    <hr>
                </div>";
            }
        }
        return $html;
    }

    public static function getNumberOfUnReadNotification()
    {
        $unReadNotification = DB::table('notifications')->where('read_at', NULL)->get();
        $numberOfUnReadNotification = count($unReadNotification);
        return $numberOfUnReadNotification;
    }
}
