<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::filter($request->search)->paginate(5); 

        return view('sections.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('sections.contacts.create');
    }

    public function store(ContactRequest $request)
    {
     
       $validatedData = $request->validated();
       $validatedData['user_id'] = Auth::id();
        Contact::create( $validatedData);

        return response()->json(
            ['message'=>'تمت الاضافة بنجاح']
        );
    }

    public function edit(Contact $contact)
    {
        return view('sections.contacts.edit', compact('contact'));
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        $validatedData = $request->validated();

        $contact->update($validatedData);

        return response()->json(
            ['message'=>'تمت التعديل بنجاح']
        );    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(
            ['message'=>'تمت الحذف بنجاح','contacts']
        );    }
}
