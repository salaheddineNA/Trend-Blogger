@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<style>
.profile-hero {
    background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%);
    color: white;
    padding: 60px 0;
    position: relative;
    overflow: hidden;
}

.profile-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="50" r="3" fill="rgba(255,255,255,0.1)"/></svg>');
    animation: float 20s infinite linear;
}

@keyframes float {
    0% { transform: translate(0, 0); }
    100% { transform: translate(-50px, -50px); }
}

.profile-avatar {
    width: 150px;
    height: 150px;
    border: 5px solid rgba(255,255,255,0.3);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.profile-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    margin-bottom: 20px;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-label {
    color: #6c757d;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 5px;
}

.post-card {
    background: white;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 15px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-left: 4px solid #667eea;
}

.post-card:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 25px rgba(0,0,0,0.15);
}

.edit-profile-btn {
    background: rgba(255,255,255,0.2);
    border: 2px solid rgba(255,255,255,0.3);
    color: white;
    padding: 10px 25px;
    border-radius: 25px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.edit-profile-btn:hover {
    background: rgba(255,255,255,0.3);
    border-color: rgba(255,255,255,0.5);
    color: white;
    transform: translateY(-2px);
}

.empty-state {
    padding: 60px 20px;
    text-align: center;
    color: #6c757d;
}

.icon-2 {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 20px;
}



.badge-custom {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

</style>

<!-- Profile Hero Section -->
<div class="profile-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=725daa&color=fff&size=150" 
                     alt="Profile" class="rounded-circle profile-avatar">
            </div>
            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-3">{{ Auth::user()->name }}</h1>
                <p class="lead mb-2">{{ Auth::user()->email }}</p>
                <p class="mb-4">
                    <i class="bx bx-calendar me-2"></i>
                    Member since {{ Auth::user()->created_at->format('F d, Y') }}
                </p>
                <button class="btn edit-profile-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="bx bx-edit me-2"></i> Edit Profile
                </button>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-number">{{ Auth::user()->posts->count() }}</div>
                    <div class="stat-label">Total Posts</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <i class="bx bx-file-blank fs-2 text-primary mb-3"></i>
                <div class="stat-number">{{ Auth::user()->posts()->where('is_published', true)->count() }}</div>
                <div class="stat-label">Published</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="bx bx-edit-alt fs-2 text-warning mb-3"></i>
                <div class="stat-number">{{ Auth::user()->posts()->where('is_published', false)->count() }}</div>
                <div class="stat-label">Drafts</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="bx bx-show fs-2 text-info mb-3"></i>
                <div class="stat-number">{{ Auth::user()->posts()->sum('views') ?? 0 }}</div>
                <div class="stat-label">Total Views</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <i class="bx bx-trending-up fs-2 text-success mb-3"></i>
                <div class="stat-number">{{ Auth::user()->posts()->count() > 0 ? round(Auth::user()->posts()->sum('views') / Auth::user()->posts()->count()) : 0 }}</div>
                <div class="stat-label">Avg Views</div>
            </div>
        </div>
    </div>
</div>
        
        <!-- Recent Posts Section -->
<div class="container mt-5 " style="margin-bottom: 200px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Recent Posts</h2>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="bx bx-plus me-2"></i> Create New Post
        </a>
    </div>
    
    @if(Auth::user()->posts->count() > 0)
        <div class="row">
            @foreach(Auth::user()->posts()->with('category')->latest()->take(6)->get() as $post)
                <div class="col-md-6 mb-4">
                    <div class="post-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-2">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none text-dark" target="_blank">
                                        {{ Str::limit($post->title, 60) }}
                                    </a>
                                </h5>
                                <div class="d-flex gap-2 mb-2">
                                    @if($post->category)
                                        <span class="badge badge-custom bg-primary">{{ $post->category->name }}</span>
                                    @else
                                        <span class="badge badge-custom bg-secondary">Uncategorized</span>
                                    @endif
                                    @if($post->is_published)
                                        <span class="badge badge-custom bg-success">Published</span>
                                    @else
                                        <span class="badge badge-custom bg-warning">Draft</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="text-muted small">
                                    <i class="bx bx-show me-1"></i>{{ $post->views ?? 0 }}
                                </div>
                                <div class="text-muted small">
                                    <i class="bx bx-calendar me-1"></i>{{ $post->created_at->format('M d') }}
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-muted mb-3">{{ Str::limit(strip_tags($post->content ?? ''), 100) }}</p>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bx bx-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-info" target="_blank">
                                <i class="bx bx-show me-1"></i> View
                            </a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                    <i class="bx bx-trash me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if(Auth::user()->posts->count() > 6)
            <div class="text-center mt-4">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-primary">
                    View All Posts ({{ Auth::user()->posts->count() }} total)
                </a>
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="bx bx-file-blank icon-2"></i>
            <h3 class="mb-3">No Posts Yet</h3>
            <p class="mb-4">You haven't created any posts yet. Start sharing your thoughts with the world!</p>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-lg" style="background: #0b5ed7; border: none; border-radius: 15px; padding: 12px 30px;">
                <i class="bx bx-plus me-2" style="font-size: 1.2rem;"></i> Create Your First Post
            </a>
        </div>
    @endif
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title fw-bold">
                    <i class="bx bx-edit me-2"></i>Edit Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">
                            <i class="bx bx-user me-2"></i>Name
                        </label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" 
                               value="{{ Auth::user()->name }}" required
                               style="border-radius: 10px; border: 2px solid #e9ecef;">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">
                            <i class="bx bx-envelope me-2"></i>Email
                        </label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" 
                               value="{{ Auth::user()->email }}" required
                               style="border-radius: 10px; border: 2px solid #e9ecef;">
                    </div>
                    <hr class="my-4">
                    <h6 class="fw-semibold mb-3">
                        <i class="bx bx-lock me-2"></i>Change Password
                    </h6>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password (optional)</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Leave blank to keep current password"
                               style="border-radius: 10px; border: 2px solid #e9ecef;">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" 
                               name="password_confirmation" placeholder="Confirm new password"
                               style="border-radius: 10px; border: 2px solid #e9ecef;">
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal" style="border-radius: 10px;">
                        <i class="bx bx-x me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 10px;">
                        <i class="bx bx-save me-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
