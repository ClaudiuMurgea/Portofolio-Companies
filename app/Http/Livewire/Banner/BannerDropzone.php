<?php

namespace App\Http\Livewire\Banner;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Banner;
use App\Models\Media;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

class BannerDropzone extends Component
{
    use WithFileUploads;

    public function render()
    {
        return view('livewire.banner.banner-dropzone');
    }

    function upload (Request $request, $id)
    {   
        $image = $request->file('file');

        $fileName = $image->store('photos', 'public');
        $manager = new ImageManager();
        $image = $manager->make('storage/'.$fileName)->resize(523.2, 255.66);
        $image->save('storage/'.$fileName);

        $media = new Media();
        $media->url = $fileName;
        $media->save();

        $banner = new Banner();
        $banner->company_id = $id;
        $banner->media_id = $media->id;
        $banner->name = $fileName;
        $banner->save();

        return response()->json(['success' => $imageName]);
    }
}
