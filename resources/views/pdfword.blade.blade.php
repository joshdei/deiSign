<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PDF to Word Converter — Free & Instant | pdf</title>
  <meta name="description" content="Convert PDF to Word (.docx) free online. No upload, no sign-up. Processed entirely in your browser.">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <script src="https://unpkg.com/docx@8.5.0/build/index.umd.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
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
    
    /* PDF to Word specific styles (PHASE 4-5 adapted to pdf) */
    .step-bar {
      display: flex; align-items: center; justify-content: center;
      gap: 8px; padding: 0 20px 40px; flex-wrap: wrap;
    }
    .step-item {
      display: flex; align-items: center; gap: 7px;
      font-size: 14px; font-weight: 500; color: #9ca3af;
    }
    .step-item.active { color: var(--primary); }
    .step-dot {
      width: 26px; height: 26px; border-radius: 50%;
      border: 2px solid currentColor;
      display: flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 700;
    }
    .step-item.active .step-dot { background: var(--primary); border-color: var(--primary); color: white; }
    .step-sep { color: #d1d5db; font-size: 16px; }
    
    .upload-zone {
      border: 2px dashed #d1d5eb;
      border-radius: 16px;
      padding: 48px 24px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      background: white;
    }
    .upload-zone:hover, .upload-zone.dragover {
      border-color: var(--primary);
      background-color: #f0f4ff;
    }
    .upload-title { font-size: 17px; font-weight: 600; color: var(--dark); margin: 14px 0 6px; }
    .upload-sub { font-size: 14px; color: #6b7280; }
    .browse-link { color: var(--primary); cursor: pointer; text-decoration: underline; }
    .upload-hint { font-size: 12px; color: #9ca3af; margin-top: 10px; }
    
    .file-card {
      display: flex; align-items: center; justify-content: space-between;
      background: white; border: 1px solid #e5e7eb;
      border-radius: 12px; padding: 14px 18px; margin-top: 14px;
    }
    .file-card-left { display: flex; align-items: center; gap: 12px; }
    .file-icon {
      background: #fee2e2; color: #dc2626;
      font-size: 10px; font-weight: 800; letter-spacing: .05em;
      width: 38px; height: 38px; border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
    }
    .file-name { font-size: 14px; font-weight: 500; color: var(--dark); }
    .file-size { font-size: 12px; color: #9ca3af; margin-top: 2px; }
    .remove-btn {
      background: none; border: none; cursor: pointer;
      color: #9ca3af; font-size: 16px; padding: 4px 8px;
      border-radius: 6px; transition: all .15s;
    }
    .remove-btn:hover { color: #dc2626; background: #fee2e2; }
    
    .main-btn {
      display: block; width: 100%; margin-top: 18px;
      background: var(--primary); color: white;
      font-size: 16px; font-weight: 600;
      padding: 14px 28px; border-radius: 12px;
      border: none; cursor: pointer;
      transition: all .3s ease;
      box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);
    }
    .main-btn:hover:not(:disabled) { 
      background: var(--primary-dark); 
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(99, 102, 241, 0.3);
    }
    
    .spinner {
      width: 44px; height: 44px; margin: 0 auto;
      border: 3px solid #e5e7eb;
      border-top-color: var(--primary);
      border-radius: 50%;
      animation: spin .8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
    
    .success-check {
      width: 64px; height: 64px; margin: 0 auto;
      background: #d1fae5; color: var(--secondary);
      border-radius: 50%; font-size: 28px;
      display: flex; align-items: center; justify-content: center;
    }
    
    .error-box {
      background: #fef2f2; border: 1px solid #fecaca;
      border-radius: 12px; padding: 20px 24px;
      color: #991b1b; text-align: center;
    }
    
    .tips-box {
      margin-top: 32px; background: #f9fafb;
      border: 1px solid #e5e7eb; border-radius: 12px;
      padding: 20px 24px;
    }
    .tips-box ul {
      margin-top: 10px; padding-left: 18px;
      display: flex; flex-direction: column; gap: 6px;
    }
    .tips-box li { line-height: 1.6; color: #6b7280; }
    
    .badge {
      display: inline-block;
      background: #eff6ff; color: var(--primary);
      font-size: 12px; font-weight: 600;
      padding: 4px 14px; border-radius: 100px;
      margin-bottom: 16px;
      border: 1px solid rgba(99,102,241,.2);
    }
    .new-badge {
      background: var(--primary); color: white;
      font-size: 9px; font-weight: 700;
      padding: 2px 6px; border-radius: 4px;
      vertical-align: middle; margin-left: 4px;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar (copied from welcome.blade.php, added NEW badge PHASE 9) -->
<header class="w-full shadow-sm navbar sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 flex justify-between items-center py-4">
    <div class="flex items-center">
      <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center mr-3">
        <i class="fas fa-signature text-white"></i>
      </div>
      <h1 class="text-2xl font-bold heading-font gradient-text">pdf</h1>
    </div>
    <nav class="space-x-8 hidden md:flex">
      <a href="/" class="hover:text-indigo-600 font-medium transition-colors">Home</a>
      <a href="/#how-it-works" class="hover:text-indigo-600 font-medium transition-colors">How It Works</a>
      <a href="/#features" class="hover:text-indigo-600 font-medium transition-colors">Features</a>
      <a href="/#uploadSection" class="hover:text-indigo-600 font-medium transition-colors">Sign PDF</a>
      <a href="/#footer" class="hover:text-indigo-600 font-medium transition-colors">Contact</a>
    </nav>
    <button class="md:hidden text-gray-600">
      <i class="fas fa-bars text-xl"></i>
    </button>
  </div>
</header>

<!-- Hero (PHASE 4) -->
<section class="relative overflow-hidden gradient-bg text-white py-24 px-6">
  <div class="floating-shape floating-shape-1"></div>
  <div class="floating-shape floating-shape-2"></div>
  <div class="max-w-4xl mx-auto text-center relative z-10 fade-in">
    <div class="badge">New Tool</div>
    <h1 class="text-5xl md:text-6xl font-bold mb-6 heading-font">PDF to Word Converter</h1>
    <p class="max-w-2xl mx-auto text-xl mb-10 opacity-90">Convert any PDF into an editable Word document. Free, instant, and private — your file never leaves your browser.</p>
  </div>
</section>

<!-- Step indicator (PHASE 4) -->
<div class="step-bar">
  <div class="step-item active" id="step1-label">
    <span class="step-dot">1</span> Upload PDF
  </div>
  <div class="step-sep">→</div>
  <div class="step-item" id="step2-label">
    <span class="step-dot">2</span> Converting
  </div>
  <div class="step-sep">→</div>
  <div class="step-item" id="step3-label">
    <span class="step-dot">3</span> Download
  </div>
</div>

<!-- Converter Section (PHASE 4) -->
<section class="py-16 px-6 flex flex-col items-center">
  <div class="max-w-2xl w-full">
    
    <!-- STATE 1: Upload -->
    <div id="state-upload">
      <div class="upload-zone" id="drop-zone">
        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" class="mx-auto mb-4">
          <rect width="48" height="48" rx="12" fill="#EFF6FF"/>
          <path d="M24 32V18M18 24l6-6 6 6" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M16 34h16" stroke="var(--primary)" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <p class="upload-title">Drag & drop your PDF here</p>
        <p class="upload-sub">or <label for="pdf-input" class="browse-link">click to browse</label></p>
        <p class="upload-hint">PDF files only · Max 20MB</p>
        <input type="file" id="pdf-input" accept=".pdf,application/pdf" class="hidden">
      </div>

      <!-- File selected card -->
      <div id="file-card" class="hidden file-card">
        <div class="file-card-left">
          <div class="file-icon">PDF</div>
          <div>
            <div id="file-name" class="file-name">document.pdf</div>
            <div id="file-size" class="file-size">0 KB</div>
          </div>
        </div>
        <button id="remove-file" class="remove-btn" title="Remove file">✕</button>
      </div>

      <button id="convert-btn" class="main-btn" disabled>Convert to Word</button>
    </div>

    <!-- STATE 2: Processing -->
    <div id="state-processing" class="hidden text-center py-20">
      <div class="spinner"></div>
      <p class="text-lg font-semibold text-gray-800 mt-6">Converting your PDF…</p>
      <p class="text-sm text-gray-500 mt-2">This usually takes a few seconds.</p>
    </div>

    <!-- STATE 3: Success -->
    <div id="state-success" class="hidden text-center py-20">
      <div class="success-check">✓</div>
      <h2 class="text-2xl font-bold mt-4">Your file is ready!</h2>
      <p class="text-gray-600 mt-2 mb-8">Your Word document has been created successfully.</p>
      <button id="download-btn" class="main-btn" style="max-width:240px; margin: 0 auto 20px;">⬇ Download .docx</button>
      <a href="/pdf-to-word" class="text-sm text-gray-500 hover:text-gray-700 font-medium">← Convert another file</a>
    </div>

    <!-- STATE 4: Error -->
    <div id="state-error" class="hidden error-box">
      <strong>⚠ Conversion failed</strong>
      <p id="error-msg" class="mt-2 text-sm">Something went wrong. Please try again.</p>
      <button id="retry-btn" class="main-btn" style="background: #dc2626; max-width:180px; margin: 16px auto 0; display: block;">Try Again</button>
    </div>

    <!-- Tips (PHASE 7) -->
    <div class="tips-box">
      <strong>💡 Tips for best results</strong>
      <ul>
        <li>Works best on text-based PDFs (not scanned images)</li>
        <li>Scanned PDFs may have formatting differences</li>
        <li>Password-protected PDFs cannot be converted</li>
        <li>Your file is processed entirely in your browser</li>
      </ul>
    </div>

    <!-- Privacy note (PHASE 7) -->
    <p class="text-center text-xs text-gray-500 mt-12 py-8 border-t">
      🔒 Your file is processed entirely in your browser. Nothing is uploaded to any server.
    </p>
  </div>
</section>

<!-- Footer (copied from welcome.blade.php) -->
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
        <li><a href="/" class="hover:text-indigo-400 transition-colors">Home</a></li>
        <li><a href="/#how-it-works" class="hover:text-indigo-400 transition-colors">How It Works</a></li>
        <li><a href="/#features" class="hover:text-indigo-400 transition-colors">Features</a></li>
        <li><a href="/pdf-to-word" class="hover:text-indigo-400 transition-colors">PDF to Word</a></li>
        <li><a href="/#uploadSection" class="hover:text-indigo-400 transition-colors">Sign PDF</a></li>
        <li><a href="/#footer" class="hover:text-indigo-400 transition-colors">Contact</a></li>
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

<!-- PHASE 6 JavaScript -->
<script>
  // PDF.js worker
  pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

  let selectedFile = null;
  let outputBlob = null;

  const dropZone = document.getElementById('drop-zone');
  const fileInput = document.getElementById('pdf-input');
  const convertBtn = document.getElementById('convert-btn');
  const fileCard = document.getElementById('file-card');
  const fileNameEl = document.getElementById('file-name');
  const fileSizeEl = document.getElementById('file-size');

  // Drag & drop
  dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('dragover'); });
  dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
  dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.classList.remove('dragover');
    const f = e.dataTransfer.files[0];
    if (f) handleFile(f);
  });
  dropZone.addEventListener('click', () => fileInput.click());
  fileInput.addEventListener('change', e => { if (e.target.files[0]) handleFile(e.target.files[0]); });
  document.getElementById('remove-file').addEventListener('click', clearFile);

  function handleFile(file) {
    if (!file.type.includes('pdf') && !file.name.toLowerCase().endsWith('.pdf')) {
      showError('Please upload a PDF file.'); return;
    }
    if (file.size > 20 * 1024 * 1024) {
      showError('File is too large. Maximum size is 20MB.'); return;
    }
    selectedFile = file;
    fileNameEl.textContent = file.name;
    fileSizeEl.textContent = formatBytes(file.size);
    fileCard.classList.remove('hidden');
    convertBtn.disabled = false;
  }

  function clearFile() {
    selectedFile = null;
    fileCard.classList.add('hidden');
    convertBtn.disabled = true;
    fileInput.value = '';
  }

  function formatBytes(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / 1048576).toFixed(1) + ' MB';
  }

  // State management
  function setState(state) {
    document.querySelectorAll('[id^="state-"]').forEach(el => el.classList.add('hidden'));
    document.getElementById('state-' + state).classList.remove('hidden');
    
    // Update step bar
    const steps = ['step1-label', 'step2-label', 'step3-label'];
    const stateMap = { upload: 0, processing: 1, success: 2, error: 0 };
    steps.forEach((id, i) => {
      const el = document.getElementById(id);
      el.classList.remove('active');
      if (i === stateMap[state]) el.classList.add('active');
    });
  }

  function showError(msg) {
    document.getElementById('error-msg').textContent = msg;
    setState('error');
  }

  document.getElementById('retry-btn').onclick = () => setState('upload');

  // Conversion
  convertBtn.addEventListener('click', convertPdf);

  async function convertPdf() {
    if (!selectedFile) return;
    setState('processing');

    try {
      const arrayBuffer = await selectedFile.arrayBuffer();
      const pdfDoc = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
      const numPages = pdfDoc.numPages;
      const allParagraphs = [];

      for (let pageNum = 1; pageNum <= numPages; pageNum++) {
        const page = await pdfDoc.getPage(pageNum);
        const textContent = await page.getTextContent();

        // Group by Y position
        const lines = {};
        textContent.items.forEach(item => {
          const y = Math.round(item.transform[5]);
          if (!lines[y]) lines[y] = [];
          lines[y].push(item.str);
        });

        // Sort top-to-bottom
        const sortedYs = Object.keys(lines).map(Number).sort((a, b) => b - a);
        sortedYs.forEach(y => {
          const lineText = lines[y].join(' ').trim();
          if (lineText) {
            allParagraphs.push(new docx.Paragraph({
              children: [new docx.TextRun({ text: lineText, size: 24 })],
              spacing: { after: 120 },
            }));
          }
        });

        if (pageNum < numPages) {
          allParagraphs.push(new docx.Paragraph({ pageBreakBefore: true }));
        }
      }

      const doc = new docx.Document({
        sections: [{
          properties: {},
          children: allParagraphs.length > 0 ? allParagraphs : [
            new docx.Paragraph({
              children: [new docx.TextRun({
                text: 'No text content could be extracted from this PDF. It may be a scanned document.',
                size: 24
              })]
            })
          ]
        }]
      });

      outputBlob = await docx.Packer.toBlob(doc);
      setState('success');
      document.getElementById('download-btn').onclick = () => {
        const outName = selectedFile.name.replace(/\.pdf$/i, '') + '.docx';
        saveAs(outputBlob, outName);
      };

    } catch (err) {
      console.error(err);
      showError(err.message.includes('password') 
        ? 'Password-protected PDF detected. Remove password first.' 
        : 'Conversion failed. PDF may be image-only or corrupted.');
    }
  }
</script>
</body>
</html>
