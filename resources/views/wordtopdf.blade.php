<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Word to PDF — Free & Instant</title>
  <meta name="description" content="Convert Word (.docx) to PDF free online. No upload, no sign-up. Processed entirely in your browser.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.6.0/mammoth.browser.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --ink: #0f1117;
      --ink-mid: #2d3142;
      --ink-soft: #5a607a;
      --paper: #f7f5f0;
      --paper-mid: #e8e3d8;
      --gold: #c8963e;
      --gold-light: #e8b86d;
      --gold-pale: #fdf4e3;
      --white: #ffffff;
      --danger: #d94f4f;
      --success: #3a9e6f;
      --blue: #2563eb;
      --radius: 14px;
      --shadow-card: 0 2px 24px rgba(15,17,23,0.08), 0 1px 4px rgba(15,17,23,0.05);
      --shadow-lg: 0 8px 48px rgba(15,17,23,0.13), 0 2px 12px rgba(15,17,23,0.07);
      --t: 220ms cubic-bezier(0.4,0,0.2,1);
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--paper);
      color: var(--ink);
      min-height: 100vh;
    }

    /* ── NAV ── */
    nav {
      position: sticky; top: 0; z-index: 100;
      background: var(--white);
      border-bottom: 1px solid var(--paper-mid);
      padding: 0 32px;
      height: 62px;
      display: flex; align-items: center; justify-content: space-between;
      box-shadow: 0 1px 8px rgba(15,17,23,0.05);
    }
    .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; color: var(--ink); }
    .nav-logo {
      width: 33px; height: 33px;
      background: linear-gradient(135deg, var(--gold), var(--gold-light));
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 14px;
    }
    .nav-wordmark { font-family: 'DM Serif Display', serif; font-size: 1.2rem; letter-spacing: -0.02em; }
    .nav-links { display: flex; gap: 4px; }
    .nav-link {
      text-decoration: none; color: var(--ink-soft); font-size: 0.85rem; font-weight: 500;
      padding: 6px 13px; border-radius: 8px; transition: var(--t);
    }
    .nav-link:hover { background: var(--paper); color: var(--ink); }
    .nav-link.active { background: var(--gold-pale); color: var(--gold); }

    /* ── HERO ── */
    .hero {
      background: var(--ink); color: var(--white);
      padding: 76px 24px 68px; text-align: center;
      position: relative; overflow: hidden;
    }
    .hero::before {
      content: ''; position: absolute; inset: 0; pointer-events: none;
      background:
        radial-gradient(ellipse 65% 55% at 18% 55%, rgba(200,150,62,0.20) 0%, transparent 65%),
        radial-gradient(ellipse 55% 75% at 82% 25%, rgba(200,150,62,0.12) 0%, transparent 60%);
    }
    .hero-grid {
      position: absolute; inset: 0; pointer-events: none;
      background-image: linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
      background-size: 48px 48px;
    }
    .hero-inner { position: relative; }
    .hero-badge {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(200,150,62,0.15); border: 1px solid rgba(200,150,62,0.3);
      color: var(--gold-light);
      font-size: 0.74rem; font-weight: 600; letter-spacing: 0.09em; text-transform: uppercase;
      padding: 5px 14px; border-radius: 100px; margin-bottom: 26px;
    }
    .hero h1 {
      font-family: 'DM Serif Display', serif;
      font-size: clamp(2.6rem, 5.5vw, 4.2rem);
      line-height: 1.08; letter-spacing: -0.03em;
      margin-bottom: 18px;
    }
    .hero h1 em { font-style: italic; color: var(--gold-light); }
    .hero-sub {
      font-size: 1rem; color: rgba(255,255,255,0.58);
      max-width: 500px; margin: 0 auto 32px;
      font-weight: 300; line-height: 1.68;
    }
    .hero-pills { display: flex; justify-content: center; flex-wrap: wrap; gap: 9px; }
    .pill {
      display: flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.11);
      color: rgba(255,255,255,0.7); font-size: 0.78rem;
      padding: 5px 13px; border-radius: 100px;
    }
    .pill i { color: var(--gold-light); font-size: 0.72rem; }

    /* ── MAIN ── */
    .main { max-width: 860px; margin: 0 auto; padding: 44px 22px 72px; }

    /* ── CARD ── */
    .card {
      background: var(--white); border-radius: var(--radius);
      box-shadow: var(--shadow-card); border: 1px solid var(--paper-mid);
    }

    /* ── ERROR BAR ── */
    .error-bar {
      display: none; align-items: center; gap: 12px;
      background: #fef2f2; border: 1px solid rgba(217,79,79,0.22);
      border-radius: var(--radius); padding: 14px 18px;
      color: var(--danger); font-size: 0.875rem; margin-bottom: 14px;
    }
    .error-bar.show { display: flex; }
    .error-bar i { font-size: 1rem; flex-shrink: 0; }
    .error-close { margin-left: auto; background: none; border: none; cursor: pointer; color: var(--danger); padding: 4px; border-radius: 5px; }

    /* ── FILE INFO BAR ── */
    .file-info-bar {
      display: none; align-items: center; gap: 13px;
      background: var(--gold-pale); border: 1px solid rgba(200,150,62,0.22);
      border-radius: var(--radius); padding: 14px 18px; margin-bottom: 14px;
    }
    .file-info-bar.show { display: flex; }
    .file-ico {
      width: 42px; height: 42px; flex-shrink: 0;
      background: linear-gradient(135deg, var(--blue), #1d4ed8);
      border-radius: 10px; display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 1rem;
    }
    .file-details { flex: 1; min-width: 0; }
    .file-name { font-weight: 600; font-size: 0.88rem; color: var(--ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .file-meta { font-size: 0.76rem; color: var(--ink-soft); margin-top: 2px; }
    .btn-rm {
      background: none; border: none; cursor: pointer;
      color: var(--ink-soft); padding: 6px; border-radius: 7px;
      transition: var(--t); flex-shrink: 0;
    }
    .btn-rm:hover { background: rgba(217,79,79,0.1); color: var(--danger); }

    /* ── DROPZONE ── */
    .dropzone {
      border: 2px dashed var(--paper-mid); border-radius: var(--radius);
      padding: 52px 28px; text-align: center; cursor: pointer;
      transition: var(--t); background: var(--white); overflow: hidden;
    }
    .dropzone:hover, .dropzone.over {
      border-color: var(--gold); background: var(--gold-pale);
    }
    .dropzone.over { transform: scale(1.008); }
    .dz-icon-wrap {
      width: 78px; height: 78px;
      background: var(--paper); border-radius: 18px;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 20px; border: 1px solid var(--paper-mid);
      transition: var(--t);
    }
    .dropzone:hover .dz-icon-wrap { background: var(--gold-pale); border-color: var(--gold-light); }
    .dz-icon-wrap i { font-size: 1.9rem; color: var(--ink-soft); transition: var(--t); }
    .dropzone:hover .dz-icon-wrap i { color: var(--gold); }
    .dz-title { font-family: 'DM Serif Display', serif; font-size: 1.35rem; color: var(--ink); margin-bottom: 7px; }
    .dz-sub { font-size: 0.84rem; color: var(--ink-soft); margin-bottom: 22px; }
    .btn-browse {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--ink); color: #fff;
      font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 500;
      padding: 10px 22px; border-radius: 9px; border: none; cursor: pointer;
      transition: var(--t);
    }
    .btn-browse:hover { background: var(--gold); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(200,150,62,0.35); }
    .dz-formats { margin-top: 16px; font-size: 0.76rem; color: var(--ink-soft); display: flex; align-items: center; justify-content: center; gap: 6px; }
    .fmt { background: var(--paper); border: 1px solid var(--paper-mid); border-radius: 5px; padding: 2px 7px; font-weight: 600; font-size: 0.73rem; color: var(--ink-mid); }
    #fileInput { display: none; }

    /* ── OPTIONS PANEL ── */
    .options-panel {
      display: none; background: var(--paper); border: 1px solid var(--paper-mid);
      border-radius: var(--radius); padding: 18px; margin-bottom: 14px;
      grid-template-columns: 1fr 1fr; gap: 18px;
    }
    .options-panel.show { display: grid; }
    @media (max-width: 480px) { .options-panel.show { grid-template-columns: 1fr; } }
    .opt label { display: block; font-size: 0.75rem; font-weight: 600; color: var(--ink-soft); text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 7px; }
    .opt select {
      width: 100%; font-family: 'DM Sans', sans-serif; font-size: 0.84rem;
      color: var(--ink); background: var(--white);
      border: 1px solid var(--paper-mid); border-radius: 8px;
      padding: 8px 11px; outline: none; cursor: pointer; transition: var(--t);
    }
    .opt select:focus { border-color: var(--gold); }

    /* ── ACTION ROW ── */
    .action-row { display: none; gap: 11px; margin-bottom: 18px; }
    .action-row.show { display: flex; }
    .btn-convert {
      flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 9px;
      background: linear-gradient(135deg, var(--gold), #b8823a); color: #fff;
      font-family: 'DM Sans', sans-serif; font-size: 0.93rem; font-weight: 600;
      padding: 14px 26px; border-radius: 10px; border: none; cursor: pointer;
      transition: var(--t); box-shadow: 0 4px 16px rgba(200,150,62,0.28);
    }
    .btn-convert:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 8px 26px rgba(200,150,62,0.42); }
    .btn-convert:disabled { opacity: 0.52; cursor: not-allowed; transform: none; }
    .btn-opts {
      display: inline-flex; align-items: center; justify-content: center; gap: 7px;
      background: var(--white); color: var(--ink-mid);
      font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 500;
      padding: 14px 18px; border-radius: 10px; border: 1px solid var(--paper-mid);
      cursor: pointer; transition: var(--t);
    }
    .btn-opts:hover { background: var(--paper); border-color: var(--ink-soft); }

    /* ── PROGRESS ── */
    .progress-wrap { display: none; margin-bottom: 18px; }
    .progress-wrap.show { display: block; }
    .prog-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 9px; }
    .prog-label { font-size: 0.83rem; font-weight: 500; color: var(--ink-mid); display: flex; align-items: center; gap: 8px; }
    .prog-pct { font-size: 0.78rem; color: var(--ink-soft); }
    .prog-track { height: 5px; background: var(--paper); border-radius: 100px; overflow: hidden; }
    .prog-fill { height: 100%; background: linear-gradient(90deg, var(--gold), var(--gold-light)); width: 0%; transition: width 280ms ease; border-radius: 100px; }
    .prog-steps { display: flex; flex-wrap: wrap; gap: 7px; margin-top: 11px; }
    .step {
      display: flex; align-items: center; gap: 5px;
      font-size: 0.73rem; padding: 4px 10px; border-radius: 100px;
      background: var(--paper); color: var(--ink-soft); border: 1px solid transparent;
      transition: var(--t);
    }
    .step i { font-size: 0.68rem; }
    .step.active { background: var(--gold-pale); color: var(--gold); border-color: rgba(200,150,62,0.28); }
    .step.done { background: #ecfdf5; color: var(--success); border-color: rgba(58,158,111,0.22); }

    /* ── SUCCESS ── */
    .success-wrap {
      display: none; text-align: center;
      padding: 36px 28px;
      background: linear-gradient(145deg, #ecfdf5, #f0fdf4);
      border: 1px solid rgba(58,158,111,0.18);
      border-radius: var(--radius); margin-bottom: 18px;
    }
    .success-wrap.show { display: block; animation: fadeSlide 0.4s ease; }
    @keyframes fadeSlide { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .success-ico {
      width: 68px; height: 68px; border-radius: 50%;
      background: linear-gradient(135deg, var(--success), #2d8a5e);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 18px; color: #fff; font-size: 1.7rem;
      box-shadow: 0 8px 22px rgba(58,158,111,0.32);
      animation: pop 0.4s cubic-bezier(0.34,1.56,0.64,1);
    }
    @keyframes pop { from { transform: scale(0.4); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .success-title { font-family: 'DM Serif Display', serif; font-size: 1.55rem; color: var(--ink); margin-bottom: 7px; }
    .success-meta { font-size: 0.83rem; color: var(--ink-soft); margin-bottom: 22px; }
    .btn-dl {
      display: inline-flex; align-items: center; gap: 9px;
      background: linear-gradient(135deg, var(--success), #2d8a5e); color: #fff;
      font-family: 'DM Sans', sans-serif; font-size: 0.92rem; font-weight: 600;
      padding: 13px 30px; border-radius: 10px; border: none; cursor: pointer;
      transition: var(--t); box-shadow: 0 4px 15px rgba(58,158,111,0.32);
      text-decoration: none;
    }
    .btn-dl:hover { transform: translateY(-2px); box-shadow: 0 8px 26px rgba(58,158,111,0.42); }
    .btn-reset { background: none; border: none; font-size: 0.8rem; color: var(--ink-soft); cursor: pointer; font-family: 'DM Sans', sans-serif; margin-top: 14px; display: block; margin-left: auto; margin-right: auto; transition: var(--t); }
    .btn-reset:hover { color: var(--ink); }

    /* ── PREVIEW ── */
    .preview-section { display: none; margin-top: 18px; }
    .preview-section.show { display: block; }
    .preview-head {
      display: flex; align-items: center; justify-content: space-between;
      padding: 16px 20px; border-bottom: 1px solid var(--paper-mid);
    }
    .preview-ttl { font-weight: 600; font-size: 0.88rem; color: var(--ink); display: flex; align-items: center; gap: 8px; }
    .preview-ttl i { color: var(--gold); }
    .preview-badge { font-size: 0.74rem; background: var(--paper); border: 1px solid var(--paper-mid); border-radius: 100px; padding: 3px 10px; color: var(--ink-soft); }
    .preview-body {
      padding: 22px; max-height: 500px; overflow-y: auto; background: #f9f8f5;
    }
    .preview-body::-webkit-scrollbar { width: 5px; }
    .preview-body::-webkit-scrollbar-thumb { background: var(--paper-mid); border-radius: 100px; }
    #docPreview {
      font-family: 'DM Sans', sans-serif; font-size: 0.86rem; line-height: 1.8;
      color: var(--ink-mid); background: var(--white); border-radius: 9px;
      padding: 28px 32px; box-shadow: var(--shadow-card); min-height: 160px;
    }
    #docPreview h1 { font-family: 'DM Serif Display', serif; font-size: 1.75em; margin-bottom: 0.45em; color: var(--ink); }
    #docPreview h2 { font-family: 'DM Serif Display', serif; font-size: 1.35em; margin: 0.9em 0 0.35em; color: var(--ink); }
    #docPreview h3 { font-size: 1.1em; font-weight: 600; margin: 0.8em 0 0.3em; color: var(--ink); }
    #docPreview p { margin-bottom: 0.8em; }
    #docPreview ul, #docPreview ol { padding-left: 1.5em; margin-bottom: 0.8em; }
    #docPreview li { margin-bottom: 0.25em; }
    #docPreview table { width: 100%; border-collapse: collapse; margin-bottom: 1em; font-size: 0.87em; }
    #docPreview th, #docPreview td { border: 1px solid var(--paper-mid); padding: 7px 11px; text-align: left; }
    #docPreview th { background: var(--paper); font-weight: 600; }
    #docPreview img { max-width: 100%; border-radius: 5px; margin: 6px 0; }
    #docPreview strong, #docPreview b { font-weight: 600; color: var(--ink); }
    #docPreview blockquote { border-left: 3px solid var(--gold-light); padding-left: 14px; color: var(--ink-soft); margin: 10px 0; }
    #docPreview a { color: var(--gold); }

    /* ── FEATURES ── */
    .features { display: flex; gap: 14px; flex-wrap: wrap; margin-top: 36px; }
    .feat {
      flex: 1; min-width: 170px;
      background: var(--white); border: 1px solid var(--paper-mid);
      border-radius: var(--radius); padding: 22px 18px;
      transition: var(--t);
    }
    .feat:hover { box-shadow: var(--shadow-card); transform: translateY(-2px); }
    .feat-ico {
      width: 40px; height: 40px; background: var(--gold-pale); border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      color: var(--gold); font-size: 1rem; margin-bottom: 13px;
    }
    .feat-title { font-weight: 600; font-size: 0.84rem; color: var(--ink); margin-bottom: 4px; }
    .feat-desc { font-size: 0.77rem; color: var(--ink-soft); line-height: 1.52; }

    /* ── SPINNER ── */
    .spin { width: 15px; height: 15px; border: 2px solid rgba(255,255,255,0.3); border-top-color: #fff; border-radius: 50%; animation: rot 0.65s linear infinite; display: none; }
    .spin.show { display: block; }
    @keyframes rot { to { transform: rotate(360deg); } }

    /* ── FOOTER ── */
    footer { border-top: 1px solid var(--paper-mid); padding: 26px 28px; text-align: center; font-size: 0.78rem; color: var(--ink-soft); background: var(--white); }
    footer a { color: var(--gold); text-decoration: none; }
    footer a:hover { text-decoration: underline; }

    @media (max-width: 600px) {
      .hero { padding: 52px 18px 48px; }
      nav { padding: 0 14px; }
      .nav-links { display: none; }
      .action-row { flex-direction: column; }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  <nav>
    <a href="#" class="nav-brand">
      <div class="nav-logo"><i class="fa-solid fa-file-pdf"></i></div>
      <span class="nav-wordmark">pdf<span style="color:var(--gold)">.</span></span>
    </a>
    <div class="nav-links">
      <a href="#" class="nav-link">PDF to Word</a>
      <a href="#" class="nav-link active">Word to PDF</a>
      <a href="#" class="nav-link">Compress</a>
      <a href="#" class="nav-link">Merge</a>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-grid"></div>
    <div class="hero-inner">
      <div class="hero-badge"><i class="fa-solid fa-lock" style="font-size:0.68rem"></i>100% Private — In-Browser</div>
      <h1>Word to <em>PDF</em></h1>
      <p class="hero-sub">Convert .docx documents to PDF right in your browser. No uploads, no accounts, no watermarks.</p>
      <div class="hero-pills">
        <div class="pill"><i class="fa-solid fa-bolt"></i> Instant</div>
        <div class="pill"><i class="fa-solid fa-shield-halved"></i> Private</div>
        <div class="pill"><i class="fa-solid fa-table"></i> Tables & Images</div>
        <div class="pill"><i class="fa-solid fa-infinity"></i> Free forever</div>
      </div>
    </div>
  </section>

  <!-- MAIN -->
  <main class="main">

    <!-- Error -->
    <div class="error-bar" id="errorBar">
      <i class="fa-solid fa-circle-exclamation"></i>
      <span id="errorMsg">Something went wrong.</span>
      <button class="error-close" onclick="clearErr()"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <!-- File info bar -->
    <div class="file-info-bar" id="fileBar">
      <div class="file-ico"><i class="fa-brands fa-microsoft"></i></div>
      <div class="file-details">
        <div class="file-name" id="fName">document.docx</div>
        <div class="file-meta" id="fMeta">—</div>
      </div>
      <button class="btn-rm" o
