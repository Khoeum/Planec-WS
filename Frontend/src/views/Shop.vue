<template>
  <div class="shop-page">

    <!-- ── Hero Banner ── -->
    <div class="shop-hero">
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
          Official Store
        </span>
        <h1>Shop <em>Products</em></h1>
        <div class="hero-stats">
          <div class="stat"><strong>{{ products.length }}</strong><span>Products</span></div>
          <div class="stat-divider" />
          <div class="stat"><strong>{{ inStockCount }}</strong><span>In Stock</span></div>
          <div class="stat-divider" />
          <div class="stat"><strong>{{ popularCount }}</strong><span>Popular</span></div>
        </div>
      </div>
    </div>

    <!-- ── Filter Bar ── -->
    <div class="filter-bar">
      <div class="filter-inner">
        <div class="filter-tabs">
          <button v-for="tab in tabs" :key="tab.key" class="filter-tab" :class="{ active: activeTab === tab.key }"
            @click="activeTab = tab.key">
            <span class="tab-icon">{{ tab.icon }}</span>
            {{ tab.label }}
            <span class="tab-count">{{ tab.count }}</span>
          </button>
        </div>
        <div class="filter-right">
          <div class="filter-search">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.35-4.35" />
            </svg>
            <input v-model="searchTerm" type="text" placeholder="Search products…" />
          </div>
          <!-- Cart Button -->
          <button class="cart-btn" @click="openCart" :class="{ 'has-items': cartCount > 0 }">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="9" cy="21" r="1" />
              <circle cx="20" cy="21" r="1" />
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
            </svg>
            Cart
            <span v-if="cartCount > 0" class="cart-badge">{{ cartCount }}</span>
          </button>
        </div>
      </div>
    </div>

    <!-- ── Product Grid ── -->
    <section class="product-section">
      <div class="product-grid">
        <div v-for="product in filteredProducts" :key="product.id" class="product-card"
          :class="{ 'out-of-stock': !product.inStock }">
          <!-- Badges -->
          <div class="card-badges">
            <span v-if="product.popular" class="badge badge-popular">🔥 Popular</span>
            <span v-if="!product.inStock" class="badge badge-oos">Out of Stock</span>
            <span v-else class="badge badge-stock">In Stock</span>
            <span v-if="product.discount" class="badge badge-discount">-{{ product.discount }}%</span>
          </div>

          <!-- Product Image -->
          <div class="card-img-wrap">
            <img :src="product.image" :alt="product.name" class="card-img" loading="lazy"
              @error="handleImgError($event, product)" />
            <div v-if="!product.inStock" class="oos-overlay"><span>Unavailable</span></div>
            <!-- Add to cart overlay -->
            <div v-if="product.inStock" class="card-hover-overlay">
              <button class="quick-add-btn" @click.stop="addToCart(product)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <line x1="12" y1="5" x2="12" y2="19" />
                  <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add to Cart
              </button>
            </div>
          </div>

          <!-- Card Body -->
          <div class="card-body">
            <span class="card-category-tag">{{ product.category }}</span>
            <h3 class="card-title">{{ product.name }}</h3>
            <p class="card-desc">{{ product.description }}</p>
            <div class="card-specs">
              <span v-for="spec in product.specs" :key="spec" class="spec-tag">{{ spec }}</span>
            </div>
            <div class="card-footer">
              <div class="price-block">
                <span class="price-label">Price</span>
                <div class="price-row">
                  <span v-if="product.discount" class="price-old">${{ product.price }}</span>
                  <span class="price-current">${{ discountedPrice(product) }}</span>
                </div>
              </div>
              <button class="order-btn" :class="{ disabled: !product.inStock }" :disabled="!product.inStock"
                @click="addToCart(product)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                  <circle cx="9" cy="21" r="1" />
                  <circle cx="20" cy="21" r="1" />
                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                </svg>
                {{ product.inStock ? 'Add to Cart' : 'Notify Me' }}
              </button>
            </div>
          </div>

          <!-- In-cart indicator -->
          <div v-if="cartItems.find(c => c.id === product.id)" class="in-cart-badge">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
              <polyline points="20 6 9 17 4 12" />
            </svg>
            In Cart
          </div>
        </div>
      </div>
      <div v-if="filteredProducts.length === 0" class="empty-state">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="rgba(34,197,94,0.3)" stroke-width="1.2">
          <circle cx="11" cy="11" r="8" />
          <path d="m21 21-4.35-4.35" />
        </svg>
        <p>No products found</p>
      </div>
    </section>

    <!-- ══════════════════════════════════
         CART SIDEBAR / MODAL
    ══════════════════════════════════ -->
    <transition name="modal-fade">
      <div v-if="showCart" class="modal-backdrop" @click.self="closeCart">
        <div class="cart-panel">
          <div class="cart-header">
            <div class="cart-header-left">
              <div class="modal-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2">
                  <circle cx="9" cy="21" r="1" />
                  <circle cx="20" cy="21" r="1" />
                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                </svg>
              </div>
              <div>
                <h2>Your Cart</h2>
                <p>{{ cartCount }} item(s) selected</p>
              </div>
            </div>
            <button class="modal-close" @click="closeCart">✕</button>
          </div>

          <!-- Cart Items -->
          <div class="cart-items-wrap">
            <div v-if="cartItems.length === 0" class="cart-empty">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(34,197,94,0.3)"
                stroke-width="1.2">
                <circle cx="9" cy="21" r="1" />
                <circle cx="20" cy="21" r="1" />
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
              </svg>
              <p>Your cart is empty</p>
              <button class="btn-browse" @click="closeCart">Browse Products</button>
            </div>

            <div v-for="item in cartItems" :key="item.id" class="cart-item">
              <img :src="item.image" :alt="item.name" class="cart-item-img" @error="handleImgError($event, item)" />
              <div class="cart-item-info">
                <span class="cart-item-cat">{{ item.category }}</span>
                <strong class="cart-item-name">{{ item.name }}</strong>
                <span class="cart-item-price">${{ discountedPrice(item) }} / unit</span>
              </div>
              <div class="cart-item-qty">
                <button class="qty-btn" @click="updateQty(item, -1)">−</button>
                <span>{{ item.qty }}</span>
                <button class="qty-btn" @click="updateQty(item, 1)">+</button>
              </div>
              <div class="cart-item-subtotal">${{ (discountedPrice(item) * item.qty).toFixed(2) }}</div>
              <button class="cart-item-remove" @click="removeFromCart(item.id)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="3 6 5 6 21 6" />
                  <path d="M19 6l-1 14H6L5 6" />
                  <path d="M10 11v6M14 11v6" />
                  <path d="M9 6V4h6v2" />
                </svg>
              </button>
            </div>
          </div>

          <!-- Cart Total -->
          <div v-if="cartItems.length > 0" class="cart-total-bar">
            <div class="cart-total-row">
              <span>{{ cartCount }} item(s)</span>
              <span class="cart-grand-total">${{ cartTotal }}</span>
            </div>
            <button class="btn-checkout" @click="proceedToCheckout">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path d="m22 2-7 20-4-9-9-4 20-7z" />
              </svg>
              Proceed to Checkout
            </button>
          </div>
        </div>
      </div>
    </transition>

    <!-- ════════════════════════════════
         ORDER MODAL (multi-product)
    ════════════════════════════════ -->
    <transition name="modal-fade">
      <div v-if="showOrderModal" class="modal-backdrop" @click.self="closeOrder">
        <div class="modal-box">

          <!-- Modal Header -->
          <div class="modal-header">
            <div class="modal-header-left">
              <div class="modal-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2">
                  <path d="m22 2-7 20-4-9-9-4 20-7z" />
                </svg>
              </div>
              <div>
                <h2>Place Order</h2>
                <p>{{ cartCount }} product(s) · ${{ cartTotal }} total</p>
              </div>
            </div>
            <button class="modal-close" @click="closeOrder">✕</button>
          </div>

          <!-- Progress Steps -->
          <div class="progress-steps">
            <div v-for="(step, i) in steps" :key="i" class="step"
              :class="{ active: orderStep >= i, done: orderStep > i }">
              <div class="step-circle">
                <svg v-if="orderStep > i" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="3">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                <span v-else>{{ i + 1 }}</span>
              </div>
              <span class="step-label">{{ step }}</span>
            </div>
            <div class="step-line" :style="{ width: stepLineWidth }" />
          </div>

          <!-- ── STEP 1: Customer Info ── -->
          <div v-if="orderStep === 0" class="step-content">
            <h3 class="step-title">Customer Information</h3>
            <div class="form-grid">
              <div class="form-group">
                <label>First Name <span class="req">*</span></label>
                <input v-model="form.firstName" type="text" placeholder="John" :class="{ error: errors.firstName }" />
                <span v-if="errors.firstName" class="err-msg">{{ errors.firstName }}</span>
              </div>
              <div class="form-group">
                <label>Last Name <span class="req">*</span></label>
                <input v-model="form.lastName" type="text" placeholder="Doe" :class="{ error: errors.lastName }" />
                <span v-if="errors.lastName" class="err-msg">{{ errors.lastName }}</span>
              </div>
              <div class="form-group">
                <label>Phone Number <span class="req">*</span></label>
                <div class="input-icon-wrap">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path
                      d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.85a16 16 0 0 0 6 6l.95-.95a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 16z" />
                  </svg>
                  <input v-model="form.phone" type="tel" placeholder="+855 12 345 678"
                    :class="{ error: errors.phone }" />
                </div>
                <span v-if="errors.phone" class="err-msg">{{ errors.phone }}</span>
              </div>
              <div class="form-group">
                <label>Telegram <span class="req">*</span></label>
                <div class="input-icon-wrap">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m22 2-7 20-4-9-9-4 20-7z" />
                  </svg>
                  <input v-model="form.telegram" type="text" placeholder="@username"
                    :class="{ error: errors.telegram }" />
                </div>
                <span v-if="errors.telegram" class="err-msg">{{ errors.telegram }}</span>
              </div>
              <div class="form-group full">
                <label>Email Address</label>
                <div class="input-icon-wrap">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                    <polyline points="22,6 12,13 2,6" />
                  </svg>
                  <input v-model="form.email" type="email" placeholder="john@example.com" />
                </div>
              </div>
              <div class="form-group full">
                <label>Delivery Location <span class="req">*</span></label>
                <div class="input-icon-wrap">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                    <circle cx="12" cy="10" r="3" />
                  </svg>
                  <input v-model="form.location" type="text" placeholder="Street, City, Province"
                    :class="{ error: errors.location }" />
                </div>
                <span v-if="errors.location" class="err-msg">{{ errors.location }}</span>
              </div>
            </div>
          </div>

          <!-- ── STEP 2: Order Details (multi-product) ── -->
          <div v-if="orderStep === 1" class="step-content">
            <h3 class="step-title">Order Details</h3>

            <!-- Products in cart -->
            <div class="order-products-list">
              <div v-for="item in cartItems" :key="item.id" class="order-product-row">
                <img :src="item.image" :alt="item.name" class="op-img" @error="handleImgError($event, item)" />
                <div class="op-info">
                  <span class="op-cat">{{ item.category }} · {{ item.type || 'Standard' }}</span>
                  <strong>{{ item.name }}</strong>
                </div>
                <div class="op-qty-ctrl">
                  <button class="qty-btn" @click="updateQty(item, -1)">−</button>
                  <input v-model.number="item.qty" type="number" min="1" max="999" class="op-qty-input" />
                  <button class="qty-btn" @click="updateQty(item, 1)">+</button>
                </div>
                <div class="op-price">${{ (discountedPrice(item) * item.qty).toFixed(2) }}</div>
                <button class="op-remove" @click="removeFromCart(item.id)">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                  </svg>
                </button>
              </div>
            </div>

            <div class="form-group full" style="margin-top:16px">
              <label>Additional Notes</label>
              <textarea v-model="form.notes" rows="3"
                placeholder="Special requirements, installation details, delivery instructions…" />
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
              <div class="summary-row" v-for="item in cartItems" :key="item.id">
                <span>{{ item.name }} × {{ item.qty }}</span>
                <span>${{ (discountedPrice(item) * item.qty).toFixed(2) }}</span>
              </div>
              <div class="summary-row total">
                <span>Grand Total</span>
                <span>${{ cartTotal }}</span>
              </div>
            </div>
          </div>

          <!-- ── STEP 3: Review ── -->
          <div v-if="orderStep === 2" class="step-content">
            <h3 class="step-title">Review Your Order</h3>
            <div class="review-grid">
              <div class="review-section">
                <h4>Customer Info</h4>
                <div class="review-item"><span>Name</span><strong>{{ form.firstName }} {{ form.lastName }}</strong>
                </div>
                <div class="review-item"><span>Phone</span><strong>{{ form.phone }}</strong></div>
                <div class="review-item"><span>Telegram</span><strong>{{ form.telegram }}</strong></div>
                <div class="review-item" v-if="form.email"><span>Email</span><strong>{{ form.email }}</strong></div>
                <div class="review-item"><span>Location</span><strong>{{ form.location }}</strong></div>
              </div>
              <div class="review-section">
                <h4>Products ({{ cartCount }} items)</h4>
                <div class="review-item" v-for="item in cartItems" :key="item.id">
                  <span>{{ item.name }}</span>
                  <strong>× {{ item.qty }} · ${{ (discountedPrice(item) * item.qty).toFixed(2) }}</strong>
                </div>
                <div class="review-item highlight">
                  <span>Grand Total</span>
                  <strong>${{ cartTotal }}</strong>
                </div>
              </div>
            </div>
            <div v-if="form.notes" class="review-notes">
              <h4>Notes</h4>
              <p>{{ form.notes }}</p>
            </div>
          </div>

          <!-- ── STEP 4: Loading ── -->
          <div v-if="orderStep === 3" class="step-content loading-step">
            <div class="loading-animation">
              <div class="loading-ring" />
              <div class="loading-ring ring2" />
              <div class="loading-ring ring3" />
              <div class="loading-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2">
                  <path d="m22 2-7 20-4-9-9-4 20-7z" />
                </svg>
              </div>
            </div>
            <h3>Processing Your Order</h3>
            <p class="loading-msg">{{ loadingMessages[loadingMsgIndex] }}</p>
            <div class="loading-dots"><span /><span /><span /></div>
          </div>

          <!-- Modal Footer -->
          <div v-if="orderStep < 3" class="modal-footer">
            <button v-if="orderStep > 0" class="btn-back" @click="orderStep--">← Back</button>
            <div class="footer-right">
              <button class="btn-cancel" @click="closeOrder">Cancel</button>
              <button v-if="orderStep < 2" class="btn-next" @click="nextStep">Continue →</button>
              <button v-if="orderStep === 2" class="btn-submit" @click="submitOrder">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
                Confirm Order
              </button>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <!-- ════════════════════════════════
         THANK YOU PAGE (OVERLAY)
    ════════════════════════════════ -->
    <transition name="modal-fade">
      <div v-if="showThankYou" class="modal-backdrop">
        <div class="thankyou-box" id="receipt-area">
          <div class="confetti-wrap">
            <span v-for="n in 20" :key="n" class="confetti-dot" :style="confettiStyle(n)" />
          </div>

          <div class="ty-icon">
            <div class="ty-ring" />
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5">
              <polyline points="20 6 9 17 4 12" />
            </svg>
          </div>

          <h2 class="ty-title">Thank You, {{ form.firstName }}!</h2>
          <p class="ty-subtitle">Your order has been received. Our team will contact you via Telegram or phone shortly.
          </p>

          <div class="order-id-badge">Order ID: <strong>#{{ orderId }}</strong></div>

          <!-- Receipt Card -->
          <div class="receipt-card">
            <div class="receipt-header">
              <div class="receipt-logo">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2">
                  <circle cx="12" cy="12" r="10" />
                  <path
                    d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                </svg>
                <span>PLAN<em>EC</em></span>
              </div>
              <div class="receipt-meta"><span>{{ orderDate }}</span></div>
            </div>

            <div class="receipt-divider"><span>ORDER RECEIPT</span></div>

            <div class="receipt-body">
              <div class="receipt-row"><span>Order ID</span><strong>#{{ orderId }}</strong></div>
              <div class="receipt-row"><span>Customer</span><strong>{{ form.firstName }} {{ form.lastName }}</strong>
              </div>
              <div class="receipt-row"><span>Phone</span><strong>{{ form.phone }}</strong></div>
              <div class="receipt-row"><span>Telegram</span><strong>{{ form.telegram }}</strong></div>
              <div class="receipt-row" v-if="form.email"><span>Email</span><strong>{{ form.email }}</strong></div>
              <div class="receipt-row"><span>Location</span><strong>{{ form.location }}</strong></div>
              <div class="receipt-spacer" />
              <!-- Multi product rows -->
              <div class="receipt-row" v-for="item in cartItems" :key="item.id">
                <span>{{ item.name }} × {{ item.qty }}</span>
                <strong>${{ (discountedPrice(item) * item.qty).toFixed(2) }}</strong>
              </div>
              <div class="receipt-total"><span>TOTAL</span><strong>${{ cartTotal }}</strong></div>
            </div>

            <div class="receipt-footer">
              <p>PLANEC — Cambodia's #1 Network Distributor</p>
              <p>+855 23 000 000 · planec.com.kh</p>
            </div>
          </div>

          <div class="ty-actions">
            <button class="ty-btn-print" @click="printReceipt">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 6 2 18 2 18 9" />
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                <rect x="6" y="14" width="12" height="8" />
              </svg>
              Print Receipt
            </button>
            <button class="ty-btn-home" @click="backToShop">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
              </svg>
              Back to Shop
            </button>
          </div>
        </div>
      </div>
    </transition>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

// ══════════════════════════════════════════════════════════════════
//  ⚙️  EMAILJS CONFIGURATION — replace these 3 values
//  1. Sign up free at https://emailjs.com
//  2. Add an Email Service (Gmail / Outlook / etc.) → copy Service ID
//  3. Create an Email Template              → copy Template ID
//     Required template variables (use exactly these names):
//       {{to_email}}  {{order_id}}  {{order_date}}
//       {{customer_name}}  {{phone}}  {{telegram}}
//       {{email}}  {{location}}  {{products_list}}
//       {{grand_total}}  {{notes}}
//  4. Account → API Keys                    → copy Public Key
// ══════════════════════════════════════════════════════════════════
const EMAILJS_SERVICE_ID  = 'YOUR_SERVICE_ID'   // e.g. 'service_abc123'
const EMAILJS_TEMPLATE_ID = 'YOUR_TEMPLATE_ID'  // e.g. 'template_xyz789'
const EMAILJS_PUBLIC_KEY  = 'YOUR_PUBLIC_KEY'   // e.g. 'aBcDeFgHiJkLmNoPq'
const SELLER_EMAIL        = 'cpnkhoeumvd030005@gmail.com'
// ══════════════════════════════════════════════════════════════════

// Load EmailJS SDK dynamically on mount
onMounted(() => {
  if (!document.getElementById('emailjs-sdk')) {
    const script = document.createElement('script')
    script.id  = 'emailjs-sdk'
    script.src = 'https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js'
    script.onload = () => {
      window.emailjs.init({ publicKey: EMAILJS_PUBLIC_KEY })
    }
    document.head.appendChild(script)
  } else if (window.emailjs) {
    window.emailjs.init({ publicKey: EMAILJS_PUBLIC_KEY })
  }
})

const products = ref([
  {
    id: 1,
    name: 'Professional Tools Tester',
    category: 'Planet',
    type: 'Managed Switch',
    description: '24-port gigabit managed PoE switch with 95W PoH support and intelligent power management.',
    price: 2843.75,
    discount: 10,
    inStock: true,
    popular: true,
    specs: ['24-Port', 'PoH 95W', 'Managed', 'Gigabit'],
    image: 'https://planec.com.kh/wp-content/uploads/2021/04/softing-tools-200x200.png',
  },
  {
    id: 2,
    name: 'Network Rack',
    category: 'Finen',
    type: 'L3 Managed',
    description: '48-port 10G uplink managed switch ideal for enterprise backbone networks.',
    price: 967.50,
    discount: null,
    inStock: true,
    popular: true,
    specs: ['48-Port', '10G Uplink', 'L3 Managed', 'SFP+'],
    image: 'https://planec.com.kh/wp-content/uploads/2020/03/network-rack-e1584178170665.jpg',
  },
  {
    id: 3,
    name: 'Wireless LAN',
    category: 'Cabling',
    type: 'Copper Bulk',
    description: 'Premium shielded CAT6A cable rated for 10G transmission up to 100m with EMI protection.',
    price: 152.50,
    discount: 5,
    inStock: true,
    popular: false,
    specs: ['CAT6A', 'Shielded', '10Gbps', '305m Spool'],
    image: 'https://planec.com.kh/wp-content/uploads/2020/03/Wireless-LAN-e1584177128469.jpg',
  },
  {
    id: 4,
    name: 'Media Conversion',
    category: 'Control Panel',
    type: 'PoE Controller',
    description: '7-inch touch LCD panel for intelligent PoE management, real-time power monitoring.',
    price: 749,
    discount: null,
    inStock: false,
    popular: true,
    specs: ['7" Touch LCD', 'PoE Control', 'Real-time Monitor'],
    image: 'https://planec.com.kh/wp-content/uploads/2020/03/Industrail-Media-Conversation-e1584177366363.jpg',
  },
  {
    id: 5,
    name: 'Layer 3 Chassis',
    category: 'Wireless',
    type: 'Access Point',
    description: 'Tri-band Wi-Fi 6 access point with MU-MIMO, ideal for high-density deployments.',
    price: 429,
    discount: 15,
    inStock: true,
    popular: true,
    specs: ['Wi-Fi 6', 'AX3000', 'MU-MIMO', 'PoE Powered'],
    image: 'https://planec.com.kh/wp-content/uploads/2020/02/box_XGS3-42000Rv2-e1581221463218.jpg',
  },
  {
    id: 6,
    name: 'Cassis Managed Gigabit Media',
    category: 'Transceiver',
    type: 'MMF',
    description: '10G SFP+ short-range multimode fiber module, compatible with major switch brands.',
    price: 89,
    discount: null,
    inStock: false,
    popular: false,
    specs: ['10G SFP+', '850nm', 'MMF', '300m Range'],
    image: 'https://planec.com.kh/wp-content/uploads/2020/03/box_GST-80X-e1584180887714.jpg',
  },
  {
    id: 7,
    name: 'Structured Cabling Systems',
    category: 'PoE Switch',
    type: 'Industrial',
    description: '48-port industrial-grade PoE switch built for harsh environments, DIN rail mount.',
    price: 274.88,
    discount: 8,
    inStock: true,
    popular: false,
    specs: ['48-Port', 'Industrial', 'DIN Rail', 'IP40'],
    image: 'https://planec.com.kh/wp-content/uploads/2019/09/cat6.jpg',
  },
  {
    id: 8,
    name: 'Wireless Management Software',
    category: 'Fiber Optic',
    type: 'Single-mode',
    description: 'Single-mode SC/APC to SC/APC duplex fiber patch cord, low insertion loss.',
    price: 153.75,
    discount: null,
    inStock: true,
    popular: false,
    specs: ['SC/APC', 'Duplex', 'SM', '3m'],
    image: 'https://planec.com.kh/wp-content/uploads/2020/03/Smart-AP-Control_Box_L-e1584263819471.jpg',
  },
  {
    id: 9,
    name: 'Lite-8P PoE+ Desktop Switch',
    category: 'PoE Switch',
    type: 'Unmanaged',
    description: 'Compact 8-port PoE+ switch, ideal for small offices & surveillance systems.',
    price: 189,
    discount: null,
    inStock: true,
    popular: true,
    specs: ['8-Port', 'PoE+', 'Fanless', 'Desktop'],
    image: 'https://images.unsplash.com/photo-1597852074816-d933c7d2b988?w=400&h=220&fit=crop&auto=format',
  },
  {
    id: 10,
    name: 'Pro-24P 2.5G Multigig PoE',
    category: 'PoE Switch',
    type: 'Multigig',
    description: '24 x 2.5GbE PoE++ ports, 4 x 10G SFP+, perfect for WiFi 6 deployments.',
    price: 1999,
    discount: 12,
    inStock: true,
    popular: true,
    specs: ['2.5GbE', 'PoE++', 'SFP+', '90W per port'],
    image: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400&h=220&fit=crop&auto=format',
  },
  {
    id: 11,
    name: 'Agg-16X 10G Aggregator',
    category: 'Core Switch',
    type: 'Aggregation',
    description: '16-port 10G SFP+ aggregation switch with low latency & redundant power.',
    price: 1599,
    discount: 5,
    inStock: true,
    popular: false,
    specs: ['16x10G SFP+', 'Low Latency', 'Redundant PSU'],
    image: 'https://images.unsplash.com/photo-1551703599-6b3e8379aa8c?w=400&h=220&fit=crop&auto=format',
  },
  {
    id: 12,
    name: 'CAT7 SSTP Patch Cable 2m',
    category: 'Cabling',
    type: 'Patch Cord',
    description: 'S/FTP CAT7 patch cord, gold-plated, 600MHz, fully shielded.',
    price: 8.5,
    discount: null,
    inStock: true,
    popular: true,
    specs: ['CAT7', 'SSTP', '2m', 'Gold Plated'],
    image: 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=400&h=220&fit=crop&auto=format',
  },
  {
    id: 13,
    name: 'LC-LC OM4 Multimode 5m',
    category: 'Fiber Optic',
    type: 'Multimode',
    description: 'Premium OM4 50/125 fiber, LC to LC, high bandwidth for 40/100G.',
    price: 18.9,
    discount: null,
    inStock: true,
    popular: false,
    specs: ['OM4', 'LC-LC', '5m', '40G/100G'],
    image: 'https://images.unsplash.com/photo-1567789884554-0b844b597180?w=400&h=220&fit=crop&auto=format',
  },
  {
    id: 14,
    name: 'Outdoor AX6000 Wi-Fi 6 AP',
    category: 'Wireless',
    type: 'Outdoor',
    description: 'IP67 rated outdoor Wi-Fi 6 AP, 4x4 MU-MIMO, 5 GbE port, extreme coverage.',
    price: 679,
    discount: null,
    inStock: true,
    popular: true,
    specs: ['Wi-Fi 6', 'AX6000', 'Outdoor', '5GbE'],
    image: 'https://images.unsplash.com/photo-1606904825846-647eb07f5be2?w=400&h=220&fit=crop&auto=format',
  },
  {
    id: 15,
    name: 'Smart Rack PDU Pro',
    category: 'Accessories',
    type: 'Power Distribution',
    description: 'Switched PDU with per-outlet power metering, environmental sensors, remote reboot.',
    price: 529,
    discount: 10,
    inStock: true,
    popular: false,
    specs: ['8 Outlets', 'Remote Reboot', 'Energy Monitoring'],
    image: 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=400&h=220&fit=crop&auto=format',
  },
  {
    id: 16,
    name: 'SFP-10G-LR Transceiver',
    category: 'Transceiver',
    type: 'SMF',
    description: '10km long reach single-mode SFP+ module, DDM support, industrial temp.',
    price: 119,
    discount: null,
    inStock: true,
    popular: true,
    specs: ['10G SFP+', '1310nm', '10km', 'DDM'],
    image: 'https://images.unsplash.com/photo-1581092335397-9583eb92d232?w=400&h=220&fit=crop&auto=format',
  },
  {
    id: 17,
    name: 'BiDi SFP 1.25G',
    category: 'Transceiver',
    type: 'BiDi',
    description: 'Single-strand fiber BiDi SFP, TX1310/RX1550, 20km reach.',
    price: 42,
    discount: null,
    inStock: true,
    popular: false,
    specs: ['BiDi', '1.25G', '20km', 'Single Strand'],
    image: 'https://images.unsplash.com/photo-1581092335397-9583eb92d232?w=400&h=220&fit=crop&auto=format',
  }
])

// ── State ──
const activeTab = ref('all')
const searchTerm = ref('')
const showOrderModal = ref(false)
const showThankYou = ref(false)
const showCart = ref(false)
const orderStep = ref(0)
const orderId = ref('')
const orderDate = ref('')
const loadingMsgIndex = ref(0)
const cartItems = ref([])

const form = ref({ firstName: '', lastName: '', phone: '', telegram: '', email: '', location: '', notes: '' })
const errors = ref({})
const steps = ['Your Info', 'Order Details', 'Review', 'Processing']

// ── Computed ──
const inStockCount = computed(() => products.value.filter(p => p.inStock).length)
const popularCount = computed(() => products.value.filter(p => p.popular).length)
const cartCount = computed(() => cartItems.value.reduce((s, i) => s + i.qty, 0))
const cartTotal = computed(() => cartItems.value.reduce((s, i) => s + discountedPrice(i) * i.qty, 0).toFixed(2))

const tabs = computed(() => [
  { key: 'all', label: 'All Products', icon: '📦', count: products.value.length },
  { key: 'instock', label: 'In Stock', icon: '✅', count: inStockCount.value },
  { key: 'popular', label: 'Popular', icon: '🔥', count: popularCount.value },
  { key: 'oos', label: 'Out of Stock', icon: '⏳', count: products.value.filter(p => !p.inStock).length },
])

const filteredProducts = computed(() => {
  let list = products.value
  if (activeTab.value === 'instock') list = list.filter(p => p.inStock)
  else if (activeTab.value === 'popular') list = list.filter(p => p.popular)
  else if (activeTab.value === 'oos') list = list.filter(p => !p.inStock)
  if (searchTerm.value) {
    const q = searchTerm.value.toLowerCase()
    list = list.filter(p => p.name.toLowerCase().includes(q) || p.category.toLowerCase().includes(q) || (p.type && p.type.toLowerCase().includes(q)))
  }
  return list
})

const stepLineWidth = computed(() => `${(orderStep.value / (steps.length - 1)) * 100}%`)

// ── Methods ──
function discountedPrice(product) {
  if (!product) return 0
  if (product.discount) return parseFloat((product.price * (1 - product.discount / 100)).toFixed(2))
  return product.price
}

function handleImgError(event, product) {
  event.target.src = `https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400&h=220&fit=crop&auto=format`
}

function addToCart(product) {
  const existing = cartItems.value.find(i => i.id === product.id)
  if (existing) {
    existing.qty++
  } else {
    cartItems.value.push({ ...product, qty: 1 })
  }
}

function removeFromCart(id) {
  cartItems.value = cartItems.value.filter(i => i.id !== id)
}

function updateQty(item, delta) {
  const target = cartItems.value.find(i => i.id === item.id)
  if (target) {
    target.qty = Math.max(1, target.qty + delta)
  }
}

function openCart() { showCart.value = true }
function closeCart() { showCart.value = false }

function proceedToCheckout() {
  showCart.value = false
  orderStep.value = 0
  errors.value = {}
  showOrderModal.value = true
}

function closeOrder() {
  showOrderModal.value = false
  orderStep.value = 0
  errors.value = {}
}

function validateStep0() {
  const e = {}
  if (!form.value.firstName.trim()) e.firstName = 'First name is required'
  if (!form.value.lastName.trim()) e.lastName = 'Last name is required'
  if (!form.value.phone.trim()) e.phone = 'Phone number is required'
  if (!form.value.telegram.trim()) e.telegram = 'Telegram is required'
  if (!form.value.location.trim()) e.location = 'Location is required'
  errors.value = e
  return Object.keys(e).length === 0
}

function nextStep() {
  if (orderStep.value === 0 && !validateStep0()) return
  orderStep.value++
}

const loadingMessages = ['Sending your order to our team…', 'Verifying product availability…', 'Preparing your confirmation…', 'Almost done, hang tight!']

// ══════════════════════════════════════════════════════════════════
//  EMAIL SENDING — uses EmailJS (no backend required)
//  The template on EmailJS should have these variables:
//    {{to_email}} {{order_id}} {{order_date}} {{customer_name}}
//    {{phone}} {{telegram}} {{email}} {{location}}
//    {{products_list}} {{grand_total}} {{notes}}
// ══════════════════════════════════════════════════════════════════
async function sendEmailToSeller(orderData) {
  // Build a readable product list string for the email body
  const productsList = orderData.items
    .map(item => `• ${item.name} × ${item.qty}  →  $${(discountedPrice(item) * item.qty).toFixed(2)}`)
    .join('\n')

  const templateParams = {
    to_email:      SELLER_EMAIL,
    order_id:      orderData.orderId,
    order_date:    orderData.orderDate,
    customer_name: orderData.customerName,
    phone:         orderData.phone,
    telegram:      orderData.telegram,
    email:         orderData.email || '—',
    location:      orderData.location,
    products_list: productsList,
    grand_total:   `$${orderData.total}`,
    notes:         orderData.notes || '—',
  }

  // Wait for the SDK to be available (it's loaded async)
  let attempts = 0
  while (!window.emailjs && attempts < 20) {
    await new Promise(r => setTimeout(r, 200))
    attempts++
  }

  if (!window.emailjs) {
    console.error('EmailJS SDK failed to load.')
    return
  }

  try {
    const response = await window.emailjs.send(
      EMAILJS_SERVICE_ID,
      EMAILJS_TEMPLATE_ID,
      templateParams
    )
    console.log('✅ Order email sent to seller:', response.status, response.text)
  } catch (err) {
    // Order still shows success to customer — log the error silently
    console.error('❌ EmailJS send failed:', err)
  }
}

function submitOrder() {
  orderStep.value = 3
  const interval = setInterval(() => {
    loadingMsgIndex.value = (loadingMsgIndex.value + 1) % loadingMessages.length
  }, 1200)

  setTimeout(async () => {
    clearInterval(interval)
    orderId.value = 'PLC-' + Math.random().toString(36).substring(2, 8).toUpperCase()
    const now = new Date()
    orderDate.value = now.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) + ' ' + now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' })

    await sendEmailToSeller({
      orderId:      orderId.value,
      orderDate:    orderDate.value,
      customerName: `${form.value.firstName} ${form.value.lastName}`,
      phone:        form.value.phone,
      telegram:     form.value.telegram,
      email:        form.value.email,
      location:     form.value.location,
      items:        cartItems.value,
      total:        cartTotal.value,
      notes:        form.value.notes,
    })

    showOrderModal.value = false
    showThankYou.value = true
  }, 3500)
}

function printReceipt() { window.print() }

function backToShop() {
  showThankYou.value = false
  cartItems.value = []
  form.value = { firstName: '', lastName: '', phone: '', telegram: '', email: '', location: '', notes: '' }
  errors.value = {}
  orderStep.value = 0
}

function confettiStyle(n) {
  return {
    left: `${(n * 37) % 100}%`,
    top: `${(n * 53) % 60}%`,
    animationDelay: `${(n * 0.15) % 2}s`,
    background: n % 3 === 0 ? '#22c55e' : n % 3 === 1 ? '#3b82f6' : '#f59e0b',
    width: `${6 + (n % 4) * 3}px`,
    height: `${6 + (n % 4) * 3}px`,
    borderRadius: n % 2 === 0 ? '50%' : '2px',
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@700;800&display=swap');

* {
  box-sizing: border-box;
}

.shop-page {
  font-family: 'Barlow', sans-serif;
  background: #f0f4f8;
  min-height: 100vh;
  color: #1a2540;
}

/* ══════════════════════════════════ HERO */
.shop-hero {
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
  max-width: 800px;
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

.hero-inner h1 {
  font-family: 'Playfair Display', serif;
  font-size: clamp(2.4rem, 5vw, 3.6rem);
  font-weight: 700;
  line-height: 1.1;
  color: #fff;
  margin: 0 0 20px;
}

.hero-inner h1 em {
  color: #4ade80;
  font-style: italic;
}

.hero-inner p {
  font-size: 1.05rem;
  line-height: 1.7;
  color: rgba(255, 255, 255, 0.7);
  margin: 0 auto 36px;
  max-width: 560px;
}

.hero-stats {
  display: inline-flex;
  align-items: center;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 999px;
  overflow: hidden;
}

.hero-stats .stat {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 12px 32px;
}

.hero-stats .stat strong {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: 700;
  color: #4ade80;
}

.hero-stats .stat span {
  font-size: 8px;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.4);
  margin-top: 1px;
}

.hero-stats .stat-divider {
  width: 1px;
  height: 40px;
  background: rgba(255, 255, 255, 0.1);
  flex-shrink: 0;
}

/* ══════════════════════════════════ FILTER BAR */
.filter-bar {
  background: #071e3d;
  border-bottom: 1px solid rgba(255, 255, 255, 0.07);
  position: sticky;
  top: 0;
  z-index: 50;
}

.filter-inner {
  max-width: 1260px;
  margin: 0 auto;
  padding: 0 28px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}

.filter-tabs {
  display: flex;
}

.filter-tab {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 14px 20px;
  background: none;
  border: none;
  cursor: pointer;
  font-family: 'Barlow', sans-serif;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 0.45);
  border-bottom: 2px solid transparent;
  transition: all 0.2s;
  white-space: nowrap;
}

.filter-tab:hover {
  color: rgba(255, 255, 255, 0.75);
}

.filter-tab.active {
  color: #22c55e;
  border-bottom-color: #22c55e;
}

.tab-count {
  background: rgba(255, 255, 255, 0.08);
  border-radius: 999px;
  padding: 2px 8px;
  font-size: 10px;
}

.filter-tab.active .tab-count {
  background: rgba(34, 197, 94, 0.15);
  color: #22c55e;
}

.filter-right {
  display: flex;
  align-items: center;
  gap: 10px;
}

.filter-search {
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  padding: 8px 14px;
  color: rgba(255, 255, 255, 0.4);
}

.filter-search input {
  background: transparent;
  border: none;
  outline: none;
  font-family: 'Barlow', sans-serif;
  font-size: 12px;
  color: #fff;
  width: 160px;
}

.filter-search input::placeholder {
  color: rgba(255, 255, 255, 0.3);
}

/* Cart button */
.cart-btn {
  display: flex;
  align-items: center;
  gap: 7px;
  background: rgba(255, 255, 255, 0.07);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 8px;
  padding: 8px 16px;
  color: rgba(255, 255, 255, 0.7);
  font-family: 'Barlow', sans-serif;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.5px;
  cursor: pointer;
  transition: all 0.2s;
  position: relative;
}

.cart-btn:hover,
.cart-btn.has-items {
  background: rgba(34, 197, 94, 0.15);
  border-color: rgba(34, 197, 94, 0.35);
  color: #22c55e;
}

.cart-badge {
  background: #22c55e;
  color: #071e3d;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 700;
  padding: 1px 7px;
}

/* ══════════════════════════════════ PRODUCT GRID */
.product-section {
  max-width: 1260px;
  margin: 0 auto;
  padding: 48px 28px;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
}

/* WHITE PRODUCT CARD */
.product-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  overflow: hidden;
  transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
  position: relative;
  color: #1a2540;
}

.product-card:hover {
  transform: translateY(-4px);
  border-color: #22c55e;
  box-shadow: 0 16px 48px rgba(34, 197, 94, 0.12);
}

.product-card.out-of-stock {
  opacity: 0.7;
}

.card-badges {
  position: absolute;
  top: 14px;
  left: 14px;
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  z-index: 2;
}

.badge {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  padding: 4px 10px;
  border-radius: 999px;
}

.badge-popular {
  background: rgba(245, 158, 11, 0.12);
  color: #b45309;
  border: 1px solid rgba(245, 158, 11, 0.3);
}

.badge-stock {
  background: rgba(34, 197, 94, 0.1);
  color: #15803d;
  border: 1px solid rgba(34, 197, 94, 0.25);
}

.badge-oos {
  background: rgba(239, 68, 68, 0.1);
  color: #dc2626;
  border: 1px solid rgba(239, 68, 68, 0.25);
}

.badge-discount {
  background: rgba(59, 130, 246, 0.1);
  color: #1d4ed8;
  border: 1px solid rgba(59, 130, 246, 0.25);
}

.card-img-wrap {
  position: relative;
  height: 200px;
  overflow: hidden;
  background: #f8fafc;
}

.card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
  display: block;
}

.product-card:hover .card-img {
  transform: scale(1.05);
}

.card-hover-overlay {
  position: absolute;
  inset: 0;
  background: rgba(7, 30, 61, 0.55);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.25s;
}

.product-card:hover .card-hover-overlay {
  opacity: 1;
}

.quick-add-btn {
  display: flex;
  align-items: center;
  gap: 7px;
  background: #22c55e;
  color: #071e3d;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  font-family: 'Barlow', sans-serif;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  cursor: pointer;
  transition: background 0.15s, transform 0.1s;
}

.quick-add-btn:hover {
  background: #16a34a;
  transform: scale(1.04);
}

.oos-overlay {
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.65);
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(2px);
}

.oos-overlay span {
  background: rgba(239, 68, 68, 0.1);
  border: 1px solid rgba(239, 68, 68, 0.3);
  color: #dc2626;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  padding: 8px 20px;
  border-radius: 8px;
}

.card-body {
  padding: 20px;
}

.card-category-tag {
  font-size: 10px;
  font-weight: 600;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #22c55e;
}

.card-title {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 20px;
  font-weight: 700;
  letter-spacing: 0.5px;
  margin: 6px 0 8px;
  color: #0f172a;
  line-height: 1.2;
}

.card-desc {
  font-size: 12px;
  color: #64748b;
  line-height: 1.6;
  margin: 0 0 14px;
}

.card-specs {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-bottom: 18px;
}

.spec-tag {
  font-size: 10px;
  padding: 3px 10px;
  border-radius: 6px;
  background: #f1f5f9;
  border: 1px solid #e2e8f0;
  color: #475569;
  letter-spacing: 0.5px;
}

.card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}

.price-label {
  font-size: 10px;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: #94a3b8;
  display: block;
  margin-bottom: 3px;
}

.price-row {
  display: flex;
  align-items: baseline;
  gap: 8px;
}

.price-old {
  font-size: 12px;
  color: #94a3b8;
  text-decoration: line-through;
}

.price-current {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 22px;
  font-weight: 700;
  color: #22c55e;
}

.order-btn {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: #071e3d;
  color: #fff;
  border: none;
  padding: 10px 18px;
  border-radius: 8px;
  font-family: 'Barlow', sans-serif;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  cursor: pointer;
  white-space: nowrap;
  transition: background 0.2s, transform 0.15s;
  flex-shrink: 0;
}

.order-btn:hover:not(.disabled) {
  background: #22c55e;
  color: #071e3d;
  transform: translateY(-1px);
}

.order-btn.disabled {
  background: #e2e8f0;
  color: #94a3b8;
  cursor: not-allowed;
}

.in-cart-badge {
  position: absolute;
  bottom: 16px;
  right: 16px;
  background: rgba(34, 197, 94, 0.12);
  border: 1px solid rgba(34, 197, 94, 0.3);
  border-radius: 999px;
  padding: 3px 10px;
  font-size: 10px;
  font-weight: 700;
  color: #15803d;
  display: flex;
  align-items: center;
  gap: 4px;
}

.empty-state {
  text-align: center;
  padding: 80px 20px;
  color: rgba(255, 255, 255, 0.3);
}

.empty-state p {
  margin-top: 16px;
  font-size: 14px;
}

/* ══════════════════════════════════ CART PANEL */
.cart-panel {
  background: #ffffff;
  border-radius: 20px;
  width: 100%;
  max-width: 560px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 40px 80px rgba(0, 0, 0, 0.25);
  color: #1a2540;
  display: flex;
  flex-direction: column;
}

.cart-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 24px 28px 20px;
  border-bottom: 1px solid #f1f5f9;
}

.cart-header-left {
  display: flex;
  align-items: center;
  gap: 14px;
}

.cart-header h2 {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 22px;
  font-weight: 700;
  margin: 0 0 3px;
  color: #0f172a;
}

.cart-header p {
  font-size: 12px;
  color: #64748b;
  margin: 0;
}

.cart-items-wrap {
  flex: 1;
  overflow-y: auto;
  padding: 16px 28px;
}

.cart-empty {
  text-align: center;
  padding: 48px 20px;
  color: #94a3b8;
}

.cart-empty p {
  margin: 12px 0 20px;
  font-size: 14px;
}

.btn-browse {
  background: #071e3d;
  color: #fff;
  border: none;
  padding: 10px 22px;
  border-radius: 8px;
  font-family: 'Barlow', sans-serif;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
}

.cart-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 14px 0;
  border-bottom: 1px solid #f1f5f9;
}

.cart-item-img {
  width: 56px;
  height: 42px;
  object-fit: cover;
  border-radius: 8px;
  border: 1px solid #e2e8f0;
  flex-shrink: 0;
}

.cart-item-info {
  flex: 1;
  min-width: 0;
}

.cart-item-cat {
  font-size: 10px;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: #22c55e;
  display: block;
}

.cart-item-name {
  font-size: 13px;
  font-weight: 600;
  color: #0f172a;
  display: block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.cart-item-price {
  font-size: 11px;
  color: #64748b;
}

.cart-item-qty {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  font-weight: 600;
  color: #0f172a;
}

.cart-item-subtotal {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 16px;
  font-weight: 700;
  color: #22c55e;
  min-width: 60px;
  text-align: right;
}

.cart-item-remove {
  background: #fef2f2;
  border: 1px solid #fecaca;
  border-radius: 6px;
  color: #dc2626;
  padding: 5px 7px;
  cursor: pointer;
  display: flex;
  align-items: center;
}

.cart-item-remove:hover {
  background: #fee2e2;
}

.cart-total-bar {
  padding: 16px 28px 24px;
  border-top: 1px solid #f1f5f9;
}

.cart-total-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 14px;
  font-size: 13px;
  color: #475569;
}

.cart-grand-total {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 26px;
  font-weight: 800;
  color: #0f172a;
}

.btn-checkout {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: #22c55e;
  color: #071e3d;
  border: none;
  padding: 14px;
  border-radius: 10px;
  font-family: 'Barlow', sans-serif;
  font-size: 14px;
  font-weight: 700;
  letter-spacing: 0.5px;
  cursor: pointer;
  transition: background 0.2s;
}

.btn-checkout:hover {
  background: #16a34a;
}

/* ══════════════════════════════════ MODAL */
.modal-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(4, 15, 36, 0.75);
  backdrop-filter: blur(8px);
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

/* WHITE MODAL BOX */
.modal-box {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 20px;
  width: 100%;
  max-width: 680px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 40px 80px rgba(0, 0, 0, 0.3);
  color: #1a2540;
}

.modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 24px 28px 20px;
  border-bottom: 1px solid #f1f5f9;
}

.modal-header-left {
  display: flex;
  align-items: center;
  gap: 14px;
}

.modal-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: rgba(34, 197, 94, 0.1);
  border: 1px solid rgba(34, 197, 94, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.modal-header h2 {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 22px;
  font-weight: 700;
  margin: 0 0 3px;
  color: #0f172a;
}

.modal-header p {
  font-size: 12px;
  color: #64748b;
  margin: 0;
}

.modal-close {
  background: #f1f5f9;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  color: #64748b;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 14px;
  transition: all 0.2s;
}

.modal-close:hover {
  background: #fef2f2;
  border-color: #fecaca;
  color: #dc2626;
}

/* Progress */
.progress-steps {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 24px 28px 8px;
  position: relative;
}

.step {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;
  gap: 8px;
  z-index: 1;
}

.step-circle {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #f1f5f9;
  border: 2px solid #e2e8f0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: 700;
  color: #94a3b8;
  transition: all 0.3s;
}

.step.active .step-circle {
  background: rgba(34, 197, 94, 0.1);
  border-color: #22c55e;
  color: #22c55e;
}

.step.done .step-circle {
  background: #22c55e;
  border-color: #22c55e;
  color: #fff;
}

.step-label {
  font-size: 10px;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #94a3b8;
  font-weight: 600;
}

.step.active .step-label {
  color: #22c55e;
}

.step.done .step-label {
  color: #16a34a;
}

.step-line {
  position: absolute;
  left: calc(16.6%);
  top: 40px;
  height: 2px;
  background: linear-gradient(90deg, #22c55e, rgba(34, 197, 94, 0.3));
  border-radius: 2px;
  transition: width 0.4s ease;
  pointer-events: none;
  z-index: 0;
}

/* Form */
.step-content {
  padding: 20px 28px;
}

.step-title {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 18px;
  font-weight: 700;
  color: #0f172a;
  margin: 0 0 20px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 7px;
}

.form-group.full {
  grid-column: 1 / -1;
}

.form-group label {
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #475569;
}

.req {
  color: #ef4444;
}

.form-group input,
.form-group textarea {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 10px 14px;
  font-family: 'Barlow', sans-serif;
  font-size: 13px;
  color: #0f172a;
  outline: none;
  transition: border-color 0.2s;
  width: 100%;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: #22c55e;
  background: #fff;
}

.form-group input.error {
  border-color: rgba(239, 68, 68, 0.6);
}

.err-msg {
  font-size: 11px;
  color: #ef4444;
}

.input-icon-wrap {
  position: relative;
  display: flex;
  align-items: center;
}

.input-icon-wrap svg {
  position: absolute;
  left: 12px;
  color: #94a3b8;
  pointer-events: none;
}

.input-icon-wrap input {
  padding-left: 36px !important;
}

.form-group textarea {
  resize: vertical;
  min-height: 80px;
}

/* Order Products List (multi-product) */
.order-products-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-bottom: 4px;
}

.order-product-row {
  display: flex;
  align-items: center;
  gap: 12px;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  padding: 10px 14px;
}

.op-img {
  width: 52px;
  height: 38px;
  object-fit: cover;
  border-radius: 6px;
  border: 1px solid #e2e8f0;
  flex-shrink: 0;
}

.op-info {
  flex: 1;
  min-width: 0;
}

.op-cat {
  font-size: 9px;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: #22c55e;
  display: block;
}

.op-info strong {
  font-size: 12px;
  font-weight: 600;
  color: #0f172a;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: block;
}

.op-qty-ctrl {
  display: flex;
  align-items: center;
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  overflow: hidden;
}

.op-qty-input {
  width: 42px;
  text-align: center;
  border: none !important;
  border-left: 1px solid #e2e8f0 !important;
  border-right: 1px solid #e2e8f0 !important;
  border-radius: 0 !important;
  padding: 6px 4px !important;
  font-size: 12px;
  background: #fff;
  color: #0f172a;
}

.op-price {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 16px;
  font-weight: 700;
  color: #22c55e;
  min-width: 60px;
  text-align: right;
}

.op-remove {
  background: #fef2f2;
  border: 1px solid #fecaca;
  border-radius: 6px;
  color: #dc2626;
  padding: 5px 6px;
  cursor: pointer;
  display: flex;
  align-items: center;
  margin-left: 4px;
}

/* Qty button */
.qty-btn {
  width: 30px;
  height: 30px;
  background: #f1f5f9;
  border: none;
  color: #475569;
  font-size: 16px;
  cursor: pointer;
  transition: background 0.15s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.qty-btn:hover {
  background: rgba(34, 197, 94, 0.1);
  color: #22c55e;
}

/* Order Summary */
.order-summary {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 16px 20px;
  margin-top: 16px;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  font-size: 13px;
  padding: 6px 0;
  border-bottom: 1px solid #f1f5f9;
  color: #64748b;
}

.summary-row:last-child {
  border-bottom: none;
}

.summary-row span:last-child {
  color: #334155;
}

.summary-row.total {
  margin-top: 6px;
  padding-top: 14px;
  border-top: 1px solid #e2e8f0 !important;
  font-size: 15px;
  font-weight: 700;
  color: #0f172a;
}

.summary-row.total span:last-child {
  color: #22c55e;
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 20px;
}

/* Review */
.review-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}

.review-section {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 16px 18px;
}

.review-section h4 {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #22c55e;
  margin: 0 0 14px;
}

.review-item {
  display: flex;
  justify-content: space-between;
  padding: 6px 0;
  font-size: 12px;
  border-bottom: 1px solid #f1f5f9;
  gap: 12px;
}

.review-item span {
  color: #94a3b8;
  flex-shrink: 0;
}

.review-item strong {
  color: #334155;
  text-align: right;
  word-break: break-all;
}

.review-item.highlight strong {
  color: #22c55e;
  font-size: 15px;
  font-family: 'Barlow Condensed', sans-serif;
}

.review-notes {
  margin-top: 16px;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 14px 18px;
}

.review-notes h4 {
  font-size: 10px;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #94a3b8;
  margin: 0 0 8px;
}

.review-notes p {
  font-size: 12px;
  color: #475569;
  margin: 0;
  line-height: 1.6;
}

/* Loading Step */
.loading-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 48px 28px !important;
  gap: 20px;
}

.loading-animation {
  position: relative;
  width: 100px;
  height: 100px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.loading-ring {
  position: absolute;
  inset: 0;
  border-radius: 50%;
  border: 2px solid transparent;
  border-top-color: #22c55e;
  animation: spin 1.2s linear infinite;
}

.ring2 {
  inset: 10px;
  border-top-color: rgba(34, 197, 94, 0.4);
  animation-duration: 1.8s;
  animation-direction: reverse;
}

.ring3 {
  inset: 20px;
  border-top-color: rgba(34, 197, 94, 0.2);
  animation-duration: 2.4s;
}

.loading-icon {
  width: 44px;
  height: 44px;
  background: rgba(34, 197, 94, 0.08);
  border: 1px solid rgba(34, 197, 94, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.loading-step h3 {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 24px;
  font-weight: 700;
  margin: 0;
  color: #0f172a;
}

.loading-msg {
  color: #64748b;
  font-size: 13px;
  text-align: center;
  margin: 0;
  min-height: 20px;
}

.loading-dots {
  display: flex;
  gap: 6px;
}

.loading-dots span {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #22c55e;
  animation: blink 1.2s ease-in-out infinite;
}

.loading-dots span:nth-child(2) {
  animation-delay: 0.2s;
}

.loading-dots span:nth-child(3) {
  animation-delay: 0.4s;
}

@keyframes blink {

  0%,
  80%,
  100% {
    opacity: 0.2
  }

  40% {
    opacity: 1
  }
}

/* Modal Footer */
.modal-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 18px 28px 24px;
  border-top: 1px solid #f1f5f9;
  gap: 12px;
}

.footer-right {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-left: auto;
}

.btn-back {
  background: #f1f5f9;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  color: #475569;
  padding: 10px 18px;
  font-family: 'Barlow', sans-serif;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-back:hover {
  background: #e2e8f0;
  color: #0f172a;
}

.btn-cancel {
  background: transparent;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  color: #94a3b8;
  padding: 10px 18px;
  font-family: 'Barlow', sans-serif;
  font-size: 13px;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-cancel:hover {
  border-color: #fecaca;
  color: #ef4444;
}

.btn-next {
  background: rgba(34, 197, 94, 0.1);
  border: 1px solid rgba(34, 197, 94, 0.3);
  border-radius: 8px;
  color: #16a34a;
  padding: 10px 22px;
  font-family: 'Barlow', sans-serif;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  letter-spacing: 0.5px;
  transition: all 0.2s;
}

.btn-next:hover {
  background: rgba(34, 197, 94, 0.2);
}

.btn-submit {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #22c55e;
  border: none;
  border-radius: 8px;
  color: #071e3d;
  padding: 11px 24px;
  font-family: 'Barlow', sans-serif;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 0.5px;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-submit:hover {
  background: #16a34a;
  transform: translateY(-1px);
}

/* Modal Transition */
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.25s, transform 0.25s;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
  transform: scale(0.97);
}

/* ══════════════════════════════════ THANK YOU PAGE — WHITE */
.thankyou-box {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 24px;
  width: 100%;
  max-width: 580px;
  max-height: 90vh;
  overflow-y: auto;
  padding: 40px 36px;
  text-align: center;
  position: relative;
  box-shadow: 0 40px 80px rgba(0, 0, 0, 0.25);
  color: #1a2540;
}

.confetti-wrap {
  position: absolute;
  inset: 0;
  pointer-events: none;
  overflow: hidden;
  border-radius: 24px;
}

.confetti-dot {
  position: absolute;
  animation: confettiFall 3s ease-in-out infinite;
  opacity: 0.7;
}

@keyframes confettiFall {
  0% {
    transform: translateY(-20px) rotate(0deg);
    opacity: 0.7
  }

  100% {
    transform: translateY(120px) rotate(360deg);
    opacity: 0
  }
}

.ty-icon {
  position: relative;
  width: 80px;
  height: 80px;
  margin: 0 auto 24px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.ty-ring {
  position: absolute;
  inset: 0;
  border-radius: 50%;
  border: 2px solid rgba(34, 197, 94, 0.3);
  animation: expandRing 2s ease-out infinite;
}

@keyframes expandRing {
  0% {
    transform: scale(1);
    opacity: 0.6
  }

  100% {
    transform: scale(1.8);
    opacity: 0
  }
}

.ty-icon svg {
  background: rgba(34, 197, 94, 0.1);
  border: 2px solid rgba(34, 197, 94, 0.3);
  border-radius: 50%;
  width: 64px;
  height: 64px;
  padding: 14px;
}

.ty-title {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 36px;
  font-weight: 800;
  letter-spacing: 1px;
  margin: 0 0 10px;
  color: #0f172a;
}

.ty-subtitle {
  font-size: 13px;
  color: #64748b;
  line-height: 1.7;
  margin: 0 auto 24px;
  max-width: 400px;
}

.order-id-badge {
  display: inline-block;
  background: rgba(34, 197, 94, 0.08);
  border: 1px solid rgba(34, 197, 94, 0.2);
  border-radius: 999px;
  padding: 8px 22px;
  font-size: 12px;
  font-weight: 600;
  color: #475569;
  letter-spacing: 1px;
  margin-bottom: 28px;
}

.order-id-badge strong {
  color: #16a34a;
}

/* Receipt Card — WHITE */
.receipt-card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  overflow: hidden;
  margin-bottom: 28px;
  text-align: left;
}

.receipt-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 20px;
  background: #fff;
  border-bottom: 1px solid #e2e8f0;
}

.receipt-logo {
  display: flex;
  align-items: center;
  gap: 8px;
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 18px;
  font-weight: 800;
  letter-spacing: 2px;
  color: #0f172a;
}

.receipt-logo em {
  color: #22c55e;
  font-style: normal;
}

.receipt-meta {
  font-size: 11px;
  color: #94a3b8;
}

.receipt-divider {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 20px;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 3px;
  color: #94a3b8;
  text-transform: uppercase;
}

.receipt-divider::before,
.receipt-divider::after {
  content: '';
  flex: 1;
  border-top: 1px dashed #e2e8f0;
}

.receipt-body {
  padding: 4px 20px 16px;
}

.receipt-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 7px 0;
  font-size: 12px;
  border-bottom: 1px solid #f1f5f9;
}

.receipt-row span {
  color: #94a3b8;
}

.receipt-row strong {
  color: #334155;
  text-align: right;
}

.receipt-spacer {
  height: 1px;
  background: #e2e8f0;
  margin: 10px 0;
  border-top: 1px dashed rgba(34, 197, 94, 0.3);
}

.receipt-total {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  padding: 14px 0 8px;
  margin-top: 8px;
  border-top: 2px solid rgba(34, 197, 94, 0.2);
}

.receipt-total span {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #64748b;
}

.receipt-total strong {
  font-family: 'Barlow Condensed', sans-serif;
  font-size: 28px;
  font-weight: 800;
  color: #22c55e;
}

.receipt-footer {
  padding: 12px 20px;
  text-align: center;
  border-top: 1px solid #e2e8f0;
  background: #fff;
}

.receipt-footer p {
  margin: 3px 0;
  font-size: 10px;
  color: #94a3b8;
  letter-spacing: 0.5px;
}

/* TY Buttons */
.ty-actions {
  display: flex;
  gap: 12px;
  justify-content: center;
  flex-wrap: wrap;
}

.ty-btn-print {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #f1f5f9;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  color: #475569;
  padding: 12px 24px;
  font-family: 'Barlow', sans-serif;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 0.5px;
  cursor: pointer;
  transition: all 0.2s;
}

.ty-btn-print:hover {
  background: #e2e8f0;
  transform: translateY(-1px);
}

.ty-btn-home {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #22c55e;
  border: none;
  border-radius: 10px;
  color: #071e3d;
  padding: 12px 24px;
  font-family: 'Barlow', sans-serif;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 0.5px;
  cursor: pointer;
  transition: all 0.2s;
}

.ty-btn-home:hover {
  background: #16a34a;
  transform: translateY(-1px);
}

/* Print */
@media print {
  body * {
    visibility: hidden;
  }

  #receipt-area,
  #receipt-area * {
    visibility: visible;
  }

  #receipt-area {
    position: fixed;
    inset: 0;
    background: #fff !important;
    padding: 40px;
    max-height: none;
    border: none;
    border-radius: 0;
    box-shadow: none;
  }

  .ty-actions,
  .ty-icon,
  .ty-ring,
  .confetti-wrap {
    display: none !important;
  }
}

/* Responsive */
@media (max-width: 640px) {
  .form-grid {
    grid-template-columns: 1fr;
  }

  .form-group.full {
    grid-column: 1;
  }

  .review-grid {
    grid-template-columns: 1fr;
  }

  .progress-steps {
    gap: 0;
  }

  .step-label {
    font-size: 8px;
  }

  .thankyou-box {
    padding: 28px 20px;
  }

  .filter-tabs {
    overflow-x: auto;
  }

  .filter-inner {
    padding: 0 16px;
  }

  .op-qty-ctrl {
    display: none;
  }
}
</style>