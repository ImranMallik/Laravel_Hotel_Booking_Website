<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

use Intervention\Image\Drivers\Gd\Driver;

class GalleryController extends Controller
{
    //
    public function AllGallery()
    {
        $gallery = Gallery::latest()->get();
        return view('backend.gallery.all_gallery', compact('gallery'));
    }

    public function AddGallery()
    {
        return view('backend.gallery.add_gallery');
    } // End Method 

    public function StoreGallery(Request $request)
    {

        $images = $request->file('photo_name');

        foreach ($images as $img) {
            try {
                $image = new ImageManager(new Driver());
                $nam_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                // $img = $image->make($img);
                $img = $image->read($img);
                $directory = 'upload/gallery/';
                $img = $img->resize(550, 550);
                // $img->encode('jpg', 100)->save(public_path($directory . $nam_gen));
                $img->toJpeg(100)->save(public_path($directory . $nam_gen));

                $save_url = $directory . $nam_gen;

                Gallery::insert([
                    'photo_name' => $save_url,
                    'created_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Handle any exceptions (e.g., log the error, provide user feedback)
                return back()->withError('Failed to upload one or more images.');
            }
        }

        $notification = [
            'message' => 'Gallery Inserted Successfully',
            'alert-type' => 'success'
        ];


        return redirect()->route('all.gallery')->with($notification);
    } // End Method 


    public function EditGallery($id)
    {

        $gallery = Gallery::find($id);
        return view('backend.gallery.edit_gallery', compact('gallery'));
    }

    public function UpdateGallery(Request $request)
    {
        $gal_id = $request->id;
        $img = $request->file('photo_name');

        // Retrieve the existing gallery item
        $galleryItem = Gallery::find($gal_id);

        if ($galleryItem) {
            // Get the current image path
            $currentImagePath = public_path($galleryItem->photo_name);

            // Check if the file exists and delete it
            if (File::exists($currentImagePath)) {
                File::delete($currentImagePath);
            }

            $image = new ImageManager(new Driver());
            $nam_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            // $img = $image->make($img);
            $img = $image->read($img);
            $directory = 'upload/gallery/';
            $img = $img->resize(550, 550);
            $img->toJpeg(100)->save(public_path($directory . $nam_gen));

            $save_url = $directory . $nam_gen;

            // Update the gallery item with the new image path
            $galleryItem->update([
                'photo_name' => $save_url,
            ]);

            // Notification for successful update
            $notification = [
                'message' => 'Gallery Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.gallery')->with($notification);
        } else {
            // Handle the case where the gallery item is not found
            return redirect()->route('all.gallery')->withError('Gallery item not found.');
        }
    }

    public function DeleteGallery($id)
    {

        $item = Gallery::findOrFail($id);
        $img = $item->photo_name;
        unlink($img);

        Gallery::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Gallery Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteGalleryMultiple(Request $request)
    {

        $selectedItems = $request->input('selectedItem', []);

        foreach ($selectedItems as $itemId) {
            $item = Gallery::find($itemId);
            $img = $item->photo_name;
            unlink($img);
            $item->delete();
        }

        $notification = array(
            'message' => 'Selected Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ShowGallery()
    {
        $gallery = Gallery::latest()->get();
        return view('frontend.gallery.show_gallery', compact('gallery'));
    }

    public function ContactUs()
    {

        return view('frontend.contact.contact_us');
    }

    public function StoreContactUs(Request $request)
    {

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Your Message Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function AdminContactMessage()
    {

        $contact = Contact::latest()->get();
        return view('backend.contact.contact_message', compact('contact'));
    }
}
