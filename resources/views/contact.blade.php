@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<style>
.contact-hero {
    background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.contact-hero::before {
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

.contact-form-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.contact-form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-gradient {
    background: linear-gradient(135deg, #4DE5E7 0%, #764ba2 100%);
    border: none;
    border-radius: 10px;
    padding: 12px 30px;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    color: white;
}

.contact-info-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
}

.contact-info-item {
    padding: 20px;
    border-bottom: 1px solid #f8f9fa;
    transition: background-color 0.3s ease;
}

.contact-info-item:hover {
    background-color: #f8f9fa;
}

.contact-info-item:last-child {
    border-bottom: none;
}

.social-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-icon:hover {
    transform: translateY(-3px);
    color: white !important;
}

.social-facebook { background: #1877f2; }
.social-twitter { background: #1da1f2; }
.social-instagram { background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); }
.social-linkedin { background: #0077b5; }

.form-floating label {
    color: #6c757d;
}

.form-floating .form-control:focus ~ label {
    color: #667eea;
}
</style>

<!-- Hero Section -->
<div class="contact-hero">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Get in Touch</h1>
        <p class="lead mb-0">We'd love to hear from you! Send us a message and we'll respond as soon as possible.</p>
    </div>
</div>

<!-- Contact Form Section -->
<div class="container my-5">
    <div class="row g-4">
        <!-- Contact Form -->
        <div class="col-lg-8">
            <div class="card contact-form-card">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 mb-3" style="width: 60px; height: 60px;">
                            <i class="bx bx-envelope fs-1 text-primary"></i>
                        </div>
                        <h3 class="card-title">Send us a Message</h3>
                        <p class="text-muted">Fill out the form below and we'll get back to you</p>
                    </div>

                    <form method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name') }}" placeholder="Your Name" required>
                                    <label for="name">Your Name *</label>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" placeholder="Email Address" required>
                                    <label for="email">Email Address *</label>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Choose a subject...</option>
                                        <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                        <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Technical Support</option>
                                        <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                                        <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                                        <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <label for="subject">Subject *</label>
                                    @error('subject')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="message" name="message" rows="5" 
                                              placeholder="Your message..." required>{{ old('message') }}</textarea>
                                    <label for="message">Your Message *</label>
                                    @error('message')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                                                        
                            <div class="col-12">
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-gradient flex-fill">
                                        <i class="bx bx-send me-2"></i> Send Message
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary flex-fill">
                                        <i class="bx bx-refresh me-2"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Contact Information -->
        <div class="col-lg-4">
            <div class="card contact-info-card">
                <div class="card-body p-0">
                    <div class="text-center p-4 bg-primary bg-opacity-10">
                        <i class="bx bx-info-circle fs-1 text-primary"></i>
                        <h4 class="mt-3">Contact Information</h4>
                        <p class="text-muted mb-0">Reach out to us through any of these channels</p>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10" style="width: 40px; height: 40px;">
                                    <i class="bx bx-map text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Address</h6>
                                <p class="text-muted mb-0">123 Blog Street<br>Web City, WC 12345<br>United States</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10" style="width: 40px; height: 40px;">
                                    <i class="bx bx-phone text-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Phone</h6>
                                <p class="text-muted mb-0">+1 (555) 123-4567</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-10" style="width: 40px; height: 40px;">
                                    <i class="bx bx-envelope text-info"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Email</h6>
                                <p class="text-muted mb-0">contact@salaheddine.com</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10" style="width: 40px; height: 40px;">
                                    <i class="bx bx-time-five text-warning"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Business Hours</h6>
                                <p class="text-muted mb-0">Mon-Fri: 9:00 AM - 6:00 PM<br>Sat: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <div class="text-center">
                            <h6 class="mb-3">Follow Us</h6>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="#" class="social-icon social-facebook text-white">
                                    <i class="bx bxl-facebook"></i>
                                </a>
                                <a href="#" class="social-icon social-twitter text-white">
                                    <i class="bx bxl-twitter"></i>
                                </a>
                                <a href="#" class="social-icon social-instagram text-white">
                                    <i class="bx bxl-instagram"></i>
                                </a>
                                <a href="#" class="social-icon social-linkedin text-white">
                                    <i class="bx bxl-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="bx bx-check-circle me-2"></i> Message Sent!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0">Thank you for contacting us!</p>
                <p class="mb-0">We'll get back to you within 24 hours.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                    <i class="bx bx-check me-2"></i> Got it!
                </button>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
    @endif
@endsection
