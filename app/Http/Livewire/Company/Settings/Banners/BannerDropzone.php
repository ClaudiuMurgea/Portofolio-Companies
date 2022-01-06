<?php

namespace App\Http\Livewire\Company\Settings\Banners;

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
        return view('livewire.company.settings.banners.banner-dropzone');
    }

    function upload (Request $request, $id)
    {   
        $image = $request->file('file');

        $fileName = $image->store('photos', 'public');

        $banner = new Banner();
            $banner->company_id = $id;
            $banner->name = $fileName;
        $media = new Media();
        $media->url = $fileName;
        $media->save();
            $banner->media_id = $media->id;
            $banner->save();

        $manager = new ImageManager();
        $image = $manager->make('storage/'.$fileName)->resize(523.2, 255.66);
        $image->save('storage/'.$fileName);

        return response()->json(['success' => $imageName]);
    }
}
