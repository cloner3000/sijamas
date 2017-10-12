<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrinataController extends Controller
{
    public function __construct()
    {
    	if (\Auth::user()) {
            $notif = $this->getNotif();
            // dd($notif);
            \View::share('notif', $notif);  
        } 
    }

    public function logNotif($id, $type)
    {
        $log = \App\Models\Notification::whereUserId(\Auth::user()->id)->whereType($type)->whereContentId($id)->count();
            if ($log < 1) \App\Models\Notification::create(['user_id'=>\Auth::user()->id, 'content_id'=>$id, 'type'=>$type]);
    }

    public function getNotif()
    {
        $data = ['cooperation'=>[], 'proposed'=>[]];

        $log = \App\Models\Notification::whereUserId(\Auth::user()->id)->get();
        if ($log) {
            foreach ($log as $key => $value) {
                $data[$value->type][] = $value->content_id;
            }
        }
        
        $cooperationData = (count($data['cooperation']) > 0) ? implode(',', $data['cooperation']) : 'null'; 
        $proposedData = (count($data['proposed']) > 0) ? implode(',', $data['proposed']) : 'null'; 
        
        $cooperation = \DB::table('cooperations')
                        ->select('cooperations.id as id', 'cooperations.title as title', 'cooperations.created_at as created_at', 
                            \DB::raw("if (cooperations.id in (".$cooperationData."), 'read', 'pending') as 'read', 'cooperation' as type")
                            )
                        ->where('cooperations.approval', 'draft')
                        ->orderBy('cooperations.created_at', 'desc');
        
        $proposeds  = \DB::table('proposed_cooperations')
                        ->select('proposed_cooperations.id as id', 'proposed_cooperations.title as title', 'proposed_cooperations.created_at as created_at', 
                            \DB::raw("if (proposed_cooperations.id in (". $proposedData ."), 'read', 'pending') as 'read', 'proposed' as type")
                            )
                        ->where('approval', 'draft')
                        ->orderBy('created_at', 'desc');
        
        $dataArr = $cooperation->union($proposeds)->orderBy('created_at', 'desc')->take(10)->get();
        
        
        return $dataArr;
    }
}
