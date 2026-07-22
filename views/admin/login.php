<div class="login-premium-container fade-in">
    <div style="margin-bottom: 30px;">
        <div style="width: 60px; height: 60px; background: rgba(0, 194, 68, 0.1); border-radius: 18px; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#00C244" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h1 style="font-size: 24px; font-weight: 700; margin-bottom: 8px;">Admin Portal</h1>
        <p style="color: var(--gray-text); font-size: 14px;">Secure Authentication Required</p>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="color: #ff3b30; background: rgba(255, 59, 48, 0.1); padding: 12px; border-radius: 12px; margin-bottom: 24px; font-size: 13px; font-weight: 600;">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/admin/auth" method="POST">
        <div style="text-align: left; margin-bottom: 5px;">
            <label style="font-size: 12px; color: var(--gray-text); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-left: 5px;">Username</label>
        </div>
        <input type="text" name="username" class="input-premium" placeholder="Enter username" required>

        <div style="text-align: left; margin-bottom: 5px;">
            <label style="font-size: 12px; color: var(--gray-text); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-left: 5px;">Password</label>
        </div>
        <input type="password" name="password" class="input-premium" placeholder="••••••••" required>

        <button type="submit" class="btn-pay" style="width: 100%; border-radius: 14px; margin-top: 10px;">
            Sign In
        </button>
    </form>
    
    <div style="margin-top: 30px; font-size: 12px; color: var(--gray-text); opacity: 0.5;">
        &copy; <?= date('Y') ?> Secure Payment Gateway Admin
    </div>
</div>
