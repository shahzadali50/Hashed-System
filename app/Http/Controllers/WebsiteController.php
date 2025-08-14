<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BussinessSetting;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function websiteAppearance()
    {
        return view("admin.website_settings.appearance");
    }
    public function websiteTheme()
    {
        return view("admin.website_settings.theme");
    }
    public function websiteBanner()
    {
        return view("admin.website_settings.banner");
    }
    public function updateBussineesSetting(Request $request)
    {
        // Validate the input
        $request->validate([
            'header_logo' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'site_icon' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
           'banner_image' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

            'facebook_link' => ['nullable', 'url'],
            'youtube_link' => ['nullable', 'url'],
            'twitter_link' => ['nullable', 'url'],
            'instagram_link' => ['nullable', 'url'],
            'website_name' =>  ['nullable', 'string', 'max:40'],
            'Linkedin_link' => ['nullable', 'url'],
            'banner_youtube_link' => ['nullable', 'url'],
            'email' => ['nullable', 'email'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'banner_title' => ['nullable', 'string', 'max:50'],
            'banner_description' => ['nullable', 'string', 'max:1000'],
            'primary_color' => ['sometimes', 'nullable', 'string', 'max:20'],
            'secondary_color' => ['sometimes', 'nullable', 'string', 'max:20'],
            'font_family' => ['sometimes', 'nullable', 'string', 'max:50'],
            'layout' => ['sometimes', 'nullable', 'string', 'in:boxed,wide'],
        ]);

        // Handle the file uploads for header_logo and site_icon
        $this->updateBusinessSettingFile($request->file('header_logo'), 'header_logo');
        $this->updateBusinessSettingFile($request->file('site_icon'), 'site_icon');
        $this->updateBusinessSettingFile($request->file('banner_image'), 'banner_image');

        // Update the links and other fields
        $this->updateBusinessSetting('banner_youtube_link', $request->banner_youtube_link);
        $this->updateBusinessSetting('facebook_link', $request->facebook_link);
        $this->updateBusinessSetting('youtube_link', $request->youtube_link);
        $this->updateBusinessSetting('twitter_link', $request->twitter_link);
        $this->updateBusinessSetting('instagram_link', $request->instagram_link);
        $this->updateBusinessSetting('Linkedin_link', $request->Linkedin_link);
        $this->updateBusinessSetting('email', $request->email);
        $this->updateBusinessSetting('phone_number', $request->phone_number);
        $this->updateBusinessSetting('address', $request->address);
        $this->updateBusinessSetting('website_name', $request->website_name);
        $this->updateBusinessSetting('banner_title', $request->banner_title);
        $this->updateBusinessSetting('banner_description', $request->banner_description);

        // Theme settings
        $this->updateBusinessSetting('primary_color', $request->primary_color);
        $this->updateBusinessSetting('secondary_color', $request->secondary_color);
        $this->updateBusinessSetting('font_family', $request->font_family);
        $this->updateBusinessSetting('layout', $request->layout);

        return back()->with('success', 'Settings updated successfully.');
    }

    private function updateBusinessSetting($type, $value)
    {
        if (!is_null($value)) {
            BussinessSetting::updateOrCreate(['type' => $type], ['value' => $value]);
        }
    }

    private function updateBusinessSettingFile($file, $type)
    {
        if ($file) {
            $existing = BussinessSetting::where('type', $type)->first();
            if ($existing && Storage::disk('public')->exists($existing->value)) {
                Storage::disk('public')->delete($existing->value);
            }
            $filePath = $file->store($type, 'public');
            BussinessSetting::updateOrCreate(['type' => $type], ['value' => $filePath]);
        }
    }
}
