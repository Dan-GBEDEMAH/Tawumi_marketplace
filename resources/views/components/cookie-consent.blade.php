<div id="cookieConsent" class="cookie-consent-banner">
    <div class="cookie-content">
        <div class="cookie-text">
            <p>Ce site utilise des cookies pour améliorer votre expérience. <a href="{{ route('privacy.policy') }}" target="_blank">En savoir plus</a></p>
        </div>
        <div class="cookie-buttons">
            <button id="acceptCookies" class="btn-accept">J'ai compris</button>
        </div>
    </div>
</div>

<style>
.cookie-consent-banner {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    z-index: 9999;
    transform: translateX(120%);
    transition: transform 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 350px;
}

.cookie-consent-banner.show {
    transform: translateX(0);
}

.cookie-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}

.cookie-text {
    flex: 1;
    min-width: 200px;
}

.cookie-text h4 {
    color: #28a745;
    margin: 0 0 10px 0;
    font-size: 1.2rem;
}

.cookie-text p {
    margin: 0;
    color: #666;
    font-size: 0.85rem;
    line-height: 1.3;
}

.cookie-text a {
    color: #28a745;
    text-decoration: none;
}

.cookie-text a:hover {
    text-decoration: underline;
}

.cookie-buttons {
    display: flex;
    gap: 10px;
    align-items: center;
}

.btn-accept {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.2s ease;
    background: #28a745;
    color: white;
}

.btn-accept:hover {
    background: #218838;
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .cookie-consent-banner {
        max-width: 300px;
        bottom: 10px;
        right: 10px;
        padding: 12px;
    }
    
    .cookie-content {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .cookie-text {
        min-width: unset;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cookieBanner = document.getElementById('cookieConsent');
    const acceptBtn = document.getElementById('acceptCookies');
    
    // Check if user has already made a choice
    const cookieChoice = localStorage.getItem('cookieConsent');
    
    if (!cookieChoice) {
        // Show banner after a short delay
        setTimeout(() => {
            cookieBanner.classList.add('show');
        }, 500);
    }
    
    // Accept cookies
    acceptBtn.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'accepted');
        cookieBanner.classList.remove('show');
        // Here you can initialize analytics, marketing cookies, etc.
        console.log('Cookies accepted');
    });
});
</script>