@extends('admin.layout')

@section('admin_content')
<style>
/* ===== Enhanced Styles ===== */
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
    border: 1px solid rgba(0,0,0,0.06);
}

.hover-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
}

/* ===== Table ===== */
.table {
    border-radius: 12px;
    overflow: hidden;
    background: white;
}

.table thead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.table thead th {
    border: none;
    padding: 16px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f0f0f0;
}

.table tbody tr:hover {
    background: linear-gradient(90deg, #f8f9ff 0%, #ffffff 100%);
    transform: scale(1.01);
}

.table td {
    padding: 16px;
    vertical-align: middle;
}

/* ===== Buttons ===== */
.btn-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gradient-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    color: white;
}

.btn-outline-primary,
.btn-outline-danger,
.btn-outline-success {
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-outline-primary:hover,
.btn-outline-danger:hover,
.btn-outline-success:hover {
    transform: scale(1.05);
}

/* ===== Badges ===== */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
}

/* ===== Search Box ===== */
.search-box {
    position: relative;
}

.search-box input {
    border-radius: 25px;
    border: 1px solid #e0e0e0;
    padding: 10px 20px 10px 45px;
    transition: all 0.3s ease;
}

.search-box input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
}

.search-box .search-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
}

/* ===== Status Pills ===== */
.status-published {
    background: linear-gradient(135deg, rgba(25, 135, 84, 0.15) 0%, rgba(25, 135, 84, 0.05) 100%);
    color: #198754;
    border: 1px solid rgba(25, 135, 84, 0.2);
}

.status-draft {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 193, 7, 0.05) 100%);
    color: #ff9800;
    border: 1px solid rgba(255, 193, 7, 0.2);
}

/* ===== Animations ===== */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}
</style>

<div class="container-fluid mb-5">
    <!-- Enhanced Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in-up">
        <div>
            <h2 class="fw-bold mb-1">📝 Posts Management</h2>
            <p class="text-muted mb-0">Manage and organize your blog posts</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-gradient-primary">
            <i class="bx bx-plus-circle me-2"></i> Create New Post
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="card hover-card border-0 shadow-sm mb-4 fade-in-up" style="animation-delay: 0.1s">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="search-box">
                        <i class="bx bx-search search-icon"></i>
                        <input type="text" class="form-control" placeholder="Search posts by title..." id="searchInput">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Posts Table -->
    <div class="card hover-card  shadow-sm fade-in-up" style="animation-delay: 0.2s;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="postsTable">
                    <thead>
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr class="post-row" data-title="{{ $post->title }}" data-category="{{ $post->category->id }}" data-status="{{ $post->is_published ? 'published' : 'draft' }}">
                                <td>
                                    <span class="text-muted fw-bold">{{ $loop->index + 1 }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="bx bx-file text-primary"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="text-decoration-none fw-semibold text-dark">
                                                {{ Str::limit($post->title, 50) }}
                                            </a>
                                            @if(strlen($post->title) > 50)
                                                <br><small class="text-muted">{{ Str::limit($post->title, 80) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);">
                                        {{ $post->category->name }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <span class="fw-medium">{{ $post->author->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($post->is_published)
                                        <span class="badge status-published">
                                            <i class="bx bx-check-circle me-1"></i> Published
                                        </span>
                                    @else
                                        <span class="badge status-draft">
                                            <i class="bx bx-edit me-1"></i> Draft
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small text-muted">{{ $post->created_at->format('M d, Y') }}</div>
                                    <div class="small text-muted">{{ $post->created_at->format('h:i A') }}</div>
                                </td>
                                <td>
                                    <div class="btn-group-sm d-flex gap-1">
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank" class="btn btn-sm btn-outline-success" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-center">
                                        <div class="bg-light rounded-3 d-inline-flex p-3 mb-3">
                                            <i class="bx bx-file text-muted fs-1"></i>
                                        </div>
                                        <h6 class="text-muted mb-2">No posts found</h6>
                                        <p class="text-muted small mb-3">Start by creating your first blog post</p>
                                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary rounded-pill">
                                            <i class="bx bx-plus-circle me-1"></i> Create First Post
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="card-footer bg-white border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} posts
                    </div>
                    <div>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- JavaScript for Search and Filter -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const statusFilter = document.getElementById('statusFilter');
    const postRows = document.querySelectorAll('.post-row');
    const noResultsRow = document.querySelector('.text-center.py-5');

    function filterPosts() {
        const searchTerm = searchInput.value.toLowerCase();
        const categoryValue = categoryFilter.value;
        const statusValue = statusFilter.value;
        let visibleCount = 0;

        postRows.forEach(row => {
            const title = row.dataset.title.toLowerCase();
            const category = row.dataset.category;
            const status = row.dataset.status;

            const matchesSearch = title.includes(searchTerm);
            const matchesCategory = !categoryValue || category === categoryValue;
            const matchesStatus = !statusValue || status === statusValue;

            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (noResultsRow) {
            noResultsRow.style.display = visibleCount === 0 ? '' : 'none';
        }
    }

    searchInput.addEventListener('input', filterPosts);
    categoryFilter.addEventListener('change', filterPosts);
    statusFilter.addEventListener('change', filterPosts);
});
</script>
@endsection
