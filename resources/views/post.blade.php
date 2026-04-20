@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<style>
/* ===== Modern Posts Page Styles ===== */
body {
    background: linear-gradient(135deg, #f5f7fb 0%, #e9ecef 100%);
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
}

/* ===== Category Filter ===== */
.category-filter-container {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 20px;
    margin: 30px auto;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    max-width: 1200px;
}

.filter-header {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.filter-items {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
}

.filter-item {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 25px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: #6b7280;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.filter-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    transition: left 0.3s ease;
    z-index: -1;
}

.filter-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    color: white;
}

.filter-item:hover::before {
    left: 0;
}

.filter-item.active-filter {
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    color: white;
    border-color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

/* ===== Posts Grid ===== */
.posts-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 5px 40px 5px;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

/* ===== Post Card ===== */
.post-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.post-image-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.post-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.post-card:hover .post-image {
    transform: scale(1.05);
}

.post-category-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.post-content {
    padding: 25px;
}

.post-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    text-decoration: none;
    display: block;
    margin-bottom: 10px;
    line-height: 1.4;
    transition: color 0.3s ease;
}

.post-title:hover {
    color: #667eea;
}

.post-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    color: #6b7280;
    font-size: 0.875rem;
}

.post-date {
    display: flex;
    align-items: center;
    gap: 5px;
}

.post-description {
    color: #4b5563;
    line-height: 1.6;
    margin-bottom: 20px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.post-author {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-top: 15px;
    border-top: 1px solid #e5e7eb;
}

.author-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e5e7eb;
}

.author-info {
    flex: 1;
}

.author-name {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.875rem;
}

/* ===== No Posts State ===== */
.no-posts-container {
    text-align: center;
    padding: 80px 20px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    margin: 40px auto;
    max-width: 600px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.no-posts-icon {
    font-size: 4rem;
    color: #9ca3af;
    margin-bottom: 20px;
}

.no-posts-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #4b5563;
    margin-bottom: 10px;
}

.no-posts-text {
    color: #6b7280;
    line-height: 1.6;
}

/* ===== Pagination ===== */
.pagination-container {
    display: flex;
    justify-content: center;
    margin: 50px 0;
}

.pagination {
    display: flex;
    gap: 10px;
    align-items: center;
}

.pagination .page-item .page-link {
    padding: 10px 15px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    background: white;
    color: #6b7280;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination .page-item .page-link:hover {
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    color: white;
    border-color: #667eea;
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    color: white;
    border-color: #667eea;
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
    animation: fadeInUp 0.6s ease-out;
}

.stagger-1 { animation-delay: 0.1s; }
.stagger-2 { animation-delay: 0.2s; }
.stagger-3 { animation-delay: 0.3s; }
.stagger-4 { animation-delay: 0.4s; }
.stagger-5 { animation-delay: 0.5s; }

/* ===== Responsive Design ===== */
@media (max-width: 768px) {
    .posts-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .category-filter-container {
        margin: 20px;
        padding: 15px;
    }
    
    .filter-items {
        justify-content: center;
    }
    
    .post-content {
        padding: 20px;
    }
}
</style>

<!-- Category Filter -->
<div class="category-filter-container fade-in-up">
    <h3 class="filter-header">
        <i class="bx bx-filter me-2"></i>Explore Topics
    </h3>
    <div class="filter-items">
        <a href="{{ route('posts') }}" 
           class="filter-item {{ !request('category') ? 'active-filter' : '' }}" 
           data-filter="all">
            <i class="bx bx-grid-alt me-1"></i> All Posts
        </a>
        @foreach($categories as $category)
            <a href="{{ route('posts', ['category' => $category->slug]) }}" 
               class="filter-item {{ request('category') == $category->slug ? 'active-filter' : '' }}" 
               data-filter="{{ $category->slug }}">
                <i class="bx bx-tag me-1"></i> {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>

<!-- Posts Grid -->
<div class="posts-container">
    <div class="posts-grid">
        @forelse($posts as $index => $post)
            <article class="post-card fade-in-up stagger-{{ ($index % 5) + 1 }}">
                <div class="post-image-container">
                    <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/img1.jpg') }}" 
                         alt="{{ $post->title }}" 
                         class="post-image">
                    <div class="post-category-badge">
                        {{ $post->category?->name ?? 'Uncategorized' }}
                    </div>
                </div>
                
                <div class="post-content">
                    <a href="{{ route('posts.show', $post->slug) }}" class="post-title">
                        {{ $post->title }}
                    </a>
                    
                    <div class="post-meta">
                        <div class="post-date">
                            <i class="bx bx-calendar"></i>
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <p class="post-description">{{ $post->excerpt }}</p>
                    
                    <div class="post-author">
                        <img src="https://img.freepik.com/vecteurs-libre/jeune-homme-capuche-orange_1308-175788.jpg?t=st=1776206521~exp=1776210121~hmac=8dbddcba5648fa3ffe41f6f7dfcf5387a135aa04333a55a343ee46e4d04f8468&w=1480" 
                             alt="{{ $post->author?->name ?? 'Author' }}" 
                             class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">{{ $post->author?->name ?? 'Anonymous' }}</div>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="no-posts-container fade-in-up">
                <div class="no-posts-icon">
                    <i class="bx bx-file-blank"></i>
                </div>
                <h3 class="no-posts-title">No posts found</h3>
                <p class="no-posts-text">
                    Try adjusting your filters or check back later for new content.
                </p>
            </div>
        @endforelse
    </div>
</div>

<!-- Pagination -->
@if($posts->hasPages())
    <div class="pagination-container">
        {{ $posts->links() }}
    </div>
@endif
@endsection