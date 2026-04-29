<template>
  <div class="events-page">

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-bg">
        <svg class="hero-lines" viewBox="0 0 1440 480" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path class="line l1" d="M-100,280 C200,200 400,320 700,240 C1000,160 1200,300 1540,220" fill="none"
            stroke="rgba(0,200,180,0.18)" stroke-width="2" />
          <path class="line l2" d="M-100,320 C250,240 450,360 750,280 C1050,200 1250,340 1540,260" fill="none"
            stroke="rgba(0,200,180,0.12)" stroke-width="1.5" />
          <path class="line l3" d="M-100,360 C300,280 500,400 800,320 C1100,240 1300,360 1540,300" fill="none"
            stroke="rgba(0,200,180,0.08)" stroke-width="1" />
          <path class="line l4" d="M-100,240 C150,160 350,280 650,200 C950,120 1150,260 1540,180" fill="none"
            stroke="rgba(0,200,180,0.1)" stroke-width="1.5" />
        </svg>
        <div class="hero-teal-glow"></div>
      </div>
      <div class="hero-content">
        <span class="hero-badge">
          <span class="badge-dot"></span>
          Latest Updates
        </span>
        <h1>Events</h1>
        <p>Stay updated with our latest training sessions, product launches, and industry events</p>
      </div>
    </section>

    <!-- Filter Bar -->
    <section class="filter-bar">
      <div class="container">
        <div class="filter-tabs">
          <button v-for="tab in tabs" :key="tab.id" :class="['filter-tab', { active: activeTab === tab.id }]"
            @click="activeTab = tab.id">
            <component :is="tab.icon" class="tab-icon" />
            {{ tab.label }}
            <span class="tab-badge">{{ getCount(tab.id) }}</span>
          </button>
        </div>
        <div class="filter-right">
          <span class="results-count">{{ filteredEvents.length }} events found</span>
        </div>
      </div>
    </section>

    <!-- Events Section -->
    <section class="events-section">
      <div class="container">
        <div class="large-cards-list">

          <!-- Card 1: image LEFT, content RIGHT -->
          <div v-for="(event, index) in filteredEvents" :key="event.id" class="featured-wrapper">
            <article class="event-card featured-card" :class="{ 'image-right': index % 2 !== 0 }">

              <!-- Image panel -->
              <div class="featured-image-col">
                <div class="featured-image-bg" :style="{ background: event.gradient }">
                  <div class="featured-pattern"></div>
                  <img v-if="event.image" :src="event.image" class="featured-bg-img" alt="" />
                </div>
              </div>

              <!-- Content panel -->
              <div class="featured-content-col">
                <div class="card-meta-row">
                  <span class="event-type-chip" :class="event.type">
                    <component :is="event.typeIcon" class="chip-icon" />
                    {{ event.typeLabel }}
                  </span>
                  <span class="card-status" :class="event.status">{{ event.statusLabel }}</span>
                </div>
                <h2 class="featured-title">{{ event.title }}</h2>
                <p class="featured-desc">{{ event.description }}</p>
                <div class="card-details">
                  <div class="detail-item">
                    <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="4" width="18" height="18" rx="2" />
                      <path d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    <span>{{ event.date }}</span>
                  </div>
                  <div class="detail-item">
                    <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10" />
                      <polyline points="12,6 12,12 16,14" />
                    </svg>
                    <span>{{ event.time }}</span>
                  </div>
                  <div class="detail-item">
                    <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    <span>{{ event.location }}</span>
                  </div>
                </div>
              </div>

            </article>
          </div>

        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, h } from 'vue'

const activeTab = ref('all')

/* ── Icon helpers ── */
const IconGrid = { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('rect', { x: '3', y: '3', width: '7', height: '7' }), h('rect', { x: '14', y: '3', width: '7', height: '7' }), h('rect', { x: '14', y: '14', width: '7', height: '7' }), h('rect', { x: '3', y: '14', width: '7', height: '7' })]) }
const IconBook = { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('path', { d: 'M4 19.5A2.5 2.5 0 016.5 17H20' }), h('path', { d: 'M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z' })]) }
const IconTool = { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('path', { d: 'M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z' })]) }
const IconZap = { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('polygon', { points: '13 2 3 14 12 14 11 22 21 10 12 10 13 2' })]) }

const tabs = [
  { id: 'all', label: 'All Events', icon: IconGrid },
  { id: 'training', label: 'Training', icon: IconBook },
]

const events = ref([
  {
    id: 1, tabId: 'training', featured: true,
    image: 'https://planec.com.kh/wp-content/uploads/2019/09/photo_2021-02-06_17-25-45-1200x899.jpg',
    title: 'PLANEC CLASSROOM – TECNICAL TRAINING',
    description: 'This course generated providing knowledge with guidelines of cabling selection, installation in address to current issues of cabling installation at real sites. You will get to known the ISO criteria and critical points of dat acable before making selection. Also the difference design and usage of data cable specifically by customer model such as Commercial building, hotel, apartment, F&B , Data Center, and Factory This course is suitable for data cable designer and technician.',
    date: 'April 07 2021', time: '8:30 AM – 5:00 PM',
    location: 'Phnom Penh Training Center',
    type: 'training', typeLabel: 'Training', typeIcon: IconBook,
  },
  {
    id: 2, tabId: 'training', featured: false,
    image: 'https://planec.com.kh/wp-content/uploads/2021/07/Pages-from-FO-Cable-Switch-Media-1200x845.png',
    title: 'FIBER OPTIC FUNDAMENTALS & SPLICING',
    description: 'A hands-on course covering single-mode and multi-mode fiber optic cabling, splicing techniques, OTDR testing, and end-to-end loss budgeting. Ideal for engineers and technicians working on enterprise or telco backbone infrastructure.',
    date: 'July 14 2021', time: '9:00 AM – 4:30 PM',
    location: 'Phnom Penh Training Center',
    type: 'training', typeLabel: 'Training', typeIcon: IconBook,
  },
])

const filteredEvents = computed(() =>
  activeTab.value === 'all' ? events.value : events.value.filter(e => e.tabId === activeTab.value)
)

const getCount = (id) =>
  id === 'all' ? events.value.length : events.value.filter(e => e.tabId === id).length
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=DM+Sans:ital,wght@0,400;0,500;1,400&display=swap');

* {
  box-sizing: border-box;
}

.events-page {
  font-family: 'DM Sans', sans-serif;
  background: #f0f4f8;
  min-height: 100vh;
}

/* ── HERO ── */
.hero {
  position: relative;
  background: linear-gradient(130deg, #071e3d 0%, #0b3d5e 45%, #0d6e6e 100%);
  padding: 90px 0 130px;
  overflow: hidden;
}

.hero-bg {
  position: absolute;
  inset: 0;
}

.hero-lines {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
}

.line {
  stroke-dasharray: 1200;
  stroke-dashoffset: 1200;
  animation: drawLine 3s ease forwards;
}

.l1 {
  animation-delay: 0s;
}

.l2 {
  animation-delay: 0.3s;
}

.l3 {
  animation-delay: 0.6s;
}

.l4 {
  animation-delay: 0.9s;
}

@keyframes drawLine {
  to {
    stroke-dashoffset: 0;
  }
}

.hero-teal-glow {
  position: absolute;
  top: -80px;
  right: -80px;
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, rgba(13, 180, 150, 0.22) 0%, transparent 65%);
  border-radius: 50%;
}

.hero-content {
  position: relative;
  z-index: 10;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 32px;
  text-align: center;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 10px 18px;
  background: rgba(13, 180, 150, 0.18);
  border: 1px solid rgba(13, 180, 150, 0.4);
  border-radius: 50px;
  color: #4ade80;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: 0.5px;
  margin-bottom: 24px;
}

.badge-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #4ade80;
  box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.25);
  animation: pulse 2s infinite;
}

@keyframes pulse {

  0%,
  100% {
    box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.25);
  }

  50% {
    box-shadow: 0 0 0 6px rgba(74, 222, 128, 0.1);
  }
}

.hero h1 {
  font-family: 'Sora', sans-serif;
  font-size: 62px;
  font-weight: 700;
  color: #fff;
  margin: 0 0 18px;
  line-height: 1.1;
}

.hero p {
  font-size: 19px;
  color: rgba(255, 255, 255, 0.72);
  max-width: 580px;
  margin: 0 auto;
  line-height: 1.65;
}

/* ── FILTER BAR ── */
.filter-bar {
  position: sticky;
  top: 0;
  z-index: 200;
  background: #fff;
  border-bottom: 1px solid #e2e8f0;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 32px;
}

.filter-bar .container {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.filter-tabs {
  display: flex;
  gap: 6px;
  padding: 14px 0;
  overflow-x: auto;
}

.filter-tab {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 9px 20px;
  background: #f8fafc;
  border: 1.5px solid #e2e8f0;
  border-radius: 50px;
  color: #64748b;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
  white-space: nowrap;
}

.filter-tab:hover {
  background: #f1f5f9;
  color: #334155;
  border-color: #cbd5e1;
}

.filter-tab.active {
  background: #10b981;
  color: #fff;
  border-color: #10b981;
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.tab-icon {
  width: 16px;
  height: 16px;
}

.tab-badge {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 22px;
  height: 22px;
  padding: 0 6px;
  background: rgba(0, 0, 0, 0.08);
  border-radius: 11px;
  font-size: 11px;
  font-weight: 700;
}

.filter-tab.active .tab-badge {
  background: rgba(255, 255, 255, 0.2);
}

.results-count {
  font-size: 13px;
  color: #94a3b8;
  white-space: nowrap;
}

/* ── EVENTS SECTION ── */
.events-section {
  padding: 50px 0 80px;
}

.large-cards-list {
  display: flex;
  flex-direction: column;
  gap: 32px;
}

/* ── CARD LAYOUT ── */
.featured-card {
  display: grid;
  /* default: image LEFT, content RIGHT */
  grid-template-columns: 380px 1fr;
  background: #fff;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s;
}

/* image-right: content LEFT, image RIGHT */
.featured-card.image-right {
  grid-template-columns: 1fr 380px;
}

.featured-card.image-right .featured-image-col {
  order: 2;
}

.featured-card.image-right .featured-content-col {
  order: 1;
}

.featured-card:hover {
  box-shadow: 0 16px 50px rgba(0, 0, 0, 0.15);
}

/* ── IMAGE PANEL ── */
.featured-image-col {
  position: relative;
  min-height: 380px;
}

.featured-image-bg {
.featured-bg-img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 1;           /* was 0.22 */
  mix-blend-mode: normal; /* was luminosity */
}
}

.featured-pattern {
  position: absolute;
  inset: 0;
  background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
  background-size: 24px 24px;
}

.featured-bg-img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0.22;
  mix-blend-mode: luminosity;
}

.featured-category-icon {
  position: relative;
  z-index: 2;
  width: 100px;
  height: 100px;
  background: rgba(255, 255, 255, 0.1);
  border: 1.5px solid rgba(255, 255, 255, 0.2);
  border-radius: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(8px);
}

.featured-category-icon svg {
  width: 48px;
  height: 48px;
  stroke: rgba(255, 255, 255, 0.9);
}

.featured-label {
  position: absolute;
  top: 20px;
  left: 20px;
  z-index: 2;
  padding: 6px 14px;
  background: rgba(255, 255, 255, 0.15);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 50px;
  color: #fff;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}

/* ── CONTENT PANEL ── */
.featured-content-col {
  padding: 36px 40px;
  display: flex;
  flex-direction: column;
}

.card-meta-row {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 18px;
}

.event-type-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 14px;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.4px;
}

.event-type-chip.training {
  background: #d1fae5;
  color: #065f46;
}

.event-type-chip.products {
  background: #dbeafe;
  color: #1e40af;
}

.event-type-chip.news {
  background: #ede9fe;
  color: #4c1d95;
}

.chip-icon {
  width: 12px;
  height: 12px;
}

.card-status {
  padding: 4px 12px;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 600;
}

.card-status.open {
  background: #dcfce7;
  color: #166534;
}

.card-status.soon {
  background: #fef9c3;
  color: #854d0e;
}

.card-status.new {
  background: #fce7f3;
  color: #9d174d;
}

.featured-title {
  font-family: 'Sora', sans-serif;
  font-size: 26px;
  font-weight: 700;
  color: #0f172a;
  margin: 0 0 14px;
  line-height: 1.3;
}

.featured-desc {
  font-size: 15px;
  color: #475569;
  line-height: 1.7;
  margin: 0 0 24px;
  flex: 1;
}

.card-details {
  display: flex;
  flex-wrap: wrap;
  gap: 18px;
}

.detail-item {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  color: #334155;
}

.detail-icon {
  width: 16px;
  height: 16px;
  color: #10b981;
  flex-shrink: 0;
}

/* ── RESPONSIVE ── */
@media (max-width: 768px) {

  .featured-card,
  .featured-card.image-right {
    grid-template-columns: 1fr;
  }

  .featured-card .featured-image-col,
  .featured-card.image-right .featured-image-col {
    order: 1;
    min-height: 220px;
  }

  .featured-card .featured-content-col,
  .featured-card.image-right .featured-content-col {
    order: 2;
  }

  .hero h1 {
    font-size: 38px;
  }
}
</style>