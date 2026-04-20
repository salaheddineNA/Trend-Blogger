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
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
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
.btn-outline-danger {
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-outline-primary:hover,
.btn-outline-danger:hover {
    transform: scale(1.05);
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

/* ===== Badges ===== */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.75rem;
}

/* ===== Code Slug ===== */
.slug-code {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 4px 8px;
    border-radius: 6px;
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
    color: #495057;
    border: 1px solid #dee2e6;
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
            <h2 class="fw-bold mb-1">📂 Categories Management</h2>
            <p class="text-muted mb-0">Organize your blog content with categories</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-gradient-primary">
            <i class="bx bx-plus-circle me-2"></i> Create Category
        </a>
    </div>

    <!-- Search -->
    <div class="card hover-card border-0 shadow-sm mb-4 fade-in-up" style="animation-delay: 0.1s">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="search-box">
                        <i class="bx bx-search search-icon"></i>
                        <input type="text" class="form-control" placeholder="Search categories by name..." id="searchInput">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="sortBy">
                        <option value="name">Sort by Name</option>
                        <option value="posts">Sort by Posts Count</option>
                        <option value="created">Sort by Created Date</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="text-muted">
                        <i class="bx bx-folder me-1"></i>
                        <span id="categoryCount">{{ $categories->count() }}</span> categories
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="card hover-card border-0 shadow-sm fade-in-up" style="animation-delay: 0.2s">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="categoriesTable">
                    <thead>
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Posts Count</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr class="category-row" data-name="{{ $category->name }}" data-posts="{{ $category->posts_count }}">
                                <td>
                                    <span class="text-muted fw-bold">{{ $loop->index + 1 }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="bx bx-folder text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $category->name }}</div>
                                            <small class="text-muted">Category</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="slug-code">{{ $category->slug }}</code>
                                </td>
                                <td>
                                    @if($category->posts_count > 0)
                                        <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);">
                                            <i class="bx bx-file me-1"></i> {{ $category->posts_count }} posts
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="bx bx-x me-1"></i> No posts
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group-sm d-flex gap-1">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-center">
                                        <div class="bg-light rounded-3 d-inline-flex p-3 mb-3">
                                            <i class="bx bx-folder text-muted fs-1"></i>
                                        </div>
                                        <h6 class="text-muted mb-2">No categories found</h6>
                                        <p class="text-muted small mb-3">Start organizing your content by creating categories</p>
                                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary rounded-pill">
                                            <i class="bx bx-plus-circle me-1"></i> Create First Category
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Search and Sort -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const sortBy = document.getElementById('sortBy');
    const categoryRows = document.querySelectorAll('.category-row');
    const noResultsRow = document.querySelector('.text-center.py-5');
    const categoryCount = document.getElementById('categoryCount');

    function filterCategories() {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;

        categoryRows.forEach(row => {
            const name = row.dataset.name.toLowerCase();
            const matchesSearch = name.includes(searchTerm);

            if (matchesSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update count
        if (categoryCount) {
            categoryCount.textContent = visibleCount;
        }

        // Show/hide no results message
        if (noResultsRow) {
            noResultsRow.style.display = visibleCount === 0 ? '' : 'none';
        }
    }

    function sortCategories() {
        const sortByValue = sortBy.value;
        const rowsArray = Array.from(categoryRows);

        rowsArray.sort((a, b) => {
            switch(sortByValue) {
                case 'name':
                    return a.dataset.name.localeCompare(b.dataset.name);
                case 'posts':
                    return parseInt(b.dataset.posts) - parseInt(a.dataset.posts);
                case 'created':
                    // This would need date data attributes for proper sorting
                    return 0;
                default:
                    return 0;
            }
        });

        const tbody = document.querySelector('#categoriesTable tbody');
        rowsArray.forEach(row => {
            tbody.appendChild(row);
        });
    }

    searchInput.addEventListener('input', filterCategories);
    sortBy.addEventListener('change', sortCategories);
});
</script>
@endsection
