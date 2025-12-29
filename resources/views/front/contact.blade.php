@extends('layouts.front')

@section('contentPage')


 <!-- Contact Header -->
    <section class="contact-header">
        <div class="container">
            <h1>Contactez-nous</h1>
            <p>Nous serions ravis de vous entendre</p>
        </div>
    </section>

    <!-- Contact Info & Form -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-lg-4">
                    <div class="contact-info">
                        <h3>Informations de Contact</h3>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <h4>Adresse</h4>
                                <p>123 Avenue du Commerce</p>
                                <p>Lomé, Togo</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="info-content">
                                <h4>Téléphone</h4>
                                <p>+228 79 76 80 43</p>
                                <p>+228 91 23 45 67</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <h4>Email</h4>
                                <p>tawumi@gmail.tg</p>
                                <p>gbedemahdaniel1@gmail.com</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <h4>Horaires</h4>
                                <p>Lun-Ven: 8h-20h</p>
                                <p>Sam-Dim: 9h-18h</p>
                            </div>
                        </div>
                        

                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="contact-form">
                        <h3>Envoyez-nous un Message</h3>
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nom Complet</label>
                                        <input type="text" class="form-control" id="name" placeholder="Votre nom">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Votre email">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Téléphone</label>
                                        <input type="tel" class="form-control" id="phone" placeholder="Votre téléphone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject">Sujet</label>
                                        <input type="text" class="form-control" id="subject" placeholder="Sujet du message">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="6" placeholder="Votre message"></textarea>
                            </div>
                            
                            <button type="submit" class="btn-submit">Envoyer le Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    <section class="contact-section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Nous Trouver</h2>
                <p>Visitez notre magasin</p>
            </div>
            
            <div class="map-container">
                <!-- Replace with actual map embed code -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.341!2d1.2132!3d6.1376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xeec898dd54329eb%3A0x25b3d4c27d1c2b0!2sLom%C3%A9%2C%20Togo!5e0!3m2!1sen!2stg!4v1650000000000!5m2!1sen!2stg" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Opening Hours -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="opening-hours">
                        <h3>Heures d'Ouverture</h3>
                        <div class="hours-item">
                            <span>Lundi</span>
                            <span>8h00 - 20h00</span>
                        </div>
                        <div class="hours-item">
                            <span>Mardi</span>
                            <span>8h00 - 20h00</span>
                        </div>
                        <div class="hours-item">
                            <span>Mercredi</span>
                            <span>8h00 - 20h00</span>
                        </div>
                        <div class="hours-item">
                            <span>Jeudi</span>
                            <span>8h00 - 20h00</span>
                        </div>
                        <div class="hours-item">
                            <span>Vendredi</span>
                            <span>8h00 - 20h00</span>
                        </div>
                        <div class="hours-item">
                            <span>Samedi</span>
                            <span>8h00 - 20h00</span>
                        </div>
                        <div class="hours-item">
                            <span>Dimanche</span>
                            <span>9h00 - 18h00</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="contact-info h-100">
                        <h3>Support Client</h3>
                        <p>Notre équipe de support est disponible pour vous aider du lundi au samedi de 9h à 18h.</p>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa fa-headset"></i>
                            </div>
                            <div class="info-content">
                                <h4>Service Client</h4>
                                <p>+228 79 76 80 43</p>
                                <p>tawumiconfirm@gmail.tg</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div class="info-content">
                                <h4>Livraison</h4>
                                <p>+228 79768043</p>
                                <p>tawumiconfirm@gmail.tg</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="info-content">
                                <h4>Chat en Direct</h4>
                                <p>Disponible sur le site</p>
                                <p>Lun-Sam: 9h-18h</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    

@endsection