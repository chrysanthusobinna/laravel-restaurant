<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;


class PrivacyPolicyController extends Controller
{
    use AdminViewSharedDataTrait;
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

        $privacyPolicy = PrivacyPolicy::firstOrNew([]);
        $privacyPolicy->content = $validatedData['content'];
        $privacyPolicy->save();

        return back()->with('success', 'Privacy Policy updated successfully.');

    }
}