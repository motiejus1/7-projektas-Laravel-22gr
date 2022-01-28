<?php

namespace App\Http\Controllers;

use App\Models\ProfileImage;
use App\Http\Requests\StoreProfileImageRequest;
use App\Http\Requests\UpdateProfileImageRequest;

use Illuminate\Http\Request;

class ProfileImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profileImages = ProfileImage::all();
        return view('profileimage.index', ['profileImages' => $profileImages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profileimage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profileImage = new ProfileImage;

        $profileImage->alt = $request->image_alt;

        //time(); //string - tekstas, 12544353531 - timestamp

        $imageName = 'image' . time().'.'.$request->image_src->extension();

        $request->image_src->move(public_path('images') , $imageName);

        $profileImage->src = $imageName;
        //paveiksliukas.docx
        // $imageName = image1245157451354.docx


        //pacio paveiksliu patalpinimas i serveri ir jo pavadinimo pasiemimas/sudarymas, kelio irasymas i duomenu baze
        
        //paveiksliukai/ aplankas

        //paveiksliukas.jpg
        //paveiksliukas.png 
        //paveiksliukas.png

        //paveiksliukas24135.png
        //paveiksliukas21251.png

        $profileImage->width = $request->image_width;
        $profileImage->height = $request->image_height;
        $profileImage->class = $request->image_class;

        $profileImage->save();

        // 
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfileImage  $profileImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileImage $profileImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfileImage  $profileImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileImage $profileImage)
    {
        return view('profileimage.edit',['profileImage'=> $profileImage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileImageRequest  $request
     * @param  \App\Models\ProfileImage  $profileImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileImage $profileImage)
    {


        //jeigu file yra tuscias - duombazeje nieko nedarom
        //kitu atveju jei pasirinkome nauja paveiksliuka




        // if(isset($_POST['image_src]) $$ !empty($_POST['image_src]) ))

        if($request->has('image_src')) {
            $imageName = 'image' . time().'.'.$request->image_src->extension();
            $request->image_src->move(public_path('images') , $imageName);
            $profileImage->src = $imageName;
        }
        
        $profileImage->alt = $request->image_alt;
        $profileImage->width = $request->image_width;
        $profileImage->height = $request->image_height;
        $profileImage->class = $request->image_class;

        
        
        $profileImage->save();

        // 
        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfileImage  $profileImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileImage $profileImage)
    {
        //
    }
}
