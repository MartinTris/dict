@extends('layouts.app')

@section('contents')
<!-- Add Bootstrap, jQuery, Chart.js and jsVectorMap scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<div class="container-fluid py-3">
    <!-- Modified Hero Section -->
    <div class="row mb-4 hero-section section-fade-in">
        <div class="col-md-12">
            <div class="card hero-card">
                <div class="card-body p-5" style="background: linear-gradient(135deg, #003566 0%, #001d3d 100%);">
                    <div class="row align-items-center g-0">
                       
                        <div class="col-md-9">
                            <div class="hero-content text-white animate__animated animate__fadeInUp px-4">
                                <h1 class="fw-bold mb-3" style="font-size: 2.5rem; letter-spacing: -0.5px;">E-Government Philippines</h1>
                                <p class="lead mb-4" style="font-size: 1.25rem; font-weight: 300;">Streamlining Government Services for All Filipinos</p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="#download" class="btn btn-light px-4 py-2 fw-bold rounded-1 shadow-sm hero-btn">
                                        Download Now
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                    <a href="#services" class="btn btn-outline-light px-4 py-2 rounded-1 hero-btn-outline">
                                        Explore Services
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- What is eGov Section -->
    <div class="row mb-5 section-fade-in">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <img src="{{ asset('/images/egovlogo1.png') }}" alt="E-Government Philippines Logo" class="img-fluid mb-4" style="max-width: 200px;">
                        </div>
                        <div class="col-md-9">
                            <h2 class="fw-bold section-title" style="color: #003566;">What is E-Government Philippines?</h2>
                            <p class="lead">E-Government Philippines (eGov PH) is the government's digital transformation initiative aimed at delivering public services through electronic means.</p>
                            <p>It provides citizens with convenient access to government services, information, and transactions online, reducing the need for physical visits to government offices and simplifying bureaucratic processes.</p>
                            <p>Through eGov PH, Filipinos can access services like document applications, tax filing, business registrations, and social welfare benefits digitally - saving time, reducing costs, and improving transparency in governance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How E-Gov Works Section with Interactive Workflow -->
    <div class="row mb-5 section-fade-in">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <h2 class="fw-bold section-title mb-4" style="color: #003566;">How E-Government Philippines Works</h2>
                    
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <p class="lead">E-Government Philippines operates on a secure, centralized platform that connects all government agencies and services through a unified digital infrastructure.</p>
                            <p>The system employs a user-centric approach, allowing citizens to access various government services through a single portal or mobile application, eliminating the need to visit multiple agencies.</p>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('/images/egovheader.jpg') }}" alt="E-Gov System" class="img-fluid rounded shadow">
                        </div>
                    </div>
                    
                    <!-- Interactive Workflow Steps -->
                    <div class="workflow-container mt-5">
                        <h4 class="text-center mb-4" style="color: #003566;">E-Government Service Flow</h4>
                        
                        <div class="workflow-steps">
                            <div class="workflow-step active" data-step="1">
                                <div class="workflow-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h5>User Registration</h5>
                            </div>
                            <div class="workflow-connector"></div>
                            
                            <div class="workflow-step" data-step="2">
                                <div class="workflow-icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <h5>Identity Verification</h5>
                            </div>
                            <div class="workflow-connector"></div>
                            
                            <div class="workflow-step" data-step="3">
                                <div class="workflow-icon">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                <h5>Service Selection</h5>
                            </div>
                            <div class="workflow-connector"></div>
                            
                            <div class="workflow-step" data-step="4">
                                <div class="workflow-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h5>Form Submission</h5>
                            </div>
                            <div class="workflow-connector"></div>
                            
                            <div class="workflow-step" data-step="5">
                                <div class="workflow-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h5>Payment</h5>
                            </div>
                            <div class="workflow-connector"></div>
                            
                            <div class="workflow-step" data-step="6">
                                <div class="workflow-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h5>Service Delivery</h5>
                            </div>
                        </div>
                        
                        <div class="workflow-content mt-4">
                            <div class="workflow-detail active" data-step="1">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Create Your E-Gov Account</h5>
                                        <p class="card-text">The first step is creating your secure E-Government account by providing basic personal information and setting up authentication credentials.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="workflow-detail" data-step="2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Verify Your Identity</h5>
                                        <p class="card-text">Your identity is verified through multiple secure channels, including mobile verification, biometrics, or presenting valid ID at a verification center.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="workflow-detail" data-step="3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Choose the Service You Need</h5>
                                        <p class="card-text">Browse through categorized government services or use the search function to find specific services you need to access.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="workflow-detail" data-step="4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Complete and Submit Forms</h5>
                                        <p class="card-text">Fill out digital forms with your information. The system pre-fills known data and validates entries in real-time to ensure accuracy.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="workflow-detail" data-step="5">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Process Secure Payment</h5>
                                        <p class="card-text">Pay for services using various payment methods including credit/debit cards, e-wallets, online banking, or over-the-counter options.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="workflow-detail" data-step="6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Receive Your Service</h5>
                                        <p class="card-text">Depending on the service, receive digital documents immediately, track physical document delivery, or get notified when your service is ready.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Expanded Carousel Section -->
    <div class="row mb-5 section-fade-in">
        <div class="col-md-12">
            <div class="carousel-container">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('/images/egov1.jpg') }}" alt="E-Government Services">
                            <div class="carousel-caption d-none d-md-block">
                                <h2 class="fw-bold">Digital Government Services</h2>
                                <p class="lead mb-0">Transforming service delivery for a better Philippines</p>
                                <a href="#services" class="btn btn-primary mt-3">Learn More</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('/images/egov2.png') }}" alt="Online Services">
                            <div class="carousel-caption d-none d-md-block">
                                <h2 class="fw-bold">Accessible Services</h2>
                                <p class="lead mb-0">Government services at your fingertips</p>
                                <a href="#download" class="btn btn-primary mt-3">Get Started</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('/images/egov3.jpg') }}" alt="Mobile Access">
                            <div class="carousel-caption d-none d-md-block">
                                <h2 class="fw-bold">Empowering Citizens</h2>
                                <p class="lead mb-0">Connecting Filipinos to essential government services</p>
                                <a href="#download" class="btn btn-primary mt-3">Download Now</a>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <!-- Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleControls" data-slide-to="1"></li>
                        <li data-target="#carouselExampleControls" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Importance of E-Gov Section -->
    <div class="row mb-5 parallax-bg section-fade-in" style="background-image: url('{{ asset('/images/subtle-pattern.png') }}');">
        <div class="col-md-12 mb-4">
            <h2 class="text-center fw-bold section-title">The Importance of E-Government Philippines</h2>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 feature-card">
                <div class="card-body text-center p-4">
                    <div class="card-icon">
                        <i class="fas fa-laptop fa-2x"></i>
                    </div>
                    <h4 class="card-title" style="color: #003566;">Accessibility</h4>
                    <p class="card-text">E-Government services eliminate geographical barriers, allowing Filipinos from remote areas to access government services without traveling long distances.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 feature-card">
                <div class="card-body text-center p-4">
                    <div class="card-icon">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <h4 class="card-title" style="color: #003566;">Efficiency</h4>
                    <p class="card-text">Digital services reduce processing times and eliminate redundant paperwork, making government transactions faster and more efficient for all citizens.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 feature-card">
                <div class="card-body text-center p-4">
                    <div class="card-icon">
                        <i class="fas fa-lock fa-2x"></i>
                    </div>
                    <h4 class="card-title" style="color: #003566;">Transparency</h4>
                    <p class="card-text">E-Government initiatives promote transparency in government operations, reduce corruption, and build trust between citizens and public institutions.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- E-Gov Usage Statistics with Real Data -->
    <div class="row mb-5 section-fade-in">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <h2 class="fw-bold section-title mb-4" style="color: #003566;">E-Government Philippines Usage Statistics</h2>
                    
                    <div class="row align-items-center mb-4">
                        <div class="col-md-7">
                            <p class="lead">The adoption of E-Government services has grown significantly, with millions of Filipinos now using the eGov PH super app to access government services.</p>
                            
                            <div class="chart-highlights mt-4 mb-4">
                                <div class="row">
                                    <div class="col-md-6 text-center mb-3">
                                        <div class="highlight-card p-3" style="background-color: rgba(0, 53, 102, 0.05); border-radius: 10px;">
                                            <h3 class="counter highlight-number" data-target="8">0</h3>
                                            <p class="highlight-label">Million Registered Users</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 text-center mb-3">
                                        <div class="highlight-card p-3" style="background-color: rgba(0, 53, 102, 0.05); border-radius: 10px;">
                                            <h3 class="counter highlight-number" data-target="72">0</h3>
                                            <p class="highlight-label">Million Digital National ID Users</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <p>The eGov PH super app was first launched in Cebu, making it the first province in the Visayas and Mindanao to launch the platform outside Manila. Since then, adoption has continued to grow nationwide as more citizens discover the convenience of accessing government services digitally.</p>
                        </div>
                        
                        <div class="col-md-5">
                            <!-- Simple User Growth Chart -->
                            <div class="chart-container" style="position: relative; height: 300px; width: 100%;">
                                <canvas id="egovUsageChart"></canvas>
                            </div>
                            
                            <!-- Note about data source -->
                            <div class="text-center mt-2">
                                <small class="text-muted">Source: Official eGov PH statistics</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How E-Gov Helps Filipinos Section - Interactive with Fixed Tabs -->
    <div class="row mb-5 section-fade-in" id="services">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <h2 class="fw-bold section-title mb-4" style="color: #003566;">How E-Government Helps Filipinos</h2>
                    
                    <!-- Interactive Services with Tabs - More Visible -->
                    <ul class="nav nav-tabs" id="servicesTab" role="tablist" style="border-bottom: 2px solid rgb(0, 98, 196);">
                        <li class="nav-item">
                            <a class="nav-link active" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab" aria-controls="documentation" aria-selected="true" style="background-color: #003566; color: white; border: 1px solid #dee2e6; border-bottom: none; margin-right: 5px;">
                                <i class="fas fa-id-card mr-2"></i> Documentation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="taxes-tab" data-toggle="tab" href="#taxes" role="tab" aria-controls="taxes" aria-selected="false" style="background-color: #003566; color: white; border: 1px solid #dee2e6; border-bottom: none; margin-right: 5px;">
                                <i class="fas fa-money-bill-wave mr-2"></i> Taxes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="business-tab" data-toggle="tab" href="#business" role="tab" aria-controls="business" aria-selected="false" style="background-color: #003566; color: white; border: 1px solid #dee2e6; border-bottom: none; margin-right: 5px;">
                                <i class="fas fa-chart-line mr-2"></i> Business
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false" style="background-color: #003566; color: white; border: 1px solid #dee2e6; border-bottom: none;">
                                <i class="fas fa-hands-helping mr-2"></i> Social Services
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content p-3 bg-white" id="servicesTabContent" style="border: 1px solid #dee2e6; border-top: none; border-radius: 0 0 5px 5px;">
                        <!-- Documentation Tab -->
                        <div class="tab-pane fade show active" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h4 style="color: #003566;">Simplified Documentation</h4>
                                    <p style="color: #333333;">Easily apply for government IDs, business permits, and other essential documents online without long queues.</p>
                                    <ul class="service-features">
                                        <li>Online application for National ID</li>
                                        <li>Digital birth, marriage, and death certificates</li>
                                        <li>Passport renewal and scheduling</li>
                                        <li>Driver's license application and renewal</li>
                                    </ul>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Learn More</a>
                                </div>
                                <div class="col-md-5 text-center">
                                    <div class="service-icon-large">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Taxes Tab -->
                        <div class="tab-pane fade" id="taxes" role="tabpanel" aria-labelledby="taxes-tab">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h4 style="color: #003566;">Tax Filing and Payments</h4>
                                    <p style="color: #333333;">Streamlined tax filing systems and secure online payment options for government fees and taxes.</p>
                                    <ul class="service-features">
                                        <li>Electronic filing of income tax returns</li>
                                        <li>Online payment of property taxes</li>
                                        <li>Business tax registration and filing</li>
                                        <li>Tax clearance certificate applications</li>
                                    </ul>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Learn More</a>
                                </div>
                                <div class="col-md-5 text-center">
                                    <div class="service-icon-large">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Business Tab -->
                        <div class="tab-pane fade" id="business" role="tabpanel" aria-labelledby="business-tab">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h4 style="color: #003566;">Economic Opportunities</h4>
                                    <p style="color: #333333;">Simplified business registration processes and access to government procurement opportunities.</p>
                                    <ul class="service-features">
                                        <li>Business permit application and renewal</li>
                                        <li>Access to government bidding opportunities</li>
                                        <li>MSME support and development programs</li>
                                        <li>Export and import licensing</li>
                                    </ul>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Learn More</a>
                                </div>
                                <div class="col-md-5 text-center">
                                    <div class="service-icon-large">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Services Tab -->
                        <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h4 style="color: #003566;">Social Services</h4>
                                    <p style="color: #333333;">Easier access to social welfare programs, health services, and educational resources for all Filipinos.</p>
                                    <ul class="service-features">
                                        <li>PhilHealth registration and benefits</li>
                                        <li>SSS/GSIS online services</li>
                                        <li>Educational scholarships application</li>
                                        <li>Social welfare assistance programs</li>
                                    </ul>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Learn More</a>
                                </div>
                                <div class="col-md-5 text-center">
                                    <div class="service-icon-large">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Download Section with Interactive Steps -->
    <div class="row mb-5 section-fade-in" id="download">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5" style="background-color: #f8f9fa;">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="fw-bold section-title" style="color: #003566;">How to Download E-Government Services</h2>
                            <p class="mb-4">Access E-Government Philippines services through our official mobile application or web portal. Follow these simple steps:</p>
                            
                            <!-- Simplified Interactive Steps -->
                            <div class="steps-wrapper mb-4">
                                <div class="step-tabs mb-3">
                                    <div class="btn-group w-100" role="group">
                                        <button type="button" class="btn btn-outline-primary step-tab active" data-step="1">Step 1</button>
                                        <button type="button" class="btn btn-outline-primary step-tab" data-step="2">Step 2</button>
                                        <button type="button" class="btn btn-outline-primary step-tab" data-step="3">Step 3</button>
                                        <button type="button" class="btn btn-outline-primary step-tab" data-step="4">Step 4</button>
                                    </div>
                                </div>
                                
                                <div class="step-contents">
                                    <div class="step-content active" data-step="1">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title" style="color: #003566;"><i class="fas fa-globe me-2"></i> Visit the Official Website</h5>
                                                <p class="card-text">Go to the official E-Government Philippines website to start the process.</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="step-content" data-step="2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title" style="color: #003566;"><i class="fas fa-id-card me-2"></i> Register with Valid ID</h5>
                                                <p class="card-text">Create an account using your valid government-issued identification.</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="step-content" data-step="3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title" style="color: #003566;"><i class="fas fa-user-check me-2"></i> Verify Your Identity</h5>
                                                <p class="card-text">Complete the verification process via SMS or email confirmation.</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="step-content" data-step="4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title" style="color: #003566;"><i class="fas fa-download me-2"></i> Download and Access</h5>
                                                <p class="card-text">Download the mobile app or access services directly on the web.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="app-download-buttons">
                            <a href="#" class="btn d-flex align-items-center px-4 py-2 hover-effect" style="background-color: #003566; color: white;">
                                    <i class="fab fa-android me-2"></i> Google Play
                                </a>
                                <a href="#" class="btn d-flex align-items-center px-4 py-2 hover-effect" style="background-color: #003566; color: white;">
                                    <i class="fab fa-apple me-2"></i> App Store
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('/images/egov4.jpg') }}" class="img-fluid rounded shadow hover-effect" alt="E-Government on Devices">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mb-5 section-fade-in">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <h2 class="fw-bold text-center section-title" style="color: #003566;">Frequently Asked Questions</h2>
                    
                    <!-- FAQ Item 1 -->
                    <div class="faq-item mb-4">
                        <h3 class="faq-question" style="color: #003566; cursor: pointer; font-weight: 600; padding: 15px; background-color: rgba(0, 53, 102, 0.05); border-radius: 8px;">
                            Is my data secure on the E-Government platform?
                            <i class="fas fa-chevron-down float-end"></i>
                        </h3>
                        <div class="faq-answer p-3">
                            <p>Yes, the E-Government platform employs enterprise-grade security measures to protect your personal information. All data is encrypted and stored securely following international data protection standards.</p>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 2 -->
                    <div class="faq-item mb-4">
                        <h3 class="faq-question" style="color: #003566; cursor: pointer; font-weight: 600; padding: 15px; background-color: rgba(0, 53, 102, 0.05); border-radius: 8px;">
                            What if I don't have internet access?
                            <i class="fas fa-chevron-down float-end"></i>
                        </h3>
                        <div class="faq-answer p-3" >
                            <p>The government maintains physical service centers across the country to assist those without internet access. Additionally, many municipalities have free WiFi zones where you can access E-Government services.</p>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 3 -->
                    <div class="faq-item mb-4">
                        <h3 class="faq-question" style="color: #003566; cursor: pointer; font-weight: 600; padding: 15px; background-color: rgba(0, 53, 102, 0.05); border-radius: 8px;">
                            What government services are available online?
                            <i class="fas fa-chevron-down float-end"></i>
                        </h3>
                        <div class="faq-answer p-3" >
                            <p>The E-Government platform offers numerous services including tax filing, business registration, ID applications, birth/marriage/death certificates, land title verification, and many more. New services are continuously being added.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row section-fade-in">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center p-5" style="background-color: rgba(0, 53, 102, 0.9); color: white;">
                    <h2 class="fw-bold mb-3">Start Using E-Government Philippines Today</h2>
                    <p class="lead mb-4">Join millions of Filipinos who are accessing government services with ease and convenience</p>
                    <a href="#" class="btn btn-light btn-lg px-5 py-3 fw-bold hover-effect">Get Started Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #003566;
        --light-color: #ffffff;
        --dark-color: #001d3d;
        --hover-color: #004d99;
        --text-color: #333333;
        --light-bg: #f8f9fa;
    }
    
    /* Fade in animation */
    .section-fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    
    .section-fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Modernized Hero Section */
    .hero-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        transition: all 0.4s ease;
        border: none;
    }
    
    .hero-btn {
        transition: all 0.3s ease;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        font-size: 0.8rem;
    }
    
    .hero-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .hero-btn-outline {
        border: 1px solid white;
        transition: all 0.3s ease;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        font-size: 0.8rem;
    }
    
    .hero-btn-outline:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }
    
    .egov-logo {
        filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.2));
        transition: transform 0.3s ease;
    }
    
    .egov-logo:hover {
        transform: scale(1.05);
    }
    
    /* How E-Gov Works - Workflow Styling */
    .workflow-container {
        margin: 30px 0;
    }
    
    .workflow-steps {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .workflow-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 120px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .workflow-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: rgba(0, 53, 102, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }
    
    .workflow-icon i {
        font-size: 25px;
        color: #003566;
        transition: all 0.3s ease;
    }
    
    .workflow-step h5 {
        font-size: 14px;
        text-align: center;
        margin: 0;
        color: #333;
        transition: all 0.3s ease;
    }
    
    .workflow-connector {
        flex-grow: 1;
        height: 3px;
        background: linear-gradient(90deg, rgba(0, 53, 102, 0.3) 0%, rgba(0, 53, 102, 0.8) 100%);
        position: relative;
        max-width: 50px;
    }
    
    .workflow-step.active .workflow-icon {
        background-color: #003566;
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 53, 102, 0.3);
    }
    
    .workflow-step.active .workflow-icon i {
        color: white;
    }
    
    .workflow-step.active h5 {
        color: #003566;
        font-weight: 600;
    }
    
    .workflow-step:hover .workflow-icon {
        transform: scale(1.05);
    }
    
    .workflow-detail {
        display: none;
        animation: fadeIn 0.5s ease;
    }
    
    .workflow-detail.active {
        display: block;
    }
    
    /* Usage Statistics Highlights */
    .highlight-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .highlight-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        background-color: rgba(0, 53, 102, 0.1) !important;
    }
    
    .highlight-number {
        font-size: 36px;
        font-weight: 700;
        color: #003566;
        margin-bottom: 0;
    }
    
    .highlight-label {
        font-size: 14px;
        font-weight: 500;
        color: #555;
        margin: 0;
    }
    
    /* Enhanced tab styling for better visibility */
    #servicesTab .nav-link {
        color: #003566;
        font-weight: 600;
        border-radius: 5px 5px 0 0;
        position: relative;
        transition: all 0.3s ease;
        padding: 10px 15px;
    }
    
    #servicesTab .nav-link.active {
        color: #003566;
        background-color: white !important;
        border-bottom-color: white !important;
        font-weight: 700;
    }
    
    #servicesTab .nav-link:hover {
        color: #004d99;
    }
    
    /* Tab border styling */
    #servicesTabContent {
        border-color: #dee2e6 !important;
    }
    
    /* Interactive Services Styling */
    .service-icon-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--primary-color);
        color: white;
        font-size: 3rem;
        margin: 0 auto;
        box-shadow: 0 5px 15px rgba(0, 53, 102, 0.3);
        transition: all 0.5s ease;
    }
    
    .tab-pane:hover .service-icon-large {
        transform: rotate(360deg);
        box-shadow: 0 8px 25px rgba(0, 53, 102, 0.5);
    }
    
    .service-features {
        padding-left: 20px;
        margin-bottom: 20px;
        color: #333;
    }
    
    .service-features li {
        margin-bottom: 8px;
        position: relative;
        padding-left: 5px;
    }
    
    .service-features li:before {
        content: "•";
        color: var(--primary-color);
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }
    
    /* Interactive Steps */
    .step-tabs {
        display: flex;
        justify-content: space-between;
    }
    
    .step-tab {
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .step-tab.active {
        background-color: var(--primary-color);
        color: white;
    }
    
    .step-content {
        display: none;
        animation: fadeIn 0.5s ease;
    }
    
    .step-content.active {
        display: block;
    }
    
    /* Expanded Carousel */
    .carousel-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }
    
    .carousel-item {
        height: 550px; /* Expanded height */
    }
    
    .carousel-item img {
        object-fit: cover;
        height: 100%;
        width: 100%;
        filter: brightness(0.7);
    }
    
    .carousel-caption {
        background-color: rgba(0, 53, 102, 0.7);
        border-radius: 10px;
        padding: 25px 30px;
        bottom: 40px;
        max-width: 80%;
        margin: 0 auto;
        left: 10%;
        right: 10%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .carousel-indicators {
        bottom: 20px;
    }
    
    .carousel-indicators li {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 0 5px;
        transition: all 0.3s ease;
    }
    
    .carousel-indicators li.active {
        background-color: white;
        width: 14px;
        height: 14px;
    }
    
    /* Interactive carousel navigation */
    .carousel-control-prev, 
    .carousel-control-next {
        width: 50px;
        height: 50px;
        background-color: var(--primary-color);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.5;
        transition: all 0.3s ease;
    }
    
    .carousel-control-prev:hover, 
    .carousel-control-next:hover {
        opacity: 1;
        transform: translateY(-50%) scale(1.1);
    }
    
    .carousel-control-prev {
        left: 20px;
    }
    
    .carousel-control-next {
        right: 20px;
    }
    
    /* Interactive button effects */
    .hover-effect {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .hover-effect:after {
        content: '';
        position: absolute;
        width: 0;
        height: 3px;
        background: var(--primary-color);
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }
    
    .hover-effect:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .hover-effect:hover:after {
        width: 80%;
    }
    
    /* Enhanced Card Hover Effects */
    .card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        border-color: #003566;
    }
    
    /* Add glassmorphism to feature cards */
    .feature-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        transition: all 0.4s ease;
    }
    
    .feature-card:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateY(-10px) scale(1.02);
    }
    
    .feature-card:hover .card-title {
        color: #004d99 !important;
        font-weight: 700;
    }
    
    /* Card icon hover effects */
    .card-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0, 53, 102, 0.3);
        background-color: var(--primary-color);
        color: var(--light-color);
        transition: all 0.5s ease;
    }
    
    .feature-card:hover .card-icon {
        transform: rotateY(180deg) scale(1.2);
        background-color: var(--hover-color);
    }
    
    /* FAQ styling */
    .faq-item {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .faq-item:hover {
        transform: translateX(5px);
    }
    
    .faq-question {
        transition: all 0.3s ease;
    }
    
    .faq-question.active {
        background-color: rgba(0, 53, 102, 0.1) !important;
    }
    
    .faq-answer {
        background-color: white;
        border-radius: 0 0 8px 8px;
        padding: 15px;
    }
    
    /* Section styling */
    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        width: 50px;
        height: 3px;
        background-color: var(--primary-color);
        bottom: 0;
        left: 0;
    }
    
    .text-center .section-title:after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    /* App download buttons */
    .app-download-buttons {
        display: flex;
        gap: 20px;
    }
    
    .app-download-buttons .btn {
        border-radius: 6px;
        position: relative;
        overflow: hidden;
        z-index: 1;
        transition: all 0.4s ease;
    }
    
    .app-download-buttons .btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transition: all 0.4s ease;
        z-index: -1;
    }
    
    .app-download-buttons .btn:hover:before {
        left: 0;
    }
    
    .app-download-buttons .btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 29, 61, 0.3);
    }
    
    /* Add parallax scrolling effect */
    .parallax-bg {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    
    /* Animation for elements */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .hero-card {
        animation: fadeIn 1.5s ease-in-out;
    }
    
    /* Additional hover effect for buttons */
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Optimize container */
    .container-fluid {
        max-width: 1400px;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: rgba(0, 29, 61, 0.05);
    }
    
    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: var(--hover-color);
    }
    
    /* For responsiveness in mobile */
    @media (max-width: 768px) {
        .workflow-steps {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .workflow-step {
            flex-direction: row;
            width: 100%;
            margin-bottom: 15px;
        }
        
        .workflow-icon {
            margin-right: 15px;
            margin-bottom: 0;
        }
        
        .workflow-connector {
            width: 3px;
            height: 30px;
            margin: 5px 0 5px 35px;
        }
        
        .chart-container {
            height: 300px !important;
        }
        
        .highlight-number {
            font-size: 28px;
        }
    }
</style>

<script>
$(document).ready(function() {
    // Initialize carousel
    $('#carouselExampleControls').carousel({
        interval: 5000,
        wrap: true
    });
    
    // Override Bootstrap's default tab styling with !important
    // First, modify the CSS in the head
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            #servicesTab .nav-link.active {
                background-color: #004d99 !important;
                color: white !important;
                border-bottom-color: #004d99 !important;
            }
            #servicesTab .nav-link {
                background-color: #003566 !important;
                color: white !important;
            }
            #servicesTab .nav-link:hover {
                background-color: #004d99 !important;
            }
        `)
        .appendTo('head');
    
    // Fix for tab links causing page scrolling
    $('#servicesTab a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    // Override the inline styles immediately after tab change
    $('#servicesTab a').on('shown.bs.tab', function() {
        // Force all tabs to have blue background
        $('#servicesTab .nav-link').attr('style', 'background-color: #003566 !important; color: white !important;');
        // Make active tab slightly different blue
        $('#servicesTab .nav-link.active').attr('style', 'background-color: #004d99 !important; color: white !important;');
    });
    
    // Initialize the first tab as active
    $('#servicesTab a:first').tab('show');
    
    // Set initial styles with a slight delay to ensure they apply
    setTimeout(function() {
        $('#servicesTab .nav-link').attr('style', 'background-color: #003566 !important; color: white !important;');
        $('#servicesTab .nav-link.active').attr('style', 'background-color: #004d99 !important; color: white !important;');
    }, 100);
    
    // Tab icon animation on hover
    $('#servicesTab a').hover(
        function() {
            $(this).find('i').addClass('fa-bounce');
        }, 
        function() {
            $(this).find('i').removeClass('fa-bounce');
        }
    );
    
    // Simple FAQ toggle functionality
    $('.faq-question').click(function() {
        $(this).next('.faq-answer').slideToggle(300);
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        $(this).toggleClass('active');
    });
    
    // Hide all FAQ answers initially
    $('.faq-answer').hide();
    
    // New Interactive Workflow
    $('.workflow-step').click(function() {
        const stepNum = $(this).data('step');
        $('.workflow-step').removeClass('active');
        $(this).addClass('active');
        $('.workflow-detail').removeClass('active');
        $(`.workflow-detail[data-step="${stepNum}"]`).addClass('active');
    });
    
    // Simplified interactive steps functionality
    $('.step-tab').click(function() {
        const stepNum = $(this).data('step');
        $('.step-tab').removeClass('active');
        $(this).addClass('active');
        $('.step-content').removeClass('active');
        $(`.step-content[data-step="${stepNum}"]`).addClass('active');
    });
    
    // Counter Animation
    function animateCounter() {
        $('.counter').each(function() {
            const $this = $(this);
            const targetValue = parseInt($this.attr('data-target'));
            
            // Only animate if in viewport
            if ($this.isInViewport() && !$this.hasClass('counted')) {
                $this.addClass('counted');
                $({ Counter: 0 }).animate({
                    Counter: targetValue
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.ceil(this.Counter));
                    }
                });
            }
        });
    }
    
    // Check if element is in viewport
    $.fn.isInViewport = function() {
        const elementTop = $(this).offset().top;
        const elementBottom = elementTop + $(this).outerHeight();
        const viewportTop = $(window).scrollTop();
        const viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };
    
    // Fade in sections as they come into view
    function checkFadeElements() {
        $('.section-fade-in').each(function() {
            var elementTop = $(this).offset().top;
            var elementVisible = 150;
            var windowHeight = $(window).height();
            var scrollTop = $(window).scrollTop();
            
            if (elementTop < (windowHeight + scrollTop) - elementVisible) {
                $(this).addClass('visible');
            }
        });
    }
    
    // Run on page load
    checkFadeElements();
    animateCounter();
    
    // Run on scroll
    $(window).on('scroll', function() {
        checkFadeElements();
        animateCounter();
        
        // Parallax scrolling effect
        var scrollPosition = $(this).scrollTop();
        $('.parallax-bg').css({
            'background-position-y': -scrollPosition/5 + 'px'
        });
    });
    
    // Enhanced hover effects for feature cards
    $('.feature-card').hover(
        function() {
            $(this).find('.card-icon').css('transform', 'scale(1.2) rotate(10deg)');
            $(this).find('.card-title').css('color', '#004d99');
        },
        function() {
            $(this).find('.card-icon').css('transform', 'scale(1) rotate(0deg)');
            $(this).find('.card-title').css('color', '#003566');
        }
    );
    
    // Add smooth scrolling for anchor links (but not for tabs)
    $('a[href*="#"]').not('[data-toggle="tab"]').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate(
            {
                scrollTop: $($(this).attr('href')).offset().top - 70
            },
            800,
            'swing'
        );
    });
    
    // Add interactive typing effect to hero headline
    if($('.hero-content h1').length) {
        const text = $('.hero-content h1').text();
        $('.hero-content h1').empty();
        
        let i = 0;
        const typeWriter = function() {
            if (i < text.length) {
                $('.hero-content h1').append(text.charAt(i));
                i++;
                setTimeout(typeWriter, 50);
            }
        }
        
        setTimeout(typeWriter, 500);
    }
    
    // E-Gov Usage Chart with real data
    const usageCtx = document.getElementById('egovUsageChart').getContext('2d');
    const usageChart = new Chart(usageCtx, {
        type: 'bar',
        data: {
            labels: ['Registered eGov PH Users', 'Digital National ID Users'],
            datasets: [{
                label: 'Number of Users (Millions)',
                data: [8, 72],
                backgroundColor: [
                    'rgba(0, 53, 102, 0.7)',
                    'rgba(33, 150, 243, 0.7)'
                ],
                borderColor: [
                    'rgb(0, 53, 102)',
                    'rgb(33, 150, 243)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Users (Millions)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Service Type'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' million users';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection