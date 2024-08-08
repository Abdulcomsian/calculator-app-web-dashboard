<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
{
    public function getContact()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }

            $contacts = Contact::where('user_id', $user->id)->get();

            $contacts->each(function ($contact) {
                if ($contact->photo) {
                    $contact->photo_url = url($contact->photo);
                } else {
                    $contact->photo_url = null;
                }
            });

            return response()->json([
                "status" => "success",
                'data' => $contacts,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function storeOrUpdateContact(Request $request)
    {
        try {
            $this->validate($request, [
                "contact_no" => "required|string|max:15",
                "first_name" => "required|string|max:255",
                "last_name" => "required|string|max:255",
                "photo" => "nullable|image|mimes:jpg,jpeg,png,gif|max:2048",
            ]);

            if ($request->has('id')) {
                $contact = Contact::find($request->input('id'));

                if (!$contact) {
                    return response()->json([
                        "status" => "error",
                        "message" => "Contact not found.",
                    ], 404);
                }
            } else {
                $contact = new Contact;
                $contact->user_id = Auth::user()->id;
            }

            $contact->contact_no = $request->input("contact_no");
            $contact->first_name = $request->input("first_name");
            $contact->last_name = $request->input("last_name");

            if ($request->hasFile('photo')) {
                if ($contact->photo && File::exists(public_path($contact->photo))) {
                    File::delete(public_path($contact->photo));
                }

                $directory = 'contact_pictures';
                $directoryPath = public_path($directory);

                if (!File::exists($directoryPath)) {
                    File::makeDirectory($directoryPath, 0755, true);
                }

                $file = $request->file('photo');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move($directoryPath, $fileName);
                $contact->photo = $directory . '/' . $fileName;
            }

            $contact->save();

            return response()->json([
                "status" => "success",
                "message" => $request->has('id') ? "Contact Updated Successfully!" : "Contact Saved Successfully!",
                "contact" => $contact,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteContact($id)
    {
        try {
            Contact::findOrFail($id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Contact Deleted Successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
