# BugarKu — Frontend Agent Instructions

> This file is read by OpenCode at the start of every session.
> It is the FRONTEND version. A different person builds the backend.
> Always work on ONE phase at a time, exactly as requested (e.g. "Do Phase 4").

## 1. Your role and scope

You assist the **frontend developer** of BugarKu. Your job is everything the user SEES and TOUCHES:
Blade views, Blade components, Tailwind styling, Alpine.js behaviour, Chart.js charts, and small JS modules.

You do NOT build backend logic. The backend developer owns controllers, services, models, migrations, seeders, policies, form requests, middleware, and tests.

If something you need is missing from the backend (a route, a variable, a table), DO NOT build it. Use dummy data (section 5) and write the need into `docs/backend-requests.md`.

## 2. Product

BugarKu is a fitness and health website for Indonesian beginners. Users enter their body data, get a BMI result, set a goal, pick the equipment they own and any health conditions, then receive rule-based workout recommendations. They create workout programs, run workout sessions with a timer, log body weight, and see progress charts and nutrition targets. Admins manage master data (exercises, equipment, conditions, quotes) and users.

Roles:
- **guest**: landing page, public BMI calculator, register, login.
- **user**: onboarding, dashboard, programs, workout sessions, workout logs, body logs, progress, recommendations, nutrition, profile. Only their OWN data is ever shown.
- **admin**: admin dashboard, CRUD for exercises/equipment/conditions/quotes, user list. Admin never sees users' workout details (privacy).

## 3. Tech stack (do not change without asking)

- Laravel (latest stable, PHP 8.2+) with **Blade** templates and **Laravel Breeze (Blade stack)**
- **Tailwind CSS** (use the version Breeze installed; do not downgrade) + **Alpine.js**
- **Chart.js** (installed with npm) for charts
- **Lucide** icons as inline SVG through a Blade icon component
- **Vite** for assets
- MySQL 8 (backend concern, not yours)

Tailwind setup style depends on version: `tailwind.config.js` for v3, `@theme` in CSS for v4. Check which one is installed before editing.

## 4. Ownership boundaries

### You MAY create or edit
- `resources/views/**` (layouts, components, pages, error pages, auth views)
- `resources/css/**`
- `resources/js/**`
- `public/images/**` (local placeholder images only)
- `tailwind.config.js`, `vite.config.js`, `package.json` (only to add frontend dependencies such as chart.js; Phase 1 and Phase 9)
- `routes/preview.php` (preview routes with dummy data, see section 5)
- `docs/view-contract.md`, `docs/backend-requests.md`, `docs/frontend-checklist.md`

### You MUST NOT edit
- `app/**` (controllers, models, services, policies, requests, middleware)
- `database/**` (migrations, seeders, factories)
- `tests/**` (backend writes PHP tests; you provide manual checklists instead)
- `config/**`, `.env`, `composer.json`, `bootstrap/**`
- `routes/web.php` and `routes/auth.php`, EXCEPT one allowed change: a single include line for `routes/preview.php` (section 5)

If a task seems to require editing a forbidden file, STOP and ask. Do not "just fix it".

## 5. Working without a finished backend (preview + dummy data)

The backend may not be ready when you work. So:

1. Build every page as a Blade view that receives its data through **variables** (props), never by querying the database. No `Model::query()` or `DB::` in Blade files.
2. Create `routes/preview.php` and include it from `routes/web.php` with ONE line, guarded:
   ```php
   if (app()->environment('local')) { require __DIR__.'/preview.php'; }
   ```
3. In `routes/preview.php`, define preview routes under the prefix `/_preview/...` that render each view with hard-coded dummy arrays/objects. Mark them with `// FRONTEND-PREVIEW`. Never use real route names or URLs of the backend (no collisions).
4. Dummy data must look realistic and Indonesian (names, dates, exercises like "Push-up", "Plank", "Jalan Cepat").
5. When the backend controller exists, the real route renders the same view, and the preview route can stay (local only).

Real links and form actions in views should use named routes that follow the route table in section 8. If the named route does not exist yet, use `url('/path')` and note it in `docs/view-contract.md`.

### View contract
Maintain `docs/view-contract.md`. For every page, list: view file, route/URL, variables the view expects (name, type, shape), and form fields it submits (field names). Update it at the end of each phase. This file is what the backend developer reads to wire controllers to your views. If the backend developer's controller sends different variable names, adapt the view to the contract in this file, not the other way around, and update the file.

## 6. Design tokens (must match the Stitch designs in `/design`)

- Primary green `#10B981`, primary dark `#047857`
- Accent orange `#F97316` (CTA, streak)
- Navy `#0F172A` (headings, sidebar, footer)
- Background `#F8FAFC`, cards `#FFFFFF`, muted text `#64748B`
- Success `#22C55E`, warning `#F59E0B`, danger `#EF4444`
- BMI status colors: Kurus = blue, Normal = green, Gemuk = yellow, Obesitas = red
- Fonts: **Poppins** (headings, bold), **Inter** (body)
- Radius: cards 16px, buttons 12px. Soft shadows. Spacing in multiples of 8px.

Design references (screenshots/HTML) are in `/design`, named per page (`landing`, `bmi`, `login`, `onboarding`, `profile`, `dashboard`, `programs-*`, `session`, `progress`, `recommendations`, `nutrition`, `admin-*`). Specs are in `/docs` (including `BugarKu_UI_UX_Spec_untuk_Stitch.md`). ALWAYS look at the matching design file before building a page. Match layout, spacing, colors, and typography.

## 7. Frontend coding conventions

- **Mobile-first** Tailwind classes. Test at 375px, 768px, 1280px.
- All user-facing text in **Indonesian**. Dates in Indonesian format (e.g. "Selasa, 27 Oktober 2026"); the controller passes dates as Carbon, format them with `translatedFormat()`/`isoFormat()` in the view.
- Reusable UI goes into Blade components under `resources/views/components` (`x-button`, `x-input`, etc.). Do not copy-paste the same markup across pages.
- Alpine.js for interactivity (modals, tabs, steppers, dynamic lists, live previews). Keep non-trivial logic (timer, charts) in dedicated modules under `resources/js`, not inline in Blade.
- **Never** inline PHP inside JavaScript. Pass data to JS through `data-*` attributes or a `<script type="application/json">` tag, then read it in the module.
- Every form: `@csrf`, `@method` for PUT/PATCH/DELETE, `old()` values, inline error display with `@error`, and the submit button disabled with a spinner after submit.
- Every list page: an **empty state**, pagination markup (`{{ $items->links() }}`) where relevant, and flash message/toast support.
- Every destructive action uses the confirm-delete modal component.
- Accessibility: a `<label>` for every input, alt text on images, visible focus styles, sufficient color contrast, tap targets at least 44px.
- Images: local placeholders in `public/images` or gradient placeholders with a clear comment where real photos go. **Never hotlink** copyrighted images.
- Icons only through the `x-icon` component (Lucide-style inline SVG).
- Tables are wrapped in `overflow-x-auto`. The page body must never scroll sideways.
- **Disclaimers (mandatory):**
  - Health disclaimer component `x-health-disclaimer` must appear on: BMI result, onboarding conditions step, conditions form in profile, nutrition page, and the footer.
  - BMI note component `x-bmi-note` must appear on every BMI result: "BMI tidak membedakan otot dan lemak. Ini hanya perkiraan awal dan bukan diagnosis."
  - If `/docs` contains exact wording for these texts, use the wording from `/docs`.

## 8. Route table (so you use the right URLs and names)

| URL | Access | Page |
|---|---|---|
| `/` | all | Landing page |
| `/kalkulator-bmi` (GET, POST) | all | Public BMI calculator |
| `/register`, `/login`, `/logout` | guest/auth | Breeze auth |
| `/onboarding` (GET, POST) | user | 4-step wizard |
| `/dashboard` | user | Dashboard |
| `/programs` (resource) | user | Workout plans CRUD |
| `/programs/auto` (POST) | user | Auto program (returns JSON) |
| `/programs/{plan}/session` | user | Workout session + timer |
| `/workout-logs` (resource) | user | Workout history CRUD |
| `/body-logs` (resource) | user | Body weight and BMI CRUD |
| `/progress` | user | Charts and evaluation |
| `/recommendations` | user | Recommended exercises |
| `/nutrition` | user | Calorie target and meal ideas |
| `/profile`, `/profile/goal`, `/profile/equipment`, `/profile/conditions` | user | Profile pages |
| `/admin/*` | admin | Admin panel |

Error pages 403, 404, 419, 500 are Blade views using the guest layout.

## 9. Working rules for the agent

- Work on **ONE phase** at a time, exactly as requested. Do not build features from other phases.
- Before coding, briefly state the plan: which files you will create or change. After coding, summarise what changed in simple Indonesian so the developer can present it.
- Run `npm run build` after each phase and fix errors. (`php artisan test` belongs to the backend; run it only to confirm you broke nothing, and report failures instead of fixing PHP files.)
- Do not delete or rewrite files you were not asked to touch. Make small, targeted edits.
- Ask when a requirement is ambiguous instead of guessing.
- If the page looks different from the design, compare against the design file and fix only the differences.
- Never commit `.env`.
- At the end of each phase, update `docs/view-contract.md` and tick the phase in the progress list (section 11).

---

## 10. Phases (frontend)

Each phase has: prerequisite, tasks, done-when check, commit message. Phases 0, 2, 3 (logic), 6, 14 (logic) and 15 belong to the backend developer.

### Phase 1 — Design system, layouts, Blade components
**Prerequisite:** Breeze is installed (backend Phase 0).

1. Configure Tailwind with the palette (primary, primary-dark, accent, navy, muted, success, warning, danger), fonts (Poppins for headings, Inter for body, via Google Fonts or `@fontsource`), border radius, and soft shadows.
2. Create layouts:
   - `layouts/guest-public.blade.php`: landing and BMI pages; transparent-capable navbar and footer; hamburger menu on mobile.
   - `layouts/auth.blade.php`: split-screen auth layout.
   - `layouts/app.blade.php`: user area; left navy sidebar on desktop, bottom tab bar on mobile, top bar with avatar and logout.
   - `layouts/admin.blade.php`: same as app but with an "Admin" badge and admin menu.
3. Create components in `resources/views/components`: `button` (variants primary, accent, outline, ghost; sizes), `input`, `select`, `textarea`, `number-stepper` (Alpine), `chip` (selectable, supports checkbox/radio), `card`, `stat-card`, `progress-bar`, `progress-ring` (SVG), `modal` (Alpine), `confirm-delete` (modal with form), `toast` (flash messages), `empty-state`, `page-header`, `badge`, `health-disclaimer`, `bmi-note`, and `icon` (Lucide-style inline SVG by name; include: home, dumbbell, activity, user, flame, utensils, target, bar-chart, settings, log-out, plus, pencil, trash, check, x, menu, chevron-right, arrow-up-right, heart, scale, calendar, play, timer, search, eye, eye-off).
4. Create a temporary route `/_ui` in `routes/preview.php` (local only) that shows every component and every variant for visual review.

**Done when:** `npm run build` has no errors; `/_ui` looks tidy at phone and desktop widths.
**Commit:** `feat: design system, layouts and blade components`

### Phase 3 (frontend part) — Auth views and error pages
**Prerequisite:** Phase 1. The backend developer handles middleware, redirects, and tests.

1. Restyle Breeze `login` and `register` views using `layouts/auth`: Indonesian labels (Nama Lengkap, Email, Password, Konfirmasi Password, checkbox terms), password show/hide toggle (Alpine), inline validation errors, design from `/design/login.*` and `/design/register.*`.
2. Create `errors/403`, `404`, `419`, `500` Blade pages using the guest layout, with friendly Indonesian text and a "Kembali ke Beranda" button.
3. Create placeholder `dashboard` and `admin` views ("Halo, {name}") only if the backend asks for them.

**Done when:** login, register, and error pages match the design at 375px and 1280px.
**Commit:** `feat: auth views and error pages`

### Phase 4 — Landing page and BMI calculator (views)
**Prerequisite:** Phase 1. Needs backend `BmiService` for the server-side result; use the preview route until it exists.

1. Landing page at `/`, matching `/design/landing.*` and the landing spec in `/docs`: big rounded hero photo, huge headline, glassmorphism floating card, pill tags, giant watermark text, typographic "SEHAT" section, dashed-border card, chip row, 3-photo program grid, how-it-works, motivation + CTA, footer with disclaimer. Use local placeholder images. The motivation section shows `$quote` (text, author) passed by the controller. CTA buttons go to `/register`. Navbar: "Masuk" and "Daftar Gratis" for guests, "Dashboard" for logged-in users. Hamburger menu on mobile.
2. BMI page at `/kalkulator-bmi`, matching `/design/bmi.*`:
   - Form: gender, age, height (slider + number input), weight (slider + number input).
   - **Live preview with Alpine.js**: calculate BMI in the browser. Thresholds: below 18.5 Kurus; 18.5 to 25.0 Normal; above 25.0 to 27.0 Gemuk; above 27.0 Obesitas. Ideal weight range = BMI 18.5 to 25.0 times height(m)^2.
   - Server-side result section (when `$result` exists): BMI number, category pill with color, 4-zone gauge bar with marker, ideal weight range, advice text, `x-bmi-note`, `x-health-disclaimer`.
   - Guests see a "Daftar untuk Dapat Program Latihan" button. Logged-in users also see "Buat Program dari Hasil Ini". The "Simpan ke Riwayat" button is **hidden** until Phase 9.
   - Validation ranges shown in the UI: height 100 to 250, weight 20 to 300, age 18 to 100; show error messages with `@error`.
3. Fully responsive; check 375px.

**Done when:** both pages match the design on phone and desktop; live preview gives the correct category at boundary values 18.4, 18.5, 25.0, 25.1, 27.0, 27.1.
**Commit:** `feat: landing page and public bmi calculator views`

### Phase 5 — Onboarding wizard and Profile (views)
**Prerequisite:** Phase 1. Backend provides `$equipment`, `$conditions`, and handles the final POST.

1. `/onboarding` single-page wizard with Alpine.js, matching `/design/onboarding.*`. Top stepper with 4 steps; steps shown and hidden client-side; ONE final form POST:
   1. **Data Diri**: birth date, gender, height, weight, activity level (sedentary/light/moderate/active), fitness level (beginner/intermediate/advanced), live BMI preview card.
   2. **Tujuan & Target**: goal type as selectable cards (lose_weight, build_muscle, stamina, maintain), target weight, number of weeks.
   3. **Alat**: multi-select chips from `$equipment` (includes "Tanpa Alat" and "Gym Lengkap").
   4. **Kondisi**: multi-select chips from `$conditions`, a "Tidak ada" option, and `x-health-disclaimer`.
   Per-step client-side checks (required fields) plus server error display after submit. Back/Next buttons, and the final button shows a spinner.
2. `/profile` with a left tab menu (top tabs on mobile), matching `/design/profile.*`: Data Diri, Tujuan & Target, Alat, Kondisi, Akun (change name/email, change password, delete account with confirmation modal). A BMI card with category and a mini history.

**Done when:** the wizard can be completed on a 375px screen; the form field names are written in `docs/view-contract.md`.
**Commit:** `feat: onboarding wizard and profile views`

### Phase 7 — Workout Program CRUD (views)
**Prerequisite:** Phase 1. Needs `RecommendationService` data from the backend; use dummy data until then.

Match `/design/programs-*.*`.
1. **Index**: grid of cards (name, goal tag, level, number of exercises, day chips, equipment icons, kebab menu with Edit/Hapus), search by name, filter by goal, pagination, empty state, delete confirmation modal.
2. **Create/Edit form**: name, goal type, day toggle chips (Sen to Min; submit as `days[]` with values `mon..sun`), notes, and a dynamic "Daftar Latihan" list built with Alpine.js:
   - each row: searchable exercise select (recommended exercises first, option to show all active exercises), sets / reps / rest number steppers, unit label ("repetisi" or "detik"), delete button;
   - "Tambah Latihan" button; reorder with up/down buttons (no drag and drop);
   - field names as `items[0][exercise_id]`, `items[0][sets]`, `items[0][reps]`, `items[0][rest_seconds]`, `items[0][unit]`, and sort order from the index.
   - sticky side card "Rekomendasi untukmu" listing recommended exercises with a "Tambah" button and the recommended scheme text (e.g. "3 set x 8-12 repetisi");
   - "Buat Program Otomatis" button that calls `POST /programs/auto` with `fetch` (CSRF header) and prefills the form from the JSON response; the user can edit before saving.
   - show a **warning** (not an error) when a chosen exercise conflicts with the user's conditions (`conflict` flag from data).
3. **Show page**: program detail with exercise list and a big "Mulai Latihan" button linking to `/programs/{plan}/session` (keep it disabled until Phase 8 is done).

**Done when:** all three pages work with dummy data on a phone and desktop; reorder and add/remove rows work.
**Commit:** `feat: workout plan views`

### Phase 8 — Workout session and history (views)
Match `/design/session.*` and the "Riwayat Latihan" tab of `/design/progress.*`.

1. `/programs/{plan}/session`: a focused, distraction-free page (minimal layout). With Alpine.js:
   - top progress bar "Latihan X dari N";
   - current exercise name and instructions; "Set X dari Y" with tap-to-complete set buttons; target reps (or seconds);
   - circular rest timer that auto-starts after each completed set (uses `rest_seconds`, with "Lewati" and "+15 detik");
   - Previous/Next buttons; seconds countdown for exercises with unit `seconds`;
   - finish modal showing duration, total sets, and a notes textarea; finishing submits a form to `POST /workout-logs` with `workout_plan_id`, `duration_minutes`, `notes`, `completed=1`;
   - big buttons for mobile; `beforeunload` warning when leaving mid-session.
   - Put the timer logic in a dedicated module, e.g. `resources/js/workout-session.js`.
2. `/workout-logs` index: timeline list grouped by month, month filter, edit and delete (with confirmation), pagination, empty state, and a modal form to add a manual log.

**Done when:** a full session can be run on a 375px screen with dummy data, and the rest timer, skip, and +15 detik work.
**Commit:** `feat: workout session and workout log views`

### Phase 9 — Body logs, progress, and charts (views)
Match `/design/progress.*`.

1. Install Chart.js with npm. Create `resources/js/charts.js` that reads data from `data-*` attributes or a JSON script tag (never PHP inside JS). Charts must be responsive and readable at 375px.
2. `/progress` with three Alpine tabs:
   - **Berat Badan**: form card to add an entry (date, weight, note), line chart of weight over time with a dashed target-weight line, paginated table with edit/delete icons and the confirmation modal;
   - **Riwayat Latihan**: link or embed of the workout log list plus a bar chart of workouts per week for the last 8 weeks;
   - **Evaluasi**: card with status badge (Sesuai Target / Perlu Penyesuaian / Data Belum Cukup), the message, a progress ring (percent of weight change achieved), and action buttons "Terapkan" and "Abaikan".
3. Enable the "Simpan ke Riwayat" button on the BMI page for logged-in users (it posts `weight_kg` and `log_date` to `/body-logs`).

**Done when:** charts render with dummy data, are readable at 375px, and the empty state shows when there is no data.
**Commit:** `feat: progress views and charts`

### Phase 10 — User dashboard (views)
Match `/design/dashboard.*`.

Content: greeting with today's date in Indonesian; 4 stat cards (BMI with category color, current weight, streak with flame icon, workouts this week out of planned days); "Program Hari Ini" card (exercises with sets x reps, estimated duration, big "Mulai Latihan" button; empty state with "Buat Program" when none); weight line chart for the last 8 weeks and a goal progress ring; weekly workouts bar chart; "Saran Penyesuaian" card with "Terapkan" and "Abaikan" buttons; a daily quote. Mobile: stat cards 2x2, charts stacked. A brand-new user with no data must render without errors (use empty states everywhere).

**Done when:** the dashboard works with both a full dummy dataset and an empty dataset.
**Commit:** `feat: user dashboard view`

### Phase 11 — Recommendations and Nutrition (views)
Match `/design/recommendations.*` and `/design/nutrition.*`.

1. `/recommendations`: left filter panel (equipment checkboxes, conditions checkboxes, muscle group chips, level, duration), prefilled from the profile and submitted as GET query string. Right grid of exercise cards (name, muscle tag, level tag, equipment, "Aman untuk <kondisi>" badges, "Tambah ke Program" button opening a small modal to pick a plan or create a new one). Banner "Latihan ini sudah disaring sesuai alat dan kondisimu" with a link to the profile. Collapsed section "Disembunyikan" listing excluded exercises with the reason (e.g. "Hindari: Nyeri Lutut" or "Butuh: Dumbbell"). Pagination.
2. `/nutrition`: daily calorie target and macros with circular rings, a plain-language strategy explanation per goal, meal suggestions in 3 tabs (Sarapan, Makan Siang, Makan Malam) using common Indonesian foods, an accordion of tips, and `x-health-disclaimer`. Empty state pointing to the profile when data is missing.

**Done when:** both pages work with dummy data; filters and tabs work on mobile.
**Commit:** `feat: recommendations and nutrition views`

### Phase 12 — Admin panel (views)
Match `/design/admin-*.*`. Use `layouts/admin`.

1. Admin dashboard: stat cards (total users, active users, total exercises, total plans), line chart of new registrations per week (last 8 weeks), table of the 5 latest users.
2. CRUD views for Exercises (fields: name, muscle group, level, category, description, instructions, image upload with preview, is_active, multi-select equipment, multi-select restricted conditions), Equipment, Conditions, and Quotes: paginated tables with search and delete confirmation, plus a form page (or slide-over drawer) per resource. Show an error banner with a "Nonaktifkan" alternative when deleting a used exercise fails.
3. Users page: table (name, email, role badge, status toggle Aktif/Nonaktif, registration date) with search. The status toggle is a PATCH form. Do not show any workout details.

**Done when:** all admin pages work with dummy data on desktop and are usable on a tablet.
**Commit:** `feat: admin panel views`

### Phase 13 — Polish, responsive, accessibility (frontend only)
Do not add new features.

1. Responsive audit of every page at 375px, 768px, 1280px: fix overflow, tiny tap targets (minimum 44px), tables (`overflow-x-auto`), navigation (bottom tab bar on mobile for the user area, hamburger on landing).
2. States audit: submit buttons disable and show a spinner; empty states, error states, and flash messages (toast) work consistently.
3. Accessibility: labels for all inputs, alt text on images, focus styles, color contrast on buttons.
4. Confirm `x-health-disclaimer` and `x-bmi-note` appear in every place listed in section 7.
5. Remove unused components and console errors. Make sure `npm run build` passes.
6. Write `docs/frontend-checklist.md`: a manual QA checklist for guest, user, and admin flows with the pages and states to verify.

**Done when:** no horizontal scroll on any page at 375px; build passes.
**Commit:** `chore: frontend polish, responsive and accessibility fixes`

---

## 11. Progress list (update after each finished phase)

- [x] Phase 1 — Design system, layouts, components
- [ ] Phase 3 — Auth views and error pages
- [ ] Phase 4 — Landing page and BMI calculator
- [ ] Phase 5 — Onboarding and Profile
- [ ] Phase 7 — Workout Program CRUD
- [ ] Phase 8 — Workout session and history
- [ ] Phase 9 — Body logs, progress, charts
- [ ] Phase 10 — User dashboard
- [ ] Phase 11 — Recommendations and Nutrition
- [ ] Phase 12 — Admin panel
- [ ] Phase 13 — Polish, responsive, accessibility

## 12. Useful repair prompts (for the developer to paste)

- `The page /<url> looks different from the design in /design/<file>. Differences: <list>. Fix only these differences without changing logic.`
- `I got this error when running <command>: <full error>. Find the root cause, fix it, and run the command again to confirm. Do not change unrelated files.`
- `Review the code you wrote in this phase for accessibility, responsive problems, and duplicated markup. List problems first, then fix them.`
- `Explain in simple Indonesian how <feature> works, which files are involved, and the request flow, so I can present it.`