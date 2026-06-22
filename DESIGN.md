---
version: beta
name: Orion-Clinic-design-system
description: "A clean, accessible healthcare platform canvas built around a soft cream-white ground, charcoal type, and a trustworthy Orion Navy (#003E7E) with an Orion Teal (#1BA098) accent. Cards live as floating white tiles with thin hairline borders and minimal radii (8–16px). The system is designed to convey trust, clarity, and ease-of-use for patients and healthcare professionals, ensuring WCAG AA standards are met."

colors:
  primary: "#003E7E"
  on-primary: "#ffffff"
  accent: "#1BA098"
  on-accent: "#ffffff"
  ink: "#111111"
  ink-muted: "#626260"
  ink-subtle: "#7b7b78"
  ink-tertiary: "#9c9fa5"
  canvas: "#f5f1ec"
  surface-1: "#ffffff"
  surface-2: "#ebe7e1"
  inverse-canvas: "#000000"
  inverse-surface-1: "#313130"
  inverse-ink: "#ffffff"
  inverse-ink-muted: "#9c9fa5"
  hairline: "#d3cec6"
  hairline-soft: "#ebe7e1"
  semantic-success: "#4CAF50"
  semantic-warning: "#FF9800"
  semantic-error: "#E53935"
  semantic-info: "#2196F3"
  dark-canvas: "#121212"
  dark-surface-1: "#1e1e1e"
  dark-surface-2: "#2a2a2a"
  dark-ink: "#f5f5f5"
  dark-ink-muted: "#a3a3a3"
  dark-hairline: "#333333"

typography:
  display-xl:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 72px
    fontWeight: 700
    lineHeight: 1.05
    letterSpacing: -2.0px
  display-lg:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 56px
    fontWeight: 700
    lineHeight: 1.10
    letterSpacing: -1.4px
  display-md:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 40px
    fontWeight: 600
    lineHeight: 1.15
    letterSpacing: -0.8px
  headline:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 28px
    fontWeight: 600
    lineHeight: 1.20
    letterSpacing: -0.5px
  card-title:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 22px
    fontWeight: 600
    lineHeight: 1.25
    letterSpacing: -0.3px
  subhead:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 20px
    fontWeight: 400
    lineHeight: 1.40
    letterSpacing: -0.2px
  body-lg:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 18px
    fontWeight: 400
    lineHeight: 1.50
    letterSpacing: -0.1px
  body:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 16px
    fontWeight: 400
    lineHeight: 1.50
    letterSpacing: 0
  body-sm:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 14px
    fontWeight: 400
    lineHeight: 1.50
    letterSpacing: 0
  caption:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 12px
    fontWeight: 400
    lineHeight: 1.40
    letterSpacing: 0
  button:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 15px
    fontWeight: 600
    lineHeight: 1.20
    letterSpacing: 0
  eyebrow:
    fontFamily: Plus Jakarta Sans, Inter
    fontSize: 14px
    fontWeight: 600
    lineHeight: 1.30
    letterSpacing: 0
  mono:
    fontFamily: monospace
    fontSize: 13px
    fontWeight: 400
    lineHeight: 1.50
    letterSpacing: 0

rounded:
  xs: 4px
  sm: 6px
  md: 8px
  lg: 12px
  xl: 16px
  xxl: 24px
  pill: 9999px
  full: 9999px

spacing:
  xxs: 4px
  xs: 8px
  sm: 12px
  md: 16px
  lg: 24px
  xl: 32px
  xxl: 48px
  section: 96px

components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.on-primary}"
    typography: "{typography.button}"
    rounded: "{rounded.md}"
    padding: 10px 18px
  button-accent:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.on-accent}"
    typography: "{typography.button}"
    rounded: "{rounded.md}"
    padding: 10px 18px
  button-secondary:
    backgroundColor: "{colors.surface-1}"
    textColor: "{colors.ink}"
    typography: "{typography.button}"
    rounded: "{rounded.md}"
    padding: 10px 18px
  health-metrics-card:
    backgroundColor: "{colors.surface-1}"
    textColor: "{colors.ink}"
    typography: "{typography.body}"
    rounded: "{rounded.lg}"
    padding: 24px
  patient-profile-card:
    backgroundColor: "{colors.surface-1}"
    textColor: "{colors.ink}"
    typography: "{typography.body}"
    rounded: "{rounded.lg}"
    padding: 24px
  appointment-status-indicator:
    backgroundColor: "{colors.semantic-info}"
    textColor: "{colors.on-primary}"
    typography: "{typography.caption}"
    rounded: "{rounded.full}"
    padding: 4px 12px
  prescription-display:
    backgroundColor: "{colors.surface-1}"
    textColor: "{colors.ink}"
    typography: "{typography.body-sm}"
    rounded: "{rounded.md}"
    padding: 16px
  patient-health-timeline:
    backgroundColor: "{colors.canvas}"
    textColor: "{colors.ink-muted}"
    typography: "{typography.caption}"
    padding: 0
  top-nav:
    backgroundColor: "{colors.canvas}"
    textColor: "{colors.ink}"
    typography: "{typography.body-sm}"
    rounded: "{rounded.xs}"
    height: 64px
---

## Overview

Orion Clinic's telemedicine canvas is a soft cream-white ground (`{colors.canvas}` ≈ #f5f1ec) — deliberately warm to convey care and comfort. On top of the cream canvas sit white floating cards (`{colors.surface-1}`), thin hairline dividers (`{colors.hairline}`), and high-contrast charcoal type (`{colors.ink}` #111111) for maximum readability and accessibility.

The primary brand color is **Orion Navy** (`{colors.primary}` #003E7E), establishing trust, medical authority, and calmness. The secondary chromatic accent is **Orion Teal** (`{colors.accent}` #1BA098), which brings a modern, digital-first healthcare feel to active states and key highlights.

Display type is **Plus Jakarta Sans** (or Inter) — ensuring clarity in medical records, patient data, and instructions.

The system is rigorously designed to meet **WCAG AA contrast standards**, acknowledging that healthcare software is used by patients with varied visual capabilities and in high-stress environments.

## Colors

### Brand & Accent
- **Orion Navy** ({colors.primary}): The system primary color. Represents medical authority, trust, and calm. Used for primary buttons, prominent headers, and active states.
- **Orion Teal** ({colors.accent}): The digital healthcare accent. Used to highlight key interactive elements, successful progress, and secondary active actions.
- **White** ({colors.on-primary}): Text on Navy and Teal elements.

### Surface
- **Canvas** ({colors.canvas}): Default page background — soft cream-white #f5f1ec. Reduces eye strain compared to pure white.
- **Surface 1** ({colors.surface-1}): Pure white — used for patient profile cards, health metric tiles, and prescriptions.
- **Surface 2** ({colors.surface-2}): Slightly darker cream — used for secondary information panels and striped table rows.
- **Hairline** ({colors.hairline}): 1px borders on cards — soft warm gray (#d3cec6).

### Text (WCAG AA Compliant)
- **Ink** ({colors.ink}): All headlines, body type, button labels — charcoal #111111. High contrast against canvas and surface.
- **Ink Muted** ({colors.ink-muted}): Secondary type at #626260 — meta info, timestamps on timelines.
- **Ink Subtle** ({colors.ink-subtle}): Tertiary type at #7b7b78 — footer columns, helper text.

### Healthcare Semantic Palette
Crucial for a telemedicine platform where statuses dictate patient care:
- **Success** ({colors.semantic-success} #4CAF50): Lab results normal, appointment confirmed, prescription ready.
- **Warning** ({colors.semantic-warning} #FF9800): Upcoming appointments, pending lab results, mild interactions.
- **Error** ({colors.semantic-error} #E53935): Critical lab values, missed appointments, system alerts.
- **Info** ({colors.semantic-info} #2196F3): Informational notices, general health tips, neutral statuses.

### Dark Mode Palette
Designed for doctors on night shifts and patients sensitive to bright light:
- **Dark Canvas**: #121212
- **Dark Surface**: #1e1e1e
- **Dark Text (Ink)**: #f5f5f5
- **Dark Text Muted**: #a3a3a3

## Typography

- **Primary Font**: Plus Jakarta Sans (fallback: Inter, system-ui). Used across the board for excellent legibility of medical data.
- **Hierarchy**: Maintained by size and weight. Display headers use heavier weights (700/600) with slight negative tracking to save space, while body text uses a relaxed 1.50 line height at 400 weight for readability.

## Components (Healthcare Context)

**`health-metrics-card`**
- Frames patient vitals (Blood Pressure, Heart Rate, etc.).
- Background: `{colors.surface-1}` (White). Allows metric data and charts to pop cleanly. Rounded `{rounded.lg}`.

**`patient-profile-card`**
- Centralized view of a patient's demographics and quick stats.
- Background: `{colors.surface-1}`, padded 24px, with a 1px `{colors.hairline}` border to separate it from the `{colors.canvas}`.

**`appointment-status-indicator`**
- Small pill badges (`{rounded.full}`) communicating the state of a consultation (e.g., "Waiting", "In Progress", "Completed").
- Colors map to the Semantic Palette.

**`prescription-display`**
- Clear, highly legible list of medications. 
- Background: `{colors.surface-1}` with `{typography.body-sm}` for precise dosage instructions.

**`patient-health-timeline`**
- Vertical feed of a patient's medical history. 
- Blends into `{colors.canvas}` with distinct `{colors.surface-1}` nodes.

## Do's and Don'ts

### Do
- Ensure all text on `{colors.primary}` and `{colors.accent}` uses `{colors.on-primary}` (White) to maintain WCAG AA contrast.
- Use **Orion Navy** as the default action color to project trust.
- Reserve **Orion Teal** for highlighting new messages, successful steps, or key digital interactions.
- Use semantic colors strictly for their intended meaning (e.g., Red ONLY for errors or critical health alerts).
- Maintain the `{colors.canvas}` cream background to reduce eye strain for doctors looking at screens all day.

### Don't
- Don't use pure white (`#ffffff`) as the main application background.
- Don't use light gray text that fails WCAG AA contrast ratios (avoid anything lighter than `#7b7b78` on white/cream backgrounds).
- Don't use Orion Teal for destructive actions or warnings.
- Don't clutter medical cards with drop shadows; rely on hairline borders and surface color differences for depth.

## Implementation Checklist

- [ ] Update global CSS variables to reflect Orion Clinic colors (`#003E7E`, `#1BA098`).
- [ ] Add the Semantic Palette variables (`--color-success`, `--color-warning`, `--color-error`, `--color-info`) to the stylesheet.
- [ ] Implement the Dark Mode color palette using `@media (prefers-color-scheme: dark)` or a data-theme attribute.
- [ ] Replace any hardcoded "blue" utility classes with `bg-primary`, `text-primary`, `bg-accent`, etc.
- [ ] Ensure `Plus Jakarta Sans` or `Inter` is correctly imported and set as the default sans-serif font family.
- [ ] Run an automated accessibility checker (e.g., Lighthouse, Axe) to verify WCAG AA contrast compliance across all new color pairings.
- [ ] Build the structural healthcare components (`HealthMetricsCard`, `PatientProfileCard`, `AppointmentStatusIndicator`, `PrescriptionDisplay`, `PatientHealthTimeline`) matching the design tokens.
- [ ] Validate button tap targets are at least 44x44px for accessible mobile usage by patients.
