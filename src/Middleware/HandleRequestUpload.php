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
        $header_file = Cache::rememberForever('header_file',function (){
            return Header::select('code','d0','d1')->where('type','file')->get()->mapWithKeys(function ($data){
                return [$data->code => ['disk' => $data->d0 ?: $this->disk, 'path' => $data->d1 ?: $this->path]];
            })->toArray();
        });
        if($request->hasAny(array_keys($header_file))){
            foreach ($header_file as $code => $DiskPath)
                if($request->hasFile($code))
                    $request->replace([ $code => Uploader::upload($request->$code,$DiskPath)]);
        }
        return $next($request);
    }

    private $disk = 'local';
    private $path = 'uploads';
}
