<?php
if (empty($_COOKIE['cards_session'])) {
    header('Location: ./');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard • Cards.kuzub.com</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⚙️</text></svg>">
    <style>
        :root {
            --primary: #c8102e;
            --primary-hover: #a50d24;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --border: #e2e8f0;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
            --radius: 10px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }

        body {
            background-color: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar Header */
        header.admin-header {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-brand h1 {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .admin-badge {
            font-size: 0.72rem;
            font-weight: 700;
            background: #fee2e2;
            color: var(--primary);
            padding: 2px 8px;
            border-radius: 999px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-tag {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .user-tag strong {
            color: var(--text-dark);
        }

        /* Buttons */
        button, .btn-link {
            font-size: 0.85rem;
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--text-dark);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
        }

        button:hover, .btn-link:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        button.primary, .btn-link.primary {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        button.primary:hover, .btn-link.primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        button.danger {
            color: var(--danger);
            border-color: #fecaca;
            background: #fff;
        }

        button.danger:hover {
            background: #fef2f2;
            border-color: var(--danger);
        }

        button.sm {
            padding: 4px 8px;
            font-size: 0.78rem;
        }

        /* Main Container */
        main.admin-main {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 24px 20px 48px;
            display: grid;
            gap: 24px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .stat-card .label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .stat-card .val {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        /* Panel Container */
        .panel {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
            overflow: hidden;
        }

        .panel-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .panel-title {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .panel-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 8px 12px 8px 32px;
            font-size: 0.85rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            outline: none;
            width: 220px;
            transition: border-color 0.15s;
        }

        .search-box input:focus {
            border-color: var(--primary);
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.85rem;
            pointer-events: none;
        }

        /* Table */
        .table-wrap {
            overflow-x: auto;
        }

        table.admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.875rem;
        }

        table.admin-table th {
            background: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 18px;
            border-bottom: 1px solid var(--border);
        }

        table.admin-table td {
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        table.admin-table tr:last-child td {
            border-bottom: none;
        }

        table.admin-table tr:hover td {
            background-color: #fcfdfe;
        }

        .collector-col {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .anthony-badge {
            font-size: 0.7rem;
            background: #dbeafe;
            color: #1e40af;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
        }

        .team-pill {
            font-size: 0.75rem;
            background: #f1f5f9;
            color: #334155;
            padding: 3px 8px;
            border-radius: 6px;
            display: inline-block;
        }

        .pass-tag {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            background: #f1f5f9;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 0.82rem;
            letter-spacing: 1px;
            color: #0f172a;
        }

        .email-text {
            color: var(--text-muted);
            font-size: 0.82rem;
        }

        .email-empty {
            color: #94a3b8;
            font-style: italic;
            font-size: 0.82rem;
        }

        .actions-cell {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        /* Modal Dialogs */
        dialog {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            width: min(440px, 94vw);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            margin: auto;
        }

        dialog::backdrop {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(2px);
        }

        dialog form {
            display: grid;
            gap: 14px;
        }

        dialog h3 {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        dialog p.subtext {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        dialog label {
            display: grid;
            gap: 5px;
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
        }

        dialog input, dialog select {
            font-size: 0.95rem;
            padding: 8px 10px;
            border: 1px solid var(--border);
            border-radius: 6px;
            outline: none;
            width: 100%;
        }

        dialog input:focus, dialog select:focus {
            border-color: var(--primary);
        }

        dialog .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            cursor: pointer;
            margin-top: 4px;
        }

        dialog .checkbox-label input[type="checkbox"] {
            width: auto;
        }

        dialog .dialog-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 8px;
        }

        .error-msg {
            color: var(--danger);
            font-size: 0.82rem;
            min-height: 1.2em;
        }

        /* Toast */
        .toast {
            position: fixed;
            left: 50%;
            bottom: 24px;
            transform: translateX(-50%);
            background: #0f172a;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 500;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
            z-index: 100;
        }

        /* Access Denied overlay */
        .access-denied {
            text-align: center;
            padding: 60px 20px;
        }
        .access-denied h2 {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <header class="admin-header">
        <div class="header-brand">
            <h1>🏒 Cards.kuzub.com</h1>
            <span class="admin-badge">Admin Panel</span>
        </div>
        <div class="header-actions">
            <span class="user-tag" id="headerUserTag">Signed in as <strong>Anthony</strong></span>
            <a href="collection.php" class="btn-link">← Back to Collection</a>
            <button type="button" id="adminSignOutBtn">Sign Out</button>
        </div>
    </header>

    <main class="admin-main" id="adminMain">
        <!-- STATS -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="label">Total Collectors</div>
                <div class="val" id="statUsers">0</div>
            </div>
            <div class="stat-card">
                <div class="label">Total Teams</div>
                <div class="val" id="statTeams">0</div>
            </div>
            <div class="stat-card">
                <div class="label">Cards Collected</div>
                <div class="val" id="statCards">0</div>
            </div>
            <div class="stat-card">
                <div class="label">Doubles in Circulation</div>
                <div class="val" id="statDoubles">0</div>
            </div>
        </div>

        <!-- PEOPLE MANAGEMENT PANEL -->
        <div class="panel">
            <div class="panel-header">
                <div class="panel-title">Collectors & People Management</div>
                <div class="panel-controls">
                    <div class="search-box">
                        <span class="search-icon">🔍</span>
                        <input type="text" id="userSearchInput" placeholder="Search name, team, email...">
                    </div>
                    <button type="button" class="primary" id="openAddUserBtn">+ Add Person</button>
                </div>
            </div>

            <div class="table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Collector Name</th>
                            <th>Password (Initials)</th>
                            <th>Email Address</th>
                            <th>Team</th>
                            <th>Cards</th>
                            <th>Doubles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <tr>
                            <td colspan="7" style="text-align:center; padding: 30px; color: var(--text-muted);">Loading collectors...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="toast" id="toast" hidden></div>

    <!-- ADD PERSON MODAL -->
    <dialog id="addUserDialog">
        <form id="addUserForm">
            <h3>+ Add New Person</h3>
            <p class="subtext">Create a collector account directly in the system.</p>

            <label>Collector Name
                <input type="text" id="addUserName" required maxlength="50" placeholder="e.g. Wayne, Anthony, Mark">
            </label>

            <label>Password / Initials
                <input type="text" id="addUserPass" required maxlength="20" placeholder="1-5 letters or password">
            </label>

            <label>Email Address (Optional)
                <input type="email" id="addUserEmail" placeholder="collector@example.com">
            </label>

            <label>Team
                <select id="addUserTeamSelect">
                    <option value="">— No Team (Individual) —</option>
                </select>
            </label>

            <div id="addUserNewTeamRow" hidden>
                <label>New Team Name
                    <input type="text" id="addUserNewTeamInput" maxlength="50" placeholder="Enter new team name">
                </label>
            </div>

            <label class="checkbox-label">
                <input type="checkbox" id="addUserIsAdmin">
                Grant Admin Privileges
            </label>

            <div class="error-msg" id="addUserError"></div>

            <div class="dialog-actions">
                <button type="button" id="cancelAddUserBtn">Cancel</button>
                <button type="submit" class="primary">Add Person</button>
            </div>
        </form>
    </dialog>

    <!-- EDIT PERSON MODAL -->
    <dialog id="editUserDialog">
        <form id="editUserForm">
            <h3>✏️ Edit Person</h3>
            <p class="subtext" id="editUserSubtitle">Update collector details, password, and email.</p>
            <input type="hidden" id="editUserId">

            <label>Collector Name
                <input type="text" id="editUserName" required maxlength="50">
            </label>

            <label>Change Password (leave blank to keep current)
                <input type="text" id="editUserPass" maxlength="20" placeholder="Enter new password/initials">
            </label>

            <label>Email Address
                <input type="email" id="editUserEmail" placeholder="collector@example.com">
            </label>

            <label>Team
                <select id="editUserTeamSelect">
                    <option value="">— No Team (Individual) —</option>
                </select>
            </label>

            <div id="editUserNewTeamRow" hidden>
                <label>New Team Name
                    <input type="text" id="editUserNewTeamInput" maxlength="50" placeholder="Enter new team name">
                </label>
            </div>

            <label class="checkbox-label" id="editUserAdminRow">
                <input type="checkbox" id="editUserIsAdmin">
                Admin Privileges
            </label>

            <div class="error-msg" id="editUserError"></div>

            <div class="dialog-actions">
                <button type="button" id="cancelEditUserBtn">Cancel</button>
                <button type="submit" class="primary">Save Changes</button>
            </div>
        </form>
    </dialog>

    <!-- RESET / EDIT EMAIL MODAL -->
    <dialog id="emailDialog">
        <form id="emailForm">
            <h3>✉️ Reset / Update Email</h3>
            <p class="subtext" id="emailUserSubtext">Manage email address for this collector.</p>
            <input type="hidden" id="emailUserId">

            <label>Email Address
                <input type="email" id="emailInput" placeholder="collector@example.com">
            </label>

            <div class="error-msg" id="emailError"></div>

            <div class="dialog-actions">
                <button type="button" id="clearEmailBtn" class="danger">Clear Email</button>
                <button type="button" id="cancelEmailBtn">Cancel</button>
                <button type="submit" class="primary">Save Email</button>
            </div>
        </form>
    </dialog>

    <!-- CHANGE PASSWORD MODAL -->
    <dialog id="passwordDialog">
        <form id="passwordForm">
            <h3>🔑 Change Password</h3>
            <p class="subtext" id="passwordUserSubtext">Update password/initials for this collector.</p>
            <input type="hidden" id="passwordUserId">

            <label>New Password / Initials
                <input type="text" id="passwordInput" required maxlength="20" placeholder="Enter new password">
            </label>

            <div class="error-msg" id="passwordError"></div>

            <div class="dialog-actions">
                <button type="button" id="cancelPasswordBtn">Cancel</button>
                <button type="submit" class="primary">Update Password</button>
            </div>
        </form>
    </dialog>

    <!-- DELETE CONFIRMATION MODAL -->
    <dialog id="deleteUserDialog">
        <form id="deleteUserForm">
            <h3 style="color: var(--danger);">🗑️ Remove Collector</h3>
            <p class="subtext" id="deleteUserWarning">Are you sure you want to remove this collector?</p>
            <p style="font-size: 0.85rem; color: #475569; margin-bottom: 8px;">
                This will delete their account and remove their card collection. This action cannot be undone.
            </p>
            <input type="hidden" id="deleteUserId">

            <div class="error-msg" id="deleteUserError"></div>

            <div class="dialog-actions">
                <button type="button" id="cancelDeleteUserBtn">Cancel</button>
                <button type="submit" class="danger">Yes, Remove Collector</button>
            </div>
        </form>
    </dialog>

    <script>
        const state = {
            currentUser: null,
            users: [],
            teams: [],
            stats: null,
            searchQuery: '',
        };

        function esc(s) {
            return String(s ?? '').replace(/[&<>"']/g, c => ({'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'}[c]));
        }

        let toastTimer;
        function toast(msg) {
            const el = document.getElementById('toast');
            el.textContent = msg;
            el.hidden = false;
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => el.hidden = true, 3400);
        }

        async function api(action, params = {}, body = null) {
            const query = new URLSearchParams({ action, ...params });
            const headers = {};
            if (body) headers['Content-Type'] = 'application/json';

            const token = localStorage.getItem('cards_session_token');
            if (token) headers['X-Session-Token'] = token;

            const opts = { method: body ? 'POST' : 'GET', headers };
            if (body) opts.body = JSON.stringify(body);

            const res = await fetch(`api.php?${query}`, opts);
            const data = await res.json();
            if (data && data.error) throw new Error(data.error);
            return data;
        }

        // Initialize Admin Page
        async function init() {
            try {
                const me = await api('me');
                if (!me) {
                    window.location.replace('./');
                    return;
                }

                const isAdmin = Boolean(me.is_admin || (me.collector_name && me.collector_name.toUpperCase() === 'ANTHONY'));
                if (!isAdmin) {
                    document.getElementById('adminMain').innerHTML = `
                        <div class="panel access-denied">
                            <h2>Access Denied</h2>
                            <p>You must be signed in as administrator Anthony to view this page.</p>
                            <div style="margin-top: 16px;"><a href="collection.php" class="btn-link primary">Return to Collection</a></div>
                        </div>
                    `;
                    return;
                }

                state.currentUser = me;
                document.getElementById('headerUserTag').innerHTML = `Signed in as <strong>${esc(me.collector_name)}</strong> (Admin)`;

                await Promise.all([loadStats(), loadTeams(), loadUsers()]);
            } catch (err) {
                console.error(err);
                toast(err.message);
            }
        }

        async function loadStats() {
            try {
                const data = await api('admin_get_stats');
                state.stats = data;
                document.getElementById('statUsers').textContent = data.users ?? 0;
                document.getElementById('statTeams').textContent = data.teams ?? 0;
                document.getElementById('statCards').textContent = data.cards ?? 0;
                document.getElementById('statDoubles').textContent = data.doubles ?? 0;
            } catch (err) {
                console.error('Failed to load stats:', err);
            }
        }

        async function loadTeams() {
            try {
                const data = await api('get_teams');
                state.teams = data || [];
                populateTeamSelect(document.getElementById('addUserTeamSelect'));
                populateTeamSelect(document.getElementById('editUserTeamSelect'));
            } catch (err) {
                console.error('Failed to load teams:', err);
            }
        }

        function populateTeamSelect(selectEl, selectedVal = '') {
            if (!selectEl) return;
            let html = '<option value="">— No Team (Individual) —</option>';
            for (const t of state.teams) {
                const isSel = (selectedVal && (selectedVal.toLowerCase() === t.name.toLowerCase() || String(selectedVal) === String(t.id))) ? 'selected' : '';
                html += `<option value="${esc(t.name)}" ${isSel}>Team ${esc(t.name)}</option>`;
            }
            html += '<option value="__new__">+ Create New Team...</option>';
            selectEl.innerHTML = html;
        }

        async function loadUsers() {
            try {
                const data = await api('admin_get_users');
                state.users = data || [];
                renderUsersTable();
            } catch (err) {
                toast('Failed to load users: ' + err.message);
            }
        }

        function renderUsersTable() {
            const tbody = document.getElementById('usersTableBody');
            const q = state.searchQuery.toLowerCase().trim();

            const filtered = state.users.filter(u => {
                if (!q) return true;
                return (u.collector_name || '').toLowerCase().includes(q)
                    || (u.team_name || '').toLowerCase().includes(q)
                    || (u.email || '').toLowerCase().includes(q)
                    || (u.password || '').toLowerCase().includes(q);
            });

            if (filtered.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding: 24px; color: var(--text-muted);">No collectors found matching "${esc(q)}".</td></tr>`;
                return;
            }

            tbody.innerHTML = filtered.map(u => {
                const isAnthony = (u.collector_name || '').toUpperCase() === 'ANTHONY';
                const isSelf = state.currentUser && state.currentUser.id === u.id;
                const emailHtml = u.email
                    ? `<span class="email-text">${esc(u.email)}</span>`
                    : `<span class="email-empty">None</span>`;

                return `
                    <tr data-id="${u.id}">
                        <td>
                            <div class="collector-col">
                                <span>${esc(u.collector_name)}</span>
                                ${isAnthony ? '<span class="anthony-badge">Admin ★</span>' : u.is_admin ? '<span class="anthony-badge">Admin</span>' : ''}
                            </div>
                        </td>
                        <td>
                            <span class="pass-tag">${esc(u.password)}</span>
                        </td>
                        <td>
                            <div style="display:flex; align-items:center; gap:6px;">
                                ${emailHtml}
                                <button type="button" class="sm" onclick="openResetEmail(${u.id})" title="Reset or change email">✉️</button>
                            </div>
                        </td>
                        <td>
                            ${u.team_name ? `<span class="team-pill">Team ${esc(u.team_name)}</span>` : '<span style="color:#94a3b8; font-size:0.8rem;">—</span>'}
                        </td>
                        <td><a href="collection.php?view=${u.id}&admin_tinker=1" style="color:var(--text-dark); text-decoration:underline; font-weight:700;" title="Tinker with ${esc(u.collector_name)}'s collection"><strong>${u.cards_collected ?? 0}</strong></a></td>
                        <td><a href="collection.php?view=${u.id}&admin_tinker=1" style="color:#f57f17; font-weight:700; text-decoration:underline;" title="Tinker with ${esc(u.collector_name)}'s doubles">${u.doubles_count ?? 0}</a></td>
                        <td>
                            <div class="actions-cell">
                                <a href="collection.php?view=${u.id}&admin_tinker=1" class="btn-link sm" style="background:#0284c7; color:#fff; border-color:#0284c7; font-weight:700;" title="Go in and tinker with ${esc(u.collector_name)}'s collection as Admin">🃏 Tinker</a>
                                <button type="button" class="sm" onclick="openEditUser(${u.id})" title="Edit person, password, email">✏️ Edit</button>
                                <button type="button" class="sm" onclick="openChangePassword(${u.id})" title="Change password">🔑 Password</button>
                                ${(!isAnthony && !isSelf) ? `<button type="button" class="sm danger" onclick="openDeleteUser(${u.id})" title="Remove person">🗑️ Delete</button>` : ''}
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Search watcher
        document.getElementById('userSearchInput').addEventListener('input', e => {
            state.searchQuery = e.target.value;
            renderUsersTable();
        });

        // Team Dropdown + New Team toggles
        function setupTeamToggle(selectEl, rowEl, inputEl) {
            selectEl.addEventListener('change', () => {
                if (selectEl.value === '__new__') {
                    rowEl.hidden = false;
                    inputEl.required = true;
                    inputEl.focus();
                } else {
                    rowEl.hidden = true;
                    inputEl.required = false;
                }
            });
        }
        setupTeamToggle(
            document.getElementById('addUserTeamSelect'),
            document.getElementById('addUserNewTeamRow'),
            document.getElementById('addUserNewTeamInput')
        );
        setupTeamToggle(
            document.getElementById('editUserTeamSelect'),
            document.getElementById('editUserNewTeamRow'),
            document.getElementById('editUserNewTeamInput')
        );

        // ADD PERSON
        const addUserDialog = document.getElementById('addUserDialog');
        const addUserForm = document.getElementById('addUserForm');
        document.getElementById('openAddUserBtn').addEventListener('click', () => {
            addUserForm.reset();
            populateTeamSelect(document.getElementById('addUserTeamSelect'));
            document.getElementById('addUserNewTeamRow').hidden = true;
            document.getElementById('addUserError').textContent = '';
            addUserDialog.showModal();
        });
        document.getElementById('cancelAddUserBtn').addEventListener('click', () => addUserDialog.close());
        addUserForm.addEventListener('submit', async e => {
            e.preventDefault();
            const errEl = document.getElementById('addUserError');
            errEl.textContent = '';

            const name = document.getElementById('addUserName').value.trim();
            const pass = document.getElementById('addUserPass').value.trim();
            const email = document.getElementById('addUserEmail').value.trim();
            const teamSel = document.getElementById('addUserTeamSelect').value;
            const newTeam = document.getElementById('addUserNewTeamInput').value.trim();
            const isAdmin = document.getElementById('addUserIsAdmin').checked;
            const team = teamSel === '__new__' ? newTeam : teamSel;

            try {
                await api('admin_add_user', {}, {
                    collector_name: name,
                    password: pass,
                    email: email,
                    team_name: team,
                    is_admin: isAdmin ? 1 : 0
                });
                addUserDialog.close();
                toast(`Added collector ${name}!`);
                await Promise.all([loadStats(), loadTeams(), loadUsers()]);
            } catch (err) {
                errEl.textContent = err.message;
            }
        });

        // EDIT PERSON
        const editUserDialog = document.getElementById('editUserDialog');
        const editUserForm = document.getElementById('editUserForm');
        window.openEditUser = function(id) {
            const u = state.users.find(x => x.id === id);
            if (!u) return;
            editUserForm.reset();
            document.getElementById('editUserId').value = u.id;
            document.getElementById('editUserName').value = u.collector_name;
            document.getElementById('editUserPass').value = '';
            document.getElementById('editUserPass').placeholder = `Current: ${u.password} (or enter new)`;
            document.getElementById('editUserEmail').value = u.email || '';
            populateTeamSelect(document.getElementById('editUserTeamSelect'), u.team_name || '');
            document.getElementById('editUserNewTeamRow').hidden = true;

            const isAnthony = (u.collector_name || '').toUpperCase() === 'ANTHONY';
            const adminBox = document.getElementById('editUserIsAdmin');
            adminBox.checked = Boolean(u.is_admin || isAnthony);
            adminBox.disabled = isAnthony; // Anthony cannot be revoked

            document.getElementById('editUserError').textContent = '';
            editUserDialog.showModal();
        };
        document.getElementById('cancelEditUserBtn').addEventListener('click', () => editUserDialog.close());
        editUserForm.addEventListener('submit', async e => {
            e.preventDefault();
            const errEl = document.getElementById('editUserError');
            errEl.textContent = '';

            const id = Number(document.getElementById('editUserId').value);
            const name = document.getElementById('editUserName').value.trim();
            const pass = document.getElementById('editUserPass').value.trim();
            const email = document.getElementById('editUserEmail').value.trim();
            const teamSel = document.getElementById('editUserTeamSelect').value;
            const newTeam = document.getElementById('editUserNewTeamInput').value.trim();
            const isAdmin = document.getElementById('editUserIsAdmin').checked;
            const team = teamSel === '__new__' ? newTeam : teamSel;

            try {
                await api('admin_update_user', {}, {
                    id: id,
                    collector_name: name,
                    password: pass,
                    email: email,
                    team_name: team,
                    is_admin: isAdmin ? 1 : 0
                });
                editUserDialog.close();
                toast(`Updated ${name}!`);
                await Promise.all([loadStats(), loadTeams(), loadUsers()]);
            } catch (err) {
                errEl.textContent = err.message;
            }
        });

        // RESET / EDIT EMAIL
        const emailDialog = document.getElementById('emailDialog');
        const emailForm = document.getElementById('emailForm');
        window.openResetEmail = function(id) {
            const u = state.users.find(x => x.id === id);
            if (!u) return;
            document.getElementById('emailUserId').value = u.id;
            document.getElementById('emailUserSubtext').textContent = `Set or clear email address for ${u.collector_name}.`;
            document.getElementById('emailInput').value = u.email || '';
            document.getElementById('emailError').textContent = '';
            emailDialog.showModal();
        };
        document.getElementById('cancelEmailBtn').addEventListener('click', () => emailDialog.close());
        document.getElementById('clearEmailBtn').addEventListener('click', async () => {
            const id = Number(document.getElementById('emailUserId').value);
            try {
                await api('admin_reset_email', {}, { id: id, email: '' });
                emailDialog.close();
                toast('Email cleared!');
                await loadUsers();
            } catch (err) {
                document.getElementById('emailError').textContent = err.message;
            }
        });
        emailForm.addEventListener('submit', async e => {
            e.preventDefault();
            const id = Number(document.getElementById('emailUserId').value);
            const email = document.getElementById('emailInput').value.trim();
            try {
                await api('admin_reset_email', {}, { id: id, email: email });
                emailDialog.close();
                toast('Email updated!');
                await loadUsers();
            } catch (err) {
                document.getElementById('emailError').textContent = err.message;
            }
        });

        // CHANGE PASSWORD DIRECTLY
        const passwordDialog = document.getElementById('passwordDialog');
        const passwordForm = document.getElementById('passwordForm');
        window.openChangePassword = function(id) {
            const u = state.users.find(x => x.id === id);
            if (!u) return;
            document.getElementById('passwordUserId').value = u.id;
            document.getElementById('passwordUserSubtext').textContent = `Change password for ${u.collector_name} (Current: ${u.password}).`;
            document.getElementById('passwordInput').value = '';
            document.getElementById('passwordError').textContent = '';
            passwordDialog.showModal();
        };
        document.getElementById('cancelPasswordBtn').addEventListener('click', () => passwordDialog.close());
        passwordForm.addEventListener('submit', async e => {
            e.preventDefault();
            const id = Number(document.getElementById('passwordUserId').value);
            const pass = document.getElementById('passwordInput').value.trim();
            try {
                await api('admin_change_password', {}, { id: id, password: pass });
                passwordDialog.close();
                toast('Password updated successfully!');
                await loadUsers();
            } catch (err) {
                document.getElementById('passwordError').textContent = err.message;
            }
        });

        // DELETE PERSON
        const deleteUserDialog = document.getElementById('deleteUserDialog');
        const deleteUserForm = document.getElementById('deleteUserForm');
        window.openDeleteUser = function(id) {
            const u = state.users.find(x => x.id === id);
            if (!u) return;
            document.getElementById('deleteUserId').value = u.id;
            document.getElementById('deleteUserWarning').textContent = `Are you sure you want to remove ${u.collector_name}?`;
            document.getElementById('deleteUserError').textContent = '';
            deleteUserDialog.showModal();
        };
        document.getElementById('cancelDeleteUserBtn').addEventListener('click', () => deleteUserDialog.close());
        deleteUserForm.addEventListener('submit', async e => {
            e.preventDefault();
            const id = Number(document.getElementById('deleteUserId').value);
            try {
                await api('admin_delete_user', {}, { id: id });
                deleteUserDialog.close();
                toast('Collector removed.');
                await Promise.all([loadStats(), loadTeams(), loadUsers()]);
            } catch (err) {
                document.getElementById('deleteUserError').textContent = err.message;
            }
        });

        // Sign Out
        document.getElementById('adminSignOutBtn').addEventListener('click', async () => {
            try {
                await api('logout', {}, {});
            } catch (_) {}
            localStorage.removeItem('cards_session_token');
            document.cookie = 'cards_session=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            window.location.replace('./');
        });

        // Close dialogs when clicking backdrop
        [addUserDialog, editUserDialog, emailDialog, passwordDialog, deleteUserDialog].forEach(d => {
            d.addEventListener('click', e => {
                if (e.target === d) d.close();
            });
        });

        init();
    </script>
</body>
</html>
