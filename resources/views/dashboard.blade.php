@extends('layouts.app')
  

@section('contents')
  <div class="header">
    <img src="/images/DICT_Logo.png" alt="DICT Logo">
    <h2 class="m-1">DICT Cavite Main Page</h2>
  </div>

  <div class="row">
 
  </div>

  <div class="carousel-section">
    <h3 class="section-title mt-4">Featured Projects</h3>
    <div class="carousel-container">
      <div class="void" id="void">
        <div class="crop">
          <ul id="card-list" style="--count: 6;">
            <li><div class="card"><a href=""><span class="model-name">Project Alpha</span><span>Modern digital infrastructure development for rural communities</span></a></div></li>
            <li><div class="card"><a href=""><span class="model-name">Tech Connect</span><span>Bridging the digital divide through community-based initiatives</span></a></div></li>
            <li><div class="card"><a href=""><span class="model-name">CyberSafe PH</span><span>Cybersecurity awareness and training for local government units</span></a></div></li>
            <li><div class="card"><a href=""><span class="model-name">e-Governance</span><span>Streamlining government services through digital transformation</span></a></div></li>
            <li><div class="card"><a href=""><span class="model-name">Digital Literacy</span><span>Educational programs for enhancing ICT skills in underserved areas</span></a></div></li>
            <li><div class="card"><a href=""><span class="model-name">Smart Cities</span><span>Implementing IoT solutions for urban development and monitoring</span></a></div></li>
          </ul>
          <div class="last-circle"></div>
          <div class="second-circle"></div>
        </div>
        <div class="mask"></div>
        <div class="center-circle">
          <div class="center-content">
            <div class="pulse-ring"></div>
            <div class="center-icon">
              <img src="/images/dict.png" alt="DICT Logo" class="center-icon-image">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Text Carousel Section -->
  <div class="text-carousel-section">
    <!-- In the Text Carousel Section, remove carousel-fade class -->
<div id="dictInfoCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="carousel-text-content">
            <h2 class="mission-title">Mission</h2>
            <p class="mission-tagline">"DICT of the people and for the people."</p>
            <p>The Department of Information and Communications Technology commits to:</p>
            <ul>
              <li>Provide every Filipino access to vital ICT infostructure and services</li>
              <li>Ensure sustainable growth of Philippine ICT-enabled industries resulting to creation of more jobs</li>
              <li>Establish a One Digitized Government, One Nation</li>
              <li>Support the administration in fully achieving its goals</li>
              <li>Be the enabler, innovator, achiever and leader in pushing the country's development and transition towards a world-class digital economy</li>
            </ul>
          </div>
        </div>
        <div class="carousel-item">
          <div class="carousel-text-content">
            <h2 class="vision-title">Vision</h2>
            <p class="vision-tagline">"An innovative, safe and happy nation that thrives through and is enabled by Information and Communications Technology."</p>
            <p>DICT aspires for the Philippines to develop and flourish through innovation and constant development of ICT in the pursuit of a progressive, safe, secured, contented and happy Filipino nation.</p>
            <h3 class="values-title">Core Values</h3>
            <ul class="values-list">
              <li><strong>D</strong> – Dignity</li>
              <li><strong>I</strong> – Integrity</li>
              <li><strong>C</strong> – Competency and Compassion</li>
              <li><strong>T</strong> – Transparency</li>
            </ul>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#dictInfoCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#dictInfoCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <ol class="carousel-indicators">
        <li data-target="#dictInfoCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#dictInfoCarousel" data-slide-to="1"></li>
      </ol>
    </div>
  </div>

  <!-- Project Cards Section -->
  <div class="project-cards-section">
    <h2 class="cards-section-title">Overview of DICT Cavite Projects</h2>
    
    <div class="container">
      <div class="row">
        <!-- First Row -->
        <div class="col-md-4 mb-4">
          <div class="dict-card">
            <div class="card-img-container">
              <img src="/images/tech4ed.jpg" class="card-img-top" alt="Digital Transformation">
            </div>
            <div class="card-body">
              <h5 class="card-title">Digital Transformation</h5>
              <p class="card-text">Comprehensive digital transformation initiatives for government agencies to improve service delivery and operational efficiency.</p>
              <h6 class="btm">DICT Cavite</h6>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="dict-card">
            <div class="card-img-container">
              <img src="/images/wifi.jpg" class="card-img-top" alt="Free WiFi">
            </div>
            <div class="card-body">
              <h5 class="card-title">Free WiFi for All</h5>
              <p class="card-text">Providing free internet access in public places across Cavite province to bridge the digital divide and empower communities.</p>
              <h6 class="btm">DICT Cavite</h6>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="dict-card">
            <div class="card-img-container">
              <img src="/images/spark1.jpg" class="card-img-top" alt="ICT Training">
            </div>
            <div class="card-body">
              <h5 class="card-title">ICT Training Programs</h5>
              <p class="card-text">Capacity building initiatives focusing on digital literacy and advanced ICT skills development for various stakeholders.</p>
              <h6 class="btm">DICT Cavite</h6>
            </div>
          </div>
        </div>
        
        <!-- Second Row -->
        <div class="col-md-4 mb-4">
          <div class="dict-card">
            <div class="card-img-container">
              <img src="/images/pcucyber.jpg" class="card-img-top" alt="Cybersecurity">
            </div>
            <div class="card-body">
              <h5 class="card-title">Cybersecurity Programs</h5>
              <p class="card-text">Enhancing digital safety through comprehensive cybersecurity frameworks, awareness campaigns, and technical assistance.</p>
              <h6 class="btm">DICT Cavite</h6>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="dict-card">
            <div class="card-img-container">
              <img src="/images/egovpcu.jpg" class="card-img-top" alt="eGov Services">
            </div>
            <div class="card-body">
              <h5 class="card-title">e-Government Services</h5>
              <p class="card-text">Digital platforms that streamline government processes, enhancing citizen access to essential public services.</p>
              <h6 class="btm">DICT Cavite</h6>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="dict-card">
            <div class="card-img-container">
              <img src="/images/techfair.jpg" class="card-img-top" alt="Tech Startups">
            </div>
            <div class="card-body">
              <h5 class="card-title">Tech Startup Support</h5>
              <p class="card-text">Fostering innovation through mentorship, funding opportunities, and resources for local tech persons.</p>
              <h6 class="btm">DICT Cavite</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    :root {
      --rotate-speed: 40;
      --count: 6;
      --easeInOutSine: cubic-bezier(0.37, 0, 0.63, 1);
      --easing: cubic-bezier(0.000, 0.37, 1.000, 0.63);
      --primary-color: rgba(13, 110, 253, 0.25);
      --primary-color-solid: #0d6efd;
      --dict-blue: #003566;
      --dict-dark-blue: #002349;
    }
    .header {
    background-color: var(--dict-dark-blue);
    color: white;
    padding: 15px 30px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    margin-bottom: 16px;
    margin-top: -24px; /* Add this line to move it up */
    position: relative; /* Add this to ensure proper stacking */
    z-index: 10; /* Add this to keep it above other elements */
}
    
    .header img {
      height: 40px;
      width: auto;
    }

    .carousel-section {
    margin-top: -30px;
    padding: 0 20px;
    margin-bottom: 250px; /* Add margin to create space between carousels */
}

    
    .section-title {
      color: var(--dict-blue);
      font-weight: 600;
      margin-bottom: 15px;
      position: relative;
      display: block;  /* Changed from inline-block */
      padding-bottom: 8px;
      text-align: center;  /* Added to center the text */
}

.section-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;  /* Changed from 0 */
      transform: translateX(-50%);  /* Added to center the underline */
      width: 200px;  /* Changed from 60% to fixed width for better centering */
      height: 3px;
      background: linear-gradient(90deg, transparent, var(--dict-blue), transparent);  /* Modified gradient for centered look */
}

.carousel-container {
    padding: 20px 0 60px;
    position: relative;
    overflow: visible; /* Change from hidden to visible */
    max-height: 800px; /* Increase from 700px to give more space */
}

.void {
    width: 100%;
    max-width: 1000px;
    margin: auto;
    position: relative;
    aspect-ratio: 1 / 1;
    margin-bottom: 20px; /* Reduce bottom margin since we added spacing above */
}
    
    #card-list {
      list-style-type: none;
      margin: 0;
      padding: 0;
      position: relative;
      width: 100%;
      aspect-ratio: 1 / 1;
      z-index: 1;
      pointer-events: none;
    }
    
    #card-list li {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 100%;
      animation: rotateCW calc(var(--rotate-speed) * 1s) var(--easing) infinite;
      transform-origin: center;
      pointer-events: auto;
    }
    
    #card-list:hover * {
      animation-play-state: paused;
    }
    
    .card {
      width: 280px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 20px 24px;
      gap: 10px;
      background: #FFFFFF;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1), 0px 4px 8px rgba(0, 0, 0, 0.05);
      border-radius: 12px;
      font-family: 'Inter', sans-serif;
      font-style: normal;
      font-weight: 400;
      font-size: 14px;
      line-height: 20px;
      color: #535062;
      animation: rotateCCW calc(var(--rotate-speed) * 1s) var(--easing) infinite;
      transform-origin: center;
      position: relative;
      z-index: 1;
      transition: all 0.3s ease;
      border-left: 4px solid var(--dict-blue);
    }
    
    .card:hover {
      z-index: 10;
      transform: scale(1.05);
      box-shadow: 0px 12px 24px rgba(0, 53, 102, 0.25), 0px 8px 16px rgba(0, 0, 0, 0.1);
    }
    
    .card a {
      text-decoration: none;
      color: unset;
      display: block;
      width: 100%;
    }
    
    .model-name {
      font-weight: 600;
      font-size: 18px;
      line-height: 150%;
      color: var(--dict-blue);
      display: block;
      margin-bottom: 5px;
    }

    #card-list li:nth-child(2), #card-list li:nth-child(2) .card {
      animation-delay: calc((var(--rotate-speed)/var(--count)) * -1s);
    }
    #card-list li:nth-child(3), #card-list li:nth-child(3) .card {
      animation-delay: calc((var(--rotate-speed)/var(--count)) * -2s);
    }
    #card-list li:nth-child(4), #card-list li:nth-child(4) .card {
      animation-delay: calc((var(--rotate-speed)/var(--count)) * -3s);
    }
    #card-list li:nth-child(5), #card-list li:nth-child(5) .card {
      animation-delay: calc((var(--rotate-speed)/var(--count)) * -4s);
    }
    #card-list li:nth-child(6), #card-list li:nth-child(6) .card {
      animation-delay: calc((var(--rotate-speed)/var(--count)) * -5s);
    }

    @keyframes rotateCW {
      from {
        transform: translate3d(0px, -50%, -1px) rotate(-45deg);
      }
      to {
        transform: translate3d(0px, -50%, 0px) rotate(-315deg);
      }
    }
    
    @keyframes rotateCCW {
      from {
        transform: rotate(45deg);
      }
      to {
        transform: rotate(315deg);
      }
    }
    
    @keyframes pulseGlow {
      from {
        background-size: 60%;
      }
      to {
        background-size: 100%;
      }
    }
    
    @keyframes pulse {
      0% {
        transform: scale(1);
        opacity: 1;
      }
      50% {
        transform: scale(1.1);
        opacity: 0.7;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    .center-circle {
      position: absolute;
      width: 250px;
      aspect-ratio: 1 / 1;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
      border-radius: 50%;
      z-index: 5;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .center-content {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 100%;
    }
    
    .center-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 100%;
      z-index: 2;
    }
    
    .center-icon-image {
      width: 70%;
      height: auto;
      max-width: 160px;
      z-index: 2;
      filter: drop-shadow(0 0 3px rgba(0, 53, 102, 0.3));
    }
    
    .pulse-ring {
      position: absolute;
      width: 100%;
      height: 100%;
      border-radius: 50%;
      border: 2px solid rgba(0, 53, 102, 0.4);
      animation: pulse 3s infinite;
    }
    
    .second-circle {
      position: absolute;
      width: 60%;
      aspect-ratio: 1 / 1;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      background: var(--dict-blue);
      opacity: 0.12;
      box-shadow: 0px 18px 36px -18px rgba(0, 35, 73, 0.3), 0px 30px 60px -12px rgba(0, 35, 73, 0.25);
      border-radius: 50%;
      z-index: 4;
    }
    
    .last-circle {
      position: absolute;
      width: 85%;
      aspect-ratio: 1 / 1;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      background: var(--dict-blue);
      opacity: 0.06;
      box-shadow: 0px 18px 36px -18px rgba(0, 35, 73, 0.3), 0px 30px 60px -12px rgba(0, 35, 73, 0.25);
      border-radius: 50%;
      z-index: 3;
    }
    
    .crop {
      -webkit-mask-image: linear-gradient(90deg, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) 50%, rgba(0, 0, 0, 1) 50%, rgba(0, 0, 0, 1));
      position: relative;
      width: 100%;
      height: 100%;
    }
    
    .mask {
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      width: 50%;
      animation: pulseGlow 5s linear infinite alternate;
      background-position: 100% 50%;
      background-repeat: no-repeat;
      background-image: radial-gradient(
        100% 50% at 100% 50%,
        rgba(0, 53, 102, 0.75) 0%,
        rgba(0, 53, 102, 0.74) 11.79%,
        rgba(0, 53, 102, 0.72) 21.38%,
        rgba(0, 53, 102, 0.70) 29.12%,
        rgba(0, 53, 102, 0.68) 35.34%,
        rgba(0, 53, 102, 0.66) 40.37%,
        rgba(0, 53, 102, 0.64) 44.56%,
        rgba(0, 53, 102, 0.62) 48.24%,
        rgba(0, 53, 102, 0.60) 51.76%,
        rgba(0, 53, 102, 0.58) 55.44%,
        rgba(0, 53, 102, 0.56) 59.63%,
        rgba(0, 53, 102, 0.54) 64.66%,
        rgba(0, 53, 102, 0.52) 70.88%,
        rgba(0, 53, 102, 0.50) 78.62%,
        rgba(0, 53, 102, 0.48) 88.21%,
        rgba(0, 53, 102, 0) 100%
      );
      z-index: 1;
    }
    
    .mask:after {
      content: "";
      position: absolute;
      width: 1px;
      height: 100%;
      right: 0;
      display: block;
      background-image: linear-gradient(180deg, rgba(0, 53, 102, 0) 0%, var(--dict-blue) 50%, rgba(0, 53, 102, 0) 100%);
    }

    /* Text Carousel Styles */
    .text-carousel-section {
    margin: 30px auto 50px; /* Change -30px to 30px to move it down */
    max-width: 1000px;
    padding: 0 20px;
    clear: both; /* Ensure it clears any floating elements */
    position: relative; /* Add positioning context */
    z-index: 1; /* Lower z-index to ensure it stays below the circle carousel */
}
    #dictInfoCarousel {
      background: white;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      position: relative;
    }

    .carousel-text-content {
  padding: 40px 60px;
  text-align: center;
  height: 500px; /* Fixed height instead of min-height */
  display: flex;
  flex-direction: column;
  justify-content: center;
  overflow-y: auto; /* Allow scrolling if content is too long */
}

.carousel-item {
  height: 500px; /* Match the fixed height */
}

    .carousel-text-content h2 {
      color: var(--dict-blue);
      font-weight: 700;
      margin-bottom: 15px;
      font-size: 28px;
    }

    .mission-tagline, .vision-tagline {
      font-style: italic;
      color: #555;
      margin-bottom: 20px;
      font-size: 18px;
    }

    .carousel-text-content p {
      margin-bottom: 15px;
      line-height: 1.6;
    }

    .carousel-text-content ul {
      text-align: left;
      margin: 0 auto;
      max-width: 700px;
      padding-left: 20px;
    }

    .carousel-text-content ul li {
      margin-bottom: 8px;
      line-height: 1.5;
    }

    .values-title {
      color: var(--dict-blue);
      font-weight: 600;
      margin: 25px 0 15px;
      font-size: 22px;
    }

    .values-list {
      list-style-type: none;
      padding: 0;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
    }

    .values-list li {
      background: rgba(0, 53, 102, 0.05);
      padding: 12px 15px;
      border-radius: 8px;
      margin: 0;
      flex: 1 1 40%;
      min-width: 200px;
      text-align: center;
      border-left: 3px solid var(--dict-blue);
    }

    .values-list strong {
      color: var(--dict-blue);
      font-size: 20px;
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 5%;
      opacity: 0.7;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: var(--dict-blue);
      border-radius: 50%;
      padding: 15px;
      background-size: 50%;
    }

    .carousel-indicators {
      bottom: 0;
    }

    .carousel-indicators li {
      background-color: var(--dict-blue);
      opacity: 0.5;
      width: 30px;
      height: 4px;
      border-radius: 2px;
      margin: 0 4px;
    }

    .carousel-indicators li.active {
      opacity: 1;
    }

    /* Project Cards Section Styles */
    .project-cards-section {
      padding: 60px 20px;
      background-color: #f8f9fa;
      position: relative;
    }
    
    .cards-section-title {
      text-align: center;
      color: var(--dict-blue);
      font-weight: 700;
      margin-bottom: 40px;
      position: relative;
      display: inline-block;
      padding-bottom: 10px;
      font-size: 28px;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .cards-section-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background: linear-gradient(90deg, transparent, var(--dict-blue), transparent);
    }
    
    .dict-card {
      height: 100%;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      background: white;
      position: relative;
      border: none;
      display: flex;
      flex-direction: column;
    }
    
    .dict-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 53, 102, 0.2);
    }
    
    .card-img-container {
      height: 180px;
      overflow: hidden;
      position: relative;
    }
    
    .card-img-top {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .dict-card:hover .card-img-top {
      transform: scale(1.1);
    }
    
    .card-body {
      padding: 20px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      position: relative;
      border-top: 4px solid var(--dict-blue);
      background: white;
    }
    
    .card-title {
      color: var(--dict-blue);
      font-weight: 600;
      font-size: 20px;
      margin-bottom: 12px;
      position: relative;
      padding-bottom: 8px;
    }
    
    .card-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 2px;
      background-color: var(--dict-blue);
    }
    
    .card-text {
      color: #535062;
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 20px;
      flex-grow: 1;
    }
    
    .btn-learn-more {
      display: inline-block;
      color: var(--dict-dark-blue);
      font-weight: 600;
      text-decoration: none;
      position: relative;
      padding-right: 25px;
      align-self: flex-start;
      transition: color 0.3s ease;
    }
    
    .btn-learn-more:after {
      content: '→';
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
      transition: transform 0.3s ease;
    }
    
    .btn-learn-more:hover {
      color: var(--dict-blue);
      text-decoration: none;
    }
    
    .btn-learn-more:hover:after {
      transform: translate(5px, -50%);
    }
    
    @media (max-width: 768px) {
      .carousel-text-content {
        padding: 30px 20px;
      }
      
      .values-list li {
        flex: 1 1 100%;
      }
      
      .dict-card {
        margin-bottom: 30px;
      }
    }
  </style>
@endsection