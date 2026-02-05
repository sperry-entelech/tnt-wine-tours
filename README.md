# TNT Wine Tours - Website Integration Package

**For JTZ Web Team**
Complete marketing campaign materials ready for website integration.

---

## What's Included

This repository contains **production-ready** static files for the TNT Virginia Wine Tours marketing campaign. Everything is designed to integrate seamlessly into the existing TNT website with minimal technical setup.

### Components:

1. **Wine Tours Promotional Popup** - Capture attention on homepage
2. **Interactive Winery Map** - 24 Virginia wineries with insider tips
3. **Lead Magnet Guides** - Premium downloadable wine tour guides
4. **Lead Capture Landing Page** - Form with guide download

---

## Quick Start: What JTZ Needs to Do

### Component 1: Wine Tours Popup (High Priority)
**File:** `popup-example.html`
**Purpose:** Clean promotional popup that appears on the main website

**Integration Steps:**
1. Open `popup-example.html` in browser to preview
2. Copy the CSS (inside `<style>` tags) to your site's stylesheet
3. Copy the HTML (inside `<div class="popup-overlay">`) to your site template
4. Copy the JavaScript (inside `<script>` tags) to your site's JS file
5. Update the link `href` to point to your hosted landing page URL

**Notes:**
- Popup appears after 3 seconds
- Shows once per session (uses cookies)
- Mobile responsive
- Easy to dismiss

---

### Component 2: Lead Capture Landing Page
**File:** `landing-page.html`
**Purpose:** Main destination where users sign up to receive guides

**Integration Steps:**
1. Upload `landing-page.html` to your web hosting
2. Upload the `images/` folder to the same directory
3. **Update Form Action:** Change `action="#"` to your actual form processing endpoint
4. Test form submission

**Dependencies (Loaded from CDN - No Installation Needed):**
- No external dependencies for the landing page

---

### Component 3: Interactive Winery Map
**File:** `interactive-map.html`
**Purpose:** Standalone map page with all 24 wineries, tasting details, and insider tips

**Integration Options:**

**Option A: Standalone Page (Recommended)**
1. Upload `interactive-map.html` to your site
2. Link to it from your main navigation or wine tours section

**Option B: Embed in Existing Page**
```html
<iframe src="interactive-map.html" width="100%" height="800px" frameborder="0"></iframe>
```

**Features:**
- 24 Virginia wineries (Monticello AVA + Richmond Area)
- Tasting fees, hours, signature wines
- Region and feature filters
- Mobile-optimized
- No API keys needed (uses free OpenStreetMap)

---

### Component 4: Lead Magnet Guides
**Files:**
- `TNT-Wine-Tour-Insider-Guide.html`
- `TNT-Wine-Tour-Planning-Checklist.html`

**Integration Steps:**
1. **Convert to PDF:**
   - Open each HTML file in Chrome/Edge
   - Right-click > "Print" > "Save as PDF"
   - Use settings: Letter size, no headers/footers, background graphics enabled

2. **Host the PDFs:**
   - Upload PDFs to your web hosting (e.g., `/downloads/wine-tour-guide.pdf`)

3. **Update Landing Page Form:**
   - After form submission, redirect users to the PDF download URLs
   - Or email PDFs automatically via your form handler

---

## File Structure

```
tnt-wine-tours/
├── README.md                                  # This file
├── popup-example.html                         # Wine tours popup widget
├── landing-page.html                          # Main landing page with form
├── interactive-map.html                       # Full winery map experience
├── form-handler.php                           # Form processing script
├── wine-tours-database.json                   # Winery data (24 wineries)
├── TNT-Wine-Tour-Insider-Guide.html           # Lead magnet (needs PDF conversion)
├── TNT-Wine-Tour-Planning-Checklist.html      # Lead magnet (needs PDF conversion)
├── copy-variations-reference.md               # Copy alternatives for A/B testing
├── EMAIL-TO-JTZ-FORM-SETUP.md                # Form setup instructions
├── README-FORM-SETUP.md                       # Form package documentation
├── FORM-TESTING-GUIDE.md                      # Testing checklist
└── images/
    ├── wine-tour-1.jpg                        # Placeholder (needs sourcing)
    ├── wine-tour-2.jpg                        # Placeholder
    ├── wine-tour-3.jpg                        # Placeholder
    ├── wine-tour-4.jpg                        # Placeholder
    ├── tnt-logo.png                           # TNT branding
    └── tnt logo.jpg                           # TNT branding (alt)
```

---

## Design System

**Color Palette (matches tntlimousine.com):**
- Background: White `#ffffff` / Light Gray `#f5f5f5`
- Text: Charcoal `#333333` / Dark `#111111`
- Accent: TNT Red `#CC0000` (used sparingly)
- Header/Nav: Dark `#2d2d2d`

**Fonts:**
- Body: System fonts (Arial, Helvetica, sans-serif)
- Headlines: Clean sans-serif, bold
- All fonts are standard - no external font loading required

**Branding:**
- TNT logo in existing formats
- Clean, professional aesthetic matching tntlimousine.com
- Mobile-first responsive design

---

## Technical Specifications

### No Complex Setup Required
- **No database** needed
- **No API keys** required (uses free OpenStreetMap)
- **No build process** - pure HTML/CSS/JavaScript
- **No Node.js, npm, or dependencies** to install
- **No environment variables** to configure

### Browser Compatibility
- Chrome, Firefox, Safari, Edge (last 2 versions)
- Mobile Safari (iOS 12+)
- Chrome Mobile (Android 8+)

### External Dependencies (CDN-loaded)
1. **Leaflet.js** - https://unpkg.com/leaflet@1.9.4/
   - Free, open-source mapping library
   - No API key required
   - Uses OpenStreetMap tiles (also free)

---

## Integration Checklist for JTZ

- [ ] **Test all HTML files locally** (open in browser)
- [ ] **Upload files to web hosting**
  - [ ] landing-page.html
  - [ ] interactive-map.html
  - [ ] popup-example.html
  - [ ] wine-tours-database.json
  - [ ] images/ folder
- [ ] **Update form action** in landing-page.html
- [ ] **Integrate popup code** into main website
- [ ] **Convert lead magnets to PDF**
  - [ ] TNT-Wine-Tour-Insider-Guide.html > PDF
  - [ ] TNT-Wine-Tour-Planning-Checklist.html > PDF
- [ ] **Upload PDFs** to hosting
- [ ] **Update popup link** to point to hosted landing-page.html
- [ ] **Test form submissions** (verify emails/CRM integration)
- [ ] **Test on mobile devices**
- [ ] **Test map functionality** (clicks, popups, filters)

---

## Marketing Campaign Flow

1. **Visitor lands on TNT website** > Sees wine tours popup after 3 seconds
2. **Clicks "Get Free Wine Tour Guide"** > Goes to landing page
3. **Explores interactive map** > Views 24 wineries with insider tips
4. **Fills out form** > Submits name and email
5. **Receives lead magnets** > Downloads wine tour guide and checklist
6. **TNT captures lead** > Email goes to your CRM/mailing list

---

## Version Info

- **Created:** February 2026
- **Campaign:** TNT Virginia Wine Tours
- **Availability:** Year-round (peak: Spring through Fall)
- **Total Wineries:** 24 Virginia wineries across 2 regions
- **Itineraries:** 5 curated routes
- **Lead Magnets:** 2 premium downloadable guides

---

## What's Already Done for You

- 24 wineries researched and verified
- Tasting details and insider tips compiled
- 5 curated tour itineraries built
- Vehicle pricing table included
- Mobile-responsive design implemented
- Professional branding matching tntlimousine.com
- Lead magnet content written
- Interactive map fully functional
- Form validation included
- Popup behavior optimized (session-based, dismissible)

**JTZ just needs to integrate - all the hard work is done!**

---

## Questions?

Contact your TNT point of contact or refer to this README for integration guidance.
