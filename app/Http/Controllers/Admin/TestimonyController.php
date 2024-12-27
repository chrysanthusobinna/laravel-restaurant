<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimony;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonyRequest;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;

class TestimonyController extends Controller
{
    use AdminViewSharedDataTrait;
    public function __construct()
    {
        $this->shareAdminViewData();
        
    }
    public function index()
    {
        $testimonies = Testimony::all();
        return view('admin.testimonies', compact('testimonies'));
    }

    public function store(TestimonyRequest  $request)
    {
        Testimony::create($request->all());
        return back()->with('success', 'Testimony Created successfully.');

    }


    public function update(TestimonyRequest $request, $id)
    {
        $testimony = Testimony::findOrFail($id);
        $testimony->update($request->all());
        return back()->with('success', 'Testimony updated successfully.');
    }

    public function destroy($id)
    {
        $testimony = Testimony::findOrFail($id);
        $testimony->delete();
        return back()->with('success', 'Testimony Deleted successfully.');
    }
}
