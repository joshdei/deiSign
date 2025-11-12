<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>deiSign — Sign PDFs Instantly</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
    .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .btn-primary { background-color: #4f46e5; color: white; }
    .btn-primary:hover { background-color: #4338ca; }
    .btn-secondary { background-color: #10b981; color: white; }
    .btn-secondary:hover { background-color: #059669; }
    .pdf-viewer canvas { margin-bottom: 20px; border-radius: 8px; }
    .signature-pad-container { background-color: #f9fafb; border: 1px dashed #cbd5e0; border-radius: 8px; }
    .signature-pad-container canvas { background-color: transparent; }
    .step-card { background: white; border-radius: 12px; padding: 24px; text-align: center; box-shadow: 0 8px 24px rgba(0,0,0,0.05); transition: transform 0.3s; }
    .step-card:hover { transform: translateY(-5px); }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<header class="w-full shadow bg-white sticky top-0 z-50">
  <div class="max-w-6xl mx-auto px-6 flex justify-between items-center py-4">
    <h1 class="text-2xl font-bold text-indigo-600">deiSign</h1>
    <nav class="space-x-6 hidden md:flex">
      <a href="#how-it-works" class="hover:text-indigo-600">How It Works</a>
      <a href="#uploadSection" class="hover:text-indigo-600">Sign PDF</a>
      <a href="#footer" class="hover:text-indigo-600">Contact</a>
    </nav>
  </div>
</header>

<!-- Hero Section -->
<section class="gradient-bg text-white text-center py-24 px-6">
  <h1 class="text-5xl font-bold mb-4">Sign PDFs Instantly, Anywhere</h1>
  <p class="max-w-2xl mx-auto text-lg mb-8">Upload, sign, share, and download your PDF documents without printing or scanning.</p>
  <a href="#uploadSection" class="btn-primary px-8 py-3 rounded-lg text-lg shadow-lg">Get Started</a>
</section>

<!-- Steps Section -->
<section id="how-it-works" class="py-20 px-6 bg-gray-50">
  <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>
  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    <div class="step-card">
      <h3 class="text-xl font-semibold mb-2">Step 1: Upload</h3>
      <p>Select the PDF you want to sign from your device.</p>
    </div>
    <div class="step-card">
      <h3 class="text-xl font-semibold mb-2">Step 2: Sign</h3>
      <p>Click on the PDF to draw your signature at the desired position.</p>
    </div>
    <div class="step-card">
      <h3 class="text-xl font-semibold mb-2">Step 3: Download & Share</h3>
      <p>Download your signed PDF or generate a shareable link to send to others.</p>
    </div>
  </div>
</section>

<!-- Upload Section -->
<section id="uploadSection" class="py-16 px-6 flex flex-col items-center">
  <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md w-full text-center">
    <h2 class="text-2xl font-bold mb-4">Upload Your PDF</h2>
    <p class="text-gray-500 mb-6">Upload a document you’d like to sign.</p>
    <input id="fileInput" type="file" accept="application/pdf"
           class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer mb-6 p-2" />
    <button id="uploadBtn" class="btn-primary w-full py-3 rounded-lg text-lg">Continue</button>
  </div>
</section>

<!-- PDF Viewer Section -->
<section id="viewerSection" class="hidden flex flex-col items-center w-full py-10 px-6">
  <div id="pdfContainer" class="pdf-viewer border rounded-lg bg-white shadow w-full max-w-4xl h-[80vh] overflow-y-auto p-4"></div>
  <div class="flex flex-col sm:flex-row gap-4 mt-6">
    <button id="downloadBtn" class="btn-secondary px-8 py-3 rounded-lg text-lg">Download</button>
    <button id="shareBtn" class="bg-indigo-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-indigo-700">Share</button>
    <button id="backBtn" class="bg-gray-500 text-white px-8 py-3 rounded-lg text-lg hover:bg-gray-600">Back</button>
  </div>
</section>

<!-- Signature Modal -->
<div id="signatureModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-full">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 text-center">Draw Your Signature</h2>
    <div class="signature-pad-container mb-4">
      <canvas id="signaturePad" class="w-full h-48 rounded"></canvas>
    </div>
    <div class="flex justify-between">
      <button id="clearSig" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Clear</button>
      <div>
        <button id="cancelSig" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 mr-2">Cancel</button>
        <button id="saveSig" class="btn-primary px-4 py-2 rounded">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Share Modal -->
<div id="shareModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-full">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 text-center">Share Your Signed PDF</h2>
    <p class="text-gray-600 mb-4 text-center">Choose how you want to share:</p>
    <div class="flex flex-col gap-4">
      <button id="shareWhatsapp" class="bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">Share via WhatsApp</button>
      <button id="shareEmail" class="bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Share via Email</button>
      <div id="emailInputContainer" class="hidden flex flex-col gap-2">
        <input id="recipientEmail" type="email" placeholder="Enter recipient email"
               class="border border-gray-300 rounded-lg p-2 w-full" />
        <button id="sendEmailBtn" class="bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Send Email</button>
      </div>
      <button id="closeShareModal" class="bg-gray-400 text-white py-2 rounded-lg hover:bg-gray-500">Cancel</button>
    </div>
  </div>
</div>

<!-- Footer -->
<footer id="footer" class="bg-gray-800 text-white py-12 mt-16">
  <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8">
    <div>
      <h3 class="font-bold text-xl mb-4">deiSign</h3>
      <p>Sign PDFs online instantly. Share, download, and manage your documents efficiently.</p>
    </div>
    <div>
      <h3 class="font-semibold mb-4">Links</h3>
      <ul>
        <li><a href="#how-it-works" class="hover:text-indigo-400">How It Works</a></li>
        <li><a href="#uploadSection" class="hover:text-indigo-400">Sign PDF</a></li>
        <li><a href="#footer" class="hover:text-indigo-400">Contact</a></li>
      </ul>
    </div>
    <div>
      <h3 class="font-semibold mb-4">Contact</h3>
      <p>Email: support@deisign.com</p>
      <p>Phone: +234 800 123 4567</p>
    </div>
  </div>
  <p class="text-center mt-8 text-gray-400">&copy; 2025 deiSign. All rights reserved.</p>
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

  const signatureModal = document.getElementById("signatureModal");
  const signaturePadCanvas = document.getElementById("signaturePad");
  let signaturePad, pdfBytes, clickPosition, clickPage;

  const shareModal = document.getElementById("shareModal");
  const shareWhatsapp = document.getElementById("shareWhatsapp");
  const shareEmail = document.getElementById("shareEmail");
  const closeShareModal = document.getElementById("closeShareModal");
  const emailInputContainer = document.getElementById("emailInputContainer");
  const recipientEmail = document.getElementById("recipientEmail");
  const sendEmailBtn = document.getElementById("sendEmailBtn");

  // Upload PDF
  uploadBtn.addEventListener("click", async () => {
    const file = fileInput.files[0];
    if (!file) return alert("Please select a PDF file");
    const reader = new FileReader();
    reader.onload = async (e) => {
      pdfBytes = new Uint8Array(e.target.result);
      await renderAllPages();
      uploadSection.classList.add("hidden");
      viewerSection.classList.remove("hidden");
      window.scrollTo({ top: 0, behavior: 'smooth' });
    };
    reader.readAsArrayBuffer(file);
  });

  backBtn.addEventListener("click", () => {
    viewerSection.classList.add("hidden");
    uploadSection.classList.remove("hidden");
  });

  async function renderAllPages() {
    pdfContainer.innerHTML = "";
    const pdfDoc = await pdfjsLib.getDocument({ data: pdfBytes }).promise;
    for (let i = 1; i <= pdfDoc.numPages; i++) {
      const page = await pdfDoc.getPage(i);
      const viewport = page.getViewport({ scale: 1.4 });
      const canvas = document.createElement("canvas");
      canvas.width = viewport.width;
      canvas.height = viewport.height;
      canvas.classList.add("cursor-crosshair", "border", "shadow-sm");
      await page.render({ canvasContext: canvas.getContext("2d"), viewport }).promise;
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
    signaturePad = new SignaturePad(signaturePadCanvas, { backgroundColor: 'rgba(0,0,0,0)', penColor: '#2563eb' });
  }

  document.getElementById("clearSig").addEventListener("click", () => signaturePad.clear());
  document.getElementById("cancelSig").addEventListener("click", () => { signatureModal.classList.add("hidden"); signaturePad.clear(); });

  document.getElementById("saveSig").addEventListener("click", async () => {
    if (signaturePad.isEmpty()) return alert("Please draw your signature first.");
    const sigDataURL = signaturePad.toDataURL("image/png");
    signatureModal.classList.add("hidden");
    await embedSignature(sigDataURL);
    await renderAllPages();
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
    page.drawImage(pngImage, { x: clickPosition.x * scaleX - sigWidth / 2, y: height - clickPosition.y * scaleY - sigHeight / 2, width: sigWidth, height: sigHeight });
    pdfBytes = await pdfDocLib.save();
  }

  downloadBtn.addEventListener("click", () => {
    const blob = new Blob([pdfBytes], { type: "application/pdf" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "signed_document.pdf";
    link.click();
  });

  // Share Modal
  shareBtn.addEventListener("click", () => shareModal.classList.remove("hidden"));
  closeShareModal.addEventListener("click", () => { shareModal.classList.add("hidden"); emailInputContainer.classList.add("hidden"); recipientEmail.value=""; });

  shareWhatsapp.addEventListener("click", () => {
    const base64 = btoa(String.fromCharCode(...pdfBytes));
    const shareUrl = `${window.location.origin}${window.location.pathname}?pdf=${base64}`;
    window.open(`https://wa.me/?text=${encodeURIComponent("Check out this signed PDF: "+shareUrl)}`, "_blank");
  });

  shareEmail.addEventListener("click", () => emailInputContainer.classList.remove("hidden"));

  sendEmailBtn.addEventListener("click", () => {
    const email = recipientEmail.value.trim();
    if(!email) return alert("Enter a valid email");
    const base64 = btoa(String.fromCharCode(...pdfBytes));
    const shareUrl = `${window.location.origin}${window.location.pathname}?pdf=${base64}`;
    window.location.href = `mailto:${email}?subject=${encodeURIComponent("Signed PDF Document")}&body=${encodeURIComponent("Hi,\n\nCheck out this signed PDF: "+shareUrl+"\n\nBest regards.")}`;
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
