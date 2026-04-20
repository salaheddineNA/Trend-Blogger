<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('Dashboard') }}
            </h2>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm" onclick="refreshDashboard()">
                    <i class="bx bx-refresh me-1"></i> Refresh
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h3 class="fw-bold mb-2">Welcome back, {{ Auth::user()->name }}! {{ __('') }}</h3>
                                    <p class="mb-0 opacity-90">{{ __("Here's what's happening with your blog today.") }}</p>
                                </div>
                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <div class="d-flex justify-content-md-end gap-2">
                                        <a href="{{ route('posts.create') }}" class="btn btn-light btn-sm">
                                            <i class="bx bx-plus-circle me-1"></i> New Post
                                        </a>
                                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-light btn-sm">
                                            <i class="bx bx-user me-1"></i> Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-1">{{ \App\Models\Post::where('user_id', Auth::id())->count() }}</h4>
                                    <p class="text-muted mb-0 small">My Posts</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 rounded-2 p-2">
                                        <i class="bx bx-file text-primary fs-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-1">{{ \App\Models\Post::where('user_id', Auth::id())->where('is_published', true)->count() }}</h4>
                                    <p class="text-muted mb-0 small">Published</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 rounded-2 p-2">
                                        <i class="bx bx-show text-success fs-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-1">{{ \App\Models\Post::where('user_id', Auth::id())->where('is_published', false)->count() }}</h4>
                                    <p class="text-muted mb-0 small">Drafts</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-10 rounded-2 p-2">
                                        <i class="bx bx-edit text-warning fs-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm hover-lift">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-1">{{ \App\Models\Category::count() }}</h4>
                                    <p class="text-muted mb-0 small">Categories</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-info bg-opacity-10 rounded-2 p-2">
                                        <i class="bx bx-category text-info fs-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm hover-lift position-relative">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-1">{{ \App\Models\ContactMessage::count() }}</h4>
                                    <p class="text-muted mb-0 small">Messages</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="bg-danger bg-opacity-10 rounded-2 p-2 position-relative">
                                        <i class="bx bx-envelope text-danger fs-5"></i>
                                        @php
                                            $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
                                        @endphp
                                        @if($unreadCount > 0)
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; margin-top: -5px; margin-left: 5px;">
                                                {{ $unreadCount }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($unreadCount > 0)
                                <div class="mt-2">
                                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-danger">
                                        <i class="bx bx-envelope-open me-1"></i> View {{ $unreadCount }} New Message{{ $unreadCount > 1 ? 's' : '' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & Quick Actions -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0">
                            <h5 class="mb-0 fw-semibold">My Recent Posts</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $recentPosts = \App\Models\Post::where('user_id', Auth::id())->latest()->take(5)->get();
                            @endphp
                            @if($recentPosts->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th class="border-0 text-muted fw-semibold">Title</th>
                                                <th class="border-0 text-muted fw-semibold">Status</th>
                                                <th class="border-0 text-muted fw-semibold">Created</th>
                                                <th class="border-0 text-muted fw-semibold text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentPosts as $post)
                                                <tr class="hover-lift">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                                                <i class="bx bx-file text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('posts.edit', $post->id) }}" class="text-decoration-none fw-semibold text-dark">
                                                                    {{ \Illuminate\Support\Str::limit($post->title, 40) }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($post->is_published)
                                                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill">
                                                                <i class="bx bx-check-circle me-1"></i>Published
                                                            </span>
                                                        @else
                                                            <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill">
                                                                <i class="bx bx-edit me-1"></i>Draft
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="small text-muted">{{ $post->created_at->format('M d, Y') }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary rounded">
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-info rounded" target="_blank">
                                                                <i class="bx bx-show"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary rounded-pill">
                                        View All Posts <i class="bx bx-right-arrow-alt ms-1"></i>
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="bg-light rounded-3 d-inline-flex p-3 mb-3">
                                        <i class="bx bx-file text-muted fs-1"></i>
                                    </div>
                                    <h6 class="text-muted mb-2">No posts yet</h6>
                                    <p class="text-muted small mb-3">Start creating content for your blog</p>
                                    <a href="{{ route('posts.create') }}" class="btn btn-primary rounded-pill">
                                        <i class="bx bx-plus-circle me-1"></i> Create your first post
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0">
                            <h5 class="mb-0 fw-semibold">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-3">
                                <a href="{{ route('posts.create') }}" class="btn btn-primary d-flex align-items-center justify-content-center py-3">
                                    <i class="bx bx-plus-circle me-2 fs-5"></i>
                                    <span>Create New Post</span>
                                </a>
                                <a href="{{ route('posts.index') }}" class="btn btn-outline-primary d-flex align-items-center justify-content-center py-3">
                                    <i class="bx bx-file me-2 fs-5"></i>
                                    <span>Manage Posts</span>
                                </a>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center py-3">
                                    <i class="bx bx-user me-2 fs-5"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mt-3">
                        <div class="card-header bg-white border-0">
                            <h5 class="mb-0 fw-semibold">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                            <div class="space-y-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded-2 p-2 me-3">
                                        <i class="bx bx-check-circle text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="small fw-semibold">Welcome to your dashboard</div>
                                        <div class="small text-muted">Just now</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
<style>
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.transition-all {
    transition: all 0.3s ease;
}

.space-y-3 > * + * {
    margin-top: 1rem;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1) !important;
}

.text-success-emphasis {
    color: #0f5132 !important;
}

.bg-warning-subtle {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.text-warning-emphasis {
    color: #664d03 !important;
}
</style>
@endpush

@push('scripts')
<script>
function refreshDashboard() {
    location.reload();
}
</script>
@endpush
