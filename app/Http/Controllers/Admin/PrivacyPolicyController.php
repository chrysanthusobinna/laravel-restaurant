<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SanitizesInputTrait;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;


class PrivacyPolicyController extends Controller
{
    use AdminViewSharedDataTrait;
    use SanitizesInputTrait;

    public function __construct()
    {
        $this->shareAdminViewData();
        
    }
    public function edit()
    {
         $privacyPolicy = PrivacyPolicy::latest()->first();
        return view('admin.privacy-policy-edit', compact('privacyPolicy'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);
    
        $sanitizedContent = $this->sanitizeHtmlContent($validatedData['content']);
    
        $privacyPolicy = PrivacyPolicy::firstOrNew([]);
        $privacyPolicy->content = $sanitizedContent;
        $privacyPolicy->save();
    
        return back()->with('success', 'Privacy Policy updated successfully.');
    }
    
}