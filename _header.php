<?php
// Start the session at the very beginning of the file
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check for the user's login status based on a session variable
$isLoggedIn = isset($_SESSION['user_id']);

$page_title = "BulSU Microsoft Student Community";
$current_page = basename($_SERVER['PHP_SELF']);

// --- Updated PHP Page Title Logic ---
switch ($current_page) {
    case 'aboutus.php':
        $page_title = "About Us | BulSU MSC";
        break;
    case 'events-and-register-events.php':
        $page_title = "Events | BulSU MSC";
        break;
    case 'announcements.php':
        $page_title = "Announcements | BulSU MSC";
        break;
    case 'dashboard.php':
        $page_title = "Dashboard | BulSU MSC";
        break;
    case 'calendar.php':
        $page_title = "Calendar | BulSU MSC";
        break;
    case 'profile.php':
        $page_title = "Profile | BulSU MSC";
        break;
    case 'edit_profile.php':
        $page_title = "Edit Profile | BulSU MSC";
        break;
    case 'settings.php':
        $page_title = "Settings | BulSU MSC";
        break;
    case 'login.php':
        $page_title = "Login | BulSU MSC";
        break;
    case 'forgot_password.php':
        $page_title = "Forgot Password | BulSU MSC";
        break;
    case 'change_password.php':
        $page_title = "Change Password | BulSU MSC";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="icon" href="./Logos/Bulsu MSC Logo-02.png" type="image/png">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&family=Play:wght@400;700&family=Segoe+UI:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <?php include '_styles.php'; ?>
</head>

<body>
    <div class="el"></div>

    <?php if ($isLoggedIn): ?>
        <!-- Expose minimal session info to JS for immediate display (non-sensitive) -->
        <script>
            window.__MSC_SESSION_USER = {
                username: <?php echo json_encode($_SESSION['username'] ?? null); ?>
            };
        </script>
    <?php endif; ?>


    <!-- Mobile Sidebar Overlay -->
    <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-[60] hidden md:hidden"></div>

    <!-- Mobile Sidebar - Updated z-index to be higher than header -->
    <div id="mobile-sidebar" class="fixed top-0 left-0 h-full w-64 bg-[#0a1a2e] z-[70] transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
        <div class="flex flex-col h-full">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <div class="flex items-center space-x-2">
                    <img src="./Logos/Bulsu MSC Logo-02.png" alt="BULSU MSC Logo" class="h-8" onerror="this.onerror=null; this.src='https://placehold.co/100x50/00071c/b9da05?text=Logo';">
                    <span class="text-white font-semibold text-sm">BulSU MSC</span>
                </div>
                <button id="mobile-sidebar-close" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Navigation Items -->
            <div class="flex-1 py-4">
                <nav class="space-y-1">
                    <?php if ($isLoggedIn): ?>
                        <!-- Profile Section -->
                        <a href="profile.php" class="flex items-center mb-4 p-3 bg-[#16213e] rounded-lg mx-3 no-underline" aria-label="View Profile">
                        <div class="w-10 h-10 bg-[#b9da05] rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-[#0a1a2e]"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p id="fullName" class="text-white text-sm font-medium truncate"></p>
                            <p class="text-gray-400 text-xs">View Profile</p>
                        </div>
                    </a>
                    <?php endif; ?>

                    <!-- Home -->
                    <a href="index.php" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[#16213e] hover:text-white transition-colors duration-200 <?php if ($current_page == 'index.php') echo 'bg-[#16213e] text-[#b9da05] border-r-2 border-[#b9da05]'; ?>">
                        <i class="fas fa-home w-5 mr-3"></i>
                        <span>Home</span>
                    </a>

                    <!-- About (for non-logged-in users) -->
                    <a href="aboutus.php" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[#16213e] hover:text-white transition-colors duration-200 <?php if ($current_page == 'aboutus.php') echo 'bg-[#16213e] text-[#b9da05] border-r-2 border-[#b9da05]'; ?>">
                        <i class="fas fa-info-circle w-5 mr-3"></i>
                        <span>About</span>
                    </a>

                    <!-- Events -->
                    <a href="events-and-register-events.php" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[#16213e] hover:text-white transition-colors duration-200 <?php if ($current_page == 'events-and-register-events.php') echo 'bg-[#16213e] text-[#b9da05] border-r-2 border-[#b9da05]'; ?>">
                        <i class="fas fa-calendar w-5 mr-3"></i>
                        <span>Events</span>
                    </a>

                    <?php if ($isLoggedIn): ?>
                        <!-- Announcements -->
                        <a href="announcements.php" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[#16213e] hover:text-white transition-colors duration-200 <?php if ($current_page == 'announcements.php') echo 'bg-[#16213e] text-[#b9da05] border-r-2 border-[#b9da05]'; ?>">
                            <i class="fas fa-bell w-5 mr-3"></i>
                            <span>Announcements</span>
                        </a>

                        <a href="dashboard.php" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[#16213e] hover:text-white transition-colors duration-200 <?php if ($current_page == 'announcements.php') echo 'bg-[#16213e] text-[#b9da05] border-r-2 border-[#b9da05]'; ?>">
                            <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                            <span>Dashboard</span>
                        </a>

                        <!-- Edit Profile -->
                        <a href="edit_profile.php" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[#16213e] hover:text-white transition-colors duration-200">
                            <i class="fas fa-user-edit w-5 mr-3"></i>
                            <span>Edit Profile</span>
                        </a>

                        <!-- Calendar -->
                        <a href="calendar.php" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[#16213e] hover:text-white transition-colors duration-200 <?php if ($current_page == 'calendar.php') echo 'bg-[#16213e] text-[#b9da05] border-r-2 border-[#b9da05]'; ?>">
                            <i class="fas fa-calendar-alt w-5 mr-3"></i>
                            <span>Calendar</span>
                        </a>

                        <!-- Settings -->
                        <a href="settings.php" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[#16213e] hover:text-white transition-colors duration-200">
                            <i class="fas fa-cog w-5 mr-3"></i>
                            <span>Settings</span>
                        </a>
                    <?php else: ?>

                        <!-- Partners -->
                        <a href="index.php#partners" class="flex items-center px-4 py-3 text-gray-300 hover:bg-[#16213e] hover:text-white transition-colors duration-200">
                            <i class="fas fa-handshake w-5 mr-3"></i>
                            <span>Partners</span>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>

            <!-- Bottom Section -->
            <div class="border-t border-gray-700 p-4">
                <?php if ($isLoggedIn): ?>

                    <!-- Logout Button -->
                    <a href="logout.php" class="flex items-center justify-center w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span>Logout</span>
                    </a>
                <?php else: ?>
                    <!-- Login Button -->
                    <a href="login.php" class="flex items-center justify-center w-full py-3 px-4 bg-[#b9da05] hover:bg-white text-[#00071c] font-bold rounded-lg transition-colors duration-200">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span>Login</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <nav id="main-header" class="fixed top-0 left-0 right-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <a href="index.php" class="flex items-center space-x-2 text-white transition-colors duration-300 hover:text-[#b9da05]">
                <img src="./Logos/Bulsu MSC Logo-02.png" alt="BULSU MSC Logo" class="h-12" onerror="this.onerror=null; this.src='https://placehold.co/100x50/00071c/b9da05?text=Logo';">
            </a>

            <!-- --- Desktop Navigation (md:flex) --- -->
            <div class="hidden md:flex items-center space-x-6">
                <!-- Home -->
                <a href="index.php" class="nav-link font-semibold <?php if ($current_page == 'index.php') echo 'text-[#b9da05]'; ?>">Home</a>
                <!-- About -->
                <a href="aboutus.php" class="nav-link font-semibold <?php if ($current_page == 'aboutus.php') echo 'text-[#b9da05]'; ?>">About</a>
                <!-- Events: Link updated -->
                <a href="events-and-register-events.php" class="nav-link font-semibold <?php if ($current_page == 'events-and-register-events.php') echo 'text-[#b9da05]'; ?>">Events</a>

                <?php if ($isLoggedIn): ?>
                    <!-- Announcements: Added -->
                    <a href="announcements.php" class="nav-link font-semibold <?php if ($current_page == 'announcements.php') echo 'text-[#b9da05]'; ?>">Announcements</a>

                    <!-- Calendar Icon: Uniform size (text-2xl) -->
                    <a href="calendar.php" class="text-white hover:text-[#b9da05] transition-colors duration-300 <?php if ($current_page == 'calendar.php') echo 'text-[#b9da05]'; ?>">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </a>

                    <!-- Profile Dropdown Container (Replaced Logout Button) -->
                    <div class="relative">
                        <!-- Profile Icon (Toggle Button) - Uniform size (text-2xl) -->
                        <i id="profile-pic-desktop"
                            class="fas fa-user-circle text-2xl text-[#b9da05] cursor-pointer transition-colors duration-300 hover:text-white"
                            onclick="toggleProfileDropdown(event)"
                            aria-label="Toggle Profile Menu"></i>

                        <!-- Dropdown Menu -->
                        <div id="profile-dropdown" class="absolute right-0 mt-3 w-48 bg-[#00071c] border border-[#b9da05] rounded-lg shadow-xl overflow-hidden hidden transform transition-all duration-300 origin-top-right z-50">
                            <div class="py-1">
                                <!-- Profile -->
                                <a href="profile.php" class="block px-4 py-2 text-sm text-gray-200 hover:bg-[#b9da05] hover:text-[#00071c] transition-colors duration-200 flex items-center space-x-2">
                                    <i class="fas fa-user w-4"></i><span>Profile</span>
                                </a>
                                <!-- Dashboard -->
                                <a href="dashboard.php" class="block px-4 py-2 text-sm text-gray-200 hover:bg-[#b9da05] hover:text-[#00071c] transition-colors duration-200 flex items-center space-x-2">
                                    <i class="fas fa-tachometer-alt w-4"></i><span>Dashboard</span>
                                </a>
                                <!-- Edit Profile -->
                                <a href="edit_profile.php" class="block px-4 py-2 text-sm text-gray-200 hover:bg-[#b9da05] hover:text-[#00071c] transition-colors duration-200 flex items-center space-x-2">
                                    <i class="fas fa-edit w-4"></i><span>Edit Profile</span>
                                </a>
                                <!-- Settings -->
                                <a href="settings.php" class="block px-4 py-2 text-sm text-gray-200 hover:bg-[#b9da05] hover:text-[#00071c] transition-colors duration-200 flex items-center space-x-2">
                                    <i class="fas fa-cog w-4"></i><span>Settings</span>
                                </a>
                                <!-- Logout -->
                                <a href="logout.php" class="block px-4 py-2 text-sm text-red-400 hover:bg-red-500 hover:text-white transition-colors duration-200 border-t border-gray-700 mt-1 pt-2 flex items-center space-x-2">
                                    <i class="fas fa-sign-out-alt w-4"></i><span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php else: ?>
                    <!-- Partners: Re-added for non-logged-in users -->
                    <a href="index.php#partners" class="nav-link font-semibold">Partners</a>

                    <a href="login.php" id="login-button-desktop" class="bg-[#b9da05] text-[#00071c] font-bold py-2 px-4 rounded-full transition-colors duration-300 hover:bg-white hover:text-[#00071c] shadow-md">
                        Login
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button (md:hidden) -->
            <div class="md:hidden flex items-center space-x-4">
                <button id="mobile-menu-button" class="text-gray-300 hover:text-[#b9da05] focus:outline-none">
                    <i id="mobile-menu-icon" class="fas fa-bars text-2xl transition-transform duration-300"></i>
                </button>
            </div>
        </div>
    </nav>

    <main>

        <script>
            // Function to toggle the visibility of the profile dropdown (for desktop)
            function toggleProfileDropdown(event) {
                // Stop the click event from immediately propagating to the document listener below.
                if (event) {
                    event.stopPropagation();
                }
                const dropdown = document.getElementById('profile-dropdown');
                if (dropdown) {
                    // Toggle the 'hidden' class to show/hide the menu
                    dropdown.classList.toggle('hidden');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const mobileSidebar = document.getElementById('mobile-sidebar');
                const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');
                const mobileSidebarClose = document.getElementById('mobile-sidebar-close');
                const mobileMenuIcon = document.getElementById('mobile-menu-icon');
                const profileDropdown = document.getElementById('profile-dropdown');
                const profilePic = document.getElementById('profile-pic-desktop');

                // --- Profile Dropdown Closure Logic ---
                // Close the dropdown if the user clicks anywhere outside of it
                document.addEventListener('click', function(event) {
                    // Check if we have both elements (only available when logged in)
                    if (profileDropdown && profilePic) {
                        // Check if the click target is NOT the profile picture AND NOT inside the dropdown
                        if (!profilePic.contains(event.target) && !profileDropdown.contains(event.target)) {
                            // Only hide if it is currently visible
                            if (!profileDropdown.classList.contains('hidden')) {
                                profileDropdown.classList.add('hidden');
                            }
                        }
                    }
                });

                // --- Mobile Sidebar Toggle Logic ---
                function openMobileSidebar() {
                    if (mobileSidebar && mobileSidebarOverlay && mobileMenuIcon) {
                        mobileSidebar.classList.remove('-translate-x-full');
                        mobileSidebarOverlay.classList.remove('hidden');
                        mobileMenuIcon.classList.remove('fa-bars');
                        mobileMenuIcon.classList.add('fa-times');

                        // Prevent body scrolling when sidebar is open
                        document.body.style.overflow = 'hidden';

                        // Close desktop profile dropdown if open
                        if (profileDropdown && !profileDropdown.classList.contains('hidden')) {
                            profileDropdown.classList.add('hidden');
                        }
                    }
                }

                function closeMobileSidebar() {
                    if (mobileSidebar && mobileSidebarOverlay && mobileMenuIcon) {
                        mobileSidebar.classList.add('-translate-x-full');
                        mobileSidebarOverlay.classList.add('hidden');
                        mobileMenuIcon.classList.remove('fa-times');
                        mobileMenuIcon.classList.add('fa-bars');

                        // Restore body scrolling
                        document.body.style.overflow = '';
                    }
                }

                // Mobile menu button click
                if (mobileMenuButton) {
                    mobileMenuButton.addEventListener('click', function() {
                        if (mobileSidebar.classList.contains('-translate-x-full')) {
                            openMobileSidebar();
                        } else {
                            closeMobileSidebar();
                        }
                    });
                }

                // Close button in sidebar
                if (mobileSidebarClose) {
                    mobileSidebarClose.addEventListener('click', closeMobileSidebar);
                }

                // Overlay click to close sidebar
                if (mobileSidebarOverlay) {
                    mobileSidebarOverlay.addEventListener('click', closeMobileSidebar);
                }

                // Close sidebar when clicking on navigation links (for better UX)
                const sidebarLinks = document.querySelectorAll('#mobile-sidebar a[href]');
                sidebarLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        // Add a small delay to allow navigation to start before closing
                        setTimeout(closeMobileSidebar, 100);
                    });
                });

                // Handle escape key to close sidebar
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape' && !mobileSidebar.classList.contains('-translate-x-full')) {
                        closeMobileSidebar();
                    }
                });

                // --- Populate mobile sidebar full name ---
                try {
                    const fullNameEl = document.getElementById('fullName');
                    if (fullNameEl) {
                        // show immediate username from session if available
                        if (window.__MSC_SESSION_USER && window.__MSC_SESSION_USER.username) {
                            fullNameEl.textContent = window.__MSC_SESSION_USER.username;
                        }

                        // fetch full profile to get first & last name (use credentials)
                        (async () => {
                            try {
                                const resp = await fetch('api/auth/profile', { credentials: 'include' });
                                if (!resp.ok) return;
                                const json = await resp.json();
                                if (json && json.success && json.data) {
                                    const u = json.data;
                                    const name = [u.first_name, u.last_name].filter(Boolean).join(' ');
                                    if (name) fullNameEl.textContent = name;
                                    else if (u.username) fullNameEl.textContent = u.username;
                                }
                            } catch (err) {
                                // silent fail - keep whatever text is present
                                console.debug('Could not fetch profile for header:', err);
                            }
                        })();
                    }
                } catch (e) {
                    console.debug('fullName population error', e);
                }
            });
        </script>