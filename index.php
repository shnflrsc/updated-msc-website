<?php include '_header.php'; ?>

<main>
    <?php
    // Use PHP to randomly select the display order of the two ad modals.
    // The rand(0, 1) function returns either 0 or 1.
    // If it's 0, we show the landscape ad first. If it's 1, we show the portrait ad first.
    $random_order = rand(0, 1);
    
    if ($random_order == 0) {
    ?>
    <div id="ad-modal-landscape" class="ad-modal">
        <div id="ad-modal-landscape-content" class="ad-modal-content">
            <button class="ad-modal-close-button bg-gray-800 text-white p-2 rounded-full hover:bg-gray-600 transition-colors">
                <i class="fas fa-xmark"></i>
            </button>
            <a href="https://www.facebook.com/share/p/1Cw3PacZBf/" target="_blank">
                <img src="./Announcements/MS365TOGO/MS365TOGOL.gif" alt="Promotional Ad">
            </a>
        </div>
    </div>
    <div id="ad-modal-portrait" class="ad-modal">
        <div id="ad-modal-portrait-content" class="ad-modal-content">
            <button class="ad-modal-close-button bg-gray-800 text-white p-2 mt-7 rounded-full hover:bg-gray-600 transition-colors">
                <i class="fas fa-xmark"></i>
            </button>
            <a href="https://www.facebook.com/share/p/1Cw3PacZBf/" target="_blank">
                <img src="./Announcements/MS365TOGO/MS365TOGOP.gif" alt="Promotional Ad Portrait">
            </a>
        </div>
    </div>
    <?php
    } else {
    ?>
    <div id="ad-modal-portrait" class="ad-modal">
        <div id="ad-modal-portrait-content" class="ad-modal-content">
            <button class="ad-modal-close-button bg-gray-800 text-white p-2 rounded-full hover:bg-gray-600 transition-colors">
                <i class="fas fa-xmark"></i>
            </button>
            <a href="" target="_blank">
                <img src="./Announcements/NowNa/NowNaP.jpg" alt="Promotional Ad Portrait">
            </a>
        </div>
    </div>
    <div id="ad-modal-landscape" class="ad-modal">
        <div id="ad-modal-landscape-content" class="ad-modal-content">
            <button class="ad-modal-close-button bg-gray-800 text-white p-2 rounded-full hover:bg-gray-600 transition-colors">
                <i class="fas fa-xmark"></i>
            </button>
            <a href="" target="_blank">
                <img src="./Announcements/NowNa/NowNaL.jpg" alt="Promotional Ad">
            </a>
        </div>
    </div>
    <?php
    }
    ?>

    <section id="hero" class="relative pt-24 pb-20 md:py-32 text-center h-screen flex items-center justify-center overflow-hidden">
        <div class="relative z-10 container mx-auto px-4 text-white">
            <!-- Hero text container with classes for the fade-out effect -->
            <div id="hero-text-container" class="relative z-20 hero-text-hidden hero-text-fade-in">
                <h1 id="hero-title" class="text-xl md:text-4xl font-extrabold leading-tight mb-0">
                    What does it take to become
                </h1>
                <p id="hero-tagline" class="text-8xl md:text-[12rem] font-bold uppercase shine-text leading-none">
                    MORE
                </p>
            </div>
            <!-- Hero image container, initially hidden -->
            <div id="hero-image-container" class="absolute inset-0 flex items-center justify-center z-10 opacity-0 transition-opacity duration-1000">
                <img src="./Logos/XPLore More.png" alt="XPLore More" class="w-4/5 md:w-3/5 h-auto object-contain">
            </div>
        </div>
    </section>

    <div class="gradient-bg">
        <section id="about" class="py-16 md:py-24">
            <div class="container mx-auto px-4 fade-in-up">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-white mb-2">Who We Are</h2>
                </div>
                <div class="flex flex-col lg:flex-row items-center gap-12 relative">
                    <div class="w-full lg:w-1/2 relative">
                        <img
                            src="./Photos/2new.jpg"
                            alt="Our Team"
                            class="w-full h-auto rounded-xl shadow-lg transform transition-transform duration-300 hover:scale-[1.02]"
                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/011538/b9da05?text=Our+Team';"
                        />
                    </div>
                    <div class="w-full lg:w-1/2">
                        <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                            The Bulacan State University – Microsoft Student Community is a recognized university-wide student organization at Bulacan State University founded by Microsoft Learn Student Ambassadors (MLSA) dedicated to inspiring and empowering students in enhancing their skills and knowledge in various Microsoft technologies established in 2022. The organization aims to foster a community of avid technology enthusiasts, aspiring developers, and passionate student leaders. By fostering a collaborative environment, we always aspire to be a force of good; leaving a meaningful and lasting impact on society.
                        </p>
                        <p class="text-lg text-gray-300 leading-relaxed font-bold">
                            Together let us inspire, teach, and promote.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="vision-mission" class="relative py-16 md:py-24">
            <div class="container mx-auto px-4 fade-in-up">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8 xl:gap-12">
                    <div class="bg-[#011538] rounded-xl shadow-lg p-8 transform transition-transform duration-300 hover:scale-[1.02] h-full w-full max-w-lg mx-auto">
                        <div class="text-center mb-6">
                            <h2 class="text-4xl font-bold text-white mb-2">MISSION</h2>
                            <p class="text-xl font-bold mb-4">
                                <span class="highlight-text">Inspire. Teach. Promote.</span>
                            </p>
                        </div>
                        <p class="text-lg text-gray-300 leading-relaxed text-center">
                            We empower students with the knowledge and skills needed to excel in the ever-changing field of technology through engaging activities, educational initiatives, and industry partnerships, equipping them with the tools and resources necessary to thrive in the digital age.
                        </p>
                    </div>

                    <div class="bg-[#011538] rounded-xl shadow-lg p-8 transform transition-transform duration-300 hover:scale-[1.02] h-full w-full max-w-lg mx-auto">
                        <div class="text-center mb-6">
                            <h2 class="text-4xl font-bold text-white mb-2">VISION</h2>
                        </div>
                        <p class="text-lg text-gray-300 leading-relaxed text-center">
                            We, as a catalyst for positive change and a community of excellence. We cultivate a generation endowed with technological expertise, embracing innovation and leveraging technology for societal advancement, while remaining attuned to the evolving needs of our community. By fostering an environment of collaboration, continuous learning, and ethical practices, <span class="highlight-text">we aspire to be a force for good</span>, making a meaningful and lasting impact on society.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section id="services" class="py-16 md:py-24">
            <div class="container mx-auto px-4 fade-in-up">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-white mb-2">Members' Benefits</h2>
                    <p class="text-lg text-gray-300 max-w-2xl mx-auto">Enjoy this perks and advantages that can help you achieve your goals.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 justify-items-center">
                    <div class="bg-[#011538] rounded-xl shadow-lg p-8 transform transition-transform duration-300 hover:scale-[1.02] h-full w-full max-w-sm">
                        <div class="text-[#b9da05] mb-4 text-center">
                            <i class="fas fa-laptop-code text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Workshops & Seminars</h3>
                        <p class="text-gray-300">
                            Join hands-on events that sharpen your skills and prep you for the real world.
                        </p>
                    </div>
                    <div class="bg-[#011538] rounded-xl shadow-lg p-8 transform transition-transform duration-300 hover:scale-[1.02] h-full w-full max-w-sm">
                        <div class="text-[#b9da05] mb-4 text-center">
                            <i class="fas fa-seedling text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Leadership & Growth</h3>
                        <p class="text-gray-300">
                            Step up, speak out, or simply grow—we've got the space and support for it.
                        </p>
                    </div>
                    <div class="bg-[#011538] rounded-xl shadow-lg p-8 transform transition-transform duration-300 hover:scale-[1.02] h-full w-full max-w-sm">
                        <div class="text-[#b9da05] mb-4 text-center">
                            <i class="fas fa-briefcase text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Career & Connections</h3>
                        <p class="text-300">
                            Meet mentors, alumni, and industry pros who can open doors for your future.
                        </p>
                    </div>
                    <div class="bg-[#011538] rounded-xl shadow-lg p-8 transform transition-transform duration-300 hover:scale-[1.02] h-full w-full max-w-sm">
                        <div class="text-[#b9da05] mb-4 text-center">
                            <i class="fas fa-gem text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Perks & Resources</h3>
                        <p class="text-gray-300">
                            Get access to tools, materials, and exclusive perks just for being with MSC.
                        </p>
                    </div>
                    <div class="bg-[#011538] rounded-xl shadow-lg p-8 transform transition-transform duration-300 hover:scale-[1.02] h-full w-full max-w-sm">
                        <div class="text-[#b9da05] mb-4 text-center">
                            <i class="fas fa-users text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Belonging & Community</h3>
                        <p class="text-gray-300">
                            Connect with students across all courses. There's a place for you here.
                        </p>
                    </div>
                </div>
                <div class="mt-12 text-center">
                    <a href="previous-activities.php" class="bg-[#b9da05] text-[#00071c] font-bold py-3 px-8 rounded-full transition-colors duration-300 hover:bg-white hover:text-[#00071c] shadow-md text-lg">
                        Check Our Previous Activities
                    </a>
                </div>
            </div>
        </section>

        <section id="partners" class="py-16 md:py-24 fade-in-up">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-white mb-2">Our Partners</h2>
                    <p class="text-lg text-gray-300 max-w-2xl mx-auto">We are proud to collaborate with these organizations and businesses who share our vision and support our mission.</p>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-8">
                    <a href="https://www.facebook.com/StillLifePhotographyStudio" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web - slp.png" alt="Still Life Photography" class="max-w-full max-h-full object-contain p-2">
                    </a>
                    <a href="https://www.facebook.com/kennethgads" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web - Kenneth G Ads.png" alt="Kenneth G Ads & Printing Services" class="max-w-full max-h-full object-contain p-2">
                    </a>
                    <a href="https://www.facebook.com/TheCrunch.Malolos" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web - The Crunch.png" alt="The Crunch - Graceland, Malolos" class="max-w-full max-h-full object-contain p-2">
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=100064006274079" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web - Student Meal.png" alt="Student Meal Pinoy Food and Sizzling" class="max-w-full max-h-full object-contain p-2">
                    </a>
                    <a href="https://www.facebook.com/mygirlmalolos" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web - mygirl.png" alt="My.Girl Milktea and Coffee - Malolos" class="max-w-full max-h-full object-contain p-2">
                    </a>
                    <a href="https://www.facebook.com/avocadoriasmbaliwag" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web - avocadoria.png" alt="Avocadoria.ph" class="max-w-full max-h-full object-contain p-2">
                    </a>
                    <a href="https://www.facebook.com/DAYLIGHTCAFEBSUGRACELANDMALOLOS" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web -daylightcafe.png" alt="Daylight Cafe" class="max-w-full max-h-full object-contain p-2">
                    </a>
                    <a href="https://www.facebook.com/SunKist2022" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web - sunkist.png" alt="Sun Kist Enterprise" class="max-w-full max-h-full object-contain p-2">
                    </a>
                    <a href="https://www.facebook.com/StartUpPodcastPH" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web - YR - Start Up Podcast PH.png" alt="Start Up Podcast PH" class="max-w-full max-h-full object-contain p-2">
                    </a>
                    <a href="https://phstartup.online/" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center p-4 transform transition-transform duration-300 hover:scale-[1.05] w-40 h-30">
                        <img src="./Partners/web-phstartuponline_trans.png" alt="Start Up Podcast PH" class="max-w-full max-h-full object-contain p-2">
                    </a>
                </div>
            </div>
        </section>
    </div>
</main>
<?php include '_footer.php'; ?>
