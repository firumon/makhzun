<?php

namespace Firumon\Makhzun\Middleware;

use Closure;
use Firumon\Makhzun\Model\Header;
use Firumon\Makhzun\Uploader;
use Illuminate\Support\Facades\Cache;

class HandleRequestUpload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->files->count()){
            $header_file = Cache::rememberForever('header_file',function (){
                return Header::select('code','d0','d1')->where('type','file')->get()->mapWithKeys(function ($data){
                    return [$data->code => ['disk' => $data->d0 ?: $this->disk, 'path' => $data->d1 ?: $this->path]];
                })->toArray();
            });
            foreach ($request->files as $code => $uploadedFile){
                if(!isset($header_file[$code])) continue; $DiskPath = $header_file[$code]; $var = $code . '_ID';
                $$var = Uploader::upload($request->$code,$DiskPath); $request->merge(compact($var));
            }
        }
        return $next($request);
    }

    private $disk = 'local';
    private $path = 'uploads';
}
