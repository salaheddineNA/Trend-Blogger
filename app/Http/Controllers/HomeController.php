<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::where('is_published', true)
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        $categories = Category::withCount('posts')->get();

        return view('welcome', compact('latestPosts', 'categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function dashboard()
    {
        $recentPosts = Post::with(['category', 'author'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $categories = Category::withCount('posts')->get();

        return view('admin.dashboard', compact('recentPosts', 'categories'));
    }

    public function posts(Request $request)
    {
        $query = Post::where('is_published', true)
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc');

        if ($request->has('category') && $request->category !== 'all') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $posts = $query->paginate(12);
        $categories = Category::all();

        return view('post', compact('posts', 'categories'));
    }
}
