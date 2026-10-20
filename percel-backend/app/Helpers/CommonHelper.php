<?php

namespace App\Helpers;

use Cache;
use DB;
use Image;
use Request;
use Route;
use Schema;
use Session;
use Storage;
use Validator;
use App\Models\Settings;
use App\Models\Notification;

class CommonHelper
{
    /**
     *  Comma-delimited data output from the child table
     */
     public static function first($table, $id)
    {
        $table = self::parseSqlTable($table)['table'];
        if (is_array($id)) {
            $first = DB::table($table);
            foreach ($id as $k => $v) {
                $first->where($k, $v);
            }

            return $first->first();
        } else {
            $pk = self::pk($table);

            return DB::table($table)->where($pk, $id)->first();
        }
    }
    public static function getSetting($name)
    {
        // if (Cache::has('setting_'.$name)) {
        //     return Cache::get('setting_'.$name);
        // }

        $query = DB::table('admin_settings')->select($name)->first();
        if(!empty($query))
        {
            Cache::forever('setting_'.$name, $query->$name);

            return $query->$name;
        }
       
    }
    public static function sendEmail($config = [])
    {

        $to = $config['to'];
        $data = $config['data'];
        $template = $config['template'];

        $template = AdminHelper::first('cms_email_templates', ['slug' => $template]);
        $html = $template->content;
        $subject = $template->subject;
        foreach ($data as $key => $val) {
            $html = str_replace('['.$key.']', $val, $html);
            $template->subject = str_replace('['.$key.']', $val, $template->subject);
            $subject = str_replace('['.$key.']', $val, $subject);
        }
        $attachments = (!empty($config['attachments'])) ?$config['attachments']: [];

        $setting_dtls = Settings::find(1);
        $logo =  $setting_dtls->logo;
        \Mail::send("emails.email_template", ['content' => $html,'logo'=>$logo], function ($message) use ($to, $subject, $template, $attachments) {
            $message->priority(1);
            $message->to($to);

            if ($template->from_email) {
                $from_name = ($template->from_name) ?: AdminHelper::getSetting('appname');
                $message->from($template->from_email, $from_name);
            }

            if ($template->cc_email) {
                $message->cc($template->cc_email);
            }

            if (count($attachments)) {
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            }

            $message->subject($subject);
        });
    }


   public static function dateFormat($date)
   {
        return date('Y-m-d', strtotime($date));
   }

   public static function dateTimeFormat($date)
   {
        return date('Y-m-d h:i A', strtotime($date));
   }

   public static function getCustomerReviews()
   {
     return \App\Review::where('status', 1)->orderBy('created_at','desc')->get();
   }

   public static function getPages()
   {
        $pages = [
            'home' => 'Homepage',
            'about' => 'About Us',
            'event' => 'Events',
            'contact_us' => 'Contact Us',
            'register' => 'Register',
            'login' => 'Login',
            'subscribe' => 'Subscribe'
        ];

        return $pages;
   }

   public static function notifyUsers($data)
   {
        if(isset($data[0]))
        {
            foreach($data as $dt)
            {
                Notification::insert([
                    'notify_to' => $dt['user_id'],
                    'message' => $dt['message'],
                    'status' => 0
                ]);
            }
        }else{
            Notification::insert([
                'notify_to' => $data['user_id'],
                'message' => $data['message'],
                'status' => 0
            ]);
        }
   }

   public static function calculateDuration($date)
   {
        $date1 = new \DateTime();
        $date2 = date('Y-m-d H:i:s', strtotime($date));        
        //return $date2;
        if(time()>strtotime($date2))
        {
            return "";
        }else{
            $date2 = new \DateTime(date('Y-m-d H:i:s', strtotime($date)));
            $duration = $date1->diff($date2);
            if($duration->days>0)
            {
                return $duration->format("%d days %h hrs %i minutes");
            }else{
                return $duration->format("%h hrs %i minutes");
            }
        }
   }

   public static function loadProfileImg($user, $class=NULL)
   {
        $img='';
        $class_name=(isset($class)?$class:'');
        if(!empty($user))
        {
            if($user->profile_image!='')
            {
                $img='<img class="'.$class_name.'" src="'.asset($user->profile_image).'" alt="'.$user->name.'"/>';
            }else{
                if($user->gender=='male')
                {
                    $img='<img class="'.$class_name.'" src="'.asset('assets/frontend/images/male-avatar.png').'" alt="'.$user->name.'"/>';
                }else{
                    $img='<img class="'.$class_name.'" src="'.asset('assets/frontend/images/female-avatar.png').'" alt="'.$user->name.'"/>';
                }
            }
            
        }else{
            $img='<img src="'.asset('assets/frontend/images/male-avatar.png').'" alt="Profile Image"/>';
        }

        return $img;
   }

   public static function printTime($date)
    {
        $date1 = new \DateTime();
        $date2 = new \DateTime(date('Y-m-d H:i:s', strtotime($date)));;
        $duration = $date2->diff($date1);
        
        if($duration->days>0)
        {
            return $duration->format("%d d");
        }else{
            if($duration->format("%h")>60)
            {
                return $duration->format("%h h");
            }else if($duration->format("%s")>60){
                return $duration->format("%i m");
            }else{
                return $duration->format("%s s");
            }            
        }
    }

}
