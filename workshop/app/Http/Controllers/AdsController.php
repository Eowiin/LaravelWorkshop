<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    public function index(Request $request)
    {
        $pages = DB::table('ads')->count() / 4;
        $ads = $this->getAds($request);
        $page = $request->input('page');

        // dd(substr($ads[0]['photo'], 7));
        return view('ads', [
            'ads' => $ads,
            'pages' => $pages,
            'page' => $page,
        ]);
    }

    public function getAds(Request $request)
    {
        $query = Ads::query();
        $category = $request->input('category');
        $location = $request->input('location');
        $lower_price = $request->input('lower_price');
        $upper_price = $request->input('upper_price');
        $condition = $request->input('condition');
        $search = $request->input('search');
        $page = $request->input('page');

        if ($category)
            $query->where('category', $category);
        if ($location)
            $query->where('location', $location);
        if ($lower_price)
            $query->where('price', '>=', $lower_price);
        if ($upper_price)
            $query->where('price', '<=', $upper_price);
        if ($condition)
            $query->where('condition', $condition);
        if ($search)
            $query->where('title', 'like', '%' . $search . '%');

        $ads = $query->skip(($page - 1) * 4)->take(4)->get();
        $ads_array = $ads->toArray();
        return $ads_array;
    }

    public function search(Request $request)
    {
        return redirect()->route('ads', [
            'page' => 1,
            'category' => $request->input('category'),
            'location' => $request->input('location'),
            'lower_price' => $request->input('lower_price'),
            'upper_price' => $request->input('upper_price'),
            'condition' => $request->input('condition'),
            'search' => $request->input('search'),
        ]);
    }

    public function filter(Request $request)
    {
        return redirect()->route('ads', [
            'page' => 1,
            'category' => $request->input('category'),
            'location' => $request->input('location'),
            'lower_price' => $request->input('lower_price'),
            'upper_price' => $request->input('upper_price'),
            'condition' => $request->input('condition'),
            'search' => $request->input('search'),
        ]);
    }

    public function add(Request $request)
    {
        return view('add');
    }

    public function create(Request $request)
    {
        $array = $request->validate([
            'title' => 'required|max:40',
            'category' => 'required',
            'description' => 'required|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|min:0|numeric',
            'location' => 'required|min:0|numeric|max:96000',
        ]);

        // dd($request->file('photo')->store('images'));
        $tmp_photo = $request->file('photo')->store('public/images');
        $ads = new Ads();
        $ads->title = $request->input('title');
        $ads->category = $request->input('category');
        $ads->description = $request->input('description');
        $ads->photo = substr($tmp_photo, 7);
        $ads->price = $request->input('price');
        $ads->location = $request->input('location');
        $ads->save();

        return redirect()->route('ads', [
            'page' => 1,
        ]);
    }
}
