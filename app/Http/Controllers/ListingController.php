<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //
    public function index(){
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag' , 'search']))->paginate(6)
        ]);
    }
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
        ]);
    }
    public function create(){
        return view('listings.create');
    }
    public function store(Request $request){
        $formFeilds = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings','company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' => 'required',
            'description' => 'required',

        ]);

        if($request->hasFile('logo')) {
            $formFeilds['logo'] =$request->file('logo')->store('logos','public'); 
        }
        
        Listing::create($formFeilds);

        return redirect('/')->with('message','Listings created successfully');
    }
    // show edit form
    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

    //update form
    public function update(Request $request, Listing $listing){
        $formFeilds = $request->validate([
            'title' => 'required',
            'company' =>'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' => 'required',
            'description' => 'required',

        ]);

        if($request->hasFile('logo')) {
            $formFeilds['logo'] =$request->file('logo')->store('logos','public'); 
        }
        
        $listing->update($formFeilds);

        return back()->with('message','Listings updated successfully');
    }

    public function destroy(Listing $listing) {
        $listing->delete();
        return redirect('/')->with('message','Listing deleted successfully');

    }

}
