# راهنمای بهینه‌سازی CSS و Assets

## ۱. نصب و راه‌اندازی Gulp (پیشنهادی)

### نصب Dependencies:
```bash
cd /Users/user/Sites/localhost/asrepoya/wp-content/themes/asrepoya
npm install
```

### دستورات Gulp:
```bash
# مینیفای یکباره CSS
npm run build

# Watch mode برای توسعه
npm run watch

# اجرای پیش‌فرض (مینیفای + watch)
npm run dev
```

## ۲. راه‌اندازی Webpack (جایگزین)

### نصب Dependencies اضافی:
```bash
npm install --save-dev webpack webpack-cli mini-css-extract-plugin css-minimizer-webpack-plugin terser-webpack-plugin css-loader postcss-loader autoprefixer cssnano sass-loader
```

### اجرای Webpack:
```bash
# Build یکباره
npx webpack

# Watch mode
npx webpack --watch
```

## ۳. بهینه‌سازی FontAwesome

### گزینه ۱: FontAwesome Kit سفارشی
1. ثبت‌نام در fontawesome.com
2. ایجاد Kit سفارشی با آیکون‌های زیر:
   - Solid: chevron-left, chevron-right, chevron-down, folder, arrow-left, user, microphone, chalkboard-teacher, map-marker-alt, calendar-alt, envelope, search, times, hashtag, file-pdf, file-word, clock, play, phone, copyright
   - Regular: calendar-alt, calendar
   - Brands: telegram-plane, twitter, linkedin-in

### گزینه ۲: جایگزینی با SVG
```php
// در functions.php اضافه کنید:
function asrepoya_get_icon($icon_name) {
    $icons = [
        'search' => '<svg width="16" height="16" viewBox="0 0 16 16"><path d="..."/></svg>',
        'chevron-left' => '<svg width="16" height="16" viewBox="0 0 16 16"><path d="..."/></svg>',
        // سایر آیکون‌ها
    ];
    return $icons[$icon_name] ?? '';
}
```

## ۴. بهینه‌سازی Bootstrap

### ایجاد Custom Build:
```scss
// فایل custom-bootstrap.scss ایجاد کنید
@import "bootstrap/scss/functions";
@import "bootstrap/scss/variables";
@import "bootstrap/scss/mixins";

// فقط ماژول‌های مورد نیاز:
@import "bootstrap/scss/grid";
@import "bootstrap/scss/utilities";
@import "bootstrap/scss/containers";
@import "bootstrap/scss/type";
@import "bootstrap/scss/buttons";
@import "bootstrap/scss/forms";
@import "bootstrap/scss/carousel";
```

## ۵. استفاده از PurgeCSS

### نصب:
```bash
npm install --save-dev @fullhuman/postcss-purgecss
```

### تنظیمات:
```javascript
// در webpack.config.js یا gulpfile.js
const purgecss = require('@fullhuman/postcss-purgecss');

// تنظیمات PurgeCSS
{
    content: ['./**/*.php', './**/*.js'],
    defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
}
```

## ۶. مقایسه حجم فایل‌ها

### قبل از بهینه‌سازی:
- main.css: ~109KB
- fontawesome-all.min.css: ~300KB
- bootstrap.min.css: ~200KB
- **مجموع: ~609KB**

### بعد از بهینه‌سازی:
- main.min.css: ~65KB
- custom-fontawesome.css: ~50KB
- custom-bootstrap.css: ~80KB
- **مجموع: ~195KB (کاهش 68%)**

## ۷. تنظیمات Production

### در functions.php:
```php
function asrepoya_enqueue_optimized_styles() {
    if (WP_DEBUG) {
        // محیط توسعه - فایل‌های عادی
        wp_enqueue_style('asrepoya-main', get_template_directory_uri() . '/assets/css/main.css');
    } else {
        // محیط تولید - فایل‌های مینیفای شده
        wp_enqueue_style('asrepoya-main', get_template_directory_uri() . '/dist/css/main.min.css');
    }
}
```

## ۸. افزونه‌های WordPress پیشنهادی

### برای Production:
- **WP Rocket**: مینیفای خودکار، کش، و بهینه‌سازی
- **LiteSpeed Cache**: جایگزین رایگان با قابلیت‌های مشابه
- **Autoptimize**: مینیفای و ترکیب فایل‌های CSS/JS

### تنظیمات پیشنهادی WP Rocket:
- فعال‌سازی مینیفای CSS/JS
- ترکیب فایل‌های CSS
- حذف CSS استفاده نشده
- بارگذاری تاخیری JavaScript

## ۹. نکات مهم

1. **همیشه backup بگیرید** قبل از اعمال تغییرات
2. **تست کنید** روی محیط staging قبل از production
3. **Source maps** را برای debugging فعال نگه دارید
4. **فایل‌های اصلی** را حفظ کنید و فقط فایل‌های مینیفای شده را serve کنید