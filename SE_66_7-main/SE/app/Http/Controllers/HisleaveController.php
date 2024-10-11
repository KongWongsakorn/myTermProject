<?php

namespace App\Http\Controllers;

use App\Models\eventdate;
use App\Models\users;
use App\Models\user;
use App\Models\leavebalances;
use App\Models\leaveofabsences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HisleaveController extends Controller
{
    
    public function showleavetype()
        {
            $leaveofabsences = leaveofabsences::with('typeleave1','users','approver')->get();
            $leavebalances = leavebalances::where('u_id',auth()->user()->id)->with('typeleave')->orderBy('typeL_id')->get();
            $users = user::where('id',auth()->user()->id)->with('subCategory')->get();
            $eventdate = eventdate::with('eventdate')->get(); 
            $show = leavebalances::where('u_id',auth()->user()->id)->select(DB::raw('SUM(remainingLeave) as totalremaining'))->groupBy('remainingLeave')->get();          
            $data = leavebalances::where('u_id', auth()->user()->id)->with('typeleave')->select('typeL_id', DB::raw('SUM(usedLeave) as totalUsedLeave'))->groupBy('typeL_id')->get();
            $number3 = leavebalances::where('u_id',auth()->user()->id)->where('typeL_id',3)->with('typeleave')->get();
            $number4 = leavebalances::where('u_id',auth()->user()->id)->where('typeL_id',4)->with('typeleave')->get();
            $number5 = leavebalances::where('u_id',auth()->user()->id)->where('typeL_id',5)->with('typeleave')->get();
            $typeL3 = leaveofabsences::where('u_id',auth()->user()->id)->where('typeL_id',3)->where('status', 'อนุมัติ')->get();
            $typeL4 = leaveofabsences::where('u_id',auth()->user()->id)->where('typeL_id',4)->where('status', 'อนุมัติ')->get();
            $typeL5 = leaveofabsences::where('u_id',auth()->user()->id)->where('typeL_id',5)->where('status', 'อนุมัติ')->get();
            $total3 = 0; $total4 = 0; $total5 = 0; 
            $totalday3 = 0; $totalday4 = 0; $totalday5 = 0;
            $num3 = 0; $num4 = 0; $num5 = 0; $n1 = 0;
            
            // showgraph
            $array[] = ['การลา', 'จำนวนวันลา'];
            foreach($data as $key => $value)
            {    
                $array[++$key] = [strval($value->typeleave->name), intval($value->totalUsedLeave)];
            }
            foreach($show as $sh){
                $n1 += $sh->totalremaining;
            }
            $array[] = ['จำนวนวันลาคงเหลือทั้งหมด',intval($n1)];                      
            
            //ลาป่วย
            foreach($number3 as $n3){
                $num3 = $n3->typeleave->number;
            }
            foreach ($typeL3 as $item){                      
                foreach ($eventdate as $event){                                                                                                                    
                    $firstDate = strtotime($item->firstDate);
                    $endDate = strtotime($item->endDate);
                    $eventday = strtotime($event->date); 
                    $day = 0;
                    $countSatSuneventday = 0;
                                                   
                    for ($i = $firstDate; $i <= $endDate; $i += 86400) {
                        $dayOfWeek = date('N', $i);
                            if ($dayOfWeek == 6 || $dayOfWeek == 7 || ($i == $eventday && $event->chechRest != 1)) { 
                                        $countSatSuneventday++;
                        }
                        $day++;
                    }
                    $totalday3 = $day - $countSatSuneventday;                                    
                }
                $total3 += $totalday3;
            }   

            $type3 = leavebalances::updateOrCreate(
                ['u_id' => auth()->user()->id,'typeL_id' => 3],
                ['usedLeave' => $total3, 'remainingLeave' => $num3 - $total3]
            );                       
            $type3->save();
            

            //ลากิจ
            foreach($number4 as $n4){
                $num4 = $n4->typeleave->number;
            }
            foreach ($typeL4 as $item){                      
                foreach ($eventdate as $event){                                                                                                                    
                    $firstDate = strtotime($item->firstDate);
                    $endDate = strtotime($item->endDate);
                    $eventday = strtotime($event->date); 
                    $day = 0;
                    $countSatSuneventday = 0;
                                                   
                    for ($i = $firstDate; $i <= $endDate; $i += 86400) {
                        $dayOfWeek = date('N', $i);
                            if ($dayOfWeek == 6 || $dayOfWeek == 7 || ($i == $eventday && $event->chechRest != 1)) { 
                                        $countSatSuneventday++;
                        }
                        $day++;
                    }
                    $totalday4 = $day - $countSatSuneventday;                                    
                }
                $total4 += $totalday4;
            }        
                                                 
            $type4 = leavebalances::updateOrCreate(
                ['u_id' => auth()->user()->id,'typeL_id' => 4],
                ['usedLeave' => $total4, 'remainingLeave' => $num4 - $total4]
            );                       
            $type4->save();

            //ลาพักร้อน
            foreach($number5 as $n5){
                $num5 = $n5->typeleave->number;
            }
            foreach ($typeL5 as $item){                      
                foreach ($eventdate as $event){                                                                                                                    
                    $firstDate = strtotime($item->firstDate);
                    $endDate = strtotime($item->endDate);
                    $eventday = strtotime($event->date); 
                    $day = 0;
                    $countSatSuneventday = 0;
                                                   
                    for ($i = $firstDate; $i <= $endDate; $i += 86400) {
                        $dayOfWeek = date('N', $i);
                            if ($dayOfWeek == 6 || $dayOfWeek == 7 || ($i == $eventday && $event->chechRest != 1)) { 
                                        $countSatSuneventday++;
                        }
                        $day++;
                    }
                    $totalday5 = $day - $countSatSuneventday;                                    
                }
                $total5 += $totalday5;
            }        
            
            
                $type5 = leavebalances::updateOrCreate(
                    ['u_id' => auth()->user()->id,'typeL_id' => 5],
                    ['usedLeave' => $total5, 'remainingLeave' => $num5 - $total5]
                );                       
                $type5->save();
            
            return view('leavetype',compact('leaveofabsences','leavebalances','users','eventdate',
                                            'typeL3','typeL4','typeL5',
                                            'type3','total3','totalday3',
                                            'type4','total4','totalday4',
                                            'type5','total5','totalday5')
                                            )->with('typeL',json_encode($array));
        }
    
    public function showleavehis()
        {
            $leaveofabsences = leaveofabsences::with('typeleave1','users','approver')->get();
            $users = users::with('subcategories')->get();
            $eventdate = eventdate::with('eventdate')->get();

            return view('leavehis',compact('leaveofabsences','users','eventdate'));
        }
}



    

