
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>pdf — Sign PDFs Instantly</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap');
    
    :root {
      --primary: #6366f1;
      --primary-dark: #4f46e5;
      --secondary: #10b981;
      --accent: #f59e0b;
      --dark: #1e293b;
      --light: #f8fafc;
    }
    
    body { 
      font-family: 'Inter', sans-serif; 
      scroll-behavior: smooth; 
      background-color: var(--light);
      color: var(--dark);
    }
    
    .heading-font {
      font-family: 'Poppins', sans-serif;
    }
    
    .gradient-bg { 
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
    }
    
    .gradient-bg-2 {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .gradient-bg-3 {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .gradient-text {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    
    .btn-primary { 
      background-color: var(--primary); 
      color: white; 
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);
    }
    
    .btn-primary:hover { 
      background-color: var(--primary-dark); 
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(99, 102, 241, 0.3);
    }
    
    .btn-secondary { 
      background-color: var(--secondary); 
      color: white; 
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
    }
    
    .btn-secondary:hover { 
      background-color: #059669; 
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(16, 185, 129, 0.3);
    }
    
    .pdf-viewer canvas { 
      margin-bottom: 20px; 
      border-radius: 8px; 
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .signature-pad-container { 
      background-color: #f9fafb; 
      border: 2px dashed #cbd5e0; 
      border-radius: 12px; 
      transition: all 0.3s ease;
    }
    
    .signature-pad-container:hover {
      border-color: var(--primary);
    }
    
    .signature-pad-container canvas { 
      background-color: transparent; 
    }
    
    .step-card { 
      background: white; 
      border-radius: 16px; 
      padding: 32px 24px; 
      text-align: center; 
      box-shadow: 0 8px 24px rgba(0,0,0,0.05); 
      transition: transform 0.3s, box-shadow 0.3s;
      position: relative;
      overflow: hidden;
    }
    
    .step-card:hover { 
      transform: translateY(-8px); 
      box-shadow: 0 12px 32px rgba(0,0,0,0.1);
    }
    
    .step-number {
      position: absolute;
      top: 16px;
      right: 16px;
      width: 36px;
      height: 36px;
      background: var(--primary);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }
    
    .upload-area {
      border: 2px dashed #cbd5e0;
      border-radius: 16px;
      padding: 40px 20px;
      text-align: center;
      transition: all 0.3s ease;
      background: white;
      cursor: pointer;
    }
    
    .upload-area:hover, .upload-area.dragover {
      border-color: var(--primary);
      background-color: #f0f4ff;
    }
    
    .upload-icon {
      font-size: 48px;
      color: var(--primary);
      margin-bottom: 16px;
    }
    
    .floating-shape {
      position: absolute;
      border-radius: 50%;
      opacity: 0.1;
      z-index: -1;
    }
    
    .floating-shape-1 {
      width: 300px;
      height: 300px;
      background: var(--primary);
      top: -150px;
      right: -150px;
    }
    
    .floating-shape-2 {
      width: 200px;
      height: 200px;
      background: var(--secondary);
      bottom: -100px;
      left: -100px;
    }
    
    .navbar {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.9);
    }
    
    .feature-icon {
      width: 60px;
      height: 60px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
      font-size: 24px;
      color: white;
    }
    
    .animate-float {
      animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }
    
    .pulse {
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    .fade-in {
      animation: fadeIn 0.8s ease-in;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .glow {
      box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
    }

    /* Tools Section CSS (PHASE 2 adapted to pdf) */
    .tools-row {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 32px;
    }
    .tool-card {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      padding: 32px 28px;
      width: 280px;
      text-decoration: none;
      color: inherit;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .tool-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 32px rgba(0,0,0,0.1);
    }
    .tool-icon { 
      font-size: 36px; 
      margin-bottom: 14px; 
      display: block;
    }
    .tool-card h3 { 
      font-size: 18px; 
      font-weight: 600; 
      margin-bottom: 8px; 
      color: var(--dark);
    }
    .tool-card p { 
      font-size: 14px; 
      color: #6b7280; 
      line-height: 1.6; 
      margin-bottom: 16px;
    }
    .tool-btn {
      display: inline-block;
      font-size: 13px;
      font-weight: 600;
      color: var(--primary);
    }
    
    .share-option {
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      transition: all 0.3s ease;
      cursor: pointer;
    }
    
    .share-option:hover {
      border-color: var(--primary);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .share-option.active {
      border-color: var(--primary);
      background-color: #f0f4ff;
    }
    
    .share-icon {
      font-size: 32px;
      margin-bottom: 12px;
    }
    
    .copy-link {
      display: flex;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      overflow: hidden;
    }
    
    .copy-link input {
      flex: 1;
      border: none;
      padding: 12px 16px;
      outline: none;
    }
    
    .copy-link button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0 16px;
      cursor: pointer;
      transition: background 0.3s;
    }
    
    .copy-link button:hover {
      background: var(--primary-dark);
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<header class="w-full shadow-sm navbar sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 flex justify-between items-center py-4">
    <div class="flex items-center">
      <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center mr-3">
        <i class="fas fa-signature text-white"></i>
      </div>
      <h1 class="text-2xl font-bold heading-font gradient-text">pdf</h1>
    </div>
    <nav class="space-x-8 hidden md:flex">
      <a href="#how-it-works" class="hover:text-indigo-600 font-medium transition-colors">How It Works</a>
      <a href="#features" class="hover:text-indigo-600 font-medium transition-colors">Features</a>
      <a href="/pdf-to-word" class="hover:text-indigo-600 font-medium transition-colors">PDF to Word</a>
      <a href="#uploadSection" class="hover:text-indigo-600 font-medium transition-colors">Sign PDF</a>
      <a href="#footer" class="hover:text-indigo-600 font-medium transition-colors">Contact</a>
    </nav>
    <button class="md:hidden text-gray-600">
      <i class="fas fa-bars text-xl"></i>
    </button>
  </div>
</header>

<!-- Hero Section -->
<section class="relative overflow-hidden gradient-bg text-white py-24 px-6">
  <div class="floating-shape floating-shape-1"></div>
  <div class="floating-shape floating-shape-2"></div>
  
  <div class="max-w-4xl mx-auto text-center relative z-10 fade-in">
    <h1 class="text-5xl md:text-6xl font-bold mb-6 heading-font">Sign PDFs Instantly, Anywhere</h1>
    <p class="max-w-2xl mx-auto text-xl mb-10 opacity-90">Upload, sign, share, and download your PDF documents without printing or scanning. Fast, secure, and completely free.</p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="#uploadSection" class="btn-primary px-8 py-4 rounded-xl text-lg font-medium pulse">Get Started Free</a>
      <a href="#how-it-works" class="bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-xl text-lg font-medium hover:bg-white/30 transition-all">How It Works</a>
    </div>
    
    <div class="mt-16 flex justify-center animate-float">
      <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl shadow-lg max-w-md">
        <div class="flex items-center mb-4">
          <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mr-4">
            <i class="fas fa-upload text-white"></i>
          </div>
          <div>
            <h3 class="font-semibold">Upload PDF</h3>
            <p class="text-sm opacity-80">Drag & drop your document</p>
          </div>
        </div>
        <div class="flex items-center mb-4">
          <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mr-4">
            <i class="fas fa-pen text-white"></i>
          </div>
          <div>
            <h3 class="font-semibold">Add Signature</h3>
            <p class="text-sm opacity-80">Draw or type your signature</p>
          </div>
        </div>
        <div class="flex items-center">
          <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mr-4">
            <i class="fas fa-download text-white"></i>
          </div>
          <div>
            <h3 class="font-semibold">Download & Share</h3>
            <p class="text-sm opacity-80">Get your signed document</p>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <!-- Tools Section (PHASE 2) -->
  <section id="tools" class="py-20 px-6 bg-white">
    <div class="max-w-6xl mx-auto text-center">
      <h2 class="text-3xl font-bold mb-4 heading-font">Our Tools</h2>
      <p class="text-gray-600 max-w-2xl mx-auto mb-16">Everything you need to work with PDF documents.</p>
      <div class="tools-row">
        <!-- Sign PDF Tool Card -->
        <a href="#uploadSection" class="tool-card fade-in">
          <div class="tool-icon">✍️</div>
          <h3>Sign PDF</h3>
          <p>Draw or type your signature directly on any PDF document.</p>
          <span class="tool-btn">Sign Now →</span>
        </a>
        <!-- PDF to Word Tool Card -->
        <a href="/pdfword" class="tool-card fade-in">
          <div class="tool-icon">📄→📝</div>
          <h3>PDF to Word</h3>
          <p>Convert PDF to editable Word (.docx)</p>
          <span class="tool-btn">Convert →</span>
        </a>
        <a href="/word-to-pdf" class="tool-card fade-in">
          <div class="tool-icon">📝→📄</div>
          <h3>Word to PDF</h3>
          <p>Convert Word to PDF with perfect formatting</p>
          <span class="tool-btn">Convert →</span>
        </a>
      </div>
    </div>
  </section>

  <!-- Steps Section -->
  <section id="how-it-works" class="py-20 px-6 bg-gray-50">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold text-center mb-4 heading-font">How It Works</h2>
    <p class="text-gray-600 text-center max-w-2xl mx-auto mb-16">Signing documents has never been easier. Follow these simple steps.</p>
    
    <div class="grid md:grid-cols-3 gap-8">
      <div class="step-card">
        <div class="step-number">1</div>
        <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-cloud-upload-alt text-indigo-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold mb-2">Upload PDF</h3>
        <p class="text-gray-600">Select the PDF you want to sign from your device or drag and drop it.</p>
      </div>
      
      <div class="step-card">
        <div class="step-number">2</div>
        <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-pen text-green-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold mb-2">Add Signature</h3>
        <p class="text-gray-600">Click anywhere on the PDF to draw your signature at the desired position.</p>
      </div>
      
      <div class="step-card">
        <div class="step-number">3</div>
        <div class="w-16 h-16 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-4">
          <i class="fas fa-file-download text-amber-600 text-2xl"></i>
        </div>
        <h3 class="text-xl font-semibold mb-2">Download & Share</h3>
        <p class="text-gray-600">Download your signed PDF or generate a shareable link to send to others.</p>
      </div>
    </div>
  </div>
</section>

<!-- Upload Section -->
<section id="uploadSection" class="py-16 px-6 flex flex-col items-center">
  <div class="max-w-2xl w-full">
    <h2 class="text-3xl font-bold text-center mb-2 heading-font">Ready to Sign Your PDF?</h2>
    <p class="text-gray-600 text-center mb-8">Upload your document and start signing in seconds.</p>
    
    <div class="bg-white rounded-2xl shadow-xl p-8 w-full">
      <div id="uploadArea" class="upload-area">
        <i class="upload-icon fas fa-file-pdf"></i>
        <h3 class="text-xl font-semibold mb-2">Upload Your PDF</h3>
        <p class="text-gray-500 mb-4">Drag & drop your file here or click to browse</p>
        <p class="text-sm text-gray-400">Supports PDF files up to 10MB</p>
        <input id="fileInput" type="file" accept="application/pdf" class="hidden" />
      </div>
      
      <div class="mt-6 flex justify-between items-center">
        <div class="flex items-center">
          <i class="fas fa-lock text-gray-500 mr-2"></i>
          <span class="text-sm text-gray-500">Your file is processed locally</span>
        </div>
        <button id="uploadBtn" class="btn-primary px-8 py-3 rounded-lg text-lg font-medium">Continue <i class="fas fa-arrow-right ml-2"></i></button>
      </div>
    </div>
    
    <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
      <div class="bg-white p-4 rounded-xl shadow-sm">
        <i class="fas fa-user-check text-indigo-600 text-xl mb-2"></i>
        <p class="text-sm font-medium">No Registration</p>
      </div>
      <div class="bg-white p-4 rounded-xl shadow-sm">
        <i class="fas fa-infinity text-indigo-600 text-xl mb-2"></i>
        <p class="text-sm font-medium">Unlimited Signatures</p>
      </div>
      <div class="bg-white p-4 rounded-xl shadow-sm">
        <i class="fas fa-shield-alt text-indigo-600 text-xl mb-2"></i>
        <p class="text-sm font-medium">Secure</p>
      </div>
      <div class="bg-white p-4 rounded-xl shadow-sm">
        <i class="fas fa-bolt text-indigo-600 text-xl mb-2"></i>
        <p class="text-sm font-medium">Fast Processing</p>
      </div>
    </div>
  </div>
</section>

<!-- PDF Viewer Section -->
<section id="viewerSection" class="hidden flex flex-col items-center w-full py-10 px-6">
  <div class="max-w-4xl w-full">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold heading-font">Sign Your Document</h2>
      <div class="flex items-center text-sm text-gray-600">
        <i class="fas fa-info-circle mr-2"></i>
        <span>Click anywhere on the document to place your signature</span>
      </div>
    </div>
    
    <div id="pdfContainer" class="pdf-viewer border rounded-xl bg-white shadow w-full h-[70vh] overflow-y-auto p-6"></div>
    
    <div class="flex flex-col sm:flex-row gap-4 mt-8">
      <button id="downloadBtn" class="btn-secondary px-8 py-3 rounded-lg text-lg font-medium flex items-center justify-center">
        <i class="fas fa-download mr-2"></i> Download
      </button>
      <!-- Signature Modal 
      <button id="shareBtn" class="bg-indigo-600 text-white px-8 py-3 rounded-lg text-lg font-medium hover:bg-indigo-700 transition-colors flex items-center justify-center">
        <i class="fas fa-share-alt mr-2"></i> Share
      </button>-->
      <button id="backBtn" class="bg-gray-500 text-white px-8 py-3 rounded-lg text-lg font-medium hover:bg-gray-600 transition-colors flex items-center justify-center">
        <i class="fas fa-arrow-left mr-2"></i> Back
      </button>
    </div>
  </div>
</section>

<!-- Signature Modal -->
<div id="signatureModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-md w-full fade-in">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 text-center heading-font">Draw Your Signature</h2>
    
    <div class="flex border-b mb-4">
      <button id="drawTab" class="flex-1 py-2 font-medium border-b-2 border-indigo-600 text-indigo-600">Draw</button>
      <button id="typeTab" class="flex-1 py-2 font-medium text-gray-500">Type</button>
    </div>
    
    <div id="drawSection">
      <div class="signature-pad-container mb-4 p-4">
        <canvas id="signaturePad" class="w-full h-48 rounded"></canvas>
      </div>
      <div class="flex justify-between mb-4">
        <button id="clearSig" class="text-gray-600 hover:text-gray-800 flex items-center">
          <i class="fas fa-eraser mr-2"></i> Clear
        </button>
        <div class="flex gap-2">
          <button class="w-8 h-8 rounded-full bg-black" data-color="black"></button>
          <button class="w-8 h-8 rounded-full bg-blue-600" data-color="blue"></button>
          <button class="w-8 h-8 rounded-full bg-red-600" data-color="red"></button>
        </div>
      </div>
    </div>
    
    <div id="typeSection" class="hidden">
      <div class="mb-4">
        <input type="text" id="typedSignature" placeholder="Enter your name" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
      </div>
      <div class="flex gap-2 mb-4">
        <select id="fontSelect" class="flex-1 p-2 border rounded-lg">
          <option value="Arial">Arial</option>
          <option value="Courier New">Courier New</option>
          <option value="Georgia">Georgia</option>
          <option value="Times New Roman">Times New Roman</option>
          <option value="Brush Script MT">Brush Script</option>
        </select>
        <select id="colorSelect" class="flex-1 p-2 border rounded-lg">
          <option value="black">Black</option>
          <option value="blue">Blue</option>
          <option value="red">Red</option>
        </select>
      </div>
    </div>
    
    <div class="flex justify-between pt-4 border-t">
      <button id="cancelSig" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition-colors">Cancel</button>
      <button id="saveSig" class="btn-primary px-6 py-2 rounded-lg">Save Signature</button>
    </div>
  </div>
</div>

<!-- Share Modal -->
<div id="shareModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
  <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-md w-full fade-in">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-xl font-semibold text-gray-800 heading-font">Share Your Document</h2>
      <button id="closeShareModal" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times text-xl"></i>
      </button>
    </div>
    
    <div class="mb-6">
      <p class="text-gray-600 mb-3">Share this link to allow others to view or download your signed PDF:</p>
      <div class="copy-link mb-2">
        <input id="shareLink" type="text" readonly class="bg-gray-50">
        <button id="copyLinkBtn" class="flex items-center">
          <i class="fas fa-copy mr-2"></i> Copy
        </button>
      </div>
      <p class="text-xs text-gray-500">Anyone with this link can view and download the document</p>
    </div>
    
    <div class="mb-6">
      <h3 class="font-medium mb-3">Share via:</h3>
      <div class="grid grid-cols-2 gap-4">
        <div id="whatsappOption" class="share-option">
          <div class="share-icon text-green-500">
            <i class="fab fa-whatsapp"></i>
          </div>
          <h4 class="font-medium">WhatsApp</h4>
        </div>
        <div id="emailOption" class="share-option">
          <div class="share-icon text-indigo-500">
            <i class="fas fa-envelope"></i>
          </div>
          <h4 class="font-medium">Email</h4>
        </div>
      </div>
    </div>
    
    <!-- Email Form (initially hidden) -->
    <div id="emailForm" class="hidden">
      <h3 class="font-medium mb-3">Send via Email</h3>
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Recipient Email</label>
          <input id="recipientEmail" type="email" placeholder="email@example.com" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
          <input id="emailSubject" type="text" value="Signed PDF Document" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
          <textarea id="emailMessage" rows="3" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">I've shared a signed PDF document with you. You can view and download it using the link below.</textarea>
        </div>
        <button id="sendEmailBtn" class="btn-primary w-full py-3 rounded-lg">Send Email</button>
      </div>
    </div>
  </div>
</div>



<!-- Features Section -->
<section id="features" class="py-20 px-6 bg-white">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold text-center mb-4 heading-font">Why Choose pdf?</h2>
    <p class="text-gray-600 text-center max-w-2xl mx-auto mb-16">Our platform offers everything you need for seamless digital document signing.</p>
    
    <div class="grid md:grid-cols-3 gap-8">
      <div class="text-center fade-in">
        <div class="feature-icon gradient-bg">
          <i class="fas fa-bolt"></i>
        </div>
        <h3 class="text-xl font-semibold mb-2">Lightning Fast</h3>
        <p class="text-gray-600">Sign documents in seconds, not minutes. No registration required.</p>
      </div>
      
      <div class="text-center fade-in">
        <div class="feature-icon gradient-bg-2">
          <i class="fas fa-shield-alt"></i>
        </div>
        <h3 class="text-xl font-semibold mb-2">Secure & Private</h3>
        <p class="text-gray-600">Your documents never leave your browser. Complete privacy guaranteed.</p>
      </div>
      
      <div class="text-center fade-in">
        <div class="feature-icon gradient-bg-3">
          <i class="fas fa-mobile-alt"></i>
        </div>
        <h3 class="text-xl font-semibold mb-2">Mobile Friendly</h3>
        <p class="text-gray-600">Works perfectly on all devices - desktop, tablet, and mobile.</p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer id="footer" class="bg-gray-800 text-white py-16 mt-16">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-4 gap-8">
    <div class="md:col-span-2">
      <div class="flex items-center mb-4">
        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center mr-3">
          <i class="fas fa-signature text-white"></i>
        </div>
        <h3 class="font-bold text-xl heading-font">pdf</h3>
      </div>
      <p class="mb-6 max-w-md">Sign PDFs online instantly. Share, download, and manage your documents efficiently with our secure and user-friendly platform.</p>
      <div class="flex space-x-4">
        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center hover:bg-indigo-600 transition-colors">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center hover:bg-indigo-600 transition-colors">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center hover:bg-indigo-600 transition-colors">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </div>
    </div>
    <div>
      <h3 class="font-semibold text-lg mb-4 heading-font">Quick Links</h3>
      <ul class="space-y-2">
        <li><a href="#how-it-works" class="hover:text-indigo-400 transition-colors">How It Works</a></li>
        <li><a href="#features" class="hover:text-indigo-400 transition-colors">Features</a></li>
        <li><a href="/pdf-to-word" class="hover:text-indigo-400 transition-colors">PDF to Word</a></li>
        <li><a href="#uploadSection" class="hover:text-indigo-400 transition-colors">Sign PDF</a></li>
        <li><a href="#footer" class="hover:text-indigo-400 transition-colors">Contact</a></li>
      </ul>
    </div>
    <div>
      <h3 class="font-semibold text-lg mb-4 heading-font">Contact</h3>
      <ul class="space-y-2">
        <li class="flex items-center">
          <i class="fas fa-envelope mr-3 text-indigo-400"></i>
          <span>support@pdf.com</span>
        </li>
        <li class="flex items-center">
  <i class="fas fa-phone mr-3 text-indigo-400"></i>
  <a href="https://wa.me/2348135836125" target="_blank" class="text-indigo-600 hover:underline">
    +234 8135836125
  </a>
</li>

        <li class="flex items-start">
          <i class="fas fa-map-marker-alt mr-3 mt-1 text-indigo-400"></i>
          <span>Warri Jakpa Delta State Nigeria</span>
        </li>
      </ul>
    </div>
  </div>
  <div class="max-w-6xl mx-auto px-6 mt-12 pt-8 border-t border-gray-700">
    <p class="text-center text-gray-400">&copy; 2025 pdf. All rights reserved.</p>
  </div>
</footer>

<script>
  const pdfjsLib = window['pdfjs-dist/build/pdf'];
  pdfjsLib.GlobalWorkerOptions.workerSrc =
    'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

  const uploadSection = document.getElementById("uploadSection");
  const viewerSection = document.getElementById("viewerSection");
  const fileInput = document.getElementById("fileInput");
  const uploadBtn = document.getElementById("uploadBtn");
  const backBtn = document.getElementById("backBtn");
  const pdfContainer = document.getElementById("pdfContainer");
  const downloadBtn = document.getElementById("downloadBtn");
  const shareBtn = document.getElementById("shareBtn");
  const uploadArea = document.getElementById("uploadArea");

  const signatureModal = document.getElementById("signatureModal");
  const signaturePadCanvas = document.getElementById("signaturePad");
  const drawTab = document.getElementById("drawTab");
  const typeTab = document.getElementById("typeTab");
  const drawSection = document.getElementById("drawSection");
  const typeSection = document.getElementById("typeSection");
  
  // Share modal elements
  const shareModal = document.getElementById("shareModal");
  const closeShareModal = document.getElementById("closeShareModal");
  const shareLink = document.getElementById("shareLink");
  const copyLinkBtn = document.getElementById("copyLinkBtn");
  const whatsappOption = document.getElementById("whatsappOption");
  const emailOption = document.getElementById("emailOption");
  const emailForm = document.getElementById("emailForm");
  const recipientEmail = document.getElementById("recipientEmail");
  const emailSubject = document.getElementById("emailSubject");
  const emailMessage = document.getElementById("emailMessage");
  const sendEmailBtn = document.getElementById("sendEmailBtn");
  
  let signaturePad, pdfBytes, pdfDoc, clickPosition, clickPage;
  let shareUrl = "";

  // Upload area click handler
  uploadArea.addEventListener("click", () => {
    fileInput.click();
  });

  // Drag and drop functionality
  uploadArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    uploadArea.classList.add("dragover");
  });

  uploadArea.addEventListener("dragleave", () => {
    uploadArea.classList.remove("dragover");
  });

  uploadArea.addEventListener("drop", (e) => {
    e.preventDefault();
    uploadArea.classList.remove("dragover");
    
    if (e.dataTransfer.files.length) {
      fileInput.files = e.dataTransfer.files;
      handleFileSelection();
    }
  });

  fileInput.addEventListener("change", handleFileSelection);

  function handleFileSelection() {
    if (fileInput.files.length) {
      const fileName = fileInput.files[0].name;
      uploadArea.innerHTML = `
        <i class="upload-icon fas fa-file-pdf"></i>
        <h3 class="text-xl font-semibold mb-2">${fileName}</h3>
        <p class="text-gray-500">Click "Continue" to proceed</p>
      `;
    }
  }

  uploadBtn.addEventListener("click", async () => {
    const file = fileInput.files[0];
    if (!file) return alert("Please select a PDF file");
    
    // Show loading state
    uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
    uploadBtn.disabled = true;
    
    const reader = new FileReader();
    reader.onload = async (e) => {
      pdfBytes = new Uint8Array(e.target.result);
      await renderAllPages();
      uploadSection.classList.add("hidden");
      viewerSection.classList.remove("hidden");
      window.scrollTo({ top: 0, behavior: 'smooth' });
      
      // Reset button
      uploadBtn.innerHTML = 'Continue <i class="fas fa-arrow-right ml-2"></i>';
      uploadBtn.disabled = false;
    };
    reader.readAsArrayBuffer(file);
  });

  backBtn.addEventListener("click", () => {
    viewerSection.classList.add("hidden");
    uploadSection.classList.remove("hidden");
    
    // Reset upload area
    uploadArea.innerHTML = `
      <i class="upload-icon fas fa-file-pdf"></i>
      <h3 class="text-xl font-semibold mb-2">Upload Your PDF</h3>
      <p class="text-gray-500 mb-4">Drag & drop your file here or click to browse</p>
      <p class="text-sm text-gray-400">Supports PDF files up to 10MB</p>
    `;
    fileInput.value = '';
  });

  async function renderAllPages() {
    pdfContainer.innerHTML = "";
    pdfDoc = await pdfjsLib.getDocument({ data: pdfBytes }).promise;

    for (let i = 1; i <= pdfDoc.numPages; i++) {
      const page = await pdfDoc.getPage(i);
      const viewport = page.getViewport({ scale: 1.4 });
      const canvas = document.createElement("canvas");
      const context = canvas.getContext("2d");
      canvas.width = viewport.width;
      canvas.height = viewport.height;
      canvas.classList.add("cursor-crosshair", "border", "shadow-sm", "mb-6");
      
      // Add page number
      const pageLabel = document.createElement("div");
      pageLabel.className = "text-center text-gray-500 mb-2 font-medium";
      pageLabel.textContent = `Page ${i}`;
      pdfContainer.appendChild(pageLabel);
      
      await page.render({ canvasContext: context, viewport: viewport }).promise;
      pdfContainer.appendChild(canvas);
      
      canvas.addEventListener("click", (e) => {
        const rect = canvas.getBoundingClientRect();
        clickPosition = { x: e.clientX - rect.left, y: e.clientY - rect.top };
        clickPage = i;
        openSignatureModal();
      });
    }
  }

  function openSignatureModal() {
    signatureModal.classList.remove("hidden");
    signaturePadCanvas.width = 400;
    signaturePadCanvas.height = 200;
    signaturePad = new SignaturePad(signaturePadCanvas, { 
      backgroundColor: 'rgba(0,0,0,0)', 
      penColor: '#000000' 
    });
    
    // Set up color buttons
    document.querySelectorAll('[data-color]').forEach(btn => {
      btn.addEventListener('click', () => {
        const color = btn.getAttribute('data-color');
        signaturePad.penColor = color;
      });
    });
  }

  // Tab switching
  drawTab.addEventListener("click", () => {
    drawTab.classList.add("border-indigo-600", "text-indigo-600");
    typeTab.classList.remove("border-indigo-600", "text-indigo-600");
    drawSection.classList.remove("hidden");
    typeSection.classList.add("hidden");
  });

  typeTab.addEventListener("click", () => {
    typeTab.classList.add("border-indigo-600", "text-indigo-600");
    drawTab.classList.remove("border-indigo-600", "text-indigo-600");
    typeSection.classList.remove("hidden");
    drawSection.classList.add("hidden");
  });

  document.getElementById("clearSig").addEventListener("click", () => {
    if (drawSection.classList.contains("hidden")) {
      document.getElementById("typedSignature").value = "";
    } else {
      signaturePad.clear();
    }
  });

  document.getElementById("cancelSig").addEventListener("click", () => { 
    signatureModal.classList.add("hidden"); 
    if (signaturePad) signaturePad.clear();
    document.getElementById("typedSignature").value = "";
  });

  document.getElementById("saveSig").addEventListener("click", async () => {
    let sigDataURL;
    
    if (drawSection.classList.contains("hidden")) {
      // Typed signature
      const text = document.getElementById("typedSignature").value;
      if (!text) return alert("Please enter your signature");
      
      const font = document.getElementById("fontSelect").value;
      const color = document.getElementById("colorSelect").value;
      
      // Create a canvas for the typed signature
      const canvas = document.createElement('canvas');
      canvas.width = 300;
      canvas.height = 100;
      const ctx = canvas.getContext('2d');
      
      ctx.font = `36px ${font}`;
      ctx.fillStyle = color;
      ctx.textBaseline = 'middle';
      ctx.textAlign = 'center';
      ctx.fillText(text, canvas.width/2, canvas.height/2);
      
      sigDataURL = canvas.toDataURL("image/png");
    } else {
      // Drawn signature
      if (signaturePad.isEmpty()) return alert("Please draw your signature first.");
      sigDataURL = signaturePad.toDataURL("image/png");
    }
    
    signatureModal.classList.add("hidden");
    await embedSignature(sigDataURL);
    await renderAllPages();
    
    // Reset signature inputs
    if (signaturePad) signaturePad.clear();
    document.getElementById("typedSignature").value = "";
  });

  async function embedSignature(sigDataURL) {
    const pdfDocLib = await PDFLib.PDFDocument.load(pdfBytes);
    const page = pdfDocLib.getPage(clickPage - 1);
    const pngImage = await pdfDocLib.embedPng(sigDataURL);
    const { width, height } = page.getSize();
    const canvasList = pdfContainer.getElementsByTagName("canvas");
    const clickedCanvas = canvasList[clickPage - 1];
    const scaleX = width / clickedCanvas.width;
    const scaleY = height / clickedCanvas.height;
    const sigWidth = 120;
    const sigHeight = (pngImage.height / pngImage.width) * sigWidth;
    page.drawImage(pngImage, {
      x: clickPosition.x * scaleX - sigWidth / 2,
      y: height - clickPosition.y * scaleY - sigHeight / 2,
      width: sigWidth,
      height: sigHeight,
    });
    pdfBytes = await pdfDocLib.save();
  }

  downloadBtn.addEventListener("click", () => {
    const blob = new Blob([pdfBytes], { type: "application/pdf" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "signed_document.pdf";
    link.click();
  });

  // Share button functionality
  shareBtn.addEventListener("click", () => {
    // Generate share URL with PDF encoded in Base64
    const base64 = btoa(String.fromCharCode(...pdfBytes));
    shareUrl = `${window.location.origin}${window.location.pathname}?pdf=${base64}`;
    
    // Set the share link value
    shareLink.value = shareUrl;
    
    // Show the share modal
    shareModal.classList.remove("hidden");
    
    // Reset email form
    emailForm.classList.add("hidden");
    whatsappOption.classList.add("active");
    emailOption.classList.remove("active");
  });

  // Close share modal
  closeShareModal.addEventListener("click", () => {
    shareModal.classList.add("hidden");
  });

  // Copy link functionality
  copyLinkBtn.addEventListener("click", () => {
    shareLink.select();
    document.execCommand("copy");
    
    // Show success feedback
    const originalText = copyLinkBtn.innerHTML;
    copyLinkBtn.innerHTML = '<i class="fas fa-check mr-2"></i> Copied!';
    setTimeout(() => {
      copyLinkBtn.innerHTML = originalText;
    }, 2000);
  });

  // WhatsApp sharing
  whatsappOption.addEventListener("click", () => {
    whatsappOption.classList.add("active");
    emailOption.classList.remove("active");
    emailForm.classList.add("hidden");
    
    const text = `I've shared a signed PDF document with you. You can view and download it here: ${shareUrl}`;
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
    window.open(whatsappUrl, '_blank');
  });

  // Email option
  emailOption.addEventListener("click", () => {
    emailOption.classList.add("active");
    whatsappOption.classList.remove("active");
    emailForm.classList.remove("hidden");
  });

  // Send email functionality
  sendEmailBtn.addEventListener("click", () => {
    const email = recipientEmail.value;
    const subject = emailSubject.value;
    const message = emailMessage.value;
    
    if (!email) {
      alert("Please enter a recipient email address");
      return;
    }
    
    // Create mailto link with the share URL
    const body = `${message}\n\n${shareUrl}`;
    const mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    
    // Open default email client
    window.location.href = mailtoLink;
    
    // Show success message
    alert("Your email client will open with the share link. Just hit send to share your document!");
  });

  // Load shared PDF if URL has ?pdf=
  window.addEventListener('load', async () => {
    const params = new URLSearchParams(window.location.search);
    const sharedPdf = params.get('pdf');
    if (sharedPdf) {
      pdfBytes = Uint8Array.from(atob(sharedPdf), c => c.charCodeAt(0));
      await renderAllPages();
      uploadSection.classList.add("hidden");
      viewerSection.classList.remove("hidden");
    }
  });
</script>
</body>
</html>
