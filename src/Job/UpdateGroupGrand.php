<?php

namespace Firumon\Makhzun\Job;

use Firumon\Makhzun\Model\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateGroupGrand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $grands = []; $idGrand = [];
        Group::select('id','parent')->whereNotNull('master')->each(function($group)use(&$grands,&$idGrand){
            if(!$group->parent) $idGrand[$group->id] = $group->id;
            else {
                $grand = $idGrand[$group->parent]; $idGrand[$group->id] = $grand;
                if(!isset($grands[$grand])) $grands[$grand] = [];
                $grands[$grand][] = $group->id;
            }
        });
        foreach ($grands as $grand => $ids) Group::whereIn('id',$ids)->update(compact('grand'));
    }
}
