<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Display a listing of published posts
     */
    public function index()
    {
        $posts = Post::published()
            ->locale()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('blog', compact('posts'));
    }

    /**
     * Display a single post
     */
    public function show(Request $request)
    {
        $slug = $request->route('slug');
        
        $post = Post::where('slug', $slug)->firstOrFail();
        
        // Only show published posts to public
        if ($post->status !== 'published') {
            abort(404);
        }

        return view('blog-show', compact('post'));
    }
}
