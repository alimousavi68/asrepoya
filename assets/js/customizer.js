/**
 * Asrepoya Theme Customizer Live Preview
 *
 * @package Asrepoya
 */

( function( $ ) {
    'use strict';

    // Site title and description.
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a' ).text( to );
        } );
    } );
    
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).text( to );
        } );
    } );

    // Header text color.
    wp.customize( 'header_textcolor', function( value ) {
        value.bind( function( to ) {
            if ( 'blank' === to ) {
                $( '.site-title, .site-description' ).css( {
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                } );
            } else {
                $( '.site-title, .site-description' ).css( {
                    'clip': 'auto',
                    'position': 'relative'
                } );
                $( '.site-title a, .site-description' ).css( {
                    'color': to
                } );
            }
        } );
    } );

    // Footer Contact Information
    wp.customize( 'asrepoya_about_us', function( value ) {
        value.bind( function( to ) {
            $( '.footer-about-us' ).text( to );
        } );
    } );

    // Phone Numbers
    for ( var i = 1; i <= 4; i++ ) {
        ( function( index ) {
            wp.customize( 'asrepoya_phone_' + index, function( value ) {
                value.bind( function( to ) {
                    var phoneElement = $( '.footer-phone-' + index );
                    if ( to ) {
                        phoneElement.text( to ).show();
                    } else {
                        phoneElement.hide();
                    }
                } );
            } );
        } )( i );
    }

    // Email
    wp.customize( 'asrepoya_email', function( value ) {
        value.bind( function( to ) {
            var emailElement = $( '.footer-email' );
            if ( to ) {
                emailElement.text( to ).attr( 'href', 'mailto:' + to ).show();
            } else {
                emailElement.hide();
            }
        } );
    } );

    // Addresses
    for ( var i = 1; i <= 2; i++ ) {
        ( function( index ) {
            wp.customize( 'asrepoya_address_' + index, function( value ) {
                value.bind( function( to ) {
                    var addressElement = $( '.footer-address-' + index );
                    if ( to ) {
                        addressElement.html( to ).show();
                    } else {
                        addressElement.hide();
                    }
                } );
            } );
        } )( i );
    }

    // Copyright Text
    wp.customize( 'asrepoya_copyright_text', function( value ) {
        value.bind( function( to ) {
            $( '.footer-copyright' ).html( to );
        } );
    } );

    // Social Media Links
    for ( var i = 1; i <= 10; i++ ) {
        ( function( index ) {
            // Social Media Icon
            wp.customize( 'asrepoya_social_icon_' + index, function( value ) {
                value.bind( function( to ) {
                    var socialItem = $( '.footer-social-' + index );
                    var link = wp.customize.value( 'asrepoya_social_link_' + index )();
                    
                    if ( to && link ) {
                        if ( socialItem.length === 0 ) {
                            $( '.footer-social-media' ).append( 
                                '<a href="' + link + '" class="footer-social-' + index + '" target="_blank" rel="noopener"></a>' 
                            );
                            socialItem = $( '.footer-social-' + index );
                        }
                        
                        // Get the attachment URL
                        wp.media.attachment( to ).fetch().then( function() {
                            var attachment = wp.media.attachment( to );
                            var iconUrl = attachment.get( 'url' );
                            socialItem.html( '<img src="' + iconUrl + '" alt="Social Media Icon" class="social-icon">' ).show();
                        } );
                    } else if ( !link ) {
                        socialItem.hide();
                    }
                } );
            } );

            // Social Media Link
            wp.customize( 'asrepoya_social_link_' + index, function( value ) {
                value.bind( function( to ) {
                    var socialItem = $( '.footer-social-' + index );
                    var icon = wp.customize.value( 'asrepoya_social_icon_' + index )();
                    
                    if ( to && icon ) {
                        if ( socialItem.length === 0 ) {
                            $( '.footer-social-media' ).append( 
                                '<a href="' + to + '" class="footer-social-' + index + '" target="_blank" rel="noopener"></a>' 
                            );
                            socialItem = $( '.footer-social-' + index );
                            
                            // Get the attachment URL for icon
                            wp.media.attachment( icon ).fetch().then( function() {
                                var attachment = wp.media.attachment( icon );
                                var iconUrl = attachment.get( 'url' );
                                socialItem.html( '<img src="' + iconUrl + '" alt="Social Media Icon" class="social-icon">' );
                            } );
                        } else {
                            socialItem.attr( 'href', to ).show();
                        }
                    } else if ( !icon ) {
                        socialItem.hide();
                    }
                } );
            } );
        } )( i );
    }

} )( jQuery );