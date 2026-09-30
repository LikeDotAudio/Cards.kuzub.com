<?php
// If already logged in, redirect immediately to collection
if (!empty($_COOKIE['cards_session'])) {
    header('Location: collection.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In • Cards.kuzub.com</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏒</text></svg>">
    <style>
        :root {
            --primary: #c8102e;
            --primary-hover: #a50d24;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --border: #e2e8f0;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --input-border: #cbd5e1;
            --radius: 14px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }

        body {
            background-color: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: var(--card-bg);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            padding: 32px 28px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-brand {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 4px;
        }

        .login-subtitle {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .series-banner {
            border: 1px solid #fed7aa;
            background: #fff;
            border-radius: 10px;
            padding: 8px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .series-banner-name {
            font-size: 0.88rem;
            font-weight: 700;
            color: #1e293b;
        }

        .series-banner-price {
            font-size: 0.76rem;
            font-weight: 700;
            background: #fee2e2;
            color: var(--primary);
            border-radius: 20px;
            padding: 3px 10px;
        }

        .divider {
            border-top: 1px solid #f1f5f9;
            margin: 20px 0 20px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .login-form label {
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-size: 0.84rem;
            font-weight: 600;
            color: #334155;
            text-align: left;
        }

        .login-form select,
        .login-form input {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid var(--input-border);
            font-size: 0.95rem;
            background: #fff;
            color: #0f172a;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            width: 100%;
        }

        .login-form select:focus,
        .login-form input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.15);
        }

        .error {
            color: #dc2626;
            font-size: 0.83rem;
            font-weight: 600;
            text-align: center;
            min-height: 18px;
        }

        .submit-btn {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s, transform 0.05s;
            width: 100%;
            margin-top: 4px;
        }

        .submit-btn:hover {
            background: var(--primary-hover);
        }

        .submit-btn:active {
            transform: scale(0.99);
        }

        .login-footer-hint {
            font-size: 0.78rem;
            color: var(--text-muted);
            text-align: center;
            line-height: 1.5;
            margin-top: 14px;
        }

        .login-footer-hint strong {
            color: #334155;
        }

        #toast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            background: #1e293b;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 0.88rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <div class="login-brand">🏒 Cards.kuzub.com</div>
        <div class="login-subtitle">Hockey Card Checklist & Team Tracker</div>
        <div class="series-banner">
            <span class="series-banner-name">2026-27 UD Tim Hortons</span>
            <span class="series-banner-price">$1 per account</span>
        </div>
    </div>

    <div class="divider"></div>

    <form class="login-form" id="loginForm">
        <!-- Selector to pick an existing collector (e.g. Bronzo) or create a new one -->
        <label>Select Collector
            <select id="collectorSelect">
                <option value="">— Loading collectors... —</option>
            </select>
        </label>

        <!-- New Collector Name input (visible when + Create New Collector is chosen) -->
        <div id="newCollectorRow" hidden>
            <label>New Collector Name
                <input name="collector_name" id="collectorName" maxlength="50" minlength="2" placeholder="e.g. Anthony" autocomplete="username">
            </label>
        </div>

        <label>Team Name (e.g. Hawks, Flames — optional)
            <input name="team_name" id="teamName" maxlength="50" placeholder="e.g. Hawks" autocomplete="organization">
        </label>

        <label>Password (your initials or team code)
            <input name="password" id="password" type="password" maxlength="5" required placeholder="••••" autocomplete="current-password">
        </label>

        <div class="error" id="formError"></div>

        <button type="submit" class="submit-btn" id="submitBtn">Enter Checklist →</button>

        <div class="login-footer-hint">
            Have an existing account? Select your name and enter your password or initials.<br>
            New here? Select <strong>+ Create New Collector</strong> to register!
        </div>
    </form>
</div>

<div id="toast" hidden></div>

<script>
    let usersList = [];

    function esc(s) {
        return String(s ?? '').replace(/[&<>"']/g, c => ({'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'}[c]));
    }

    let toastTimer;
    function toast(message) {
        const el = document.getElementById('toast');
        el.textContent = message;
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

        const response = await fetch(`api.php?${query}`, opts);
        const data = await response.json();
        if (data && data.error) throw new Error(data.error);
        if (data && data.token) {
            localStorage.setItem('cards_session_token', data.token);
        }
        return data;
    }

    async function init() {
        try {
            // If already signed in, go directly to collection
            const me = await api('me').catch(() => null);
            if (me) {
                window.location.replace('collection.php');
                return;
            }

            usersList = await api('get_users').catch(() => []);
            populateCollectorSelect();
        } catch (err) {
            console.error(err);
            populateCollectorSelect();
        }
    }

    function populateCollectorSelect() {
        const select = document.getElementById('collectorSelect');
        let html = '<option value="">— Select an existing collector —</option>';

        if (usersList && usersList.length > 0) {
            for (const u of usersList) {
                const teamLabel = u.team_name ? ` (Team ${esc(u.team_name)})` : '';
                html += `<option value="${u.id}">${esc(u.collector_name)}${teamLabel}</option>`;
            }
        }
        html += '<option value="new">+ Create New Collector</option>';
        select.innerHTML = html;

        // Default to Bronzo if present, or first user
        if (usersList && usersList.length > 0) {
            const bronzo = usersList.find(u => u.collector_name.toLowerCase() === 'bronzo');
            const target = bronzo || usersList[0];
            select.value = String(target.id);
            const teamInput = document.getElementById('teamName');
            if (teamInput && target.team_name) {
                teamInput.value = target.team_name;
            }
        }
    }

    // Toggle + Create New Collector row
    document.getElementById('collectorSelect').addEventListener('change', e => {
        const val = e.target.value;
        const newRow = document.getElementById('newCollectorRow');
        const nameInput = document.getElementById('collectorName');
        const teamInput = document.getElementById('teamName');
        const submitBtn = document.getElementById('submitBtn');

        if (val === 'new') {
            newRow.hidden = false;
            nameInput.required = true;
            nameInput.value = '';
            teamInput.value = '';
            nameInput.focus();
            submitBtn.textContent = 'Register & Enter Checklist →';
        } else {
            newRow.hidden = true;
            nameInput.required = false;
            submitBtn.textContent = 'Enter Checklist →';
            if (val) {
                const sel = usersList.find(u => u.id === Number(val));
                teamInput.value = sel?.team_name || '';
            } else {
                teamInput.value = '';
            }
        }
    });

    // Form Submission
    document.getElementById('loginForm').addEventListener('submit', async e => {
        e.preventDefault();
        const select = document.getElementById('collectorSelect');
        const isNew = select.value === 'new';
        const password = document.getElementById('password').value.trim();
        const teamName = document.getElementById('teamName').value.trim();
        const errorEl = document.getElementById('formError');
        const submitBtn = document.getElementById('submitBtn');
        errorEl.textContent = '';

        if (!select.value) {
            errorEl.textContent = 'Please select a collector or create a new one';
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Verifying...';

        try {
            if (isNew) {
                const name = document.getElementById('collectorName').value.trim();
                if (!name) {
                    errorEl.textContent = 'Please enter your collector name';
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Register & Enter Checklist →';
                    return;
                }
                const isFreeCheat = password.toUpperCase() === 'HAWK';
                await api('create_user', {}, {
                    collector_name: name,
                    team_name: teamName,
                    password: password,
                    discount_code: password,
                    paid: !isFreeCheat
                });
            } else {
                const userId = Number(select.value);
                await api('login', {}, {
                    user_id: userId,
                    password: password,
                    team_name: teamName
                });
            }

            // Successfully authenticated -> redirect to collection!
            window.location.href = 'collection.php';
        } catch (err) {
            errorEl.textContent = err.message;
            submitBtn.disabled = false;
            submitBtn.textContent = isNew ? 'Register & Enter Checklist →' : 'Enter Checklist →';
        }
    });

    init();
</script>
</body>
</html>
