<?php
/**
 * Template part for displaying custom post meta data
 * 
 * This file demonstrates how to use the i8 custom meta fields
 * 
 * @package Asrepoya
 */

// Get post ID
$post_id = get_the_ID();

// Get post type and main category
$post_type = i8_get_post_type( $post_id );
$post_type_label = i8_get_post_type_label( $post_id );
$main_category = i8_get_post_main_category( $post_id );

?>

<div class="i8-post-meta">
    <div class="post-meta-header">
        <span class="post-type-badge badge-<?php echo esc_attr( $post_type ); ?>">
            <?php echo esc_html( $post_type_label ); ?>
        </span>
        
        <?php if ( $main_category ) : ?>
            <span class="main-category">
                دسته‌بندی: <a href="<?php echo esc_url( get_category_link( $main_category->term_id ) ); ?>">
                    <?php echo esc_html( $main_category->name ); ?>
                </a>
            </span>
        <?php endif; ?>
    </div>

    <?php
    // Display conditional fields based on post type
    switch ( $post_type ) :
        case 'report':
            $pdf_url = i8_get_meta( 'i8_report_pdf', $post_id );
            $word_url = i8_get_meta( 'i8_report_word', $post_id );
            ?>
            <div class="report-meta">
                <h4>فایل‌های گزارش</h4>
                <?php if ( $pdf_url ) : ?>
                    <a href="<?php echo esc_url( $pdf_url ); ?>" class="download-link pdf" target="_blank">
                        <i class="fas fa-file-pdf"></i> دانلود PDF
                    </a>
                <?php endif; ?>
                
                <?php if ( $word_url ) : ?>
                    <a href="<?php echo esc_url( $word_url ); ?>" class="download-link word" target="_blank">
                        <i class="fas fa-file-word"></i> دانلود Word
                    </a>
                <?php endif; ?>
            </div>
            <?php
            break;

        case 'multimedia':
            $duration = i8_get_meta( 'i8_media_duration', $post_id );
            $video_url = i8_get_meta( 'i8_media_url', $post_id );
            $embed_code = i8_get_meta( 'i8_media_embed', $post_id );
            ?>
            <div class="multimedia-meta">
                <?php if ( $duration ) : ?>
                    <div class="duration">
                        <i class="fas fa-clock"></i> مدت زمان: <?php echo esc_html( $duration ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( $video_url ) : ?>
                    <div class="video-link">
                        <a href="<?php echo esc_url( $video_url ); ?>" target="_blank">
                            <i class="fas fa-play"></i> مشاهده ویدیو
                        </a>
                    </div>
                <?php endif; ?>
                
                <?php if ( $embed_code ) : ?>
                    <div class="embed-container">
                        <?php echo wp_kses_post( $embed_code ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
            break;

        case 'session':
            $field = i8_get_meta( 'i8_session_field', $post_id );
            $date = i8_get_meta( 'i8_session_date', $post_id );
            $host = i8_get_meta( 'i8_session_host', $post_id );
            $position = i8_get_meta( 'i8_session_position', $post_id );
            ?>
            <div class="session-meta">
                <h4>جزئیات نشست</h4>
                <?php if ( $field ) : ?>
                    <div class="session-field">
                        <strong>حوزه تخصصی:</strong> <?php echo esc_html( $field ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( $date ) : ?>
                    <div class="session-date">
                        <strong>تاریخ برگزاری:</strong> <?php echo esc_html( date_i18n( 'j F Y', strtotime( $date ) ) ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( $host ) : ?>
                    <div class="session-host">
                        <strong>میزبان:</strong> <?php echo esc_html( $host ); ?>
                        <?php if ( $position ) : ?>
                            <span class="position">(<?php echo esc_html( $position ); ?>)</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
            break;

        case 'event':
            $month = i8_get_meta( 'i8_event_date_month', $post_id );
            $day = i8_get_meta( 'i8_event_date_day', $post_id );
            $location = i8_get_meta( 'i8_event_location', $post_id );
            ?>
            <div class="event-meta">
                <h4>جزئیات رویداد</h4>
                <?php if ( $month || $day ) : ?>
                    <div class="event-date">
                        <i class="fas fa-calendar"></i>
                        <?php if ( $day ) echo esc_html( $day ); ?>
                        <?php if ( $month ) echo ' ' . esc_html( $month ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( $location ) : ?>
                    <div class="event-location">
                        <i class="fas fa-map-marker-alt"></i> <?php echo esc_html( $location ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
            break;

        case 'publication':
            $author = i8_get_meta( 'i8_publication_author', $post_id );
            ?>
            <div class="publication-meta">
                <?php if ( $author ) : ?>
                    <div class="publication-author">
                        <strong>نویسنده:</strong> <?php echo esc_html( $author ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
            break;

        case 'course':
            $instructor = i8_get_meta( 'i8_course_instructor', $post_id );
            $course_date = i8_get_meta( 'i8_course_date', $post_id );
            ?>
            <div class="course-meta">
                <h4>جزئیات دوره</h4>
                <?php if ( $instructor ) : ?>
                    <div class="course-instructor">
                        <strong>مدرس:</strong> <?php echo esc_html( $instructor ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( $course_date ) : ?>
                    <div class="course-date">
                        <strong>تاریخ برگزاری:</strong> <?php echo esc_html( date_i18n( 'j F Y', strtotime( $course_date ) ) ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
            break;

        default:
            // Simple post - no additional meta to display
            break;
    endswitch;
    ?>
</div>

<style>
.i8-post-meta {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
}

.post-meta-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #dee2e6;
}

.post-type-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    color: white;
}

.badge-simple { background-color: #6c757d; }
.badge-report { background-color: #007bff; }
.badge-multimedia { background-color: #28a745; }
.badge-session { background-color: #ffc107; color: #212529; }
.badge-event { background-color: #dc3545; }
.badge-publication { background-color: #6f42c1; }
.badge-course { background-color: #fd7e14; }

.main-category a {
    color: #495057;
    text-decoration: none;
}

.main-category a:hover {
    color: #007bff;
}

.download-link {
    display: inline-block;
    padding: 8px 16px;
    margin: 5px 10px 5px 0;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.download-link:hover {
    background: #0056b3;
    color: white;
}

.download-link.pdf {
    background: #dc3545;
}

.download-link.word {
    background: #0d6efd;
}

.session-meta div,
.event-meta div,
.course-meta div,
.publication-meta div {
    margin-bottom: 8px;
}

.embed-container {
    margin-top: 15px;
}

.position {
    font-style: italic;
    color: #6c757d;
}
</style>