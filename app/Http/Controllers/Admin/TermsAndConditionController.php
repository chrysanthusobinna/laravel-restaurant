<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SanitizesInputTrait;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;


class TermsAndConditionController extends Controller
{
    use AdminViewSharedDataTrait;
    use SanitizesInputTrait;

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
        
        $sanitizedContent = $this->sanitizeHtmlContent($validatedData['content']);

        $termsAndCondition = TermsAndCondition::firstOrNew([]);
        $termsAndCondition->content = $sanitizedContent;
        $termsAndCondition->save();

        return back()->with('success', 'Terms and Conditions updated successfully.');

    }
}