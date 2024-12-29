<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\ArticleNews;
use App\Models\BannerAdvertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class FrontController extends Controller
{
    public function index(){
        $categories = Category::all();

        $articles = ArticleNews::with(['category'])
        ->where('is_featured','not_featured')
        ->take(12)
        ->latest()
        ->get();

        $featured_articles = ArticleNews::with(['category'])
        ->where('is_featured','featured')
        ->inRandomOrder()
        ->take(6)
        ->get();

        $authors = Author::all();
        $bannerAds = BannerAdvertisement::where('is_active','active')
        ->inRandomOrder()
        ->where('type','banner')
        // ->take(1)
        // ->get();
        ->first();
        

        $entertainment_articles = ArticleNews::whereHas('category', function ($querry)
        {
            $querry->where('name','Entertainment');
        })
        ->where('is_featured','not_featured')
        ->latest()
        ->take(6)
        ->get();

        $featured_entertainment_articles = ArticleNews::whereHas('category', function ($querry)
        {
            $querry->where('name','Entertainment');
        })
        ->where('is_featured','featured')
        ->inRandomOrder()
        ->first();

        $business_articles = ArticleNews::whereHas('category', function ($querry)
        {
            $querry->where('name','Business');
        })
        ->where('is_featured','not_featured')
        ->latest()
        ->take(6)
        ->get();

        $featured_business_articles = ArticleNews::whereHas('category', function ($querry)
        {
            $querry->where('name','Business');
        })
        ->where('is_featured','featured')
        ->inRandomOrder()
        ->first();

        $automotive_articles = ArticleNews::whereHas('category', function($querry)
        {
            $querry->where('name','automotive');
        })
        ->where('is_featured','not_featured')
        ->latest()
        ->take(6)
        ->get();

        $featured_automotive_articles = ArticleNews::whereHas('category', function ($querry){
            $querry->where('name','automotive');
        })
        ->where('is_featured','featured')
        ->inRandomOrder()
        ->first();


        return view('front.index',[
            'categories' => $categories,
            'articles' => $articles,
            'authors' => $authors,
            'bannerAds' => $bannerAds,
            'featured_articles' => $featured_articles,
            'entertainment_articles' => $entertainment_articles,
            'featured_entertainment_articles' => $featured_entertainment_articles,
            'business_articles' => $business_articles,
            'featured_business_articles' => $featured_business_articles,
            'automotive_articles' => $automotive_articles,
            'featured_automotive_articles' => $featured_automotive_articles,
        ]);
    }

    public function category (Category $category)
    {
        $categories = Category::all();
        $bannerAds = BannerAdvertisement::where('is_active','active')
        ->inRandomOrder()
        ->where('type','banner')
        // ->take(1)
        // ->get();
        ->first();
        return view('front.category',[
            'categories' => $categories,
            'category' => $category,
            'bannerAds' => $bannerAds
            
        ]);
    }

    public function author(Author $author){
        $categories = Category::all();
        $bannerAds = BannerAdvertisement::where('is_active','active')
        ->inRandomOrder()
        ->where('type','banner')
        // ->take(1)
        // ->get();
        ->first();

        return view('front.author',[
            'categories' => $categories,
            'author' => $author,
            'bannerAds' => $bannerAds
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'keywords' => ['required','string','max:255'],
        ]);
        $categories = Category::all();
        $keywords = $request->keywords;

        $articles = ArticleNews::with(['category','author'])->where('name','like', '%' . $keywords . '%')->paginate(6);

        return view('front.search',[
            'articles' => $articles,
            'keywords' => $keywords,
            'categories' => $categories
        ]);
    }

    public function details(ArticleNews $articleNews)
    {
        $categories = Category::all();

        $articles = ArticleNews::with(['category'])
        ->where('is_featured','not_featured')
        ->where('id', '!=' , $articleNews->id)
        ->take(3)
        ->inRandomOrder()
        ->get();

        $bannerAds = BannerAdvertisement::where('is_active','active')
        ->inRandomOrder()
        ->where('type','banner')
        // ->take(1)
        // ->get();
        ->first();

        $squareAds = BannerAdvertisement::where('is_active','active')
        ->where('type','square')
        ->inRandomOrder()
        ->take(2)
        ->get();

        if ($squareAds->count() < 2) {
            $squareAds_1 = $squareAds->first();
            $squareAds_2 = null;
            // $squareAds_2 = $squareAds->first(); munculin 2 iklan tpi sama
        } else {
            $squareAds_1 = $squareAds->get(0);
            $squareAds_2 = $squareAds->get(1);
        }


        $author_news = ArticleNews::where('author_id',$articleNews->author->id)
        ->where('id', '!=', $articleNews->id)
        ->inRandomOrder()
        ->get();

        return view('front.details',[
            'articleNews' => $articleNews,
            'categories' => $categories,
            'articles' => $articles,
            'bannerAds' => $bannerAds,
            'squareAds_1' => $squareAds_1,
            'squareAds_2' => $squareAds_2,
            'author_news'  => $author_news
        ]);
    }
}
