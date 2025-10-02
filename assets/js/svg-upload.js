/**
 * SVG Upload Control for Asrepoya Theme Customizer
 *
 * @package Asrepoya
 */

( function( $ ) {
    'use strict';

    // Extend the media control to handle SVG files
    wp.customize.controlConstructor.svg_upload = wp.customize.MediaControl.extend( {
        ready: function() {
            var control = this;
            
            // Call parent ready method
            wp.customize.MediaControl.prototype.ready.call( this );
            
            // Override the media frame options to allow SVG files
            this.params.mime_type = 'image/svg+xml';
            
            // Custom validation for SVG files
            this.container.on( 'click', '.upload-button', function( e ) {
                e.preventDefault();
                
                // Create media frame
                var frame = wp.media( {
                    title: 'انتخاب فایل SVG',
                    button: {
                        text: 'انتخاب'
                    },
                    library: {
                        type: 'image/svg+xml'
                    },
                    multiple: false
                } );
                
                // When an image is selected
                frame.on( 'select', function() {
                    var attachment = frame.state().get( 'selection' ).first().toJSON();
                    
                    // Validate file type
                    if ( attachment.mime === 'image/svg+xml' || attachment.subtype === 'svg+xml' ) {
                        control.setting.set( attachment.id );
                        control.renderContent();
                    } else {
                        alert( 'لطفاً فقط فایل‌های SVG انتخاب کنید.' );
                    }
                } );
                
                frame.open();
            } );
        },
        
        renderContent: function() {
            var control = this;
            var value = this.setting.get();
            
            if ( value ) {
                // Get attachment data
                wp.media.attachment( value ).fetch().then( function() {
                    var attachment = wp.media.attachment( value );
                    var template = control.container.find( '.customize-media-control-content' );
                    
                    if ( attachment.get( 'mime' ) === 'image/svg+xml' ) {
                        template.find( '.thumbnail-image' ).html( 
                            '<img src="' + attachment.get( 'url' ) + '" alt="SVG Preview" style="max-width: 100px; max-height: 100px;">' 
                        );
                        template.find( '.actions .remove' ).show();
                    }
                } );
            }
        }
    } );

    // Allow SVG uploads in WordPress media library
    $( document ).ready( function() {
        // Add SVG support message
        if ( typeof wp !== 'undefined' && wp.customize ) {
            wp.customize.bind( 'ready', function() {
                // Add notice about SVG support
                $( '.customize-control-svg_upload' ).each( function() {
                    var $control = $( this );
                    if ( !$control.find( '.svg-notice' ).length ) {
                        $control.find( '.customize-control-description' ).after( 
                            '<p class="svg-notice" style="font-size: 12px; color: #666; margin-top: 5px;">' +
                            'توجه: فقط فایل‌های SVG پذیرفته می‌شوند.' +
                            '</p>'
                        );
                    }
                } );
            } );
        }
    } );

} )( jQuery );