<style>
/* ===== Modern Reset Password Page Styles ===== */
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

/* ===== Reset Password Container ===== */
.reset-container {
    position: relative;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.reset-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 50px 40px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.2);
    width: 100%;
    max-width: 500px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.reset-card::before {
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

.reset-card:hover::before {
    left: 0;
}

/* ===== Reset Password Header ===== */
.reset-header {
    text-align: center;
    margin-bottom: 40px;
}

.reset-logo {
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

.reset-logo::after {
    content: '🔐';
    font-size: 2rem;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.reset-title {
    font-size: 2rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.reset-subtitle {
    color: #6b7280;
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.6;
}

.token-info {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
    border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
    font-size: 0.85rem;
    color: #10b981;
    text-align: center;
}

/* ===== Form Styles ===== */
.reset-form {
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

/* ===== Password Strength Indicator ===== */
.password-strength {
    margin-top: 8px;
    height: 4px;
    background: #e5e7eb;
    border-radius: 2px;
    overflow: hidden;
    display: none;
}

.password-strength-bar {
    height: 100%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-weak { background: #ef4444; width: 33%; }
.strength-medium { background: #f59e0b; width: 66%; }
.strength-strong { background: #10b981; width: 100%; }

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

.login-link {
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

.login-link:hover {
    color: #4de5e7;
    transform: translateY(-2px);
}

/* ===== Error Messages ===== */
.error-message {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: #ef4444;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 0.9rem;
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
    .reset-card {
        padding: 40px 30px;
        margin: 10px;
    }
    
    .reset-title {
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

<!-- Reset Password Container -->
<div class="reset-container">
    <div class="reset-card fade-in-up">
        <!-- Reset Password Header -->
        <div class="reset-header">
            <div class="reset-logo">
                <!-- Logo content here -->
            </div>
            <h2 class="reset-title">Reset Password</h2>
            <p class="reset-subtitle">
                Enter your email address and create a new password to secure your account.
            </p>
        </div>

        <!-- Token Info -->
        <div class="token-info">
            <i class="bx bx-shield-check me-2"></i>
            Password reset token is valid and ready to use
        </div>

        <!-- Reset Password Form -->
        <form method="POST" action="{{ route('password.store') }}" class="reset-form">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="bx bx-envelope me-2"></i>Email Address
                </label>
                <input type="email" 
                       id="email" 
                       class="form-input" 
                       name="email" 
                       value="{{ old('email', $request->email) }}" 
                       placeholder="Enter your email address" 
                       required 
                       autofocus 
                       autocomplete="username">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="bx bx-lock me-2"></i>New Password
                </label>
                <input type="password" 
                       id="password" 
                       class="form-input" 
                       name="password" 
                       placeholder="Create a strong password" 
                       required 
                       autocomplete="new-password">
                <div class="password-strength" id="passwordStrength">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">
                    <i class="bx bx-lock-alt me-2"></i>Confirm New Password
                </label>
                <input type="password" 
                       id="password_confirmation" 
                       class="form-input" 
                       name="password_confirmation" 
                       placeholder="Confirm your new password" 
                       required 
                       autocomplete="new-password">
                @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="reset-button">
                    <i class="bx bx-refresh me-2"></i>Reset Password
                </button>
                
                <a href="{{ route('login') }}" class="login-link">
                    <i class="bx bx-log-in me-1"></i>Back to Login
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Password strength checker
document.getElementById('password').addEventListener('input', function(e) {
    const password = e.target.value;
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthContainer = document.getElementById('passwordStrength');
    
    if (password.length > 0) {
        strengthContainer.style.display = 'block';
        
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        
        strengthBar.className = 'password-strength-bar';
        
        if (strength <= 1) {
            strengthBar.classList.add('strength-weak');
        } else if (strength === 2) {
            strengthBar.classList.add('strength-medium');
        } else {
            strengthBar.classList.add('strength-strong');
        }
    } else {
        strengthContainer.style.display = 'none';
    }
});
</script>
