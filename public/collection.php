<?php
// Open access: strangers can view Bronzo's collection openly without logging in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2026-27 UD Tim Hortons Hockey Checklist & Team Tracker</title>
    <style>
        :root {
            --bg-color: #f7f9fa;
            --surface-color: #ffffff;
            --text-color: #1e293b;
            --muted: #64748b;
            --primary: #c8102e;
            --primary-hover: #a50d25;
            --primary-light: #fee2e2;
            --row-single: #e8f5e9;
            --row-single-edge: #81c784;
            --row-double: #fff9c4;
            --row-double-edge: #fbc02d;
            --trade: #1565c0;
            --team-accent: #0284c7;
            --team-light: #e0f2fe;
            --border-color: #e2e8f0;
            --left-bar-width: 250px;
            --right-bar-width: 280px;
            --sidebar-width: 250px;
            --vu-bg: #090d16;
            --vu-green: #22c55e;
            --vu-yellow: #fbbf24;
            --vu-red: #ef4444;
            --vu-blue: #38bdf8;
            --topbar-height: 53px;
            --ifs-height: 48px;
            --footer-height: 114px;
        }
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            font-size: 14px;
        }

        /* Full-screen Login Gate */
        #loginGate {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: radial-gradient(circle at 50% 20%, #ffffff 0%, #eef2f6 100%);
        }
        .gate-card {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 460px;
            overflow: hidden;
        }
        .gate-header {
            padding: 24px 24px 16px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            background: #fafbfc;
        }
        .gate-brand {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .gate-subtitle {
            font-size: 0.82rem;
            color: var(--muted);
            margin-top: 4px;
        }
        .gate-series-banner {
            margin-top: 14px;
            padding: 10px 12px;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .gate-series-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text-color);
        }
        .gate-series-price {
            font-size: 0.78rem;
            font-weight: 700;
            color: #b91c1c;
            background: var(--primary-light);
            padding: 3px 8px;
            border-radius: 999px;
        }
        .cheat-callout {
            margin: 16px 24px 0;
            padding: 12px 14px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            font-size: 0.8rem;
            line-height: 1.45;
            color: #1e40af;
        }
        .cheat-callout strong { color: #1d4ed8; }
        .cheat-badge {
            display: inline-block;
            background: #2563eb;
            color: #fff;
            padding: 1px 6px;
            border-radius: 4px;
            font-weight: 700;
            letter-spacing: 0.05em;
        }
        .gate-form {
            padding: 20px 24px 24px;
            display: grid;
            gap: 14px;
        }
        .gate-form label {
            display: grid;
            gap: 5px;
            font-size: 0.82rem;
            font-weight: 600;
            color: #475569;
        }
        .gate-form input, .gate-form select {
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 0.95rem;
            background: #fff;
            color: var(--text-color);
        }
        .gate-form input:focus, .gate-form select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.15);
        }
        .gate-form button.cta {
            padding: 11px 16px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.15s;
            margin-top: 4px;
        }
        .gate-form button.cta:hover { background: var(--primary-hover); }
        .gate-footer-hint {
            font-size: 0.76rem;
            color: var(--muted);
            text-align: center;
            line-height: 1.4;
        }

        /* Gate Tabs & Registration UI */
        .gate-tabs {
            display: flex;
            background: #f1f5f9;
            border-bottom: 1px solid var(--border-color);
        }
        .gate-tab {
            flex: 1;
            padding: 12px 14px;
            background: transparent;
            border: none;
            border-bottom: 2px solid transparent;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--muted);
            cursor: pointer;
            transition: all 0.15s;
        }
        .gate-tab:hover {
            color: var(--text-color);
            background: rgba(255,255,255,0.5);
        }
        .gate-tab.active {
            color: var(--primary);
            background: #fff;
            border-bottom: 2px solid var(--primary);
        }
        .pricing-box {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 11px 13px;
            display: grid;
            gap: 8px;
        }
        .pricing-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-color);
        }
        .pricing-amount {
            font-size: 1.05rem;
            font-weight: 800;
            color: #b91c1c;
        }
        .pricing-amount.is-free {
            color: #15803d;
        }
        .discount-status-pill {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.76rem;
            font-weight: 600;
            padding: 5px 8px;
            border-radius: 6px;
            line-height: 1.3;
        }
        .discount-status-pill.free {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .discount-status-pill.standard {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }
        .gate-toggle-link {
            text-align: center;
            font-size: 0.8rem;
            color: var(--muted);
            margin-top: 4px;
        }
        .gate-toggle-link a {
            color: #2563eb;
            text-decoration: underline;
            cursor: pointer;
            font-weight: 600;
        }

        /* App Layout */
        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Fixed Left Bar ("the left we call it the left bar - remain fixed all the time") */
        aside.sidebar,
        aside.left-bar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: var(--footer-height, 68px);
            width: var(--left-bar-width);
            flex-shrink: 0;
            background: #ffffff;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            z-index: 30;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 16px 18px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sidebar-brand h2 {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .close-sidebar-btn {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.2rem;
            color: var(--muted);
            cursor: pointer;
            padding: 4px;
        }
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .menu-section-title {
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--muted);
            padding: 0 8px 6px;
        }
        .menu-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .menu-item {
            padding: 8px 10px;
            border-radius: 6px;
            text-decoration: none;
            color: var(--text-color);
            display: block;
            border: 1px solid transparent;
            cursor: pointer;
        }
        .menu-item.active {
            background: #fef2f2;
            border-color: #fecaca;
        }
        .menu-item.active .menu-series-name {
            font-weight: 700;
            color: var(--primary);
        }
        .menu-item.disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .menu-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }
        .menu-series-name {
            font-size: 0.88rem;
            font-weight: 600;
        }
        .menu-badge {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 999px;
            background: var(--primary-light);
            color: var(--primary);
            white-space: nowrap;
        }
        .menu-badge.badge-free {
            background: #dbeafe;
            color: #1d4ed8;
        }
        .menu-badge.muted {
            background: #f1f5f9;
            color: #64748b;
        }
        .menu-subtext {
            font-size: 0.73rem;
            color: var(--muted);
            margin-top: 3px;
        }

        /* Team Hub in Sidebar */
        .team-hub {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
        }
        .team-hub-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .team-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .team-progress-bar {
            height: 7px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            margin: 6px 0;
        }
        .team-progress-bar > div {
            height: 100%;
            background: #0284c7;
            transition: width 0.3s;
        }
        .team-progress-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--muted);
            margin-bottom: 10px;
        }
        .view-team-btn {
            width: 100%;
            padding: 6px 10px;
            background: #0284c7;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .view-team-btn:hover { background: #0369a1; }
        .teammates-list-title {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 6px;
        }
        .teammates-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
            max-height: 180px;
            overflow-y: auto;
        }
        .teammate-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 8px;
            border-radius: 4px;
            font-size: 0.78rem;
            cursor: pointer;
            border: 1px solid transparent;
            background: #fff;
        }
        .teammate-row:hover {
            border-color: #cbd5e1;
            background: #f1f5f9;
        }
        .teammate-row.active {
            border-color: #0284c7;
            background: var(--team-light);
            font-weight: 700;
        }
        .teammate-count {
            font-size: 0.72rem;
            color: var(--muted);
        }

        /* Sidebar Footer (Rotating Stats & Compact User Strip) */
        .sidebar-footer {
            padding: 10px 12px 14px;
            border-top: 1px solid var(--border-color);
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* L-Bar Rotating Stats Corner Widget */
        .side-rotating-stats-widget {
            background: #0b1120;
            border: 1px solid #1e293b;
            border-radius: 8px;
            padding: 8px 10px;
            color: #f1f5f9;
            display: flex;
            flex-direction: column;
            gap: 6px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
            user-select: none;
            overflow: hidden;
        }
        .srw-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .srw-title-wrap {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .srw-live-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #10b981;
            animation: hlPulse 1.2s infinite ease-in-out;
        }
        .srw-badge-title {
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 0.08em;
            color: #94a3b8;
            text-transform: uppercase;
        }
        .srw-controls {
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }
        .srw-btn {
            background: #1e293b;
            border: 1px solid #334155;
            color: #cbd5e1;
            font-size: 0.66rem;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 4px;
            cursor: pointer;
            line-height: 1.2;
        }
        .srw-btn:hover {
            background: #334155;
            color: #fff;
        }
        .srw-speed-btn {
            color: #38bdf8;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
        }
        .srw-card-stage {
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.22s ease;
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid #1e293b;
        }
        .srw-card-stage:hover {
            transform: translateY(-1px);
            border-color: #38bdf8;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
        }
        .srw-dots-row {
            display: flex;
            justify-content: center;
            gap: 4px;
            padding-top: 1px;
        }
        .srw-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #334155;
            cursor: pointer;
            transition: all 0.2s;
        }
        .srw-dot.active {
            background: #38bdf8;
            transform: scale(1.3);
        }

        /* Compact User Strip & Actions */
        .side-user-strip {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 6px 8px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
        }
        .user-summary {
            font-size: 0.76rem;
            line-height: 1.3;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 4px;
        }
        .user-summary strong { color: var(--text-color); }
        .user-team-badge {
            display: inline-block;
            font-size: 0.68rem;
            background: #e0f2fe;
            color: #0369a1;
            padding: 1px 5px;
            border-radius: 4px;
            font-weight: 700;
        }
        .sidebar-actions {
            display: flex;
            gap: 4px;
        }
        .sidebar-actions button,
        .sidebar-actions a {
            flex: 1;
            padding: 4px 6px;
            font-size: 0.72rem;
            text-align: center;
            border-radius: 4px;
        }
        .side-widget-customizer {
            display: flex;
            justify-content: flex-end;
        }
        .btn-customize-widgets {
            background: transparent;
            border: none;
            font-size: 0.68rem;
            font-weight: 700;
            color: #64748b;
            cursor: pointer;
            padding: 2px 4px;
            border-radius: 4px;
        }
        .btn-customize-widgets:hover {
            color: #0284c7;
            background: #f1f5f9;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            margin-left: var(--left-bar-width);
            margin-right: var(--right-bar-width);
            min-height: 100vh;
            padding-bottom: var(--footer-height, 68px);
            background: var(--bg);
        }

        /* Flexible Center when no L-Bar is selected ("there is no LBAR selected... then the all flexible") */
        body.no-left-bar {
            --left-bar-width: 0px !important;
        }
        body.no-left-bar aside.sidebar,
        body.no-left-bar aside.left-bar {
            display: none !important;
        }
        body.no-left-bar .content-area {
            margin-left: 0 !important;
        }

        /* Fixed Right Bar ("the right side bar... we call it the right bare - remain fixed all the time") */
        aside.right-bar {
            position: fixed;
            top: 0;
            right: 0;
            bottom: var(--footer-height, 68px);
            width: var(--right-bar-width);
            background: #ffffff;
            border-left: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            z-index: 30;
            overflow-y: auto;
            padding: 14px 14px 24px;
            gap: 16px;
            box-shadow: -1px 0 3px rgba(0, 0, 0, 0.02);
        }
        .right-bar-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .right-bar-badge {
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #64748b;
            background: #f1f5f9;
            padding: 2px 7px;
            border-radius: 4px;
            text-transform: uppercase;
        }
        .right-bar-account {
            width: 100%;
        }
        .right-bar .account-pill {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
            background: #f8fafc;
            border: 1px solid var(--border-color);
            padding: 10px 12px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            margin-left: 0;
        }
        .account-pill-main {
            display: flex;
            align-items: center;
            gap: 9px;
        }
        .account-pill-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
            padding-top: 6px;
            border-top: 1px solid #e2e8f0;
        }
        .right-bar-section {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .right-bar-section-title {
            font-size: 0.66rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #64748b;
            text-transform: uppercase;
        }
        .right-bar-collection-stats {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 12px;
            gap: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        }
        .right-bar-collection-stats .right-bar-section-title {
            font-size: 0.74rem;
            font-weight: 800;
            color: #334155;
            letter-spacing: 0.02em;
            text-transform: none;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .right-bar-collection-stats .collector-sentence-wrap {
            display: flex;
            flex-direction: column;
            gap: 6px;
            width: 100%;
        }
        .right-bar-collection-stats .sentence-stats-group {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
            width: 100%;
        }
        .right-bar-collection-stats .stat-sentence-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 700;
            border: 1px solid var(--border-color);
            background: #f8fafc;
            color: #334155;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .right-bar-collection-stats .stat-sentence-pill:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
            transform: translateY(-1px);
        }
        .right-bar-collection-stats .stat-sentence-pill.active {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }
        .right-bar-collection-stats .stat-sentence-pill.active .stat-num,
        .right-bar-collection-stats .stat-sentence-pill.active .stat-word {
            color: #ffffff !important;
        }
        .right-bar-collection-stats .stat-sentence-pill.have .stat-num { color: #15803d; font-weight: 800; }
        .right-bar-collection-stats .stat-sentence-pill.need {
            border-color: #fecaca;
            background: #fef2f2;
        }
        .right-bar-collection-stats .stat-sentence-pill.need .stat-num { color: #dc2626; font-weight: 800; }
        .right-bar-collection-stats .stat-sentence-pill.doubles .stat-num { color: #d97706; font-weight: 800; }
        .right-bar-collection-stats .stat-sentence-pill.team .stat-num { color: #0284c7; font-weight: 800; }
        /* Right Bar Subsets & Quick Jump */
        .right-bar-quick-jump {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .rb-quick-jump-container {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .rb-quick-jump-select {
            width: 100%;
            padding: 7px 10px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #0f172a;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            outline: none;
            transition: border-color 0.15s;
        }
        .rb-quick-jump-select:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 2px rgba(2, 132, 199, 0.15);
        }
        .rb-quick-jump-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            max-height: 100px;
            overflow-y: auto;
        }
        .rb-qj-chip {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 3px 6px;
            font-size: 0.68rem;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.15s;
        }
        .rb-qj-chip:hover {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
        }
        .rb-qj-chip .rb-qj-badge {
            background: rgba(0, 0, 0, 0.08);
            padding: 1px 4px;
            border-radius: 3px;
            font-size: 0.62rem;
        }
        .rb-qj-chip:hover .rb-qj-badge {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }

        /* Right Bar Layout Switcher */
        .right-bar-layout-switcher {
            display: flex;
            width: 100%;
            background: #f1f5f9;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 3px;
            gap: 4px;
            box-sizing: border-box;
            margin-left: 0;
        }
        .right-bar-layout-switcher .layout-btn {
            flex: 1;
            text-align: center;
            justify-content: center;
            padding: 8px 10px;
            font-size: 0.82rem;
            font-weight: 700;
            border-radius: 6px;
        }
        /* Right Bar Market Card */
        .right-bar-market-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .market-quick-card {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .mqc-badge {
            font-size: 0.65rem;
            font-weight: 900;
            color: #0284c7;
            letter-spacing: 0.05em;
        }
        .mqc-text {
            font-size: 0.76rem;
            color: #475569;
            line-height: 1.35;
        }
        .btn-open-market {
            background: #0f172a;
            color: #fff;
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s;
        }
        .btn-open-market:hover {
            background: #1e293b;
        }

        /* ==========================================================
           SPORTS CHANNEL HIGHLIGHTS PACKAGE & NEWS FEED
           ("bottom right corner, sprinkled cards, green-red gradient, completeness, sports channel news feed")
           Sticky South in Right Bar ("the live desk should be sticky south")
           ========================================================== */
        .sports-highlights-deck {
            background: #090d16;
            border: 1px solid #1e293b;
            border-top: 2px solid #2563eb;
            border-radius: 12px;
            padding: 12px;
            color: #e2e8f0;
            display: flex;
            flex-direction: column;
            gap: 10px;
            box-shadow: 0 -4px 18px rgba(0, 0, 0, 0.45);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin-top: auto;
            position: sticky;
            bottom: 0;
            z-index: 20;
        }
        .hl-broadcast-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            padding-bottom: 6px;
            border-bottom: 1px solid #1e293b;
            min-height: 24px;
        }
        .hl-live-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #dc2626;
            color: #ffffff;
            font-size: 0.62rem;
            font-weight: 900;
            letter-spacing: 0.1em;
            padding: 2px 6px;
            border-radius: 3px;
            text-transform: uppercase;
            flex-shrink: 0;
        }
        .hl-live-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #ffffff;
            animation: hlPulse 1.2s infinite ease-in-out;
        }
        @keyframes hlPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(0.7); }
        }
        .hl-series-label {
            font-size: 0.6rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            color: #94a3b8;
            text-transform: uppercase;
            text-align: right;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }
        /* Completeness Box ("not in percentage... but in completeness") */
        .hl-completeness-box {
            background: #111827;
            border: 1px solid #1f2937;
            border-radius: 8px;
            padding: 8px 10px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .hl-completeness-label {
            font-size: 0.6rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #64748b;
            text-transform: uppercase;
        }
        .hl-completeness-score {
            display: flex;
            align-items: baseline;
            gap: 6px;
        }
        .hl-have-num {
            font-size: 1.4rem;
            font-weight: 900;
            color: #10b981;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            line-height: 1;
        }
        .hl-of-total {
            font-size: 0.85rem;
            font-weight: 800;
            color: #cbd5e1;
        }
        .hl-breakdown-sub {
            font-size: 0.68rem;
            font-weight: 600;
            color: #94a3b8;
            padding-top: 2px;
        }
        /* Sprinkled Set Spectrum Canvas */
        .hl-spectrum-container {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .hl-spectrum-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.62rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #64748b;
            text-transform: uppercase;
        }
        .hl-spectrum-hint {
            font-size: 0.58rem;
            font-weight: 700;
            color: #38bdf8;
            letter-spacing: normal;
        }
        .hl-spectrum-canvas-wrap {
            background: #050811;
            border: 1px solid #1e293b;
            border-radius: 6px;
            padding: 3px;
            position: relative;
            cursor: crosshair;
        }
        #hlSpectrumCanvas {
            width: 100%;
            height: 48px;
            display: block;
        }
        .hl-spectrum-legend {
            display: flex;
            justify-content: space-between;
            font-size: 0.6rem;
            font-weight: 700;
            color: #94a3b8;
            padding: 0 2px;
        }
        .leg-item {
            display: inline-flex;
            align-items: center;
            gap: 2px;
        }
        /* Subset Completeness & Interaction Graph */
        .hl-subsets-graph {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .hl-interaction-tag {
            font-size: 0.58rem;
            color: #eab308;
            font-weight: 800;
        }
        .hl-subset-bars {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .hl-subset-row {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .hl-subset-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.62rem;
            font-weight: 700;
            color: #cbd5e1;
        }
        .hl-subset-track {
            height: 6px;
            background: #111827;
            border: 1px solid #1f2937;
            border-radius: 3px;
            overflow: hidden;
            position: relative;
        }
        .hl-subset-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981 0%, #22c55e 60%, #eab308 85%, #ef4444 100%);
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        /* ==========================================================
           ELECTION DESK & SPORTS BROADCAST FOOTER TICKER
           ("this ticker should be a footer. when the user seese these or hovers they should cycle... walk though the collection like a live animated news cast thingking like an election")
           ========================================================== */
        /* ==========================================================
           ELECTION DESK & SET SPECTRUM DUAL BROADCAST FOOTER
           ("this is so goo d that it should be the footer below the selection desk")
           ========================================================== */
        .app-broadcast-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 100;
            background: #070b14;
            border-top: 3px solid #2563eb;
            box-shadow: 0 -8px 32px rgba(0, 0, 0, 0.65);
            display: flex;
            flex-direction: column;
            user-select: none;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .election-footer-ticker {
            position: relative;
            height: 40px;
            background: linear-gradient(90deg, #070b14 0%, #0d1527 50%, #070b14 100%);
            display: flex;
            align-items: center;
            overflow: hidden;
            border-bottom: 1px solid #1e293b;
            flex-shrink: 0;
        }
        .footer-spectrum-dock {
            padding: 3px 10px 4px;
            background: #040711;
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex-shrink: 0;
        }
        .fsd-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            font-size: 0.68rem;
            color: #94a3b8;
            flex-wrap: wrap;
        }
        .fsd-title-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .fsd-badge {
            font-weight: 900;
            letter-spacing: 0.08em;
            color: #38bdf8;
            font-size: 0.74rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .fsd-hint {
            color: #38bdf8;
            font-weight: 700;
            background: rgba(56, 189, 248, 0.12);
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid rgba(56, 189, 248, 0.25);
            font-size: 0.72rem;
            max-width: 420px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .fsd-meta {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            min-width: 250px;
            height: 22px;
            cursor: pointer;
        }
        .fsd-fader-item {
            position: absolute;
            right: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            pointer-events: none;
            transform: translateY(3px);
        }
        .fsd-fader-item.active {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }
        .fsd-counts {
            font-weight: 700;
            color: #cbd5e1;
            font-size: 0.72rem;
        }
        .fsd-legend {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 0.64rem;
        }
        .fsd-width-btn {
            background: #1e293b;
            color: #38bdf8;
            border: 1px solid #334155;
            border-radius: 4px;
            font-size: 0.64rem;
            font-weight: 800;
            padding: 2px 7px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .fsd-width-btn:hover {
            background: #38bdf8;
            color: #0f172a;
            border-color: #38bdf8;
        }
        .fsd-canvas-wrap {
            position: relative;
            background: #020409;
            border-radius: 6px;
            padding: 3px 5px;
            cursor: crosshair;
            transition: max-width 0.25s ease, border-color 0.2s ease, box-shadow 0.2s ease;
            box-sizing: border-box;
            min-height: 56px;
        }
        /* Border when narrow vs wide ("and a border when it goes narry and wide") */
        .fsd-canvas-wrap.is-narrow {
            max-width: 920px;
            margin: 0 auto;
            width: 100%;
            border: 2px solid #06b6d4; /* Distinct vibrant cyan border when narrow */
            box-shadow: 0 0 12px rgba(6, 182, 212, 0.25), inset 0 0 6px rgba(6, 182, 212, 0.15);
        }
        .fsd-canvas-wrap.is-wide {
            width: 100%;
            border: 2px solid #3b82f6; /* Distinct royal blue border when wide */
            box-shadow: 0 0 12px rgba(59, 130, 246, 0.2), inset 0 0 6px rgba(59, 130, 246, 0.1);
        }
        /* Active glowing border while scrubbing */
        .fsd-canvas-wrap.is-scrubbing {
            border-color: #f59e0b !important;
            box-shadow: 0 0 16px rgba(245, 158, 11, 0.5), inset 0 0 8px rgba(245, 158, 11, 0.25) !important;
        }
        #footerSpectrumCanvas {
            width: 100%;
            height: 52px;
            display: block;
        }
        /* Magnifying Glass Loupe ("this lower bar should have a magnifying glass when scrubbing") */
        .fsd-magnifier {
            position: absolute;
            bottom: 58px;
            transform: translateX(-50%);
            pointer-events: none;
            z-index: 50;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fsdMagPop 0.12s ease-out;
            filter: drop-shadow(0 8px 18px rgba(0, 0, 0, 0.65));
        }
        @keyframes fsdMagPop {
            0% { opacity: 0; transform: translateX(-50%) scale(0.85) translateY(6px); }
            100% { opacity: 1; transform: translateX(-50%) scale(1) translateY(0); }
        }
        .fsd-mag-lens {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #090e1a 0%, #172554 100%);
            border: 3px solid #38bdf8;
            border-radius: 12px;
            padding: 8px 12px;
            min-width: 160px;
            max-width: 260px;
            box-shadow: inset 0 1px 3px rgba(255, 255, 255, 0.35), 0 0 14px rgba(56, 189, 248, 0.45);
            text-align: center;
            position: relative;
        }
        .fsd-mag-icon {
            font-size: 1.15rem;
            position: absolute;
            left: -12px;
            top: -12px;
            background: #0284c7;
            color: #ffffff;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
        }
        .fsd-mag-num {
            font-size: 1.05rem;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: 0.04em;
            line-height: 1.2;
        }
        .fsd-mag-player {
            font-size: 0.86rem;
            font-weight: 800;
            color: #38bdf8;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 220px;
            margin-top: 2px;
        }
        .fsd-mag-subset {
            font-size: 0.66rem;
            color: #94a3b8;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 220px;
        }
        .fsd-mag-badge {
            margin-top: 5px;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .fsd-mag-badge.owned {
            background: #059669;
            color: #ffffff;
            border: 1px solid #34d399;
        }
        .fsd-mag-badge.doubles {
            background: #dc2626;
            color: #ffffff;
            border: 1px solid #f87171;
        }
        .fsd-mag-badge.needed {
            background: #334155;
            color: #94a3b8;
            border: 1px solid #475569;
        }
        .fsd-mag-pointer {
            width: 0;
            height: 0;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-top: 8px solid #38bdf8;
            margin-top: -1px;
        }
        .eft-desk-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #dc2626;
            color: #ffffff;
            font-size: 0.76rem;
            font-weight: 900;
            letter-spacing: 0.08em;
            padding: 0 10px;
            height: 100%;
            flex-shrink: 0;
            text-transform: uppercase;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.3);
            border-right: 1px solid rgba(255, 255, 255, 0.15);
        }
        .eft-live-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ffffff;
            animation: hlPulse 1.2s infinite ease-in-out;
        }
        .eft-call-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #111827;
            color: #f1f5f9;
            height: 100%;
            padding: 0 10px;
            font-size: 0.76rem;
            font-weight: 800;
            border-right: 1px solid #1e293b;
            flex: 0 0 290px;
            width: 290px;
            min-width: 290px;
            max-width: 290px;
            box-sizing: border-box;
            cursor: pointer;
            transition: background 0.15s ease;
            user-select: none;
            overflow: hidden;
            white-space: nowrap;
        }
        @media (max-width: 768px) {
            .eft-call-chip {
                flex: 0 0 200px;
                width: 200px;
                min-width: 200px;
                max-width: 200px;
                padding: 0 6px;
            }
        }
        .eft-call-chip:hover {
            background: #1e293b;
        }
        .eft-call-chip:active {
            transform: scale(0.98);
        }
        .eft-call-lbl {
            color: #38bdf8;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-size: 0.78rem;
            transition: color 0.3s ease;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex-shrink: 1;
        }
        .eft-call-val {
            color: #10b981;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-weight: 900;
            font-size: 0.84rem;
            transition: color 0.3s ease, opacity 0.18s ease, transform 0.18s ease;
            white-space: nowrap;
            flex-shrink: 0;
            margin-left: auto;
        }
        .eft-call-chip.flipping .eft-call-val,
        .eft-call-chip.flipping .eft-call-lbl {
            opacity: 0.25;
            transform: translateY(-2px);
        }
        .eft-viewport {
            flex: 1;
            min-width: 0;
            height: 100%;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            background: rgba(3, 7, 18, 0.6);
        }
        .eft-stream {
            display: flex;
            align-items: center;
            gap: 16px;
            white-space: nowrap;
            will-change: transform;
            animation: eftWalkThrough 600s linear infinite;
        }
        .eft-stream:hover,
        .eft-stream.is-paused {
            animation-play-state: paused;
        }
        @keyframes eftWalkThrough {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .eft-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 10px;
            border-radius: 4px;
            background: rgba(15, 23, 42, 0.94);
            border: 1px solid #1e293b;
            font-size: 0.78rem;
            color: #cbd5e1;
            flex-shrink: 0;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .eft-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.5);
        }
        /* Red and blue text: needed cards in red, owned/secured cards in blue */
        .eft-item.eft-status-needed {
            border-color: rgba(239, 68, 68, 0.45);
            background: rgba(239, 68, 68, 0.1);
        }
        .eft-item.eft-status-needed:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: #ef4444;
            box-shadow: 0 0 12px rgba(239, 68, 68, 0.4);
        }
        .eft-item.eft-status-owned {
            border-color: rgba(56, 189, 248, 0.45);
            background: rgba(56, 189, 248, 0.1);
        }
        .eft-item.eft-status-owned:hover {
            background: rgba(56, 189, 248, 0.2);
            border-color: #38bdf8;
            box-shadow: 0 0 12px rgba(56, 189, 248, 0.4);
        }
        .eft-item.eft-status-trade {
            border-color: rgba(245, 158, 11, 0.45);
            background: rgba(245, 158, 11, 0.1);
        }
        .eft-item.eft-status-trade:hover {
            background: rgba(245, 158, 11, 0.2);
            border-color: #f59e0b;
            box-shadow: 0 0 12px rgba(245, 158, 11, 0.4);
        }
        .eft-needed-text {
            color: #ef4444 !important;
        }
        .eft-owned-text {
            color: #38bdf8 !important;
        }
        .eft-trade-text {
            color: #f59e0b !important;
        }
        .eft-item-num {
            font-weight: 900;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: 0.88rem;
        }
        .eft-item-name {
            font-weight: 700;
            font-size: 0.80rem;
        }
        .eft-item-set {
            font-size: 0.64rem;
            color: #94a3b8;
            text-transform: uppercase;
            background: rgba(255, 255, 255, 0.08);
            padding: 1px 4px;
            border-radius: 3px;
        }
        .eft-callout {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 6px;
            background: linear-gradient(90deg, rgba(30, 58, 138, 0.7) 0%, rgba(15, 23, 42, 0.9) 100%);
            border: 1px solid #2563eb;
            color: #93c5fd;
            font-size: 0.78rem;
            font-weight: 800;
            flex-shrink: 0;
            letter-spacing: 0.04em;
        }
        .eft-callout-badge {
            background: #2563eb;
            color: #ffffff;
            font-size: 0.68rem;
            font-weight: 900;
            padding: 1px 5px;
            border-radius: 3px;
            text-transform: uppercase;
        }
        .eft-actions {
            display: inline-flex;
            align-items: center;
            gap: 2px;
            padding: 0 6px;
            height: 100%;
            background: #0b1120;
            border-left: 1px solid #1e293b;
            flex-shrink: 0;
        }
        .eft-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            font-size: 0.88rem;
            cursor: pointer;
            padding: 3px 6px;
            border-radius: 4px;
            line-height: 1;
        }
        .eft-btn:hover {
            color: #ffffff;
            background: #1e293b;
        }
        .eft-speed-btn {
            font-size: 0.72rem;
            font-weight: 800;
            color: #38bdf8;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            padding: 2px 5px;
            border: 1px solid #1e293b;
            border-radius: 4px;
        }
        .eft-speed-btn:hover {
            border-color: #38bdf8;
        }

        /* Sticky top bar */
        header.topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            background: #fff;
            border-bottom: 1px solid var(--border-color);
            padding: 5px 14px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .bar {
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }
        .topbar-main-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            flex-wrap: nowrap;
        }
        .topbar-left-group {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: nowrap;
        }
        .topbar-nav-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            padding: 3px 8px;
            font-size: 0.95rem;
            line-height: 1.2;
            cursor: pointer;
            transition: all 0.15s ease;
            color: #1e293b;
        }
        .topbar-nav-btn:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }
        .topbar-sub-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding-top: 3px;
            border-top: 1px solid #f1f5f9;
        }
        .topbar-sub-left,
        .topbar-sub-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .topbar-sub-row h1 {
            margin: 0;
            color: var(--primary);
            font-size: 0.92rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .topbar-sub-row .overall {
            font-size: 0.80rem;
            color: #475569;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .topbar-sub-row select {
            padding: 2px 6px;
            font-size: 0.80rem;
        }
        .topbar-sub-row button.primary {
            padding: 3px 8px;
            font-size: 0.80rem;
        }
        .mobile-menu-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        h1 {
            margin: 0;
            color: var(--primary);
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .series-tag {
            font-size: 0.72rem;
            font-weight: normal;
            background: #f1f5f9;
            color: #475569;
            padding: 2px 7px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }
        select, button, input {
            font: inherit;
            font-size: 0.85rem;
        }
        select, input {
            padding: 4px 8px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background: #fff;
        }
        button {
            padding: 4px 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background: #fff;
            cursor: pointer;
        }
        button.primary { background: var(--primary); border-color: var(--primary); color: #fff; }
        .filters { display: flex; flex-wrap: nowrap; gap: 4px; }
        .filters button {
            padding: 3px 8px;
            font-size: 0.78rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .filters button.active { background: var(--text-color); border-color: var(--text-color); color: #fff; }
        .filters button.team-active { background: #0284c7; border-color: #0284c7; color: #fff; }

        /* Top Right Account Information */
        .topbar-account {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .account-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1px solid var(--border-color);
            padding: 4px 10px 4px 6px;
            border-radius: 999px;
            font-size: 0.8rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .account-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
            color: #475569;
            flex-shrink: 0;
        }
        .account-meta {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
            text-align: left;
        }
        .account-name {
            font-weight: 700;
            color: var(--text-color);
            font-size: 0.82rem;
            white-space: nowrap;
        }
        .account-team {
            font-size: 0.7rem;
            color: #0284c7;
            cursor: pointer;
            font-weight: 600;
            white-space: nowrap;
        }
        .account-team:hover {
            text-decoration: underline;
        }
        .btn-topbar-edit-team {
            padding: 3px 7px;
            font-size: 0.72rem;
            border-radius: 999px;
            background: #fff;
            border: 1px solid #cbd5e1;
            color: #334155;
            cursor: pointer;
            white-space: nowrap;
        }
        .btn-topbar-edit-team:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }
        .btn-topbar-admin {
            padding: 3px 8px;
            font-size: 0.72rem;
            border-radius: 999px;
            background: #f1f5f9;
            border: 1px solid #94a3b8;
            color: #1e293b;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            transition: all 0.15s;
        }
        .btn-topbar-admin:hover {
            background: #e2e8f0;
            border-color: #64748b;
        }
        .admin-link-btn {
            display: inline-block;
            text-align: center;
            padding: 6px 12px;
            font-size: 0.82rem;
            font-weight: 600;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            color: #1e293b;
            text-decoration: none;
            margin-bottom: 6px;
            transition: background 0.15s;
        }
        .admin-link-btn:hover {
            background: #e2e8f0;
        }
        .btn-topbar-signout {
            padding: 3px 8px;
            font-size: 0.72rem;
            border-radius: 999px;
            background: #fff;
            border: 1px solid #cbd5e1;
            color: var(--muted);
            cursor: pointer;
            transition: all 0.15s;
            white-space: nowrap;
        }
        .btn-topbar-signout:hover {
            background: #fee2e2;
            border-color: #fca5a5;
            color: #b91c1c;
        }
        .btn-topbar-signin {
            padding: 6px 14px;
            font-size: 0.82rem;
            border-radius: 999px;
            background: var(--primary);
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: 700;
            white-space: nowrap;
        }
        .btn-topbar-signin:hover {
            background: var(--primary-hover);
        }

        /* Main content area (95% List and Views) */
        main {
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            padding: 8px 16px 82px;
            flex: 1;
        }

        /* Collector Dashboard Unit: Sentence Stats + Pro Audio VU Meter (no visual void) */
        .collector-dashboard-unit {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px 20px;
        }
        .collector-sentence-wrap {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px 12px;
        }
        .sentence-user-lead {
            font-size: 0.88rem;
            color: #334155;
        }
        .sentence-user-lead strong {
            color: #0f172a;
        }
        .sentence-stats-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
        }
        .stat-sentence-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background: #f8fafc;
            font-size: 0.84rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
            color: #334155;
        }
        .stat-sentence-pill:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
            transform: translateY(-1px);
        }
        .stat-sentence-pill.active {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
            box-shadow: 0 1px 4px rgba(15, 23, 42, 0.2);
        }
        .stat-sentence-pill.active .stat-num,
        .stat-sentence-pill.active .stat-word {
            color: #ffffff !important;
        }
        .stat-sentence-pill.have .stat-num { color: #15803d; font-weight: 800; }
        .stat-sentence-pill.need .stat-num { color: #dc2626; font-weight: 800; }
        .stat-sentence-pill.doubles .stat-num { color: #d97706; font-weight: 800; }
        .stat-sentence-pill.team .stat-num { color: #0284c7; font-weight: 800; }
        .stat-emoji {
            font-size: 0.95rem;
            line-height: 1;
        }
        .stat-word {
            font-size: 0.78rem;
            color: var(--muted);
        }
        .stat-sep {
            color: #cbd5e1;
            font-weight: 700;
        }

        /* Series Quick Links Navigation Panel ("use all this real estate to be serias quick links, menu quick jump to those pages and those numbers") */
        .series-nav-panel {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 14px 12px;
            margin-bottom: 14px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .series-nav-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }
        .series-nav-title {
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #475569;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .series-nav-hint {
            font-size: 0.72rem;
            color: var(--muted);
        }
        .series-chips-row {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            overflow: visible;
            padding-right: 0;
        }
        .series-chip {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            padding: 4px 7px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            color: #334155;
            font-size: 0.72rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
            flex: 1 1 calc(50% - 4px);
            min-width: 95px;
            line-height: 1.15;
        }
        .series-chip:hover {
            background: #f0f9ff;
            border-color: #0284c7;
            color: #0369a1;
        }
        .series-chip.active {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 1px 4px rgba(2, 132, 199, 0.3);
            font-weight: 700;
        }
        .series-chip .chip-name {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 80px;
        }
        .series-chip .chip-count {
            font-size: 0.62rem;
            opacity: 0.95;
            background: rgba(0, 0, 0, 0.07);
            padding: 1px 4px;
            border-radius: 999px;
            font-weight: 700;
            flex-shrink: 0;
        }
        .series-chip.active .chip-count {
            background: rgba(255, 255, 255, 0.28);
            color: #fff;
        }

        /* Sub-list row for Sheet/Number quick jumps */
        /* ("base quick jump... has all this vertical space and a scroll bar. avoid the scroll bar at all costs") */
        .series-sublist-row {
            background: #f1f5f9;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            padding: 8px 10px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            overflow: visible;
        }
        .sublist-lead {
            font-size: 0.72rem;
            font-weight: 800;
            color: #1e293b;
            white-space: nowrap;
        }
        .sublist-pills-wrap {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 5px;
            overflow: visible;
            padding: 2px 0;
        }
        .sublist-jump-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 4px;
            padding: 4px 6px;
            border-radius: 5px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.15s ease;
            line-height: 1.15;
            min-width: 0;
        }
        .sublist-jump-btn:hover {
            background: #0284c7;
            color: #fff;
            border-color: #0284c7;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.25);
        }
        .sublist-jump-btn:hover .jump-card-range {
            color: rgba(255, 255, 255, 0.9);
        }
        .jump-sheet-num {
            font-size: 0.68rem;
            font-weight: 800;
        }
        .jump-card-range {
            font-size: 0.6rem;
            font-weight: 700;
            color: var(--muted);
        }

        /* Glow animation on jumped sheet */
        @keyframes sheetGlow {
            0% { box-shadow: 0 0 0 4px #0284c7, 0 8px 24px rgba(2, 132, 199, 0.45); transform: scale(1.02); }
            100% { box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05); transform: scale(1); }
        }
        .binder-page.jump-highlight,
        .group.list-group.jump-highlight {
            animation: sheetGlow 1.5s ease-out;
            border-color: #0284c7 !important;
        }

        .notice {
            background: #fff;
            border: 1px dashed var(--border-color);
            border-radius: 6px;
            padding: 12px;
            margin: 8px 0;
            color: var(--muted);
            line-height: 1.4;
        }
        .notice.team-notice {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            color: #0369a1;
        }

        /* Set sections */
        details.set {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            margin-top: 8px;
        }
        details.set > summary {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            cursor: pointer;
            font-weight: 600;
            list-style: none;
        }
        details.set > summary::-webkit-details-marker { display: none; }
        details.set > summary::before { content: "▸"; color: var(--muted); }
        details.set[open] > summary::before { content: "▾"; }
        .set-count { font-weight: normal; font-size: 0.8rem; color: var(--muted); }
        .progress {
            flex: 0 0 80px;
            height: 5px;
            background: #eee;
            border-radius: 3px;
            overflow: hidden;
            margin-left: auto;
        }
        .progress > span { display: block; height: 100%; background: var(--row-single-edge); }

        /* Layout switcher */
        .layout-switcher {
            display: inline-flex;
            background: #f1f5f9;
            border-radius: 6px;
            padding: 2px;
            gap: 2px;
            border: 1px solid var(--border-color);
            margin-left: 4px;
        }
        .layout-btn {
            padding: 4px 10px;
            font-size: 0.76rem;
            font-weight: 700;
            border: none;
            background: transparent;
            color: var(--muted);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .layout-btn:hover {
            color: var(--text-color);
        }
        .layout-btn.active {
            background: #fff;
            color: var(--text-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .layout-btn-mc {
            letter-spacing: -0.01em;
        }
        .layout-btn-mc .layout-btn-mc-icon {
            font-size: 0.85em;
            display: inline-block;
        }
        .layout-btn-mc.active {
            background: #13683a !important; /* Signature McMaster Hunter Green */
            color: #ffffff !important;
            box-shadow: 0 1px 3px rgba(19, 104, 58, 0.35);
        }
        .layout-btn-mc:hover:not(.active) {
            color: #13683a;
            background: rgba(19, 104, 58, 0.08);
        }

        /* Card tiles: Grid layouts */
        /* 2-Page Binder Spread: "two pages... put them upwards if there is room" */
        .grid.layout-page {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 18px;
            padding: 10px 12px 18px;
            align-items: start;
        }
        @media (min-width: 680px) {
            .grid.layout-page {
                grid-template-columns: repeat(2, minmax(290px, 1fr));
                align-items: start;
            }
        }
        @media (min-width: 1400px) {
            .grid.layout-page {
                grid-template-columns: repeat(2, minmax(320px, 1fr));
                max-width: 1100px;
                align-items: start;
            }
        }
        .grid.layout-list {
            column-width: 260px;
            column-gap: 14px;
            padding: 0 8px 10px;
        }
        .grid {
            width: 100%;
        }

        /* 3x3 Binder Page Sheet */
        .binder-page {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 14px 12px 12px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
            break-inside: avoid;
            display: flex;
            flex-direction: column;
            gap: 10px;
            position: relative;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            align-self: start;
        }
        .binder-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 8px;
            border-bottom: 1.5px solid #e2e8f0;
        }
        .binder-rings-punch {
            display: flex;
            gap: 5px;
        }
        .ring-hole {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #e2e8f0;
            border: 1px solid #94a3b8;
        }
        .binder-page-meta {
            display: flex;
            align-items: baseline;
            gap: 6px;
        }
        .binder-page-title {
            font-size: 0.85rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #1e293b;
        }
        .binder-page-subtitle {
            font-size: 0.72rem;
            color: var(--muted);
            font-weight: 600;
        }
        .binder-page-badge {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 8px;
            background: #e2e8f0;
            border-radius: 12px;
            color: #334155;
        }

        /* 3x3 Pocket Grid */
        .binder-grid-3x3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        /* Cards in Page Mode: authentic 2.5 : 3.5 hockey card ratio */
        .card.page-card {
            aspect-ratio: 2.5 / 3.5;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 8px 7px 6px;
            border-radius: 7px;
            border: 1.5px solid #e2e8f0;
            background: #ffffff;
            position: relative;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            cursor: pointer;
            user-select: none;
            transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
            overflow: hidden;
            text-align: center;
        }
        .card.page-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.1);
            border-color: #94a3b8;
        }
        .card.page-card.collected {
            background: linear-gradient(160deg, #f0fdf4 0%, #dcfce7 100%);
            border-color: #86efac;
        }
        .card.page-card.doubles {
            background: linear-gradient(160deg, #fefce8 0%, #fef08a 100%);
            border-color: #fde047;
        }
        .card.page-card.empty-pocket {
            background: #f8fafc;
            border: 1.5px dashed #cbd5e1;
            opacity: 0.55;
            cursor: default;
            align-items: center;
            justify-content: center;
        }
        .card.page-card.empty-pocket:hover {
            transform: none;
            box-shadow: none;
            border-color: #cbd5e1;
        }

        .card-head {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 100%;
            margin-bottom: 2px;
        }
        .card-num-tag {
            font-size: 0.85rem;
            font-weight: 800;
            color: #475569;
        }
        /* Prominent card series number on missing cards */
        .card.page-card.missing .card-head {
            align-items: flex-start;
            justify-content: flex-end;
        }
        .card.page-card.missing .card-num-tag {
            font-size: 1.45rem;
            font-weight: 900;
            color: #0f172a;
            line-height: 1;
            letter-spacing: -0.5px;
            margin-top: -1px;
        }
        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 0;
            padding: 2px 0;
        }
        .card-player-title {
            font-size: 0.78rem;
            font-weight: 700;
            line-height: 1.22;
            color: var(--text-color);
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: break-word;
        }
        .card-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            margin-top: 2px;
            gap: 2px;
        }
        .card-status-badge {
            font-size: 0.68rem;
            font-weight: 800;
            padding: 1px 5px;
            border-radius: 4px;
        }
        .card.collected .card-status-badge {
            color: #166534;
            background: #bbf7d0;
        }
        .card.doubles .card-status-badge {
            color: #854d0e;
            background: #fef08a;
        }
        .card-status-badge.missing {
            color: #94a3b8;
            background: #f1f5f9;
        }

        /* Hold push state */
        .card.holding {
            transform: scale(0.96) !important;
            border-color: #0284c7 !important;
            box-shadow: 0 0 14px rgba(2, 132, 199, 0.5) !important;
        }

        /* List mode styles */
        .group.list-group {
            display: grid;
            gap: 3px;
            break-inside: avoid;
            margin-bottom: 12px;
            padding: 4px;
            border: 1px solid #cfd4da;
            border-radius: 6px;
        }
        .card {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 4px 6px;
            border: 1px solid transparent;
            border-left: 3px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            user-select: none;
            min-width: 0;
            background: #fff;
        }
        .card:hover { border-color: var(--border-color); }
        .readonly .card { cursor: default; }
        .need {
            flex: 0 0 auto;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--primary);
            border: 1px solid var(--primary);
            border-radius: 8px;
            padding: 0 4px;
        }
        .card.collected { background: var(--row-single); border-left-color: var(--row-single-edge); }
        .card.doubles { background: var(--row-double); border-left-color: var(--row-double-edge); }
        .num { flex: 0 0 auto; min-width: 2.2em; font-weight: 700; font-size: 0.75rem; color: var(--muted); }
        .card.missing .num { font-size: 0.92rem; font-weight: 900; color: #0f172a; }
        .name {
            flex: 1 1 auto;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 0.84rem;
            font-weight: 600;
            letter-spacing: -0.01em;
        }
        .qty { flex: 0 0 auto; font-size: 0.7rem; font-weight: 700; }
        .collected .qty { color: #2e7d32; }
        .doubles .qty { color: #f57f17; }
        .trade {
            flex: 0 0 auto;
            font-size: 0.7rem;
            font-weight: 700;
            color: #fff;
            background: var(--trade);
            border-radius: 8px;
            padding: 0 5px;
        }
        .trade.team-trade { background: #0284c7; }
        .trade-names {
            grid-column: 1 / -1;
            font-size: 0.75rem;
            color: var(--trade);
            padding: 0 6px 0 calc(2.2em + 15px);
            margin-top: -2px;
        }
        .holders-info {
            grid-column: 1 / -1;
            font-size: 0.72rem;
            color: #0369a1;
            padding: 0 6px 0 calc(2.2em + 15px);
            margin-top: -2px;
        }
        .card-nhl-team {
            flex: 0 0 auto;
            font-size: 0.62rem;
            font-weight: 800;
            color: #475569;
            background: #f1f5f9;
            padding: 1px 3px;
            border-radius: 3px;
            border: 1px solid #e2e8f0;
            letter-spacing: 0.01em;
        }
        .card-wiki-lookup-btn {
            flex: 0 0 auto;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            font-size: 0.68rem;
            line-height: 1;
            padding: 1px 3px;
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .card-wiki-lookup-btn:hover {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
            transform: scale(1.08);
        }
        .page-card-team-pill {
            font-size: 0.65rem;
            font-weight: 800;
            color: #0284c7;
            background: rgba(2, 132, 199, 0.1);
            padding: 2px 5px;
            border-radius: 3px;
            margin-left: auto;
        }
        .page-card-wiki-btn {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            font-size: 0.72rem;
            line-height: 1;
            padding: 2px 4px;
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .page-card-wiki-btn:hover {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
            transform: scale(1.08);
        }
        .card-player-team {
            font-size: 0.72rem;
            color: #64748b;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 1px;
        }

        /* Wikipedia Player Bio Modal */
        .wiki-dialog {
            width: min(520px, 94vw);
            border-radius: 14px;
            padding: 0;
            overflow: hidden;
            border: 1px solid var(--border-color);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .wiki-header {
            padding: 14px 18px;
            background: #f8fafc;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .wiki-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .wiki-icon {
            font-size: 1.4rem;
        }
        .wiki-header h3 {
            font-size: 1.1rem;
            font-weight: 800;
            margin: 0;
            color: #0f172a;
        }
        .wiki-subtitle {
            font-size: 0.75rem;
            color: var(--muted);
        }
        .wiki-content {
            padding: 18px;
            max-height: 60vh;
            overflow-y: auto;
        }
        .wiki-player-card {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            margin-bottom: 14px;
        }
        .wiki-player-img {
            width: 105px;
            height: 135px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            flex: 0 0 auto;
            background: #f1f5f9;
        }
        .wiki-player-info {
            flex: 1;
        }
        .wiki-player-desc {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 6px;
        }
        .wiki-extract {
            font-size: 0.875rem;
            line-height: 1.5;
            color: #334155;
        }
        .wiki-footer {
            padding: 12px 18px;
            background: #f8fafc;
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }
        .wiki-hint {
            font-size: 0.72rem;
            color: var(--muted);
        }
        .wiki-full-btn {
            font-size: 0.82rem;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 6px;
            background: #0284c7;
            color: #fff;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background 0.15s;
        }
        .wiki-full-btn:hover {
            background: #0369a1;
        }

        /* ==========================================================
           PRO-AUDIO VU METER (Integrated into Collector Dashboard)
           ========================================================== */
        .collector-dashboard-unit .vu-meter-housing {
            flex: 1 1 280px;
            max-width: 440px;
            min-width: 200px;
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 8px;
            padding: 6px 10px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.4);
        }

        .vu-stats-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }
        .vu-stat-box {
            background: #111827;
            border: 1px solid #1f2937;
            border-radius: 6px;
            padding: 4px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 66px;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s;
        }
        .vu-stat-box:hover {
            background: #1f2937;
            border-color: #374151;
        }
        .vu-stat-label {
            font-size: 0.62rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #94a3b8;
        }
        .vu-stat-num {
            font-size: 1.25rem;
            font-weight: 900;
            line-height: 1.1;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        }
        .vu-stat-box.have .vu-stat-num {
            color: var(--vu-green);
            text-shadow: 0 0 10px rgba(34, 197, 94, 0.4);
        }
        .vu-stat-box.need .vu-stat-num {
            color: #f87171;
            text-shadow: 0 0 10px rgba(239, 68, 68, 0.4);
        }
        .vu-stat-box.doubles .vu-stat-num {
            color: var(--vu-yellow);
            text-shadow: 0 0 10px rgba(251, 191, 36, 0.4);
        }
        .vu-stat-box.team .vu-stat-num {
            color: var(--vu-blue);
            text-shadow: 0 0 10px rgba(56, 189, 248, 0.4);
        }
        .vu-stat-sub {
            font-size: 0.65rem;
            color: #64748b;
        }

        .vu-meter-housing {
            flex: 1;
            min-width: 140px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .vu-scale-ticks {
            display: flex;
            justify-content: space-between;
            font-size: 0.62rem;
            font-weight: 700;
            color: #64748b;
            font-family: ui-monospace, SFMono-Regular, monospace;
            padding: 0 2px;
        }
        .vu-scale-ticks .peak-tick {
            color: #ef4444;
        }
        .vu-meter-track {
            height: 18px;
            background: #090d16;
            border: 1px solid #1e293b;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.7);
        }
        /* Faint unlit LEDs across the entire fixed track */
        .vu-meter-track::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to right,
                rgba(16, 185, 129, 0.08) 0%,
                rgba(34, 197, 94, 0.08) 65%,
                rgba(234, 179, 8, 0.08) 75%,
                rgba(249, 115, 22, 0.08) 90%,
                rgba(239, 68, 68, 0.12) 96%,
                rgba(239, 68, 68, 0.12) 100%
            );
            z-index: 1;
        }
        /* The lit meter gradient: fixed 100% across the track, revealed via clip-path */
        .vu-meter-fill {
            position: absolute;
            left: 0;
            top: 0;
            width: 100% !important;
            height: 100%;
            background: linear-gradient(
                to right,
                #10b981 0%,
                #10b981 50%,
                #22c55e 65%,
                #eab308 75%,
                #f59e0b 85%,
                #f97316 90%,
                #ef4444 96%,
                #dc2626 100%
            );
            clip-path: inset(0 100% 0 0);
            -webkit-clip-path: inset(0 100% 0 0);
            transition: clip-path 0.35s cubic-bezier(0.4, 0, 0.2, 1), -webkit-clip-path 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 2;
        }
        /* Discrete LED bar segments dividing the track */
        .vu-meter-track::after {
            content: "";
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                90deg,
                rgba(9, 13, 22, 0.75) 0px,
                rgba(9, 13, 22, 0.75) 2px,
                transparent 2px,
                transparent 8px
            );
            z-index: 3;
            pointer-events: none;
        }
        .vu-channel-label {
            font-size: 0.58rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            color: #475569;
            text-align: right;
            padding-top: 1px;
        }

        /* Modal Dialogs */
        dialog {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 18px;
            width: min(360px, 92vw);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        dialog::backdrop { background: rgba(0, 0, 0, 0.4); }
        dialog form { display: grid; gap: 10px; }
        dialog label { display: grid; gap: 4px; font-size: 0.82rem; color: var(--muted); }
        dialog input, dialog select { font-size: 16px; padding: 6px 8px; }
        dialog .actions { display: flex; justify-content: flex-end; gap: 8px; margin-top: 6px; }
        .error { color: var(--primary); font-size: 0.82rem; min-height: 1em; }
        .toast {
            position: fixed;
            left: 50%;
            bottom: 75px;
            transform: translateX(-50%);
            background: #0f172a;
            color: #fff;
            padding: 9px 16px;
            border-radius: 6px;
            font-size: 0.85rem;
            z-index: 50;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
            border: 1px solid #334155;
        }

        /* Card Options Modal */
        .card-opt-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 4px;
        }
        .card-opt-title-wrap {
            display: flex;
            align-items: baseline;
            gap: 6px;
            min-width: 0;
            overflow: hidden;
        }
        .card-opt-num {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--muted);
            flex: 0 0 auto;
        }
        .card-opt-name {
            font-size: 1.05rem;
            font-weight: 700;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .card-opt-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            line-height: 1;
            padding: 2px 6px;
            cursor: pointer;
            color: var(--muted);
            border-radius: 4px;
        }
        .card-opt-close:hover {
            color: var(--text-color);
            background: #f1f5f9;
        }
        .card-opt-current {
            font-size: 0.82rem;
            color: var(--muted);
            margin-bottom: 14px;
        }
        .card-opt-buttons {
            display: grid;
            gap: 8px;
        }
        .card-opt-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-align: left;
            transition: all 0.15s ease;
        }
        .card-opt-btn:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }
        .card-opt-btn.double-btn {
            border-left: 5px solid #f57f17;
        }
        .card-opt-btn.triple-btn {
            border-left: 5px solid #d97706;
        }
        .card-opt-btn.single-btn {
            border-left: 5px solid #2e7d32;
        }
        .card-opt-btn.remove-btn {
            border-left: 5px solid #dc2626;
            color: #dc2626;
        }
        .card-opt-btn.remove-btn:hover {
            background: #fef2f2;
            border-color: #dc2626;
        }
        .card-opt-btn.active {
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.15);
            background: #f8fafc;
        }
        .card-opt-badge {
            font-size: 0.8rem;
            padding: 2px 8px;
            border-radius: 12px;
            background: #f1f5f9;
            color: #475569;
            font-weight: 700;
        }
        .card-opt-btn.active .card-opt-badge {
            background: #334155;
            color: #fff;
        }
        .card-opt-custom-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed var(--border-color);
            font-size: 0.85rem;
            color: var(--muted);
        }
        .card-opt-custom-row input {
            width: 55px;
            padding: 4px 6px;
            font-size: 0.85rem;
            text-align: center;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }
        .card-opt-custom-row button {
            padding: 4px 10px;
            font-size: 0.85rem;
        }

        /* Responsive */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 25;
        }
        @media (max-width: 1080px) {
            .content-area {
                margin-left: 0;
                margin-right: 0;
            }
            aside.sidebar,
            aside.left-bar {
                transform: translateX(-100%);
                transition: transform 0.22s ease-in-out;
                box-shadow: 2px 0 20px rgba(0, 0, 0, 0.15);
                width: 280px;
            }
            aside.sidebar.open,
            aside.left-bar.open { transform: translateX(0); }
            aside.right-bar {
                transform: translateX(100%);
                transition: transform 0.22s ease-in-out;
                box-shadow: -2px 0 20px rgba(0, 0, 0, 0.15);
                width: 300px;
            }
            aside.right-bar.open { transform: translateX(0); }
            .sidebar-backdrop.open { display: block; }
            .close-sidebar-btn { display: block; }
            .mobile-menu-btn { display: inline-flex; align-items: center; justify-content: center; }
            .mobile-subsets-btn { display: inline-flex !important; }
            .mobile-right-btn { display: inline-flex; }
            header.topbar { padding: 6px 10px; }
            main { padding: 8px 10px 82px; }
            .collector-dashboard-unit {
                padding: 8px 10px;
                gap: 10px;
            }
            .collector-dashboard-unit .vu-meter-housing {
                min-width: 100%;
            }
        }

        /* Topbar Controls & Mobile Enhancements */
        .mobile-subsets-btn {
            display: none;
            align-items: center;
            gap: 4px;
            background: #eff6ff;
            color: #0284c7;
            border: 1px solid #bae6fd;
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 0.78rem;
            font-weight: 800;
            cursor: pointer;
        }
        .mobile-subsets-btn:hover {
            background: #0284c7;
            color: #fff;
        }
        .topbar-layout-switcher {
            display: inline-flex;
            flex: 1 1 auto;
            background: #f1f5f9;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 2px;
            gap: 2px;
        }
        .topbar-layout-switcher .layout-btn {
            flex: 1 1 auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 10px;
            font-size: 0.76rem;
            font-weight: 700;
            border-radius: 4px;
            border: none;
            background: transparent;
            color: #64748b;
            white-space: nowrap;
            text-align: center;
        }
        .topbar-layout-switcher .layout-btn.active {
            background: #fff;
            color: #0f172a;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .topbar-right-cluster {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1 1 auto;
            max-width: 860px;
        }
        .trade-market-topbar-btn {
            background: #0f172a;
            color: #fff;
            border: none;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .trade-market-topbar-btn:hover {
            background: #1e293b;
        }
        .trade-market-topbar-btn.active {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.35);
        }
        .mobile-subsets-bar {
            display: none !important;
        }
        @media (max-width: 900px) {
            .mobile-subsets-bar:not([hidden]) {
                width: 100%;
                padding: 8px 10px;
                background: #f8fafc;
                border-top: 1px solid #e2e8f0;
                display: flex !important;
                flex-direction: column;
                gap: 6px;
            }
        }
        .msb-title {
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 0.08em;
            color: #0284c7;
            text-transform: uppercase;
        }
        .msb-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            max-height: 120px;
            overflow-y: auto;
        }

        /* Trade Market Dialog */
        .trade-market-dialog {
            width: min(720px, 94vw);
            border-radius: 14px;
            padding: 0;
            overflow: hidden;
            border: 1px solid #1e293b;
            background: #ffffff;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
        }
        .tmd-header {
            padding: 14px 18px;
            background: #0f172a;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .tmd-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .tmd-icon {
            font-size: 1.5rem;
        }
        .tmd-header h3 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 800;
            color: #f8fafc;
        }
        .tmd-subtitle {
            margin: 2px 0 0;
            font-size: 0.76rem;
            color: #94a3b8;
        }
        .tmd-body {
            padding: 16px 18px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            max-height: 65vh;
            overflow-y: auto;
            background: #f8fafc;
        }
        .tmd-split {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 12px;
            align-items: start;
        }
        @media (max-width: 640px) {
            .tmd-split { grid-template-columns: 1fr; }
        }
        .tmd-col {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-height: 200px;
        }
        .tmd-col-head {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .tmd-pill {
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        .tmd-pill-trade {
            background: rgba(239, 68, 68, 0.12);
            color: #dc2626;
            border: 1px solid #fca5a5;
        }
        .tmd-pill-need {
            background: rgba(16, 185, 129, 0.12);
            color: #059669;
            border: 1px solid #86efac;
        }
        .tmd-partner-select {
            width: 100%;
            padding: 4px 8px;
            font-size: 0.82rem;
            font-weight: 700;
        }
        .tmd-card-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
            max-height: 180px;
            overflow-y: auto;
        }
        .tmd-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 4px 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 0.78rem;
        }
        .tmd-exchange-icon {
            align-self: center;
            font-size: 1.5rem;
            color: #0284c7;
            font-weight: 900;
        }
        .tmd-match-summary {
            padding: 10px 14px;
            border-radius: 8px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            font-size: 0.84rem;
            font-weight: 700;
            text-align: center;
        }
        .tmd-footer {
            padding: 12px 18px;
            background: #fff;
            border-top: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }
        .btn-rig-market {
            background: #16a34a !important;
            border-color: #16a34a !important;
            color: #fff !important;
            font-weight: 800;
        }

        /* L-bar Customize Dialog */
        .lbar-customize-dialog {
            width: min(420px, 92vw);
            border-radius: 12px;
            padding: 16px;
        }
        .lcd-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 8px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            margin-bottom: 6px;
            font-size: 0.84rem;
            font-weight: 600;
            cursor: pointer;
        }

        /* ==========================================================
           DRAGGABLE & MOVABLE STATS & HEAT MAP OVERLAY HUD
           ("the base percentages, the above the ice and other series percentages... then all the heat maps of the popularity site wide. this should be on the tablet view and the iphone view always. all these overlays the user should be able to drag them and move them around stereatech and shift bump over move change windows")
           ========================================================== */
        .stats-hud-overlay {
            position: fixed;
            z-index: 46;
            user-select: none;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            transition: opacity 0.2s ease;
        }
        .stats-hud-overlay.hud-dock-bottom-right {
            right: 16px;
            bottom: 124px;
            left: auto !important;
            top: auto !important;
        }
        .stats-hud-overlay.hud-dock-bottom-left {
            left: 16px;
            bottom: 124px;
            right: auto !important;
            top: auto !important;
        }
        .stats-hud-overlay.hud-dock-top-left {
            left: 16px;
            top: 64px;
            right: auto !important;
            bottom: auto !important;
        }
        .stats-hud-overlay.hud-dock-top-right {
            right: 16px;
            top: 64px;
            left: auto !important;
            bottom: auto !important;
        }
        .stats-hud-overlay.hud-animating {
            transition: top 0.26s cubic-bezier(0.4, 0, 0.2, 1),
                        left 0.26s cubic-bezier(0.4, 0, 0.2, 1),
                        right 0.26s cubic-bezier(0.4, 0, 0.2, 1),
                        bottom 0.26s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.26s ease !important;
        }

        /* Minimized Mini Bar Pill */
        .stats-hud-mini-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(7, 11, 20, 0.94);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(59, 130, 246, 0.45);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.65), 0 0 12px rgba(37, 99, 235, 0.3);
            border-radius: 9999px;
            padding: 5px 10px;
            color: #f1f5f9;
            font-size: 0.74rem;
            font-weight: 700;
            max-width: 92vw;
            box-sizing: border-box;
        }
        .hud-mini-drag {
            cursor: grab;
            font-size: 0.92rem;
            color: #60a5fa;
            padding: 2px 4px;
            user-select: none;
            touch-action: none;
        }
        .hud-mini-drag:active {
            cursor: grabbing;
        }
        .hud-mini-label-btn {
            background: transparent;
            border: none;
            color: #f1f5f9;
            font-size: 0.72rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            padding: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 250px;
        }
        .hud-mini-label-btn:hover {
            color: #38bdf8;
        }

        /* Floating Window Container */
        .stats-hud-window {
            width: clamp(285px, 88vw, 360px);
            max-height: clamp(280px, 62vh, 460px);
            display: flex;
            flex-direction: column;
            background: rgba(8, 13, 25, 0.96);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(59, 130, 246, 0.4);
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.7), 0 0 20px rgba(37, 99, 235, 0.25);
            border-radius: 12px;
            overflow: hidden;
            color: #f1f5f9;
            box-sizing: border-box;
        }

        /* Window Header */
        .hud-header {
            background: linear-gradient(90deg, #091024 0%, #0f1c3d 50%, #091024 100%);
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
            padding: 7px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            cursor: grab;
            flex-shrink: 0;
            touch-action: none;
        }
        .hud-header:active {
            cursor: grabbing;
        }
        .hud-title-wrap {
            display: flex;
            align-items: center;
            gap: 6px;
            min-width: 0;
        }
        .hud-drag-icon {
            font-size: 0.95rem;
            color: #60a5fa;
            user-select: none;
        }
        .hud-title {
            font-size: 0.68rem;
            font-weight: 900;
            letter-spacing: 0.05em;
            color: #93c5fd;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .hud-live-dot {
            width: 6px;
            height: 6px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 8px #10b981;
            animation: hudPulse 1.8s infinite;
        }
        .hud-live-dot.mini {
            width: 5px;
            height: 5px;
        }
        @keyframes hudPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }

        .hud-tab-switcher {
            display: inline-flex;
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 6px;
            padding: 2px;
            gap: 2px;
        }
        .hud-tab-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            font-size: 0.64rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.15s ease;
            white-space: nowrap;
        }
        .hud-tab-btn:hover {
            color: #f1f5f9;
        }
        .hud-tab-btn.active {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 1px 4px rgba(37, 99, 235, 0.4);
        }

        .hud-actions {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-shrink: 0;
        }
        .hud-btn {
            background: rgba(30, 41, 59, 0.85);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.25);
            border-radius: 5px;
            font-size: 0.66rem;
            font-weight: 700;
            padding: 3px 6px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
        }
        .hud-btn:hover {
            background: #334155;
            color: #fff;
            border-color: #60a5fa;
        }
        .hud-btn-mini {
            padding: 2px 5px;
            font-size: 0.66rem;
        }
        .hud-bump-btn {
            background: #1e3a8a;
            color: #93c5fd;
            border-color: #3b82f6;
        }
        .hud-bump-btn:hover {
            background: #2563eb;
            color: #fff;
        }
        .hud-minimize-btn {
            font-weight: 900;
            line-height: 0.8;
        }
        .hud-close-btn:hover {
            background: #991b1b;
            color: #fff;
            border-color: #ef4444;
        }

        /* Body Content */
        .hud-scroll-body {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 8px 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            scrollbar-width: thin;
            scrollbar-color: #334155 transparent;
        }
        .hud-scroll-body::-webkit-scrollbar {
            width: 4px;
        }
        .hud-scroll-body::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }

        .hud-pane-section {
            display: flex;
            flex-direction: column;
            gap: 6px;
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(51, 65, 85, 0.6);
            border-radius: 8px;
            padding: 7px 8px;
        }
        .hud-pane-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
        }
        .hud-pane-title {
            font-size: 0.66rem;
            font-weight: 900;
            letter-spacing: 0.04em;
            color: #60a5fa;
            text-transform: uppercase;
        }
        .hud-pane-badge {
            font-size: 0.63rem;
            font-weight: 800;
            padding: 1px 6px;
            border-radius: 9999px;
            background: #1e293b;
            color: #94a3b8;
            border: 1px solid #334155;
        }
        .hud-pane-badge.active-good {
            background: #064e3b;
            color: #34d399;
            border-color: #059669;
        }

        /* Subsets List */
        .hud-subsets-list {
            display: flex;
            flex-direction: column;
            gap: 5px;
            max-height: 180px;
            overflow-y: auto;
            scrollbar-width: thin;
        }
        .hud-subset-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
            cursor: pointer;
            padding: 3px 5px;
            border-radius: 5px;
            transition: background 0.15s ease;
        }
        .hud-subset-item:hover {
            background: rgba(30, 41, 59, 0.8);
        }
        .hud-subset-item.is-base {
            border-left: 2px solid #f59e0b;
        }
        .hud-subset-item.is-ice {
            border-left: 2px solid #38bdf8;
        }
        .hud-subset-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.67rem;
            color: #e2e8f0;
        }
        .hud-subset-name {
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 170px;
        }
        .hud-subset-count {
            font-size: 0.63rem;
            color: #94a3b8;
            font-variant-numeric: tabular-nums;
        }
        .hud-subset-count strong {
            color: #38bdf8;
        }
        .hud-subset-track {
            height: 5px;
            background: #1e293b;
            border-radius: 9999px;
            overflow: hidden;
            position: relative;
        }
        .hud-subset-bar {
            height: 100%;
            border-radius: 9999px;
            background: linear-gradient(90deg, #2563eb 0%, #38bdf8 100%);
            transition: width 0.3s ease;
        }
        .hud-subset-item.is-base .hud-subset-bar {
            background: linear-gradient(90deg, #d97706 0%, #fbbf24 100%);
        }
        .hud-subset-item.is-ice .hud-subset-bar {
            background: linear-gradient(90deg, #0284c7 0%, #38bdf8 100%);
        }

        /* Site-Wide Popularity Heat Map */
        .hud-heatmap-canvas-container {
            position: relative;
            background: #020617;
            border: 1px solid #1e293b;
            border-radius: 6px;
            padding: 4px;
            overflow: hidden;
        }
        #hudSitewideHeatmapCanvas {
            display: block;
            width: 100%;
            height: 48px;
            cursor: crosshair;
        }
        .hud-heatmap-tooltip {
            position: absolute;
            bottom: 54px;
            left: 50%;
            transform: translateX(-50%);
            background: #0f172a;
            border: 1px solid #3b82f6;
            color: #f8fafc;
            font-size: 0.68rem;
            padding: 4px 8px;
            border-radius: 6px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.7);
            pointer-events: none;
            white-space: nowrap;
            z-index: 50;
        }
        .hud-heatmap-legend {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 4px;
            font-size: 0.61rem;
            color: #94a3b8;
            flex-wrap: wrap;
            margin-top: 2px;
        }
        .hud-legend-item {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .hud-swatch {
            width: 7px;
            height: 7px;
            border-radius: 2px;
        }
        .swatch-hot { background: #22c55e; }
        .swatch-mid { background: #f59e0b; }
        .swatch-rare { background: #ef4444; }
        .swatch-mine { background: #38bdf8; border: 1px solid #ffffff; }

        .hud-heatmap-tip {
            font-size: 0.61rem;
            color: #64748b;
            font-style: italic;
            line-height: 1.25;
        }

        /* HUD Footer */
        .hud-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid rgba(51, 65, 85, 0.5);
            padding-top: 6px;
            font-size: 0.63rem;
            color: #64748b;
        }
        .hud-sync-tag {
            color: #94a3b8;
            font-weight: 600;
        }
        .hud-footer-link {
            background: transparent;
            border: none;
            color: #60a5fa;
            font-size: 0.63rem;
            font-weight: 700;
            cursor: pointer;
            padding: 0;
        }
        .hud-footer-link:hover {
            color: #93c5fd;
            text-decoration: underline;
        }

        /* Tablet & Mobile specifics */
        @media (max-width: 1080px) {
            .stats-hud-overlay {
                bottom: 124px;
                right: 8px;
            }
            .stats-hud-window {
                width: clamp(275px, 94vw, 340px);
                max-height: 54vh;
            }
        }
        @media (max-width: 480px) {
            .stats-hud-overlay {
                bottom: 124px;
                right: 4px;
            }
            .stats-hud-window {
                width: calc(100vw - 8px);
                max-height: 50vh;
            }
            .hud-header {
                padding: 6px 8px;
            }
            .hud-title {
                font-size: 0.64rem;
            }
        }

        /* ==========================================================
           DIGIKEY-STYLE PARAMETRIC INVENTORY FILTER (FLY-IN / FLY-OUT DRAWER)
           ========================================================== */
        .ifs-drawer-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(2px);
            z-index: 1190;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.28s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .ifs-drawer-backdrop.open {
            opacity: 1;
            pointer-events: auto;
        }

        .inventory-filter-section {
            position: fixed;
            top: 0;
            left: 0;
            right: auto;
            bottom: var(--footer-height, 68px);
            width: 600px;
            max-width: min(600px, calc(100vw - 20px));
            height: calc(100vh - var(--footer-height, 68px));
            z-index: 1200;
            background: #ffffff;
            border: none;
            border-right: 1px solid #cbd5e1;
            border-radius: 0;
            margin: 0;
            box-shadow: 10px 0 35px rgba(0, 0, 0, 0.38);
            transform: translateX(-100%);
            transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #1e293b;
            visibility: hidden;
            pointer-events: none;
        }
        .inventory-filter-section.open {
            transform: translateX(0);
            visibility: visible;
            pointer-events: auto;
        }
        /* Keep target subsets and sheets visible below sticky header */
        details.set,
        .binder-page-sheet,
        .binder-grid-group,
        .cards-group,
        .card {
            scroll-margin-top: calc(var(--topbar-height, 53px) + 8px);
        }
        .ifs-header-bar {
            background: #0f172a;
            color: #ffffff;
            border-bottom: 1px solid #1e293b;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-shrink: 0;
        }
        .ifs-title-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .ifs-close-drawer-btn {
            background: #1e293b;
            color: #f8fafc;
            border: 1px solid #334155;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 5px 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background 0.15s ease, color 0.15s ease;
        }
        .ifs-close-drawer-btn:hover {
            background: #ef4444;
            border-color: #ef4444;
            color: #ffffff;
        }
        .ifs-flyout-trigger-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 11px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            background: #ffffff;
            color: #1e293b;
            border: 1px solid #cbd5e1;
            transition: all 0.15s ease;
            white-space: nowrap;
        }
        .ifs-flyout-trigger-btn:hover {
            background: #eff6ff;
            border-color: #3b82f6;
            color: #1d4ed8;
        }
        .ifs-flyout-trigger-btn.has-active {
            background: #eff6ff;
            border-color: #2563eb;
            color: #1d4ed8;
        }
        .ifs-active-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 18px;
            height: 18px;
            padding: 0 4px;
            border-radius: 9px;
            background: #e02424;
            color: #ffffff;
            font-size: 0.68rem;
            font-weight: 800;
            line-height: 1;
        }
        .ifs-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 0;
            overflow: hidden;
            background: #f8fafc;
        }
        .ifs-breadcrumbs {
            font-size: 0.74rem;
            color: #64748b;
        }
        .ifs-breadcrumbs span {
            color: #94a3b8;
            margin: 0 4px;
        }
        .ifs-main-title {
            font-size: 1.12rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.01em;
            margin: 2px 0 0;
        }
        .ifs-controls-top {
            padding: 10px 14px 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            border-bottom: 1px solid #f1f5f9;
            background: #ffffff;
        }
        .ifs-search-within-wrap {
            display: flex;
            align-items: center;
            position: relative;
            min-width: 260px;
            max-width: 420px;
            flex: 1;
        }
        .ifs-search-input {
            width: 100%;
            padding: 7px 34px 7px 12px;
            font-size: 0.85rem;
            border: 1px solid #94a3b8;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .ifs-search-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.18);
        }
        .ifs-search-icon {
            position: absolute;
            right: 10px;
            pointer-events: none;
            color: #64748b;
            font-size: 0.95rem;
        }
        .ifs-results-count {
            font-size: 0.9rem;
            color: #334155;
        }
        .ifs-results-count strong {
            font-size: 1.12rem;
            font-weight: 800;
            color: #0f172a;
        }
        .ifs-view-toggles {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 600;
        }
        .ifs-mode-btn-group {
            display: inline-flex;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            overflow: hidden;
        }
        .ifs-mode-btn {
            background: #fff;
            border: none;
            padding: 4px 10px;
            font-size: 0.78rem;
            font-weight: 700;
            color: #475569;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .ifs-mode-btn:hover {
            background: #f1f5f9;
        }
        .ifs-mode-btn.active {
            background: #1e293b;
            color: #ffffff;
        }
        .ifs-toggle-panel-btn {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            border-radius: 4px;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 5px 10px;
            cursor: pointer;
        }
        .ifs-toggle-panel-btn:hover {
            background: #dbeafe;
        }

        /* Parametric Columns Wrapper (Scrolling vs Stacked) */
        .ifs-columns-wrapper {
            padding: 10px 12px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            flex: 1;
            min-height: 0;
            overflow-y: auto;
        }
        .ifs-columns-wrapper.mode-scrolling {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            overflow-y: hidden;
            padding-bottom: 14px;
            scrollbar-width: thin;
            scrollbar-color: #94a3b8 #f1f5f9;
        }
        .ifs-columns-wrapper.mode-scrolling::-webkit-scrollbar {
            height: 10px;
        }
        .ifs-columns-wrapper.mode-scrolling::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        .ifs-columns-wrapper.mode-scrolling::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
        }
        .ifs-columns-wrapper.mode-stacked {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 10px;
        }

        /* Individual Parametric Box Column - Same height and scrolls */
        .ifs-col {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            display: flex;
            flex-direction: column;
            min-width: 200px;
            max-width: 235px;
            height: 220px;
            min-height: 220px;
            max-height: 220px;
            flex-shrink: 0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }
        .ifs-columns-wrapper.mode-stacked .ifs-col {
            min-width: 0;
            max-width: none;
            height: 210px;
            min-height: 210px;
            max-height: 210px;
        }
        .ifs-col-head {
            background: #eaeff5;
            border-bottom: 1px solid #cbd5e1;
            padding: 6px 10px;
            font-size: 0.78rem;
            font-weight: 800;
            color: #1e293b;
            letter-spacing: 0.02em;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .ifs-col-search-box {
            padding: 5px 8px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            flex-shrink: 0;
        }
        .ifs-col-search-input {
            width: 100%;
            padding: 4px 6px;
            font-size: 0.76rem;
            border: 1px solid #cbd5e1;
            border-radius: 3px;
            box-sizing: border-box;
            outline: none;
        }
        .ifs-col-search-input:focus {
            border-color: #2563eb;
        }
        .ifs-col-list {
            padding: 4px 0;
            flex: 1 1 0;
            min-height: 0;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
        }
        .ifs-col-list::-webkit-scrollbar {
            width: 6px;
        }
        .ifs-col-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .ifs-col-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            font-size: 0.77rem;
            color: #1e293b;
            cursor: pointer;
            transition: background 0.1s ease;
            user-select: none;
        }
        .ifs-col-item:hover {
            background: #f1f5f9;
        }
        .ifs-col-item.is-selected {
            background: #eff6ff;
            font-weight: 700;
        }
        .ifs-col-item input[type="checkbox"] {
            margin: 0;
            cursor: pointer;
            accent-color: #2563eb;
        }
        .ifs-item-text {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .ifs-item-count {
            font-size: 0.72rem;
            color: #64748b;
            font-variant-numeric: tabular-nums;
        }

        /* Bottom Action Bar */
        .ifs-actions-bar {
            background: #ffffff;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            flex-shrink: 0;
            border-top: 1px solid #cbd5e1;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }
        .ifs-actions-left {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }
        .ifs-apply-btn {
            background: #e02424;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 9px 24px;
            font-size: 0.94rem;
            font-weight: 800;
            cursor: pointer;
            transition: background 0.15s ease, transform 0.1s ease;
            box-shadow: 0 2px 6px rgba(224, 36, 36, 0.35);
        }
        .ifs-apply-btn:hover {
            background: #c81e1e;
        }
        .ifs-apply-btn:active {
            transform: scale(0.98);
        }
        .ifs-reset-btn {
            background: transparent;
            color: #0284c7;
            border: none;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: underline;
            padding: 4px 6px;
        }
        .ifs-reset-btn:hover {
            color: #0369a1;
        }
        .ifs-actions-right {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }
        .ifs-showing-text {
            font-size: 0.84rem;
            color: #475569;
        }
        .ifs-showing-text strong {
            color: #0f172a;
        }
        .ifs-sort-wrap {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.82rem;
            color: #475569;
            font-weight: 700;
        }
        .ifs-sort-select {
            padding: 5px 8px;
            font-size: 0.82rem;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            background: #fff;
            color: #0f172a;
            font-weight: 600;
            outline: none;
            cursor: pointer;
        }
        .ifs-download-btn {
            background: #ffffff;
            border: 1px solid #94a3b8;
            border-radius: 4px;
            color: #0f172a;
            font-size: 0.82rem;
            font-weight: 700;
            padding: 6px 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
        }
        .ifs-download-btn:hover {
            background: #f8fafc;
            border-color: #64748b;
        }
        /* ==========================================================================
           MCMASTER-CARR BY-JOB & SPECS CATALOG LENS
           ========================================================================== */
        .mc-catalog-wrapper {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
            overflow: hidden;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #0f172a;
        }
        .mc-top-accent {
            height: 3px;
            background: #f5b800; /* Signature McMaster Golden Yellow */
            width: 100%;
        }
        .mc-header-bar {
            padding: 10px 16px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .mc-breadcrumbs {
            font-size: 0.82rem;
            color: #64748b;
        }
        .mc-breadcrumbs span {
            color: #94a3b8;
            margin: 0 4px;
        }
        .mc-breadcrumbs strong {
            color: #13683a; /* Signature McMaster Hunter Green */
        }
        .mc-view-toggles {
            display: inline-flex;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 2px;
            gap: 2px;
        }
        .mc-mode-toggle {
            padding: 4px 10px;
            font-size: 0.78rem;
            font-weight: 700;
            border-radius: 3px;
            border: none;
            background: transparent;
            color: #475569;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .mc-mode-toggle:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .mc-mode-toggle.active {
            background: #13683a;
            color: #ffffff;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        .mc-catalog-body {
            display: grid;
            grid-template-columns: 240px 1fr;
            min-height: 600px;
        }
        @media (max-width: 920px) {
            .mc-catalog-body {
                grid-template-columns: 1fr;
            }
        }
        /* Left Sidebar: "Choose a Category / Job" */
        .mc-sidebar {
            background: #f8fafc;
            border-right: 1px solid #e2e8f0;
            padding: 16px 14px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .mc-sidebar-section-title {
            font-size: 0.84rem;
            font-weight: 800;
            color: #0f172a;
            padding-bottom: 4px;
            border-bottom: 2px solid #f5b800;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .mc-sidebar-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        .mc-sidebar-btn {
            width: 100%;
            text-align: left;
            background: transparent;
            border: none;
            padding: 6px 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #334155;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.12s ease;
        }
        .mc-sidebar-btn:hover {
            background: #e7f7ed;
            color: #13683a;
            font-weight: 700;
        }
        .mc-sidebar-btn.active {
            background: #13683a;
            color: #ffffff;
            font-weight: 700;
        }
        .mc-sidebar-badge {
            font-size: 0.7rem;
            font-weight: 700;
            background: #e2e8f0;
            color: #475569;
            padding: 1px 6px;
            border-radius: 10px;
        }
        .mc-sidebar-btn.active .mc-sidebar-badge {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }
        .mc-filter-box {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 8px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        /* Right Main Panel */
        .mc-main-panel {
            padding: 18px 22px;
            background: #ffffff;
            overflow-x: hidden;
        }
        .mc-summary-banner {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 20px;
        }
        .mc-summary-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
        }
        .mc-summary-stats {
            font-size: 0.82rem;
            color: #475569;
            font-weight: 600;
        }
        .mc-job-group {
            margin-bottom: 34px;
        }
        .mc-section-h2 {
            font-size: 1.15rem;
            font-weight: 800;
            color: #13683a; /* McMaster Hunter Green */
            margin: 0 0 4px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #13683a;
            padding-bottom: 4px;
        }
        .mc-section-counts {
            font-size: 0.8rem;
            font-weight: 700;
            color: #475569;
        }
        .mc-section-desc {
            font-size: 0.8rem;
            line-height: 1.4;
            color: #475569;
            margin: 6px 0 14px 0;
            background: #f8fafc;
            border-left: 3px solid #13683a;
            padding: 6px 10px;
            border-radius: 0 4px 4px 0;
        }
        /* Visual Catalog Mode */
        .mc-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(105px, 1fr));
            gap: 16px 12px;
            align-items: start;
        }
        .card.mc-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
            transition: transform 0.15s ease;
        }
        .card.mc-card:hover {
            transform: translateY(-2px);
        }
        .mc-thumb {
            width: 82px;
            height: 110px;
            border-radius: 4px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 4px;
            position: relative;
            transition: all 0.15s ease;
        }
        .card.mc-card:hover .mc-thumb {
            border-color: #13683a;
            box-shadow: 0 4px 10px rgba(19, 104, 58, 0.18);
        }
        .card.mc-card.collected .mc-thumb {
            border: 1.5px solid #13683a;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
        }
        .card.mc-card.doubles .mc-thumb {
            border: 1.5px solid #d97706;
            background: linear-gradient(135deg, #ffffff 0%, #fffbeb 100%);
        }
        .card.mc-card.missing .mc-thumb {
            border: 1.5px dashed #94a3b8;
            background: #f8fafc;
        }
        .mc-thumb-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .mc-num-badge {
            font-size: 0.62rem;
            font-weight: 800;
            color: #ffffff;
            background: #0f172a;
            padding: 1px 4px;
            border-radius: 2px;
        }
        .card.mc-card.collected .mc-num-badge {
            background: #13683a;
        }
        .card.mc-card.doubles .mc-num-badge {
            background: #d97706;
        }
        .card.mc-card.missing .mc-num-badge {
            background: #64748b;
        }
        .mc-pos-badge {
            font-size: 0.6rem;
            font-weight: 800;
            color: #475569;
            background: #e2e8f0;
            padding: 1px 3px;
            border-radius: 2px;
        }
        .mc-thumb-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 0;
            padding: 2px 0;
        }
        .mc-jersey-icon {
            font-size: 1.6rem;
            line-height: 1;
            filter: drop-shadow(0 1px 1px rgba(0,0,0,0.1));
        }
        .card.mc-card.missing .mc-jersey-icon {
            opacity: 0.35;
            filter: grayscale(1);
        }
        .mc-thumb-foot {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .mc-status-pill {
            font-size: 0.6rem;
            font-weight: 800;
            padding: 1px 4px;
            border-radius: 3px;
            white-space: nowrap;
        }
        .card.mc-card.collected .mc-status-pill {
            color: #13683a;
            background: #bbf7d0;
        }
        .card.mc-card.doubles .mc-status-pill {
            color: #92400e;
            background: #fef08a;
        }
        .card.mc-card.missing .mc-status-pill {
            color: #64748b;
            background: #e2e8f0;
        }
        .mc-card-caption {
            margin-top: 5px;
            width: 100%;
            max-width: 95px;
        }
        .mc-player-name {
            font-size: 0.72rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.22;
            word-break: break-word;
        }
        .mc-player-role {
            font-size: 0.65rem;
            font-weight: 600;
            color: #13683a;
            margin-top: 1px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .mc-player-timeline {
            font-size: 0.62rem;
            color: #64748b;
            font-weight: 600;
        }
        /* Engineering Specs Table Mode */
        .mc-spec-table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            margin-bottom: 24px;
        }
        .mc-spec-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.78rem;
            text-align: left;
            white-space: nowrap;
        }
        .mc-spec-table th {
            background: #f8fafc;
            color: #0f172a;
            font-weight: 800;
            padding: 8px 10px;
            border-bottom: 2px solid #13683a;
            border-right: 1px solid #e2e8f0;
            cursor: pointer;
            user-select: none;
        }
        .mc-spec-table th:hover {
            background: #f1f5f9;
        }
        .mc-spec-table td {
            padding: 6px 10px;
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid #f1f5f9;
            color: #334155;
            vertical-align: middle;
        }
        .mc-spec-table tbody tr:hover {
            background: #f0fdf4;
        }
        .mc-part-num {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-weight: 700;
            color: #13683a;
            text-decoration: underline;
            cursor: pointer;
        }
        .mc-table-btn {
            background: #13683a;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 3px 8px;
            cursor: pointer;
            transition: background 0.12s ease;
        }
        .mc-table-btn:hover {
            background: #0f512c;
        }
        /* Detail Popover / Flyout (Screenshot 3) */
        .mc-detail-drawer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 360px;
            max-width: calc(100vw - 32px);
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-shadow: 0 10px 28px rgba(0,0,0,0.18);
            z-index: 1000;
            display: flex;
            overflow: hidden;
            animation: mcSlideIn 0.2s ease-out;
        }
        @keyframes mcSlideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .mc-drawer-yellow-stripe {
            width: 6px;
            background: #f5b800;
            flex-shrink: 0;
        }
        .mc-drawer-content {
            flex: 1;
            padding: 14px 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: 80vh;
            overflow-y: auto;
        }
        .mc-drawer-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 8px;
        }
        .mc-drawer-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            line-height: 1;
            cursor: pointer;
            color: #64748b;
        }
        .mc-drawer-close:hover {
            color: #0f172a;
        }
        .mc-drawer-img-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 8px;
            min-height: 120px;
        }
        .mc-drawer-img {
            max-height: 120px;
            max-width: 100%;
            object-fit: contain;
            border-radius: 3px;
        }
        .mc-drawer-specs-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 12px;
            background: #f8fafc;
            padding: 8px 10px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
            font-size: 0.76rem;
        }
        .mc-drawer-spec-item strong {
            color: #0f172a;
        }
        .mc-order-box {
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 10px;
            background: #fafafa;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .mc-add-btn {
            background: #13683a; /* McMaster Green */
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 0.84rem;
            font-weight: 800;
            padding: 9px 12px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            transition: background 0.12s ease;
        }
        .mc-add-btn:hover {
            background: #0e4c29;
        }
    </style>
</head>
<body>

<!-- MAIN APP -->
<div class="app-layout" id="appLayout">
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- LEFT BAR ("the left we call it the left bar - remain fixed all the time") -->
    <aside class="sidebar left-bar" id="sidebar">
        <div class="sidebar-brand">
            <h2>🏒 Cards.kuzub.com</h2>
            <button class="close-sidebar-btn" id="closeSidebarBtn" aria-label="Close menu">✕</button>
        </div>

        <div class="sidebar-content">
            <!-- Series Quick Links & Sheet Jump Menu placed at the top on left side ("this should be on side or top the left side") -->
            <nav class="series-nav-panel left-bar-series-nav" id="seriesNavPanel" aria-label="Series quick links and sheet jump menu">
                <div class="series-nav-header">
                    <span class="series-nav-title">⚡ Subsets &amp; Quick Jump</span>
                </div>
                <div class="series-chips-row" id="seriesChipsRow"></div>
                <div class="series-sublist-row" id="seriesSublistRow"></div>
            </nav>

            <!-- Hockey Category -->
            <div id="sidebarHockeySection">
                <div class="menu-section-title">Hockey</div>
                <nav class="menu-nav">
                    <div class="menu-item active" id="menuSeries2026" data-series="2026-27">
                        <div class="menu-item-row">
                            <span class="menu-series-name">2026-27 UD Tim Hortons</span>
                            <span class="menu-badge" id="menuSeriesBadge">$1 / acct</span>
                        </div>
                        <div class="menu-subtext">Current Season Checklist</div>
                    </div>
                    <div class="menu-item" id="menuSeries2025" data-series="2025-26">
                        <div class="menu-item-row">
                            <span class="menu-series-name">2025-26 Tim Hortons</span>
                            <span class="menu-badge">Archive</span>
                        </div>
                        <div class="menu-subtext">Bronzo's Collection (234 cards)</div>
                    </div>
                </nav>
            </div>

            <!-- Team Hub Section -->
            <div class="team-hub" id="teamHubSection" hidden>
                <div class="team-hub-header">
                    <span class="team-title">🏒 Team <span id="sideTeamName"></span></span>
                </div>
                <div class="team-progress-bar">
                    <div id="sideTeamBarFill" style="width: 0%"></div>
                </div>
                <div class="team-progress-meta">
                    <span id="sideTeamCollectedText">0/0 cards</span>
                    <strong id="sideTeamPctText">0%</strong>
                </div>
                <button type="button" class="view-team-btn" id="sideViewTeamBtn">👥 View Team Progress</button>
                <div class="teammates-list-title">Teammates</div>
                <div class="teammates-list" id="sideTeamMembers"></div>
            </div>
        </div>

        <!-- Sidebar Footer (L Bar Space: Rotating Stats corner widget instead of static login info) -->
        <div class="sidebar-footer" id="sidebarFooter">
            <!-- Rotating Collection Stats Widget in bottom-left footer corner -->
            <div class="side-rotating-stats-widget" id="sideRotatingStatsWidget">
                <div class="srw-header">
                    <div class="srw-title-wrap">
                        <span class="srw-live-dot"></span>
                        <span class="srw-badge-title">COLLECTION STATS</span>
                    </div>
                    <div class="srw-controls">
                        <button type="button" class="srw-btn srw-speed-btn" id="srwSpeedBtn" title="Broadcast & Rotating Stats Speed (0.5x, 1x, 2x, 5x)">⚡ 1x</button>
                        <button type="button" class="srw-btn srw-nav-btn" id="srwPrevCardBtn" title="Previous Stat">‹</button>
                        <button type="button" class="srw-btn srw-nav-btn" id="srwNextCardBtn" title="Next Stat">›</button>
                    </div>
                </div>
                <div class="srw-card-stage" id="srwStage" title="Click to filter cards by this stat">
                    <!-- Populated dynamically via renderRotatingStats() -->
                </div>
                <div class="srw-dots-row" id="srwDotsRow"></div>
            </div>

            <!-- Compact User Profile Strip & Actions (Redundant with Right Bar Collector Profile) -->
            <div class="side-user-strip" id="sideUserStrip" style="display: none;">
                <div class="user-summary">
                    <span><strong id="sideUserName"></strong></span>
                    <span class="user-team-badge" id="sideUserTeamBadge"></span>
                </div>
                <div class="sidebar-actions">
                    <a href="admin.php" id="sideAdminLink" class="admin-link-btn" hidden>⚙️ Admin</a>
                    <button type="button" id="editTeamBtn">Team ⚙️</button>
                    <button type="button" id="signOutBtn" onclick="handleSignOut(event)" class="primary">Sign out</button>
                </div>
            </div>

            <div class="side-widget-customizer">
                <button type="button" class="btn-customize-widgets" id="btnCustomizeWidgets" title="Customize L-bar widgets">⚙️ Customize L-Bar</button>
            </div>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <div class="content-area">
        <header class="topbar">
            <!-- Row 1: Primary Controls - Head emoji behind hamburger at top left, filters on left top, layout and tools on right -->
            <div class="bar topbar-main-row">
                <div class="topbar-left-group">
                    <button class="topbar-nav-btn mobile-menu-btn" id="openSidebarBtn" title="Toggle left sidebar (checklist &amp; subsets)" aria-label="Open menu">☰</button>
                    <button class="topbar-nav-btn mobile-menu-btn" id="openRightBarBtn" title="Toggle collector profile &amp; options" aria-label="Open collector options">👤</button>

                    <div class="filters" id="filters">
                        <button data-filter="all" class="active">All</button>
                        <button data-filter="missing">Missing</button>
                        <button data-filter="doubles">My Doubles</button>
                        <button data-filter="trade" title="Your doubles, plus cards you're missing that teammates have doubles of">For Trade</button>
                        <button data-filter="team_needs" id="teamNeedsFilterBtn" hidden title="Cards nobody on your team has collected yet">Team Needs</button>
                    </div>

                    <button type="button" class="ifs-flyout-trigger-btn" id="ifsFlyoutTriggerBtn" title="Detailed Parametric Filter (Flies in from left)">⚡ Detailed Filters <span id="ifsFilterActiveBadge" class="ifs-active-badge" hidden>0</span></button>
                </div>

                <div class="topbar-right-cluster">
                    <div class="topbar-layout-switcher layout-switcher" id="topbarLayoutSwitcher" title="View Layout Style">
                        <button type="button" class="layout-btn" data-layout="list" title="Compact List view">☰ List</button>
                        <button type="button" class="layout-btn" data-layout="page" title="3x3 Binder Page Sheet view">📄 3×3 by Filter</button>
                        <button type="button" class="layout-btn layout-btn-mc" data-layout="job" data-job-mode="visual" title="McMaster Visual Grid with Player Cards & Roles"><span class="layout-btn-mc-icon">🖼️</span> Visual Catalog</button>
                        <button type="button" class="layout-btn layout-btn-mc" data-layout="job" data-job-mode="table" title="McMaster Engineering Specification Table with Timelines & Specs"><span class="layout-btn-mc-icon">📊</span> Engineering Specs Table</button>
                    </div>
                    <button type="button" class="trade-market-topbar-btn" id="topbarStatsHudBtn" title="Toggle Live Stats & Heat Map HUD">📊 HUD</button>
                    <button type="button" class="trade-market-topbar-btn" id="topbarTradeMarketBtn" title="Offer Trade / Simulate Card Market">🤝 Market</button>
                </div>
            </div>

            <!-- Row 2: Sub-row - Series Context & Viewing Selector (Saves space, compact height) -->
            <div class="bar topbar-sub-row">
                <div class="topbar-sub-left">
                    <h1 class="topbar-title">
                        <span id="topbarSeriesTitle">2026-27 UD Tim Hortons</span>
                        <span class="series-tag" id="topbarSeriesTag">$1 / account</span>
                    </h1>
                    <button type="button" class="mobile-subsets-btn" id="mobileSubsetsBtn" title="Subsets & Quick Jump">⚡ Subsets</button>
                </div>
                <div class="topbar-sub-right">
                    <label class="overall">Viewing
                        <select id="viewSelect" aria-label="Viewing collection"></select>
                    </label>
                    <button type="button" id="newCollectorTopbarBtn" class="primary">+ Collector</button>
                </div>
            </div>
            <!-- Mobile Subsets Slide-Down Bar -->
            <div class="mobile-subsets-bar" id="mobileSubsetsBar" hidden>
                <div class="msb-title">⚡ QUICK JUMP SUBSETS</div>
                <div class="msb-chips" id="mobileSubsetsChips"></div>
            </div>
        </header>

        <main id="main">
            <!-- DYNAMIC CARDS CONTAINER (Center is 95% List and Views) -->
            <div id="cardsContainer"></div>
        </main>

        <!-- PARAMETRIC INVENTORY FILTER DRAWER (Flies in / flies out from the right) -->
        <div class="ifs-drawer-backdrop" id="ifsDrawerBackdrop" aria-hidden="true"></div>
        <aside class="inventory-filter-section" id="inventoryFilterSection" aria-label="Parametric Inventory and Checklist Filter">
            <div class="ifs-header-bar">
                <div class="ifs-title-group">
                    <div>
                        <div class="ifs-breadcrumbs">Product Index <span>›</span> Cards <span>›</span> <strong id="ifsBreadcrumbSeries">2026-27 UD Tim Hortons</strong></div>
                        <h2 class="ifs-main-title">Inventory &amp; Checklist Filter</h2>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:8px;">
                    <button type="button" class="ifs-close-drawer-btn" id="ifsCloseDrawerBtn" title="Close Filter Drawer (Esc)">✕ Close</button>
                </div>
            </div>

            <div class="ifs-body" id="ifsBody">
                    <div class="ifs-controls-top">
                        <div class="ifs-search-within-wrap">
                            <input type="search" id="ifsSearchWithin" class="ifs-search-input" placeholder="Search Within (Player, Card #, Subset...)" autocomplete="off">
                            <span class="ifs-search-icon">🔍</span>
                        </div>
                        <div class="ifs-results-count">Results: <strong id="ifsTopResultsCount">135</strong></div>
                        <div class="ifs-view-toggles">
                            <span>Filters</span>
                            <div class="ifs-mode-btn-group">
                                <button type="button" class="ifs-mode-btn" id="ifsModeStacked">Stacked</button>
                                <button type="button" class="ifs-mode-btn active" id="ifsModeScrolling">Scrolling</button>
                            </div>
                        </div>
                    </div>

                    <!-- Parametric Columns Row -->
                    <div class="ifs-columns-wrapper mode-scrolling" id="ifsColumnsWrapper">
                        <!-- Column 1: Common Attributes / Collection Status -->
                        <div class="ifs-col" data-col="status">
                            <div class="ifs-col-head">Common Attributes</div>
                            <div class="ifs-col-search-box">
                                <input type="text" class="ifs-col-search-input" placeholder="Search Filter" data-target="ifsColStatusList">
                            </div>
                            <div class="ifs-col-list" id="ifsColStatusList">
                                <!-- Populated dynamically -->
                            </div>
                        </div>

                        <!-- Column 2: Card Series -->
                        <div class="ifs-col" data-col="series">
                            <div class="ifs-col-head">Card Series</div>
                            <div class="ifs-col-search-box">
                                <input type="text" class="ifs-col-search-input" placeholder="Search Filter" data-target="ifsColSeriesList">
                            </div>
                            <div class="ifs-col-list" id="ifsColSeriesList">
                                <!-- Populated dynamically -->
                            </div>
                        </div>

                        <!-- Column 3: Checklist Year -->
                        <div class="ifs-col" data-col="year">
                            <div class="ifs-col-head">Checklist Year</div>
                            <div class="ifs-col-search-box">
                                <input type="text" class="ifs-col-search-input" placeholder="Search Filter" data-target="ifsColYearList">
                            </div>
                            <div class="ifs-col-list" id="ifsColYearList">
                                <!-- Populated dynamically -->
                            </div>
                        </div>

                        <!-- Column 4: Subsets / Inserts -->
                        <div class="ifs-col" data-col="subsets">
                            <div class="ifs-col-head">Subsets / Inserts</div>
                            <div class="ifs-col-search-box">
                                <input type="text" class="ifs-col-search-input" placeholder="Search Filter" data-target="ifsColSubsetsList">
                            </div>
                            <div class="ifs-col-list" id="ifsColSubsetsList">
                                <!-- Populated dynamically -->
                            </div>
                        </div>

                        <!-- Column 4: Card Number Range -->
                        <div class="ifs-col" data-col="ranges">
                            <div class="ifs-col-head">Card Number Range</div>
                            <div class="ifs-col-search-box">
                                <input type="text" class="ifs-col-search-input" placeholder="Search Filter" data-target="ifsColRangesList">
                            </div>
                            <div class="ifs-col-list" id="ifsColRangesList">
                                <!-- Populated dynamically -->
                            </div>
                        </div>

                        <!-- Column 5: Scarcity / Popularity Tier -->
                        <div class="ifs-col" data-col="scarcity">
                            <div class="ifs-col-head">Circulation / Scarcity</div>
                            <div class="ifs-col-search-box">
                                <input type="text" class="ifs-col-search-input" placeholder="Search Filter" data-target="ifsColScarcityList">
                            </div>
                            <div class="ifs-col-list" id="ifsColScarcityList">
                                <!-- Populated dynamically -->
                            </div>
                        </div>

                        <!-- Column 6: Quantity in Collection -->
                        <div class="ifs-col" data-col="quantity">
                            <div class="ifs-col-head">Quantity in Deck</div>
                            <div class="ifs-col-search-box">
                                <input type="text" class="ifs-col-search-input" placeholder="Search Filter" data-target="ifsColQuantityList">
                            </div>
                            <div class="ifs-col-list" id="ifsColQuantityList">
                                <!-- Populated dynamically -->
                            </div>
                        </div>

                        <!-- Column 7: Player Name -->
                        <div class="ifs-col" data-col="players">
                            <div class="ifs-col-head">Player Name</div>
                            <div class="ifs-col-search-box">
                                <input type="text" class="ifs-col-search-input" placeholder="Search Filter" data-target="ifsColPlayersList">
                            </div>
                            <div class="ifs-col-list" id="ifsColPlayersList">
                                <!-- Populated dynamically -->
                            </div>
                        </div>

                        <!-- Column 8: Trading Partner Doubles -->
                        <div class="ifs-col" data-col="partners">
                            <div class="ifs-col-head">Partner Doubles (Trade)</div>
                            <div class="ifs-col-search-box">
                                <input type="text" class="ifs-col-search-input" placeholder="Search Filter" data-target="ifsColPartnersList">
                            </div>
                            <div class="ifs-col-list" id="ifsColPartnersList">
                                <!-- Populated dynamically -->
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Action Bar -->
                    <div class="ifs-actions-bar">
                        <div class="ifs-actions-left">
                            <button type="button" class="ifs-apply-btn" id="ifsApplyBtn">Apply All</button>
                            <button type="button" class="ifs-reset-btn" id="ifsResetBtn">Clear / Reset</button>
                            <span class="ifs-results-count"><strong id="ifsBottomResultsCount">135</strong> Results</span>
                        </div>
                        <div class="ifs-actions-right">
                            <span class="ifs-showing-text" id="ifsShowingText">Showing <strong>135</strong> of 135 Cards</span>
                            <div class="ifs-sort-wrap">
                                <span>Sort By:</span>
                                <select id="ifsSortBy" class="ifs-sort-select">
                                    <option value="featured">Featured (Checklist Order)</option>
                                    <option value="num_asc">Card # (Ascending 1 → 100)</option>
                                    <option value="num_desc">Card # (Descending 100 → 1)</option>
                                    <option value="player_asc">Player Name (A → Z)</option>
                                    <option value="player_desc">Player Name (Z → A)</option>
                                    <option value="set_asc">Subset Name (A → Z)</option>
                                    <option value="qty_desc">Quantity Owned (High → Low)</option>
                                    <option value="hot_desc">Popularity Site-wide (Most Owned)</option>
                                    <option value="rare_desc">Rarity Site-wide (Fewest Owned)</option>
                                </select>
                            </div>
                            <button type="button" class="ifs-download-btn" id="ifsDownloadTableBtn" title="Download current filtered checklist table as CSV">📥 Download Table</button>
                        </div>
                    </div>
                </div>
        </aside>

        <!-- BROADCAST DUAL FOOTER: SELECTION DESK TICKER + SET SPECTRUM -->
        <!-- ("this is so goo d that it should be the footer below the selection desk") -->
        <footer class="app-broadcast-footer" id="appBroadcastFooter" aria-label="Selection Desk and Set Spectrum Footer">
            <!-- Row 1: SELECTION DESK FOOTER TICKER -->
            <div class="election-footer-ticker" id="electionFooterTicker" aria-label="Selection Desk Footer Ticker">
                <div class="eft-desk-badge">
                    <span class="eft-live-dot"></span>
                    <span class="eft-badge-title">SELECTION DESK</span>
                </div>
                <div class="eft-call-chip" id="eftCallChip" title="Click to alternate graph metrics (Completeness, Spectrum, Subsets, Trade)">
                    <span class="eft-call-lbl" id="eftCallLbl">CALL:</span>
                    <span class="eft-call-val" id="eftCallVal">0/0 SECURED</span>
                </div>
                <div class="eft-viewport" id="eftViewport">
                    <div class="eft-stream" id="eftStream">
                        <!-- Populated dynamically: walk through collection cards + breaking set calls -->
                    </div>
                </div>
                <div class="eft-actions">
                    <button type="button" class="eft-btn eft-speed-btn" id="eftSpeedBtn" title="Broadcast Speed (Click to cycle: 0.5x, 1x, 2x, 5x)">⚡ 1x</button>
                    <button type="button" class="eft-btn" id="eftPrevBtn" title="Scroll Previous" aria-label="Previous">‹</button>
                    <button type="button" class="eft-btn eft-pause-btn" id="eftPauseBtn" title="Pause / Resume Ticker" aria-label="Pause/Resume">⏸</button>
                    <button type="button" class="eft-btn" id="eftNextBtn" title="Scroll Next" aria-label="Next">›</button>
                </div>
            </div>

            <!-- Row 2: SET SPECTRUM FOOTER DOCK ("this is so goo d that it should be the footer below the selection desk") -->
            <div class="footer-spectrum-dock" id="footerSpectrumDock" aria-label="Set Spectrum Collection Map">
                <div class="fsd-header">
                    <div class="fsd-title-group">
                        <span class="fsd-badge">📊 SET SPECTRUM</span>
                        <button type="button" class="fsd-width-btn" id="fsdWidthToggleBtn" title="Toggle Narrow / Wide Spectrum View">↔ Wide</button>
                        <span class="fsd-hint" id="footerSpectrumHint">Interactive Map (Hover or Click to Jump)</span>
                    </div>
                    <div class="fsd-meta" id="fsdMeta" title="Click to toggle between collection stats and spectrum legend">
                        <span class="fsd-fader-item fsd-counts active" id="footerSpectrumCounts">0 Owned · 0 Needed · 0 Trade</span>
                        <div class="fsd-fader-item fsd-legend" id="footerSpectrumLegend">
                            <span class="leg-item leg-owned">🟩 Owned</span>
                            <span class="leg-item leg-doubles">🟥 2x Trade</span>
                            <span class="leg-item leg-needed">🟩 🔻 Needed</span>
                        </div>
                    </div>
                </div>
                <div class="fsd-canvas-wrap is-wide" id="fsdCanvasWrap">
                    <canvas id="footerSpectrumCanvas" height="52" title="Click or hover any card in the collection"></canvas>
                    <div id="fsdMagnifier" class="fsd-magnifier" style="display: none;"></div>
                </div>
            </div>
        </footer>
    </div>

    <!-- RIGHT BAR ("the right side bar... we call it the right bare - remain fixed all the time") -->
    <aside class="right-bar" id="rightBar" aria-label="Collector options and controls">
        <div class="right-bar-top-row">
            <span class="right-bar-badge">Collector Profile</span>
            <button class="close-sidebar-btn" id="closeRightBarBtn" aria-label="Close right bar">✕</button>
        </div>

        <!-- RIGHT BAR AT TOP: User Profile Pill / Account Widget ("then right bar at top") -->
        <div class="right-bar-account" id="topbarAccount">
            <div class="account-pill" id="accountPill" hidden>
                <div class="account-pill-main">
                    <span class="account-avatar">👤</span>
                    <div class="account-meta">
                        <span class="account-name" id="topbarUserName">Bronzo</span>
                        <span class="account-team" id="topbarUserTeam" title="Click to view or edit team">No team</span>
                    </div>
                </div>
                <div class="account-pill-actions">
                    <a href="admin.php" class="btn-topbar-admin" id="topbarAdminBtn" hidden title="Admin Dashboard">⚙️ Admin</a>
                    <button type="button" class="btn-topbar-edit-team" id="topbarEditTeamBtn" title="Change Team">Team ⚙️</button>
                    <button type="button" class="btn-topbar-signout" id="topbarSignOutBtn" onclick="handleSignOut(event)" title="Sign out of this collector account">Sign Out</button>
                </div>
            </div>
            <button type="button" class="btn-topbar-signin" id="topbarSignInBtn" hidden>Sign In / Register</button>
        </div>

        <!-- MY COLLECTION STATS ("between account and view layout") -->
        <div class="right-bar-section right-bar-collection-stats" id="collectorDashboardUnit">
            <div class="right-bar-section-title" id="sentenceUserText">👤 My collection:</div>
            <div class="collector-sentence-wrap">
                <div class="sentence-stats-group" id="collectionHighlightDeck">
                    <button type="button" class="stat-sentence-pill deck-card have active" id="statHaveBtn" data-filter="all" title="Click to view all collected cards">
                        <span class="stat-num" id="deckHaveVal">0</span>
                        <span class="stat-emoji">✅</span>
                        <span class="stat-word">have</span>
                    </button>
                    <button type="button" class="stat-sentence-pill deck-card need" id="statNeedBtn" data-filter="missing" title="Click to view missing cards needed">
                        <span class="stat-num" id="deckNeedVal">0</span>
                        <span class="stat-emoji">❓</span>
                        <span class="stat-word">needed</span>
                    </button>
                    <button type="button" class="stat-sentence-pill deck-card doubles" id="statTradeBtn" data-filter="doubles" title="Click to view doubles for trade">
                        <span class="stat-num" id="deckDoublesVal">0</span>
                        <span class="stat-emoji">🔁</span>
                        <span class="stat-word">trade</span>
                    </button>
                    <button type="button" class="stat-sentence-pill deck-card team" id="deckTeamCard" hidden data-filter="team_needs" title="Click to view team cards / coverage">
                        <span class="stat-emoji">👥</span>
                        <span class="stat-word">Team:</span>
                        <span class="stat-num" id="deckTeamVal">0</span>
                    </button>
                </div>
                <div id="deckSubsWrap" hidden>
                    <span id="deckHaveSub"></span>
                    <span id="deckNeedSub"></span>
                    <span id="deckDoublesSub"></span>
                    <span id="deckTeamSub"></span>
                </div>
            </div>

            <!-- Hidden holders for legacy VU readouts so all JS bindings remain valid -->
            <div id="vuLegacyHousing" hidden>
                <div id="vuMeterHousing"><div id="vuMeterFill"></div><div id="vuChannelLabel"></div></div>
                <div id="vuStatHave"><span id="vuStatHaveNum">0</span><span id="vuStatHavePct">0%</span></div>
                <div id="vuStatNeed"><span id="vuStatNeedNum">0</span></div>
                <div id="vuStatDoubles"><span id="vuStatDoublesNum">0</span></div>
                <div id="vuStatTeam"><span id="vuStatTeamNum">0</span><span id="vuStatTeamPct">0%</span></div>
            </div>
        </div>

        <!-- SUBSETS & QUICK JUMP (Moved to left sidebar - hidden here to remove redundancy) -->
        <div class="right-bar-section right-bar-quick-jump" id="rightBarQuickJump" style="display: none;">
            <div class="right-bar-section-title">⚡ Subsets &amp; Quick Jump</div>
            <div class="rb-quick-jump-container" id="rbQuickJumpContainer">
                <select id="rbQuickJumpSelect" class="rb-quick-jump-select" aria-label="Jump directly to subset">
                    <option value="">Jump to subset...</option>
                </select>
                <div class="rb-quick-jump-chips" id="rbQuickJumpChips"></div>
            </div>
        </div>

        <!-- TOGGLE PAGE VIEW / LIST VIEW (Moved to topbar - hidden here to remove redundancy) -->
        <div class="right-bar-section" style="display: none;">
            <div class="right-bar-section-title">View Layout</div>
            <div class="layout-switcher right-bar-layout-switcher" id="layoutSwitcher">
                <button type="button" class="layout-btn" data-layout="list" title="Compact List view">☰ List</button>
                <button type="button" class="layout-btn" data-layout="page" title="3x3 Binder Page Sheet view">📄 3×3 by Filter</button>
                <button type="button" class="layout-btn layout-btn-mc" data-layout="job" data-job-mode="visual" title="McMaster Visual Grid with Player Cards & Roles"><span class="layout-btn-mc-icon">🖼️</span> Visual Catalog</button>
                <button type="button" class="layout-btn layout-btn-mc" data-layout="job" data-job-mode="table" title="McMaster Engineering Specification Table with Timelines & Specs"><span class="layout-btn-mc-icon">📊</span> Engineering Specs Table</button>
            </div>
        </div>

        <!-- QUICK TRADE / CARD MARKET ACTION TILE -->
        <div class="right-bar-section right-bar-market-card" id="rightBarMarketCard">
            <div class="right-bar-section-title">Card Market</div>
            <div class="market-quick-card">
                <div class="mqc-badge">⚡ ACTIVE TRADING</div>
                <div class="mqc-text" id="mqcStatusText">Simulate trades, find mutual partner doubles, and test the market.</div>
                <button type="button" class="btn-open-market" id="rbOpenMarketBtn">🤝 Open Trade Exchange</button>
            </div>
        </div>

        <!-- L-BAR WIDGET CUSTOMIZER SHORTCUT IN RIGHT BAR -->
        <div class="right-bar-section" style="padding-top: 4px;">
            <button type="button" class="btn-customize-widgets" id="btnCustomizeWidgetsRight" title="Customize L-bar widgets" style="width: 100%; justify-content: center;">⚙️ Customize L-Bar</button>
        </div>

        <!-- SPORTS CHANNEL HIGHLIGHTS PACKAGE & NEWS FEED (Moved to sticky south footer - hidden here to remove redundancy) -->
        <div class="sports-highlights-deck" id="sportsHighlightsDeck" style="display: none;">
            <div class="hl-broadcast-header">
                <div class="hl-live-badge"><span class="hl-live-dot"></span>LIVE DESK</div>
                <div class="hl-series-label" id="hlSeriesLabel">HIGHLIGHTS</div>
            </div>

            <!-- Completeness ("not in percentage... but in completeness") -->
            <div class="hl-completeness-box">
                <div class="hl-completeness-label">COLLECTION COMPLETENESS</div>
                <div class="hl-completeness-score">
                    <span class="hl-have-num" id="hlHaveNum">0</span>
                    <span class="hl-of-total">/ <span id="hlTotalNum">0</span> Cards Complete</span>
                </div>
                <div class="hl-breakdown-sub" id="hlBreakdownSub">0 Owned · 0 Needed · 0 Trade</div>
            </div>

            <!-- Set Spectrum: Cards sprinkled across the set with green-to-red gradient -->
            <div class="hl-spectrum-container">
                <div class="hl-spectrum-title">
                    <span>SET SPECTRUM</span>
                    <span class="hl-spectrum-hint" id="hlSpectrumHint">Interactive Map</span>
                </div>
                <div class="hl-spectrum-canvas-wrap">
                    <canvas id="hlSpectrumCanvas" width="250" height="48" title="Cards sprinkled across checklist"></canvas>
                </div>
                <div class="hl-spectrum-legend">
                    <span class="leg-item leg-owned">🟩 Owned</span>
                    <span class="leg-item leg-doubles">🟥 2x Trade</span>
                    <span class="leg-item leg-needed">🟩 🔻 Needed</span>
                </div>
            </div>

            <!-- Subset Completeness & Interaction Graph -->
            <div class="hl-subsets-graph">
                <div class="hl-spectrum-title">
                    <span>SUBSET COVERAGE</span>
                    <span class="hl-interaction-tag" id="hlInteractionTag">This Season</span>
                </div>
                <div class="hl-subset-bars" id="hlSubsetBars"></div>
            </div>
        </div>
    </aside>
</div>

<!-- DRAGGABLE & MOVABLE STATS & HEAT MAP OVERLAY HUD -->
<!-- ("the base percentages, the above the ice and other series percentages... then all the heat maps of the popularity site wide. this should be on the tablet view and the iphone view always. all these overlays the user should be able to drag them and move them around stereatech and shift bump over move change windows and that vierw saves with them locally and it could push it to the DB") -->
<aside id="statsHudOverlay" class="stats-hud-overlay hud-dock-bottom-right" role="region" aria-label="Live Statistics and Heat Map HUD" style="display: none;">
    <!-- Minimized pill bar -->
    <div id="statsHudMiniBar" class="stats-hud-mini-bar" style="display: none;">
        <span class="hud-mini-drag" id="hudMiniDragHandle" title="Drag to move anywhere">⠿</span>
        <button type="button" class="hud-mini-label-btn" id="hudMiniLabelBtn" title="Click to expand full stats & heat map">
            <span class="hud-live-dot mini"></span>
            <span id="hudMiniStatsText">📊 Base 0% · Ice 0% · 🔥 Heat Map</span>
        </button>
        <button type="button" class="hud-btn hud-btn-mini hud-bump-btn" id="hudMiniBumpBtn" title="Bump dock corner (⇄ Bump Over)">⇄</button>
        <button type="button" class="hud-btn hud-btn-mini" id="hudMiniExpandBtn" title="Expand Window">◻</button>
        <button type="button" class="hud-btn hud-btn-mini hud-close-btn" id="hudMiniCloseBtn" title="Close HUD (Turn Off)">✕</button>
    </div>

    <!-- Main floating draggable window -->
    <div id="statsHudWindow" class="stats-hud-window">
        <div class="hud-header" id="hudDragHandle">
            <div class="hud-title-wrap">
                <span class="hud-drag-icon" title="Drag overlay window anywhere">⠿</span>
                <span class="hud-title">LIVE STATS & HEAT MAP</span>
                <span class="hud-live-dot" title="Live stats active"></span>
            </div>
            <div class="hud-tab-switcher" role="tablist">
                <button type="button" class="hud-tab-btn active" data-tab="all" title="Show all stats and site heat map">All</button>
                <button type="button" class="hud-tab-btn" data-tab="subsets" title="Series & Subset Percentages">Subsets %</button>
                <button type="button" class="hud-tab-btn" data-tab="heatmap" title="Site-wide Popularity Heat Map">Heat Map</button>
            </div>
            <div class="hud-actions">
                <button type="button" class="hud-btn hud-bump-btn" id="hudBumpBtn" title="Shift / Bump window to opposite side or next corner (⇄ Bump Over)">⇄ Bump</button>
                <button type="button" class="hud-btn hud-minimize-btn" id="hudMinimizeBtn" title="Minimize to compact bar">_</button>
                <button type="button" class="hud-btn hud-close-btn" id="hudCloseBtn" title="Close HUD (Turn Off)">✕</button>
            </div>
        </div>

        <div class="hud-scroll-body" id="hudScrollBody">
            <!-- SECTION 1: SERIES & SUBSET PERCENTAGES -->
            <div class="hud-pane-section" id="hudSubsetsPane">
                <div class="hud-pane-header">
                    <span class="hud-pane-title">📊 SERIES & SUBSET COVERAGE</span>
                    <span class="hud-pane-badge" id="hudOverallCoverageBadge">0% Total</span>
                </div>
                <div class="hud-subsets-list" id="hudSubsetsList">
                    <!-- Dynamic subset rows: Base, Above the Ice, etc. -->
                </div>
            </div>

            <!-- SECTION 2: SITE-WIDE POPULARITY HEAT MAP -->
            <div class="hud-pane-section" id="hudHeatmapPane">
                <div class="hud-pane-header">
                    <span class="hud-pane-title">🔥 SITE-WIDE CARD CIRCULATION</span>
                    <span class="hud-pane-badge" id="hudSitewideHoldersCountBadge">Site Activity</span>
                </div>
                <div class="hud-heatmap-canvas-container">
                    <canvas id="hudSitewideHeatmapCanvas" height="48" title="Site-wide popularity heat map across all checklist cards"></canvas>
                    <div id="hudHeatmapTooltip" class="hud-heatmap-tooltip" style="display: none;"></div>
                </div>
                <div class="hud-heatmap-legend">
                    <div class="hud-legend-item"><span class="hud-swatch swatch-hot"></span> Hot / Widely Owned</div>
                    <div class="hud-legend-item"><span class="hud-swatch swatch-mid"></span> Moderate Circulation</div>
                    <div class="hud-legend-item"><span class="hud-swatch swatch-rare"></span> Rare / Coveted</div>
                    <div class="hud-legend-item"><span class="hud-swatch swatch-mine"></span> 🟩 In Your Deck</div>
                </div>
                <div class="hud-heatmap-tip">💡 Tap or hover any bar to inspect card scarcity site-wide. Click to jump to card.</div>
            </div>

            <!-- HUD FOOTER -->
            <div class="hud-footer">
                <span class="hud-sync-tag" id="hudSyncTag">💾 Preferences Saved</span>
                <div class="hud-footer-controls">
                    <button type="button" class="hud-footer-link" id="hudResetDockBtn" title="Reset to standard bottom dock">↺ Reset Dock</button>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- CARD MARKET & TRADE EXCHANGE DIALOG -->
<!-- ("should be a mode a guest could enter into... they could add and sub tract to their account and offer a trade... and rig the card market") -->
<dialog id="tradeMarketDialog" class="trade-market-dialog">
    <div class="tmd-header">
        <div class="tmd-title-wrap">
            <span class="tmd-icon">🤝</span>
            <div>
                <h3>Card Market & Trade Exchange</h3>
                <p class="tmd-subtitle">Simulate swaps, negotiate doubles, and test the hockey card market</p>
            </div>
        </div>
        <button type="button" class="close-sidebar-btn" id="closeTradeMarketBtn" aria-label="Close dialog">✕</button>
    </div>
    <div class="tmd-body">
        <div class="tmd-split">
            <div class="tmd-col tmd-my-col">
                <div class="tmd-col-head">
                    <span class="tmd-pill tmd-pill-trade">⭐️ YOUR DOUBLES FOR TRADE (RED)</span>
                </div>
                <div class="tmd-card-list" id="tmdMyDoublesList">
                    <!-- Dynamically populated -->
                </div>
            </div>
            <div class="tmd-exchange-icon">⇄</div>
            <div class="tmd-col tmd-target-col">
                <div class="tmd-col-head">
                    <label class="tmd-select-label" style="font-size:0.75rem; font-weight:800; color:#475569;">Trading Partner:
                        <select id="tmdPartnerSelect" class="tmd-partner-select"></select>
                    </label>
                    <span class="tmd-pill tmd-pill-need">🔻 NEEDED ACQUISITIONS (GREEN)</span>
                </div>
                <div class="tmd-card-list" id="tmdTargetNeedsList">
                    <!-- Dynamically populated -->
                </div>
            </div>
        </div>
        <div class="tmd-match-summary" id="tmdMatchSummary">
            Select a partner to analyze mutual trade matches!
        </div>
    </div>
    <div class="tmd-footer">
        <button type="button" class="btn-rig-market primary" id="btnRigMarket">⚡ Rig the Card Market (Simulate Swap)</button>
        <button type="button" class="btn-lock-trade" id="btnLockTrade" style="background:#0f172a; color:#fff; border-radius:6px; font-size:0.82rem; font-weight:700; padding:6px 12px; cursor:pointer;">💾 Lock In (+ Collector)</button>
        <button type="button" id="cancelTradeMarketBtn">Close</button>
    </div>
</dialog>

<!-- L-BAR WIDGET CUSTOMIZATION DIALOG -->
<dialog id="lbarCustomizeDialog" class="lbar-customize-dialog">
    <div class="lcd-header" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
        <h3 style="margin:0; font-size:1.05rem; font-weight:800; color:#0f172a;">⚙️ Customize L-Bar Widgets</h3>
        <button type="button" class="close-sidebar-btn" id="closeLbarCustomizeBtn" aria-label="Close">✕</button>
    </div>
    <div class="lcd-body">
        <p style="font-size:0.84rem; color:#475569; margin-bottom:12px;">Toggle or reorder which modules appear in the Left Bar:</p>
        <div class="lcd-widget-list">
            <label class="lcd-item"><input type="checkbox" id="toggleWidgetSeries" checked> <span>🏒 Hockey Series Checklist Selector</span></label>
            <label class="lcd-item"><input type="checkbox" id="toggleWidgetSubsets" checked> <span>⚡ Subsets & Quick Jump Menu</span></label>
            <label class="lcd-item"><input type="checkbox" id="toggleWidgetTeam" checked> <span>👥 Team Hub & Teammates List</span></label>
            <label class="lcd-item"><input type="checkbox" id="toggleWidgetStats" checked> <span>📊 Footer Rotating Stats Corner</span></label>
        </div>
    </div>
    <div class="lcd-footer" style="margin-top:14px; display:flex; justify-content:flex-end; gap:8px;">
        <button type="button" id="resetLbarCustomizeBtn">Reset Defaults</button>
        <button type="button" class="primary" id="saveLbarCustomizeBtn">Save Preferences</button>
    </div>
</dialog>

<div class="toast" id="toast" hidden></div>

<!-- NEW COLLECTOR DIALOG (+ Collector button) -->
<!-- NEW COLLECTOR DIALOG (+ Collector button) -->
<!-- ("Team code this can be anything. This should be the TEAM NAME and this should be encouraging to use the team name... then buddy name -0 public trader like a circle of teams mates that trade a trading community") -->
<dialog id="newCollectorDialog">
    <form id="newCollectorForm">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px;">
            <span style="font-size:1.4rem;">🤝</span>
            <div>
                <strong style="display:block; font-size:1.05rem;">Join the Trading Community</strong>
                <span style="font-size:0.75rem; color:#64748b;">Create your collector profile & trade cards with buddies</span>
            </div>
        </div>

        <label>Collector Name (shown to other traders)
            <input name="collector_name" id="newCollectorName" maxlength="50" minlength="2" required placeholder="e.g. Anthony, Josh, etc." autocomplete="off">
        </label>

        <!-- Team Code / Trading Community Circle -->
        <div class="team-community-box" style="background:#f8fafc; border:1.5px solid #cbd5e1; border-radius:8px; padding:10px 12px; margin:10px 0;">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
                <label style="margin:0; font-weight:800; font-size:0.82rem; color:#0f172a;" for="newCollectorDiscountCode">
                    🏒 Team Code / Trading Circle Name
                </label>
                <span class="pricing-amount is-free" id="newCollectorPricingAmount" style="font-size:0.8rem; font-weight:800; color:#15803d; background:#dcfce7; padding:2px 8px; border-radius:999px;">FREE ($0.00)</span>
            </div>
            <p style="margin:0 0 6px; font-size:0.73rem; color:#475569; line-height:1.35;">
                <strong>This can be anything!</strong> Enter a team or buddy circle name to trade cards together. Teammates share doubles, view combined progress, and trade cards with <strong>100% FREE access</strong>!
            </p>
            <input id="newCollectorDiscountCode" value="HAWK" placeholder="Enter ANY Team Name (e.g. Blackhawks, Oilers, Buddies, or HAWK)" style="text-transform: uppercase; font-weight:700;">

            <div style="margin-top:6px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:6px;">
                <label style="margin:0; font-size:0.72rem; color:#64748b;">Or join existing team:
                    <select id="newCollectorTeamSelect" style="padding:2px 6px; font-size:0.72rem; margin-left:4px;">
                        <option value="">— Pick a Team Circle —</option>
                    </select>
                </label>
                <div style="font-size:0.7rem; color:#94a3b8;">
                    Enter <code>0</code> or blank for Public Trader
                </div>
            </div>

            <div class="discount-status-pill free" id="newCollectorDiscountPill" style="margin-top:8px;">
                <span id="newCollectorPillIcon">🎉</span> <span id="newCollectorDiscountText">Team circle HAWK applied — 100% Free Trading Community!</span>
            </div>
        </div>

        <input type="hidden" id="newCollectorNewTeamName" value="">

        <label>Password (your initials or cheat code HAWK)
            <input name="password" id="newCollectorPass" type="password" maxlength="5" required placeholder="1-5 letters (e.g. initials or HAWK)" autocomplete="new-password">
        </label>

        <div class="error" id="newCollectorError"></div>
        <div class="actions">
            <button type="button" id="cancelNewCollector">Cancel</button>
            <button type="submit" class="primary" id="newCollectorSubmitBtn">Register (FREE with Team HAWK) →</button>
        </div>
    </form>
</dialog>

<!-- EDIT TEAM DIALOG -->
<dialog id="teamDialog">
    <form id="teamForm">
        <strong>Update Team</strong>
        <label>Select Team
            <select id="teamDialogSelect">
                <option value="">— No Team (Individual Collector) —</option>
            </select>
        </label>
        <div id="teamDialogNewTeamRow" hidden>
            <label>New Team Name
                <input id="teamDialogNewTeamInput" maxlength="50" placeholder="Enter new team name">
            </label>
        </div>
        <div class="actions">
            <button type="button" id="cancelTeamDialog">Cancel</button>
            <button type="submit" class="primary">Save Team</button>
        </div>
    </form>
</dialog>

<!-- CARD OPTIONS OVERLAY -->
<dialog id="cardOptionsDialog">
    <div class="card-opt-header">
        <div class="card-opt-title-wrap">
            <span class="card-opt-num" id="cardOptNum"></span>
            <strong class="card-opt-name" id="cardOptName"></strong>
        </div>
        <button type="button" id="closeCardOptBtn" class="card-opt-close" aria-label="Close">✕</button>
    </div>
    <div class="card-opt-current" id="cardOptCurrent"></div>
    <div class="card-opt-buttons">
        <button type="button" class="card-opt-btn double-btn" data-qty="2">
            <span>Declare Double</span>
            <span class="card-opt-badge">2x</span>
        </button>
        <button type="button" class="card-opt-btn triple-btn" data-qty="3">
            <span>Declare Triple</span>
            <span class="card-opt-badge">3x</span>
        </button>
        <button type="button" class="card-opt-btn single-btn" data-qty="1">
            <span>Keep as Single</span>
            <span class="card-opt-badge">1x</span>
        </button>
        <button type="button" class="card-opt-btn remove-btn" data-qty="0">
            <span>Remove from Collection</span>
            <span class="card-opt-badge">0</span>
        </button>
    </div>
    <div class="card-opt-custom-row">
        <span>Other amount:</span>
        <input type="number" id="cardOptCustomInput" min="0" max="99" value="4">
        <button type="button" id="cardOptCustomBtn">Set</button>
    </div>
</dialog>

<!-- WIKIPEDIA PLAYER MODAL -->
<dialog id="wikiDialog" class="wiki-dialog">
    <div class="wiki-header">
        <div class="wiki-title-wrap">
            <span class="wiki-icon">🌐</span>
            <div>
                <h3 id="wikiPlayerTitle">Player Bio</h3>
                <span class="wiki-subtitle" id="wikiPlayerSubtitle">Wikipedia NHL Biography</span>
            </div>
        </div>
        <button type="button" id="closeWikiBtn" class="card-opt-close" aria-label="Close">✕</button>
    </div>
    <div class="wiki-content" id="wikiContent">
        <div style="display:flex; align-items:center; gap:12px; padding:20px; justify-content:center; color:var(--muted);">
            <span>Loading Wikipedia article...</span>
        </div>
    </div>
    <div class="wiki-footer">
        <span class="wiki-hint">💡 Click 🌐 or push & hold any card to view Wikipedia bio</span>
        <div style="display:flex; gap:8px; flex-wrap:wrap;">
            <a href="#" target="_blank" rel="noopener noreferrer" id="wikiCommonsLink" class="wiki-commons-btn" style="font-size:0.82rem; font-weight:700; padding:6px 12px; border-radius:6px; background:#475569; color:#fff; text-decoration:none; display:inline-flex; align-items:center; gap:4px;">📷 Commons Photos ↗</a>
            <a href="#" target="_blank" rel="noopener noreferrer" id="wikiFullLink" class="wiki-full-btn">Read on Wikipedia ↗</a>
            <button type="button" id="dismissWikiBtn">Close</button>
        </div>
    </div>
</dialog>

<script>
    const state = {
        series: '2026-27',  // active series: '2026-27' or '2025-26'
        users: [],          // all available collectors (or teammates if user is on team)
        teams: [],          // all teams from teams table
        currentUser: null,  // { id, collector_name, team_name, team_id }
        userId: null,
        viewId: null,       // number (user_id) or 'team'
        cards: [],
        filter: 'all',
        layout: localStorage.getItem('cards_layout') || 'list', // 'list', 'page', or 'job'
        jobMode: localStorage.getItem('cards_job_mode') || 'visual', // 'visual' or 'table'
        selectedJob: 'all',
        collapsed: new Set(),
        teamSummary: null,
        activeNavSet: null,
    };

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

        // Token fallback support
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

    async function checkAuthAndInit() {
        try {
            // Apply saved layout button state
            document.querySelectorAll('.layout-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.layout === state.layout);
            });

            const me = await api('me').catch(() => null);
            const [usersData, teamsData] = await Promise.all([
                api('get_users').catch(() => []),
                api('get_teams').catch(() => [])
            ]);
            state.users = usersData;
            state.teams = teamsData;

            const urlParams = new URLSearchParams(window.location.search);
            const viewParam = urlParams.get('view') || urlParams.get('user');

            if (me) {
                state.currentUser = me;
                state.userId = me.id;
                state.viewId = me.id;
                if (me.layout_prefs) {
                    applyHudLayoutPrefs(me.layout_prefs);
                }
            } else {
                // Stranger / Public Guest: display Bronzo's collection openly
                state.currentUser = null;
                state.userId = null;
                const bronzo = state.users.find(u => (u.collector_name || '').toLowerCase() === 'bronzo') || state.users[0];
                state.viewId = bronzo ? bronzo.id : null;
            }

            if (viewParam) {
                if (viewParam === 'team') {
                    state.viewId = 'team';
                } else {
                    const targetId = Number(viewParam);
                    if (targetId && state.users.some(u => u.id === targetId)) {
                        state.viewId = targetId;
                    }
                }
            }

            populateTeamDropdowns();
            renderAccountInfo();
            renderViewSelect();
            await Promise.all([loadTeamSummary(), loadCards()]);
        } catch (err) {
            console.error('Initialization error:', err);
        }
    }



    function populateTeamDropdown(selectEl, selectedVal = '') {
        if (!selectEl) return;
        let html = '<option value="">— No Team (Individual Collector) —</option>';
        if (state.teams && state.teams.length > 0) {
            for (const t of state.teams) {
                const count = Number(t.member_count) || 0;
                const countStr = count > 0 ? ` (${count} member${count === 1 ? '' : 's'})` : '';
                const isSelected = (selectedVal && (selectedVal.toLowerCase() === t.name.toLowerCase() || String(selectedVal) === String(t.id))) ? 'selected' : '';
                html += `<option value="${esc(t.name)}" ${isSelected}>Team ${esc(t.name)}${countStr}</option>`;
            }
        }
        html += '<option value="__new__">+ Create / Ask for New Team...</option>';
        selectEl.innerHTML = html;
    }

    function populateTeamDropdowns() {
        populateTeamDropdown(document.getElementById('newCollectorTeamSelect'));
        populateTeamDropdown(document.getElementById('teamDialogSelect'), state.currentUser?.team_name || '');
    }

    // Helper for team dropdown selection changes (toggles new team text input)
    function setupTeamSelectToggle(selectEl, newRowEl, newInputEl) {
        if (!selectEl) return;
        selectEl.addEventListener('change', () => {
            if (selectEl.value === '__new__') {
                newRowEl.hidden = false;
                if (newInputEl) {
                    newInputEl.required = true;
                    newInputEl.focus();
                }
            } else {
                newRowEl.hidden = true;
                if (newInputEl) newInputEl.required = false;
            }
        });
    }

    setupTeamSelectToggle(
        document.getElementById('newCollectorTeamSelect'),
        document.getElementById('newCollectorNewTeamRow'),
        document.getElementById('newCollectorNewTeamName')
    );
    setupTeamSelectToggle(
        document.getElementById('teamDialogSelect'),
        document.getElementById('teamDialogNewTeamRow'),
        document.getElementById('teamDialogNewTeamInput')
    );

    // Live Discount / Cheat Code Watcher
    // Live Team Code / Trading Community Watcher
    // ("Team code this can be anything. This should be the TEAM NAME and this should be encouraging to use the team name... then buddy name -0 public trader like a circle of teams mates that trade a trading community")
    function setupDiscountWatcher(inputEl, amountEl, pillEl, textEl, submitBtnEl, baseLabel) {
        if (!inputEl) return;
        function update() {
            const raw = inputEl.value.trim();
            const val = raw.toUpperCase();
            if (val !== '' && val !== '0' && val !== 'PUBLIC') {
                amountEl.textContent = 'FREE ($0.00)';
                amountEl.className = 'pricing-amount is-free';
                pillEl.className = 'discount-status-pill free';
                textEl.textContent = `🎉 Team circle "${raw}" joined — 100% Free! Circle of teammates & buddies that trade!`;
                submitBtnEl.textContent = `${baseLabel} (FREE with Team "${raw}") →`;
            } else if (val === '0' || val === 'PUBLIC') {
                amountEl.textContent = '$1.00 USD';
                amountEl.className = 'pricing-amount';
                pillEl.className = 'discount-status-pill standard';
                textEl.textContent = '🌐 Public Trader mode. Tip: Enter ANY team or buddy circle above to trade with teammates for 100% FREE!';
                submitBtnEl.textContent = `Pay $1.00 & ${baseLabel} (Public Trader) →`;
            } else {
                amountEl.textContent = '$1.00 USD';
                amountEl.className = 'pricing-amount';
                pillEl.className = 'discount-status-pill standard';
                textEl.textContent = '💡 Enter ANY Team Name above to join a trading circle with buddies and register for 100% FREE!';
                submitBtnEl.textContent = `Pay $1.00 & ${baseLabel} →`;
            }
        }
        inputEl.addEventListener('input', update);
        update();

        const selectEl = document.getElementById('newCollectorTeamSelect');
        if (selectEl) {
            selectEl.addEventListener('change', () => {
                if (selectEl.value && selectEl.value !== '__new__') {
                    inputEl.value = selectEl.value;
                    inputEl.dispatchEvent(new Event('input'));
                }
            });
        }
    }

    setupDiscountWatcher(
        document.getElementById('newCollectorDiscountCode'),
        document.getElementById('newCollectorPricingAmount'),
        document.getElementById('newCollectorDiscountPill'),
        document.getElementById('newCollectorDiscountText'),
        document.getElementById('newCollectorSubmitBtn'),
        'Register'
    );

    function showLoginGate() {
        window.location.href = './';
    }

    // Render both top-right header account widget and sidebar info
    function renderAccountInfo() {
        const me = state.currentUser;
        const pill = document.getElementById('accountPill');
        const signInBtn = document.getElementById('topbarSignInBtn');
        const sideUserName = document.getElementById('sideUserName');
        const sideUserTeamBadge = document.getElementById('sideUserTeamBadge');
        const topUserName = document.getElementById('topbarUserName');
        const topUserTeam = document.getElementById('topbarUserTeam');
        const teamNeedsBtn = document.getElementById('teamNeedsFilterBtn');
        const vuStatTeam = document.getElementById('vuStatTeam');
        const deckTeam = document.getElementById('deckTeamCard');

        if (me) {
            pill.hidden = false;
            signInBtn.hidden = true;
            topUserName.textContent = me.collector_name;
            sideUserName.textContent = me.collector_name;

            const isAdmin = Boolean(me.is_admin || (me.collector_name && me.collector_name.toUpperCase() === 'ANTHONY'));
            const adminBtn = document.getElementById('topbarAdminBtn');
            if (adminBtn) adminBtn.hidden = !isAdmin;
            const sideAdminLink = document.getElementById('sideAdminLink');
            if (sideAdminLink) sideAdminLink.hidden = !isAdmin;

            if (me.team_name) {
                topUserTeam.textContent = `Team: ${me.team_name}`;
                sideUserTeamBadge.textContent = `Team: ${me.team_name}`;
                sideUserTeamBadge.hidden = false;
                teamNeedsBtn.hidden = false;
                vuStatTeam.hidden = false;
                deckTeam.hidden = false;
                document.getElementById('menuSeriesBadge').className = 'menu-badge badge-free';
                document.getElementById('menuSeriesBadge').textContent = 'HAWK Free';
            } else {
                topUserTeam.textContent = `No team (click to join)`;
                sideUserTeamBadge.textContent = 'No team set (Click Edit Team to join)';
                teamNeedsBtn.hidden = true;
                vuStatTeam.hidden = true;
                deckTeam.hidden = true;
                document.getElementById('menuSeriesBadge').className = 'menu-badge';
                document.getElementById('menuSeriesBadge').textContent = '$1 / acct';
            }
        } else {
            pill.hidden = true;
            signInBtn.hidden = false;
        }

        const titleEl = document.getElementById('topbarSeriesTitle');
        const tagEl = document.getElementById('topbarSeriesTag');
        if (state.series === '2025-26') {
            if (titleEl) titleEl.textContent = '2025-26 Tim Hortons';
            if (tagEl) tagEl.textContent = 'Archive • Bronzo Collection';
        } else {
            if (titleEl) titleEl.textContent = '2026-27 UD Tim Hortons';
            if (tagEl) tagEl.textContent = me?.team_name ? 'HAWK Free' : '$1 / account';
        }
    }

    function renderSidebarUser() {
        renderAccountInfo();
    }

    async function loadTeamSummary() {
        const me = state.currentUser;
        const teamHub = document.getElementById('teamHubSection');
        if (!me || !me.team_name) {
            teamHub.hidden = true;
            state.teamSummary = null;
            return;
        }

        try {
            const data = await api('get_team_summary', { team_name: me.team_name, series: state.series || '2026-27' });
            state.teamSummary = data;
            if (!data) {
                teamHub.hidden = true;
                return;
            }

            teamHub.hidden = false;
            document.getElementById('sideTeamName').textContent = data.team_name;
            document.getElementById('sideTeamBarFill').style.width = `${data.percentage}%`;
            document.getElementById('sideTeamCollectedText').textContent = `${data.collected}/${data.total} cards`;
            document.getElementById('sideTeamPctText').textContent = `${data.percentage}%`;

            const membersList = document.getElementById('sideTeamMembers');
            membersList.innerHTML = data.members.map(m => {
                const isCurrentViewing = state.viewId === m.id;
                return `<div class="teammate-row ${isCurrentViewing ? 'active' : ''}" data-user-id="${m.id}">
                    <span>${esc(m.collector_name)}</span>
                    <span class="teammate-count">${m.collected_count} cards</span>
                </div>`;
            }).join('');

            document.getElementById('vuStatTeamNum').textContent = data.collected;
            document.getElementById('vuStatTeamPct').textContent = `${data.percentage}%`;
            document.getElementById('deckTeamVal').textContent = `${data.collected}/${data.total}`;
            document.getElementById('deckTeamSub').textContent = `${data.percentage}% team coverage across members`;
        } catch (err) {
            console.error('Failed to load team summary:', err);
        }
    }

    function renderViewSelect() {
        const view = document.getElementById('viewSelect');
        if (!view) return;
        const me = state.currentUser;

        let html = '';
        if (me) {
            html += `<option value="${me.id}">${state.viewId === me.id ? '✓ ' : ''}My collection</option>`;

            if (me.team_name) {
                html += `<option value="team">${state.viewId === 'team' ? '✓ ' : ''}👥 Team ${esc(me.team_name)} (Combined Progress)</option>`;

                // Teammates on the same team
                const teammates = state.users.filter(u => u.team_name === me.team_name && u.id !== me.id);
                if (teammates.length > 0) {
                    html += `<optgroup label="Teammates (${esc(me.team_name)})">`;
                    for (const t of teammates) {
                        html += `<option value="${t.id}">${esc(t.collector_name)}</option>`;
                    }
                    html += `</optgroup>`;
                }
            } else {
                // No team set: allow viewing other collectors
                const others = state.users.filter(u => u.id !== me.id);
                if (others.length > 0) {
                    html += `<optgroup label="Other Collectors">`;
                    for (const o of others) {
                        html += `<option value="${o.id}">${esc(o.collector_name)}</option>`;
                    }
                    html += `</optgroup>`;
                }
            }
        } else {
            // Stranger / guest viewing public collections
            html += `<option value="guest">${state.viewId === 'guest' ? '✓ ' : ''}🎭 Guest Trader (Sandbox / My Deck)</option>`;
            html += `<optgroup label="Public Collectors">`;
            for (const u of state.users) {
                const isBronzo = (u.collector_name || '').toLowerCase() === 'bronzo';
                const prefix = isBronzo ? '⭐ ' : '';
                html += `<option value="${u.id}">${prefix}${esc(u.collector_name)}'s collection</option>`;
            }
            html += `</optgroup>`;
        }

        view.innerHTML = html;
        if (state.viewId) {
            view.value = String(state.viewId);
        }
    }

    function isGuestMode() {
        return !state.userId && state.viewId === 'guest';
    }

    function getGuestCardsKey() {
        return `cards_guest_${state.series || '2026-27'}`;
    }

    function getGuestCardsMap() {
        try {
            return JSON.parse(localStorage.getItem(getGuestCardsKey()) || '{}');
        } catch (e) {
            return {};
        }
    }

    function saveGuestCardsMap(map) {
        try {
            localStorage.setItem(getGuestCardsKey(), JSON.stringify(map));
            localStorage.setItem('cards_guest_active', '1');
        } catch (e) {}
    }

    function applyGuestCards() {
        const guestMap = getGuestCardsMap();
        for (const card of state.cards) {
            const q = guestMap[card.id] || 0;
            card.quantity = q;
            card.my_quantity = q;
        }
    }

    function isOwn() {
        if (isGuestMode()) return true;
        return Boolean(state.userId && state.viewId === state.userId);
    }

    function isTeamView() {
        return state.viewId === 'team';
    }

    function isAdminTinkering() {
        return Boolean(state.currentUser?.is_admin && !isOwn() && !isTeamView() && typeof state.viewId === 'number');
    }

    function canEdit() {
        if (isGuestMode()) return true;
        return isOwn() || isAdminTinkering();
    }

    function switchToOwnCollection() {
        if (!state.userId) {
            state.viewId = 'guest';
            const viewSel = document.getElementById('viewSelect');
            if (viewSel) viewSel.value = 'guest';
            loadCards();
            return;
        }
        state.viewId = state.userId;
        const viewSel = document.getElementById('viewSelect');
        if (viewSel) viewSel.value = String(state.userId);
        loadCards();
    }

    function viewedName() {
        if (isGuestMode()) return 'Guest Trader';
        if (isTeamView()) return `Team ${state.currentUser?.team_name ?? ''}`;
        return state.users.find(u => u.id === state.viewId)?.collector_name ?? (state.currentUser?.collector_name || 'Bronzo');
    }

    async function loadCards() {
        const params = { series: state.series || '2026-27' };
        if (state.viewId === 'team') {
            params.user_id = 'team';
        } else if (state.viewId === 'guest') {
            params.user_id = 'guest';
        } else if (state.viewId) {
            params.user_id = state.viewId;
        }
        state.cards = await api('get_cards', params);
        if (state.cards && Array.isArray(state.cards)) {
            state.cards.forEach(c => {
                c.series = c.series || 'Upper Deck Tim Hortons';
                c.year = c.year || state.series || '2026-27';
            });
        }
        if (isGuestMode() || (!state.userId && state.viewId === 'guest')) {
            applyGuestCards();
        }
        render();
        renderViewSelect();
        loadTeamSummary();
    }

    /* ==========================================================
       DIGIKEY-STYLE PARAMETRIC INVENTORY FILTER CONTROLLER
       ========================================================== */
    const paramState = {
        searchWithin: '',
        mode: localStorage.getItem('cards_ifs_mode') || 'scrolling', // 'scrolling' | 'stacked'
        collapsed: localStorage.getItem('cards_ifs_collapsed') !== 'false', // Default collapsed (true) so center is just the lists
        status: new Set(),
        series: new Set(),
        year: new Set(),
        subsets: new Set(),
        ranges: new Set(),
        scarcity: new Set(),
        quantity: new Set(),
        players: new Set(),
        partners: new Set(),
        sortBy: 'featured'
    };

    function hasActiveParamFilters() {
        return Boolean(
            paramState.searchWithin ||
            paramState.status.size > 0 ||
            paramState.series.size > 0 ||
            paramState.year.size > 0 ||
            paramState.subsets.size > 0 ||
            paramState.ranges.size > 0 ||
            paramState.scarcity.size > 0 ||
            paramState.quantity.size > 0 ||
            paramState.players.size > 0 ||
            paramState.partners.size > 0
        );
    }

    function matchesParamFilters(card) {
        if (!card) return false;

        // Search Within
        if (paramState.searchWithin) {
            const q = paramState.searchWithin.toLowerCase();
            const num = String(card.card_number || '').toLowerCase();
            const player = String(card.player_name || '').toLowerCase();
            const set = String(card.set_name || '').toLowerCase();
            if (!num.includes(q) && !player.includes(q) && !set.includes(q)) {
                return false;
            }
        }

        // Common Attributes / Status
        if (paramState.status.size > 0) {
            let matchesAnyStatus = false;
            if (paramState.status.has('owned') && card.quantity > 0) matchesAnyStatus = true;
            if (paramState.status.has('missing') && card.quantity === 0) matchesAnyStatus = true;
            if (paramState.status.has('doubles') && card.quantity >= 2) matchesAnyStatus = true;
            if (paramState.status.has('triples') && card.quantity >= 3) matchesAnyStatus = true;
            if (paramState.status.has('team_doubles')) {
                const hasDbls = (card.doubles_by && card.doubles_by.length > 0) || (card.team_doubles_by && card.team_doubles_by.length > 0);
                if (hasDbls) matchesAnyStatus = true;
            }
            if (paramState.status.has('team_needs') && card.team_has === 0) matchesAnyStatus = true;
            if (!matchesAnyStatus) return false;
        }

        // Subsets
        if (paramState.subsets.size > 0) {
            if (!paramState.subsets.has(card.set_name)) return false;
        }

        // Card Series
        if (paramState.series.size > 0) {
            const cardSeries = card.series || 'Upper Deck Tim Hortons';
            const matchesSeries = Array.from(paramState.series).some(s =>
                cardSeries.toLowerCase().includes(s.toLowerCase()) || s.toLowerCase().includes(cardSeries.toLowerCase())
            );
            if (!matchesSeries) return false;
        }

        // Checklist Year
        if (paramState.year.size > 0) {
            const cardYear = card.year || state.series || '2026-27';
            if (!paramState.year.has(cardYear)) return false;
        }

        // Number Ranges
        if (paramState.ranges.size > 0) {
            const num = parseInt(card.card_number, 10);
            const isBase = (card.set_name || '').toLowerCase().includes('base');
            let matchRange = false;
            if (!isNaN(num) && isBase) {
                if (paramState.ranges.has('1-25') && num >= 1 && num <= 25) matchRange = true;
                if (paramState.ranges.has('26-50') && num >= 26 && num <= 50) matchRange = true;
                if (paramState.ranges.has('51-75') && num >= 51 && num <= 75) matchRange = true;
                if (paramState.ranges.has('76-100') && num >= 76 && num <= 100) matchRange = true;
            } else {
                if (paramState.ranges.has('inserts')) matchRange = true;
            }
            if (!matchRange) return false;
        }

        // Scarcity / Popularity
        if (paramState.scarcity.size > 0) {
            const maxHolders = Math.max(1, ...state.cards.map(c => c.sitewide_holders || 0));
            const ratio = (card.sitewide_holders || 0) / maxHolders;
            let matchScarcity = false;
            if (paramState.scarcity.has('hot') && ratio >= 0.7) matchScarcity = true;
            if (paramState.scarcity.has('mid') && ratio >= 0.3 && ratio < 0.7) matchScarcity = true;
            if (paramState.scarcity.has('rare') && ratio < 0.3) matchScarcity = true;
            if (paramState.scarcity.has('zero_doubles') && (card.sitewide_doubles || 0) === 0) matchScarcity = true;
            if (!matchScarcity) return false;
        }

        // Quantity Held
        if (paramState.quantity.size > 0) {
            let matchQty = false;
            if (paramState.quantity.has('0') && card.quantity === 0) matchQty = true;
            if (paramState.quantity.has('1') && card.quantity === 1) matchQty = true;
            if (paramState.quantity.has('2') && card.quantity === 2) matchQty = true;
            if (paramState.quantity.has('3+') && card.quantity >= 3) matchQty = true;
            if (!matchQty) return false;
        }

        // Player Name
        if (paramState.players.size > 0) {
            if (!paramState.players.has(card.player_name)) return false;
        }

        // Partner Doubles
        if (paramState.partners.size > 0) {
            const allHolders = [...(card.doubles_by || []), ...(card.team_doubles_by || [])];
            const matchPartner = Array.from(paramState.partners).some(p => allHolders.some(h => h.includes(p)));
            if (!matchPartner) return false;
        }

        return true;
    }

    function sortCards(cardList) {
        const list = [...cardList];
        switch (paramState.sortBy) {
            case 'num_asc':
                return list.sort((a, b) => {
                    const na = parseInt(a.card_number, 10);
                    const nb = parseInt(b.card_number, 10);
                    if (isNaN(na) && isNaN(nb)) return String(a.card_number).localeCompare(String(b.card_number));
                    if (isNaN(na)) return 1;
                    if (isNaN(nb)) return -1;
                    return na - nb;
                });
            case 'num_desc':
                return list.sort((a, b) => {
                    const na = parseInt(a.card_number, 10);
                    const nb = parseInt(b.card_number, 10);
                    if (isNaN(na) && isNaN(nb)) return String(b.card_number).localeCompare(String(a.card_number));
                    if (isNaN(na)) return 1;
                    if (isNaN(nb)) return -1;
                    return nb - na;
                });
            case 'player_asc':
                return list.sort((a, b) => (a.player_name || '').localeCompare(b.player_name || ''));
            case 'player_desc':
                return list.sort((a, b) => (b.player_name || '').localeCompare(a.player_name || ''));
            case 'set_asc':
                return list.sort((a, b) => (a.set_name || '').localeCompare(b.set_name || ''));
            case 'qty_desc':
                return list.sort((a, b) => (b.quantity - a.quantity) || (a.id - b.id));
            case 'hot_desc':
                return list.sort((a, b) => (b.sitewide_holders || 0) - (a.sitewide_holders || 0));
            case 'rare_desc':
                return list.sort((a, b) => (a.sitewide_holders || 0) - (b.sitewide_holders || 0));
            default:
                return list;
        }
    }

    function matchesFilter(card) {
        // Base topbar filter check
        switch (state.filter) {
            case 'missing':
                if (card.quantity != 0) return false;
                break;
            case 'doubles':
                if (card.quantity < 2) return false;
                break;
            case 'trade':
                if (isOwn()) {
                    if (!(card.quantity >= 2 || (card.quantity == 0 && (card.doubles_by.length > 0 || (card.team_doubles_by && card.team_doubles_by.length > 0))))) return false;
                } else if (isTeamView()) {
                    if (card.doubles_by.length === 0) return false;
                } else {
                    if (!(card.quantity >= 2 && (!state.userId || card.my_quantity == 0))) return false;
                }
                break;
            case 'team_needs':
                if (!(card.team_has === 0 || (isTeamView() && card.quantity == 0))) return false;
                break;
        }

        // Parametric Inventory Filters (DigiKey-style)
        if (!matchesParamFilters(card)) {
            return false;
        }

        return true;
    }

    function cleanSetId(s) {
        return String(s || '').replace(/[^a-zA-Z0-9_-]/g, '_');
    }

    function updateVUMeterAndHighlights() {
        const total = state.cards.length;
        const have = state.cards.filter(c => c.quantity > 0).length;
        const need = Math.max(0, total - have);
        const doublesCards = state.cards.filter(c => c.quantity >= 2).length;
        const pct = total > 0 ? Math.round((have / total) * 100) : 0;

        const haveVal = document.getElementById('deckHaveVal');
        if (haveVal) haveVal.textContent = have;
        const haveSub = document.getElementById('deckHaveSub');
        if (haveSub) haveSub.textContent = `${have} of ${total} cards (${pct}%)`;

        const needVal = document.getElementById('deckNeedVal');
        if (needVal) needVal.textContent = need;
        const needSub = document.getElementById('deckNeedSub');
        if (needSub) needSub.textContent = need === 0 ? '🎉 Complete set collected!' : `${need} cards left to complete`;

        const doublesVal = document.getElementById('deckDoublesVal');
        if (doublesVal) doublesVal.textContent = doublesCards;
        const doublesSub = document.getElementById('deckDoublesSub');
        if (doublesSub) doublesSub.textContent = `${doublesCards} extra cards for trade`;

        const userLeadEl = document.getElementById('sentenceUserText');
        if (userLeadEl) {
            if (isTeamView()) {
                userLeadEl.innerHTML = `👥 <strong>Team ${esc(state.currentUser?.team_name ?? '')}</strong> combined:`;
            } else if (isOwn()) {
                userLeadEl.innerHTML = `👤 <strong>My collection</strong>:`;
            } else if (isAdminTinkering()) {
                userLeadEl.innerHTML = `🛠️ <strong>Tinkering: ${esc(viewedName())}</strong>:`;
            } else {
                userLeadEl.innerHTML = `👤 Viewing <strong>${esc(viewedName())}</strong>'s collection:`;
            }
        }

        const teamBtn = document.getElementById('deckTeamCard');
        const teamSep = document.getElementById('statTeamSep');
        if (teamBtn) {
            const hasTeam = Boolean(state.currentUser?.team_name);
            teamBtn.hidden = !hasTeam;
            if (teamSep) teamSep.hidden = !hasTeam;
        }

        document.getElementById('vuStatHaveNum').textContent = have;
        document.getElementById('vuStatHavePct').textContent = `${pct}%`;

        document.getElementById('vuStatNeedNum').textContent = need;
        document.getElementById('vuStatDoublesNum').textContent = doublesCards;

        const vuBar = document.getElementById('vuMeterFill');
        const clampedPct = Math.min(100, Math.max(0, pct));
        vuBar.style.setProperty('--vu-pct', `${clampedPct}%`);
        vuBar.style.clipPath = `inset(0 ${100 - clampedPct}% 0 0)`;
        vuBar.style.webkitClipPath = `inset(0 ${100 - clampedPct}% 0 0)`;
        if (clampedPct >= 90) {
            vuBar.style.boxShadow = '0 0 16px rgba(239, 68, 68, 0.85)';
        } else if (clampedPct >= 75) {
            vuBar.style.boxShadow = '0 0 14px rgba(234, 179, 8, 0.7)';
        } else {
            vuBar.style.boxShadow = '0 0 12px rgba(34, 197, 94, 0.5)';
        }

        let channelLabel = 'VU LEVEL • MY COLLECTION';
        if (isTeamView()) channelLabel = `VU LEVEL • TEAM ${state.currentUser?.team_name ?? ''} COMBINED`;
        else if (!isOwn()) channelLabel = `VU LEVEL • ${viewedName().toUpperCase()}`;
        const chanEl = document.getElementById('vuChannelLabel');
        if (chanEl) chanEl.textContent = channelLabel;

        // Render the Sports Highlights Deck in the bottom right corner
        renderSportsHighlights();
        // Render Set Spectrum footer dock below Selection Desk
        renderFooterSpectrum();
        // Render the Rotating Stats corner widget in the bottom left footer
        renderRotatingStats();
        // Render Draggable Stats & Site-Wide Heat Map HUD (always visible on tablet & iPhone)
        renderStatsHud();
    }

    function renderFooterSpectrum(activeCardId = null) {
        const total = state.cards?.length || 0;
        if (total === 0) return;

        const canvas = document.getElementById('footerSpectrumCanvas');
        const countsEl = document.getElementById('footerSpectrumCounts');
        const have = state.cards.filter(c => c.quantity > 0).length;
        const doublesCount = state.cards.filter(c => c.quantity >= 2).length;
        const need = Math.max(0, total - have);

        if (countsEl) {
            countsEl.textContent = `${have} Owned · ${need} Needed · ${doublesCount} Trade`;
        }

        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const dpr = window.devicePixelRatio || 1;
        const rect = canvas.getBoundingClientRect();
        const w = rect.width || canvas.offsetWidth || 600;
        const h = 52;

        if (canvas.width !== Math.round(w * dpr) || canvas.height !== Math.round(h * dpr)) {
            canvas.width = Math.round(w * dpr);
            canvas.height = Math.round(h * dpr);
        }
        ctx.resetTransform?.();
        ctx.scale(dpr, dpr);

        // Dark sports broadcast background
        ctx.fillStyle = '#030712';
        ctx.fillRect(0, 0, w, h);

        // Baseline tick bar
        ctx.fillStyle = '#1e293b';
        ctx.fillRect(0, h - 4, w, 4);

        const slotW = Math.max(1.2, w / total);
        let activeX = null;

        for (let i = 0; i < total; i++) {
            const card = state.cards[i];
            const x = (i / total) * w;
            const qty = card.quantity || 0;
            const isActive = activeCardId && card.id === activeCardId;
            if (isActive) activeX = x + slotW / 2;

            if (qty === 0) {
                // Needed card: crisp glowing tick on baseline
                ctx.fillStyle = isActive ? '#38bdf8' : 'rgba(16, 185, 129, 0.45)';
                ctx.fillRect(x, h - 5, Math.max(1, slotW - 0.5), 4);
            } else if (qty === 1) {
                // Single owned: vibrant emerald green bar with tall rich gradient
                const barH = Math.round(h * 0.60);
                const grad = ctx.createLinearGradient(0, h - barH, 0, h);
                grad.addColorStop(0, isActive ? '#67e8f9' : '#34d399');
                grad.addColorStop(1, isActive ? '#0284c7' : '#059669');
                ctx.fillStyle = grad;
                ctx.fillRect(x, h - barH, Math.max(1.2, slotW), barH);
            } else {
                // Doubles (2x+): prominent ruby red trade surplus tower
                const barH = Math.round(h * 0.92);
                const grad = ctx.createLinearGradient(0, h - barH, 0, h);
                grad.addColorStop(0, isActive ? '#fbcfe8' : '#f87171');
                grad.addColorStop(1, isActive ? '#db2777' : '#dc2626');
                ctx.fillStyle = grad;
                ctx.fillRect(x, h - barH, Math.max(1.5, slotW), barH);
            }
        }

        // Scrub reticle / needle
        if (activeX !== null) {
            ctx.fillStyle = '#38bdf8';
            ctx.fillRect(Math.max(0, activeX - 1.5), 0, 3, h);
            ctx.fillStyle = '#ffffff';
            ctx.beginPath();
            ctx.arc(activeX, 3, 3, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    // Alternating Call Metrics in Selection Desk Footer Ticker
    // ("this call secured should alternate between all the graphs availible for the vurrent view --- the completeness.... the spectrum summary walk through high lights...")
    let eftCallTimer = null;
    function setupCallMetrics() {
        const total = state.cards?.length || 0;
        if (total === 0) {
            state.callMetrics = [{ label: 'CALL:', value: '0/0 (0%)', badgeColor: '#38bdf8', valColor: '#10b981' }];
            displayCurrentCallMetric();
            return;
        }

        const have = state.cards.filter(c => c.quantity > 0).length;
        const need = Math.max(0, total - have);
        const doublesCount = state.cards.filter(c => c.quantity >= 2).length;
        const pct = Math.round((have / total) * 100);

        const metrics = [
            // 1. Overall Completeness Graph Call (compact without verbose SECURED)
            {
                label: 'CALL:',
                value: `${have}/${total} (${pct}%)`,
                badgeColor: '#38bdf8',
                valColor: '#38bdf8'
            },
            // 2. Set Spectrum Walk-Through Summary
            {
                label: 'SPECTRUM:',
                value: `${have} OWNED · ${need} NEEDED · ${doublesCount} DBL`,
                badgeColor: '#c084fc',
                valColor: '#38bdf8'
            }
        ];

        // 3. Subset Coverage Walk-Through Highlights
        const setsMap = new Map();
        for (const card of state.cards) {
            if (!setsMap.has(card.set_name)) setsMap.set(card.set_name, []);
            setsMap.get(card.set_name).push(card);
        }

        for (const [setName, setCards] of setsMap) {
            const sHave = setCards.filter(c => c.quantity > 0).length;
            const sTotal = setCards.length;
            const sPct = sTotal > 0 ? Math.round((sHave / sTotal) * 100) : 0;
            metrics.push({
                label: `${setName.toUpperCase()}:`,
                value: `${sHave}/${sTotal} (${sPct}%)`,
                badgeColor: '#f59e0b',
                valColor: sHave === sTotal ? '#22c55e' : (sPct >= 50 ? '#38bdf8' : '#e2e8f0')
            });
        }

        // 4. Trade Deck / Market Highlights
        if (doublesCount > 0 || need > 0) {
            metrics.push({
                label: 'TRADE DECK:',
                value: `${doublesCount} DOUBLES ⇄ ${need} NEEDED`,
                badgeColor: '#ef4444',
                valColor: '#facc15'
            });
        }

        // 5. Team Combined Call (if team view or user has team)
        if (state.currentUser?.team_name) {
            const teamHave = state.teamProgress?.total_collected || have;
            const teamPct = state.teamProgress?.team_pct || pct;
            metrics.push({
                label: `TEAM ${state.currentUser.team_name.toUpperCase()}:`,
                value: `${teamHave}/${total} (${teamPct}%)`,
                badgeColor: '#06b6d4',
                valColor: '#10b981'
            });
        }

        state.callMetrics = metrics;
        state.callMetricIdx = (state.callMetricIdx || 0) % metrics.length;
        displayCurrentCallMetric();
        restartCallMetricsTimer();
    }

    function displayCurrentCallMetric() {
        const chip = document.getElementById('eftCallChip');
        const lbl = document.getElementById('eftCallLbl');
        const val = document.getElementById('eftCallVal');
        if (!lbl || !val || !state.callMetrics || state.callMetrics.length === 0) return;

        const current = state.callMetrics[state.callMetricIdx];
        if (!current) return;

        if (chip) {
            chip.classList.add('flipping');
            setTimeout(() => chip.classList.remove('flipping'), 180);
        }

        lbl.textContent = current.label;
        lbl.style.color = current.badgeColor || '#38bdf8';
        val.textContent = current.value;
        val.style.color = current.valColor || '#10b981';
    }

    function cycleCallMetric() {
        if (!state.callMetrics || state.callMetrics.length === 0) return;
        state.callMetricIdx = (state.callMetricIdx + 1) % state.callMetrics.length;
        displayCurrentCallMetric();
        restartCallMetricsTimer();
    }

    function restartCallMetricsTimer() {
        if (eftCallTimer) clearInterval(eftCallTimer);
        const speed = state.broadcastSpeed || 1;
        const intervalMs = Math.round(3400 / speed);
        eftCallTimer = setInterval(() => {
            if (!state.callMetrics || state.callMetrics.length <= 1) return;
            state.callMetricIdx = (state.callMetricIdx + 1) % state.callMetrics.length;
            displayCurrentCallMetric();
        }, intervalMs);
    }

    function renderSportsHighlights() {
        const total = state.cards.length;
        if (total === 0) return;

        const have = state.cards.filter(c => c.quantity > 0).length;
        const need = Math.max(0, total - have);
        const doublesCount = state.cards.filter(c => c.quantity >= 2).length;

        // Completeness readout ("not in percentage... but in completeness")
        const haveEl = document.getElementById('hlHaveNum');
        const totalEl = document.getElementById('hlTotalNum');
        const subEl = document.getElementById('hlBreakdownSub');
        if (haveEl) haveEl.textContent = have;
        if (totalEl) totalEl.textContent = total;
        if (subEl) {
            subEl.textContent = `${have} Owned · ${need} Needed · ${doublesCount} Trade`;
        }

        const seriesLabelEl = document.getElementById('hlSeriesLabel');
        if (seriesLabelEl) {
            seriesLabelEl.textContent = state.series === '2025-26' ? '2025-26 ARCHIVE' : '2026-27 UD TIM HORTONS';
        }

        // Draw Set Spectrum on Canvas ("list of cards as a set sprinkled, green to red gradient")
        const canvas = document.getElementById('hlSpectrumCanvas');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            const dpr = window.devicePixelRatio || 1;
            const rect = canvas.getBoundingClientRect();
            const w = rect.width || 250;
            const h = 48;
            canvas.width = w * dpr;
            canvas.height = h * dpr;
            ctx.scale(dpr, dpr);

            // Dark sports broadcast background
            ctx.fillStyle = '#050811';
            ctx.fillRect(0, 0, w, h);

            // Baseline tick bar
            ctx.fillStyle = '#1e293b';
            ctx.fillRect(0, h - 3, w, 3);

            // Sprinkled cards mapped across the checklist
            const slotW = Math.max(1, w / total);
            for (let i = 0; i < total; i++) {
                const card = state.cards[i];
                const x = (i / total) * w;
                const qty = card.quantity || 0;

                if (qty === 0) {
                    // Needed card: subtle green tick matching needed market acquisition targets
                    ctx.fillStyle = 'rgba(16, 185, 129, 0.45)';
                    ctx.fillRect(x, h - 4, Math.max(1, slotW - 0.5), 3);
                } else if (qty === 1) {
                    // Single owned: vibrant emerald green bar
                    const barH = 26;
                    const grad = ctx.createLinearGradient(0, h - barH, 0, h);
                    grad.addColorStop(0, '#34d399');
                    grad.addColorStop(1, '#059669');
                    ctx.fillStyle = grad;
                    ctx.fillRect(x, h - barH, Math.max(1.2, slotW), barH);
                } else {
                    // Doubles (2x+): taller red trade surplus bar
                    const barH = 42;
                    const grad = ctx.createLinearGradient(0, h - barH, 0, h);
                    grad.addColorStop(0, '#f87171');
                    grad.addColorStop(1, '#dc2626');
                    ctx.fillStyle = grad;
                    ctx.fillRect(x, h - barH, Math.max(1.4, slotW), barH);
                }
            }
        }

        // Subsets coverage & interaction graph
        const setsMap = new Map();
        for (const card of state.cards) {
            if (!setsMap.has(card.set_name)) setsMap.set(card.set_name, []);
            setsMap.get(card.set_name).push(card);
        }

        const subsetBarsEl = document.getElementById('hlSubsetBars');
        if (subsetBarsEl) {
            let sHtml = '';
            let count = 0;
            for (const [setName, setCards] of setsMap) {
                if (count++ >= 3) break;
                const sHave = setCards.filter(c => c.quantity > 0).length;
                const sPct = setCards.length > 0 ? Math.round((sHave / setCards.length) * 100) : 0;
                sHtml += `<div class="hl-subset-row">
                    <div class="hl-subset-meta">
                        <span>${esc(setName)}</span>
                        <span>${sHave}/${setCards.length} (${sPct}%)</span>
                    </div>
                    <div class="hl-subset-track">
                        <div class="hl-subset-fill" style="width: ${sPct}%"></div>
                    </div>
                </div>`;
            }
            subsetBarsEl.innerHTML = sHtml;
        }

        // Selection Desk / Sports Broadcast Footer Ticker alternating call metrics
        setupCallMetrics();

        const eftStream = document.getElementById('eftStream');
        if (eftStream && total > 0) {
            const seriesName = state.series === '2025-26' ? '2025-26 Tim Hortons' : '2026-27 UD Tim Hortons';
            const userTitle = isOwn() ? (state.currentUser?.collector_name || 'My Collection') : viewedName();
            const teamName = state.currentUser?.team_name || 'Hawks';

            const items = [];

            // Leading broadcast call
            const pct = Math.round((have / total) * 100);
            items.push(`
                <div class="eft-callout">
                    <span class="eft-callout-badge">LIVE CALL</span>
                    <span>${esc(userTitle)}: ${have}/${total} (${pct}%) IN ${esc(seriesName.toUpperCase())}</span>
                </div>
            `);

            // Walk through collection cards with compact red & blue text
            // "this should be red and ble text   secured and needed are too many words and too much space
            // make the player name and card number worth the colout and apped or prepend"
            for (let i = 0; i < total; i++) {
                const card = state.cards[i];
                const qty = card.quantity || 0;
                let itemStatusCls = 'eft-status-needed';
                let numHtml = '';
                let nameHtml = '';

                if (qty === 0) {
                    // Needed card: red text, 🔻 prepended to card number
                    itemStatusCls = 'eft-status-needed';
                    numHtml = `<span class="eft-item-num eft-needed-text">🔻 #${esc(card.card_number)}</span>`;
                    nameHtml = `<span class="eft-item-name eft-needed-text">${esc(card.player_name)}</span>`;
                } else if (qty === 1) {
                    // Single owned/secured: blue text, ✓ appended to player name
                    itemStatusCls = 'eft-status-owned';
                    numHtml = `<span class="eft-item-num eft-owned-text">#${esc(card.card_number)}</span>`;
                    nameHtml = `<span class="eft-item-name eft-owned-text">${esc(card.player_name)} ✓</span>`;
                } else {
                    // Trade surplus double: amber/red text, ⭐️${qty}x appended
                    itemStatusCls = 'eft-status-trade';
                    numHtml = `<span class="eft-item-num eft-trade-text">#${esc(card.card_number)}</span>`;
                    nameHtml = `<span class="eft-item-name eft-trade-text">${esc(card.player_name)} ⭐️${qty}x</span>`;
                }

                items.push(`
                    <div class="eft-item ${itemStatusCls}" data-id="${card.id}" title="Click to jump to #${esc(card.card_number)} ${esc(card.player_name)}">
                        ${numHtml}
                        ${nameHtml}
                        <span class="eft-item-set">${esc(card.set_name)}</span>
                    </div>
                `);

                // Interspersed breaking calls every 16 cards
                if (i > 0 && i % 16 === 0) {
                    const subsetInfo = setsMap.get(card.set_name);
                    const sHave = subsetInfo ? subsetInfo.filter(c => c.quantity > 0).length : 0;
                    const sTot = subsetInfo ? subsetInfo.length : 0;
                    const sPct = sTot > 0 ? Math.round((sHave / sTot) * 100) : 0;
                    items.push(`
                        <div class="eft-callout">
                            <span class="eft-callout-badge">SUBSET CALL</span>
                            <span>${esc(card.set_name)}: ${sHave}/${sTot} (${sPct}%)</span>
                        </div>
                    `);
                }
            }

            // Summary desk calls
            items.push(`
                <div class="eft-callout">
                    <span class="eft-callout-badge">TRADE DESK</span>
                    <span>${doublesCount} ACTIVE TRADE DOUBLES AVAILABLE (RED)</span>
                </div>
            `);
            items.push(`
                <div class="eft-callout">
                    <span class="eft-callout-badge">TEAM DESK</span>
                    <span>TEAM ${esc(teamName.toUpperCase())} TRACKING LIVE</span>
                </div>
            `);

            // Duplicate array for seamless infinite ticker loop
            eftStream.innerHTML = items.join('') + items.join('');

            // Pace the walk-through according to broadcast speed
            const speed = state.broadcastSpeed || 1;
            const durationSec = Math.max(90, Math.min(2400, Math.round((items.length * 14) / speed)));
            eftStream.style.animationDuration = `${durationSec}s`;
        }
    }

    // Rotating Stats in L-Bar bottom left footer
    // ("these stats should rotate on the L bar bottom left footer corner instea of the login information")
    let rotatingStatsTimer = null;
    function renderRotatingStats() {
        const total = state.cards.length;
        if (total === 0) return;

        const have = state.cards.filter(c => c.quantity > 0).length;
        const need = Math.max(0, total - have);
        const doublesCount = state.cards.filter(c => c.quantity >= 2).length;
        const pct = Math.round((have / total) * 100);
        const teamName = state.currentUser?.team_name || 'Hawks';
        const teamHave = state.teamProgress?.total_collected || have;
        const teamPct = Math.round((teamHave / total) * 100);

        state.rotatingStatCards = [
            {
                type: 'have',
                filter: 'all',
                label: 'COLLECTION SECURED',
                value: `${have} / ${total}`,
                sub: `${pct}% Complete`,
                accent: '#10b981',
                icon: '🟢'
            },
            {
                type: 'need',
                filter: 'missing',
                label: 'WANTED TARGETS',
                value: `${need} CARDS`,
                sub: '🔻 NEEDED IN SET',
                accent: '#ef4444',
                icon: '🔻'
            },
            {
                type: 'trade',
                filter: 'doubles',
                label: 'SURPLUS INVENTORY',
                value: `${doublesCount} DOUBLES`,
                sub: '⭐️ FOR TRADE (RED)',
                accent: '#f59e0b',
                icon: '⭐️'
            },
            {
                type: 'team',
                filter: 'team_needs',
                label: `TEAM ${teamName.toUpperCase()}`,
                value: `${teamHave} / ${total}`,
                sub: `👥 ${teamPct}% Synergy`,
                accent: '#38bdf8',
                icon: '🏒'
            }
        ];

        state.rotatingStatIdx = (state.rotatingStatIdx || 0) % state.rotatingStatCards.length;
        displayCurrentRotatingStat();
        restartRotatingStatsTimer();
    }

    function displayCurrentRotatingStat() {
        const stage = document.getElementById('srwStage');
        const dotsRow = document.getElementById('srwDotsRow');
        const cards = state.rotatingStatCards;
        if (!stage || !cards || cards.length === 0) return;

        const cur = cards[state.rotatingStatIdx];
        stage.style.borderColor = cur.accent;
        stage.innerHTML = `
            <div style="display:flex; flex-direction:column; gap:2px; line-height:1.2;">
                <span style="font-size:0.62rem; font-weight:800; color:${cur.accent}; letter-spacing:0.06em; text-transform:uppercase;">${cur.label}</span>
                <span style="font-size:1.05rem; font-weight:900; color:#f8fafc; font-family:ui-monospace, SFMono-Regular, Menlo, monospace;">${cur.value}</span>
            </div>
            <div style="display:flex; flex-direction:column; align-items:flex-end; gap:2px;">
                <span style="font-size:1.15rem; line-height:1;">${cur.icon}</span>
                <span style="font-size:0.65rem; font-weight:700; color:#cbd5e1;">${cur.sub}</span>
            </div>
        `;
        stage.onclick = () => setFilter(cur.filter);

        if (dotsRow) {
            dotsRow.innerHTML = cards.map((c, i) => `
                <span class="srw-dot ${i === state.rotatingStatIdx ? 'active' : ''}" data-idx="${i}" onclick="jumpRotatingStat(${i})"></span>
            `).join('');
        }
    }

    function jumpRotatingStat(idx) {
        if (!state.rotatingStatCards || state.rotatingStatCards.length === 0) return;
        const len = state.rotatingStatCards.length;
        state.rotatingStatIdx = ((idx % len) + len) % len;
        displayCurrentRotatingStat();
        restartRotatingStatsTimer();
    }

    function cycleBroadcastSpeed() {
        const speeds = [0.5, 1, 2, 5];
        const cur = state.broadcastSpeed || 1;
        const nextIdx = (speeds.indexOf(cur) + 1) % speeds.length;
        setBroadcastSpeed(speeds[nextIdx]);
    }

    function setBroadcastSpeed(speed) {
        state.broadcastSpeed = speed;
        try { localStorage.setItem('cards_broadcast_speed', String(speed)); } catch (e) {}

        const label = `⚡ ${speed}x`;
        const srwSpeedBtn = document.getElementById('srwSpeedBtn');
        const eftSpeedBtn = document.getElementById('eftSpeedBtn');
        if (srwSpeedBtn) srwSpeedBtn.textContent = label;
        if (eftSpeedBtn) eftSpeedBtn.textContent = label;

        // Recalculate ticker speed
        const eftStream = document.getElementById('eftStream');
        if (eftStream && state.cards?.length > 0) {
            const baseDuration = Math.max(350, Math.min(2400, state.cards.length * 14));
            eftStream.style.animationDuration = `${Math.round(baseDuration / speed)}s`;
        }

        restartRotatingStatsTimer();
        restartCallMetricsTimer();
        toast(`Broadcast & stats speed updated to ${speed}x`);
    }

    function restartRotatingStatsTimer() {
        if (rotatingStatsTimer) clearInterval(rotatingStatsTimer);
        const speed = state.broadcastSpeed || 1;
        const intervalMs = Math.round(3600 / speed);
        rotatingStatsTimer = setInterval(() => {
            if (!state.rotatingStatCards || state.rotatingStatCards.length === 0) return;
            state.rotatingStatIdx = (state.rotatingStatIdx + 1) % state.rotatingStatCards.length;
            displayCurrentRotatingStat();
        }, intervalMs);
    }

    function renderSeriesNav(sets) {
        const chipsRow = document.getElementById('seriesChipsRow');
        const sublistRow = document.getElementById('seriesSublistRow');
        if (!chipsRow || !sublistRow) return;

        if (!sets || sets.size === 0) {
            chipsRow.innerHTML = '';
            sublistRow.innerHTML = '';
            return;
        }

        if (!state.activeNavSet || !sets.has(state.activeNavSet)) {
            state.activeNavSet = sets.keys().next().value;
        }

        let chipsHtml = '';
        for (const [setName, cards] of sets) {
            const have = cards.filter(c => c.quantity > 0).length;
            const isActive = (state.activeNavSet === setName);
            chipsHtml += `<button type="button" class="series-chip ${isActive ? 'active' : ''}" data-set="${esc(setName)}">
                <span class="chip-name">${esc(setName)}</span>
                <span class="chip-count">${have}/${cards.length}</span>
            </button>`;
        }
        chipsRow.innerHTML = chipsHtml;

        const activeCards = sets.get(state.activeNavSet) || [];
        const totalPages = Math.ceil(activeCards.length / 9) || 1;
        const isPage = state.layout === 'page';

        let sublistHtml = `<div class="sublist-lead"><strong>${esc(state.activeNavSet)}</strong> Quick Jump:</div>`;
        sublistHtml += `<div class="sublist-pills-wrap">`;

        for (let p = 1; p <= totalPages; p++) {
            const slice = activeCards.slice((p - 1) * 9, p * 9);
            const firstNum = slice[0]?.card_number ?? ((p - 1) * 9 + 1);
            const lastNum = slice[slice.length - 1]?.card_number ?? (p * 9);
            const rangeStr = `#${firstNum}–#${lastNum}`;
            const sheetHave = slice.filter(c => c.quantity > 0).length;
            const label = isPage ? `Sheet ${p}` : `Group ${p}`;

            sublistHtml += `<button type="button" class="sublist-jump-btn" data-set="${esc(state.activeNavSet)}" data-sheet="${p}" title="Jump to ${label} (${rangeStr})">
                <span class="jump-sheet-num">${label}</span>
                <span class="jump-card-range">${rangeStr} · ${sheetHave}/${slice.length}</span>
            </button>`;
        }

        sublistHtml += `</div>`;
        sublistRow.innerHTML = sublistHtml;
    }

    // ==========================================================================
    // MCMASTER-CARR BY-JOB & SPECIFICATIONS CATALOG LENS
    // ==========================================================================
    const JOB_CATEGORIES = {
        netminder: {
            id: 'netminder',
            title: 'Netminders & Crease Anchors',
            icon: '🥅',
            shortDesc: 'Puck stoppers & crease commanders',
            longDesc: 'The primary defensive anchor. Responsible for turning away high-danger chances, tracking cross-ice feeds, rebound control, and maintaining positioning in the blue paint under heavy barrage.',
        },
        defense: {
            id: 'defense',
            title: 'Blue Liners & Puck Movers',
            icon: '🛡️',
            shortDesc: 'Transition quarterbacks & blue line stoppers',
            longDesc: 'Guards the defensive perimeter, initiates zone breakouts with tape-to-tape transition passes, logs heavy all-situation minutes, and quarterbacks offensive blue-line pressure.',
        },
        sniper: {
            id: 'sniper',
            title: 'Snipers & Goal Finishers',
            icon: '🎯',
            shortDesc: 'One-timer specialists & lethal marksmen',
            longDesc: 'High-velocity offensive weapons specializing in high-danger conversion, quick wrist releases, pinpoint one-timers from the circles, and elite shooting percentage.',
        },
        playmaker: {
            id: 'playmaker',
            title: 'Playmakers & Ice Generals',
            icon: '🧠',
            shortDesc: 'Visionary distributors & 200-foot pivots',
            longDesc: 'Controls offensive pace, dissects defensive coverage with elite vision, wins crucial center-ice draws, and manufactures high-danger scoring lanes for linemates.',
        },
        power_forward: {
            id: 'power_forward',
            title: 'Power Forwards & Two-Way Battlers',
            icon: '💥',
            shortDesc: 'Net-front disruption & physical board battlers',
            longDesc: 'Combines heavy physical presence with scoring touch. Dominates board battles, screens goaltenders in the blue paint, and forces turnovers deep in opponent zones.',
        },
        phenom: {
            id: 'phenom',
            title: 'Next-Gen Phenoms & Rising Rookies',
            icon: '🌟',
            shortDesc: 'First-round talent & breakthrough rookies',
            longDesc: 'The vanguard of NHL talent. Highly touted draft picks and breakthrough rookies making immediate impacts on team trajectories and collector market demand.',
        },
        legend: {
            id: 'legend',
            title: 'Franchise Icons & Legends',
            icon: '👑',
            shortDesc: 'Heritage champions & historical cornerstones',
            longDesc: 'Foundational historical figures, multi-Cup champions, and legendary franchise cornerstones who defined the game and hockey lore across generations.',
        }
    };

    const PLAYER_SPECS = {
        // Goalies / Netminders
        'Jeremy Swayman': { role: 'Crease Anchor', job: 'netminder', pos: 'G', team: 'BOS', shoots: 'L', age: 27, born: 1998, draft: '2017 #111', timeline: '2021–Pres', desc: 'Elite positioning and post-to-post agility' },
        'Igor Shesterkin': { role: 'Franchise Netminder', job: 'netminder', pos: 'G', team: 'NYR', shoots: 'L', age: 30, born: 1995, draft: '2014 #118', timeline: '2019–Pres', desc: 'Vezina Trophy winner, high-danger rebound control' },
        'Connor Hellebuyck': { role: 'Workhorse Stopper', job: 'netminder', pos: 'G', team: 'WPG', shoots: 'L', age: 32, born: 1993, draft: '2012 #130', timeline: '2015–Pres', desc: '2x Vezina winner, heavy-volume workhorse crease commander' },
        'Andrei Vasilevskiy': { role: 'Championship Anchor', job: 'netminder', pos: 'G', team: 'TBL', shoots: 'L', age: 31, born: 1994, draft: '2012 #19', timeline: '2014–Pres', desc: '2x Stanley Cup, Conn Smythe, big-game clutch performer' },
        'Jake Oettinger': { role: 'Crease Anchor', job: 'netminder', pos: 'G', team: 'DAL', shoots: 'L', age: 27, born: 1998, draft: '2017 #26', timeline: '2020–Pres', desc: 'Size, calm butterfly technique and playoff poise' },
        'Ilya Sorokin': { role: 'Acrobatic Stopper', job: 'netminder', pos: 'G', team: 'NYI', shoots: 'L', age: 30, born: 1995, draft: '2014 #78', timeline: '2020–Pres', desc: 'Exceptional lateral explosiveness and paddle saves' },
        'Dustin Wolf': { role: 'Next-Gen Netminder', job: 'netminder', pos: 'G', team: 'CGY', shoots: 'L', age: 24, born: 2001, draft: '2019 #214', timeline: '2023–Pres', desc: '2x AHL MVP, ultra-quick reflexes and tracking' },
        'Linus Ullmark': { role: 'Vezina Stopper', job: 'netminder', pos: 'G', team: 'OTT', shoots: 'L', age: 32, born: 1993, draft: '2012 #163', timeline: '2015–Pres', desc: 'Vezina Trophy winner, technically sound size and tracking' },
        'Darcy Kuemper': { role: 'Veteran Anchor', job: 'netminder', pos: 'G', team: 'LAK', shoots: 'L', age: 35, born: 1990, draft: '2009 #161', timeline: '2013–Pres', desc: 'Stanley Cup champion netminder with veteran mileage' },
        'Jordan Binnington': { role: 'Cup Champion Stopper', job: 'netminder', pos: 'G', team: 'STL', shoots: 'L', age: 32, born: 1993, draft: '2011 #88', timeline: '2016–Pres', desc: 'Stanley Cup champion with fiery competitive crease edge' },
        'Stuart Skinner': { role: 'Crease Starter', job: 'netminder', pos: 'G', team: 'EDM', shoots: 'L', age: 27, born: 1998, draft: '2017 #78', timeline: '2021–Pres', desc: 'Homegrown starter anchoring deep playoff runs' },
        'Joey Daccord': { role: 'Breakout Stopper', job: 'netminder', pos: 'G', team: 'SEA', shoots: 'L', age: 29, born: 1996, draft: '2015 #199', timeline: '2019–Pres', desc: 'Acrobatic puck-handling netminder with breakout save percentage' },
        'Filip Gustavsson': { role: 'Crease Stopper', job: 'netminder', pos: 'G', team: 'MIN', shoots: 'L', age: 27, born: 1998, draft: '2016 #55', timeline: '2020–Pres', desc: 'Calm positional goalie with elite puck tracking' },
        'Anthony Stolarz': { role: 'Big-Frame Stopper', job: 'netminder', pos: 'G', team: 'TOR', shoots: 'L', age: 32, born: 1994, draft: '2012 #45', timeline: '2016–Pres', desc: '6-foot-6 frame, 2024 Stanley Cup ring, high save efficiency' },
        'Sergei Bobrovsky': { role: 'Championship Anchor', job: 'netminder', pos: 'G', team: 'FLA', shoots: 'L', age: 37, born: 1988, draft: 'Undrafted', timeline: '2010–Pres', desc: '2x Vezina, 2024 Stanley Cup champion, acrobatic recovery' },
        'Lukas Dostal': { role: 'Rising Stopper', job: 'netminder', pos: 'G', team: 'ANA', shoots: 'L', age: 25, born: 2000, draft: '2018 #85', timeline: '2021–Pres', desc: 'World Championship MVP, rapid recovery and glove speed' },
        'Joseph Woll': { role: 'Technique Stopper', job: 'netminder', pos: 'G', team: 'TOR', shoots: 'L', age: 27, born: 1998, draft: '2016 #62', timeline: '2021–Pres', desc: 'Composed technical style with calm lateral slides' },
        'Adin Hill': { role: 'Cup Champion Anchor', job: 'netminder', pos: 'G', team: 'VGK', shoots: 'L', age: 29, born: 1996, draft: '2015 #76', timeline: '2017–Pres', desc: '2023 Stanley Cup winning netminder, huge wingspan' },
        'Logan Thompson': { role: 'Athletic Stopper', job: 'netminder', pos: 'G', team: 'WSH', shoots: 'R', age: 29, born: 1997, draft: 'Undrafted', timeline: '2021–Pres', desc: 'Rare right-catching starter with dynamic athletic recovery' },
        'Juuse Saros': { role: 'Elite Reflex Anchor', job: 'netminder', pos: 'G', team: 'NSH', shoots: 'L', age: 30, born: 1995, draft: '2013 #99', timeline: '2015–Pres', desc: 'Lightning-fast recovery, precise edge control and vision' },
        'Thatcher Demko': { role: 'Vezina Finalist', job: 'netminder', pos: 'G', team: 'VAN', shoots: 'L', age: 30, born: 1995, draft: '2014 #36', timeline: '2018–Pres', desc: 'Massive butterfly coverage, flexible post-integration' },
        'Sam Montembeault': { role: 'Workhorse Stopper', job: 'netminder', pos: 'G', team: 'MTL', shoots: 'L', age: 29, born: 1996, draft: '2015 #77', timeline: '2018–Pres', desc: 'High-volume save producer, calm under heavy shot counts' },
        'Jacob Markstrom': { role: 'Towering Stopper', job: 'netminder', pos: 'G', team: 'NJD', shoots: 'L', age: 36, born: 1990, draft: '2008 #31', timeline: '2010–Pres', desc: '6-foot-6 veteran anchor with aggressive depth control' },

        // Defensemen / Blue Liners
        'Cale Makar': { role: 'Franchise Blue Liner', job: 'defense', pos: 'D', team: 'COL', shoots: 'R', age: 27, born: 1998, draft: '2017 #4', timeline: '2019–Pres', desc: 'Generational offensive defenseman, Norris & Conn Smythe' },
        'Quinn Hughes': { role: 'Puck-Moving General', job: 'defense', pos: 'D', team: 'VAN', shoots: 'L', age: 26, born: 1999, draft: '2018 #7', timeline: '2019–Pres', desc: 'Norris Trophy winner, transcendent edge work and transition' },
        'Adam Fox': { role: 'IQ Quarterback', job: 'defense', pos: 'D', team: 'NYR', shoots: 'R', age: 28, born: 1998, draft: '2016 #66', timeline: '2019–Pres', desc: 'Norris Trophy winner, elite deception and breakout vision' },
        'Miro Heiskanen': { role: 'All-Situation Anchor', job: 'defense', pos: 'D', team: 'DAL', shoots: 'L', age: 26, born: 1999, draft: '2017 #3', timeline: '2018–Pres', desc: 'Smooth skating, shuts down elite forwards and logs 26+ mins' },
        'Evan Bouchard': { role: 'Heavy Artillery Blue Liner', job: 'defense', pos: 'D', team: 'EDM', shoots: 'R', age: 26, born: 1999, draft: '2018 #10', timeline: '2018–Pres', desc: 'Devastating slap shot, elite powerplay quarterback' },
        'Rasmus Dahlin': { role: 'Franchise Cornerstone', job: 'defense', pos: 'D', team: 'BUF', shoots: 'L', age: 25, born: 2000, draft: '2018 #1', timeline: '2018–Pres', desc: 'Physical, skilled two-way workhorse captain' },
        'Drew Doughty': { role: 'Hall of Fame Anchor', job: 'defense', pos: 'D', team: 'LAK', shoots: 'R', age: 36, born: 1989, draft: '2008 #2', timeline: '2008–Pres', desc: '2x Stanley Cup, Norris Trophy, elite competitive intensity' },
        'Victor Hedman': { role: 'Towering General', job: 'defense', pos: 'D', team: 'TBL', shoots: 'L', age: 35, born: 1990, draft: '2009 #2', timeline: '2009–Pres', desc: '6-foot-7 icon, 2x Cup, Norris, Conn Smythe champion' },
        'Roman Josi': { role: 'Rush Catalyst', job: 'defense', pos: 'D', team: 'NSH', shoots: 'L', age: 35, born: 1990, draft: '2008 #38', timeline: '2011–Pres', desc: 'Norris Trophy winner, dynamic end-to-end puck carrier' },
        'Josh Morrissey': { role: 'Two-Way Blue Liner', job: 'defense', pos: 'D', team: 'WPG', shoots: 'L', age: 30, born: 1995, draft: '2013 #13', timeline: '2015–Pres', desc: 'Elite transition passing and defensive zone entry denial' },
        'Zach Werenski': { role: 'Offensive Anchor', job: 'defense', pos: 'D', team: 'CBJ', shoots: 'L', age: 28, born: 1997, draft: '2015 #8', timeline: '2016–Pres', desc: 'Dynamic offensive defenseman and powerplay quarterback' },
        'Shea Theodore': { role: 'Puck-Moving Maestro', job: 'defense', pos: 'D', team: 'VGK', shoots: 'L', age: 30, born: 1995, draft: '2013 #26', timeline: '2015–Pres', desc: 'Stanley Cup champion, effortless skating and poise under pressure' },
        'Brock Faber': { role: 'Shutdown Quarterback', job: 'defense', pos: 'D', team: 'MIN', shoots: 'R', age: 23, born: 2002, draft: '2020 #45', timeline: '2023–Pres', desc: 'Calder finalist, logged massive minutes in rookie season' },
        'Noah Dobson': { role: 'High-Output General', job: 'defense', pos: 'D', team: 'NYI', shoots: 'R', age: 26, born: 2000, draft: '2018 #12', timeline: '2019–Pres', desc: 'Top-tier offensive distributor with reach and smooth mobility' },
        'Moritz Seider': { role: 'Heavyweight Stopper', job: 'defense', pos: 'D', team: 'DET', shoots: 'R', age: 24, born: 2001, draft: '2019 #6', timeline: '2021–Pres', desc: 'Calder Trophy winner, punishing open-ice hits and minutes muncher' },
        'Charlie McAvoy': { role: 'Two-Way Juggernaut', job: 'defense', pos: 'D', team: 'BOS', shoots: 'R', age: 28, born: 1997, draft: '2016 #14', timeline: '2017–Pres', desc: 'Physical force, rugged defender, dynamic transition driver' },
        'Morgan Rielly': { role: 'Rush Quarterback', job: 'defense', pos: 'D', team: 'TOR', shoots: 'L', age: 32, born: 1994, draft: '2012 #5', timeline: '2013–Pres', desc: 'Longtime defensive catalyst and playoff scoring threat' },

        // Snipers & Finishers
        'Auston Matthews': { role: 'Generational Sniper', job: 'sniper', pos: 'C', team: 'TOR', shoots: 'L', age: 28, born: 1997, draft: '2016 #1', timeline: '2016–Pres', desc: '3x Rocket Richard, 69-goal season, lethal drag release' },
        'Alex Ovechkin': { role: 'All-Time Goal King', job: 'sniper', pos: 'LW', team: 'WSH', shoots: 'R', age: 40, born: 1985, draft: '2004 #1', timeline: '2005–Pres', desc: '9x Rocket Richard, chasing all-time NHL goal scoring record' },
        'David Pastrnak': { role: 'Elite Finisher', job: 'sniper', pos: 'RW', team: 'BOS', shoots: 'R', age: 29, born: 1996, draft: '2014 #25', timeline: '2014–Pres', desc: 'Rocket Richard winner, deadly one-timer from left circle' },
        'Nikita Kucherov': { role: 'Master Gunner & Architect', job: 'sniper', pos: 'RW', team: 'TBL', shoots: 'L', age: 32, born: 1993, draft: '2011 #58', timeline: '2013–Pres', desc: '2x Art Ross, Hart Trophy, 100-assist scorer, deceptive release' },
        'Sam Reinhart': { role: 'High-Percentage Finisher', job: 'sniper', pos: 'RW', team: 'FLA', shoots: 'R', age: 30, born: 1995, draft: '2014 #2', timeline: '2014–Pres', desc: '57-goal season, 2024 Cup champion, elite bumper-slot marksman' },
        'Brock Boeser': { role: 'Pure Marksman', job: 'sniper', pos: 'RW', team: 'VAN', shoots: 'R', age: 28, born: 1997, draft: '2015 #23', timeline: '2017–Pres', desc: 'Lethal wrist shot, heavy one-timer, clutch playoff goal-scorer' },
        'Kevin Fiala': { role: 'Dynamic Winger', job: 'sniper', pos: 'LW', team: 'LAK', shoots: 'L', age: 29, born: 1996, draft: '2014 #11', timeline: '2015–Pres', desc: 'Explosive skater, creative perimeter threat and sniper' },
        'Matt Boldy': { role: 'Power Winger', job: 'sniper', pos: 'LW', team: 'MIN', shoots: 'L', age: 24, born: 2001, draft: '2019 #12', timeline: '2021–Pres', desc: 'Size, soft hands in tight, rapid wrist release' },
        'Cole Caufield': { role: 'Quick-Draw Specialist', job: 'sniper', pos: 'RW', team: 'MTL', shoots: 'R', age: 25, born: 2001, draft: '2019 #15', timeline: '2021–Pres', desc: 'Lightning release, finds shooting lanes with minimal space' },
        'Kyle Connor': { role: 'Perimeter Finisher', job: 'sniper', pos: 'LW', team: 'WPG', shoots: 'L', age: 29, born: 1996, draft: '2015 #17', timeline: '2016–Pres', desc: 'Perennial 35+ goal scorer with breakaway speed and elite hands' },
        'Tage Thompson': { role: 'Long-Range Cannon', job: 'sniper', pos: 'C/RW', team: 'BUF', shoots: 'R', age: 28, born: 1997, draft: '2016 #26', timeline: '2017–Pres', desc: '6-foot-6 frame, 100mph one-timer, dangling puck skill' },
        'Jason Robertson': { role: 'Clinical Slot Scorer', job: 'sniper', pos: 'LW', team: 'DAL', shoots: 'L', age: 26, born: 1999, draft: '2017 #39', timeline: '2019–Pres', desc: 'Deceptive release, supreme anticipation and scoring touch' },
        'Kirill Kaprizov': { role: 'Explosive Gamebreaker', job: 'sniper', pos: 'LW', team: 'MIN', shoots: 'L', age: 28, born: 1997, draft: '2015 #135', timeline: '2020–Pres', desc: 'Calder Trophy winner, elusive lower-body power and finishing' },

        // Playmakers & Ice Generals
        'Connor McDavid': { role: 'Generational Maestro', job: 'playmaker', pos: 'C', team: 'EDM', shoots: 'L', age: 29, born: 1997, draft: '2015 #1', timeline: '2015–Pres', desc: '3x Hart, 5x Art Ross, Conn Smythe, transcendent speed and IQ' },
        'Nathan MacKinnon': { role: 'High-Power Ice General', job: 'playmaker', pos: 'C', team: 'COL', shoots: 'R', age: 30, born: 1995, draft: '2013 #1', timeline: '2013–Pres', desc: 'Hart Trophy, Stanley Cup champion, explosive bull-rush speed' },
        'Leon Draisaitl': { role: 'Puck-Protection General', job: 'playmaker', pos: 'C', team: 'EDM', shoots: 'L', age: 30, born: 1995, draft: '2014 #3', timeline: '2014–Pres', desc: 'Hart Trophy, Art Ross, premier backhand passer and shooter' },
        'Jack Eichel': { role: 'Transition Commander', job: 'playmaker', pos: 'C', team: 'VGK', shoots: 'R', age: 29, born: 1996, draft: '2015 #2', timeline: '2015–Pres', desc: 'Stanley Cup champion, powerful long stride and vision' },
        'Nick Suzuki': { role: '200-Foot Captain', job: 'playmaker', pos: 'C', team: 'MTL', shoots: 'R', age: 26, born: 1999, draft: '2017 #13', timeline: '2019–Pres', desc: 'Captain of Montreal, cerebral distributor and clutch playmaker' },
        'Sebastian Aho': { role: 'Complete Pivot', job: 'playmaker', pos: 'C', team: 'CAR', shoots: 'L', age: 28, born: 1997, draft: '2015 #35', timeline: '2016–Pres', desc: 'Two-way catalyst, high-IQ penalty killer and offensive engine' },
        'Tim Stützle': { role: 'Electrifying Playmaker', job: 'playmaker', pos: 'C', team: 'OTT', shoots: 'L', age: 24, born: 2002, draft: '2020 #3', timeline: '2020–Pres', desc: 'High-speed agility, creative zone entries and vision' },
        'Mitch Marner': { role: 'Pass-First Maestro', job: 'playmaker', pos: 'RW', team: 'TOR', shoots: 'R', age: 28, born: 1997, draft: '2015 #4', timeline: '2016–Pres', desc: 'Magic hands, elite penalty killer, premier assist generator' },
        'Jack Hughes': { role: 'Dynamic Rush Driver', job: 'playmaker', pos: 'C', team: 'NJD', shoots: 'L', age: 24, born: 2001, draft: '2019 #1', timeline: '2019–Pres', desc: 'Effortless edge work, deceptive passing and rapid transition' },
        'Dylan Strome': { role: 'Playmaking Pivot', job: 'playmaker', pos: 'C', team: 'WSH', shoots: 'L', age: 29, born: 1997, draft: '2015 #3', timeline: '2016–Pres', desc: 'Soft touch around the net, excellent powerplay distributor' },
        'Mark Scheifele': { role: 'Top-Unit Pivot', job: 'playmaker', pos: 'C', team: 'WPG', shoots: 'R', age: 32, born: 1993, draft: '2011 #7', timeline: '2011–Pres', desc: 'Franchise center, precise one-timers and high-IQ playmaking' },
        'Robert Thomas': { role: 'Elite Visionary', job: 'playmaker', pos: 'C', team: 'STL', shoots: 'R', age: 26, born: 1999, draft: '2017 #20', timeline: '2018–Pres', desc: 'Stanley Cup champion, one of the NHL’s purest passers' },
        'Brayden Point': { role: 'Clutch Speed General', job: 'playmaker', pos: 'C', team: 'TBL', shoots: 'R', age: 29, born: 1996, draft: '2014 #79', timeline: '2016–Pres', desc: '2x Cup champion, phenomenal playoff performer in tight spaces' },

        // Power Forwards & Battlers
        'Matthew Tkachuk': { role: 'Franchise Agitator', job: 'power_forward', pos: 'LW', team: 'FLA', shoots: 'L', age: 28, born: 1997, draft: '2016 #6', timeline: '2016–Pres', desc: '2024 Cup champion, relentless net-front disrupter and leader' },
        'Brady Tkachuk': { role: 'Power Forward Captain', job: 'power_forward', pos: 'LW', team: 'OTT', shoots: 'L', age: 26, born: 1999, draft: '2018 #4', timeline: '2018–Pres', desc: 'Physical wrecking ball, high shot volume, fearless team leader' },
        'Aleksander Barkov': { role: 'Selke Trophy Icon', job: 'power_forward', pos: 'C', team: 'FLA', shoots: 'L', age: 30, born: 1995, draft: '2013 #2', timeline: '2013–Pres', desc: '2024 Stanley Cup captain, 2x Selke winner, 200-foot juggernaut' },
        'Travis Konecny': { role: 'High-Motor Agitator', job: 'power_forward', pos: 'RW', team: 'PHI', shoots: 'R', age: 29, born: 1997, draft: '2015 #24', timeline: '2016–Pres', desc: 'Tenacious forechecker, breakaway speed, gritty heart-and-soul' },
        'Tyler Bertuzzi': { role: 'Net-Front Grinder', job: 'power_forward', pos: 'LW', team: 'CHI', shoots: 'L', age: 31, born: 1995, draft: '2013 #58', timeline: '2016–Pres', desc: 'Greasy net-front goals, tip-in specialist, relentless physical battle' },
        'Tom Wilson': { role: 'Heavyweight Enforcer & Scorer', job: 'power_forward', pos: 'RW', team: 'WSH', shoots: 'R', age: 32, born: 1994, draft: '2012 #16', timeline: '2013–Pres', desc: 'Cup champion, punishing physical presence with top-six skill' },
        'Brad Marchand': { role: 'Playoff Pest & Leader', job: 'power_forward', pos: 'LW', team: 'BOS', shoots: 'L', age: 37, born: 1988, draft: '2006 #71', timeline: '2009–Pres', desc: 'Cup champion captain, Hall of Fame resume, elite penalty killer' },
        'Sam Bennett': { role: 'Playoff Battering Ram', job: 'power_forward', pos: 'C', team: 'FLA', shoots: 'L', age: 29, born: 1996, draft: '2014 #4', timeline: '2015–Pres', desc: '2024 Cup champion, physical playoff forechecker' },
        'Zach Hyman': { role: 'Net-Front Workhorse', job: 'power_forward', pos: 'LW', team: 'EDM', shoots: 'R', age: 33, born: 1992, draft: '2010 #123', timeline: '2015–Pres', desc: '54-goal scorer, unmatched work ethic in the crease blue paint' },

        // Next-Gen Phenoms & Rookies
        'Ivan Demidov': { role: 'Russian Prodigy', job: 'phenom', pos: 'RW', team: 'MTL', shoots: 'L', age: 20, born: 2005, draft: '2024 #5', timeline: '2024–Pres', desc: 'High-end skill, dynamic skating and playmaking vision' },
        'Matvei Michkov': { role: 'Offensive Wizard', job: 'phenom', pos: 'RW', team: 'PHI', shoots: 'L', age: 21, born: 2004, draft: '2023 #7', timeline: '2024–Pres', desc: 'Electrifying creativity, lacrosse-style Michigan goals and swagger' },
        'Macklin Celebrini': { role: 'Franchise Centerpiece', job: 'phenom', pos: 'C', team: 'SJS', shoots: 'L', age: 19, born: 2006, draft: '2024 #1', timeline: '2024–Pres', desc: '#1 overall pick, Hobey Baker winner, 200-foot complete pivot' },
        'Will Smith': { role: 'Playmaking Phenom', job: 'phenom', pos: 'C', team: 'SJS', shoots: 'R', age: 20, born: 2005, draft: '2023 #4', timeline: '2024–Pres', desc: 'Silky smooth hands, Boston College star, dynamic offensive instinct' },
        'Connor Bedard': { role: 'Generational Talent', job: 'phenom', pos: 'C', team: 'CHI', shoots: 'R', age: 20, born: 2005, draft: '2023 #1', timeline: '2023–Pres', desc: 'Calder Trophy winner, world-class curl-and-drag wrist shot' },
        'Leo Carlsson': { role: 'Towering Playmaker', job: 'phenom', pos: 'C', team: 'ANA', shoots: 'L', age: 21, born: 2004, draft: '2023 #2', timeline: '2023–Pres', desc: '6-foot-3 Swedish prodigy, poise, soft touch, exceptional reach' },
        'Leo Carlson': { role: 'Towering Playmaker', job: 'phenom', pos: 'C', team: 'ANA', shoots: 'L', age: 21, born: 2004, draft: '2023 #2', timeline: '2023–Pres', desc: '6-foot-3 Swedish prodigy, poise, soft touch, exceptional reach' },
        'Lane Hutson': { role: 'Deceptive Blue Liner', job: 'phenom', pos: 'D', team: 'MTL', shoots: 'L', age: 22, born: 2004, draft: '2022 #62', timeline: '2024–Pres', desc: 'World-class head fakes, vision, and dynamic blue-line walk' },
        'Adam Fantilli': { role: 'Power Pivot Phenom', job: 'phenom', pos: 'C', team: 'CBJ', shoots: 'L', age: 21, born: 2004, draft: '2023 #3', timeline: '2023–Pres', desc: 'Hobey Baker winner, rare combo of explosive speed, power, and shot' },
        'Logan Stankoven': { role: 'High-Octane Spark', job: 'phenom', pos: 'C/RW', team: 'DAL', shoots: 'R', age: 23, born: 2003, draft: '2021 #47', timeline: '2024–Pres', desc: 'Endless engine, fearless competitor, rapid offensive attack' },
        'William Eklund': { role: 'Swedish Wizard', job: 'phenom', pos: 'LW', team: 'SJS', shoots: 'L', age: 23, born: 2002, draft: '2021 #7', timeline: '2021–Pres', desc: 'Cerebral playmaker with quick-strike scoring touch' },
        'Juraj Slafkovsky': { role: 'Power Forward Prodigy', job: 'phenom', pos: 'LW', team: 'MTL', shoots: 'L', age: 21, born: 2004, draft: '2022 #1', timeline: '2022–Pres', desc: '6-foot-3 #1 pick, physical cycle dominance and growing finish' },
        'Juraj Slavkovsky': { role: 'Power Forward Prodigy', job: 'phenom', pos: 'LW', team: 'MTL', shoots: 'L', age: 21, born: 2004, draft: '2022 #1', timeline: '2022–Pres', desc: '6-foot-3 #1 pick, physical cycle dominance and growing finish' },

        // Franchise Icons & Legends
        'Tim Horton': { role: 'Hall of Fame Legend', job: 'legend', pos: 'D', team: 'TOR/BUF', shoots: 'R', age: 44, born: 1930, draft: 'Historical', timeline: '1949–1974', desc: '4x Stanley Cup champion with Toronto, HOF 1977, Canadian coffee icon' },
        'Sidney Crosby': { role: 'All-Time Icon', job: 'legend', pos: 'C', team: 'PIT', shoots: 'L', age: 38, born: 1987, draft: '2005 #1', timeline: '2005–Pres', desc: '3x Stanley Cup, 2x Conn Smythe, Olympic gold hero, generational captain' },
        'Patrick Kane': { role: 'American Scoring Icon', job: 'legend', pos: 'RW', team: 'DET', shoots: 'L', age: 37, born: 1988, draft: '2007 #1', timeline: '2007–Pres', desc: '3x Stanley Cup champion, Hart Trophy, Conn Smythe, premier stickhandler' },
        'Steven Stamkos': { role: 'Franchise 500-Goal Scorer', job: 'legend', pos: 'C/RW', team: 'NSH', shoots: 'R', age: 36, born: 1990, draft: '2008 #1', timeline: '2008–Pres', desc: '2x Stanley Cup captain, 2x Rocket Richard, legendary left-circle blast' },
        'Evgeni Malkin': { role: 'Power General Icon', job: 'legend', pos: 'C', team: 'PIT', shoots: 'L', age: 39, born: 1986, draft: '2004 #2', timeline: '2006–Pres', desc: '3x Stanley Cup, Hart Trophy, Conn Smythe, unstoppable physical beast' }
    };

    function getPlayerSpec(name, card = null) {
        const cleanName = (name || '').trim();
        if (PLAYER_SPECS[cleanName]) {
            return { ...PLAYER_SPECS[cleanName] };
        }
        // Normalize common typos or variations
        const normalized = cleanName.replace('Stutzle', 'Stützle');
        if (PLAYER_SPECS[normalized]) {
            return { ...PLAYER_SPECS[normalized] };
        }

        // Duo or composite card check (e.g. McDavid/Draisaitl)
        if (cleanName.includes('/')) {
            const parts = cleanName.split('/');
            const first = getPlayerSpec(parts[0], card);
            return {
                role: 'Dual Franchise Pairing',
                job: first.job || 'playmaker',
                pos: 'DUO',
                team: first.team || 'NHL',
                shoots: first.shoots || 'L',
                age: first.age || 28,
                born: first.born || 1997,
                draft: 'Featured Tandem',
                timeline: 'Co-Star Era',
                desc: `Featured star duo featuring ${parts.join(' and ')}.`
            };
        }

        // Heuristic derivation based on subset or name patterns
        const setName = (card?.set_name || '').toLowerCase();
        if (setName.includes('goalie') || setName.includes('crease')) {
            return { role: 'Crease Netminder', job: 'netminder', pos: 'G', team: 'NHL', shoots: 'L', age: 27, born: 1998, draft: 'Drafted', timeline: 'Active Era', desc: 'Puck-stopping netminder guarding the goal crease.' };
        }
        if (setName.includes('above the ice')) {
            return { role: 'Acetate Defender', job: 'defense', pos: 'D', team: 'NHL', shoots: 'L', age: 26, born: 1999, draft: 'Drafted', timeline: 'Active Era', desc: 'Premier blue-line anchor patrolling above the ice.' };
        }
        if (setName.includes('next gen') || setName.includes('phenom') || setName.includes('young gun') || setName.includes('rookie')) {
            return { role: 'Breakthrough Phenom', job: 'phenom', pos: 'F', team: 'NHL', shoots: 'L', age: 21, born: 2004, draft: 'Top Pick', timeline: 'Rookie Era', desc: 'Emerging rookie phenom with high-ceiling potential.' };
        }
        if (setName.includes('attack angle') || setName.includes('celly')) {
            return { role: 'Dynamic Finisher', job: 'sniper', pos: 'W', team: 'NHL', shoots: 'R', age: 27, born: 1998, draft: 'Drafted', timeline: 'Active Era', desc: 'Perimeter finisher attacking high-danger angles.' };
        }
        if (setName.includes('first liner') || setName.includes('pillar') || setName.includes('profile')) {
            return { role: 'Top-Unit Pivot', job: 'playmaker', pos: 'C', team: 'NHL', shoots: 'L', age: 28, born: 1997, draft: 'Drafted', timeline: 'Active Era', desc: 'Core franchise cornerstone and primary playmaker.' };
        }
        if (setName.includes('signature') || setName.includes('relic') || setName.includes('timbits')) {
            return { role: 'Franchise Star', job: 'legend', pos: 'F', team: 'NHL', shoots: 'L', age: 31, born: 1994, draft: 'Drafted', timeline: 'Veteran Era', desc: 'Featured superstar with premium collectible memorabilia.' };
        }

        // Safe fallback
        return {
            role: 'Professional Skater',
            job: 'playmaker',
            pos: 'F',
            team: 'NHL',
            shoots: 'L',
            age: 26,
            born: 1999,
            draft: 'Drafted',
            timeline: 'Active Era',
            desc: 'Professional NHL skater contributing 200-foot gameplay.'
        };
    }

    function renderJobCatalog(sets) {
        const allCards = state.cards;
        const visibleCards = allCards.filter(c => matchesFilter(c) && (!hasActiveParamFilters() || matchesParamFilters(c)));
        const haveTotal = allCards.filter(c => c.quantity > 0).length;
        const totalCards = allCards.length;
        const overallPct = totalCards ? Math.round((haveTotal / totalCards) * 100) : 0;
        const mode = state.jobMode || 'visual';
        const selectedJob = state.selectedJob || 'all';

        // Group cards by job
        const jobMap = new Map();
        Object.keys(JOB_CATEGORIES).forEach(key => jobMap.set(key, []));

        visibleCards.forEach(card => {
            const spec = getPlayerSpec(card.player_name, card);
            if (!jobMap.has(spec.job)) jobMap.set(spec.job, []);
            jobMap.get(spec.job).push({ card, spec });
        });

        // Compute counts per job across all cards (unfiltered for sidebar badges)
        const allJobCounts = new Map();
        Object.keys(JOB_CATEGORIES).forEach(key => allJobCounts.set(key, { total: 0, have: 0 }));
        allCards.forEach(card => {
            const spec = getPlayerSpec(card.player_name, card);
            if (!allJobCounts.has(spec.job)) allJobCounts.set(spec.job, { total: 0, have: 0 });
            const item = allJobCounts.get(spec.job);
            item.total++;
            if (card.quantity > 0) item.have++;
        });

        let html = `
        <div class="mc-catalog-wrapper" id="mcCatalogWrapper">
            <div class="mc-top-accent"></div>
            <div class="mc-header-bar">
                <div class="mc-breadcrumbs">
                    Product Index <span>›</span> Collectibles <span>›</span> <strong>By Job Specifications & Roles</strong>
                </div>
                <div class="mc-view-toggles">
                    <button type="button" class="mc-mode-toggle ${mode === 'visual' ? 'active' : ''}" data-mc-mode="visual" title="McMaster Visual Grid with Player Cards & Roles">🖼️ Visual Catalog</button>
                    <button type="button" class="mc-mode-toggle ${mode === 'table' ? 'active' : ''}" data-mc-mode="table" title="McMaster Engineering Specification Table with Timelines & Specs">📊 Engineering Specs Table</button>
                </div>
            </div>

            <div class="mc-catalog-body">
                <!-- LEFT SIDEBAR: "Choose a Job / Role" -->
                <aside class="mc-sidebar">
                    <div>
                        <div class="mc-sidebar-section-title">Choose a Job / Role</div>
                        <ul class="mc-sidebar-list">
                            <li>
                                <button type="button" class="mc-sidebar-btn ${selectedJob === 'all' ? 'active' : ''}" data-job="all">
                                    <span>🏒 All Jobs & Roles</span>
                                    <span class="mc-sidebar-badge">${haveTotal}/${totalCards}</span>
                                </button>
                            </li>`;

        for (const [key, cat] of Object.entries(JOB_CATEGORIES)) {
            const counts = allJobCounts.get(key) || { total: 0, have: 0 };
            const isActive = selectedJob === key;
            html += `
                            <li>
                                <button type="button" class="mc-sidebar-btn ${isActive ? 'active' : ''}" data-job="${key}" title="${esc(cat.longDesc)}">
                                    <span>${cat.icon} ${esc(cat.title.split('&')[0].trim())}</span>
                                    <span class="mc-sidebar-badge">${counts.have}/${counts.total}</span>
                                </button>
                            </li>`;
        }

        html += `
                        </ul>
                    </div>

                    <div>
                        <div class="mc-sidebar-section-title">Collection Filter</div>
                        <div class="mc-filter-box">
                            <button type="button" class="mc-sidebar-btn ${state.filter === 'all' ? 'active' : ''}" data-filter-set="all">
                                <span>📋 All Cards</span>
                                <span class="mc-sidebar-badge">${totalCards}</span>
                            </button>
                            <button type="button" class="mc-sidebar-btn ${state.filter === 'missing' ? 'active' : ''}" data-filter-set="missing">
                                <span>🔻 In Need / Missing</span>
                                <span class="mc-sidebar-badge">${Math.max(0, totalCards - haveTotal)}</span>
                            </button>
                            <button type="button" class="mc-sidebar-btn ${state.filter === 'doubles' ? 'active' : ''}" data-filter-set="doubles">
                                <span>⇄ Trade Doubles</span>
                                <span class="mc-sidebar-badge">${allCards.filter(c => c.quantity >= 2).length}</span>
                            </button>
                        </div>
                    </div>
                </aside>

                <!-- RIGHT MAIN PANEL -->
                <main class="mc-main-panel">
                    <div class="mc-summary-banner">
                        <div>
                            <div class="mc-summary-title">${selectedJob === 'all' ? 'All Roles & Job Specifications' : (JOB_CATEGORIES[selectedJob]?.title || 'Job Specifications')}</div>
                            <div class="mc-summary-stats">${haveTotal}/${totalCards} Collected (${overallPct}%) · Showing ${visibleCards.length} matching cards in catalog</div>
                        </div>
                    </div>`;

        if (mode === 'visual') {
            // Visual Catalog Mode (Screenshot 0 & 1)
            let renderedGroups = 0;
            for (const [jobKey, cat] of Object.entries(JOB_CATEGORIES)) {
                if (selectedJob !== 'all' && selectedJob !== jobKey) continue;
                const items = jobMap.get(jobKey) || [];
                if (items.length === 0 && (state.filter !== 'all' || hasActiveParamFilters())) continue;

                const catHave = items.filter(i => i.card.quantity > 0).length;
                renderedGroups++;

                html += `
                    <section class="mc-job-group" id="mc-job-${jobKey}">
                        <h2 class="mc-section-h2">
                            <span>${cat.icon} ${esc(cat.title)}</span>
                            <span class="mc-section-counts">${catHave}/${items.length} Owned</span>
                        </h2>
                        <div class="mc-section-desc">${esc(cat.longDesc)}</div>
                        <div class="mc-card-grid">`;

                for (const item of items) {
                    const card = item.card;
                    const spec = item.spec;
                    const isCollected = card.quantity >= 1;
                    const isDoubles = card.quantity >= 2;
                    const cls = isDoubles ? 'doubles' : isCollected ? 'collected' : 'missing';
                    const statusText = isDoubles ? `×${card.quantity} Stock` : isCollected ? '✓ In Binder' : 'Need';
                    const partNum = `CK-26-${String(card.id).padStart(3, '0')}`;

                    html += `
                        <div class="card mc-card ${cls}" data-id="${card.id}" data-player="${esc(card.player_name)}" title="Click to view McMaster specs & details">
                            <div class="mc-thumb">
                                <div class="mc-thumb-head">
                                    <span class="mc-num-badge">#${esc(card.card_number || card.id)}</span>
                                    <span class="mc-pos-badge">${esc(spec.pos)}</span>
                                </div>
                                <div class="mc-thumb-body">
                                    <div class="mc-jersey-icon">${spec.pos === 'G' ? '🥅' : spec.pos === 'D' ? '🛡️' : '🏒'}</div>
                                </div>
                                <div class="mc-thumb-foot">
                                    <span class="mc-status-pill">${statusText}</span>
                                </div>
                            </div>
                            <div class="mc-card-caption">
                                <div class="mc-player-name">${esc(card.player_name)}</div>
                                <div class="mc-player-role">${esc(spec.team)} · ${esc(spec.role)}</div>
                                <div class="mc-player-timeline">${esc(spec.timeline)} · Age ${spec.age}</div>
                            </div>
                        </div>`;
                }

                html += `</div></section>`;
            }

            if (renderedGroups === 0) {
                html += `<div class="notice">No cards match the active job and collection filter.</div>`;
            }
        } else {
            // Engineering Specs Table Mode (Screenshot 2 & 3)
            html += `
                <div class="mc-spec-table-wrap">
                    <table class="mc-spec-table">
                        <thead>
                            <tr>
                                <th>Card</th>
                                <th>Part Number</th>
                                <th>Player Name</th>
                                <th>Job Role</th>
                                <th>Pos</th>
                                <th>Team</th>
                                <th>Shoots</th>
                                <th>Age</th>
                                <th>Draft / Timeline</th>
                                <th>Subset / Series</th>
                                <th>Inventory Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>`;

            let tableRows = 0;
            for (const [jobKey, cat] of Object.entries(JOB_CATEGORIES)) {
                if (selectedJob !== 'all' && selectedJob !== jobKey) continue;
                const items = jobMap.get(jobKey) || [];

                for (const item of items) {
                    tableRows++;
                    const card = item.card;
                    const spec = item.spec;
                    const partNum = `CK-26-${String(card.id).padStart(3, '0')}`;
                    const isCollected = card.quantity >= 1;
                    const isDoubles = card.quantity >= 2;
                    const statusPill = isDoubles
                        ? `<span class="mc-status-pill doubles" style="color:#92400e; background:#fef08a;">×${card.quantity} Doubles</span>`
                        : isCollected
                        ? `<span class="mc-status-pill collected" style="color:#13683a; background:#bbf7d0;">✓ In Binder</span>`
                        : `<span class="mc-status-pill missing" style="color:#64748b; background:#e2e8f0;">🔻 Needed</span>`;

                    const actionLabel = isDoubles ? '+ Add Double' : isCollected ? '+ Add Double' : 'Add to Binder';

                    html += `
                        <tr class="mc-spec-row" data-id="${card.id}">
                            <td style="text-align:center; width:36px;">
                                <span style="font-size:1.1rem;">${spec.pos === 'G' ? '🥅' : spec.pos === 'D' ? '🛡️' : '🏒'}</span>
                            </td>
                            <td>
                                <span class="mc-part-num" data-action="spec-detail" data-id="${card.id}">${partNum}</span>
                            </td>
                            <td>
                                <strong style="color:#0f172a; cursor:pointer;" data-action="spec-detail" data-id="${card.id}">${esc(card.player_name)}</strong>
                            </td>
                            <td><span style="color:#13683a; font-weight:700;">${esc(spec.role)}</span></td>
                            <td><span class="mc-pos-badge">${esc(spec.pos)}</span></td>
                            <td><strong>${esc(spec.team)}</strong></td>
                            <td>${esc(spec.shoots)}</td>
                            <td>${spec.age}</td>
                            <td><span style="color:#64748b; font-size:0.75rem;">${esc(spec.draft)} (${esc(spec.timeline)})</span></td>
                            <td>${esc(card.set_name)} #${esc(card.card_number)}</td>
                            <td>${statusPill}</td>
                            <td>
                                <button type="button" class="mc-table-btn" data-action="toggle-qty" data-id="${card.id}">${actionLabel}</button>
                            </td>
                        </tr>`;
                }
            }

            if (tableRows === 0) {
                html += `<tr><td colspan="12" style="text-align:center; padding:20px; color:#64748b;">No specifications match this filter.</td></tr>`;
            }

            html += `</tbody></table></div>`;
        }

        html += `
                </main>
            </div>
        </div>`;

        return html;
    }

    function attachJobCatalogEvents() {
        const wrapper = document.getElementById('mcCatalogWrapper');
        if (!wrapper) return;

        // View mode toggles: visual vs table
        wrapper.querySelectorAll('.mc-mode-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const newMode = btn.dataset.mcMode;
                state.jobMode = newMode;
                try { localStorage.setItem('cards_job_mode', newMode); } catch (e) {}
                document.querySelectorAll('.layout-btn').forEach(lb => {
                    const isMatch = lb.dataset.layout === 'job' &&
                        (!lb.dataset.jobMode || lb.dataset.jobMode === state.jobMode);
                    lb.classList.toggle('active', isMatch);
                });
                render();
            });
        });

        // Job category navigation in sidebar
        wrapper.querySelectorAll('.mc-sidebar-btn[data-job]').forEach(btn => {
            btn.addEventListener('click', () => {
                state.selectedJob = btn.dataset.job;
                render();
            });
        });

        // Filter shortcuts in sidebar
        wrapper.querySelectorAll('.mc-sidebar-btn[data-filter-set]').forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.dataset.filterSet;
                state.filter = filter;
                document.querySelectorAll('#filters button').forEach(b => {
                    b.classList.toggle('active', b.dataset.filter === filter);
                });
                render();
            });
        });

        // Part number click / detail click
        wrapper.querySelectorAll('[data-action="spec-detail"]').forEach(el => {
            el.addEventListener('click', e => {
                e.stopPropagation();
                const id = Number(el.dataset.id);
                const card = state.cards.find(c => c.id === id);
                if (card) openMcDetailDrawer(card);
            });
        });

        // Table action buttons
        wrapper.querySelectorAll('[data-action="toggle-qty"]').forEach(btn => {
            btn.addEventListener('click', async e => {
                e.stopPropagation();
                if (!canEdit()) {
                    toast("Switch viewing mode to your own collection to edit binder quantities.");
                    return;
                }
                const id = Number(btn.dataset.id);
                const card = state.cards.find(c => c.id === id);
                if (!card) return;
                const nextQty = (card.quantity || 0) + 1;
                await setCardQuantity(id, nextQty);
            });
        });
    }

    let activeMcDetailCardId = null;
    async function openMcDetailDrawer(card) {
        if (!card) return;
        activeMcDetailCardId = card.id;
        const spec = getPlayerSpec(card.player_name, card);
        const partNum = `CK-26-${String(card.id).padStart(3, '0')}`;
        const isCollected = card.quantity >= 1;
        const isDoubles = card.quantity >= 2;

        let existing = document.getElementById('mcDetailDrawer');
        if (!existing) {
            existing = document.createElement('div');
            existing.id = 'mcDetailDrawer';
            existing.className = 'mc-detail-drawer';
            document.body.appendChild(existing);
        }

        existing.innerHTML = `
            <div class="mc-drawer-yellow-stripe"></div>
            <div class="mc-drawer-content">
                <div class="mc-drawer-head">
                    <div>
                        <div style="font-size:0.7rem; font-weight:800; color:#13683a; font-family:monospace;">${partNum} • CARD #${esc(card.card_number || card.id)}</div>
                        <h3 style="font-size:1.05rem; font-weight:800; margin:2px 0 0 0; color:#0f172a;">${esc(card.player_name)}</h3>
                        <div style="font-size:0.76rem; color:#475569; font-weight:600;">${esc(spec.role)} (${esc(JOB_CATEGORIES[spec.job]?.title || spec.job)})</div>
                    </div>
                    <button type="button" class="mc-drawer-close" id="mcDrawerCloseBtn" title="Close Specification Sheet">×</button>
                </div>

                <div class="mc-drawer-img-wrap" id="mcDrawerImgWrap">
                    <div style="font-size:2.8rem; filter:drop-shadow(0 2px 4px rgba(0,0,0,0.15));">${spec.pos === 'G' ? '🥅' : spec.pos === 'D' ? '🛡️' : '🏒'}</div>
                </div>

                <div class="mc-drawer-specs-grid">
                    <div class="mc-drawer-spec-item"><strong>Position:</strong> ${esc(spec.pos)}</div>
                    <div class="mc-drawer-spec-item"><strong>Team:</strong> ${esc(spec.team)}</div>
                    <div class="mc-drawer-spec-item"><strong>Shoots:</strong> ${esc(spec.shoots)}</div>
                    <div class="mc-drawer-spec-item"><strong>Age / Born:</strong> ${spec.age} (${spec.born || 'N/A'})</div>
                    <div class="mc-drawer-spec-item"><strong>Draft:</strong> ${esc(spec.draft)}</div>
                    <div class="mc-drawer-spec-item"><strong>Timeline:</strong> ${esc(spec.timeline)}</div>
                    <div class="mc-drawer-spec-item" style="grid-column: span 2;"><strong>Subset Series:</strong> ${esc(card.set_name)}</div>
                </div>

                <div id="mcDrawerBioExtract" style="font-size:0.76rem; line-height:1.35; color:#334155; max-height:80px; overflow-y:auto; border-left:2px solid #13683a; padding-left:8px;">
                    ${esc(spec.desc)}. Loading live Wikipedia technical biography...
                </div>

                <div class="mc-order-box">
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <span style="font-size:0.75rem; font-weight:700; color:#64748b;">INVENTORY STATUS</span>
                        <span style="font-size:0.75rem; font-weight:800; color:${isDoubles ? '#d97706' : isCollected ? '#13683a' : '#64748b'};">
                            ${isDoubles ? `✓ In Stock (${card.quantity}x Doubles)` : isCollected ? '✓ In Stock (In Binder)' : '🔻 Needed for Binder'}
                        </span>
                    </div>

                    <div style="display:flex; gap:8px;">
                        <button type="button" class="mc-add-btn" id="mcDrawerAddBtn" style="flex:1;">
                            ${isCollected ? '+ ADD DOUBLE TO BINDER' : 'ADD TO BINDER'}
                        </button>
                        ${isCollected ? `<button type="button" id="mcDrawerRemoveBtn" style="background:#fee2e2; border:1px solid #fca5a5; color:#b91c1c; border-radius:4px; font-size:0.74rem; font-weight:700; padding:6px 10px; cursor:pointer;">Remove</button>` : ''}
                    </div>

                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:2px;">
                        <span style="font-size:0.68rem; color:#64748b;">Delivers to Binder instantly</span>
                        <a href="https://en.wikipedia.org/wiki/Special:Search?search=${encodeURIComponent(card.player_name)}" target="_blank" rel="noopener" id="mcDrawerWikiLink" style="font-size:0.72rem; color:#13683a; font-weight:700; text-decoration:none;">Wikipedia Bio ↗</a>
                    </div>
                </div>
            </div>
        `;

        // Bind events
        document.getElementById('mcDrawerCloseBtn')?.addEventListener('click', closeMcDetailDrawer);

        document.getElementById('mcDrawerAddBtn')?.addEventListener('click', async () => {
            if (!canEdit()) {
                toast("Switch viewing mode to your own collection to edit binder quantities.");
                return;
            }
            const nextQty = (card.quantity || 0) + 1;
            await setCardQuantity(card.id, nextQty);
            const updated = state.cards.find(c => c.id === card.id);
            if (updated) openMcDetailDrawer(updated);
        });

        document.getElementById('mcDrawerRemoveBtn')?.addEventListener('click', async () => {
            if (!canEdit()) return;
            await setCardQuantity(card.id, 0);
            const updated = state.cards.find(c => c.id === card.id);
            if (updated) openMcDetailDrawer(updated);
        });

        // Fetch Wikipedia live thumbnail and bio
        try {
            const wikiData = await api('wiki_player', { name: card.player_name });
            if (activeMcDetailCardId === card.id && wikiData) {
                if (wikiData.thumbnail) {
                    const imgWrap = document.getElementById('mcDrawerImgWrap');
                    if (imgWrap) {
                        imgWrap.innerHTML = `<img src="${esc(wikiData.thumbnail)}" alt="${esc(card.player_name)}" class="mc-drawer-img">`;
                    }
                }
                if (wikiData.extract) {
                    const bioEl = document.getElementById('mcDrawerBioExtract');
                    if (bioEl) {
                        bioEl.textContent = wikiData.extract;
                    }
                }
                if (wikiData.wiki_url) {
                    const wikiLink = document.getElementById('mcDrawerWikiLink');
                    if (wikiLink) {
                        wikiLink.href = wikiData.wiki_url;
                    }
                }
            }
        } catch (e) {
            console.warn('Could not load Wikipedia profile for', card.player_name, e);
        }
    }

    function closeMcDetailDrawer() {
        const el = document.getElementById('mcDetailDrawer');
        if (el) el.remove();
        activeMcDetailCardId = null;
    }

    function render() {
        const container = document.getElementById('cardsContainer');
        const sets = new Map();
        for (const card of state.cards) {
            if (!sets.has(card.set_name)) sets.set(card.set_name, []);
            sets.get(card.set_name).push(card);
        }

        updateVUMeterAndHighlights();
        renderSeriesNav(sets);
        setupMobileSubsetsBar(sets);
        populateParamInventoryFilter();
        container.classList.toggle('readonly', !canEdit());

        let html = '';
        if (isTeamView()) {
            html += `<div class="notice team-notice">
                👥 <strong>Team ${esc(state.currentUser?.team_name ?? '')} Combined Progress</strong>.
                Cards marked with ✓ are owned by at least one teammate. Team members only see cards within their own team!
            </div>`;
        } else if (isGuestMode()) {
            html += `<div class="notice guest-sandbox-banner" style="background:#f0fdf4; border:2px solid #22c55e; border-radius:10px; padding:12px 16px; margin-bottom:14px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
                <div>
                    <div style="font-weight:900; color:#15803d; font-size:1rem; display:flex; align-items:center; gap:6px;">
                        <span>🎭 GUEST TRADER SANDBOX:</span>
                        <span style="color:#0f172a;">Active Collection</span>
                    </div>
                    <div style="font-size:0.84rem; color:#334155; margin-top:2px;">
                        You are in Guest Mode! Add and subtract cards, configure doubles, and offer trades against other collectors in the market!
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:8px;">
                    <button type="button" onclick="openTradeMarket()" style="background:#0f172a; color:#fff; font-size:0.84rem; font-weight:800; padding:6px 12px; border-radius:6px; cursor:pointer;">🤝 Offer Trade / Rig Market</button>
                    <button type="button" onclick="document.getElementById('newCollectorTopbarBtn').click()" style="background:#16a34a; color:#fff; font-size:0.84rem; font-weight:800; padding:6px 12px; border-radius:6px; cursor:pointer;">💾 Lock In (+ Collector)</button>
                </div>
            </div>`;
        } else if (!isOwn()) {
            const isGuest = !state.userId;
            if (isAdminTinkering()) {
                html += `<div class="notice admin-tinker-banner" style="background:#eff6ff; border:2px solid #0284c7; border-radius:8px; padding:12px 16px; margin-bottom:14px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
                    <div>
                        <div style="font-weight:900; color:#0369a1; font-size:1rem; display:flex; align-items:center; gap:6px;">
                            <span>🛡️ ADMIN TINKER MODE:</span>
                            <span style="color:#0f172a;">Editing ${esc(viewedName())}'s Collection</span>
                        </div>
                        <div style="font-size:0.84rem; color:#475569; margin-top:2px;">
                            You have full admin privileges. Click any card to toggle, adjust doubles, or set quantities directly for this collector!
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <a href="admin.php" style="background:#0284c7; color:#fff; font-size:0.82rem; font-weight:700; padding:6px 12px; border-radius:6px; text-decoration:none;">⚙️ Admin Panel</a>
                        <button type="button" onclick="switchToOwnCollection()" style="background:#fff; border:1px solid #cbd5e1; font-size:0.82rem; font-weight:700; padding:6px 12px; border-radius:6px; cursor:pointer;">👤 My Collection</button>
                    </div>
                </div>`;
            } else {
                html += `<div class="notice" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px;">
                    <div>Viewing <strong>${esc(viewedName())}</strong>'s collection (read-only). ${isGuest ? 'Cards marked <span class="need" style="color:#10b981; border-color:#10b981;">🔻 NEED</span> are their doubles you can trade for!' : (state.userId ? 'Cards marked <span class="need">NEED</span> are their doubles you\'re missing.' : '')}</div>
                    <button type="button" onclick="openTradeMarket(${state.viewId})" style="background:#0f172a; color:#fff; font-size:0.8rem; font-weight:700; padding:5px 12px; border-radius:6px; cursor:pointer;">🤝 Trade with ${esc(viewedName())}</button>
                </div>`;
            }
        }

        // Dedicated McMaster-Carr "By Job & Specifications" Catalog Lens
        if (state.layout === 'job') {
            html += renderJobCatalog(sets);
            container.innerHTML = html;
            attachJobCatalogEvents();
            return;
        }

        const isPageLayout = state.layout === 'page';

        for (const [setName, cards] of sets) {
            const sortedCards = sortCards(cards);
            const visible = sortedCards.filter(matchesFilter);
            if (!visible.length && (state.filter !== 'all' || hasActiveParamFilters())) continue;

            const have = cards.filter(c => c.quantity > 0).length;
            const setPct = Math.round(have / cards.length * 100);
            const open = state.collapsed.has(setName) ? '' : ' open';
            const cleanId = cleanSetId(setName);

            let gridContent = '';
            if (isPageLayout) {
                // 3x3 Binder Page Sheets: 9 cards per sheet (Pos 1 to 9)
                const totalPages = Math.ceil(sortedCards.length / 9) || 1;
                const pages = [];

                for (let pIdx = 0; pIdx < totalPages; pIdx++) {
                    const slice = sortedCards.slice(pIdx * 9, (pIdx + 1) * 9);
                    const pagePockets = [];
                    let hasMatching = false;
                    for (let pos = 1; pos <= 9; pos++) {
                        const card = slice[pos - 1] || null;
                        if (card) {
                            const isMatch = matchesFilter(card);
                            if (isMatch) hasMatching = true;
                            pagePockets.push({ pos, card, isMatch });
                        } else {
                            pagePockets.push({ pos, card: null, isMatch: false });
                        }
                    }
                    if ((state.filter === 'all' && !hasActiveParamFilters()) || hasMatching) {
                        pages.push({ pageNum: pIdx + 1, pockets: pagePockets });
                    }
                }

                gridContent = pages.map(p => renderBinderPage(p.pockets, p.pageNum, totalPages, setName)).join('');
            } else {
                // List Mode: column groups
                const groups = [];
                sortedCards.forEach((card, i) => {
                    if (!matchesFilter(card)) return;
                    (groups[Math.floor(i / 9)] ??= []).push(card);
                });
                gridContent = groups.filter(Boolean).map((g, idx) => `<div class="group list-group" id="group-${cleanId}-${idx}">${g.map(renderCard).join('')}</div>`).join('');
            }

            const gridClass = isPageLayout ? 'grid layout-page' : 'grid layout-list';

            html += `<details class="set" id="set-${cleanId}" data-set="${esc(setName)}"${open}>
                <summary>${esc(setName)} <span class="set-count">${have}/${cards.length}</span>
                    <span class="progress"><span style="width:${setPct}%"></span></span></summary>
                <div class="${gridClass}">${gridContent}</div>
            </details>`;
        }
        if (!html) html = '<div class="notice">No cards match the selected filter.</div>';
        container.innerHTML = html;
        updateStickyOffsets();
    }

    function renderBinderPage(pockets, pageNum, totalPages, setName) {
        const pageCollected = pockets.filter(p => p.card && p.card.quantity > 0).length;
        const pageTotal = pockets.filter(p => p.card).length;
        const cleanId = cleanSetId(setName);

        let html = `<div class="binder-page" id="sheet-${cleanId}-${pageNum}">
            <div class="binder-page-header">
                <div class="binder-rings-punch" title="3-ring binder punch holes">
                    <span class="ring-hole"></span>
                    <span class="ring-hole"></span>
                    <span class="ring-hole"></span>
                </div>
                <div class="binder-page-meta">
                    <span class="binder-page-title">SHEET ${pageNum}</span>
                    <span class="binder-page-subtitle">of ${totalPages}</span>
                </div>
                <span class="binder-page-badge">${pageCollected}/${pageTotal} cards</span>
            </div>
            <div class="binder-grid-3x3">`;

        for (const pocket of pockets) {
            if (pocket.card && (state.filter === 'all' || pocket.isMatch)) {
                html += renderPageCard(pocket.card, pocket.pos);
            } else {
                html += `<div class="card page-card empty-pocket" title="Empty pocket">
                    <div class="card-head"></div>
                    <div style="font-size:0.72rem; color:#94a3b8; font-weight:700;">Empty</div>
                    <div></div>
                </div>`;
            }
        }

        html += `</div></div>`;
        return html;
    }

    // NHL Player Team & Public Photo Directory Mapping
    const NHL_PLAYER_TEAMS = {
        'Connor McDavid': { team: 'Edmonton Oilers', abbr: 'EDM' },
        'Leon Draisaitl': { team: 'Edmonton Oilers', abbr: 'EDM' },
        'Evan Bouchard': { team: 'Edmonton Oilers', abbr: 'EDM' },
        'Zach Hyman': { team: 'Edmonton Oilers', abbr: 'EDM' },
        'Stuart Skinner': { team: 'Edmonton Oilers', abbr: 'EDM' },
        'Ryan Nugent-Hopkins': { team: 'Edmonton Oilers', abbr: 'EDM' },
        'Auston Matthews': { team: 'Toronto Maple Leafs', abbr: 'TOR' },
        'Mitch Marner': { team: 'Toronto Maple Leafs', abbr: 'TOR' },
        'William Nylander': { team: 'Toronto Maple Leafs', abbr: 'TOR' },
        'John Tavares': { team: 'Toronto Maple Leafs', abbr: 'TOR' },
        'Joseph Woll': { team: 'Toronto Maple Leafs', abbr: 'TOR' },
        'Anthony Stolarz': { team: 'Toronto Maple Leafs', abbr: 'TOR' },
        'Tim Horton': { team: 'Toronto Maple Leafs (Legend)', abbr: 'TOR' },
        'Quinn Hughes': { team: 'Vancouver Canucks', abbr: 'VAN' },
        'Elias Pettersson': { team: 'Vancouver Canucks', abbr: 'VAN' },
        'Brock Boeser': { team: 'Vancouver Canucks', abbr: 'VAN' },
        'J.T. Miller': { team: 'Vancouver Canucks', abbr: 'VAN' },
        'Filip Hronek': { team: 'Vancouver Canucks', abbr: 'VAN' },
        'Thatcher Demko': { team: 'Vancouver Canucks', abbr: 'VAN' },
        'Jake DeBrusk': { team: 'Vancouver Canucks', abbr: 'VAN' },
        'Jake Debrusk': { team: 'Vancouver Canucks', abbr: 'VAN' },
        'Nick Suzuki': { team: 'Montreal Canadiens', abbr: 'MTL' },
        'Cole Caufield': { team: 'Montreal Canadiens', abbr: 'MTL' },
        'Juraj Slafkovsky': { team: 'Montreal Canadiens', abbr: 'MTL' },
        'Juraj Slavkovsky': { team: 'Montreal Canadiens', abbr: 'MTL' },
        'Lane Hutson': { team: 'Montreal Canadiens', abbr: 'MTL' },
        'Ivan Demidov': { team: 'Montreal Canadiens', abbr: 'MTL' },
        'Samuel Montembeault': { team: 'Montreal Canadiens', abbr: 'MTL' },
        'Brady Tkachuk': { team: 'Ottawa Senators', abbr: 'OTT' },
        'Tim Stützle': { team: 'Ottawa Senators', abbr: 'OTT' },
        'Tim Stutzle': { team: 'Ottawa Senators', abbr: 'OTT' },
        'Claude Giroux': { team: 'Ottawa Senators', abbr: 'OTT' },
        'Drake Batherson': { team: 'Ottawa Senators', abbr: 'OTT' },
        'Jake Sanderson': { team: 'Ottawa Senators', abbr: 'OTT' },
        'Linus Ullmark': { team: 'Ottawa Senators', abbr: 'OTT' },
        'Dustin Wolf': { team: 'Calgary Flames', abbr: 'CGY' },
        'Jonathan Huberdeau': { team: 'Calgary Flames', abbr: 'CGY' },
        'Rasmus Andersson': { team: 'Calgary Flames', abbr: 'CGY' },
        'Nazem Kadri': { team: 'Calgary Flames', abbr: 'CGY' },
        'MacKenzie Weegar': { team: 'Calgary Flames', abbr: 'CGY' },
        'Connor Hellebuyck': { team: 'Winnipeg Jets', abbr: 'WPG' },
        'Kyle Connor': { team: 'Winnipeg Jets', abbr: 'WPG' },
        'Mark Scheifele': { team: 'Winnipeg Jets', abbr: 'WPG' },
        'Josh Morrissey': { team: 'Winnipeg Jets', abbr: 'WPG' },
        'Nikolaj Ehlers': { team: 'Winnipeg Jets', abbr: 'WPG' },
        'Dylan Samberg': { team: 'Winnipeg Jets', abbr: 'WPG' },
        'Gabe Vilardi': { team: 'Winnipeg Jets', abbr: 'WPG' },
        'Gabe Villardi': { team: 'Winnipeg Jets', abbr: 'WPG' },
        'David Pastrnak': { team: 'Boston Bruins', abbr: 'BOS' },
        'Brad Marchand': { team: 'Boston Bruins', abbr: 'BOS' },
        'Jeremy Swayman': { team: 'Boston Bruins', abbr: 'BOS' },
        'Charlie McAvoy': { team: 'Boston Bruins', abbr: 'BOS' },
        'Elias Lindholm': { team: 'Boston Bruins', abbr: 'BOS' },
        'Nikita Kucherov': { team: 'Tampa Bay Lightning', abbr: 'TBL' },
        'Andrei Vasilevskiy': { team: 'Tampa Bay Lightning', abbr: 'TBL' },
        'Brayden Point': { team: 'Tampa Bay Lightning', abbr: 'TBL' },
        'Jake Guentzel': { team: 'Tampa Bay Lightning', abbr: 'TBL' },
        'Brandon Hagel': { team: 'Tampa Bay Lightning', abbr: 'TBL' },
        'Anthony Cirelli': { team: 'Tampa Bay Lightning', abbr: 'TBL' },
        'Victor Hedman': { team: 'Tampa Bay Lightning', abbr: 'TBL' },
        'Aleksander Barkov': { team: 'Florida Panthers', abbr: 'FLA' },
        'Matthew Tkachuk': { team: 'Florida Panthers', abbr: 'FLA' },
        'Sam Reinhart': { team: 'Florida Panthers', abbr: 'FLA' },
        'Carter Verhaeghe': { team: 'Florida Panthers', abbr: 'FLA' },
        'Anton Lundell': { team: 'Florida Panthers', abbr: 'FLA' },
        'Sergei Bobrovsky': { team: 'Florida Panthers', abbr: 'FLA' },
        'Aaron Ekblad': { team: 'Florida Panthers', abbr: 'FLA' },
        'Sam Bennett': { team: 'Florida Panthers', abbr: 'FLA' },
        'Igor Shesterkin': { team: 'NY Rangers', abbr: 'NYR' },
        'Artemi Panarin': { team: 'NY Rangers', abbr: 'NYR' },
        'Adam Fox': { team: 'NY Rangers', abbr: 'NYR' },
        'Mika Zibanejad': { team: 'NY Rangers', abbr: 'NYR' },
        'Alexis Lafrenière': { team: 'NY Rangers', abbr: 'NYR' },
        'Chris Kreider': { team: 'NY Rangers', abbr: 'NYR' },
        'Nathan MacKinnon': { team: 'Colorado Avalanche', abbr: 'COL' },
        'Cale Makar': { team: 'Colorado Avalanche', abbr: 'COL' },
        'Mikko Rantanen': { team: 'Colorado Avalanche', abbr: 'COL' },
        'Gabriel Landeskog': { team: 'Colorado Avalanche', abbr: 'COL' },
        'Jack Eichel': { team: 'Vegas Golden Knights', abbr: 'VGK' },
        'Mark Stone': { team: 'Vegas Golden Knights', abbr: 'VGK' },
        'Shea Theodore': { team: 'Vegas Golden Knights', abbr: 'VGK' },
        'Adin Hill': { team: 'Vegas Golden Knights', abbr: 'VGK' },
        'Tomas Hertl': { team: 'Vegas Golden Knights', abbr: 'VGK' },
        'Jason Robertson': { team: 'Dallas Stars', abbr: 'DAL' },
        'Miro Heiskanen': { team: 'Dallas Stars', abbr: 'DAL' },
        'Jake Oettinger': { team: 'Dallas Stars', abbr: 'DAL' },
        'Wyatt Johnston': { team: 'Dallas Stars', abbr: 'DAL' },
        'Roope Hintz': { team: 'Dallas Stars', abbr: 'DAL' },
        'Logan Stankoven': { team: 'Dallas Stars', abbr: 'DAL' },
        'Connor Bedard': { team: 'Chicago Blackhawks', abbr: 'CHI' },
        'Tyler Bertuzzi': { team: 'Chicago Blackhawks', abbr: 'CHI' },
        'Frank Nazar': { team: 'Chicago Blackhawks', abbr: 'CHI' },
        'Teuvo Teravainen': { team: 'Chicago Blackhawks', abbr: 'CHI' },
        'Sidney Crosby': { team: 'Pittsburgh Penguins', abbr: 'PIT' },
        'Evgeni Malkin': { team: 'Pittsburgh Penguins', abbr: 'PIT' },
        'Erik Karlsson': { team: 'Pittsburgh Penguins', abbr: 'PIT' },
        'Kris Letang': { team: 'Pittsburgh Penguins', abbr: 'PIT' },
        'Alex Ovechkin': { team: 'Washington Capitals', abbr: 'WSH' },
        'Dylan Strome': { team: 'Washington Capitals', abbr: 'WSH' },
        'Aleksei Protas': { team: 'Washington Capitals', abbr: 'WSH' },
        'John Carlson': { team: 'Washington Capitals', abbr: 'WSH' },
        'Pierre-Luc Dubois': { team: 'Washington Capitals', abbr: 'WSH' },
        'Tom Wilson': { team: 'Washington Capitals', abbr: 'WSH' },
        'Dylan Larkin': { team: 'Detroit Red Wings', abbr: 'DET' },
        'Lucas Raymond': { team: 'Detroit Red Wings', abbr: 'DET' },
        'Lukas Raymond': { team: 'Detroit Red Wings', abbr: 'DET' },
        'Moritz Seider': { team: 'Detroit Red Wings', abbr: 'DET' },
        'Alex DeBrincat': { team: 'Detroit Red Wings', abbr: 'DET' },
        'Patrick Kane': { team: 'Detroit Red Wings', abbr: 'DET' },
        'Tage Thompson': { team: 'Buffalo Sabres', abbr: 'BUF' },
        'Rasmus Dahlin': { team: 'Buffalo Sabres', abbr: 'BUF' },
        'Alex Tuch': { team: 'Buffalo Sabres', abbr: 'BUF' },
        'Dylan Cozens': { team: 'Buffalo Sabres', abbr: 'BUF' },
        'JJ Peterka': { team: 'Buffalo Sabres', abbr: 'BUF' },
        'J.J. Peterka': { team: 'Buffalo Sabres', abbr: 'BUF' },
        'Travis Konecny': { team: 'Philadelphia Flyers', abbr: 'PHI' },
        'Matvei Michkov': { team: 'Philadelphia Flyers', abbr: 'PHI' },
        'Owen Tippett': { team: 'Philadelphia Flyers', abbr: 'PHI' },
        'Sebastian Aho': { team: 'Carolina Hurricanes', abbr: 'CAR' },
        'Seth Jarvis': { team: 'Carolina Hurricanes', abbr: 'CAR' },
        'Andrei Svechnikov': { team: 'Carolina Hurricanes', abbr: 'CAR' },
        'Martin Necas': { team: 'Carolina Hurricanes', abbr: 'CAR' },
        'Jaccob Slavin': { team: 'Carolina Hurricanes', abbr: 'CAR' },
        'Jacob Slavin': { team: 'Carolina Hurricanes', abbr: 'CAR' },
        'Brent Burns': { team: 'Carolina Hurricanes', abbr: 'CAR' },
        'Jack Hughes': { team: 'NJ Devils', abbr: 'NJD' },
        'Jesper Bratt': { team: 'NJ Devils', abbr: 'NJD' },
        'Nico Hischier': { team: 'NJ Devils', abbr: 'NJD' },
        'Timo Meier': { team: 'NJ Devils', abbr: 'NJD' },
        'Dougie Hamilton': { team: 'NJ Devils', abbr: 'NJD' },
        'Jacob Markstrom': { team: 'NJ Devils', abbr: 'NJD' },
        'Ilya Sorokin': { team: 'NY Islanders', abbr: 'NYI' },
        'Mathew Barzal': { team: 'NY Islanders', abbr: 'NYI' },
        'Bo Horvat': { team: 'NY Islanders', abbr: 'NYI' },
        'Noah Dobson': { team: 'NY Islanders', abbr: 'NYI' },
        'Brock Nelson': { team: 'NY Islanders', abbr: 'NYI' },
        'Anders Lee': { team: 'NY Islanders', abbr: 'NYI' },
        'Kirill Kaprizov': { team: 'Minnesota Wild', abbr: 'MIN' },
        'Matt Boldy': { team: 'Minnesota Wild', abbr: 'MIN' },
        'Brock Faber': { team: 'Minnesota Wild', abbr: 'MIN' },
        'Joel Eriksson Ek': { team: 'Minnesota Wild', abbr: 'MIN' },
        'Filip Gustavsson': { team: 'Minnesota Wild', abbr: 'MIN' },
        'Marc-Andre Fleury': { team: 'Minnesota Wild', abbr: 'MIN' },
        'Filip Forsberg': { team: 'Nashville Predators', abbr: 'NSH' },
        'Roman Josi': { team: 'Nashville Predators', abbr: 'NSH' },
        'Juuse Saros': { team: 'Nashville Predators', abbr: 'NSH' },
        'Steven Stamkos': { team: 'Nashville Predators', abbr: 'NSH' },
        'Jonathan Marchessault': { team: 'Nashville Predators', abbr: 'NSH' },
        'Jon Marchessault': { team: 'Nashville Predators', abbr: 'NSH' },
        'Jordan Kyrou': { team: 'St. Louis Blues', abbr: 'STL' },
        'Robert Thomas': { team: 'St. Louis Blues', abbr: 'STL' },
        'Jordan Binnington': { team: 'St. Louis Blues', abbr: 'STL' },
        'Brayden Schenn': { team: 'St. Louis Blues', abbr: 'STL' },
        'Anze Kopitar': { team: 'LA Kings', abbr: 'LAK' },
        'Drew Doughty': { team: 'LA Kings', abbr: 'LAK' },
        'Kevin Fiala': { team: 'LA Kings', abbr: 'LAK' },
        'Adrian Kempe': { team: 'LA Kings', abbr: 'LAK' },
        'Quinton Byfield': { team: 'LA Kings', abbr: 'LAK' },
        'Darcy Kuemper': { team: 'LA Kings', abbr: 'LAK' },
        'Leo Carlsson': { team: 'Anaheim Ducks', abbr: 'ANA' },
        'Leo Carlson': { team: 'Anaheim Ducks', abbr: 'ANA' },
        'Cutter Gauthier': { team: 'Anaheim Ducks', abbr: 'ANA' },
        'Mason McTavish': { team: 'Anaheim Ducks', abbr: 'ANA' },
        'Trevor Zegras': { team: 'Anaheim Ducks', abbr: 'ANA' },
        'Troy Terry': { team: 'Anaheim Ducks', abbr: 'ANA' },
        'Beckett Senecke': { team: 'Anaheim Ducks', abbr: 'ANA' },
        'John Gibson': { team: 'Anaheim Ducks', abbr: 'ANA' },
        'Macklin Celebrini': { team: 'San Jose Sharks', abbr: 'SJS' },
        'Will Smith': { team: 'San Jose Sharks', abbr: 'SJS' },
        'William Eklund': { team: 'San Jose Sharks', abbr: 'SJS' },
        'Matty Beniers': { team: 'Seattle Kraken', abbr: 'SEA' },
        'Jared McCann': { team: 'Seattle Kraken', abbr: 'SEA' },
        'Joey Daccord': { team: 'Seattle Kraken', abbr: 'SEA' },
        'Brandon Montour': { team: 'Seattle Kraken', abbr: 'SEA' },
        'Shane Wright': { team: 'Seattle Kraken', abbr: 'SEA' },
        'Clayton Keller': { team: 'Utah HC', abbr: 'UTA' },
        'Dylan Guenther': { team: 'Utah HC', abbr: 'UTA' },
        'Logan Cooley': { team: 'Utah HC', abbr: 'UTA' },
        'Mikhail Sergachev': { team: 'Utah HC', abbr: 'UTA' },
        'Adam Fantilli': { team: 'Columbus Blue Jackets', abbr: 'CBJ' },
        'Zach Werenski': { team: 'Columbus Blue Jackets', abbr: 'CBJ' },
        'Kent Johnson': { team: 'Columbus Blue Jackets', abbr: 'CBJ' }
    };

    function getPlayerTeamInfo(name) {
        if (!name) return { team: 'NHL Pro', abbr: 'NHL' };
        if (NHL_PLAYER_TEAMS[name]) return NHL_PLAYER_TEAMS[name];
        if (name.includes('/')) {
            const first = name.split('/')[0].trim();
            if (NHL_PLAYER_TEAMS[first]) return NHL_PLAYER_TEAMS[first];
        }
        return { team: 'NHL Pro', abbr: 'NHL' };
    }

    window.openWikipediaModalById = function(cardId) {
        const card = state.cards?.find(c => c.id === cardId);
        if (card) {
            openWikipediaModal(card);
        }
    };

    function renderPageCard(card, pos) {
        const isTeam = isTeamView();
        const isCollected = card.quantity >= 1;
        const isDoubles = card.quantity >= 2;
        const cls = isDoubles ? 'doubles' : isCollected ? 'collected' : 'missing';
        const teamInfo = getPlayerTeamInfo(card.player_name);

        const teamTraders = card.team_doubles_by ?? [];
        const otherTraders = card.doubles_by ?? [];
        const traders = teamTraders.length > 0 ? teamTraders : otherTraders;
        const holders = card.holders ?? [];

        let tooltipParts = [card.player_name];
        if (card.card_number) tooltipParts.push(`Card #${card.card_number}`);
        tooltipParts.push(`NHL: ${teamInfo.team} (${teamInfo.abbr})`);
        if (card.last_checked) tooltipParts.push(`Checked: ${card.last_checked}`);
        if (holders.length > 0) tooltipParts.push(`Teammates with copies: ${holders.join(', ')}`);
        if (teamTraders.length > 0) tooltipParts.push(`Teammate doubles: ${teamTraders.join(', ')}`);
        else if (otherTraders.length > 0) tooltipParts.push(`Doubles: ${otherTraders.join(', ')}`);
        tooltipParts.push('💡 Click 🌐 or push & hold for Wikipedia bio & photo');

        let badgeText = '';
        let badgeClass = 'card-status-badge';
        if (isDoubles) {
            badgeText = `${card.quantity}x (Trade)`;
        } else if (isCollected) {
            badgeText = '✓ Owned';
        } else {
            badgeText = '🔻 NEEDED';
            badgeClass += ' missing';
        }

        let tradePill = '';
        if (isOwn()) {
            if (teamTraders.length > 0) {
                tradePill = `<span class="trade team-trade" title="Teammates with doubles: ${esc(teamTraders.join(', '))}">⇄ ${teamTraders.length}</span>`;
            } else if (otherTraders.length > 0) {
                tradePill = `<span class="trade" title="Doubles: ${esc(otherTraders.join(', '))}">⇄ ${otherTraders.length}</span>`;
            }
        } else if (!isTeam && card.quantity >= 2 && ((state.userId && card.my_quantity == 0) || (isGuestMode() && (card.quantity || 0) == 0))) {
            tradePill = `<span class="need" style="color:#10b981; border-color:#10b981;">🔻 NEED</span>`;
        }

        return `<div class="card page-card ${cls}" data-id="${card.id}" data-player="${esc(card.player_name)}" title="${esc(tooltipParts.join('\n'))}">
            <div class="card-head">
                <span class="card-num-tag">#${esc(card.card_number)}</span>
                <span class="page-card-team-pill" title="NHL Team: ${esc(teamInfo.team)}">${esc(teamInfo.abbr)}</span>
                <button type="button" class="page-card-wiki-btn" title="Lookup ${esc(card.player_name)} Wikipedia bio & Wikimedia photo" onclick="event.stopPropagation(); openWikipediaModalById(${card.id});">🌐</button>
            </div>
            <div class="card-body">
                <div class="card-player-title">${esc(card.player_name)}</div>
                <div class="card-player-team">${esc(teamInfo.team)}</div>
            </div>
            <div class="card-foot">
                <span class="${badgeClass}">${badgeText}</span>
                ${tradePill}
            </div>
        </div>`;
    }

    function renderCard(card) {
        const isTeam = isTeamView();
        const cls = card.quantity >= 2 ? 'doubles' : card.quantity >= 1 ? 'collected' : 'missing';
        const qty = card.quantity >= 2 ? `${card.quantity}x` : card.quantity == 1 ? '✓' : '';
        const teamInfo = getPlayerTeamInfo(card.player_name);

        const teamTraders = card.team_doubles_by ?? [];
        const otherTraders = card.doubles_by ?? [];
        const traders = teamTraders.length > 0 ? teamTraders : otherTraders;
        const holders = card.holders ?? [];

        let tooltipParts = [card.player_name];
        if (card.card_number) tooltipParts.push(`Card #${card.card_number}`);
        tooltipParts.push(`NHL: ${teamInfo.team} (${teamInfo.abbr})`);
        if (card.last_checked) tooltipParts.push(`Checked: ${card.last_checked}`);
        if (holders.length > 0) tooltipParts.push(`Teammates with copies: ${holders.join(', ')}`);
        if (teamTraders.length > 0) tooltipParts.push(`Teammate doubles: ${teamTraders.join(', ')}`);
        else if (otherTraders.length > 0) tooltipParts.push(`Doubles: ${otherTraders.join(', ')}`);
        tooltipParts.push('💡 Click 🌐 or push & hold for Wikipedia bio & photo');

        let html = `<div class="card ${cls}" data-id="${card.id}" data-player="${esc(card.player_name)}" title="${esc(tooltipParts.join('\n'))}">
            <span class="num">${esc(card.card_number)}</span>
            <span class="name">${esc(card.player_name)}</span>
            <span class="card-nhl-team" title="NHL Team: ${esc(teamInfo.team)}">${esc(teamInfo.abbr)}</span>
            <button type="button" class="card-wiki-lookup-btn" title="Lookup ${esc(card.player_name)} Wikipedia bio & Wikimedia photo" onclick="event.stopPropagation(); openWikipediaModalById(${card.id});">🌐</button>`;

        if (isOwn()) {
            if (teamTraders.length > 0) {
                html += `<span class="trade team-trade" title="Teammates with doubles: ${esc(teamTraders.join(', '))}">⇄ ${teamTraders.length}</span>`;
            } else if (otherTraders.length > 0) {
                html += `<span class="trade" title="Doubles: ${esc(otherTraders.join(', '))}">⇄ ${otherTraders.length}</span>`;
            }
        } else if (!isTeam && card.quantity >= 2 && ((state.userId && card.my_quantity == 0) || (isGuestMode() && (card.quantity || 0) == 0))) {
            html += `<span class="need" style="color:#10b981; border-color:#10b981;">🔻 NEED</span>`;
        }

        html += `<span class="qty">${qty}</span>`;
        html += `</div>`;

        if (isTeam && holders.length > 0) {
            html += `<div class="holders-info">${esc(holders.join(', '))}</div>`;
        }
        if (state.filter === 'trade' && isOwn() && card.quantity == 0 && traders.length > 0) {
            html += `<div class="trade-names">from ${traders.map(esc).join(', ')}</div>`;
        }

        return html;
    }

    let activeOptionCardId = null;

    async function setCardQuantity(cardId, quantity) {
        if (!state.userId) {
            // Guest mode: store in local storage map and update state live
            if (state.viewId !== 'guest') {
                state.viewId = 'guest';
                const vs = document.getElementById('viewSelect');
                if (vs) vs.value = 'guest';
            }
            const guestMap = getGuestCardsMap();
            if (quantity > 0) {
                guestMap[cardId] = quantity;
            } else {
                delete guestMap[cardId];
            }
            saveGuestCardsMap(guestMap);
            const card = state.cards.find(c => c.id === cardId);
            if (card) {
                card.quantity = quantity;
                card.my_quantity = quantity;
            }
            render();
            toast(`Updated #${card?.card_number || cardId} to ${quantity}x (Guest Sandbox)`);
            return;
        }
        if (!canEdit()) {
            if (isTeamView()) {
                toast("Switch Viewing to 'My collection' to edit your cards");
            } else {
                toast(`This is ${viewedName()}'s collection — switch Viewing to 'My collection' to edit`);
            }
            return;
        }
        let data;
        const body = { card_id: cardId, quantity: quantity };
        if (isAdminTinkering()) {
            body.target_user_id = state.viewId;
        }
        try {
            data = await api('set_card_quantity', {}, body);
        } catch (err) {
            toast(err.message);
            return;
        }
        const card = state.cards.find(c => c.id === cardId);
        if (card) {
            card.quantity = data.quantity;
            card.last_checked = data.last_checked;
        }
        render();
        loadTeamSummary();
        if (isAdminTinkering()) {
            toast(`Admin updated #${card?.card_number || ''} ${card?.player_name || 'Card'} to ${data.quantity}x for ${viewedName()}`);
        }
    }

    function openCardOptions(card) {
        activeOptionCardId = card.id;
        const dialog = document.getElementById('cardOptionsDialog');
        document.getElementById('cardOptNum').textContent = card.card_number ? `#${card.card_number} ` : '';
        document.getElementById('cardOptName').textContent = card.player_name || 'Card Options';

        let statusText = 'Currently: Not in collection';
        if (card.quantity === 1) statusText = 'Currently: 1 copy (Single)';
        else if (card.quantity === 2) statusText = 'Currently: 2 copies (Double)';
        else if (card.quantity === 3) statusText = 'Currently: 3 copies (Triple)';
        else if (card.quantity > 3) statusText = `Currently: ${card.quantity} copies`;
        document.getElementById('cardOptCurrent').textContent = statusText;

        document.getElementById('cardOptCustomInput').value = Math.max(4, card.quantity + 1);

        dialog.querySelectorAll('.card-opt-btn').forEach(btn => {
            const btnQty = Number(btn.dataset.qty);
            btn.classList.toggle('active', btnQty === card.quantity);
        });

        dialog.showModal();
    }



    // Topbar + Collector button opens creation dialog
    const newCollectorDialog = document.getElementById('newCollectorDialog');
    const newCollectorForm = document.getElementById('newCollectorForm');
    document.getElementById('newCollectorTopbarBtn').addEventListener('click', () => {
        newCollectorForm.reset();
        populateTeamDropdown(document.getElementById('newCollectorTeamSelect'), state.currentUser?.team_name || '');
        document.getElementById('newCollectorNewTeamRow').hidden = true;
        document.getElementById('newCollectorDiscountCode').value = 'HAWK';
        document.getElementById('newCollectorDiscountCode').dispatchEvent(new Event('input'));
        document.getElementById('newCollectorError').textContent = '';
        newCollectorDialog.showModal();
    });
    document.getElementById('cancelNewCollector').addEventListener('click', () => newCollectorDialog.close());
    newCollectorForm.addEventListener('submit', async e => {
        e.preventDefault();
        const name = document.getElementById('newCollectorName').value.trim();
        const teamSelect = document.getElementById('newCollectorTeamSelect')?.value || '';
        const newTeamName = document.getElementById('newCollectorNewTeamName')?.value?.trim() || '';
        const pass = document.getElementById('newCollectorPass').value.trim();
        const discountCode = document.getElementById('newCollectorDiscountCode').value.trim();
        const errorEl = document.getElementById('newCollectorError');
        errorEl.textContent = '';

        let finalTeam = discountCode;
        if (discountCode === '0' || discountCode.toUpperCase() === 'PUBLIC') {
            finalTeam = '';
        } else if (!finalTeam && teamSelect && teamSelect !== '__new__') {
            finalTeam = teamSelect;
        } else if (!finalTeam && newTeamName) {
            finalTeam = newTeamName;
        }

        const isFreeCheat = finalTeam !== '' || pass.toUpperCase() === 'HAWK' || discountCode.toUpperCase() === 'HAWK';

        try {
            const res = await api('create_user', {}, {
                collector_name: name,
                team_name: finalTeam,
                password: pass,
                discount_code: discountCode,
                paid: !isFreeCheat
            });
            state.currentUser = res.user || res;
            state.userId = state.currentUser.id;
            state.viewId = state.currentUser.id;

            // Migrate any guest sandbox cards to newly created user account
            const guestMap = getGuestCardsMap();
            const cardEntries = Object.entries(guestMap);
            if (cardEntries.length > 0) {
                for (const [cardId, qty] of cardEntries) {
                    if (Number(qty) > 0) {
                        await api('set_quantity', {}, {
                            card_id: Number(cardId),
                            quantity: Number(qty)
                        }).catch(() => {});
                    }
                }
                try { localStorage.removeItem(`cards_guest_${state.series || '2026-27'}`); } catch (err) {}
            }

            const [usersData, teamsData] = await Promise.all([
                api('get_users').catch(() => []),
                api('get_teams').catch(() => [])
            ]);
            state.users = usersData;
            state.teams = teamsData;
            populateTeamDropdowns();
            newCollectorDialog.close();
            renderAccountInfo();
            renderViewSelect();
            await Promise.all([loadTeamSummary(), loadCards()]);
            toast(finalTeam ? `🎉 Welcome to Team "${finalTeam}"! 100% Free Trading Community activated.` : `Created collector ${name}! ($1.00 fee processed)`);
        } catch (err) {
            errorEl.textContent = err.message;
        }
    });

    function syncLayoutButtons() {
        document.querySelectorAll('.layout-btn').forEach(btn => {
            const isMatch = btn.dataset.layout === state.layout &&
                (!btn.dataset.jobMode || btn.dataset.jobMode === state.jobMode);
            btn.classList.toggle('active', isMatch);
        });
    }

    function setLayout(newLayout, newJobMode = null) {
        state.layout = newLayout;
        if (newJobMode) {
            state.jobMode = newJobMode;
            try { localStorage.setItem('cards_job_mode', newJobMode); } catch (e) {}
        }
        try { localStorage.setItem('cards_layout', newLayout); } catch (e) {}
        syncLayoutButtons();
        render();
    }

    document.querySelectorAll('.layout-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            setLayout(btn.dataset.layout, btn.dataset.jobMode || null);
        });
    });
    syncLayoutButtons();

    // Wikipedia Player Bio Modal & Push-and-Hold
    const wikiDialog = document.getElementById('wikiDialog');
    if (wikiDialog) {
        document.getElementById('closeWikiBtn')?.addEventListener('click', () => wikiDialog.close());
        document.getElementById('dismissWikiBtn')?.addEventListener('click', () => wikiDialog.close());
        wikiDialog.addEventListener('click', e => {
            if (e.target === wikiDialog) wikiDialog.close();
        });
    }

    async function openWikipediaModal(card) {
        if (!wikiDialog) return;
        const titleEl = document.getElementById('wikiPlayerTitle');
        const subtitleEl = document.getElementById('wikiPlayerSubtitle');
        const contentEl = document.getElementById('wikiContent');
        const fullLink = document.getElementById('wikiFullLink');
        const commonsLink = document.getElementById('wikiCommonsLink');
        const teamInfo = getPlayerTeamInfo(card.player_name);

        titleEl.textContent = card.player_name;
        subtitleEl.textContent = `${teamInfo.team} • ${card.card_number ? 'Card #' + card.card_number + ' • ' : ''}${card.set_name || 'Tim Hortons'}`;
        fullLink.href = `https://en.wikipedia.org/wiki/Special:Search?search=${encodeURIComponent(card.player_name)}`;
        if (commonsLink) {
            commonsLink.href = `https://commons.wikimedia.org/w/index.php?search=${encodeURIComponent(card.player_name)}`;
        }

        contentEl.innerHTML = `
            <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; padding:32px 16px; gap:12px; color:var(--muted);">
                <div style="font-size:2.4rem;">🏒</div>
                <div>Loading Wikipedia biography & public photos for <strong>${esc(card.player_name)}</strong> (${esc(teamInfo.team)})...</div>
            </div>
        `;

        wikiDialog.showModal();

        try {
            const data = await api('wiki_player', { name: card.player_name });
            if (data && data.wiki_url) fullLink.href = data.wiki_url;
            if (data && data.commons_url && commonsLink) commonsLink.href = data.commons_url;

            let imgHtml = '';
            if (data && data.thumbnail) {
                imgHtml = `<a href="${esc(data.thumbnail)}" target="_blank" rel="noopener noreferrer" title="View original image on Wikimedia Commons public repository">
                    <img src="${esc(data.thumbnail)}" alt="${esc(data.title || card.player_name)}" class="wiki-player-img" loading="lazy">
                </a>`;
            } else {
                imgHtml = `<div class="wiki-player-img" style="display:flex; align-items:center; justify-content:center; font-size:2.2rem; color:#94a3b8;">🏒</div>`;
            }

            const teamBadge = `<div style="display:inline-block; font-size:0.75rem; font-weight:800; color:#0284c7; background:rgba(2,132,199,0.12); padding:2px 8px; border-radius:4px; margin-bottom:6px;">🏒 ${esc(teamInfo.team)} (${esc(teamInfo.abbr)})</div>`;
            const desc = (data && data.description) ? `<div class="wiki-player-desc">${teamBadge}<div>${esc(data.description)}</div></div>` : teamBadge;
            const extract = (data && data.extract) ? `<div class="wiki-extract">${esc(data.extract)}</div>` : `<div class="wiki-extract" style="color:var(--muted);">No biography extract available on Wikipedia.</div>`;

            contentEl.innerHTML = `
                <div class="wiki-player-card">
                    ${imgHtml}
                    <div class="wiki-player-info">
                        ${desc}
                        ${extract}
                    </div>
                </div>
            `;
        } catch (err) {
            contentEl.innerHTML = `
                <div style="padding:18px; text-align:center; color:var(--muted);">
                    <p>Could not load Wikipedia bio: ${esc(err.message)}</p>
                    <p><a href="https://en.wikipedia.org/wiki/Special:Search?search=${encodeURIComponent(card.player_name)}" target="_blank" rel="noopener noreferrer" style="color:#0284c7; font-weight:700;">Search "${esc(card.player_name)}" directly on Wikipedia ↗</a></p>
                </div>
            `;
        }
    }

    let holdTimer = null;
    let holdTargetCard = null;
    let longPressTriggered = false;
    let holdStartX = 0;
    let holdStartY = 0;

    function clearCardHold() {
        if (holdTimer) {
            clearTimeout(holdTimer);
            holdTimer = null;
        }
        if (holdTargetCard) {
            holdTargetCard.classList.remove('holding');
            holdTargetCard = null;
        }
    }

    function startCardHold(e, cardEl) {
        if (!cardEl || cardEl.classList.contains('empty-pocket')) return;
        clearCardHold();
        longPressTriggered = false;
        holdTargetCard = cardEl;

        const point = (e.touches && e.touches.length > 0) ? e.touches[0] : e;
        holdStartX = point.clientX;
        holdStartY = point.clientY;

        holdTargetCard.classList.add('holding');

        holdTimer = setTimeout(() => {
            longPressTriggered = true;
            const cardId = Number(cardEl.dataset.id);
            const card = state.cards.find(c => c.id === cardId);
            clearCardHold();
            if (card && card.player_name) {
                const wikiUrl = `https://en.wikipedia.org/wiki/Special:Search?search=${encodeURIComponent(card.player_name)}`;
                window.open(wikiUrl, '_blank', 'noopener,noreferrer');
            }
        }, 450);
    }

    const cardsContainerEl = document.getElementById('cardsContainer');

    cardsContainerEl.addEventListener('touchstart', e => {
        const cardEl = e.target.closest('.card');
        if (cardEl) startCardHold(e, cardEl);
    }, { passive: true });

    cardsContainerEl.addEventListener('touchmove', e => {
        if (!holdTimer) return;
        const point = e.touches[0];
        if (Math.hypot(point.clientX - holdStartX, point.clientY - holdStartY) > 10) {
            clearCardHold();
        }
    }, { passive: true });

    cardsContainerEl.addEventListener('touchend', () => {
        setTimeout(clearCardHold, 60);
    });

    cardsContainerEl.addEventListener('touchcancel', clearCardHold);

    cardsContainerEl.addEventListener('mousedown', e => {
        if (e.button !== 0) return; // primary left click only
        const cardEl = e.target.closest('.card');
        if (cardEl) startCardHold(e, cardEl);
    });

    window.addEventListener('mousemove', e => {
        if (!holdTimer) return;
        if (Math.hypot(e.clientX - holdStartX, e.clientY - holdStartY) > 8) {
            clearCardHold();
        }
    });

    window.addEventListener('mouseup', () => {
        setTimeout(clearCardHold, 60);
    });

    // Main Card Clicks: if unchecked -> check it; if already checked -> open options overlay
    cardsContainerEl.addEventListener('click', e => {
        if (longPressTriggered) {
            longPressTriggered = false;
            e.preventDefault();
            e.stopPropagation();
            return;
        }
        const tile = e.target.closest('.card');
        if (!tile || tile.classList.contains('empty-pocket')) return;
        const cardId = Number(tile.dataset.id);
        const card = state.cards.find(c => c.id === cardId);
        if (!card) return;

        if (state.layout === 'job') {
            openMcDetailDrawer(card);
            return;
        }

        if (!canEdit()) {
            if (isTeamView()) {
                toast("Switch Viewing to 'My collection' to edit your cards");
            } else if (!state.userId) {
                toast(`Viewing ${viewedName()}'s cards. Switch Viewing to 'Guest Trader' to add/subtract in your sandbox!`);
            } else {
                toast(`This is ${viewedName()}'s collection — switch Viewing to 'My collection' to edit`);
            }
            return;
        }

        if (card.quantity === 0) {
            // First push: mark as checked (1x)
            setCardQuantity(cardId, 1);
        } else {
            // Already checked and pushed again: show options overlay
            openCardOptions(card);
        }
    });

    // Card Options Overlay Dialog handlers
    const cardOptionsDialog = document.getElementById('cardOptionsDialog');
    document.getElementById('closeCardOptBtn').addEventListener('click', () => cardOptionsDialog.close());
    cardOptionsDialog.addEventListener('click', e => {
        if (e.target === cardOptionsDialog) cardOptionsDialog.close();
    });

    cardOptionsDialog.querySelectorAll('.card-opt-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (!activeOptionCardId) return;
            const targetQty = Number(btn.dataset.qty);
            const cardId = activeOptionCardId;
            cardOptionsDialog.close();
            setCardQuantity(cardId, targetQty);
        });
    });

    document.getElementById('cardOptCustomBtn').addEventListener('click', () => {
        if (!activeOptionCardId) return;
        const val = parseInt(document.getElementById('cardOptCustomInput').value, 10);
        if (isNaN(val) || val < 0 || val > 99) {
            toast('Please enter a quantity between 0 and 99');
            return;
        }
        const cardId = activeOptionCardId;
        cardOptionsDialog.close();
        setCardQuantity(cardId, val);
    });

    // Details accordion toggle
    document.getElementById('cardsContainer').addEventListener('toggle', e => {
        const set = e.target.dataset.set;
        if (!set) return;
        e.target.open ? state.collapsed.delete(set) : state.collapsed.add(set);
    }, true);

    function setFilter(newFilter) {
        state.filter = newFilter;
        document.querySelectorAll('#filters button').forEach(b => {
            b.classList.remove('active', 'team-active');
            if (b.dataset.filter === newFilter) {
                b.classList.add(newFilter === 'team_needs' ? 'team-active' : 'active');
            }
        });
        document.querySelectorAll('.stat-sentence-pill, .deck-card').forEach(b => {
            b.classList.toggle('active', b.dataset.filter === newFilter);
        });
        render();
    }

    // Filter Buttons click
    document.getElementById('filters').addEventListener('click', e => {
        const btn = e.target.closest('button');
        if (!btn) return;
        setFilter(btn.dataset.filter);
    });

    // Top Collector Sentence Stats Bar click
    document.getElementById('collectionHighlightDeck')?.addEventListener('click', e => {
        const card = e.target.closest('.deck-card, .stat-sentence-pill');
        if (!card) return;
        if (card.id === 'deckTeamCard') {
            state.viewId = 'team';
            document.getElementById('viewSelect').value = 'team';
            loadCards();
        } else {
            setFilter(card.dataset.filter);
        }
    });

    /* ==========================================================
       STICKY TOPBAR & PARAMETRIC FILTER SCROLL CONTROLLER
       ========================================================== */
    function updateStickyOffsets() {
        const topbar = document.querySelector('header.topbar');
        const topbarH = topbar ? Math.round(topbar.getBoundingClientRect().height) : 53;
        document.documentElement.style.setProperty('--topbar-height', `${topbarH}px`);
        document.documentElement.style.setProperty('--ifs-height', `0px`);
    }

    function scrollToElementWithStickyOffset(el) {
        if (!el) return;
        updateStickyOffsets();
        const topbar = document.querySelector('header.topbar');
        const topbarH = topbar ? Math.round(topbar.getBoundingClientRect().height) : 53;
        const totalOffset = topbarH + 8;

        const elRect = el.getBoundingClientRect();
        const targetY = window.pageYOffset + elRect.top - totalOffset;
        window.scrollTo({
            top: Math.max(0, targetY),
            behavior: 'smooth'
        });
    }

    window.addEventListener('scroll', updateStickyOffsets, { passive: true });
    window.addEventListener('resize', updateStickyOffsets, { passive: true });

    // Series Quick Links & Sub-List Quick Jump click handler
    const seriesNavPanel = document.getElementById('seriesNavPanel');
    if (seriesNavPanel) {
        seriesNavPanel.addEventListener('click', e => {
            const chip = e.target.closest('.series-chip');
            if (chip) {
                const setName = chip.dataset.set;
                state.activeNavSet = setName;
                const cleanId = cleanSetId(setName);
                const setDetails = document.getElementById('set-' + cleanId);
                if (setDetails) {
                    setDetails.open = true;
                    state.collapsed.delete(setName);
                    scrollToElementWithStickyOffset(setDetails);
                }
                const sets = new Map();
                for (const card of state.cards) {
                    if (!sets.has(card.set_name)) sets.set(card.set_name, []);
                    sets.get(card.set_name).push(card);
                }
                renderSeriesNav(sets);
                return;
            }

            const jumpBtn = e.target.closest('.sublist-jump-btn');
            if (jumpBtn) {
                const setName = jumpBtn.dataset.set;
                const sheetNum = Number(jumpBtn.dataset.sheet);
                const cleanId = cleanSetId(setName);
                const setDetails = document.getElementById('set-' + cleanId);
                if (setDetails) {
                    setDetails.open = true;
                    state.collapsed.delete(setName);
                }
                const targetEl = document.getElementById('sheet-' + cleanId + '-' + sheetNum)
                    || document.getElementById('group-' + cleanId + '-' + (sheetNum - 1))
                    || setDetails;
                if (targetEl) {
                    scrollToElementWithStickyOffset(targetEl);
                    targetEl.classList.add('jump-highlight');
                    setTimeout(() => targetEl.classList.remove('jump-highlight'), 1600);
                }
                if (window.innerWidth <= 1080) closeSidebar();
            }
        });
    }

    // VU Meter Readout Boxes click
    document.getElementById('vuStatHave').addEventListener('click', () => setFilter('all'));
    document.getElementById('vuStatNeed').addEventListener('click', () => setFilter('missing'));
    document.getElementById('vuStatDoubles').addEventListener('click', () => setFilter('doubles'));
    document.getElementById('vuStatTeam').addEventListener('click', () => {
        state.viewId = 'team';
        document.getElementById('viewSelect').value = 'team';
        loadCards();
    });

    // Viewing select change
    document.getElementById('viewSelect').addEventListener('change', e => {
        const val = e.target.value;
        state.viewId = val === 'team' ? 'team' : Number(val);
        loadCards();
    });

    // View Team button from sidebar
    document.getElementById('sideViewTeamBtn').addEventListener('click', () => {
        state.viewId = 'team';
        document.getElementById('viewSelect').value = 'team';
        loadCards();
        closeSidebar();
    });

    // Teammate list click from sidebar
    document.getElementById('sideTeamMembers').addEventListener('click', e => {
        const row = e.target.closest('.teammate-row');
        if (!row) return;
        const userId = Number(row.dataset.userId);
        state.viewId = userId;
        document.getElementById('viewSelect').value = String(userId);
        loadCards();
        closeSidebar();
    });

    // Sign out handler (used by both top right button and sidebar button)
    async function handleSignOut(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        try {
            await api('logout', {}, {});
        } catch (err) {
            console.error('Logout error:', err);
        }
        localStorage.removeItem('cards_session_token');
        document.cookie = 'cards_session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        window.location.replace('./');
    }

    // Series navigation switcher (2026-27 vs 2025-26 Archive)
    function switchSeries(newSeries) {
        if (state.series === newSeries) return;
        state.series = newSeries;
        document.querySelectorAll('.menu-nav .menu-item[data-series]').forEach(el => {
            el.classList.toggle('active', el.dataset.series === newSeries);
        });
        renderAccountInfo();
        loadCards();
        closeSidebar();
    }

    document.querySelectorAll('.menu-nav .menu-item[data-series]').forEach(item => {
        item.addEventListener('click', () => {
            switchSeries(item.dataset.series);
        });
    });

    const signOutBtn = document.getElementById('signOutBtn');
    if (signOutBtn) signOutBtn.addEventListener('click', handleSignOut);

    const topbarSignOutBtn = document.getElementById('topbarSignOutBtn');
    if (topbarSignOutBtn) topbarSignOutBtn.addEventListener('click', handleSignOut);

    const topbarSignIn = document.getElementById('topbarSignInBtn');
    if (topbarSignIn) topbarSignIn.addEventListener('click', () => window.location.href = './');

    // Edit Team modal
    const teamDialog = document.getElementById('teamDialog');
    const teamForm = document.getElementById('teamForm');
    function openTeamDialog() {
        populateTeamDropdown(document.getElementById('teamDialogSelect'), state.currentUser?.team_name || '');
        document.getElementById('teamDialogNewTeamRow').hidden = true;
        document.getElementById('teamDialogNewTeamInput').value = '';
        teamDialog.showModal();
    }

    const editTeamBtn = document.getElementById('editTeamBtn');
    if (editTeamBtn) editTeamBtn.addEventListener('click', openTeamDialog);
    document.getElementById('topbarEditTeamBtn').addEventListener('click', openTeamDialog);
    document.getElementById('topbarUserTeam').addEventListener('click', openTeamDialog);
    document.getElementById('cancelTeamDialog').addEventListener('click', () => teamDialog.close());

    teamForm.addEventListener('submit', async e => {
        e.preventDefault();
        const teamSelect = document.getElementById('teamDialogSelect').value;
        const newTeamName = document.getElementById('teamDialogNewTeamInput').value.trim();
        const finalTeam = teamSelect === '__new__' ? newTeamName : teamSelect;

        try {
            await api('set_team', {}, { team_name: finalTeam });
            if (state.currentUser) state.currentUser.team_name = finalTeam;
            const [usersData, teamsData] = await Promise.all([
                api('get_users').catch(() => []),
                api('get_teams').catch(() => [])
            ]);
            state.users = usersData;
            state.teams = teamsData;
            populateTeamDropdowns();
            renderAccountInfo();
            teamDialog.close();
            await Promise.all([loadTeamSummary(), loadCards()]);
            toast(finalTeam ? `Joined Team ${finalTeam}!` : 'Team removed');
        } catch (err) {
            toast(err.message);
        }
    });

    // Mobile sidebar and right bar toggle
    const sidebar = document.getElementById('sidebar');
    const rightBar = document.getElementById('rightBar');
    const backdrop = document.getElementById('sidebarBackdrop');

    function openSidebar() {
        if (sidebar) sidebar.classList.add('open');
        if (rightBar) rightBar.classList.remove('open');
        if (backdrop) backdrop.classList.add('open');
    }
    function openRightBar() {
        if (rightBar) rightBar.classList.add('open');
        if (sidebar) sidebar.classList.remove('open');
        if (backdrop) backdrop.classList.add('open');
    }
    function closeSidebar() {
        if (sidebar) sidebar.classList.remove('open');
        if (rightBar) rightBar.classList.remove('open');
        if (backdrop) backdrop.classList.remove('open');
    }

    document.getElementById('openSidebarBtn')?.addEventListener('click', openSidebar);
    document.getElementById('closeSidebarBtn')?.addEventListener('click', closeSidebar);
    document.getElementById('openRightBarBtn')?.addEventListener('click', openRightBar);
    document.getElementById('closeRightBarBtn')?.addEventListener('click', closeSidebar);
    backdrop?.addEventListener('click', closeSidebar);

    // Interactive mouse hover & click on Set Spectrum canvas
    const spectrumCanvas = document.getElementById('hlSpectrumCanvas');
    const spectrumHint = document.getElementById('hlSpectrumHint');
    if (spectrumCanvas) {
        spectrumCanvas.addEventListener('mousemove', e => {
            if (!state.cards || state.cards.length === 0) return;
            const rect = spectrumCanvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const idx = Math.min(state.cards.length - 1, Math.max(0, Math.floor((x / rect.width) * state.cards.length)));
            const card = state.cards[idx];
            if (card && spectrumHint) {
                const status = card.quantity >= 2 ? `${card.quantity}x Trade` : card.quantity === 1 ? 'Owned' : 'Needed';
                spectrumHint.textContent = `#${card.card_number} ${card.player_name} (${status})`;
            }
        });
        spectrumCanvas.addEventListener('mouseleave', () => {
            if (spectrumHint) spectrumHint.textContent = 'Interactive Map';
        });
        spectrumCanvas.addEventListener('click', e => {
            if (!state.cards || state.cards.length === 0) return;
            const rect = spectrumCanvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const idx = Math.min(state.cards.length - 1, Math.max(0, Math.floor((x / rect.width) * state.cards.length)));
            const card = state.cards[idx];
            if (card) {
                const cardEl = document.querySelector(`.card[data-id="${card.id}"]`);
                if (cardEl) {
                    cardEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    cardEl.classList.add('jump-highlight');
                    setTimeout(() => cardEl.classList.remove('jump-highlight'), 1600);
                }
            }
        });
    }

    // Set Spectrum Footer interactive hover, scrubbing, magnifier & narrow/wide toggle
    const fsdCanvas = document.getElementById('footerSpectrumCanvas');
    const fsdHint = document.getElementById('footerSpectrumHint');
    const fsdCanvasWrap = document.getElementById('fsdCanvasWrap');
    const fsdMagnifier = document.getElementById('fsdMagnifier');
    const fsdWidthToggleBtn = document.getElementById('fsdWidthToggleBtn');

    // Width Toggle: Narrow vs Wide with responsive distinct borders ("and a border when it goes narry and wide")
    let fsdIsWide = localStorage.getItem('cards_fsd_wide') !== 'false'; // default wide
    function applyFsdWidth() {
        if (!fsdCanvasWrap || !fsdWidthToggleBtn) return;
        if (fsdIsWide) {
            fsdCanvasWrap.classList.remove('is-narrow');
            fsdCanvasWrap.classList.add('is-wide');
            fsdWidthToggleBtn.textContent = '↔ Wide';
            fsdWidthToggleBtn.title = 'Switch to Narrow Spectrum (Centered)';
        } else {
            fsdCanvasWrap.classList.remove('is-wide');
            fsdCanvasWrap.classList.add('is-narrow');
            fsdWidthToggleBtn.textContent = '⇥ Narrow';
            fsdWidthToggleBtn.title = 'Switch to Full-Width Spectrum';
        }
        renderFooterSpectrum();
    }
    if (fsdWidthToggleBtn) {
        applyFsdWidth();
        fsdWidthToggleBtn.addEventListener('click', () => {
            fsdIsWide = !fsdIsWide;
            try { localStorage.setItem('cards_fsd_wide', String(fsdIsWide)); } catch (e) {}
            applyFsdWidth();
        });
    }

    // Alternating Fade-In / Fade-Out between Stats counts and Spectrum Legend Key ("the spats and key should be displayed for a bit then fade in and out")
    const fsdMetaEl = document.getElementById('fsdMeta');
    const fsdCountsEl = document.getElementById('footerSpectrumCounts');
    const fsdLegendEl = document.getElementById('footerSpectrumLegend');
    let fsdMetaTimer = null;
    let fsdMetaShowCounts = true;

    function toggleFsdMetaDisplay() {
        if (!fsdCountsEl || !fsdLegendEl) return;
        fsdMetaShowCounts = !fsdMetaShowCounts;
        if (fsdMetaShowCounts) {
            fsdCountsEl.classList.add('active');
            fsdLegendEl.classList.remove('active');
        } else {
            fsdCountsEl.classList.remove('active');
            fsdLegendEl.classList.add('active');
        }
    }

    function startFsdMetaRotation() {
        if (fsdMetaTimer) clearInterval(fsdMetaTimer);
        fsdMetaTimer = setInterval(toggleFsdMetaDisplay, 3800);
    }

    if (fsdMetaEl) {
        fsdMetaEl.addEventListener('click', () => {
            toggleFsdMetaDisplay();
            startFsdMetaRotation();
        });
        startFsdMetaRotation();
    }

    if (fsdCanvas) {
        function updateScrubLoupe(e) {
            if (!state.cards || state.cards.length === 0) return;
            const rect = fsdCanvas.getBoundingClientRect();
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const x = Math.max(0, Math.min(rect.width, clientX - rect.left));
            const idx = Math.min(state.cards.length - 1, Math.max(0, Math.floor((x / rect.width) * state.cards.length)));
            const card = state.cards[idx];
            if (!card) return;

            // Highlight scrubbing border on dock
            if (fsdCanvasWrap) fsdCanvasWrap.classList.add('is-scrubbing');

            const status = card.quantity >= 2 ? `${card.quantity}x Trade` : card.quantity === 1 ? 'Owned' : 'Needed';
            const badgeCls = card.quantity >= 2 ? 'doubles' : card.quantity === 1 ? 'owned' : 'needed';

            // Update top hint text
            if (fsdHint) {
                fsdHint.innerHTML = `<span style="color:#38bdf8; font-weight:800;">#${esc(card.card_number)} ${esc(card.player_name)} (${status.toUpperCase()})</span>`;
            }

            // Draw scrub reticle on canvas
            renderFooterSpectrum(card.id);

            // Position and show floating magnifying loupe
            if (fsdMagnifier) {
                fsdMagnifier.style.display = 'flex';
                fsdMagnifier.style.left = `${x}px`;
                fsdMagnifier.innerHTML = `
                    <div class="fsd-mag-lens">
                        <div class="fsd-mag-icon" title="Magnifying Loupe">🔍</div>
                        <div class="fsd-mag-num">#${esc(card.card_number)}</div>
                        <div class="fsd-mag-player">${esc(card.player_name)}</div>
                        <div class="fsd-mag-subset">${esc(card.set_name || 'Base Set')}</div>
                        <div class="fsd-mag-badge ${badgeCls}">${status.toUpperCase()}</div>
                    </div>
                    <div class="fsd-mag-pointer"></div>
                `;
            }
        }

        function clearScrubLoupe() {
            if (fsdHint) fsdHint.textContent = 'Interactive Map (Hover or Click to Jump)';
            if (fsdCanvasWrap) fsdCanvasWrap.classList.remove('is-scrubbing');
            if (fsdMagnifier) fsdMagnifier.style.display = 'none';
            renderFooterSpectrum(null);
        }

        fsdCanvas.addEventListener('mousemove', updateScrubLoupe);
        fsdCanvas.addEventListener('touchmove', e => {
            e.preventDefault();
            updateScrubLoupe(e);
        }, { passive: false });

        fsdCanvas.addEventListener('mouseleave', clearScrubLoupe);
        fsdCanvas.addEventListener('touchend', clearScrubLoupe);

        fsdCanvas.addEventListener('click', e => {
            if (!state.cards || state.cards.length === 0) return;
            const rect = fsdCanvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const idx = Math.min(state.cards.length - 1, Math.max(0, Math.floor((x / rect.width) * state.cards.length)));
            const card = state.cards[idx];
            if (card) {
                jumpToCard(card.id);
            }
        });
    }

    window.addEventListener('resize', () => {
        renderSportsHighlights();
        renderFooterSpectrum();
        renderStatsHud(true);
    });

    function jumpToCard(cardId) {
        const card = state.cards.find(c => c.id === cardId);
        if (!card) return;
        const cleanId = cleanSetId(card.set_name);
        const setDetails = document.getElementById('set-' + cleanId);
        if (setDetails && !setDetails.open) {
            setDetails.open = true;
            state.collapsed.delete(card.set_name);
        }
        const cardEl = document.querySelector(`.card[data-id="${cardId}"]`);
        if (cardEl) {
            cardEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
            cardEl.classList.add('jump-highlight');
            setTimeout(() => cardEl.classList.remove('jump-highlight'), 1800);
        }
    }

    const eftStreamEl = document.getElementById('eftStream');
    if (eftStreamEl) {
        eftStreamEl.addEventListener('click', e => {
            const item = e.target.closest('.eft-item[data-id]');
            if (item) {
                const cardId = Number(item.dataset.id);
                jumpToCard(cardId);
            }
        });
    }

    const eftCallChip = document.getElementById('eftCallChip');
    if (eftCallChip) {
        eftCallChip.addEventListener('click', () => {
            cycleCallMetric();
        });
    }

    const eftPauseBtn = document.getElementById('eftPauseBtn');
    if (eftPauseBtn && eftStreamEl) {
        eftPauseBtn.addEventListener('click', () => {
            eftStreamEl.classList.toggle('is-paused');
            eftPauseBtn.textContent = eftStreamEl.classList.contains('is-paused') ? '▶' : '⏸';
        });
    }

    const eftPrevBtn = document.getElementById('eftPrevBtn');
    const eftNextBtn = document.getElementById('eftNextBtn');
    const eftViewport = document.getElementById('eftViewport');
    if (eftPrevBtn && eftViewport) {
        eftPrevBtn.addEventListener('click', () => {
            eftViewport.scrollBy({ left: -260, behavior: 'smooth' });
        });
    }
    if (eftNextBtn && eftViewport) {
        eftNextBtn.addEventListener('click', () => {
            eftViewport.scrollBy({ left: 260, behavior: 'smooth' });
        });
    }

    // Subsets Quick Jump helper
    window.jumpToSet = function(cleanId) {
        const el = document.getElementById('set-' + cleanId);
        if (el) {
            if (!el.open) {
                el.open = true;
                const setName = el.getAttribute('data-set');
                if (setName) state.collapsed.delete(setName);
            }
            scrollToElementWithStickyOffset(el);
            el.classList.add('jump-highlight');
            setTimeout(() => el.classList.remove('jump-highlight'), 1800);
        }
        const msb = document.getElementById('mobileSubsetsBar');
        if (msb) msb.hidden = true;
    };

    function setupMobileSubsetsBar(sets) {
        const chipsEl = document.getElementById('mobileSubsetsChips');
        const rbSelect = document.getElementById('rbQuickJumpSelect');
        const rbChips = document.getElementById('rbQuickJumpChips');

        if (!sets || sets.size === 0) {
            if (chipsEl) chipsEl.innerHTML = '<span style="color:#64748b; font-size:0.75rem;">No subsets available</span>';
            if (rbChips) rbChips.innerHTML = '<span style="color:#64748b; font-size:0.75rem;">No subsets</span>';
            return;
        }

        let mobileHtml = '';
        let rbSelectHtml = '<option value="">⚡ Jump to subset...</option>';
        let rbChipsHtml = '';

        for (const [setName, cards] of sets) {
            const have = cards.filter(c => c.quantity > 0).length;
            const cleanId = cleanSetId(setName);
            mobileHtml += `<button type="button" class="msb-chip" onclick="jumpToSet('${cleanId}')">
                <span>${esc(setName)}</span>
                <span class="msb-badge">${have}/${cards.length}</span>
            </button>`;

            rbSelectHtml += `<option value="${cleanId}">${esc(setName)} (${have}/${cards.length})</option>`;
            rbChipsHtml += `<button type="button" class="rb-qj-chip" onclick="jumpToSet('${cleanId}')" title="${esc(setName)}">
                <span>${esc(setName)}</span>
                <span class="rb-qj-badge">${have}/${cards.length}</span>
            </button>`;
        }

        if (chipsEl) chipsEl.innerHTML = mobileHtml;
        if (rbSelect) {
            rbSelect.innerHTML = rbSelectHtml;
            rbSelect.onchange = function() {
                if (this.value) {
                    jumpToSet(this.value);
                    this.value = '';
                }
            };
        }
        if (rbChips) rbChips.innerHTML = rbChipsHtml;
    }

    const mobileSubsetsBtn = document.getElementById('mobileSubsetsBtn');
    const mobileSubsetsBar = document.getElementById('mobileSubsetsBar');
    if (mobileSubsetsBtn && mobileSubsetsBar) {
        mobileSubsetsBtn.addEventListener('click', () => {
            mobileSubsetsBar.hidden = !mobileSubsetsBar.hidden;
            updateStickyOffsets();
        });
    }

    // L-Bar Customization
    function applyLbarPrefs() {
        let prefs = { series: true, subsets: true, team: true, stats: true };
        try {
            const saved = localStorage.getItem('cards_lbar_prefs');
            if (saved) prefs = Object.assign(prefs, JSON.parse(saved));
        } catch (e) {}

        const seriesEl = document.getElementById('sidebarHockeySection');
        if (seriesEl) seriesEl.style.display = prefs.series ? '' : 'none';

        const subsetsEl = document.getElementById('seriesNavPanel');
        if (subsetsEl) subsetsEl.style.display = prefs.subsets ? '' : 'none';

        const teamEl = document.getElementById('teamHubSection');
        if (teamEl) {
            if (!prefs.team) teamEl.style.display = 'none';
            else if (state.currentUser?.team_name) teamEl.style.display = '';
        }

        const statsEl = document.getElementById('sideRotatingStatsWidget');
        if (statsEl) statsEl.style.display = prefs.stats ? '' : 'none';

        const sideFooter = document.getElementById('sidebarFooter');
        if (sideFooter) {
            sideFooter.style.display = prefs.stats ? '' : 'none';
        }

        // When no L-BAR modules are active, collapse left bar completely so middle is all flexible
        const anyLbarActive = !!(prefs.series || prefs.subsets || prefs.team || prefs.stats);
        if (!anyLbarActive) {
            document.body.classList.add('no-left-bar');
        } else {
            document.body.classList.remove('no-left-bar');
        }

        const cbSeries = document.getElementById('toggleWidgetSeries');
        const cbSubsets = document.getElementById('toggleWidgetSubsets');
        const cbTeam = document.getElementById('toggleWidgetTeam');
        const cbStats = document.getElementById('toggleWidgetStats');
        if (cbSeries) cbSeries.checked = prefs.series !== false;
        if (cbSubsets) cbSubsets.checked = prefs.subsets !== false;
        if (cbTeam) cbTeam.checked = prefs.team !== false;
        if (cbStats) cbStats.checked = prefs.stats !== false;
    }

    function setupLbarCustomization() {
        const dialog = document.getElementById('lbarCustomizeDialog');
        const btnOpen = document.getElementById('btnCustomizeWidgets');
        const btnOpenRight = document.getElementById('btnCustomizeWidgetsRight');
        const btnClose = document.getElementById('closeLbarCustomizeBtn');
        const btnSave = document.getElementById('saveLbarCustomizeBtn');
        const btnReset = document.getElementById('resetLbarCustomizeBtn');

        if (btnOpen && dialog) {
            btnOpen.addEventListener('click', () => {
                applyLbarPrefs();
                dialog.showModal();
            });
        }
        if (btnOpenRight && dialog) {
            btnOpenRight.addEventListener('click', () => {
                applyLbarPrefs();
                dialog.showModal();
            });
        }
        if (btnClose && dialog) {
            btnClose.addEventListener('click', () => dialog.close());
        }
        if (btnReset) {
            btnReset.addEventListener('click', () => {
                const defaults = { series: true, subsets: true, team: true, stats: true };
                try { localStorage.setItem('cards_lbar_prefs', JSON.stringify(defaults)); } catch (e) {}
                applyLbarPrefs();
                toast('L-bar widgets reset to default');
            });
        }
        if (btnSave && dialog) {
            btnSave.addEventListener('click', () => {
                const prefs = {
                    series: document.getElementById('toggleWidgetSeries')?.checked ?? true,
                    subsets: document.getElementById('toggleWidgetSubsets')?.checked ?? true,
                    team: document.getElementById('toggleWidgetTeam')?.checked ?? true,
                    stats: document.getElementById('toggleWidgetStats')?.checked ?? true,
                };
                try { localStorage.setItem('cards_lbar_prefs', JSON.stringify(prefs)); } catch (e) {}
                applyLbarPrefs();
                dialog.close();
                toast('L-bar preferences saved');
            });
        }
    }

    // Trade Market & Rigging Exchange
    let currentPartnerCards = [];

    window.openTradeMarket = async function(partnerId = null) {
        const dialog = document.getElementById('tradeMarketDialog');
        if (!dialog) return;

        const partnerSelect = document.getElementById('tmdPartnerSelect');
        if (!partnerSelect) return;

        const currentMyId = state.userId;
        const partners = (state.users || []).filter(u => u.id !== currentMyId);

        if (partners.length === 0) {
            toast('No other collectors found to trade with yet.');
            return;
        }

        partnerSelect.innerHTML = partners.map(u => {
            const teamPart = u.team_name ? ` (Team ${esc(u.team_name)})` : '';
            return `<option value="${u.id}">${esc(u.collector_name)}${teamPart}</option>`;
        }).join('');

        if (partnerId && partners.some(u => u.id === Number(partnerId))) {
            partnerSelect.value = String(partnerId);
        } else if (state.viewId && partners.some(u => u.id === Number(state.viewId))) {
            partnerSelect.value = String(state.viewId);
        } else {
            const bronzo = partners.find(u => (u.collector_name || '').toLowerCase() === 'bronzo') || partners[0];
            partnerSelect.value = String(bronzo.id);
        }

        await loadMarketPartnerData(Number(partnerSelect.value));
        dialog.showModal();
    };

    async function loadMarketPartnerData(partnerId) {
        const myDoublesList = document.getElementById('tmdMyDoublesList');
        const targetNeedsList = document.getElementById('tmdTargetNeedsList');

        if (!myDoublesList || !targetNeedsList) return;

        myDoublesList.innerHTML = '<div style="padding:12px; color:#64748b; font-size:0.8rem;">Loading your trade inventory...</div>';
        targetNeedsList.innerHTML = '<div style="padding:12px; color:#64748b; font-size:0.8rem;">Loading partner cards...</div>';

        try {
            const partnerCards = await api(`cards&user_id=${partnerId}&series=${encodeURIComponent(state.series || '2026-27')}`);
            currentPartnerCards = partnerCards || [];
        } catch (e) {
            console.error('Error fetching partner cards:', e);
            currentPartnerCards = [];
        }

        const partner = (state.users || []).find(u => u.id === partnerId);
        const partnerName = partner ? partner.collector_name : 'Partner';

        const myCards = state.cards || [];
        const myDoubles = myCards.filter(c => c.quantity >= 2);

        const partnerDoublesINeed = currentPartnerCards.filter(pc => {
            if (pc.quantity < 2) return false;
            const myCard = myCards.find(c => c.id === pc.id);
            return !myCard || myCard.quantity === 0;
        });

        const partnerNeedsFromMe = myDoubles.filter(mc => {
            const pc = currentPartnerCards.find(c => c.id === mc.id);
            return !pc || pc.quantity === 0;
        });

        if (myDoubles.length === 0) {
            myDoublesList.innerHTML = `<div style="padding:16px; text-align:center; color:#64748b; font-size:0.82rem;">
                No doubles currently in your inventory.<br>
                <span style="font-size:0.75rem; color:#94a3b8;">${isGuestMode() ? 'Tip: Click cards in the checklist to add them to your sandbox!' : 'Add doubles by clicking cards!'}</span>
            </div>`;
        } else {
            myDoublesList.innerHTML = myDoubles.map(c => {
                const doesPartnerNeed = partnerNeedsFromMe.some(pnm => pnm.id === c.id);
                return `
                <label class="tmd-card-item ${doesPartnerNeed ? 'is-mutual-match' : ''}">
                    <input type="checkbox" class="tmd-my-card-cb" value="${c.id}" ${doesPartnerNeed ? 'checked' : ''}>
                    <div class="tmd-card-info">
                        <div class="tmd-card-num">#${esc(c.card_number)} • ${esc(c.set_name)}</div>
                        <div class="tmd-card-name">${esc(c.player_name)}</div>
                    </div>
                    <div class="tmd-card-tag tmd-tag-double">⭐️ ${c.quantity}x ${doesPartnerNeed ? '🔥 Partner Needs!' : ''}</div>
                </label>`;
            }).join('');
        }

        if (partnerDoublesINeed.length === 0) {
            targetNeedsList.innerHTML = `<div style="padding:16px; text-align:center; color:#64748b; font-size:0.82rem;">
                ${esc(partnerName)} doesn't have any doubles you're currently missing.<br>
                <span style="font-size:0.75rem; color:#94a3b8;">Try selecting another trading partner!</span>
            </div>`;
        } else {
            targetNeedsList.innerHTML = partnerDoublesINeed.map(c => {
                return `
                <label class="tmd-card-item">
                    <input type="checkbox" class="tmd-target-card-cb" value="${c.id}" checked>
                    <div class="tmd-card-info">
                        <div class="tmd-card-num">#${esc(c.card_number)} • ${esc(c.set_name)}</div>
                        <div class="tmd-card-name">${esc(c.player_name)}</div>
                    </div>
                    <div class="tmd-card-tag tmd-tag-needed">🔻 NEEDED (${c.quantity}x avl)</div>
                </label>`;
            }).join('');
        }

        updateMarketSummary();
    }

    function updateMarketSummary() {
        const summaryEl = document.getElementById('tmdMatchSummary');
        if (!summaryEl) return;

        const partnerSelect = document.getElementById('tmdPartnerSelect');
        const partnerId = Number(partnerSelect?.value);
        const partner = (state.users || []).find(u => u.id === partnerId);
        const partnerName = partner ? partner.collector_name : 'Partner';

        const mySelected = document.querySelectorAll('.tmd-my-card-cb:checked').length;
        const targetSelected = document.querySelectorAll('.tmd-target-card-cb:checked').length;

        if (mySelected === 0 && targetSelected === 0) {
            summaryEl.innerHTML = `<span>Select doubles to trade with <strong>${esc(partnerName)}</strong>.</span>`;
        } else {
            const fairness = mySelected === targetSelected ? '⚖️ 100% Even Swap!' : (mySelected > targetSelected ? '⭐️ Favorable to partner' : '🔥 Favorable to you');
            summaryEl.innerHTML = `<strong>Trade Proposition:</strong> You give <strong>${mySelected}</strong> card(s) ➔ receive <strong>${targetSelected}</strong> card(s) from <strong>${esc(partnerName)}</strong>. <span style="font-weight:700; color:#0369a1;">${fairness}</span>`;
        }
    }

    async function rigTheCardMarket() {
        const partnerSelect = document.getElementById('tmdPartnerSelect');
        const partnerId = Number(partnerSelect?.value);
        const partner = (state.users || []).find(u => u.id === partnerId);
        const partnerName = partner ? partner.collector_name : 'Partner';

        const mySelectedIds = Array.from(document.querySelectorAll('.tmd-my-card-cb:checked')).map(cb => Number(cb.value));
        const targetSelectedIds = Array.from(document.querySelectorAll('.tmd-target-card-cb:checked')).map(cb => Number(cb.value));

        if (mySelectedIds.length === 0 && targetSelectedIds.length === 0) {
            toast('Select at least one card to trade or swap!');
            return;
        }

        // Give cards: Decrement user's doubles
        for (const cardId of mySelectedIds) {
            const card = state.cards.find(c => c.id === cardId);
            if (card && card.quantity > 0) {
                const newQty = card.quantity - 1;
                if (isGuestMode()) {
                    const guestMap = getGuestCardsMap();
                    guestMap[cardId] = newQty;
                    saveGuestCardsMap(guestMap);
                    card.quantity = newQty;
                } else {
                    card.quantity = newQty;
                    api('set_quantity', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ card_id: cardId, quantity: newQty })
                    }).catch(() => {});
                }
            }
        }

        // Receive cards: Increment needed cards
        for (const cardId of targetSelectedIds) {
            const card = state.cards.find(c => c.id === cardId);
            if (card) {
                const newQty = (card.quantity || 0) + 1;
                if (isGuestMode()) {
                    const guestMap = getGuestCardsMap();
                    guestMap[cardId] = newQty;
                    saveGuestCardsMap(guestMap);
                    card.quantity = newQty;
                } else {
                    card.quantity = newQty;
                    api('set_quantity', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ card_id: cardId, quantity: newQty })
                    }).catch(() => {});
                }
            }
        }

        const dialog = document.getElementById('tradeMarketDialog');
        if (dialog) dialog.close();

        render();
        updateVUMeterAndHighlights();

        toast(`🎉 Card Market Rigged! Swapped ${targetSelectedIds.length} card(s) with ${partnerName}! Added to your binder!`);
    }

    // Bind Market Dialog events
    const tmdPartnerSelect = document.getElementById('tmdPartnerSelect');
    if (tmdPartnerSelect) {
        tmdPartnerSelect.addEventListener('change', () => {
            loadMarketPartnerData(Number(tmdPartnerSelect.value));
        });
    }

    const tmdDialogEl = document.getElementById('tradeMarketDialog');
    if (tmdDialogEl) {
        tmdDialogEl.addEventListener('change', e => {
            if (e.target.matches('.tmd-my-card-cb, .tmd-target-card-cb')) {
                updateMarketSummary();
            }
        });
        document.getElementById('closeTradeMarketBtn')?.addEventListener('click', () => tmdDialogEl.close());
        document.getElementById('cancelTradeMarketBtn')?.addEventListener('click', () => tmdDialogEl.close());
        document.getElementById('btnRigMarket')?.addEventListener('click', rigTheCardMarket);
        document.getElementById('btnLockTrade')?.addEventListener('click', () => {
            tmdDialogEl.close();
            if (isGuestMode()) {
                document.getElementById('newCollectorTopbarBtn')?.click();
            } else {
                toast('Trade locked into your permanent collection!');
            }
        });
    }

    // Speed & Control button listeners
    const srwSpeedBtn = document.getElementById('srwSpeedBtn');
    const eftSpeedBtn = document.getElementById('eftSpeedBtn');
    if (srwSpeedBtn) srwSpeedBtn.addEventListener('click', cycleBroadcastSpeed);
    if (eftSpeedBtn) eftSpeedBtn.addEventListener('click', cycleBroadcastSpeed);

    const srwPrevCardBtn = document.getElementById('srwPrevCardBtn');
    const srwNextCardBtn = document.getElementById('srwNextCardBtn');
    if (srwPrevCardBtn) srwPrevCardBtn.addEventListener('click', () => jumpRotatingStat(state.rotatingStatIdx - 1));
    if (srwNextCardBtn) srwNextCardBtn.addEventListener('click', () => jumpRotatingStat(state.rotatingStatIdx + 1));

    document.getElementById('topbarTradeMarketBtn')?.addEventListener('click', () => openTradeMarket());
    document.getElementById('rbOpenMarketBtn')?.addEventListener('click', () => openTradeMarket());

    setupLbarCustomization();
    applyLbarPrefs();

    /* ==========================================================
       DRAGGABLE & MOVABLE STATS & HEAT MAP OVERLAY HUD
       ("the base percentages, the above the ice and other series percentages... then all the heat maps of the popularity site wide. this should be on the tablet view and the iphone view always. all these overlays the user should be able to drag them and move them around stereatech and shift bump over move change windows and that vierw saves with them locally and it could push it to the DB")
       ========================================================== */
    const hudState = {
        visible: false, // Off by default
        dock: 'bottom-right',
        x: null,
        y: null,
        minimized: false,
        activeTab: 'all',
        isDragging: false,
        dragStartX: 0,
        dragStartY: 0,
        initialX: 0,
        initialY: 0,
        saveTimeout: null,
        docks: ['bottom-right', 'bottom-left', 'top-left', 'top-right']
    };

    function initStatsHud() {
        const overlay = document.getElementById('statsHudOverlay');
        const hudWindow = document.getElementById('statsHudWindow');
        const miniBar = document.getElementById('statsHudMiniBar');
        const dragHandle = document.getElementById('hudDragHandle');
        const miniDrag = document.getElementById('hudMiniDragHandle');
        if (!overlay || !hudWindow || !miniBar) return;

        // Restore layout from localStorage first
        try {
            const raw = localStorage.getItem('cards_hud_layout');
            if (raw) {
                applyHudLayoutPrefs(raw);
            }
        } catch (e) {
            console.warn('Could not read hud layout from localStorage', e);
        }

        // Pointer & Touch Dragging for both window header and mini bar
        [dragHandle, miniDrag].forEach(el => {
            if (!el) return;

            const onPointerDown = e => {
                if (e.target.closest('button, .hud-tab-btn, a')) return;
                hudState.isDragging = true;
                hudState.dragStartX = e.clientX || (e.touches && e.touches[0].clientX) || 0;
                hudState.dragStartY = e.clientY || (e.touches && e.touches[0].clientY) || 0;

                const rect = overlay.getBoundingClientRect();
                hudState.initialX = rect.left;
                hudState.initialY = rect.top;

                // Fix to absolute coordinates and remove dock classes
                overlay.classList.remove('hud-dock-bottom-right', 'hud-dock-bottom-left', 'hud-dock-top-left', 'hud-dock-top-right', 'hud-animating');
                overlay.style.left = `${rect.left}px`;
                overlay.style.top = `${rect.top}px`;
                overlay.style.right = 'auto';
                overlay.style.bottom = 'auto';

                if (e.pointerId && el.setPointerCapture) {
                    try { el.setPointerCapture(e.pointerId); } catch (err) {}
                }
                if (e.cancelable && e.type === 'touchstart') {
                    e.preventDefault();
                }
            };

            const onPointerMove = e => {
                if (!hudState.isDragging) return;
                const curX = e.clientX || (e.touches && e.touches[0].clientX) || 0;
                const curY = e.clientY || (e.touches && e.touches[0].clientY) || 0;
                const dx = curX - hudState.dragStartX;
                const dy = curY - hudState.dragStartY;

                const curW = overlay.offsetWidth || 300;
                const curH = overlay.offsetHeight || 200;
                const minX = 4;
                const maxX = Math.max(minX, window.innerWidth - curW - 4);
                const minY = 52;
                const maxY = Math.max(minY, window.innerHeight - 120 - curH);

                const nextX = Math.max(minX, Math.min(maxX, hudState.initialX + dx));
                const nextY = Math.max(minY, Math.min(maxY, hudState.initialY + dy));

                overlay.style.left = `${Math.round(nextX)}px`;
                overlay.style.top = `${Math.round(nextY)}px`;
                overlay.style.right = 'auto';
                overlay.style.bottom = 'auto';

                if (e.cancelable && e.type === 'touchmove') {
                    e.preventDefault();
                }
            };

            const onPointerUp = e => {
                if (!hudState.isDragging) return;
                hudState.isDragging = false;
                hudState.dock = 'custom';
                hudState.x = parseInt(overlay.style.left, 10);
                hudState.y = parseInt(overlay.style.top, 10);

                if (e.pointerId && el.releasePointerCapture) {
                    try { el.releasePointerCapture(e.pointerId); } catch (err) {}
                }
                saveHudLayout();
            };

            el.addEventListener('pointerdown', onPointerDown);
            el.addEventListener('pointermove', onPointerMove);
            el.addEventListener('pointerup', onPointerUp);
            el.addEventListener('pointercancel', onPointerUp);

            // Touch fallbacks
            el.addEventListener('touchstart', onPointerDown, { passive: false });
            el.addEventListener('touchmove', onPointerMove, { passive: false });
            el.addEventListener('touchend', onPointerUp);
            el.addEventListener('touchcancel', onPointerUp);
        });

        // Bump Button: shifts dock position to next corner ("stereatech and shift, bump over, move change windows")
        const bumpBtns = [document.getElementById('hudBumpBtn'), document.getElementById('hudMiniBumpBtn')];
        bumpBtns.forEach(btn => {
            if (!btn) return;
            btn.addEventListener('click', e => {
                e.stopPropagation();
                bumpHudPosition();
            });
        });

        // Minimize Button
        const minBtn = document.getElementById('hudMinimizeBtn');
        if (minBtn) {
            minBtn.addEventListener('click', e => {
                e.stopPropagation();
                minimizeHud(true);
            });
        }

        // Close Buttons (Turn Off HUD)
        const closeBtn = document.getElementById('hudCloseBtn');
        if (closeBtn) {
            closeBtn.addEventListener('click', e => {
                e.stopPropagation();
                toggleStatsHud(false);
            });
        }
        const miniCloseBtn = document.getElementById('hudMiniCloseBtn');
        if (miniCloseBtn) {
            miniCloseBtn.addEventListener('click', e => {
                e.stopPropagation();
                toggleStatsHud(false);
            });
        }

        // Expand Buttons
        const expBtn = document.getElementById('hudMiniExpandBtn');
        const miniLabelBtn = document.getElementById('hudMiniLabelBtn');
        [expBtn, miniLabelBtn].forEach(b => {
            if (!b) return;
            b.addEventListener('click', e => {
                e.stopPropagation();
                minimizeHud(false);
            });
        });

        // Topbar HUD Button (Toggles HUD on/off)
        const topbarHudBtn = document.getElementById('topbarStatsHudBtn');
        if (topbarHudBtn) {
            topbarHudBtn.addEventListener('click', () => {
                toggleStatsHud();
            });
        }

        // Tabs switcher
        const tabBtns = document.querySelectorAll('.hud-tab-btn');
        tabBtns.forEach(tabBtn => {
            tabBtn.addEventListener('click', () => {
                const tab = tabBtn.dataset.tab;
                switchHudTab(tab);
            });
        });

        // Reset Dock Button
        const resetBtn = document.getElementById('hudResetDockBtn');
        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                setHudDock('bottom-right');
            });
        }

        // Apply initial visibility (off by default)
        updateHudVisibilityUI();

        // Site-wide Heatmap Canvas hover / tap interaction
        setupHeatmapCanvasInteraction();
    }

    function bumpHudPosition() {
        const overlay = document.getElementById('statsHudOverlay');
        if (!overlay) return;

        let curIdx = hudState.docks.indexOf(hudState.dock);
        if (curIdx === -1) curIdx = 0;
        const nextDock = hudState.docks[(curIdx + 1) % hudState.docks.length];
        setHudDock(nextDock);
    }

    function setHudDock(dockName) {
        const overlay = document.getElementById('statsHudOverlay');
        if (!overlay) return;

        hudState.dock = dockName;
        hudState.x = null;
        hudState.y = null;

        overlay.classList.add('hud-animating');
        overlay.classList.remove('hud-dock-bottom-right', 'hud-dock-bottom-left', 'hud-dock-top-left', 'hud-dock-top-right');
        overlay.classList.add(`hud-dock-${dockName}`);
        overlay.style.left = '';
        overlay.style.top = '';
        overlay.style.right = '';
        overlay.style.bottom = '';

        setTimeout(() => {
            overlay.classList.remove('hud-animating');
            renderStatsHud(true);
        }, 280);

        saveHudLayout();
    }

    function updateHudVisibilityUI() {
        const overlay = document.getElementById('statsHudOverlay');
        const topbarHudBtn = document.getElementById('topbarStatsHudBtn');
        if (!overlay) return;

        if (hudState.visible) {
            overlay.style.display = '';
            if (topbarHudBtn) topbarHudBtn.classList.add('active');
            const hudWindow = document.getElementById('statsHudWindow');
            const miniBar = document.getElementById('statsHudMiniBar');
            if (hudState.minimized) {
                if (hudWindow) hudWindow.style.display = 'none';
                if (miniBar) miniBar.style.display = 'flex';
            } else {
                if (hudWindow) hudWindow.style.display = 'flex';
                if (miniBar) miniBar.style.display = 'none';
                renderStatsHud(true);
            }
        } else {
            overlay.style.display = 'none';
            if (topbarHudBtn) topbarHudBtn.classList.remove('active');
        }
    }

    function toggleStatsHud(forceState) {
        if (typeof forceState === 'boolean') {
            hudState.visible = forceState;
        } else {
            hudState.visible = !hudState.visible;
        }
        updateHudVisibilityUI();
        saveHudLayout();
        if (hudState.visible) {
            toast(hudState.minimized ? '📊 HUD enabled (minimized bar)' : '📊 Live Stats & Heat Map HUD enabled');
        }
    }

    function minimizeHud(minimized) {
        hudState.minimized = Boolean(minimized);
        const hudWindow = document.getElementById('statsHudWindow');
        const miniBar = document.getElementById('statsHudMiniBar');
        if (hudWindow && miniBar && hudState.visible) {
            if (hudState.minimized) {
                hudWindow.style.display = 'none';
                miniBar.style.display = 'flex';
            } else {
                hudWindow.style.display = 'flex';
                miniBar.style.display = 'none';
                renderStatsHud(true);
            }
        }
        saveHudLayout();
    }

    function switchHudTab(tab) {
        hudState.activeTab = tab;
        document.querySelectorAll('.hud-tab-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.tab === tab);
        });

        const subsetsPane = document.getElementById('hudSubsetsPane');
        const heatmapPane = document.getElementById('hudHeatmapPane');

        if (subsetsPane) {
            subsetsPane.style.display = (tab === 'all' || tab === 'subsets') ? 'flex' : 'none';
        }
        if (heatmapPane) {
            heatmapPane.style.display = (tab === 'all' || tab === 'heatmap') ? 'flex' : 'none';
        }

        if (tab === 'all' || tab === 'heatmap') {
            setTimeout(() => drawSitewideHeatmap(), 50);
        }

        saveHudLayout();
    }

    function saveHudLayout() {
        const payload = {
            visible: hudState.visible,
            dock: hudState.dock,
            x: hudState.x,
            y: hudState.y,
            minimized: hudState.minimized,
            activeTab: hudState.activeTab,
            updatedAt: Date.now()
        };

        try {
            localStorage.setItem('cards_hud_layout', JSON.stringify(payload));
        } catch (e) {
            console.warn('Could not save cards_hud_layout to localStorage', e);
        }

        const syncTag = document.getElementById('hudSyncTag');
        if (syncTag) syncTag.textContent = '💾 Saved locally';

        if (state.currentUser?.id) {
            if (hudState.saveTimeout) clearTimeout(hudState.saveTimeout);
            hudState.saveTimeout = setTimeout(async () => {
                try {
                    await api('set_layout_prefs', {}, { layout_prefs: JSON.stringify(payload) });
                    if (syncTag) syncTag.textContent = '☁️ Synced to DB';
                } catch (err) {
                    console.warn('Could not sync layout prefs to DB:', err);
                }
            }, 600);
        }
    }

    function applyHudLayoutPrefs(prefsStr) {
        try {
            const data = (typeof prefsStr === 'string') ? JSON.parse(prefsStr) : prefsStr;
            if (!data) return;

            // HUD is off by default ("the HUD should be off by default")
            hudState.visible = false;

            const overlay = document.getElementById('statsHudOverlay');
            if (data.dock && data.dock !== 'custom') {
                hudState.dock = data.dock;
                hudState.x = null;
                hudState.y = null;
                if (overlay) {
                    overlay.classList.remove('hud-dock-bottom-right', 'hud-dock-bottom-left', 'hud-dock-top-left', 'hud-dock-top-right');
                    overlay.classList.add(`hud-dock-${data.dock}`);
                    overlay.style.left = '';
                    overlay.style.top = '';
                    overlay.style.right = '';
                    overlay.style.bottom = '';
                }
            } else if (data.x !== null && data.y !== null && overlay) {
                hudState.dock = 'custom';
                hudState.x = data.x;
                hudState.y = data.y;
                overlay.classList.remove('hud-dock-bottom-right', 'hud-dock-bottom-left', 'hud-dock-top-left', 'hud-dock-top-right');
                overlay.style.left = `${data.x}px`;
                overlay.style.top = `${data.y}px`;
                overlay.style.right = 'auto';
                overlay.style.bottom = 'auto';
            }

            if (data.minimized !== undefined) {
                minimizeHud(data.minimized);
            }

            if (data.activeTab) {
                switchHudTab(data.activeTab);
            }
        } catch (err) {
            console.warn('Failed parsing layout_prefs:', err);
        }
    }

    function renderStatsHud(forceRedraw = false) {
        if (!hudState.visible) return;
        if (!state.cards || state.cards.length === 0) return;

        const total = state.cards.length;
        const have = state.cards.filter(c => c.quantity > 0).length;
        const overallPct = total > 0 ? Math.round((have / total) * 100) : 0;

        const coverageBadge = document.getElementById('hudOverallCoverageBadge');
        if (coverageBadge) {
            coverageBadge.textContent = `${have}/${total} (${overallPct}%)`;
            coverageBadge.classList.toggle('active-good', overallPct >= 50);
        }

        // Group cards by subset
        const setsMap = new Map();
        for (const card of state.cards) {
            if (!setsMap.has(card.set_name)) setsMap.set(card.set_name, []);
            setsMap.get(card.set_name).push(card);
        }

        // Sort subsets: Base first, Above the Ice second, then others
        const sortedSets = Array.from(setsMap.entries()).sort((a, b) => {
            const nameA = a[0].toLowerCase();
            const nameB = b[0].toLowerCase();
            if (nameA.includes('base') && !nameB.includes('base')) return -1;
            if (!nameA.includes('base') && nameB.includes('base')) return 1;
            if (nameA.includes('ice') && !nameB.includes('ice')) return -1;
            if (!nameA.includes('ice') && nameB.includes('ice')) return 1;
            return nameA.localeCompare(nameB);
        });

        // Populate Subsets List in HUD
        const subsetsListEl = document.getElementById('hudSubsetsList');
        if (subsetsListEl) {
            let sHtml = '';
            let basePct = 0;
            let icePct = 0;

            for (const [setName, setCards] of sortedSets) {
                const sHave = setCards.filter(c => c.quantity > 0).length;
                const sTotal = setCards.length;
                const sPct = sTotal > 0 ? Math.round((sHave / sTotal) * 100) : 0;

                const isBase = setName.toLowerCase().includes('base');
                const isIce = setName.toLowerCase().includes('ice');
                if (isBase) basePct = sPct;
                if (isIce) icePct = sPct;

                const rowClass = isBase ? 'is-base' : (isIce ? 'is-ice' : '');

                sHtml += `
                    <div class="hud-subset-item ${rowClass}" data-set="${esc(setName)}" title="Click to jump to ${esc(setName)}">
                        <div class="hud-subset-info">
                            <span class="hud-subset-name">${esc(setName)}</span>
                            <span class="hud-subset-count"><strong>${sHave}/${sTotal}</strong> (${sPct}%)</span>
                        </div>
                        <div class="hud-subset-track">
                            <div class="hud-subset-bar" style="width: ${sPct}%"></div>
                        </div>
                    </div>
                `;
            }

            subsetsListEl.innerHTML = sHtml;

            // Clicking any subset jumps to it
            subsetsListEl.querySelectorAll('.hud-subset-item').forEach(row => {
                row.addEventListener('click', () => {
                    const setName = row.dataset.set;
                    const cleanId = cleanSetId(setName);
                    const setDetails = document.getElementById('set-' + cleanId);
                    if (setDetails) {
                        setDetails.open = true;
                        state.collapsed.delete(setName);
                        scrollToElementWithStickyOffset(setDetails);
                    }
                });
            });

            // Update mini pill text
            const miniStatsText = document.getElementById('hudMiniStatsText');
            if (miniStatsText) {
                miniStatsText.textContent = `📊 Base ${basePct}% · Ice ${icePct}% · Overall ${overallPct}% · 🔥 Heat Map`;
            }
        }

        // Draw Site-Wide Heatmap
        drawSitewideHeatmap(forceRedraw);
    }

    function drawSitewideHeatmap() {
        const canvas = document.getElementById('hudSitewideHeatmapCanvas');
        if (!canvas || !state.cards || state.cards.length === 0) return;

        const container = canvas.parentElement;
        const rect = container.getBoundingClientRect();
        const dpr = window.devicePixelRatio || 1;
        const w = rect.width ? Math.floor(rect.width - 8) : 280;
        const h = 48;

        canvas.width = w * dpr;
        canvas.height = h * dpr;
        canvas.style.width = `${w}px`;
        canvas.style.height = `${h}px`;

        const ctx = canvas.getContext('2d');
        ctx.scale(dpr, dpr);
        ctx.clearRect(0, 0, w, h);

        const cards = state.cards;
        const total = cards.length;
        const maxHolders = Math.max(1, ...cards.map(c => c.sitewide_holders || 0));

        // Update badge
        const badge = document.getElementById('hudSitewideHoldersCountBadge');
        if (badge) {
            badge.textContent = `🔥 Max ${maxHolders} owners / card`;
        }

        const slotW = w / total;

        // Baseline
        ctx.fillStyle = '#0f172a';
        ctx.fillRect(0, h - 2, w, 2);

        for (let i = 0; i < total; i++) {
            const card = cards[i];
            const x = i * slotW;
            const holders = card.sitewide_holders || 0;
            const ratio = holders / maxHolders;
            const barH = Math.max(5, Math.round(ratio * (h - 10)));
            const barW = Math.max(1.2, slotW - 0.4);

            // Thermal Popularity Gradient
            let grad = ctx.createLinearGradient(0, h - barH, 0, h);
            if (ratio >= 0.7) {
                // Hot / Widely owned
                grad.addColorStop(0, '#34d399');
                grad.addColorStop(1, '#059669');
            } else if (ratio >= 0.3) {
                // Moderate
                grad.addColorStop(0, '#fbbf24');
                grad.addColorStop(1, '#d97706');
            } else {
                // Rare / Coveted
                grad.addColorStop(0, '#f87171');
                grad.addColorStop(1, '#dc2626');
            }

            ctx.fillStyle = grad;
            ctx.fillRect(x, h - barH, barW, barH);

            // Ownership indicators:
            if (card.quantity > 0) {
                // User owns this card: bright cyan marker at the top of the bar
                ctx.fillStyle = '#38bdf8';
                ctx.fillRect(x, h - barH - 3, Math.max(2, barW), 2.5);

                if (card.quantity >= 2) {
                    // Double / Trade: dual gold dot
                    ctx.fillStyle = '#facc15';
                    ctx.fillRect(x, h - barH - 6, Math.max(2, barW), 2);
                }
            }
        }
    }

    function setupHeatmapCanvasInteraction() {
        const canvas = document.getElementById('hudSitewideHeatmapCanvas');
        const tooltip = document.getElementById('hudHeatmapTooltip');
        if (!canvas || !tooltip) return;

        let hideTimer = null;

        const onMove = e => {
            if (!state.cards || state.cards.length === 0) return;
            if (hideTimer) clearTimeout(hideTimer);

            const rect = canvas.getBoundingClientRect();
            const clientX = (e.touches && e.touches[0]) ? e.touches[0].clientX : e.clientX;
            const clientY = (e.touches && e.touches[0]) ? e.touches[0].clientY : e.clientY;
            const x = clientX - rect.left;

            if (x < 0 || x > rect.width) {
                tooltip.style.display = 'none';
                return;
            }

            const idx = Math.floor((x / rect.width) * state.cards.length);
            const card = state.cards[idx];
            if (!card) {
                tooltip.style.display = 'none';
                return;
            }

            const holders = card.sitewide_holders || 0;
            const doubles = card.sitewide_doubles || 0;
            const myStatus = card.quantity > 0
                ? (card.quantity >= 2 ? `🟥 2x In Trade (${card.quantity})` : '🟩 In Your Deck')
                : '🔻 Needed';

            tooltip.innerHTML = `
                <div style="font-weight:800; color:#38bdf8;">#${card.card_number || ''} ${esc(card.player_name)}</div>
                <div style="font-size:0.64rem; color:#cbd5e1;">${esc(card.set_name)}</div>
                <div style="margin-top:2px; font-size:0.64rem;">🔥 <strong>${holders}</strong> owner(s) site-wide · <strong>${doubles}</strong> in trade</div>
                <div style="margin-top:2px; font-size:0.64rem; font-weight:700;">${myStatus}</div>
            `;
            tooltip.style.display = 'block';

            // Center tooltip clamped within container
            const tipW = tooltip.offsetWidth || 150;
            const containerW = canvas.parentElement.offsetWidth || 300;
            const clampedX = Math.max(tipW / 2 + 4, Math.min(containerW - tipW / 2 - 4, x));
            tooltip.style.left = `${clampedX}px`;
            tooltip.style.bottom = `${rect.height + 8}px`;
        };

        const onLeave = () => {
            hideTimer = setTimeout(() => {
                tooltip.style.display = 'none';
            }, 300);
        };

        const onClick = e => {
            if (!state.cards || state.cards.length === 0) return;
            const rect = canvas.getBoundingClientRect();
            const clientX = (e.touches && e.touches[0]) ? e.touches[0].clientX : e.clientX;
            const x = clientX - rect.left;
            const idx = Math.floor((x / rect.width) * state.cards.length);
            const card = state.cards[idx];
            if (card) {
                jumpToCard(card.id);
            }
        };

        canvas.addEventListener('mousemove', onMove);
        canvas.addEventListener('mouseleave', onLeave);
        canvas.addEventListener('click', onClick);

        // Touch events
        canvas.addEventListener('touchstart', onMove, { passive: true });
        canvas.addEventListener('touchmove', onMove, { passive: true });
        canvas.addEventListener('touchend', onClick);
    }

    /* ==========================================================
       DIGIKEY-STYLE PARAMETRIC INVENTORY FILTER METHODS
       ========================================================== */
    function populateParamInventoryFilter() {
        if (!state.cards || state.cards.length === 0) return;

        const cards = state.cards;
        const total = cards.length;
        const totalMatched = cards.filter(matchesFilter).length;

        // Update counts
        const topCount = document.getElementById('ifsTopResultsCount');
        const bottomCount = document.getElementById('ifsBottomResultsCount');
        const showingText = document.getElementById('ifsShowingText');
        const seriesTitle = document.getElementById('ifsBreadcrumbSeries');

        if (topCount) topCount.textContent = totalMatched.toLocaleString();
        if (bottomCount) bottomCount.textContent = totalMatched.toLocaleString();
        if (showingText) showingText.innerHTML = `Showing <strong>${totalMatched}</strong> of ${total} Cards`;
        if (seriesTitle) seriesTitle.textContent = state.series === '2025-26' ? '2025-26 Tim Hortons' : '2026-27 UD Tim Hortons';
        if (typeof updateIfsBadge === 'function') updateIfsBadge();

        // 1. Common Attributes
        const statusListEl = document.getElementById('ifsColStatusList');
        if (statusListEl) {
            const ownedCnt = cards.filter(c => c.quantity > 0).length;
            const missingCnt = cards.filter(c => c.quantity === 0).length;
            const doublesCnt = cards.filter(c => c.quantity >= 2).length;
            const triplesCnt = cards.filter(c => c.quantity >= 3).length;
            const teamDoublesCnt = cards.filter(c => (c.doubles_by && c.doubles_by.length > 0) || (c.team_doubles_by && c.team_doubles_by.length > 0)).length;
            const teamNeedsCnt = cards.filter(c => c.team_has === 0).length;

            const items = [
                { id: 'owned', label: '🟩 In Collection / Owned', count: ownedCnt },
                { id: 'missing', label: '🔻 Needed / Missing', count: missingCnt },
                { id: 'doubles', label: '🟥 Doubles (2x In Trade)', count: doublesCnt },
                { id: 'triples', label: '📦 Triples+ (3x+ Stash)', count: triplesCnt },
                { id: 'team_doubles', label: '👥 Teammate Has Doubles', count: teamDoublesCnt },
                { id: 'team_needs', label: '⚠️ Team Needs (0 in Team)', count: teamNeedsCnt }
            ];

            statusListEl.innerHTML = items.map(it => `
                <label class="ifs-col-item ${paramState.status.has(it.id) ? 'is-selected' : ''}">
                    <input type="checkbox" data-facet="status" value="${it.id}" ${paramState.status.has(it.id) ? 'checked' : ''}>
                    <span class="ifs-item-text">${esc(it.label)}</span>
                    <span class="ifs-item-count">(${it.count})</span>
                </label>
            `).join('');
        }

        // 2. Subsets
        const subsetsListEl = document.getElementById('ifsColSubsetsList');
        if (subsetsListEl) {
            const subsetsMap = new Map();
            cards.forEach(c => {
                subsetsMap.set(c.set_name, (subsetsMap.get(c.set_name) || 0) + 1);
            });
            const sortedSubsets = Array.from(subsetsMap.entries()).sort((a, b) => {
                if (a[0].toLowerCase().includes('base')) return -1;
                if (b[0].toLowerCase().includes('base')) return 1;
                return a[0].localeCompare(b[0]);
            });

            subsetsListEl.innerHTML = sortedSubsets.map(([name, cnt]) => `
                <label class="ifs-col-item ${paramState.subsets.has(name) ? 'is-selected' : ''}">
                    <input type="checkbox" data-facet="subsets" value="${esc(name)}" ${paramState.subsets.has(name) ? 'checked' : ''}>
                    <span class="ifs-item-text">${esc(name)}</span>
                    <span class="ifs-item-count">(${cnt})</span>
                </label>
            `).join('');
        }

        // Card Series
        const seriesListEl = document.getElementById('ifsColSeriesList');
        if (seriesListEl) {
            const seriesItems = [
                { id: 'Upper Deck Tim Hortons', label: 'Upper Deck Tim Hortons', count: cards.length }
            ];
            seriesListEl.innerHTML = seriesItems.map(it => `
                <label class="ifs-col-item ${paramState.series.has(it.id) ? 'is-selected' : ''}">
                    <input type="checkbox" data-facet="series" value="${esc(it.id)}" ${paramState.series.has(it.id) ? 'checked' : ''}>
                    <span class="ifs-item-text">${esc(it.label)}</span>
                    <span class="ifs-item-count">(${it.count})</span>
                </label>
            `).join('');
        }

        // Checklist Year
        const yearListEl = document.getElementById('ifsColYearList');
        if (yearListEl) {
            const curYear = state.series || '2026-27';
            const yearItems = [
                { id: '2026-27', label: '2026-27', count: curYear === '2026-27' ? cards.length : 276 },
                { id: '2025-26', label: '2025-26', count: curYear === '2025-26' ? cards.length : 234 }
            ];
            yearListEl.innerHTML = yearItems.map(it => `
                <label class="ifs-col-item ${paramState.year.has(it.id) ? 'is-selected' : ''}">
                    <input type="checkbox" data-facet="year" value="${it.id}" ${paramState.year.has(it.id) ? 'checked' : ''}>
                    <span class="ifs-item-text">${esc(it.label)}</span>
                    <span class="ifs-item-count">(${it.count})</span>
                </label>
            `).join('');
        }

        // 4. Card Number Range
        const rangesListEl = document.getElementById('ifsColRangesList');
        if (rangesListEl) {
            const r1 = cards.filter(c => { const n = parseInt(c.card_number, 10); return (c.set_name || '').toLowerCase().includes('base') && n >= 1 && n <= 25; }).length;
            const r2 = cards.filter(c => { const n = parseInt(c.card_number, 10); return (c.set_name || '').toLowerCase().includes('base') && n >= 26 && n <= 50; }).length;
            const r3 = cards.filter(c => { const n = parseInt(c.card_number, 10); return (c.set_name || '').toLowerCase().includes('base') && n >= 51 && n <= 75; }).length;
            const r4 = cards.filter(c => { const n = parseInt(c.card_number, 10); return (c.set_name || '').toLowerCase().includes('base') && n >= 76 && n <= 100; }).length;
            const rInserts = cards.filter(c => !(c.set_name || '').toLowerCase().includes('base')).length;

            const rangeItems = [
                { id: '1-25', label: 'Cards #1 - #25', count: r1 },
                { id: '26-50', label: 'Cards #26 - #50', count: r2 },
                { id: '51-75', label: 'Cards #51 - #75', count: r3 },
                { id: '76-100', label: 'Cards #76 - #100', count: r4 },
                { id: 'inserts', label: 'Inserts & Special', count: rInserts }
            ];

            rangesListEl.innerHTML = rangeItems.map(it => `
                <label class="ifs-col-item ${paramState.ranges.has(it.id) ? 'is-selected' : ''}">
                    <input type="checkbox" data-facet="ranges" value="${it.id}" ${paramState.ranges.has(it.id) ? 'checked' : ''}>
                    <span class="ifs-item-text">${esc(it.label)}</span>
                    <span class="ifs-item-count">(${it.count})</span>
                </label>
            `).join('');
        }

        // 5. Scarcity / Popularity
        const scarcityListEl = document.getElementById('ifsColScarcityList');
        if (scarcityListEl) {
            const maxHolders = Math.max(1, ...cards.map(c => c.sitewide_holders || 0));
            const hotCnt = cards.filter(c => (c.sitewide_holders || 0) / maxHolders >= 0.7).length;
            const midCnt = cards.filter(c => { const r = (c.sitewide_holders || 0) / maxHolders; return r >= 0.3 && r < 0.7; }).length;
            const rareCnt = cards.filter(c => (c.sitewide_holders || 0) / maxHolders < 0.3).length;
            const zeroDbls = cards.filter(c => (c.sitewide_doubles || 0) === 0).length;

            const scarcityItems = [
                { id: 'hot', label: '🔥 Hot / High Circulation', count: hotCnt },
                { id: 'mid', label: '⚡ Moderate Circulation', count: midCnt },
                { id: 'rare', label: '❄️ Rare Site-Wide', count: rareCnt },
                { id: 'zero_doubles', label: '💎 Zero Site Doubles', count: zeroDbls }
            ];

            scarcityListEl.innerHTML = scarcityItems.map(it => `
                <label class="ifs-col-item ${paramState.scarcity.has(it.id) ? 'is-selected' : ''}">
                    <input type="checkbox" data-facet="scarcity" value="${it.id}" ${paramState.scarcity.has(it.id) ? 'checked' : ''}>
                    <span class="ifs-item-text">${esc(it.label)}</span>
                    <span class="ifs-item-count">(${it.count})</span>
                </label>
            `).join('');
        }

        // 6. Quantity in Deck
        const quantityListEl = document.getElementById('ifsColQuantityList');
        if (quantityListEl) {
            const q0 = cards.filter(c => c.quantity === 0).length;
            const q1 = cards.filter(c => c.quantity === 1).length;
            const q2 = cards.filter(c => c.quantity === 2).length;
            const q3 = cards.filter(c => c.quantity >= 3).length;

            const qItems = [
                { id: '0', label: '0 Copies (Missing)', count: q0 },
                { id: '1', label: '1 Copy (Single)', count: q1 },
                { id: '2', label: '2 Copies (Double)', count: q2 },
                { id: '3+', label: '3+ Copies (Hoard)', count: q3 }
            ];

            quantityListEl.innerHTML = qItems.map(it => `
                <label class="ifs-col-item ${paramState.quantity.has(it.id) ? 'is-selected' : ''}">
                    <input type="checkbox" data-facet="quantity" value="${it.id}" ${paramState.quantity.has(it.id) ? 'checked' : ''}>
                    <span class="ifs-item-text">${esc(it.label)}</span>
                    <span class="ifs-item-count">(${it.count})</span>
                </label>
            `).join('');
        }

        // 7. Player Name
        const playersListEl = document.getElementById('ifsColPlayersList');
        if (playersListEl) {
            const playersMap = new Map();
            cards.forEach(c => {
                if (c.player_name) {
                    playersMap.set(c.player_name, (playersMap.get(c.player_name) || 0) + 1);
                }
            });
            const sortedPlayers = Array.from(playersMap.entries()).sort((a, b) => a[0].localeCompare(b[0]));

            playersListEl.innerHTML = sortedPlayers.map(([pname, cnt]) => `
                <label class="ifs-col-item ${paramState.players.has(pname) ? 'is-selected' : ''}">
                    <input type="checkbox" data-facet="players" value="${esc(pname)}" ${paramState.players.has(pname) ? 'checked' : ''}>
                    <span class="ifs-item-text">${esc(pname)}</span>
                    <span class="ifs-item-count">(${cnt})</span>
                </label>
            `).join('');
        }

        // 8. Trading Partner Doubles
        const partnersListEl = document.getElementById('ifsColPartnersList');
        if (partnersListEl) {
            const partnersMap = new Map();
            cards.forEach(c => {
                const combined = [...(c.doubles_by || []), ...(c.team_doubles_by || [])];
                combined.forEach(rawStr => {
                    const match = rawStr.match(/^([^\s(×]+)/);
                    if (match) {
                        const pName = match[1].trim();
                        partnersMap.set(pName, (partnersMap.get(pName) || 0) + 1);
                    }
                });
            });

            if (partnersMap.size === 0) {
                partnersListEl.innerHTML = `<div style="padding:8px; font-size:0.75rem; color:#64748b; font-style:italic;">No partner doubles in current checklist.</div>`;
            } else {
                const sortedPartners = Array.from(partnersMap.entries()).sort((a, b) => a[0].localeCompare(b[0]));
                partnersListEl.innerHTML = sortedPartners.map(([pName, cnt]) => `
                    <label class="ifs-col-item ${paramState.partners.has(pName) ? 'is-selected' : ''}">
                        <input type="checkbox" data-facet="partners" value="${esc(pName)}" ${paramState.partners.has(pName) ? 'checked' : ''}>
                        <span class="ifs-item-text">🤝 ${esc(pName)}</span>
                        <span class="ifs-item-count">(${cnt})</span>
                    </label>
                `).join('');
            }
        }
    }

    function downloadFilteredTableCSV() {
        if (!state.cards || state.cards.length === 0) return;
        const matchingCards = sortCards(state.cards.filter(matchesFilter));
        if (matchingCards.length === 0) {
            toast('No cards match the current filter to export.');
            return;
        }

        const headers = ["Card Number", "Player Name", "Subset", "Series", "Year", "My Quantity", "Status", "Site-Wide Holders", "Site-Wide Doubles", "Teammate Doubles"];
        const rows = [headers.map(h => `"${h.replace(/"/g, '""')}"`).join(',')];

        for (const c of matchingCards) {
            const status = c.quantity === 0 ? "Missing" : (c.quantity === 1 ? "Owned (Single)" : `Double (${c.quantity} copies)`);
            const teamDoubles = (c.team_doubles_by || []).join('; ');
            const row = [
                c.card_number || "",
                c.player_name || "",
                c.set_name || "",
                c.series || "Upper Deck Tim Hortons",
                c.year || state.series || "2026-27",
                c.quantity,
                status,
                c.sitewide_holders || 0,
                c.sitewide_doubles || 0,
                teamDoubles
            ];
            rows.push(row.map(val => `"${String(val).replace(/"/g, '""')}"`).join(','));
        }

        const csvContent = "data:text/csv;charset=utf-8," + encodeURIComponent(rows.join('\r\n'));
        const link = document.createElement("a");
        link.setAttribute("href", csvContent);
        link.setAttribute("download", `HockeyCards_Inventory_${state.series || '2026-27'}_${new Date().toISOString().slice(0, 10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        toast(`📥 Exported ${matchingCards.length} cards to CSV table!`);
    }

    function updateIfsBadge() {
        const badge = document.getElementById('ifsFilterActiveBadge');
        const trigger = document.getElementById('ifsFlyoutTriggerBtn');
        let count = 0;
        if (paramState.searchWithin) count++;
        count += paramState.status.size;
        count += paramState.series.size;
        count += paramState.year.size;
        count += paramState.subsets.size;
        count += paramState.ranges.size;
        count += paramState.scarcity.size;
        count += paramState.quantity.size;
        count += paramState.players.size;
        count += paramState.partners.size;

        if (badge) {
            badge.textContent = count;
            badge.hidden = count === 0;
        }
        if (trigger) {
            trigger.classList.toggle('has-active', count > 0);
        }
    }

    let paramFilterDebounce = null;
    function initParamInventoryFilter() {
        const wrapper = document.getElementById('ifsColumnsWrapper');
        if (!wrapper) return;

        // Delegated checkbox change handler - multi-select with live grouped re-render
        wrapper.addEventListener('change', e => {
            const cb = e.target.closest('input[type="checkbox"]');
            if (!cb) return;

            const facet = cb.dataset.facet;
            const val = cb.value;
            const set = paramState[facet];
            if (!set) return;

            if (cb.checked) {
                set.add(val);
                cb.closest('.ifs-col-item')?.classList.add('is-selected');
                if (facet === 'year' && (val === '2025-26' || val === '2026-27') && val !== state.series) {
                    paramState.year.clear();
                    paramState.year.add(val);
                    switchSeries(val);
                    return;
                }
            } else {
                set.delete(val);
                cb.closest('.ifs-col-item')?.classList.remove('is-selected');
            }

            // Update live result counts immediately
            const totalMatched = state.cards ? state.cards.filter(matchesFilter).length : 0;
            const topCount = document.getElementById('ifsTopResultsCount');
            const bottomCount = document.getElementById('ifsBottomResultsCount');
            const showingText = document.getElementById('ifsShowingText');
            if (topCount) topCount.textContent = totalMatched.toLocaleString();
            if (bottomCount) bottomCount.textContent = totalMatched.toLocaleString();
            if (showingText && state.cards) showingText.innerHTML = `Showing <strong>${totalMatched}</strong> of ${state.cards.length} Cards`;
            updateIfsBadge();

            // Live re-render results grouped below as user selects multiple filters
            clearTimeout(paramFilterDebounce);
            paramFilterDebounce = setTimeout(() => {
                render();
            }, 60);
        });

        // Search inputs within each column
        document.querySelectorAll('.ifs-col-search-input').forEach(input => {
            input.addEventListener('input', () => {
                const targetId = input.dataset.target;
                const targetList = document.getElementById(targetId);
                if (!targetList) return;
                const q = input.value.trim().toLowerCase();
                targetList.querySelectorAll('.ifs-col-item').forEach(item => {
                    const text = (item.textContent || '').toLowerCase();
                    item.style.display = (!q || text.includes(q)) ? 'flex' : 'none';
                });
            });
        });

        // Top Search Within input
        const searchInput = document.getElementById('ifsSearchWithin');
        if (searchInput) {
            searchInput.addEventListener('input', () => {
                paramState.searchWithin = searchInput.value.trim();
                const totalMatched = state.cards ? state.cards.filter(matchesFilter).length : 0;
                const topCount = document.getElementById('ifsTopResultsCount');
                const bottomCount = document.getElementById('ifsBottomResultsCount');
                if (topCount) topCount.textContent = totalMatched.toLocaleString();
                if (bottomCount) bottomCount.textContent = totalMatched.toLocaleString();
                updateIfsBadge();

                clearTimeout(paramFilterDebounce);
                paramFilterDebounce = setTimeout(() => {
                    render();
                }, 220);
            });
            searchInput.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(paramFilterDebounce);
                    render();
                }
            });
        }

        // Apply All button
        const applyBtn = document.getElementById('ifsApplyBtn');
        if (applyBtn) {
            applyBtn.addEventListener('click', () => {
                updateIfsBadge();
                render();
                const totalMatched = state.cards ? state.cards.filter(matchesFilter).length : 0;
                toast(`🔍 Parametric filter applied: ${totalMatched} matching card(s) found!`);
            });
        }

        // Reset Filters button
        const resetBtn = document.getElementById('ifsResetBtn');
        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                paramState.searchWithin = '';
                paramState.status.clear();
                paramState.series.clear();
                paramState.year.clear();
                paramState.subsets.clear();
                paramState.ranges.clear();
                paramState.scarcity.clear();
                paramState.quantity.clear();
                paramState.players.clear();
                paramState.partners.clear();
                paramState.sortBy = 'featured';

                if (searchInput) searchInput.value = '';
                const sortSel = document.getElementById('ifsSortBy');
                if (sortSel) sortSel.value = 'featured';

                document.querySelectorAll('.ifs-col-search-input').forEach(si => si.value = '');

                updateIfsBadge();
                render();
                toast('↺ All inventory filters cleared.');
            });
        }

        // Mode Toggles (Scrolling vs Stacked)
        const modeStacked = document.getElementById('ifsModeStacked');
        const modeScrolling = document.getElementById('ifsModeScrolling');
        if (modeStacked && modeScrolling) {
            modeStacked.addEventListener('click', () => {
                paramState.mode = 'stacked';
                wrapper.classList.remove('mode-scrolling');
                wrapper.classList.add('mode-stacked');
                modeStacked.classList.add('active');
                modeScrolling.classList.remove('active');
                try { localStorage.setItem('cards_ifs_mode', 'stacked'); } catch (e) {}
            });
            modeScrolling.addEventListener('click', () => {
                paramState.mode = 'scrolling';
                wrapper.classList.remove('mode-stacked');
                wrapper.classList.add('mode-scrolling');
                modeScrolling.classList.add('active');
                modeStacked.classList.remove('active');
                try { localStorage.setItem('cards_ifs_mode', 'scrolling'); } catch (e) {}
            });
        }

        // Flyout Drawer Open/Close Controller ("the filter should fly in and fly out from the right")
        const ifsDrawer = document.getElementById('inventoryFilterSection');
        const ifsBackdrop = document.getElementById('ifsDrawerBackdrop');
        const ifsTriggerBtn = document.getElementById('ifsFlyoutTriggerBtn');
        const ifsCloseBtn = document.getElementById('ifsCloseDrawerBtn');
        const collapseBtn = document.getElementById('ifsCollapseBtn');

        function openIfsDrawer() {
            if (!ifsDrawer) return;
            ifsDrawer.classList.add('open');
            if (ifsBackdrop) ifsBackdrop.classList.add('open');
            document.body.classList.add('ifs-drawer-active');
            if (searchInput) {
                setTimeout(() => searchInput.focus(), 120);
            }
        }

        function closeIfsDrawer() {
            if (!ifsDrawer) return;
            ifsDrawer.classList.remove('open');
            if (ifsBackdrop) ifsBackdrop.classList.remove('open');
            document.body.classList.remove('ifs-drawer-active');
        }

        function toggleIfsDrawer() {
            if (ifsDrawer && ifsDrawer.classList.contains('open')) {
                closeIfsDrawer();
            } else {
                openIfsDrawer();
            }
        }

        if (ifsTriggerBtn) ifsTriggerBtn.addEventListener('click', toggleIfsDrawer);
        if (ifsCloseBtn) ifsCloseBtn.addEventListener('click', closeIfsDrawer);
        if (collapseBtn) collapseBtn.addEventListener('click', toggleIfsDrawer);
        if (ifsBackdrop) ifsBackdrop.addEventListener('click', closeIfsDrawer);

        window.addEventListener('keydown', e => {
            if (e.key === 'Escape' && ifsDrawer && ifsDrawer.classList.contains('open')) {
                closeIfsDrawer();
            }
        });

        // Sort By dropdown
        const sortBySelect = document.getElementById('ifsSortBy');
        if (sortBySelect) {
            sortBySelect.addEventListener('change', () => {
                paramState.sortBy = sortBySelect.value;
                render();
            });
        }

        // Download Table CSV button
        const downloadBtn = document.getElementById('ifsDownloadTableBtn');
        if (downloadBtn) {
            downloadBtn.addEventListener('click', () => {
                downloadFilteredTableCSV();
            });
        }

        updateIfsBadge();
    }

    // Initialize Parametric Inventory Filter
    initParamInventoryFilter();
    updateStickyOffsets();

    // Initialize HUD Overlay
    initStatsHud();

    // Initial check
    checkAuthAndInit();
</script>

</body>
</html>
