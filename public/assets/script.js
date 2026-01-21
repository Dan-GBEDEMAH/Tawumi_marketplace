$(document).ready(function() {

    // =========================================
    // 1. INITIALISATION DES SLIDERS (CAROUSELS)
    // =========================================
    
    // Slider des catégories (petites icônes rondes)
    // Commenté pour garder l'affichage statique en cercles
    // if($('.item-slider').length) {
    //     $('.item-slider').slick({
    //         dots: false,
    //         infinite: true,
    //         arrows: false,
    //         speed: 300,
    //         slidesToShow: 6, // Ajusté pour être joli
    //         slidesToScroll: 1,
    //         autoplay: true,
    //         autoplaySpeed: 3000,
    //         responsive: [
    //             { breakpoint: 1024, settings: { slidesToShow: 4, slidesToScroll: 1 } },
    //             { breakpoint: 600, settings: { slidesToShow: 3, slidesToScroll: 1 } },
    //             { breakpoint: 480, settings: { slidesToShow: 2, slidesToScroll: 1 } }
    //         ]
    //     });
    // }

    // Slider des produits mis en avant (Index) - seulement s'il y a plus de 4 produits
    if($('.product-slider').length && $('.product-slider .col-md-3').length > 4) {
        $('.product-slider').slick({
            dots: false,
            infinite: true,
            arrows: false,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 3 } },
                { breakpoint: 768, settings: { slidesToShow: 2 } },
                { breakpoint: 480, settings: { slidesToShow: 1 } }
            ]
        });
    }

    // Deuxième slider de produits (Nouveautés)
    if($('.product-slider-2').length) {
        $('.product-slider-2').slick({
            dots: false,
            infinite: true,
            arrows: false,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 3 } },
                { breakpoint: 768, settings: { slidesToShow: 2 } },
                { breakpoint: 480, settings: { slidesToShow: 1 } }
            ]
        });
    }

// =========================================
// 2. MODAL / POPUP NEWSLETTER (Supprimé)
// =========================================



    // =========================================
    // 3. COMPTE À REBOURS (OFFRES)
    // =========================================
    
    function updateTimers() {
        console.log('updateTimers function called');
        
        // Handle offer cards (existing functionality)
        $('.offer-card').each(function() {
            const timerBox = $(this).find('.timer-flex');
            
            // Si cette carte a un minuteur
            if(timerBox.length > 0) {
                console.log('Found offer card timer');
                // Récupérer les valeurs actuelles
                let daysSpan = timerBox.find('.timer-box').eq(0).find('.timer-value');
                let hoursSpan = timerBox.find('.timer-box').eq(1).find('.timer-value');
                let minsSpan = timerBox.find('.timer-box').eq(2).find('.timer-value');
                let secsSpan = timerBox.find('.timer-box').eq(3).find('.timer-value');

                let d = parseInt(daysSpan.text());
                let h = parseInt(hoursSpan.text());
                let m = parseInt(minsSpan.text());
                let s = parseInt(secsSpan.text());

                // Logique de décompte simple
                s--;
                if(s < 0) {
                    s = 59;
                    m--;
                    if(m < 0) {
                        m = 59;
                        h--;
                        if(h < 0) {
                            h = 23;
                            d--;
                            if(d < 0) d = 0; // Fin du temps
                        }
                    }
                }

                // Mise à jour de l'affichage avec le zéro devant (05 au lieu de 5)
                daysSpan.text(d < 10 ? '0' + d : d);
                hoursSpan.text(h < 10 ? '0' + h : h);
                minsSpan.text(m < 10 ? '0' + m : m);
                secsSpan.text(s < 10 ? '0' + s : s);
            }
        });

        // Handle product timers on index page - FIXED VERSION WITH SLICK CLONE HANDLING
        $('.product-timer:not(.slick-cloned)').each(function(index) {
            const timerContainer = $(this);
            const timerFlex = timerContainer.find('.timer-flex ul');
            
            // Skip if this is a slick cloned element
            if(timerContainer.hasClass('slick-cloned')) {
                console.log('Skipping cloned timer #' + (index + 1));
                return;
            }
            
            if(timerFlex.length > 0) {
                console.log('Processing timer #' + (index + 1));
                
                try {
                    // Get all li elements
                    const timerItems = timerFlex.find('li');
                    
                    if(timerItems.length >= 4) {
                        const daysLi = timerItems.eq(0);
                        const hoursLi = timerItems.eq(1);
                        const minsLi = timerItems.eq(2);
                        const secsLi = timerItems.eq(3);
                        
                        // Extract current values more reliably
                        const daysText = daysLi.clone().children().remove().end().text().trim();
                        const hoursText = hoursLi.clone().children().remove().end().text().trim();
                        const minsText = minsLi.clone().children().remove().end().text().trim();
                        const secsText = secsLi.clone().children().remove().end().text().trim();
                        
                        console.log('Raw timer values:', daysText, hoursText, minsText, secsText);
                        
                        // Parse integers
                        let d = parseInt(daysText) || 0;
                        let h = parseInt(hoursText) || 0;
                        let m = parseInt(minsText) || 0;
                        let s = parseInt(secsText) || 0;
                        
                        console.log('Parsed timer values:', d, h, m, s);
                        
                        // Countdown logic
                        s--;
                        if(s < 0) {
                            s = 59;
                            m--;
                            if(m < 0) {
                                m = 59;
                                h--;
                                if(h < 0) {
                                    h = 23;
                                    d--;
                                    if(d < 0) d = 0;
                                }
                            }
                        }
                        
                        // Update display with proper formatting
                        daysLi.html(d.toString().padStart(2, '0') + ' <span>JOURS</span>');
                        hoursLi.html(h.toString().padStart(2, '0') + ' <span>HRS</span>');
                        minsLi.html(m.toString().padStart(2, '0') + ' <span>MIN</span>');
                        secsLi.html(s.toString().padStart(2, '0') + ' <span>SEC</span>');
                        
                        console.log('Timer updated successfully');
                    }
                } catch(error) {
                    console.error('Error processing timer #' + (index + 1) + ':', error);
                }
            }
        });
    }

    // Lancer le minuteur toutes les secondes
    console.log('Setting up timer interval');
    const timerInterval = setInterval(updateTimers, 1000);
    console.log('Timer interval ID:', timerInterval);


    // =========================================
    // 4. FILTRES DES OFFRES (Page Offres)
    // =========================================
    
    $('.category-btn').on('click', function() {
        // Gestion de la classe active
        $('.category-btn').removeClass('active');
        $(this).addClass('active');
        
        const filter = $(this).text().trim().toLowerCase();
        
        // Logique de filtrage
        $('.offer-card').parent().each(function() { // .parent() car la card est dans une col-bootstrap
            const badge = $(this).find('.offer-badge').text().toLowerCase();
            const title = $(this).find('h3').text().toLowerCase();
            
            if (filter === 'toutes les offres') {
                $(this).fadeIn();
            } else if (filter === 'réductions' && badge.includes('%')) {
                $(this).fadeIn();
            } else if (filter === 'produits gratuits' && (badge.includes('gratuit') || title.includes('gratuit'))) {
                $(this).fadeIn();
            } else if (filter === 'offres limitées' && badge.includes('limité')) {
                $(this).fadeIn();
            } else if (filter === 'week-end' && title.includes('week-end')) {
                $(this).fadeIn();
            } else {
                $(this).hide();
            }
        });
    });


    // =========================================
    // 5. FORMULAIRE DE CONTACT
    // =========================================
    
    $('form.contact-form').on('submit', function(e) {
        // Ne cible que le formulaire de contact spécifique
        e.preventDefault();
        
        const name = $('#name').val();
        const email = $('#email').val();
        const message = $('#message').val();
        
        if(name && email && message) {
            alert('Merci ' + name + '! Votre message a été envoyé avec succès.');
            $(this)[0].reset();
        } else {
            alert('Veuillez remplir les champs obligatoires.');
        }
    });

    // =========================================
    // 6. DÉFILEMENT FLUIDE (SMOOTH SCROLL)
    // =========================================
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $($(this).attr('href'));
        if(target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 800);
        }
    });

});

// =========================================
// 7. FONCTION "LIRE LA SUITE" (BLOG)
// =========================================
// Cette fonction doit être en dehors du $(document).ready pour être accessible par le onclick="" du HTML

function toggleContent(contentId) {
    const content = document.getElementById(contentId);
    const link = content.previousElementSibling; // Le lien <a> juste avant
    
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block'; // Afficher
        // Changer le texte du bouton
        link.innerHTML = 'Lire moins <i class="fa fa-arrow-up"></i>';
    } else {
        content.style.display = 'none'; // Cacher
        link.innerHTML = 'Lire la suite <i class="fa fa-arrow-right"></i>';
    }
}
