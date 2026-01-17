<div id="cookieConsent" class="cookie-consent-banner">
    <div class="cookie-content">
        <div class="cookie-text">
            <h4>Politique de Confidentialité</h4>
            <p>Nous collectons vos données personnelles (nom, email, adresse, etc.) pour traiter vos commandes et améliorer votre expérience. Nous utilisons également des cookies pour analyser le trafic et optimiser notre site. <a href="{{ route('privacy.policy') }}" target="_blank">Plus d'informations</a>.</p>
        </div>
        <div class="cookie-buttons">
            <button id="acceptCookies" class="btn-accept">Accepter</button>
            <button id="declineCookies" class="btn-decline">Refuser</button>
            <button id="closeCookieBanner" class="btn-close">×</button>
        </div>
    </div>
</div>

<style>
.cookie-consent-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-top: 1px solid #ddd;
    padding: 20px;
    z-index: 9999;
    transform: translateY(100%);
    transition: transform 0.3s ease;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
}

.cookie-consent-banner.show {
    transform: translateY(0);
}

.cookie-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 15px;
}

.cookie-text {
    flex: 1;
    min-width: 300px;
}

.cookie-text h4 {
    color: #28a745;
    margin: 0 0 10px 0;
    font-size: 1.2rem;
}

.cookie-text p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
    line-height: 1.4;
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

.btn-accept, .btn-decline, .btn-close {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-accept {
    background: #28a745;
    color: white;
}

.btn-accept:hover {
    background: #218838;
    transform: translateY(-2px);
}

.btn-decline {
    background: #dc3545;
    color: white;
}

.btn-decline:hover {
    background: #c82333;
    transform: translateY(-2px);
}

.btn-close {
    background: #6c757d;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    padding: 0;
}

.btn-close:hover {
    background: #5a6268;
    transform: scale(1.1);
}

@media (max-width: 768px) {
    .cookie-content {
        flex-direction: column;
        text-align: center;
    }
    
    .cookie-buttons {
        width: 100%;
        justify-content: center;
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
    const declineBtn = document.getElementById('declineCookies');
    const closeBtn = document.getElementById('closeCookieBanner');
    
    // Check if user has already made a choice
    const cookieChoice = localStorage.getItem('cookieConsent');
    
    if (!cookieChoice) {
        // Show banner after a short delay
        setTimeout(() => {
            cookieBanner.classList.add('show');
        }, 1000);
    }
    
    // Accept cookies
    acceptBtn.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'accepted');
        cookieBanner.classList.remove('show');
        // Here you can initialize analytics, marketing cookies, etc.
        console.log('Cookies accepted');
    });
    
    // Decline cookies
    declineBtn.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'declined');
        cookieBanner.classList.remove('show');
        // Disable non-essential cookies
        console.log('Cookies declined');
    });
    
    // Close banner (ignore)
    closeBtn.addEventListener('click', function() {
        cookieBanner.classList.remove('show');
        // User can still see the banner on next visit since no choice was made
    });
});
</script>