@extends('layouts.app')

@section('title', 'home')

@section('content')
    <section class="home" id="home">
        <div class="home-text container">
            <h2 class="home-title">Trend Blogger</h2>
            <span class="home-subtitle">Your source of great content</span>
        </div>
    </section>

    <section class="about container" id="about" style="margin-top:20px;">
        <div class="contentBx">
            <h2 class="titleText">Catch up with trending topics</h2>
            <p class="title-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum eos consequuntur voluptate dolorum totam provident ducimus cupiditate dolore doloribus repellat. Saepe ad fugit similique quis quam. Odio suscipit incidunt distinctio.
                <br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed blanditiis libero pariatur ipsum suscipit voluptates aut, repellendus quos dolor autem, natus laboriosam consectetur maxime cumque, sunt magni optio? Veritatis, ea?
            </p>
            <a href="#" class="btn2">Read more</a>
        </div>
        <div class="imgBx">
            <img src="https://p2.piqsels.com/preview/968/825/85/copy-space-copyspace-workspace-workplace.jpg" alt="" class="fitBg" style="border-radius: 10px;">
        </div>
    </section>

    <section style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 60px 0;">
        @if($latestPosts->count() > 0) 
        <!-- Modern Category Filter -->
        <div class="container mb-5">
            <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 30px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08); border: 1px solid rgba(0, 0, 0, 0.05);">
                <h3 style="font-size: 1.3rem; font-weight: 700; color: #1f2937; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="bx bx-filter me-2"></i>Browse by Category
                </h3>
                <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: center;">
                    <a href="{{ route('posts') }}" 
                       class="filter-item {{ request()->is('/') ? 'active-filter' : '' }}" 
                       style="display: inline-block; padding: 12px 25px; border-radius: 25px; background: {{ request()->is('/') ? 'linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%)' : 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)' }}; color: {{ request()->is('/') ? 'white' : '#6b7280' }}; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid transparent; position: relative; overflow: hidden;">
                        <i class="bx bx-grid-alt me-2"></i>All Posts
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('posts', ['category' => $category->slug]) }}" 
                           class="filter-item {{ request('category') == $category->slug ? 'active-filter' : '' }}" 
                           style="display: inline-block; padding: 12px 25px; border-radius: 25px; background: {{ request('category') == $category->slug ? 'linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%)' : 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)' }}; color: {{ request('category') == $category->slug ? 'white' : '#6b7280' }}; text-decoration: none; font-weight: 600; transition: all 0.3s ease; border: 2px solid transparent; position: relative; overflow: hidden;">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Modern Posts Grid -->
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 40px;">
                @foreach($latestPosts as $post)
                    <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; position: relative;"
                          onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(0, 0, 0, 0.15)'"
                          onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0, 0, 0, 0.1)'">
                        
                        <div style="position: relative; overflow: hidden; height: 250px;">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/img1.jpg') }}" 
                                 alt="{{ $post->title }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                 onmouseover="this.style.transform='scale(1.05)'"
                                 onmouseout="this.style.transform='scale(1)'">
                        </div>
                        
                        <div style="padding: 30px;">
                            <div style="display: inline-block; background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%); color: white; padding: 6px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $post->category?->name ?? 'Uncategorized' }}
                            </div>
                            
                            <a href="{{ route('posts.show', $post->slug) }}" 
                               style="font-size: 1.4rem; font-weight: 700; color: #1f2937; text-decoration: none; display: block; margin-bottom: 15px; line-height: 1.3; transition: color 0.3s ease;"
                               onmouseover="this.style.color='#4DE5E7'"
                               onmouseout="this.style.color='#1f2937'">
                                {{ $post->title }}
                            </a>
                            
                            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px; color: #6b7280; font-size: 0.9rem;">
                                <div style="display: flex; align-items: center; gap: 5px;">
                                    <i class="bx bx-calendar"></i>
                                    {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                                </div>
                                @if($post->views)
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="bx bx-show"></i>
                                        {{ $post->views }} views
                                    </div>
                                @endif
                            </div>
                            
                            <p style="color: #6b7280; line-height: 1.6; margin-bottom: 25px; font-size: 1rem;">
                                {{ $post->excerpt }}
                            </p>
                            
                            <div style="display: flex; align-items: center; gap: 15px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                                <img src="https://ui-avatars.com/api/?name={{ $post->author?->name ?? 'Anonymous' }}&background=725daa&color=fff&size=45" 
                                     alt="{{ $post->author?->name ?? 'Anonymous' }}" 
                                     style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 3px solid #f3f4f6;">
                                <span style="font-weight: 600; color: #1f2937;">{{ $post->author?->name ?? 'Anonymous' }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        @else
            <div class="container text-center" style="padding: 80px 20px; color: #6b7280;">
                <i class="bx bx-file-blank" style="font-size: 4rem; color: #d1d5db; margin-bottom: 20px;"></i>
                <h3 style="font-size: 1.8rem; margin-bottom: 10px; color: #374151;">No posts yet</h3>
                <p>Check back soon for new content!</p>
                <a href="{{ route('admin.posts.create') }}" 
                   class="btn btn-primary" 
                   style="background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%); border: none; border-radius: 25px; padding: 12px 30px; color: white; font-weight: 600;">
                    <i class="bx bx-plus me-2"></i>Create First Post
                </a>
            </div>
        @endif
    </section>
@endsection