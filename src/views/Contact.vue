<template>
  <section class="contact-page">

    <!-- Hero Banner (updated to match Events page style) -->
    <div class="contact-hero">
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
      <div class="hero-inner">
        <span class="label">
          <span class="badge-dot"></span>
          GET IN TOUCH
        </span>
        <h1>Contact <em>Us</em></h1>
        <p>Have a question, a project in mind, or just want to say hello? We'd love to hear from you.</p>
      </div>
    </div>

    <!-- Contact Info Cards -->
    <div class="contact-body">
      <div class="info-cards">

        <!-- Location -->
        <a href="https://maps.google.com/?q=Phnom+Penh,+Cambodia" target="_blank" rel="noopener" class="info-card">
          <div class="info-icon location">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
          </div>
          <h3>Our Location</h3>
          <p>No 89B, Street 199A, Sangkat Tumnubtek,Khan Chamkamom,<br>Phnom Penh, Cambodia</p>
          <span class="card-link">Open in Maps ↗</span>
        </a>

        <!-- Telegram -->
        <a href="https://t.me/yourhandle" target="_blank" rel="noopener" class="info-card">
          <div class="info-icon telegram">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path
                d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
            </svg>
          </div>
          <h3>Telegram</h3>
          <p>@yourhandle<br>Reply within minutes</p>
          <span class="card-link">Message us ↗</span>
        </a>

        <!-- Email -->
        <a href="mailto:hello@planec.com" class="info-card">
          <div class="info-icon email">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
              <polyline points="22,6 12,13 2,6" />
            </svg>
          </div>
          <h3>Email</h3>
          <p>planec@planec.com<br>sales@planec.com.kh</p>
          <span class="card-link">Send email ↗</span>
        </a>

        <!-- Phone -->
        <a href="tel:+85512345678" class="info-card">
          <div class="info-icon phone">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path
                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.8a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.5 16z" />
            </svg>
          </div>
          <h3>Phone</h3>
          <p>+855 23 216 425<br>Open : Mon to Sat, 8:00am to 5:30pm</p>
          <span class="card-link">Call us ↗</span>
        </a>

      </div>

      <!-- Google Map Embed -->
      <div class="map-section">
        <div class="map-header">
          <h2>Find <em>Us</em></h2>
          <p>We're located in the heart of Phnom Penh — come say hi.</p>
        </div>
        <div class="map-wrapper">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62538.79783890406!2d104.8671588!3d11.5563738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109513dc76a6be3%3A0x9c010ee85ab525bb!2sPhnom%20Penh%2C%20Cambodia!5e0!3m2!1sen!2s!4v1700000000000"
            width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" title="Our Location on Google Maps"></iframe>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
// No logic needed for this page
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap');

.contact-page {
  font-family: 'DM Sans', sans-serif;
  color: #1a1a2e;
  background: #fafaf8;
}

/* ── Hero (Events-style) ── */
.contact-hero {
  position: relative;
  background: linear-gradient(130deg, #071e3d 0%, #0b3d5e 45%, #0d6e6e 100%);
  padding: 90px 60px 130px;
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

.hero-inner {
  position: relative;
  z-index: 2;
  max-width: 560px;
  text-align: center;
  margin: 0 auto;
}

.label {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.22em;
  color: #4ade80;
  margin-bottom: 20px;
  text-transform: uppercase;
  padding: 10px 22px;
  background: rgba(13, 180, 150, 0.18);
  border: 1px solid rgba(13, 180, 150, 0.4);
  border-radius: 50px;
}

.badge-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #4ade80;
  box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.25);
  animation: pulse 2s infinite;
  flex-shrink: 0;
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

.contact-hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: clamp(2.4rem, 5vw, 3.6rem);
  font-weight: 700;
  line-height: 1.1;
  color: #fff;
  margin: 0 0 20px;
}

.contact-hero h1 em {
  color: #00cd30;
  font-style: italic;
}

.contact-hero p {
  font-size: 1.05rem;
  line-height: 1.7;
  color: rgba(255, 255, 255, 0.7);
  margin: 0 auto;
  max-width: 420px;
}

/* Body */
.contact-body {
  max-width: 1500px;
  margin: 0 auto;
  padding: 60px 40px 80px;
}

/* Cards */
.info-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  margin-bottom: 60px;
}

.info-card {
  background: #fff;
  border: 1px solid #0669eb;
  border-radius: 14px;
  padding: 28px 24px 22px;
  text-decoration: none;
  color: inherit;
  display: flex;
  flex-direction: column;
  transition: box-shadow 0.22s, transform 0.22s, border-color 0.22s;
}

.info-card:hover {
  box-shadow: 0 10px 32px rgba(0, 0, 0, 0.09);
  transform: translateY(-4px);
  border-color: #0abc4f;
}

.info-icon {
  width: 46px;
  height: 46px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 18px;
}

.info-icon svg {
  width: 22px;
  height: 22px;
}

.info-icon.location {
  background: #fef3e2;
  color: #e8922a;
}

.info-icon.telegram {
  background: #e6f4fd;
  color: #2ca5e0;
}

.info-icon.email {
  background: #fff0f0;
  color: #e05252;
}

.info-icon.phone {
  background: #edfaf2;
  color: #27ae60;
}

.info-card h3 {
  font-family: 'Playfair Display', serif;
  font-size: 1.05rem;
  font-weight: 700;
  margin: 0 0 8px;
}

.info-card p {
  font-size: 0.875rem;
  line-height: 1.75;
  color: #666;
  margin: 0 0 16px;
  flex: 1;
}

.card-link {
  font-size: 0.8rem;
  font-weight: 500;
  color: #01bd17;
}

/* Map */
.map-header {
  margin-bottom: 24px;
}

.map-header h2 {
  font-family: 'Playfair Display', serif;
  font-size: 1.8rem;
  font-weight: 700;
  margin: 0 0 6px;
}

.map-header h2 em {
  color: #02b72c;
  font-style: italic;
}

.map-header p {
  font-size: 0.92rem;
  color: #888;
  margin: 0;
}

.map-wrapper {
  width: 100%;
  height: 420px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid #ebebeb;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
}

@media (max-width: 640px) {
  .contact-hero {
    padding: 50px 28px 100px;
  }

  .contact-body {
    padding: 40px 20px 60px;
  }

  .map-wrapper {
    height: 280px;
  }
}
</style>