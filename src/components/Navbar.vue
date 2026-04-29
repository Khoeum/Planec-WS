<template>
    <div>
        <!-- News Ticker -->
        <div class="ticker">
            <div class="ticker-inner">
                <div v-for="(item, i) in [...tickerItems, ...tickerItems]" :key="i" class="ticker-item">
                    <span class="ticker-dot" />
                    {{ item }}
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar">
            <div class="inner">

                <!-- Logo -->
                <router-link to="/" class="logo">
                    <div class="logo-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2"
                            stroke-linecap="round">
                            <circle cx="12" cy="12" r="10" />
                            <path
                                d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                        </svg>
                    </div>
                    <div class="logo-text">
                        <span class="logo-main">PLAN<em>EC</em></span>
                        <span class="logo-sub">Cable &amp; Network Solution</span>
                    </div>
                </router-link>

                <div class="divider" />

                <!-- Desktop Links -->
                <ul class="links">
                    <li v-for="link in navLinks" :key="link.path">
                        <router-link :to="link.path" class="nav-link" :class="{ active: $route.path === link.path }">
                            <span class="dot" />
                            {{ link.label }}
                        </router-link>
                    </li>
                </ul>

                <!-- Right Side -->
                <div class="right">
                    <!-- Search -->
                    <div class="search-wrap">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.5)"
                            stroke-width="2.2">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" />
                        </svg>
                        <input v-model="searchQuery" type="text" placeholder="Search products…" aria-label="Search"
                            @keyup.enter="handleSearch" />
                    </div>

                    <!-- Hamburger -->
                    <button class="burger" :class="{ open: menuOpen }" aria-label="Toggle menu"
                        @click="menuOpen = !menuOpen">
                        <span /><span /><span />
                    </button>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <transition name="slide">
            <div v-if="menuOpen" class="mobile-menu">
                <router-link v-for="link in navLinks" :key="link.path" :to="link.path" class="mobile-link"
                    @click="menuOpen = false">
                    {{ link.label }}
                </router-link>
                <router-link to="/contact" class="mobile-cta" @click="menuOpen = false">
                    Get In Touch
                </router-link>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const menuOpen = ref(false)
const searchQuery = ref('')

const navLinks = [
    { label: 'Home', path: '/' },
    { label: 'Products', path: '/product' },
    { label: 'Events', path: '/event' },
    { label: 'Partnership', path: '/partnership' },
    { label: 'Contact Us', path: '/contact' },
    { label: 'About', path: '/about' },
    { label: 'Shop', path: '/shop' },
]

const tickerItems = [
    'Ultra PoE Solutions — 95W PoH',
    '10G Uplink Managed Switches',
    'Intelligent PoE Management',
    'Touch LCD Control Panels',
    "Cambodia's #1 Network Distributor",
]

function handleSearch() {
    if (searchQuery.value.trim()) {
        router.push({ path: '/search', query: { q: searchQuery.value.trim() } })
        searchQuery.value = ''
        menuOpen.value = false
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&family=Barlow+Condensed:wght@700;800&display=swap');

* {
    box-sizing: border-box;
}

/* ── Ticker ── */
.ticker {
    background: #071e3d;
    height: 32px;
    display: flex;
    align-items: center;
    overflow: hidden;
    border-bottom: 1px solid rgba(255, 255, 255, 0.07);
}

.ticker-inner {
    display: flex;
    white-space: nowrap;
    animation: ticker 28s linear infinite;
}

.ticker-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 0 32px;
    font-size: 11px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.5);
    border-right: 1px solid rgba(255, 255, 255, 0.08);
    font-family: 'Barlow', sans-serif;
}

.ticker-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #22c55e;
    flex-shrink: 0;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes ticker {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}

@keyframes pulse {

    0%,
    100% {
        opacity: 1;
    }

    50% {
        opacity: 0.3;
    }
}

/* ── Navbar ── */
.navbar {
    background: #0d2d5e;
    height: 74px;
    display: flex;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
    border-bottom: 2px solid rgba(34, 197, 94, 0.3);
    font-family: 'Barlow', sans-serif;
}

.inner {
    width: 100%;
    max-width: 1260px;
    margin: 0 auto;
    padding: 0 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

/* ── Logo ── */
.logo {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    flex-shrink: 0;
}

.logo-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: rgba(34, 197, 94, 0.15);
    border: 1px solid rgba(34, 197, 94, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}

.logo:hover .logo-icon {
    background: rgba(34, 197, 94, 0.25);
}

.logo-text {
    display: flex;
    flex-direction: column;
    line-height: 1;
}

.logo-main {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: 26px;
    font-weight: 800;
    letter-spacing: 3px;
    color: #fff;
}

.logo-main em {
    color: #22c55e;
    font-style: normal;
}

.logo-sub {
    font-size: 8.5px;
    letter-spacing: 3.5px;
    color: rgba(255, 255, 255, 0.4);
    text-transform: uppercase;
    margin-top: 2px;
}

/* ── Divider ── */
.divider {
    width: 1px;
    height: 36px;
    background: rgba(255, 255, 255, 0.12);
    flex-shrink: 0;
}

/* ── Desktop Links ── */
.links {
    display: flex;
    align-items: center;
    gap: 0;
    list-style: none;
    flex: 1;
    justify-content: center;
    margin: 0;
    padding: 0;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.65);
    text-decoration: none;
    border-radius: 8px;
    position: relative;
    transition: color 0.2s, background 0.2s;
    white-space: nowrap;
}

.dot {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: #22c55e;
    flex-shrink: 0;
    opacity: 0;
    transform: scale(0);
    transition: opacity 0.2s, transform 0.2s;
}

.nav-link:hover {
    color: #fff;
    background: rgba(255, 255, 255, 0.06);
}

.nav-link.active {
    color: #fff;
}

.nav-link.active .dot {
    opacity: 1;
    transform: scale(1);
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 16px;
    right: 16px;
    height: 2px;
    background: #22c55e;
    border-radius: 2px 2px 0 0;
    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-link:hover::after,
.nav-link.active::after {
    transform: scaleX(1);
}

/* ── Right Side ── */
.right {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

/* ── Search ── */
.search-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.07);
    border-radius: 8px;
    padding: 7px 14px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: border-color 0.2s, background 0.2s;
}

.search-wrap:focus-within {
    border-color: rgba(34, 197, 94, 0.5);
    background: rgba(255, 255, 255, 0.1);
}

.search-wrap input {
    background: transparent;
    border: none;
    outline: none;
    font-size: 12px;
    font-family: 'Barlow', sans-serif;
    color: #fff;
    width: 100px;
    transition: width 0.3s;
}

.search-wrap input::placeholder {
    color: rgba(255, 255, 255, 0.35);
}

.search-wrap input:focus {
    width: 140px;
}

/* ── Phone Button ── */
.phone-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 7px 14px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: rgba(255, 255, 255, 0.05);
    color: rgba(255, 255, 255, 0.7);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-decoration: none;
    white-space: nowrap;
    transition: all 0.2s;
}

.phone-btn:hover {
    border-color: rgba(34, 197, 94, 0.4);
    color: #fff;
    background: rgba(34, 197, 94, 0.08);
}

/* ── CTA ── */
.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #22c55e;
    color: #071e3d;
    padding: 9px 20px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    white-space: nowrap;
    transition: background 0.2s, transform 0.15s;
}

.cta-btn:hover {
    background: #16a34a;
    transform: translateY(-1px);
}

.cta-btn:active {
    transform: translateY(0);
}

/* ── Hamburger ── */
.burger {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 6px;
}

.burger span {
    display: block;
    width: 22px;
    height: 2px;
    background: #fff;
    border-radius: 2px;
    transition: transform 0.3s, opacity 0.3s;
}

.burger.open span:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
}

.burger.open span:nth-child(2) {
    opacity: 0;
}

.burger.open span:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
}

/* ── Mobile Menu ── */
.mobile-menu {
    background: #0d2d5e;
    border-bottom: 2px solid rgba(34, 197, 94, 0.3);
    padding: 12px 16px 16px;
}

.mobile-link {
    display: block;
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    border-radius: 8px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    transition: background 0.15s, color 0.15s;
}

.mobile-link:hover {
    background: rgba(255, 255, 255, 0.06);
    color: #fff;
}

.mobile-cta {
    display: block;
    margin-top: 12px;
    width: 100%;
    background: #22c55e;
    color: #071e3d;
    padding: 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    text-align: center;
}

/* ── Slide Transition ── */
.slide-enter-active,
.slide-leave-active {
    transition: opacity 0.2s, transform 0.2s;
}

.slide-enter-from,
.slide-leave-to {
    opacity: 0;
    transform: translateY(-8px);
}

/* ── Responsive ── */
@media (max-width: 960px) {

    .links,
    .divider,
    .search-wrap,
    .phone-btn {
        display: none;
    }

    .burger {
        display: flex;
    }
}
</style>