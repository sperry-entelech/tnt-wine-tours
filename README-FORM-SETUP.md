# Form Setup Package for JTZ

**Created:** 2026-02-05
**Purpose:** Complete form processing solution for TNT Wine Tours landing page

---

## WHAT'S IN THIS PACKAGE

### 1. **EMAIL-TO-JTZ-FORM-SETUP.md**
**Use this:** Email instructions for JTZ developers explaining how to set up the form

**Summary:**
- Tells them to use their existing form handler (simplest approach)
- Lists all form fields to process
- Provides email notification template
- Includes optional Google Analytics tracking code

**Action:** Copy this content and send to JTZ team

---

### 2. **form-handler.php** (Backup Option)
**Use this if:** JTZ doesn't have an existing form handler or wants a dedicated script

**Features:**
- Complete PHP form processing script
- Email notifications with HTML formatting
- "Hot lead" alerts when tour interest is checked
- Input validation and sanitization
- Spam prevention (rate limiting)
- CSV logging (automatic lead tracking)
- Security features (SQL injection protection)

**Setup Instructions:**
1. Update line 14: `define('RECIPIENT_EMAIL', 'sedan@tntauto.com');`
2. Upload to JTZ web server
3. Update landing-page.html form action: `action="form-handler.php"`

---

### 3. **FORM-TESTING-GUIDE.md**
**Use this:** Complete testing checklist for JTZ before going live

**Includes:**
- 7-step testing process
- 5 test cases with expected results
- Mobile & browser compatibility checks
- Security testing procedures
- Troubleshooting common issues
- Production readiness checklist

**Action:** Send to JTZ QA team for pre-launch testing

---

## RECOMMENDED IMPLEMENTATION PATH

### OPTION A: Fast Track (Recommended)

**Step 1:** Send `EMAIL-TO-JTZ-FORM-SETUP.md` to JTZ
**Step 2:** JTZ points form to their existing contact form handler
**Step 3:** Test using `FORM-TESTING-GUIDE.md`
**Step 4:** Go live

**Pros:**
- Uses proven infrastructure (their existing form handler)
- Minimal setup required
- Familiar workflow (email notifications)

---

### OPTION B: Custom Script (If JTZ Doesn't Have Existing Handler)

**Step 1:** Send `form-handler.php` to JTZ
**Step 2:** JTZ uploads to web server and configures
**Step 3:** Update landing-page.html to point to form-handler.php
**Step 4:** Test using `FORM-TESTING-GUIDE.md`
**Step 5:** Go live

**Pros:**
- Dedicated form processor for this campaign
- Automatic CSV logging (built-in lead tracking)
- Hot lead alerts in email
- Pretty HTML email formatting

---

## HOW THE FORM WORKS

### User Flow:
1. User fills out form on landing-page.html
2. Clicks "Get My Free Guide Now" button
3. Client-side JavaScript validates required fields
4. Form submits to form handler (POST request)
5. Form handler processes data and sends email
6. User sees success message

### Email Notification:
- **To:** sedan@tntauto.com
- **Subject:** "New Wine Tour Lead: [First Name] [Last Name]"
- **Body:** HTML formatted email with all form data
- **Special Alert:** If user checked "tour interest" > **HOT LEAD** flag appears

### Data Collected:
- **Required:** First Name, Last Name, Email, Phone
- **Optional:** Tour Date, Group Size
- **Flag:** Tour Interest checkbox (YES/NO)

---

## TRACKING OPTIONS

### Basic (Included in form-handler.php):
- CSV log file: `wine-tour-leads.csv`
- Automatically tracks: timestamp, contact info, tour interest, IP address
- Can open in Excel/Google Sheets for analysis

### Advanced (Optional - Set Up Later):
- Google Analytics event tracking (code included in EMAIL-TO-JTZ-FORM-SETUP.md)
- n8n workflow integration
- Zapier/Make.com automation
- Direct CRM integration

---

## SECURITY FEATURES

### Built into form-handler.php:
- Input sanitization (prevents XSS attacks)
- Email validation (prevents spam)
- Rate limiting (prevents bot submissions)
- SQL injection protection
- CSRF protection via session checks

---

## FAQ FOR JTZ

**Q: Do we need to create a thank-you page?**
A: Not required. The form can show an in-page success message.

**Q: How do we send the PDFs to customers?**
A: For now, manually email them after receiving the lead notification. We can automate this later.

**Q: What if our existing form handler doesn't work?**
A: Use the form-handler.php script provided. It's plug-and-play ready.

**Q: Can we track which leads came from this specific page?**
A: Yes - the email subject line says "Wine Tour Lead" and the CSV log tracks the source.

**Q: What if we get spam submissions?**
A: The form-handler.php has built-in spam prevention (rate limiting). If needed, we can add CAPTCHA later.

---

## TECHNICAL REQUIREMENTS

### Server Requirements (if using form-handler.php):
- PHP 7.0 or higher
- mail() function enabled (or PHPMailer installed)
- Write permissions for CSV logging (optional)

### Browser Requirements (User-facing):
- Modern browsers: Chrome, Firefox, Safari, Edge (last 2 versions)
- Mobile: iOS 12+, Android 8+
- JavaScript enabled (for validation and formatting)

---

## NEXT STEPS

### Your Action Items:
1. Send EMAIL-TO-JTZ-FORM-SETUP.md to JTZ developers
2. Wait for JTZ to implement
3. Test form using FORM-TESTING-GUIDE.md
4. Approve for production launch
5. Monitor first week of submissions

### JTZ Action Items:
1. Choose implementation path (existing handler vs custom script)
2. Update landing-page.html form action attribute
3. Complete testing checklist
4. Deploy to production
5. Send test submission to verify email delivery

---

## FINAL CHECKLIST

Before sending to JTZ:

- [x] Email instructions created (EMAIL-TO-JTZ-FORM-SETUP.md)
- [x] Backup PHP script ready (form-handler.php)
- [x] Testing guide prepared (FORM-TESTING-GUIDE.md)
- [x] Summary documentation written (this file)
- [ ] Send package to JTZ team
- [ ] Schedule follow-up call to answer questions
- [ ] Set reminder to check first submissions
