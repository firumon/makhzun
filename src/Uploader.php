<?php

    namespace Firumon\Makhzun;

    use Firumon\Makhzun\Model\File;
    use Illuminate\Http\UploadedFile;

    class Uploader
    {
        private $file,$disk,$path;
        private $name,$name_client,$mime,$mime_client,$size,$extension;

        public function __construct(UploadedFile $file,$disk,$path)
        {
            $this->file = $file; $this->disk = $disk; $this->path = $path;
            $this->name = $file->hashName();
            $this->name_client = $file->getClientOriginalName();
            $this->mime = $file->getMimeType();
            $this->mime_client = $file->getClientMimeType();
            $this->size = $file->getSize();
            $this->extension = $file->extension();
        }

        private function doUpload(){
            return $this->file->storeAs($this->path,$this->name,$this->disk);
        }

        private function doStore($file){
            $keys = ['name','name_client','mime','mime_client','size','extension','disk','path'];
            $attributes = collect($keys)->mapWithKeys(function ($key){ return [$key => $this->$key]; })->merge(compact('file'))->toArray();
            return File::create($attributes)->id;
        }

        public static function upload($file,$Ary){
            $disk = $Ary['disk']; $path = $Ary['path'];
            $Uploader = new self($file,$disk,$path);
            return $Uploader->doStore($Uploader->doUpload());
        }
    }
