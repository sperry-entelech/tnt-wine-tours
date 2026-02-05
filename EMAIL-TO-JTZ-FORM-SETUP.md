# Email to JTZ: Form Processing Setup Instructions

**Date:** 2026-02-05
**Subject:** Wine Tours Form Processing - Use Your Existing Form Handler

---

## EMAIL DRAFT FOR JTZ DEVELOPERS

**To:** JTZ Development Team
**Subject:** Re: Form Processing for Wine Tours Landing Page
**Priority:** Normal

---

Hi JTZ Team,

Thanks for asking about the form processing! Here's the simple answer:

## Use Your Existing Form Handler

Please point the wine tours landing page form to **the same form processing endpoint you currently use for TNT's main website contact forms**.

This is the fastest and safest approach since that system is already working and delivering leads to our inbox.

---

## What You Need to Do:

### Step 1: Update the Form Action Attribute

**File:** `landing-page.html`

**Change this:**
```html
<form id="winetours-form" action="#" method="POST">
```

**To this:**
```html
<form id="winetours-form" action="YOUR_EXISTING_FORM_HANDLER.php" method="POST">
```

*(Replace `YOUR_EXISTING_FORM_HANDLER.php` with whatever endpoint you use for the current TNT website contact form)*

---

### Step 2: Process These Form Fields

The form collects the following data (all fields are already properly named in the HTML):

**Required Fields:**
- `firstName` - Text input
- `lastName` - Text input
- `email` - Email input (validated on client-side)
- `phone` - Phone number (auto-formatted on client-side as (XXX) XXX-XXXX)

**Optional Fields:**
- `tourDate` - Date picker (format: YYYY-MM-DD)
- `groupSize` - Dropdown select (values: "1-4", "5-8", "9-14", "15+")
- `tour_interest` - Checkbox (value: "yes" if checked, empty if unchecked)

**IMPORTANT:** The `tour_interest` checkbox indicates if the lead wants to book a professional wine tour. If this is checked, it's a **hot lead** who should be prioritized.

---

### Step 3: Email Notification Setup

**Send email notifications to:**
sedan@tntauto.com *(or whatever email TNT uses for website leads)*

**Suggested Email Format:**

**Subject Line:**
`New Wine Tour Lead: [firstName] [lastName]`

**Email Body Template:**
```
New Wine Tour Lead Received
================================

CONTACT INFORMATION:
--------------------
Name: [firstName] [lastName]
Email: [email]
Phone: [phone]

TOUR DETAILS:
-------------
Tour Interest: [tour_interest = "YES" if checked, "No" if unchecked]
Preferred Date: [tourDate or "Not specified"]
Group Size: [groupSize or "Not specified"]

---
Lead Source: Wine Tours Landing Page
Submitted: [timestamp]

[If tour_interest is checked, add this:]
HOT LEAD: This person indicated interest in booking a professional wine tour!
```

---

### Step 4: Success Redirect (Optional)

After successful form submission, you can either:

**Option A:** Redirect to a thank-you page
**Option B:** Show an in-page success message
**Option C:** Trigger the PDF downloads automatically

You can use JavaScript to show a success message like:
```
"Thank you! We've received your information and will send your free wine tour guide shortly. A dispatcher will contact you within 24 hours if you indicated interest in booking a tour."
```

---

## That's It!

This should work exactly like your existing contact forms.

**Questions?** Let us know if you need any clarification!

---

Best regards,
TNT Team

---

## OPTIONAL: Google Analytics Event Tracking

If TNT has Google Analytics installed and wants to track form conversions:

```javascript
if (typeof gtag !== 'undefined') {
    gtag('event', 'form_submit', {
        'event_category': 'Wine Tours Campaign',
        'event_label': document.querySelector('input[name="tour_interest"]').checked ? 'Tour Interest - Hot Lead' : 'Guide Download Only',
        'value': document.querySelector('input[name="tour_interest"]').checked ? 1 : 0
    });
}
```

---

## TESTING CHECKLIST

Before going live, please test:

- [ ] Form submits successfully
- [ ] Email notification arrives at sedan@tntauto.com
- [ ] All form fields are included in the email
- [ ] Phone number is formatted correctly: (804) XXX-XXXX
- [ ] "Tour interest" checkbox value is captured
- [ ] Success message displays after submission
- [ ] Test on mobile devices
- [ ] Test with and without optional fields filled
