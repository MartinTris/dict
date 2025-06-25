<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>DICT Cavite Monitoring - Admin Register</title>

  <!-- Fonts and styles -->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600,700,900" rel="stylesheet">
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #003566, #0d6efd);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .header {
      background-color: #002349;
      color: white;
      padding: 15px 30px;
      display: flex;
      align-items: center;
      gap: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .header img {
      height: 50px;
    }

    .registration-container {
      flex-grow: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px 15px;
    }

    .bg-image {
      background-image: url('/images/dict.png');
      background-size: 60%;
      background-repeat: no-repeat;
      background-position: center;
      min-height: 500px;
    }

    .card {
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.90); /* White with slight transparency */
      backdrop-filter: blur(15px); /* Glassmorphism effect */
      -webkit-backdrop-filter: blur(15px); /* Safari compatibility */
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      border: 1px solid rgba(255, 255, 255, 0.18);
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    .card:hover {
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
      transform: translateY(-2px);
    }
    
    .form-control-user:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-user {
      border-radius: 12px;
      padding: 10px 20px;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }
    
    .text-primary {
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
    }

    .card-body .text-center h1 {
      font-weight: 700;
    }
    
    .password-container {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      background: none;
      border: none;
      color: #003566;
      opacity: 0.7;
      transition: opacity 0.3s;
      display: flex;
      align-items: center;
      font-size: 14px;
      padding: 4px 8px;
      border-radius: 4px;
    }

    .password-toggle:hover {
      opacity: 1;
      background-color: rgba(0, 53, 102, 0.05);
    }

    .password-toggle i {
      margin-right: 4px;
    }
    
    /* Modern password meter styles */
    .password-strength-meter {
      height: 4px;
      background-color: #e9ecef;
      margin: 12px 0 5px;
      border-radius: 2px;
      position: relative;
      overflow: hidden;
    }
    
    .password-strength-meter-fill {
      height: 100%;
      border-radius: 2px;
      transition: width 0.3s ease, background-color 0.3s ease;
      width: 0%;
    }
    
    .strength-very-weak { background-color: #e63946; width: 20%; }
    .strength-weak { background-color: #ff9e00; width: 40%; }
    .strength-medium { background-color: #ffb700; width: 60%; }
    .strength-strong { background-color: #7cb518; width: 80%; }
    .strength-very-strong { background-color: #38b000; width: 100%; }
    
    .password-strength-text {
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
    }
    
    /* Compressed password requirements */
    .password-requirements {
      background-color: rgba(0, 53, 102, 0.05);
      padding: 10px 15px;
      border-radius: 10px;
      margin: 10px 0;
      font-size: 12px;
      border-left: 3px solid #003566;
    }
    
    .password-requirements .title {
      font-weight: 600;
      color: #003566;
      margin-bottom: 8px;
      display: flex;
      align-items: center;
    }
    
    .password-requirements .title i {
      margin-right: 5px;
    }
    
    .requirements-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 5px;
    }
    
    .requirement-item {
      display: flex;
      align-items: center;
      transition: color 0.3s ease;
      margin-bottom: 0;
      white-space: nowrap;
    }
    
    .requirement-item i {
      margin-right: 4px;
      font-size: 10px;
      min-width: 12px;
    }
    
    .requirement-met {
      color: #38b000;
    }
    
    .requirement-not-met {
      color: #6c757d;
    }
    
    .password-match {
      padding: 6px 10px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      margin-top: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .match-success {
      background-color: rgba(56, 176, 0, 0.1);
      color: #38b000;
    }
    
    .match-error {
      background-color: rgba(230, 57, 70, 0.1);
      color: #e63946;
    }
    
    .password-match i {
      margin-right: 5px;
    }

    @media (max-width: 768px) {
      .bg-image {
        display: none !important;
      }

      .header h2 {
        font-size: 18px;
      }
      
      .requirements-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
        <img src="/images/dict.png" alt="DICT Logo">
        <h2 class="m-0">DICT Cavite Monitoring System - Admin Portal</h2>
    </div>
    <a class="m-0 text-white" href="{{ route('employee.login') }}">Admin Login</a>
</div>

  <!-- Main Registration Container -->
  <div class="registration-container">
    <div class="card o-hidden shadow-lg w-100" style="max-width: 1000px;">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 text-primary mb-4 font-weight-bold">Register for Access</h1>
              </div>
              <form action="{{ route('register.save') }}" method="POST" class="user" id="registrationForm">
                @csrf
                <div class="form-group">
                  <input name="name" type="text" class="form-control form-control-user @error('name')is-invalid @enderror" placeholder="Full Name" required>
                  @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <input name="email" type="email" class="form-control form-control-user @error('email')is-invalid @enderror" placeholder="Email Address" required>
                  @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="password-container">
                      <input name="password" type="password" id="password-field" class="form-control form-control-user @error('password')is-invalid @enderror" placeholder="Password" required>
                      <button type="button" class="password-toggle" onclick="togglePassword('password-field')">
                        <i class="fas fa-eye" id="password-field-icon"></i>
                      </button>
                    </div>
                    <div class="password-strength-meter">
                      <div class="password-strength-meter-fill" id="strength-meter"></div>
                    </div>
                    <div class="password-strength-text">
                      <span>Password Strength:</span>
                      <span id="strength-text">None</span>
                    </div>
                    @error('password')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <div class="password-container">
                      <input name="password_confirmation" type="password" id="confirm-password-field" class="form-control form-control-user @error('password_confirmation')is-invalid @enderror" placeholder="Confirm Password" required>
                      <button type="button" class="password-toggle" onclick="togglePassword('confirm-password-field')">
                        <i class="fas fa-eye" id="confirm-password-field-icon"></i>
                      </button>
                      @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                    <div id="password-match-container" class="password-match d-none">
                      <i class="fas fa-check-circle"></i> Passwords match
                    </div>
                  </div>
                </div>
                
                <!-- Horizontally compressed password requirements -->
                <div class="password-requirements">
                  <div class="title">
                    <i class="fas fa-shield-alt"></i> Password Requirements
                  </div>
                  <div class="requirements-grid">
                    <div class="requirement-item requirement-not-met" id="length">
                      <i class="far fa-circle"></i> Min 8 characters
                    </div>
                    <div class="requirement-item requirement-not-met" id="uppercase">
                      <i class="far fa-circle"></i> One uppercase
                    </div>
                    <div class="requirement-item requirement-not-met" id="lowercase">
                      <i class="far fa-circle"></i> One lowercase
                    </div>
                    <div class="requirement-item requirement-not-met" id="number">
                      <i class="far fa-circle"></i> One number
                    </div>
                    <div class="requirement-item requirement-not-met" id="special" style="grid-column: span 2;">
                      <i class="far fa-circle"></i> One special character (!@#$%^&*(),.?":{}|<>)
                    </div>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-user btn-block mt-4">Register Account</button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
  
  <script>
    function togglePassword(fieldId) {
      const passwordField = document.getElementById(fieldId);
      const icon = document.getElementById(fieldId + '-icon');
      
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
    
    // Live password validation and strength meter
    document.getElementById('password-field').addEventListener('input', function() {
      const password = this.value;
      
      // Check for criteria
      const hasLength = password.length >= 8;
      const hasUppercase = /[A-Z]/.test(password);
      const hasLowercase = /[a-z]/.test(password);
      const hasNumber = /\d/.test(password);
      const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
      
      // Update requirement indicators
      updateRequirement('length', hasLength);
      updateRequirement('uppercase', hasUppercase);
      updateRequirement('lowercase', hasLowercase);
      updateRequirement('number', hasNumber);
      updateRequirement('special', hasSpecial);
      
      // Calculate password strength
      let strength = 0;
      if (hasLength) strength += 1;
      if (hasUppercase) strength += 1;
      if (hasLowercase) strength += 1;
      if (hasNumber) strength += 1;
      if (hasSpecial) strength += 1;
      
      // Update strength meter
      updateStrengthMeter(strength);
      
      // Check if passwords match
      checkPasswordsMatch();
    });
    
    function updateRequirement(id, isMet) {
      const element = document.getElementById(id);
      const icon = element.querySelector('i');
      
      if (isMet) {
        element.classList.remove('requirement-not-met');
        element.classList.add('requirement-met');
        icon.classList.remove('far', 'fa-circle');
        icon.classList.add('fas', 'fa-check-circle');
      } else {
        element.classList.remove('requirement-met');
        element.classList.add('requirement-not-met');
        icon.classList.remove('fas', 'fa-check-circle');
        icon.classList.add('far', 'fa-circle');
      }
    }
    
    function updateStrengthMeter(strength) {
      const meter = document.getElementById('strength-meter');
      const text = document.getElementById('strength-text');
      
      // Remove all strength classes
      meter.className = 'password-strength-meter-fill';
      
      // Add appropriate class and update text based on strength
      if (strength === 0) {
        text.textContent = 'None';
      } else if (strength === 1) {
        meter.classList.add('strength-very-weak');
        text.textContent = 'Very Weak';
      } else if (strength === 2) {
        meter.classList.add('strength-weak');
        text.textContent = 'Weak';
      } else if (strength === 3) {
        meter.classList.add('strength-medium');
        text.textContent = 'Medium';
      } else if (strength === 4) {
        meter.classList.add('strength-strong');
        text.textContent = 'Strong';
      } else {
        meter.classList.add('strength-very-strong');
        text.textContent = 'Very Strong';
      }
    }
    
    // Check if passwords match
    document.getElementById('confirm-password-field').addEventListener('input', checkPasswordsMatch);
    
    function checkPasswordsMatch() {
      const password = document.getElementById('password-field').value;
      const confirmPassword = document.getElementById('confirm-password-field').value;
      const matchContainer = document.getElementById('password-match-container');
      
      if (confirmPassword === '') {
        matchContainer.classList.add('d-none');
        return;
      }
      
      matchContainer.classList.remove('d-none');
      
      if (password === confirmPassword) {
        matchContainer.classList.remove('match-error');
        matchContainer.classList.add('match-success');
        matchContainer.innerHTML = '<i class="fas fa-check-circle"></i> Passwords match';
      } else {
        matchContainer.classList.remove('match-success');
        matchContainer.classList.add('match-error');
        matchContainer.innerHTML = '<i class="fas fa-times-circle"></i> Passwords do not match';
      }
    }
    
    // Form submission validation
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
      const password = document.getElementById('password-field').value;
      const confirmPassword = document.getElementById('confirm-password-field').value;
      
      // Password regex: at least 8 characters, one uppercase, one lowercase, one number, one special character
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;
      
      if (!passwordRegex.test(password)) {
        event.preventDefault();
        
        // Create detailed alert
        const requirements = [];
        if (password.length < 8) requirements.push("at least 8 characters");
        if (!/[A-Z]/.test(password)) requirements.push("at least one uppercase letter");
        if (!/[a-z]/.test(password)) requirements.push("at least one lowercase letter");
        if (!/\d/.test(password)) requirements.push("at least one number");
        if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) requirements.push("at least one special character");
        
        alert('Password must contain ' + requirements.join(', ') + '.');
        return false;
      }
      
      if (password !== confirmPassword) {
        event.preventDefault();
        alert('Passwords do not match.');
        return false;
      }
      
      return true;
    });
  </script>
</body>
</html>