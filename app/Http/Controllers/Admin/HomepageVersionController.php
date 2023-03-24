<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomepageVersion;
use Illuminate\Http\Request;

class HomepageVersionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieving models
        $homepage_version = HomepageVersion::first();

        return view('admin.banner.homepage_version.create', compact('homepage_version'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Form validation
        $request->validate([
            'choose_version' => 'required|in:home,home2',
        ]);

        // Get All Request
        $input = $request->all();

        // Update user
        HomepageVersion::find($id)->update($input);

        // Forget a single key...
        session()->forget('choose_version');

        return redirect()->route('homepage-version.create')
            ->with('success', 'content.updated_successfully');
    }

}
