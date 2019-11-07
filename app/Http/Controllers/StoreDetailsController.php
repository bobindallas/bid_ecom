<?php

namespace App\Http\Controllers;

use App\Model\StoreDetail;
use Illuminate\Http\Request;

class StoreDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

		 $store_details = StoreDetail::first();

		 if (! $store_details) {
			 return $this->create();
		 } else {
			 return $this->edit($store_details);
		 }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
		return view('admin.store_details.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

		 // TODO: auth & validation

		 $store_details = new StoreDetail();

		 $store_details->name            = $request->input('name');
		 $store_details->address1        = $request->input('address1');
		 $store_details->address2        = $request->input('address2');
		 $store_details->city            = $request->input('city');
		 $store_details->state           = $request->input('state');
		 $store_details->country         = $request->input('country');
		 $store_details->postal_code     = $request->input('postal_code');
		 $store_details->phone1          = $request->input('phone1');
		 $store_details->phone2          = $request->input('phone2');
		 $store_details->fax             = $request->input('fax');
		 $store_details->email           = $request->input('email');
		 $store_details->description     = $request->input('description');
		 $store_details->enable_taxes    = $request->input('enable_taxes',0);
		 $store_details->enable_shipping = $request->input('enable_shipping',0);

		 $store_details->save();

	 	return redirect()->route('store_details.index')->with('success', 'Store Details Saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\StoreDetail  $storeDetail
     * @return \Illuminate\Http\Response
     */
    public function show(StoreDetail $storeDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\StoreDetail  $storeDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreDetail $store_details) {

		return view('admin.store_details.edit', compact('store_details'));
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\StoreDetail  $storeDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $store_details_id) {

		 // dd($request);
		 // dd($store_details);

		 // some route related issue here - bypass hydration for now
		 $store_details = StoreDetail::findOrFail($store_details_id);

		 $store_details->name            = $request->input('name');
		 $store_details->address1        = $request->input('address1');
		 $store_details->address2        = $request->input('address2');
		 $store_details->city            = $request->input('city');
		 $store_details->state           = $request->input('state');
		 $store_details->country         = $request->input('country');
		 $store_details->postal_code     = $request->input('postal_code');
		 $store_details->phone1          = $request->input('phone1');
		 $store_details->phone2          = $request->input('phone2');
		 $store_details->fax             = $request->input('fax');
		 $store_details->email           = $request->input('email');
		 $store_details->description     = $request->input('description');
		 $store_details->enable_taxes    = $request->input('enable_taxes',0);
		 $store_details->enable_shipping = $request->input('enable_shipping',0);

		 $store_details->save();

	 	return redirect()->route('store_details.index')->with('success', 'Store Details Saved');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\StoreDetail  $storeDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreDetail $storeDetail)
    {
        //
    }
}
