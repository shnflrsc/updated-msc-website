<?php include '_header.php'; ?>
    
<img src="./Mascot/4.png" id="mascot-left" class="mascot-float hidden md:block">
<img src="./Mascot/3.png" id="mascot-right" class="mascot-float hidden md:block">

<div class="gradient-bg">
    <main class="container mx-auto px-4 pt-24 md:pt-32 pb-16">
        <h1 class="text-4xl md:text-6xl text-center font-bold mb-12">Previous Activities</h1>

        <div class="grid grid-cols-1 gap-12">
            <div class="activities-card rounded-2xl p-8 flex flex-col md:flex-row items-center gap-8" onclick="showEventDetails(1)" style="background-image: url('./PrevActivities/Salubong/BGSalubong.png');">
                <img src="./PrevActivities/Salubong/Salubong 2024.png" alt="Salubong 2024" class="w-48 h-48 object-contain rounded-xl relative z-20">
                <div class="flex-1 text-center md:text-left relative z-20">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">Salubong 2024</h2>
                    <div class="text-lg text-gray-300 mb-4">
                        <p class="font-bold">August 21 and 27, 2024</p>
                        <p>234 Registered Members</p>
                    </div>
                    <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                        Joined the university-wide "Freshies Week" or known as "Salubong" and set-up a small booth to launch a two-day membership drive with the goal to interact and encourage BulSUans to joining the organization. The booth had activities, free snacks, and giveaways prepared by the Executive Board.
                    </p>
                </div>
            </div>

            <div class="activities-card reverse-gradient rounded-2xl p-8 flex flex-col md:flex-row-reverse items-center gap-8" onclick="showEventDetails(2)" style="background-image: url('./PrevActivities/Merch/BGMerch.png');">
                <img src="./PrevActivities/Merch/Merch.png" alt="Threaded with Tech" class="w-48 h-48 object-contain rounded-xl relative z-20">
                <div class="flex-1 text-center md:text-left relative z-20">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">Threaded with Tech</h2>
                    <div class="text-lg text-gray-300 mb-4">
                        <p class="font-bold">2025-2026</p>
                        <p>284 Total Orders, 100 T-Shirts Sold, 184 Lanyards Sold</p>
                    </div>
                    <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                        Exclusive and well-crafted merchandise were sold and distributed to members and non-members of the organization. This project spanned from November 18, 2024, to February 24, 2025, covering all stages, from initial planning and supplier negotiation to order fulfillment and distribution.
                    </p>
                </div>
            </div>

            <div class="activities-card rounded-2xl p-8 flex flex-col md:flex-row items-center gap-8" onclick="showEventDetails(3)" style="background-image: url('./PrevActivities/GLWL/GLWLBG.png');">
                <img src="./PrevActivities/GLWL/GLWL.png" alt="Get Linked with LinkedIn" class="w-48 h-48 object-contain rounded-xl relative z-20">
                <div class="flex-1 text-center md:text-left relative z-20">
                    <h2 class="text-3xl md::text-4xl font-bold mb-4 text-[#b9da05]">Get Linked with LinkedIn</h2>
                    <div class="text-lg text-gray-300 mb-4">
                        <p class="font-bold">March 8, 2025</p>
                        <p>170+ Participants, 7 Event Partners, 1 Media Partner</p>
                    </div>
                    <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                        This webinar navigated the basic interface of LinkedIn and one's profile to effectively attract potential recruiters and business opportunities. Participated by mostly third year and fourth year BulSUans, this aims to equip them with the essential digital literacy and networking skills needed to launch their future careers and secure valuable professional connections in today's competitive landscape.
                    </p>
                </div>
            </div>
            
            <div class="activities-card reverse-gradient rounded-2xl p-8 flex flex-col md:flex-row-reverse items-center gap-8" onclick="showEventDetails(4)" style="background-image: url('./PrevActivities/B2B/BGB2B L.png');">
                <img src="./PrevActivities/B2B/B2B.png" alt="Back to the Basics" class="w-48 h-48 object-contain rounded-xl relative z-20">
                <div class="flex-1 text-center md:text-left relative z-20">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">Back to the Basics</h2>
                    <div class="text-lg text-gray-300 mb-4">
                        <p class="font-bold">April 5, 8, and 12, 2025</p>
                        <p>144 Verified Participants, 3 Successful Webinars, 12 Apps Discussed</p>
                    </div>
                    <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                        This three-day webinar explored the Microsoft 365 ecosystem and its application for academic research and professional purposes, participated by BulSUans across different colleges. The speakers from this event came from the Microsoft Youth Ambassadors (MYA) across the country, experienced in the field of integrating technology in academic and professional endeavors.
                    </p>
                </div>
            </div>

            <div class="activities-card rounded-2xl p-8 flex flex-col md:flex-row items-center gap-8" onclick="showEventDetails(5)" style="background-image: url('./PrevActivities/GA/QuantumVerseBGL.png');">
                <img src="./PrevActivities/GA/QuantumVerse.png" alt="QuantumVerse" class="w-48 h-48 object-contain rounded-xl relative z-20">
                <div class="flex-1 text-center md:text-left relative z-20">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">QuantumVerse</h2>
                    <div class="text-lg text-gray-300 mb-4">
                        <p class="font-bold">January 23, 2025</p>
                        <p>55 Registered Members, 6 Event Partners</p>
                    </div>
                    <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                        This was the first general assembly for all BULSUans to introduce them to the organization and Microsoft-related student programs and technologies. The event showcased the Microsoft Learn Student Ambassadors (MLSA) Program through engaging discussions, fun activities, and a raffle with prizes.
                    </p>
                </div>
            </div>
            
            <div class="activities-card reverse-gradient rounded-2xl p-8 flex flex-col md:flex-row-reverse items-center gap-8" onclick="showEventDetails(6)" style="background-image: url('./PrevActivities/PitchTech/PitchTech_Background.png');">
                <img src="./PrevActivities/PitchTech/PitchTech_Title.png" alt="PitchTech Bootcamp" class="w-48 h-48 object-contain rounded-xl relative z-20">
                <div class="flex-1 text-center md:text-left relative z-20">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">PitchTech Bootcamp</h2>
                    <div class="text-lg text-gray-300 mb-4">
                        <p class="font-bold">September 29, 2023</p>
                        <p>Participants from various colleges and year levels</p>
                    </div>
                    <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                        The PitchTech Bootcamp equipped participants with the necessary skills and confidence to present their technological innovations effectively. By enhancing their pitching abilities, the organization empowered its members to showcase their ideas compellingly, increasing their chances of securing funding, partnerships, and support for their tech projects.
                    </p>
                </div>
            </div>

            <div class="activities-card rounded-2xl p-8 flex flex-col md:flex-row items-center gap-8" onclick="showEventDetails(7)" style="background-image: url('./PrevActivities/Azure MVP/BG L Microsoft Learn with MVPs.png');">
                <img src="./PrevActivities/Azure MVP/MLMVP dark.png" alt="Microsoft Learn with MVPs" class="w-48 h-48 object-contain rounded-xl relative z-20">
                <div class="flex-1 text-center md:text-left relative z-20">
                    <h2 class="text-3xl md::text-4xl font-bold mb-4 text-[#b9da05]">Microsoft Learn with MVPs</h2>
                    <div class="text-lg text-gray-300 mb-4">
                        <p class="font-bold">May 2, 2025</p>
                        <p>21 BulSU MSC Attendees</p>
                    </div>
                    <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                        Attendees went to the Microsoft Philippine Headquarters in Makati City to learn about Azure Data Fundamentals and Azure AI Services from Mr. Pio Balistoy and Mr. Ziggy Zulueta. The event included a pizza and soda party after the seminar.
                    </p>
                </div>
            </div>
            
            <div class="activities-card reverse-gradient rounded-2xl p-8 flex flex-col md:flex-row-reverse items-center gap-8" onclick="showEventDetails(8)" style="background-image: url('./PrevActivities/Zuitt/FCBZuittBGL.png');">
                <img src="./PrevActivities/Zuitt/FCBZuitt.png" alt="ZUITT Free Coding Bootcamp" class="w-48 h-48 object-contain rounded-xl relative z-20">
                <div class="flex-1 text-center md:text-left relative z-20">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">ZUITT Free Coding Bootcamp</h2>
                    <div class="text-lg text-gray-300 mb-4">
                        <p class="font-bold">April 25, 2025</p>
                        <p>90+ Attendees, 3 Tools Taught</p>
                    </div>
                    <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                        This virtual coding bootcamp, presented by Zuitt Tech Programs, covered the basics of web development with HTML, CSS, and Bootstrap. Attendees participated in quick exercises to reinforce the concepts they learned.
                    </p>
                </div>
            </div>
            
        </div>
        </main>
        
    <div id="event-modal" class="modal-backdrop hidden">
        <div id="event-modal-content" class="modal-content">
            <button id="modal-close-button" class="modal-close-button">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-scroll-area">
                <div id="modal-body" class="p-4">
                    <div id="event-content-1" class="hidden" data-background-image="./PrevActivities/Salubong/BGSalubong.png">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <img src="./PrevActivities/Salubong/Salubong 2024.png" alt="Salubong 2024" class="w-48 h-48 object-contain rounded-xl z-20">
                            <div class="flex-1 text-center md:text-left z-20">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">Salubong 2024</h2>
                                <div class="text-lg text-gray-300 mb-4">
                                    <p class="font-bold">August 21 and 27, 2024</p>
                                    <p>234 Registered Members</p>
                                </div>
                                <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                                    Joined the university-wide "Freshies Week" or known as "Salubong" and set-up a small booth to launch a two-day membership drive with the goal to interact and encourage BulSUans to joining the organization. The booth had activities, free snacks, and giveaways prepared by the Executive Board.
                                </p>
                            </div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <img src="./PrevActivities/Salubong/_MG_3720.JPG" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/Salubong/_MG_3745.JPG" alt="Event Photo" class="rounded-lg">
                        </div>
                    </div>
                    <div id="event-content-2" class="hidden" data-background-image="./PrevActivities/Merch/BGMerch.png">
                        <div class="flex flex-col md:flex-row-reverse items-center gap-8">
                            <img src="./PrevActivities/Merch/Merch.png" alt="Threaded with Tech" class="w-48 h-48 object-contain rounded-xl z-20">
                            <div class="flex-1 text-center md:text-left z-20">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">Threaded with Tech</h2>
                                <div class="text-lg text-gray-300 mb-4">
                                    <p class="font-bold">2025-2026</p>
                                    <p>284 Total Orders, 100 T-Shirts Sold, 184 Lanyards Sold</p>
                                </div>
                                <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                                    Exclusive and well-crafted merchandise were sold and distributed to members and non-members of the organization. This project spanned from November 18, 2024, to February 24, 2025, covering all stages, from initial planning and supplier negotiation to order fulfillment and distribution.
                                </p>
                            </div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <img src="./PrevActivities/Merch/Shirt.png" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/Merch/Lanyard.png" alt="Event Photo" class="rounded-lg">
                        </div>
                    </div>
                    <div id="event-content-3" class="hidden" data-background-image="./PrevActivities/GLWL/GLWLBG S.png">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <img src="./PrevActivities/GLWL/GLWLwht.png" alt="Get Linked with LinkedIN" class="w-48 h-48 object-contain rounded-xl z-20">
                            <div class="flex-1 text-center md:text-left z-20">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">Get Linked with LinkedIn</h2>
                                <div class="text-lg text-gray-300 mb-4">
                                    <p class="font-bold">March 8, 2025</p>
                                    <p>170+ Participants, 7 Event Partners, 1 Media Partner</p>
                                </div>
                                <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                                    This webinar navigated the basic interface of LinkedIn and one's profile to effectively attract potential recruiters and business opportunities. Participated by mostly third year and fourth year BulSUans, this aims to equip them with the essential digital literacy and networking skills needed to launch their future careers and secure valuable professional connections in today's competitive landscape.
                                </p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-2xl font-bold mb-4 text-[#b9da05]">Partners</h3>
                            <div class="flex flex-wrap justify-center items-center gap-2">
                                <img src="./PrevActivities/GLWL/cbealsc.png" alt="CBEA LSC" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GLWL/chtmlsc.png" alt="CHTM LSC" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GLWL/CS LSC.png" alt="CS LSC" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GLWL/BLISS logo.png" alt="BLISS" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GLWL/CYBL LOGO.png" alt="CYBL" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GLWL/MATHSOC w backing.png" alt="MathSoc" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GLWL/SWITSv5.png" alt="SWITS" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GLWL/cursor.png" alt="Cursor Publication" class="w-24 h-12 object-contain p-0">
                            </div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <img src="./PrevActivities/GLWL/pic1.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/GLWL/pic2.jpg" alt="Event Photo" class="rounded-lg">
                        </div>
                    </div>
                    <div id="event-content-4" class="hidden" data-background-image="./PrevActivities/B2B/BGB2B S.png">
                        <div class="flex flex-col md:flex-row-reverse items-center gap-8">
                            <img src="./PrevActivities/B2B/B2B.png" alt="Back to the Basics" class="w-48 h-48 object-contain rounded-xl z-20">
                            <div class="flex-1 text-center md:text-left z-20">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">Back to the Basics</h2>
                                <div class="text-lg text-gray-300 mb-4">
                                    <p class="font-bold">April 5, 8, and 12, 2025</p>
                                    <p>144 Verified Participants, 3 Successful Webinars, 12 Apps Discussed</p>
                                </div>
                                <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                                    This three-day webinar explored the Microsoft 365 ecosystem and its application for academic research and professional purposes, participated by BulSUans across different colleges. The speakers from this event came from the Microsoft Youth Ambassadors (MYA) across the country, experienced in the field of integrating technology in academic and professional endeavors.
                                </p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="flex flex-wrap justify-center items-center gap-3">
                                <img src="./PrevActivities/B2B/BGri.png" alt="Beyond the Grind" class="w-22 h-20 object-contain p-1">
                                <img src="./PrevActivities/B2B/BDes.png" alt="Beyond the Desk" class="w-22 h-20 object-contain p-1">
                                <img src="./PrevActivities/B2B/BObv.png" alt="Beyond the Obvious" class="w-22 h-20 object-contain p-1">
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-2xl font-bold mb-4 text-[#b9da05]">Apps Explained</h3>
                            <div class="flex flex-wrap justify-center items-center gap-1">
                                <img src="./PrevActivities/B2B/word.png" alt="Word" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/ppt.png" alt="Powerpoint" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/onenote.png" alt="OneNote" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/tofo.png" alt="To Do" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/outlook.png" alt="Outlook" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/teams.png" alt="Teams" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/whiteboard.png" alt="Whiteboard" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/loop.png" alt="Loop" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/forms.png" alt="Forms" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/Steram.png" alt="Stream" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/od.png" alt="OneDrive" class="w-40 h-28 object-contain p-1">
                                <img src="./PrevActivities/B2B/excel.png" alt="Excel" class="w-40 h-28 object-contain p-1">
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-2xl font-bold mb-4 text-[#b9da05]">Partners</h3>
                            <div class="flex flex-wrap justify-center items-center gap-2">
                                <img src="./PrevActivities/B2B/CS LSC.png" alt="CS LSC" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/LSC.png" alt="CICT LSC" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/LOGO - PCSMT.jpg" alt="PCSMT" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/PAFT.png" alt="PAFT" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/Rotaract Logo_EN21 (1) (1).png" alt="Rotaract BulSU" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/SWITSv5.png" alt="SWITS" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/SOTLES Logo (Transparent).png" alt="SOTLES" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/Techno Paragons Logo_No Background.png" alt="TP" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/LOGO REAL.png" alt="VolComm" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/SPICE LOGO.png" alt="SPICE" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/Kapimapa.png" alt="Kapimapa" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/BLISS logo.png" alt="BLISS" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/MATHSOC w backing.png" alt="MathSoc" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/B2B/sme.png" alt="SME BulSU SC" class="w-24 h-12 object-contain p-0">
                            </div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <img src="./PrevActivities/B2B/pic1.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/B2B/pic2.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/B2B/pic3.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/B2B/pic4.jpg" alt="Event Photo" class="rounded-lg">
                        </div>
                    </div>
                    <div id="event-content-5" class="hidden" data-background-image="./PrevActivities/GA/QuantumverseBGS.png">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <img src="./PrevActivities/GA/QuantumVerse.png" alt="QuantumVerse Logo" class="w-48 h-48 object-contain rounded-xl z-20">
                            <div class="flex-1 text-center md:text-left z-20">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">QuantumVerse</h2>
                                <div class="text-lg text-gray-300 mb-4">
                                    <p class="font-bold">September 1, 2023</p>
                                    <p>55 Registered Members, 6 Event Partners</p>
                                </div>
                                <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                                    This was the first general assembly for all BULSUans to introduce them to the organization and Microsoft-related student programs and technologies. The event showcased the Microsoft Learn Student Ambassadors (MLSA) Program through engaging discussions, fun activities, and a raffle with prizes.
                                </p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-2xl font-bold mb-4 text-[#b9da05]">Partners</h3>
                            <div class="flex flex-wrap justify-center items-center gap-4">
                                <img src="./PrevActivities/GA/Avocadoria.png" alt="Avocadoria" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GA/Pluma.png" alt="Pluma" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GA/Palpitate.png" alt="Palpitate" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GA/SF.png" alt="Simply Froyo" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GA/TheCrunch.png" alt="The Crunch" class="w-24 h-12 object-contain p-0">
                                <img src="./PrevActivities/GA/Wang.png" alt="Wang Scents" class="w-24 h-12 object-contain p-0">
                            </div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <img src="./PrevActivities/GA/pic1.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/GA/pic2.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/GA/pic3.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/GA/pic4.jpg" alt="Event Photo" class="rounded-lg">
                        </div>
                    </div>
                    <div id="event-content-6" class="hidden" data-background-image="./PrevActivities/PitchTech/PitchTech_Background.png">
                        <div class="flex flex-col md:flex-row-reverse items-center gap-8">
                            <img src="./PrevActivities/PitchTech/PitchTech_Title.png" alt="PitchTech Bootcamp Logo" class="w-48 h-48 object-contain rounded-xl z-20">
                            <div class="flex-1 text-center md:text-left z-20">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">PitchTech Bootcamp</h2>
                                <div class="text-lg text-gray-300 mb-4">
                                    <p class="font-bold">September 29, 2023</p>
                                    <p>Participants from various colleges and year levels</p>
                                </div>
                                <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                                    The PitchTech Bootcamp equipped participants with the necessary skills and confidence to present their technological innovations effectively. By enhancing their pitching abilities, the organization empowered its members to showcase their ideas compellingly, increasing their chances of securing funding, partnerships, and support for their tech projects.
                                </p>
                            </div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <img src="./PrevActivities/PitchTech/pic1.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/PitchTech/pic2.jpg" alt="Event Photo" class="rounded-lg">
                        </div>
                    </div>
                    <div id="event-content-7" class="hidden" data-background-image="./PrevActivities/Azure MVP/BG S Microsoft Learn with MVPs.png">
                        <div class="flex flex-col md:flex-row items-center gap-8">
                            <img src="./PrevActivities/Azure MVP/MLMVP.png" alt="Microsoft Learn with MVPs Logo" class="w-48 h-48 object-contain rounded-xl z-20">
                            <div class="flex-1 text-center md:text-left z-20">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">Microsoft Learn with MVPs</h2>
                                <div class="text-lg text-gray-300 mb-4">
                                    <p class="font-bold">May 2, 2025</p>
                                    <p>21 BulSU MSC Attendees</p>
                                </div>
                                <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                                    Attendees went to the Microsoft Philippine Headquarters in Makati City to learn about Azure Data Fundamentals and Azure AI Services from Mr. Pio Balistoy and Mr. Ziggy Zulueta. The event included a pizza and soda party after the seminar.
                                </p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-2xl font-bold mb-4 text-[#b9da05]">Partners</h3>
                            <div class="flex flex-wrap justify-center items-center gap-4">
                                <img src="./PrevActivities/Azure MVP/MSC PLM.png" alt="MSC-PLM" class="w-24 h-12 object-contain p-0">
                            </div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <img src="./PrevActivities/Azure MVP/pic1.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/Azure MVP/pic2.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/Azure MVP/pic3.jpg" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/Azure MVP/pic5.jpg" alt="Event Photo" class="rounded-lg">
                        </div>
                    </div>
                    <div id="event-content-8" class="hidden" data-background-image="./PrevActivities/Zuitt/FCBZuittBGS.png">
                        <div class="flex flex-col md:flex-row-reverse items-center gap-8">
                            <img src="./PrevActivities/Zuitt/FCBZuitt.png" alt="ZUITT Free Coding Bootcamp" class="w-48 h-48 object-contain rounded-xl z-20">
                            <div class="flex-1 text-center md:text-left z-20">
                                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#b9da05]">ZUITT Free Coding Bootcamp</h2>
                                <div class="text-lg text-gray-300 mb-4">
                                    <p class="font-bold">April 25, 2025</p>
                                    <p>90+ Attendees, 3 Tools Taught</p>
                                </div>
                                <p class="text-gray-400 text-base md:text-lg leading-relaxed">
                                    This virtual coding bootcamp, presented by Zuitt Tech Programs, covered the basics of web development with HTML, CSS, and Bootstrap. Attendees participated in quick exercises to reinforce the concepts they learned.
                                </p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-2xl font-bold mb-4 text-[#b9da05]">Partners</h3>
                            <div class="flex flex-wrap justify-center items-center gap-4">
                                <img src="./PrevActivities/Zuitt/zuitt.png" alt="Zuitt" class="w-24 h-12 object-contain p-0">
                            </div>
                        </div>
                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <img src="./PrevActivities/Zuitt/pic1.png" alt="Event Photo" class="rounded-lg">
                            <img src="./PrevActivities/Zuitt/pic2.png" alt="Event Photo" class="rounded-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="status-modal" class="modal-backdrop hidden">
        <div class="status-modal-content">
            <button id="status-modal-close-button" class="status-modal-close-button">
                <i class="fas fa-times"></i>
            </button>
            <div class="flex flex-col items-center">
                <div class="text-[#b9da05] mb-4">
                    <i class="fas fa-info-circle text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Login Feature</h3>
                <p id="modal-message" class="text-gray-300 text-lg">Available soon</p>
            </div>
        </div>
    </div>

    <script>
        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuIcon = document.getElementById('mobile-menu-icon');
        
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
                if (mobileMenu.classList.contains('active')) {
                    mobileMenuIcon.classList.remove('fa-bars');
                    mobileMenuIcon.classList.add('fa-xmark');
                    document.body.style.overflow = 'hidden';
                } else {
                    mobileMenuIcon.classList.remove('fa-xmark');
                    mobileMenuIcon.classList.add('fa-bars');
                    document.body.style.overflow = '';
                }
            });
        }
        
        // Modal Functionality
        const eventModal = document.getElementById('event-modal');
        const eventModalContent = document.getElementById('event-modal-content');
        const eventModalCloseButton = document.getElementById('modal-close-button');

        function showEventDetails(eventId) {
            // Hide all event content
            document.querySelectorAll('[id^="event-content-"]').forEach(content => {
                content.classList.add('hidden');
            });
            // Show the specific event content
            const eventContent = document.getElementById(`event-content-${eventId}`);
            if (eventContent) {
                eventContent.classList.remove('hidden');
                // Set the specific background image for the modal content using the data attribute
                const backgroundImage = eventContent.getAttribute('data-background-image');
                eventModalContent.style.backgroundImage = `url('${backgroundImage}')`;
                
                eventModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function hideEventModal() {
            // Remove the background image when hiding the modal
            eventModalContent.style.backgroundImage = 'none';

            eventModal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        if (eventModalCloseButton) {
            eventModalCloseButton.addEventListener('click', hideEventModal);
        }
        
        if (eventModal) {
            eventModal.addEventListener('click', (e) => {
                if (e.target === eventModal) {
                    hideEventModal();
                }
            });
        }
        
        // --- Custom Modal Functionality for "Login" button ---
        const loginButtonDesktop = document.getElementById('login-button-desktop');
        const loginButtonMobile = document.getElementById('login-button-mobile');
        const statusModal = document.getElementById('status-modal');
        const statusModalCloseButton = document.getElementById('status-modal-close-button');
        const modalMessage = document.getElementById('modal-message');

        // I will change the behavior of the login buttons here to redirect
        function showStatusModal(message) {
            modalMessage.textContent = message;
            statusModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent body scrolling
        }

        function hideStatusModal() {
            statusModal.classList.add('hidden');
            document.body.style.overflow = ''; // Restore body scrolling
        }
        
        if (loginButtonDesktop) {
            loginButtonDesktop.addEventListener('click', () => {
                // hideStatusModal(); // No need to hide the modal if we redirect immediately
                window.location.href = 'login.html';
            });
        }
        if (loginButtonMobile) {
            loginButtonMobile.addEventListener('click', () => {
                // hideStatusModal(); // No need to hide the modal if we redirect immediately
                window.location.href = 'login.html';
            });
        }
        // I'll keep the modal functionality for the other parts of the site that might use it
        if (statusModalCloseButton) {
            statusModalCloseButton.addEventListener('click', hideStatusModal);
        }

        if (statusModal) {
            statusModal.addEventListener('click', (e) => {
                if (e.target === statusModal) {
                    hideStatusModal();
                }
            });
        }

        // Mascot scroll animation
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    } else {
                        entry.target.classList.remove('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.mascot-float').forEach(element => {
                observer.observe(element);
            });

            // Header scroll effect
            const header = document.getElementById('main-header');
            const mainContent = document.querySelector('main');
            if (mainContent && window.scrollY > mainContent.offsetTop) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        });
        
        // Add new event listener to prevent right-click and long-press on images
        document.addEventListener('contextmenu', function(e) {
            if (e.target.nodeName === 'IMG') {
                e.preventDefault();
            }
        });
        
        document.addEventListener('touchstart', function(e) {
            if (e.target.nodeName === 'IMG') {
                e.preventDefault();
            }
        }, { passive: false });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('main-header');
            const mainContent = document.querySelector('main');
            if (mainContent && window.scrollY > mainContent.offsetTop) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        });
    </script>
</div>

<?php include '_footer.php'; ?>
