<style>
/* ===== Modern Forgot Password Page Styles ===== */
body {
    background: linear-gradient(135deg, #667eea 0%, #4de5ff 100%);
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    position: relative;
    overflow: hidden;
}

body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="30" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
    opacity: 0.3;
}

/* ===== Floating Shapes ===== */
.floating-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 80px;
    height: 80px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 60px;
    height: 60px;
    top: 70%;
    right: 15%;
    animation-delay: 2s;
}

.shape-3 {
    width: 40px;
    height: 40px;
    bottom: 20%;
    left: 20%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* ===== Forgot Password Container ===== */
.forgot-container {
    position: relative;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.forgot-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 50px 40px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.2);
    width: 100%;
    max-width: 450px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.forgot-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(77, 229, 231, 0.1) 100%);
    transition: left 0.5s ease;
    z-index: -1;
}

.forgot-card:hover::before {
    left: 0;
}

/* ===== Forgot Password Header ===== */
.forgot-header {
    text-align: center;
    margin-bottom: 40px;
}

.forgot-logo {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    position: relative;
    overflow: hidden;
}

.forgot-logo::after {
    content: '🔑';
    font-size: 2rem;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.forgot-title {
    font-size: 2rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.forgot-subtitle {
    color: #6b7280;
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.6;
}

/* ===== Form Styles ===== */
.forgot-form {
    position: relative;
    z-index: 2;
}

.form-group {
    margin-bottom: 25px;
    position: relative;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-input {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e5e7eb;
    border-radius: 15px;
    font-size: 1rem;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    color: #374151;
}

.form-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: rgba(255, 255, 255, 0.95);
    transform: translateY(-2px);
}

.form-input::placeholder {
    color: #9ca3af;
    font-style: italic;
}

/* ===== Buttons ===== */
.form-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 30px;
}

.reset-button {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, #667eea 0%, #4de5e7 100%);
    color: white;
    border: none;
    border-radius: 15px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.reset-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 100%);
    transition: left 0.5s ease;
    z-index: -1;
}

.reset-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
}

.reset-button:hover::before {
    left: 0;
}

.back-link {
    text-align: center;
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    padding: 10px;
    border-radius: 10px;
    display: inline-block;
}

.back-link:hover {
    color: #4de5e7;
    transform: translateY(-2px);
}

/* ===== Success/Error Messages ===== */
.status-message {
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 0.9rem;
    animation: fadeInUp 0.5s ease-out;
}

.status-success {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: #10b981;
}

.error-message {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: #ef4444;
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* ===== Animations ===== */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

/* ===== Responsive Design ===== */
@media (max-width: 768px) {
    .forgot-card {
        padding: 40px 30px;
        margin: 10px;
    }
    
    .forgot-title {
        font-size: 1.5rem;
    }
    
    .floating-shapes {
        display: none;
    }
}
</style>

<!-- Floating Background Shapes -->
<div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
</div>

<!-- Forgot Password Container -->
<div class="forgot-container">
    <div class="forgot-card fade-in-up">
        <!-- Forgot Password Header -->
        <div class="forgot-header">
            <div class="forgot-logo">
                <!-- Logo content here -->
            </div>
            <h2 class="forgot-title">Reset Password</h2>
            <p class="forgot-subtitle">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </p>
        </div>

        <!-- Session Status -->
        @if(session('status'))
            <div class="status-message status-success">
                <i class="bx bx-check-circle me-2"></i>{{ session('status') }}
            </div>
        @endif

        <!-- Forgot Password Form -->
        <form method="POST" action="{{ route('password.email') }}" class="forgot-form">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="bx bx-envelope me-2"></i>Email Address
                </label>
                <input type="email" 
                       id="email" 
                       class="form-input" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="Enter your email address" 
                       required 
                       autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="reset-button">
                    <i class="bx bx-mail-send me-2"></i>Email Password Reset Link
                </button>
                
                <a href="{{ route('login') }}" class="back-link">
                    <i class="bx bx-arrow-back me-1"></i>Back to Login
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Debug Info (remove in production) -->
@if(config('app.debug'))
<div style="position: fixed; bottom: 10px; right: 10px; background: rgba(0,0,0,0.8); color: white; padding: 10px; border-radius: 5px; font-size: 12px; z-index: 1000;">
    Route: {{ route('password.email') }}<br>
    Method: POST<br>
    @if(session('status'))
        Status: {{ session('status') }}<br>
    @endif
    @if($errors->any())
        Errors: {{ $errors->count() }}<br>
    @endif
</div>
@endif
