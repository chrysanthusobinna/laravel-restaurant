<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;


class TermsAndConditionController extends Controller
{
    use AdminViewSharedDataTrait;
    public function __construct()
    {
        $this->shareAdminViewData();
        
    }
    public function edit()
    {
        $termsAndCondition = TermsAndCondition::latest()->first();

        return view('admin.terms-edit', compact('termsAndCondition'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $termsAndCondition = TermsAndCondition::firstOrNew([]);
        $termsAndCondition->content = $validatedData['content'];
        $termsAndCondition->save();

        return back()->with('success', 'Terms and Conditions updated successfully.');

    }
}