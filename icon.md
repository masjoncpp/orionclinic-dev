I want to integrate Flaticon icons (colored, fill style) into Orion Clinic telemedicine PHP/CodeIgniter project.

PROJECT TECH STACK:
- Framework: CodeIgniter 4
- Frontend: Blade templates (or similar PHP templating)
- CSS: TailwindCSS
- No TypeScript/React - pure PHP backend with templating

ICON REQUIREMENTS:

Icon Type: Flaticon colored fill icons (not outline, not monochrome)

Brand Colors:
- Primary Navy: #003E7E
- Accent Teal: #1BA098
- Success/Health: #4CAF50
- Warning: #FF9800
- Error: #E53935
- Info: #2196F3

ICON USE CASES IN ORION CLINIC:

Healthcare Icons (20-24px, Navy #003E7E):
- Doctor/Healthcare Provider
- Patient/Person
- Appointment/Calendar
- Medical Records/Document
- Prescription/Pills
- Vital Signs/Heart Rate
- Stethoscope
- Lab Results/Beaker
- Temperature/Thermometer

Navigation Icons (24-32px, Navy #003E7E):
- Dashboard/Home
- Appointments
- Medical Records
- Messages/Chat
- User Profile
- Settings
- Notifications/Bell
- Search
- Menu

Status Icons (16-24px, Color-Coded):
- Success/Checkmark (Green #4CAF50)
- Pending/Clock (Orange #FF9800)
- Error/Alert (Red #E53935)
- Warning (Orange #FF9800)
- Completed (Green #4CAF50)

Action Icons (16-20px, Navy #003E7E):
- Add/Plus
- Delete/Trash
- Edit/Pencil
- Download
- Upload
- Back/Arrow
- Forward/Arrow
- Refresh
- Save

IMPLEMENTATION APPROACH FOR PHP:

I need:
1. PHP Icons class (app/Constants/Icons.php):
   - Store icon SVG data
   - Color constants
   - Size constants
   - Helper methods to render icons

2. Icon Helper functions (app/Helpers/IconHelper.php):
   - icon() function - render icon with size/color
   - iconButton() function - render clickable icon button
   - statusBadge() function - render status badge with icon
   - Can be used directly in Blade templates

3. Blade template examples:
   - How to use in navigation sidebar
   - How to use in cards (health metrics, appointments)
   - How to use in forms
   - How to use in tables
   - How to use in buttons

4. CSS styling:
   - Icon sizing utilities
   - Icon color utilities
   - Hover/focus states
   - Navigation styling
   - Card styling

5. Accessibility:
   - aria-labels for icon-only buttons
   - Color contrast verification
   - Focus states
   - Screen reader compatibility

DELIVERABLES:

1. PHP Icons.php class with:
   - SVG data for each icon
   - Color palette constants
   - Size constants
   - Helper methods

2. IconHelper.php with functions:
   - icon($name, $size, $color)
   - iconButton($name, $ariaLabel, $color)
   - statusBadge($status)

3. Blade template examples:
   - Sidebar navigation
   - Health metrics card
   - Appointment card
   - Medical records table
   - Search form
   - Form validation with icons

4. CSS file (icons.css or Tailwind config):
   - Icon utilities
   - Button styles
   - Card styles
   - Navigation styles

5. Integration guide:
   - How to register helpers in CodeIgniter
   - How to use in Blade templates
   - How to add new icons
   - Project structure after setup