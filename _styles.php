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

    h1,
    h2,
    h3,
    h4 {
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
        background: conic-gradient(from 180deg at 50% 70%, hsla(0, 0%, 98%, 1) 0deg, #b9da05 72.0000010728836deg, #0051ff 144.0000021457672deg, #0095ff 216.00000858306885deg, #b9da05 288.0000042915344deg, hsla(0, 0%, 98%, 1) 1turn);
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
        to {
            mask-position: 50% 50%, 0 50%;
        }
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
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
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
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0);
        }
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

    .activities-card .flex,
    .activities-card h2,
    .activities-card p {
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

    /*  */
    main,
    body {
        background-color: #080c24;
    }

    #main-header {
        background-color: #00071c;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    #main-header.header-scrolled {
        background-color: #00071c;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.4);
    }

    .nav-link {
        color: #d1d5db;
        transition: color 0.3s;
    }

    .nav-link:hover {
        color: #b9da05;
    }

    .nav-icon-wrapper {
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        transition: all 0.3s;
        cursor: pointer;
    }

    .nav-icon-wrapper:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .nav-icon {
        color: white;
        font-size: 1.25rem;
        transition: transform 0.3s, color 0.3s;
    }

    .nav-icon-wrapper:hover .nav-icon {
        color: #b9da05;
        transform: scale(1.1);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: scale(1);
        }

        to {
            opacity: 0;
            transform: scale(0.95);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out forwards;
    }

    .animate-fadeOut {
        animation: fadeOut 0.3s ease-in forwards;
    }

    /* Custom scrollbar styles */
    ::-webkit-scrollbar {
        width: 8px;
        background-color: #1e293b;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #b9da05;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #d1d5db;
    }

    /* Calendar: day cell */
    #calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        grid-auto-rows: 1fr;
        height: 100%;
    }

    .day-cell {
        height: 100%;
        min-height: unset;
        max-height: unset;
    }

    /* Profile picture upload */
    input[type="file"] {
        width: 100%;
        color: #f3f4f6;
        font-size: 0.95rem;
        background-color: #0b1c3a;
        border: 1px solid #334155;
        padding: 0.5rem;
        margin-top: 0.2rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease-in-out;
        box-sizing: border-box;
    }

    input:focus {
        outline: none;
        border-color: #b9da05;
        box-shadow: 0 0 0 2px #b9da05;
    }

    input[type="file"]::file-selector-button {
        margin-right: 1rem;
        padding: 0.5rem 1rem;
        border: 0;
        border-radius: 0.375rem;
        font-weight: 600;
        background-color: #b9da05;
        color: #000;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    input[type="file"] {
        cursor: pointer;
    }

    /* Toast notification*/
    @keyframes slide-in {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-in {
        animation: slide-in 0.4s ease-out;
    }

    /* Mobile Settings Tabs */
    @media (max-width: 767px) {
        .mobile-tabs {
            display: flex;
            justify-content: space-around;
            width: 100%;
            background-color: #011538;
            border-bottom: 2px solid #b9da05;
        }

        /* input[type="file"] {
                display: block;
            }

            input[type="file"]::file-selector-button {
                display: block;
                margin-bottom: 0.5rem;
                margin-right: 0;
            } */

        /* Adjustments for mobile view of the file input */
        input[type="file"] {
            display: block;
        }

        input[type="file"]::file-selector-button {
            display: block;
            width: 100%;
            /* This is the key change */
            margin-bottom: 0.5rem;
            margin-right: 0;
        }
    }

    /* Default: sidebar tabs */
    .sidebar-btn {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        font-weight: 500;
        color: #d1d5db;
        background: transparent;
        border-left: 4px solid transparent;
        border-radius: 0.375rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        text-align: left;
        position: relative;
        overflow: hidden;
    }

    .sidebar-btn::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 0;
        height: 100%;
        background: rgba(185, 218, 5, 0.1);
        transition: width 0.3s ease;
        z-index: 0;
    }

    .sidebar-btn:hover::before {
        width: 100%;
    }

    .sidebar-btn.active::before {
        width: 100%;
    }

    .sidebar-btn:hover,
    .sidebar-btn.active {
        color: #b9da05;
        border-left-color: #b9da05;
    }

    .sidebar-btn i {
        width: 1.5rem;
        text-align: center;
        z-index: 1;
        transition: transform 0.3s ease;
    }

    .sidebar-btn:hover i,
    .sidebar-btn.active i {
        transform: scale(1.1);
    }

    /* Mobile tabs - settings */
    .mobile-tabs .tab-btn {
        flex-grow: 1;
        text-align: center;
        padding: 1rem 0;
        color: #d1d5db;
        cursor: pointer;
        font-weight: 500;
        margin-bottom: 8px;
        position: relative;
        transition: color 0.3s ease, transform 0.2s ease;
        border-radius: 0.5rem;
        /* smooth corners */
        overflow: hidden;
    }

    .mobile-tabs .tab-btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: 50%;
        width: 0;
        height: 100%;
        background: rgba(185, 218, 5, 0.1);
        transition: all 0.3s ease;
        z-index: 0;
        transform: translateX(-50%);
    }

    .mobile-tabs .tab-btn:hover::before {
        width: 100%;
    }

    .mobile-tabs .tab-btn:hover {
        color: #b9da05;
        transform: scale(1.05);
    }

    .mobile-tabs .tab-btn.active {
        color: #b9da05;
        transform: scale(1.05);
    }

    .mobile-tabs .tab-btn::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 0;
        width: 0;
        height: 2px;
        background: #b9da05;
        transition: width 0.3s ease, left 0.3s ease;
        z-index: 1;
    }

    .mobile-tabs .tab-btn.active::after {
        width: 100%;
        left: 0;
    }

    .mobile-tabs .tab-btn i {
        display: block;
        margin: 0 auto 4px;
        transition: transform 0.3s ease;
        z-index: 1;
    }

    .mobile-tabs .tab-btn:hover i,
    .mobile-tabs .tab-btn.active i {
        transform: scale(1.1);
    }

    /* settings */
    .toggle-switch {
        position: relative;
        width: 60px;
        height: 30px;
        background: linear-gradient(135deg, #374151, #4b5563);
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow:
            inset 0 2px 4px rgba(0, 0, 0, 0.2),
            0 2px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .toggle-switch.active {
        background: linear-gradient(135deg, #b9da05, #a8c904);
        box-shadow:
            inset 0 2px 4px rgba(0, 0, 0, 0.1),
            0 0 20px rgba(185, 218, 5, 0.3),
            0 2px 8px rgba(185, 218, 5, 0.2);
    }

    .toggle-slider {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 26px;
        height: 26px;
        background: linear-gradient(135deg, #ffffff, #f8fafc);
        border-radius: 50%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow:
            0 2px 8px rgba(0, 0, 0, 0.15),
            0 1px 3px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toggle-switch.active .toggle-slider {
        transform: translateX(30px);
        background: linear-gradient(135deg, #ffffff, #f1f5f9);
        box-shadow:
            0 2px 12px rgba(185, 218, 5, 0.3),
            0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .toggle-icon {
        width: 14px;
        height: 14px;
        transition: all 0.3s ease;
        opacity: 0.7;
    }

    .toggle-switch.active .toggle-icon {
        opacity: 1;
    }

    .notification-card {
        background: linear-gradient(135deg, #1f2a40, #243447);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .pulse-ring {
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        border: 2px solid #b9da05;
        border-radius: 20px;
        opacity: 0;
        animation: pulse-ring 2s ease-out infinite;
    }

    .toggle-switch.active .pulse-ring {
        animation: pulse-ring 2s ease-out infinite;
    }

    @keyframes pulse-ring {
        0% {
            transform: scale(0.8);
            opacity: 1;
        }

        100% {
            transform: scale(1.2);
            opacity: 0;
        }
    }

    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #6b7280;
        transition: all 0.3s ease;
    }

    .status-indicator.active .status-dot {
        background: #b9da05;
        box-shadow: 0 0 10px rgba(185, 218, 5, 0.5);
    }

    /* events and register */
    .hero-section {
        margin-top: 80px;
        padding: 60px 20px;
        text-align: center;
        max-width: 80rem;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 0;
        position: relative;
    }

    .hero-section h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        font-family: 'Orbitron', sans-serif;
        color: #b9da05;
        position: relative;
        z-index: 1;
    }

    .hero-section p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        position: relative;
        z-index: 1;
    }

    .main-content {
        flex: 1;
        max-width: 80rem;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .filter-container {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }

    .filter-buttons {
        background: #011538;
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 8px;
        display: flex;
        gap: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 15px rgba(255, 255, 255, 0.1);
    }

    .filter-btn {
        padding: 12px 24px;
        border: none;
        border-radius: 25px;
        background: transparent;
        color: #d1d5db;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .filter-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .filter-btn.active {
        background: #b9da05;
        color: #011538;
        box-shadow: 0 4px 12px rgba(185, 218, 5, 0.3);
    }

    .event-section {
        width: 100%;
        margin: 0;
        padding: 0 1rem;
    }

    .event-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin: 0 auto;
        max-width: 80rem;
        padding: 0 20px 70px;
        position: relative;
    }

    .nav-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(185, 218, 5, 0.9);
        color: #080c24;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .nav-arrow:hover {
        background: #b9da05;
        transform: translateY(-50%) scale(1.1);
    }

    .nav-arrow.prev {
        left: -25px;
    }

    .nav-arrow.next {
        right: -25px;
    }

    .nav-arrow:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }

    .nav-arrow:disabled:hover {
        transform: translateY(-50%);
    }

    .empty-state {
        background: #011538;
        border: 2px dashed rgba(185, 218, 5, 0.3);
        border-radius: 16px;
        padding: 60px 40px;
        text-align: center;
        color: rgba(255, 255, 255, 0.7);
        margin: 0 auto;
        max-width: 80rem;
    }

    .empty-state i {
        font-size: 4rem;
        color: rgba(185, 218, 5, 0.5);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        color: #b9da05;
        margin-bottom: 10px;
        font-family: 'Orbitron', sans-serif;
    }

    .empty-state p {
        font-size: 1rem;
        line-height: 1.6;
    }

    .event-card {
        background: #011538;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 0;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 10px rgba(255, 255, 255, 0.1);
        display: flex;
        flex-direction: row;
        overflow: hidden;
        height: 280px;
        min-height: 280px;
        width: 100%;
        max-width: none;
        display: none;
    }

    .event-card.active {
        display: flex;
    }

    .event-card:hover {
        transform: translateY(-8px);
        border-color: #b9da05;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7), 0 0 30px rgba(185, 218, 5, 0.3);
    }

    .event-image {
        width: 280px;
        height: 100%;
        background: #1a1f3a;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
        padding: 25px;
    }

    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .event-image i {
        font-size: 3rem;
        color: #64748b;
    }

    .event-content {
        padding: 40px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .event-card h3 {
        font-size: 1.75rem;
        font-weight: bold;
        margin-bottom: 12px;
        color: white;
        line-height: 1.3;
    }

    .event-card .date {
        color: #b9da05;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 12px;
    }

    .event-card .excerpt {
        color: #d1d5db;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: #011538;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 30px;
        max-width: 500px;
        width: 90%;
        position: relative;
        color: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6), 0 0 20px rgba(255, 255, 255, 0.1);
    }

    .close-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
        color: #d1d5db;
        transition: color 0.3s;
    }

    .close-btn:hover {
        color: #ef4444;
    }

    .register-btn {
        background: #b9da05;
        color: #011538;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 20px;
        transition: all 0.3s;
    }

    .register-btn:hover {
        background: #9abc04;
        transform: translateY(-2px);
    }

    .footer-container {
        margin-top: auto;
    }

    footer {
        background: #00071c;
        text-align: center;
        padding: 1.5rem;
        border-top: 1px solid #374151;
    }

    footer .flex.justify-center.space-x-1.mb-1 img {
        height: 2.5rem;
    }

    footer .flex.justify-center.space-x-1.mb-1 img:last-child {
        height: 2.5rem;
        width: 2.5rem;
    }

    footer .text-gray-500 {
        color: #6b7280;
        font-size: 0.875rem;
    }

    footer .flex.justify-center.space-x-4.mt-2 a {
        color: #9ca3af;
        transition: color 0.3s;
    }

    footer .flex.justify-center.space-x-4.mt-2 a:hover {
        color: #b9da05;
    }

    .form-grid {
        display: flex;
        flex-wrap: wrap;
        /* ensures columns stack on smaller screens */
        gap: 20px;
        margin-top: 15px;
        width: 100%;
        box-sizing: border-box;
    }

    .left-col,
    .right-col {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 12px;
        min-width: 0;
        /* prevents overflow when content is wide */
    }

    .modal-content form {
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 100%;
        box-sizing: border-box;
        padding: 5px 5px 0 5px;
        /* small inner buffer */
    }

    /* Input and select field consistency */
    .modal-content input,
    .modal-content select,
    .modal-content textarea {
        width: 100%;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background-color: rgba(255, 255, 255, 0.05);
        color: white;
        padding: 10px 14px;
        font-size: 0.95rem;
        box-sizing: border-box;
    }

    .form-grid input:focus,
    .form-grid select:focus,
    .form-grid textarea:focus {
        outline: none;
        border-color: #b9da05;
        box-shadow: 0 0 10px rgba(185, 218, 5, 0.4);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .form-actions button {
        background: #b9da05;
        color: #011538;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
    }

    .form-actions button:hover {
        background: #9abc04;
        transform: translateY(-2px);
    }

    .form-grid select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: rgba(255, 255, 255, 0.05);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.95rem;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg fill='white' height='16' viewBox='0 0 24 24' width='16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        padding-right: 36px;
    }

    /* This targets the dropdown list itself in Chromium browsers */
    .form-grid select option {
        background-color: #011538;
        color: #fff;
    }

    /* When hovering options (optional — improves contrast) */
    .form-grid select option:hover {
        background-color: #b9da05;
        color: #011538;
    }

    /* Optional: make it glow slightly when focused */
    .form-grid select:focus {
        outline: none;
        border-color: #b9da05;
        box-shadow: 0 0 10px rgba(185, 218, 5, 0.4);
    }

    .single-select {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 15px;
        width: 100%;
        box-sizing: border-box;
    }

    /* Match input/select style from your reference */
    .single-select label {
        font-weight: 500;
        color: #ffffff;
        font-size: 0.95rem;
        margin-bottom: 5px;
    }

    .single-select select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 100%;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background-color: rgba(255, 255, 255, 0.05);
        color: #fff;
        padding: 10px 14px;
        font-size: 0.95rem;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg fill='white' height='16' viewBox='0 0 24 24' width='16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        padding-right: 36px;
        transition: all 0.3s ease;
    }

    /* Dropdown options — consistent with other selects */
    .single-select select option {
        background-color: #011538;
        color: #fff;
    }

    /* Hover and focus effects */
    .single-select select option:hover {
        background-color: #b9da05;
        color: #011538;
    }

    .single-select select:focus {
        outline: none;
        border-color: #b9da05;
        box-shadow: 0 0 10px rgba(185, 218, 5, 0.4);
    }

    @media (max-width: 600px) {
        .form-grid {
            flex-direction: column;
            gap: 15px;
        }

        .left-col,
        .right-col {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            margin-top: 70px;
            padding: 40px 1rem;
        }

        .hero-section h1 {
            font-size: 1.75rem;
        }

        .hero-section p {
            font-size: 1rem;
        }

        .main-content {
            padding: 0 0.5rem;
        }

        .filter-container {
            margin-bottom: 25px;
            padding: 0 10px;
        }

        .filter-buttons {
            flex-direction: row;
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
            padding: 6px;
        }

        .filter-btn {
            flex: 1;
            padding: 10px 12px;
            font-size: 13px;
            min-width: 100px;
        }

        .event-list {
            gap: 16px;
            padding: 0 10px 40px;
            max-width: 100%;
        }

        .nav-arrow {
            display: none;
        }

        .event-card {
            flex-direction: column;
            height: auto;
            min-height: auto;
            display: flex !important;
        }

        .event-image {
            width: 100%;
            height: 200px;
            padding: 20px;
        }

        .event-content {
            padding: 20px;
        }

        .event-card h3 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .event-card .date {
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .event-card .excerpt {
            font-size: 1rem;
            line-height: 1.5;
        }

        .modal-content {
            width: 95%;
            margin: 10px;
            padding: 20px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .empty-state {
            padding: 40px 20px;
            margin: 0 10px;
        }

        .empty-state i {
            font-size: 3rem;
        }

        .empty-state h3 {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            margin-top: 60px;
            padding: 30px 0.75rem;
        }

        .hero-section h1 {
            font-size: 1.5rem;
        }

        .hero-section p {
            font-size: 0.9rem;
        }

        .filter-container {
            padding: 0 5px;
            margin-bottom: 20px;
        }

        .filter-buttons {
            max-width: 320px;
            padding: 4px;
        }

        .filter-btn {
            padding: 8px 10px;
            font-size: 12px;
            min-width: 90px;
        }

        .event-list {
            padding: 0 5px 30px;
        }

        .event-card {
            margin: 0 5px;
        }

        .event-image {
            height: 180px;
            padding: 15px;
        }

        .event-content {
            padding: 15px;
        }

        .event-card h3 {
            font-size: 1.25rem;
        }

        .modal-content {
            width: 98%;
            margin: 5px;
            padding: 15px;
        }
    }

    /* announcements */
    .hero-section {
        margin-top: 80px;
        padding: 60px 20px;
        text-align: center;
        max-width: 80rem;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 20px;
        position: relative;
    }

    .hero-section h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        font-family: 'Orbitron', sans-serif;
        color: #b9da05;
        position: relative;
        z-index: 1;
    }

    .hero-section p {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        position: relative;
        z-index: 1;
    }

    .main-content {
        flex: 1;
        max-width: 80rem;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .announcement-section {
        width: 100%;
        margin: 0;
        padding: 0 1rem;
    }

    .announcement-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin: 0 auto;
        max-width: 80rem;
        padding: 0 20px 70px;
        position: relative;
    }

    .nav-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(185, 218, 5, 0.9);
        color: #080c24;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .nav-arrow:hover {
        background: #b9da05;
        transform: translateY(-50%) scale(1.1);
    }

    .nav-arrow.prev {
        left: -25px;
    }

    .nav-arrow.next {
        right: -25px;
    }

    .nav-arrow:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }

    .nav-arrow:disabled:hover {
        transform: translateY(-50%);
    }

    .empty-state {
        background: #011538;
        border: 2px dashed rgba(185, 218, 5, 0.3);
        border-radius: 16px;
        padding: 60px 40px;
        text-align: center;
        color: rgba(255, 255, 255, 0.7);
        margin: 0 auto;
        max-width: 80rem;
    }

    .empty-state i {
        font-size: 4rem;
        color: rgba(185, 218, 5, 0.5);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        color: #b9da05;
        margin-bottom: 10px;
        font-family: 'Orbitron', sans-serif;
    }

    .empty-state p {
        font-size: 1rem;
        line-height: 1.6;
    }

    .announcement-card {
        background: #011538;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 0;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 10px rgba(255, 255, 255, 0.1);
        display: flex;
        flex-direction: row;
        overflow: hidden;
        height: 280px;
        min-height: 280px;
        width: 100%;
        max-width: none;
        display: none;
    }

    .announcement-card.active {
        display: flex;
    }

    .announcement-card:hover {
        transform: translateY(-8px);
        border-color: #b9da05;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7), 0 0 30px rgba(185, 218, 5, 0.3);
    }

    .announcement-image {
        width: 280px;
        height: 100%;
        background: #1a1f3a;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
        padding: 25px;
    }

    .announcement-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .announcement-image i {
        font-size: 3rem;
        color: #64748b;
    }

    .announcement-content {
        padding: 40px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .announcement-card h3 {
        font-size: 1.75rem;
        font-weight: bold;
        margin-bottom: 12px;
        color: white;
        line-height: 1.3;
    }

    .announcement-card .date {
        color: #b9da05;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 12px;
    }

    .announcement-card .excerpt {
        color: #d1d5db;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: #011538;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 30px;
        max-width: 500px;
        width: 90%;
        position: relative;
        color: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6), 0 0 20px rgba(255, 255, 255, 0.1);
    }

    .close-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
        color: #d1d5db;
        transition: color 0.3s;
    }

    .close-btn:hover {
        color: #ef4444;
    }

    @media (max-width: 768px) {
        .hero-section {
            margin-top: 70px;
            padding: 40px 1rem;
        }

        .hero-section h1 {
            font-size: 1.75rem;
        }

        .hero-section p {
            font-size: 1rem;
        }

        .announcement-list {
            gap: 16px;
            padding: 0 10px 40px;
            max-width: 100%;
        }

        .announcement-card {
            flex-direction: column;
            height: auto;
            min-height: auto;
            display: flex !important;
        }

        .announcement-image {
            width: 100%;
            height: 200px;
            padding: 20px;
        }

        .announcement-content {
            padding: 20px;
        }

        .announcement-card h3 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .announcement-card .date {
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .announcement-card .excerpt {
            font-size: 1rem;
            line-height: 1.5;
        }

        .main-content {
            padding: 0 0.5rem;
        }

        .nav-arrow {
            display: none;
        }

        .modal-content {
            width: 95%;
            margin: 10px;
            padding: 20px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .empty-state {
            padding: 40px 20px;
            margin: 0 10px;
        }

        .empty-state i {
            font-size: 3rem;
        }

        .empty-state h3 {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            margin-top: 60px;
            padding: 30px 0.75rem;
        }

        .hero-section h1 {
            font-size: 1.5rem;
        }

        .hero-section p {
            font-size: 0.9rem;
        }

        .announcement-list {
            padding: 0 5px 30px;
        }

        .announcement-card {
            margin: 0 5px;
        }

        .announcement-image {
            height: 180px;
            padding: 15px;
        }

        .announcement-content {
            padding: 15px;
        }

        .announcement-card h3 {
            font-size: 1.25rem;
        }

        .modal-content {
            width: 98%;
            margin: 5px;
            padding: 15px;
        }
    }
</style>