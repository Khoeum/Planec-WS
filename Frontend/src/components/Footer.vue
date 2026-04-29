<template>
    <footer class="planec-footer">

        <!-- Animated Wave SVG Background -->
        <div class="footer-bg" aria-hidden="true">
            <svg class="wave wave--1" viewBox="0 0 1440 200" preserveAspectRatio="none">
                <path d="M0,80 C240,140 480,20 720,80 C960,140 1200,20 1440,80 L1440,200 L0,200 Z"
                    fill="rgba(57,224,137,0.04)" />
            </svg>
            <svg class="wave wave--2" viewBox="0 0 1440 200" preserveAspectRatio="none">
                <path d="M0,100 C360,40 720,160 1080,100 C1260,70 1360,120 1440,100 L1440,200 L0,200 Z"
                    fill="rgba(15,123,120,0.06)" />
            </svg>
            <div class="bg-glow bg-glow--teal"></div>
            <div class="bg-glow bg-glow--green"></div>
        </div>

        <!-- Separator -->
        <div class="footer-sep">
            <div class="sep-line"></div>
            <div class="sep-badge">
                <span class="sep-dot"></span>
                <span class="sep-label">PLANEC</span>
                <span class="sep-sub">CABLE &amp; NETWORK SOLUTION</span>
                <span class="sep-dot"></span>
            </div>
            <div class="sep-line"></div>
        </div>

        <div class="footer-inner">

            <!-- Grid -->
            <div class="footer-grid">

                <!-- Brand -->
                <div class="col col--brand">
                    <div class="brand-head">
                        <div class="brand-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="2" y1="12" x2="22" y2="12" />
                                <path
                                    d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="brand-name">PLAN<span class="brand-accent">EC</span></h2>
                            <p class="brand-sub">Cable &amp; Network Solution</p>
                        </div>
                    </div>
                    <p class="brand-desc">
                        Built by experts in information technology and engineering — ready to power your network today
                        and into the future.
                    </p>
                    <div class="trust-badges">
                        <span class="trust-chip">✓ ISO 9001</span>
                        <span class="trust-chip">✓ AWS Partner</span>
                        <span class="trust-chip">✓ CISA</span>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col">
                    <h3 class="col-head"><span class="col-head__bar"></span>Quick Links</h3>
                    <ul class="link-list">
                        <li v-for="item in navLinks" :key="item">
                            <a href="#" class="footer-link">
                                <svg class="link-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg>
                                {{ item }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Products -->
                <div class="col">
                    <h3 class="col-head"><span class="col-head__bar"></span>Products</h3>
                    <ul class="link-list">
                        <li v-for="item in products" :key="item">
                            <a href="#" class="footer-link">
                                <svg class="link-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg>
                                {{ item }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact + Social -->
                <div class="col col--contact">
                    <h3 class="col-head"><span class="col-head__bar"></span>Get In Touch</h3>
                    <ul class="contact-list">
                        <li class="contact-row">
                            <span class="contact-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </span>
                            <a href="mailto:info@planec.com.kh" class="contact-val">info@planec.com.kh</a>
                        </li>
                        <li class="contact-row">
                            <span class="contact-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.06 1.18a2 2 0 012-2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 6.91a16 16 0 006.59 6.59l.79-1.3a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
                                </svg>
                            </span>
                            <a href="tel:+85512345678" class="contact-val">
                                +855 23 216 425</a>
                        </li>
                        <li class="contact-row">
                            <span class="contact-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </span>
                            <span class="contact-val">Phnom Penh, Cambodia</span>
                        </li>
                    </ul>

                    <!-- Newsletter -->
                    <div class="newsletter">
                        <p class="newsletter-label">Subscribe for updates</p>
                        <div class="newsletter-row" :class="{ 'newsletter-row--focused': focused }">
                            <input v-model="email" type="email" placeholder="Enter your email" class="newsletter-input"
                                @focus="focused = true" @blur="focused = false" @keyup.enter="subscribe" />
                            <button class="newsletter-btn" @click="subscribe">
                                <span v-if="!subscribed">Subscribe</span>
                                <span v-else class="subscribed-check">✓ Done!</span>
                            </button>
                        </div>
                    </div>

                    <!-- Social -->
                    <div class="social-row">
                        <a href="https://youtube.com" target="_blank" class="social-btn" aria-label="YouTube"
                            data-hover="yt">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M22.54 6.42a2.78 2.78 0 00-1.95-1.97C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58zM9.75 15.02V8.98L15.5 12l-5.75 3.02z" />
                            </svg>
                        </a>
                        <a href="https://facebook.com" target="_blank" class="social-btn" aria-label="Facebook"
                            data-hover="fb">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                            </svg>
                        </a>
                        <a href="https://tiktok.com" target="_blank" class="social-btn" aria-label="TikTok"
                            data-hover="tk">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.32 6.32 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.73a4.85 4.85 0 01-1.01-.04z" />
                            </svg>
                        </a>
                        <a href="https://linkedin.com" target="_blank" class="social-btn" aria-label="LinkedIn"
                            data-hover="li">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="footer-bottom">
                <p class="copy">© {{ year }} PLANEC Co., Ltd. All rights reserved.</p>
                <div class="legal">
                    <a href="#" class="legal-link">Privacy Policy</a>
                    <span class="legal-dot">·</span>
                    <a href="#" class="legal-link">Terms of Use</a>
                    <span class="legal-dot">·</span>
                    <a href="#" class="legal-link">Cookie Policy</a>
                </div>
                <p class="origin">🇰🇭 Proudly Cambodian</p>
            </div>

        </div>
    </footer>
</template>

<script setup>
import { ref, computed } from 'vue'

const email = ref('')
const subscribed = ref(false)
const focused = ref(false)

const year = computed(() => new Date().getFullYear())

const navLinks = ['Home', 'About Us', 'Events', 'Partnership', 'Contact Us', 'Shop']
const products = ['Structured Cabling Systems', 'LAN Switches', 'Wireless LAN', 'Network Management', 'IP Telephony', 'Media Conversion']

function subscribe() {
    if (email.value.includes('@')) {
        subscribed.value = true
        email.value = ''
        setTimeout(() => (subscribed.value = false), 3500)
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

.planec-footer {
    --navy-deep: #050e1d;
    --navy-mid: #071b35;
    --teal: #0f7b78;
    --teal-bright: #14a89e;
    --green: #39e089;
    --text-main: #e8f0f8;
    --text-muted: #7a9bb5;
    --text-faint: #3d5f7a;
    --border: rgba(255, 255, 255, 0.07);

    position: relative;
    background: linear-gradient(135deg, var(--navy-deep) 0%, var(--navy-mid) 45%, #0a3848 100%);
    color: var(--text-main);
    font-family: 'Outfit', sans-serif;
    overflow: hidden;
}

.footer-bg {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.wave {
    position: absolute;
    width: 100%;
    bottom: 0;
    left: 0;
}

.wave--1 {
    height: 180px;
    animation: waveFloat 12s ease-in-out infinite alternate;
}

.wave--2 {
    height: 160px;
    animation: waveFloat 9s ease-in-out infinite alternate-reverse;
}

@keyframes waveFloat {
    from {
        transform: scaleX(1) translateY(0);
    }

    to {
        transform: scaleX(1.05) translateY(-12px);
    }
}

.bg-glow {
    position: absolute;
    border-radius: 50%;
    filter: blur(120px);
    opacity: 0.15;
    pointer-events: none;
}

.bg-glow--teal {
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, var(--teal) 0%, transparent 70%);
    top: -200px;
    right: 10%;
}

.bg-glow--green {
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, var(--green) 0%, transparent 70%);
    bottom: 0;
    left: 5%;
    opacity: 0.08;
}

.footer-sep {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 0 60px;
    position: relative;
    z-index: 2;
}

.sep-line {
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(57, 224, 137, 0.25), transparent);
}

.sep-badge {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 24px;
    border: 1px solid rgba(57, 224, 137, 0.2);
    border-radius: 100px;
    background: rgba(57, 224, 137, 0.04);
    margin: 28px 0;
    white-space: nowrap;
}

.sep-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--green);
    animation: blink 2.2s ease-in-out infinite;
}

@keyframes blink {

    0%,
    100% {
        opacity: 1
    }

    50% {
        opacity: 0.3
    }
}

.sep-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.22em;
    color: #fff;
}

.sep-sub {
    font-size: 9px;
    font-weight: 400;
    letter-spacing: 0.15em;
    color: var(--green);
    text-transform: uppercase;
}

.footer-inner {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 60px 52px;
    position: relative;
    z-index: 2;
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.4fr;
    gap: 48px 56px;
    padding-bottom: 44px;
    border-bottom: 1px solid var(--border);
}

@media (max-width: 1060px) {
    .footer-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 600px) {
    .footer-inner {
        padding: 0 24px 40px;
    }

    .footer-sep {
        padding: 0 24px;
    }

    .footer-grid {
        grid-template-columns: 1fr;
        gap: 36px;
    }
}

.brand-head {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 16px;
}

.brand-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--teal), var(--teal-bright));
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    flex-shrink: 0;
    box-shadow: 0 0 24px rgba(15, 123, 120, 0.4);
}

.brand-name {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    letter-spacing: 0.08em;
    margin: 0 0 2px;
    line-height: 1;
}

.brand-accent {
    color: var(--green);
}

.brand-sub {
    font-size: 9px;
    font-weight: 400;
    letter-spacing: 0.18em;
    color: var(--text-muted);
    text-transform: uppercase;
    margin: 0;
}

.brand-desc {
    font-size: 13px;
    font-weight: 300;
    line-height: 1.75;
    color: var(--text-muted);
    margin-bottom: 20px;
    max-width: 290px;
}

.trust-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.trust-chip {
    font-size: 10px;
    font-weight: 500;
    color: var(--green);
    background: rgba(57, 224, 137, 0.08);
    border: 1px solid rgba(57, 224, 137, 0.2);
    padding: 4px 11px;
    border-radius: 100px;
    letter-spacing: 0.04em;
}

.col-head {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0 0 18px;
}

.col-head__bar {
    display: inline-block;
    width: 20px;
    height: 2px;
    background: linear-gradient(90deg, var(--green), transparent);
    border-radius: 2px;
    flex-shrink: 0;
}

.link-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.link-list li {
    margin-bottom: 2px;
}

.footer-link {
    display: flex;
    align-items: center;
    gap: 0;
    font-size: 13px;
    font-weight: 400;
    color: var(--text-muted);
    text-decoration: none;
    padding: 5px 0;
    transition: color 0.2s, gap 0.2s;
}

.footer-link:hover {
    color: var(--text-main);
    gap: 6px;
}

.link-arrow {
    color: var(--green);
    opacity: 0;
    transform: translateX(-6px);
    transition: opacity 0.2s, transform 0.2s;
    flex-shrink: 0;
}

.footer-link:hover .link-arrow {
    opacity: 1;
    transform: translateX(0);
}

.contact-list {
    list-style: none;
    padding: 0;
    margin: 0 0 22px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.contact-row {
    display: flex;
    align-items: center;
    gap: 11px;
}

.contact-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: rgba(15, 123, 120, 0.12);
    border: 1px solid rgba(15, 123, 120, 0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--teal-bright);
    flex-shrink: 0;
}

.contact-val {
    font-size: 12.5px;
    color: var(--text-muted);
    text-decoration: none;
    transition: color 0.2s;
}

a.contact-val:hover {
    color: var(--green);
}

.newsletter {
    margin-bottom: 20px;
}

.newsletter-label {
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.1em;
    color: var(--text-muted);
    text-transform: uppercase;
    margin: 0 0 10px;
}

.newsletter-row {
    display: flex;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid var(--border);
    background: rgba(255, 255, 255, 0.04);
    transition: border-color 0.2s;
}

.newsletter-row--focused {
    border-color: rgba(57, 224, 137, 0.35);
}

.newsletter-input {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    padding: 9px 13px;
    font-family: 'Outfit', sans-serif;
    font-size: 12.5px;
    color: var(--text-main);
    min-width: 0;
}

.newsletter-input::placeholder {
    color: var(--text-faint);
}

.newsletter-btn {
    background: linear-gradient(135deg, var(--teal), var(--teal-bright));
    border: none;
    padding: 9px 16px;
    font-family: 'Outfit', sans-serif;
    font-size: 12px;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
    white-space: nowrap;
    transition: filter 0.2s;
    flex-shrink: 0;
}

.newsletter-btn:hover {
    filter: brightness(1.15);
}

.subscribed-check {
    color: var(--green);
}

.social-row {
    display: flex;
    gap: 8px;
}

.social-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    text-decoration: none;
    transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.social-btn:hover {
    transform: translateY(-3px) scale(1.08);
    border-color: transparent;
    color: #fff;
}

.social-btn[data-hover="yt"]:hover {
    background: #ff0000;
}

.social-btn[data-hover="fb"]:hover {
    background: #1877f2;
}

.social-btn[data-hover="tk"]:hover {
    background: #010101;
    border-color: #69c9d0;
}

.social-btn[data-hover="li"]:hover {
    background: #0a66c2;
}

.footer-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    padding-top: 28px;
}

.copy,
.origin {
    font-size: 12px;
    color: var(--text-faint);
    margin: 0;
}

.legal {
    display: flex;
    align-items: center;
    gap: 8px;
}

.legal-link {
    font-size: 12px;
    color: var(--text-faint);
    text-decoration: none;
    transition: color 0.2s;
}

.legal-link:hover {
    color: var(--green);
}

.legal-dot {
    font-size: 12px;
    color: #1e3650;
}
</style>