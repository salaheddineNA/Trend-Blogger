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

/* ===== Color Picker ===== */
.color-picker-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    gap: 15px;
}

.color-input {
    width: 60px;
    height: 60px;
    border: 3px solid #e0e0e0;
    border-radius: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.color-input:hover {
    border-color: #667eea;
    transform: scale(1.05);
}

.color-preview {
    flex: 1;
    padding: 12px 16px;
    border-radius: 10px;
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    font-family: 'Courier New', monospace;
    font-weight: 600;
    text-align: center;
    transition: all 0.3s ease;
}

/* ===== Category Preview ===== */
.category-preview {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    padding: 20px;
    margin-top: 20px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.category-preview:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.preview-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-top: 10px;
    transition: all 0.3s ease;
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
            <h2 class="fw-bold mb-1">📁 Create New Category</h2>
            <p class="text-muted mb-0">Organize your content with categories</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
            <i class="bx bx-arrow-back me-2"></i> Back to Categories
        </a>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <!-- Main Content Area -->
            <div class="col-md-8">
                <div class="card hover-card border-0 shadow-sm mb-4 fade-in-up" style="animation-delay: 0.1s">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label for="name" class="form-label">
                                <i class="bx bx-tag me-2"></i>Category Name
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Enter category name..." required>
                            <div class="char-counter" id="nameCounter">0 / 50 characters</div>
                            @error('name')
                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class="bx bx-text me-2"></i>Description
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="6" 
                                      placeholder="Describe this category...">{{ old('description') }}</textarea>
                            <div class="char-counter" id="descCounter">0 / 200 characters</div>
                            @error('description')
                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category Preview -->
                        <div class="category-preview fade-in-up" style="animation-delay: 0.3s">
                            <h6 class="mb-3">
                                <i class="bx bx-show me-2"></i>Preview
                            </h6>
                            <div class="preview-badge" id="previewBadge">
                                <span id="previewText">Category Name</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Color Selection -->
                <div class="card hover-card border-0 shadow-sm mb-4 fade-in-up" style="animation-delay: 0.2s">
                    <div class="card-body p-4">
                        <h5 class="mb-3">
                            <i class="bx bx-palette me-2"></i>Category Color
                        </h5>
                        
                        <div class="mb-3">
                            <div class="color-picker-wrapper">
                                <input type="color" class="color-input @error('color') is-invalid @enderror" 
                                       id="color" name="color" value="{{ old('color', '#667eea') }}">
                                <div class="color-preview" id="colorPreview">
                                    #667eea
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block">Choose a color that represents this category</small>
                            @error('color')
                                <div class="invalid-feedback mt-2 d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Quick Color Presets -->
                        <div class="mt-3">
                            <small class="text-muted d-block mb-2">Quick presets:</small>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="color-preset" style="background: #667eea; width: 30px; height: 30px; border-radius: 8px; border: 2px solid transparent; cursor: pointer;" data-color="#667eea"></button>
                                <button type="button" class="color-preset" style="background: #f59e0b; width: 30px; height: 30px; border-radius: 8px; border: 2px solid transparent; cursor: pointer;" data-color="#f59e0b"></button>
                                <button type="button" class="color-preset" style="background: #10b981; width: 30px; height: 30px; border-radius: 8px; border: 2px solid transparent; cursor: pointer;" data-color="#10b981"></button>
                                <button type="button" class="color-preset" style="background: #ef4444; width: 30px; height: 30px; border-radius: 8px; border: 2px solid transparent; cursor: pointer;" data-color="#ef4444"></button>
                                <button type="button" class="color-preset" style="background: #8b5cf6; width: 30px; height: 30px; border-radius: 8px; border: 2px solid transparent; cursor: pointer;" data-color="#8b5cf6"></button>
                                <button type="button" class="color-preset" style="background: #ec4899; width: 30px; height: 30px; border-radius: 8px; border: 2px solid transparent; cursor: pointer;" data-color="#ec4899"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card hover-card border-0 shadow-sm fade-in-up" style="animation-delay: 0.4s">
                    <div class="card-body p-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-gradient-primary">
                                <i class="bx bx-save me-2"></i> Create Category
                            </button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-default border border-dark">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript for Interactive Elements -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Name character counter
    const nameInput = document.getElementById('name');
    const nameCounter = document.getElementById('nameCounter');
    const previewText = document.getElementById('previewText');
    
    nameInput.addEventListener('input', function() {
        const length = this.value.length;
        nameCounter.textContent = `${length} / 50 characters`;
        
        if (length > 40) {
            nameCounter.classList.add('danger');
            nameCounter.classList.remove('warning');
        } else if (length > 30) {
            nameCounter.classList.add('warning');
            nameCounter.classList.remove('danger');
        } else {
            nameCounter.classList.remove('warning', 'danger');
        }
        
        // Update preview
        previewText.textContent = this.value || 'Category Name';
    });
    
    // Description character counter
    const descInput = document.getElementById('description');
    const descCounter = document.getElementById('descCounter');
    
    descInput.addEventListener('input', function() {
        const length = this.value.length;
        descCounter.textContent = `${length} / 200 characters`;
        
        if (length > 180) {
            descCounter.classList.add('danger');
            descCounter.classList.remove('warning');
        } else if (length > 150) {
            descCounter.classList.add('warning');
            descCounter.classList.remove('danger');
        } else {
            descCounter.classList.remove('warning', 'danger');
        }
    });
    
    // Color picker
    const colorInput = document.getElementById('color');
    const colorPreview = document.getElementById('colorPreview');
    const previewBadge = document.getElementById('previewBadge');
    
    function updateColor() {
        const color = colorInput.value;
        colorPreview.textContent = color.toUpperCase();
        previewBadge.style.background = color;
        previewBadge.style.color = '#ffffff';
    }
    
    function getContrastColor(hexColor) {
        const r = parseInt(hexColor.substr(1, 2), 16);
        const g = parseInt(hexColor.substr(3, 2), 16);
        const b = parseInt(hexColor.substr(5, 2), 16);
        const brightness = ((r * 299) + (g * 587) + (b * 114)) / 1000;
        return brightness > 128 ? '#000000' : '#ffffff';
    }
    
    colorInput.addEventListener('input', updateColor);
    
    // Color preset buttons
    const colorPresets = document.querySelectorAll('.color-preset');
    colorPresets.forEach(preset => {
        preset.addEventListener('click', function() {
            const color = this.dataset.color;
            colorInput.value = color;
            updateColor();
            
            // Visual feedback
            colorPresets.forEach(p => p.style.borderColor = 'transparent');
            this.style.borderColor = '#667eea';
        });
    });
    
    // Initialize with default color
    updateColor();
});
</script>
@endsection
