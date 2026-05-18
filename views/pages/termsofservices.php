<?php
// Ensure this is included through feed.php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("Location: ../../feed.php?page=terms");
    exit;
}
?>
<div class="max-w-6xl mx-auto px-4 py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Quick Nav Sidebar (Visible on Desktop) -->
        <div class="hidden lg:block lg:col-span-1">
            <div class="sticky top-24 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-4">Table of Contents</h3>
                <nav class="space-y-3">
                    <a href="#acceptance" class="block text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">1. Acceptance of Terms</a>
                    <a href="#user-accounts" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">2. User Accounts & Registration</a>
                    <a href="#hours-tracking" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">3. Hours Tracking & Integrity</a>
                    <a href="#privacy" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">4. Privacy & Data Protection</a>
                    <a href="#acceptable-use" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">5. Acceptable Use Policy</a>
                    <a href="#liability" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">6. Limitation of Liability</a>
                    <a href="#termination" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">7. Account Termination</a>
                    <a href="#changes" class="block text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">8. Changes to Terms</a>
                </nav>
            </div>
        </div>
        
        <!-- Terms Body -->
        <div class="lg:col-span-3 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 md:p-10">
            
            <!-- Page Title -->
            <div class="border-b border-gray-100 dark:border-gray-700 pb-6 mb-8">
                <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">OurTracker Legal</span>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mt-1">Terms of Service</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Last updated: May 18, 2026</p>
            </div>

            <!-- Content Sections -->
            <div class="space-y-8 text-gray-600 dark:text-gray-300 leading-relaxed text-sm md:text-base">
                
                <section id="acceptance" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">1.</span>
                        Acceptance of Terms
                    </h2>
                    <p>By registering for or using <strong>OurTracker</strong> ("the Service"), you agree to be bound by these Terms of Service. If you are using this Service on behalf of an institution, university, organization, or employer, you represent that you have the authority to bind that entity to these terms.</p>
                </section>

                <section id="user-accounts" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">2.</span>
                        User Accounts & Security
                    </h2>
                    <p>To access OurTracker, you must log in using authorized credentials, including third-party OAuth authentication such as Google Accounts. You agree to:</p>
                    <ul class="list-disc pl-5 mt-2 space-y-1.5">
                        <li>Provide accurate, current, and complete profile information including your birthdate, contact details, and location.</li>
                        <li>Maintain the confidentiality and security of your account sessions and credentials.</li>
                        <li>Immediately notify system administrators of any unauthorized use or security breaches.</li>
                    </ul>
                </section>

                <section id="hours-tracking" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">3.</span>
                        Hours Tracking & Integrity
                    </h2>
                    <p>OurTracker is dedicated to precise time tracking for student internships and employee hour logging. By logging time, you certify the following:</p>
                    <div class="bg-gray-50 dark:bg-gray-900/40 border-l-4 border-indigo-500 rounded-r-xl p-4 my-3 text-sm italic">
                        "I verify that all hours, accomplishment reports, check-in logs, and absence requests submitted through this platform represent true, authentic work sessions and correspond to my actual attendance."
                    </div>
                    <p>Any falsification of hours, automated time logging using bot scripts, or submitting misleading attendance data is strictly prohibited and constitutes a breach of academic or professional integrity, which may be reported directly to your supervisor or university administrator.</p>
                </section>

                <section id="privacy" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">4.</span>
                        Privacy & Data Protection
                    </h2>
                    <p>Your privacy is important to us. Information gathered through the profile completion form (such as your address, phone number, and birthdate) is used strictly to fulfill database records required by your supervisor or academic coordinator.</p>
                    <p class="mt-2">By choosing to toggle your profile visibility to "Public", you agree that designated supervisors, administrators, and peers within your organizational directory can view your tracked totals and logged hours.</p>
                </section>

                <section id="acceptable-use" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">5.</span>
                        Acceptable Use Policy
                    </h2>
                    <p>You agree not to abuse the system by executing excessive automated queries, attempting SQL injections, circumventing CSRF protection, or uploading malicious code. Any deliberate attempt to compromise database integrity will result in instant IP blocking.</p>
                </section>

                <section id="liability" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">6.</span>
                        Limitation of Liability
                    </h2>
                    <p>The Service is provided on an "AS IS" and "AS AVAILABLE" basis. OurTracker makes no warranties regarding the uptime of the system or that logged historical data will never be subject to accidental database loss. We highly recommend interns export regular CSV reports of their hours for backup purposes.</p>
                </section>

                <section id="termination" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">7.</span>
                        Account Termination
                    </h2>
                    <p>We reserve the right to suspend or terminate your access to the Service at any time, without prior notice, in the event of fraudulent activity, breach of integrity, or violations of these terms.</p>
                </section>

                <section id="changes" class="scroll-mt-24">
                    <h2 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">8.</span>
                        Changes to Terms
                    </h2>
                    <p>We reserve the right to modify these terms at any time. Any revisions will be posted directly to this page and the "Last updated" date will be revised accordingly. Continued usage of the application following changes implies your agreement to the new terms.</p>
                </section>
                
            </div>

            <!-- Footer Action -->
            <div class="border-t border-gray-100 dark:border-gray-700 pt-8 mt-12 text-center">
                <p class="text-xs text-gray-400 dark:text-gray-500">If you have any questions regarding these Terms, please contact your organizational administrator or system developer.</p>
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
// Active Quick Nav Highlight on Scroll
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
