<template>
  <div class="product-page">

    <!-- ───── Hero ───── -->
    <section class="hero">
      <div class="hero-bg">
        <svg class="hero-waves" viewBox="0 0 1440 320" preserveAspectRatio="none">
          <path class="wave wave-1"
            d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z" />
          <path class="wave wave-2"
            d="M0,256L48,240C96,224,192,192,288,181.3C384,171,480,181,576,208C672,235,768,277,864,277.3C960,277,1056,235,1152,213.3C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z" />
        </svg>
        <div class="hero-glow"></div>
        <div class="hero-glow hero-glow-2"></div>
      </div>
      <div class="hero-content">
        <span class="hero-label">
          <span class="badge-dot"></span>
          Cambodia Authorized Distributor
        </span>
        <h1>Product Catalog</h1>
        <p>Premium networking, cabling &amp; security solutions from world-leading manufacturers</p>
      </div>
    </section>

    <!-- ───── Brands Strip ───── -->
    <section class="brands-strip">
      <div class="container">
        <p class="brands-label">Authorized brands</p>
        <div class="brands-row">
          <button v-for="b in brandList" :key="b.name" :class="['brand-pill', { active: activeBrand === b.name }]"
            :style="activeBrand === b.name ? `background:${b.bg};color:${b.fg};border-color:${b.fg}` : ''"
            @click="activeBrand = activeBrand === b.name ? 'All' : b.name; currentPage = 1">
            {{ b.name }}
          </button>
        </div>
      </div>
    </section>

    <!-- ───── Toolbar ───── -->
    <section class="toolbar-section">
      <div class="container">
        <div class="toolbar">
          <!-- Search -->
          <div class="search-wrap">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.35-4.35" />
            </svg>
            <input v-model="searchQuery" class="search-input" type="text"
              placeholder="Search by name, part number or brand…" @input="currentPage = 1" />
            <button v-if="searchQuery" class="search-clear" @click="searchQuery = ''; currentPage = 1">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                <path d="M18 6 6 18M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Category filter -->
          <div class="cat-tabs">
            <button v-for="cat in categoryList" :key="cat" :class="['cat-tab', { active: activeCategory === cat }]"
              @click="activeCategory = cat; currentPage = 1">
              {{ cat }}
              <span class="cat-count">{{ getCatCount(cat) }}</span>
            </button>
          </div>

          <!-- Sort -->
          <div class="sort-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"
              style="color:var(--text-muted)">
              <path d="M3 6h18M7 12h10M11 18h2" />
            </svg>
            <select v-model="sortMode" class="sort-select" @change="currentPage = 1">
              <option value="default">Default order</option>
              <option value="priceAsc">Price: low → high</option>
              <option value="priceDesc">Price: high → low</option>
              <option value="discount">Highest discount</option>
              <option value="brand">Brand A–Z</option>
              <option value="name">Name A–Z</option>
            </select>
          </div>
        </div>

        <!-- Active filters summary -->
        <div v-if="activeBrand !== 'All' || activeCategory !== 'All' || searchQuery" class="active-filters">
          <span class="filter-summary-label">Filters:</span>
          <span v-if="activeBrand !== 'All'" class="filter-chip" @click="activeBrand = 'All'; currentPage = 1">
            {{ activeBrand }} <span class="chip-x">×</span>
          </span>
          <span v-if="activeCategory !== 'All'" class="filter-chip" @click="activeCategory = 'All'; currentPage = 1">
            {{ activeCategory }} <span class="chip-x">×</span>
          </span>
          <span v-if="searchQuery" class="filter-chip" @click="searchQuery = ''; currentPage = 1">
            "{{ searchQuery }}" <span class="chip-x">×</span>
          </span>
          <button class="clear-all-btn" @click="clearFilters">Clear all</button>
        </div>
      </div>
    </section>

    <!-- ───── Results bar ───── -->
    <section class="results-bar-section">
      <div class="container results-bar">
        <span class="results-count">
          Showing <strong>{{ paginatedProducts.length }}</strong> of <strong>{{ filteredProducts.length }}</strong>
          products
        </span>
        <div class="view-toggle">
          <button :class="['view-btn', { active: viewMode === 'grid' }]" @click="viewMode = 'grid'" title="Grid view">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
              <rect x="3" y="3" width="7" height="7" />
              <rect x="14" y="3" width="7" height="7" />
              <rect x="14" y="14" width="7" height="7" />
              <rect x="3" y="14" width="7" height="7" />
            </svg>
          </button>
          <button :class="['view-btn', { active: viewMode === 'list' }]" @click="viewMode = 'list'" title="List view">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
              <line x1="8" y1="6" x2="21" y2="6" />
              <line x1="8" y1="12" x2="21" y2="12" />
              <line x1="8" y1="18" x2="21" y2="18" />
              <line x1="3" y1="6" x2="3.01" y2="6" />
              <line x1="3" y1="12" x2="3.01" y2="12" />
              <line x1="3" y1="18" x2="3.01" y2="18" />
            </svg>
          </button>
        </div>
      </div>
    </section>

    <!-- ───── Products ───── -->
    <section class="products-section">
      <div class="container">

        <!-- Empty state -->
        <div v-if="filteredProducts.length === 0" class="empty-state">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48"
            style="color:#d1d5db">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.35-4.35" />
          </svg>
          <p class="empty-title">No products found</p>
          <p class="empty-sub">Try adjusting your search or filters</p>
          <button class="btn-primary" @click="clearFilters">Clear all filters</button>
        </div>

        <!-- Grid view -->
        <div v-else-if="viewMode === 'grid'" class="products-grid">
          <article v-for="product in paginatedProducts" :key="product.id" class="product-card"
            @click="openDetail(product)">
            <div class="card-image-wrap">
              <div class="brand-badge"
                :style="`background:${getBrandColor(product.brand).bg};color:${getBrandColor(product.brand).fg}`">
                {{ product.brand }}
              </div>
              <div class="dsrp-badge">DSRP</div>
              <div class="card-image-inner">
                <img v-if="product.image" :src="product.image" :alt="product.name" class="product-img"
                  @error="e => e.target.style.display = 'none'" />
                <div v-else class="img-placeholder">
                  <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.2" width="40" height="40"
                    style="color:#d1d5db">
                    <rect x="8" y="8" width="48" height="48" rx="4" />
                    <circle cx="24" cy="26" r="6" />
                    <path d="m8 44 16-12 12 10 8-8 12 14" />
                  </svg>
                  <span class="placeholder-part">{{ product.partNo }}</span>
                </div>
              </div>
              <button class="wishlist-btn" :class="{ active: isWishlisted(product.id) }"
                @click.stop="toggleWishlist(product.id)">
                <svg viewBox="0 0 24 24" :fill="isWishlisted(product.id) ? 'currentColor' : 'none'"
                  stroke="currentColor" stroke-width="2" width="16" height="16">
                  <path
                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
              </button>
            </div>

            <div class="card-body">
              <div class="card-meta">
                <code class="part-no">{{ product.partNo }}</code>
                <span class="cat-tag">{{ product.cat }}</span>
              </div>
              <h3 class="card-title">{{ product.name }}</h3>
              <p v-if="product.description" class="card-desc">{{ product.description }}</p>

              <div class="card-specs">
                <div class="spec-row">
                  <div class="spec-cell">
                    <span class="spec-label">Unit</span>
                    <span class="spec-value">{{ product.unit }}</span>
                  </div>
                  <div class="spec-cell">
                    <span class="spec-label">Qty</span>
                    <span class="spec-value">{{ product.qty }}</span>
                  </div>
                  <div class="spec-cell">
                    <span class="spec-label">Discount</span>
                    <span class="spec-value discount">{{ product.discount }}%</span>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <div class="price-block">
                  <span class="list-price">List: <s>${{ fmt(product.list) }}</s></span>
                  <span class="sell-price">${{ fmt(sellPrice(product)) }}</span>
                </div>
                <button class="btn-detail" @click.stop="openDetail(product)">
                  View details
                  <svg viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
                    <path fill-rule="evenodd"
                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>
                </button>
              </div>
            </div>
          </article>
        </div>

        <!-- List view -->
        <div v-else class="products-list">
          <div v-for="product in paginatedProducts" :key="product.id" class="list-row" @click="openDetail(product)">
            <div class="list-img">
              <img v-if="product.image" :src="product.image" :alt="product.name"
                @error="e => e.target.style.display = 'none'" />
              <svg v-else viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.2" width="28"
                height="28" style="color:#d1d5db">
                <rect x="8" y="8" width="48" height="48" rx="4" />
                <circle cx="24" cy="26" r="6" />
                <path d="m8 44 16-12 12 10 8-8 12 14" />
              </svg>
            </div>
            <div class="list-info">
              <div class="list-top">
                <span class="brand-badge-sm"
                  :style="`background:${getBrandColor(product.brand).bg};color:${getBrandColor(product.brand).fg}`">{{
                    product.brand }}</span>
                <code class="part-no">{{ product.partNo }}</code>
                <span class="cat-tag">{{ product.cat }}</span>
              </div>
              <p class="list-name">{{ product.name }}</p>
            </div>
            <div class="list-meta">
              <span class="spec-label">Unit</span>
              <span class="spec-value">{{ product.unit }}</span>
            </div>
            <div class="list-meta">
              <span class="spec-label">Qty</span>
              <span class="spec-value">{{ product.qty }}</span>
            </div>
            <div class="list-meta">
              <span class="spec-label">List price</span>
              <span class="spec-value"><s>${{ fmt(product.list) }}</s></span>
            </div>
            <div class="list-meta">
              <span class="spec-label">Discount</span>
              <span class="spec-value discount">{{ product.discount }}%</span>
            </div>
            <div class="list-meta">
              <span class="spec-label">Sell price</span>
              <span class="spec-value sell-price-sm">${{ fmt(sellPrice(product)) }}</span>
            </div>
            <button class="btn-detail-sm" @click.stop="openDetail(product)">Details →</button>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="totalPages > 1" class="pagination">
          <button class="page-btn" :disabled="currentPage === 1" @click="currentPage--">
            <svg viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
              <path fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            Prev
          </button>
          <div class="page-numbers">
            <button v-for="p in pageRange" :key="p"
              :class="['page-num', { active: p === currentPage, ellipsis: p === '…' }]" :disabled="p === '…'"
              @click="p !== '…' && (currentPage = p)">{{ p }}</button>
          </div>
          <button class="page-btn" :disabled="currentPage === totalPages" @click="currentPage++">
            Next
            <svg viewBox="0 0 20 20" fill="currentColor" width="14" height="14">
              <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
    </section>

    <!-- ───── Detail Modal ───── -->
    <Transition name="modal">
      <div v-if="selectedProduct" class="modal-backdrop" @click.self="selectedProduct = null">
        <div class="modal">
          <button class="modal-close" @click="selectedProduct = null">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20">
              <path d="M18 6 6 18M6 6l12 12" />
            </svg>
          </button>

          <div class="modal-image">
            <img v-if="selectedProduct.image" :src="selectedProduct.image" :alt="selectedProduct.name" />
            <div v-else class="modal-img-placeholder">
              <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.2" width="56" height="56"
                style="color:#d1d5db">
                <rect x="8" y="8" width="48" height="48" rx="4" />
                <circle cx="24" cy="26" r="6" />
                <path d="m8 44 16-12 12 10 8-8 12 14" />
              </svg>
            </div>
            <div class="modal-brand-badge"
              :style="`background:${getBrandColor(selectedProduct.brand).bg};color:${getBrandColor(selectedProduct.brand).fg}`">
              {{ selectedProduct.brand }}</div>
          </div>

          <div class="modal-body">
            <div class="modal-meta">
              <code class="part-no-lg">{{ selectedProduct.partNo }}</code>
              <span class="cat-tag">{{ selectedProduct.cat }}</span>
              <span class="dsrp-tag-sm">DSRP 2026-190126-V01</span>
            </div>
            <h2 class="modal-title">{{ selectedProduct.name }}</h2>
            <p v-if="selectedProduct.description" class="modal-desc">{{ selectedProduct.description }}</p>

            <div class="modal-specs-grid">
              <div class="modal-spec">
                <span class="spec-label">Brand</span>
                <span class="spec-value">{{ selectedProduct.brand }}</span>
              </div>
              <div class="modal-spec">
                <span class="spec-label">Part number</span>
                <code class="spec-value">{{ selectedProduct.partNo }}</code>
              </div>
              <div class="modal-spec">
                <span class="spec-label">Unit</span>
                <span class="spec-value">{{ selectedProduct.unit }}</span>
              </div>
              <div class="modal-spec">
                <span class="spec-label">Qty</span>
                <span class="spec-value">{{ selectedProduct.qty }}</span>
              </div>
              <div class="modal-spec">
                <span class="spec-label">List price</span>
                <span class="spec-value">${{ fmt(selectedProduct.list) }}</span>
              </div>
              <div class="modal-spec">
                <span class="spec-label">Discount</span>
                <span class="spec-value discount">{{ selectedProduct.discount }}% off</span>
              </div>
            </div>

            <div class="modal-price-box">
              <div>
                <p class="modal-list-price">List price: <s>${{ fmt(selectedProduct.list) }}</s></p>
                <p class="modal-you-save">You save: ${{ fmt(selectedProduct.list - sellPrice(selectedProduct)) }} ({{
                  selectedProduct.discount }}%)</p>
              </div>
              <div class="modal-sell-price">${{ fmt(sellPrice(selectedProduct)) }}</div>
            </div>

            <div class="modal-actions">
              <button class="btn-primary" @click="selectedProduct = null">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                  <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Add to quote
              </button>
              <button class="btn-secondary" @click="toggleWishlist(selectedProduct.id)">
                <svg viewBox="0 0 24 24" :fill="isWishlisted(selectedProduct.id) ? 'currentColor' : 'none'"
                  stroke="currentColor" stroke-width="2" width="16" height="16">
                  <path
                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
                {{ isWishlisted(selectedProduct.id) ? 'Remove from wishlist' : 'Save to wishlist' }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </Transition>

    <!-- ───── Wishlist Toast ───── -->
    <Transition name="toast">
      <div v-if="showToast" class="toast">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"
          style="color:#10b981">
          <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ toastMsg }}
      </div>
    </Transition>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

/* ── Brand colours ── */
const brandColors = {
  'Siemon': { bg: '#E6F1FB', fg: '#0C447C' },
  'Planet': { bg: '#E1F5EE', fg: '#085041' },
  'Tyco': { bg: '#FAECE7', fg: '#712B13' },
  'Johnson Controls': { bg: '#FAEEDA', fg: '#633806' },
  'Kantech': { bg: '#EEEDFE', fg: '#3C3489' },
  'Nittan': { bg: '#FCEBEB', fg: '#791F1F' },
  'Nexans': { bg: '#EAF3DE', fg: '#27500A' },
  'Simplex': { bg: '#FBEAF0', fg: '#72243E' },
  'Finen': { bg: '#E6F1FB', fg: '#185FA5' },
  'Softing': { bg: '#F1EFE8', fg: '#444441' },
  'Exacq': { bg: '#FAEEDA', fg: '#854F0B' },
  'Software House': { bg: '#EEEDFE', fg: '#534AB7' },
}
const getBrandColor = (brand) => brandColors[brand] || { bg: '#F1EFE8', fg: '#444441' }

/* ── State ── */
const products = ref([])
const wishlist = ref([])
const selectedProduct = ref(null)
const activeBrand = ref('All')
const activeCategory = ref('All')
const searchQuery = ref('')
const sortMode = ref('default')
const viewMode = ref('grid')
const currentPage = ref(1)
const pageSize = 12
const showToast = ref(false)
const toastMsg = ref('')

/* ── Helpers ── */
const fmt = (n) => Number(n).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
const sellPrice = (p) => p.list * (1 - p.discount / 100)

/* ── Static product data ── */
/* Replace or extend with your API call in onMounted */
const staticProducts = [
  /* ── Siemon ── */
  { id: 1, brand: 'Siemon', cat: 'Structured cabling', partNo: '9C6M4-E2-RXA', name: 'Cable, Copper, Category 6, E2, 4 Pair, Solid, UTP, CM, BLUE, Reelex, 305 Meter, 24 AWG, Class Eca', description: 'High-performance Cat6 solid copper cable for horizontal runs, 305m reel.', unit: 'Box', qty: 1, list: 168.25, discount: 20, image: 'https://planec.com.kh/wp-content/uploads/2020/03/Industrail-Media-Conversation-e1584177366363.jpg' },
  { id: 2, brand: 'Siemon', cat: 'Structured cabling', partNo: 'UP6-F1-24K-RS', name: 'Copper Patch Panel, UltraMAX, with Jacks, UTP, Category 6, 24 Port, Flat, 1U, Black', description: '24-port flat patch panel with integrated Cat6 UltraMAX jacks.', unit: 'pcs', qty: 1, list: 155.75, discount: 20, image: 'https://planec.com.kh/wp-content/uploads/2020/03/network-rack-e1584178170665.jpg' },
  { id: 3, brand: 'Siemon', cat: 'Structured cabling', partNo: 'UP6-F1-48K-RS', name: 'Copper Patch Panel, UltraMAX, with Jacks, UTP, Category 6, 48 Port, Flat, 1U, Black', description: '48-port flat patch panel with integrated Cat6 UltraMAX jacks.', unit: 'pcs', qty: 1, list: 274.88, discount: 20, image: 'https://planec.com.kh/wp-content/uploads/2020/03/lan-switch-e1584329494547.jpg' },
  { id: 4, brand: 'Siemon', cat: 'Structured cabling', partNo: 'PC6-001M-A06LS', name: 'Copper Patch Cord, RJ45, RJ45, Category 6, UTP, T568A/B, Stranded, LSOH-1, Blue Cable, Blue Boot, 1 Meter, 24 AWG', description: 'Cat6 stranded LSOH patch cord, 1 m, blue.', unit: 'pcs', qty: 1, list: 4.13, discount: 20, image: 'https://planec.com.kh/wp-content/uploads/2021/04/softing-tools-200x200.png' },
  { id: 5, brand: 'Siemon', cat: 'Structured cabling', partNo: 'PC6-002M-A06LS', name: 'Copper Patch Cord, RJ45, RJ45, Category 6, UTP, T568A/B, Stranded, LSOH-1, Blue Cable, Blue Boot, 2 Meter, 24 AWG', description: 'Cat6 stranded LSOH patch cord, 2 m, blue.', unit: 'pcs', qty: 1, list: 4.90, discount: 20, image: 'https://planec.com.kh/wp-content/uploads/2020/03/Wireless-LAN-e1584177128469.jpg' },
  { id: 6, brand: 'Siemon', cat: 'Structured cabling', partNo: 'PC6-005M-A06LS', name: 'Copper Patch Cord, RJ45, RJ45, Category 6, UTP, T568A/B, Stranded, LSOH-1, Blue Cable, Blue Boot, 5 Meter, 24 AWG', description: 'Cat6 stranded LSOH patch cord, 5 m, blue.', unit: 'pcs', qty: 1, list: 9.68, discount: 20, image: 'https://planec.com.kh/wp-content/uploads/2019/09/cat6.jpg' },
  { id: 7, brand: 'Siemon', cat: 'Structured cabling', partNo: 'MX-BFPL-01-82', name: 'Faceplate, Double Layer, British, Single Gang, 1 Opening, MX, Alpine White', description: 'British-style single-gang faceplate, 1 port, Alpine White.', unit: 'pcs', qty: 1, list: 2.43, discount: 20, image: '' },
  { id: 8, brand: 'Siemon', cat: 'Structured cabling', partNo: 'MX-BFPL-02-82', name: 'Faceplate, Double Layer, British, Single Gang, 2 Opening, MX, Alpine White', description: 'British-style single-gang faceplate, 2 ports, Alpine White.', unit: 'pcs', qty: 1, list: 2.43, discount: 20, image: '' },
  { id: 9, brand: 'Siemon', cat: 'Structured cabling', partNo: 'U6-H02NS', name: 'Copper Outlet, UltraMAX, UTP, Category 6, RJ45, Hybrid, White, Punch down, T568A/B', description: 'UltraMAX Cat6 RJ45 outlet, punch-down, hybrid white.', unit: 'pcs', qty: 1, list: 5.19, discount: 20, image: '' },
  { id: 10, brand: 'Siemon', cat: 'Structured cabling', partNo: 'UMAX-TT', name: 'Termination Tool, TurboTool, UltraMAX', description: 'TurboTool for fast, reliable UltraMAX outlet termination.', unit: 'pcs', qty: 1, list: 125.00, discount: 20, image: '' },
  /* ── Planet ── */
  { id: 11, brand: 'Planet', cat: 'LAN switches', partNo: 'GS-4210-24T4S', name: '24-Port 10/100/1000T + 4-Port 100/1000X SFP Managed Gigabit Switch', description: 'Layer 2+ managed switch with 24 GbE ports and 4 SFP uplinks.', unit: 'pcs', qty: 1, list: 420.00, discount: 15, image: '' },
  { id: 12, brand: 'Planet', cat: 'Wireless LAN', partNo: 'WNAP-C3220E', name: 'IEEE 802.11ac 2T2R Wireless Outdoor AP with 5 dBi Dual-Band Antenna', description: 'Dual-band outdoor access point with IP67-rated enclosure.', unit: 'pcs', qty: 1, list: 185.00, discount: 15, image: '' },
  { id: 13, brand: 'Planet', cat: 'IP telephony', partNo: 'VIP-2140PT', name: '4-Port SIP IP Phone Adapter with PoE, 2 FXS + 2 FXO', description: 'VoIP adapter supporting SIP protocol with PoE power input.', unit: 'pcs', qty: 1, list: 145.00, discount: 15, image: '' },
  { id: 14, brand: 'Planet', cat: 'Media conversion', partNo: 'FT-802S35', name: 'Fast Ethernet Media Converter, 10/100Base-TX to 100Base-FX, Single-Mode, SC, 35 km', description: '100 Mbps copper-to-fibre media converter, single-mode 35 km.', unit: 'pcs', qty: 1, list: 68.00, discount: 15, image: '' },
  /* ── Tyco ── */
  { id: 15, brand: 'Tyco', cat: 'Security', partNo: 'T-REX-2W', name: 'T-Rex Dual Technology PIR & Microwave Motion Detector, 12 m × 12 m', description: 'Indoor dual-tech detector with anti-masking, 12 × 12 m coverage.', unit: 'pcs', qty: 1, list: 58.00, discount: 18, image: '' },
  { id: 16, brand: 'Tyco', cat: 'Security', partNo: 'DS-150i', name: 'Hardwire Door/Window Contact with LED Indicator, Surface Mount, White', description: 'Surface-mount magnetic contact with built-in LED status indicator.', unit: 'pcs', qty: 1, list: 12.50, discount: 18, image: '' },
  /* ── Johnson Controls ── */
  { id: 17, brand: 'Johnson Controls', cat: 'Fire alarm', partNo: 'MS-9200UDLS', name: 'FireFinder XLS Analog Addressable Fire Alarm Control Panel, 198 Points', description: 'Addressable FACP supporting up to 198 devices with UDP/LCD display.', unit: 'pcs', qty: 1, list: 1250.00, discount: 15, image: '' },
  /* ── Kantech ── */
  { id: 18, brand: 'Kantech', cat: 'Access control', partNo: 'E3-DOOR', name: 'Kantech E3 Door Controller with IP Connectivity and 5,000 Card Capacity', description: 'Single-door IP controller, 5 000-card onboard memory, PoE-compatible.', unit: 'pcs', qty: 1, list: 380.00, discount: 12, image: '' },
  /* ── Nittan ── */
  { id: 19, brand: 'Nittan', cat: 'Fire detection', partNo: 'EV-C', name: 'Evolution Analogue Addressable Optical Smoke Detector', description: 'Addressable optical detector for early warning smoke detection.', unit: 'pcs', qty: 1, list: 35.00, discount: 15, image: '' },
  /* ── Nexans ── */
  { id: 20, brand: 'Nexans', cat: 'Structured cabling', partNo: 'LANmark-7A', name: 'LANmark-7A 10G Category 7A LSZH Installation Cable, 500 m Drum', description: 'Cat7A LSZH screened installation cable for 10G backbone runs.', unit: 'Box', qty: 1, list: 420.00, discount: 18, image: '' },
  /* ── Simplex ── */
  { id: 21, brand: 'Simplex', cat: 'Fire alarm', partNo: '4904-9101', name: 'TrueAlert ES Notification Appliance, Ceiling, Red, 24 V, Speaker/Strobe', description: 'Addressable speaker-strobe notification appliance, ceiling mount, red.', unit: 'pcs', qty: 1, list: 89.00, discount: 15, image: '' },
  /* ── Finen ── */
  { id: 22, brand: 'Finen', cat: 'Network management', partNo: 'FN-SFP-GE-SX', name: 'Gigabit SX SFP Transceiver, 850 nm, LC Duplex, MMF, up to 550 m', description: '1000Base-SX SFP module for multi-mode fibre, 550 m reach.', unit: 'pcs', qty: 1, list: 22.00, discount: 15, image: '' },
  /* ── Softing ── */
  { id: 23, brand: 'Softing', cat: 'Network management', partNo: 'WireXpert-4500', name: 'WireXpert 4500 Cat 8.2 / Class I Network Cable Tester with LCD Display', description: 'Field tester supporting Cat8.2/Class I with colour touchscreen display.', unit: 'pcs', qty: 1, list: 3200.00, discount: 10, image: '' },
  /* ── Exacq ── */
  { id: 24, brand: 'Exacq', cat: 'Security', partNo: 'Z-16-16T-DT', name: 'Exacq Z-Series 16-Channel Desktop NVR with 16 TB Storage', description: '16-channel IP NVR in desktop form factor, 16 TB pre-installed.', unit: 'pcs', qty: 1, list: 1450.00, discount: 12, image: '' },
  /* ── Software House ── */
  { id: 25, brand: 'Software House', cat: 'Access control', partNo: 'CCURE-9000', name: 'C•CURE 9000 Security and Event Management Platform, Software License', description: 'Enterprise-grade access control and video management platform license.', unit: 'pcs', qty: 1, list: 2800.00, discount: 10, image: '' },
]

/* ── Load data ── */
onMounted(async () => {
  try {
    const res = await fetch('http://127.0.0.1:8000/api/products')
    const data = await res.json()
    products.value = data.map(p => ({
      id: p.id,
      brand: p.brand || 'PLANET',
      cat: p.category || 'Networking',
      partNo: p.part_number || p.partNo || '',
      name: p.name,
      description: p.description || '',
      unit: p.unit || 'pcs',
      qty: p.qty || 1,
      list: parseFloat(p.list_price || p.list || 0),
      discount: parseFloat(p.discount || 0),
      image: p.image || '',
    }))
  } catch {
    /* Fall back to static data when API is unavailable */
    products.value = staticProducts
  }
})

/* ── Brand list for pills ── */
const brandList = computed(() =>
  Object.entries(brandColors).map(([name, col]) => ({ name, ...col }))
)

/* ── Category list ── */
const categoryList = computed(() => {
  const cats = [...new Set(products.value.map(p => p.cat))].sort()
  return ['All', ...cats]
})
const getCatCount = (cat) =>
  cat === 'All' ? products.value.length : products.value.filter(p => p.cat === cat).length

/* ── Filtered + sorted ── */
const filteredProducts = computed(() => {
  let list = products.value.filter(p => {
    const bOk = activeBrand.value === 'All' || p.brand === activeBrand.value
    const cOk = activeCategory.value === 'All' || p.cat === activeCategory.value
    const q = searchQuery.value.toLowerCase()
    const sOk = !q || p.name.toLowerCase().includes(q) || p.partNo.toLowerCase().includes(q) || p.brand.toLowerCase().includes(q)
    return bOk && cOk && sOk
  })
  if (sortMode.value === 'priceAsc') list = [...list].sort((a, b) => sellPrice(a) - sellPrice(b))
  if (sortMode.value === 'priceDesc') list = [...list].sort((a, b) => sellPrice(b) - sellPrice(a))
  if (sortMode.value === 'discount') list = [...list].sort((a, b) => b.discount - a.discount)
  if (sortMode.value === 'brand') list = [...list].sort((a, b) => a.brand.localeCompare(b.brand))
  if (sortMode.value === 'name') list = [...list].sort((a, b) => a.name.localeCompare(b.name))
  return list
})

/* ── Pagination ── */
const totalPages = computed(() => Math.ceil(filteredProducts.value.length / pageSize))
const paginatedProducts = computed(() => {
  const start = (currentPage.value - 1) * pageSize
  return filteredProducts.value.slice(start, start + pageSize)
})
const pageRange = computed(() => {
  const total = totalPages.value
  const cur = currentPage.value
  if (total <= 7) return Array.from({ length: total }, (_, i) => i + 1)
  if (cur <= 4) return [1, 2, 3, 4, 5, '…', total]
  if (cur >= total - 3) return [1, '…', total - 4, total - 3, total - 2, total - 1, total]
  return [1, '…', cur - 1, cur, cur + 1, '…', total]
})

/* ── Wishlist ── */
const isWishlisted = (id) => wishlist.value.includes(id)
const toggleWishlist = (id) => {
  const idx = wishlist.value.indexOf(id)
  if (idx > -1) {
    wishlist.value.splice(idx, 1)
    showToastMsg('Removed from wishlist')
  } else {
    wishlist.value.push(id)
    showToastMsg('Added to wishlist')
  }
}

/* ── Modal ── */
const openDetail = (product) => { selectedProduct.value = product }

/* ── Filters ── */
const clearFilters = () => {
  activeBrand.value = 'All'
  activeCategory.value = 'All'
  searchQuery.value = ''
  currentPage.value = 1
}

/* ── Toast ── */
let toastTimer = null
const showToastMsg = (msg) => {
  toastMsg.value = msg
  showToast.value = true
  clearTimeout(toastTimer)
  toastTimer = setTimeout(() => { showToast.value = false }, 2500)
}
</script>

<style scoped>
/* ── CSS variables ── */
.product-page {
  --green-dark: #072b4f;
  --green-mid: #0f5b66;
  --green-accent: #10b981;
  --green-light: #d1fae5;
  --text-primary: #111827;
  --text-muted: #6b7280;
  --text-faint: #9ca3af;
  --border: #e5e7eb;
  --surface: #f9fafb;
  --white: #ffffff;
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --radius-xl: 24px;
  --transition: 0.2s ease;

  min-height: 100vh;
  background: var(--surface);
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  color: var(--text-primary);
}

/* ── Container ── */
.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}

/* ═══════════════════════════ HERO ═══════════════════════════ */
.hero {
  position: relative;
  background: linear-gradient(135deg, #072b4f 0%, #0b3d63 35%, #0f5b66 70%, #14706f 100%);
  padding: 100px 0 140px;
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
  height: 160px;
}

.wave {
  fill: rgba(0, 200, 180, 0.10);
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
    transform: translateX(0)
  }

  50% {
    transform: translateX(-24px)
  }
}

.hero-glow {
  position: absolute;
  top: 10%;
  right: 5%;
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, rgba(0, 200, 180, 0.18) 0%, transparent 70%);
  border-radius: 50%;
}

.hero-glow-2 {
  top: 60%;
  right: 60%;
  width: 300px;
  height: 300px;
}

.hero-content {
  position: relative;
  z-index: 10;
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
  text-align: center;
}

.hero-label {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: #4ade80;
  margin-bottom: 24px;
  padding: 10px 22px;
  background: rgba(13, 180, 150, 0.18);
  border: 1px solid rgba(13, 180, 150, 0.4);
  border-radius: 50px;
}

.badge-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #4ade80;
  box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.25);
  animation: pulse 2s infinite;
  flex-shrink: 0;
}

@keyframes pulse {

  0%,
  100% {
    box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.25)
  }

  50% {
    box-shadow: 0 0 0 6px rgba(74, 222, 128, 0.1)
  }
}

.hero h1 {
  font-size: 60px;
  font-weight: 800;
  color: #fff;
  margin: 0 0 20px;
  letter-spacing: -1px;
}

.hero p {
  font-size: 20px;
  color: rgba(255, 255, 255, 0.78);
  max-width: 560px;
  margin: 0 auto 40px;
  line-height: 1.6;
}

.hero-stats {
  display: inline-flex;
  align-items: center;
  gap: 0;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: var(--radius-xl);
  padding: 4px;
}

.hero-stat {
  padding: 12px 28px;
  text-align: center;
}

.hero-stat-num {
  display: block;
  font-size: 26px;
  font-weight: 700;
  color: #fff;
}

.hero-stat-lbl {
  display: block;
  font-size: 12px;
  color: rgba(255, 255, 255, 0.6);
  margin-top: 2px;
}

.hero-stat-divider {
  width: 1px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
}

/* ═══════════════════════════ BRANDS STRIP ═══════════════════════════ */
.brands-strip {
  background: var(--white);
  border-bottom: 1px solid var(--border);
  padding: 18px 0;
}

.brands-label {
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: var(--text-faint);
  margin-bottom: 12px;
}

.brands-row {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.brand-pill {
  padding: 6px 16px;
  border-radius: 50px;
  border: 1.5px solid var(--border);
  background: var(--white);
  color: var(--text-muted);
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  transition: all var(--transition);
}

.brand-pill:hover {
  border-color: var(--green-accent);
  color: var(--green-accent);
}

.brand-pill.active {
  font-weight: 600;
}

/* ═══════════════════════════ TOOLBAR ═══════════════════════════ */
.toolbar-section {
  position: sticky;
  top: 0;
  z-index: 90;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(8px);
  border-bottom: 1px solid var(--border);
  padding: 14px 0;
}

.toolbar {
  display: flex;
  gap: 12px;
  align-items: center;
  flex-wrap: wrap;
}

.search-wrap {
  position: relative;
  flex: 1;
  min-width: 220px;
}

.search-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  width: 16px;
  height: 16px;
  color: var(--text-faint);
  pointer-events: none;
}

.search-input {
  width: 100%;
  padding: 10px 36px 10px 38px;
  border: 1.5px solid var(--border);
  border-radius: 50px;
  font-size: 14px;
  color: var(--text-primary);
  background: var(--surface);
  outline: none;
  transition: border-color var(--transition);
}

.search-input:focus {
  border-color: var(--green-accent);
  background: var(--white);
}

.search-clear {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  color: var(--text-faint);
  display: flex;
  align-items: center;
}

.cat-tabs {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
}

.cat-tab {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  border-radius: 50px;
  border: 1.5px solid var(--border);
  background: var(--white);
  color: var(--text-muted);
  font-size: 13px;
  cursor: pointer;
  transition: all var(--transition);
  white-space: nowrap;
}

.cat-tab:hover {
  border-color: var(--green-accent);
  color: var(--green-accent);
}

.cat-tab.active {
  background: var(--green-accent);
  color: #fff;
  border-color: var(--green-accent);
}

.cat-count {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 20px;
  height: 20px;
  padding: 0 6px;
  background: rgba(0, 0, 0, 0.10);
  border-radius: 10px;
  font-size: 11px;
  font-weight: 600;
}

.cat-tab.active .cat-count {
  background: rgba(255, 255, 255, 0.25);
}

.sort-wrap {
  display: flex;
  align-items: center;
  gap: 8px;
}

.sort-select {
  padding: 9px 14px;
  border: 1.5px solid var(--border);
  border-radius: 50px;
  font-size: 13px;
  color: var(--text-primary);
  background: var(--white);
  cursor: pointer;
  outline: none;
}

.active-filters {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 10px;
  flex-wrap: wrap;
}

.filter-summary-label {
  font-size: 12px;
  color: var(--text-muted);
}

.filter-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 12px;
  background: #dbeafe;
  color: #1e40af;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 500;
  cursor: pointer;
}

.filter-chip:hover {
  background: #bfdbfe;
}

.chip-x {
  font-weight: 700;
}

.clear-all-btn {
  background: none;
  border: none;
  font-size: 12px;
  color: var(--text-muted);
  cursor: pointer;
  text-decoration: underline;
  padding: 0;
}

/* ═══════════════════════════ RESULTS BAR ═══════════════════════════ */
.results-bar-section {
  padding: 14px 0;
}

.results-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.results-count {
  font-size: 14px;
  color: var(--text-muted);
}

.results-count strong {
  color: var(--text-primary);
}

.view-toggle {
  display: flex;
  gap: 4px;
}

.view-btn {
  width: 34px;
  height: 34px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1.5px solid var(--border);
  border-radius: var(--radius-sm);
  background: var(--white);
  color: var(--text-muted);
  cursor: pointer;
  transition: all var(--transition);
}

.view-btn:hover {
  border-color: var(--green-accent);
  color: var(--green-accent);
}

.view-btn.active {
  background: var(--green-accent);
  color: #fff;
  border-color: var(--green-accent);
}

/* ═══════════════════════════ PRODUCTS ═══════════════════════════ */
.products-section {
  padding: 0 0 80px;
}

/* ── Empty State ── */
.empty-state {
  text-align: center;
  padding: 80px 24px;
  border: 2px dashed var(--border);
  border-radius: var(--radius-lg);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
}

.empty-title {
  font-size: 18px;
  font-weight: 600;
  color: var(--text-primary);
}

.empty-sub {
  font-size: 14px;
  color: var(--text-muted);
}

/* ── Grid ── */
.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
}

/* ── Card ── */
.product-card {
  background: var(--white);
  border: 1.5px solid var(--border);
  border-radius: var(--radius-lg);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform var(--transition), border-color var(--transition), box-shadow var(--transition);
  cursor: pointer;
}

.product-card:hover {
  transform: translateY(-6px);
  border-color: #a7f3d0;
  box-shadow: 0 12px 32px rgba(16, 185, 129, 0.12);
}

.card-image-wrap {
  position: relative;
  height: 180px;
  background: var(--surface);
  border-bottom: 1.5px solid var(--border);
  overflow: hidden;
}

.card-image-inner {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.product-img {
  max-width: 85%;
  max-height: 140px;
  object-fit: contain;
  transition: transform 0.4s ease;
}

.product-card:hover .product-img {
  transform: scale(1.06);
}

.img-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
}

.placeholder-part {
  font-size: 11px;
  font-family: monospace;
  color: var(--text-faint);
}

.brand-badge {
  position: absolute;
  top: 12px;
  left: 12px;
  font-size: 11px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 6px;
  letter-spacing: 0.03em;
}

.dsrp-badge {
  position: absolute;
  top: 12px;
  right: 52px;
  font-size: 10px;
  font-weight: 600;
  padding: 4px 8px;
  border-radius: 6px;
  background: #EAF3DE;
  color: #27500A;
}

.wishlist-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  width: 34px;
  height: 34px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--white);
  border: 1.5px solid var(--border);
  border-radius: 50%;
  cursor: pointer;
  color: var(--text-faint);
  transition: all var(--transition);
}

.wishlist-btn:hover {
  border-color: #fca5a5;
  color: #ef4444;
}

.wishlist-btn.active {
  color: #ef4444;
  border-color: #fca5a5;
  background: #fef2f2;
}

.card-body {
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 12px;
  flex: 1;
}

.card-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}

.part-no {
  font-size: 11px;
  font-family: monospace;
  background: var(--surface);
  color: #0C447C;
  padding: 3px 8px;
  border-radius: 6px;
  border: 1px solid #B5D4F4;
}

.cat-tag {
  font-size: 11px;
  color: var(--text-muted);
  padding: 3px 10px;
  border-radius: 20px;
  background: var(--surface);
  border: 1px solid var(--border);
}

.card-title {
  font-size: 14px;
  font-weight: 600;
  color: var(--text-primary);
  line-height: 1.45;
  flex: 1;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.card-desc {
  font-size: 12px;
  color: var(--text-muted);
  line-height: 1.5;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.card-specs {
  background: var(--surface);
  border-radius: var(--radius-sm);
  padding: 12px 14px;
}

.spec-row {
  display: flex;
  gap: 16px;
}

.spec-label {
  display: block;
  font-size: 10px;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-faint);
  margin-bottom: 3px;
}

.spec-value {
  display: block;
  font-size: 13px;
  font-weight: 600;
  color: var(--text-primary);
}

.spec-value.discount {
  color: #d97706;
}

.card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 12px;
  border-top: 1.5px solid var(--border);
  margin-top: auto;
}

.price-block {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.list-price {
  font-size: 11px;
  color: var(--text-faint);
}

.list-price s {
  text-decoration: line-through;
}

.sell-price {
  font-size: 20px;
  font-weight: 700;
  color: #059669;
}

.btn-detail {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 10px 18px;
  background: var(--green-accent);
  color: #fff;
  font-size: 13px;
  font-weight: 600;
  border: none;
  border-radius: 50px;
  cursor: pointer;
  transition: all var(--transition);
}

.btn-detail:hover {
  background: #059669;
  transform: translateX(3px);
}

/* ── List view ── */
.products-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.list-row {
  background: var(--white);
  border: 1.5px solid var(--border);
  border-radius: var(--radius-md);
  display: grid;
  grid-template-columns: 64px 1fr 80px 60px 100px 80px 100px auto;
  align-items: center;
  gap: 16px;
  padding: 14px 20px;
  cursor: pointer;
  transition: all var(--transition);
}

.list-row:hover {
  border-color: #a7f3d0;
  box-shadow: 0 2px 12px rgba(16, 185, 129, 0.08);
}

.list-img {
  width: 64px;
  height: 48px;
  border-radius: 8px;
  background: var(--surface);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  flex-shrink: 0;
}

.list-img img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.list-info {
  min-width: 0;
}

.list-top {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 4px;
  flex-wrap: wrap;
}

.brand-badge-sm {
  font-size: 10px;
  font-weight: 600;
  padding: 2px 8px;
  border-radius: 4px;
}

.list-name {
  font-size: 13px;
  font-weight: 500;
  color: var(--text-primary);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.list-meta {
  text-align: center;
}

.sell-price-sm {
  font-size: 14px;
  font-weight: 700;
  color: #059669;
}

.btn-detail-sm {
  padding: 7px 14px;
  border: 1.5px solid var(--green-accent);
  background: transparent;
  color: var(--green-accent);
  font-size: 12px;
  font-weight: 600;
  border-radius: 50px;
  cursor: pointer;
  transition: all var(--transition);
  white-space: nowrap;
}

.btn-detail-sm:hover {
  background: var(--green-accent);
  color: #fff;
}

/* ── Pagination ── */
.pagination {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  margin-top: 48px;
}

.page-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 9px 18px;
  border: 1.5px solid var(--border);
  background: var(--white);
  border-radius: 50px;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  color: var(--text-primary);
  transition: all var(--transition);
}

.page-btn:hover:not(:disabled) {
  border-color: var(--green-accent);
  color: var(--green-accent);
}

.page-btn:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.page-numbers {
  display: flex;
  gap: 4px;
}

.page-num {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1.5px solid var(--border);
  border-radius: 50%;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  background: var(--white);
  color: var(--text-primary);
  transition: all var(--transition);
}

.page-num:hover:not(.ellipsis) {
  border-color: var(--green-accent);
  color: var(--green-accent);
}

.page-num.active {
  background: var(--green-accent);
  color: #fff;
  border-color: var(--green-accent);
}

.page-num.ellipsis {
  border: none;
  cursor: default;
}

/* ═══════════════════════════ MODAL ═══════════════════════════ */
.modal-backdrop {
  position: fixed;
  inset: 0;
  z-index: 1000;
  background: rgba(0, 0, 0, 0.55);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 24px;
}

.modal {
  background: var(--white);
  border-radius: var(--radius-xl);
  max-width: 820px;
  width: 100%;
  display: grid;
  grid-template-columns: 340px 1fr;
  overflow: hidden;
  position: relative;
  max-height: 90vh;
  overflow-y: auto;
}

.modal-close {
  position: absolute;
  top: 16px;
  right: 16px;
  z-index: 10;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: var(--surface);
  border: 1.5px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: var(--text-muted);
  transition: all var(--transition);
}

.modal-close:hover {
  background: #fee2e2;
  border-color: #fca5a5;
  color: #ef4444;
}

.modal-image {
  background: var(--surface);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px;
  position: relative;
  border-right: 1.5px solid var(--border);
  min-height: 300px;
}

.modal-image img {
  max-width: 100%;
  max-height: 280px;
  object-fit: contain;
}

.modal-img-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
}

.modal-brand-badge {
  position: absolute;
  top: 16px;
  left: 16px;
  font-size: 12px;
  font-weight: 600;
  padding: 5px 12px;
  border-radius: 8px;
}

.modal-body {
  padding: 36px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.modal-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}

.part-no-lg {
  font-size: 12px;
  font-family: monospace;
  background: #E6F1FB;
  color: #0C447C;
  padding: 4px 10px;
  border-radius: 6px;
}

.dsrp-tag-sm {
  font-size: 11px;
  background: #EAF3DE;
  color: #27500A;
  padding: 4px 10px;
  border-radius: 6px;
}

.modal-title {
  font-size: 20px;
  font-weight: 700;
  color: var(--text-primary);
  line-height: 1.4;
}

.modal-desc {
  font-size: 14px;
  color: var(--text-muted);
  line-height: 1.6;
}

.modal-specs-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  background: var(--surface);
  border-radius: var(--radius-md);
  padding: 16px;
}

.modal-spec {
  display: flex;
  flex-direction: column;
  gap: 3px;
}

.modal-price-box {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #f0fdf4;
  border: 2px solid #bbf7d0;
  border-radius: var(--radius-md);
  padding: 16px 20px;
}

.modal-list-price {
  font-size: 12px;
  color: var(--text-muted);
}

.modal-list-price s {
  text-decoration: line-through;
}

.modal-you-save {
  font-size: 12px;
  color: #059669;
  margin-top: 3px;
}

.modal-sell-price {
  font-size: 32px;
  font-weight: 800;
  color: #059669;
}

.modal-actions {
  display: flex;
  gap: 12px;
}

/* ── Buttons ── */
.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  background: var(--green-accent);
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  border: none;
  border-radius: 50px;
  cursor: pointer;
  transition: all var(--transition);
}

.btn-primary:hover {
  background: #059669;
}

.btn-secondary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 24px;
  border: 1.5px solid var(--border);
  background: var(--white);
  color: var(--text-primary);
  font-size: 14px;
  font-weight: 600;
  border-radius: 50px;
  cursor: pointer;
  transition: all var(--transition);
}

.btn-secondary:hover {
  border-color: var(--green-accent);
  color: var(--green-accent);
}

/* ── Toast ── */
.toast {
  position: fixed;
  bottom: 28px;
  left: 50%;
  transform: translateX(-50%);
  background: #111827;
  color: #fff;
  padding: 12px 22px;
  border-radius: 50px;
  font-size: 14px;
  font-weight: 500;
  z-index: 2000;
  display: flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

/* ── Transitions ── */
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.25s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-active .modal,
.modal-leave-active .modal {
  transition: transform 0.25s ease;
}

.modal-enter-from .modal,
.modal-leave-to .modal {
  transform: scale(0.95) translateY(16px);
}

.toast-enter-active,
.toast-leave-active {
  transition: all 0.3s ease;
}

.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translateX(-50%) translateY(12px);
}

/* ── Responsive ── */
@media (max-width: 1024px) {
  .hero h1 {
    font-size: 44px;
  }

  .products-grid {
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  }

  .modal {
    grid-template-columns: 1fr;
  }

  .modal-image {
    min-height: 200px;
    border-right: none;
    border-bottom: 1.5px solid var(--border);
  }

  .list-row {
    grid-template-columns: 48px 1fr auto;
  }

  .list-meta,
  .btn-detail-sm {
    display: none;
  }
}

@media (max-width: 640px) {
  .hero {
    padding: 70px 0 110px;
  }

  .hero h1 {
    font-size: 32px;
  }

  .hero p {
    font-size: 16px;
  }

  .hero-stats {
    flex-direction: column;
    gap: 0;
  }

  .hero-stat-divider {
    width: 40px;
    height: 1px;
  }

  .products-grid {
    grid-template-columns: 1fr;
  }

  .toolbar {
    flex-direction: column;
    align-items: stretch;
  }

  .modal {
    max-width: 100%;
  }

  .modal-body {
    padding: 20px;
  }

  .modal-actions {
    flex-direction: column;
  }
}
</style>