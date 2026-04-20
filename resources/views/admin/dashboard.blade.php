@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')

<style>
/* ===== General ===== */
body {
    background: #f5f7fb;
    font-family: 'Inter', sans-serif;
}

/* ===== Cards ===== */
.hover-card {
    transition: all 0.3s ease;
    border-radius: 18px;
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);
}

.hover-card:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
}

/* ===== Icon ===== */
.icon-circle {
    width: 55px;
    height: 55px;
    border-radius: 15px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size: 22px;
}

/* ===== Buttons ===== */
.btn-gradient-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
    color: white;
    border: none;
    border-radius: 10px;
}

.btn-gradient-success {
    background: linear-gradient(135deg, #1cc88a, #13855c);
    color: white;
    border: none;
    border-radius: 10px;
}

.btn-gradient-primary:hover,
.btn-gradient-success:hover {
    transform: scale(1.02);
    opacity: 0.95;
}

/* ===== Table ===== */
.table {
    border-radius: 12px;
    overflow: hidden;
}

.table thead {
    background: #f8f9fc;
}

.table tbody tr {
    transition: 0.2s;
}

.table tbody tr:hover {
    background: #eef3ff;
}

.table td, .table th {
    padding: 16px;
}

/* ===== Category ===== */
.category-item {
    transition: all 0.25s ease;
    border-radius: 12px;
}

.category-item:hover {
    background: #eef3ff;
    transform: translateX(4px);
}

/* ===== Badge ===== */
.badge-soft-success {
    background: rgba(25, 135, 84, 0.12);
    color: #198754;
    padding: 6px 10px;
    border-radius: 8px;
}

.badge-soft-warning {
    background: rgba(255, 193, 7, 0.15);
    color: #ffb703;
    padding: 6px 10px;
    border-radius: 8px;
}

/* ===== Header ===== */
.card-header {
    border-bottom: none;
    font-weight: 600;
}

/* ===== Buttons small ===== */
.btn-outline-primary,
.btn-outline-danger,
.btn-outline-success,
.btn-outline-info {
    border-radius: 8px;
}
</style>

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <h2 class="fw-bold mb-1">📊 Dashboard</h2>
            <p class="fs-3 mb-0">Welcome back, Admin 👋</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mt-4">

        <!-- Posts -->
        <div class="col-md-3 mb-4">
            <div class="card hover-card shadow-sm border-0 p-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold">{{ App\Models\Post::count() }}</h3>
                        <small class="text-muted">Total Posts</small>
                    </div>
                    <div class="icon-circle bg-primary text-white">
                        <i class="bx bx-file"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-md-3 mb-4">
            <div class="card hover-card shadow-sm border-0 p-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold">{{ App\Models\Category::count() }}</h3>
                        <small class="text-muted">Categories</small>
                    </div>
                    <div class="icon-circle bg-success text-white">
                        <i class="bx bx-category"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Published -->
        <div class="col-md-3 mb-4">
            <div class="card hover-card shadow-sm border-0 p-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold">{{ App\Models\Post::where('is_published', true)->count() }}</h3>
                        <small class="text-muted">Published</small>
                    </div>
                    <div class="icon-circle bg-info text-white">
                        <i class="bx bx-show"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Drafts -->
        <div class="col-md-3 mb-4">
            <div class="card hover-card shadow-sm border-0 p-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold">{{ App\Models\Post::where('is_published', false)->count() }}</h3>
                        <small class="text-muted">Drafts</small>
                    </div>
                    <div class="icon-circle bg-warning text-white">
                        <i class="bx bx-edit"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="col-md-3 mb-4">
            <div class="card hover-card shadow-sm border-0 p-2 position-relative">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold">{{ App\Models\ContactMessage::count() }}</h3>
                        <small class="text-muted">Messages</small>
                        @php
                            $unreadCount = App\Models\ContactMessage::where('is_read', false)->count();
                        @endphp
                        @if($unreadCount > 0)
                            <div class="mt-2">
                                <span class="badge bg-danger">{{ $unreadCount }} New</span>
                            </div>
                        @endif
                    </div>
                    <div class="icon-circle bg-danger text-white position-relative">
                        <i class="bx bx-envelope"></i>
                        @if($unreadCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning" style="font-size: 0.6rem; margin-top: -5px; margin-left: 5px;">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </div>
                </div>
                @if($unreadCount > 0)
                    <div class="mt-2 text-center">
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-danger w-100">
                            <i class="bx bx-envelope-open me-1"></i> View Messages
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="card mb-4 border-0 shadow-sm hover-card">
        <div class="card-header bg-white">
            <h5 class="mb-0">⚡ Quick Actions</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-gradient-primary btn-lg w-100">
                        <i class="bx bx-plus-circle me-2"></i>
                        Create Post
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-gradient-success btn-lg w-100">
                        <i class="bx bx-category-plus me-2"></i>
                        Create Category
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Recent Posts -->
        <div class="col-md-6 p-4">
            <div class="card shadow-sm border-0 hover-card">
                <div class="card-header d-flex justify-content-between bg-white">
                    <h5>📝 Recent Posts</h5>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>

                <div class="card-body">
                    @if($recentPosts->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle table-borderless">
                                <thead class="text-muted small">
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($recentPosts as $post)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-dark">
                                                {{ Str::limit($post->title, 40) }}
                                            </a>
                                        </td>

                                        <td>
                                            <span class="badge bg-success">{{ $post->category->name }}</span>
                                        </td>

                                        <td>
                                            @if($post->is_published)
                                                <span class="badge badge-soft-success">Published</span>
                                            @else
                                                <span class="badge badge-soft-warning">Draft</span>
                                            @endif
                                        </td>

                                        <td>{{ $post->created_at->format('M d, Y') }}</td>

                                        <td>
                                            <div class="btn-group gap-1">
                                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline-primary">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                                <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="btn btn-outline-success">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger" onclick="return confirm('Delete?')">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No posts yet</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-md-6 p-4">
            <div class="card shadow-sm border-0 hover-card">
                <div class="card-header d-flex justify-content-between bg-white">
                    <h5>📂 Categories</h5>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-success">Manage</a>
                </div>

                <div class="card-body">
                    @foreach($categories as $category)
                        <div class="category-item d-flex justify-content-between align-items-center p-3 mb-2 border">
                            <div>
                                <strong>{{ $category->name }}</strong>
                                <span class="badge bg-secondary ms-2">{{ $category->posts_count }}</span>
                            </div>

                            <div class="btn-group gap-1">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline-success">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" onclick="return confirm('Delete?')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>

    <!-- Messages Section -->
    <div class="row">

        <!-- Messages -->
        <div class="col-12 p-4">
            <div class="card shadow-sm border-0 hover-card">
                <div class="card-header d-flex justify-content-between bg-white p-4">
                    <h5>📧 Recent Messages</h5>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-danger">View All Messages</a>
                </div>

                <div class="card-body">
                    @php
                        $recentMessages = App\Models\ContactMessage::latest()->take(10)->get();
                    @endphp
                    @if($recentMessages->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-middle table-borderless">
                                <thead class="text-muted small">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($recentMessages as $message)
                                    <tr class="{{ $message->is_read ? '' : 'bg-light' }}">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-user me-2 text-muted"></i>
                                                {{ $message->name }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bx bx-envelope me-2 text-muted"></i>
                                                {{ $message->email }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(!$message->is_read)
                                                    <span class="badge bg-danger me-2">New</span>
                                                @endif
                                                {{ Str::limit($message->subject, 40) }}
                                            </div>
                                        </td>

                                        <td>{{ $message->created_at->format('M d, Y - g:i A') }}</td>

                                        <td>
                                            @if($message->is_read)
                                                <span class="badge bg-success">Read</span>
                                            @else
                                                <span class="badge bg-warning">Unread</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="btn-group gap-1">
                                                <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-outline-primary">
                                                    <i class="bx bx-show"></i> View
                                                </a>
                                                @if(!$message->is_read)
                                                    <form action="{{ route('admin.messages.mark-read', $message->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-outline-success" title="Mark as read">
                                                            <i class="bx bx-check"></i> Mark Read
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this message?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger" title="Delete message">
                                                        <i class="bx bx-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bx bx-envelope-open fs-1 text-muted"></i>
                            <h5 class="mt-3">No messages yet</h5>
                            <p class="text-muted">When users contact you, their messages will appear here.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>

@endsection