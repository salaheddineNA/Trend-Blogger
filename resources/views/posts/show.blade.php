@extends('layouts.app')

@section('title', $post->title)

@section('content')
<style>
/* ===== Modern Post Show Page Styles ===== */
body {
    background: linear-gradient(135deg, #f5f7fb 0%, #e9ecef 100%);
    font-family: 'Inter', sans-serif;
}

/* ===== Hero Header ===== */
.post-hero {
    background: linear-gradient(135deg, #667eea 0%, #4de5ff 100%);
    padding: 20px 0 20px;
    position: relative;
    overflow: hidden;
}

.post-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="30" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 1;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.post-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.category-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.category-badge:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.post-date {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}

.post-title {
    font-size: 1rem;
    font-weight: 800;
    color: white;
    line-height: 1.2;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.post-author {
    display: flex;
    align-items: center;
    gap: 15px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 15px 20px;
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.author-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255, 255, 255, 0.3);
}

.author-info {
    flex: 1;
}

.author-name {
    font-weight: 700;
    color: white;
    font-size: 1rem;
    margin-bottom: 2px;
}

.post-stats {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 15px;
}

/* ===== Main Content ===== */
.post-container {
    max-width: 900px;
    margin: 20px auto 0;
    position: relative;
    z-index: 10;
    padding: 0 20px;
}

.post-header-section {
    background: linear-gradient(135deg, #115561ff 0%, #4de5ff 100%);
    margin: -40px -40px 30px -40px;
    padding: 30px;
    border-radius: 20px 20px 0 0;
    position: relative;
    overflow: hidden;
}

.post-header-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="30" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
    opacity: 0.3;
}

.post-article {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    margin-bottom: 60px;
}

.post-featured-image {
    margin: -40px -40px 30px -40px;
    padding: 40px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px 20px 0 0;
}

.post-featured-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.post-excerpt {
    font-size: 1.25rem;
    line-height: 1.6;
    color: #4b5563;
    font-weight: 500;
    margin-bottom: 30px;
    padding: 25px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    border-left: 4px solid #4de5ff;
}

.post-body {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #374151;
}

.post-body p {
    margin-bottom: 20px;
}

.post-body h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1f2937;
    margin: 40px 0 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e5e7eb;
}

.post-body h3 {
    font-size: 1.4rem;
    font-weight: 600;
    color: #374151;
    margin: 30px 0 15px;
}

/* ===== Related Posts ===== */
.related-posts-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px 60px;
}

.related-header {
    text-align: center;
    margin-bottom: 50px;
}

.related-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 10px;
    position: relative;
    display: inline-block;
}

.related-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    border-radius: 2px;
}

.related-subtitle {
    color: #6b7280;
    font-size: 1.1rem;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}

.related-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
}

.related-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    text-decoration: none;
    color: inherit;
}

.related-image {
    height: 200px;
    overflow: hidden;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.related-card:hover .related-image img {
    transform: scale(1.05);
}

.related-content {
    padding: 25px;
}

.related-category {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 15px;
}

.related-post-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 10px;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.related-card:hover .related-post-title {
    color: #667eea;
}

.related-meta {
    color: #6b7280;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* ===== Animations ===== */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

.stagger-1 { animation-delay: 0.1s; }
.stagger-2 { animation-delay: 0.2s; }
.stagger-3 { animation-delay: 0.3s; }

/* ===== Responsive Design ===== */
@media (max-width: 768px) {
    .post-title {
        font-size: 2rem;
    }
    
    .post-article {
        padding: 25px;
    }
    
    .post-featured-image {
        margin: -25px -25px 20px -25px;
        padding: 25px;
    }
    
    .post-featured-image img {
        height: 250px;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .post-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}
</style>

<!-- Main Content -->
<div class="post-container">
    <article class="post-article fade-in-up">
        <!-- Combined Header Section -->
        <div class="post-header-section">
            <div class="post-meta">
                <span class="category-badge">
                    <i class="bx bx-tag me-1"></i> {{ $post->category?->name ?? 'Uncategorized' }}
                </span>
                <div class="post-date">
                    <i class="bx bx-calendar"></i>
                    {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                </div>
            </div>
            
            <h1 class="post-title">{{ $post->title }}</h1>
            
            <div class="post-author">
                <div class="author-info">
                    <div class="author-name">{{ $post->author?->name ?? 'Anonymous' }}</div>
                    <div class="post-stats">
                        <span><i class="bx bx-show me-1"></i>{{ $post->views ?? 0 }} views</span>
                    </div>
                </div>
            </div>
        </div>

        @if($post->image)
            <div class="post-featured-image">
                <img src="{{ asset('storage/' . $post->image) }}" 
                     alt="{{ $post->title }}" 
                     class="img-fluid">
            </div>
        @endif
        
        <div class="post-content">
            <div class="post-excerpt">
                {{ $post->excerpt }}
            </div>
            
            <div class="post-body">
                {!! nl2br($post->content) !!}
            </div>
        </div>
    </article>
</div>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
    <section class="related-posts-section">
        <div class="related-header fade-in-up">
            <h2 class="related-title">Related Posts</h2>
            <p class="related-subtitle">Discover more content you might enjoy</p>
        </div>
        
        <div class="related-grid">
            @foreach($relatedPosts as $index => $relatedPost)
                <a href="{{ route('posts.show', $relatedPost->slug) }}" 
                   class="related-card fade-in-up stagger-{{ ($index % 3) + 1 }}">
                    <div class="related-image">
                        @if($relatedPost->image)
                            <img src="{{ asset('storage/' . $relatedPost->image) }}" 
                                 alt="{{ $relatedPost->title }}">
                        @else
                            <img src="{{ asset('images/img1.jpg') }}" 
                                 alt="{{ $relatedPost->title }}">
                        @endif
                    </div>
                    
                    <div class="related-content">
                        <span class="related-category">{{ $relatedPost->category->name }}</span>
                        <h3 class="related-post-title">{{ $relatedPost->title }}</h3>
                        <div class="related-meta">
                            <i class="bx bx-calendar"></i>
                            {{ $relatedPost->published_at ? $relatedPost->published_at->format('M d, Y') : $relatedPost->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endif
@endsection
