<style>
    :root {
        --bs-primary: #b9da05;
        --bs-dark-bg: #00071c;
        --bs-card-bg: #011538;
        --bs-text-light: #d1d5db;
        --bs-text-heading: #ffffff;
        --size: 20px;
    }

    /* General Body and Font Styles */
    body {
        font-family: 'Segoe UI', 'Segoe UI Web', 'Segoe UI Symbol', 'Helvetica Neue', 'Arial', sans-serif;
        background-color: var(--bs-dark-bg);
        color: var(--bs-text-light);
        scroll-behavior: smooth;
    }

    h1, h2, h3, h4 {
        font-family: 'Bakbak One', sans-serif;
    }

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        width: 8px;
        background-color: #1e293b;
    }
    ::-webkit-scrollbar-thumb {
        background-color: var(--bs-primary);
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background-color: #d1d5db;
    }

    /* Full-page background effect from index.html */
    .el {
        background: conic-gradient(from 180deg at 50% 70%,hsla(0,0%,98%,1) 0deg,#b9da05 72.0000010728836deg,#0051ff 144.0000021457672deg,#0095ff 216.00000858306885deg,#b9da05 288.0000042915344deg,hsla(0,0%,98%,1) 1turn);
        width: 100%;
        height: 100%;
        mask: radial-gradient(circle at 50% 50%, white 2px, transparent 2.5px) 50% 50% / var(--size) var(--size), url("https://assets.codepen.io/605876/noise-mask.png") 256px 50% / 256px 256px;
        mask-composite: intersect;
        animation: flicker 20s infinite linear;
        position: fixed;
        top: 0;
        left: 0;
        z-index: -1;
    }
    @keyframes flicker {
        to { mask-position: 50% 50%, 0 50%; }
    }
    
    /* Interactive header styles */
    #main-header {
        background-color: rgba(0, 7, 28, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        transition: all 0.3s ease-in-out;
    }
    #main-header.header-scrolled {
        background-color: var(--bs-dark-bg);
        box-shadow: 0 4px 6px -1-px rgba(0, 0, 0, 0.4);
    }
    .nav-link {
        color: var(--bs-text-light);
        transition: color 0.3s;
    }
    .nav-link:hover {
        color: var(--bs-primary);
    }

    /* Mobile menu specific styles */
    #mobile-menu {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 7, 28, 0.8);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        transition: transform 0.3s ease-in-out;
        transform: translateY(-100%);
        z-index: 40;
        padding-top: 6rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #mobile-menu.active {
        transform: translateY(0);
    }
    .mobile-nav-links {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        width: 100%;
        max-width: 300px;
    }

    /* Content card styling */
    .content-card {
        background-color: var(--bs-card-bg);
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid var(--bs-primary);
    }
    .content-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(185, 218, 5, 0.2);
    }

    .section-title {
        font-family: 'Bakbak One', sans-serif;
        color: var(--bs-text-heading);
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2.5rem;
    }

    .card-title {
        font-family: 'Bakbak One', sans-serif;
        color: var(--bs-primary);
        font-size: 1.75rem;
        margin-bottom: 0.75rem;
    }
    
    .icon-style {
        font-size: 2.5rem;
        color: var(--bs-primary);
        margin-bottom: 1rem;
    }

    /* Member list styling for committees */
    .member-list li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .member-list li:last-child {
        border-bottom: none;
    }
    .member-photo {
        width: 56px;
        height: 56px;
        border-radius: 9999px;
        margin-right: 1rem;
        object-fit: cover;
        border: 2px solid var(--bs-primary);
    }
    .member-name {
        font-weight: 600;
        color: var(--bs-text-heading);
    }
    .member-position {
        color: var(--bs-text-light);
        font-style: italic;
        font-size: 0.875rem;
    }

    /* shine effect for homepage */
    @keyframes shine {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    .shine-text {
        color: #b9da05;
        font-family: 'Bakbak One', sans-serif;
        background: linear-gradient(90deg, #b9da05 0%, #ffffff 50%, #b9da05 100%);
        background-size: 150% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s linear infinite;
    }
    #services h3 {
        font-family: 'Segoe UI', sans-serif !important;
        font-weight: 700;
    }
    .highlight-text {
        color: #b9da05;
        font-family: 'Segoe UI', sans-serif;
        font-weight: bold;
    }

    /* Modals for login and ads */
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 100;
    }
    .status-modal-content {
        background-color: #011538;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 90%;
        position: relative;
        text-align: center;
        border: 1px solid #b9da05;
    }
    .modal-close-button {
        position: absolute;
        top: 1rem;
        right: 1rem;
        cursor: pointer;
        color: #b9da05;
        font-size: 1.5rem;
        line-height: 1;
        transition: color 0.3s;
    }
    .modal-close-button:hover {
        color: white;
    }
    
    /* Ad modal styles */
    .ad-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        padding: 1rem;
    }
    #ad-modal-landscape-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        width: 160vh;
        height: 90vh;
        aspect-ratio: 16 / 9;
        background-color: transparent;
    }
    #ad-modal-portrait-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        width: 90vh;
        height: 160vh;
        aspect-ratio: 9 / 16;
        background-color: transparent;
    }
    .ad-modal-content img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }
    .ad-modal-close-button {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        border: 2px solid white;
        border-radius: 50%;
        color: white;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5rem;
        cursor: pointer;
        z-index: 1001;
    }

    /* Image protection */
    img {
        -webkit-user-drag: none;
        -khtml-user-drag: none;
        -moz-user-drag: none;
        -o-user-drag: none;
        user-drag: none;
        pointer-events: none;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    
    /* New styles for a consistent gradient background across the site */
    .gradient-bg {
        background: linear-gradient(180deg, #00071c 0%, #011538 100%);
    }
    
    /* New hero styles for the index.php page */
    .hero-text-hidden {
        opacity: 0;
    }

    .hero-text-fade-in {
        transition: opacity 1s ease-in-out;
    }
    
    .fade-out-text {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    @keyframes mascot-float-animation {
        0% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0); }
    }

    .mascot-float {
        position: fixed;
        z-index: 10;
        opacity: 0;
        transition: opacity 0.8s ease-out;
        animation: mascot-float-animation 8s ease-in-out infinite;
    }

    .mascot-float.visible {
        opacity: 1;
    }
    #mascot-left {
        top: 70%; 
        left: -10px; 
        width: 150px; 
    }
    #mascot-right {
        top: 25%; 
        right: -10px; 
        width: 150px; 
    }
    
    .activities-card {
        background-color: transparent;
        border: 1px solid #b9da05;
        box-shadow: 0 4px 6px -1-px rgba(0, 0, 0, 0.4);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        cursor: pointer;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .activities-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        border-radius: 1rem;
        background: linear-gradient(90deg, rgba(1, 21, 56, 0) 0px, rgba(1, 21, 56, 0.85) 400px);
    }
    
    .activities-card.reverse-gradient::before {
        background: linear-gradient(-90deg, rgba(1, 21, 56, 0) 0px, rgba(1, 21, 56, 0.85) 400px);
    }

    @media (max-width: 767px) {
        .activities-card::before {
            background: linear-gradient(180deg, rgba(1, 21, 56, 0) 0px, rgba(1, 21, 56, 0.85) 400px);
        }
        .activities-card.reverse-gradient::before {
            background: linear-gradient(180deg, rgba(1, 21, 56, 0) 0px, rgba(1, 21, 56, 0.85) 400px);
        }
        .modal-content {
            padding: 1rem;
        }
        .modal-content .flex-col,
        .modal-content .md:flex-row,
        .modal-content .md:flex-row-reverse {
            flex-direction: column;
        }
        .modal-content .md:text-left {
            text-align: center;
        }
        .modal-content img {
            margin: 0 auto;
        }
    }
    .activities-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 12px -1-px rgba(0, 0, 0, 0.6);
    }
    
    .activities-card .flex, .activities-card h2, .activities-card p {
        position: relative;
        z-index: 2;
    }
    
    .activities-card img {
        box-shadow: none;
    }
    
    .modal-content {
        background-color: #011538;
        border: 1px solid #b9da05;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 90%;
        width: 800px;
        position: relative;
        max-height: 90vh;
        z-index: 101;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .modal-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(1, 21, 56, 0.85);
        z-index: -1;
        border-radius: 1rem;
    }
    
    .modal-content .modal-scroll-area {
        max-height: calc(90vh - 4rem);
        overflow-y: auto;
        position: relative;
    }
    
    .modal-content .modal-close-button {
        z-index: 3;
    }
    
    .modal-content img {
        z-index: 2;
    }

    .status-modal-content {
        background-color: #011538;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 90%;
        position: relative;
        text-align: center;
        border: 1px solid #b9da05;
    }
    .status-modal-close-button {
        position: absolute;
        top: 1rem;
        right: 1rem;
        cursor: pointer;
        color: #b9da05;
        font-size: 1.5rem;
        line-height: 1;
        transition: color 0.3s;
    }
    .status-modal-close-button:hover {
        color: white;
    }
</style>
