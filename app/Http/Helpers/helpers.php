<?php

if (!function_exists('business_setting')) {
    /**
     * Retrieve a business setting value by type.
     *
     * @param string $type
     * @return string|null
     */
    function business_setting($type)
    {
        // Fetch the record where type matches the provided type
        $businessSetting = \App\Models\BussinessSetting::where('type', $type)->first();

        if ($businessSetting) {
            // Return the value column directly
            return $businessSetting->value;
        }

        return null; // Return null if no record is found
    }
}
if (!function_exists('get_blogs')) {
    /**
     * Retrieve a list of blogs with their categories.
     *
     * @param int $limit Number of blogs to retrieve (default: 5)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function get_blogs($limit = 5)
    {
        return \App\Models\Blog::with('category:id,name,slug') // Eager load category with selected columns
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }
}

if (!function_exists('get_portfolio_categories')) {
    /**
     * Retrieve all portfolio categories with their related portfolios.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function get_portfolio_categories()
    {
        return \App\Models\PortfolioCategory::with('portfolios')->get();
    }
}



?>
