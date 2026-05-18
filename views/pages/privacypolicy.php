<?php
// Ensure this is included through feed.php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("Location: ../../feed.php?page=privacy");
    exit;
}
?>
<div class="max-w-6xl mx-auto px-4 py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Quick Nav Sidebar (Visible on Desktop) -->
        <div class="hidden lg:block lg:col-span-1">
            <div class="sticky top-24 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-4">Privacy Index</h3>
                <nav class="space-y-3">
                    <a href="#information-collection" class="block text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">1. Information We Collect</a>
                    <a href="#how-we-use" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">2. How We Use Data</a>
                    <a href="#data-sharing" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">3. Information Sharing</a>
                    <a href="#security" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">4. Data Security</a>
                    <a href="#user-rights" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">5. Your Controls & Rights</a>
                    <a href="#cookies" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">6. Cookies & Tracking</a>
                    <a href="#retention" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">7. Data Retention</a>
                    <a href="#contact-us" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">8. Contact Us</a>
                </nav>
            </div>
        </div>
        
        <!-- Privacy Body -->
        <div class="lg:col-span-3 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-10">
            
            <!-- Page Title -->
            <div class="border-b border-gray-100 dark:border-gray-700 pb-6 mb-8">
                <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">OurTracker Legal</span>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mt-1">Privacy Policy</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Last updated: May 18, 2026</p>
            </div>

            <!-- Content Sections -->
            <div class="space-y-8 text-gray-600 dark:text-gray-300 leading-relaxed text-sm md:text-base">
                
                <section id="information-collection" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">1.</span>
                        Information We Collect
                    </h2>
                    <p>We collect information to support your internship registration, attendance auditing, and program coordination. This includes:</p>
                    <ul class="list-disc pl-5 mt-2 space-y-1.5">
                        <li><strong>Identity Data:</strong> Full name, nickname, email address, password hash, and birthdate.</li>
                        <li><strong>Google OAuth Data:</strong> If logged in via Google Auth, we access your authorized public email address and name.</li>
                        <li><strong>Demographics & Location:</strong> Contact number, specific street address, region, province, city, and zip code (sourced cleanly using the Philippine PSGC location directory).</li>
                        <li><strong>Workplace Details:</strong> Assigned Office, Organization, and role category (Intern vs. Supervisor/Admin).</li>
                        <li><strong>Activity Logs:</strong> Daily check-in timestamps, total hours tracked, and submitted accomplishment descriptions.</li>
                    </ul>
                </section>

                <section id="how-we-use" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">2.</span>
                        How We Use Your Data
                    </h2>
                    <p>Your demographic and geographic data is used exclusively to fulfill administrative records requested by your supervisor or academic coordinator. Specific uses include:</p>
                    <ul class="list-disc pl-5 mt-2 space-y-1.5">
                        <li>Fulfilling legal and educational requirements for auditing intern placement records.</li>
                        <li>Validating physical attendance and check-in integrity.</li>
                        <li>Providing dynamic metrics and tracking reports for supervisors.</li>
                        <li>Adapting dark/light themes according to saved UI settings.</li>
                    </ul>
                </section>

                <section id="data-sharing" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">3.</span>
                        Information Sharing
                    </h2>
                    <p>We values your trust. <strong>We do not sell, rent, or lease your private data to third-party advertisers.</strong> Your information is visible only to:</p>
                    <ul class="list-disc pl-5 mt-2 space-y-1.5">
                        <li>Your designated <strong>Supervisor / Administrator</strong>, who accesses it to review timesheets, print reports, and manage intern placement files.</li>
                        <li>Other interns inside your organization (if your account visibility is set to <strong>"Public"</strong>). When set to public, peers can view your nickname and overall hours completed.</li>
                    </ul>
                </section>

                <section id="security" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">4.</span>
                        Data Security
                    </h2>
                    <p>We deploy standard security protocols to safeguard your credentials. Passwords are secured using a strong **SHA-256 HMAC hash** matching your unique environmental key. Additionally, CSRF protection secures your forms and AJAX endpoints against session hijacking.</p>
                </section>

                <section id="user-rights" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">5.</span>
                        Your Controls & Rights
                    </h2>
                    <p>You maintain ultimate control over your settings. You can edit your profile details (such as names, organization, and password) directly from the **Profile settings page**, or toggle your profile privacy between Public and Private status to dictate what other students can see.</p>
                </section>

                <section id="cookies" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">6.</span>
                        Cookies & Tracking
                    </h2>
                    <p>OurTracker uses simple secure PHP session cookies (`PHPSESSID`) to maintain active login states and remember user preferences. These cookies contain no plaintext identifying information and are destroyed when you log out.</p>
                </section>

                <section id="retention" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">7.</span>
                        Data Retention
                    </h2>
                    <p>We retain your profile data and historical logged hours as long as your account remains active in your institution's registration list. To delete your account or purge timesheet records, please coordinate with your supervisor or administrator.</p>
                </section>

                <section id="contact-us" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">8.</span>
                        Contact Us
                    </h2>
                    <p>If you have any questions or concerns regarding our privacy practices, please contact your university placement coordinator or institutional system administrator.</p>
                </section>
                
            </div>

            <!-- Footer Action -->
            <div class="border-t border-gray-100 dark:border-gray-700 pt-8 mt-12 text-center">
                <p class="text-xs text-gray-400 dark:text-gray-500">Your trust and privacy are paramount to the success of your internship track.</p>
                <div class="mt-4">
                    <a href="feed.php?page=dashboard" class="inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-sm transition duration-200 text-sm">
                        Return to Dashboard
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
// Active Index Highlight on Scroll
window.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            const id = entry.target.getAttribute('id');
            const navLink = document.querySelector(`nav a[href="#${id}"]`);
            if (navLink) {
                if (entry.intersectionRatio > 0) {
                    document.querySelectorAll('nav a').forEach(a => a.classList.replace('text-indigo-600', 'text-gray-600'));
                    document.querySelectorAll('nav a').forEach(a => a.classList.replace('dark:text-indigo-400', 'dark:text-gray-400'));
                    navLink.classList.replace('text-gray-600', 'text-indigo-600');
                    navLink.classList.replace('dark:text-gray-400', 'dark:text-indigo-400');
                }
            }
        });
    });

    // Track all sections
    document.querySelectorAll('section[id]').forEach((section) => {
        observer.observe(section);
    });
});
</script>
