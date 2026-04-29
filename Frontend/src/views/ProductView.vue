<template>
  <div class="product-page">
    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-bg">
        <svg class="hero-waves" viewBox="0 0 1440 320" preserveAspectRatio="none">
          <path class="wave wave-1"
            d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
          </path>
          <path class="wave wave-2"
            d="M0,256L48,240C96,224,192,192,288,181.3C384,171,480,181,576,208C672,235,768,277,864,277.3C960,277,1056,235,1152,213.3C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
          </path>
        </svg>
        <div class="hero-glow"></div>
      </div>
      <div class="hero-content">
        <span class="label">
          <span class="badge-dot"></span>
          Our Solustions
        </span>
        <h1>Products</h1>
        <p>Premium networking and cabling solutions from world-leading manufacturers</p>
      </div>
    </section>

    <!-- Category Filter -->
    <section class="filter-section">
      <div class="container">
        <div class="filter-tabs">
          <button v-for="category in categories" :key="category.id"
            :class="['filter-tab', { active: activeCategory === category.id }]" @click="activeCategory = category.id">
            <component :is="category.icon" class="tab-icon" />
            {{ category.name }}
            <span class="tab-count">{{ getCategoryCount(category.id) }}</span>
          </button>
        </div>
      </div>
    </section>

    <!-- Products Grid -->
    <section class="products-section">
      <div class="container">
        <div class="products-grid">
          <article v-for="product in filteredProducts" :key="product.id" class="product-card">
            <div class="product-image-wrapper">
              <div class="product-badge" :class="product.badge.type">
                {{ product.badge.text }}
              </div>
              <img :src="product.image" :alt="product.title" class="product-image" />
            </div>
            <div class="product-content">
              <div class="product-brand">
                <span class="brand-name">{{ product.brand }}</span>
                <span class="product-category">{{ product.category }}</span>
              </div>
              <h3 class="product-title">{{ product.title }}</h3>
              <p class="product-description">{{ product.description }}</p>
              <ul class="product-features">
                <li v-for="(feature, index) in product.features" :key="index">
                  <svg class="check-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                      clip-rule="evenodd" />
                  </svg>
                  {{ feature }}
                </li>
              </ul>
              <div class="product-footer">
                <a :href="product.link" class="product-btn">
                  View Details
                  <svg class="arrow-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>
                </a>
                <button class="wishlist-btn" @click="toggleWishlist(product.id)">
                  <svg viewBox="0 0 24 24" :fill="isWishlisted(product.id) ? 'currentColor' : 'none'"
                    stroke="currentColor" stroke-width="2">
                    <path
                      d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                    </path>
                  </svg>
                </button>
              </div>
            </div>
          </article>
        </div>

        <!-- Load More -->
        <div class="load-more">
          <button class="load-more-btn">
            Load More Products
            <svg class="refresh-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M23 4v6h-6M1 20v-6h6M3.51 9a9 9 0 0114.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0020.49 15" />
            </svg>
          </button>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, h } from 'vue'

const activeCategory = ref('all')
const wishlist = ref([])

const categories = [
  { id: 'all', name: 'All Products', icon: { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('rect', { x: '3', y: '3', width: '7', height: '7' }), h('rect', { x: '14', y: '3', width: '7', height: '7' }), h('rect', { x: '14', y: '14', width: '7', height: '7' }), h('rect', { x: '3', y: '14', width: '7', height: '7' })]) } },
  { id: 'cables', name: 'Structured Cabling Systems', icon: { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('path', { d: 'M4 9h16M4 15h16M10 3v18M14 3v18' })]) } },
  { id: 'switches', name: 'LAN Switches', icon: { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('circle', { cx: '12', cy: '12', r: '2' }), h('path', { d: 'M16.24 7.76a6 6 0 010 8.49m-8.48-.01a6 6 0 010-8.49m11.31-2.82a10 10 0 010 14.14m-14.14 0a10 10 0 010-14.14' })]) } },
  { id: 'wireless', name: 'Wireless LAN', icon: { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('path', { d: 'M12 2v20M2 12h20M12 2a10 10 0 0110 10M12 2a10 10 0 00-10 10' })]) } },
  { id: 'networking', name: 'Network Management', icon: { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('path', { d: 'M4 4h16v16H4z' }), h('path', { d: 'M8 8h8v8H8z' })]) } },
  { id: 'telephony', name: 'IP Telephony', icon: { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('path', { d: 'M12 20l9-5-9-5-9 5 9 5z' }), h('path', { d: 'M12 12l9-5-9-5-9 5 9 5z' })]) } },
  { id: 'media', name: 'Media Conversion', icon: { render: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': '2' }, [h('path', { d: 'M12 1v22M1 12h22' })]) } },
]

const products = ref([
  {
    id: 1,
    brand: 'Nexans',
    category: 'Cables',
    title: 'L2+ 10G Ethernet Switch',
    description: 'L2+ 10G Ethernet Switch',
    image: 'https://planec.com.kh/wp-content/uploads/2020/02/box_XGS-5240-24X2QR-e1581832356245.jpg',
    features: ['10 Gigabit Support', '500 MHz Bandwidth', 'LSZH Jacket'],
    badge: { text: 'Best Seller', type: 'bestseller' },
    link: '/products/cat6a-cable',
    categoryId: 'cables'
  },
  {
    id: 2,
    brand: 'PLANET',
    category: 'Networking',
    title: 'Industrial Managed Switch',
    description: '24-Port Gigabit + 4-Port SFP L2+ Industrial Managed Switch with wide operating temperature.',
    image: 'https://planec.com.kh/wp-content/uploads/2021/04/box_GS-5220-16P2XVR_01-e1618819044877.jpg',
    features: ['24 Gigabit Ports', '-40 to 75°C', 'Redundant Power'],
    badge: { text: 'New Arrival', type: 'new' },
    link: '/products/industrial-switch',
    categoryId: 'networking'
  },
  {
    id: 3,
    brand: 'FINEN',
    category: 'Structured Cabling',
    title: 'Fiber Patch Panel 24-Port',
    description: 'High-density LC duplex fiber optic patch panel for data center and enterprise applications.',
    image: 'https://planec.com.kh/wp-content/uploads/2020/02/box_WDAP-C7200E-e1581841599837.jpg',
    features: ['24 LC Duplex', 'Tool-less Design', 'Cable Management'],
    badge: { text: 'Popular', type: 'popular' },
    link: '/products/fiber-panel',
    categoryId: 'fiber'
  },
  {
    id: 4,
    brand: 'LINK',
    category: 'Cabling Systems',
    title: 'Cat6 Keystone Jack',
    description: 'UTP Cat6 keystone jack with 90-degree termination and gold-plated contacts.',
    image: 'https://planec.com.kh/wp-content/uploads/2020/02/box_WNAP-C3220E-e1581841172654.jpg',
    features: ['T568A/B Wiring', 'Gold Contacts', 'UL Listed'],
    badge: { text: 'Value', type: 'value' },
    link: '/products/keystone-jack',
    categoryId: 'cables'
  },
  {
    id: 5,
    brand: 'PLANET',
    category: 'Networking',
    title: 'PoE Media Converter',
    description: '10/100/1000Base-T to 1000Base-SX/LX PoE+ Media Converter with fiber connectivity.',
    image: 'https://planec.com.kh/wp-content/uploads/2020/03/Industrail-Media-Conversation-e1584177366363.jpg',
    features: ['PoE+ 30W', 'Fiber to Copper', 'DIN Rail Mount'],
    badge: { text: 'Featured', type: 'featured' },
    link: '/products/poe-converter',
    categoryId: 'networking'
  },
  {
    id: 6,
    brand: 'Nexans',
    category: 'Cables',
    title: 'Cat5e UTP Cable',
    description: 'Cost-effective unshielded twisted pair cable for Fast Ethernet applications up to 100 meters.',
    image: 'https://planec.com.kh/wp-content/uploads/2020/02/box_XGS-5240-24X2QR-e1581832356245.jpg',
    features: ['Fast Ethernet Support', '100 MHz Bandwidth', 'PVC Jacket'],
    badge: { text: 'Best Value', type: 'value' },
    link: '/products/cat5e-cable',
    categoryId: 'cables'
  },
  {
    id: 7,
    brand: 'FINEN',
    category: 'Structured Cabling',
    title: 'Fiber Patch Panel 48-Port',
    description: 'High-density LC duplex fiber optic patch panel for data center and enterprise applications.',
    image: 'https://planec.com.kh/wp-content/uploads/2020/02/box_WDAP-C7200E-e1581841599837.jpg',
    features: ['48 LC Duplex', 'Tool-less Design', 'Cable Management'],
    badge: { text: 'New Arrival', type: 'new' },
    link: '/products/fiber-panel-48',
    categoryId: 'fiber'
  },
  {
    id: 8,
    brand: 'LINK',
    category: 'Cabling Systems',
    title: 'Cat6A Keystone Jack',
    description: 'Shielded Cat6A keystone jack with 90-degree termination and gold-plated contacts.',
    image: 'https://planec.com.kh/wp-content/uploads/2020/02/box_WNAP-C3220E-e1581841172654.jpg',
    features: ['T568A/B Wiring', 'Gold Contacts', 'UL Listed'],
    badge: { text: 'Popular', type: 'popular' },
    link: '/products/cat6a-keystone-jack',
    categoryId: 'cables'
  },
  {
    id: 9,
    brand: 'PLANET',
    category: 'Networking',
    title: 'Industrial PoE Switch',
    description: '8-Port Gigabit PoE+ Industrial Switch with wide operating temperature and redundant power.',
    image: 'https://planec.com.kh/wp-content/uploads/2021/04/box_GS-5220-16P2XVR_01-e1618819044877.jpg',
    features: ['8 Gigabit PoE+ Ports', '-40 to 75°C', 'Redundant Power'],
    badge: { text: 'Featured', type: 'featured' },
    link: '/products/industrial-poe-switch',
    categoryId: 'networking'
  },
  {
    id: 10,
    brand: 'Nexans',
    category: 'Cables',
    title: 'Cat6 UTP Cable',
    description: 'High-performance unshielded twisted pair cable for Gigabit Ethernet applications up to 100 meters.',
    image: 'https://planec.com.kh/wp-content/uploads/2020/02/box_XGS-5240-24X2QR-e1581832356245.jpg',
    features: ['Gigabit Support', '250 MHz Bandwidth', 'PVC Jacket'],
    badge: { text: 'Best Seller', type: 'bestseller' },
    link: '/products/cat6-cable',
    categoryId: 'cables'
  },
])

const filteredProducts = computed(() => {
  if (activeCategory.value === 'all') return products.value
  return products.value.filter(p => p.categoryId === activeCategory.value)
})

const getCategoryCount = (categoryId) => {
  if (categoryId === 'all') return products.value.length
  return products.value.filter(p => p.categoryId === categoryId).length
}

const toggleWishlist = (productId) => {
  const index = wishlist.value.indexOf(productId)
  if (index > -1) {
    wishlist.value.splice(index, 1)
  } else {
    wishlist.value.push(productId)
  }
}

const isWishlisted = (productId) => {
  return wishlist.value.includes(productId)
}
</script>

<style scoped>
.product-page {
  min-height: 90vh;
  background-color: #f8faf9;
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

/* Hero Section */
.hero {
  position: relative;
  background: linear-gradient(135deg,
      #072b4f 0%,
      #0b3d63 35%,
      #0f5b66 70%,
      #14706f 100%);
  padding: 80px 0 120px;
  overflow: hidden;
}

.hero-bg {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.hero-waves {
  position: absolute;
  bottom: -1px;
  left: 0;
  width: 100%;
  height: 150px;
}

.wave {
  fill: rgba(0, 200, 180, 0.1);
}

.wave-1 {
  animation: wave 8s ease-in-out infinite;
}

.wave-2 {
  fill: rgba(0, 200, 180, 0.05);
  animation: wave 10s ease-in-out infinite reverse;
}

@keyframes wave {

  0%,
  100% {
    transform: translateX(0);
  }

  50% {
    transform: translateX(-20px);
  }
}

.hero-glow {
  position: absolute;
  top: 20%;
  right: 10%;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(0, 200, 180, 0.2) 0%, transparent 70%);
  border-radius: 50%;
  filter: blur(60px);
}

.hero-content {
  position: relative;
  z-index: 10;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
  text-align: center;
}

.hero-badge {
  display: inline-block;
  padding: 8px 20px;
  background: rgba(16, 185, 129, 0.2);
  border: 1px solid rgba(16, 185, 129, 0.3);
  border-radius: 50px;
  color: #34d399;
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 20px;
}

.hero h1 {
  font-size: 56px;
  font-weight: 700;
  color: white;
  margin: 0 0 16px;
  text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
}

.hero p {
  font-size: 20px;
  color: rgba(255, 255, 255, 0.8);
  margin: 0;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

/* Filter Section */
.filter-section {
  position: sticky;
  top: 0;
  z-index: 100;
  background: white;
  border-bottom: 1px solid #e5e7eb;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
}

.filter-tabs {
  display: flex;
  gap: 8px;
  padding: 16px 0;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.filter-tab {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: #f3f4f6;
  border: 2px solid transparent;
  border-radius: 50px;
  color: #6b7280;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
  white-space: nowrap;
}

.filter-tab:hover {
  background: #e5e7eb;
  color: #374151;
}

.filter-tab.active {
  background: #10b981;
  color: white;
  border-color: #10b981;
}

.tab-icon {
  width: 18px;
  height: 18px;
}

.tab-count {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 24px;
  height: 24px;
  padding: 0 8px;
  background: rgba(0, 0, 0, 0.1);
  border-radius: 12px;
  font-size: 12px;
  font-weight: 600;
}

.filter-tab.active .tab-count {
  background: rgba(255, 255, 255, 0.2);
}

/* Products Section */
.products-section {
  padding: 60px 0;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}

@media (max-width: 1024px) {
  .products-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 640px) {
  .products-grid {
    grid-template-columns: 1fr;
  }
}

.product-card {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.product-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
}

.product-image-wrapper {
  position: relative;
  aspect-ratio: 4/3;
  overflow: hidden;
  background: #f3f4f6;
}

.product-badge {
  position: absolute;
  top: 16px;
  left: 16px;
  z-index: 10;
  padding: 6px 14px;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.product-badge.bestseller {
  background: #fef3c7;
  color: #d97706;
}

.product-badge.new {
  background: #dbeafe;
  color: #2563eb;
}

.product-badge.popular {
  background: #fce7f3;
  color: #db2777;
}

.product-badge.value {
  background: #d1fae5;
  color: #059669;
}

.product-badge.featured {
  background: #ede9fe;
  color: #7c3aed;
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.product-card:hover .product-image {
  transform: scale(1.08);
}

.product-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
  opacity: 1;
}

.product-content {
  padding: 24px;
}

.product-brand {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
}

.brand-name {
  font-size: 13px;
  font-weight: 600;
  color: #10b981;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.product-category {
  font-size: 12px;
  color: #9ca3af;
  background: #f3f4f6;
  padding: 4px 10px;
  border-radius: 20px;
}

.product-title {
  font-size: 18px;
  font-weight: 700;
  color: #1f2937;
  margin: 0 0 12px;
  line-height: 1.3;
}

.product-description {
  font-size: 14px;
  color: #6b7280;
  line-height: 1.6;
  margin: 0 0 16px;
}

.product-features {
  list-style: none;
  padding: 0;
  margin: 0 0 20px;
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.product-features li {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  color: #4b5563;
  background: #f9fafb;
  padding: 6px 12px;
  border-radius: 20px;
}

.check-icon {
  width: 14px;
  height: 14px;
  color: #10b981;
  flex-shrink: 0;
}

.product-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 16px;
  border-top: 1px solid #f3f4f6;
}

.product-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  background: #10b981;
  color: white;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  border-radius: 50px;
  transition: all 0.2s ease;
}

.product-btn:hover {
  background: #059669;
  transform: translateX(4px);
}

.arrow-icon {
  width: 16px;
  height: 16px;
  transition: transform 0.2s ease;
}

.product-btn:hover .arrow-icon {
  transform: translateX(4px);
}

.wishlist-btn {
  width: 44px;
  height: 44px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f9fafb;
  border: 1px solid #e5e7eb;
  border-radius: 50%;
  color: #9ca3af;
  cursor: pointer;
  transition: all 0.2s ease;
}

.wishlist-btn:hover {
  background: #fef2f2;
  border-color: #fecaca;
  color: #ef4444;
}

.wishlist-btn svg {
  width: 20px;
  height: 20px;
}

/* Load More */
.load-more {
  display: flex;
  justify-content: center;
  margin-top: 50px;
}

.load-more-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 16px 36px;
  background: white;
  border: 2px solid #e5e7eb;
  border-radius: 50px;
  color: #374151;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
}

.load-more-btn:hover {
  border-color: #10b981;
  color: #10b981;
}

.refresh-icon {
  width: 18px;
  height: 18px;
}

.load-more-btn:hover .refresh-icon {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}

/* Responsive */
@media (max-width: 768px) {
  .hero {
    padding: 60px 0 100px;
  }

  .hero h1 {
    font-size: 36px;
  }

  .hero p {
    font-size: 16px;
  }

  .filter-tabs {
    gap: 6px;
  }

  .filter-tab {
    padding: 8px 14px;
    font-size: 13px;
  }
}
</style>