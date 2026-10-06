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
            bottom: 0;
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

        /* Sidebar Footer (User info & actions) */
        .sidebar-footer {
            padding: 12px 14px;
            border-top: 1px solid var(--border-color);
            background: #fafbfc;
            display: grid;
            gap: 8px;
        }
        .user-summary {
            font-size: 0.8rem;
            line-height: 1.35;
        }
        .user-summary strong { color: var(--text-color); }
        .user-team-badge {
            display: inline-block;
            margin-top: 2px;
            font-size: 0.72rem;
            background: #e2e8f0;
            padding: 1px 6px;
            border-radius: 4px;
            color: #334155;
        }
        .sidebar-actions {
            display: flex;
            gap: 6px;
        }
        .sidebar-actions button {
            flex: 1;
            padding: 5px 8px;
            font-size: 0.78rem;
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
            background: var(--bg);
        }

        /* Fixed Right Bar ("the right side bar... we call it the right bare - remain fixed all the time") */
        aside.right-bar {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
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
        /* ==========================================================
           SPORTS CHANNEL HIGHLIGHTS PACKAGE & NEWS FEED
           ("bottom right corner, sprinkled cards, green-red gradient, completeness, sports channel news feed")
           ========================================================== */
        .sports-highlights-deck {
            background: #090d16;
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 12px;
            color: #e2e8f0;
            display: flex;
            flex-direction: column;
            gap: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin-top: auto; /* Docks cleanly to the bottom right corner of the right bar */
        }
        .hl-broadcast-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 6px;
            border-bottom: 1px solid #1e293b;
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
            font-size: 0.64rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: #94a3b8;
            text-transform: uppercase;
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
        /* Sports Channel News Ticker ("like a news feed, like a sports channel") */
        .hl-news-ticker {
            display: flex;
            align-items: center;
            background: #050811;
            border: 1px solid #1e293b;
            border-radius: 6px;
            overflow: hidden;
            height: 24px;
        }
        .ticker-badge {
            background: #1e3a8a;
            color: #93c5fd;
            font-size: 0.58rem;
            font-weight: 900;
            letter-spacing: 0.08em;
            padding: 0 6px;
            height: 100%;
            display: flex;
            align-items: center;
            flex-shrink: 0;
            text-transform: uppercase;
        }
        .ticker-track-wrap {
            flex: 1;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }
        .ticker-track {
            display: inline-block;
            white-space: nowrap;
            padding-left: 100%;
            animation: tickerScroll 24s linear infinite;
        }
        .ticker-track:hover {
            animation-play-state: paused;
        }
        @keyframes tickerScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
        .ticker-item {
            font-size: 0.65rem;
            font-weight: 700;
            color: #e2e8f0;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            margin-right: 28px;
        }

        /* Sticky top bar */
        header.topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            background: #fff;
            border-bottom: 1px solid var(--border-color);
            padding: 8px 16px;
        }
        .bar {
            max-width: 1600px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px 12px;
        }
        .mobile-menu-btn {
            display: none;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 1rem;
            cursor: pointer;
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
        .filters { display: flex; flex-wrap: wrap; gap: 4px; }
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

        /* Main content area */
        main {
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            padding: 14px 16px 36px;
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
            gap: 6px;
            margin-bottom: 8px;
        }
        .series-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 9px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background: #f8fafc;
            font-size: 0.78rem;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .series-chip:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
            transform: translateY(-1px);
        }
        .series-chip.active {
            background: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.25);
        }
        .series-chip .chip-count {
            font-size: 0.7rem;
            opacity: 0.9;
            background: rgba(0,0,0,0.07);
            padding: 1px 5px;
            border-radius: 4px;
            font-weight: 600;
        }
        .series-chip.active .chip-count {
            background: rgba(255,255,255,0.25);
            color: #fff;
        }

        /* Sub-list row for Sheet/Number quick jumps */
        .series-sublist-row {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 7px 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .sublist-lead {
            font-size: 0.74rem;
            font-weight: 800;
            color: #1e293b;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .sublist-pills-wrap {
            display: flex;
            align-items: center;
            gap: 5px;
            overflow-x: auto;
            padding: 2px 0;
        }
        .sublist-jump-btn {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3px 8px;
            border-radius: 5px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.15s ease;
            flex-shrink: 0;
            line-height: 1.15;
        }
        .sublist-jump-btn:hover {
            background: #0284c7;
            color: #fff;
            border-color: #0284c7;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.25);
        }
        .sublist-jump-btn:hover .jump-card-range {
            color: rgba(255,255,255,0.9);
        }
        .jump-sheet-num {
            font-size: 0.72rem;
            font-weight: 800;
        }
        .jump-card-range {
            font-size: 0.64rem;
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

        /* Card tiles: Grid layouts */
        .grid.layout-page {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 20px;
            padding: 10px 12px 18px;
        }
        .grid.layout-list {
            column-width: 195px;
            column-gap: 12px;
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
            gap: 6px;
            padding: 4px 6px;
            border: 1px solid transparent;
            border-left: 3px solid #ddd;
            border-radius: 3px;
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
        .num { flex: 0 0 auto; min-width: 2.6em; font-weight: 700; font-size: 0.75rem; color: var(--muted); }
        .card.missing .num { font-size: 0.95rem; font-weight: 900; color: #0f172a; }
        .name { flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
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
            padding: 0 6px 0 calc(2.6em + 15px);
            margin-top: -2px;
        }
        .holders-info {
            grid-column: 1 / -1;
            font-size: 0.72rem;
            color: #0369a1;
            padding: 0 6px 0 calc(2.6em + 15px);
            margin-top: -2px;
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
            .mobile-right-btn { display: inline-flex; margin-left: auto; }
            header.topbar { padding: 6px 10px; }
            main { padding: 8px 10px 24px; }
            .collector-dashboard-unit {
                padding: 8px 10px;
                gap: 10px;
            }
            .collector-dashboard-unit .vu-meter-housing {
                min-width: 100%;
            }
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
            <!-- Hockey Category -->
            <div>
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

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <div class="user-summary">
                Signed in as <strong id="sideUserName"></strong><br>
                <span class="user-team-badge" id="sideUserTeamBadge"></span>
            </div>
            <div class="sidebar-actions">
                <a href="admin.php" id="sideAdminLink" class="admin-link-btn" hidden>⚙️ Admin</a>
                <button type="button" id="editTeamBtn">Edit Team</button>
                <button type="button" id="signOutBtn" onclick="handleSignOut(event)" class="primary">Sign out</button>
            </div>
        </div>
    </aside>

    <!-- CONTENT AREA -->
    <div class="content-area">
        <header class="topbar">
            <div class="bar">
                <button class="mobile-menu-btn" id="openSidebarBtn" aria-label="Open menu">☰</button>
                <h1>
                    <span id="topbarSeriesTitle">2026-27 UD Tim Hortons</span>
                    <span class="series-tag" id="topbarSeriesTag">$1 / account</span>
                </h1>

                <button type="button" id="newCollectorTopbarBtn" class="primary">+ Collector</button>

                <label class="overall">Viewing
                    <select id="viewSelect" aria-label="Viewing collection"></select>
                </label>

                <div class="filters" id="filters">
                    <button data-filter="all" class="active">All</button>
                    <button data-filter="missing">Missing</button>
                    <button data-filter="doubles">My Doubles</button>
                    <button data-filter="trade" title="Your doubles, plus cards you're missing that teammates have doubles of">For Trade</button>
                    <button data-filter="team_needs" id="teamNeedsFilterBtn" hidden title="Cards nobody on your team has collected yet">Team Needs</button>
                </div>

                <button class="mobile-menu-btn mobile-right-btn" id="openRightBarBtn" aria-label="Open collector options">👤</button>
            </div>
        </header>

        <main id="main">
            <!-- COLLECTOR DASHBOARD UNIT: Sentence Stats + Pro Audio VU Meter ("right with the thing it's about, no visual void") -->
            <div class="collector-dashboard-unit" id="collectorDashboardUnit">
                <div class="collector-sentence-wrap">
                    <span class="sentence-user-lead" id="sentenceUserText">Viewing <strong>Bronzo</strong>'s collection:</span>
                    <div class="sentence-stats-group" id="collectionHighlightDeck">
                        <button type="button" class="stat-sentence-pill deck-card have active" id="statHaveBtn" data-filter="all" title="Click to view all collected cards">
                            <span class="stat-num" id="deckHaveVal">0</span>
                            <span class="stat-emoji">✅</span>
                            <span class="stat-word">have</span>
                        </button>
                        <span class="stat-sep">·</span>
                        <button type="button" class="stat-sentence-pill deck-card need" id="statNeedBtn" data-filter="missing" title="Click to view missing cards needed">
                            <span class="stat-num" id="deckNeedVal">0</span>
                            <span class="stat-emoji">❓</span>
                            <span class="stat-word">needed</span>
                        </button>
                        <span class="stat-sep">·</span>
                        <button type="button" class="stat-sentence-pill deck-card doubles" id="statTradeBtn" data-filter="doubles" title="Click to view doubles for trade">
                            <span class="stat-num" id="deckDoublesVal">0</span>
                            <span class="stat-emoji">🔁</span>
                            <span class="stat-word">trade</span>
                        </button>
                        <span class="stat-sep" id="statTeamSep" hidden>·</span>
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

            <!-- SERIES QUICK LINKS & SUB-LIST JUMP MENU ("use all this real estate to be serias quick links, menu quick jump to those pages and those numbers") -->
            <nav class="series-nav-panel" id="seriesNavPanel" aria-label="Series quick links and sheet jump menu">
                <div class="series-nav-header">
                    <span class="series-nav-title">⚡ Series Quick Links</span>
                    <span class="series-nav-hint">Click a series to jump, or select a sheet and numbers below:</span>
                </div>
                <div class="series-chips-row" id="seriesChipsRow"></div>
                <div class="series-sublist-row" id="seriesSublistRow"></div>
            </nav>

            <!-- DYNAMIC CARDS CONTAINER -->
            <div id="cardsContainer"></div>
        </main>
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

        <!-- TOGGLE PAGE VIEW / LIST VIEW ("on the right bar, toggle page view / list view") -->
        <div class="right-bar-section">
            <div class="right-bar-section-title">View Layout</div>
            <div class="layout-switcher right-bar-layout-switcher" id="layoutSwitcher">
                <button type="button" class="layout-btn active" data-layout="page" title="3x3 Binder Page Sheet view">📄 3×3 Page</button>
                <button type="button" class="layout-btn" data-layout="list" title="Compact List view">☰ List</button>
            </div>
        </div>

        <!-- SPORTS CHANNEL HIGHLIGHTS PACKAGE & NEWS FEED ("on the bottom right corner like a news feed like a sports channel a highlights package") -->
        <div class="sports-highlights-deck" id="sportsHighlightsDeck">
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
                    <span class="leg-item leg-doubles">🟨 2x Trade</span>
                    <span class="leg-item leg-needed">🟥 Needed</span>
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

            <!-- Sports Channel News Feed Ticker -->
            <div class="hl-news-ticker">
                <div class="ticker-badge">TICKER</div>
                <div class="ticker-track-wrap">
                    <div class="ticker-track" id="tickerTrack">
                        <span class="ticker-item">🏒 2026-27 UD Tim Hortons live highlights feed</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>

<div class="toast" id="toast" hidden></div>

<!-- NEW COLLECTOR DIALOG (+ Collector button) -->
<dialog id="newCollectorDialog">
    <form id="newCollectorForm">
        <strong>Create New Collector Account</strong>
        <label>Collector Name (shown to other traders)
            <input name="collector_name" id="newCollectorName" maxlength="50" minlength="2" required placeholder="e.g. Anthony" autocomplete="off">
        </label>
        <label>Ask to Join a Team (Optional)
            <select id="newCollectorTeamSelect">
                <option value="">— No Team (Individual Collector) —</option>
            </select>
        </label>
        <div id="newCollectorNewTeamRow" hidden>
            <label>New Team Name
                <input id="newCollectorNewTeamName" maxlength="50" placeholder="e.g. Blackhawks">
            </label>
        </div>
        <label>Password (your initials or cheat code HAWK)
            <input name="password" id="newCollectorPass" type="password" maxlength="5" required placeholder="1-5 letters or HAWK" autocomplete="new-password">
        </label>

        <!-- Pricing & Cheat Code Box -->
        <div class="pricing-box">
            <div class="pricing-header">
                <span>Account Fee</span>
                <span class="pricing-amount is-free" id="newCollectorPricingAmount">FREE ($0.00)</span>
            </div>
            <label style="margin: 0; font-size: 0.78rem;">Discount / Cheat Code (Enter HAWK for Free)
                <input id="newCollectorDiscountCode" value="HAWK" placeholder="Enter HAWK" style="text-transform: uppercase;">
            </label>
            <div class="discount-status-pill free" id="newCollectorDiscountPill">
                <span>🎉</span> <span id="newCollectorDiscountText">Cheat code HAWK applied — 100% Free!</span>
            </div>
        </div>

        <div class="error" id="newCollectorError"></div>
        <div class="actions">
            <button type="button" id="cancelNewCollector">Cancel</button>
            <button type="submit" class="primary" id="newCollectorSubmitBtn">Register (FREE with HAWK)</button>
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
        <span class="wiki-hint">💡 Push and hold any card to view Wikipedia bio</span>
        <div style="display:flex; gap:8px;">
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
        layout: localStorage.getItem('cards_layout') || 'page', // 'page' (3x3 binder sheet) or 'list'
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

            if (me) {
                state.currentUser = me;
                state.userId = me.id;
                state.viewId = me.id;
            } else {
                // Stranger / Public Guest: display Bronzo's collection openly
                state.currentUser = null;
                state.userId = null;
                const bronzo = state.users.find(u => (u.collector_name || '').toLowerCase() === 'bronzo') || state.users[0];
                state.viewId = bronzo ? bronzo.id : null;
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
    function setupDiscountWatcher(inputEl, amountEl, pillEl, textEl, submitBtnEl, baseLabel) {
        if (!inputEl) return;
        function update() {
            const val = inputEl.value.trim().toUpperCase();
            if (val === 'HAWK') {
                amountEl.textContent = 'FREE ($0.00)';
                amountEl.className = 'pricing-amount is-free';
                pillEl.className = 'discount-status-pill free';
                textEl.textContent = 'Cheat code HAWK applied — 100% Free Team Access!';
                submitBtnEl.textContent = `${baseLabel} (FREE with HAWK) →`;
            } else if (val !== '') {
                const matchedTeam = state.teams.find(t => (t.cheat_code || 'HAWK').toUpperCase() === val);
                if (matchedTeam) {
                    amountEl.textContent = 'FREE ($0.00)';
                    amountEl.className = 'pricing-amount is-free';
                    pillEl.className = 'discount-status-pill free';
                    textEl.textContent = `Team ${matchedTeam.name} cheat code applied — FREE!`;
                    submitBtnEl.textContent = `${baseLabel} (FREE with Code) →`;
                } else {
                    amountEl.textContent = '$1.00 USD';
                    amountEl.className = 'pricing-amount';
                    pillEl.className = 'discount-status-pill standard';
                    textEl.textContent = 'Code not recognized — Standard Account Fee: $1.00';
                    submitBtnEl.textContent = `Pay $1.00 & ${baseLabel} →`;
                }
            } else {
                amountEl.textContent = '$1.00 USD';
                amountEl.className = 'pricing-amount';
                pillEl.className = 'discount-status-pill standard';
                textEl.textContent = 'Standard Account Fee: $1.00 (or enter cheat code HAWK)';
                submitBtnEl.textContent = `Pay $1.00 & ${baseLabel} →`;
            }
        }
        inputEl.addEventListener('input', update);
        update();
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

    function isOwn() {
        return Boolean(state.userId && state.viewId === state.userId);
    }

    function isTeamView() {
        return state.viewId === 'team';
    }

    function viewedName() {
        if (isTeamView()) return `Team ${state.currentUser?.team_name ?? ''}`;
        return state.users.find(u => u.id === state.viewId)?.collector_name ?? (state.currentUser?.collector_name || 'Bronzo');
    }

    async function loadCards() {
        const params = { series: state.series || '2026-27' };
        if (state.viewId === 'team') {
            params.user_id = 'team';
        } else if (state.viewId) {
            params.user_id = state.viewId;
        }
        state.cards = await api('get_cards', params);
        render();
        renderViewSelect();
        loadTeamSummary();
    }

    function matchesFilter(card) {
        switch (state.filter) {
            case 'missing':
                return card.quantity == 0;
            case 'doubles':
                return card.quantity >= 2;
            case 'trade':
                if (isOwn()) {
                    return card.quantity >= 2 || (card.quantity == 0 && (card.doubles_by.length > 0 || (card.team_doubles_by && card.team_doubles_by.length > 0)));
                } else if (isTeamView()) {
                    return card.doubles_by.length > 0;
                } else {
                    return card.quantity >= 2 && (!state.userId || card.my_quantity == 0);
                }
            case 'team_needs':
                return (card.team_has === 0 || (isTeamView() && card.quantity == 0));
            default:
                return true;
        }
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
                    // Needed card: subtle red/crimson tick
                    ctx.fillStyle = 'rgba(239, 68, 68, 0.45)';
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
                    // Doubles (2x+): taller golden amber bar with yellow peak
                    const barH = 42;
                    const grad = ctx.createLinearGradient(0, h - barH, 0, h);
                    grad.addColorStop(0, '#fbbf24');
                    grad.addColorStop(1, '#d97706');
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

        // Sports Channel News Feed Ticker
        const tickerTrack = document.getElementById('tickerTrack');
        if (tickerTrack) {
            const seriesName = state.series === '2025-26' ? '2025-26 Tim Hortons' : '2026-27 UD Tim Hortons';
            const userTitle = isOwn() ? (state.currentUser?.collector_name || 'My Collection') : viewedName();
            const teamName = state.currentUser?.team_name || 'Hawks';

            const headlines = [
                `🏒 [SET HIGHLIGHT] ${userTitle}: ${have} of ${total} cards secured in ${seriesName}`,
                `🔁 [TRADE DESK] ${doublesCount} active doubles ready for trading`,
                `👥 [TEAM ${teamName.toUpperCase()}] Team tracking active across the roster`,
                `⚡ [CHECKLIST WATCH] ${need > 0 ? need + ' cards needed to complete full set' : 'FULL SET COLLECTED!'}`,
                `💡 [PRO TIP] Push & hold any card for Wikipedia bio · Click twice for double/triple`
            ];

            tickerTrack.innerHTML = headlines.map(h => `<span class="ticker-item">${esc(h)}</span>`).join('');
        }
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

    function render() {
        const container = document.getElementById('cardsContainer');
        const sets = new Map();
        for (const card of state.cards) {
            if (!sets.has(card.set_name)) sets.set(card.set_name, []);
            sets.get(card.set_name).push(card);
        }

        updateVUMeterAndHighlights();
        renderSeriesNav(sets);
        container.classList.toggle('readonly', !isOwn());

        let html = '';
        if (isTeamView()) {
            html += `<div class="notice team-notice">
                👥 <strong>Team ${esc(state.currentUser?.team_name ?? '')} Combined Progress</strong>.
                Cards marked with ✓ are owned by at least one teammate. Team members only see cards within their own team!
            </div>`;
        } else if (!isOwn()) {
            const isGuest = !state.userId;
            html += `<div class="notice">
                Viewing <strong>${esc(viewedName())}</strong>'s collection (read-only).
                ${isGuest ? 'Browse the complete 3×3 hockey card binder sheets openly! <a href="./" style="font-weight:700; color:#0284c7; text-decoration:underline;">Sign In</a> or click + Collector to track your own cards.' : (state.userId ? 'Cards marked <span class="need">NEED</span> are their doubles you\'re missing.' : '')}
            </div>`;
        }

        const isPageLayout = state.layout === 'page';

        for (const [setName, cards] of sets) {
            const visible = cards.filter(matchesFilter);
            if (!visible.length && state.filter !== 'all') continue;

            const have = cards.filter(c => c.quantity > 0).length;
            const setPct = Math.round(have / cards.length * 100);
            const open = state.collapsed.has(setName) ? '' : ' open';
            const cleanId = cleanSetId(setName);

            let gridContent = '';
            if (isPageLayout) {
                // 3x3 Binder Page Sheets: 9 cards per sheet (Pos 1 to 9)
                const totalPages = Math.ceil(cards.length / 9) || 1;
                const pages = [];

                for (let pIdx = 0; pIdx < totalPages; pIdx++) {
                    const slice = cards.slice(pIdx * 9, (pIdx + 1) * 9);
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
                    if (state.filter === 'all' || hasMatching) {
                        pages.push({ pageNum: pIdx + 1, pockets: pagePockets });
                    }
                }

                gridContent = pages.map(p => renderBinderPage(p.pockets, p.pageNum, totalPages, setName)).join('');
            } else {
                // List Mode: column groups
                const groups = [];
                cards.forEach((card, i) => {
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

    function renderPageCard(card, pos) {
        const isTeam = isTeamView();
        const isCollected = card.quantity >= 1;
        const isDoubles = card.quantity >= 2;
        const cls = isDoubles ? 'doubles' : isCollected ? 'collected' : 'missing';

        const teamTraders = card.team_doubles_by ?? [];
        const otherTraders = card.doubles_by ?? [];
        const traders = teamTraders.length > 0 ? teamTraders : otherTraders;
        const holders = card.holders ?? [];

        let tooltipParts = [card.player_name];
        if (card.card_number) tooltipParts.push(`Card #${card.card_number}`);
        if (card.last_checked) tooltipParts.push(`Checked: ${card.last_checked}`);
        if (holders.length > 0) tooltipParts.push(`Teammates with copies: ${holders.join(', ')}`);
        if (teamTraders.length > 0) tooltipParts.push(`Teammate doubles: ${teamTraders.join(', ')}`);
        else if (otherTraders.length > 0) tooltipParts.push(`Doubles: ${otherTraders.join(', ')}`);
        tooltipParts.push('💡 Push & hold for Wikipedia bio');

        let badgeText = '';
        let badgeClass = 'card-status-badge';
        if (isDoubles) {
            badgeText = `${card.quantity}x`;
        } else if (isCollected) {
            badgeText = '✓ Owned';
        } else {
            badgeText = 'Missing';
            badgeClass += ' missing';
        }

        let tradePill = '';
        if (isOwn()) {
            if (teamTraders.length > 0) {
                tradePill = `<span class="trade team-trade" title="Teammates with doubles: ${esc(teamTraders.join(', '))}">⇄ ${teamTraders.length}</span>`;
            } else if (otherTraders.length > 0) {
                tradePill = `<span class="trade" title="Doubles: ${esc(otherTraders.join(', '))}">⇄ ${otherTraders.length}</span>`;
            }
        } else if (!isTeam && state.userId && card.quantity >= 2 && card.my_quantity == 0) {
            tradePill = `<span class="need">NEED</span>`;
        }

        return `<div class="card page-card ${cls}" data-id="${card.id}" data-player="${esc(card.player_name)}" title="${esc(tooltipParts.join('\n'))}">
            <div class="card-head">
                <span class="card-num-tag">#${esc(card.card_number)}</span>
            </div>
            <div class="card-body">
                <div class="card-player-title">${esc(card.player_name)}</div>
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

        const teamTraders = card.team_doubles_by ?? [];
        const otherTraders = card.doubles_by ?? [];
        const traders = teamTraders.length > 0 ? teamTraders : otherTraders;
        const holders = card.holders ?? [];

        let tooltipParts = [card.player_name];
        if (card.last_checked) tooltipParts.push(`Checked: ${card.last_checked}`);
        if (holders.length > 0) tooltipParts.push(`Teammates with copies: ${holders.join(', ')}`);
        if (teamTraders.length > 0) tooltipParts.push(`Teammate doubles: ${teamTraders.join(', ')}`);
        else if (otherTraders.length > 0) tooltipParts.push(`Doubles: ${otherTraders.join(', ')}`);
        tooltipParts.push('💡 Push & hold for Wikipedia bio');

        let html = `<div class="card ${cls}" data-id="${card.id}" data-player="${esc(card.player_name)}" title="${esc(tooltipParts.join('\n'))}">
            <span class="num">${esc(card.card_number)}</span>
            <span class="name">${esc(card.player_name)}</span>`;

        if (isOwn()) {
            if (teamTraders.length > 0) {
                html += `<span class="trade team-trade" title="Teammates with doubles: ${esc(teamTraders.join(', '))}">⇄ ${teamTraders.length}</span>`;
            } else if (otherTraders.length > 0) {
                html += `<span class="trade" title="Doubles: ${esc(otherTraders.join(', '))}">⇄ ${otherTraders.length}</span>`;
            }
        } else if (!isTeam && state.userId && card.quantity >= 2 && card.my_quantity == 0) {
            html += `<span class="need">NEED</span>`;
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
            showLoginGate();
            return;
        }
        if (!isOwn()) {
            if (isTeamView()) {
                toast("Switch Viewing to 'My collection' to edit your cards");
            } else {
                toast(`This is ${viewedName()}'s collection — switch Viewing to 'My collection' to edit`);
            }
            return;
        }
        let data;
        try {
            data = await api('set_card_quantity', {}, { card_id: cardId, quantity: quantity });
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
        const teamSelect = document.getElementById('newCollectorTeamSelect').value;
        const newTeamName = document.getElementById('newCollectorNewTeamName').value.trim();
        const pass = document.getElementById('newCollectorPass').value.trim();
        const discountCode = document.getElementById('newCollectorDiscountCode').value.trim();
        const errorEl = document.getElementById('newCollectorError');
        errorEl.textContent = '';

        const finalTeam = teamSelect === '__new__' ? newTeamName : teamSelect;
        const isFreeCheat = discountCode.toUpperCase() === 'HAWK' || pass.toUpperCase() === 'HAWK';

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
            toast(isFreeCheat ? `Created collector ${name}! Free with HAWK discount.` : `Created collector ${name}! ($1.00 fee processed)`);
        } catch (err) {
            errorEl.textContent = err.message;
        }
    });

    // Layout Switcher
    function setLayout(newLayout) {
        state.layout = newLayout;
        try { localStorage.setItem('cards_layout', newLayout); } catch (e) {}
        document.querySelectorAll('.layout-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.layout === newLayout);
        });
        render();
    }

    document.querySelectorAll('.layout-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            setLayout(btn.dataset.layout);
        });
    });

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

        titleEl.textContent = card.player_name;
        subtitleEl.textContent = card.card_number ? `Card #${card.card_number} • ${card.set_name || 'Tim Hortons'}` : 'Wikipedia NHL Bio';
        fullLink.href = `https://en.wikipedia.org/wiki/Special:Search?search=${encodeURIComponent(card.player_name)}`;
        contentEl.innerHTML = `
            <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; padding:32px 16px; gap:12px; color:var(--muted);">
                <div style="font-size:2.4rem;">🏒</div>
                <div>Loading Wikipedia biography for <strong>${esc(card.player_name)}</strong>...</div>
            </div>
        `;

        wikiDialog.showModal();

        try {
            const data = await api('wiki_player', { name: card.player_name });
            if (data && data.wiki_url) fullLink.href = data.wiki_url;

            let imgHtml = '';
            if (data && data.thumbnail) {
                imgHtml = `<img src="${esc(data.thumbnail)}" alt="${esc(data.title || card.player_name)}" class="wiki-player-img" loading="lazy">`;
            } else {
                imgHtml = `<div class="wiki-player-img" style="display:flex; align-items:center; justify-content:center; font-size:2.2rem; color:#94a3b8;">🏒</div>`;
            }

            const desc = (data && data.description) ? `<div class="wiki-player-desc">${esc(data.description)}</div>` : '';
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
            if (card) {
                openWikipediaModal(card);
            }
        }, 460);
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

        if (!state.userId) {
            showLoginGate();
            return;
        }
        if (!isOwn()) {
            if (isTeamView()) {
                toast("Switch Viewing to 'My collection' to edit your cards");
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
                    setDetails.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
                    targetEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    targetEl.classList.add('jump-highlight');
                    setTimeout(() => targetEl.classList.remove('jump-highlight'), 1600);
                }
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

    document.getElementById('editTeamBtn').addEventListener('click', openTeamDialog);
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

    // Initial check
    checkAuthAndInit();
</script>

</body>
</html>
