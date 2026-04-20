@extends('admin.layout')

@section('admin_content')
<style>
.category-edit-header {
    background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%);
    color: white;
    padding: 40px 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
}

.category-edit-header::before {
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

.form-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.form-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.form-control:focus {
    border-color: #4DE5E7;
    box-shadow: 0 0 0 0.2rem rgba(77, 229, 231, 0.25);
}

.form-control-color {
    height: 50px;
    width: 100%;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%);
    border: none;
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(77, 229, 231, 0.3);
}

.btn-outline-secondary {
    border: 2px solid #6c757d;
    border-radius: 25px;
    padding: 12px 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    border-color: #6c757d;
    transform: translateY(-2px);
}

.color-preview {
    display: inline-block;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-left: 10px;
    vertical-align: middle;
    border: 2px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.category-stats {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 25px;
}

.stat-item {
    text-align: center;
    padding: 15px;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #4DE5E7;
}

.stat-label {
    color: #6c757d;
    font-size: 0.9rem;
    margin-top: 5px;
}

.invalid-feedback {
    font-size: 0.875rem;
    margin-top: 5px;
}
</style>

<!-- Header Section -->
<div class="category-edit-header">
    <div class="position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="mb-2 fw-bold">
                    <i class="bx bx-edit me-3"></i>Edit Category
                </h1>
                <p class="mb-0 opacity-75">Modify category information and settings</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                <i class="bx bx-arrow-back me-2"></i> Back to Categories
            </a>
        </div>
    </div>
</div>

<!-- Category Statistics -->
<div class="category-stats">
    <div class="row">
        <div class="col-md-4">
            <div class="stat-item">
                <div class="stat-number">{{ $category->posts->count() }}</div>
                <div class="stat-label">Total Posts</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-item">
                <div class="stat-number">{{ $category->posts()->where('is_published', true)->count() }}</div>
                <div class="stat-label">Published</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-item">
                <div class="stat-number">{{ $category->created_at->format('M d') }}</div>
                <div class="stat-label">Created</div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Form -->
<div class="form-card">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="name" class="form-label">
                        <i class="bx bx-tag me-2"></i>Category Name
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $category->name) }}" 
                           placeholder="Enter category name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="color" class="form-label">
                        <i class="bx bx-palette me-2"></i>Category Color
                        <span class="color-preview" id="colorPreview" style="background-color: {{ old('color', $category->color ?? '#000000') }};"></span>
                    </label>
                    <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                           id="color" name="color" value="{{ old('color', $category->color ?? '#000000') }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-4">
                    <label for="description" class="form-label">
                        <i class="bx bx-text me-2"></i>Description
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="5" 
                              placeholder="Enter category description (optional)">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-x me-2"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save me-2"></i> Update Category
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('color').addEventListener('input', function(e) {
    document.getElementById('colorPreview').style.backgroundColor = e.target.value;
});
</script>
@endsection
