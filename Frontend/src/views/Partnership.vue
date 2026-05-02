<template>
  <section class="partnership-page">

    <!-- Hero -->
    <div class="partnership-hero">
      <div class="hero-bg">
        <svg class="hero-lines" viewBox="0 0 1440 480" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path class="line l1" d="M-100,280 C200,200 400,320 700,240 C1000,160 1200,300 1540,220" fill="none" stroke="rgba(0,200,180,0.18)" stroke-width="2"/>
          <path class="line l2" d="M-100,320 C250,240 450,360 750,280 C1050,200 1250,340 1540,260" fill="none" stroke="rgba(0,200,180,0.12)" stroke-width="1.5"/>
          <path class="line l3" d="M-100,360 C300,280 500,400 800,320 C1100,240 1300,360 1540,300" fill="none" stroke="rgba(0,200,180,0.08)" stroke-width="1"/>
          <path class="line l4" d="M-100,240 C150,160 350,280 650,200 C950,120 1150,260 1540,180" fill="none" stroke="rgba(0,200,180,0.1)" stroke-width="1.5"/>
        </svg>
        <div class="hero-teal-glow"></div>
      </div>
      <div class="hero-inner">
        <span class="label"><span class="badge-dot"></span>GROW TOGETHER</span>
        <h1>Our <em>Partnership</em></h1>
        <p>Honesty and integrity are the core values in successful business. We pursue sustainable growth and long-term partnership with our partners, customers and employees.</p>
      </div>
    </div>

    <!-- Stats -->
    <div class="stats-bar">
      <div class="stat"><span class="stat-num">13+</span><span class="stat-label">Global Brands</span></div>
      <div class="stat-divider"></div>
      <div class="stat"><span class="stat-num">10+</span><span class="stat-label">Years Experience</span></div>
      <div class="stat-divider"></div>
      <div class="stat"><span class="stat-num">500+</span><span class="stat-label">Customers Served</span></div>
      <div class="stat-divider"></div>
      <div class="stat"><span class="stat-num">100%</span><span class="stat-label">Authorized Distributor</span></div>
    </div>

    <!-- Body -->
    <div class="partnership-body">

      <!-- Value Cards -->
      <div class="value-grid">
        <div class="value-card">
          <div class="value-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <h2>Our Supplier</h2>
          <p>Honesty and integrity are the core value in successful business. We pursue sustainable growth and long-term partnership with our partners, customers and employees.</p>
        </div>
        <div class="value-card">
          <div class="value-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <polyline points="20 12 20 22 4 22 4 12"/>
              <rect x="2" y="7" width="20" height="5"/>
              <line x1="12" y1="22" x2="12" y2="7"/>
              <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/>
              <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>
            </svg>
          </div>
          <h2>Our Customer</h2>
          <p>We commit to deliver the best products and support with professionalism and expertise to our customers.</p>
        </div>
      </div>

      <!-- Brands -->
      <div class="brands-section">
        <div class="brands-header">
          <div class="brands-header-left">
            <span class="section-label">TRUSTED BRANDS</span>
            <h2>Authorized <em>Distribution</em> Products</h2>
            <p>We are proud to be the authorized distributor for these industry-leading brands in Cambodia.</p>
          </div>
          <div class="brands-header-right">
            <div class="auth-badge">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                <polyline points="9 12 11 14 15 10"/>
              </svg>
              Authorized Distributor
            </div>
          </div>
        </div>

        <!-- Category filters -->
        <div class="filter-row">
          <button class="filter-btn active" data-filter="all">All Brands</button>
          <button class="filter-btn" data-filter="cabling">Cabling</button>
          <button class="filter-btn" data-filter="security">Security</button>
          <button class="filter-btn" data-filter="fire">Fire Safety</button>
          <button class="filter-btn" data-filter="network">Networking</button>
        </div>

        <div class="logo-grid">

          <!-- 1. Siemon -->
          <div class="logo-card" data-category="cabling">
            <div class="logo-wrapper">
              <svg viewBox="0 0 150 52" xmlns="http://www.w3.org/2000/svg">
                <circle cx="24" cy="26" r="20" fill="none" stroke="#CC0000" stroke-width="3.5"/>
                <circle cx="24" cy="26" r="12" fill="none" stroke="#CC0000" stroke-width="2"/>
                <path d="M30 26 L18 26 M18 26 L23 21 M18 26 L23 31" stroke="#CC0000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <text x="52" y="30" font-family="'Arial Black', Arial, sans-serif" font-size="18" font-weight="900" fill="#1a1a2e" letter-spacing="-0.3">SIEMON</text>
                <text x="52" y="42" font-family="Arial, sans-serif" font-size="8" fill="#aaa">™</text>
              </svg>
            </div>
            <span class="logo-cat">Cabling Systems</span>
          </div>

          <!-- 2. Johnson Controls -->
          <div class="logo-card" data-category="security">
            <div class="logo-wrapper">
              <svg viewBox="0 0 158 52" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 40 Q6 28 16 22" fill="none" stroke="#00B0A0" stroke-width="3" stroke-linecap="round"/>
                <path d="M2 46 Q2 22 20 12" fill="none" stroke="#5DC8B8" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M-2 52 Q-2 16 24 4" fill="none" stroke="#A0DED8" stroke-width="2" stroke-linecap="round"/>
                <circle cx="18" cy="22" r="4.5" fill="#00B0A0"/>
                <path d="M24 6 Q34 0 40 6 Q34 12 24 6Z" fill="#7CC242"/>
                <text x="46" y="25" font-family="'Arial Black', Arial, sans-serif" font-size="11.5" font-weight="900" fill="#003087">Johnson</text>
                <text x="46" y="41" font-family="'Arial Black', Arial, sans-serif" font-size="11.5" font-weight="900" fill="#003087">Controls</text>
              </svg>
            </div>
            <span class="logo-cat">Building Solutions</span>
          </div>

          <!-- 3. Kantech -->
          <div class="logo-card" data-category="security">
            <div class="logo-wrapper">
              <svg viewBox="0 0 160 52" xmlns="http://www.w3.org/2000/svg">
                <text x="2" y="34" font-family="'Arial Black', Arial, sans-serif" font-size="26" font-weight="900" fill="#003087" letter-spacing="-0.5">KANTECH</text>
                <text x="2" y="47" font-family="Arial, sans-serif" font-size="7.5" fill="#888" letter-spacing="0.2">From Tyco Security Products</text>
              </svg>
            </div>
            <span class="logo-cat">Access Control</span>
          </div>

          <!-- 4. Nexans / Aginode -->
          <div class="logo-card" data-category="cabling">
            <div class="logo-wrapper">
              <svg viewBox="0 0 156 52" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="2" width="60" height="17" rx="2" fill="#1a1a1a"/>
                <text x="6" y="14" font-family="Arial, sans-serif" font-size="8.5" font-weight="700" fill="#fff">Nexans</text>
                <rect x="2" y="20" width="60" height="28" rx="2" fill="#F7941D"/>
                <text x="6" y="32" font-family="Arial, sans-serif" font-size="6.5" fill="#fff">Telecom Systems</text>
                <text x="6" y="42" font-family="'Arial Black', Arial, sans-serif" font-size="10" font-weight="900" fill="#fff">is now</text>
                <rect x="68" y="14" width="84" height="28" rx="14" fill="#1a1a1a"/>
                <circle cx="83" cy="28" r="8" fill="#F7941D"/>
                <text x="96" y="33" font-family="'Arial Black', Arial, sans-serif" font-size="12" font-weight="900" fill="#fff">aginode</text>
              </svg>
            </div>
            <span class="logo-cat">Telecom Cabling</span>
          </div>

          <!-- 5. Tyco -->
          <div class="logo-card" data-category="security">
            <div class="logo-wrapper">
              <svg viewBox="0 0 155 52" xmlns="http://www.w3.org/2000/svg">
                <text x="4" y="36" font-family="'Arial Black', Arial, sans-serif" font-size="30" font-weight="900" fill="#003087" font-style="italic">tyco</text>
                <text x="4" y="49" font-family="Arial, sans-serif" font-size="10" fill="#666" letter-spacing="0.2">Security Products</text>
              </svg>
            </div>
            <span class="logo-cat">Security Products</span>
          </div>

          <!-- 6. Nittan -->
          <div class="logo-card" data-category="fire">
            <div class="logo-wrapper">
              <svg viewBox="0 0 155 52" xmlns="http://www.w3.org/2000/svg">
                <text x="2" y="38" font-family="'Arial Black', Arial, sans-serif" font-size="30" font-weight="900" fill="#CC0000" letter-spacing="1.5">NITTAN</text>
              </svg>
            </div>
            <span class="logo-cat">Fire Detection</span>
          </div>

          <!-- 7. Planet -->
          <div class="logo-card" data-category="network">
            <div class="logo-wrapper">
              <svg viewBox="0 0 155 52" xmlns="http://www.w3.org/2000/svg">
                <defs><clipPath id="pgc"><circle cx="22" cy="24" r="16"/></clipPath></defs>
                <circle cx="22" cy="24" r="16" fill="#0066B3"/>
                <ellipse cx="22" cy="24" rx="16" ry="6" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1" clip-path="url(#pgc)"/>
                <ellipse cx="22" cy="24" rx="16" ry="11" fill="none" stroke="rgba(255,255,255,0.25)" stroke-width="1" clip-path="url(#pgc)"/>
                <line x1="22" y1="8" x2="22" y2="40" stroke="rgba(255,255,255,0.3)" stroke-width="1"/>
                <ellipse cx="22" cy="24" rx="22" ry="7" fill="none" stroke="#F7941D" stroke-width="3" transform="rotate(-30 22 24)"/>
                <text x="48" y="29" font-family="'Arial Black', Arial, sans-serif" font-size="19" font-weight="900" fill="#0066B3">PLANET</text>
                <text x="48" y="41" font-family="Arial, sans-serif" font-size="6.5" fill="#666" letter-spacing="0.3">Networking &amp; Communication</text>
              </svg>
            </div>
            <span class="logo-cat">Network Infrastructure</span>
          </div>

          <!-- 8. Simplex -->
          <div class="logo-card" data-category="fire">
            <div class="logo-wrapper">
              <svg viewBox="0 0 155 52" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="6" width="36" height="36" rx="6" fill="#CC0000"/>
                <text x="8" y="34" font-family="'Arial Black', Arial, sans-serif" font-size="26" font-weight="900" fill="#fff">S</text>
                <text x="46" y="33" font-family="Arial, sans-serif" font-size="22" font-weight="400" fill="#1a1a2e">Simplex</text>
              </svg>
            </div>
            <span class="logo-cat">Fire Alarm</span>
          </div>

          <!-- 9. Finen -->
          <div class="logo-card" data-category="cabling">
            <div class="logo-wrapper">
              <svg viewBox="0 0 155 52" xmlns="http://www.w3.org/2000/svg">
                <text x="4" y="36" font-family="'Arial Black', Arial, sans-serif" font-size="30" font-weight="900" fill="#1250A0" font-style="italic" letter-spacing="1">FINEN</text>
                <text x="136" y="16" font-family="Arial, sans-serif" font-size="11" fill="#1250A0">®</text>
              </svg>
            </div>
            <span class="logo-cat">Structured Cabling</span>
          </div>

          <!-- 10. Softing -->
          <div class="logo-card" data-category="network">
            <div class="logo-wrapper">
              <svg viewBox="0 0 155 52" xmlns="http://www.w3.org/2000/svg">
                <text x="4" y="14" font-family="Arial, sans-serif" font-size="10" font-style="italic" fill="#777">optimize!</text>
                <text x="2" y="44" font-family="'Arial Black', Arial, sans-serif" font-size="28" font-weight="900" fill="#0066B3">soft</text>
                <text x="70" y="44" font-family="'Arial Black', Arial, sans-serif" font-size="28" font-weight="900" fill="#00A090">ing</text>
              </svg>
            </div>
            <span class="logo-cat">Network Testing</span>
          </div>

          <!-- 11. Exacq -->
          <div class="logo-card" data-category="security">
            <div class="logo-wrapper">
              <svg viewBox="0 0 155 52" xmlns="http://www.w3.org/2000/svg">
                <text x="4" y="38" font-family="Georgia, 'Times New Roman', serif" font-size="30" font-weight="400" fill="#1a1a2e" letter-spacing="-0.5">exacq</text>
              </svg>
            </div>
            <span class="logo-cat">Video Surveillance</span>
          </div>

          <!-- 12. Software House -->
          <div class="logo-card" data-category="security">
            <div class="logo-wrapper">
              <svg viewBox="0 0 155 52" xmlns="http://www.w3.org/2000/svg">
                <text x="4" y="21" font-family="Georgia, 'Times New Roman', serif" font-size="13.5" font-weight="700" fill="#1a1a2e" letter-spacing="0.8">SOFTWARE</text>
                <text x="4" y="38" font-family="Georgia, 'Times New Roman', serif" font-size="13.5" font-weight="700" fill="#1a1a2e" letter-spacing="0.8">HOUSE</text>
                <text x="4" y="50" font-family="Arial, sans-serif" font-size="7" fill="#888" letter-spacing="0.2">From Tyco Security Products</text>
              </svg>
            </div>
            <span class="logo-cat">Access Management</span>
          </div>

          <!-- 13. LINK -->
          <div class="logo-card" data-category="cabling">
            <div class="logo-wrapper">
              <svg viewBox="0 0 140 58" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 52 Q6 12 38 12 Q60 12 72 28" fill="none" stroke="#003D7A" stroke-width="7" stroke-linecap="round"/>
                <path d="M72 28 Q82 46 104 24" fill="none" stroke="#CC0000" stroke-width="4.5" stroke-linecap="round"/>
                <circle cx="106" cy="22" r="5" fill="#CC0000"/>
                <text x="16" y="50" font-family="'Arial Black', Arial, sans-serif" font-size="24" font-weight="900" fill="#003D7A">LINK</text>
                <text x="83" y="16" font-family="Arial, sans-serif" font-size="8" fill="#003D7A">®</text>
                <text x="18" y="62" font-family="Arial, sans-serif" font-size="7" fill="#CC0000" letter-spacing="0.2">American Standard</text>
              </svg>
            </div>
            <span class="logo-cat">Cabling Systems</span>
          </div>

        </div>
      </div>

      <!-- CTA -->
      <div class="cta-banner">
        <div class="cta-content">
          <h3>Interested in Partnering with Us?</h3>
          <p>Let&apos;s build something great together. Reach out to explore distribution or project collaboration opportunities.</p>
        </div>
        <router-link to="/contact" class="cta-btn">Get in Touch &rarr;</router-link>
      </div>

    </div>
  </section>
</template>

<script setup>
import { onMounted } from 'vue'

onMounted(() => {
  const buttons = document.querySelectorAll('.filter-btn')
  const cards = document.querySelectorAll('.logo-card')

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      buttons.forEach(b => b.classList.remove('active'))
      btn.classList.add('active')
      const filter = btn.dataset.filter
      cards.forEach(card => {
        if (filter === 'all' || card.dataset.category === filter) {
          card.style.opacity = '1'
          card.style.transform = ''
          card.style.pointerEvents = ''
        } else {
          card.style.opacity = '0.18'
          card.style.transform = 'scale(0.97)'
          card.style.pointerEvents = 'none'
        }
      })
    })
  })
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

.partnership-page { font-family: 'DM Sans', sans-serif; color: #1a1a2e; background: #f4f8f5; }

/* ── Hero ── */
.partnership-hero {
  position: relative;
  background: linear-gradient(130deg, #071e3d 0%, #0b3d5e 45%, #0d6e6e 100%);
  padding: 80px 60px 130px; overflow: hidden;
}
.hero-bg { position: absolute; inset: 0; }
.hero-lines { position: absolute; inset: 0; width: 100%; height: 100%; }
.line { stroke-dasharray: 1200; stroke-dashoffset: 1200; animation: drawLine 3s ease forwards; }
.l1 { animation-delay: 0s; } .l2 { animation-delay: 0.3s; }
.l3 { animation-delay: 0.6s; } .l4 { animation-delay: 0.9s; }
@keyframes drawLine { to { stroke-dashoffset: 0; } }
.hero-teal-glow {
  position: absolute; top: -80px; right: -80px; width: 500px; height: 500px;
  background: radial-gradient(circle, rgba(13,180,150,0.22) 0%, transparent 65%); border-radius: 50%;
}
.hero-inner { position: relative; z-index: 2; max-width: 600px; text-align: center; margin: 0 auto; }
.label {
  display: inline-flex; align-items: center; gap: 10px;
  font-size: 11px; font-weight: 600; letter-spacing: 0.22em; color: #4ade80;
  margin-bottom: 20px; text-transform: uppercase; padding: 10px 22px;
  background: rgba(13,180,150,0.18); border: 1px solid rgba(13,180,150,0.4); border-radius: 50px;
}
.badge-dot {
  width: 8px; height: 8px; border-radius: 50%; background: #4ade80;
  box-shadow: 0 0 0 3px rgba(74,222,128,0.25); animation: pulse 2s infinite; flex-shrink: 0;
}
@keyframes pulse {
  0%,100% { box-shadow: 0 0 0 3px rgba(74,222,128,0.25); }
  50%      { box-shadow: 0 0 0 7px rgba(74,222,128,0.08); }
}
.partnership-hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: clamp(2.4rem, 5vw, 3.6rem); font-weight: 700; line-height: 1.1; color: #fff; margin: 0 0 20px;
}
.partnership-hero h1 em { color: #4ade30; font-style: italic; }
.partnership-hero p { font-size: 1rem; line-height: 1.75; color: rgba(255,255,255,0.7); margin: 0 auto; max-width: 480px; }
.section-label {
  display: inline-block; font-size: 11px; font-weight: 600;
  letter-spacing: 0.22em; color: #2db84b; margin-bottom: 14px; text-transform: uppercase;
}

/* ── Stats ── */
.stats-bar { background: #fff; border-bottom: 2px solid #e8f8ec; display: flex; align-items: center; justify-content: center; }
.stat { display: flex; flex-direction: column; align-items: center; padding: 28px 48px; flex: 1; max-width: 220px; }
.stat-num { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: #2db84b; line-height: 1; margin-bottom: 4px; }
.stat-label { font-size: 0.78rem; font-weight: 500; color: #888; text-transform: uppercase; letter-spacing: 0.08em; text-align: center; }
.stat-divider { width: 1px; height: 48px; background: #e0ece3; flex-shrink: 0; }

/* ── Body ── */
.partnership-body { max-width: 1100px; margin: 0 auto; padding: 64px 40px 80px; }

/* ── Value Cards ── */
.value-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; margin-bottom: 72px; }
.value-card {
  background: #fff; border: 1px solid #dff0e3; border-radius: 16px;
  padding: 40px 36px; position: relative; overflow: hidden;
  transition: box-shadow 0.25s, transform 0.25s;
}
.value-card::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
  background: linear-gradient(90deg, #1483c8, #027cd9); border-radius: 16px 16px 0 0;
}
.value-card:hover { box-shadow: 0 12px 40px rgba(45,184,75,0.12); transform: translateY(-4px); }
.value-icon {
  width: 52px; height: 52px; background: #e8f8ec; border-radius: 14px;
  display: flex; align-items: center; justify-content: center; color: #2db84b; margin-bottom: 20px;
}
.value-icon svg { width: 26px; height: 26px; }
.value-card h2 { font-family: 'Playfair Display', serif; font-size: 1.55rem; font-weight: 700; margin: 0 0 14px; }
.value-card p { font-size: 0.92rem; line-height: 1.8; color: #555; margin: 0; }

/* ── Brands ── */
.brands-section { margin-bottom: 64px; }
.brands-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 24px; gap: 24px; }
.brands-header-left h2 { font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 700; margin: 6px 0 10px; }
.brands-header-left h2 em { color: #2db84b; font-style: italic; }
.brands-header-left p { font-size: 0.9rem; color: #777; margin: 0; line-height: 1.7; }
.auth-badge {
  display: flex; align-items: center; gap: 8px; background: #1a1a2e; color: #fff;
  padding: 10px 20px; border-radius: 30px; font-size: 0.82rem; font-weight: 600; white-space: nowrap;
}
.auth-badge svg { width: 16px; height: 16px; color: #2db84b; }

/* ── Filter Row ── */
.filter-row { display: flex; gap: 8px; margin-bottom: 28px; flex-wrap: wrap; }
.filter-btn {
  padding: 7px 18px; border-radius: 30px; border: 1px solid #d5e8da; background: #fff;
  font-size: 0.82rem; font-weight: 500; color: #666; cursor: pointer;
  transition: all 0.2s; font-family: 'DM Sans', sans-serif;
}
.filter-btn:hover { border-color: #2db84b; color: #2db84b; }
.filter-btn.active { background: #2db84b; border-color: #2db84b; color: #fff; }

/* ── Logo Grid ── */
.logo-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 14px; }
.logo-card {
  background: #fff; border: 1px solid #e8ede9; border-radius: 14px;
  padding: 22px 12px 16px;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  gap: 10px; min-height: 148px;
  transition: all 0.25s cubic-bezier(0.34, 1.4, 0.64, 1);
  text-align: center; position: relative; overflow: hidden;
}
.logo-card::after {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
  background: linear-gradient(90deg, #2db84b, #0099cc);
  transform: scaleX(0); transform-origin: left;
  transition: transform 0.28s ease; border-radius: 14px 14px 0 0;
}
.logo-card:hover::after { transform: scaleX(1); }
.logo-card:hover {
  box-shadow: 0 14px 36px rgba(20, 131, 200, 0.12);
  transform: translateY(-5px); border-color: #c8e8d4;
}
.logo-wrapper { display: flex; align-items: center; justify-content: center; width: 100%; height: 64px; }
.logo-wrapper svg { width: 100%; max-width: 145px; height: auto; transition: transform 0.25s ease; }
.logo-card:hover .logo-wrapper svg { transform: scale(1.05); }
.logo-cat {
  font-size: 0.67rem; color: #b0b8c0; font-weight: 600;
  text-transform: uppercase; letter-spacing: 0.1em; margin-top: auto;
}

/* ── CTA ── */
.cta-banner {
  background: linear-gradient(135deg, #166995 0%, #065b82 100%);
  border-radius: 20px; padding: 48px 52px;
  display: flex; align-items: center; justify-content: space-between;
  gap: 32px; position: relative; overflow: hidden;
}
.cta-banner::before {
  content: ''; position: absolute; right: -60px; top: -60px;
  width: 260px; height: 260px; border-radius: 50%;
  border: 1px solid rgba(45,184,75,0.15);
}
.cta-content h3 { font-family: 'Playfair Display', serif; font-size: 1.6rem; font-weight: 700; color: #fff; margin: 0 0 8px; }
.cta-content p { font-size: 0.92rem; color: rgba(255,255,255,0.6); margin: 0; max-width: 440px; line-height: 1.7; }
.cta-btn {
  background: #2db84b; color: #fff; text-decoration: none;
  padding: 14px 32px; border-radius: 30px;
  font-size: 0.95rem; font-weight: 600; white-space: nowrap;
  transition: all 0.2s; box-shadow: 0 4px 20px rgba(45,184,75,0.35);
}
.cta-btn:hover { background: #1e9e3a; transform: translateY(-2px); }

/* ── Responsive ── */
@media (max-width: 1100px) { .logo-grid { grid-template-columns: repeat(4, 1fr); } }
@media (max-width: 900px) {
  .logo-grid { grid-template-columns: repeat(3, 1fr); }
  .value-grid { grid-template-columns: 1fr; }
  .stats-bar { flex-wrap: wrap; }
  .stat-divider { display: none; }
}
@media (max-width: 640px) {
  .partnership-hero { padding: 50px 28px 100px; }
  .partnership-body { padding: 40px 20px 60px; }
  .logo-grid { grid-template-columns: repeat(2, 1fr); }
  .brands-header { flex-direction: column; align-items: flex-start; }
  .cta-banner { flex-direction: column; padding: 36px 28px; text-align: center; }
  .value-card { padding: 28px 24px; }
}
</style>