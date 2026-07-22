<div id="screen-keypad" class="screen fade-in">
    <div class="header">
        <h1>Pay .............. </h1>
        <div class="badge-secure">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            SECURE PAYMENT
        </div>
    </div>

    <div class="method-card">
        <div class="method-icon" style="color: white;">$</div>
        <div class="method-name">Cashapp</div>
        <div class="method-status">Instant</div>
    </div>

    <div class="amount-container">
        <div class="amount-display">$<span id="display-amount">0</span></div>
        <div class="currency-label">USD</div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="color: white; background: rgba(0,0,0,0.2); padding: 10px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; text-align: center;">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <div class="keypad">
        <div class="key" onclick="appendNumber(1)">1</div>
        <div class="key" onclick="appendNumber(2)">2</div>
        <div class="key" onclick="appendNumber(3)">3</div>
        <div class="key" onclick="appendNumber(4)">4</div>
        <div class="key" onclick="appendNumber(5)">5</div>
        <div class="key" onclick="appendNumber(6)">6</div>
        <div class="key" onclick="appendNumber(7)">7</div>
        <div class="key" onclick="appendNumber(8)">8</div>
        <div class="key" onclick="appendNumber(9)">9</div>
        <div class="key" onclick="appendNumber('.')">.</div>
        <div class="key" onclick="appendNumber(0)">0</div>
        <div class="key" onclick="deleteLast()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"/><line x1="18" y1="9" x2="12" y2="15"/><line x1="12" y1="9" x2="18" y2="15"/></svg>
        </div>
    </div>

    <form id="payment-form" action="<?= BASE_URL ?>/invoice/create" method="POST" style="display: none;">
        <input type="hidden" name="amount" id="amount-input">
    </form>

    <button class="btn-pay" onclick="submitPayment()">
        <span id="pay-btn-text">Pay</span>
        <div class="loading-spinner" id="pay-loader" style="display: none;"></div>
    </button>
</div>

<script>
    let currentAmount = "0";
    const displayEl = document.getElementById('display-amount');
    const amountInput = document.getElementById('amount-input');
    const paymentForm = document.getElementById('payment-form');
    const payBtnText = document.getElementById('pay-btn-text');
    const payLoader = document.getElementById('pay-loader');

    function appendNumber(num) {
        if (currentAmount === "0" && num !== ".") {
            currentAmount = num.toString();
        } else {
            if (num === "." && currentAmount.includes(".")) return;
            if (currentAmount.includes(".")) {
                const parts = currentAmount.split(".");
                if (parts[1].length >= 2) return;
            }
            currentAmount += num.toString();
        }
        updateDisplay();
    }

    function deleteLast() {
        if (currentAmount.length > 1) {
            currentAmount = currentAmount.slice(0, -1);
        } else {
            currentAmount = "0";
        }
        updateDisplay();
    }

    function updateDisplay() {
        displayEl.textContent = currentAmount;
        amountInput.value = currentAmount;
    }

    function submitPayment() {
        const amount = parseFloat(currentAmount);
        if (isNaN(amount) || amount <= 0) {
            alert("Please enter a valid amount");
            return;
        }

        payBtnText.style.display = "none";
        payLoader.style.display = "block";
        
        setTimeout(() => {
            paymentForm.submit();
        }, 800);
    }
</script>
