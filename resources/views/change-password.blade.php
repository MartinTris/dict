@extends('layouts.app')

@section('title', 'Change Password')

@section('styles')
<style>
:root {
    --primary-color: #003566;
    --primary-dark: #001d3d;
    --primary-light: #0466c8;
    --accent-color: #0353a4;
    --success-color: #38b000;
    --background-color: #f8f9fa;
    --card-shadow: 0 8px 24px rgba(0, 53, 102, 0.15);
    --text-light: #6c757d;
}

.password-page {
    background-color: var(--background-color);
    min-height: 100vh;
    padding: 60px 0;
}

.password-card {
    border: none;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
    padding: 40px;
}

.password-header {
    margin-bottom: 30px;
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 20px;
}

.password-header h4 {
    font-weight: 600;
    color: var(--primary-color);
}

.form-label {
    font-weight: 500;
    margin-bottom: 8px;
    color: var(--primary-color);
}

.form-control {
    border-radius: 8px;
    padding: 12px 16px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(0, 53, 102, 0.15);
}

.password-container {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-light);
    cursor: pointer;
    display: flex;
    align-items: center;
    font-size: 14px;
}

.password-toggle i {
    margin-right: 5px;
}

.password-footer {
    margin-top: 30px;
    text-align: center;
}

.submit-btn {
    background-color: var(--primary-color);
    border: none;
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.submit-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
}

.btn-outline-secondary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-secondary:hover {
    background-color: var(--primary-color);
    color: white;
}

.alert-success {
    background-color: rgba(56, 176, 0, 0.15);
    border-color: var(--success-color);
    color: #2a8600;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 24px;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 8px;
    font-size: 14px;
    color: #dc3545;
}

.form-text {
    margin-top: 8px;
    font-size: 14px;
    color: var(--text-light);
}

.is-invalid {
    border-color: #dc3545;
}

.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
}
</style>
@endsection

@section('contents')
<div class="password-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card password-card">
                    <div class="password-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Security Settings</h4>
                        <a href="{{ route('profile') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Profile
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.change-password') }}" id="password-form">
                        @csrf
                        <div class="mb-4">
                            <label for="current_password" class="form-label">Current Password</label>
                            <div class="password-container">
                                <input type="password" id="current_password" name="current_password" 
                                    class="form-control @error('current_password') is-invalid @enderror" 
                                    placeholder="Enter your current password">
                                <button type="button" class="password-toggle" data-target="current_password">
                                    <i class="far fa-eye"></i> Show
                                </button>
                            </div>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="new_password" class="form-label">New Password</label>
                            <div class="password-container">
                                <input type="password" id="new_password" name="new_password" 
                                    class="form-control @error('new_password') is-invalid @enderror" 
                                    placeholder="Enter new password">
                                <button type="button" class="password-toggle" data-target="new_password">
                                    <i class="far fa-eye"></i> Show
                                </button>
                            </div>
                            <small class="form-text">Password must be at least 8 characters long.</small>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <div class="password-container">
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                    class="form-control" 
                                    placeholder="Confirm new password">
                                <button type="button" class="password-toggle" data-target="new_password_confirmation">
                                    <i class="far fa-eye"></i> Show
                                </button>
                            </div>
                        </div>
                        
                        <div class="password-footer">
                            <button class="btn btn-primary submit-btn" type="submit">
                                <i class="fas fa-lock me-2"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.querySelector('input[name="new_password"]');
    const confirmField = document.querySelector('input[name="new_password_confirmation"]');
    const form = document.getElementById('password-form');

    // Password toggle functionality
    const toggleButtons = document.querySelectorAll('.password-toggle');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetName = this.getAttribute('data-target');
            const input = document.getElementById(targetName);
            
            if (input.type === 'password') {
                input.type = 'text';
                this.innerHTML = '<i class="far fa-eye-slash"></i> Hide';
            } else {
                input.type = 'password';
                this.innerHTML = '<i class="far fa-eye"></i> Show';
            }
        });
    });

    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Check password length
        if (passwordField.value.length < 8) {
            const errorContainer = document.createElement('span');
            errorContainer.className = 'invalid-feedback';
            errorContainer.innerHTML = '<strong>Password must be at least 8 characters long.</strong>';
            
            passwordField.classList.add('is-invalid');
            
            // Remove any existing error message
            const existingError = passwordField.parentNode.parentNode.querySelector('.invalid-feedback');
            if (existingError && existingError.textContent.includes('8 characters')) {
                existingError.remove();
            }
            
            // Add the new error message
            if (!passwordField.parentNode.parentNode.querySelector('.invalid-feedback')) {
                passwordField.parentNode.after(errorContainer);
            }
            
            isValid = false;
        } else {
            passwordField.classList.remove('is-invalid');
            const existingError = passwordField.parentNode.parentNode.querySelector('.invalid-feedback');
            if (existingError && existingError.textContent.includes('8 characters')) {
                existingError.remove();
            }
        }
        
        // Check if passwords match
        if (passwordField.value !== confirmField.value) {
            const errorContainer = document.createElement('span');
            errorContainer.className = 'invalid-feedback';
            errorContainer.innerHTML = '<strong>Passwords do not match.</strong>';
            
            confirmField.classList.add('is-invalid');
            
            // Remove any existing error message
            const existingError = confirmField.parentNode.parentNode.querySelector('.invalid-feedback');
            if (existingError && existingError.textContent.includes('do not match')) {
                existingError.remove();
            }
            
            // Add the new error message
            if (!confirmField.parentNode.parentNode.querySelector('.invalid-feedback')) {
                confirmField.parentNode.after(errorContainer);
            }
            
            isValid = false;
        } else {
            confirmField.classList.remove('is-invalid');
            const existingError = confirmField.parentNode.parentNode.querySelector('.invalid-feedback');
            if (existingError && existingError.textContent.includes('do not match')) {
                existingError.remove();
            }
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>
@endsection