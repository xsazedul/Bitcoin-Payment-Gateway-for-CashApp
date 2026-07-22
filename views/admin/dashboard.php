<div class="admin-layout fade-in">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 40px; padding: 0 10px;">
            <div style="width: 32px; height: 32px; background: var(--primary-green); border-radius: 8px; display: flex; justify-content: center; align-items: center; color: black; font-weight: 800;">$</div>
            <span style="font-weight: 700; font-size: 18px; letter-spacing: -0.5px;">PayMe Admin</span>
        </div>

        <nav style="display: flex; flex-direction: column; gap: 8px;">
            <a href="<?= BASE_URL ?>/admin/dashboard" class="admin-nav-item active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Overview
            </a>
            <a href="#" class="admin-nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                Payments
            </a>
            <a href="#" class="admin-nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Users
            </a>
            <a href="#" class="admin-nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Settings
            </a>
        </nav>

        <div style="margin-top: auto; padding: 20px; background: rgba(255,255,255,0.02); border-radius: 16px;">
            <div style="font-size: 13px; font-weight: 600; margin-bottom: 4px;"><?= htmlspecialchars($_SESSION['admin_username']) ?></div>
            <div style="font-size: 11px; color: var(--gray-text); margin-bottom: 12px;">System Administrator</div>
            <a href="<?= BASE_URL ?>/admin/logout" style="font-size: 12px; color: #ff3b30; text-decoration: none; font-weight: 700;">Sign Out</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <div>
                <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 4px;">Dashboard</h1>
                <p style="color: var(--gray-text); font-size: 14px;">Welcome back! Here's what's happening today.</p>
            </div>
            <div style="display: flex; gap: 12px;">
                <button class="btn-pay" style="padding: 10px 20px; font-size: 14px; border-radius: 10px;">Download Report</button>
            </div>
        </header>

        <div class="admin-stats-grid">
            <div class="premium-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <span style="font-size: 12px; color: #00C244; font-weight: 700; background: rgba(0, 194, 68, 0.1); padding: 4px 8px; border-radius: 6px;">+12.5%</span>
                </div>
                <div style="color: var(--gray-text); font-size: 13px; font-weight: 600; margin-bottom: 4px;">Total Revenue</div>
                <div style="font-size: 28px; font-weight: 700;">$<?= number_format($stats['total_usd'], 2) ?></div>
            </div>

            <div class="premium-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background: rgba(0, 122, 255, 0.1); color: #007aff;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <span style="font-size: 12px; color: #007aff; font-weight: 700; background: rgba(0, 122, 255, 0.1); padding: 4px 8px; border-radius: 6px;">Active</span>
                </div>
                <div style="color: var(--gray-text); font-size: 13px; font-weight: 600; margin-bottom: 4px;">Total Payments</div>
                <div style="font-size: 28px; font-weight: 700;"><?= $stats['total_payments'] ?></div>
            </div>

            <div class="premium-card">
                <div class="stat-header">
                    <div class="stat-icon" style="background: rgba(255, 159, 10, 0.1); color: #ff9f0a;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                </div>
                <div style="color: var(--gray-text); font-size: 13px; font-weight: 600; margin-bottom: 4px;">Pending Invoices</div>
                <div style="font-size: 28px; font-weight: 700;"><?= $stats['pending_count'] ?></div>
            </div>
        </div>

        <div class="premium-table-container">
            <div style="padding: 24px; border-bottom: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center;">
                <h2 style="font-size: 18px; font-weight: 700;">Recent Invoices</h2>
                <a href="#" style="font-size: 13px; color: var(--primary-green); text-decoration: none; font-weight: 600;">View All</a>
            </div>
            <div style="overflow-x: auto;">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Expires</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($history as $inv): ?>
                        <tr>
                            <td style="font-family: 'JetBrains Mono', monospace; font-size: 12px; opacity: 0.8;"><?= substr($inv['invoice_id'], 0, 12) ?>...</td>
                            <td style="font-weight: 700;">$<?= number_format($inv['amount_usd'], 2) ?></td>
                            <td>
                                <span class="status-pill <?= $inv['status'] ?>">
                                    <?= ucfirst($inv['status']) ?>
                                </span>
                            </td>
                            <td style="color: var(--gray-text); font-size: 13px;"><?= date('M d, H:i', strtotime($inv['created_at'])) ?></td>
                            <td style="color: var(--gray-text); font-size: 13px;"><?= $inv['expires_at'] ? date('M d, H:i', strtotime($inv['expires_at'])) : '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
