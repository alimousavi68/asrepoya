/**
 * Main JavaScript file for Asrepoya Theme
 */

(function($) {
    'use strict';

    /**
     * Document ready function
     */
    $(document).ready(function() {
        
        /**
         * Mobile menu toggle
         */
        $('.menu-toggle').on('click', function() {
            $(this).toggleClass('active');
            $('.main-navigation').toggleClass('toggled');
        });

        /**
         * Smooth scroll for anchor links
         */
        $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function(event) {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            }
        });

        /**
         * Back to top button
         */
        var $backToTop = $('.back-to-top');
        
        if ($backToTop.length) {
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 300) {
                    $backToTop.addClass('show');
                } else {
                    $backToTop.removeClass('show');
                }
            });

            $backToTop.on('click', function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        }

        /**
         * Search toggle
         */
        $('.search-toggle').on('click', function() {
            $('.search-form-container').toggleClass('active');
            if ($('.search-form-container').hasClass('active')) {
                $('.search-form-container input[type="search"]').focus();
            }
        });

        /**
         * Close search when clicking outside
         */
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.search-form-container, .search-toggle').length) {
                $('.search-form-container').removeClass('active');
            }
        });

        /**
         * Responsive tables
         */
        $('table').wrap('<div class="table-wrapper"></div>');

        /**
         * Image lazy loading
         */
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                }
            });
        } else {
            // Fallback for browsers that don't support lazy loading
            const script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
            document.body.appendChild(script);
        }

        /**
         * Add loading class to images
         */
        $('img').on('load', function() {
            $(this).addClass('loaded');
        }).each(function() {
            if (this.complete) {
                $(this).addClass('loaded');
            }
        });

        /**
         * Inline Comment Reply Functionality
         */
        function initInlineCommentReply() {
            // Store original form location
            var originalForm = $('#respond');
            var originalParent = originalForm.parent();
            
            // Handle reply link clicks
            $(document).on('click', '.comment-reply-link', function(e) {
                e.preventDefault();
                
                // Get data from parent span or the link itself
                var $parent = $(this).parent('span');
                var commentId = $parent.attr('data-commentid') || $(this).attr('data-commentid');
                var postId = $parent.attr('data-postid') || $(this).attr('data-postid');
                var belowelement = $parent.attr('data-belowelement') || $(this).attr('data-belowelement');
                
                // Extract comment ID from href as fallback
                if (!commentId) {
                    var href = $(this).attr('href');
                    var match = href.match(/replytocom=(\d+)/);
                    if (match) {
                        commentId = match[1];
                    }
                }
                
                // Get post ID from form if not available
                if (!postId) {
                    postId = $('#comment_post_ID').val();
                }
                
                if (!commentId) {
                    console.log('Comment ID not found, falling back to default behavior');
                    return true; // Let WordPress handle it
                }
                
                // Hide all other reply forms first
                $('.inline-reply-form').hide();
                $('.inline-reply-form').empty();
                
                // Move form back to original location first (in case it was moved)
                if (originalForm.parent().hasClass('inline-reply-form')) {
                    originalForm.appendTo(originalParent);
                }
                
                // Move form to inline position
                var targetContainer = $('#reply-form-' + commentId);
                if (targetContainer.length) {
                    // Clone the form to avoid moving issues
                    var formClone = originalForm.clone(true);
                    
                    // Move the original form
                    originalForm.appendTo(targetContainer);
                    targetContainer.show();
                    
                    // Update form fields
                    $('#comment_parent').val(commentId);
                    if (postId) {
                        $('#comment_post_ID').val(postId);
                    }
                    
                    // Update cancel link
                    var cancelLink = $('#cancel-comment-reply-link');
                    if (cancelLink.length) {
                        cancelLink.show();
                        cancelLink.text('لغو پاسخ');
                    }
                    
                    // Clear the comment text
                    $('#comment').val('');
                    
                    // Focus on comment textarea
                    setTimeout(function() {
                        $('#comment').focus();
                    }, 100);
                    
                    // Scroll to the reply form
                    $('html, body').animate({
                        scrollTop: targetContainer.offset().top - 100
                    }, 500);
                } else {
                    console.log('Target container not found: #reply-form-' + commentId);
                }
            });
            
            // Handle cancel reply
            $(document).on('click', '#cancel-comment-reply-link', function(e) {
                e.preventDefault();
                
                // Hide all inline reply forms
                $('.inline-reply-form').hide();
                $('.inline-reply-form').empty();
                
                // Move form back to original location
                originalForm.appendTo(originalParent);
                
                // Reset form fields
                $('#comment_parent').val('0');
                $('#comment').val('');
                
                // Hide cancel link
                $(this).hide();
                
                // Scroll back to main form
                $('html, body').animate({
                    scrollTop: originalForm.offset().top - 100
                }, 500);
            });
        }
        
        // Initialize inline comment reply
        initInlineCommentReply();

    });

    /**
     * Window load function
     */
    $(window).on('load', function() {
        
        /**
         * Add loaded class to body
         */
        $('body').addClass('loaded');

        /**
         * Preloader
         */
        $('.preloader').fadeOut(300, function() {
            $(this).remove();
        });

    });

    /**
     * Window resize function
     */
    $(window).on('resize', function() {
        
        /**
         * Reset mobile menu on desktop
         */
        if ($(window).width() > 768) {
            $('.menu-toggle').removeClass('active');
            $('.main-navigation').removeClass('toggled');
        }

    });

})(jQuery);