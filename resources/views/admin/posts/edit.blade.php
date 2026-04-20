@extends('admin.layout')

@section('admin_content')
<style>
/* ===== Enhanced Form Styles ===== */
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

/* ===== Form Controls ===== */
.form-control, .form-select {
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    padding: 12px 16px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
    transform: translateY(-1px);
}

.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* ===== Buttons ===== */
.btn-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gradient-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    color: white;
}

.btn-outline-secondary {
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    transform: translateY(-2px);
    background: #f8f9fa;
}

/* ===== File Input ===== */
.file-upload-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}

.file-upload-wrapper input[type=file] {
    position: absolute;
    left: -9999px;
}

.file-upload-label {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    border: 2px dashed #667eea;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(77, 229, 231, 0.05) 100%);
    cursor: pointer;
    transition: all 0.3s ease;
    min-height: 100px;
}

.file-upload-label:hover {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(77, 229, 231, 0.1) 100%);
    border-color: #4de5e7;
}

.file-upload-label i {
    font-size: 2rem;
    color: #667eea;
    margin-right: 10px;
}

/* ===== Current Image Display ===== */
.current-image {
    margin-top: 15px;
    padding: 15px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    border: 1px solid #e0e0e0;
}

.current-image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* ===== Checkbox ===== */
.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.form-check-input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* ===== Sidebar Card ===== */
.sidebar-card {
    background: linear-gradient(135deg, #667eea 0%, #4de5ff 100%);
    color: white;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
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

/* ===== Character Counter ===== */
.char-counter {
    font-size: 0.85rem;
    color: #6b7280;
    margin-top: 4px;
}

.char-counter.warning {
    color: #f59e0b;
}

.char-counter.danger {
    color: #ef4444;
}
</style>

<div class="container-fluid mb-5">
    <!-- Enhanced Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in-up">
        <div>
            <h2 class="fw-bold mb-1">✏️ Edit Post</h2>
            <p class="text-muted mb-0">Update your post content and settings</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline">
            <i class="bx bx-arrow-back me-2"></i> Back to Posts
        </a>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Main Content Area -->
            <div class="col-md-8">
                <div class="card hover-card border-0 shadow-sm mb-4 fade-in-up" style="animation-delay: 0.1s">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label for="title" class="form-label">
                                <i class="bx bx-heading me-2"></i>Post Title
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $post->title) }}" 
                                   placeholder="Enter a compelling title..." required>
                            <div class="char-counter" id="titleCounter">{{ strlen(old('title', $post->title)) }} / 100 characters</div>
                            @error('title')
                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="excerpt" class="form-label">
                                <i class="bx bx-text me-2"></i>Excerpt
                            </label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                      id="excerpt" name="excerpt" rows="3" 
                                      placeholder="Write a brief summary..." required>{{ old('excerpt', $post->excerpt) }}</textarea>
                            <div class="char-counter" id="excerptCounter">{{ strlen(old('excerpt', $post->excerpt)) }} / 200 characters</div>
                            @error('excerpt')
                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label">
                                <i class="bx bx-file me-2"></i>Content
                            </label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="15" 
                                      placeholder="Start writing your amazing content..." required>{{ old('content', $post->content) }}</textarea>
                            <div class="char-counter" id="contentCounter">{{ str_word_count(old('content', $post->content)) }} words</div>
                            @error('content')
                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Publishing Options -->
                <div class="sidebar-card fade-in-up" style="animation-delay: 0.2s">
                    <h5 class="mb-3">
                        <i class="bx bx-cog me-2"></i>Publishing Options
                    </h5>
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label text-white">
                            <i class="bx bx-folder me-2"></i>Category
                        </label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" 
                                   value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="is_published">
                                <i class="bx bx-check-circle me-2"></i>Published
                            </label>
                        </div>
                        <small class="text-white-50">Uncheck to save as draft</small>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="card hover-card border-0 shadow-sm mb-4 fade-in-up" style="animation-delay: 0.3s">
                    <div class="card-body p-4">
                        <h5 class="mb-3">
                            <i class="bx bx-image me-2"></i>Featured Image
                        </h5>
                        
                        @if($post->image)
                            <div class="current-image mb-3">
                                <small class="text-muted d-block mb-2">Current Image:</small>
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Current featured image">
                                <small class="text-muted d-block mt-2">{{ $post->image }}</small>
                            </div>
                        @endif
                        
                        <div class="file-upload-wrapper">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <label for="image" class="file-upload-label">
                                <div>
                                    <i class="bx bx-cloud-upload"></i>
                                    <div>
                                        <strong>Click to upload</strong> or drag and drop<br>
                                        <small class="text-muted">PNG, JPG, GIF up to 10MB</small>
                                    </div>
                                </div>
                            </label>
                        </div>
                        
                        @error('image')
                            <div class="invalid-feedback mt-2 d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card hover-card border-0 shadow-sm fade-in-up" style="animation-delay: 0.4s">
                    <div class="card-body p-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-gradient-primary">
                                <i class="bx bx-save me-2"></i> Update Post
                            </button>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-default border border-dark">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript for Character Counters -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Title character counter
    const titleInput = document.getElementById('title');
    const titleCounter = document.getElementById('titleCounter');
    
    titleInput.addEventListener('input', function() {
        const length = this.value.length;
        titleCounter.textContent = `${length} / 100 characters`;
        
        if (length > 80) {
            titleCounter.classList.add('danger');
            titleCounter.classList.remove('warning');
        } else if (length > 60) {
            titleCounter.classList.add('warning');
            titleCounter.classList.remove('danger');
        } else {
            titleCounter.classList.remove('warning', 'danger');
        }
    });
    
    // Excerpt character counter
    const excerptInput = document.getElementById('excerpt');
    const excerptCounter = document.getElementById('excerptCounter');
    
    excerptInput.addEventListener('input', function() {
        const length = this.value.length;
        excerptCounter.textContent = `${length} / 200 characters`;
        
        if (length > 180) {
            excerptCounter.classList.add('danger');
            excerptCounter.classList.remove('warning');
        } else if (length > 150) {
            excerptCounter.classList.add('warning');
            excerptCounter.classList.remove('danger');
        } else {
            excerptCounter.classList.remove('warning', 'danger');
        }
    });
    
    // Content word counter
    const contentInput = document.getElementById('content');
    const contentCounter = document.getElementById('contentCounter');
    
    contentInput.addEventListener('input', function() {
        const words = this.value.trim().split(/\s+/).filter(word => word.length > 0).length;
        contentCounter.textContent = `${words} words`;
    });
    
    // File upload feedback
    const imageInput = document.getElementById('image');
    const fileLabel = document.querySelector('.file-upload-label');
    
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
            
            fileLabel.innerHTML = `
                <div>
                    <i class="bx bx-check-circle" style="color: #10b981;"></i>
                    <div>
                        <strong>${fileName}</strong><br>
                        <small class="text-muted">${fileSize} MB</small>
                    </div>
                </div>
            `;
        }
    });
});
</script>
@endsection
