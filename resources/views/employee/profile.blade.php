@extends('layouts.app')

@section('title', 'Profile')

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

        .profile-page {
            background-color: var(--background-color);
            min-height: 100vh;
            padding: 60px 0;
        }

        .profile-card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .profile-header {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .profile-header h4 {
            font-weight: 600;
            margin-top: 15px;
        }

        .profile-header p {
            opacity: 0.9;
            margin-bottom: 0;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 15px rgba(0, 29, 61, 0.3);
            margin: 0 auto;
            transition: transform 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
        }

        .profile-body {
            padding: 30px;
        }

        .section-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
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

        .form-control:disabled {
            background-color: #f8f9fa;
        }

        .security-card {
            border: none;
            border-radius: 12px;
            background-color: #f2f7ff;
            margin-top: 30px;
            padding: 20px;
            border-left: 4px solid var(--primary-color);
        }

        .change-password-btn {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            padding: 10px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 53, 102, 0.1);
        }

        .change-password-btn:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 53, 102, 0.2);
        }

        .update-btn {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 53, 102, 0.1);
        }

        .update-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 53, 102, 0.2);
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

        .navy-gradient {
            background: linear-gradient(135deg, #003566 0%, #001d3d 100%);
        }
    </style>
@endsection

@section('contents')
    <div class="profile-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div class="card profile-card">
                        <div class="profile-header navy-gradient">

                            <h4 class="mt-3">{{ Auth::guard('employee')->user()->name }}</h4>
                            <p>{{ Auth::guard('employee')->user()->email }}</p>
                        </div>

                        <div class="profile-body">
                            <h5 class="section-title">
                                <i class="fas fa-user-circle me-2"></i> Profile Information
                            </h5>

                            <form method="POST" action="{{-- route('profile.update') --}}">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ auth('employee')->user()->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email"
                                            value="{{ auth('employee')->user()->email }}" disabled>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary update-btn">
                                        <i class="fas fa-save me-2"></i> Update Profile
                                    </button>
                                </div>
                            </form>

                            <div class="security-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1" style="color: var(--primary-color);">
                                            <i class="fas fa-shield-alt me-2"></i> Password & Security
                                        </h6>
                                        <p class="text-muted mb-0 small">Manage your password and account security settings
                                        </p>
                                    </div>
                                    <a href="{{-- route('profile.change-password-form') --}}"
                                        class="btn change-password-btn">
                                        <i class="fas fa-lock me-2"></i> Change Password
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection